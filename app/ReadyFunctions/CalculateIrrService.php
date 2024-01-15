<?php

namespace App\ReadyFunctions;

class CalculateIrrService
{
	public function calculateIrr($annual_free_cash_array, $discount_rate, $cash_and_loans, $net_present_value, $calculatedPercentage = null, $numberOfIteration = 1)
	{

		$discount_rate = $discount_rate/ 100 ;
		$yearsAndFreeCash = $annual_free_cash_array;
		// = [
		//     1=>-5000000 ,
		//     2=>3000000 ,
		//     3=>4500000,
		//     4=>15000000 ,
		//     5=>125000000,
		//     // 6=>1545132872.40807
		// ];

		if ($numberOfIteration == 1 && ($this->checkIfArrayAllIsAllNegative($yearsAndFreeCash) || $this->checkIfArrayAllIsAllPositive($yearsAndFreeCash))) {
			return 'No IRR';
		}


		$percentage = $calculatedPercentage ?: $discount_rate;
		$discountFactor = [];
		$npv = [];
		$year = 1 ;
		foreach ($yearsAndFreeCash as $date => $freshCash) {
			$discountFactor[$year] = pow(1  +  $percentage, $year);
			$npv[$year] = $freshCash / $discountFactor[$year];
			$year++ ;
		}

		$npv_sum = array_sum($npv) + $cash_and_loans;

		if ($numberOfIteration == 750000) {
			return $calculatedPercentage;
		}
		// need to make $npv_sum = 0 by changing  $percentage  to get irr
		if ($net_present_value >= 0) {
			while ((!($npv_sum <= $net_present_value * 0.000001))) {
				if ($npv_sum > 0) {
					$irr = $percentage  + 0.00001;

					return $this->calculateIrr($annual_free_cash_array, $discount_rate, $cash_and_loans, $net_present_value, $irr, ++$numberOfIteration);
				}
			}
		} elseif ($net_present_value < 0) {
			while ((!($npv_sum >= $net_present_value * -0.000001))) {
				if ($npv_sum < 0) {
					$irr = $percentage - 0.00001;

					return $this->calculateIrr($annual_free_cash_array, $discount_rate, $cash_and_loans, $net_present_value, $irr, ++$numberOfIteration);
				}
			}
		}

		return $calculatedPercentage;
	}

	protected function checkIfArrayAllIsAllPositive(array $array)
	{
		$positiveNumbers = array_filter($array, function ($val) {
			return $val >= 0;
		});

		return count($positiveNumbers) == count($array);
	}

	protected  function checkIfArrayAllIsAllNegative(array $array)
	{
		$negativeNumbers = array_filter($array, function ($val) {
			return $val <= 0;
		});

		return count($negativeNumbers) == count($array);
	}
	public function calculateNetPresentValue(array $freeCashFlow , float $costOfFundRate):float 
	{
		$netPresentValues =   [];
		$costOfFundRate = $costOfFundRate / 100 ; 
		$index = 1 ;
		foreach ($freeCashFlow  as $date => $value){
			$pow = (pow((1+$costOfFundRate) , $index)) ;
			// dump('index = ' , $index , ' pow = ' ,$pow , 'and val' , $value , 'and result ' , );
			$netPresentValues[$date] = $value / (pow((1+$costOfFundRate) , $index));
			$index++;
		}
		return array_sum($netPresentValues) ; 
	}
	
}
