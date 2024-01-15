<?php

namespace Database\Seeders;

use App\Models\FreelancerExpense;
use Illuminate\Database\Seeder;

class FreelancerExpenseSeeder extends Seeder
{
    
    public function run()
    {
        FreelancerExpense::factory()->create();
        
        FreelancerExpense::factory()->create();
    }
}
