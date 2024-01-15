<?php

namespace Database\Seeders;

use App\Models\DirectManpowerExpense;
use App\Models\GeneralExpense;
use App\Models\OtherDirectOperationExpense;
use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class GeneralExpenseQuickPricingCalculatorSeeder extends Seeder
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
        
        $quickPricingCalculator->generalExpenses()->attach([
           
            'general_expense_id'=>GeneralExpense::inRandomOrder()->first()->id
        ]  , [
            'percentage_of_price'=>15 ,
            'cost_per_unit'=> 145000 ,
            'unit_cost'=>14500,
            'total_cost' => 145000 + 14500 ,
            'company_id'=>31 ,
            'creator_id'=>1 ,
            // 'position_id'=>Position::inRandomOrder()->first()->id 
        ]);
            
        }
        
    }
}
