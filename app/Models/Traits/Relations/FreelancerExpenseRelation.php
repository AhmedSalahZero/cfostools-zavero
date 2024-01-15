<?php
namespace App\Models\Traits\Relations ;

use App\Models\Position;
use App\Models\QuickPricingCalculator;

trait FreelancerExpenseRelation
{
    
    public function quickPricingCalculators()
    {
        return $this->morphedByMany(QuickPricingCalculator::class ,'freelancerExpenseAble','freelancer_expense_quick_pricing_calculator');
    }
    
     public function freelancerPositions()
    {
        return $this->morphedByMany(Position::class ,'freelancerExpenseAble','freelancer_expense_quick_pricing_calculator','position_id');
    }
    
}