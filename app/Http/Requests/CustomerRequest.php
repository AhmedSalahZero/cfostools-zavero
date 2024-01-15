<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
            'customer_name'=>'required|max:255',
            'customer_type'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required'=>__('Please Enter Customer Or Lead Name'),
            'customer_name.max'=>__('Max Letters Numbers For Customer Or Lead Name'),
            'customer_type.required'=>__('Please Select Customer Type')
        ];
    }
}
