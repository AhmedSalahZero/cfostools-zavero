<?php
namespace App\ReadyFunctions;

use Carbon\Carbon;

class StraightMethodService {
	
	public function calculateStraightAmount(float $amount, string $startDate, int $duration){
		$steadyGrowthCount = [];
		for($i = 1 ; $i <= $duration ; $i++){
			$steadyGrowthCount[] = $duration;			
		}
		// $steadyGrowthFactor = array_sum($steadyGrowthCount);
		// $steadyFactorAmount = $steadyGrowthFactor != 0 ? $amount / $steadyGrowthFactor : $amount  ; 
		$straightAmount = [];
		$straightDate = Carbon::make($startDate)->format('d-m-Y'); // 01-02-2023 
		foreach($steadyGrowthCount as $steadyGrowthCountElement){
			$straightAmount[$straightDate] = $amount / $duration;
			$straightDate = Carbon::make($straightDate)->addMonth()->format('d-m-Y'); // [$steadGrowthRate = 01-02-2023]

		}
		return $straightAmount;
		}
	
}
