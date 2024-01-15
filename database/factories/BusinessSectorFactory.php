<?php

namespace Database\Factories;

use App\Models\Repositories\BusinessSectorRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessSectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'name'=>$this->faker->name ,
            'company_id'=>31,
            'creator_id'=>Auth()->user()->id
        ];
    }
}
