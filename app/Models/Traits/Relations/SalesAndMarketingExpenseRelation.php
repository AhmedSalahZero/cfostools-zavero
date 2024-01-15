<?php
namespace App\Models\Traits\Relations ;

use App\Models\Position;
use App\Models\QuickPricingCalculator;

trait SalesAndMarketingExpenseRelation
{
    
    public function quickPricingCalculators()
    {
        return $this->morphedByMany(QuickPricingCalculator::class ,'salesAndMarketingExpenseAble','sales_and_marketing_quick_pricing_calculator');
    }
    
}