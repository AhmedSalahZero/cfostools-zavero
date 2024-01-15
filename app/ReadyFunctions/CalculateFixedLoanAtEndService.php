<?php

namespace App\ReadyFunctions;

use App\Helpers\HArr;
use App\Models\HospitalitySector;
use App\Models\Loan;
use App\ReadyFunctions\Date;
use App\ReadyFunctions\FfeExecutionAndPayment;
use App\ReadyFunctions\SoftConstructionExecutionAndPayment;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class CalculateFixedLoanAtEndService
{
	public function __calculate(string $loanType, string $startDate, float $loanAmount, float $baseRate, float $marginRate, float $tenor, string $installmentPaymentIntervalName, float $stepUpRate = 0, string $stepUpIntervalName = null, float $stepDownRate = 0, string $stepDownIntervalName = null, float $gracePeriod  = 0)
	{
		$pricing = ($baseRate + $marginRate) /100;
		$stepRate = Loan::getStepRate($loanType, $stepUpRate, $stepDownRate);
		$stepRate = $stepRate / 100;
		$appliedStepName = Loan::getAppliedStepIntervalName($loanType, $stepUpIntervalName, $stepDownIntervalName);
		$appliedStepValue = $this->getAppliedStepIntervalValue($appliedStepName);
		$installmentPaymentIntervalValue = $this->getInstallmentPaymentIntervalValue($installmentPaymentIntervalName);
		$installmentStartDate = $this->getInstallmentStartDate($startDate, $gracePeriod, $installmentPaymentIntervalValue);
		$stepFactors = $this->calculateStepFactor($tenor, $appliedStepValue, $installmentStartDate, $this->getDateFormatted($this->addMonths($startDate, $tenor)));
		$daysCount = $this->calculateDaysCount($startDate, $tenor, $installmentPaymentIntervalValue);

		$interestFactor=$this->calcInterestFactor($daysCount, $pricing);
		$endDateString = $this->getDateFormatted($this->addMonths($startDate, $tenor));
		$loanFactor = $this->calcLoanFactor($loanType, $loanAmount, $interestFactor, $gracePeriod, $installmentPaymentIntervalValue, $startDate, $tenor, $endDateString);
		$installmentFactor = $this->calculateInstallmentFactor($installmentStartDate, $interestFactor, $stepRate, $stepFactors, $tenor, $installmentPaymentIntervalValue, $gracePeriod, $loanFactor);
		$installmentAmount = $this->calculateInstallmentAmount($loanFactor, $installmentFactor, $stepRate, $stepFactors, $installmentStartDate, $endDateString, $tenor, $installmentPaymentIntervalValue, $appliedStepValue);
		$loanScheduleResult = $this->calculateLoanScheduleResult($loanType, $loanAmount, $interestFactor, $installmentAmount);
		return $loanScheduleResult;
			// return $this->replaceIndexesWith($loanScheduleResult, $dates);
	}

	protected function replaceIndexesWith(array $items, array $dates):array
	{
		$newItems = [];
		$newItems['totals']=$items['totals'];
		foreach ($dates as $index=>$date) {
			$newItems['beginning'][$date] = $items['beginning'][$index];
			$newItems['interestAmount'][$date] = $items['interestAmount'][$index];
			$newItems['schedulePayment'][$date] = $items['schedulePayment'][$index];
			$newItems['principleAmount'][$date] = $items['principleAmount'][$index];
			$newItems['endBalance'][$date] = $items['endBalance'][$index];
		}

		return $newItems;
	}

	protected function getInstallmentPaymentIntervalValue($installmentPayment):int
	{
		switch($installmentPayment) {
			case 'monthly':
				return 1;
			case 'quartly':
				return 3;
			case 'semi annually':
				return 6;
		}
	}

	protected function getAppliedStepIntervalValue($appliedStepIntervalName):int
	{
		switch($appliedStepIntervalName) {
			case 'quartly':
				return 3;
			case 'semi annually':
				return 6;
			case 'annually':
				return 12;
			default:
				return 12;
		}
	}

	protected function getInstallmentStartDate(string $startDate, float $gracePeriod, float $installmentPaymentIntervalValue):string
	{
		return $this->getDateFormatted($this->addMonths($startDate, $gracePeriod + $installmentPaymentIntervalValue));
	}

	protected function defaultDateFormat():string
	{
		return 'd-m-Y';
	}

	protected function calculateStepFactor($tenor, $appliedStepValue, string $installmentStartDate, string $endDate):array
	{
		$counter =  0;
		$stepFactors = [];

		for ($i = 0; $i <= $tenor; $i++) {
			if ($i % $appliedStepValue == 0 && $i != 0) {
				$counter = $counter + 1;
			}

			$obj = [];
			$obj['date'] = $this->getDateFormatted($this->addMonths($installmentStartDate, $i));
			$obj['factory'] = $counter;
			$stepFactors[$obj['date']]= $obj;
			if ($endDate ==  $obj['date']) {
				break;
			}
		}

		return [
			'stepFactors'=>$stepFactors
		];
	}

	protected function addMonths(string $date, int $duration):Carbon
	{
		return Carbon::make((new Date())->addMonths($date, $duration));
	}

	protected function getDateFormatted(Carbon $date):string
	{
		return $date->format($this->defaultDateFormat());
	}

	protected function calculateDaysCount(string $startDate, float $tenor, int $installmentPaymentIntervalValue):array
	{
		$days = [];
		$originalStartDate = $startDate;
		$obj = [];
		$obj['date'] = $startDate;
		$obj['daysDiff'] = 0;
		$days[$obj['date']]=$obj;
		for ($i = 0; $i < $tenor; $i = $i + $installmentPaymentIntervalValue) {
			$firstMonth = Carbon::make($startDate);
			$secondMonth = $this->addMonths($originalStartDate, $i+ $installmentPaymentIntervalValue);
			$diffInDays = getDifferenceBetweenTwoDatesInDays($firstMonth, $secondMonth);

			$obj = [];
			$obj['date'] = $this->getDateFormatted($secondMonth);
			$obj['daysDiff'] = $diffInDays;
			$days[$obj['date']]=$obj;
			$startDate  = $secondMonth;
		}

		return [
			'daysCount' => $days
		];
	}

	protected function calcInterestFactor(array $daysCount, float $pricing):array
	{
		$interestFactor = [];
		$dates = [];
		foreach ($daysCount['daysCount'] as $date => $daysCountArr) {
			$interest = ($pricing / 360) * ($daysCountArr['daysDiff']);
			$obj = [];
			$obj['date'] = $daysCountArr['date'];
			$dates[] = $obj['date'];
			$obj['interestFactor'] = $interest;
			$interestFactor[$date]=$obj;
		}

		return [
			'interestFactor' => $interestFactor,
			'dates'=>$dates
		];
	}

	protected function calcLoanFactor(string $loanType, float $loanAmount, array $interestFactor, int $gracePeriod, int $installmentPaymentIntervalValue, string $startDate, float $tenor, string $endDate)
	{
		$originStartDate = $startDate ;
		
		$loanFactor = 0;
		$ballonPayment = 0;
		$residualValue  = 0;
		if (in_array($loanType, Loan::graceTypes())) {
			$loanFactorStartDate = $this->getDateFormatted($this->addMonths($startDate, $installmentPaymentIntervalValue + $gracePeriod));
			$searchedInterestFactor = Arr::first(array_filter($interestFactor['interestFactor'], function ($item) use ($loanFactorStartDate) {
				return $item['date'] == $loanFactorStartDate;
			}));
			$loanFactor = $loanAmount * (1 + $searchedInterestFactor['interestFactor']);
		} else {
			$loanFactorStartDate = $this->getDateFormatted($this->addMonths($startDate, $installmentPaymentIntervalValue));
			$searchedInterestFactor = Arr::first(array_filter($interestFactor['interestFactor'], function ($item) use ($loanFactorStartDate) {
				return $item['date'] == $loanFactorStartDate;
			}));
			$loanFactor = $loanAmount * (1 + $searchedInterestFactor['interestFactor']);
		}



		$loanFactoriesArr = [];

		$obj = [];
		$obj['date'] = $originStartDate;
		$obj['loanFactor'] = 0;
		$loanFactoriesArr[$obj['date']]= $obj;
		$obj = [];
		$obj['date'] = $loanFactorStartDate;
		$obj['loanFactor'] = $loanFactor;
		$loanFactoriesArr[$loanFactorStartDate]=$obj;
		$loopPreviousDate = $loanFactorStartDate ;
		for ($i = 1; $i <= ($tenor / $installmentPaymentIntervalValue); $i++) {
			// $index = $i+1+($gracePeriod/$installmentPaymentIntervalValue);
			$loopDate = getNextDate($interestFactor['interestFactor'] ,$loopPreviousDate );
			// $loopDate = $interestFactor['interestFactor'][$index]['date']; // معادله صلاح
			$searchedInterestFactor = Arr::first(array_filter($interestFactor['interestFactor'], function ($item) use ($loopDate) {
				return $item['date'] ==$loopDate;
			}));

			$loanFactor = $loanFactor + ($loanFactor * $searchedInterestFactor['interestFactor']);


			$obj = [];
			$obj['date'] = $loopDate;
			$loopPreviousDate = $loopDate ;
			$obj['loanFactor'] = $loanFactor;
			$loanFactoriesArr[$obj['date']]=$obj;

			if ($endDate == $loopDate) {
				break;
			}
		}
	
		$loanFactoriesArr = $this->calculateFinalLoanFactor($loanFactoriesArr, $ballonPayment, $residualValue);
		return [
			'loanFactories'=> $loanFactoriesArr
		];
	}

	protected function calculateFinalLoanFactor(array $items, $ballonPayment, $residualValue)
	{
		$finalLoanFactor = [];
		$lastKey = array_key_last($items) ;
		
		foreach ($items as $index=>$arr) {
			$isLastIndex = $index == $lastKey;
			if ($isLastIndex) {
				$arr['loanFactor'] = $arr['loanFactor'] - $ballonPayment - $residualValue;
			}
			$finalLoanFactor[$index] = $arr;
		}

		return $finalLoanFactor;
	}

	public function calculateInstallmentFactor(string $installmentStartDate, array $interestFactor, float $stepRate, array $stepFactor, float $tenor, int $installmentPaymentIntervalValue, float $gracePeriod, array $loanFactor)
	{
		$firstInstallmentStartDate = $installmentStartDate;
		$installmentFactors = [];
		$installmentFactor = -1;

		$obj = [];
		$obj['date'] = $this->getDateFormatted($this->addMonths($installmentStartDate, 0));

		$obj['installmentFactor'] = -1;
		$installmentFactors[$obj['date']]=$obj;

		for ($i = 1; $i <= $tenor / $installmentPaymentIntervalValue; $i++) {
			$loopDate = $this->getDateFormatted($this->addMonths($installmentStartDate, $installmentPaymentIntervalValue));

			$searchedInterestFactor = Arr::first(array_filter($interestFactor['interestFactor'], function ($item) use ($loopDate) {
				return $item['date'] ==$loopDate;
			}));

			$stepFactorOfDate = Arr::first(array_filter($stepFactor['stepFactors'], function ($item) use ($loopDate) {
				return $item['date'] ==$loopDate;
			}));
			if (!$searchedInterestFactor) {
				break;
			} else {
				$installmentFactor = $installmentFactor + ($installmentFactor * $searchedInterestFactor['interestFactor']) - (1 * pow((1 + $stepRate), ($stepFactorOfDate['factory'])));
				$obj = [];
				$obj['date'] = $loopDate;

				$obj['installmentFactor'] = $installmentFactor;
				$installmentFactors[$obj['date']]=$obj;
			}
			$installmentStartDate = $loopDate;
		}

		return [
			'installmentFactors'=> $installmentFactors];
	}

	protected function calculateInstallmentAmount(array $loanFactor, array $InstallmentFactor, float $stepRate, array $stepFactor, string $installmentStartDate, string $endDate, float $tenor, int $installmentPaymentIntervalValue, int $appliedStepValue)
	{
		$installmentsAmounts = [];
		$dates = [];

		$loanFactoryAtEndDate = Arr::first(array_filter($loanFactor['loanFactories'], function ($item) use ($endDate) {
			return $item['date'] ==$endDate;
		}));


		$installmentFactorAtEndDate = Arr::first(array_filter($InstallmentFactor['installmentFactors'], function ($item) use ($endDate) {
			return $item['date'] ==$endDate;
		}));

		$installmentAmount = $loanFactoryAtEndDate['loanFactor'] / ($installmentFactorAtEndDate['installmentFactor'] * -1);
		$obj = [];
		$obj['date'] = $installmentStartDate;
		$obj['amount'] = $installmentAmount;
		$installmentsAmounts[$obj['date']] = $obj;

		for ($i = 1; $i <= ($tenor / $installmentPaymentIntervalValue); $i++) {
			$loopDate = $this->getDateFormatted($this->addMonths($installmentStartDate, $installmentPaymentIntervalValue));

			$stepFactorOfDate = Arr::first(array_filter($stepFactor['stepFactors'], function ($item) use ($loopDate) {
				return $item['date'] ==$loopDate;
			}));

			if (!$stepFactorOfDate) {
				break;
			} else {
				if (($i % ($appliedStepValue / $installmentPaymentIntervalValue)) == 0 && $i != 0) {
					$installmentAmount = $installmentAmount * ((pow((1 + $stepRate), 1)));
				} else {
					$installmentAmount = $installmentAmount;
				}

				$obj = [];
				$obj['date'] = $loopDate;

				$obj['amount'] = $installmentAmount;
				$installmentsAmounts[$obj['date']]=$obj;
			}
			$installmentStartDate = $loopDate;
		}

		return [
			'InstallmentAmountArr'=> $installmentsAmounts,
		];
	}

	protected function calculateLoanScheduleResult(string $loanType, float $loanAmount, array $interestFactor, array $installmentAmount)
	{
		$loanScheduleResult = [];
		$loanScheduleResult['totals']['totalSchedulePayment'] = 0;
		$loanScheduleResult['totals']['totalPrincipleAmount'] = 0;
		$loanScheduleResult['totals']['totalInterestAmount'] = 0;
		
		$isWithoutCapitalization =  Loan::isWithoutCapitalization($loanType);
		$firstLoop = true ;
		foreach ($interestFactor['interestFactor']??[] as $date=>$interestFactorArr) {
			$previousDate = getPreviousDate($interestFactor['interestFactor']??[] , $date);
			$i = $date ; 
			$loanScheduleResult['beginning'][$i] =  $firstLoop ? $loanAmount : $loanScheduleResult['endBalance'][$previousDate]??0;
			$loanScheduleResult['interestAmount'][$i] = $loanScheduleResult['beginning'][$i] *   $interestFactor['interestFactor'][$i]['interestFactor'];
			$loanScheduleResult['totals']['totalInterestAmount'] += $loanScheduleResult['interestAmount'][$i];
			$installmentAmountAtIndex =$installmentAmount['InstallmentAmountArr'][$i]['amount'] ?? 0;
			// $installmentAmountAtIndex =$installmentAmount['InstallmentAmountArr'][$previousDate]['amount'] ?? 0;
			
			$loanScheduleResult['schedulePayment'][$i] = $isWithoutCapitalization && $installmentAmountAtIndex == 0 ? $loanScheduleResult['interestAmount'][$i] : $installmentAmountAtIndex;
			
			$loanScheduleResult['totals']['totalSchedulePayment'] = $loanScheduleResult['totals']['totalSchedulePayment'] + $loanScheduleResult['schedulePayment'][$i];
			$loanScheduleResult['principleAmount'][$i] = $loanScheduleResult['schedulePayment'][$i] - $loanScheduleResult['interestAmount'][$i];
			$loanScheduleResult['totals']['totalPrincipleAmount'] += $loanScheduleResult['principleAmount'][$i];
			$loanScheduleResult['endBalance'][$i] = $loanScheduleResult['beginning'][$i]  + $loanScheduleResult['interestAmount'][$i] -$loanScheduleResult['schedulePayment'][$i];
			$loanScheduleResult['endBalance'][$i] = $loanScheduleResult['endBalance'][$i] < 1 && $loanScheduleResult['endBalance'][$i] > -1 ? 0 : $loanScheduleResult['endBalance'][$i];
			$firstLoop = false ;
		}

		return $loanScheduleResult;
	}

	public function calculateFixedAssetsLoans(HospitalitySector $hospitalitySector,array $datesAsStringAndIndex,array $dateIndexWithDate,array $dateWithDateIndex)
	{
		$fixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$ffeExecutionAndPaymentService  = new FfeExecutionAndPayment();
		$constructionExecutionAndPaymentService  = new ConstructionExecutionAndPayment();
		$softConstructionExecutionAndPaymentService  = new SoftConstructionExecutionAndPayment();
		$contractPaymentService  = new ContractPaymentService();
		$landAcquisitionCostAndPaymentService = (new LandAcquisitionCostAndPayment());
		$loanWithdrawalService = new CalculateLoanWithdrawal();
		$operationStartDateAsString =  $hospitalitySector->getOperationStartDateFormatted();

		
		
		// 1- Land Equity Payment


		$landPayments = [];
		$landEquityPayment = [];
		$landLoanWithdrawal = [];
		$contractPayments = [];
		$landLoanInstallment = [];
		$landLoanStartDate = null;
		
		$landLoanAmount = 0;
		$landLoanEndBalanceAtStudyEndDate = 0;
		$landLoanEndBalance = [];
		$landLoanPricing = 0 ;

		$hardConstructionEquityPayment= [];
		$hardConstructionLoanInstallment = [];
		$hardConstructionLoanWithdrawal = [];
		$hardLoanStartDate = null;
		$hardLoanAmount= 0;
		$hardLoanPricing= 0;
		$hardConstructionLoanEndBalanceAtStudyEndDate = 0 ;
		$hardConstructionLoanEndBalance = [];
		$ffeEquityPayment= [];
		$ffeLoanInstallment = [];
		$ffeLoanWithdrawal = [];
		$ffeLoanStartDate = null;
		$ffeLoanAmount = 0;
		$ffeLoanPricing  = 0 ;
		$ffeLoanEndBalanceAtStudyEndDate = 0 ;

		$landLoanInterestAmounts = [];
		$hardConstructionLoanInterestAmounts=[];
		$ffeLoanInterestAmounts=[];
		$ffeLoanEndBalance = [];
		$propertyLoanStartDate = null;
		$propertyLoanAmount = 0;
		$propertyLoanEndBalanceAtStudyEndBalance = 0 ;
		$propertyLoanPricing = 0;
		$propertyEquityPayment =[];
		$propertyLoanWithdrawal =[];
		$propertyPayments=[];
		$propertyLoanInstallment=[];
		$propertyLoanInterestAmounts=[];
		$propertyLoanEndBalance = [];
		
		
		$hardLoanWithdrawalEndBalance = [];
		$ffeLoanWithdrawalEndBalance=[];
		$propertyLoanWithdrawalEndBalance = [];
		$landLoanWithdrawalEndBalance = [];
		$hardLoanWithdrawalAmounts = [];
		$ffeLoanWithdrawalAmounts = [];
		$propertyLoanWithdrawalAmounts = [];
		$landLoanWithdrawalAmounts = [];
		
		
		
		$propertyLandCapitalizedInterest  = [];
		$propertyBuildingCapitalizedInterest  = [];
		$propertyFFECapitalizedInterest  = [];
		
		
		$landLoanCapitalizedInterest = [];
		
		







		$acquisition = $hospitalitySector->getAcquisition();
		$propertyAcquisition = $hospitalitySector->getPropertyAcquisition();

		if ($propertyAcquisition) {
			// property Acquisition Equity Payment
			$purchaseDate = $propertyAcquisition->getPropertyPurchaseDateFormatted();
			$purchaseDateAsIndex = $dateWithDateIndex[$purchaseDate];
			$totalPropertyPurchaseCost = $propertyAcquisition->getTotalPurchaseCost();
			$paymentMethodType = $propertyAcquisition->getPropertyPaymentMethod();
			$downPaymentOneRate = $propertyAcquisition->getFirstPropertyDownPaymentPercentage();
			$balanceRate = $propertyAcquisition->getPropertyBalanceRate();
			$installmentCount = $propertyAcquisition->getPropertyInstallmentCount();
			$installmentInterval = $propertyAcquisition->getPropertyInstallmentInterval();
			$downPaymentTwoRate = $propertyAcquisition->getSecondPropertyDownPaymentPercentage();
			$propertyAfterMonths = $propertyAcquisition->getPropertyAfterMonthDays();
			$equityFundingRate = $propertyAcquisition->getPropertyEquityFundingRate();
			$customCollectionPolicyValue = $propertyAcquisition->getPropertyCustomCollectionPolicyValue();
			
			$propertyBuildingCostPercentage = $propertyAcquisition->getBuildingPropertyPercentage();
			$propertyLandCostPercentage = $propertyAcquisition->getLandPropertyAmountPercentage();
			$propertyFfeCostPercentage = $propertyAcquisition->getFFEPropertyAmountPercentage();

			$propertyPayments['Property Payments'] = $landAcquisitionCostAndPaymentService->calculateLandPayments($purchaseDateAsIndex, $totalPropertyPurchaseCost, $paymentMethodType, $downPaymentOneRate, $balanceRate, $installmentCount, $installmentInterval, $downPaymentTwoRate, $propertyAfterMonths, $customCollectionPolicyValue,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex, $hospitalitySector);
			$propertyEquityPayment['Property Equity Injection'] = $landAcquisitionCostAndPaymentService->calculateLandEquityPayment($propertyPayments['Property Payments'], $totalPropertyPurchaseCost, $equityFundingRate);
			$propertyLoanWithdrawal['Property Loan Withdrawal']=$landAcquisitionCostAndPaymentService->calculateLandLoanWithdrawal($propertyPayments['Property Payments'], $totalPropertyPurchaseCost, $equityFundingRate);


			$loanForProperty = $propertyAcquisition->getLoanForSection(PROPERTY_LOAN);
			if ($loanForProperty) {
				$propertyLoanType = $loanForProperty->getLoanType();
				$propertyBaseRate = $loanForProperty->getBaseRate();
				$propertyMarginRate = $loanForProperty->getMarginRate();
				$propertyTenor = $loanForProperty->getTenor();
				$propertyInstallmentIntervalName = $loanForProperty->getInstallmentInterval();
				$propertyStepUpRate=$loanForProperty->getStepUpRate();
				$propertyStepUpIntervalName=$loanForProperty->getStepUpIntervalName();
				$propertyStepDownRate=$loanForProperty->getStepDownRate();
				$propertyStepDownIntervalName=$loanForProperty->getStepDownIntervalName();
				$propertyGracePeriod=$loanForProperty->getGracePeriod();
				$propertyLoanPricing = $loanForProperty->getPricing(); 

				$propertyWithdrawal=$loanWithdrawalService->__calculate($hospitalitySector->replaceIndexWithItsStringDate($propertyLoanWithdrawal['Property Loan Withdrawal'],$dateIndexWithDate), $propertyBaseRate, $propertyMarginRate, $dateWithDateIndex);
	
				$propertyLoanStartDate =array_key_last($propertyWithdrawal);
				$propertyLoanWithdrawalInterestAmounts =$propertyWithdrawal['withdrawal_interest_amounts']??[];
				$propertyLoanWithdrawalEndBalance = $propertyWithdrawal['withdrawalEndBalance']??[];
				$propertyLoanWithdrawalAmounts = $propertyWithdrawal['loanWithdrawal']??[];


				$propertyLoanAmount = $propertyWithdrawal[$propertyLoanStartDate];
				if ($propertyLoanStartDate) {
					$propertyLoanCalculations = $fixedLoanAtEndService->__calculate($propertyLoanType, $propertyLoanStartDate, $propertyLoanAmount, $propertyBaseRate, $propertyMarginRate, $propertyTenor, $propertyInstallmentIntervalName, $propertyStepUpRate, $propertyStepUpIntervalName, $propertyStepDownRate, $propertyStepDownIntervalName, $propertyGracePeriod);
					
					$propertyLoanInterestAmounts = $propertyLoanCalculations['interestAmount'] ?? [];
					
					
					$propertyLoanCapitalizedInterest = HArr::getIndexesBeforeDateOrNumericIndex($propertyLoanInterestAmounts , $operationStartDateAsString);
					$propertyLandCapitalizedInterest = HArr::MultiplyWithNumber($propertyLoanCapitalizedInterest,$propertyLandCostPercentage/100);
					$propertyBuildingCapitalizedInterest = HArr::MultiplyWithNumber($propertyLoanCapitalizedInterest,$propertyBuildingCostPercentage/100);
					$propertyFFECapitalizedInterest = HArr::MultiplyWithNumber($propertyLoanCapitalizedInterest,$propertyFfeCostPercentage/100);
					
					
					$propertyLoanEndBalanceAtStudyEndBalance = $propertyLoanCalculations['endBalance'][$hospitalitySector->getStudyEndDateFormatted()] ?? 0;
					$propertyLoanEndBalance = $propertyLoanCalculations['endBalance'] ;

					$propertyLoanInstallment['Property Loan Installment'] = $propertyLoanCalculations['schedulePayment']??[];
					$propertyLoanInstallment['Property Loan Installment'] = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyLoanInstallment['Property Loan Installment'],$datesAsStringAndIndex);
				}
			}
		}

		if ($acquisition) {
			// land loan Equity Payment
			$purchaseDate = $acquisition->getLandPurchaseDateFormatted();
			$purchaseDateAsIndex = $dateWithDateIndex[$purchaseDate];
			$totalLandPurchaseCost = $acquisition->getTotalPurchaseCost();
			$paymentMethodType = $acquisition->getLandPaymentMethod();
			$downPaymentOneRate = $acquisition->getFirstLandDownPaymentPercentage();
			$balanceRate = $acquisition->getLandBalanceRate();
			$installmentCount = $acquisition->getLandInstallmentCount();
			$installmentInterval = $acquisition->getLandInstallmentInterval();
			$downPaymentTwoRate = $acquisition->getSecondLandDownPaymentPercentage();
			$landAfterMonths = $acquisition->getLandAfterMonthDays();
			$equityFundingRate = $acquisition->getLandEquityFundingRate();
			$hardEquityFundingRate = $acquisition->getHardEquityFunding();
			$customCollectionPolicyValue = $acquisition->getLandCustomCollectionPolicyValue();
			$landPayments['Land Payments'] = $landAcquisitionCostAndPaymentService->calculateLandPayments($purchaseDateAsIndex, $totalLandPurchaseCost, $paymentMethodType, $downPaymentOneRate, $balanceRate, $installmentCount, $installmentInterval, $downPaymentTwoRate, $landAfterMonths, $customCollectionPolicyValue,$datesAsStringAndIndex, $dateIndexWithDate,$dateWithDateIndex,$hospitalitySector);
			$landEquityPayment['Land Equity Injection'] = $landAcquisitionCostAndPaymentService->calculateLandEquityPayment($landPayments['Land Payments'], $totalLandPurchaseCost, $equityFundingRate);
			$landLoanWithdrawal['Land Loan Withdrawal']=$landAcquisitionCostAndPaymentService->calculateLandLoanWithdrawal($landPayments['Land Payments'], $totalLandPurchaseCost, $equityFundingRate);


			$loanForLand = $acquisition->getLoanForSection(LAND_LOAN);
			if ($loanForLand) {
				$landLoanType = $loanForLand->getLoanType();
				$landBaseRate = $loanForLand->getBaseRate();
				$landMarginRate = $loanForLand->getMarginRate();
				$landTenor = $loanForLand->getTenor();
				$landInstallmentIntervalName = $loanForLand->getInstallmentInterval();
				$landStepUpRate=$loanForLand->getStepUpRate();
				$landStepUpIntervalName=$loanForLand->getStepUpIntervalName();
				$landStepDownRate=$loanForLand->getStepDownRate();
				$landStepDownIntervalName=$loanForLand->getStepDownIntervalName();
				$landGracePeriod=$loanForLand->getGracePeriod();
			
				$landLoanPricing = $loanForLand->getPricing(); 

				$landWithdrawal=$loanWithdrawalService->__calculate($hospitalitySector->replaceIndexWithItsStringDate($landLoanWithdrawal['Land Loan Withdrawal'],$dateIndexWithDate), $landBaseRate, $landMarginRate, $dateWithDateIndex);
				$landLoanStartDate =array_key_last($landWithdrawal);
				$landLoanWithdrawalEndBalance = $landWithdrawal['withdrawalEndBalance']??[];
				$landLoanWithdrawalAmounts = $landWithdrawal['loanWithdrawal']??[];
				
				
				$landLoanAmount = $landWithdrawal[$landLoanStartDate];
				if ($landLoanStartDate) {
					$landLoanCalculations = $fixedLoanAtEndService->__calculate($landLoanType, $landLoanStartDate, $landLoanAmount, $landBaseRate, $landMarginRate, $landTenor, $landInstallmentIntervalName, $landStepUpRate, $landStepUpIntervalName, $landStepDownRate, $landStepDownIntervalName, $landGracePeriod);
					$landLoanInterestAmounts = $landLoanCalculations['interestAmount'] ?? [];
					$landLoanCapitalizedInterest = HArr::getIndexesBeforeDateOrNumericIndex($landLoanInterestAmounts , $operationStartDateAsString);
			
					$landLoanEndBalanceAtStudyEndDate = $landLoanCalculations['endBalance'][$hospitalitySector->getStudyEndDateFormatted()] ?? 0;
					$landLoanEndBalance =  $landLoanCalculations['endBalance'] ??[];
					$landLoanInstallment['Land Loan Installment'] = $landLoanCalculations['schedulePayment']??[];
					$landLoanInstallment['Land Loan Installment'] = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($landLoanInstallment['Land Loan Installment'],$datesAsStringAndIndex);
				}
			}



			// hard Construction Equity Payment



			$hardConstructionCost = $acquisition->getHardConstructionCost();
			$hardContingencyRate = $acquisition->getHardConstructionContingencyRate();
			$hardConstructionStartDateAsString = $acquisition->getHardConstructionStartDateFormatted($hospitalitySector);
			$hardConstructionStartDateAsIndex = $dateWithDateIndex[$hardConstructionStartDateAsString];
			$duration = $acquisition->getHardConstructionDuration();
			$hardExecutionMethod = $acquisition->getHardExecutionMethod();
			$downPaymentRateOne  = $acquisition->getHardDownPaymentPercentage();
			$hardConstructionCollectionPolicyValue  = $acquisition->getHardCollectionPolicyValue();
			$downPaymentRateOne  = $acquisition->getHardDownPaymentPercentage();
			$constructionExecutionAndPayment =$constructionExecutionAndPaymentService->__calculate($hardConstructionCost, $hardContingencyRate, $hardConstructionStartDateAsIndex, $duration, $hardExecutionMethod,$dateIndexWithDate, $hospitalitySector);

			$contractPayments['Hard Construction Payment'] = $contractPaymentService->__calculate($hardConstructionCost, $hardContingencyRate, $constructionExecutionAndPayment, $hardConstructionStartDateAsIndex, $downPaymentRateOne, $hardConstructionCollectionPolicyValue,$dateIndexWithDate, $dateWithDateIndex);
			$hardConstructionEquityPayment['Hard Construction Equity Injection'] = $constructionExecutionAndPaymentService->calculateHardConstructionEquityPayment($contractPayments['Hard Construction Payment'], $hardConstructionCost, $hardContingencyRate, $hardEquityFundingRate);
			$hardConstructionLoanWithdrawal['Hard Construction Loan Withdrawal'] = $constructionExecutionAndPaymentService->calculateHardConstructionLoanWithdrawal($contractPayments['Hard Construction Payment'], $hardConstructionCost, $hardContingencyRate, $hardEquityFundingRate);


			$loanForHardConstructionCost = $acquisition->getLoanForSection(HARD_COST_CONSTRUCTION);
			if ($loanForHardConstructionCost) {
				$hardLoanType = $loanForHardConstructionCost->getLoanType();
				$hardBaseRate = $loanForHardConstructionCost->getBaseRate();
				$hardMarginRate = $loanForHardConstructionCost->getMarginRate();
				$hardTenor = $loanForHardConstructionCost->getTenor();
				$hardInstallmentIntervalName = $loanForHardConstructionCost->getInstallmentInterval();
				$hardStepUpRate=$loanForHardConstructionCost->getStepUpRate();
				$hardStepUpIntervalName=$loanForHardConstructionCost->getStepUpIntervalName();
				$hardStepDownRate=$loanForHardConstructionCost->getStepDownRate();
				$hardStepDownIntervalName=$loanForHardConstructionCost->getStepDownIntervalName();
				$hardGracePeriod=$loanForHardConstructionCost->getGracePeriod();
				$hardLoanPricing = $loanForHardConstructionCost->getPricing();
				$loanWithdrawalService = new CalculateLoanWithdrawal();
				$hardLoanWithdrawal=$loanWithdrawalService->__calculate($hospitalitySector->replaceIndexWithItsStringDate($hardConstructionLoanWithdrawal['Hard Construction Loan Withdrawal'],$dateIndexWithDate), $hardBaseRate, $hardMarginRate, $dateWithDateIndex);
				$hardLoanWithdrawalEndBalance = $hardLoanWithdrawal['withdrawalEndBalance'];
				$hardLoanWithdrawalAmounts = $hardLoanWithdrawal['loanWithdrawal'];
				$hardWithdrawalInterestAmounts =$hardLoanWithdrawal['withdrawal_interest_amounts'];
				$hardLoanStartDate =array_key_last($hardLoanWithdrawal);
				$hardLoanAmount = $hardLoanWithdrawal[$hardLoanStartDate];
				if ($hardLoanStartDate) {
					$hardConstructionLoanCalculations = $fixedLoanAtEndService->__calculate($hardLoanType, $hardLoanStartDate, $hardLoanAmount, $hardBaseRate, $hardMarginRate, $hardTenor, $hardInstallmentIntervalName, $hardStepUpRate, $hardStepUpIntervalName, $hardStepDownRate, $hardStepDownIntervalName, $hardGracePeriod);
					$hardConstructionLoanInterestAmounts = $hardConstructionLoanCalculations['interestAmount'] ?? [];
					$hardConstructionLoanEndBalance = $hardConstructionLoanCalculations['endBalance'] ;
					$hardConstructionLoanEndBalanceAtStudyEndDate = $hardConstructionLoanCalculations['endBalance'][$hospitalitySector->getStudyEndDateFormatted()] ?? 0;
					$hardConstructionLoanInstallment['Hard Construction Loan Installment'] = $hardConstructionLoanCalculations['schedulePayment']??[];
					$hardConstructionLoanInstallment['Hard Construction Loan Installment'] = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($hardConstructionLoanInstallment['Hard Construction Loan Installment'],$datesAsStringAndIndex);
				}
			}

			// soft construction equity injection


			$softConstructionCost = $acquisition->getSoftConstructionCost();
			$softContingencyRate = $acquisition->getSoftConstructionContingencyRate();
			$softConstructionStartDateAsString = $acquisition->getSoftConstructionStartDateFormatted($hospitalitySector);
			$softConstructionStartDateAsIndex = $dateWithDateIndex[$softConstructionStartDateAsString];
			$duration = $acquisition->getSoftConstructionDuration();
			$softExecutionMethod = $acquisition->getSoftExecutionMethod();
			$downPaymentRateOne  = $acquisition->getSoftDownPaymentPercentage();
			$softConstructionCollectionPolicyValue  = $acquisition->getSoftCollectionPolicyValue();
			$downPaymentRateOne  = $acquisition->getSoftDownPaymentPercentage();
			$softEquityFundingRate = $acquisition->getSoftEquityFundingRate();
			$softConstructionExecutionAndPayment =$softConstructionExecutionAndPaymentService->__calculate($softConstructionCost, $softContingencyRate, $softConstructionStartDateAsIndex, $duration, $softExecutionMethod,$dateIndexWithDate, $hospitalitySector);
			$contractPayments['Soft Construction Payment'] = $contractPaymentService->__calculate($softConstructionCost, $softContingencyRate, $softConstructionExecutionAndPayment, $softConstructionStartDateAsIndex, $downPaymentRateOne, $softConstructionCollectionPolicyValue,$dateIndexWithDate, $dateWithDateIndex);
			$softConstructionEquityPayment['Soft Construction Equity Injection'] = $softConstructionExecutionAndPaymentService->calculateSoftConstructionEquityPayment($contractPayments['Soft Construction Payment'], $softConstructionCost, $softContingencyRate, $softEquityFundingRate);
		}
		$ffe = $hospitalitySector->ffe;

		if ($ffe) {
			$totalFFECost = $ffe->getTotalItemsCost();
			$ffeStartDateAsString = $ffe->getStartDateFormatted($hospitalitySector);
			$ffeStartDateAsIndex = $dateWithDateIndex[$ffeStartDateAsString];
			$duration = $ffe->getDuration();
			$ffeExecutionMethod = $ffe->getExecutionMethod();
			$downPaymentRateOne  = $ffe->getDownPaymentPercentage();
			$ffeCollectionPolicyValue  = $ffe->getCollectionPolicyValue();
			$downPaymentRateOne  = $ffe->getDownPaymentPercentage();
			$ffeEquityFundingRate = $ffe->getEquityFunding();

			$executionAndPayment =$ffeExecutionAndPaymentService->__calculate($totalFFECost, $ffeStartDateAsIndex, $duration, $ffeExecutionMethod,$dateIndexWithDate, $hospitalitySector);
			$contractPayments['FFE Payment'] = $contractPaymentService->__calculate($totalFFECost, 0, $executionAndPayment, $ffeStartDateAsIndex, $downPaymentRateOne, $ffeCollectionPolicyValue,$dateIndexWithDate, $dateWithDateIndex);
			$ffeEquityPayment['FFE Equity Injection'] = $ffeExecutionAndPaymentService->calculateFFEEquityPayment($contractPayments['FFE Payment'], $totalFFECost, 0, $ffeEquityFundingRate);
			$ffeLoanWithdrawal['FFE Loan Withdrawal'] = $ffeExecutionAndPaymentService->calculateFFELoanWithdrawal($contractPayments['FFE Payment'], $totalFFECost, 0, $ffeEquityFundingRate);


			$loanForFFECost = $ffe->getLoanForSection(FFE_COST);

			if ($loanForFFECost) {
				$ffeLoanType = $loanForFFECost->getLoanType();
				$ffeBaseRate = $loanForFFECost->getBaseRate();
				$ffeMarginRate = $loanForFFECost->getMarginRate();
				$ffeTenor = $loanForFFECost->getTenor();
				$ffeInstallmentIntervalName = $loanForFFECost->getInstallmentInterval();
				$ffeStepUpRate=$loanForFFECost->getStepUpRate();
				$ffeStepUpIntervalName=$loanForFFECost->getStepUpIntervalName();
				$ffeStepDownRate=$loanForFFECost->getStepDownRate();
				$ffeStepDownIntervalName=$loanForFFECost->getStepDownIntervalName();
				$ffeGracePeriod=$loanForFFECost->getGracePeriod();
				$ffeLoanPricing = $loanForFFECost->getPricing();
				$loanWithdrawalService = new CalculateLoanWithdrawal();
				$ffeLoanWithdrawalInterest=$loanWithdrawalService->__calculate($hospitalitySector->replaceIndexWithItsStringDate($ffeLoanWithdrawal['FFE Loan Withdrawal'],$dateIndexWithDate), $ffeBaseRate, $ffeMarginRate, $dateWithDateIndex);
				$ffeLoanStartDate =array_key_last($ffeLoanWithdrawalInterest);
				$ffeLoanAmount = $ffeLoanWithdrawalInterest[$ffeLoanStartDate];
				$ffeLoanWithdrawalInterestAmounts =$ffeLoanWithdrawalInterest['withdrawal_interest_amounts']??[];
				$ffeLoanWithdrawalEndBalance = $ffeLoanWithdrawalInterest['withdrawalEndBalance']??[];
				$ffeLoanWithdrawalAmounts = $ffeLoanWithdrawalInterest['loanWithdrawal']??[];


				if ($ffeLoanStartDate) {
					$ffeLoanCalculations = $fixedLoanAtEndService->__calculate($ffeLoanType, $ffeLoanStartDate, $ffeLoanAmount, $ffeBaseRate, $ffeMarginRate, $ffeTenor, $ffeInstallmentIntervalName, $ffeStepUpRate, $ffeStepUpIntervalName, $ffeStepDownRate, $ffeStepDownIntervalName, $ffeGracePeriod);
					$ffeLoanInterestAmounts = $ffeLoanCalculations['interestAmount'] ?? [];
					$ffeLoanEndBalanceAtStudyEndDate = $ffeLoanCalculations['endBalance'][$hospitalitySector->getStudyEndDateFormatted()] ?? 0;
					$ffeLoanEndBalance = $ffeLoanCalculations['endBalance'];
					$ffeLoanInstallment['FFE Loan Installment'] = $ffeLoanCalculations['schedulePayment']??[];
					$ffeLoanInstallment['FFE Loan Installment'] = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($ffeLoanInstallment['FFE Loan Installment'],$datesAsStringAndIndex);
				}
			}
		}

		return [
			'totalPropertyPurchaseCost'=>$totalPropertyPurchaseCost??0,
			'propertyEquityPayment'=>$propertyEquityPayment,
			'propertyLoanWithdrawal'=>$propertyLoanWithdrawal,
			'propertyPayments'=>$propertyPayments,
			'propertyLoanInstallment'=>$propertyLoanInstallment,
			'propertyLoanInterestAmounts'=>$propertyLoanInterestAmounts,
			'propertyLoanWithdrawalInterest'=>$propertyLoanWithdrawalInterestAmounts??[],



			'totalLandPurchaseCost'=>$totalLandPurchaseCost??0,
			'landEquityPayment'=>$landEquityPayment,
			'landLoanWithdrawal'=>$landLoanWithdrawal,
			'landPayments'=>$landPayments,
			'landLoanInstallment'=>$landLoanInstallment,
			'landLoanInterestAmounts'=>$landLoanInterestAmounts??[],
			'landLoanEndBalanceAtStudyEndDate'=>$landLoanEndBalanceAtStudyEndDate,



			'contractPayments'=>$contractPayments,

			'hardConstructionEquityPayment'=>$hardConstructionEquityPayment,
			'hardConstructionLoanWithdrawal'=>$hardConstructionLoanWithdrawal,
			'hardConstructionLoanInstallment'=>$hardConstructionLoanInstallment,
			'hardConstructionLoanInterestAmounts'=>$hardConstructionLoanInterestAmounts,
			'hardConstructionExecutionAndPayment'=>$constructionExecutionAndPayment ??[],
			'hardWithdrawalInterestAmounts'=>$hardWithdrawalInterestAmounts??[],

			'softConstructionEquityPayment'=>$softConstructionEquityPayment??[],
			'softConstructionExecutionAndPayment'=>$softConstructionExecutionAndPayment??[],

			'ffeEquityPayment'=>$ffeEquityPayment,
			'ffeLoanWithdrawal'=>$ffeLoanWithdrawal,
			'ffeLoanInstallment'=>$ffeLoanInstallment,
			'ffeLoanInterestAmounts'=>$ffeLoanInterestAmounts,
			'ffeExecutionAndPayment'=>$executionAndPayment??[],
			'ffeLoanWithdrawalInterest'=>$ffeLoanWithdrawalInterestAmounts??[],
			'propertyLoanStartDate'=>$propertyLoanStartDate ,
			'propertyLoanAmount'=>$propertyLoanAmount,
			'propertyLoanEndBalanceAtStudyEndBalance'=>$propertyLoanEndBalanceAtStudyEndBalance,
			'landLoanStartDate'=>$landLoanStartDate,
			'landLoanAmount'=>$landLoanAmount,
			'hardLoanStartDate'=>$hardLoanStartDate,
			'hardLoanAmount'=>$hardLoanAmount,
			'hardConstructionLoanEndBalanceAtStudyEndDate'=>$hardConstructionLoanEndBalanceAtStudyEndDate,
			'ffeLoanStartDate'=>$ffeLoanStartDate,
			'ffeLoanAmount'=>$ffeLoanAmount,
			'ffeLoanEndBalanceAtStudyEndDate'=>$ffeLoanEndBalanceAtStudyEndDate,
			'propertyLoanPricing'=>$propertyLoanPricing ,
			'landLoanPricing'=>$landLoanPricing ,
			'hardLoanPricing'=>$hardLoanPricing ,
			'ffeLoanPricing'=>$ffeLoanPricing ,
			
			
			'propertyLoanEndBalance'=>$propertyLoanEndBalance,
			'hardConstructionLoanEndBalance'=>$hardConstructionLoanEndBalance,
			'landLoanEndBalance'=>$landLoanEndBalance,
			'ffeLoanEndBalance'=>$ffeLoanEndBalance,
			
			'hardLoanWithdrawalEndBalance'=>$hardLoanWithdrawalEndBalance ,
			'ffeLoanWithdrawalEndBalance'=>$ffeLoanWithdrawalEndBalance,
			'propertyLoanWithdrawalEndBalance'=>$propertyLoanWithdrawalEndBalance ,
			'landLoanWithdrawalEndBalance'=>$landLoanWithdrawalEndBalance ,
			'hardLoanWithdrawalAmounts'=>$hardLoanWithdrawalAmounts ,
			'ffeLoanWithdrawalAmounts'=>$ffeLoanWithdrawalAmounts ,
			'propertyLoanWithdrawalAmounts'=>$propertyLoanWithdrawalAmounts ,
			'landLoanWithdrawalAmounts'=>$landLoanWithdrawalAmounts ,
			
			'propertyLandCapitalizedInterest'=>$propertyLandCapitalizedInterest  ,
			'propertyBuildingCapitalizedInterest'=>$propertyBuildingCapitalizedInterest  ,
			'propertyFFECapitalizedInterest'=>$propertyFFECapitalizedInterest  ,
			
			
			'landLoanCapitalizedInterest'=>$landLoanCapitalizedInterest,
			
			
			
			'propertyLoanCalculations'=>$propertyLoanCalculations??[] ,
			'landLoanCalculations'=>$landLoanCalculations??[],
			'hardConstructionLoanCalculations' =>$hardConstructionLoanCalculations??[],
			'ffeLoanCalculations'=>$ffeLoanCalculations??[]
			

		];



		// period == tenor
		// duration == interval == $appliedStepValue
	}
	
}
