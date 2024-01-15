<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Interfaces\Models\IHaveAllRelations;
use App\Interfaces\Models\IShareable;
use App\Models\Repositories\CurrencyRepository;
use App\Models\Traits\Accessors\FBAccessor;
use App\Models\Traits\Mutators\FBMutator;
use App\Models\Traits\Relations\FBRelation;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\withAllRelationsScope;
use Illuminate\Database\Eloquent\Model;

class  FB extends Model implements IBaseModel, IHaveAllRelations, IExportable, IShareable
{
	protected $connection = 'mysql_fb';
	protected $table = 'fbs';
	
	use  FBAccessor, FBMutator, FBRelation, CompanyScope, withAllRelationsScope;
	
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
			'pageTitle' => FB::getPageTitle(),
		];
	}

	public function getRouteKeyName()
	{
		return 'fbs.id';
	}
	public static function exportViewName(): string
	{
		return __('Food & Beverage Outlets Feasibility & Valuations');
	}
	public static function getFileName(): string
	{
		return __('Food & Beverage Outlets & Valuations');
	}

	protected static function booted()
	{
		// static::aHGlobalScope(new StateCountryScope);
	}

	public static function getCrudViewName(): string
	{
		return 'admin.fb.create';
	}

	public static function getViewVars(): array
	{
		$currentCompanyId =  getCurrentCompanyId();

		return [
			'getDataRoute' => route('admin.get.fb', ['company' => $currentCompanyId]),
			'modelName' => 'FB',
			'exportRoute' => route('admin.export.fb', $currentCompanyId),
			'createRoute' => route('admin.create.fb', $currentCompanyId),
			'storeRoute' => route('admin.store.fb', $currentCompanyId),
			'hasChildRows' => false,
			'pageTitle' => FB::getPageTitle(),
			'redirectAfterSubmitRoute' => route('admin.view.fb', $currentCompanyId),
			'type' => 'create',
			'company' => Company::find($currentCompanyId),
			'redirectAfterSubmitRoute' => route('admin.view.fb', ['company' => getCurrentCompanyId()]),
			'currencies' => App(CurrencyRepository::class)->allFormattedForSelect()
			//	'durationTypes' => getDurationIntervalTypesForSelect()
		];
	}
	
	
	

	public static function getPageTitle(): string
	{
		return __('Food & Beverage Outlets Feasibility and Valuations');
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
