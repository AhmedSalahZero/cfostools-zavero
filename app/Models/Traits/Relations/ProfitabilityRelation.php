<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;

trait ProfitabilityRelation
{
    
    public function quickPricingCalculators()
    {
        return $this->morphTo(QuickPricingCalculator::class ,'profitabilityAble');
    }

}