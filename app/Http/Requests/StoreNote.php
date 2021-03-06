<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request to validate Note input
 * @package App\Http\Requests
 */
class StoreNote extends FormRequest
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
            'content'=>'required|min:10'
        ];
    }

    /**
     * Custom error messages for when validation fails
     * @return array
     */
    public function messages()
    {
        return [
            'content.required'=>'Your note cannot be blank.',
        ];
    }
}
