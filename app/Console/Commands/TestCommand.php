<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\SalesForecast;
use App\Models\SalesGathering;
use App\ReadyFunctions\IntervalSummationOperations;
use App\Services\Caching\CashingService;
use App\Services\Caching\CustomerDashboardCashing;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Code Command';

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
		$items = [
			'01-01-2025'=>0 ,
			'01-02-2025'=>1 ,
			'01-03-2025'=>2 ,
			'01-04-2025'=>3 ,
			'01-05-2025'=>4 ,
			'01-06-2025'=>5 ,
			'01-07-2025'=>6 ,
			'01-08-2025'=>7 ,
			'01-09-2025'=>8 ,
			'01-10-2025'=>9 ,
			'01-11-2025'=>10 ,
			'01-12-2025'=>11 ,
			'01-01-2026'=>12 ,
			'01-02-2026'=>13 ,
			'01-03-2026'=>14 ,
			'01-04-2026'=>15 ,
			'01-05-2026'=>16 ,
			'01-06-2026'=>17 ,
			'01-07-2026'=>18 ,
			
		];
		$intervalOperationService = new IntervalSummationOperations();
		$intervalOperationService->__calculate($items ,'annually','january');
        
    }

}
