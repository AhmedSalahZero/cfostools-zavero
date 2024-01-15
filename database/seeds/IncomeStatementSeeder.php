<?php

namespace Database\Seeders;

use App\Models\IncomeStatement;
use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class IncomeStatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $incomeStatement = IncomeStatement::factory()->create([
            'company_id'=>31,
            'creator_id'=>1 ,
            'duration'=>36,
            'duration_type'=>'monthly',
            'start_from'=>'01-01-2021',
            'name'=>'Income Statement 1'
        ]);

        $incomeStatement->storeMainItems(Request());

         $incomeStatement = IncomeStatement::factory()->create([
            'company_id'=>31,
            'creator_id'=>1 ,
            'duration'=>60,
            'duration_type'=>'monthly',
            'start_from'=>'2021-03-01',
            'name'=>'Income Statement 2'
        ]);
        $incomeStatement->storeMainItems(Request());
        
        $incomeStatement = IncomeStatement::factory()->create([
            'company_id'=>31,
            'creator_id'=>1 ,
            'duration'=>60,
            'duration_type'=>'annually',
            'start_from'=>'2021-01-01',
            'name'=>'Income Statement 3'
        ]);
        $incomeStatement->storeMainItems(Request());
        
        $incomeStatement = IncomeStatement::factory()->create([
            'company_id'=>31,
            'creator_id'=>1 ,
            'duration'=>60,
            'duration_type'=>'annually',
            'start_from'=>'2021-07-01',
            'name'=>'Income Statement 4'
        ]);
        $incomeStatement->storeMainItems(Request());
        
        
    }
}
