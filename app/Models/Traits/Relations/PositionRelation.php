<?php
namespace App\Models\Traits\Relations ;

use App\Models\QuickPricingCalculator;

trait PositionRelation
{
    
     public function freelancerExpenseAble()
    {
        // position_id [foreign key on the pivot table to identify (this model) record]
        return $this->morphedByMany(QuickPricingCalculator::class ,'freelancerExpenseAble','freelancer_expense_quick_pricing_calculator','position_id');
    }
    public function directManpowerExpenseAble()
    {
        // position_id [foreign key on the pivot table to identify (this model) record]
        return $this->morphedByMany(QuickPricingCalculator::class ,'directManpowerExpenseAble','direct_manpower_expense_quick_pricing_calculator','position_id');
    }
    
           
}
