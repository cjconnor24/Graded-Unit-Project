<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request to validate input when storing branch data
 * @package App\Http\Requests
 */
class StoreBranch extends FormRequest
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
            'name'=>'required|unique:branches',
            'address1'=>'required',
            'postcode'=>'required',
            'telephone'=>'required',
            'email'=>'required|email'
        ];
    }
}
