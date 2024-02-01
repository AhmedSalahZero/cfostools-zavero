<?php

namespace App\Models\Traits\Accessors;

use App\Models\Currency;
use App\Models\Repositories\CurrencyRepository;
use App\ReadyFunctions\CalculateDurationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
trait FinancialPlanAccessor
{
	public function getId(): int
	{
		return $this->id;
	}

	public function getName(): string
	{
		return $this->study_name ?: __('');
	
	}public function getStudyName(): string
	{
		return $this->study_name ?: __('');
	
	}
	public function getStudyStatus()
	{
		return $this->study_status;
	}
	
	
	protected function getMaxDate(array $datesAsStringAndIndex,array $datesIndexWithYearIndex ,array $yearIndexWithYear ,array $dateIndexWithDate,array $dateWithMonthNumber)
	{
		$studyDurationPerMonth = $this->getStudyDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);

		return $studyDurationPerMonth[array_key_last($studyDurationPerMonth)];
	}

	

	
	public function getStudyStartDate(): ?string
	{
		return $this->study_start_date;
	}

	public function getStudyStartDateFormattedForView(): string
	{
		$studyStartDate = $this->getStudyStartDate();

		return dateFormating($studyStartDate, 'M\' Y');
		// return
	}
	public function getStudyEndDate(): ?string
	{
		return $this->study_end_date;
	}
	
	public function getDurationInYears(): ?int
	{
		return $this->duration_in_years;
	}
	public function removeDatesBeforeDate(array $items, string $limitDate)
	{
		$newItems = [];
		$limitDate = Carbon::make($limitDate);
		foreach ($items as $year=>$dateAndValues) {
			foreach ($dateAndValues as $date=>$value) {
				$currentDate = Carbon::make($date);
				if ($limitDate->lessThanOrEqualTo($currentDate)) {
					$newItems[$year][$date]=$value;
				}
			}
		}

		return $newItems;
	}
	
	public function getStudyDurationPerYear(array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber, $asIndexes = true, $maxYearIsStudyEndDate = true, $repeatIndexes = true)
	{
		
		$calculateDurationService = new CalculateDurationService();
		$studyStartDate  = $this->getStudyStartDate();
		// $operationStartDate = $this->getOperationStartDate();
		if ($maxYearIsStudyEndDate) {
			$maxDate = $this->getStudyEndDate();
		} else {
			$maxDate = $this->getMaxDate($datesAsStringAndIndex,$datesIndexWithYearIndex ,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		}

		$studyDurationInYears = $this->getDurationInYears();

		$limitationDate = $studyStartDate;
		$studyDurationPerYear = $calculateDurationService->calculateMonthsDurationPerYear($studyStartDate, $maxDate, $studyDurationInYears, $limitationDate);
		$studyDurationPerYear = $this->removeDatesBeforeDate($studyDurationPerYear, $studyStartDate);
		$dates = [];
		if ($asIndexes) {
			$dates =  $this->convertMonthAndYearsToIndexes($studyDurationPerYear, $datesAsStringAndIndex,$datesIndexWithYearIndex);
		} else {
			$dates =  $studyDurationPerYear;
		}
		if ($repeatIndexes) {
			return $this->addMoreIndexes($dates,$yearIndexWithYear, $dateIndexWithDate,$dateWithMonthNumber ,$asIndexes);
		} else {
			return $dates;
		}
		// return $this->removeZeroValuesFromTwoDimArr($dates);
	}
	public function replaceIndexWithItsStringDate(array $dates,array $dateIndexWithDate):array
	{
		$stringFormattedDates = [];
		foreach ($dates as $dateIndex => $value) {
			if (is_numeric($dateIndex)) {
				// is index date like 25
				$stringFormattedDates[$dateIndexWithDate[$dateIndex]] =$value;
			} else {
				// is already date string like 10-10-2025
				$stringFormattedDates[$dateIndex] = $value;
			}
		}

		return $stringFormattedDates;
	}
	protected function addMoreIndexes(array $yearAndDatesValues,array $yearIndexWithYear , array $dateIndexWithDate,array $dateWithMonthNumber ,bool $asIndexes):array
	{
		$maxYearsCount = MAX_YEARS_COUNT;
		$lastYear = array_key_last($yearAndDatesValues);
		$firstYear = array_key_first($yearAndDatesValues);
		$maxYear = $firstYear  + $maxYearsCount;
		$firstYearAfterLast = $lastYear+1;
		for ($firstYearAfterLast; $firstYearAfterLast < $maxYear; $firstYearAfterLast++) {
			$dates = $this->replaceIndexWithItsStringDate($yearAndDatesValues[$lastYear],$dateIndexWithDate);
			if ($asIndexes) {
				$yearAndDatesValues[$firstYearAfterLast] = $this->replaceYearWithAnotherYear($dates, $yearIndexWithYear[$firstYearAfterLast], $asIndexes,$dateIndexWithDate,$dateWithMonthNumber);
			} else {
				$yearAndDatesValues[$firstYearAfterLast] = $this->replaceYearWithAnotherYear($dates, $firstYearAfterLast, $asIndexes,$dateIndexWithDate,$dateWithMonthNumber);
			}
		}

		return $yearAndDatesValues;
	}

	protected function replaceYearWithAnotherYear(array $dateAndValues, $newYear, bool $asIndexes,array $dateIndexWithDate,array $dateWithMonthNumber)
	{
		$newDatesAndValues   = [];
		foreach ($dateAndValues as $date=>$value) {
			$dateAsIndex = null;
			if ($asIndexes) {
				$dateAsIndex = $date;
				$date = $dateIndexWithDate[$date];
			}
			$day = getDayFromDate($date);
			
			$monthNumber = $dateWithMonthNumber[$date] ?? getMonthFromDate($date);
			$fullDate = $day . '-' .$monthNumber . '-' . $newYear;

			if ($asIndexes) {
				$newDatesAndValues[$dateAsIndex] = $value;
			} else {
				$newDatesAndValues[$fullDate] = $value;
			}
		}

		return $newDatesAndValues;
	}

	protected function removeZeroValuesFromTwoDimArr(array $dates)
	{
		$result = [];
		foreach ($dates as $year => $dateAndValues) {
			foreach ($dateAndValues as $date=>$value) {
				if ($value) {
					$result[$year][$date] = $value;
				}
			}
		}

		return $result;
	}

	public function getStudyDurationPerMonth(array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber, $maxYearIsStudyEndDate = true, $repeatIndexes = true)
	{
		$studyDurationPerMonth = [];
		$studyDurationPerYear = $this->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber, false, $maxYearIsStudyEndDate, true, $repeatIndexes);
	
		foreach ($studyDurationPerYear as $year => $values) {
			foreach ($values as $date => $value) {
				$studyDurationPerMonth[$date] = $value;
			}
		}

		return array_keys($studyDurationPerMonth);
	}

	protected function convertMonthAndYearsToIndexes(array $yearsAndItsDates, array $datesAsStringAndIndex, array $datesIndexWithYearIndex)
	{
		$result = [];

		foreach ($yearsAndItsDates as $yearNumber => $datesAndZeros) {
			foreach ($datesAndZeros as $date => $zeroOrOne) {
				$dateIndex = $datesAsStringAndIndex[$date];
				$yearIndex = $datesIndexWithYearIndex[$dateIndex];
				$result[$yearIndex][$dateIndex] = $zeroOrOne;
			}
		}

		return $result;
	}
	
	public function getRevenueStreamTypes()
	{
		
		// one to many 
		return $this->revenue_streams;
	}
	public function getDevelopmentStartMonth(): ?string
	{
		return $this->development_start_month ?: 0;
	}

	public function getDevelopmentStartDate(): ?string
	{
		return $this->development_start_date;
	}

	public function getDevelopmentStartDateFormatted():?string
	{
		return Carbon::make($this->getDevelopmentStartDate())->format('d-m-Y');
	}
	

	
	public function getFullDateStringFromDateIndex(int $dateIndex): string
	{
		return App('dateIndexWithDate')[$dateIndex];
	}

	public function getYearIndexFromDateIndex(int $dateIndex): int
	{
		return App('datesIndexWithYearIndex')[$dateIndex];
	}

	public function getYearFromYearIndex(int $yearIndex): int
	{
		return App('yearIndexWithYear')[$yearIndex];
	}

	public function getDateIndexFromDate(string $date)
	{
		return App('dateWithDateIndex')[$date];
	}

	public function getDatesAsStringAndIndex()
	{
		return array_flip($this->getStudyDates());
	}
	public function getStudyDates(): array
	{
		// dd($this->study_dates);
		return  $this->study_dates ?: [];
	}
	public function datesAndIndexesHelpers(array $studyDates){
		$firstLoop = true ;
		$baseYear = null ;
		$datesIndexWithYearIndex = [];
		$yearIndexWithYear = [];
		$dateIndexWithDate = [];
		$dateIndexWithMonthNumber = [];
		$dateWithMonthNumber = [];
		$dateWithDateIndex = [];
		
		foreach($studyDates as $dateIndex => $dateAsString){
			$year = explode('-',$dateAsString)[2];
			$montNumber = explode('-',$dateAsString)[1];
			if($firstLoop ){
				$baseYear = $year ;
				$firstLoop = false ; 
			}
			$yearIndex = $year - $baseYear ;
			$datesIndexWithYearIndex[$dateIndex] =$yearIndex ;
			$yearIndexWithYear[$yearIndex] = $year ;
			$dateIndexWithDate[$dateIndex] = $dateAsString ;
			$dateIndexWithMonthNumber[$dateIndex] = $montNumber ;
			$dateWithMonthNumber[$dateAsString] = $montNumber ;
			$dateWithDateIndex[$dateAsString] =$dateIndex ;
			
		}
		return [
			'datesIndexWithYearIndex'=>$datesIndexWithYearIndex,
			'yearIndexWithYear'=>$yearIndexWithYear,
			'dateIndexWithDate'=>$dateIndexWithDate,
			'dateIndexWithMonthNumber'=>$dateIndexWithMonthNumber,
			'dateWithMonthNumber'=>$dateWithMonthNumber,
			'dateWithDateIndex'=>$dateWithDateIndex,
		];
		return $datesIndexWithYearIndex ;
	}
	public function getCreatorName(): string
	{
		return $this->creator->name ?? __('N/A');
	
	}
	
	public function getCountryId(): ?int
	{
		return $this->country_id;
	}

	public function getStateId(): ?int
	{
		return $this->state_id;
	}

	public function getRegion(): ?string
	{
		return $this->region;
	}
	public function getDevelopmentDuration(): ?int
	{
		return $this->development_duration ?: 0;
	}
	
	public function getMainFunctionalCurrency(): ?int
	{
		return $this->main_functional_currency;
	}
	public function getAdditionalCurrency(): ?int
	{
		return $this->additional_currency;
	}
	public function getExchangeRate()
	{
		return $this->exchange_rate ?: 1;
	}

	public function getCorporateTaxesRate()
	{
		return $this->corporate_taxes_rate ?: 0;
	}

	public function getInvestmentReturnRate()
	{
		return $this->investment_return_rate ?: 1;
	}

	public function getPerpetualGrowthRate()
	{
		return $this->perpetual_growth_rate ?: 0;
	}	
	public function financialYearStartMonth(): ?string
	{
		return $this->financial_year_start_month;
	}
	public function updateRepeaterModel(Request $request,bool $deleteAll , string $relationName , string $identifier)
	{
		
		if($deleteAll){
			$this->$relationName()->delete();
			return $this ;
		}
		$oldStoredIds = $this->$relationName->pluck($identifier)->toArray();
		$itemsFromRequest = (array)$request->get($relationName);
		$idsOfRequest = extraKeysFromTwoDimArr($itemsFromRequest,$identifier) ;
		$idsToRemove = array_diff($oldStoredIds , $idsOfRequest);
		$idsToAdd = array_diff($idsOfRequest , $oldStoredIds );
		$idsToKeep = array_intersect($oldStoredIds,$idsOfRequest);
		foreach($idsToKeep as $idToKeep){
			$model = $this->$relationName->where($identifier,$idToKeep)->first() ;
			$data = searchKeyFromTwoDimArray($itemsFromRequest,$identifier,$idToKeep) ;
			$model->update($data);
		}
		foreach($idsToRemove as $idToRemove){
			 $this->$relationName->where($identifier,$idToRemove)->first()->delete();
		}
		foreach($idsToAdd as $idsToAdd){
			$data = searchKeyFromTwoDimArray($itemsFromRequest,$identifier,$idsToAdd);
			$this->$relationName()->create($data);
		}
		return $this;
	}
	public function getFinishedGoodsInventoryCoverageDays()
	{
		return $this->finished_goods_inventory_coverage_days;
	}
	public function getRawMaterialsInventoryCoverageDays()
	{
		return $this->raw_materials_inventory_coverage_days;
	}
	public function getFinishedGoodsInventoryCoverageDaysForTrading()
	{
		return $this->finished_goods_inventory_coverage_days_for_trading;
	}
	
	public function getFFE(int $ffeId)
	{
		return $this->ffes->where('id',$ffeId)->first();
	}
	
	public function getCurrenciesForSelect(): array
	{
		$result = [];
		$mainCurrencyId = $this->getMainFunctionalCurrency();
		$additionalCurrencyId = $this->getAdditionalCurrency();
		$currencies = formatOptionsForSelect(Currency::where('company_id',getCurrentCompanyId())->get(), 'getId', 'getName');
		foreach ($currencies as $index => $currencyArray) {
			if ($currencyArray['value'] == $mainCurrencyId) {
				$result[$mainCurrencyId] = $currencyArray['title'];
			}
			if ($currencyArray['value'] == $additionalCurrencyId) {
				$result[$additionalCurrencyId] = $currencyArray['title'];
			}
		}

		return $result;
	}
	public function hasVisitSection(string $modelName):bool
	{
		return true ;
		// $modelName = Str::singular($modelName);

		// return $this['has_visit_' . $modelName . '_section'];
	}
	public function getFFESItemForSection(?int $ffeId,string $modelName, string $sectionName, int $index = -1)
	{
		// dd($this->ffeItems,$sectionName,$modelName);
		// dd($this->ffesItems);
		$ffeItems = $this->ffesItems->where('ffe_id',$ffeId)->where('section_name', $sectionName)
			->where('model_name', $modelName)
			->values();
		if ($index == -1) {
			return $ffeItems;
		}
		if (!isset($ffeItems[$index])) {
			return null;
		}

		return $ffeItems[$index];
	}
	public function getOperationStartDate(): ?string
	{
		$startDate=$this->operation_start_date;

		return $startDate;
	}
	
	public function getDiffBetweenOperationStartDateAndStudyStartDate($operatingStartDate = null )
	{
		// dd($operatingStartDate);
		$studyStartDate = $this->getStudyStartDate();
		$operatingStartDate = $operatingStartDate ? $operatingStartDate : $this->getOperationStartDate();
		$diffInDays = Carbon::make($operatingStartDate)->diffInDays($studyStartDate);

		return  $diffInDays / 365;
	}
		
	
	public function getDirectExpensesForSection(string $modelName, string $sectionName)
	{
		$directExpenses = $this->departmentExpenses->where('section_name', $sectionName)
			->where('model_name', $modelName)
			->values();

		return $directExpenses;
	}
	public function departmentExpensesFor(string $sectionName,string $modelName)
	{
	
		return $this->departmentExpenses()->where('section_name',$sectionName)
		->where('model_name',$modelName)
		;
	}
	
	public function getDirectExpenseForSection(string $modelName, string $sectionName, int $index = -1)
	{
		$directExpenses = $this->departmentExpenses->where('section_name', $sectionName)
			->where('model_name', $modelName)
			->values();
		if ($index == -1) {
			return $directExpenses;
		}
		if (!isset($directExpenses[$index])) {
			return null;
		}

		return $directExpenses[$index];
	}
	
	public function getRecruitDate()
	{
		return $this->recruit_date;
	}	
	
	public function getOperationStartDateFormatted()
	{
		$operationStartDate = $this->getOperationStartDate();

		return  $operationStartDate ? Carbon::make($operationStartDate)->format('d-m-Y') : null;
	}
	
	public function getOnlyDatesOfActiveOperation(array $operationDurationPerYear,array $dateIndexWithDate, $removeZeros=true)
	{
		$result = [];
		foreach ($operationDurationPerYear as $currentYear => $datesAndZerosOrOnes) {
			foreach ($datesAndZerosOrOnes as $dateIndex => $zeroOrOneAtDate) {
				if ($zeroOrOneAtDate || !$removeZeros) {
					if (is_numeric($dateIndex)) {
						$dateFormatted =$dateIndexWithDate[$dateIndex];
					} else {
						$dateFormatted = $dateIndex;
					}
					$result[$dateFormatted] = $dateIndex;
				}
			}
		}

		return $result;
	}
	public function getOnlyDatesOfActiveStudy(array $studyDurationPerYear,array $dateIndexWithDate)
	{
		$result = [];
		foreach ($studyDurationPerYear as $currentYear => $datesAndZerosOrOnes) {
			foreach ($datesAndZerosOrOnes as $dateIndex => $zeroOrOneAtDate) {
				if (is_numeric($dateIndex)) {
					$dateFormatted =$dateIndexWithDate[$dateIndex];
				} else {
					$dateFormatted = $dateIndex;
				}
				$result[$dateFormatted] = $dateIndex;
			}
		}

		return $result;
	}
	
	public function calculateTotalOperatingDaysCountInEachYear(array $daysNumbersOfMonths, array $operationDurationPerYear)
	{
		$result = [];
		foreach ($daysNumbersOfMonths as $year => $daysNumbersOfMonth) {
			foreach ($daysNumbersOfMonth as $date => $numberOfDaysInMonth) {
				$operationDurationAtDate = $operationDurationPerYear[$year][$date] ?? 0;
				$result[$year][$date] = $numberOfDaysInMonth * $operationDurationAtDate;
				$result['totalOfEachYear'][$year] = isset($result['totalOfEachYear'][$year]) ? $result['totalOfEachYear'][$year] + $result[$year][$date] : $result[$year][$date];
			}
		}

		return $result;
	}
	
	public function getStudyDateFormatted(array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate)
	{
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$studyDurationPerYear = $this->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber, true, true, false);
	
		return  $this->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
	}
	public function getFirstDateIndexInYearIndex(array $datesAsStringAndIndex, int $yearIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate)
	{
		
		$studyDates = $this->getStudyDateFormatted($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
		foreach ($studyDates as $studyDateAsString=>$studyDateAsIndex) {
			$currentYearIndex = $datesIndexWithYearIndex[$studyDateAsIndex];
			if ($currentYearIndex == $yearIndex) {
				return $studyDateAsIndex;
			}
		}

		return null;
	}
	
	public function getDaysNumbersOfMonth(array $datesAsStringAndIndex, array $years,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate)
	{
		$result = [];
		foreach ($years as $yearIndex) {
			$currentYear = $yearIndexWithYear[$yearIndex];
			$dateAsIndex = $this->getFirstDateIndexInYearIndex($datesAsStringAndIndex, $yearIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
			$dateAsString = $dateIndexWithDate[$dateAsIndex];
			$firstMonthInCurrentYear = explode('-', $dateAsString)[1] ?? 1;
			for ($monthNumber = $firstMonthInCurrentYear; $monthNumber <= 12; $monthNumber++) {
				$monthNumber = sprintf('%02d', $monthNumber);
				$date = '01-' . $monthNumber . '-' . $currentYear;
				// 01-01-2023

				$dateIndex = $datesAsStringAndIndex[$date];
				$currentDate  = Carbon::make($date);
				$result[$yearIndex][$dateIndex] = $currentDate->month($monthNumber)->daysInMonth;
			}
		}

		return $result;
	}
	
	public function getOperationDurationPerYear($operationStartDate ,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber  , $asIndexes = true, $maxYearIsStudyEndDate = true)
	{
		// dd($operationStartDate);
		$calculateDurationService = new CalculateDurationService();
		$operationStartDate  = Carbon::make($operationStartDate)->format('d-m-Y');
		if ($maxYearIsStudyEndDate) {
			$maxDate = $this->getStudyEndDate();
		} else {
			$maxDate = $this->getMaxDate($datesAsStringAndIndex,$datesIndexWithYearIndex ,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		}
		$studyDurationInYears = $this->getDurationInYears();
		$operationDurationPerYear = $calculateDurationService->calculateMonthsDurationPerYear($operationStartDate, $maxDate, $studyDurationInYears);

		$operationDurationPerYear = $this->removeZeroValuesFromTwoDimArr($operationDurationPerYear);
		if ($asIndexes) {
			return $this->convertMonthAndYearsToIndexes($operationDurationPerYear, $datesAsStringAndIndex,$datesIndexWithYearIndex);
		}

		return $operationDurationPerYear;
	}
	public function getOperationDurationPerMonth(array $datesAsStringAndIndex , array $datesIndexWithYearIndex ,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithMonthNumber, $maxYearIsStudyEndDate  = true)
	{
		$operationDurationPerMonth = [];
		$operationDurationPerYear = $this->getOperationDurationPerYear($this->getOperationStartDate(),$datesAsStringAndIndex, $datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber, false, $maxYearIsStudyEndDate);
		foreach ($operationDurationPerYear as $key => $values) {
			foreach ($values as $k => $v) {
				if ($v) {
					$operationDurationPerMonth[$k] = $v;
				}
			}
		}

		return array_keys($operationDurationPerMonth);
	}
	protected function editOperationDatesStartingIndex($operationDurationDates,$studyDurationDates){
		$firstIndexInOperationDates = $operationDurationDates[0] ?? null;
		if(!$firstIndexInOperationDates)
		{
			return [];
		}
		$newDates = [];
		$firstIndex = array_search($firstIndexInOperationDates , $studyDurationDates);
		$loop = 0 ;
		foreach($operationDurationDates as $oldIndex=>$value){
				if($loop == 0){
					$newDates[$firstIndex] = $value;
				}else{
					$newDates[]=$value ;
				}
				$loop++;
		}
		return $newDates ;
	}
	
	public function getAdditionalCurrencyFormatted(): ?string
	{
		$additionalCurrency = $this->getAdditionalCurrency();
		$currencies = App(CurrencyRepository::class)->allFormattedForSelect();

		return $currencies[$additionalCurrency - 1]['title'] ?? null;
	}
	

	public function getMainFunctionalCurrencyFormatted(): ?string
	{
		$mainFunctionalCurrency = $this->getMainFunctionalCurrency();
		$currencies = App(CurrencyRepository::class)->allFormattedForSelect();

		return $currencies[$mainFunctionalCurrency - 1]['title'] ?? null;
	}
	
	public function getProductionLineForProductAtYear(int $productId , int $year,string $columnName){
		$data = $this->productCapacities()->wherePivot('product_id',$productId)->first() ;
		if(!$data){
			return 1 ;
		}
		if($columnName == 'net_working_hours_type' || $columnName == 'production_lines_count_type') {
			return $data->pivot->{$columnName} ;
		}
		$data = convertJsonToArray($data->pivot->{$columnName});
		$data = arrayToValueIndexes($data);
		return $data && isset($data[$year]) ? $data[$year] : 1;
		
	}
	public function getDevelopmentEndDate()
	{
		return $this->development_end_date;
	}
	public function getAcquisition()
	{
		$acquisition = $this->acquisition ;
		return $acquisition ? $acquisition->load('loans'):null;
	}

	public function getPropertyAcquisition()
	{
		$propertyAcquisition =$this->propertyAcquisition ;
		return $propertyAcquisition ? $propertyAcquisition->load('loans') : null;
	}
	
	public function getPropertyCostBreakdownForSection(string $modelName, string $sectionName, int $index = -1)
	{
		$propertyCostBreakDown = $this->propertyAcquisitionBreakDown->where('section_name', $sectionName)
			->where('model_name', $modelName)
			->values();
		if ($index == -1) {
			return $propertyCostBreakDown;
		}
		if (!isset($propertyCostBreakDown[$index])) {
			return null;
		}

		return $propertyCostBreakDown[$index];
	}
	public function convertStringDatesFromArrayKeysToIndexes(array $items, array $datesAsStringAndIndex)
	{
		$newItems = [];
		foreach ($items as $dateAsString => $value) {
			if (is_numeric($dateAsString)) {
				throw new \Exception('Custom Exception - Data As String Must Be Date String Format 01-12-2025');
			}
			$newItems[$datesAsStringAndIndex[$dateAsString]] = $value;
		}

		return $newItems;
	}	
	public function hasManufacturingRevenueStream()
	{
		return in_array('manufacturing',$this->getRevenueStreamTypes());
	}
	public function getStudyIncludes()
	{
		return $this->study_includes;
	}
	public function getAddAllocations()
	{
		return (array)$this->add_allocations ;
	}
	
}
