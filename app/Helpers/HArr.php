<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;

class HArr
{
	public static function sumAtDates(array $items, array $dates)
	{
		$itemsCount = count($items);
		if (!$itemsCount) {
			return [];
		}
		if (!isset($items[0])) {
			throw new Exception('Custom Exception .. First Parameter Must Be Indexes Array That Contains Arrays like [ [] , [] , [] ]');
		}

		$total = [];
		foreach ($dates as $date) {
			$currenTotal = 0;
			for ($i = 0; $i< $itemsCount; $i++) {
				$currenTotal+=$items[$i][$date]??0;
			}
			$total[$date] = $currenTotal;
		}

		return $total;
	}

	public static function subtractAtDates(array $items, array $dates)
	{
		$itemsCount = count($items);
		if (!$itemsCount) {
			return [];
		}
		if (!isset($items[0])) {
			throw new Exception('Custom Exception .. First Parameter Must Be Indexes Array That Contains Arrays like [ [] , [] , [] ]');
		}

		$total = [];
		foreach ($dates as $date) {
			$currenTotal = 0;
			for ($i = 0; $i< $itemsCount; $i++) {
				if ($i == 0) {
					$currenTotal += $items[$i][$date]??0;
				} else {
					$currenTotal -= $items[$i][$date]??0;
				}
			}
			$total[$date] = $currenTotal;
		}

		return $total;
	}
	
	public static function multipleAtDates(array $items, array $dates)
	{
		$itemsCount = count($items);
		if (!$itemsCount) {
			return [];
		}
		if (!isset($items[0])) {
			throw new Exception('Custom Exception .. First Parameter Must Be Indexes Array That Contains Arrays like [ [] , [] , [] ]');
		}

		$total = [];
		foreach ($dates as $date) {
			$currenTotal = 1;
			for ($i = 0; $i< $itemsCount; $i++) {
					$currenTotal *= $items[$i][$date]??0;
			}
			$total[$date] = $currenTotal;
		}
		return $total;
	}
	
	
	

	public static function fillMissedKeysFromPreviousKeys(array $items, array $dates, $defaultValue = 0)
	{
		$previousValue = $defaultValue;
		$newItems = [];
		foreach ($dates as $date) {
			if (isset($items[$date])) {
				$previousValue = $items[$date];
				$newItems[$date] = $items[$date];
			} else {
				$newItems[$date] = $previousValue;
			}
		}

		return $newItems;
	}

	public static function accumulateArray(array $items)
	{
		$result =[];
		$finalResult =[];
		$index = 0;
		foreach ($items as $date=>$value) {
			$previousValue = $result[$index-1] ??0;
			$currentVal = $previousValue + $value;
			$result[$index] = $currentVal;
			$finalResult[$date] = $currentVal;
			$index++;
		}

		return $finalResult;
	}
	public static function MultiplyWithNumber(array $items , float $number)
	{
		$newItems = [];
		foreach($items as $key=>$value){
			$newItems[$key]=$value * $number ;
		}
		return $newItems ;
	}

	public static function getIndexesBeforeDateOrNumericIndex(array $items, string $index, $indexIsDate = true)
	{
		$result = [];
		foreach ($items as $date => $value) {
			if ($indexIsDate ? Carbon::make($date)->lessThan(Carbon::make($index)) : $date < $index) {
				$result[$date]=$value;
			}
		}

		return $result;
	}
	public static function filterBasedOnCondition(array $items , string $condition , float $val1  , float $val2 = null  ){
		/**
		 * *note in case of [between] val1 must be the greater number [greater than val2] 
		 */

		 $result = [];
		 foreach($items as $key=>$value){
			if($condition == 'greater_than'){
				$result[$key] = $value > $val1 ? $value : 0 ;
			}
			elseif($condition == 'greater_than_or_equal'){
				$result[$key] = $value >= $val1 ? $value : 0 ;
			}
			elseif($condition == 'less_than'){
				$result[$key] = $value < $val1 ? $value : 0 ;
			}
			elseif($condition == 'less_than_or_equal'){
				$result[$key] = $value <= $val1 ? $value : 0 ;
			}
			elseif($condition == 'between_and_equal'){
				$result[$key] = $value <= $val1 && $value >= $val2 ? $value : 0;
			}
			elseif($condition == 'between'){
				$result[$key] = $value < $val1 && $value > $val2 ? $value : 0;
			}
			elseif($condition == 'equal'){
				$result[$key] = $value== $val1  ? $value : 0;
			}
			
		}			
		return $result;
	}
	public static function getKeyFromMultiArr(array $items , array $keys,$onlyNumericMainKeys=true){
		$newItems = [];
		foreach($items as $id => $arr){
			if($onlyNumericMainKeys && !is_numeric($id)){
				continue ;
			}
			foreach($arr as $k2 => $v){
				if(in_array($k2,$keys)){
					$newItems[$id][$k2] = $v;
				}
			}
			
		}
		return $newItems ;
	}
}
