<?php

namespace Modules\Customer\Http\Controllers;

use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Http\Requests\CustomerFormRequest;

class CustomerController extends BaseController
{
    use UploadAble;

    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        if (permission('customer-access')) {
            $this->setPageData('Customer', 'Customer', 'fas fa-th-list');
            return view('customer::index');
        } else {
            return $this->unauthorized_access_blocked();
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function get_datatable_data(Request $request)
    {
        if (permission('customer-access')) {
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

                    if (permission('customer-edit')) {
                        $action .= ' <a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fas fa-edit text-primary"></i> Edit</a>';
                    }
                    if (permission('customer-delete')) {
                        $action .= ' <a class="dropdown-item delete_data"  data-id="' . $value->id . '" data-name="' . $value->name . '"><i class="fas fa-trash text-danger"></i> Delete</a>';
                    }


                    $row = [];

                    if (permission('customer-bulk-delete')) {
                        $row[] = table_checkbox($value->id);
                    }
                    $row[] = $no;
                    $row[] = $value->name;
                    $row[] = permission('customer-edit') ? change_status($value->id, $value->status, $value->name) : STATUS_LABEL[$value->status];;
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

    /**
     * @param CustomerFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_or_update_data(CustomerFormRequest $request)
    {

        if ($request->ajax()) {
            if (permission('customer-add') || permission('customer-edit')) {
                $collection = collect($request->validated())->except(['image']);
                $collection = $this->track_data($request->update_id, $collection);
                $image = $request->old_image;
                if ($request->hasFile('image')) {
                    $image = $this->upload_file($request->file('image'), Customer_IMAGE_PATH);

                    if (!empty($request->old_image)) {
                        $this->delete_file($request->old_image, Customer_IMAGE_PATH);
                    }
                }

                $collection = $collection->merge(compact('image'));
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {
            if (permission('customer-edit')) {
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            if (permission('customer-delete')) {
                $result = $this->model->find($request->id)->delete();
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
            if (permission('customer-bulk-delete')) {
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
            if (permission('customer-edit')) {
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
