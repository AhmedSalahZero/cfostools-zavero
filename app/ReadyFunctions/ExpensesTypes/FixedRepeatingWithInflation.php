<?php
namespace App\ReadyFunctions\ExpensesTypes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class FixedRepeatingWithInflation
{
	public function calculate(Collection $expenseItems,string $intervalName,Carbon $studyEndDate )
	
	{
		$intervalDuration = [
			'monthly'=>1 , 
			'quarterly'=>3 ,
			'semi-annually'=>6,
			'annually'=>12 
		][$intervalName];
		$power=0;
		$result = [];
		foreach ($expenseItems as $expenseItem) {
			$baseValue =  $expenseItem->getMonthlyAmount() ?: 0;
			$baseValue = $expenseItem->is_deductible == 0 ? $baseValue * (1+$expenseItem->getVatRate() / 100) : $baseValue;
			$expenseStartDate = Carbon::make($expenseItem->getStartDateFormatted());
			$dates = generateDatesBetweenTwoDates($expenseStartDate,$studyEndDate,'addMonth','d-m-Y');
			$percentage =  $expenseItem->getIncreaseRate() / (12 / $intervalDuration);
			$monthsOfInflation = $expenseStartDate->addMonths($intervalDuration)->format('d-m-Y');
			foreach ($dates as $dateString) {
				if ($monthsOfInflation == $dateString) {
						$power = $power + 1;
					$monthsOfInflation = Carbon::make($monthsOfInflation)->addMonths($intervalDuration)->format('d-m-Y');
				}
				$result[$expenseItem->id][$dateString] = applyInflationRate($baseValue, $percentage, $power);
			}
		}
		return $result;
	}
	
}
