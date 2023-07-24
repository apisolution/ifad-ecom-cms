<?php

namespace Modules\Combo\Http\Controllers;

use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\ComboCategory\Entities\ComboCategory;
use Modules\Combo\Entities\Combo;
use Modules\Combo\Entities\ComboItem;
use Modules\Inventory\Entities\Inventory;
use Modules\Combo\Http\Requests\ComboFormRequest;
use DB;

class ComboController extends BaseController
{
    use UploadAble;

    public function __construct(Combo $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        // dd($this->model->getDatatableList());
        if (permission('combo-access')) {
            $this->setPageData('combo Product', 'combo Product', 'fas fa-box');
            $data = [
                'ComboCategories' => ComboCategory::all(),
                'Inventories' => Inventory::all(),
            ];
            return view('combo::index', $data);
        } else {
            return $this->unauthorized_access_blocked();
        }
    }

    public function get_datatable_data(Request $request)
    {
        if (permission('combo-access')) {
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

                    if (permission('combo-edit')) {
                        $action .= ' <a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fas fa-edit text-primary"></i> Edit</a>';
                    }
                    if (permission('combo-delete')) {
                        $action .= ' <a class="dropdown-item delete_data"  data-id="' . $value->id . '" data-name="' . $value->title . '"><i class="fas fa-trash text-danger"></i> Delete</a>';
                    }

                    $row = [];
                    if (permission('combo-bulk-delete')) {
                        $row[] = table_checkbox($value->id);
                    }
                    $row[] = $no;
                    $row[] = $value->title;
                    $row[] = $value->sale_price;
                    $row[] = $value->stock_quantity;
                    $row[] = permission('combo-edit') ? change_status($value->id, $value->status, $value->title) : STATUS_LABEL[$value->status];

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

    public function store_or_update_data(ComboFormRequest $request)
    {
        if ($request->ajax()) {
            if (permission('combo-add') || permission('combo-edit')) {
                $collection = collect($request->validated())->except(['combo_category_id']);
                $collection = $this->track_data($request->update_id, $collection);
                $combo_category_id = $request->combo_category_id;
                $collection = $collection->merge(compact('combo_category_id'));
                $result = $this->model->updateOrCreate(['id' => $request->update_id], $collection->all());
                //$output = $this->store_message($result, $request->update_id);

                //combo variant option save start
                $combo['combo_id'] = $result->id??0;
                $inventory_ids = $request->inventory_id;

                for($i=0;$i<count($request->inventory_id); $i++){
                    ComboItem::updateOrCreate(['combo_id' => $request->update_id], [
                        'combo_id'=>$result->id??0,
                        'inventory_id'=>$inventory_ids[$i],
                    ]);
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
            if (permission('combo-edit')) {
                $data = $this->model->findOrFail($request->id);
                $data->load('inventoryComboItems');
                $data['all_inventory'] = Inventory::get();
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
            if (permission('combo-delete')) {
                $combo_item = ComboItem::whereIn('combo_id',$request->id)->delete();
                $combo = $this->model->find($request->id);
                $combo->delete();
                $output = $this->delete_message($combo);
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
            if (permission('combo-bulk-delete')) {
                $combo_item = ComboItem::where('combo_id',$request->id)->delete();
                $result = $this->model->destroy($request->ids);
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
            if (permission('combo-edit')) {
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
