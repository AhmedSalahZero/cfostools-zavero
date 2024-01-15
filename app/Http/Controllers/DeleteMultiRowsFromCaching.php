<?php

namespace App\Http\Controllers;

use App\Models\CachingCompany;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DeleteMultiRowsFromCaching extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Company $company , Request $request)
    {
         $selectedRows = $request->rows ;
   if($selectedRows && count($selectedRows))
   {
       $totalRemoveItems = 0 ;
    //    $cachesItems = [];
       $caches = CachingCompany::where('company_id' , $company->id )->get();
       $caches->each(function($cache) use($selectedRows) {
           $reCache = false ; 
           $cachesGroup = Cache::get($cache->key_name) ?: [] ;
           foreach($cachesGroup as $index=>$cachesElement){
               $found = in_array($cachesElement['id'] , $selectedRows);
               if($found)
               {
                   $reCache = true ;
                   unset($cachesGroup[$index]);
               }
           }
           if($reCache)
           {
               Cache::forget($cache->key_name);
               Cache::forever($cache->key_name , $cachesGroup );
               
           }
           
           
        //    $cachesItems = array_merge(Cache::get($cache->key_name) ?: [] ,$cachesItem );
       });
       return redirect()->back()->with('success',__('Items Has Been Removed Successfully'));

   }
   return redirect()->back()->with('fail',__('No Selected Rows'));
    }
}
