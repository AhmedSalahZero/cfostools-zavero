<?php

namespace Database\Seeders;

use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class ProfitabilityQuickPricingCalculatorSeeder extends Seeder
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
        
        $quickPricingCalculator->profitability()->create( [
            'percentage'=>15,
            'net_profit_after_taxes'=>10,
            'vat'=>8,           
            'company_id'=>31 ,
            'creator_id'=>1 
        ]);
            
        }
        
    }
}
