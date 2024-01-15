<?php
namespace App\Models\Traits\Relations ;

use App\Models\Currency;
use App\Models\DirectManpowerExpense;
use App\Models\FreelancerExpense;
use App\Models\GeneralExpense;
use App\Models\OtherDirectOperationExpense;
use App\Models\OtherVariableManpowerExpense;
use App\Models\Position;
use App\Models\PricingPlan;
use App\Models\Profitability;
use App\Models\RevenueBusinessLine;
use App\Models\SalesAndMarketingExpense;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\ServiceNature;
use App\Models\SharingLink;
use App\Models\Traits\Relations\Commons\CommonRelations;
use App\Models\Traits\Relations\Commons\StateRelations;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait QuickPricingCalculatorRelation
{
   use CommonRelations , StateRelations ;
   
   public function revenueBusinessLine():BelongsTo
   {
       return $this->belongsTo(RevenueBusinessLine::class , 'revenue_business_line_id');
   }
   public function serviceCategory():BelongsTo
   {
       return $this->belongsTo(ServiceCategory::class , 'service_category_id','id');
   }
   public function serviceItem():BelongsTo
   {
       return $this->belongsTo(ServiceItem::class ,'service_item_id','id');
   }
   public function serviceNature():BelongsTo
   {
       return $this->belongsTo(ServiceNature::class ,'service_nature_id','id');
   }
   public function currency():BelongsTo
   {
       return $this->belongsTo(Currency::class , 'currency_id','id');
   }
   public function otherVariableManpowerExpenses():morphMany
   {
       return $this->morphMany(OtherVariableManpowerExpense::class , 'otherVariableManpowerExpenseAble');
   }

   public function directManpowerExpenses():morphToMany
   {
       return $this->morphToMany(DirectManpowerExpense::class ,'directManpowerExpenseAble','direct_manpower_expense_quick_pricing_calculator')
       ->withPivot([
       'position_id','working_days','cost_per_day','total_cost','company_id','creator_id'
       ])
       ;
   }

    public function salesAndMarketingExpenses():morphToMany
   {
       return $this->morphToMany(SalesAndMarketingExpense::class ,'salesAndMarketingExpenseAble','sales_and_marketing_quick_pricing_calculator')
       ->withPivot([
           'percentage_of_price','cost_per_unit','unit_cost','total_cost','company_id','creator_id','name'
       ]);
   }
   

   public function otherDirectOperationExpenses():morphToMany
   {
       return $this->morphToMany(OtherDirectOperationExpense::class ,'otherDirectOperationExpenseAble','other_direct_operation_expense_quick_pricing')
       ->withPivot([
		'name',
            'percentage_of_price','cost_per_unit','cost_per_unit','unit_cost','total_cost','company_id','creator_id'
        ])
       ;
   }

    public function generalExpenses():morphToMany
   {
       return $this->morphToMany(GeneralExpense::class ,'generalExpenseAble','general_expense_quick_pricing_calculator')
       ->withPivot([
		'name',
           'percentage_of_price','cost_per_unit','unit_cost','total_cost','company_id','creator_id'
       ]);
   }
   
    public function freelancerExpensePositions():morphToMany
   {
       return $this->morphToMany(Position::class ,'freelancerExpenseAble','freelancer_expense_quick_pricing_calculator','freelancerExpenseAble_id','position_id');
   }
   
    public function directManpowerExpensePositions():morphToMany
   {
       return $this->morphToMany(Position::class ,'directManpowerExpenseAble','direct_manpower_expense_quick_pricing_calculator','directManpowerExpenseAble_id','position_id');
   }
   
      public function freelancerExpenses():morphToMany
   {
       return $this->morphToMany(FreelancerExpense::class ,'freelancerExpenseAble','freelancer_expense_quick_pricing_calculator')
       ->withPivot([
           'percentage_of_price','position_id','working_days','cost_per_day','total_cost','company_id','creator_id'
       ]);
   }
   public function profitability()
   {
       return $this->morphOne(Profitability::class , 'profitabilityAble');
   }

   public function sharingLinks()
   {
       return $this->morphMany(SharingLink::class , 'shareable');
   }
 
   public function pricingPlan()
   {
	return $this->belongsTo(PricingPlan::class , 'pricing_plan_id','id');
   }
}
