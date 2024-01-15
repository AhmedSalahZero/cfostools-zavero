<?php

namespace App\ReadyFunctions;

use App\Models\FinancialPlan;


class ProjectsUnderProgress
{
	public function calculateForConstruction(array $hardConstructionExecution , array $softConstructionExecution,array $loanInterestOfHardConstruction ,array $withdrawalInterestOfHardConstruction,FinancialPlan $financialPlan,int $operationStartDateAsIndex,array $datesAsStringAndIndex, array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate):array
	{

		$studyDates = $financialPlan->getStudyDateFormatted($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
		
		$result = [];
		$beginningBalance = 0;
		$additions = sumTwoArray($hardConstructionExecution, $softConstructionExecution);
		$finalHardExecutionDate = array_key_last($hardConstructionExecution);
		$finalHardExecutionDate = is_numeric($finalHardExecutionDate) ? $finalHardExecutionDate : ($finalHardExecutionDate ? $datesAsStringAndIndex[$finalHardExecutionDate] : null);
		if(is_null($finalHardExecutionDate)){
			return [];
		}
		$dateBeforeOperation = $operationStartDateAsIndex == 0 ? $operationStartDateAsIndex : $operationStartDateAsIndex - 1;
		$finalCapitalizedInterestDateAsIndex = $dateBeforeOperation >= $finalHardExecutionDate ? $dateBeforeOperation : $finalHardExecutionDate;
		$softEndDate = array_key_last($softConstructionExecution);
		$softEndDate = is_numeric($softEndDate) ? $softEndDate : $datesAsStringAndIndex[$softEndDate];
		$transferredToFixedAssetDateAsIndex = $softEndDate >=     $finalCapitalizedInterestDateAsIndex ? $softEndDate : $finalCapitalizedInterestDateAsIndex;
		$transferredToFixedAssetDateAsIndex = is_null($transferredToFixedAssetDateAsIndex)?$operationStartDateAsIndex:$transferredToFixedAssetDateAsIndex;
		$transferredToFixedAssetDateAsString = $dateIndexWithDate[$transferredToFixedAssetDateAsIndex];
		$capitalizedInterest = $financialPlan->sumTwoArrayUntilIndex($withdrawalInterestOfHardConstruction, $loanInterestOfHardConstruction, $dateIndexWithDate[$finalCapitalizedInterestDateAsIndex],$dateIndexWithDate);
		foreach ($studyDates as $dateAsString => $dateAsIndex) {
			$result['beginning_balance'][$dateAsString] = $beginningBalance;
			$additionsAtDate = $additions[$dateAsString] ?? 0;
			$result['additions'][$dateAsString] = $additionsAtDate;
			$capitalizedInterestAtDate =  $capitalizedInterest[$dateAsString]??0;
			$result['capitalized_interest'][$dateAsString] = $capitalizedInterestAtDate;
			$total = $beginningBalance  + $additionsAtDate  +  $capitalizedInterestAtDate;
			$result['total'][$dateAsString] = $total;

			$beginningBalance = $total;
			if ($dateAsString == $transferredToFixedAssetDateAsString) {
				$result['transferred_date_and_vales'][$dateAsString] = $total;
				$result['end_balance'][$dateAsString] = $total  -  $result['transferred_date_and_vales'][$dateAsString];
				break;
			} else {
				$result['transferred_date_and_vales'][$dateAsString] = 0;
				$result['end_balance'][$dateAsString] =$total;
			}
		}
		return $result;
	}
	
	
	public function calculateForFFE(array $ffeExecutionAndPayment,array $ffeLoanInterestAmount,array $ffeLoanWithdrawalInterestAmounts,FinancialPlan $financialPlan,int $operationStartDateAsIndex,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber):array
	{
		
		$studyDurationPerYear = $financialPlan->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
		$studyDates = $financialPlan->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
		
		$result = [];
		$beginningBalance = 0;
		$additions = sumTwoArray($ffeExecutionAndPayment, []);
		$finalFFEExecutionDate = array_key_last($ffeExecutionAndPayment);
		$dateBeforeOperation = $operationStartDateAsIndex == 0 ? $operationStartDateAsIndex : $operationStartDateAsIndex - 1;
		$finalCapitalizedInterestDateAsIndex = $dateBeforeOperation >= $finalFFEExecutionDate ? $dateBeforeOperation : $finalFFEExecutionDate;
		$transferredToFixedAssetDateAsIndex = $finalCapitalizedInterestDateAsIndex;
		$transferredToFixedAssetDateAsString = $dateIndexWithDate[$transferredToFixedAssetDateAsIndex];
		$capitalizedInterest = $financialPlan->sumTwoArrayUntilIndex($ffeLoanWithdrawalInterestAmounts, $ffeLoanInterestAmount, $dateIndexWithDate[$finalCapitalizedInterestDateAsIndex],$dateIndexWithDate);
		foreach ($studyDates as $dateAsString => $dateAsIndex) {
			$result['beginning_balance'][$dateAsString] = $beginningBalance;
			$additionsAtDate = $additions[$dateAsString] ?? 0;
			$result['additions'][$dateAsString] = $additionsAtDate;
			$capitalizedInterestAtDate =  $capitalizedInterest[$dateAsString]??0;
			$result['capitalized_interest'][$dateAsString] = $capitalizedInterestAtDate;
			$total = $beginningBalance  + $additionsAtDate  +  $capitalizedInterestAtDate;
			$result['total'][$dateAsString] = $total;

			$beginningBalance = $total;
			if ($dateAsString == $transferredToFixedAssetDateAsString) {
				$result['transferred_date_and_vales'][$dateAsString] = $total;
				$result['end_balance'][$dateAsString] = $total  -  $result['transferred_date_and_vales'][$dateAsString];
				break;
			} else {
				$result['transferred_date_and_vales'][$dateAsString] = 0;
				$result['end_balance'][$dateAsString] =$total;
			}
		}
		
		return $result;
	}
}
