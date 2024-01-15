<?php

namespace App\Http\Requests;

use App\Rules\UniqueToCompanyRule;
use Illuminate\Validation\Rule;

class ServiceCategoryRequest extends CustomJsonRequest
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
                'service_category_name'=>[
                    getAddNewFieldRule('service_category_id'),
                    new UniqueToCompanyRule('ServiceCategory','name',Request('old_service_category_id'))
            ] ,
        ] ;

    }

    public function messages():array
    {

        return [
                 'service_category_name.required'=>__('Please Enter Service Category Name'),
                 'service_category_name.unique'=>__('This Service Category Name Already Exist') ,
        ];
    }

}
