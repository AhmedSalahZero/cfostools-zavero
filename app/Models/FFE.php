<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class  FFE extends Model 
{

	use   CompanyScope;
	
	protected $table ='ffe';
	
	protected $guarded = [
		'id'
	];
	
	protected $casts = [
	];
	
	public function getLandPurchaseDate()
	{
		return $this->purchase_date ;
	}
	public function getLandPurchaseDateFormatted():string 
	{
		return $this->purchase_date ? Carbon::make($this->purchase_date)->format('d-m-Y') : null ;
	}
	
	public function getDebtFundingPercentage()
	{
		$EquityFunding = $this->getEquityFunding() ;
		return  1 - $EquityFunding ;
	}

	public function getDebtAmount()
	{
		$totalPurchaseCost = $this->getTotalItemsCost();
		$debtFundingPercentage = $this->getDebtFundingPercentage() /100;
		return $totalPurchaseCost * $debtFundingPercentage ;
	}
	public function hospitalitySector()
	{
		return $this->belongsTo(HospitalitySector::class , 'hospitality_sector_id','id');
	}	
	public static function getViewVars($currentCompanyId,$hospitalitySectorId):array 
	{
		return [
			'storeRoute' => route('admin.store.hospitality.sector.ffe.cost', [$currentCompanyId,$hospitalitySectorId]),
			'type' => 'create',
			
		];
	}
	
	public function getCollectionPolicyType()
	{
		return $this->collection_policy_type ;
	}
	public function collectionPolicyInterval()
	{
		return $this->collection_policy_interval ;
	}
	public function isSystemDefaultCollectionPolicy()
	{
		return $this->getCollectionPolicyType() == 'system_default';
	}
	public function isCustomizeCollectionPolicy()
	{
		return $this->getCollectionPolicyType() == 'customize';
	}
	
	public function getSalesChannelRateAndDueInDays(int $index,$type)
	{
		if(!$this->isCustomizeCollectionPolicy()){
			return [
				'rate'=>0 ,
				'due_in_days'=>0
			][$type];
		}
		return [
			'rate'=>((array)json_decode($this->collection_policy_value))['rate'][$index]??0 , 
			'due_in_days'=>((array)json_decode($this->collection_policy_value))['due_in_days'][$index]??0 , 
		][$type];
	}

	public function loans()
	{
		return $this->hasMany(Loan::class ,'id','id');
	}
	
	public function getLoanForSection(string $currentSectionName)
	{
		return $this->loans->where('section_name',$currentSectionName)->first();
	}

	

	public function getTotalItemsCost():float 
	{
		
		$total = 0;
		$this->ffeItems->each(function($ffeItem) use (&$total){
			$total += $ffeItem->getItemCost() * (1+($ffeItem->getContingencyRate()/100));
		});
	
		return $total ; 
	}	

	

	public function getStartDate( $hospitalitySector)
	{
		return $this->start_date?:$hospitalitySector->getDevelopmentStartDate() ;
	}
	
	public function getStartDateFormatted( $hospitalitySector)
	{
		$startDate = $this->start_date ;
		if($startDate){
			return Carbon::make($startDate)->format('d-m-Y');
		}
		return $hospitalitySector->getDevelopmentStartDateFormatted() ;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function getEndDate()
	{
		return $this->end_date;
	}
	
	public function getExecutionMethod()
	{
		return $this->execution_method ;
	}
	
	public function getDownPaymentPercentage()
	{
		return $this->down_payment?:0 ;
	}
	
	public function getBalanceRateOne()
	{
		return $this->balance_rate_one?:0;
	}
	
	public function getDueOne()
	{
		return $this->due_one?:0;
	}	
	
	public function getBalanceRateTwo()
	{
		return $this->balance_rate_two?:0;
	}

	public function getDueTwo()
	{
		return $this->due_two?:0;
	}
	
	
	public function getEquityFunding()
	{
		
		return $this->ffe_equity_funding ?:0;
	}
	public function getEquityAmount()
	{
		$EquityFunding = $this->getEquityFunding() / 100 ;
		return $EquityFunding * $this->getTotalItemsCost();
	}
	public function getDebtFunding()
	{
		$EquityFundingPercentage =$this->getEquityFunding();
		
		return 100- $EquityFundingPercentage; 
	}
	
	// mutation 
	public function storeLoans(array $loans,int $companyId,int $ffeId)
	{
		foreach($loans as $sectionName=>$arrayOfData){
			$loan = $this->getLoanForSection($sectionName) ;
			$loanType = $arrayOfData['loan_type'] ?? null ;
				$data = array_merge($arrayOfData,['company_id'=>$companyId,'section_name'=>$sectionName,'ffe_id'=>$ffeId,'fixedLoanType'=>'fixed.loan.fixed.at.end',
				'capitalization_type'=>Loan::getCapitalizationType($loanType)
				
			]);
			if($loan){
				$loan->update($data);
			}else{
				$this->loans()->create($data);
			}
		}
		return $this ;
	}	
	
	
	public function getLandCustomCollectionPolicyValue()
	{
		return (array)json_decode($this->collection_policy_value) ;
	}
	public function getCollectionPolicyValue():array 
	{
		return [
			'due_in_days'=>[$this->getDueOne(), $this->getDueTwo()],
			'rate'=>[$this->getBalanceRateOne(), $this->getBalanceRateTwo()]
				];			
		}
		public function getStartDateIndex(HospitalitySector $hospitalitySector):int 
		{
			return $hospitalitySector->getStartDate();
			
		}
		public function ffeItems():HasMany
		{
		return $this->hasMany(FFEItem::class , 'ffe_id','id');
	}		
	
	
	public function calculateFFEAssetsForFFE(string  $transferredDateForFFEAsString,float  $transferredAmount,array $studyDates,string $studyEndDate):array 
	{
		
		$assets = [];
		$totalItemsCost = $this->getTotalItemsCost();
		$this->ffeItems->each(function(FFEItem $ffeItem) use ($totalItemsCost,$transferredDateForFFEAsString,$transferredAmount,&$assets,$studyDates,$studyEndDate){
			$depreciationDurationInMonthsForFFE = $ffeItem->getDepreciationDurationInMonths();
			$ffeReplacementCostRateForFFE = $ffeItem->getReplacementCostRate()  ;
			$ffeReplacementIntervalInMonthsForFFE = $ffeItem->getReplacementIntervalInMonths();
			$totalCost = $ffeItem->getTotalCost();
			$ffeItemTransferredAmount = $totalItemsCost ? $transferredAmount*($totalCost / $totalItemsCost) : 0  ;
			$projectUnderProgressForFFE = [
				'transferred_date_and_vales'=>[
					$transferredDateForFFEAsString =>  $ffeItemTransferredAmount
					]
				];
				
				
				$assets[$ffeItem->getName()] = $this->calculateFFEAssets($depreciationDurationInMonthsForFFE,$ffeReplacementCostRateForFFE,$ffeReplacementIntervalInMonthsForFFE,$projectUnderProgressForFFE,$studyDates,$studyEndDate);
			});
			return $assets ;
			
		}
		
		public function calculateFFEAssets(int $propertyDepreciationDurationInMonths,float $propertyReplacementCostRate,int $propertyReplacementIntervalInMonths,array $projectUnderProgressForConstruction,array $studyDates,string $studyEndDate  ,HospitalitySector $hospitalitySector = null):array 
		{
			$buildingAssets = [];
			$hospitalitySector = $this->hospitalitySector?:$hospitalitySector;
			$operationStartDateFormatted = $hospitalitySector->getOperationStartDateFormatted();
			$propertyReplacementCostRate = $propertyReplacementCostRate /100;
			$constructionTransferredDateAndValue = $projectUnderProgressForConstruction['transferred_date_and_vales']??[];
			$constructionTransferredDate = array_key_last($constructionTransferredDateAndValue);
			$constructionTransferredValue = $constructionTransferredDateAndValue[$constructionTransferredDate]??0;
			

		$beginningBalance = 0;
		$totalMonthlyDepreciation = [];
		$accumulatedDepreciation = [];
		$replacementDates = $this->calculateReplacementDates($studyDates,$operationStartDateFormatted ,$studyEndDate,$propertyReplacementIntervalInMonths);
		$depreciation = [];
		$index = 0 ;
		$depreciationStartDate = null;
		foreach ($studyDates as $dateAsString=>$dateAsIndex) {
			if(Carbon::make($constructionTransferredDate)->lessThan($operationStartDateFormatted)){
				$depreciationStartDate = $operationStartDateFormatted;
			}else{
				$depreciationStartDate = getNextDate($studyDates,$dateAsString);
			}
			$depreciationEndDate = $depreciationStartDate ? Carbon::make($depreciationStartDate)->addMonths($propertyDepreciationDurationInMonths - 1) : null;
			$buildingAssets['beginning_balance'][$dateAsString]= $beginningBalance;
			$buildingAssets['additions'][$dateAsString]=  $dateAsString ==$constructionTransferredDate ? $constructionTransferredValue : 0;
			$buildingAssets['initial_total_gross'][$dateAsString] =  $buildingAssets['additions'][$dateAsString] +  $beginningBalance;
			$currentInitialTotalGross = $buildingAssets['initial_total_gross'][$dateAsString] ??0;
			$replacementCost[$dateAsString] =    in_array($dateAsString ,$replacementDates)  ? $this->calculateReplacementCost($currentInitialTotalGross,$propertyReplacementCostRate) : 0;
			if( in_array($dateAsString ,$replacementDates) && ( Carbon::make($constructionTransferredDate)->lessThan($operationStartDateFormatted))){
				$depreciationStartDate = getNextDate($studyDates,$dateAsString);
				$depreciationEndDate = $depreciationStartDate ? Carbon::make($depreciationStartDate)->addMonths($propertyDepreciationDurationInMonths - 1) : null;
			}
			$replacementValueAtCurrentDate = $replacementCost[$dateAsString] ?? 0;
			$buildingAssets['replacement_cost'][$dateAsString] = $replacementCost[$dateAsString] ;
			$buildingAssets['final_total_gross'][$dateAsString] = $buildingAssets['initial_total_gross'][$dateAsString]  + $replacementValueAtCurrentDate;
			$depreciation[$dateAsString]=$this->calculateMonthlyDepreciation($buildingAssets['additions'][$dateAsString],$replacementValueAtCurrentDate,$propertyDepreciationDurationInMonths, $depreciationStartDate, $depreciationEndDate, $totalMonthlyDepreciation, $accumulatedDepreciation,$studyDates);
			$accumulatedDepreciation = $this->calculateAccumulatedDepreciation($totalMonthlyDepreciation,$studyDates);
			$buildingAssets['total_monthly_depreciation'] =$totalMonthlyDepreciation;
			$buildingAssets['accumulated_depreciation'] =$accumulatedDepreciation;
			$currentAccumulatedDepreciation = $buildingAssets['accumulated_depreciation'][$dateAsString] ?? 0;
			$buildingAssets['end_balance'][$dateAsString] =  $buildingAssets['final_total_gross'][$dateAsString] -  $currentAccumulatedDepreciation;
			$beginningBalance = $buildingAssets['final_total_gross'][$dateAsString];
			$index++;
		}
		
		return $buildingAssets ;
	}
	
	protected function calculateReplacementDates(array $studyDates , string $operationStartDateFormatted , string $studyEndDate ,int $propertyReplacementIntervalInMonths,$debug=false)
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
		foreach ($studyDates  as $date=>$dateIndex) {
			$value = $totalMonthlyDepreciation[$date] ?? 0; 
			$previousDate = getPreviousDate($studyDates, $date);
			$result[$date] = $previousDate ? $result[$previousDate] + $value : $value;
		}
		
		return $result;
	}
	
	protected function calculateMonthlyDepreciation(float $additions,float $replacementCost,int $propertyDepreciationDurationInMonths, ?string $depreciationStartDate, ?string $depreciationEndDate, &$totalMonthlyDepreciation, &$accumulatedDepreciation,array $studyDates)
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
				// $monthlyDepreciations[$dateAsString] = 0;
				// $totalMonthlyDepreciation[$dateAsString]  = 0 ;
				$accumulatedDepreciation[$dateAsString] = $accumulatedDepreciation[$previousDate] ?? 0 ;
			}
		}
		
		return $monthlyDepreciations;
	}
	
	
}
