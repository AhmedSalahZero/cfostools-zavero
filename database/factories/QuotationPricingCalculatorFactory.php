<?php

namespace Database\Factories;

use App\Models\Repositories\CurrencyRepository;
use App\Models\Repositories\RevenueBusinessLineRepository;
use App\Models\Repositories\ServiceCategoryRepository;
use App\Models\Repositories\ServiceItemRepository;
use App\Models\Repositories\StateRepository;
use App\Models\ServiceNature;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationPricingCalculatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $state = App(StateRepository::class)->Random()->first() ;
        return [
            'name'=>$this->faker->name,
            // 'revenue_business_line_id'=>App(RevenueBusinessLineRepository::class)->Random()->first()->id,
            // 'service_category_id'=>App(ServiceCategoryRepository::class)->Random()->first()->id  ,
            // 'service_item_id'=>App(ServiceItemRepository::class)->Random()->first()->id,
            // 'service_nature_id'=>ServiceNature::inRandomOrder()->first()->id ,
            // 'delivery_days'=>15 ,

            'state_id'=>$state->id ,
            'country_id'=>$state->country->id  ,
            'company_id'=>31 , 
            'creator_id'=>1 ,
            'date'=>$this->faker->date,
            'currency_id'=>App(CurrencyRepository::class)->Random()->first()->id ,
            'total_recommend_price_without_vat'=>$this->faker->numberBetween(10,8000),
            'total_recommend_price_with_vat'=>$this->faker->numberBetween(10,8000),
            'price_per_day_without_vat'=>$this->faker->numberBetween(10,8000),
            'price_per_day_with_vat'=>$this->faker->numberBetween(10,8000),
            'total_net_profit_after_taxes'=>$this->faker->numberBetween(10,8000),
            'net_profit_after_taxes_per_day'=>$this->faker->numberBetween(10,8000),
            'total_sensitive_price_without_vat'=>$this->faker->numberBetween(10,8000),
            'total_sensitive_price_with_vat'=>$this->faker->numberBetween(10,8000),
            'sensitive_price_per_day_without_vat'=>$this->faker->numberBetween(10,8000),
            'sensitive_price_per_day_with_vat'=>$this->faker->numberBetween(10,8000),
            'sensitive_total_net_profit_after_taxes'=>$this->faker->numberBetween(10,8000),
            'sensitive_net_profit_after_taxes_per_day'=>$this->faker->numberBetween(10,8000),
            'sensitive_net_profit_after_taxes_percentage'=>$this->faker->numberBetween(10,8000),
        ];
    }
}
