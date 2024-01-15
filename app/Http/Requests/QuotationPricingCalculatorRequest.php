<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationPricingCalculatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }
    
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'date'=>'required',
            'customer_id'=>'required|numeric',
            'business_sector_id'=>'required|numeric',
            'services'=>'required|array',
            'services.*'=>'required|array',
            'services.*.revenue_business_line_id'=>'required|numeric',
            'services.*.service_category_id'=>'required|numeric',
            'services.*.service_item_id'=>'required|numeric',
            'services.*.service_nature_id'=>'required|numeric',
            'services.*.delivery_days'=>'required|numeric',
            'manpower_expenses'=>'required|array',
            'manpower_expenses.*'=>'required|array',
            'manpower_expenses.*.service_item_id'=>'required',
            'variable_mp_expense_percentage'=>'nullable|numeric',
        ];
    }


     public function messages()
    {
        return [
            'name.required'=>__('Please Enter Quotation Pricing Calculator Name'),
            'date.required'=>__('Please Enter Date'),
            'customer_id.required'=>__('Please Select Customer Or Lead'),
            'customer_id.numeric'=>__('Please Select Customer Or Lead'),
            'business_sector_id.required'=>__('Please Select Business Sector'),
            'business_sector_id.numeric'=>__('Please Select Business Sector'),
            'services.*.required'=>__('Please Select Revenue Business Line '),
            'services.*.service_category_id.required'=>__('Please Select Service Category Id'),
            'services.*.revenue_business_line_id.required'=>__('Please Select Business Line Id'),
            'services.*.service_item_id.required'=>__('Please Select Service Item Id'),
            'services.*.delivery_days.required'=>__('Please Enter Delivery Days'),
            'manpower_expenses.required'=>__('Please Enter Manpower Expense'),
            'manpower_expenses.*.service_item_id.required'=>__('Please Enter Manpower Expense Service Category')
        ];
    }


}
