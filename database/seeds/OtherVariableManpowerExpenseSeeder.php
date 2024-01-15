<?php

namespace Database\Seeders;

use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class OtherVariableManpowerExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quickPricingCalculator = QuickPricingCalculator::factory()->create();
        $quickPricingCalculator->otherVariableManpowerExpenses()->create([
            'percentage_of_price'=>15 ,
            'cost_per_unit'=> 145000 ,
            'unit_cost'=>14500,
            'total_cost' => 145000 + 14500 ,
            'company_id'=>31 ,
            'creator_id'=>1 
        ]);
    }
}
