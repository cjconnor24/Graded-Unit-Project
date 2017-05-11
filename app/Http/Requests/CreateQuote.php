<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuote extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id'=>'required',
            'address_id'=>'required',
            'branch_id'=>'required',
            'order'=>'required|array',
            'order.*.product_id'=>'required|integer',
            'order.*.paper_id'=>'required|integer',
            'order.*.size_id'=>'required|integer',
            'order.*.qty'=>'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required'=>'Please select the customer.',
            'branch_id.required'=>'Please choose a branch for the quote.',
            'address_id.required'=>'Please select the customer\'s address.',
            'order.required'=>'Please add at least one item to the quotation.',
            'order.*.qty.required'=>'Please enter a quantity for all products.'
        ];
    }
}
