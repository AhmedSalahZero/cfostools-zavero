<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteSingleRecordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $record = (getModelNamespace().$request->get('modelName'))::find($request->get('recordId'));
        if($record)
        {
            $record->delete();
        }
        return response()->json([
            'status'=>true ,
            'tableId'=>$request->get('tableId')
        ]);
    }
}
