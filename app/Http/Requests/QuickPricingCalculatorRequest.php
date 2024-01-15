<?php

namespace App\Http\Requests;

use App\Rules\UniqueToCompanyRule;
use Illuminate\Validation\Rule;

class QuickPricingCalculatorRequest extends CustomJsonRequest
{

    protected $stopOnFirstFailure = true;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function messages():array  
    {
            return [
                'date.required'=>__('Please Enter Date'),
                'revenue_business_line_id.required'=>__('Please Select Revenue Business Line'),
                'service_category_id.required'=>__('Please Select Service Category'),
                'service_item_id.required'=>__('Please Select Service Item'),
                'service_nature_id.required'=>__('Please Select Service Nature'),
                'delivery_days.required'=>__('Please Enter Delivery Days'),
                'currency_id.required'=>__('Please Select Currency'),
                'manpower_expenses.required'=>__('Please Enter Manpower Expense'),
                'freelancer_expenses.required_if'=>__('Please Enter Freelancer Expense'),
                'freelancer_expense.*.required_if'=>__('Please Enter Freelancer Expense'),
                'freelancer_expenses.*.*.required_if'=>__('Please Enter Freelancer Fields'),
                'smex_expense_percentage.required'=>__('Please Enter Sales And Marketing Expense Percentage'),
                'smex_cost_per_unit.required'=>__('Please Enter Sales And Marketing Expense Cost Per Unit'),
                'smex_units_count.required'=>__('Please Enter Sales And Marketing Expense Unit Count'),
                'net_profit_after_taxes_percentage.required'=>__('Please Enter Net Profit After Taxes Percentage'),
                'vat_percentage.required'=>__('Please Enter Vat Percentage')
            ];
    }
    public static function rules():array
    {

		// dd(Request()->all());
        return [
            'date'=>'required',
            'revenue_business_line_id'=>'required',
            'service_category_id'=>'required',
            'service_item_id'=>'required',
            'service_nature_id'=>'required',
            'delivery_days'=>'required|numeric|gt:0',
            'currency_id'=>'required',
            'manpower_expenses'=>'required|array',
            'manpower_expenses.*'=>'required|array',
            'variable_mp_expense_percentage'=>'nullable|numeric',
            'mp_cost_per_unit'=>'nullable|numeric',
            'mp_units_count'=>'nullable|numeric',
            'mp_total_cost'=>'nullable',
            'use_freelancer'=>'nullable',
            'freelancer_expenses'=>'required_if:use_freelancer,1',
            'freelancer_expenses.*'=>'required_if:use_freelancer,1|array',
            'freelancer_expenses.*.*'=>'required_if:use_freelancer,1',
            'direct_opex_expense_percentage'=>'nullable|numeric',
            'direct_opex_cost_per_unit'=>'nullable|numeric',
            'direct_opex_units_count'=>'nullable|numeric',
            'direct_opex_total_cost'=>'nullable',
            'smex_expense_percentage'=>'nullable|numeric',
            'smex_cost_per_unit'=>'nullable|numeric',
            'smex_units_count'=>'nullable|numeric',
            'smex_total_cost'=>'nullable',
            'gaex_expense_percentage'=>'nullable|numeric',
            'gaex_cost_per_unit'=>'nullable|numeric',
            'gaex_units_count'=>'nullable|numeric',
            'gaex_total_cost'=>'nullable',
            'corporate_taxes_percentage'=>'required',
            'net_profit_after_taxes_percentage'=>'required',
            'vat_percentage'=>'required',
            'total_recommend_price_without_vat'=>'required',
            'total_recommend_price_with_vat'=>'required',
            'price_per_day_without_vat'=>'required',
            'price_per_day_with_vat'=>'required',
            'total_net_profit_after_taxes'=>'required',
            'net_profit_after_taxes_per_day'=>'required',
            // 'price_sensitiviy_rate'=>'required',
            'total_sensitive_price_without_vat'=>'required',
            'total_sensitive_price_with_vat'=>'required',
            'sensitive_price_per_day_without_vat'=>'required',
            'sensitive_price_per_day_with_vat'=>'required',
            'sensitive_total_net_profit_after_taxes'=>'required',
            'sensitive_net_profit_after_taxes_per_day'=>'required',
            'sensitive_net_profit_after_taxes_percentage'=>'required'            ,
            'price_sensitivity'=>'nullable|numeric'            
        ];

    }

}
