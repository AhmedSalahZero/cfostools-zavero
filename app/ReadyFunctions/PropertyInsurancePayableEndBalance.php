<?php 
namespace App\ReadyFunctions;

use App\Models\HospitalitySector;

class PropertyInsurancePayableEndBalance  
{
	
	public function getPropertyInsurancePayableEndBalance(array $purchase , array $collection , array $dateIndexWithDate,array $dateWithDateIndex , HospitalitySector $hospitalitySector )
	{

		$purchasesForIntervals = [
			'monthly'=>$purchase,
			'quarterly'=>sumIntervals($purchase,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'semi-annually'=>sumIntervals($purchase,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'annually'=>sumIntervals($purchase,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
		];
		$collectionForInterval = [
			'monthly'=>$collection,
			'quarterly'=>sumIntervals($collection,'quarterly' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'semi-annually'=>sumIntervals($collection,'semi-annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
			'annually'=>sumIntervals($collection,'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate),
		];
		
		
		
		$result = [];
		$beginning_balances =[];
		$dueAmounts =[];
		$end_balance =[];
		foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted){
			$beginning_balance = 0 ;
			foreach ($purchasesForIntervals[$intervalName]  as $date=>$purchaseAtDate) {
				$dateAsIndex = $dateWithDateIndex[$date];
				$result[$intervalName]['beginning_balance'][$date] = $beginning_balance ; 
				$beginning_balances[$date] = $beginning_balance ;
				$result[$intervalName]['property_insurance'][$date] = $purchaseAtDate ?? 0 ; 
				$due_amount =($purchaseAtDate??0) + $beginning_balance ;
				$result[$intervalName]['due_amount'][$date] = $due_amount ; 
				$currenPayment = getValueFromArrayStringAndIndex($collectionForInterval[$intervalName],$date,$dateAsIndex,0);
				$dueAmounts[$date] = $due_amount ;
				$end_balance[$date] = $due_amount - $currenPayment;
				$result[$intervalName]['payment'][$date] = $currenPayment ; 
				$result[$intervalName]['end_balance'][$date] = $end_balance[$date]??0 ; 
				$beginning_balance = $end_balance[$date];
			}
		
		}
		return $result ;
	}
	

}
