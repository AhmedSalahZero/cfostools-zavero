<?php
namespace App\Models\Traits\Relations ;

use App\Models\Position;
use App\Models\QuickPricingCalculator;

trait OtherDirectOperationExpenseRelation
{
    public function quickPricingCalculators()
    {
        return $this->morphedByMany(QuickPricingCalculator::class ,'otherDirectOperationExpenseAble','other_direct_operation_expense_quick_pricing')
        ->withPivot([
            'percentage_of_price','cost_per_unit','cost_per_unit','unit_cost','total_cost','company_id','creator_id','name'
        ]);
        ;
    }
    // one for Quotation Pricing 
    //   public function quickPricingCalculators()
    // {
    //     return $this->morphedByMany(QuickPricingCalculator::class ,'otherDirectOperationExpenseAble','other_direct_operation_expense_quick_pricing_calculator');
    // }
}
