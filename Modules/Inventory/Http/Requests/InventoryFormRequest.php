<?php

namespace Modules\Inventory\Http\Requests;

use App\Http\Requests\FormRequest;

class InventoryFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['product_id'] = ['required'];
//        $rules['title'] = ['required','unique:inventories,title,id,'.$this->id];
//        $rules['sku'] = ['required','unique:inventories,sku,id,'.$this->id];
        $rules['image']  = ['nullable','image','mimes:png,jpg'];
        $rules['title']  = ['nullable'];
        $rules['sku']  = ['nullable'];
        $rules['sale_price']  = ['nullable'];
        $rules['offer_price']  = ['nullable'];
        $rules['offer_start']  = ['nullable'];
        $rules['offer_end']  = ['nullable'];
        $rules['stock_quantity']  = ['nullable'];
        $rules['reorder_quantity']  = ['nullable'];
        $rules['min_order_quantity']  = ['nullable'];
        $rules['min_order_quantity']  = ['nullable'];
        $rules['is_special_deal']  = ['nullable'];
        $rules['is_manage_stock']  = ['nullable'];
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
