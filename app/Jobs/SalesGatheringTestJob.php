<?php

namespace App\Jobs;

use App\Imports\CustomerInvoiceTestImport;
use App\Models\CachingCompany;
use App\Models\CustomersInvoice;
use App\Models\Deduction;
use App\Models\SalesGathering;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SalesGatheringTestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels ;
    

    public $timeout = 500000*60;
    public $failOnTimeout = true;
    

    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $company_id;

    public function __construct($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */


    public function handle()
    {
        CachingCompany::where('company_id' , $this->company_id )->get()->each(function($cachingCompany){
            $cacheGroup = Cache::get($cachingCompany->key_name) ?: [];
            $chunks = \array_chunk($cacheGroup ,1000);
            foreach($chunks as $chunk)
            {
                DB::table('sales_gathering')->insert($chunk);
                $key = getTotalUploadCacheKey($this->company_id , $cachingCompany->job_id) ;
                $oldTotalUploaded = cache::get($key) ?:0 ;
                cache::forever( $key , $oldTotalUploaded + count($chunk) );
            }
                
            
          
        });
        
    }

    
    // public function handle()
    // {
    //     $invoices_data = DB::table('sales_gathering_tests')->where('company_id', $this->company_id)->orderBy('id')->get();
    //     $invoices_data = ($invoices_data->chunk(1000));
    //     foreach ($invoices_data as $invoices) {
    //         foreach ($invoices as $invoice) {


    //             $invoice = collect($invoice);
    //             $invoice_to_be_inserted = $invoice->toArray();
    //             unset($invoice_to_be_inserted['id']);

    //             $validator = Validator::make($invoice_to_be_inserted, []);

    //             if ($validator->fails()) {
    //                 DB::table('sales_gathering_tests')
    //                     ->where('id', $invoice['id'])
    //                     ->update(['validation' => $validator->errors()->all()]);
    //             } else {
                
    //                 unset($invoice_to_be_inserted["validation"]);
                
    //                 DB::table('sales_gathering')->insert($invoice_to_be_inserted);
                
    //                 DB::delete('delete from sales_gathering_tests where id = ?', [$invoice['id']]);
                
    //             }
    //         }
    //     }
        
    // }
}
