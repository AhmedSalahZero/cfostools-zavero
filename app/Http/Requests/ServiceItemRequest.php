<?php

namespace App\Http\Requests;

use App\Rules\UniqueToCompanyRule;
use Illuminate\Validation\Rule;

class ServiceItemRequest extends CustomJsonRequest
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
                'service_item'=>[
                    getAddNewFieldRule('service_item_id'),
                    new UniqueToCompanyRule('ServiceItem','name',Request('old_service_category_id'))
            ] ,
        ] ;

    }

    public function messages():array
    {

        return [
                 'service_item.required'=>__('Please Enter Service Item Name'),
                 'service_item.unique'=>__('This Service Item Name Already Exist') ,
        ];
    }

}
