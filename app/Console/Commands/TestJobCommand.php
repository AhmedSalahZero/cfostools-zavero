<?php

namespace App\Console\Commands;

use App\Models\SalesGathering;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class TestJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Job Operation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // dispatch(function(){
        //     SalesGathering::chunk(5000,function($sales){
        //         foreach($sales as $sale){
        //              $date = $sale->date ;
        //                         $year = Carbon::make($date)->format('Y'); 
        //                 $month = Carbon::make($date)->format('m'); 
        //                 $day = Carbon::make($date)->format('d'); 
        //         $sale->Year = $year ; 
        //         $sale->Month =$month ; 
        //         $sale->Day = $day ;
        //         $sale->save(); 
                
        //         }
               
        //     });
        // });


        //  dispatch(function(){
        //     SalesGathering::chunk(5000,function($sales){
        //         foreach($sales as $sale){
        //              $date = $sale->date ;
        //                         $year = Carbon::make($date)->format('Y'); 
        //         $sale->prev_year = $year - 1;
        //         $sale->save(); 
                
        //         }
               
        //     });
        // });

        
    }
}
