<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;
use App\Models\QuotationPricingCalculator;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\Traits\Relations\Commons\CommonRelations;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait RevenueBusinessLineRelation
{
   use CommonRelations ;
   public function QuotationPricingCalculators()
   {
       return $this->morphedByMany(QuotationPricingCalculator::class , 'serviceable');
   }
   
   public function serviceCategories():HasMany
   {
       return $this->hasMany(ServiceCategory::class , 'revenue_business_line_id','id');
   }
   public function serviceItems()
   {
       return $this->hasManyThrough(ServiceItem::class , ServiceCategory::class , 'revenue_business_line_id','service_category_id' );
   }
   public function quickPricingCalculators():HasMany
   {
       return $this->hasMany(QuickPricingCalculator::class , 'revenue_business_line_id','id');
   }
   

}