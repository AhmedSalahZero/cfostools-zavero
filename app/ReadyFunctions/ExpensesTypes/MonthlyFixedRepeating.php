<?php
namespace App\ReadyFunctions\ExpensesTypes;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class MonthlyFixedRepeating
{
	public function calculate(Collection $expenseItems, $dates,array $dateIndexWithMonthNumber,array $dateWithMonthNumber)
	
	{
		$result = [];
		foreach ($expenseItems as $expenseItem) {
			$power = 0;
			$canIncreasePower = false;
			$baseValue =  $expenseItem->getMonthlyAmount() ?: 0;
			$expenseStartDate = Carbon::make($expenseItem->getStartDateFormatted())->format('d-m-Y');
			$monthOfIncreasing  = $dateWithMonthNumber[$expenseStartDate];
			$percentage =  $expenseItem->getIncreaseRate();
			foreach ($dates as $date) {
				$loopMonth = $dateIndexWithMonthNumber[$date];
				if ($monthOfIncreasing == $loopMonth) {
					if ($canIncreasePower) {
						$power = $power + 1;
					}
					$canIncreasePower = true;
				}
				$result[$expenseItem->id][$date] = applyInflationRate($baseValue, $percentage, $power);
			}
		}
		
		// dd($dateWithMonthNumber[$expenseStartDate]);
		return $result;
	}
}
