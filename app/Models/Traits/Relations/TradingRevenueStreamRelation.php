<?php

namespace App\Models\Traits\Relations;

use App\Models\Category;
use App\Models\FinancialPlan;
use App\Models\Product;

trait TradingRevenueStreamRelation
{
	public function financialPlan()
	{
		return $this->belongsTo(FinancialPlan::class, 'financial_plan_id');
	}
	public function category()
	{
		return $this->belongsTo(Category::class , 'category_id','id');
	}
	public function product()
	{
		return $this->belongsTo(Product::class , 'product_id','id');
	}
}
