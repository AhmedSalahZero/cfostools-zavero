<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait CurrencyRelation
{
    public function quickPricingCalculators():HasMany
    {
        return $this->hasMany(QuickPricingCalculator::class ,'currency_id','id');
    }
    
}