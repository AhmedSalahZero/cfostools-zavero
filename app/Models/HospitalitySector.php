<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Interfaces\Models\IHaveAllRelations;
use App\Interfaces\Models\IShareable;
use App\Models\Repositories\CurrencyRepository;
use App\Models\Traits\Accessors\HospitalitySectorAccessor;
use App\Models\Traits\Mutators\HospitalitySectorMutator;
use App\Models\Traits\Relations\HospitalitySectorRelation;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\withAllRelationsScope;
use Illuminate\Database\Eloquent\Model;

class  HospitalitySector extends Model implements IBaseModel, IHaveAllRelations, IExportable, IShareable
{

	use  HospitalitySectorAccessor, HospitalitySectorMutator, HospitalitySectorRelation, CompanyScope, withAllRelationsScope;
	// protected $with = [
	// 	'departmentExpenses'
	// ];
	protected $guarded = [
		'id'
	];
	
	protected $casts = [
		'operation_dates'=>'array',
		'study_dates'=>'array'
	];
	public static function getShareableEditViewVars($model): array
	{

		return [
			'pageTitle' => HospitalitySector::getPageTitle(),
		];
	}

	public function getRouteKeyName()
	{
		return 'hospitality_sectors.id';
	}
	public static function exportViewName(): string
	{
		return __('Hospitality Sector Feasibility & Multi-years Financial Plans');
	}
	public static function getFileName(): string
	{
		return __('Hospitality Sector Feasibility & Multi-years Financial Plans');
	}

	protected static function booted()
	{
		// static::aHGlobalScope(new StateCountryScope);
	}

	public static function getCrudViewName(): string
	{
		return 'admin.hospitality-sector.create';
	}

	public static function getViewVars(): array
	{
		$currentCompanyId =  getCurrentCompanyId();

		return [
			'getDataRoute' => route('admin.get.hospitality.sector', ['company' => $currentCompanyId]),
			'modelName' => 'HospitalitySector',
			'exportRoute' => route('admin.export.hospitality.sector', $currentCompanyId),
			'createRoute' => route('admin.create.hospitality.sector', $currentCompanyId),
			'storeRoute' => route('admin.store.hospitality.sector', $currentCompanyId),
			'hasChildRows' => false,
			'pageTitle' => HospitalitySector::getPageTitle(),
			'redirectAfterSubmitRoute' => route('admin.view.hospitality.sector', $currentCompanyId),
			'type' => 'create',
			'company' => Company::find($currentCompanyId),
			'redirectAfterSubmitRoute' => route('admin.view.hospitality.sector', ['company' => getCurrentCompanyId()]),
			'currencies' => App(CurrencyRepository::class)->allFormattedForSelect()
			//	'durationTypes' => getDurationIntervalTypesForSelect()
		];
	}
	
	
	

	public static function getPageTitle(): string
	{
		return __('Hospitality Sector Feasibilities & Multi-years Financial Plan Table');
	}

	public function getAllRelationsNames(): array
	{
		return [
			// 'revenueBusinessLine',
			// 'serviceCategory','serviceItem','serviceNatureRelation','currency','otherVariableManpowerExpenses',
			// 'directManpowerExpenses','salesAndMarketingExpenses','otherDirectOperationExpenses','generalExpenses','freelancerExpensePositions',
			// 'directManpowerExpensePositions','freelancerExpenses','profitability'
		];
	}
	
	
	
	
	
}
