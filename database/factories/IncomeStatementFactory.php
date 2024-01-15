<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeStatementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $state = App(StateRepository::class)->Random()->first() ;
        return [
            'name'=>$this->faker->name ,
            'duration'=>[36 , 60][$this->faker->numberBetween(0,1)],
            'duration_type'=>['monthly','annually'][$this->faker->numberBetween(0,1)],
            'start_from'=>$this->faker->date,
            // 'service_item_id'=>App(ServiceItemRepository::class)->Random()->first()->id,
            'company_id'=>31 , 
            'creator_id'=>1 ,
            // 'sensitive_net_profit_after_taxes_percentage'=>$this->faker->numberBetween(10,8000),
        ];
    }
}
