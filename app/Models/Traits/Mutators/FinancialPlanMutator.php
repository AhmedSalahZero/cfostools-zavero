<?php

namespace App\Models\Traits\Mutators;

use App\Models\FinancialPlan;
use App\Models\Room;
use Illuminate\Http\Request;

trait FinancialPlanMutator
{
	protected function getMainFields(): array
	{
		
		return [
			'creator_id', 'company_id', 'study_name', 'study_status',
			'revenue_streams', 'country_id', 'country_id', 'state_id',
			'study_start_date', 'duration_in_years', 'study_end_date',
			'region', 'development_start_month',
			'finished_goods_inventory_coverage_days','raw_materials_inventory_coverage_days','finished_goods_inventory_coverage_days_for_trading',
			'development_start_date', 'development_duration', 'main_functional_currency', 'additional_currency', 'exchange_rate', 'corporate_taxes_rate', 'investment_return_rate', 'perpetual_growth_rate', 'financial_year_start_month',
			'operation_start_date','development_end_date',
			
		];
	}

	public function storeMainSection(Request $request)
	{
		$financialPlan = FinancialPlan::create($request->except(['_token']));
		$datesAsStringAndIndex = $financialPlan->getDatesAsStringAndIndex();
		$studyDates = $financialPlan->getStudyDates() ;
		$datesAndIndexesHelpers = $financialPlan->datesAndIndexesHelpers($studyDates);
		$datesIndexWithYearIndex=$datesAndIndexesHelpers['datesIndexWithYearIndex']; 
		$yearIndexWithYear=$datesAndIndexesHelpers['yearIndexWithYear']; 
		$dateIndexWithDate=$datesAndIndexesHelpers['dateIndexWithDate']; 
		$dateWithMonthNumber=$datesAndIndexesHelpers['dateWithMonthNumber']; 
		$financialPlan->updateStudyAndOperationDates($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
	
		return $financialPlan;
	}
	public function updateMainSection(Request $request)
	{
		$this->update(array_merge($request->only($this->getMainFields()), []));
		$financialPlan = $this->fresh();
		$datesAsStringAndIndex = $financialPlan->getDatesAsStringAndIndex();
		$studyDates = $financialPlan->getStudyDates() ;
		$datesAndIndexesHelpers = $financialPlan->datesAndIndexesHelpers($studyDates);
		$datesIndexWithYearIndex=$datesAndIndexesHelpers['datesIndexWithYearIndex']; 
		$yearIndexWithYear=$datesAndIndexesHelpers['yearIndexWithYear']; 
		$dateIndexWithDate=$datesAndIndexesHelpers['dateIndexWithDate']; 
		$dateWithMonthNumber=$datesAndIndexesHelpers['dateWithMonthNumber']; 
		$this->updateStudyAndOperationDates($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		return $this;
	}
	public function storeManufacturingRevenueStreamsSection(Request $request)
	{
			foreach ((array) $request->get('manufacturingRevenueStreams') as $manufacturingArr){
				$this->manufacturingRevenueStreams()->create(array_merge($manufacturingArr , []));
			}
			return $this;
	}
	public function storeTradingRevenueStreamsSection(Request $request)
	{
			foreach ((array) $request->get('tradingRevenueStreams') as $manufacturingArr){
				$this->tradingRevenueStreams()->create(array_merge($manufacturingArr , []));
			}
			return $this;
	}
	public function updateManufacturingRevenueStreamsSection(Request $request)
	{
		$deleteAll = false  ;
		$relationName = 'manufacturingRevenueStreams' ;
		$identifier = 'id' ;
		// dd($request->all());
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}
	public function updateTradingRevenueStreamsSection(Request $request)
	{
		$deleteAll = false  ;
		$relationName = 'tradingRevenueStreams' ;
		$identifier = 'id' ;
		return $this->updateRepeaterModel($request , $deleteAll , $relationName , $identifier);
	}
	
	public function updateStudyAndOperationDates(array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber)
	{
		
		$operationDurationDates = $this->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,false);
		
		$studyDurationDates = $this->getStudyDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,false);
		$operationDurationDates = $this->editOperationDatesStartingIndex($operationDurationDates,$studyDurationDates);
		$this->update([
			'study_dates'=>$studyDurationDates,
			'operation_dates'=>$operationDurationDates,
		]);

	}	
}
