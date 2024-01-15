<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use App\ReadyFunctions\Date;
use App\ReadyFunctions\ProjectsUnderProgress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PropertyAcquisition extends Model
{
	use  CompanyScope;

	// const BUILDING_DEPRECIATION_DURATION=300; // months

	protected $guarded = [
		'id'
	];

	protected $casts = [
	];

	public function getPropertyPurchaseDate()
	{
		return $this->purchase_date;
	}

	public function getPropertyPurchaseDateFormatted():string
	{
		return $this->purchase_date ? Carbon::make($this->purchase_date)->format('d-m-Y') : null;
	}

	public function getPropertyPurchaseCost()
	{
		return $this->property_purchase_cost ?: 0;
	}

	public function getPropertyContingencyRate()
	{
		return $this->property_contingency_rate ?: 0;
	}

	public function getTotalPurchaseCost()
	{
		$contingencyRate = $this->getPropertyContingencyRate()/100;
		$propertyPurchaseCost =$this->getPropertyPurchaseCost();

		return  $propertyPurchaseCost * (1 + $contingencyRate);
	}

	public function getPropertyPaymentMethod()
	{
		return $this->property_payment_method;
	}

	public function getFirstPropertyDownPaymentPercentage()
	{
		return $this->first_property_down_payment_percentage ?: 0;
	}

	public function getSecondPropertyDownPaymentPercentage()
	{
		return $this->second_property_down_payment_percentage ?: 0;
	}

	public function getPropertyAfterMonthDays()
	{
		return $this->property_after_month ?: 0;
	}

	public function getPropertyBalanceRate()
	{
		return 100 - $this->getFirstPropertyDownPaymentPercentage() - $this->getSecondPropertyDownPaymentPercentage();
	}

	public function getPropertyInstallmentCount()
	{
		return $this->property_installment_count ?: 1;
	}

	public function getPropertyInstallmentInterval()
	{
		return $this->installment_interval;
	}

	public function getPropertyEquityFundingRate()
	{
		return $this->property_equity_funding_rate ?: 100;
	}

	public function getDebtFundingPercentage()
	{
		$equityFundingPercentage = $this->getPropertyEquityFundingRate();

		return 100 - $equityFundingPercentage;
	}

	public function getEquityAmount()
	{
		return $this->equity_amount ?: 0;
	}

	public function getDebtAmount()
	{
		$totalPurchaseCost = $this->getTotalPurchaseCost();
		$debtFundingPercentage = $this->getDebtFundingPercentage() /100;

		return $totalPurchaseCost * $debtFundingPercentage;
	}

	public function financialPlan()
	{
		return $this->belongsTo(FinancialPlan::class, 'financial_plan_id', 'id');
	}

	public static function getViewVars($currentCompanyId, $financialPlanId):array
	{
		return [
			'storeRoute' => route('admin.store.financial.plan.property.acquisition.costs', [$currentCompanyId, $financialPlanId]),
			'type' => 'create',

		];
	}

	public function getCollectionPolicyType()
	{
		return $this->collection_policy_type;
	}

	public function collectionPolicyInterval()
	{
		return $this->collection_policy_interval;
	}

	public function isSystemDefaultCollectionPolicy()
	{
		return $this->getCollectionPolicyType() == 'system_default';
	}

	public function isCustomizeCollectionPolicy()
	{
		return $this->getCollectionPolicyType() == 'customize';
	}

	public function getSalesChannelRateAndDueInDays(int $index, $type)
	{
		if (!$this->isCustomizeCollectionPolicy()) {
			return [
				'rate'=>0,
				'due_in_days'=>0
			][$type];
		}

		return [
			'rate'=>((array)json_decode($this->collection_policy_value))['rate'][$index]??0,
			'due_in_days'=>((array)json_decode($this->collection_policy_value))['due_in_days'][$index]??0,
		][$type];
	}

	public function getCollectionPolicyValue()
	{
		$collectionPolicyValue = convertJsonToArray($this->collection_policy_value);

		return $collectionPolicyValue;
	}

	public function loans()
	{
		return $this->hasMany(Loan::class, 'acquisition_id', 'id');
	}

	public function getLoanForSection(string $currentSectionName)
	{
		return $this->loans->where('section_name',$currentSectionName)->first();
	}

	// mutation
	public function storeLoans(array $loans, int $companyId)
	{
		foreach ($loans as $sectionName=>$arrayOfData) {
			$loan = $this->getLoanForSection($sectionName);
			// current_section_name
			$loanType = $arrayOfData['loan_type'] ?? null ;
			$data = array_merge($arrayOfData, ['company_id'=>$companyId, 'section_name'=>$sectionName,'fixedLoanType'=>'fixed.loan.fixed.at.end',
			'capitalization_type'=>Loan::getCapitalizationType($loanType) 
		]);
			if ($loan) {
				$loan->update($data);
			} else {
				$this->loans()->create($data);
			}
		}

		return $this;
	}

	public function getPropertyCustomCollectionPolicyValue()
	{
		return (array)json_decode($this->collection_policy_value);
	}

	public function getReplacementCostRateForBuilding()
	{
		return $this->replacement_cost_rate ?: 0;
	}
	public function getReplacementCostRateForFFE()
	{
		return $this->ffe_replacement_cost_rate ?: 0;
	}

	public function getReplacementIntervalForBuilding()
	{
		return $this->replacement_interval ?: 0;
	}
	
	public function getReplacementIntervalInMonthsForBuilding()
	{
		return $this->getReplacementIntervalForBuilding() * 12;
	}
	
	public function getReplacementIntervalForFFE()
	{
		return $this->ffe_replacement_interval ?: 0;
	}
	
	public function getReplacementIntervalInMonthsForFFE()
	{
		return $this->getReplacementIntervalForFFE() * 12;
	}

	public function getFFEReplacementCostRate()
	{
		return $this->ffe_replacement_cost_rate ?: 0;
	}

	public function getFFEReplacementInterval()
	{
		return $this->ffe_replacement_interval ?: 0;
	}

	public function propertyBreakdowns():Collection
	{
		return $this->financialPlan->getPropertyCostBreakdownForSection('property', PROPERTY_ACQUISITION, '-1');
	}

	public function getBuildingProperty()
	{
		return $this->propertyBreakdowns()->whereIn('name', ['Building Cost', __('Building Cost')])
		->first();
	}
	public function getLandProperty()
	{
		return $this->propertyBreakdowns()->whereIn('name', ['Land Cost', __('Land Cost')])
		->first();
	}

	public function getBuildingPropertyAmount():float
	{
		return $this->getBuildingProperty()->item_amount ?: 0;
	}
	public function getBuildingPropertyPercentage():float
	{
		return $this->getBuildingProperty()->property_cost_percentage ?: 0;
	}
	public function getFFEProperty()
	{
		return $this->propertyBreakdowns()->whereIn('name', ['Furniture, Fixture & Equipment Cost', __('Furniture, Fixture & Equipment Cost')])
		->first();
	}

	public function getFFEPropertyAmount():float
	{
		return $this->getFFEProperty()->item_amount ?: 0;
	}
	
	public function getFFEPropertyAmountPercentage():float
	{
		return $this->getFFEProperty()->property_cost_percentage ?: 0;
	}
	
	public function getLandPropertyAmountPercentage():float
	{
		return $this->getLandProperty()->property_cost_percentage ?: 0;
	}
	
	
	
	public function getBuildingPropertyDepreciationDuration():float
	{
		return $this->getBuildingProperty()->depreciation_duration ?: 1;
	}
	public function getBuildingPropertyDepreciationDurationInMonths():float
	{
		return $this->getBuildingPropertyDepreciationDuration() * 12;
	}
	
	
	
	public function getFFEPropertyDepreciationDuration():float
	{
		return $this->getFFEProperty()->depreciation_duration ?: 1;
	}
	public function getFFEPropertyDepreciationDurationInMonths():float
	{
		return $this->getFFEPropertyDepreciationDuration() * 12;
	}
	
	public function  getProjectUnderProgressForConstructionForBuilding(array $hardConstructionExecution,array $softConstructionExecution,array $loanInterestOfHardConstruction,array $withdrawalInterestOfHardConstruction , FinancialPlan $financialPlan,int $operationStartDateAsIndex,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate)
	{
		return (new ProjectsUnderProgress())->calculateForConstruction($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction, $financialPlan,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
	}
	public function  getProjectUnderProgressForConstructionForFFE()
	{
		return [];
	}
	
	
	// $propertyAmount is $this->getBuildingPropertyAmount() in case of building
	// $propertyDepreciationDurationInMonths is $this->getBuildingPropertyDepreciationDurationInMonths()  in case of building
	// $propertyReplacementCostRate is $this->getReplacementCostRate() in case of building
	// $propertyReplacementIntervalInMonths is $this->getReplacementIntervalInMonths() in case of building
	// $projectUnderProgressForConstruction is $this->getProjectUnderProgressForConstructionForBuilding() in case of building and empty array for ffe
	public function calculatePropertyAssetsForBuilding(array $hardConstructionExecution,array $softConstructionExecution,array $loanInterestOfHardConstruction,array $withdrawalInterestOfHardConstruction,int $operationStartDateAsIndex,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $propertyBuildingCapitalizedInterest):array 
	{
		$financialPlan = $this->financialPlan;
		$propertyAcquisitionAmountForBuilding = $this->getBuildingPropertyAmount();
		$propertyDepreciationDurationInMonthsForBuilding = $this->getBuildingPropertyDepreciationDurationInMonths();
		$propertyReplacementCostRateForBuilding = $this->getReplacementCostRateForBuilding();
		$propertyReplacementIntervalInMonthsForBuilding = $this->getReplacementIntervalInMonthsForBuilding();
	   $projectUnderProgressForConstruction = $this->getProjectUnderProgressForConstructionForBuilding($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction ,  $financialPlan,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
		
	   return $this->calculatePropertyAssets($propertyAcquisitionAmountForBuilding,$propertyDepreciationDurationInMonthsForBuilding,$propertyReplacementCostRateForBuilding,$propertyReplacementIntervalInMonthsForBuilding,$projectUnderProgressForConstruction,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyBuildingCapitalizedInterest);

	}
	public function calculatePropertyAssetsForFFE(array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $propertyFFECapitalizedInterest):array 
	{
		$propertyAcquisitionAmountForFFE = $this->getFFEPropertyAmount();
		$propertyDepreciationDurationInMonthsForFFE = $this->getFFEPropertyDepreciationDurationInMonths();
		$propertyReplacementCostRateForFFE = $this->getReplacementCostRateForFFE();
		$propertyReplacementIntervalInMonthsForFFE = $this->getReplacementIntervalInMonthsForFFE();
	   $projectUnderProgressForFFE = $this->getProjectUnderProgressForConstructionForFFE();
		return $this->calculatePropertyAssets($propertyAcquisitionAmountForFFE,$propertyDepreciationDurationInMonthsForFFE,$propertyReplacementCostRateForFFE,$propertyReplacementIntervalInMonthsForFFE,$projectUnderProgressForFFE,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyFFECapitalizedInterest);
	  
	}
	
	
	
	
	public function calculatePropertyAssets(float $propertyAmount,int $propertyDepreciationDurationInMonths,float $propertyReplacementCostRate,int $propertyReplacementIntervalInMonths,array $projectUnderProgressForConstruction,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate , array $propertyCapitalizedInterest):array 
	{
		$buildingAssets = [];
		$financialPlan = $this->financialPlan;
		$operationStartDateFormatted = $financialPlan->getOperationStartDateFormatted();
		$purchaseDate=$this->getPropertyPurchaseDateFormatted();
		$propertyReplacementCostRate = $propertyReplacementCostRate /100;
		$constructionTransferredDateAndValue = $projectUnderProgressForConstruction['transferred_date_and_vales']??[];
		$constructionTransferredDate = array_key_last($constructionTransferredDateAndValue);
		$constructionTransferredValue = $constructionTransferredDateAndValue[$constructionTransferredDate]??0;
		$studyDates = $financialPlan->getStudyDateFormatted($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
		$studyEndDate = $financialPlan->getStudyEndDateFormatted();
	


		$beginningBalance = 0;
		$totalMonthlyDepreciation = [];
		$accumulatedDepreciation = [];
		$replacementDates = $this->calculateReplacementDates($studyDates,$operationStartDateFormatted ,$studyEndDate,$propertyReplacementIntervalInMonths);
		$depreciation = [];
		$index = 0 ;
		$depreciationStartDate = null;
		foreach ($studyDates as $dateAsString=>$dateAsIndex) {
			if(Carbon::make($purchaseDate)->lessThan($operationStartDateFormatted) || Carbon::make($constructionTransferredDate)->lessThan($operationStartDateFormatted)){
				$depreciationStartDate = $operationStartDateFormatted;
			}else{
				$depreciationStartDate = getNextDate($studyDates,$dateAsString);
			}
		
			$depreciationEndDate = $depreciationStartDate ? Carbon::make($depreciationStartDate)->addMonths($propertyDepreciationDurationInMonths - 1) : null;
			$buildingAssets['beginning_balance'][$dateAsString]= $beginningBalance;
			$buildingAssets['additions'][$dateAsString] =  $dateAsString == $purchaseDate ? $propertyAmount : ($dateAsString ==$constructionTransferredDate ? $constructionTransferredValue : 0);
			$buildingAssets['additions'][$dateAsString] += $propertyCapitalizedInterest[$dateAsString] ?? 0;
			
			$buildingAssets['initial_total_gross'][$dateAsString] =  $buildingAssets['additions'][$dateAsString] +  $beginningBalance;
			$currentInitialTotalGross = $buildingAssets['initial_total_gross'][$dateAsString] ??0;
			$replacementCost[$dateAsString] =    in_array($dateAsString ,$replacementDates)  ? $this->calculateReplacementCost($currentInitialTotalGross,$propertyReplacementCostRate) : 0;
			if( in_array($dateAsString ,$replacementDates) && (Carbon::make($purchaseDate)->lessThan($operationStartDateFormatted) || Carbon::make($constructionTransferredDate)->lessThan($operationStartDateFormatted))){
				$depreciationStartDate = getNextDate($studyDates,$dateAsString);
				$depreciationEndDate = $depreciationStartDate ? Carbon::make($depreciationStartDate)->addMonths($propertyDepreciationDurationInMonths - 1) : null;
			}
			$replacementValueAtCurrentDate = $replacementCost[$dateAsString] ?? 0;
			$buildingAssets['replacement_cost'][$dateAsString] = $replacementCost[$dateAsString] ;
			$buildingAssets['final_total_gross'][$dateAsString] = $buildingAssets['initial_total_gross'][$dateAsString]  + $replacementValueAtCurrentDate;
			$depreciation[$dateAsString]=$this->calculateMonthlyDepreciation($buildingAssets['additions'][$dateAsString],$replacementValueAtCurrentDate,$propertyDepreciationDurationInMonths, $depreciationStartDate, $depreciationEndDate, $totalMonthlyDepreciation, $accumulatedDepreciation,$studyDates);
			$accumulatedDepreciation = $this->calculateAccumulatedDepreciation($totalMonthlyDepreciation,$studyDates);
			$buildingAssets['total_monthly_depreciation'] =$totalMonthlyDepreciation;
			$buildingAssets['accumulated_depreciation'] = $accumulatedDepreciation;
			$currentAccumulatedDepreciation = $buildingAssets['accumulated_depreciation'][$dateAsString] ?? 0;
			$buildingAssets['end_balance'][$dateAsString] =  $buildingAssets['final_total_gross'][$dateAsString] - $currentAccumulatedDepreciation;
			$beginningBalance = $buildingAssets['final_total_gross'][$dateAsString];
			$index++;
		}

		return $buildingAssets ;
	}
	protected function calculateReplacementDates(array $studyDates , string $operationStartDateFormatted , string $studyEndDate ,int $propertyReplacementIntervalInMonths)
	{
		$replacementDates = [];
		foreach($studyDates as $studyDateAsString=>$studyDateAsIndex){
			if(Carbon::make($operationStartDateFormatted) > Carbon::make($studyEndDate)){
				break ;	
			}
			$replacementDates[$studyDateAsString] = Carbon::make($operationStartDateFormatted)->addMonths($propertyReplacementIntervalInMonths)->format('d-m-Y');
			$operationStartDateFormatted = $replacementDates[$studyDateAsString] ;
		}
		return $replacementDates ;
	}

	protected function calculateReplacementCost(float $totalGross, float $propertyReplacementCostRate,  )
	{
		return $totalGross * $propertyReplacementCostRate ;
	}
	protected function calculateAccumulatedDepreciation(array $totalMonthlyDepreciation,array $studyDates)
	{
		$result = [];
		foreach ($studyDates  as $date=>$dateIndex){
			$value = $totalMonthlyDepreciation[$date] ?? 0; 
			$previousDate = getPreviousDate($studyDates, $date);
			$result[$date] = $previousDate ? $result[$previousDate] + $value : $value;
		}
		return $result;
	}

	protected function calculateMonthlyDepreciation(float $additions,float $replacementCost,int $propertyDepreciationDurationInMonths, ?string $depreciationStartDate, ?string $depreciationEndDate, &$totalMonthlyDepreciation, &$accumulatedDepreciation,array $studyDates  )
	{
		if (!$depreciationStartDate || !$depreciationEndDate) {
			return [];
		}
		$monthlyDepreciations = [];
		$monthlyDepreciationAtCurrentDate =  ($additions+$replacementCost) / $propertyDepreciationDurationInMonths ;
		$depreciationStartDateAsCarbon = Carbon::make($depreciationStartDate);
		$depreciationEndDateAsCarbon = Carbon::make($depreciationEndDate);
		$depreciationDates = generateDatesBetweenTwoDates($depreciationStartDateAsCarbon, $depreciationEndDateAsCarbon, 'addMonth', 'd-m-Y');
	
		foreach ($studyDates as $dateAsString => $dateAsIndex) {
			$previousDate = getPreviousDate($studyDates, $dateAsString);
			if(in_array($dateAsString,$depreciationDates)){
				$monthlyDepreciations[$dateAsString] = $monthlyDepreciationAtCurrentDate;
				$totalMonthlyDepreciation[$dateAsString] = isset($totalMonthlyDepreciation[$dateAsString]) ? $totalMonthlyDepreciation[$dateAsString] +$monthlyDepreciationAtCurrentDate : $monthlyDepreciationAtCurrentDate;
				$accumulatedDepreciation[$dateAsString] = $previousDate ? ($totalMonthlyDepreciation[$dateAsString] + $accumulatedDepreciation[$previousDate]) : $totalMonthlyDepreciation[$dateAsString];
			}else{
				$accumulatedDepreciation[$dateAsString] = $accumulatedDepreciation[$previousDate] ?? 0 ;
			}
		}
		return $monthlyDepreciations;
	}
}
