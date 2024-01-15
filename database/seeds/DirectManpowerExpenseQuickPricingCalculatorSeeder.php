<?php

namespace Database\Seeders;

use App\Models\DirectManpowerExpense;
use App\Models\Position;
use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class DirectManpowerExpenseQuickPricingCalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        for($i = 0 ; $i <= 2   ; $i++)
        {
            $quickPricingCalculator = QuickPricingCalculator::factory()->create();
        
        $quickPricingCalculator->directManpowerExpenses()->attach([
           
            'direct_expense_id'=>DirectManpowerExpense::inRandomOrder()->first()->id
        ]  , [
             'working_days'=>$workingDays = 80 ,
            'cost_per_day' =>$costPerDay = 145000 ,
            'total_cost'=> $costPerDay * $workingDays ,
            'company_id'=>31 ,
            'creator_id'=>1 ,
            'position_id'=>Position::inRandomOrder()->first()->id 
        ]);
            
        }
        
    }
}
