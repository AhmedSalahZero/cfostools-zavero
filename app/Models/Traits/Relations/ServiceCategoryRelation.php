<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;
use App\Models\QuotationPricingCalculator;
use App\Models\RevenueBusinessLine;
use App\Models\ServiceItem;
use App\Models\Traits\Relations\Commons\CommonRelations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ServiceCategoryRelation
{
    use CommonRelations  ;

    public function QuotationPricingCalculators()
   {
       return $this->morphedByMany(QuotationPricingCalculator::class , 'serviceable');
   }
   
    public function RevenueBusinessLine():BelongsTo 
    {
        return $this->belongsTo(RevenueBusinessLine::class ,'revenue_business_line_id' , 'id');
    }
    public function serviceItems():HasMany
    {
        return $this->hasMany(ServiceItem::class ,'service_category_id','id');
    }
    public function quickPricingCalculator():HasMany
    {
        return $this->hasMany(QuickPricingCalculator::class ,'service_category_id','id');
    }
    
}