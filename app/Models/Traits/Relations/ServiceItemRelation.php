<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuotationPricingCalculator;
use App\Models\ServiceCategory;
use App\Models\Traits\Relations\Commons\CommonRelations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ServiceItemRelation
{
    use CommonRelations ;
        public function QuotationPricingCalculators()
   {
       return $this->morphedByMany(QuotationPricingCalculator::class , 'serviceable');
   }
   
    public function serviceCategory():BelongsTo 
    {
        return $this->belongsTo(ServiceCategory::class ,'service_category_id' , 'id');
    }
    
    public function quickPricingCalculator():HasMany
    {
        return $this->hasMany(QuickPricingCalculator::class ,'service_item_id','id');
    }
    
    
    
}