<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevenueBusinessGroupingRequest extends FormRequest
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
        $rules = [
            RevenueBusinessLineRequest::class ,
            ServiceCategoryRequest::class ,
            ServiceItemRequest::class 
        ];
        $mergedRules = [];
        foreach($rules as $rulePath)
        {
            $mergedRules = array_merge($mergedRules , App($rulePath)->rules());
        }
        
        return $mergedRules;
    }

}
