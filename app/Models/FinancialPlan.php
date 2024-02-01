<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Models\ProductionUnitOfMeasurement;
use App\Models\Repositories\CurrencyRepository;
use App\Models\SellingUnitOfMeasurement;
use App\Models\Traits\Accessors\FinancialPlanAccessor;
use App\Models\Traits\Mutators\FinancialPlanMutator;
use App\Models\Traits\Relations\FinancialPlanRelation;
use App\Models\Traits\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Model;

class  FinancialPlan extends Model implements IBaseModel,  IExportable
{
	use  FinancialPlanAccessor, FinancialPlanMutator, FinancialPlanRelation, CompanyScope;
	
	protected $guarded = [
		'id'
	];
	
	protected $casts = [
		'study_dates'=>'array',
		'revenue_streams'=>'array',
		'add_allocations'=>'array'
	];


	public function getRouteKeyName()
	{
		return 'financial_plans.id';
	}
	public static function exportViewName(): string
	{
		return __('Financial Plans');
	}
	public static function getFileName(): string
	{
		return __('Financial Plans');
	}

	protected static function booted()
	{
		// static::aHGlobalScope(new StateCountryScope);
	}

	public static function getCrudViewName(): string
	{
		return 'admin.financial_plans.create';
	}

	public static function getViewVars(): array
	{
		$currentCompanyId =  getCurrentCompanyId();

		return [
			'getDataRoute' => route('admin.get.financial.plans', ['company' => $currentCompanyId]),
			'modelName' => 'FinancialPlan',
			'exportRoute' => route('admin.export.financial.plan', $currentCompanyId),
			'createRoute' => route('admin.create.financial.plan', $currentCompanyId),
			'storeRoute' => route('admin.store.financial.plan', $currentCompanyId),
			'hasChildRows' => false,
			'pageTitle' => self::getPageTitle(),
			'redirectAfterSubmitRoute' => route('admin.view.financial.plans', $currentCompanyId),
			'type' => 'create',
			'company' => Company::find($currentCompanyId),
			'redirectAfterSubmitRoute' => route('admin.view.financial.plans', ['company' => getCurrentCompanyId()]),
			'currencies' => App(CurrencyRepository::class)->allFormattedForSelect(),
			'tradingCategories'=>Category::where('model_type','TradingRevenueStream')->where('company_id',$currentCompanyId)->get()->formatForSelect2(true ,'getId','getName'),
			'manufacturingCategories'=>Category::where('model_type','ManufacturingRevenueStream')->where('company_id',$currentCompanyId)->get()->formatForSelect2(true ,'getId','getName'),
			
			
			// 'tradingCategories'=>Category::where('model_type','TradingRevenueStream')->where('company_id',$currentCompanyId)->get()->formatForSelect2(true ,'getId','getName'),
			// 'tradingCategories'=>Category::where('model_type','TradingRevenueStream')->where('company_id',$currentCompanyId)->get()->formatForSelect2(true ,'getId','getName'),
			'manufacturingProducts'=>Product::where('company_id',$currentCompanyId)->where('model_type','ManufacturingRevenueStream')->get()->formatForSelect2(true ,'getId','getName'),
			'tradingProducts'=>Product::where('company_id',$currentCompanyId)->where('model_type','TradingRevenueStream')->get()->formatForSelect2(true ,'getId','getName'),
			'sellingUnitOfMeasurements'=>SellingUnitOfMeasurement::where('company_id',$currentCompanyId)->get()->formatForSelect2(true ,'getId','getName'),
			'productionUnitOfMeasurements'=>ProductionUnitOfMeasurement::where('company_id',$currentCompanyId)->get()->formatForSelect2(true ,'getId','getName'),
		];
	}
	
	
	

	public static function getPageTitle(): string
	{
		return __('Financial Plan Table');
	}


	
	
	
	
	
}
