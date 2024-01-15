<?php

namespace Database\Seeders;

use App\Models\DirectManpowerExpense;
use App\Models\OtherDirectOperationExpense;
use App\Models\Position;
use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class OtherDirectOperationExpenseQuickPricingCalculatorSeeder extends Seeder
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
        
        $quickPricingCalculator->otherDirectOperationExpenses()->attach([
           
            'other_direct_operation_expense_id'=>OtherDirectOperationExpense::inRandomOrder()->first()->id
        ]  , [
            'percentage_of_price'=>15 ,
            'cost_per_unit'=> 145000 ,
            'unit_cost'=>14500,
            'total_cost' => 145000 + 14500 ,
            'company_id'=>31 ,
            'creator_id'=>1 ,
        ]);
            
        }
        
    }
}
