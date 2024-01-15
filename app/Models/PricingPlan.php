<?php

namespace App\Models;

use App\Models\QuickPricingCalculator;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
	protected $guarded = [
		'id'
	];
	
	public function getId()
	{
		return $this->id ; 
	}
    
	public function getName()
	{
		return $this->name ;
	}
	public function quickPricingCalculators()
	{
		return $this->hasMany(QuickPricingCalculator::class , 'pricing_plan_id','id');
	}
	public static function allFormattedForSelect($companyId)
    {
        $pricingPlans = PricingPlan::where('company_id',$companyId)->get();
        return formatOptionsForSelect($pricingPlans , 'getId' , 'getName');
    }
       public static function oneFormattedForSelect($model)
    {
        $pricingPlans = PricingPlan::where('id',$model->pricing_plan_id)->get();
        return formatOptionsForSelect($pricingPlans , 'getId' , 'getName');
    }
	
	
}
