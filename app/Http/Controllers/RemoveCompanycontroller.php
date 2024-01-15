<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteAllSalesGatheringForCompanyJob;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class RemoveCompanycontroller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $company_id = $request->get('company_id') ;
     
        $company = Company::where('id',$company_id)->firstOrFail();
            $company->delete();
        dispatch(new DeleteAllSalesGatheringForCompanyJob($company_id));

       return response()->json([
           'status'=>true 
       ]);

    }
}
