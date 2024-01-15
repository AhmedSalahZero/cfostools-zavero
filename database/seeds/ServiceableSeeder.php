<?php

namespace Database\Seeders;

use App\Models\QuotationPricingCalculator;
use App\Models\Repositories\RevenueBusinessLineRepository;
use App\Models\Repositories\ServiceCategoryRepository;
use App\Models\Repositories\ServiceItemRepository;
use App\Models\Repositories\ServiceNatureRepository;
use App\Models\RevenueBusinessLine;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use Illuminate\Database\Seeder;

class ServiceableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuotationPricingCalculator::factory()->count(2)->create()->each(function(QuotationPricingCalculator $quotationPricingCalculator){
            $revenueBusinessLineId = App(RevenueBusinessLineRepository::class)->Random()->first()->id ;
            $quotationPricingCalculator->revenueBusinessLines()->attach($revenueBusinessLineId , [
                'service_category_id'=>App(ServiceCategoryRepository::class)->Random()->first()->id ,
                'service_item_id'=>App(ServiceItemRepository::class)->Random()->first()->id  , 
                'service_nature_id'=>App(ServiceNatureRepository::class)->Random()->first()->id ,
                'delivery_days'=>20 ,
                'created_at'=>now()
            ]);
        });
        
    }
}
