<?php
namespace App\ReadyFunctions\ExpensesTypes;

use App\Helpers\HArr;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class IntervallyRepeatingAmount
{
	public function calculate(Collection $expenseItems,Carbon $studyEndDate )
	
	{
	
		$power=0;
		$result = [];
		foreach ($expenseItems as $expenseItem) {
			$baseValue =  $expenseItem->getMonthlyAmount() ?: 0;
			$baseValue = $expenseItem->is_deductible == 0 ? $baseValue * (1+$expenseItem->getVatRate() / 100) : $baseValue;
			
			$expenseStartDate = Carbon::make($expenseItem->getStartDateFormatted());
			$dates = generateDatesBetweenTwoDates($expenseStartDate,$studyEndDate,'addMonth','d-m-Y');
			// dd('e');
			$repeatedBaseValue = $this->repeatValueAtDates($baseValue,$dates,$expenseItem->getInterval()); 
			
			$stepFactor = $this->calculateStepFactor($repeatedBaseValue , $expenseItem->getIncreaseInterval() , $expenseItem->getIncreaseRate());
			$result[$expenseItem->id] = HArr::multipleAtDates([$repeatedBaseValue,$stepFactor],$dates);
		}
		return $result;
	}
	protected function repeatValueAtDates(float $value,array $dates,string $repeatingInterval ):array{
		$repeatingInterval = $repeatingInterval + 0 ;
		// $repeatingInterval = $repeatingInterval + 1 ;
		$index = $repeatingInterval  ;
		$result = [];
		foreach($dates as $date){
			$result[$date] =  $index == $repeatingInterval  ?  $value : 0 ;
			if($index == $repeatingInterval ){
				$index = 1 ;
			}else{
				$index++ ;
			}
		}
		return $result ;
	}
	protected function calculateStepFactor(array $items , string $increaseInterval,float $increaseRate )
	{
		$increaseRate = $increaseRate / 100 ;
		$intervalDuration = [
			'monthly'=>1 ,
			'quarterly'=>3 ,
			'semi-annually'=>6 ,
			'annually'=>12
		][$increaseInterval];
		// $intervalDuration = 2;
		$stepFactor = [];
		
		$index = 0 ; 
		
		$previousValue = 1 ;
		foreach($items as $date => $value){
			$stepFactor[$date] = $index == $intervalDuration ? $previousValue + ($previousValue * $increaseRate)  : $previousValue ;
			$previousValue = $stepFactor[$date];
			if($index == $intervalDuration){
				$index = 1 ;	
			} else{
				$index ++ ;
			}
			
		}
		return $stepFactor;
		// dd($stepFactor);
		
	}
	
}
