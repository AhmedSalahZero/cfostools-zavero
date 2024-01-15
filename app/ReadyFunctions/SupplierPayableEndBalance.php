<?php 
namespace App\ReadyFunctions;

use App\Models\HospitalitySector;

class SupplierPayableEndBalance  
{
	
	public function getDisposablePayableStatement(array $purchase , array $collection , array $dateIndexWithDate , HospitalitySector $hospitalitySector )
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
				$result[$intervalName]['beginning_balance'][$date] = $beginning_balance ; 
				$beginning_balances[$date] = $beginning_balance ;
				$result[$intervalName]['purchase'][$date] = $purchaseAtDate ?? 0 ; 
				$due_amount =($purchaseAtDate??0) + $beginning_balance ;
				$result[$intervalName]['due_amount'][$date] = $due_amount ; 
				
				$dueAmounts[$date] = $due_amount ;
				$end_balance[$date] = $due_amount - ($collectionForInterval[$intervalName][$date]??0);
				$result[$intervalName]['payment'][$date] = $collectionForInterval[$intervalName][$date]??0 ; 
				$result[$intervalName]['end_balance'][$date] = $end_balance[$date]??0 ; 
				$beginning_balance = $end_balance[$date];
			}
		
		}
		return $result ;
	}
	

}
