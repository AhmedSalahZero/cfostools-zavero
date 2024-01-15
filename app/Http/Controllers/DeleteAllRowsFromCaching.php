<?php

namespace App\Http\Controllers;

use App\Models\CachingCompany;
use App\Models\Company;
use App\Services\Caching\CashingService;
use function React\Promise\reduce;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DeleteAllRowsFromCaching extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request , Company $company)
    {
        (new CashingService($company))->removeAll();
        
         CachingCompany::where('company_id' , $company->id)->get()->each(function($companyCache){
            Cache::forget($companyCache->key_name);
            $companyCache->delete();
            
        });

        return redirect()->back()->with('success' , __('All Data Has Been Removed'));
        
    }
    
}
