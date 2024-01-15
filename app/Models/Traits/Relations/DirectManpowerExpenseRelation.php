<?php
namespace App\Models\Traits\Relations ;

use App\Models\Position;
use App\Models\QuickPricingCalculator;

trait DirectManpowerExpenseRelation
{
    public function quickPricingCalculators()
    {
        return $this->morphedByMany(QuickPricingCalculator::class ,'directManpowerExpenseAble','direct_manpower_expense_quick_pricing_calculator');
    }
    
     public function directManpowerExpensePositions()
    {
        return $this->morphedByMany(Position::class ,'directManpowerExpenseAble','direct_manpower_expense_quick_pricing_calculator','directManpowerExpenseAble_id','position_id');
    }
    
}