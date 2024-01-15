<?php

namespace App\Validators;

use App\Interfaces\Validators\IValidateModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RevenueBusinessLineValidator implements IValidateModel
{
    public function validate(Request $request)
    {

        $validator = Validator::make( $request->all() , [
            'branch_id'=>'required|exists:branches,id',
            'name_en'=>'required|unique:expense_categories,name_en,'.Request('id') ,
            'name_ar'=>'required|unique:expense_categories,name_ar,'.Request('id') ,
            'code'=>'nullable|unique:expense_categories,code,'.Request('id')
        ]  , [
              'branch_id.required'=>__('Please Select Branch'),
            'branch_id.exists'=>__('This Branch Does Not Exist'),
            'name_en.required'=>__('Please Enter English Name')  ,
            'name_en.unique'=>__('This English Name Already Exist') ,
            'name_ar.required'=>__('Please Enter Arabic Name')  ,
            'name_ar.unique'=>__('This Arabic Name Already Exist') ,
            'code.unique'=>__('This Code Already Exist')
        ] );



        if($validator->fails())
        {
            return response()->json([
                'status'=>false ,
                'message'=>$validator->errors()->first(),
                'showAlert'=>true ,
            ],400);
        }

    }
}
