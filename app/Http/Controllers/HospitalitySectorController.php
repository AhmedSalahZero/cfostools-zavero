<?php

namespace App\Http\Controllers;

use App\Exports\HospitalitySectorExport;
use App\Helpers\HArr;
use App\Http\Requests\HospitalitySectorRequest;
use App\Models\Acquisition;
use App\Models\Company;
use App\Models\FFE;
use App\Models\HospitalitySector;
use App\Models\HospitalitySectorItem;
use App\Models\OtherVariableManpowerExpense;
use App\Models\PropertyAcquisition;
use App\Models\QuickPricingCalculator;
use App\Models\Repositories\HospitalitySectorRepository;
use App\ReadyFunctions\CalculateFixedLoanAtEndService;
use App\ReadyFunctions\CalculateIrrService;
use App\ReadyFunctions\CalculatePaybackPeriodService;
use App\ReadyFunctions\CalculateProfitsEquationsService;
use App\ReadyFunctions\FixedAssetsPayableEndBalance;
use App\ReadyFunctions\ProjectsUnderProgress;
use App\ReadyFunctions\PropertyInsurancePayableEndBalance;
use App\ReadyFunctions\PropertyTaxesPayableEndBalance;
use App\ReadyFunctions\RatioAnalysisService;
use App\ReadyFunctions\SCurveService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Instanceof_;

class HospitalitySectorController extends Controller
{
	private HospitalitySectorRepository $hospitalitySectorRepository;
	private array $modelRelations  = [
		'SalesChannel'=>'salesChannels',
		'Room'=>'rooms',
		'Food'=>'foods',
		'Meeting'=>'meetings',
		'Casino'=>'casinos',
		'Other'=>'others'
	];

	public function __construct(HospitalitySectorRepository $hospitalitySectorRepository)
	{
		$this->hospitalitySectorRepository = $hospitalitySectorRepository;
		
	}

	public function view()
	{
		return view('admin.hospitality-sector.view', HospitalitySector::getViewVars());
	}

	public function viewRooms($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();

		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		
		
		return view('admin.hospitality-sector.rooms', [
			'storeRoute' => route('admin.store.hospitality.sector.sales.channels', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			//	'businessSectorsPercentages' => $hospitalitySector->getBusinessSectorsPercentagesFormatted(),
			'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'rooms' => $rooms = $hospitalitySector->getRooms(),
			'annualAvailableRoomsNights' => $hospitalitySector->getAnnualAvailableRoomsNights($rooms, $hospitalitySector->getTotalRoomsCount()),
			//	'avgDailyRate' => $hospitalitySector->getAvgDailyRate(),
			//'roomCurrency' => $hospitalitySector->getRoomCurrency(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'datesIndexWithYearIndex'=>$datesIndexWithYearIndex,
			//	'adrEscalationRate' => $hospitalitySector->getAdrEscalationRate(),
			//	'adrAtOperationDate' => $hospitalitySector->getAdrAtOperationDate(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			//	'adrAnnualEscalationRate' => $hospitalitySector->adrAnnualEscalationRate(),
			'generalSeasonality' => $hospitalitySector->getRoomsGeneralSeasonality(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewFoods($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.foods', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.foods', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'foods' => $foods = $hospitalitySector->getFoods(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
			'itemsInEachSection' => $hospitalitySector->hasFoodsInSection($foods),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function storeFoods(Request $request, Company $company, $hospitalitySectorId)
	{
	
		$companyId = $company->id;

		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		$foods = $hospitalitySector->foods;
		$message = __('Food & Beverages "F&B" Projections has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.foods', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'food'), [$companyId, $hospitalitySectorId]);
		}
		$hospitalitySector->update([
			'food_collection_policy_type' => $collectionPolicyType = $request->get('food_collection_policy_type'),
			'foods_general_collection_policy_type'=>($isGeneralSystemDefault = (bool)$request->get('is_general_system_default')) ? 'system_default' : 'customize',
			'foods_general_collection_policy_interval'=>$collectionPolicyType == 'general_collection_terms'&& $isGeneralSystemDefault ? $request->get('general_system_default') : null,
			'foods_general_collection_policy_value'=>$collectionPolicyType == 'general_collection_terms'&& !$isGeneralSystemDefault ? convertArrayToJson($request->input('sub_items.general_collection_policy.type.value')) : null,
			'has_visit_food_section'=>true
		]);
		foreach ($foods as $food) {
			$name = $food->getName();
			$isSystemDefaultCollectionPolicy = $request->get('is_system_default')[$name] ?? false;

			$foodIdentifier = $food->getFoodIdentifier();
			$guestCapture = $request->input('guest_capture_cover_percentage.' . $foodIdentifier) ?: [];
			$mealPerGuest = $request->input('meal_per_guest.' . $foodIdentifier) ?: [];
			$percentageFromRoomRevenues = $request->input('percentage_from_rooms_revenues.' . $foodIdentifier) ?: [];
			$coverPerDay = $request->input('cover_per_day.' . $foodIdentifier) ?: [];

			$food->update([
				'f&b_facilities' => $request->input('f&b_facilities.' . $foodIdentifier) ?: $request->input('f&b_facilities.all'),
				'cover_value' => $request->input('cover_value.' . $foodIdentifier) ?: 0,
				'chosen_food_currency' => $request->input('chosen_food_currency.' . $foodIdentifier) ?: null,
				'cover_value_escalation_rate' => $request->input('cover_value_escalation_rate.' . $foodIdentifier) ?: 0,
				'cover_value_at_operation_date' => $request->input('cover_value_at_operation_date.' . $foodIdentifier) ?: null,
				'cover_value_annual_escalation_rate' => $request->input('cover_value_annual_escalation_rate.' . $foodIdentifier) ?: 0,
				'guest_capture_cover_percentage' => $guestCapture,
				'meal_per_guest' => $mealPerGuest,
				'cover_per_day' => $coverPerDay,
				'percentage_from_rooms_revenues' => $percentageFromRoomRevenues,

				'collection_policy_type' => $isSystemDefaultCollectionPolicy ? 'system_default' : 'customize',
				'collection_policy_value' => json_encode($request->get('sub_items')[$name]['collection_policy']['type']['value'] ?? []),
				'collection_policy_interval' => $request->get('system_default')[$name] ?? null
			]);
		}



		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function viewOtherRevenues($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::with('departmentExpenses')->find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.others-revenues', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.other.revenues', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(), $datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			//	'businessSectorsPercentages' => $hospitalitySector->getBusinessSectorsPercentagesFormatted(),
			'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'others' => $others = $hospitalitySector->getOthers(),
			'itemsInEachSection' => $hospitalitySector->hasFoodsInSection($others),
			// 'foods' => $foods = $hospitalitySector->getFoods(),
			// 'rooms' =>  $hospitalitySector->getRooms(),
			//'annualAvailableRoomsNights' => [],
			//	'avgDailyRate' => $hospitalitySector->getAvgDailyRate(),
			//'roomCurrency' => $hospitalitySector->getRoomCurrency(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			//	'adrEscalationRate' => $hospitalitySector->getAdrEscalationRate(),
			//	'adrAtOperationDate' => $hospitalitySector->getAdrAtOperationDate(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			//	'adrAnnualEscalationRate' => $hospitalitySector->adrAnnualEscalationRate(),
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
			// 'currencies' => App(CurrencyRepository::class)->oneFormattedForSelect($model)
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	protected function commonValidation(Request $request)
	{
	}

	public function storeOtherRevenues(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hospitalitySector->update([
			'other_collection_policy_type' => $collectionPolicyType = $request->get('other_collection_policy_type'),
			'others_general_collection_policy_type'=>($isGeneralSystemDefault = (bool)$request->get('is_general_system_default')) ? 'system_default' : 'customize',
			'others_general_collection_policy_interval'=>$collectionPolicyType == 'general_collection_terms'&& $isGeneralSystemDefault ? $request->get('general_system_default') : null,
			'others_general_collection_policy_value'=>$collectionPolicyType == 'general_collection_terms'&& !$isGeneralSystemDefault ? convertArrayToJson($request->input('sub_items.general_collection_policy.type.value')) : null,
			'has_visit_other_section'=>true
		]);
		$others = $hospitalitySector->getOthers();
		$message = __('Other Revenues Projections has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.other.revenues', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'other'), [$companyId, $hospitalitySectorId]);
		}

		foreach ($others as $other) {
			$name = $other->getName();
			$isSystemDefaultCollectionPolicy = $request->get('is_system_default')[$name] ?? false;
			$otherIdentifier = $other->getOtherIdentifier();
			$guestCapture = $request->input('guest_capture_cover_percentage.' . $otherIdentifier) ?: [];
			$percentageFromRoomRevenues = $request->input('percentage_from_rooms_revenues.' . $otherIdentifier) ?: [];
			$oldFAndBFacilityType = $other->getFAndBFacilities();
			$fAndBFacilityType = $request->input('f&b_facilities.' . $otherIdentifier) ?: $request->input('f&b_facilities.all');
			$chargesPerGuest = $request->input('charges_per_guest.' . $otherIdentifier) ?: 0;
			$chosenPerGuest = $request->input('chosen_other_currency.' . $otherIdentifier) ?: null;
			$chargesPerGuestEscalationRate = $request->input('charges_per_guest_escalation_rate.' . $otherIdentifier) ?: 0;
			$chargesPerGuestAtOperationDate  = $request->input('charges_per_guest_at_operation_date.' . $otherIdentifier) ?: null;
			$chargesPerGuestAnnualEscalationRate = $request->input('charges_per_guest_annual_escalation_rate.' . $otherIdentifier) ?: 0;
			$collectionPolicyValue = json_encode($request->get('sub_items')[$name]['collection_policy']['type']['value'] ?? []);
			$collectionPolicyInterval = $request->get('system_default')[$name] ?? null;

			if ($oldFAndBFacilityType && $oldFAndBFacilityType != $fAndBFacilityType) {
				$chargesPerGuest = 0;
				$chosenPerGuest = null;
				$chargesPerGuestEscalationRate = null;
				$chargesPerGuestAtOperationDate = null;
				$chargesPerGuestAnnualEscalationRate = 0;
				$guestCapture = null;
				$percentageFromRoomRevenues = null;
				$collectionPolicyValue = null;
				$collectionPolicyInterval = null;
			}
			$other->update([
				'f&b_facilities' => $fAndBFacilityType,
				'charges_per_guest' => $chargesPerGuest,
				'chosen_other_currency' => $chosenPerGuest,
				'charges_per_guest_escalation_rate' => $chargesPerGuestEscalationRate,
				'charges_per_guest_at_operation_date' => $chargesPerGuestAtOperationDate,
				'charges_per_guest_annual_escalation_rate' => $chargesPerGuestAnnualEscalationRate,
				'guest_capture_cover_percentage' => $guestCapture,
				'percentage_from_rooms_revenues' => $percentageFromRoomRevenues,
				'collection_policy_type' => $isSystemDefaultCollectionPolicy ? 'system_default' : 'customize',
				'collection_policy_value' => $collectionPolicyValue,
				'collection_policy_interval' => $collectionPolicyInterval
			]);
		}

		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function viewRoomsDirectExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');

		

		return view('admin.hospitality-sector.rooms-direct-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.rooms.direct.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'rooms' =>  $hospitalitySector->getRooms(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function storeRoomsDirectExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hasRoomManpower = $request->boolean('has_rooms_manpower');
		$modelName = $request->input('model_name');
		$hospitalitySector->update([
			'has_rooms_manpower' => $hasRoomManpower
		]);
		$namesWithOldNames = [];
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);
				$namesWithOldNames[$currentSectionName][$index] = [
					$oldName => $newName
				];

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);

				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];

					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}

				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Room Direct Expenses  has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			
			$redirectUrl = route('admin.view.hospitality.sector.rooms.direct.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'roomDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl,
			//'namesWithOldNames'=>$namesWithOldNames
		]);
	}

	protected function getCommonStoreData(Request $request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId): array
	{
	
		return [
			'section_name' => $currentSectionName,
			'name' => $newName,
			'model_name' => $modelName,
			'expense_per_night_sold' => $request->input('expense_per_night_sold.' . $currentSectionName . '.' . $index),
			'start_up_cost' => $request->input('start_up_cost.' . $currentSectionName . '.' . $index),
			'date' => $request->input('date.' . $currentSectionName . '.' . $index),
			'expense_per_guest' => $request->input('expense_per_guest.' . $currentSectionName . '.' . $index),
			'inventory_coverage_days' => $request->input('inventory_coverage_days.' . $currentSectionName . '.' . $index),
			'beginning_inventory_balance_value' => $request->input('beginning_inventory_balance_value.' . $currentSectionName . '.' . $index),
			'cash_payment_percentage' => $request->input('cash_payment_percentage.' . $currentSectionName . '.' . $index),
			'deferred_payment_percentage' => $request->input('deferred_payment_percentage.' . $currentSectionName . '.' . $index),
			'due_days' => $request->input('due_days.' . $currentSectionName . '.' . $index),
			'current_net_salary' => $request->input('current_net_salary.' . $currentSectionName . '.' . $index),
			'chosen_currency' => $request->input('chosen_currency.' . $currentSectionName . '.' . $index),
			'escalation_rate' => $request->input('escalation_rate.' . $currentSectionName . '.' . $index),
			'net_salary_at_operation_date' => $request->input('net_salary_at_operation_date.' . $currentSectionName . '.' . $index),
			'net_salary_at_operation_date' => $request->input('net_salary_at_operation_date.' . $currentSectionName . '.' . $index),
			'annual_escalation_rate' => $request->input('annual_escalation_rate.' . $currentSectionName . '.' . $index),
			'salary_taxes' => $request->input('salary_taxes.' . $currentSectionName . '.' . $index),
			'social_insurance' => $request->input('social_insurance.' . $currentSectionName . '.' . $index),
			'chosen_night_expense_currency' => $request->input('chosen_night_expense_currency.' . $currentSectionName . '.' . $index),
			'night_expense_at_operation_date' => $request->input('night_expense_at_operation_date.' . $currentSectionName . '.' . $index),
			'chosen_night_expense_currency' => $request->input('chosen_night_expense_currency.' . $currentSectionName . '.' . $index),
			'night_expense_escalation_rate' => $request->input('night_expense_escalation_rate.' . $currentSectionName . '.' . $index),
			'night_annual_escalation_rate' => $request->input('night_annual_escalation_rate.' . $currentSectionName . '.' . $index),
			'guest_annual_escalation_rate' => $request->input('guest_annual_escalation_rate.' . $currentSectionName . '.' . $index),
			'percentage_from_fixed_assets' => $request->input('percentage_from_fixed_assets.' . $currentSectionName . '.' . $index),
			'guest_expense_at_operation_date' => $request->input('guest_expense_at_operation_date.' . $currentSectionName . '.' . $index),
			'guest_expense_escalation_rate' => $request->input('guest_expense_escalation_rate.' . $currentSectionName . '.' . $index),
			'expense_per_guest_sold' => $request->input('expense_per_guest_sold.' . $currentSectionName . '.' . $index),
			'opex_payment_terms' => $request->input('opex_payment_terms.' . $currentSectionName . '.' . $index),
			'payment_month' => $request->input('payment_month.' . $currentSectionName . '.' . $index),
			'company_id' => $companyId,
			'hospitality_sector_id' => $hospitalitySectorId,
			'payload' => $request->input('payload.' . $currentSectionName . '.' . $index),
			'manpower_payload' => $request->input('manpower_payload.' . $currentSectionName . '.' . $index),
		];
	}

	protected function getCommonStoreDataForFFEItems(Request $request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId, $ffeId): array
	{
		return [
			'section_name' => $currentSectionName,
			'name' => $newName,
			'model_name' => $modelName,
			'company_id' => $companyId,
			'hospitality_sector_id' => $hospitalitySectorId,
			'ffe_id'=>$ffeId,
			'depreciation_duration'=>$request->input('depreciation_duration.' . $currentSectionName . '.' . $index),
			'item_cost'=>$request->input('item_cost.' . $currentSectionName . '.' . $index),
			'contingency_rate'=>$request->input('contingency_rate.' . $currentSectionName . '.' . $index),
			'currency_name'=>$request->input('currency_name.' . $currentSectionName . '.' . $index),
			'replacement_cost_rate'=>$request->input('replacement_cost_rate.' . $currentSectionName . '.' . $index),
			'replacement_interval'=>$request->input('replacement_interval.' . $currentSectionName . '.' . $index),
		];
	}

	public function storeFoodsDirectExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hasFoodManpower = $request->boolean('has_foods_manpower');
		$modelName = $request->input('model_name');
		$hospitalitySector->update([
			'has_foods_manpower' => $hasFoodManpower
		]);
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('F&B has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
		
			$redirectUrl = route('admin.view.hospitality.sector.foods.direct.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'foodDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}
	
	
	

	public function storeCasinosDirectExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hasCasinoManpower = $request->boolean('has_casinos_manpower');
		$modelName = $request->input('model_name');
		$hospitalitySector->update([
			'has_casinos_manpower' => $hasCasinoManpower
		]);
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Gaming has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.casinos.direct.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'casinoDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storeOtherRevenueExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hasCasinoManpower = $request->boolean('has_other_revenue_manpower');
		$modelName = $request->input('model_name');
		$hospitalitySector->update([
			'has_other_revenue_manpower' => $hasCasinoManpower
		]);
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Other Revenue Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.other.revenue.direct.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'otherDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storeGeneralExpenses(Request $request, Company $company, $hospitalitySectorId)
	{

		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hasCasinoManpower = $request->boolean('has_sales_and_general_manpower');
		$modelName = $request->input('model_name');
		$hospitalitySector->update([
			'has_sales_and_general_manpower' => $hasCasinoManpower
		]);
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('General Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.general.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'generalDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storeMarketingExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		// $validator = $this->commonValidation($request);

		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hasCasinoManpower = $request->boolean('has_sales_and_general_manpower');
		$modelName = $request->input('model_name');
		$hospitalitySector->update([
			'has_sales_and_general_manpower' => $hasCasinoManpower
		]);
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Sales And Marketing Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.marketing.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'marketingDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storeEnergyExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$modelName = $request->input('model_name');

		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Energy Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.energy.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'energyDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	protected function getFFEData(Request $request):array
	{
		return [
			'hospitality_sector_id'=>$request->get('hospitality_sector_id'),
			'company_id'=>$request->get('company_id'),
			'start_date'=>$request->get('start_date'),
			'duration'=>$request->get('duration'),
			'end_date'=>$request->get('end_date'),
			'execution_method'=>$request->get('execution_method'),
			'down_payment'=>$request->get('down_payment'),
			'balance_rate_one'=>$request->get('balance_rate_one'),
			'balance_rate_two'=>$request->get('balance_rate_two'),
			'due_one'=>$request->get('due_one'),
			'due_two'=>$request->get('due_two'),
			'created_at'=>now(),
			'ffe_equity_funding'=>$request->get('equity_funding')
		];
	}

	public function storeFFECost(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$modelName = $request->input('model_name');
		$ffe = $hospitalitySector->ffe;
		$ffeData = $this->getFFEData($request);

		if ($ffe) {
			$ffe->update($ffeData);
		} else {
			$ffe = $hospitalitySector->ffe()->create($ffeData);
		}
		$ffeId =$ffe->id;
		$ffe->storeLoans($request->get('loans'), $companyId, $ffeId);

		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreDataForFFEItems($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId, $ffeId);
				if ($newName && !$oldName) {
					$hospitalitySector->ffeItems()->create($data);
				}
				if ($newName && $oldName) {
					$currentFFEItems = $hospitalitySector->ffeItemsFor($currentSectionName, $modelName)->get()[$index];
					if ($currentFFEItems) {
						$currentFFEItems->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->ffeItemsFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('FFE Cost has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.ffe.cost', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'ffeCost'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storePropertyExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$modelName = $request->input('model_name');

		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index] ??null;
				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && (!$oldName || !$currentDepartmentExpense)) {
					$hospitalitySector->departmentExpenses()->create($data);
				}

				if ($newName && $oldName && $currentDepartmentExpense) {
					$currentDepartmentExpense->update($data);
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Property Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.property.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'propertyDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storeManagementFees(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		$hospitalitySector->managementFees()->delete();
		foreach ($request->get('name') as $currentSectionName=>$names) {
			foreach ($names as $currentIndex=>$name) {
				$payloadAtIndex = $request->input('payload.' . $currentSectionName . '.' . $currentIndex);
				$hospitalitySector->managementFees()->create([
					'payload'=>$payloadAtIndex,
					'company_id'=>$request->get('company_id'),
					'name'=>$name,
					'section_name'=>$currentSectionName,
					'hospitality_sector_id'=>$hospitalitySector->id,
					'model_name'=>$request->get('model_name')
				]);
			}
		}

		$message = __('Management Fees has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.management.fees', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'managementFee'), [$companyId, $hospitalitySectorId]);
		}

		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}
	
	
	

	public function storeMeetingExpenses(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$modelName = $request->input('model_name');

		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Meeting Spaces Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.meeting.direct.expenses', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'meetingDirectExpense'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function viewFoodsDirectExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.foods-direct-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.foods.direct.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'foods' =>  $hospitalitySector->getFoods(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	
	
	public function viewCasinosDirectExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		
		return view('admin.hospitality-sector.casinos-direct-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.casinos.direct.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewOtherRevenueExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');


$yearIndexWithYear =App('yearIndexWithYear');

$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');

		return view('admin.hospitality-sector.other-revenue-direct-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.other.revenue.direct.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber ),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			// 'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewGeneralExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');


		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.general-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.general.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear ,$dateIndexWithDate,$dateWithMonthNumber),
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewMarketingExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');


	$yearIndexWithYear =App('yearIndexWithYear');
	$dateIndexWithDate =App('dateIndexWithDate');
	$dateWithMonthNumber=App('dateWithMonthNumber');

		return view('admin.hospitality-sector.marketing-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.marketing.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber ),
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewMeetingExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');


		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.meeting-spaces-direct-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.meeting.direct.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber ),
			'hospitality_sector_id' => $hospitalitySectorId,
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewEnergyExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');


$yearIndexWithYear =App('yearIndexWithYear');
$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');

		return view('admin.hospitality-sector.energy-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.energy.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			'hospitality_sector_id' => $hospitalitySectorId,
			'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewFFECost($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		$ffe = $hospitalitySector->getFFE() ?: new FFE();
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');


		$yearIndexWithYear =App('yearIndexWithYear');

		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');

		return view('admin.hospitality-sector.ffe-cost', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.ffe.cost', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $ffe,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear ,$dateIndexWithDate,$dateWithMonthNumber),
			'hospitality_sector_id' => $hospitalitySectorId,
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
			'hospitalitySector'=>$hospitalitySector
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewPropertyExpenses($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.property-expenses', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.property.expenses', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			'hospitality_sector_id' => $hospitalitySectorId,
			'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewManagementFees($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.management-fees', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.management.fees', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			'hospitality_sector_id' => $hospitalitySectorId,
			'casinos' =>  $hospitalitySector->getCasinos(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}
	public function viewStartUpCost($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.start-up-cost', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.start.up.cost', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'hospitalitySector'=>$hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'foods' =>  $hospitalitySector->getFoods(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			// 'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	
	public function storeStartUpCost(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		// $hasFoodManpower = $request->boolean('has_foods_manpower');
		$modelName = $request->input('model_name');
		// $hospitalitySector->update([
		// 	'has_foods_manpower' => $hasFoodManpower
		// ]);
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $hospitalitySectorId);
				if ($newName && !$oldName) {
					$hospitalitySector->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $hospitalitySector->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('Start-up cost has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
		
			$redirectUrl = route('admin.view.hospitality.sector.start.up.cost', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'startUpCost'), [$companyId, $hospitalitySectorId]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}
	

	public function viewMeetings($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		return view('admin.hospitality-sector.meetings', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.meetings', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			//	'businessSectorsPercentages' => $hospitalitySector->getBusinessSectorsPercentagesFormatted(),
			'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'meetings' => $meetings = $hospitalitySector->getMeetings(),
			//'rooms' =>  $hospitalitySector->getRooms(),
			//'annualAvailableRoomsNights' => [],
			//	'avgDailyRate' => $hospitalitySector->getAvgDailyRate(),
			//'roomCurrency' => $hospitalitySector->getRoomCurrency(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			//	'adrEscalationRate' => $hospitalitySector->getAdrEscalationRate(),
			//	'adrAtOperationDate' => $hospitalitySector->getAdrAtOperationDate(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			//	'adrAnnualEscalationRate' => $hospitalitySector->adrAnnualEscalationRate(),
			'generalGuestSeasonality' => $hospitalitySector->getGeneralMeetingSeasonalityFormatted('guest'),
			'generalRentSeasonality' => $hospitalitySector->getGeneralMeetingSeasonalityFormatted('rent'),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
			'itemsInEachSection' => $hospitalitySector->hasFoodsInSection($meetings),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			// 'currencies' => App(CurrencyRepository::class)->oneFormattedForSelect($model)
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function viewCasinos($companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		return view('admin.hospitality-sector.casinos', array_merge([
			'storeRoute' => route('admin.store.hospitality.sector.casinos', [
				'hospitality_sector_id' => $hospitalitySectorId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $hospitalitySector,
			'yearsWithItsMonths' => $hospitalitySector->getOperationDurationPerYear( $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber),
			// 'salesChannels' => $hospitalitySector->salesChannels,
			'hospitality_sector_id' => $hospitalitySectorId,
			//	'businessSectorsPercentages' => $hospitalitySector->getBusinessSectorsPercentagesFormatted(),
			// 'businessSectorsDiscounts' => $hospitalitySector->getBusinessSectorsDiscountsFormatted(),
			// 'selectedSalesRevenues' => $hospitalitySector->getSelectedSalesRevenuesFormatted(),
			'casinos' => $casinos = $hospitalitySector->getCasinos(),
			//'rooms' =>  $hospitalitySector->getRooms(),
			//'annualAvailableRoomsNights' => [],
			//	'avgDailyRate' => $hospitalitySector->getAvgDailyRate(),
			//'roomCurrency' => $hospitalitySector->getRoomCurrency(),
			'studyCurrency' => $hospitalitySector->getCurrenciesForSelect(),
			//	'adrEscalationRate' => $hospitalitySector->getAdrEscalationRate(),
			//	'adrAtOperationDate' => $hospitalitySector->getAdrAtOperationDate(),
			'daysDifference' => $hospitalitySector->getDiffBetweenOperationStartDateAndStudyStartDate(),
			//	'adrAnnualEscalationRate' => $hospitalitySector->adrAnnualEscalationRate(),
			// 'generalSeasonality'=>$hospitalitySector->getGeneralSeasonalityFormatted(),
			// 'perRoomSeasonality'=>$hospitalitySector->getPerSeasonalitySeasonalityFormatted(),
			'itemsInEachSection' => $hospitalitySector->hasFoodsInSection($casinos),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		], $hospitalitySector->calculateRoomRevenueAndGuestCount()));
	}

	public function storeCasinos(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;

		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		$hospitalitySector->update([
			'casino_collection_policy_type' => $collectionPolicyType=$request->get('casino_collection_policy_type'),
			'casinos_general_collection_policy_type'=>($isGeneralSystemDefault = (bool)$request->get('is_general_system_default')) ? 'system_default' : 'customize',
			'casinos_general_collection_policy_interval'=>$collectionPolicyType == 'general_collection_terms'&& $isGeneralSystemDefault ? $request->get('general_system_default') : null,
			'casinos_general_collection_policy_value'=>$collectionPolicyType == 'general_collection_terms'&& !$isGeneralSystemDefault ? convertArrayToJson($request->input('sub_items.general_collection_policy.type.value')) : null,
			'has_visit_casino_section'=>true
		]);

		$casinos = $hospitalitySector->getCasinos();

		$message = __('Gaming Sales Projections has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.casinos', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route('admin.view.hospitality.sector.meetings', [$companyId, $hospitalitySectorId]);
		}

		foreach ($casinos as $casino) {
			$name = $casino->getName();
			$casinoIdentifier = $casino->getCasinoIdentifier();
			$oldFAndBFacilityType = $casino->getFAndBFacilities();
			$fAndBFacilityType = $request->input('f&b_facilities.' . $casinoIdentifier) ?: $request->input('f&b_facilities.all');
			$guestCapture = $request->input('guest_capture_cover_percentage.' . $casinoIdentifier) ?: [];
			$percentageFromRoomRevenues = $request->input('percentage_from_rooms_revenues.' . $casinoIdentifier) ?: [];
			$coverPerDay = $request->input('cover_per_day.' . $casinoIdentifier) ?: [];
			$coverValue = $request->input('cover_value.' . $casinoIdentifier) ?: 0;
			$chosenCurrency = $request->input('chosen_casino_currency.' . $casinoIdentifier) ?: null;
			$chargesValueEscalationRate = $request->input('charges_value_escalation_rate.' . $casinoIdentifier) ?: 0;
			$chargesValueAtOperationDate = $request->input('charges_value_at_operation_date.' . $casinoIdentifier) ?: null;
			$chargesValueAnnualEscalationRate = $request->input('charges_value_annual_escalation_rate.' . $casinoIdentifier) ?: 0;
			$collectionPolicyValue = json_encode($request->get('sub_items')[$name]['collection_policy']['type']['value'] ?? []);
			$collectionPolicyInterval = $request->get('system_default')[$name] ?? null;

			if ($oldFAndBFacilityType && $oldFAndBFacilityType != $fAndBFacilityType) {
				$guestCapture = null;
				$percentageFromRoomRevenues = null;
				$coverPerDay = null;
				$coverValue = 0;
				$chosenCurrency = null;
				$chargesValueEscalationRate = 0;
				$chargesValueAtOperationDate = 0;
				$chargesValueAnnualEscalationRate = 0;
				$collectionPolicyValue = null;
				$collectionPolicyInterval = null;
			}
			//	$mealPerGuest = $request->input('meal_per_guest.'.$casinoIdentifier)?:[];

			$isSystemDefaultCollectionPolicy = $request->get('is_system_default')[$name] ?? false;


			$casino->update([
				'f&b_facilities' => $fAndBFacilityType,
				'cover_value' => $coverValue,
				'chosen_casino_currency' => $chosenCurrency,
				'charges_value_escalation_rate' => $chargesValueEscalationRate,
				'charges_value_at_operation_date' => $chargesValueAtOperationDate,
				'charges_value_annual_escalation_rate' => $chargesValueAnnualEscalationRate,
				'guest_capture_cover_percentage' => $guestCapture,
				'cover_per_day' => $coverPerDay,
				'percentage_from_rooms_revenues' => $percentageFromRoomRevenues,
				'collection_policy_type' => $isSystemDefaultCollectionPolicy ? 'system_default' : 'customize',
				'collection_policy_value' => $collectionPolicyValue,
				'collection_policy_interval' => $collectionPolicyInterval

			]);
		}



		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function storeMeetings(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;

		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		$meetings = $hospitalitySector->getMeetings();

		$message = __('Meeting Spaces Sales Projections has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.hospitality.sector.meetings', [$companyId, $hospitalitySectorId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'meeting'), [$companyId, $hospitalitySectorId]);
		}

		$guestSeasonalityType = $request->get('guest_meeting_seasonality_type');
		$guestSeasonalityInterval = $request->get('guest_meeting_seasonality_interval');
		$guestGeneralSeasonality = $this->getGeneralSeasonality($guestSeasonalityType, $guestSeasonalityInterval, $request, 'guest_');


		$rentSeasonalityType = $request->get('rent_meeting_seasonality_type');
		$rentSeasonalityInterval = $request->get('rent_meeting_seasonality_interval');
		$rentGeneralSeasonality = $this->getGeneralSeasonality($rentSeasonalityType, $rentSeasonalityInterval, $request, 'rent_');

		$hospitalitySector->update([
			'guest_meeting_seasonality_type' => $guestSeasonalityType,
			'guest_meeting_seasonality_interval' => $guestSeasonalityInterval,
			'guest_meeting_general_seasonality' => $guestGeneralSeasonality,
			'rent_meeting_seasonality_type' => $rentSeasonalityType,
			'rent_meeting_seasonality_interval' => $rentSeasonalityInterval,
			'rent_meeting_general_seasonality' => $rentGeneralSeasonality,
			'meeting_collection_policy_type' => $collectionPolicyType = $request->get('meeting_collection_policy_type'),
			'meetings_general_collection_policy_type'=>($isGeneralSystemDefault = (bool)$request->get('is_general_system_default')) ? 'system_default' : 'customize',
			'meetings_general_collection_policy_interval'=>$collectionPolicyType == 'general_collection_terms'&& $isGeneralSystemDefault ? $request->get('general_system_default') : null,
			'meetings_general_collection_policy_value'=>$collectionPolicyType == 'general_collection_terms'&& !$isGeneralSystemDefault ? convertArrayToJson($request->input('sub_items.general_collection_policy.type.value')) : null,
			'has_visit_meeting_section'=>true
		]);

		foreach ($meetings as $meeting) {
			$name = $meeting->getName();
			$isSystemDefaultCollectionPolicy = $request->get('is_system_default')[$name] ?? false;


			$meetingIdentifier = $meeting->getMeetingIdentifier();
			$guestCapture = $request->input('guest_capture_cover_percentage.' . $meetingIdentifier) ?: [];
			$percentageFromRevenues = $request->input('percentage_from_f_and_b_revenues.' . $meetingIdentifier) ?: [];

			$fAndBFacilityType = $request->input('f&b_facilities.' . $meetingIdentifier) ?: $request->input('f&b_facilities.all');
			$coverValue = $request->input('cover_value.' . $meetingIdentifier) ?: 0;

			$oldFAndBFacilityType = $meeting->getFAndBFacilities();
			$chosenMeetingCurrency = $request->input('chosen_meeting_currency.' . $meetingIdentifier) ?: null;
			$chargesValueEscalationRate = $request->input('charges_value_escalation_rate.' . $meetingIdentifier) ?: 0;
			$chargesValueAtOperationDate = $request->input('charges_value_at_operation_date.' . $meetingIdentifier) ?: null;
			$chargesValueAnnualEscalationRate = $request->input('charges_value_annual_escalation_rate.' . $meetingIdentifier) ?: 0;
			$guestSeasonality = $guestSeasonalityType == 'per-meeting-type-seasonality' ? $this->getPerMeetingSeasonality($guestSeasonalityType, $guestSeasonalityInterval, $request, $meeting->getMeetingIdentifier(), 'guest_') : null;
			$rentSeasonality = $rentSeasonalityType == 'per-meeting-type-seasonality' ? $this->getPerMeetingSeasonality($rentSeasonalityType, $rentSeasonalityInterval, $request, $meeting->getMeetingIdentifier(), 'rent_') : null;
			$chargesValuePerGuest = $request->input('charges_value_per_guest.' . $meetingIdentifier);
			$collectionPolicyValue = json_encode($request->get('sub_items')[$name]['collection_policy']['type']['value'] ?? []);
			$collectionPolicyInterval = $request->get('system_default')[$name] ?? null;


			if ($oldFAndBFacilityType && $oldFAndBFacilityType != $fAndBFacilityType) {
				$coverValue =  0;
				$chargesValueEscalationRate = 0;
				$chosenMeetingCurrency = null;
				$chargesValueAtOperationDate = null;
				$chargesValueAnnualEscalationRate = 0;
				$guestCapture = null;
				$guestSeasonality = null;
				$rentSeasonality = null;
				$chargesValuePerGuest = null;
				$collectionPolicyValue = null;
				$collectionPolicyInterval = null;
			}
			$meeting->update([
				'f&b_facilities' => $fAndBFacilityType,
				'cover_value' => $coverValue,
				'chosen_meeting_currency' => $chosenMeetingCurrency,
				'charges_value_escalation_rate' => $chargesValueEscalationRate,
				'charges_value_at_operation_date' => $chargesValueAtOperationDate,
				'charges_value_annual_escalation_rate' => $chargesValueAnnualEscalationRate,
				'guest_capture_cover_percentage' => $guestCapture,
				'guest_seasonality' => $guestSeasonality,
				'rent_seasonality' => $rentSeasonality,
				'charges_value_per_guest' => $chargesValuePerGuest,
				'percentage_from_f_and_b_revenues' => $percentageFromRevenues,
				'collection_policy_type' => $isSystemDefaultCollectionPolicy ? 'system_default' : 'customize',
				'collection_policy_value' => $collectionPolicyValue,
				'collection_policy_interval' => $collectionPolicyInterval


			]);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}

	public function create()
	{
		return view('admin.hospitality-sector.create', HospitalitySector::getViewVars());
	}

	public function paginate(Request $request)
	{
		return $this->hospitalitySectorRepository->paginate($request);
	}

	public function store(HospitalitySectorRequest $request)
	{
		$hospitalitySector = $this->hospitalitySectorRepository->store($request);
		$companyId = getCurrentCompanyId();

		$redirectUrl = route('admin.view.hospitality.sector', $companyId);

		$hasSalesChannels = $request->get('has_sales_channels') && count((array) $request->get('salesChannels'));
		$redirectUrl = route('admin.view.hospitality.sector.sales.channels', ['company' => $companyId, 'hospitality_sector_id' => $hospitalitySector->id]);
		if ($hasSalesChannels) {
		}

		return response()->json([
			'status' => true,
			'message' => __('Hospitality Sector Has Been Stored Successfully'),
			'redirectTo' => $redirectUrl
		]);
	}

	protected function getGeneralSeasonality(?string $seasonalityType, ?string $seasonalityInterval, Request $request, $prepend = '')
	{
		$generalSeasonality = [];
		if ($seasonalityType != 'general-seasonality') {
			return null;
		}

		if ($seasonalityInterval == 'flat-seasonality') {
			$generalSeasonality = $request->get($prepend . 'flat_general_seasonality');
		}
		if ($seasonalityInterval == 'monthly-seasonality') {
			$generalSeasonality = $request->get($prepend . 'monthly_general_seasonality');
		}
		if ($seasonalityInterval == 'quarterly-seasonality') {
			$generalSeasonality = $request->get($prepend . 'quarterly_general_seasonality');
		}

		return json_encode((array)$generalSeasonality);
	}

	protected function getPerMeetingSeasonality(?string $seasonalityType, ?string $seasonalityInterval, Request $request, $meetingIdentifier, $prepend = '')
	{
		$perMeetingSeasonality = [];
		if ($seasonalityType == 'general-seasonality') {
			return null;
		}

		if ($seasonalityInterval == 'flat-seasonality') {
			$perMeetingSeasonality = $request->get($prepend . 'flat_per_meeting_seasonality')[$meetingIdentifier] ?? null;
		}
		if ($seasonalityInterval == 'monthly-seasonality') {
			$perMeetingSeasonality = $request->get($prepend . 'monthly_per_meeting_seasonality')[$meetingIdentifier] ?? null;
		}
		if ($seasonalityInterval == 'quarterly-seasonality') {
			$perMeetingSeasonality = $request->input($prepend . 'quarterly_per_meeting_seasonality.' . $meetingIdentifier);
		}

		return $perMeetingSeasonality;
	}

	protected function getPerRoomSeasonality(?string $seasonalityType, ?string $seasonalityInterval, Request $request, $roomIdentifier)
	{
		$perRoomSeasonality = [];
		if ($seasonalityType == 'general-seasonality') {
			return null;
		}

		if ($seasonalityInterval == 'flat-seasonality') {
			$perRoomSeasonality = $request->get('flat_per_room_seasonality')[$roomIdentifier] ?? null;
		}
		if ($seasonalityInterval == 'monthly-seasonality') {
			$perRoomSeasonality = $request->get('monthly_per_room_seasonality')[$roomIdentifier] ?? null;
		}
		if ($seasonalityInterval == 'quarterly-seasonality') {
			$perRoomSeasonality = $request->input('quarterly_per_room_seasonality.' . $roomIdentifier);
		}
		// foreach($perRoomSeasonality as $fullMonthName => $unformattedValue){
		// 	$perRoomSeasonalityWithUnFormattedNumbers[$fullMonthName] = getAmount($unformattedValue);
		// }
		return json_encode((array)$perRoomSeasonality);

		// return $request->get('flat_per_room_seasonality')
	}

	public function storeRooms(Request $request, Company $company, $hospitalitySectorId)
	{
		$companyId = $company->id;

		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$occupancyRateType = $request->get('occupancy_rate_type');
		$seasonalityType = $request->get('seasonality_type');
		$seasonalityInterval = $request->get('seasonality_interval');
		// $hasSalesChannelShareDiscount = $request->get('add_sales_channels_share_discount');
		$hasSalesChannelShareDiscount = $hospitalitySector->salesChannels->count();
		
		$generalSeasonality = $this->getGeneralSeasonality($seasonalityType, $seasonalityInterval, $request);
		$hospitalitySector->update([
			'general_occupancy_rate' => $occupancyRateType == 'general_occupancy_rate' ? json_encode((array)$request->get('general_occupancy_rate')) : null,
			'seasonality_type' => $seasonalityType,
			'seasonality_interval' => $seasonalityInterval,
			'exchange_rates'=>json_encode($request->get('exchange_rates',[])),
			'general_seasonality' => $generalSeasonality,
			'add_sales_channels_share_discount' => $hasSalesChannelShareDiscount,
			'room_collection_policy_type' => $collectionPolicyType = $request->get('room_collection_policy_type'),
			'rooms_general_collection_policy_type'=>($isGeneralSystemDefault = (bool)$request->get('is_general_system_default')) ? 'system_default' : 'customize',
			'rooms_general_collection_policy_interval'=>$collectionPolicyType == 'general_collection_terms'&& $isGeneralSystemDefault ? $request->get('general_system_default') : null,
			'rooms_general_collection_policy_value'=>$collectionPolicyType == 'general_collection_terms'&& !$isGeneralSystemDefault ? convertArrayToJson($request->input('sub_items.general_collection_policy.type.value')) : null,
			'has_visit_room_section'=>true
		]);

		foreach ($hospitalitySector->rooms as $room) {
			$roomIdentifier = $room->getRoomIdentifier();


			$occupancyRatePerRoom = $occupancyRateType == 'occupancy_rate_per_room' ? (array)$request->get('occupancy_rate_per_room')[$room->getRoomIdentifier()] : [];
			$room->update([
				//		'available_annual_rooms_nights'=>$request->get('available_annual_rooms_nights')[$roomIdentifier] ??0,
				'average_daily_rate' => $request->get('average_daily_rate')[$roomIdentifier] ?? 0,
				'chosen_room_currency' => $request->get('chosen_room_currency')[$roomIdentifier] ?? null,
				'average_daily_rate_escalation_rate' => $request->get('average_daily_rate_escalation_rate')[$roomIdentifier] ?? 0,
				//	'average_daily_rate_estimation_date'=>$request->get('average_daily_rate_estimation_date')[$roomIdentifier] ??null,
				'average_daily_rate_at_operation_date' => $request->get('average_daily_rate_at_operation_date')[$roomIdentifier] ?? null,
				'average_daily_rate_annual_escalation_rate' => $request->get('average_daily_rate_annual_escalation_rate')[$roomIdentifier] ?? null,
				'occupancy_rate_type' => $occupancyRateType,
				'occupancy_rate_per_room' => json_encode($occupancyRatePerRoom),
				'seasonality' => $seasonalityType == 'per-room-type-seasonality' ? $this->getPerRoomSeasonality($seasonalityType, $seasonalityInterval, $request, $room->getRoomIdentifier()) : null
			]);
		}
		foreach ($hospitalitySector->salesChannels as $salesChannel) {
			$salesChannelName = $salesChannel->getName();
			$isSystemDefaultCollectionPolicy = $request->get('is_system_default')[$salesChannelName] ?? false;
			$salesChannel->update([
				'revenue_share_percentage' => $hasSalesChannelShareDiscount ? json_encode((array)$request->get('revenue_share_percentage')[$salesChannelName]) : null,
				'discount_or_commission' => $hasSalesChannelShareDiscount ? json_encode((array)$request->get('discount_or_commission')[$salesChannelName]) : null,
				'collection_policy_type' => $isSystemDefaultCollectionPolicy ? 'system_default' : 'customize',
				'collection_policy_value' => json_encode($request->get('sub_items')[$salesChannelName]['collection_policy']['type']['value'] ?? []),
				'collection_policy_interval' => $request->get('system_default')[$salesChannelName] ?? null
			]);
		}

		foreach ((array)$request->salesChannelsPercentage as $salesChannelName => $dateValues) {
			$currentDiscountOrCommissions = (array)$request->get('salesChannelsDiscount')[$salesChannelName] ?? [];
			$hospitalitySector->salesChannels()
				->where('name', $salesChannelName)->where('hospitality_sector_id', $hospitalitySectorId)
				->update([
					'percentages' => json_encode($dateValues),
					'discount_or_commission' => json_encode($currentDiscountOrCommissions)
				]);
		}

		$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'room'), [$companyId, $hospitalitySectorId]);

		return response()->json([
			'status' => true,
			'message' => __('Accommodation & Rooms Sales Projections has been saved successfully '),
			'redirectTo' => $redirectUrl
		]);
	}

	public function edit(Company $company, Request $request, HospitalitySector $hospitalitySector)
	{
		return view(HospitalitySector::getCrudViewName(), array_merge(HospitalitySector::getViewVars(), [
			'type' => 'edit',
			'model' => $hospitalitySector,
			'hospitalitySector' => $hospitalitySector
		]));
	}

	public function updateDate(Company $company, Request $request)
	{
		$hospitalitySector = HospitalitySector::find($request->get('financial_statement_id'));
		$dateString = str_replace(['-', '_'], '/', $request->get('date'));
		$hospitalitySector->update([
			'start_from' => $dateString
		]);

		return response()->json([
			'status' => true
		]);
	}

	public function updateDurationType(Company $company, Request $request)
	{
		$hospitalitySector = HospitalitySector::find($request->get('hospitalitySectorId'));
		if ($durationType = Str::slug($request->get('durationType'))) {
			$hospitalitySector->update([
				'duration_type' => $durationType
			]);
		}

		return response()->json([
			'status' => true
		]);
	}

	public function update(Company $company, Request $request, HospitalitySector $hospitalitySector)
	{
		$this->hospitalitySectorRepository->update($hospitalitySector, $request);

		$companyId = getCurrentCompanyId();


		$redirectUrl = route('admin.view.hospitality.sector', getCurrentCompanyId());

		$hasSalesChannels = $request->get('has_sales_channels') && count((array) $request->get('salesChannels'));

		$redirectUrl = route('admin.view.hospitality.sector.sales.channels', ['company' => $companyId, 'hospitality_sector_id' => $hospitalitySector->id]);
		if ($hasSalesChannels) {
		}


		return response()->json([
			'status' => true,
			'message' => __('Hospitality Sector Has Been Updated Successfully'),
			'redirectTo' => $redirectUrl
		]);
	}

	public function export(Request $request)
	{
		return (new HospitalitySectorExport($this->hospitalitySectorRepository->export($request), $request))->download();
	}

	public function exportReport(Request $request)
	{
		$formattedData = $this->formatReportDataForExport($request);
		$hospitalitySectorId = array_key_first($request->get('valueMainRowThatHasSubItems'));
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);

		return (new HospitalitySectorExport(collect($formattedData), $request, $hospitalitySector))->download();
	}

	protected function combineMainValuesWithItsPercentageRows(array $firstItems, array $secondItems): array
	{
		$mergeArray = [];
		foreach ($firstItems as $hospitalitySectorId => $hospitalitySectorValues) {
			foreach ($hospitalitySectorValues as $hospitalitySectorItemId => $hospitalitySectorItemsValues) {
				foreach ($hospitalitySectorItemsValues as $date => $value) {
					$mergeArray[$hospitalitySectorId][$hospitalitySectorItemId][$date] = $value;
				}
			}
		}
		foreach ($secondItems as $hospitalitySectorId => $hospitalitySectorValues) {
			foreach ($hospitalitySectorValues as $hospitalitySectorItemId => $hospitalitySectorItemsValues) {
				foreach ($hospitalitySectorItemsValues as $date => $value) {
					$mergeArray[$hospitalitySectorId][$hospitalitySectorItemId][$date] = $value;
				}
			}
		}

		$mergeArray[$hospitalitySectorId] = orderArrayByItemsKeys($mergeArray[$hospitalitySectorId]);

		return $mergeArray;
	}

	public function formatReportDataForExport(Request $request)
	{
		// $financial
		$formattedData = [];
		$totals = $request->get('totals');
		$subTotals = $request->get('subTotals');
		$rateHospitalitySectorItemsIds = HospitalitySectorItem::rateFieldsIds();
		$combineMainValuesWithItsPercentageRows = $this->combineMainValuesWithItsPercentageRows($request->get('valueMainRowThatHasSubItems'), $request->get('valueMainRowWithoutSubItems'));
		foreach ($combineMainValuesWithItsPercentageRows as $hospitalitySectorId => $hospitalitySectorValues) {
			foreach ($hospitalitySectorValues as $hospitalitySectorItemId => $hospitalitySectorItemsValues) {
				$hospitalitySectorItem = HospitalitySectorItem::find($hospitalitySectorItemId);
				$formattedData[$hospitalitySectorItem->name]['Name'] = $hospitalitySectorItem->name;
				foreach ($hospitalitySectorItemsValues as $date => $value) {
					$formattedData[$hospitalitySectorItem->name][$date] = in_array($hospitalitySectorItemId, $rateHospitalitySectorItemsIds) ? number_format($value, 2) . ' %' : number_format($value);
				}
				$total = $totals[$hospitalitySectorId][$hospitalitySectorItemId];
				$formattedData[$hospitalitySectorItem->name]['Total'] = in_array($hospitalitySectorItemId, $rateHospitalitySectorItemsIds) ? number_format($total, 2) . ' %' : number_format($total);
				if (isset($request->get('value')[$hospitalitySectorId][$hospitalitySectorItemId])) {
					foreach ($hospitalitySectorItemSubItems = $request->get('value')[$hospitalitySectorId][$hospitalitySectorItemId] as $hospitalitySectorItemSubItemName => $hospitalitySectorItemSubItemValues) {
						$formattedData[$hospitalitySectorItemSubItemName]['Name'] = $hospitalitySectorItemSubItemName;
						foreach ($hospitalitySectorItemSubItemValues as $hospitalitySectorItemSubItemDate => $hospitalitySectorItemSubItemValue) {
							$formattedData[$hospitalitySectorItemSubItemName][$hospitalitySectorItemSubItemDate] = in_array($hospitalitySectorItemId, $rateHospitalitySectorItemsIds) ? number_format($hospitalitySectorItemSubItemValue, 2) . ' %' : number_format($hospitalitySectorItemSubItemValue);
						}
						$total = $subTotals[$hospitalitySectorId][$hospitalitySectorItemId][$hospitalitySectorItemSubItemName];
						$formattedData[$hospitalitySectorItemSubItemName]['Total'] = in_array($hospitalitySectorItemId, $rateHospitalitySectorItemsIds) ? number_format($total, 2) . ' %' : number_format($total);
					}
				}
			}
		}

		return $formattedData;
	}

	public function viewReceivableStatement($companyId, $hospitalitySectorId, $type)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		$onlyMonthlyDashboardItems = [];

		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		


		
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();

		if($type == 'total'){
			
			$dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['total']['total'] = sumSecondKeyInThreeDimArr(
				[
					$dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['rooms']['total']??[],
					$dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['foods']['total']??[],
					$dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['gaming']['total']??[],
					$dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['meetings']['total']??[],
					$dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['others']['total']??[],
				]
			);
		}
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithDateIndex,$operationDates,$fixedAssetsLoan);
		
		return view('admin.hospitality-sector.customer-receivable-statement', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'type' => $type,
			'salesChannelsNames' => array_keys($dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance'][$type] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewFixedAssetsSuppliersStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesAsStringAndIndex =$hospitalitySector->getDatesAsStringAndIndex(); 
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber= App('dateWithMonthNumber');
		
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$studyDurationPerYear = $hospitalitySector->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
		$studyDates = $hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
		$totalPropertyPurchaseCost = $dashboardItems['totalPropertyPurchaseCost']??0;
		$propertyPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Property Payments']??[];

		$totalLandPurchaseCost = $dashboardItems['totalLandPurchaseCost']??0;
		$landPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Land Payments']??[];


		$hardConstructionExecutionAndPayment = $dashboardItems['hardConstructionExecutionAndPayment']??[];
		$hardConstructionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Hard Construction Payment']??[];

		$softConstructionExecutionAndPayment = $dashboardItems['softConstructionExecutionAndPayment']??[];
		$softConstructionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Soft Construction Payment']??[];
		$ffeExecutionAndPayment = $dashboardItems['ffeExecutionAndPayment']??[];

		$ffePayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['FFE Payment']??[];
		
		
		
		$totalFixedAssetsPurchases = sumFiveArrays([$hospitalitySector->propertyAcquisition->getPropertyPurchaseDateFormatted()=>$totalPropertyPurchaseCost], $ffeExecutionAndPayment, $softConstructionExecutionAndPayment, $hardConstructionExecutionAndPayment, [$hospitalitySector->acquisition->getLandPurchaseDateFormatted()=>$totalLandPurchaseCost]);
		$totalFixedAssetsPayments = sumFiveArrays($propertyPayments, $landPayments, $hardConstructionPayments, $softConstructionPayments, $ffePayments);

		$totalFixedAssetsSupplierStatementTitle = 'Total Fixed Assets Supplier Statement';
		$propertySupplierStatementTitle = 'Property Supplier Statement';
		$landSupplierStatementTitle = 'Land Supplier Statement';
		$hardConstructionSupplierStatementTitle = 'Hard Construction Supplier Statement';
		$softConstructionSupplierStatementTitle = 'Soft Construction Supplier Statement';
		$ffeSupplierStatementTitle = 'FF&E Supplier Statement';
		$reportsToShowTitles = [$totalFixedAssetsSupplierStatementTitle, $propertySupplierStatementTitle, $landSupplierStatementTitle, $hardConstructionSupplierStatementTitle, $softConstructionSupplierStatementTitle, $ffeSupplierStatementTitle];

		$itemsForView = [
			$totalFixedAssetsSupplierStatementTitle=>$hospitalitySector->formatFixedAssetsSuppliersForView($studyDates, $totalFixedAssetsPurchases, $totalFixedAssetsPayments,$dateIndexWithDate,$dateWithDateIndex),
			$propertySupplierStatementTitle=>$propertySupplierStatement=$hospitalitySector->propertyAcquisition ? $hospitalitySector->formatFixedAssetsSuppliersForView($studyDates, [$hospitalitySector->propertyAcquisition->getPropertyPurchaseDateFormatted()=>$totalPropertyPurchaseCost], $propertyPayments,$dateIndexWithDate,$dateWithDateIndex) : [],
			$landSupplierStatementTitle=>$landSupplierStatement=$hospitalitySector->acquisition ? $hospitalitySector->formatFixedAssetsSuppliersForView($studyDates, [$hospitalitySector->acquisition->getLandPurchaseDateFormatted()=>$totalLandPurchaseCost], $landPayments,$dateIndexWithDate,$dateWithDateIndex) : [],
			$hardConstructionSupplierStatementTitle=>$hardConstructionSupplierStatement= $hospitalitySector->formatFixedAssetsSuppliersForView($studyDates, $hardConstructionExecutionAndPayment, $hardConstructionPayments,$dateIndexWithDate,$dateWithDateIndex),
			$softConstructionSupplierStatementTitle=>$softConstructionSupplierStatement=$hospitalitySector->formatFixedAssetsSuppliersForView($studyDates, $softConstructionExecutionAndPayment, $softConstructionPayments,$dateIndexWithDate,$dateWithDateIndex),
			$ffeSupplierStatementTitle=>$ffeSupplierStatement=$hospitalitySector->formatFixedAssetsSuppliersForView($studyDates, $ffeExecutionAndPayment, $ffePayments,$dateIndexWithDate,$dateWithDateIndex),
		];

		return view('admin.hospitality-sector.fixed-assets-suppliers-statement', [
			'company' => $company,

			'hospitalitySector' => $hospitalitySector,
			'reportItems' => $itemsForView,
			'reportTitles'=>$reportsToShowTitles,
			// 'salesChannelsNames' => array_keys($dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance'][$type] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewCorporateTaxesStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithDateIndex =App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		$onlyMonthlyDashboardItems = [];

		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$finalReportItems = [];
		foreach (getIntervalFormatted() as $intervalName => $intervalNameFormatted) {
			$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan, $intervalName);
			$finalReportItems[$intervalName] =$reportItems;
		}
		$operationDatesAsIndexes = $hospitalitySector->convertArrayOfStringDatesToStringDatesAndDateIndex(array_flip($hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber)),$dateIndexWithDate,$dateWithDateIndex);
		foreach (getIntervalFormatted() as $intervalName => $intervalNameFormatted) {
			$finalReportItems[$intervalName]['taxes']['Corporate Taxes Payments']=$hospitalitySector->calculateCorporateTaxesStatement($operationDatesAsIndexes, $finalReportItems['annually']['taxes']['Corporate Taxes'], $intervalName,$dateIndexWithDate,$dateWithDateIndex);
		}

		return view('admin.hospitality-sector.corporate-taxes-statement', [
			'company' => $company,
			'reportItems' => $finalReportItems['monthly']['taxes']['Corporate Taxes Payments']??[],
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewManagementFeesStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		
		
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$finalReportItems = [];
		$onlyMonthlyDashboardItems = [];
		foreach (getIntervalFormatted() as $intervalName => $intervalNameFormatted) {
			$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan, $intervalName);
			$finalReportItems[$intervalName] =$reportItems;
		}
		$operationDatesAsIndexes = $hospitalitySector->convertArrayOfStringDatesToStringDatesAndDateIndex(array_flip($hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber)),$dateIndexWithDate,$dateWithDateIndex);
		$incentiveManagementFees = $reportItems['incentive_management_fees']['Incentive Management Fees'] ?? [];
		

		foreach (getIntervalFormatted() as $intervalName => $intervalNameFormatted) {
			$managementFees=$hospitalitySector->calculateManagementFeesStatement($operationDatesAsIndexes, $incentiveManagementFees, $intervalName, $dateIndexWithDate,$dateWithDateIndex);
		}
		
	

		return view('admin.hospitality-sector.management-fees-statement', [
			'company' => $company,
			'reportItems' => $finalReportItems['monthly']['taxes']['Corporate Taxes Payments']??[],
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
			'managementFeesStatements'=>$managementFees
		]);
	}

	public function viewInventoryStatement($companyId, $hospitalitySectorId, $type)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex= App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		

		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$onlyMonthlyDashboardItems = [];
		
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		if($type == 'total'){
			
			$dashboardItems['inventoryStatements']['total']['total'] = sumSecondKeyInThreeDimArr(
				[
					$dashboardItems['inventoryStatements']['rooms']['total']??[],
					$dashboardItems['inventoryStatements']['foods']['total']??[],
					$dashboardItems['inventoryStatements']['gaming']['total']??[],
				]
			);
		}
		
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithDateIndex,$operationDates,$fixedAssetsLoan);
		return view('admin.hospitality-sector.inventory-statement', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'type' => $type,
			'namesIncludesTotal' => array_keys($dashboardItems['inventoryStatements'][$type] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}
	
	
	public function viewFixedAssetsStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		


		$onlyMonthlyDashboardItems = [];
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithDateIndex,$operationDates,$fixedAssetsLoan);
		$studyDurationPerYear = $hospitalitySector->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
		return view('admin.hospitality-sector.fixed-assets-statement', [
			'company' => $company,
			'reportItems' => array_merge([
				'Property Building'=>$reportItems['propertyAssetsForBuilding'],
				'Property FFE'=>$reportItems['propertyAssetsForFFE'],
				
			],$reportItems['ffeAssetItems']),
			'hospitalitySector' => $hospitalitySector,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewPrepaidExpenseEnergyStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		$onlyMonthlyDashboardItems = [];

		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates ,$fixedAssetsLoan);
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);

		return view('admin.hospitality-sector.fixed-energy-expense', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'namesIncludesTotal' => array_keys($dashboardItems['prepaidExpenseStatementForEnergyForView'] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}
	
	public function viewTotalFixedExpenseStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		$onlyMonthlyDashboardItems = [];

		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates ,$fixedAssetsLoan);
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
	
		$totalReport['total']=sumSecondKeyInThreeDimArr(
			[
				$dashboardItems['prepaidExpenseStatementForEnergyForView']['total'] ?? [],
				$dashboardItems['prepaidExpenseStatementForMarketingForView']['total'] ?? [],
				$dashboardItems['prepaidExpenseStatementForPropertyForView']['total'] ?? [],
				$dashboardItems['prepaidExpenseStatementForGeneralForView']['total'] ?? [],
			]
		);
	
		return view('admin.hospitality-sector.total-fixed-energy-expense', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'report'=>$totalReport,
			'namesIncludesTotal' => ['total'],
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewPrepaidExpensePropertyStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');

		
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		
		$onlyMonthlyDashboardItems = [];
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan);
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);

		return view('admin.hospitality-sector.fixed-property-expense', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'namesIncludesTotal' => array_keys($dashboardItems['prepaidExpenseStatementForPropertyForView'] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewPrepaidExpenseGeneralExpenseStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');

		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		
		$onlyMonthlyDashboardItems = [];
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithDateIndex,$operationDates,$fixedAssetsLoan);
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);

		return view('admin.hospitality-sector.fixed-general-expense', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'namesIncludesTotal' => array_keys($dashboardItems['prepaidExpenseStatementForGeneralForView'] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewPrepaidExpenseMarketingExpenseStatement($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		$onlyMonthlyDashboardItems = [];
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex ,$operationDates,$fixedAssetsLoan);

		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber );

		return view('admin.hospitality-sector.fixed-marketing-expense', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'namesIncludesTotal' => array_keys($dashboardItems['prepaidExpenseStatementForMarketingForView'] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewDisposablePaymentStatement($companyId, $hospitalitySectorId, $type)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		$onlyMonthlyDashboardItems = [];
		
		if($type == 'total'){
			
			$dashboardItems['disposablePaymentStatements']['total']['total'] = sumSecondKeyInThreeDimArr(
				[
					$dashboardItems['disposablePaymentStatements']['rooms']['total']??[],
					$dashboardItems['disposablePaymentStatements']['foods']['total']??[],
					$dashboardItems['disposablePaymentStatements']['gaming']['total']??[],
				]
			);
		}

		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan);

		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		
	
		return view('admin.hospitality-sector.disposable-payment-statement', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'type' => $type,
			'namesIncludesTotal' => array_keys($dashboardItems['disposablePaymentStatements'][$type] ?? []),
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}
	
	public function viewPropertyTaxesPaymentStatement($companyId, $hospitalitySectorId)
	{
		$propertyTaxesStatementService = new PropertyTaxesPayableEndBalance();
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex= App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$propertyTaxesPaymentStatements = [];
		
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		
		$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
			$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
			$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
			$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
			$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
			$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
			$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
			$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
			$propertyBuildingCapitalizedInterest = $dashboardItems['propertyBuildingCapitalizedInterest'];
			$propertyAcquisition = $hospitalitySector->getPropertyAcquisition();
			if($propertyAcquisition){
				$propertyAssetsForBuilding =$propertyAcquisition->calculatePropertyAssetsForBuilding($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyBuildingCapitalizedInterest );
			$monthlyPropertyTaxesAndExpensesAndPayments = $hospitalitySector->calculatePropertyTaxes($propertyAssetsForBuilding);
			$monthlyPropertyTaxesExpenses = $monthlyPropertyTaxesAndExpensesAndPayments['monthlyPropertyTaxesExpenses'] ?? []; 
			$propertyTaxesPayments = $monthlyPropertyTaxesAndExpensesAndPayments['payments'] ?? []; 
			$propertyTaxesPayments = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyTaxesPayments,$datesAsStringAndIndex);
			$propertyTaxesPaymentStatements=$propertyTaxesStatementService->getPropertyTaxesPayableEndBalance($monthlyPropertyTaxesExpenses , $propertyTaxesPayments,$dateIndexWithDate,$dateWithDateIndex,$hospitalitySector);
			}
		
		 
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);


		return view('admin.hospitality-sector.property-taxes-statement', [
			'company' => $company,
			'reportItems' => $propertyTaxesPaymentStatements,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}
	
	
	public function viewLoanScheduleReport($companyId, $hospitalitySectorId,$loanType)
	{
		$key = [
			'property'=>[
				'key'=>'propertyLoanCalculations',
				'title'=>__('Property Loan Schedule Report'),
			],
			'land'=>[
				'key'=>'landLoanCalculations',
				'title'=>'Land Loan Schedule Report'
			],
			'hard-construction'=>[
				'key'=>'hardConstructionLoanCalculations',
				'title'=>'Hard Construction Loan Schedule Report'
			],
			'ffe'=>[
				'key'=>'ffeLoanCalculations',
				'title'=>'FFE Construction Loan Schedule Report'
			],
		][$loanType] ?? null;
		if(!$key){
			return redirect()->back();
		}
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex= App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		$propertyTaxesPaymentStatements = [];
		
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		
		$fixedAtEndResult = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex)[$key['key']];

			
			
		;
		 
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);

		$loanDates = array_keys($fixedAtEndResult['beginning'] ?? [] );
		return view('admin.hospitality-sector.loan-schedule-report', [
			'company' => $company,
			'loanDates'=>$loanDates,
			'title'=>$key['title'],
			'reportItems' => $propertyTaxesPaymentStatements,
			'hospitalitySector' => $hospitalitySector,
			'fixedAtEndResult' => $fixedAtEndResult,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}
	
	
	public function viewPropertyInsurancePaymentStatement($companyId, $hospitalitySectorId)
	{
		$propertyInsuranceStatementService = new PropertyInsurancePayableEndBalance();
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex= App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$propertyInsurancePaymentStatements = [];
		
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$projectUnderProgressService = new ProjectsUnderProgress();
		$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
			$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
			$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
			$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
			$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
			$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
			$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
			$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
			$ffeLoanWithdrawalInterestAmounts = $dashboardItems['ffeLoanWithdrawalInterest']??[] ;
			$ffeLoanInterestAmounts = $dashboardItems['ffeLoanInterestAmounts']??[] ;
			$ffeExecutionAndPayment = $dashboardItems['ffeExecutionAndPayment']??[] ;
			$propertyFFECapitalizedInterest = $dashboardItems['propertyFFECapitalizedInterest'] ;
			
			$propertyAcquisition = $hospitalitySector->getPropertyAcquisition();
			$studyEndDate = $hospitalitySector->getStudyEndDateFormatted();
			$studyDurationPerYear = $hospitalitySector->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
			$propertyAssetsForFFE =$propertyAcquisition->calculatePropertyAssetsForFFE($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyFFECapitalizedInterest);
			$projectUnderProgressFFE = $projectUnderProgressService->calculateForFFE($ffeExecutionAndPayment,$ffeLoanInterestAmounts,$ffeLoanWithdrawalInterestAmounts, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
			$transferredDateForFFEAsString = array_key_last($projectUnderProgressFFE['transferred_date_and_vales']??[]);
			$studyDates=$hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
			$ffe = $hospitalitySector->ffe ;
			$ffeAssetItems = [];
			$totalOfFFEItemForFFE = [];
			if($ffe){
				$ffeAssetItems = $ffe->calculateFFEAssetsForFFE($transferredDateForFFEAsString,Arr::last($projectUnderProgressFFE['transferred_date_and_vales']??[],null,0),$studyDates,$studyEndDate);
			$totalOfFFEItemForFFE = $this->findTotalOfFFEFixedAssets($ffeAssetItems ,$studyDates);
			
			}
			
			if($propertyAcquisition){
				$propertyBuildingCapitalizedInterest = $dashboardItems['propertyBuildingCapitalizedInterest'];
				$propertyAssetsForBuilding =$propertyAcquisition->calculatePropertyAssetsForBuilding($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyBuildingCapitalizedInterest );
			$monthlyPropertyInsuranceAndExpensesAndPayments = $hospitalitySector->calculatePropertyInsurance($studyDates,$propertyAssetsForBuilding,$propertyAssetsForFFE,$totalOfFFEItemForFFE);
			$monthlyPropertyInsuranceExpenses = $monthlyPropertyInsuranceAndExpensesAndPayments['monthlyPropertyInsuranceExpenses'] ?? []; 
			$propertyInsurancePayments = $monthlyPropertyInsuranceAndExpensesAndPayments['payments'] ?? []; 
			$propertyInsurancePayments = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyInsurancePayments,$datesAsStringAndIndex);
			$propertyInsurancePaymentStatements=$propertyInsuranceStatementService->getPropertyInsurancePayableEndBalance($monthlyPropertyInsuranceExpenses , $propertyInsurancePayments,$dateIndexWithDate,$dateWithDateIndex,$hospitalitySector);
			}
		
		 
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);


		return view('admin.hospitality-sector.property-insurance-statement', [
			'company' => $company,
			'reportItems' => $propertyInsurancePaymentStatements,
			'hospitalitySector' => $hospitalitySector,
			'dashboardItems' => $dashboardItems,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
		]);
	}

	public function viewLandAcquisitionCosts($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$model = $hospitalitySector->getAcquisition();
		$model = $model ? $model : new Acquisition();

		$vars = array_merge(
			Acquisition::getViewVars($companyId, $hospitalitySectorId),
			[
				'company' => $company,
				'hospitalitySector' => $hospitalitySector,
				'model' => $model,
				'loanType' => 'fixed',
				'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			]
		);

		return view('admin.hospitality-sector.land-acquisition-costs', $vars);
	}

	public function viewPropertyAcquisitionCosts($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$model = $hospitalitySector->getPropertyAcquisition();
		$model = $model ? $model : new PropertyAcquisition();
		// $propertyCostBreakDown = $hospitalitySector->getPropertyCostBreakdownForSection();

		$vars = array_merge(
			PropertyAcquisition::getViewVars($companyId, $hospitalitySectorId),
			[
				'company' => $company,
				'hospitalitySector' => $hospitalitySector,
				'model' => $model,
				'loanType' => 'fixed',
				'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
				// 'propertyCostBreakDown'=>$propertyCostBreakDown
			]
		);

		return view('admin.hospitality-sector.property-acquisition', $vars);
	}

	protected function getLandAcquisitionData(Request $request): array
	{
		// land section
		$hasLandSection = $request->boolean('has_land_section');
		$landPaymentMethod = $request->get('land_payment_method');
		$firstLandPaymentMethod = $landPaymentMethod == 'installment' ? $request->get('first_land_down_payment_percentage') : 0;
		$secondLandPaymentMethod = $landPaymentMethod == 'installment' ? $request->get('second_land_down_payment_percentage') : 0;
		$landAfterMonth = $landPaymentMethod == 'installment' ? $request->get('land_after_month') : 0;
		$landInstallmentInterval = $landPaymentMethod == 'installment' ? $request->get('installment_interval') : 0;

		$hasHardConstructionSection = $request->boolean('has_hard_construction_cost_section');
		$hasSoftConstructionSection = $request->boolean('has_soft_construction_cost_section');
		$collectionPolicyValue = [
			'due_in_days'=>[$request->get('hard_due_one') ?: 0, $request->get('hard_due_two') ?: 0],
			'rate'=>[$request->get('hard_balance_rate_one') ?: 0, $request->get('hard_balance_rate_two') ?: 0]
		];

		return [
			'has_land_section' => $hasLandSection,
			'hospitality_sector_id' => $request->get('hospitality_sector_id'),
			'land_installment_count'=>$request->get('land_installment_count') ?: 1,
			'company_id' => $request->get('company_id'),
			'purchase_date' => $request->get('purchase_date'),
			'land_purchase_cost'=>$request->get('land_purchase_cost'),
			'land_contingency_rate' => $request->get('land_contingency_rate'),

			'land_payment_method' => $landPaymentMethod,
			'land_equity_funding_rate'=>$request->get('land_equity_funding_rate') ?: 100,
			'land_payment_method' => $request->get('land_payment_method'),
			'first_land_down_payment_percentage' => $firstLandPaymentMethod,
			'second_land_down_payment_percentage' => $secondLandPaymentMethod,
			'land_after_month' => $landAfterMonth,
			'installment_interval' => $landInstallmentInterval,

			'has_hard_construction_cost_section' => $hasHardConstructionSection,
			'hard_construction_contingency_rate' => $request->get('hard_construction_contingency_rate'),
			'hard_construction_cost' => $request->get('hard_construction_cost'),
			'hard_construction_duration' => $request->get('hard_construction_duration'),
			'hard_construction_start_date' => $request->get('hard_construction_start_date'),
			'hard_construction_end_date' => $request->get('hard_construction_end_date'),
			'hard_execution_method' => $request->get('hard_execution_method'),
			'hard_down_payment' => $request->get('hard_down_payment'),
			'hard_balance_rate_one' => $request->get('hard_balance_rate_one'),
			'hard_balance_rate_two' => $request->get('hard_balance_rate_two'),
			'hard_due_one' => $request->get('hard_due_one'),
			'hard_due_two' => $request->get('hard_due_two'),
			'hard_equity_funding' => $request->get('hard_equity_funding'),
			'collection_policy_value'=>json_encode($request->input('sub_items.collection_policy.type.value') ?? []),
			'collection_policy_type'=>'customize'
			//'hard_equity_amount'=>$request->get('hard_equity_amount'),
			//'hard_debt_amount'=>$request->get('hard_debt_amount'),



			,
			'has_soft_construction_cost_section' => $hasSoftConstructionSection,
			'soft_construction_contingency_rate' => $request->get('soft_construction_contingency_rate'),
			'soft_construction_cost' => $request->get('soft_construction_cost'),
			'soft_construction_duration' => $request->get('soft_construction_duration'),
			'soft_construction_start_date' => $request->get('soft_construction_start_date'),
			'soft_construction_end_date' => $request->get('soft_construction_end_date'),
			'soft_execution_method' => $request->get('soft_execution_method'),
			'soft_down_payment' => $request->get('soft_down_payment'),
			'soft_balance_rate_one' => $request->get('soft_balance_rate_one'),
			'soft_balance_rate_two' => $request->get('soft_balance_rate_two'),
			'soft_due_one' => $request->get('soft_due_one'),
			'soft_due_two' => $request->get('soft_due_two'),

		];
	}

	protected function getPropertyAcquisitionData(Request $request): array
	{
		// property section

		$hasPropertySection = $request->boolean('has_property_section');
		$propertyPaymentMethod = $request->get('property_payment_method');
		$firstPropertyPaymentMethod = $propertyPaymentMethod == 'installment' ? $request->get('first_property_down_payment_percentage') : 0;
		$secondPropertyPaymentMethod = $propertyPaymentMethod == 'installment' ? $request->get('second_property_down_payment_percentage') : 0;
		$propertyAfterMonth = $propertyPaymentMethod == 'installment' ? $request->get('property_after_month') : 0;
		$propertyInstallmentInterval = $propertyPaymentMethod == 'installment' ? $request->get('installment_interval') : 0;


		return [
			'has_property_section' => $hasPropertySection,
			'hospitality_sector_id' => $request->get('hospitality_sector_id'),
			'property_installment_count'=>$request->get('property_installment_count') ?: 1,
			'company_id' => $request->get('company_id'),
			'purchase_date' => $request->get('purchase_date'),
			'property_purchase_cost'=>$request->get('property_purchase_cost'),
			'property_contingency_rate' => $request->get('property_contingency_rate'),

			'property_payment_method' => $propertyPaymentMethod,
			'property_equity_funding_rate'=>$request->get('property_equity_funding_rate') ?: 100,
			'property_payment_method' => $request->get('property_payment_method'),
			'first_property_down_payment_percentage' => $firstPropertyPaymentMethod,
			'second_property_down_payment_percentage' => $secondPropertyPaymentMethod,
			'property_after_month' => $propertyAfterMonth,
			'installment_interval' => $propertyInstallmentInterval,
			'collection_policy_value'=>json_encode($request->input('sub_items.collection_policy.type.value') ?? []),
			'collection_policy_type'=>'customize',
			'replacement_cost_name'=>$request->input('replacement_cost_name'),
			'replacement_cost_rate'=>$request->input('replacement_cost_rate'),
			'replacement_interval'=>$request->input('replacement_interval'),
			'ffe_replacement_interval'=>$request->input('ffe_replacement_interval'),
			'ffe_replacement_cost_name'=>$request->input('ffe_replacement_cost_name'),
			'ffe_replacement_cost_rate'=>$request->input('ffe_replacement_cost_rate'),

		];
	}

	public function storeLandAcquisitionCosts(Request $request, $companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$acquisition = $hospitalitySector->acquisition;
		$data = $this->getLandAcquisitionData($request);
		if ($acquisition) {
			$acquisition->update($data);
		} else {
			$acquisition = $hospitalitySector->acquisition()->create($data);
		}
		
		$acquisition->storeLoans($request->get('loans'), $companyId);
		$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'landAcquisitionCost'), [$companyId, $hospitalitySectorId]);
		$message = __('Land & Constructions Costs has been saved successfully');

		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl,
			//'namesWithOldNames'=>$namesWithOldNames
		]);
	}

	public function storePropertyAcquisitionCosts(Request $request, $companyId, $hospitalitySectorId)
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$propertyAcquisition = $hospitalitySector->getPropertyAcquisition();

		$data = $this->getPropertyAcquisitionData($request);
		if ($propertyAcquisition) {
			$propertyAcquisition->update($data);
		} else {
			$propertyAcquisition = $hospitalitySector->propertyAcquisition()->create($data);
		}
		$propertyAcquisitionBreakDown = $this->storePropertyAcquisitionBreakDown($hospitalitySector, $request);


		$propertyAcquisition->storeLoans($request->get('loans'), $companyId);

		$redirectUrl = route($this->getRedirectUrlName($hospitalitySector, 'propertyAcquisitionCost'), [$companyId, $hospitalitySectorId]);

		$message = __('Property Acquisition Costs has been saved successfully');

		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl,
		]);
	}

	public function viewIncomeStatementDashboard($companyId, $hospitalitySectorId)
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$finalReportItems = [];
		$monthlyDashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$datesIndexWithYearIndex=App('datesIndexWithYearIndex');
		$yearIndexWithYear=App('yearIndexWithYear');
		$dateIndexWithDate=App('dateIndexWithDate');
		$dateWithDateIndex=App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		


		$onlyMonthlyDashboardItems = [];

		foreach (getIntervalOnlyMonthlyAndAnnuallyFormatted() as $intervalName => $intervalNameFormatted) {
			$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$monthlyDashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan,$intervalName);
			$finalReportItems[$intervalName] = $reportItems;
		}

		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);


		
		return view('admin.hospitality-sector.income-statement-dashboard', [
			'company' => $company,
			'reportItems' => $finalReportItems,
			'hospitalitySector' => $hospitalitySector,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), [])
			,'hospitality_sector_id'=>$hospitalitySectorId
		]);
	}

	public function viewStudyDashboard(Request $request, $companyId, $hospitalitySectorId)
	{
		// $start = microtime(true);
		$revenueChartOnly = isset($request['is_ajax']) && $request->get('chart_name') == 'revenue-stream' ;
		
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId)->load(['departmentExpenses']);
		$datesIndexWithYearIndex=App('datesIndexWithYearIndex');
		$yearIndexWithYear=App('yearIndexWithYear');
		$dateIndexWithDate=App('dateIndexWithDate');
		$dateWithDateIndex=App('dateWithDateIndex');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$revenueStreamType = $request->get('revenue_stream_type', 'Total Hotel Revenues');
		if($revenueChartOnly){
			$totalHotelRevenue = $this->viewCashInOutReport($companyId , $hospitalitySectorId , true,true);
			$revenueStreamValue = Arr::get($totalHotelRevenue, 'hotelRevenue.' . $revenueStreamType, []);
		
			$revenueStreamChartData = sumIntervals(removeKeyFromArray($revenueStreamValue, 'subItems'), 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);
			$revenueStreamAccumulatedData = formatAccumulatedDataForChart($revenueStreamChartData);
			$revenueStreamChart = formatDataForChart($revenueStreamChartData);
			
			if($revenueChartOnly){
				return response()->json([
					'chart_data'=>$revenueStreamChart,
					'accumulated_revenue_chart_data'=>$revenueStreamAccumulatedData,
				]);
			}
		}
		$reportItemsWithDashboardItems = $this->viewCashInOutReport($companyId , $hospitalitySectorId , true);
		$dashboardItems = $reportItemsWithDashboardItems['dashboardItems'];
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		
		
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);
		
		$onlyMonthlyDashboardItems = [];
		
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$reportItems = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan);
		$reportItemsAnnually = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan, 'annually');
		$operationDurationPerYear = $hospitalitySector->getOperationDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);

		$revenueStreamType = $request->get('revenue_stream_type', 'Total Hotel Revenues');
		$revenueStreamValue = Arr::get($reportItems, 'hotelRevenue.' . $revenueStreamType, []);
		$grossProfitDepartmentType = $request->get('gross_profit_type', 'Departments Gross Profit');
		$grossProfitDepartmentValue= Arr::get($reportItems, 'DepartmentsGrossProfit.' . $grossProfitDepartmentType, []);

		$revenueStreamChartData = sumIntervals(removeKeyFromArray($revenueStreamValue, 'subItems'), 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);
		$revenueStreamAccumulatedData = formatAccumulatedDataForChart($revenueStreamChartData);
		$revenueStreamChart = formatDataForChart($revenueStreamChartData);
		
		$hotelRevenuesBreakdownChart = formatStackedChart(Arr::get($reportItems, 'hotelRevenue.Total Hotel Revenues.subItems', []), $datesIndexWithYearIndex,$yearIndexWithYear);
		$adrChart=$this->calculateADR($dashboardItems['totalRoomRevenueOfEachYear']??[], $dashboardItems['totalRoomsSoldNightsPerYear']??[], $yearIndexWithYear);
		$adrChart=formatDataForChart($adrChart, true);

		$revparChart =$this->calculateREVPAR($dashboardItems['totalRoomRevenueOfEachYear']??[], $dashboardItems['totalMaxAvailableNightsPerYear']??[], $yearIndexWithYear);
		$revparChart=formatDataForChart($revparChart, true);

		$occupancyChart = $this->calculateOccupancyRate($dashboardItems['totalRoomsSoldNightsPerYear']??[], $dashboardItems['totalMaxPracticalAvailableNightsPerYear']??[], $yearIndexWithYear);
		$occupancyChart = formatDataForChart($occupancyChart, true, false);

		$grossProfitDepartmentChartData = sumIntervals(removeKeyFromArray($grossProfitDepartmentValue, 'subItems'), 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);

		$grossAccumulatedProfitDepartmentAccumulatedChart = formatAccumulatedDataForChart($grossProfitDepartmentChartData);
		$grossProfitDepartmentChart = formatDataForChart($grossProfitDepartmentChartData,false , false , true ,$revenueStreamChartData);
		
		if(isset($request['is_ajax']) && $request->get('chart_name') == 'gross-profit'){
			return response()->json([
				// 'chart_data'=>$revenueStreamChart,
				// 'accumulated_revenue_chart_data'=>$revenueStreamAccumulatedData,
				'gross_profit_data'=>$grossProfitDepartmentChart,
				'accumulated_gross_profit_data'=>$grossAccumulatedProfitDepartmentAccumulatedChart
			]);
		}
		$ebitdaChartData = $reportItemsAnnually['EBITDA']['Earnings Before Interest Taxes Depreciation & Amortization [ EBITDA ]']??[];
		$ebitdaChartData = sumIntervals($ebitdaChartData, 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);
		$revenueStreamValueForTotalHotelRevenueAnnually = sumIntervals(removeKeyFromArray(Arr::get($reportItems, 'hotelRevenue.Total Hotel Revenues' , []),'subItems')  , 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);

		$ebitdaChart = formatDataForChart($ebitdaChartData,false , false , true , $revenueStreamValueForTotalHotelRevenueAnnually );

		$ebitChartData = $reportItemsAnnually['EBIT']['Earnings Before Interest Taxes [ EBIT ]']??[];
		$ebitChartData = sumIntervals($ebitChartData, 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);
		$ebitChart = formatDataForChart($ebitChartData,false , false , true , $revenueStreamValueForTotalHotelRevenueAnnually);

		$ebtChartData = $reportItemsAnnually['EBT']['Earnings Before Taxes [ EBT ]']??[];

		$ebitChartData = $reportItemsAnnually['EBIT']['Earnings Before Interest Taxes [ EBIT ]']??[];
		$ebtChartData = sumIntervals($ebtChartData, 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);
		$ebtChart = formatDataForChart($ebtChartData,false , false , true , $revenueStreamValueForTotalHotelRevenueAnnually);

		$netProfitChartData = $reportItemsAnnually['net_profit']['Net Profit']??[];
		$netProfitChartData= sumIntervals($netProfitChartData, 'annually', $hospitalitySector->financialYearStartMonth(), $dateIndexWithDate);
		$netProfitChart = formatDataForChart($netProfitChartData,false , false , true , $revenueStreamValueForTotalHotelRevenueAnnually);
		
		
		$reportItems = $this->formatCashInOutReportItems($dashboardItems,$hospitalitySector);
		$workingCapitalInjection = $hospitalitySector->calculateWorkingCapitalInjection($reportItems['netCash']['Accumulated Net Cash'],$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate); 
		$dashboardItems['CashInReport']['Equity Injection']['Working Capital'] = $workingCapitalInjection ;
		
		
		
		
		
		
		$totalEquityInjection = sumTwoDimArr($dashboardItems['CashInReport']['Equity Injection'] ?? []);
		// $totalLoans = sumTwoDimArr($dashboardItems['CashInReport']['Loan Withdrawal'] ?? []) ;
		$propertyLoanAmount = $dashboardItems['propertyLoanAmount'];
		$landLoanAmount = $dashboardItems['landLoanAmount'];
		$hardLoanAmount = $dashboardItems['hardLoanAmount'];
		$ffeLoanAmount = $dashboardItems['ffeLoanAmount'];
		
		$propertyLoanPricing = $dashboardItems['propertyLoanPricing']/100;
		$landLoanPricing = $dashboardItems['landLoanPricing']/100;
		$hardLoanPricing = $dashboardItems['hardLoanPricing']/100;
		$ffeLoanPricing = $dashboardItems['ffeLoanPricing']/100;
		
		$totalLoans = $propertyLoanAmount +$landLoanAmount  +$hardLoanAmount+ $ffeLoanAmount ;
		
		$propertyLoanEndBalanceAtStudyEndBalance  = $dashboardItems['propertyLoanEndBalanceAtStudyEndBalance'];
		$landLoanEndBalanceAtStudyEndDate  = $dashboardItems['landLoanEndBalanceAtStudyEndDate'];
		$hardConstructionLoanEndBalanceAtStudyEndDate  = $dashboardItems['hardConstructionLoanEndBalanceAtStudyEndDate'];
		$ffeLoanEndBalanceAtStudyEndDate  = $dashboardItems['ffeLoanEndBalanceAtStudyEndDate'];
		
		
		$totalEndBalanceAtStudyEndDate = $propertyLoanEndBalanceAtStudyEndBalance +$landLoanEndBalanceAtStudyEndDate+ $hardConstructionLoanEndBalanceAtStudyEndDate + $ffeLoanEndBalanceAtStudyEndDate ;
		
		$totalRequiredInvestment = $totalEquityInjection+$totalLoans;
		$costOfEquity = $hospitalitySector->getInvestmentReturnRate();
		$corporateTaxesRate = $hospitalitySector->getCorporateTaxesRate()/100;
		
		$costOfDebt =  ($totalLoans ? ($propertyLoanAmount/ $totalLoans * $propertyLoanPricing) + ($landLoanAmount/ $totalLoans * $landLoanPricing)+($hardLoanAmount/ $totalLoans * $hardLoanPricing)   +($ffeLoanAmount/$totalLoans * $ffeLoanPricing ) : 0) * (1-$corporateTaxesRate)  ;
		$wacc = $totalRequiredInvestment ? ($totalEquityInjection /$totalRequiredInvestment  * ($costOfEquity /100)   ) + ($totalLoans /$totalRequiredInvestment  *$costOfDebt   ) :0;
		// Start Investment Feasibility For Equity
		$freeCashFlowForEquity = $hospitalitySector->calculateFreeCashFlowForEquity($reportItems);
		$freeCashFlowForEquityAnnually = sumIntervals($freeCashFlowForEquity , 'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		$freeCashFlowForEquityAnnually = $hospitalitySector->removeDatesAfterDate($freeCashFlowForEquityAnnually,$hospitalitySector->getStudyEndDateFormatted()) ;
		$terminalValue = Arr::last($freeCashFlowForEquityAnnually,null,0);
	
		$perpetualGrowthRate = $hospitalitySector->getPerpetualGrowthRate()/100;
		$costOfEquityPercentage = $costOfEquity /100 ;
		$costOfEquityMinusPerpetual = ($costOfEquityPercentage -  $perpetualGrowthRate) <= 0 ?1 : ($costOfEquityPercentage -  $perpetualGrowthRate);
		 
				$terminalValue =  ($terminalValue * (1+$perpetualGrowthRate)) / $costOfEquityMinusPerpetual    ;
		$terminalValueMinusLoanBalance = $terminalValue - $totalEndBalanceAtStudyEndDate ; 
		$freeCashFlowForEquityAnnuallyLastKey=array_key_last($freeCashFlowForEquityAnnually);
		$freeCashFlowForEquityAnnuallyWithTerminal = $freeCashFlowForEquityAnnually;
		if($freeCashFlowForEquityAnnuallyLastKey){
			$freeCashFlowForEquityAnnuallyWithTerminal[$freeCashFlowForEquityAnnuallyLastKey] = $freeCashFlowForEquityAnnuallyWithTerminal[$freeCashFlowForEquityAnnuallyLastKey]+ $terminalValueMinusLoanBalance;
		}
		$irrService = new CalculateIrrService();
		$netPresentValueForEquity = $irrService->calculateNetPresentValue($freeCashFlowForEquityAnnuallyWithTerminal,$costOfEquity);
		$mainFunctionalCurrency = $hospitalitySector->getMainFunctionalCurrencyFormatted();
		$irrForEquity = $irrService->calculateIrr($freeCashFlowForEquityAnnuallyWithTerminal,$costOfEquity,0,$netPresentValueForEquity);
		// end Investment Feasibility For Equity
		
		// start Investment Feasibility For Project
		
		$freeCashFlowForFirm = $hospitalitySector->calculateFreeCashFlowForFirm($reportItems);
		$freeCashFlowForFirmAnnually = sumIntervals($freeCashFlowForFirm , 'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$freeCashFlowForFirmAnnually = $hospitalitySector->removeDatesAfterDate($freeCashFlowForFirmAnnually,$hospitalitySector->getStudyEndDateFormatted()) ;
		
		$terminalValueForFirm = Arr::last($freeCashFlowForFirmAnnually,null,0);
		
		$waccPercentage = $wacc  ;
		$waccMinusPerpetual = ($waccPercentage - $perpetualGrowthRate) <= 0   ? 1 : ($waccPercentage - $perpetualGrowthRate) ;
		 
		$terminalValueForFirm =   ($terminalValueForFirm * (1+$perpetualGrowthRate)) / $waccMinusPerpetual   ;
		$terminalValueForFirmMinusLoanBalance = $terminalValueForFirm  ; 
		$freeCashFlowForFirmAnnuallyLastKey=array_key_last($freeCashFlowForFirmAnnually);
		$freeCashFlowForFirmAnnuallyWithTerminal = $freeCashFlowForFirmAnnually;
		
		if($freeCashFlowForFirmAnnuallyLastKey){
			$freeCashFlowForFirmAnnuallyWithTerminal[$freeCashFlowForFirmAnnuallyLastKey] = $freeCashFlowForFirmAnnuallyWithTerminal[$freeCashFlowForFirmAnnuallyLastKey]+ $terminalValueForFirmMinusLoanBalance;
		}
		$waccPercentage = $waccPercentage * 100;
		$netPresentValueForFirm = $irrService->calculateNetPresentValue($freeCashFlowForFirmAnnuallyWithTerminal,$waccPercentage);
		
		$irrForFirm = $irrService->calculateIrr($freeCashFlowForFirmAnnuallyWithTerminal,$waccPercentage,0,$netPresentValueForFirm);
		
		// end Investment Feasibility For Project
		$accumulatedFreeCashFlowForEquity = HArr::accumulateArray($freeCashFlowForEquity);
		$calculatePaybackPeriodService = new CalculatePaybackPeriodService();
		
		$accumulatedFreeCashFlowForEquity = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($accumulatedFreeCashFlowForEquity,$dateIndexWithDate);
		$paybackDateAndValue=$calculatePaybackPeriodService->__calculate($accumulatedFreeCashFlowForEquity,$hospitalitySector->getStudyStartDateFormatted(),$totalEquityInjection);
		$paybackDate = array_key_last($paybackDateAndValue);
		$paybackValue = $paybackDateAndValue[$paybackDate] ?? 0;
		
		$cardItems =[
			[
				'title'=>'Total Required Investment',
				'value'=>number_format($totalRequiredInvestment,0)
			],
			[
				'title'=>'Total Equity Injection',
				'value'=>number_format($totalEquityInjection,0)
			],
			[
				'title'=>'Total Loans',
				'value'=>number_format($totalLoans,0)
			],
			[
				'title'=>'WACC %',
				'value'=>number_format($wacc*100 , 1) . ' %'
			],
			[
				'title'=>'Cost Of Equity %',
				'value'=>number_format($costOfEquity , 1) . ' %'
			],
			[
				'title'=>'Cost Of Debt %',
				'value'=>number_format($costOfDebt*100 , 1) . ' %'
			],
			[
				'title'=>'Net Present Value For Firm',
				'value'=>number_format($netPresentValueForFirm) . ' [ ' . $mainFunctionalCurrency . ' ]'
			],
			[
				'title'=>'Firm IRR %',
				'value'=>is_numeric($irrForFirm) ? number_format($irrForFirm *100 , 1) . ' %' :$irrForFirm
			],	
			[
				'title'=>'Net Present Value For Equity',
				'value'=>number_format($netPresentValueForEquity) . ' [ ' . $mainFunctionalCurrency . ' ]'
			],
			[
				'title'=>'Equity IRR %',
				'value'=>is_numeric($irrForEquity)?number_format($irrForEquity *100 , 1) . ' %':$irrForEquity 
			],
			[
				'title'=>'Payback Period',
				'value'=>$paybackValue . ' ( ' . $paybackDate . ' )' 
			],
			
		] ;
		return view('admin.hospitality-sector.studyDashboard', [
			'company' => $company,
			'occupancyChart'=>$occupancyChart,
			// 'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
			'revenueStreamChart'=>$revenueStreamChart,
			'hotelRevenuesBreakdownChart'=>$hotelRevenuesBreakdownChart,
			'revenueStreamType'=>$revenueStreamType,
			'adrChart'=>$adrChart,
			'revparChart'=>$revparChart,
			'revenueStreamAccumulatedData'=>$revenueStreamAccumulatedData,
			'company_id'=>$companyId,
			'hospitality_sector_id'=>$hospitalitySectorId,
			'grossProfitDepartmentType'=>$grossProfitDepartmentType,
			'grossProfitDepartmentChart'=>$grossProfitDepartmentChart,
			'grossAccumulatedProfitDepartmentAccumulatedChart'=>$grossAccumulatedProfitDepartmentAccumulatedChart,
			'cardItems'=>$cardItems,
			'ebitdaChart'=>$ebitdaChart,
			'ebitChart'=>$ebitChart,
			'ebtChart'=>$ebtChart,
			'netProfitChart'=>$netProfitChart,
		]);
	}

	public function calculateADR(array $totalRoomRevenueOfEachYear, array $totalRoomsSoldNightsPerYear,array $yearIndexWithYear)
	{
		$adr=[];
		foreach ($totalRoomRevenueOfEachYear as $yearAsIndex => $totalRoomRevenueInYear) {
			$totalRoomSoldNightAtYear =  $totalRoomsSoldNightsPerYear[$yearAsIndex]??1;
			$yearAsNumber = $yearIndexWithYear[$yearAsIndex];
			$adr[$yearAsNumber]=$totalRoomSoldNightAtYear ? $totalRoomRevenueInYear /$totalRoomSoldNightAtYear :0;
		}

		return $adr;
	}

	public function calculateREVPAR(array $totalRoomRevenueOfEachYear, array $totalMaxAvailableNightsPerYear, array $yearIndexWithYear)
	{
		$revPar=[];
		foreach ($totalRoomRevenueOfEachYear as $yearAsIndex => $totalRoomRevenueInYear) {
			$totalMaxAvailableNightAtYear =  $totalMaxAvailableNightsPerYear[$yearAsIndex]??1;
			$yearAsNumber = $yearIndexWithYear[$yearAsIndex];
			$revPar[$yearAsNumber]=$totalMaxAvailableNightAtYear ? $totalRoomRevenueInYear /$totalMaxAvailableNightAtYear : 0 ;
		}
		return $revPar;
	}

	public function calculateOccupancyRate(array $totalRoomsSoldNightsPerYear, array $totalMaxPracticalAvailableNightsPerYear, array $yearIndexWithYear)
	{
		$occupancyRateChart=[];
		foreach ($totalRoomsSoldNightsPerYear as $yearAsIndex => $totalRoomsSoldNightsAtYear) {
			$totalMaxPracticalAvailableNightsAtYear =  $totalMaxPracticalAvailableNightsPerYear[$yearAsIndex]??1;
			$yearAsNumber = $yearIndexWithYear[$yearAsIndex];
			$occupancyRateChart[$yearAsNumber]=$totalMaxPracticalAvailableNightsAtYear ? $totalRoomsSoldNightsAtYear /$totalMaxPracticalAvailableNightsAtYear:0;
		}

		return $occupancyRateChart;
	}

	public function viewCashInOutReport($companyId, $hospitalitySectorId , $returnReportItemsWithDashboardItems = false ,$onlyTotalHotelRevenue = false  )
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId)->load(['departmentExpenses']);
		$operationStartDateFormatted =$hospitalitySector->getOperationStartDateFormatted() ;
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		$operationDates = $hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$operationStartDateAsIndex = $hospitalitySector->getOperationStartDateAsIndex($datesAsStringAndIndex,$operationStartDateFormatted);
		$studyDurationPerYear = $hospitalitySector->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
		$studyDates=$hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
		$dashboardItems = $hospitalitySector->calculateRoomRevenueAndGuestCount();
		$propertyAcquisition = $hospitalitySector->propertyAcquisition ;
		$replacementCost = [];
		$hardConstructionExecution = [] ;
		$softConstructionExecution = [] ;
		$loanInterestOfHardConstruction  = [] ; 
		$withdrawalInterestOfHardConstruction = [];
		$propertyAssetsForBuilding = [];
		$propertyAssetsForFFE = [];
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();
		$fixedAssetsLoan = $calculateFixedLoanAtEndService->calculateFixedAssetsLoans($hospitalitySector,$datesAsStringAndIndex,$dateIndexWithDate,$dateWithDateIndex);

		

		$finalReportItems = [];
		$reportItemsInterval = [];
		
		


		$onlyMonthlyDashboardItems = [];
		
		// FIXME:This Loop Takes 5 seconds To Be Executed  
		foreach (getIntervalOnlyMonthlyAndAnnuallyFormatted() as $intervalName => $intervalNameFormatted) {
			
			$reportItemsInterval = $this->formatDashboardReportItems($onlyMonthlyDashboardItems,$dashboardItems, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate , $dateWithDateIndex,$operationDates,$fixedAssetsLoan,$intervalName,$propertyAssetsForBuilding,$propertyAssetsForFFE);
			$finalReportItems[$intervalName] =$reportItemsInterval;
		}
		if($onlyTotalHotelRevenue){
			return $finalReportItems['annually']??[] ;
		}
		if($propertyAcquisition){
			$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
			$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
			$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
			$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
			$propertyBuildingCapitalizedInterest = $dashboardItems['propertyBuildingCapitalizedInterest'];
			$propertyFFECapitalizedInterest = $dashboardItems['propertyFFECapitalizedInterest'];
		
			$propertyAssetsForBuilding =$propertyAcquisition->calculatePropertyAssetsForBuilding($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate ,$propertyBuildingCapitalizedInterest);
			
			$propertyAssetsForFFE =$propertyAcquisition->calculatePropertyAssetsForFFE($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyFFECapitalizedInterest);
		
			$replacementCost = HArr::sumAtDates([
				$propertyAssetsForBuilding['replacement_cost'] ??[] , 
			$propertyAssetsForFFE['replacement_cost']??[] ,
			$hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($finalReportItems['monthly']['totalOfFFEItemForFFE']['replacement_cost']??[],$dateIndexWithDate)
		] , array_keys($studyDates));
		
			$replacementCost = $hospitalitySector->removeDatesAfterDate($replacementCost,$hospitalitySector->getStudyEndDateFormatted());
			$replacementCost = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($replacementCost,$datesAsStringAndIndex);
		}
		$dashboardItems['CashOutReport']['Acquisition And Development Payment']['Replacement Cost'] = $replacementCost;
		

		$operationDatesAsIndexes = $hospitalitySector->convertArrayOfStringDatesToStringDatesAndDateIndex(array_flip($hospitalitySector->getOperationDurationPerMonth($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber)),$dateIndexWithDate,$dateWithDateIndex);
		$incentiveManagementFees = $reportItemsInterval['incentive_management_fees']['Incentive Management Fees'] ?? [];
		
		
		foreach (getIntervalOnlyMonthlyAndAnnuallyFormatted() as $intervalName => $intervalNameFormatted) {
			$managementFees=$hospitalitySector->calculateManagementFeesStatement($operationDatesAsIndexes, $incentiveManagementFees, $intervalName, $dateIndexWithDate,$dateWithDateIndex);
		}
		foreach (getIntervalOnlyMonthlyAndAnnuallyFormatted() as $intervalName => $intervalNameFormatted) {
			$finalReportItems[$intervalName]['taxes']['Corporate Taxes Payments']=$hospitalitySector->calculateCorporateTaxesStatement($operationDatesAsIndexes, $finalReportItems['annually']['taxes']['Corporate Taxes'], $intervalName,$dateIndexWithDate,$dateWithDateIndex);
		}
		
		$dashboardItems['CashOutReport']['Management Fees']['Incentive Management Fees'] = $managementFees['monthly']['payments']??[];
		$monthlyPropertyTaxesAndExpensesAndPayments = $hospitalitySector->calculatePropertyTaxes($propertyAssetsForBuilding);
		$propertyTaxesPayments = $monthlyPropertyTaxesAndExpensesAndPayments['payments'] ?? []; 
		$propertyTaxesPayments = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyTaxesPayments,$datesAsStringAndIndex);

		$ffeAssetItems = $finalReportItems['monthly']['ffeAssetItems'] ?? [];
		$totalOfFFEItemForFFE = $this->findTotalOfFFEFixedAssets($ffeAssetItems ,$studyDates);
		
		$monthlyPropertyInsuranceAndExpensesAndPayments = $hospitalitySector->calculatePropertyInsurance($studyDates,$propertyAssetsForBuilding,$propertyAssetsForFFE , $totalOfFFEItemForFFE);
		$propertyInsurancePayments = $monthlyPropertyInsuranceAndExpensesAndPayments['payments'] ?? []; 
		$propertyInsurancePayments = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyInsurancePayments,$datesAsStringAndIndex);
		$dashboardItems['CashOutReport']['Taxes']['Property Taxes & Insurance'] = sumTwoArray($propertyTaxesPayments,$propertyInsurancePayments) ;
		
		
		$dashboardItems['CashOutReport']['Taxes']['Corporate Taxes'] = $finalReportItems['monthly']['taxes']['Corporate Taxes Payments']['monthly']['payments'] ?? [];
		$dashboardItems['CashOutReport']['Taxes']['Corporate Taxes'] = $finalReportItems['monthly']['taxes']['Corporate Taxes Payments']['monthly']['payments'] ?? [];
		
		
		
		$reportItems = $this->formatCashInOutReportItems($dashboardItems,$hospitalitySector);
		 
		
		// must be last key added 
		$workingCapitalInjection = $hospitalitySector->calculateWorkingCapitalInjection($reportItems['netCash']['Accumulated Net Cash'],$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate); 
		$dashboardItems['CashInReport']['Equity Injection']['Working Capital'] = $workingCapitalInjection ;
		$reportItems = $this->formatCashInOutReportItems($dashboardItems,$hospitalitySector,true);
		if($returnReportItemsWithDashboardItems){
			return [
				'dashboardItems'=>$dashboardItems,
				'reportItems'=>$reportItems,
				'finalReportItems'=>$finalReportItems,
				'reportItemsInterval'=>$reportItemsInterval,
				'management_fees'=>$managementFees,
				'monthlyPropertyTaxesAndExpensesAndPayments'=>$monthlyPropertyTaxesAndExpensesAndPayments,
				'monthlyPropertyInsuranceAndExpensesAndPayments'=>$monthlyPropertyInsuranceAndExpensesAndPayments
			];
		}
		
		// for balance sheet 
		 // $reportItems must be after working capital calculations;
		// $freeCashFlowForEquity = $hospitalitySector->calculateFreeCashFlowForEquity($reportItems);
		// $freeCashFlowForFirm = $hospitalitySector->calculateFreeCashFlowForFirm($reportItems);
		
		
;
		return view('admin.hospitality-sector.cash-in-out-report', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dates' => $studyDates,
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
			'hospitality_sector_id'=>$hospitalitySectorId
		]);
	}
	
	
	public function viewBalanceSheetReport($companyId, $hospitalitySectorId , $returnItems = false )
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId)->load(['departmentExpenses']);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
	
		$studyDurationPerYear = $hospitalitySector->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
		$studyDates = $hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
		$cashInOutReport = $this->viewCashInOutReport($companyId,$hospitalitySectorId,true);
		$reportItems = $cashInOutReport['reportItems'];
		$dashboardItems = $cashInOutReport['dashboardItems'];
		$finalReportItems = $cashInOutReport['finalReportItems'];
		$reportItemsInterval = $cashInOutReport['reportItemsInterval'];

		$monthlyPropertyTaxesAndExpensesAndPayments = $cashInOutReport['monthlyPropertyTaxesAndExpensesAndPayments'];
		$monthlyPropertyInsuranceAndExpensesAndPayments = $cashInOutReport['monthlyPropertyInsuranceAndExpensesAndPayments'];

		$managementFees = $cashInOutReport['management_fees'];
		$managementFeesEndBalance = $managementFees['monthly']['end_balance']??[];
		
		$propertyLoanEndBalance =$dashboardItems['propertyLoanEndBalance'];
		$propertyLoanEndBalance = HArr::fillMissedKeysFromPreviousKeys($propertyLoanEndBalance,array_keys($studyDates));
		
		$propertyLoanEndBalance =$hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($propertyLoanEndBalance,$datesAsStringAndIndex) ;
		$propertyWithdrawalEndBalance = $dashboardItems['propertyLoanWithdrawalEndBalance'] ;
		 array_pop($propertyWithdrawalEndBalance);
		$propertyLoanEndBalance = HArr::sumAtDates([ $propertyWithdrawalEndBalance,$propertyLoanEndBalance ],$studyDates);
		
		$hardConstructionLoanEndBalance =$dashboardItems['hardConstructionLoanEndBalance'];
		
		$hardConstructionLoanEndBalance = HArr::fillMissedKeysFromPreviousKeys($hardConstructionLoanEndBalance,array_keys($studyDates));
		$hardConstructionLoanEndBalance =$hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($hardConstructionLoanEndBalance,$datesAsStringAndIndex) ;
		$hardConstructionWithdrawalEndBalance = $dashboardItems['hardLoanWithdrawalEndBalance'] ;
		array_pop($hardConstructionWithdrawalEndBalance);
		$hardConstructionLoanEndBalance = HArr::sumAtDates([ $hardConstructionWithdrawalEndBalance,$hardConstructionLoanEndBalance ],$studyDates);
		
		
		$landLoanEndBalance =$dashboardItems['landLoanEndBalance'];
		$landLoanEndBalance = HArr::fillMissedKeysFromPreviousKeys($landLoanEndBalance,array_keys($studyDates));
		$landLoanEndBalance =$hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($landLoanEndBalance,$datesAsStringAndIndex) ;
		$landWithdrawalAmounts = $dashboardItems['landLoanWithdrawalAmounts'] ;
		array_pop($landWithdrawalAmounts);
		$landLoanEndBalance = HArr::sumAtDates([ $landWithdrawalAmounts,$landLoanEndBalance ],$studyDates);
		
		$ffeLoanEndBalance =$dashboardItems['ffeLoanEndBalance'];
		$ffeLoanEndBalance = HArr::fillMissedKeysFromPreviousKeys($ffeLoanEndBalance,array_keys($studyDates));
		$ffeLoanEndBalance =$hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($ffeLoanEndBalance,$datesAsStringAndIndex) ;
		$ffeWithdrawalEndBalance = $dashboardItems['ffeLoanWithdrawalEndBalance'] ;
		$propertyLandCapitalizedInterest = $dashboardItems['propertyLandCapitalizedInterest'] ;
		$landLoanCapitalizedInterest = $dashboardItems['landLoanCapitalizedInterest'] ;
		
		array_pop($ffeWithdrawalEndBalance);
		$ffeLoanEndBalance = HArr::sumAtDates([$ffeWithdrawalEndBalance,$ffeLoanEndBalance ],$studyDates);
		
		
		
		
		$buildingFixedAssets = $finalReportItems['monthly']['propertyAssetsForBuilding']['final_total_gross'] ?? [];
		$buildingEndBalance = $finalReportItems['monthly']['propertyAssetsForBuilding']['end_balance'] ?? [];
		$buildingEndBalance = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($buildingEndBalance,$datesAsStringAndIndex);
		$ffeAssetItems = $finalReportItems['monthly']['ffeAssetItems'] ?? [];
		$propertyAssetsForFFE = $finalReportItems['monthly']['propertyAssetsForFFE'] ?? [];
		$buildingFixedAssets = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($buildingFixedAssets,$datesAsStringAndIndex);
		$totalFFEFixedAssetsForAccumulatedDepreciationAndFinalTotalGrossAndEndBalance = $this->findTotalOfFFEFixedAssets(array_merge([$propertyAssetsForFFE],$ffeAssetItems) ,$studyDates);
		$totalFFEFixedAssets = $totalFFEFixedAssetsForAccumulatedDepreciationAndFinalTotalGrossAndEndBalance['final_total_gross']??[];
		$buildingAccumulatedDepreciation = $finalReportItems['monthly']['propertyAssetsForBuilding']['accumulated_depreciation']??[];
		$projectUnderProgressConstruction = $finalReportItems['monthly']['projectUnderProgressConstruction'];
		$projectUnderProgressConstructionEndBalance = $projectUnderProgressConstruction['end_balance']??[];
		$projectUnderProgressConstructionEndBalance = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($projectUnderProgressConstructionEndBalance,$datesAsStringAndIndex);
		$projectUnderProgressFFE = $finalReportItems['monthly']['projectUnderProgressFFE']??[];
		$projectUnderProgressFFEEndBalance = $projectUnderProgressFFE['end_balance']??[];
		
		$projectUnderProgressFFEEndBalance = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($projectUnderProgressFFEEndBalance,$datesAsStringAndIndex);
		$buildingAccumulatedDepreciation = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($buildingAccumulatedDepreciation,$datesAsStringAndIndex);
		$totalFFEAccumulatedDepreciation = $totalFFEFixedAssetsForAccumulatedDepreciationAndFinalTotalGrossAndEndBalance['accumulated_depreciation']??[];
		$totalFFEEndBalance = $totalFFEFixedAssetsForAccumulatedDepreciationAndFinalTotalGrossAndEndBalance['end_balance']??[];

		$currentPortionOfLongTermDebt = [];
		$totalCashAndBanks=$reportItems['netCash']['Accumulated Net Cash']??[];
		
		$customerReceivablesForRooms = $dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['rooms']['total']['intervalsReport']['monthly']['end_balance']??[];
		$customerReceivablesForFoods = $dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['foods']['total']['intervalsReport']['monthly']['end_balance']??[];
		$customerReceivablesForGaming = $dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['gaming']['total']['intervalsReport']['monthly']['end_balance']??[];
		$customerReceivablesForMeetings = $dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['meetings']['total']['intervalsReport']['monthly']['end_balance']??[];
		$customerReceivablesForOthers = $dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance']['others']['total']['intervalsReport']['monthly']['end_balance']??[];
		$disposablesInventoryForRooms=$dashboardItems['inventoryStatements']['rooms']['total']['monthly']['end_balance']??[];
		$disposablesInventoryForFoods=$dashboardItems['inventoryStatements']['foods']['total']['monthly']['end_balance']??[];
		$disposablesInventoryForGaming=$dashboardItems['inventoryStatements']['gaming']['total']['monthly']['end_balance']??[];
		$otherDebtors = [];
		
		$totalCurrentAssets = HArr::sumAtDates([$totalCashAndBanks,$customerReceivablesForRooms,$customerReceivablesForFoods,$customerReceivablesForGaming,$customerReceivablesForMeetings,$customerReceivablesForOthers,$disposablesInventoryForRooms,$disposablesInventoryForFoods,$disposablesInventoryForGaming,$otherDebtors],$studyDates);
		// 
		$disposablePayablesForRooms=$dashboardItems['disposablePaymentStatements']['rooms']['total']['monthly']['end_balance']??[];
		$disposablePayablesForFoods=$dashboardItems['disposablePaymentStatements']['foods']['total']['monthly']['end_balance']??[];
		$disposablePayablesForGaming=$dashboardItems['disposablePaymentStatements']['gaming']['total']['monthly']['end_balance']??[];
		$generalExpense = $dashboardItems['prepaidExpenseStatementForGeneralForView']['total']['monthly']['end_balance']??[] ;
		$marketExpense = $dashboardItems['prepaidExpenseStatementForMarketingForView']['total']['monthly']['end_balance']??[] ;
		$propertyExpense = $dashboardItems['prepaidExpenseStatementForPropertyForView']['total']['monthly']['end_balance'] ??[];
		$energyExpense = $dashboardItems['prepaidExpenseStatementForEnergyForView']['total']['monthly']['end_balance']??[] ;
		
		$landFixedAssetsWithAccumulation = $hospitalitySector->calculateLandFixedAssets($studyDates,$propertyLandCapitalizedInterest,$landLoanCapitalizedInterest);
		$landFixedAssets = $landFixedAssetsWithAccumulation['AccumulatedLandFixed'];
		
		$totalBeginningStartUpAndPreOperatingAssets = $dashboardItems['startUpAndPreOperationExpensesTotals']['beginning_balance']??[];
				$totalBeginningStartUpAndPreOperatingAssets = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($totalBeginningStartUpAndPreOperatingAssets , $datesAsStringAndIndex);
				
				$totalAccumulatedDepreciationStartUpAndPreOperatingAssets = $dashboardItems['startUpAndPreOperationExpensesTotals']['accumulated_depreciation']??[];
				$totalAccumulatedDepreciationStartUpAndPreOperatingAssets = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($totalAccumulatedDepreciationStartUpAndPreOperatingAssets , $datesAsStringAndIndex);
				
				$totalEndBalanceStartUpAndPreOperatingAssets = $dashboardItems['startUpAndPreOperationExpensesTotals']['end_balance'] ?? [];
				$totalEndBalanceStartUpAndPreOperatingAssets = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($totalEndBalanceStartUpAndPreOperatingAssets , $datesAsStringAndIndex);
				
				$otherPayableBalance = $dashboardItems['startUpAndPreOperationExpensesTotals']['payable_end_balance'] ?? [];
				$otherPayableBalance = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($otherPayableBalance , $datesAsStringAndIndex);

				
				
		$totalLongTermAssets=HArr::sumAtDates([$landFixedAssets,$buildingEndBalance,$totalFFEEndBalance,$projectUnderProgressConstructionEndBalance,$projectUnderProgressFFEEndBalance,$totalEndBalanceStartUpAndPreOperatingAssets],$studyDates);
		$totalAssets = HArr::sumAtDates([$totalCurrentAssets,$totalLongTermAssets],$studyDates);

		$accruedExpenses = HArr::sumAtDates([$generalExpense,$marketExpense,$propertyExpense,$energyExpense],$studyDates);
		// property acquisition end balance
		$propertyAcquisitionDatesAndAmounts = $hospitalitySector->getPropertyAcquisitionDatesAndAmounts($studyDates);
		$propertyAcquisitionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Property Payments'] ?? [] ;
		$propertyPayable=(new FixedAssetsPayableEndBalance())->calculateEndBalance($propertyAcquisitionDatesAndAmounts,$propertyAcquisitionPayments,$dateIndexWithDate,$hospitalitySector);
		$propertyPayable = $propertyPayable['monthly']['end_balance'] ?? [];
		
		// land acquisition end balance
		$landAcquisitionDatesAndAmounts = $landFixedAssetsWithAccumulation['landFixed'] ?? [];
		$landAcquisitionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Land Payments'] ?? [] ;
		$landPayable = [];
		if(count($landAcquisitionDatesAndAmounts)){
			$landPayable=(new FixedAssetsPayableEndBalance())->calculateEndBalance($landAcquisitionDatesAndAmounts,$landAcquisitionPayments,$dateIndexWithDate,$hospitalitySector);
			$landPayable = $landPayable['monthly']['end_balance'] ?? [];
		}
		
		$constructionAcquisitionDatesAndAmounts = $dashboardItems['hardConstructionExecutionAndPayment'] ?? [];
		
		$constructionAcquisitionDatesAndAmounts = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($constructionAcquisitionDatesAndAmounts,$datesAsStringAndIndex);
		$constructionAcquisitionDatesAndAmounts = HArr::sumAtDates([$constructionAcquisitionDatesAndAmounts,[]],$studyDates);
		
		$constructionAcquisitionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Hard Construction Payment'] ?? [] ;
		$constructionPayable = [];
		if(count($constructionAcquisitionDatesAndAmounts)){
			$constructionPayable=(new FixedAssetsPayableEndBalance())->calculateEndBalance($constructionAcquisitionDatesAndAmounts,$constructionAcquisitionPayments,$dateIndexWithDate,$hospitalitySector);
			$constructionPayable = $constructionPayable['monthly']['end_balance'] ?? [];
		}
		
		
		
		$softAcquisitionDatesAndAmounts = $dashboardItems['softConstructionExecutionAndPayment'] ?? [];
		$softAcquisitionDatesAndAmounts = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($softAcquisitionDatesAndAmounts,$datesAsStringAndIndex);
		$softAcquisitionDatesAndAmounts = HArr::sumAtDates([$softAcquisitionDatesAndAmounts,[]],$studyDates);
		
		$softAcquisitionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['Soft Construction Payment'] ?? [] ;
		$softPayable = [];
		if(count($softAcquisitionDatesAndAmounts)){
			$softPayable=(new FixedAssetsPayableEndBalance())->calculateEndBalance($softAcquisitionDatesAndAmounts,$softAcquisitionPayments,$dateIndexWithDate,$hospitalitySector);
			$softPayable = $softPayable['monthly']['end_balance'] ?? [];
		}
		
		
		
		$ffeAcquisitionDatesAndAmounts = $dashboardItems['ffeExecutionAndPayment'] ?? [];
		
		$ffeAcquisitionDatesAndAmounts = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($ffeAcquisitionDatesAndAmounts,$datesAsStringAndIndex);
		$ffeAcquisitionDatesAndAmounts = HArr::sumAtDates([$ffeAcquisitionDatesAndAmounts,[]],$studyDates);
		$ffeAcquisitionPayments = $dashboardItems['CashOutReport']['Acquisition And Development Payment']['FFE Payment'] ?? [] ;
		$ffePayable = [];
		if(count($ffeAcquisitionDatesAndAmounts)){
			$ffePayable=(new FixedAssetsPayableEndBalance())->calculateEndBalance($ffeAcquisitionDatesAndAmounts,$ffeAcquisitionPayments,$dateIndexWithDate,$hospitalitySector);
			$ffePayable = $ffePayable['monthly']['end_balance'] ?? [];
		}
		
				$equityInjection = $dashboardItems['CashInReport']['Equity Injection'] ?? [] ;
				$totalOfEquityInjection = HArr::sumAtDates(array_values($equityInjection),$studyDates); 
	
				$paidUpCapital =  $totalOfEquityInjection;
				$paidUpCapital = HArr::accumulateArray($paidUpCapital);	
				$annuallyNetProfit = $reportItemsInterval['net_profit']['Net Profit']??[];
		
				$retainedEarning = $hospitalitySector->calculateRetainedEarning($annuallyNetProfit );
					
					
					
				$propertyTaxesStatementService = new PropertyTaxesPayableEndBalance();
				$propertyInsuranceStatementService = new PropertyInsurancePayableEndBalance();
					
					
				$monthlyPropertyTaxesExpenses = $monthlyPropertyTaxesAndExpensesAndPayments['monthlyPropertyTaxesExpenses'] ?? []; 
				$propertyTaxesPayments = $monthlyPropertyTaxesAndExpensesAndPayments['payments'] ?? []; 
				
				$monthlyPropertyInsuranceExpenses = $monthlyPropertyInsuranceAndExpensesAndPayments['monthlyPropertyInsuranceExpenses'] ?? []; 
				$propertyInsurancePayments = $monthlyPropertyInsuranceAndExpensesAndPayments['payments'] ?? []; 
				
				$propertyTaxesPaymentStatements=$propertyTaxesStatementService->getPropertyTaxesPayableEndBalance($monthlyPropertyTaxesExpenses , $propertyTaxesPayments,$dateIndexWithDate,$dateWithDateIndex,$hospitalitySector);
					
				$propertyTaxesEndBalance = $propertyTaxesPaymentStatements['monthly']['end_balance'] ?? [];
				
				$propertyTaxesEndBalance = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($propertyTaxesEndBalance,$datesAsStringAndIndex);
		
				
				$propertyInsurancePaymentStatements=$propertyInsuranceStatementService->getPropertyInsurancePayableEndBalance($monthlyPropertyInsuranceExpenses , $propertyInsurancePayments,$dateIndexWithDate,$dateWithDateIndex,$hospitalitySector);
					
				$propertyInsuranceEndBalance = $propertyInsurancePaymentStatements['monthly']['end_balance'] ?? [];
				
				$propertyInsuranceEndBalance = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($propertyInsuranceEndBalance,$datesAsStringAndIndex);

				
				$corporateTaxesEndBalance = $finalReportItems['monthly']['taxes']['Corporate Taxes Payments']['monthly']['end_balance'];
			
				

				$totalCurrentLiabilities = HArr::sumAtDates([
					$disposablePayablesForRooms,$disposablePayablesForFoods,$disposablePayablesForGaming,$propertyTaxesEndBalance,$propertyInsuranceEndBalance,$corporateTaxesEndBalance,
					$accruedExpenses,$managementFeesEndBalance,$otherPayableBalance,$propertyPayable,$landPayable,$constructionPayable,$softPayable,$ffePayable
				],$studyDates);
				
				$workingCapital = HArr::subtractAtDates([$totalCurrentAssets,$totalCurrentLiabilities],$studyDates);
				$totalInvestment = HArr::subtractAtDates([$totalAssets,$totalCurrentLiabilities],$studyDates);
				
				$totalOwnersEquity = HArr::sumAtDates([$paidUpCapital,$retainedEarning,$annuallyNetProfit],$studyDates);
				$totalLongTermLoans= HArr::sumAtDates([$propertyLoanEndBalance,$landLoanEndBalance,$hardConstructionLoanEndBalance,$ffeLoanEndBalance],$studyDates);
				$checkError = HArr::subtractAtDates([$totalInvestment,$totalLongTermLoans,$totalOwnersEquity],$studyDates);
				
				$totalFixedAssets = HArr::sumAtDates([$landFixedAssets,$buildingFixedAssets,$totalFFEFixedAssets,$totalBeginningStartUpAndPreOperatingAssets],$studyDates);
				$totalAccumulatedDepreciation = HArr::sumAtDates([$buildingAccumulatedDepreciation,$totalFFEAccumulatedDepreciation,$totalAccumulatedDepreciationStartUpAndPreOperatingAssets],$studyDates);
				$totalNetFixedAssets= HArr::sumAtDates([$landFixedAssets,$buildingEndBalance,$totalFFEEndBalance,$totalEndBalanceStartUpAndPreOperatingAssets],$studyDates);
				$totalProjectsUnderProgress= HArr::sumAtDates([$projectUnderProgressConstructionEndBalance,$projectUnderProgressFFEEndBalance],$studyDates);
				$totalCustomersReceivables= HArr::sumAtDates([$customerReceivablesForRooms,$customerReceivablesForFoods,$customerReceivablesForGaming,$customerReceivablesForMeetings,$customerReceivablesForOthers],$studyDates);
				$totalDisposablesInventory= HArr::sumAtDates([$disposablesInventoryForRooms,$disposablesInventoryForFoods,$disposablesInventoryForGaming],$studyDates);
				$totalSuppliersPayables= HArr::sumAtDates([$disposablePayablesForRooms,$disposablePayablesForFoods,$disposablePayablesForGaming,$propertyInsuranceEndBalance,$otherPayableBalance],$studyDates);
				$totalFixedAssetsPayables= HArr::sumAtDates([$propertyPayable,$landPayable,$constructionPayable,$softPayable,$ffePayable],$studyDates);
				$totalTaxesPayables= HArr::sumAtDates([$propertyTaxesEndBalance,$corporateTaxesEndBalance],$studyDates);
				
				$totalOtherCreditors= HArr::sumAtDates([$accruedExpenses,$managementFeesEndBalance],$studyDates);
				
				
				$balanceSheetItems = [
					'Fixed Assets'=>[
						'Fixed Assets'=> arrayMergeTwoDimArray($totalFixedAssets,[
							'subItems'=>
							[
								'Land'=>$landFixedAssets,
								'Building'=>$buildingFixedAssets,
								'FFE'=>$totalFFEFixedAssets,
								'Others'=>$totalBeginningStartUpAndPreOperatingAssets
								]])
					]
				,
				'Accumulated Depreciation'=>[
					'Accumulated Depreciation'=> arrayMergeTwoDimArray($totalAccumulatedDepreciation,[
						'subItems'=>
						[
						'Building Accumulated Depreciation'=>$buildingAccumulatedDepreciation,
						'FFE Accumulated Depreciation'=>$totalFFEAccumulatedDepreciation,
						'Others'=>$totalAccumulatedDepreciationStartUpAndPreOperatingAssets
							]])
				]
						,
						'Net Fixed Assets'=>[
							'Net Fixed Assets'=> arrayMergeTwoDimArray($totalNetFixedAssets,[
								'subItems'=>
								[
									'Land'=>$landFixedAssets,
									'Building'=>$buildingEndBalance,
									'FFE'=>$totalFFEEndBalance,
									'Others'=>$totalEndBalanceStartUpAndPreOperatingAssets
									
									]])
						],
								'Projects Under Progress'=>[
									'Projects Under Progress'=> arrayMergeTwoDimArray($totalProjectsUnderProgress,[
										'subItems'=>
										[
											'Construction'=>$projectUnderProgressConstructionEndBalance,
											'FFE'=>$projectUnderProgressFFEEndBalance,
											
											]])
								],
		
				'Total Long Term Assets'=>[
					'Total Long Term Assets'=>$totalLongTermAssets
				],
				
				'Total Cash & Banks'=>[
					'Total Cash & Banks'=>$totalCashAndBanks,
				],
				
				'Customers\' Receivables'=> [
					'Customers\' Receivables'=>arrayMergeTwoDimArray($totalCustomersReceivables,[
						'subItems'=>
						[
							'Rooms Receivables'=>$customerReceivablesForRooms ,
						'F&B Receivables'=>$customerReceivablesForFoods,
						'Gaming Receivables'=>$customerReceivablesForGaming,
						'Meeting Spaces Receivables'=>$customerReceivablesForMeetings,
						'Other Revenues Receivables'=>$customerReceivablesForOthers ,
							
							]])
				]
						,'Disposables Inventory'=> [
							'Disposables Inventory'=>
								arrayMergeTwoDimArray($totalDisposablesInventory,[
									'subItems'=>
									[
										'Rooms Disposables'=>$disposablesInventoryForRooms,
							'F&B Disposables'=>$disposablesInventoryForFoods,
							'Gaming Disposables'=>$disposablesInventoryForGaming,
										
										]])
							
						]
								,
				
				
				'Other Debtors'=>[
					'Other Debtors'=>$otherDebtors
				],
				'Total Current Assets'=>[
					'Total Current Assets'=>$totalCurrentAssets
				] //
				,'Total Assets'=>[
					'Total Assets'=>$totalAssets
				],
				
				'Suppliers\' Payables'=> [
					'Suppliers\' Payables'=>arrayMergeTwoDimArray($totalSuppliersPayables,[
						'subItems'=>
						[
							'Rooms Disposable Payables'=>$disposablePayablesForRooms,
							'F&B Disposable Payables'=>$disposablePayablesForFoods,
							'Gaming Disposable Payables'=>$disposablePayablesForGaming,
							'Property Insurance Payables'=> $propertyInsuranceEndBalance,
							'Others'=>$otherPayableBalance
							
							]])
				]
						,'Fixed Assets\' Payables'=> [
							'Fixed Assets\' Payables'=>arrayMergeTwoDimArray($totalFixedAssetsPayables,[
								'subItems'=>
								[
									'Property Payables'=>$propertyPayable,
									'Land Payables'=>$landPayable,
									'Construction Payables'=>$constructionPayable,
									'Soft Payables'=>$softPayable,
									'FFE Payables'=>$ffePayable,
									
									]])
						]
		,'Taxes Payables'=> [
			'Taxes Payables'=>arrayMergeTwoDimArray($totalTaxesPayables,[
				'subItems'=>
				[
					'Property Taxes'=>$propertyTaxesEndBalance,
					'Corporate Taxes'=>$corporateTaxesEndBalance,
					
					]])
		]
				,
	
				'Current Portion Of Long Term Debt'=>[
					'Current Portion Of Long Term Debt'=>$currentPortionOfLongTermDebt
				],
				
				'Other Creditors'=> [
					'Other Creditors'=>arrayMergeTwoDimArray($totalOtherCreditors,[
						'subItems'=>
						[
							'Accrued Expenses'=>$accruedExpenses,
							'Management Fees'=>$managementFeesEndBalance,
							
							]])
				]
						,
				//Total start from Suppliers Payables  till Other Creditors
				'Total Current Liabilities'=>[
					'Total Current Liabilities'=>$totalCurrentLiabilities
				],
				'Working Capital'=>[
					'Working Capital'=>$workingCapital
				],
				'Total Investment'=>[
					'Total Investment'=>$totalInvestment
				],
				
				'Long Term Loans'=> [
					'Long Term Loans'=>arrayMergeTwoDimArray($totalLongTermLoans,[
						'subItems'=>
						[
							'Property Loan'=>$propertyLoanEndBalance,
							'Land Loan'=>$landLoanEndBalance,//end balance
							'Construction Loan'=>$hardConstructionLoanEndBalance,
							'FFE Loan'=> $ffeLoanEndBalance // end balance 
							
							]])
				]
				,
				'Owners Equity'=> [
					'Owners Equity'=>arrayMergeTwoDimArray($totalOwnersEquity,[
						'subItems'=>
						[
							'Paid Up Capital'=>$paidUpCapital, // Equity Injection + Working Capital (cash In report) [totals ]
							'Retained Earnings'=>$retainedEarning,//excel
							'Net Profit'=>$annuallyNetProfit,// last line in Income Statement
							
							]])
				]
				,
			
				'Check Error'=>[
					'Check Error'=>$checkError
				],
				
				
				
		];
		if($returnItems)
		{
			return [
				'balance_sheet_items'=>$balanceSheetItems,
				'cashInOutReport'=>$cashInOutReport,
				'study_dates'=>$studyDates
			] ;
		}
		$reportItems = $balanceSheetItems;
		return view('admin.hospitality-sector.balance-sheet-report', [
			'company' => $company,
			'reportItems' => $reportItems,
			'hospitalitySector' => $hospitalitySector,
			'dates' => $hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
			'hospitality_sector_id'=>$hospitalitySectorId
		]);
	}
	public function viewRatioAnalysisReport($companyId, $hospitalitySectorId )
	{
		$company = Company::find($companyId);
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId)->load(['departmentExpenses']);
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear = App('yearIndexWithYear');
		$dateIndexWithDate = App('dateIndexWithDate');
		$dateWithDateIndex = App('dateWithDateIndex');
		$dateWithMonthNumber = App('dateWithMonthNumber');
		$datesAsStringAndIndex = $hospitalitySector->getDatesAsStringAndIndex();
		$balanceSheetReportItems = $this->viewBalanceSheetReport($companyId, $hospitalitySectorId , true) ;

		$studyDates = $balanceSheetReportItems['study_dates'] ?? [];
		$annuallyReport = $balanceSheetReportItems['cashInOutReport']['finalReportItems']['annually']  ?? [ ];
		
		$roomsDisposableCost = removeKeyFromArray($annuallyReport['directExpenses']['Departmental Expenses']['subItems']['Rooms Direct Expenses']['subItems']['Disposable Expense']??[],'subItems');
		$roomsDisposableCost = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($roomsDisposableCost,$dateIndexWithDate);
		$roomsDisposableCost = sumIntervals($roomsDisposableCost,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$foodsDisposableCost = removeKeyFromArray($annuallyReport['directExpenses']['Departmental Expenses']['subItems']['Foods Direct Expenses']['subItems']['Disposable Expense']??[],'subItems');
		$foodsDisposableCost = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($foodsDisposableCost,$dateIndexWithDate);
		$foodsDisposableCost = sumIntervals($foodsDisposableCost,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$gamingDisposableCost = removeKeyFromArray($annuallyReport['directExpenses']['Departmental Expenses']['subItems']['Gaming Direct Expenses']['subItems']['Disposable Expense']??[],'subItems');
		$gamingDisposableCost = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($gamingDisposableCost,$dateIndexWithDate);
		$gamingDisposableCost = sumIntervals($gamingDisposableCost,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		$disposableCost = HArr::sumAtDates([$roomsDisposableCost,$foodsDisposableCost,$gamingDisposableCost],getDateFromThreeArrays($roomsDisposableCost,$foodsDisposableCost,$gamingDisposableCost));
		
		$salesRevenues = removeKeyFromArray($annuallyReport['hotelRevenue']['Total Hotel Revenues'] ?? [ ],'subItems') ;
		$salesRevenues = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($salesRevenues,$dateIndexWithDate);
		$salesRevenues = sumIntervals($salesRevenues,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$EBT = $annuallyReport['EBT']['Earnings Before Taxes [ EBT ]']??[];
		$EBT = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($EBT,$dateIndexWithDate);
		$EBT = sumIntervals($EBT,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$corporateTaxes =  $annuallyReport['taxes']['Corporate Taxes'] ?? [];
		$corporateTaxes = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($corporateTaxes,$dateIndexWithDate);
		$annuallyDates = getDateFromTwoArrays($EBT,$corporateTaxes) ;
		$netProfit = HArr::subtractAtDates([$EBT,$corporateTaxes],$annuallyDates);
		
		$EBIT = $annuallyReport['EBIT']['Earnings Before Interest Taxes [ EBIT ]'] ?? [ ] ;
		$EBIT = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($EBIT,$dateIndexWithDate);
		$EBIT = sumIntervals($EBIT,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		$EBITDA = $annuallyReport['EBITDA']['Earnings Before Interest Taxes Depreciation & Amortization [ EBITDA ]'] ?? [];
		$EBITDA = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($EBITDA,$dateIndexWithDate);
		$EBITDA = sumIntervals($EBITDA,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		// intervalsEndBalance
		$grossProfit = $annuallyReport['DepartmentsGrossProfit']['Departments Gross Profit'] ?? [] ;
		$grossProfit = removeKeyFromArray($grossProfit,'subItems');
		$grossProfit = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($grossProfit,$dateIndexWithDate);
		$grossProfit = sumIntervals($grossProfit,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		
		$totalInvestment = $balanceSheetReportItems['balance_sheet_items']['Total Investment']['Total Investment'] ?? [] ;
		$totalInvestment = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($totalInvestment,$dateIndexWithDate);
		$totalInvestment = intervalsEndBalance($totalInvestment,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$totalCurrentLiabilities=$balanceSheetReportItems['balance_sheet_items']['Total Current Liabilities']['Total Current Liabilities'] ??[];
		$totalCurrentLiabilities = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($totalCurrentLiabilities,$dateIndexWithDate);
		$totalCurrentLiabilities = intervalsEndBalance($totalCurrentLiabilities,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

		$totalLongLiabilities = $balanceSheetReportItems['balance_sheet_items']['Long Term Loans']['Long Term Loans'] ??[];
		$totalLongLiabilities = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($totalLongLiabilities,$dateIndexWithDate);
		$totalLongLiabilities = removeKeyFromArray($totalLongLiabilities,'subItems');
		$totalLongLiabilities = intervalsEndBalance($totalLongLiabilities,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$totalLiabilities = HArr::sumAtDates([$totalCurrentLiabilities,$totalLongLiabilities],getDateFromTwoArrays($totalCurrentLiabilities,$totalLongLiabilities));
		
		$totalCurrentAssets = $balanceSheetReportItems['balance_sheet_items']['Total Current Assets']['Total Current Assets'] ?? [];
		$totalCurrentAssets = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($totalCurrentAssets,$dateIndexWithDate);
		$totalCurrentAssets = intervalsEndBalance($totalCurrentAssets,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$totalAssets = $balanceSheetReportItems['balance_sheet_items']['Total Assets']['Total Assets'] ?? [];
		$totalAssets = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($totalAssets,$dateIndexWithDate);
		$totalAssets = intervalsEndBalance($totalAssets,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		
		$ownersEquity = $balanceSheetReportItems['balance_sheet_items']['Owners Equity']['Owners Equity'] ?? [];
		$ownersEquity = removeKeyFromArray($ownersEquity,'subItems');
		$ownersEquity = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($ownersEquity,$dateIndexWithDate);
		$ownersEquity = intervalsEndBalance($ownersEquity,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		
		
		$cashAndBanks = $balanceSheetReportItems['balance_sheet_items']['Total Cash & Banks']['Total Cash & Banks'] ?? [];
		$cashAndBanks = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($cashAndBanks,$dateIndexWithDate);
		$cashAndBanks = intervalsEndBalance($cashAndBanks,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		
		$customersReceivablesAndChecks = $balanceSheetReportItems['balance_sheet_items']['Customers\' Receivables']['Customers\' Receivables'] ?? [];
		$customersReceivablesAndChecks = removeKeyFromArray($customersReceivablesAndChecks,'subItems');
		$customersReceivablesAndChecks = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($customersReceivablesAndChecks,$dateIndexWithDate);
		$customersReceivablesAndChecks = intervalsEndBalance($customersReceivablesAndChecks,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		// $netProfit = $annuallyReport['net_profit']['Net Profit'] ??[];
		$workingCapital = $balanceSheetReportItems['balance_sheet_items']['Working Capital']['Working Capital'] ?? [];
		$workingCapital = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($workingCapital,$dateIndexWithDate);
		$workingCapital = intervalsEndBalance($workingCapital,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		
		$supplierPayablesAndChecks =$balanceSheetReportItems['balance_sheet_items']['Suppliers\' Payables']['Suppliers\' Payables'] ?? []; 
		$supplierPayablesAndChecks = removeKeyFromArray($supplierPayablesAndChecks,'subItems');
		$supplierPayablesAndChecks = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($supplierPayablesAndChecks,$dateIndexWithDate);
		$supplierPayablesAndChecks = intervalsEndBalance($supplierPayablesAndChecks,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		$inventory =$balanceSheetReportItems['balance_sheet_items']['Disposables Inventory']['Disposables Inventory'] ?? []; 
		$inventory = removeKeyFromArray($inventory,'subItems');
		$inventory = $hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($inventory,$dateIndexWithDate);
		$inventory = intervalsEndBalance($inventory,'annually',$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
		
		
		$dates = sumIntervals($studyDates , 'annually' , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
			 $dates = $hospitalitySector->convertArrayOfStringDatesToStringDatesAndDateIndex($dates,$dateIndexWithDate,$dateWithDateIndex);
			 
			 $ratioAnalysisService = new RatioAnalysisService();
		  $ratio_analysis_report = $ratioAnalysisService->__calculate(array_keys($dates),$salesRevenues,$EBIT ,$EBITDA,$grossProfit,$totalInvestment,$totalLiabilities,$totalAssets,
		  $ownersEquity,$cashAndBanks,$customersReceivablesAndChecks,
			$totalCurrentAssets,  $totalCurrentLiabilities ,$netProfit , $workingCapital,$supplierPayablesAndChecks,$inventory,
			$disposableCost
		);
		
		$view_dates = $dates ;
		$view_dates = array_keys($view_dates);
		return view('admin.hospitality-sector.ratio-analysis', [
			'company' => $company,
			'ratio_analysis_report' => $ratio_analysis_report ,
			'dates' => $dates,
			'view_dates' => $view_dates,
			'navigators' => array_merge($this->getCommonNavigators($companyId, $hospitalitySectorId), []),
			'hospitality_sector_id'=>$hospitalitySectorId,
			'hospitalitySector'=>$hospitalitySector 
		]);
	}
	
	protected function onlyMonthlyDashboardItems(array $dashboardItems, HospitalitySector $hospitalitySector,int $operationStartDateAsIndex,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithDateIndex,array $operationDates,array $fixedAssetsLoan , string $intervalName ='monthly',$propertyAssetsForBuilding=null,$propertyAssetsForFFE=null)
	{
		$projectUnderProgressService = new ProjectsUnderProgress();
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$studyDurationPerYear = $hospitalitySector->getStudyDurationPerYear($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber,true, true, false);
		$studyDates = $hospitalitySector->getOnlyDatesOfActiveStudy($studyDurationPerYear,$dateIndexWithDate);
		$studyEndDate = $hospitalitySector->getStudyEndDateFormatted();
		
		$hotelRevenue = [];
		$totalHotelRevenueSubItems = [];
		$propertyAssetsForBuilding =[] ;
			$propertyAssetsForFFE=[];
			$projectUnderProgressConstruction = [];
			$projectUnderProgressFFE = [];
			
			$ffeExecutionAndPayment = $dashboardItems['ffeExecutionAndPayment']??[] ;
		$ffeLoanInterestAmounts = $dashboardItems['ffeLoanInterestAmounts']??[] ;
		$ffeLoanWithdrawalInterestAmounts = $dashboardItems['ffeLoanWithdrawalInterest']??[] ;
	
		$landLoanInterestAmounts = $fixedAssetsLoan['landLoanInterestAmounts'];
		$propertyLoanInterestAmounts = $fixedAssetsLoan['propertyLoanInterestAmounts'];
		$hardConstructionLoanInterestAmounts = $fixedAssetsLoan['hardConstructionLoanInterestAmounts'];
		
		$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
		$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
		$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
		$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
		$totalOfFFEItemForFFE=[];
		//
		
	
		$ffeLoanInterestAmounts = $fixedAssetsLoan['ffeLoanInterestAmounts'];
		
		foreach ([
			'monthlyRevenuePerRoom' => ['title' => 'Total Rooms Revenue', 'hasTotalKey' => true, 'modelName' => 'Room'],
			'fAndBFacilityRevenue' => ['title' => 'Total F&B Revenues', 'hasTotalKey' => false, 'modelName' => 'Food'],
			'casinoFacilityRevenue' => ['title' => 'Total Gaming Revenues', 'hasTotalKey' => false, 'modelName' => 'Casino'],
			'meetingFacilityRevenue' => ['title' => 'Total Meeting Spaces Revenues', 'hasTotalKey' => false, 'modelName' => 'Meeting'],
			'otherRevenueFacilityRevenue' => ['title' => 'Total Other Revenues', 'hasTotalKey' => false, 'modelName' => 'Other'],
		] as $key => $options) {
			$totalHotelRevenueSubItems = array_merge(
				$totalHotelRevenueSubItems,
				$this->formatReportForDashboard($dashboardItems, $key, $options['title'], $options['modelName'],$hospitalitySector, $options['hasTotalKey'])
			);
		}
		$totalOfHotelRevenueSubItems = getTotalOfArraysOf2Depth($totalHotelRevenueSubItems);
		
		$hotelRevenue['Total Hotel Revenues'] = $totalOfHotelRevenueSubItems;
		$hotelRevenue['Total Hotel Revenues']['subItems'] = $totalHotelRevenueSubItems;
		$directExpenses = $this->formatDirectExpenseItem($dashboardItems['directExpenses']);
		$undistributedOperatingExpenses = $this->formatDirectExpenseItem($dashboardItems['Undistributed Operating Expenses'] ?? [], 'Undistributed Operating Expenses');
		
		$departmentsGrossProfit = $this->formatDepartmentGrossProfitDashboard($hotelRevenue, $directExpenses);
		
		$calculateProfitsEquationsService = new CalculateProfitsEquationsService();
		$totalGrossProfit = removeKeyFromArray($departmentsGrossProfit['Departments Gross Profit']??[], 'subItems');
		$totalUndistributedOperationExpense = removeKeyFromArray($undistributedOperatingExpenses['Undistributed Operating Expenses'] ??[], 'subItems');
		
		$propertyAcquisition = $hospitalitySector->propertyAcquisition ;
		$propertyMonthlyDepreciation = [];
		
		$projectUnderProgressFFE = $projectUnderProgressService->calculateForFFE($ffeExecutionAndPayment,$ffeLoanInterestAmounts,$ffeLoanWithdrawalInterestAmounts, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		
		
		
		$transferredDateForFFEAsString = array_key_last($projectUnderProgressFFE['transferred_date_and_vales']??[]);
		// FFE 
		
		$ffe = $hospitalitySector->ffe ;
		$ffeAssetItems = [];
		if($ffe){
			$transferredDateForFFEAsString = $transferredDateForFFEAsString?:null;
			$ffeAssetItems = $ffe->calculateFFEAssetsForFFE($transferredDateForFFEAsString,Arr::last($projectUnderProgressFFE['transferred_date_and_vales']??[],null,0),$studyDates,$studyEndDate);
			$totalOfFFEItemForFFE = $this->findTotalOfFFEFixedAssets($ffeAssetItems ,$studyDates);
			
		}
		if($propertyAcquisition){
			$hardConstructionExecution = $dashboardItems['hardConstructionExecutionAndPayment']??[];
			$softConstructionExecution = $dashboardItems['softConstructionExecutionAndPayment']??[];
			$loanInterestOfHardConstruction = $dashboardItems['hardConstructionLoanInterestAmounts']??[];
			$withdrawalInterestOfHardConstruction = $dashboardItems['hardWithdrawalInterestAmount']??[];
			$propertyBuildingCapitalizedInterest = $dashboardItems['propertyBuildingCapitalizedInterest']??[];
			$propertyFFECapitalizedInterest = $dashboardItems['propertyFFECapitalizedInterest']??[];
			$propertyAssetsForBuilding =$propertyAssetsForBuilding ?: $propertyAcquisition->calculatePropertyAssetsForBuilding($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate ,$propertyBuildingCapitalizedInterest);
		
			$propertyAssetsForFFE =$propertyAssetsForFFE?:$propertyAcquisition->calculatePropertyAssetsForFFE($datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$propertyFFECapitalizedInterest);
			
	// startUpAndPreOperationExpensesTotals
		$propertyMonthlyDepreciation = HArr::sumAtDates(
			[
				$propertyAssetsForBuilding['total_monthly_depreciation'] ??[],
				$propertyAssetsForFFE['total_monthly_depreciation']??[],
				$hospitalitySector->convertArrayOfIndexKeysToDateStringAsIndexWithItsOriginalValue($totalOfFFEItemForFFE['total_monthly_depreciation'] ??[],$dateIndexWithDate),
				$dashboardItems['startUpAndPreOperationExpensesTotals']['total_monthly_depreciation']??[]			
				
			],
			$operationDates);
			
			$propertyMonthlyDepreciation = $hospitalitySector->removeDatesAfterDate($propertyMonthlyDepreciation,$hospitalitySector->getStudyEndDateFormatted());
			
			$propertyMonthlyDepreciation = $hospitalitySector->removeDatesBeforeDateOneDim($propertyMonthlyDepreciation,$hospitalitySector->getOperationStartDateFormatted());
			$propertyMonthlyDepreciation = $hospitalitySector->convertArrayOfIndexKeysToIndexAsDateStringWithItsOriginalValue($propertyMonthlyDepreciation,$datesAsStringAndIndex);
			
		}
		
		$projectUnderProgressConstruction = $projectUnderProgressService->calculateForConstruction($hardConstructionExecution,$softConstructionExecution,$loanInterestOfHardConstruction,$withdrawalInterestOfHardConstruction, $hospitalitySector,$operationStartDateAsIndex,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
		$transferredDateForConstructionAsString = array_key_last($projectUnderProgressConstruction['transferred_date_and_vales']??[]);
		$hardConstructionLoanInterestAmountsForIncomeStatement = zeroValueForIndexesBeforeIndex($hardConstructionLoanInterestAmounts, $transferredDateForConstructionAsString);
		
		$ffeLoanInterestAmountsForIncomeStatement = zeroValueForIndexesBeforeIndex($ffeLoanInterestAmounts, $transferredDateForFFEAsString);
		$totalLoanInterest = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes(sumFourArray($propertyLoanInterestAmounts, $landLoanInterestAmounts, $hardConstructionLoanInterestAmounts, $ffeLoanInterestAmounts),$datesAsStringAndIndex);
		$totalHotelRevenue = removeKeyFromArray($hotelRevenue['Total Hotel Revenues'] ??[], 'subItems');
		$baseManagementFees = $hospitalitySector->calculateBaseManagementFeesAmounts($totalHotelRevenue,$datesIndexWithYearIndex);
		$monthlyPropertyTaxesAndExpensesAndPayments = $hospitalitySector->calculatePropertyTaxes($propertyAssetsForBuilding);
		$propertyTaxes = $monthlyPropertyTaxesAndExpensesAndPayments['monthlyPropertyTaxesExpenses'] ?? []; 
		$propertyTaxes = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyTaxes,$datesAsStringAndIndex);
		
		
		$monthlyPropertyInsuranceAndExpensesAndPayments =$hospitalitySector->calculatePropertyInsurance($studyDates,$propertyAssetsForBuilding , $propertyAssetsForFFE , $totalOfFFEItemForFFE );
		$propertyInsurance = $monthlyPropertyInsuranceAndExpensesAndPayments['monthlyPropertyInsuranceExpenses'] ?? [];
		$propertyInsurance = $hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyInsurance,$datesAsStringAndIndex);

		$totalPropertyTaxesAndInsurance=sumTwoArray($propertyTaxes,$propertyInsurance);
		$totalOtherDeduction = sumTwoArray($baseManagementFees, $totalPropertyTaxesAndInsurance);
		$ebitda = $calculateProfitsEquationsService->__calculateEBITDA($totalGrossProfit, $totalUndistributedOperationExpense, $totalOtherDeduction, $totalHotelRevenue);
		return [
			'totalOfFFEItemForFFE'=>$totalOfFFEItemForFFE,
			'ebitda'=>$ebitda,
			'propertyMonthlyDepreciation'=>$propertyMonthlyDepreciation,
			'calculateProfitsEquationsService'=>$calculateProfitsEquationsService,
			'totalLoanInterest'=>$totalLoanInterest,
			'totalHotelRevenue'=>$totalHotelRevenue,
			'projectUnderProgressConstruction'=>$projectUnderProgressConstruction,
			'projectUnderProgressFFE'=>$projectUnderProgressFFE,
			'ffeAssetItems'=>$ffeAssetItems,
			'hotelRevenue'=>$hotelRevenue,
			'directExpenses'=>$directExpenses,
			'departmentsGrossProfit'=>$departmentsGrossProfit,
			'undistributedOperatingExpenses'=>$undistributedOperatingExpenses,
			'totalOtherDeduction'=>$totalOtherDeduction,
			'baseManagementFees'=>$baseManagementFees,
			'propertyTaxes'=>$propertyTaxes,
			'propertyInsurance'=>$propertyInsurance,
			'propertyLoanInterestAmounts'=>$propertyLoanInterestAmounts,
			'landLoanInterestAmounts'=>$landLoanInterestAmounts,
			'hardConstructionLoanInterestAmountsForIncomeStatement'=>$hardConstructionLoanInterestAmountsForIncomeStatement,
			'ffeLoanInterestAmountsForIncomeStatement'=>$ffeLoanInterestAmountsForIncomeStatement,
			'propertyAssetsForBuilding'=>$propertyAssetsForBuilding,
			'propertyAssetsForFFE'=>$propertyAssetsForFFE,
			
		];
	}	
	protected function formatDashboardReportItems(array &$onlyMonthlyDashboardItems   , array $dashboardItems, HospitalitySector $hospitalitySector,int $operationStartDateAsIndex,array $datesAsStringAndIndex,array $datesIndexWithYearIndex,array $yearIndexWithYear,array $dateIndexWithDate,array $dateWithDateIndex,array $operationDates,array $fixedAssetsLoan , string $intervalName ='monthly',$propertyAssetsForBuilding=null,$propertyAssetsForFFE=null)
	{
		
		if($intervalName == 'monthly'){
			$onlyMonthlyDashboardItems = $this->onlyMonthlyDashboardItems( $dashboardItems,  $hospitalitySector, $operationStartDateAsIndex, $datesAsStringAndIndex, $datesIndexWithYearIndex, $yearIndexWithYear, $dateIndexWithDate, $dateWithDateIndex, $operationDates,$fixedAssetsLoan , $intervalName,$propertyAssetsForBuilding,$propertyAssetsForFFE);
		}
		$ebitda = $onlyMonthlyDashboardItems['ebitda'];
		$propertyMonthlyDepreciation = $onlyMonthlyDashboardItems['propertyMonthlyDepreciation'];
		$calculateProfitsEquationsService = $onlyMonthlyDashboardItems['calculateProfitsEquationsService'];
		$totalLoanInterest = $onlyMonthlyDashboardItems['totalLoanInterest'];
		$totalHotelRevenue = $onlyMonthlyDashboardItems['totalHotelRevenue'];
		$projectUnderProgressConstruction = $onlyMonthlyDashboardItems['projectUnderProgressConstruction'];
		$projectUnderProgressFFE = $onlyMonthlyDashboardItems['projectUnderProgressFFE'];
		$ffeAssetItems = $onlyMonthlyDashboardItems['ffeAssetItems'];
		$hotelRevenue =  $onlyMonthlyDashboardItems['hotelRevenue'];
		$directExpenses =  $onlyMonthlyDashboardItems['directExpenses'];
		$departmentsGrossProfit =  $onlyMonthlyDashboardItems['departmentsGrossProfit'];
		$undistributedOperatingExpenses =  $onlyMonthlyDashboardItems['undistributedOperatingExpenses'];
		$totalOtherDeduction =  $onlyMonthlyDashboardItems['totalOtherDeduction'];
		$baseManagementFees =  $onlyMonthlyDashboardItems['baseManagementFees'];
		$propertyTaxes =  $onlyMonthlyDashboardItems['propertyTaxes'];
		$propertyInsurance =  $onlyMonthlyDashboardItems['propertyInsurance'];
		$totalPropertyTaxesAndInsurance=sumTwoArray($propertyTaxes,$propertyInsurance);
		$propertyLoanInterestAmounts =  $onlyMonthlyDashboardItems['propertyLoanInterestAmounts'];
		$landLoanInterestAmounts =  $onlyMonthlyDashboardItems['landLoanInterestAmounts'];
		$hardConstructionLoanInterestAmountsForIncomeStatement =  $onlyMonthlyDashboardItems['hardConstructionLoanInterestAmountsForIncomeStatement'];
		$ffeLoanInterestAmountsForIncomeStatement =  $onlyMonthlyDashboardItems['ffeLoanInterestAmountsForIncomeStatement'];
		$propertyAssetsForBuilding =  $onlyMonthlyDashboardItems['propertyAssetsForBuilding'];
		$propertyAssetsForFFE =  $onlyMonthlyDashboardItems['propertyAssetsForFFE'];
		$totalOfFFEItemForFFE =  $onlyMonthlyDashboardItems['totalOfFFEItemForFFE'];

		/// annually
	// 	// startUpAndPreOperationExpensesTotals
	// );
	

		$incentiveManagementFeesAmounts = $hospitalitySector->calculateIncentiveManagementFeesAmounts($ebitda['values'], $intervalName,$datesIndexWithYearIndex,$dateIndexWithDate,$dateWithDateIndex);
		
		$ebit = $calculateProfitsEquationsService->__calculateEBIT($ebitda['values']??[], $propertyMonthlyDepreciation, $incentiveManagementFeesAmounts, $totalHotelRevenue);
		$ebt = $calculateProfitsEquationsService->__calculateEBT($ebit['values']??[], $totalLoanInterest, $totalHotelRevenue);
		$corporateTaxes = $hospitalitySector->calculateCorporateTaxes($ebt['values'], $intervalName,$dateIndexWithDate,$dateWithDateIndex);
		$netProfit = $calculateProfitsEquationsService->__calculateNetProfit($ebt['values']??[], $corporateTaxes, $totalHotelRevenue);
		return [
			'totalOfFFEItemForFFE'=>$totalOfFFEItemForFFE,
			'propertyAssetsForBuilding'=>$propertyAssetsForBuilding ,
			'propertyAssetsForFFE'=>$propertyAssetsForFFE,
			'projectUnderProgressConstruction'=>$projectUnderProgressConstruction,
			'projectUnderProgressFFE'=>$projectUnderProgressFFE,
			'ffeAssetItems'=>$ffeAssetItems,
			'hotelRevenue' => $hotelRevenue,
			'directExpenses' => $directExpenses,
			'DepartmentsGrossProfit'=>$departmentsGrossProfit,
			'undistributedOperatingExpenses'=>$undistributedOperatingExpenses,
			'other_deductions' => [
				'other deductions'=>arrayMergeTwoDimArray(
					$totalOtherDeduction,
					[
						'subItems'=>[
							'Base Management Fees'=>$baseManagementFees,
							'Property Taxes & Insurance Expenses'=>$totalPropertyTaxesAndInsurance
						]
					]
				)
			],
			'EBITDA' => [
				'Earnings Before Interest Taxes Depreciation & Amortization [ EBITDA ]'=> $ebitda['values'] ?? [],
				// 'EBITDA %'=> $ebitda['percentages'] ?? [],
			],

			'incentive_management_fees' => [
				'Incentive Management Fees'=>$incentiveManagementFeesAmounts
			],


			'depreciation' => [
				'Depreciation & Amortization Expenses'=>$propertyMonthlyDepreciation
			],



			'EBIT' => [
				'Earnings Before Interest Taxes [ EBIT ]'=>$ebit['values']??[]
			],
			'Interest Expenses' => [
				'Loan Interest Expenses'=> arrayMergeTwoDimArray(
					$totalLoanInterest,
					[
						'subItems'=>[
							'Property Loan Interest Expenses'=>$hospitalitySector->convertStringDatesFromArrayKeysToIndexes($propertyLoanInterestAmounts,$datesAsStringAndIndex),
							'Land Loan Interest Expenses'=>$hospitalitySector->convertStringDatesFromArrayKeysToIndexes($landLoanInterestAmounts,$datesAsStringAndIndex),
							'Construction Loan Interest Expenses'=>$hospitalitySector->convertStringDatesFromArrayKeysToIndexes($hardConstructionLoanInterestAmountsForIncomeStatement,$datesAsStringAndIndex),
							'FF&E Loan Interest Expenses'=>$hospitalitySector->convertStringDatesFromArrayKeysToIndexes($ffeLoanInterestAmountsForIncomeStatement,$datesAsStringAndIndex)
						]
					]
				)

			],
			'EBT' => [
				'Earnings Before Taxes [ EBT ]'=>$ebt['values']??[]
			],
			'taxes' => [
				'Corporate Taxes'=>$corporateTaxes
			],
			'net_profit' => [
				'Net Profit'=>$netProfit['values']??[]
			],
		];
	}

	protected function formatDepartmentGrossProfitDashboard(array $hotelRevenues, array $directExpenses)
	{
		$result = [];
		foreach ($hotelRevenues['Total Hotel Revenues'] ??[] as $indexDate=>$hotelRevenueValue) {
			if (is_numeric($indexDate)) {
				$directExpenseAtDate = $directExpenses['Departmental Expenses'][$indexDate] ?? 0;
				$result['Departments Gross Profit'][$indexDate] = $hotelRevenueValue - $directExpenseAtDate;
			}
			if ($indexDate == 'subItems') {
				// Rooms Gross Profit
				$totalHotelRoomsRevenue = $hotelRevenues['Total Hotel Revenues']['subItems']['Total Rooms Revenue'] ?? [];
				$totalDepartmentalExpensesRoom = $directExpenses['Departmental Expenses']['subItems']['Rooms Direct Expenses']??[];
				$result['Departments Gross Profit']['subItems']['Rooms Gross Profit'] = subtractTwoArray($totalHotelRoomsRevenue, $totalDepartmentalExpensesRoom);

				// F&B Gross Profit
				$totalHotelFoodRevenue = $hotelRevenues['Total Hotel Revenues']['subItems']['Total F&B Revenues'] ?? [];
				$totalDepartmentalExpensesFood = $directExpenses['Departmental Expenses']['subItems']['Foods Direct Expenses']??[];
				$result['Departments Gross Profit']['subItems']['F&B Gross Profit'] = subtractTwoArray($totalHotelFoodRevenue, $totalDepartmentalExpensesFood);


				// Gaming Gross Profit
				$totalHotelGamingRevenue = $hotelRevenues['Total Hotel Revenues']['subItems']['Total Gaming Revenues'] ?? [];
				$totalDepartmentalExpensesGaming = $directExpenses['Departmental Expenses']['subItems']['Gaming Direct Expenses']??[];
				$result['Departments Gross Profit']['subItems']['Gaming Gross Profit'] = subtractTwoArray($totalHotelGamingRevenue, $totalDepartmentalExpensesGaming);

				// Meeting Gross Profit
				$totalHotelMeetingRevenue = $hotelRevenues['Total Hotel Revenues']['subItems']['Total Meeting Spaces Revenues'] ?? [];
				$totalDepartmentalExpensesMeeting = $directExpenses['Departmental Expenses']['subItems']['Meeting Direct Expenses']??[];
				$result['Departments Gross Profit']['subItems']['Meeting Spaces Gross Profit'] = subtractTwoArray($totalHotelMeetingRevenue, $totalDepartmentalExpensesMeeting);
				// Other Gross Profit
				$totalHotelOtherRevenue = $hotelRevenues['Total Hotel Revenues']['subItems']['Total Other Revenues'] ?? [];
				$totalDepartmentalExpensesOther = $directExpenses['Departmental Expenses']['subItems']['Other Revenue Direct Expenses']??[];
				$result['Departments Gross Profit']['subItems']['Other Revenues Gross Profit'] = subtractTwoArray($totalHotelOtherRevenue, $totalDepartmentalExpensesOther);
			}
		}

		return $result;
	}

	protected function formatCashInOutReportItems(array $dashboardItems,HospitalitySector $hospitalitySector)
	{
		$collection = [];
		$cashInReport = [];
		$totalCollectionSubItems = [];
		foreach ($dashboardItems['CashInReport'] as $reportName => $reportValue) {
			$cashInReport = array_merge($cashInReport, $this->formatReportForDashboard($dashboardItems['CashInReport'], $reportName, null, 'null',$hospitalitySector, false));
		}
		foreach ([
			'rooms' => ['title' => 'Total Rooms Collection', 'hasTotalKey' => false, 'modelName' => 'Room'],
			'foods' => ['title' => 'Total F&B Collection', 'hasTotalKey' => false, 'modelName' => 'Food'],
			'gaming' => ['title' => 'Total Gaming Collection', 'hasTotalKey' => false, 'modelName' => 'Casino'],
			'meetings' => ['title' => 'Total Meeting Spaces Collection', 'hasTotalKey' => false, 'modelName' => 'Meeting'],
			'others' => ['title' => 'Total Other Collection', 'hasTotalKey' => false, 'modelName' => 'Other'],
		] as $key => $options) {
			$totalCollectionSubItems = array_merge(
				$totalCollectionSubItems,
				$this->formatReportForDashboard($dashboardItems['collectionPoliciesAndReceivableEndBalances']['collection_policy'], $key, $options['title'], $options['modelName'],$hospitalitySector, $options['hasTotalKey'])
			);
		}
		
		$totalCollectionSubItems = array_merge($cashInReport, $totalCollectionSubItems);
	
		$totalOfCollectionSubItems = getTotalOfArraysOf2Depth($totalCollectionSubItems);
		ksort($totalOfCollectionSubItems);
		$collection['Total Cash In'] = $totalOfCollectionSubItems;
		
		$collection['Total Cash In']['subItems'] = $totalCollectionSubItems;
		

		$report[
			'cashInReport'
			] = $collection;

		$cashOutReportData = [];
		$cashOutReport = [];
		foreach ($dashboardItems['CashOutReport'] as $reportName => $reportValue) {
			$cashOutReport = array_merge($cashOutReport, $this->formatReportForDashboard($dashboardItems['CashOutReport'], $reportName, null, 'null',$hospitalitySector, false));
		}
	
		$totalCashOutReport = getTotalOfArraysOf2Depth($cashOutReport);
		ksort($totalCashOutReport);
		$cashOutReportData['Total Cash Out Report'] = $totalCashOutReport;
		$cashOutReportData['Total Cash Out Report']['subItems'] = $cashOutReport;

		$report[
			'cashOutReport'
			] = $cashOutReportData;
			$netCash = subtractTwoArray(removeKeyFromArray($collection['Total Cash In'], 'subItems'), removeKeyFromArray($cashOutReportData['Total Cash Out Report'], 'subItems')) ;
		
			
		$report['netCash']['Net Cash Report'] =$netCash;
		$report['netCash']['Accumulated Net Cash'] = HArr::accumulateArray($netCash);
		return $report;
	}
	

	protected function formatReportForDashboard(array $dashboardItems, $key, $title, $modelName,HospitalitySector $hospitalitySector, $withTotalKey = false)
	{
		
		$hotelRevenueSubItems = [];
		$title = $title ?: $key;
		$formattedRoomRevenueSubItems = [];
		
		$roomRevenueSubItems = $dashboardItems[$key] ?? [];
	
		$modelFullName = '\\App\Models\\' . $modelName;
		
		$model = null;
		$model = class_exists($modelFullName) ? new ($modelFullName) : null;
		
		foreach ($roomRevenueSubItems as $roomIdentifier => $roomRevenueSubItem) {
			$modelItem = $model ? $hospitalitySector->{$this->modelRelations[$modelName]}->where($modelFullName::getIdentifierColumnName(),'=', $roomIdentifier)->first() : null;
			if ($roomIdentifier != 'total' && $roomIdentifier != 'totalOfEachYear') {
				$dateAndKeys = $withTotalKey ? ($roomRevenueSubItem['total'] ?? []) : $roomRevenueSubItem;
				$hotelRevenueSubItems[$modelItem ? $modelItem->getName() : $roomIdentifier] = $dateAndKeys;
			}
		}
		$formattedRoomRevenueSubItems[$title] = getTotalOfArraysOf2Depth($hotelRevenueSubItems);
		$formattedRoomRevenueSubItems[$title]['subItems'] = $hotelRevenueSubItems;

		return $formattedRoomRevenueSubItems;
	}

	protected function formatDirectExpenseItem(array $directExpensesItems, $mainKeyName = 'Departmental Expenses')
	{
		$sub2  = [];
		$sub3  = [];

		$directExpenseSubItems = [];

		foreach ($directExpensesItems  as $directExpenseModelNames => $directExpenseSectionsNamesWithValues) {
			foreach ($directExpenseSectionsNamesWithValues as $directExpenseModelName => $directExpenseModelValues) {
				foreach ($directExpenseModelValues as $directExpenseIdentifier => $directExpenseDatesAndValues) {
					if (is_numeric($directExpenseIdentifier)) {
						$directExpenseSubItems[$directExpenseModelNames][$directExpenseModelName][$directExpenseIdentifier] = $directExpenseDatesAndValues;
					}
				}
				$sub2[$directExpenseModelNames][$directExpenseModelName] = sumAllOfDates($directExpenseSubItems[$directExpenseModelNames][$directExpenseModelName] ?? []);
				$sub2[$directExpenseModelNames][$directExpenseModelName]['subItems'] = $directExpenseSubItems[$directExpenseModelNames][$directExpenseModelName] ?? [];
			}
			$sub3[$directExpenseModelNames] = sumAllOfDates($sub2[$directExpenseModelNames] ?? []);
			$sub3[$directExpenseModelNames]['subItems'] = $sub2[$directExpenseModelNames];
		}
		$directExpenses[$mainKeyName] =  sumAllOfDates($sub3 ?? []);
		$directExpenses[$mainKeyName]['subItems'] = $sub3 ?? [];

		return $directExpenses;
	}

	public function viewSCurveChart(Request $request, $companyId, $hospitalitySectorId)
	{
		$amount = $request->get('amount') ?: 0;
		$duration = $request->get('duration') ?: 48;
		$initialFactor = $request->get('initial_factor') ?: 8;
		$thirdInt = $request->get('third_int') ?: 4;
		$company = Company::find($companyId);
		$quartersFactors = (array)$request->get('quartersFactors');
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$hardConstructionStartDateAsIndex = $hospitalitySector->getHardConstructionStartDateIndex($hospitalitySector);
		$executionFactors = (new SCurveService())->__calculate($amount, $duration, $hardConstructionStartDateAsIndex, $quartersFactors, $thirdInt, $initialFactor);
		$sumForEachDuration = $this->sumForEachDuration($executionFactors, $duration);
		$executionFactorsChart = $this->formatDataForChart($executionFactors);
		$sCurveChartAccumulated = $this->formatAccumulatedChart($executionFactors);

		return view('admin.hospitality-sector.s-curve', [
			'hospitality_sector_id' => $hospitalitySectorId,
			'company' => $company,
			'sCurveChart' => $executionFactorsChart,
			'hospitalitySector' => $hospitalitySector,
			'amount'=>$amount,
			'thirdInt'=>$thirdInt,
			'sumForEachDuration'=>$sumForEachDuration,
			'sCurveChartAccumulated'=>$sCurveChartAccumulated,
			'duration'=>$duration,
			'quartersFactors'=>$quartersFactors,
			'initialFactor'=>$initialFactor,
			'storeRoute'=>route('admin.view.hospitality.sector.s-curve-chart', ['company'=>$companyId, 'hospitality_sector_id'=>$hospitalitySectorId])
		]);
	}

	protected function formatDataForChart(array $chartItems):array
	{
		$formattedChartItems = [];
		foreach ($chartItems as $index => $value) {
			$formattedChartItems[] = [
				'date' => now()->addMonths($index)->format('Y-m-d'),
				'value' => number_format($value, 0)
			];
		}

		return $formattedChartItems;
	}

	protected function formatAccumulatedChart(array $chartItems):array
	{
		$formattedChartItems = [];
		$oldValue = 0;
		foreach ($chartItems as $index => $value) {
			$oldValue = $oldValue + $value;
			$formattedChartItems[] = [
				'date' => now()->addMonths($index)->format('Y-m-d'),
				'value' => number_format($oldValue, 0)
			];
		}

		return $formattedChartItems;
	}

	protected function sumForEachDuration(array $items, int $duration)
	{
		$sumForEachDuration = [];
		$startIndexForSlice = 0;
		$currentDuration = [
			round(($duration/4)),
			round(($duration/2)),
			round(($duration/4*3)),
			($duration),
		];
		for ($i = 0; $i<4; $i++) {
			$slice = array_slice($items, $startIndexForSlice, $currentDuration[$i]-$startIndexForSlice);
			$startIndexForSlice = $currentDuration[$i];
			$sumForEachDuration[$i] = array_sum($slice);
		}

		return $sumForEachDuration;
	}

	protected function getCommonNavigators($companyId, $hospitalitySectorId):array
	{
		$hospitalitySector = HospitalitySector::find($hospitalitySectorId);
		$canShowConditionalPage = !in_array(Auth()->user()->email , excludeUsers());
		return [
				'studies'=>[
					'name'=>__('Studies'),
					'link' => route('admin.view.hospitality.sector', [$companyId]),
					'show'=>true,
				]
			,
			'study-info' => [
				'name' => __('Study Info'),
				'link' => route('admin.edit.hospitality.sector', [$companyId, $hospitalitySectorId]),
				'show'=>true,
			],
			[
				'name'=>__('Sales Projection'),
				'link'=>'#',
				'show'=>$hospitalitySector->hasVisitSection('room'),
				'sub_items'=>[
					[
						'name'=>__('Room Sales Projection'),
						'link'=>route('admin.view.hospitality.sector.sales.channels', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited = true
					],
					[
						'name'=>__('F&B Sales Projection'),
						'link'=>route('admin.view.hospitality.sector.foods', [$companyId, $hospitalitySectorId]),
						'show'=>$hasFoodSectionAndVisited = $hospitalitySector->hasVisitSection('food')
					],
					[
						'name'=>__('Gaming Sales Projection'),
						'link'=>route('admin.view.hospitality.sector.casinos', [$companyId, $hospitalitySectorId]),
						'show'=>$hasCasinoSectionAndVisited = $hospitalitySector->hasCasinoSection() && $hospitalitySector->hasVisitSection('casino')
					],
					[
						'name'=>__('Meeting Spaces Sales Projection'),
						'link'=>route('admin.view.hospitality.sector.meetings', [$companyId, $hospitalitySectorId]),
						'show'=>$hasMeetingSectionAndVisited = $hospitalitySector->hasMeetingSection() && $hospitalitySector->hasVisitSection('meeting')
					],
					[
						'name'=>__('Other Revenue Sales Projection'),
						'link'=>route('admin.view.hospitality.sector.other.revenues', [$companyId, $hospitalitySectorId]),
						'show'=>$hasOtherRevenueAndVisited = $hospitalitySector->hasOtherSection() && $hospitalitySector->hasVisitSection('other')
					],


				]
			],
			[
				'name'=>__('Departmental Expenses'),
				'link'=>'#',
				'show'=>$hospitalitySector->hasVisitSection('room'),
				'sub_items'=>[
					[
						'name'=>__('Room Direct Expenses'),
						'link'=>route('admin.view.hospitality.sector.rooms.direct.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					],
					[
						'name'=>__('F&B Direct Expenses'),
						'link'=>route('admin.view.hospitality.sector.foods.direct.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasFoodSectionAndVisited
					],
					[
						'name'=>__('Gaming Direct Expenses'),
						'link'=>route('admin.view.hospitality.sector.casinos.direct.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasCasinoSectionAndVisited
					],
					[
						'name'=>__('Meeting Spaces Direct Expenses'),
						'link'=>route('admin.view.hospitality.sector.meeting.direct.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasMeetingSectionAndVisited
					],
					[
						'name'=>__('Other Revenue Direct Expenses'),
						'link'=>route('admin.view.hospitality.sector.other.revenue.direct.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasOtherRevenueAndVisited
					],
				]
			],
			[
				'name'=>__('Undistributed Expenses'),
				'link'=>'#',
				'show'=>$hospitalitySector->hasVisitSection('room'),
				'sub_items'=>[
					[
						'name'=>__('Energy Expenses'),
						'link'=>route('admin.view.hospitality.sector.energy.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					],
					[
						'name'=>__('General & Administrative Expenses'),
						'link'=>route('admin.view.hospitality.sector.general.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					], [
						'name'=>__('Sales & Marketing Expenses'),
						'link'=>route('admin.view.hospitality.sector.marketing.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					],
					 [
						'name'=>__('Property Expenses'),
						'link'=>route('admin.view.hospitality.sector.property.expenses', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					],
					[
						'name'=>__('Management Fees'),
						'link'=>route('admin.view.hospitality.sector.management.fees', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					],
					[
						'name'=>__('Start-up Cost & <br> Pre-operating Expense'),
						'link'=>route('admin.view.hospitality.sector.start.up.cost', [$companyId, $hospitalitySectorId]),
						'show'=>$hasRoomSectionAndVisited
					],

				]
			],


			[
				'name'=>__('Acquisition Cost'),
				'link'=>'#',
				'show'=>$canShowConditionalPage && $hospitalitySector->hasVisitSection('room'),
				'sub_items'=>[
					[
						'name'=>__('Property Acquisition Cost'),
						'link'=>route('admin.view.hospitality.sector.property.acquisition.costs', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&$hasRoomSectionAndVisited
					],
					[
						'name'=>__('Land & Construction Cost'),
						'link'=>route('admin.view.hospitality.sector.land.acquisition.costs', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&$hasRoomSectionAndVisited
					],
					[
						'name'=>__('FF&E Cost'),
						'link'=>route('admin.view.hospitality.sector.ffe.cost', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&$hasRoomSectionAndVisited
					]
				]
			],

			'statement-reports' => [
				'name' => __('Statement Reports'),
				'link' => '#',
				'show'=>$canShowConditionalPage&&true,

				'sub_items' => [

					[
						'name' => __('Collection Report'),
						'link' => '#',
						'show'=>$canShowConditionalPage&&true,
						'sub_items'=>[
							[
								'name'=>__('Room Collection Report'),
								'link'=>route('admin.view.hospitality.sector.receivable.statement', [$companyId, $hospitalitySectorId, 'rooms']),
								'show'=>$canShowConditionalPage&& true,

							],
							[
								'name'=>__('Food Collection Report'),
								'link'=>route('admin.view.hospitality.sector.receivable.statement', [$companyId, $hospitalitySectorId, 'foods']),
								'show'=>$canShowConditionalPage&& true
							],
							[
								'name'=>__('Gaming Collection Report'),
								'link'=>route('admin.view.hospitality.sector.receivable.statement', [$companyId, $hospitalitySectorId, 'gaming']),
								'show'=>$canShowConditionalPage&& $hospitalitySector->hasCasinoSection()
							],
							[
								'name'=>__('Meeting Spaces Collection Report'),
								'link'=>route('admin.view.hospitality.sector.receivable.statement', [$companyId, $hospitalitySectorId, 'meetings']),
								'show'=>$canShowConditionalPage&& $hospitalitySector->hasMeetingSection()
							],
							[
								'name'=>__('Other Revenue Collection Report'),
								'link'=>route('admin.view.hospitality.sector.receivable.statement', [$companyId, $hospitalitySectorId, 'others']),
								'show'=>$canShowConditionalPage&& $hospitalitySector->hasOtherSection()
							],
							[
								'name'=>__('Total Revenues Collection Report'),
								'link'=>route('admin.view.hospitality.sector.receivable.statement', [$companyId, $hospitalitySectorId, 'total']),
								'show'=>$canShowConditionalPage&& true
							]

						]
					],
					[
						'name' => __('Disposable Inventory Statement'),
						'link' => '#',
						'show'=>$canShowConditionalPage&&true,
						'sub_items'=>[
							[
								'name'=>__('Room Disposable Inventory Report'),
								'link'=>route('admin.view.hospitality.sector.inventory.statement', [$companyId, $hospitalitySectorId, 'rooms']),
								'show'=>$canShowConditionalPage&&true,

							],
							[
								'name'=>__('Food Disposable Inventory Report'),
								'link'=>route('admin.view.hospitality.sector.inventory.statement', [$companyId, $hospitalitySectorId, 'foods']),
								'show'=>$canShowConditionalPage&&true
							],
							[
								'name'=>__('Gaming Disposable Inventory Report'),
								'link'=>route('admin.view.hospitality.sector.inventory.statement', [$companyId, $hospitalitySectorId, 'gaming']),
								'show'=>$canShowConditionalPage&&$hospitalitySector->hasCasinoSection()
							],	[
								'name'=>__('Total Disposables Inventory Report'),
								'link'=>route('admin.view.hospitality.sector.inventory.statement', [$companyId, $hospitalitySectorId, 'total']),
								'show'=>$canShowConditionalPage&&true
							],

						]

					],

					[
						'name' => __('Disposable Payment Statement'),
						'link' => '#',
						'show'=>$canShowConditionalPage&&true,
						'sub_items'=>[
							[
								'name'=>__('Room Disposable Payment Statement Report'),
								'link'=>route('admin.view.hospitality.sector.disposable.payment.statement', [$companyId, $hospitalitySectorId, 'rooms']),
								'show'=>$canShowConditionalPage&&true,

							],
							[
								'name'=>__('Food Disposable Payment Statement Report'),
								'link'=>route('admin.view.hospitality.sector.disposable.payment.statement', [$companyId, $hospitalitySectorId, 'foods']),
								'show'=>$canShowConditionalPage&&true
							],
							[
								'name'=>__('Gaming Disposable Payment Statement Report'),
								'link'=>route('admin.view.hospitality.sector.disposable.payment.statement', [$companyId, $hospitalitySectorId, 'gaming']),
								'show'=>$canShowConditionalPage&&$hospitalitySector->hasCasinoSection()
							],	[
								'name'=>__('Total Disposables Payment Statement Report'),
								'link'=>route('admin.view.hospitality.sector.disposable.payment.statement', [$companyId, $hospitalitySectorId, 'total']),
								'show'=>$canShowConditionalPage&&true
							],

						]

					],

					[
						'name' => __('Fixed Expenses Payment Reports'),
						'link' => '#',
						'show'=>$canShowConditionalPage&&true,
						'sub_items'=>[
							[
								'name'=>__('General Fixed Expenses Payment Report'),
								'link'=>route('admin.view.hospitality.sector.prepaid-expense.general.expense.statement', [$companyId, $hospitalitySectorId]),
								'show'=>$canShowConditionalPage&&true,

							],
							[
								'name'=>__('Sales & Marketing Fixed Expenses Payment Report'),
								'link'=>route('admin.view.hospitality.sector.prepaid-expense.marketing.expense.statement', [$companyId, $hospitalitySectorId]),
								'show'=>$canShowConditionalPage&&true,
							],
							[
								'name'=>__('Property Fixed Expenses Payment Report'),
								'link'=>route('admin.view.hospitality.sector.prepaid-expense.property.statement', [$companyId, $hospitalitySectorId]),
								'show'=>$canShowConditionalPage&&true,
							], [
								'name'=>__('Energy Fixed Expenses Payment Report'),
								'link'=>route('admin.view.hospitality.sector.prepaid-expense.energy.statement', [$companyId, $hospitalitySectorId]),
								'show'=>$canShowConditionalPage&&true,
							],
							[
								'name'=>__('Total Fixed Expenses Payment Report'),
								'link'=>route('admin.view.hospitality.sector.total.fixed.expenses.statement', [$companyId, $hospitalitySectorId]),
								'show'=>$canShowConditionalPage&&true,
							],


						]

					],
					
					[
						'name' => __('Management Fees'),
						'link' => route('admin.view.hospitality.sector.management.fees.statement', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,
						// 'sub_items'=>[
						// 	[
						// 		'name'=>__('General Fixed Expenses Payment Report'),
						// 		'link'=>route('admin.view.hospitality.sector.prepaid-expense.general.expense.statement', [$companyId, $hospitalitySectorId]),
						// 		'show'=>true,

						// 	],


						// ]

						],
						
						[
							'name' => __('Property Taxes Statement'),
							'link' => route('admin.view.hospitality.sector.property.taxes.payment.statement', [$companyId, $hospitalitySectorId]),
							'show'=>$canShowConditionalPage&&true,
	
							],[
							'name' => __('Property Insurance Statement'),
							'link' => route('admin.view.hospitality.sector.property.insurance.payment.statement', [$companyId, $hospitalitySectorId]),
							'show'=>$canShowConditionalPage&&true,
	
							],
					[
						'name' => __('Corporate Taxes Statement'),
						'link' => route('admin.view.hospitality.sector.corporate.taxes.statement', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,
						// 'sub_items'=>[
						// 	[
						// 		'name'=>__('General Fixed Expenses Payment Report'),
						// 		'link'=>route('admin.view.hospitality.sector.prepaid-expense.general.expense.statement', [$companyId, $hospitalitySectorId]),
						// 		'show'=>true,

						// 	],


						// ]

					],
					[
						'name' => __('Fixed Assets Statement'),
						'link' => route('admin.view.hospitality.sector.fixed.assets.statement', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,
					],
					
					[
						'name' => __('Loan Schedule'),
						'link' => '#',
						'show'=>$canShowConditionalPage&&true,
						'sub_items'=>[
							[
								'name'=>__('Property Loan Schedule'),
								'link'=>route('admin.view.hospitality.sector.loan.schedule.report', [$companyId, $hospitalitySectorId,'property']),
								'show'=>$canShowConditionalPage&&true,

							],
							[
								'name'=>__('Land Loan Schedule'),
								'link'=>route('admin.view.hospitality.sector.loan.schedule.report', [$companyId, $hospitalitySectorId,'land']),
								'show'=>$canShowConditionalPage&&true,

							],
							[
								'name'=>__('Hard Construction Loan Schedule'),
								'link'=>route('admin.view.hospitality.sector.loan.schedule.report', [$companyId, $hospitalitySectorId,'hard-construction']),
								'show'=>$canShowConditionalPage&&true,

							],
							[
								'name'=>__('FFE Loan Schedule'),
								'link'=>route('admin.view.hospitality.sector.loan.schedule.report', [$companyId, $hospitalitySectorId,'ffe']),
								'show'=>$canShowConditionalPage&&true,

							],
							
							


						]

					],
					
					
				],


			],
			'financial-statement' => [
				'name' => __('Financial Statement'),
				'link' => '#',
				'show'=>$canShowConditionalPage&&true,
				'sub_items'=>[
					[
						'name'=>__('Income Statement'),
						'link'=>route('admin.view.hospitality.sector.income.statement', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,

					], [
						'name'=>__('Cash In Out Flow'),
						'link'=>route('admin.view.hospitality.sector.cash.in.out.report', [$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,
					], [
						'name'=>__('Balance Sheet'),
						'link'=>route('admin.view.hospitality.sector.balance.sheet.report',[$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,
					],
					[
						'name'=>__('Ratio Analysis Report'),
						'link'=>route('admin.view.hospitality.sector.ratio.analysis.report',[$companyId, $hospitalitySectorId]),
						'show'=>$canShowConditionalPage&&true,
					]
				]
			],
			'study-dashboard' => [
				'name' => __('Study Dashboard'),
				'link' => route('admin.view.hospitality.sector.study.dashboard', [$companyId, $hospitalitySectorId]),
				'show'=>$canShowConditionalPage&&true,
			],
		];
	}

	public static function getRedirectUrlName(HospitalitySector $hospitalitySector, string $currentModelName):string
	{
		$currentModelName = Str::singular($currentModelName);
		$canShowConditionalPage = !in_array(Auth()->user()->email , excludeUsers());

		$redirectUrls = [
			'room'=>[
				'route'=>'admin.view.hospitality.sector.rooms',
				'isChecked'=>true
			],
			'food'=>[
				'route'=>'admin.view.hospitality.sector.foods',
				'isChecked'=>true
			],
			'casino'=>[
				'route'=>'admin.view.hospitality.sector.casinos',
				'isChecked'=>$hospitalitySector->hasCasinoSection()
			],
			'meeting'=>[
				'route'=>'admin.view.hospitality.sector.meetings',
				'isChecked'=>$hospitalitySector->hasMeetingSection()
			],
			'other'=>[
				'route'=>'admin.view.hospitality.sector.other.revenues',
				'isChecked'=>$hospitalitySector->hasOtherSection()
			],
			'roomDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.rooms.direct.expenses',
				'isChecked'=>true
			],
			'foodDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.foods.direct.expenses',
				'isChecked'=>true
			],
			'casinoDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.casinos.direct.expenses',
				'isChecked'=>$hospitalitySector->hasCasinoSection()
			],
			'meetingDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.meeting.direct.expenses',
				'isChecked'=>$hospitalitySector->hasMeetingSection()
			],
			'otherDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.other.revenue.direct.expenses',
				'isChecked'=>$hospitalitySector->hasOtherSection()
			],
			'energyDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.energy.expenses',
				'isChecked'=>true
			],
			'generalDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.general.expenses',
				'isChecked'=>true
			],
			'marketingDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.marketing.expenses',
				'isChecked'=>true
			],
			'propertyDirectExpense'=>[
				'route'=>'admin.view.hospitality.sector.property.expenses',
				'isChecked'=>true
			],
			'managementFee'=>[
				'route'=>'admin.view.hospitality.sector.management.fees',
				'isChecked'=>true
			],	
			'startUpCost'=>[
				'route'=>'admin.view.hospitality.sector.start.up.cost',
				'isChecked'=>true
			],
			'propertyAcquisitionCost'=>[
				'route'=>'admin.view.hospitality.sector.property.acquisition.costs',
				'isChecked'=>$canShowConditionalPage&&true
			],
			'landAcquisitionCost'=>[
				'route'=>'admin.view.hospitality.sector.land.acquisition.costs',
				'isChecked'=>$canShowConditionalPage&&true
			],
			'ffeCost'=>[
				'route'=>'admin.view.hospitality.sector.ffe.cost',
				'isChecked'=>$canShowConditionalPage&&true
			],
			'incomeStatementDashboard'=>[
				'route'=>'admin.view.hospitality.sector.income.statement',
				'isChecked'=>$canShowConditionalPage&&true
			],
			'cashInOutReportDashboard'=>[
				'route'=>'admin.view.hospitality.sector.cash.in.out.report',
				'isChecked'=>$canShowConditionalPage&&true
			],



		];
		$redirectUrl = null;
		while (!$redirectUrl) {
			$nextModelName = getNextDate($redirectUrls, $currentModelName);
			if (!$nextModelName) {
				$redirectUrl = 'admin.view.hospitality.sector';

				break;
			}
			if ($redirectUrls[$nextModelName]['isChecked']) {
				$redirectUrl = $redirectUrls[$nextModelName]['route'];
			} else {
				$currentModelName = $nextModelName;
			}
		}

		return $redirectUrl;
	}

	// protected function sumMultiArrayIntervals(array $items)
	// {
	// 	foreach($items as $index=>)
	// }
	protected function storePropertyAcquisitionBreakDown(HospitalitySector $hospitalitySector, Request $request)
	{
		$hospitalitySector->propertyAcquisitionBreakDown()->delete();

		foreach ($request->get('name') as $currentSectionName=>$names) {
			foreach ($names as $currentIndex=>$name) {
				$currentPercentage = $request->input('property_cost_percentage.' . $currentSectionName . '.' . $currentIndex);
				$currentItemValue = $request->input('item_amount.' . $currentSectionName . '.' . $currentIndex);
				$depreciationDuration = $request->input('depreciation_duration.' . $currentSectionName . '.' . $currentIndex);
				$hospitalitySector->propertyAcquisitionBreakDown()->create([
					'property_cost_percentage'=>$currentPercentage,
					'item_amount'=>$currentItemValue,
					'depreciation_duration'=>$depreciationDuration,
					'company_id'=>$request->get('company_id'),
					'name'=>$name,
					'section_name'=>$currentSectionName,
					'hospitality_sector_id'=>$hospitalitySector->id,
					'model_name'=>$request->get('model_name')
				]);
			}
		}
	}
	protected function findTotalOfFFEFixedAssets(array $ffeAsset,array $studyDates ){
		$total = [];
		$initialTotalGross = array_column($ffeAsset,'initial_total_gross');
		$finalTotalGross = array_column($ffeAsset,'final_total_gross');
		$finalTotalAccumulated = array_column($ffeAsset,'accumulated_depreciation');
		$finalTotalOfEndBalance = array_column($ffeAsset,'end_balance');
		$finalTotalOfTotalDepreciation = array_column($ffeAsset,'total_monthly_depreciation');
		$finalTotalOfReplacementCost = array_column($ffeAsset,'replacement_cost');

		$finalTotalGrossCount = count($finalTotalGross);
		foreach($studyDates as $dateAsString=>$dateAsIndex){
			$currenTotal = 0 ;
			$currenAccumulatedDepreciationTotal = 0 ;
			$currentTotalOfEndBalance = 0 ;
			$currentTotalOfInitialGross = 0 ;
			$currentTotalOfTotalDepreciation = 0 ;
			$currentTotalOfReplacementCost = 0 ;
			for($i = 0 ; $i< $finalTotalGrossCount ; $i++){
				$currenTotal+=$finalTotalGross[$i][$dateAsString]??0;
				$currentTotalOfInitialGross+=$initialTotalGross[$i][$dateAsString]??0;
				$currenAccumulatedDepreciationTotal+=$finalTotalAccumulated[$i][$dateAsString]??0;
				$currentTotalOfEndBalance+=$finalTotalOfEndBalance[$i][$dateAsString]??0;
				$currentTotalOfTotalDepreciation+=$finalTotalOfTotalDepreciation[$i][$dateAsString]??0;
				$currentTotalOfReplacementCost+=$finalTotalOfReplacementCost[$i][$dateAsString]??0;
			}
			$total['initial_total_gross'][$dateAsIndex] = $currentTotalOfInitialGross;
			$total['final_total_gross'][$dateAsIndex] = $currenTotal;
			$total['accumulated_depreciation'][$dateAsIndex] = $currenAccumulatedDepreciationTotal;
			$total['end_balance'][$dateAsIndex] = $currentTotalOfEndBalance;
			$total['total_monthly_depreciation'][$dateAsIndex] = $currentTotalOfTotalDepreciation;
			$total['replacement_cost'][$dateAsIndex] = $currentTotalOfReplacementCost;
		}

		return $total ;
	}
	

	public function storeNewModal(company $company , Request $request){
		$companyId = $company->id ;
		$model = new ('\App\Models\\' . $request->get('modalName'));
		$value = $request->get('value');
		$typeColumn = strtolower($request->get('modalName')) . '_type';
		$type = $request->get('modalType');
		
		$previousSelectorNameInDb = $request->get('previousSelectorNameInDb');
		$previousSelectorValue = $request->get('previousSelectorValue');
	
		$modelName = $model->where('company_id',$companyId);
		if($type){
			$modelName = $modelName->where($typeColumn,$type)	;
		}
		$modelName = $modelName->where('name',$value)->first();
		if($modelName){
			return response()->json([
				'status'=>false ,
			]);
		}
		$model->company_id = $companyId;
		$model->name = $value;
		if($type){
			$model->{$typeColumn} = $type;
		}
		if($previousSelectorNameInDb){
			
			$model->{$previousSelectorNameInDb} = $previousSelectorValue;
		}
		$model->save();
		return response()->json([
			'status'=>true ,
			'value'=>$value ,
			'id'=>$model->id 
		]);
	}
	
	public function deleteMulti(Company $company , Request $request){
		QuickPricingCalculator::where('company_id',$company->id)->whereIn('quick_pricing_calculators.id',$request->get('ids',[]))->delete();
		return response()->json([
			'status'=>true ,
			'link'=> route('admin.view.quick.pricing.calculator',['company'=>$company->id , 'active'=>'quick-price-calculator'])
		]);
		
	}
	
}
