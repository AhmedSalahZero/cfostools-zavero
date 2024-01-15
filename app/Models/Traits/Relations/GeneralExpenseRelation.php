<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;

trait GeneralExpenseRelation
{
    
    public function quickPricingCalculators()
    {
        return $this->morphedByMany(QuickPricingCalculator::class ,'GeneralExpenseAble','general_expense_quick_pricing_calculator');
    }
    
}