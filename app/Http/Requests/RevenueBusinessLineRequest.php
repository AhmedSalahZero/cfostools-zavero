<?php

namespace App\Http\Requests;

use App\Rules\UniqueToCompanyRule;
use Illuminate\Validation\Rule;

class RevenueBusinessLineRequest extends CustomJsonRequest
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
    public static function rules():array
    {

        return [
                'revenue_business_line_name'=>[
                    getAddNewFieldRule('revenue_business_line_id'),
                    new UniqueToCompanyRule('RevenueBusinessLine','name',Request('old_revenue_business_line_id'))
            ] ,
        ] ;

    }

    public function messages():array
    {

        return [
                 'revenue_business_line_name.required'=>__('Please Enter Revenue Business Line Name'),
                 'revenue_business_line_name.unique'=>__('This Revenue Business Line Name Already Exist') ,
        ];
    }

}
