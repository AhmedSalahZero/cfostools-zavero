<?php

namespace App\Jobs;

use App\Models\SalesGathering;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeleteAllSalesGatheringForCompanyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $company_id ;
    public function __construct(int $company_id)
    {
        $this->company_id = $company_id ; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        SalesGathering::where('company_id' , $this->company_id)->chunk(1000 , function($chunks){
            foreach($chunks as $row)
            {
                $row->delete();
            }            
        });
        
    }
}
