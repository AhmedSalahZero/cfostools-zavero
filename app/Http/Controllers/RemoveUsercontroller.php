<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteAllSalesGatheringForCompanyJob;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class RemoveUsercontroller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user_id = $request->get('user_id') ;
     
        $user = User::where('id',$user_id)->firstOrFail();
            $user->delete();
        // dispatch(new DeleteAllSalesGatheringForCompanyJob($companyId));

       return response()->json([
           'status'=>true 
       ]);

    }
}
