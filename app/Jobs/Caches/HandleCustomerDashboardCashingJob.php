<?php

namespace App\Jobs\Caches;

use App\Models\Company;
use App\Services\Caching\CashingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleCustomerDashboardCashingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;

      public $timeout = 500000*60;
    public $failOnTimeout = true;
    
    private Company $company ; 
    
    public function __construct(Company $company)
    {
        $this->company = $company ;
    }
   
    public function handle()
    {
                $cachingService = new CashingService($this->company);
                  $cachingService->refreshCustomerDashboardCashing();
    }



    
}
