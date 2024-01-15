<?php

namespace Database\Seeders;

use App\Models\QuotationPricingCalculator;
use Illuminate\Database\Seeder;

class QuotationPricingCalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuotationPricingCalculator::factory()->count(20)->create([
            'company_id'=>31,
            'creator_id'=>1 
        ]);
    }
}
