<?php 
namespace App\ReadyFunctions;

use App\Models\HospitalitySector;
use Carbon\Carbon;

class ReceivableEndBalanceService
{
	public function __calculate(array $dateAndValesSales , array $collection, array $dateIndexWithDate,HospitalitySector $hospitalitySector ,float $beginningBalance = 0 ,  )
	{
		$salesForIntervals = [
			'monthly'=>$dateAndValesSales,
			'quarterly'=>sumIntervals($dateAndValesSales,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'semi-annually'=>sumIntervals($dateAndValesSales,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'annually'=>sumIntervals($dateAndValesSales,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
		];
		$collectionForInterval = [
			'monthly'=>$collection,
			'quarterly'=>sumIntervals($collection,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'semi-annually'=>sumIntervals($collection,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'annually'=>sumIntervals($collection,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
		];
		
		$result = [];
		foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted){
			$beginningBalance = 0;
			foreach($salesForIntervals[$intervalName] as $dateIndex=>$value){
	
				$date = $dateIndex;
				$result[$intervalName]['beginning_balance'][$date] = $beginningBalance;
				$totalDue[$date] =  $value+$beginningBalance;
				$collectionAtDate = $collectionForInterval[$intervalName][$date]??0 ;
				$endBalance[$date] = $totalDue[$date] - $collectionAtDate ;
				$beginningBalance = $endBalance[$date] ;
				$result[$intervalName]['revenues'][$date] =  $value ;
				$result[$intervalName]['total_due'][$date] = $totalDue[$date];
				$result[$intervalName]['collection'][$date] = $collectionAtDate;
				$result[$intervalName]['end_balance'][$date] =$endBalance[$date];
			}	
		}
	
		return [
			'monthlyReport'=>$result['monthly']??[] ,
			'intervalsReport'=>$result
		] ; 
		
	}
	
	protected function sumForInterval(array $dateValues, string $intervalName,array $dateIndexWithDate,$financialYearStartMonth='january')
	{
		
		$result = [];
		$periodInterval = $this->getPeriodsForStartMonths($intervalName,$financialYearStartMonth) ; 
		foreach ($dateValues as $currentDate => $value) {
			$dateAsString = $dateIndexWithDate[$currentDate];
			$dateObject = Carbon::make($dateAsString);
			$year = $dateObject->format('Y');
			$month = $dateObject->format('m');
			$day = $dateObject->format('d');
			$sumMonth = sprintf("%02d", $this->getSumMonth($month, $periodInterval));
			$resultDate = $year  . '-' . $sumMonth . '-' . $day;
			$result[$resultDate] = isset($result[$resultDate]) ? $result[$resultDate] + $value  : $value;
		}
		
		return $result;
	}
	protected function getSumMonth($month, $mapMonths)
	{

		foreach ($mapMonths as $sumMonth => $sumMonths) {
			if (in_array($month, $sumMonths)) {
				return $sumMonth;
			}
		}
	}
	protected function getPeriodsForStartMonths($interval,$financialYearStartMonth = 'january')
	{
		if($financialYearStartMonth == 'january' || $financialYearStartMonth="01"){
			if ($interval == 'monthly') {
				return  [
					1 => [1],
					2 => [2],
					3 => [3],
					4 => [4],
					5 => [5],
					6 => [6],
					7 => [7],
					8 => [8],
					9 => [9],
					10 => [10],
					11 => [11],
					12 => [12],
				];
			}
	
			if ($interval == 'quarterly') {
	
				return [
					3 => [1, 2, 3], 6 => [4, 5, 6],9 => [7, 8, 9], 12 => [10, 11, 12]
				];
			}
			if ($interval == 'semi-annually') {
				return [
					6 => [1, 2, 3, 4, 5, 6], 12 => [7, 8, 9, 10, 11, 12]
				];
			}
	
			if ($interval == 'annually') {
				return [
					12 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
				];
			}
				
		}
		
		
		
		if($financialYearStartMonth == 'april' || $financialYearStartMonth=='04'){
			if ($interval == 'monthly') {
				return  [
					1 => [1],
					2 => [2],
					3 => [3],
					4 => [4],
					5 => [5],
					6 => [6],
					7 => [7],
					8 => [8],
					9 => [9],
					10 => [10],
					11 => [11],
					12 => [12],
				];
			}
	
			if ($interval == 'quarterly') {
	
				return [
					6 => [4, 5, 6], 9 => [7, 8, 9],12 => [10, 11, 12], 3 => [1, 2, 3]
				];
			}
			if ($interval == 'semi-annually') {
				return [
					9 => [4, 5, 6, 7,8,9], 3 => [10,11,12,1,2,3]
				];
			}
	
			if ($interval == 'annually') {
				return [
					3 => [4,5,6,7,8,9,10,11,12,1,2,3]
				];
			}
				
		}
		
		
		
		
		if($financialYearStartMonth == 'july' || $financialYearStartMonth=='07'){
			if ($interval == 'monthly') {
				return  [
					1 => [1],
					2 => [2],
					3 => [3],
					4 => [4],
					5 => [5],
					6 => [6],
					7 => [7],
					8 => [8],
					9 => [9],
					10 => [10],
					11 => [11],
					12 => [12],
				];
			}
	
			if ($interval == 'quarterly') {
	
				return [
					9 => [7,8,9], 12 => [10,11,12], 3 => [1,2,3], 6 => [4,5,6]
				];
			}
			if ($interval == 'semi-annually') {
				return [
					12 => [7,8,9,10,11,12], 6 => [1,2,3,4,5,6]
				];
			}
	
			if ($interval == 'annually') {
				return [
					6 => [7,8,9,10,11,12,1,2,3,4,5,6]
				];
			}
				
		}
		
		
		
	}
	
	
	
}
