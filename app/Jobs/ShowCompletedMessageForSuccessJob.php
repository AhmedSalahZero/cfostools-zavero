<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class ShowCompletedMessageForSuccessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $jobId  , $companyId ; 
    
    public function __construct($companyId  , $jobId)
    {
        $this->companyId = $companyId ; 
        $this->jobId = $jobId ; 
    }

    public function handle()
    {
        Cache::forever(\getShowCompletedTestMessageCacheKey($this->companyId)  , 1  );
    }
}
