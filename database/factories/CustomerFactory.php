<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Repositories\BusinessSectorRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customerTypes = Customer::types ;
        
        return [
            'name'=>$this->faker->name ,
            'type'=>$customerTypes[$this->faker->numberBetween(0 , count($customerTypes) - 1 )],
            'company_id'=>31,
            'creator_id'=>Auth()->user()->id,
            'business_sector_id'=>App(BusinessSectorRepository::class)->Random()->first()->id
        ];
    }
}
