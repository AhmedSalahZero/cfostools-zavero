<?php

namespace App\ReadyFunctions;

use App\Helpers\HArr;
use App\Models\FFE;
use App\Models\HospitalitySector;
use Carbon\Carbon;

class StartUpCostService
{
	public function calculateStartUpCost( float $dueDays , float $cashPayment , float $deferredPaymentPercentage, float $costAmount , int $dateAsIndex ,array $studyDatesAsStringAndIndex, array $dateIndexWithDate , array $dateWithDateIndex,HospitalitySector $hospitalitySector,array &$startUpAndPreOperationExpensesTotals)
	{
		$startUpPayment = $this->calculatePayment($dueDays , $cashPayment , $deferredPaymentPercentage , $costAmount , $dateAsIndex , $dateIndexWithDate , $dateWithDateIndex,$hospitalitySector);
		$dateAsString = $dateIndexWithDate[$dateAsIndex];
		$dateIndexWithCostAmount = [];
		foreach($studyDatesAsStringAndIndex as $dateString => $dateIndex ){
			$dateIndexWithCostAmount[$dateIndex] = $dateAsString == $dateString ? $costAmount : 0;
		}
		
		$startUpPayableBalance = $this->calculateEndBalance($dateIndexWithCostAmount , $startUpPayment , $dateIndexWithDate , $hospitalitySector );
		$projectUnderProgressForFFE = [
			'transferred_date_and_vales'=>[
				$dateAsString =>  $costAmount
			]
		];
		 $startUpCostAssets = (new FFE())->calculateFFEAssets(12,0,0,$projectUnderProgressForFFE,$studyDatesAsStringAndIndex , $hospitalitySector->getStudyEndDateFormatted(),$hospitalitySector);

		 $startUpAndPreOperationExpensesTotals['payments'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['payments'] ??[], $startUpPayment ],$studyDatesAsStringAndIndex);

		 $startUpAndPreOperationExpensesTotals['total_monthly_depreciation'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['total_monthly_depreciation'] ??[], $startUpCostAssets['total_monthly_depreciation']??[] ],array_keys($studyDatesAsStringAndIndex));
		 $startUpAndPreOperationExpensesTotals['payable_end_balance'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['payable_end_balance'] ??[], $startUpPayableBalance['monthly']['end_balance']??[] ],$studyDatesAsStringAndIndex);
		 $startUpAndPreOperationExpensesTotals['beginning_balance'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['beginning_balance'] ??[], $startUpCostAssets['beginning_balance']??[] ],array_keys($studyDatesAsStringAndIndex));
		 $startUpAndPreOperationExpensesTotals['accumulated_depreciation'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['accumulated_depreciation'] ??[], $startUpCostAssets['accumulated_depreciation']??[] ],array_keys($studyDatesAsStringAndIndex));
		 $startUpAndPreOperationExpensesTotals['end_balance'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['end_balance'] ??[], $startUpCostAssets['end_balance']??[] ],array_keys($studyDatesAsStringAndIndex));
		
		 return [
			'payments'=>$startUpPayment,
			'start_up_payable_statement'=>$startUpPayableBalance,
			'start_up_cost_assets'=>$startUpCostAssets 
		] ;
	}
	
	public function calculatePreOperatingExpense( array $payload,array $studyDatesAsStringAndIndex, array $dateIndexWithDate , HospitalitySector $hospitalitySector,array &$startUpAndPreOperationExpensesTotals)
	{
		$payloadAsIndexes = $payload ;
		$payload = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($payload , $dateIndexWithDate);
		 $perOperatingAssets = $this->calculatePreOperatingAssets($payload,12,$studyDatesAsStringAndIndex ,$hospitalitySector);
		 $startUpAndPreOperationExpensesTotals['payments'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['payments'] ??[] ,$payloadAsIndexes ],$studyDatesAsStringAndIndex);
		 
		 $startUpAndPreOperationExpensesTotals['total_monthly_depreciation'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['total_monthly_depreciation'] ??[] ,$perOperatingAssets['total_monthly_depreciation']??[] ],array_keys($studyDatesAsStringAndIndex));

		 $startUpAndPreOperationExpensesTotals['beginning_balance'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['beginning_balance'] ??[], $perOperatingAssets['beginning_balance']??[] ],array_keys($studyDatesAsStringAndIndex));
		 $startUpAndPreOperationExpensesTotals['accumulated_depreciation'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['accumulated_depreciation'] ??[], $perOperatingAssets['accumulated_depreciation']??[] ],array_keys($studyDatesAsStringAndIndex));
		 $startUpAndPreOperationExpensesTotals['end_balance'] = HArr::sumAtDates([$startUpAndPreOperationExpensesTotals['end_balance'] ??[], $perOperatingAssets['end_balance']??[] ],array_keys($studyDatesAsStringAndIndex));
		
		 
		return [
			'payments'=>$payload,
			'per_operating_assets'=>$perOperatingAssets 
		] ;
	}
	
	protected function calculatePayment(float $dueDays , float $cashPayment , float $deferredPaymentPercentage, float $costAmount , int $dateAsIndex  , array $dateIndexWithDate , array $dateWithDateIndex,HospitalitySector $hospitalitySector )
	{
		$collectionPolicyService = new CollectionPolicyService;
		$collectionPolicyValue = ['due_in_days' => [0, $dueDays], 'rate' => [$cashPayment, $deferredPaymentPercentage]];
		return  $collectionPolicyService->applyCollectionPolicy(true, 'customize', $collectionPolicyValue, [$dateAsIndex=>$costAmount], $dateIndexWithDate, $dateWithDateIndex, $hospitalitySector);
	}
	public function calculateEndBalance(array $purchase , array $collection , array $dateIndexWithDate,HospitalitySector $hospitalitySector )
	{
		$purchasesForIntervals = [
			'monthly'=>$purchase,
			'quarterly'=>sumIntervals($purchase,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'semi-annually'=>sumIntervals($purchase,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'annually'=>sumIntervals($purchase,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
		];
		$collectionForInterval = [
			'monthly'=>$collection,
			'quarterly'=>sumIntervals($collection,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'semi-annually'=>sumIntervals($collection,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'annually'=>sumIntervals($collection,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
		];
		
		// dd($purchasesForIntervals,$collectionForInterval );
		
		
		$result = [];
		$beginning_balances =[];
		$dueAmounts =[];
		$end_balance =[];
		foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted){
			$beginning_balance = 0 ;
			foreach ($purchasesForIntervals[$intervalName]  as $dateAsIndex=>$purchaseAtDate) {
				$result[$intervalName]['beginning_balance'][$dateAsIndex] = $beginning_balance ; 
				$beginning_balances[$dateAsIndex] = $beginning_balance ;
				$result[$intervalName]['asset_purchases'][$dateAsIndex] = $purchaseAtDate ?? 0 ; 
				$due_amount =($purchaseAtDate??0) + $beginning_balance ;
				$result[$intervalName]['due_amount'][$dateAsIndex] = $due_amount ; 
				$currenPayment = getValueFromArrayStringAndIndex($collectionForInterval[$intervalName],$dateAsIndex,$dateAsIndex,0);
				$dueAmounts[$dateAsIndex] = $due_amount ;
				$end_balance[$dateAsIndex] = $due_amount - $currenPayment;
				$result[$intervalName]['payment'][$dateAsIndex] = $currenPayment ; 
				$result[$intervalName]['end_balance'][$dateAsIndex] = $end_balance[$dateAsIndex]??0 ; 
				$beginning_balance = $end_balance[$dateAsIndex];
			}
		
		}
		return $result ;
	}
	
	public function calculatePreOperatingAssets(array $payload , int $propertyDepreciationDurationInMonths,array $studyDates,HospitalitySector $hospitalitySector = null):array 
	{
		$preOperatingAssets = [];
		$operationStartDateFormatted = $hospitalitySector->getOperationStartDateFormatted();


		$beginningBalance = 0;
		$totalMonthlyDepreciation = [];
		$accumulatedDepreciation = [];
		$depreciation = [];
		$index = 0 ;
		$depreciationStartDate = $operationStartDateFormatted;
		$depreciationEndDate = $depreciationStartDate ? Carbon::make($depreciationStartDate)->addMonths(11) : null;
		foreach ($studyDates as $dateAsString=>$dateAsIndex) {
			$preOperatingAssets['beginning_balance'][$dateAsString]= $beginningBalance;
			$preOperatingAssets['additions'][$dateAsString]=  $payload[$dateAsString] ?? 0;
			$preOperatingAssets['initial_total_gross'][$dateAsString] =  $preOperatingAssets['additions'][$dateAsString] +  $beginningBalance;
			$preOperatingAssets['final_total_gross'][$dateAsString] = $preOperatingAssets['initial_total_gross'][$dateAsString]  ;
			$depreciation[$dateAsString]=$this->calculateMonthlyDepreciation($preOperatingAssets['additions'][$dateAsString],0,$propertyDepreciationDurationInMonths, $depreciationStartDate, $depreciationEndDate, $totalMonthlyDepreciation, $accumulatedDepreciation,$studyDates);
			$accumulatedDepreciation = $this->calculateAccumulatedDepreciation($totalMonthlyDepreciation,$studyDates);
			$preOperatingAssets['total_monthly_depreciation'] =$totalMonthlyDepreciation;
			$preOperatingAssets['accumulated_depreciation'] =$accumulatedDepreciation;
			$currentAccumulatedDepreciation = $preOperatingAssets['accumulated_depreciation'][$dateAsString] ?? 0;
			$preOperatingAssets['end_balance'][$dateAsString] =  $preOperatingAssets['final_total_gross'][$dateAsString] -  $currentAccumulatedDepreciation;
			$beginningBalance = $preOperatingAssets['final_total_gross'][$dateAsString];
			$index++;
		}
		
		return $preOperatingAssets ;
	}
	protected function calculateAccumulatedDepreciation(array $totalMonthlyDepreciation,array $studyDates)
	{
		$result = [];
		foreach ($studyDates  as $date=>$dateIndex) {
			$value = $totalMonthlyDepreciation[$date] ?? 0; 
			$previousDate = getPreviousDate($studyDates, $date);
			$result[$date] = $previousDate ? $result[$previousDate] + $value : $value;
		}

		return $result;
	}

	protected function calculateMonthlyDepreciation(float $additions,float $replacementCost,int $propertyDepreciationDurationInMonths, ?string $depreciationStartDate, ?string $depreciationEndDate, &$totalMonthlyDepreciation, &$accumulatedDepreciation,array $studyDates)
	{
		if (!$depreciationStartDate || !$depreciationEndDate) {
			return [];
		}
		$monthlyDepreciations = [];
		$monthlyDepreciationAtCurrentDate =  ($additions+$replacementCost) / $propertyDepreciationDurationInMonths ;
		$depreciationStartDateAsCarbon = Carbon::make($depreciationStartDate);
		$depreciationEndDateAsCarbon = Carbon::make($depreciationEndDate);
		$depreciationDates = generateDatesBetweenTwoDates($depreciationStartDateAsCarbon, $depreciationEndDateAsCarbon, 'addMonth', 'd-m-Y');
		foreach ($studyDates as $dateAsString => $dateAsIndex) {
			$previousDate = getPreviousDate($studyDates, $dateAsString);
			if(in_array($dateAsString,$depreciationDates)){
				$monthlyDepreciations[$dateAsString] = $monthlyDepreciationAtCurrentDate;
				$totalMonthlyDepreciation[$dateAsString] = isset($totalMonthlyDepreciation[$dateAsString]) ? $totalMonthlyDepreciation[$dateAsString] +$monthlyDepreciationAtCurrentDate : $monthlyDepreciationAtCurrentDate;
				$accumulatedDepreciation[$dateAsString] = $previousDate ? ($totalMonthlyDepreciation[$dateAsString] + $accumulatedDepreciation[$previousDate]) : $totalMonthlyDepreciation[$dateAsString];
			}else{
				// $monthlyDepreciations[$dateAsString] = 0;
				// $totalMonthlyDepreciation[$dateAsString]  = 0 ;
				$accumulatedDepreciation[$dateAsString] = $accumulatedDepreciation[$previousDate] ?? 0 ;
			}
		}

		return $monthlyDepreciations;
	}
	
}
