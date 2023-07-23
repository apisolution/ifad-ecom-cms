<?php

namespace Modules\Inventory\Http\Controllers;

use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Inventory\Entities\InventoryVariant;
use Modules\Product\Entities\Product;
use Modules\Inventory\Entities\Inventory;
use Modules\Inventory\Http\Requests\InventoryFormRequest;
use App\Models\InventoryImage;
use DB;
use Modules\Variant\Entities\Variant;
use Modules\VariantOption\Entities\VariantOption;

class InventoryController extends BaseController
{
    use UploadAble;

    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        // dd($this->model->getDatatableList());
        if (permission('inventory-access')) {
            $this->setPageData('Inventory Product', 'Inventory Product', 'fas fa-box');
            $data = [
                'products' => Product::all(),
                'variants' => Variant::get(),
                 'variant_options' => VariantOption::get()
            ];
            return view('inventory::index', $data);
        } else {
            return $this->unauthorized_access_blocked();
        }
    }

    public function get_datatable_data(Request $request)
    {
        if (permission('inventory-access')) {
            if ($request->ajax()) {
                if (!empty($request->name)) {
                    $this->model->setName($request->name);
                }
                if (!empty($request->product_id)) {
                    $this->model->setProduct($request->product_id);
                }

                $this->set_datatable_default_property($request);
                $list = $this->model->getDatatableList();

                $data = [];
                $no = $request->input('start');
                foreach ($list as $value) {

                    $no++;
                    $action = '';

                    if (permission('inventory-edit')) {
                        $action .= ' <a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fas fa-edit text-primary"></i> Edit</a>';
                    }
                    if (permission('inventory-delete')) {
                        $action .= ' <a class="dropdown-item delete_data"  data-id="' . $value->id . '" data-name="' . $value->title . '"><i class="fas fa-trash text-danger"></i> Delete</a>';
                    }

                    $row = [];
                    if (permission('inventory-bulk-delete')) {
                        $row[] = table_checkbox($value->id);
                    }
                    $row[] = $no;
                    $row[] = $value->title;
                    $row[] = $value->sale_price;
                    $row[] = $value->stock_quantity;
                    $row[] = permission('inventory-edit') ? change_status($value->id, $value->status, $value->title) : STATUS_LABEL[$value->status];

                    $row[] = action_button($action);
                    $data[] = $row;
                }
                return $this->datatable_draw($request->input('draw'), $this->model->count_all(),
                    $this->model->count_filtered(), $data);
            } else {
                $output = $this->access_blocked();
            }

            return response()->json($output);
        }
    }

    public function store_or_update_data(InventoryFormRequest $request)
    {
        if ($request->ajax()) {
//            return $request->all();
            if (permission('inventory-add') || permission('inventory-edit')) {
                $collection = collect($request->validated())->except(['fileUpload', 'product_id']);
                $collection = $this->track_data($request->update_id, $collection);
                $product_id = $request->product_id;
                $collection = $collection->merge(compact('product_id'));
                $result = $this->model->updateOrCreate(['id' => $request->update_id], $collection->all());
                //$output = $this->store_message($result, $request->update_id);

                //inventory variant option save start
                $inventory['inventory_id'] = $result->id??0;
                $inventory_variant_option = collect($inventory);

                if(isset($request->update_id) && $request->update_id !==''){
                    InventoryVariant::where('inventory_id',$request->update_id)->delete();
                    for($i=0;$i<count($request->variant_id); $i++){
                        InventoryVariant::create([
                            'inventory_id'=>$request->update_id,
                            'variant_id'=>$request->variant_id[$i],
                            'variant_option_id'=>$request->variant_option_id[$i],
                        ]);
                    }
                }else{
                    for($i=0;$i<count($request->variant_id); $i++){
                        InventoryVariant::create([
                            'inventory_id'=>$result->id,
                            'variant_id'=>$request->variant_id[$i],
                            'variant_option_id'=>$request->variant_option_id[$i],
                        ]);
                    }
                }


              $output = $this->store_message($result, $request->update_id);
              return response()->json($output);

            } else {
                $output = $this->access_blocked();
                return response()->json($output);
            }

        } else {
            return response()->json($this->access_blocked());
        }
    }


    public function edit(Request $request)
    {
        if ($request->ajax()) {
            if (permission('inventory-edit')) {
                $data = $this->model->findOrFail($request->id);
                $data->load('inventoryVariants');
                $data['all_variant_options'] = VariantOption::get();
                $data['variants'] = Variant::get();
                $output = $this->data_message($data);
            } else {
                $output = $this->access_blocked();
            }
            return response()->json($output);
        } else {
            return response()->json($this->access_blocked());
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            if (permission('inventory-delete')) {
                $inventory_varient = InventoryVariant::where('inventory_id',$request->id)->delete();
                $inventory = $this->model->find($request->id);
                $inventory->delete();

//                $image = $pimage->image;
//                $result = $pimage->delete();
//                if ($result) {
//                    if (!empty($image)) {
//                        $this->delete_file($image, PRODUCT_MULTI_IMAGE_PATH);
//                    }
//                }
                $output = $this->delete_message($inventory);
            } else {
                $output = $this->access_blocked();
            }
            return response()->json($output);
        } else {
            return response()->json($this->access_blocked());
        }
    }

    public function bulk_delete(Request $request)
    {
        if ($request->ajax()) {
            if (permission('inventory-bulk-delete')) {
                $pimages = $this->model->toBase()->select('image')->whereIn('id', $request->ids)->get();
                $result = $this->model->destroy($request->ids);
                if ($result) {
                    if (!empty($pimages)) {
                        foreach ($pimages as $pimage) {
                            if ($pimage->image) {
                                $this->delete_file($pimage->image, PRODUCT_MULTI_IMAGE_PATH);
                            }
                        }
                    }
                }
                $output = $this->bulk_delete_message($result);
            } else {
                $output = $this->access_blocked();
            }
            return response()->json($output);
        } else {
            return response()->json($this->access_blocked());
        }
    }

    public function change_status(Request $request)
    {
        if ($request->ajax()) {
            if (permission('inventory-edit')) {
                $result = $this->model->find($request->id)->update(['status' => $request->status]);
                $output = $result ? ['status' => 'success', 'message' => 'Status has been changed successfully']
                    : ['status' => 'error', 'message' => 'Failed to change status'];
            } else {
                $output = $this->access_blocked();
            }
            return response()->json($output);
        } else {
            return response()->json($this->access_blocked());
        }
    }
}

