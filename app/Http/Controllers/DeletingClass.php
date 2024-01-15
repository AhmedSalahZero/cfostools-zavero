<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DeletingClass
{
    public function truncate(Company $company,$model)
    {

        $model_name = 'App\\Models\\' . $model;
        $model_obj = new $model_name;
        $all_model_data  = $model_obj->company()->get();
        if (count($all_model_data)>0) {
            $all_model_data->each->delete();
        }
        toastr()->success('All Rows Were Deleted  Successfully');
        return redirect()->back();
    }
    public function multipleRowsDeleting(Request $request, Company $company,$model)
    {

        if ($request->rows === null || count($request->rows) == 0) {
            toastr()->error('No Rows Were Selected');
        return redirect()->back();
        }
        $model_name = 'App\\Models\\' . $model;
        $model_obj = new $model_name;
        $all_model_data  = $model_obj->company()->whereIn('id',$request->rows)->get();
 
        if (count($all_model_data)>0) {
            $all_model_data->each->delete();
        }
        toastr()->success('Deleted Selected Rows Successfully');
        return redirect()->back();
    }

}
