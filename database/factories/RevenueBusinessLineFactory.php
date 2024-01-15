<?php

namespace Database\Factories;

use App\Models\Repositories\CompanyRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class RevenueBusinessLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = App(CompanyRepository::class)->Random()->first();
        return [
            'name'=>$this->faker->name ,
            'company_id'=> $company->id  
        ];
    }
}
