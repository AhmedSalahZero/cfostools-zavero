<?php

namespace Database\Seeders;

use App\Models\SalesAndMarketingExpense;
use Illuminate\Database\Seeder;

class SalesAndMarketingExpenseSeeder extends Seeder
{
    
    public function run()
    {
        SalesAndMarketingExpense::factory()->create();
        
        SalesAndMarketingExpense::factory()->create();
    }
}
