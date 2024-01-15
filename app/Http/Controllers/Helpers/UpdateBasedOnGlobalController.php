<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateBasedOnGlobalController extends Controller
{

    
    public function __invoke(Request $request)
    {
        $result = '';

        // if($request->get('add_new_item'))
        // {
                
        //     $result = '<option class="add-new-item" >'. __('Add New')  .' </option>';
        // }
        $parentModel = (\getModelNamespace().$request->get('parentModelName'))::find($request->get('parentModelId'));
        
        if($parentModel)
        {
            $childRelationName = $request->get('childRelationName');

            $childrenModels = $parentModel->$childRelationName()->get();
            $result =  formatSelects($childrenModels , $request->selectedItem , $request->model_id , $request->model_value , $request->get('add_new_item') , $request->get('select_all'));

        }
        return response()->json([
            'status'=>true ,
            'append_id'=>$request->append_id ,
            'result'=>$result,
            'isFullQuerySelector'=>$request->get('isFullQuerySelector'),
            'addNew'=>$request->get('add_new_item')
        ]);
        
    }
}
