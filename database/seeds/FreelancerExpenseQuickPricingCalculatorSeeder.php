<?php

namespace Database\Seeders;

use App\Models\DirectManpowerExpense;
use App\Models\FreelancerExpense;
use App\Models\Position;
use App\Models\QuickPricingCalculator;
use Illuminate\Database\Seeder;

class FreelancerExpenseQuickPricingCalculatorSeeder extends Seeder
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
        
        $quickPricingCalculator->freelancerExpenses()->attach([
           
            'freelancer_expense_id'=>FreelancerExpense::inRandomOrder()->first()->id
        ]  , [
            'percentage_of_price'=>5 ,
             'working_days'=>$workingDays = 80 ,
            'cost_per_day' =>$costPerDay = 145000 ,
            'total_cost'=> $costPerDay * $workingDays ,
            'company_id'=>31 ,
            'creator_id'=>1 ,
            'position_id'=>Position::inRandomOrder()->first()->id 
        ]);
            
        }
        
    }
}
