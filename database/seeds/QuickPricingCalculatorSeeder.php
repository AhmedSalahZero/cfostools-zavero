<?php

namespace Database\Seeders;

use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class QuickPricingCalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuickPricingCalculator::factory()->count(20)->create([
            'company_id'=>31,
            'creator_id'=>1 
        ]);
    }
}
