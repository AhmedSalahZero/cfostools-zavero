<?php

namespace Database\Seeders;

use App\Models\DirectManpowerExpense;
use Illuminate\Database\Seeder;

class DirectManpowerExpenseSeeder extends Seeder
{
    
    public function run()
    {
        DirectManpowerExpense::factory()->create();
        
        DirectManpowerExpense::factory()->create();
    }
}
