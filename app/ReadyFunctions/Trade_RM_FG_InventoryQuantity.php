<?php

namespace App\ReadyFunctions;

use App\Helpers\HArr;
use App\Models\HospitalitySector;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class Trade_RM_FG_InventoryQuantity
{
	public function coverageDurationInMonths($days)
	{
		$coverage_duration = 0;
		if ($days == 7) {
			$coverage_duration = 0.25;
		} elseif ($days == 15) {
			$coverage_duration = 0.5;
		} elseif ($days == 30) {
			$coverage_duration = 1;
		} elseif ($days == 45) {
			$coverage_duration = 1.5;
		} elseif ($days == 60) {
			$coverage_duration = 2;
		} elseif ($days == 75) {
			$coverage_duration = 2.5;
		} elseif ($days == 90) {
			$coverage_duration = 3;
		} elseif ($days == 120) {
			$coverage_duration = 4;
		} elseif ($days == 150) {
			$coverage_duration = 5;
		} elseif ($days == 180) {
			$coverage_duration = 6;
		}
		return $coverage_duration;
	}
	public function calculateTradeRawMaterialRMAndFinishedGodsFGQuantity(string $modelType,array $sold_quantity_or_raw_material_quantities,array $goodsInTransitQuantity ,array $dateIndexWithDate,array $dateWithDateIndex,float $conversionRate = 1)
	{
		/**
		 * * Product Or RawMaterial [model]
		 *  */ 
		// $sold_quantity_or_raw_material_quantities 
		/*
		[
			 * 1 == $productId or RawMaterial Id
			1 => [
				'01-01-2023'=>25,
				'01-02-2023'=>26,
				'01-03-2024'=>27,
				'01-04-2024'=>28,
				'01-05-2024'=>28,
			]
		]
		*/
		
		$purchases = [];
		$ending_balances = [];
		$result = [];
		foreach ($sold_quantity_or_raw_material_quantities as $productOrRawMaterialId => $sold_quantity_or_raw_material_quantity) {
			$productOrRawMaterial = ("\App\Models\\".$modelType)::find($productOrRawMaterialId);
			if(!$productOrRawMaterial){
				dd('not found');
			}
			$inventory_coverage_days = 30;
			// $inventory_coverage_days = $productOrRawMaterial->getInventoryCoverageDays();
			$inventory_coverage_days = $this->coverageDurationInMonths($inventory_coverage_days);
			// dd($inventory_coverage_days);
			// $beginning_balance = $productOrRawMaterial->getBeginningInventoryBalanceQuantity();
			$beginning_balance =0;
			$last_12_months =  array_slice($sold_quantity_or_raw_material_quantity, -12, 12, true);
			$last_year_avg_sales =   $this->average($last_12_months);
			// dd($last_12_months);
			// last date
			$last_date = array_key_last($sold_quantity_or_raw_material_quantity);
			$last_date = $dateIndexWithDate[$last_date];
			// first month number
			$counter = 0;
			foreach ($sold_quantity_or_raw_material_quantity as $dateIndex => $value) {
				
				$goodsInTransitQuantityAtDateIndex = $goodsInTransitQuantity[$productOrRawMaterialId][$dateIndex] ?? 0 ;
				$beginning_balance =$beginning_balance+ $goodsInTransitQuantityAtDateIndex;   
				$result[$productOrRawMaterialId]['beginning_balance'][$dateIndex] = $beginning_balance;
				$result['total']['beginning_balance'][$dateIndex] = isset($result['total']['beginning_balance'][$dateIndex]) ? $result['total']['beginning_balance'][$dateIndex] +$beginning_balance : $beginning_balance;
				
				$date = $dateIndexWithDate[$dateIndex];
				// year
				// $year = date('Y', strtotime($date));

				// $dateIndex3
				$dateIndex1=$dateWithDateIndex[$this->customMonth($date, 1)];
				$dateIndex2=$dateWithDateIndex[$this->customMonth($date, 2)];
				$dateIndex3=$dateWithDateIndex[$this->customMonth($date, 3)];
				$dateIndex4=$dateWithDateIndex[$this->customMonth($date, 4)];
				$dateIndex5=$dateWithDateIndex[$this->customMonth($date, 5)];
				$dateIndex6=$dateWithDateIndex[$this->customMonth($date, 6)];
				
				// dd($sold_quantity_or_raw_material_quantity , $dateIndex1);
				$one = isset($sold_quantity_or_raw_material_quantity[$dateIndex1]) ? $sold_quantity_or_raw_material_quantity[$dateIndex1] : 0;
				// if it is the last month
				if (strtotime($last_date) == strtotime($date)) {
					$store_final_balance = $last_year_avg_sales * $inventory_coverage_days;
				} elseif ($inventory_coverage_days == 0) {
					$store_final_balance = 0;
				} elseif ($inventory_coverage_days ==  0.25) {
					$store_final_balance = $one * 0.25;
				} elseif ($inventory_coverage_days ==  0.5) {
					$store_final_balance = $one * 0.5;
				} elseif ($inventory_coverage_days == 1) {
					$store_final_balance = $one;
					// dd($store_final_balance);
				} elseif ($inventory_coverage_days == 1.5) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$store_final_balance = ($one + ($two * 0.5));
				} elseif ($inventory_coverage_days == 2) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$store_final_balance = $one + $two;
				} elseif ($inventory_coverage_days == 2.5) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$three = isset($sold_quantity_or_raw_material_quantity[$dateIndex3]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex3]) : 0;
					$store_final_balance = $one + $two + ($three * 0.5);
				} elseif ($inventory_coverage_days == 3) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$three = isset($sold_quantity_or_raw_material_quantity[$dateIndex3]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex3]) : 0;
					$store_final_balance = $one + $two + $three;
				} elseif ($inventory_coverage_days == 4) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$three = isset($sold_quantity_or_raw_material_quantity[$dateIndex3]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex3]) : 0;
					$four = isset($sold_quantity_or_raw_material_quantity[$dateIndex4]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex4]) : 0;
					$store_final_balance = $one + $two + $three + $four;
				} elseif ($inventory_coverage_days == 5) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$three = isset($sold_quantity_or_raw_material_quantity[$dateIndex3]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex3]) : 0;
					$four = isset($sold_quantity_or_raw_material_quantity[$dateIndex4]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex4]) : 0;
					$five = isset($sold_quantity_or_raw_material_quantity[$dateIndex5]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex5]) : 0;
					$store_final_balance = $one + $two + $three + $four + $five;
				} elseif ($inventory_coverage_days == 6) {
					$two = isset($sold_quantity_or_raw_material_quantity[$dateIndex2]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex2]) : 0;
					$three = isset($sold_quantity_or_raw_material_quantity[$dateIndex3]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex3]) : 0;
					$four = isset($sold_quantity_or_raw_material_quantity[$dateIndex4]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex4]) : 0;
					$five = isset($sold_quantity_or_raw_material_quantity[$dateIndex5]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex5]) : 0;
					$six = isset($sold_quantity_or_raw_material_quantity[$dateIndex6]) ? ($sold_quantity_or_raw_material_quantity[$dateIndex6]) : 0;
					$store_final_balance = $one + $two + $three + $four + $five + $six;
				}

				// Purchases

				if ($beginning_balance == 0) {
					$purchases[$productOrRawMaterialId][$dateIndex] = (($value) + $store_final_balance);
				} elseif (((($value) + $store_final_balance) - $beginning_balance) <= 0) {
					$purchases[$productOrRawMaterialId][$dateIndex] = 0;
				} else {
					$purchases[$productOrRawMaterialId][$dateIndex] = ((($value) + $store_final_balance) - $beginning_balance);
				}
	
				// Available For Sales
				$available_for_sales = $beginning_balance +  $purchases[$productOrRawMaterialId][$dateIndex];
				
			
				// Ending Balance
				$ending_balance = $available_for_sales - ($value);
				
				// Updating the Begining Balance
		
				if (isset($sold_quantity_or_raw_material_quantity[$dateIndex])) {
				// if (isset($sold_quantity_or_raw_material_quantity[$this->customMonth($dateIndex, 1)])) {
					
					$beginning_balance = $ending_balance;
				}
			
				
				$purchases[$productOrRawMaterialId][$dateIndex] = $purchases[$productOrRawMaterialId][$dateIndex];
				$ending_balances[$dateIndex] = $ending_balance;
				$result[$productOrRawMaterialId]['purchases'][$dateIndex] = $purchases[$productOrRawMaterialId][$dateIndex];
				$result['total']['purchase'][$dateIndex] = isset($result['total']['purchase'][$dateIndex]) ? $result['total']['purchase'][$dateIndex] +$purchases[$productOrRawMaterialId][$dateIndex] : $purchases[$productOrRawMaterialId][$dateIndex];
				$result[$productOrRawMaterialId]['total_available'][$dateIndex] = $available_for_sales;
				$result['total']['total_available'][$dateIndex] = isset($result['total']['total_available'][$dateIndex]) ? $result['total']['total_available'][$dateIndex] +$available_for_sales : $available_for_sales;
				
				$result[$productOrRawMaterialId]['sold_quantity_rm_dispensed_quantity'][$dateIndex] = $value;
				$result['total']['sold_quantity_rm_dispensed_quantity'][$dateIndex] = isset($result['total']['sold_quantity_rm_dispensed_quantity'][$dateIndex]) ? $result['total']['sold_quantity_rm_dispensed_quantity'][$dateIndex] +$result[$productOrRawMaterialId]['sold_quantity_rm_dispensed_quantity'][$dateIndex] : $result[$productOrRawMaterialId]['sold_quantity_rm_dispensed_quantity'][$dateIndex];
				
				$result[$productOrRawMaterialId]['end_balance'][$dateIndex] =$ending_balance;
				$result['total']['end_balance'][$dateIndex] = isset($result['total']['end_balance'][$dateIndex]) ? $result['total']['end_balance'][$dateIndex] +$ending_balance : $ending_balance;
				$total_ending_balances[$dateIndex] = isset($total_ending_balances[$dateIndex]) ? $total_ending_balances[$dateIndex] + $ending_balance : $ending_balance;
				$counter++;
			}
		}
		$total = $result['total'] ?? [];
		unset($result['total']);
		$result['total'] = $total;
		return $result ; 
	}
	public function calculateTradeRawMaterialRmAndValue(array $quantities,array $purchasePrice,float $beginningBalanceValue = 0 ,array $goodsInTransitValue = []){
		$result = [];
		foreach($quantities as $productIdOrRawMaterialId => $quantityArr){
			$purchaseCostForProductOrRM = HArr::multipleAtDates([$quantityArr['purchases'] ,$purchasePrice[$productIdOrRawMaterialId]],array_keys($quantityArr['purchases']));
			foreach($purchaseCostForProductOrRM as $dateAsIndex => $purchaseCostAtDateIndex){
				$goodsInTransitAtDateIndex = $goodsInTransitValue[$productIdOrRawMaterialId][$dateAsIndex] ?? 0 ;
				$beginningBalanceValue = $beginningBalanceValue +  $goodsInTransitAtDateIndex ; 
				$totalAvailableForSaleOrManufacturing = $beginningBalanceValue + $purchaseCostAtDateIndex ;
				$totalAvailableAtDateIndex = $quantityArr['total_available'][$dateAsIndex] ?? 0 ;
				$inventoryValuePerUnitAtDateIndex = $totalAvailableAtDateIndex ? $totalAvailableForSaleOrManufacturing / $totalAvailableAtDateIndex : 0;
				$soldQuantityOrDispensedRMAtDateIndex = $quantityArr['sold_quantity_rm_dispensed_quantity'][$dateAsIndex] ?? 0 ;
				$costOfGoodsSoldOrRMCostAtDateIndex =$inventoryValuePerUnitAtDateIndex * $soldQuantityOrDispensedRMAtDateIndex;
				$endBalanceAtDateIndex = $totalAvailableForSaleOrManufacturing - $costOfGoodsSoldOrRMCostAtDateIndex ; 
				$result[$productIdOrRawMaterialId]['beginning_balance'][$dateAsIndex] = $beginningBalanceValue ;
				$result[$productIdOrRawMaterialId]['purchase_cost'][$dateAsIndex] =$purchaseCostAtDateIndex ;
				$result[$productIdOrRawMaterialId]['total_available_value'][$dateAsIndex] =$totalAvailableForSaleOrManufacturing ;
				$result[$productIdOrRawMaterialId]['cost_of_goods_or_rm_cost'][$dateAsIndex] =$costOfGoodsSoldOrRMCostAtDateIndex ;
				$result[$productIdOrRawMaterialId]['end_balance'][$dateAsIndex] =$endBalanceAtDateIndex ;
				$beginningBalanceValue = $endBalanceAtDateIndex ;
			}
		}
		return $result;
	}
	
	public function calculateForIntervals(array $items,array $dateIndexWithDate,HospitalitySector $hospitalitySector,bool $convertIndexesToNames=false)
	{
		$result = [];
		$directExpenseName = null;
		
		unset($items['total']);
		foreach($items as $productOrRawMaterialId => $item)
		{
			if($convertIndexesToNames){
				$directExpenseName = $hospitalitySector->departmentExpenses->where('id',$productOrRawMaterialId)->first()->getName();
			}
			$resultIdentifier = $convertIndexesToNames ?$directExpenseName: $productOrRawMaterialId;
			$initialBalance = Arr::first($item['beginning_balance']);
		
			$purchases = $item['purchases'];
			$dispensedDisposableCost = $item['sold_quantity_rm_dispensed_quantity'];
			
			
			$purchasesForInterval = [
				'monthly'=>$purchases,
				'quarterly'=>sumIntervals($purchases,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
				'semi-annually'=>sumIntervals($purchases,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
				'annually'=>sumIntervals($purchases,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			];
			
			$dispensedDisposableCostForInterval = [
				'monthly'=>$dispensedDisposableCost,
				'quarterly'=>sumIntervals($dispensedDisposableCost,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
				'semi-annually'=>sumIntervals($dispensedDisposableCost,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
				'annually'=>sumIntervals($dispensedDisposableCost,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			];
			foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted){
				$beginningBalance = $initialBalance ;
				
				foreach($purchasesForInterval[$intervalName] as $dateIndex=>$purchaseAtInterval){
					$result[$resultIdentifier][$intervalName]['beginning_balance'][$dateIndex]=$beginningBalance;
					$result['total'][$intervalName]['beginning_balance'][$dateIndex] = isset($result['total'][$intervalName]['beginning_balance'][$dateIndex]) ? $result['total'][$intervalName]['beginning_balance'][$dateIndex] +  $result[$resultIdentifier][$intervalName]['beginning_balance'][$dateIndex] : $result[$resultIdentifier][$intervalName]['beginning_balance'][$dateIndex];
					$result[$resultIdentifier][$intervalName]['purchases'][$dateIndex]=$purchaseAtInterval;
					$result['total'][$intervalName]['purchases'][$dateIndex] = isset($result['total'][$intervalName]['purchases'][$dateIndex]) ? $result['total'][$intervalName]['purchases'][$dateIndex] +  $result[$resultIdentifier][$intervalName]['purchases'][$dateIndex] : $result[$resultIdentifier][$intervalName]['purchases'][$dateIndex];
					$result[$resultIdentifier][$intervalName]['total_available'][$dateIndex]=$beginningBalance + $purchaseAtInterval ;
					$result['total'][$intervalName]['total_available'][$dateIndex] = isset($result['total'][$intervalName]['total_available'][$dateIndex]) ? $result['total'][$intervalName]['total_available'][$dateIndex] +  $result[$resultIdentifier][$intervalName]['total_available'][$dateIndex] : $result[$resultIdentifier][$intervalName]['total_available'][$dateIndex];
					
					$result[$resultIdentifier][$intervalName]['sold_quantity_rm_dispensed_quantity'][$dateIndex] = $dispensedDisposableCostForInterval[$intervalName][$dateIndex];
					$result['total'][$intervalName]['sold_quantity_rm_dispensed_quantity'][$dateIndex] = isset($result['total'][$intervalName]['sold_quantity_rm_dispensed_quantity'][$dateIndex]) ? $result['total'][$intervalName]['sold_quantity_rm_dispensed_quantity'][$dateIndex] +  $dispensedDisposableCostForInterval[$intervalName][$dateIndex] : $dispensedDisposableCostForInterval[$intervalName][$dateIndex];
					
					$result[$resultIdentifier][$intervalName]['end_balance'][$dateIndex] =$result[$resultIdentifier][$intervalName]['total_available'][$dateIndex] - $dispensedDisposableCostForInterval[$intervalName][$dateIndex];
					$result['total'][$intervalName]['end_balance'][$dateIndex] = isset($result['total'][$intervalName]['end_balance'][$dateIndex]) ? $result['total'][$intervalName]['end_balance'][$dateIndex] +  $result[$resultIdentifier][$intervalName]['end_balance'][$dateIndex] : $result[$resultIdentifier][$intervalName]['end_balance'][$dateIndex];
					$beginningBalance = $result[$resultIdentifier][$intervalName]['end_balance'][$dateIndex] ;
				}
			}
		}
		
		$total = $result['total'] ?? [];
		unset($result['total']);

		$result['total']=$total;
		return $result ;
	}
	public function customMonth($date, $number_of_added_months)
	{
		return Carbon::parse($date)->addMonths($number_of_added_months)->format('d-m-Y');
	}
	public function average($volumes)
	{
		$last_year_avg_sales = array_sum($volumes) / @count($volumes);
		return $last_year_avg_sales;
	}
	
}
