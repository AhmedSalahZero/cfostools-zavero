<?php

namespace App\ReadyFunctions;

class CalculateProfitsEquationsService
{
	protected function getDatesFromTwoArrays(array $firstArray, array $secondArray):array
	{
		return array_values(array_unique(array_merge(array_keys($firstArray), array_keys($secondArray))));
	}

	protected function getDatesFromThreeArrays(array $firstArray, array $secondArray, array $thirdArray):array
	{
		return array_values(array_unique(array_merge(array_keys($firstArray), array_keys($secondArray), array_keys($thirdArray))));
	}

	/**
	 * Calculate Gross Profit
	 *
	 * @param array $revenues [01-01-25=>5 , 01-02-2025=>5,..etc] with dimensions
	 * @param array $cogs [01-01-25=>5 , 01-02-2025=>5,..etc] with dimensions
	 *
	 * @return array [ 'value'=>['01-01-2020'=>5] , 'percentages'=>['01-01-2025'=>15]  ]
	 */
	public function __calculateGrossProfit(array $revenues, array $cogs):array
	{
		$grossProfit = [];
		$grossProfitPercentage = [];
		$dates = $this->getDatesFromTwoArrays($revenues, $cogs);
		foreach ($dates as $date) {
			$revenueAtDate = $revenues[$date]??0;
			$cogsAtDate = $cogs[$date] ?? 0;
			$grossProfit[$date] = $revenueAtDate - $cogsAtDate;
			$grossProfitPercentage[$date]=$revenueAtDate ? $grossProfit[$date] / $revenueAtDate * 100 : 0;
		}

		return [
			'values'=>$grossProfit,
			'percentages'=>$grossProfitPercentage
		];
	}

	/**
	 * Calculate EBITDA
	 *
	 * @param array $grossProfit [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $sga [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $otherDeductions [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $revenues [01-01-2025=>10,01-02-2025=>20] single dim array
	 *
	 * @return array [ 'values'=>['01-01-2020'=>5] , 'percentages'=>['01-01-2025'=>15]  ]
	 */
	public function __calculateEBITDA(array $grossProfit, array $sga, array $otherDeductions, array $revenues):array
	{
		$ebitda = [];
		$dates = $this->getDatesFromThreeArrays($grossProfit, $sga, $otherDeductions);
		foreach ($dates as $date) {
			$grossProfitAtDate = $grossProfit[$date]??0;
			$sgaAtDate = $sga[$date] ?? 0;
			$otherDeductionsAtDate = $otherDeductions[$date] ?? 0;
			$revenueAtDate = $revenues[$date] ?? 0;
			$ebitda[$date] = $grossProfitAtDate -$sgaAtDate- $otherDeductionsAtDate;
			$ebitdaPercentages[$date] =$revenueAtDate ? $ebitda[$date] / $revenueAtDate * 100 : 0;
		}

		return [
			'values'=>$ebitda,
			'percentages'=>$ebitdaPercentages
		];
	}

	/**
	 * Calculate EBIT
	 *
	 * @param array $ebitda  [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $depreciation  [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $revenues  [01-01-2025=>10,01-02-2025=>20] single dim array
	 *
	 * @return array [ 'values'=>['01-01-2020'=>5] , 'percentages'=>['01-01-2025'=>15]  ]
	 */
	public function __calculateEBIT(array $ebitda, array $depreciation, array $incentiveManagementAmounts,array $revenues):array
	{
		$ebit = [];
		$dates = $this->getDatesFromTwoArrays($ebitda, $depreciation);
		foreach ($dates as $date) {
			$ebitdaAtDate = $ebitda[$date]??0;
			$depreciationAtDate = $depreciation[$date] ?? 0;
			$incentiveManagementAmountAtDate = $incentiveManagementAmounts[$date] ?? 0 ;
			$ebit[$date] = $ebitdaAtDate - $depreciationAtDate - $incentiveManagementAmountAtDate;
			$revenueAtDate = $revenues[$date] ??  0;
			$ebitPercentages[$date] =$revenueAtDate ? $ebit[$date] / $revenueAtDate * 100 : 0;
		}

		return [
			'values'=>$ebit,
			'percentages'=>$ebitPercentages
		];
	}

	/**
	 * Calculate EBT
	 *
	 * @param array $ebit  [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $loanInterest  [01-01-2025=>10,01-02-2025=>20] single dim array
	 *
	 * @return array [ 'values'=>['01-01-2020'=>5] , 'percentages'=>['01-01-2025'=>15]  ]
	 */
	public function __calculateEBT(array $ebit, array $loanInterest, array $revenues):array
	{
		$ebt = [];
		$dates = array_keys($ebit);
		foreach ($dates as $date) {
			$ebitAtDate = $ebit[$date]??0;
			$loanInterestAtDate = $loanInterest[$date] ?? 0;
			$ebt[$date] = $ebitAtDate - $loanInterestAtDate;
			$revenueAtDate = $revenues[$date] ??  0;
			$ebtPercentages[$date] =$revenueAtDate ? $ebt[$date] / $revenueAtDate * 100 : 0;
		}

		return [
			'values'=>$ebt,
			'percentages'=>$ebtPercentages
		];
	}

	/**
	 * Calculate Net Profit
	 *
	 * @param array $ebt [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $taxes [01-01-2025=>10,01-02-2025=>20] single dim array
	 * @param array $revenues [01-01-2025=>10,01-02-2025=>20] single dim array
	 *
	 * @return array [ 'values'=>['01-01-2020'=>5] , 'percentages'=>['01-01-2025'=>15]  ]
	 */
	public function __calculateNetProfit(array $ebt, array $corporateTaxes  ,array $revenues):array
	{
		
		$dates = $this->getDatesFromTwoArrays($ebt, $corporateTaxes);
		foreach ($dates as $date) {
			$ebtAtDate = $ebt[$date]??0;
			$corporateAtDate = $corporateTaxes[$date] ?? 0;
			$netProfit[$date] =$ebtAtDate - $corporateAtDate;
			$revenueAtDate = $revenues[$date] ??  0;
			$netProfitPercentages[$date] =$revenueAtDate ? $netProfit[$date] / $revenueAtDate * 100 : 0;
		}
		return [
			'values'=>$netProfit,
			'percentages'=>$netProfitPercentages
		];
	}
}
