<?php

namespace Modules\Combo\Http\Requests;

use App\Http\Requests\FormRequest;

class ComboFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $rules['combo_category_id'] = ['required'];
        $rules['title']       = ['required'];
        $rules['sku']  = ['required','unique:combos,sku'];
        if(request()->update_id){
            $rules['sku'] = 'unique:combos,sku,'.request()->update_id;
        }
        $rules['sale_price']       = ['nullable'];
        $rules['offer_price']       = ['nullable'];
        $rules['offer_start']       = ['nullable'];
        $rules['offer_end']       = ['nullable'];
        $rules['stock_quantity']       = ['nullable'];
        $rules['reorder_quantity']       = ['nullable'];
        $rules['is_special_deal']       = ['nullable'];
        $rules['is_manage_stock']       = ['nullable'];
        $rules['min_order_quantity']       = ['nullable'];
        $rules['inventory_id']       = ['required'];
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
