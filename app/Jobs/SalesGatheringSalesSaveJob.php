<?php

namespace App\Jobs;

// use App\Models\SalesGathering;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class SalesGatheringSalesSaveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */


    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('sales_gathering')->where('company_id',25)
            ->orderBy('id')
            ->selectRaw('DATE_FORMAT(date,"%d-%m-%Y") as date,net_sales_value,company_id,id')
            ->chunk(500, function ($sales) {
                $sales = collect($sales);
                $sales = $sales->toArray();
                // $this->saveData($sales);
                $first_key_of_array = array_key_first($sales);

                // $month = date("t-m-Y",strtotime($sales[$first_key_of_array]->date));
                // $first_key_of_array = array_key_first($sales_gatherings);
                $dt = Carbon::parse($sales[$first_key_of_array]->date);
                $month = $dt->endOfMonth()->format('d-m-Y');
                $data = [];

                foreach ($sales as $key => $row) {

                    // $dt = Carbon::parse($row['date']);
                    // $current_month = date("t-m-Y",strtotime($row->date));

                    $dt = Carbon::parse($row->date);
                    $current_month = $dt->endOfMonth()->format('d-m-Y');

                    if ($current_month == $month) {
                        $zones_per_month[$current_month][] = $row->net_sales_value;
                    } else {
                        $month = $current_month;
                        $zones_per_month[$current_month][] = $row->net_sales_value;
                    }
                    // $formated_date = date('Y-m-d',strtotime($current_month));
                    //  Carbon::parse($current_month)->format('Y-m-d');
                    $data[$month] = array_sum($zones_per_month[$month]);

                }

                foreach ($data as $date => $value) {
                    $store = [
                        'date' => date('Y-m-d',strtotime($date)),
                        'company_id' => 25,
                        'net_sales_value' => $value,
                    ];

                    DB::table('sales_gathering_net_sales')->insert($store);
                }

        });


    }

}
