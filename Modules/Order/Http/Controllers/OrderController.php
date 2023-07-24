<?php

namespace Modules\Order\Http\Controllers;

use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Order\Entities\Order;
use Modules\Order\Http\Requests\OrderFormRequest;
use DB;

class OrderController extends BaseController
{
    use UploadAble;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        if (permission('order-access')) {
            $this->setPageData('Order', 'Order', 'fas fa-box');
            $data['payment_methods'] = DB::table('payment_methods')->get();
            return view('order::index',$data);
        } else {
            return $this->unauthorized_access_blocked();
        }
    }

    public function get_datatable_data(Request $request)
    {
        if (permission('order-access')) {
            if ($request->ajax()) {
                if (!empty($request->name)) {
                    $this->model->setName($request->name);
                }

                $this->set_datatable_default_property($request);
                $list = $this->model->getDatatableList();

                $data = [];
                $no = $request->input('start');

                foreach ($list as $value) {

                    $no++;
                    $action = '';

                    if (permission('order-edit')) {
                        $action .= ' <a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fas fa-edit text-primary"></i> Edit</a>';
                    }
                    if (permission('order-delete')) {
                        $action .= ' <a class="dropdown-item delete_data"  data-id="' . $value->id . '" data-name="' . $value->id . '"><i class="fas fa-trash text-danger"></i> Delete</a>';
                    }

                    $row = [];

                    if (permission('order-bulk-delete')) {
                        $row[] = table_checkbox($value->id);
                    }
                    $options = '<select name="order_status_id" id="order_status_id" class="form-control order_status_id" onchange="getOrderStatus(this.value, '.$value->id.')">
                        <option value="">Select Please</option>
                        <option '. ($value->order_status_id == 1 ? 'selected' : '') .' value="1">PENDING</option>
                        <option '. ($value->order_status_id == 2 ? 'selected' : '') .' value="2">PROCESSING</option>
                        <option '. ($value->order_status_id == 3 ? 'selected' : '') .' value="3">SHIPPED</option>
                        <option '. ($value->order_status_id == 4 ? 'selected' : '') .' value="4">DELIVERED</option>
                        <option '. ($value->order_status_id == 5 ? 'selected' : '') .' value="5">CANCELED</option>
                    </select>';

                    $row[] = $no;
                    $row[] = $value->order_date;
                    $row[] = $value->shipping_address;
                    $row[] = $value->total;
                    $row[] = $options;
                    $row[] = permission('order-edit') ? change_payment_status($value->id,$value->payment_status_id,$value->payment_status_id) : PAYMENT_STATUS_LABEL[$value->payment_status_id];;
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

    public function store_or_update_data(OrderFormRequest $request)
    {
        if ($request->ajax()) {
            if (permission('order-add') || permission('order-edit')) {
                $collection = collect($request->validated());
                $collection = $this->track_data($request->update_id, $collection);

                $result = $this->model->updateOrCreate(['id' => $request->update_id], $collection->all());
                $output = $this->store_message($result, $request->update_id);
            } else {
                $output = $this->access_blocked();
            }
            return response()->json($output);
        } else {
            return response()->json($this->access_blocked());
        }
    }


    public function edit(Request $request)
    {
        if ($request->ajax()) {
            if (permission('order-edit')) {
                $data = $this->model->findOrFail($request->id);
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
            if (permission('order-delete')) {
                $scategory = $this->model->find($request->id);
                $image = $scategory->image;
                $result = $scategory->delete();
                if ($result) {
                    if (!empty($image)) {
                        $this->delete_file($image, SUB_CATEGORY_IMAGE_PATH);
                    }
                }
                $output = $this->delete_message($result);
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
            if (permission('order-bulk-delete')) {
                $scategorys = $this->model->toBase()->select('image')->whereIn('id', $request->ids)->get();
                $result = $this->model->destroy($request->ids);
                if ($result) {
                    if (!empty($scategorys)) {
                        foreach ($scategorys as $scategory) {
                            if ($scategory->image) {
                                $this->delete_file($scategory->image, SUB_CATEGORY_IMAGE_PATH);
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

    public function change_payment_status(Request $request)
    {
        if ($request->ajax()) {
            if (permission('order-edit')) {
                $result = $this->model->find($request->id)->update(['payment_status_id' => $request->status]);
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

    public function change_order_status(Request $request){
        if ($request->ajax()) {
            if (permission('order-edit')) {
                $result = $this->model->find($request->id)->update(['order_status_id' => $request->order_id]);
                $output = $result ? ['status' => 'success', 'message' => 'Status has been changed successfully']
                    : ['status' => 'error', 'message' => 'Failed to change status'];
                return response()->json($output);
            }else{
                return response()->json($this->access_blocked());
            }
        }
    }
}

