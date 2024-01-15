<?php

namespace App\Models\Traits\Relations;

use App\Models\Acquisition;
use App\Models\DepartmentExpense;
use App\Models\FFE;
use App\Models\FFEItem;
use App\Models\FFES;
use App\Models\FFESItem;
use App\Models\ManufacturingRevenueStream;
use App\Models\Product;
use App\Models\PropertyAcquisition;
use App\Models\PropertyAcquisitionBreakDown;
use App\Models\TradingRevenueStream;
use App\Models\Traits\Relations\Commons\CommonRelations;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait FinancialPlanRelation
{
	use CommonRelations;
	public function manufacturingRevenueStreams()
	{
		return $this->hasMany(ManufacturingRevenueStream::class, 'financial_plan_id', 'id');
	}
	public function tradingRevenueStreams()
	{
		return $this->hasMany(TradingRevenueStream::class, 'financial_plan_id', 'id');
	}
	public function ffesItems()
	{
		return $this->hasMany(FFESItem::class,'financial_plan_id','id');
	}
	public function ffes()
	{
		return $this->hasMany(FFES::class , 'financial_plan_id','id');
	}
	public function ffesItemsFor(int $ffeId , string $sectionName,string $modelName)
	{
		return $this->ffesItems()->where('ffe_id',$ffeId)->where('section_name',$sectionName)
		->where('model_name',$modelName)
		;
	}
	public function departmentExpenses()
	{
		return $this->hasMany(DepartmentExpense::class,'financial_plan_id','id');
	}
	public function ffeItems()
	{
		return $this->hasMany(FFESItem::class,'financial_plan_id','id');
	}
	public function manufacturingProducts()
	{
		return $this->belongsToMany(Product::class,'manufacturing_revenue_streams','financial_plan_id','product_id')
		->withPivot([
			'selling_uom',
			'production_uom',
			'product_to_selling_converter'
		]);
	}
	public function productCapacities(){
		return $this->belongsToMany(Product::class,'product_production_capacity','financial_plan_id','product_id')->withPivot([
			'production_lines_count',
			'max_production_per_hour',
			'production_capacity_per_hour',
			'net_working_hours_type',
			'net_working_hours_per_days'
		]);
	}

	
	public function acquisition():HasOne
	{
		return $this->hasOne(Acquisition::class ,'financial_plan_id','id');
	}
	public function propertyAcquisition():HasOne
	{
		return $this->hasOne(PropertyAcquisition::class ,'financial_plan_id','id');
	}
	public function propertyAcquisitionBreakDown()
	{
		return $this->hasMany(PropertyAcquisitionBreakDown::class,'financial_plan_id','id');
	}
	public function propertyAcquisitionBreakDownFor(string $sectionName,string $modelName)
	{
		return $this->PropertyAcquisitionBreakDown()->where('section_name',$sectionName)
		->where('model_name',$modelName)
		;
	}
	
	
}
