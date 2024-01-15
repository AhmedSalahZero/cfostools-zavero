<?php

namespace App\Jobs;

use App\Models\CachingCompany;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class RemoveCachingCompaniesDataForUploadExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $companyId ; 
    
    public function __construct(int $companyId)
    {
        $this->companyId = $companyId ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         CachingCompany::where('company_id' , $this->companyId)->get()->each(function($companyCache){
            Cache::forget($companyCache->key_name);
            $companyCache->delete();
            $key = getTotalUploadForUploadExcelCacheKey($this->companyId , $companyCache->job_id) ;
            Cache::forget($key);
        });
        
    }
}
