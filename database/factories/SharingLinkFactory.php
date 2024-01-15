<?php

namespace Database\Factories;

use App\Models\QuickPricingCalculator;
use Illuminate\Database\Eloquent\Factories\Factory;

class SharingLinkFactory extends Factory
{
    
    public function definition()
    {
        
        return [
            'user_name'=>$this->faker->name ,
            'link'=>$this->faker->url,
            'sharable_id'=>QuickPricingCalculator::inRandomOrder()->first()->id ,
            'sharable_type'=>'App\Models\QuickPricingCalculator',
            'is_active'=>$this->faker->boolean(),
            'creator_id'=>Auth()->user()->id 
        ];
    }
}
