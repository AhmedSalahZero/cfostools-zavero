<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;
use App\Models\QuotationPricingCalculator;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ServiceNatureRelation
{
    public function QuotationPricingCalculators()
   {
       return $this->morphedByMany(QuotationPricingCalculator::class , 'serviceable');
   }
   
    public function quickPricingCalculator():HasMany
    {
        return $this->hasMany(QuickPricingCalculator::class ,'service_nature_id','id');
    }
    
}