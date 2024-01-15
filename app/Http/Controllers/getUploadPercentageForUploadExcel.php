<?php

namespace App\Http\Controllers;

use App\Models\CachingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class getUploadPercentageForUploadExcel extends Controller
{
    public function __invoke(Request $request , $companyId)
    {
        $totalCachedItems = 0 ;
        $currentPercentage = 0 ;
        $jobId = 0 ; 
        CachingCompany::where('company_id' , $companyId)->get()->each(function($cachingCompany) use (&$totalCachedItems , &$jobId){
            $caches = Cache::get($cachingCompany->key_name) ?: [];
            foreach($caches as $cacheItem)
            {
                ++$totalCachedItems ; 
            }
            $jobId = $cachingCompany->job_id ?? 0 ;
        });
        
        $currentUploadedNumber = cache::get(getTotalUploadForUploadExcelCacheKey($companyId , $jobId)) ?: 0 ;
        $currentPercentage =  $totalCachedItems ? $currentUploadedNumber / $totalCachedItems * 100 : 0 ;
        $cacheHasReloadKey = Cache::has(getCanReloadUploadPageCachingForUploadExcelForCompany($companyId)) ;
        
        if($cacheHasReloadKey)
        {
            cache::forget(getCanReloadUploadPageCachingForUploadExcelForCompany($companyId));
        }
        
        return response()->json([
            'totalCacheNo'=>$totalCachedItems , 
            'totalPercentage'=>$currentPercentage,
            // 'job'=>$jobId,
            'company_id'=>$companyId,
            'currentUploaded'=>$currentUploadedNumber,
            'reloadPage'=>$cacheHasReloadKey || ($currentPercentage == 0 && CachingCompany::where('company_id' , $companyId)->count() == 0 )
        ]);
    }
}
