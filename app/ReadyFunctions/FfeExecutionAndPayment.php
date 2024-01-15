<?php

namespace App\ReadyFunctions;

use App\Models\HospitalitySector;

class FfeExecutionAndPayment
{
	public function __calculate($totalCost, int $ffeStartDateAsIndex, int $duration, string $softExecutionMethod,array $dateIndexWithDate, HospitalitySector $hospitalitySector):array 
	{
		return $this->calculateConstructionExecution($totalCost, $softExecutionMethod, $ffeStartDateAsIndex, $duration,$dateIndexWithDate, $hospitalitySector);
	}

	protected function calculateConstructionExecution(float $totalCost, string $softExecutionMethod, int $ffeStartDateAsIndex, int $duration,array $dateIndexWithDate, HospitalitySector $hospitalitySector = null):array
	{
		switch($softExecutionMethod) {
			case 'straight-line':
				$ffeStartDateAsString = $dateIndexWithDate[$ffeStartDateAsIndex];
				$straightMethodService = new StraightMethodService();
				return $straightMethodService->calculateStraightAmount($totalCost, $ffeStartDateAsString, $duration);
				case 's-curve':
					$sCurveService = new SCurveService();
					$startDateAsString =$hospitalitySector->getFFEStartDateAsString();
					return $sCurveService->__calculate($totalCost, $duration,$startDateAsString);
					
				case 'steady-growth':
				$steadyGrowthMethod = new SteadyGrowthMethod();
				$startDateAsString =$hospitalitySector->getFfeStartDateAsString();
				return $steadyGrowthMethod->calculateSteadyGrowthAmount($totalCost, $startDateAsString,$duration);
			case 'steady-decline':
				$steadyDeclineMethod = new SteadyDeclineMethod();
				$startDateAsString =$hospitalitySector->getFfeStartDateAsString();
				return $steadyDeclineMethod->calculateSteadyDeclineAmount($totalCost, $startDateAsString,$duration);
				default :
			return [];
		}
	}
	
	protected function calculateEquityFundingAmount(float $totalFfeCost, float $softEquityFundingRate)
	{
		return $totalFfeCost * ($softEquityFundingRate / 100);
	}
	
	protected function calculateTotalFfeCost(float $ffeCost,float $softContingencyRate )
	{
		return  $ffeCost * (1+ ($softContingencyRate / 100));
	}
	public function calculateFfeEquityPayment(array $ffePayments, float $ffeCost, float $softContingencyRate, float $softEquityFundingRate)
	{
		$totalFfeCost = $this->calculateTotalFfeCost($ffeCost,$softContingencyRate);
		$equityFundingAmount = $this->calculateEquityFundingAmount($totalFfeCost, $softEquityFundingRate);
		$ffeEquityPayment = [];
		$remainingEquityFunding = [];
		$firstLoop = true;
		foreach ($ffePayments as $dateIndex => $ffePaymentValue) {
			$nextDateIndex = getNextDate($ffePayments,$dateIndex);
			if ($firstLoop) {
				$remainingEquityFunding[$dateIndex] = $equityFundingAmount;
				$firstLoop= false;
			}
			if ($remainingEquityFunding[$dateIndex] >= $ffePaymentValue) {
				$ffeEquityPayment[$dateIndex] = $ffePaymentValue;
				if($nextDateIndex){
					$remainingEquityFunding[$nextDateIndex] = $remainingEquityFunding[$dateIndex] -$ffeEquityPayment[$dateIndex];
				}
			} else {
				$ffeEquityPayment[$dateIndex] = $remainingEquityFunding[$dateIndex];
				if($nextDateIndex){
					$remainingEquityFunding[$nextDateIndex] = $remainingEquityFunding[$dateIndex] -$ffeEquityPayment[$dateIndex];
				}
			}
		}
		return $ffeEquityPayment;
	}
	
	public function calculateFfeLoanWithdrawal(array $ffePayments, float $ffeCost,float $softContingencyRate, float $equityFundingRate)
	{
		$totalFfeCost = $this->calculateTotalFfeCost($ffeCost,$softContingencyRate);
		
		$equityFundingAmount = $this->calculateEquityFundingAmount($totalFfeCost, $equityFundingRate);
		$ffeLoanWithdrawal = [];
		$isFirstNestedIf = true;
		foreach ($ffePayments as $index=>$landPayment) {
			$previousIndex = getPreviousDate($ffePayments, $index);
			$equityPaymentBalance[$index]  = $equityFundingAmount - $landPayment;
			$equityFundingAmount = $equityPaymentBalance[$index];
			if ($equityPaymentBalance[$index] < 0) {
				if ($isFirstNestedIf) {
					$ffeLoanWithdrawal[$index] = $equityPaymentBalance[$index] * -1;
				} else {
					$ffeLoanWithdrawal[$index] =  ($equityPaymentBalance[$index] - $equityPaymentBalance[$previousIndex]) * -1;
				}
				$isFirstNestedIf = false;
			}
		}
		if (array_sum($ffeLoanWithdrawal) > -1 && array_sum($ffeLoanWithdrawal) < 1) {
			return [];
		}

		return $ffeLoanWithdrawal;
	}
	

}
