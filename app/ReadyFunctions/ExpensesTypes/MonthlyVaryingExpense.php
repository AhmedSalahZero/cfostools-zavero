<?php
namespace App\ReadyFunctions\ExpensesTypes;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class MonthlyVaryingExpense
{
	public function calculate(Collection $expenseItems,Carbon $studyEndDate,array $dateWithDateIndex )
	{
	
		$result = [];
		$baseValue = 0 ;
		foreach ($expenseItems as $expenseItem) {
			$expenseStartDate = Carbon::make($expenseItem->getStartDateFormatted());
			$dates = generateDatesBetweenTwoDates($expenseStartDate,$studyEndDate,'addMonth','d-m-Y');
			foreach ($dates as $dateString) {
				$dateAsIndex =$dateWithDateIndex[$dateString] ?? null ;
				$baseValue =  $expenseItem->getPayloadAtDate($dateAsIndex) ;
				$baseValue = $expenseItem->is_deductible == 0 ? $baseValue * (1+$expenseItem->getVatRate() / 100) : $baseValue;
				$result[$expenseItem->id][$dateString] = $baseValue;
			}
		}
		return $result;
	}
	
}
