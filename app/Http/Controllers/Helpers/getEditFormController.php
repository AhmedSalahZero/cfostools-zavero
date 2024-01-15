<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class getEditFormController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $formPath = $request->get('formPath');
        $modelName = $request->get('modelName');
        $modelFullPath = (getModelNamespace().$modelName) ;
        // getCrudFormName
        return view($modelFullPath::getCrudFormName() , $modelFullPath::getViewVars())->render();
    }
}
