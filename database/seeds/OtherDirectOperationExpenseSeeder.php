<?php

namespace Database\Seeders;

use App\Models\OtherDirectOperationExpense;
use Illuminate\Database\Seeder;

class OtherDirectOperationExpenseSeeder extends Seeder
{
    
    public function run()
    {
        OtherDirectOperationExpense::factory()->count(2)->create();
    }
}
