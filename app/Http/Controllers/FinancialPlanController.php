<?php

namespace App\Http\Controllers;

use App\Models\Acquisition;
use App\Models\Company;
use App\Models\FFES;
use App\Models\FinancialPlan;
use App\Models\ProductionUnitOfMeasurement;
use App\Models\PropertyAcquisition;
use App\Models\QuickPricingCalculator;
use App\Models\Repositories\financialPlanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FinancialPlanController extends Controller
{
	private financialPlanRepository $financialPlanRepository;

	public function __construct(FinancialPlanRepository $financialPlanRepository)
	{
		$this->financialPlanRepository = $financialPlanRepository;
		
	}

	public function view()
	{
		return view('admin.financial_plans.view', FinancialPlan::getViewVars());
	}

	protected function commonValidation(Request $request)
	{
	}

	

	protected function getCommonStoreData(Request $request, $currentSectionName, $index, $newName, $modelName, $companyId, $financialPlanId): array
	{
	
		return [
			'section_name' => $currentSectionName,
			'name' => $newName,
			'department_name' => $newName,
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
			'financial_plan_id' => $financialPlanId,
			'payload' => $request->input('payload.' . $currentSectionName . '.' . $index),
			'manpower_payload' => $request->input('manpower_payload.' . $currentSectionName . '.' . $index),
			// 'manufacturing_allocations'=>$request->get('manufacturing_allocations',[])
		];
	}

	protected function getCommonStoreDataForFFEItems(Request $request, $currentSectionName, $index, $newName, $modelName, $companyId, $financialPlanId, $ffeId): array
	{
		return [
			'section_name' => $currentSectionName,
			'name' => $newName,
			'model_name' => $modelName,
			'company_id' => $companyId,
			'financial_plan_id' => $financialPlanId,
			'ffe_id'=>$ffeId,
			'depreciation_duration'=>$request->input('depreciation_duration.' . $currentSectionName . '.' . $index),
			'item_cost'=>$request->input('item_cost.' . $currentSectionName . '.' . $index),
			'contingency_rate'=>$request->input('contingency_rate.' . $currentSectionName . '.' . $index),
			'currency_name'=>$request->input('currency_name.' . $currentSectionName . '.' . $index),
			'replacement_cost_rate'=>$request->input('replacement_cost_rate.' . $currentSectionName . '.' . $index),
			'replacement_interval'=>$request->input('replacement_interval.' . $currentSectionName . '.' . $index),
		];
	}


	protected function getFFEData(Request $request):array
	{
		return [
			'financial_plan_id'=>$request->get('financial_plan_id'),
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

	public function storeFFECost(Request $request, Company $company, $financialPlanId)
	{
		$companyId = $company->id;
		$financialPlan = FinancialPlan::find($financialPlanId);
		$modelName = $request->input('model_name');
		$ffeId  = $request->get('ffe_id');
		$ffe = $financialPlan->ffes->where('id',$ffeId)->first();
		$nextFFE = $financialPlan->ffes->where('id','>',$ffeId)->first();
		
		$ffeData = $this->getFFEData($request);
		if ($ffe) {
			$ffe->update($ffeData);
		} else {
			$ffe = $financialPlan->ffes()->create($ffeData);
		}
		$ffeId =$ffe->id;
		$ffe->storeLoans($request->get('loans'), $companyId, $ffeId);

		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreDataForFFEItems($request, $currentSectionName, $index, $newName, $modelName, $companyId, $financialPlanId, $ffeId);
				$isCreate = $newName && !$oldName || !count($financialPlan->ffesItemsFor($ffeId,$currentSectionName, $modelName)->get()) ;
				
				if ($isCreate) {
					$financialPlan->ffeItems()->create($data);
				}
				if ($newName && $oldName && !$isCreate) {
					$currentFFEItems = $financialPlan->ffesItemsFor($ffeId,$currentSectionName, $modelName)->get()[$index];
					if ($currentFFEItems) {
						$currentFFEItems->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $financialPlan->ffesItemsFor($ffeId,$currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		$message = __('FFE Cost has been saved successfully');
		if($request->get('redirect-to-next-FFE') && $nextFFE){
			$redirectUrl = route('admin.view.financial.plan.ffe.cost', [$companyId, $financialPlanId,$nextFFE->id]);
			$message = __('Please Wait');
		}
		elseif ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.financial.plan.ffe.cost', [$companyId, $financialPlanId]);
			$message = __('Please Wait');
		} 
		else {
			$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'ffeCost'), [$companyId, $financialPlanId,'ManufacturingExpenses']);
		}


		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}


	
	

	public function viewFFECost($companyId, $financialPlanId,$ffeId = 0)
	{
		$financialPlan = FinancialPlan::find($financialPlanId);
		$ffe = $financialPlan->getFFE($ffeId) ?: new FFES();
		$nextFFE = $ffe->id ? $financialPlan->ffes->where('id','>',$ffeId)->first() : null;
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		return view('admin.financial_plans.ffe-cost', array_merge([
			'storeRoute' => route('admin.store.financial.plan.ffe.cost', [
				'financial_plan_id' => $financialPlanId,
				'company' => $companyId
			]),
			'type' => 'create',
			'model' => $ffe,
			// 'yearsWithItsMonths' => $financialPlan->getOperationDurationPerYear( $financialPlan->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear ,$dateIndexWithDate,$dateWithMonthNumber),
			'financial_plan_id' => $financialPlanId,
			'studyCurrency' => $financialPlan->getCurrenciesForSelect(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $financialPlanId), []),
			'financialPlan'=>$financialPlan,
			'ffeId'=>$ffeId,
			'nextFFE'=>$nextFFE
		], []));
		// ], $financialPlan->calculateRoomRevenueAndGuestCount()));
	}
	
	public function viewLandAcquisitionCosts($companyId, $financialPlanId)
	{
		$company = Company::find($companyId);
		$financialPlan = FinancialPlan::find($financialPlanId);
		$model = $financialPlan->getAcquisition();
		$model = $model ? $model : new Acquisition();

		$vars = array_merge(
			Acquisition::getViewVars($companyId, $financialPlanId),
			[
				'company' => $company,
				'financialPlan' => $financialPlan,
				'model' => $model,
				'loanType' => 'fixed',
				'navigators' => array_merge($this->getCommonNavigators($companyId, $financialPlanId), [])
			]
		);

		return view('admin.financial_plans.land-acquisition-costs', $vars);
	}
	public function storeLandAcquisitionCosts(Request $request, $companyId, $financialPlanId)
	{
		$financialPlan = FinancialPlan::find($financialPlanId);
		$acquisition = $financialPlan->acquisition;
		$data = $this->getLandAcquisitionData($request);
		if ($acquisition) {
			$acquisition->update($data);
		} else {
			$acquisition = $financialPlan->acquisition()->create($data);
		}
		
		$acquisition->storeLoans($request->get('loans'), $companyId);
		$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'landAcquisitionCost'), [$companyId, $financialPlanId]);
		$message = __('Land & Constructions Costs has been saved successfully');

		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl,
			//'namesWithOldNames'=>$namesWithOldNames
		]);
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
			'financial_plan_id' => $request->get('financial_plan_id'),
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
	
	public function viewPropertyAcquisitionCosts($companyId, $financialPlanId)
	{
		$company = Company::find($companyId);
		$financialPlan = FinancialPlan::find($financialPlanId);
		$model = $financialPlan->getPropertyAcquisition();
		$model = $model ? $model : new PropertyAcquisition();
		$vars = array_merge(
			PropertyAcquisition::getViewVars($companyId, $financialPlanId),
			[
				'company' => $company,
				'financialPlan' => $financialPlan,
				'model' => $model,
				'loanType' => 'fixed',
				'navigators' => array_merge($this->getCommonNavigators($companyId, $financialPlanId), []),
			]
		);

		return view('admin.financial_plans.property-acquisition', $vars);
	}
	
	public function storePropertyAcquisitionCosts(Request $request, $companyId, $financialPlanId)
	{
		$financialPlan = FinancialPlan::find($financialPlanId);
		$propertyAcquisition = $financialPlan->getPropertyAcquisition();

		$data = $this->getPropertyAcquisitionData($request);
		if ($propertyAcquisition) {
			$propertyAcquisition->update($data);
		} else {
			$propertyAcquisition = $financialPlan->propertyAcquisition()->create($data);
		}
		$propertyAcquisitionBreakDown = $this->storePropertyAcquisitionBreakDown($financialPlan, $request);


		$propertyAcquisition->storeLoans($request->get('loans'), $companyId);

		$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'propertyAcquisitionCost'), [$companyId, $financialPlanId]);

		$message = __('Property Acquisition Costs has been saved successfully');

		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl,
		]);
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
			'financial_plan_id' => $request->get('financial_plan_id'),
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
	

	
	
	public function viewProductCapacity($companyId, $financialPlanId)
	{
		$financialPlan = FinancialPlan::find($financialPlanId);
		$operationStartDate = $financialPlan->getOperationStartDate();
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		// $unitOfMeasurements = $financialPlan->manufacturingProducts->pluck('pivot.production_uom')->toArray() ;
		// $productUnitOfSalesFormatted = ProductionUnitOfMeasurement::formatForSelectFromIds($unitOfMeasurements);
		$datesAsStringAndIndex = $financialPlan->getDatesAsStringAndIndex();
		$operationDurationPerYear = $financialPlan->getOperationDurationPerYear($operationStartDate,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber);
		$yearsOfOperationDuration =  array_keys($operationDurationPerYear);
		$daysNumbersOfMonths = $financialPlan->getDaysNumbersOfMonth($datesAsStringAndIndex, $yearsOfOperationDuration,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate);
		$daysCountPerYear = $financialPlan->calculateTotalOperatingDaysCountInEachYear($daysNumbersOfMonths, $operationDurationPerYear);
		// $productionUnitOfMeasurements = DB::table('production_unit_of_measurements')->where('company_id',$companyId)->get();
		$productionUnitOfMeasurements = ProductionUnitOfMeasurement::where('company_id',$companyId)->get()->formatForSelect2(true ,'getId','getName');
		// dd($productionUnitOfMeasurements);
		
		return view('admin.financial_plans.production-capacity', array_merge([
			'storeRoute' => route('admin.store.financial.plan.production.capacity', [
				'financial_plan_id' => $financialPlanId,
				'company' => $companyId
			]),
			
			'type' => 'create',
			'model' => $financialPlan,
			
			'yearsWithItsMonths' => $financialPlan->getOperationDurationPerYear( $operationStartDate,$financialPlan->getDatesAsStringAndIndex(),$datesIndexWithYearIndex,$yearIndexWithYear ,$dateIndexWithDate,$dateWithMonthNumber),
			'financial_plan_id' => $financialPlanId,
			'datesIndexWithYearIndex'=>$datesIndexWithYearIndex,
			'studyCurrency' => $financialPlan->getCurrenciesForSelect(),
			'navigators' => array_merge($this->getCommonNavigators($companyId, $financialPlanId), []),
			'financialPlan'=>$financialPlan,
			'products'=>$financialPlan->manufacturingProducts,
			'productionUnitOfMeasurements'=>$productionUnitOfMeasurements,
			
			'daysCountPerYear'=>$daysCountPerYear
		], []));
		// ], $financialPlan->calculateRoomRevenueAndGuestCount()));
	}
	public function storeProductionCapacity(Company $company,Request $request, $financialPlanId){
		// dd($request->all());
		$financialPlan = FinancialPlan::find($financialPlanId);
		$productIds = $request->get('product_ids',[]) ;
		foreach($productIds as $productId){
			$type=$request->input('type.'.$productId);
			$productionLinesCountType=$request->input('product_lines_count_type.'.$productId);
			// dd($productionLinesCountType);
			$exists = $financialPlan->productCapacities()->wherePivot('product_id',$productId)->exists();
			$pivotArr = [
				'production_lines_count'=>json_encode($request->input('production_lines_count.'.$productId.'.'.$type)),
				'net_working_hours_type'=>$type,
				'production_lines_count_type'=>$productionLinesCountType,
				'production_capacity_per_hour'=>json_encode($request->input('production_capacity_per_hour.'.$productId)),
				'product_waste_rate'=>json_encode($request->input('product_waste_rate.'.$productId)),
				'net_working_hours_per_days'=>json_encode($request->input('net_working_hours_per_days.'.$productId.'.'.$type)),
				'max_working_days_per_year'=>json_encode($request->input('max_working_days_per_year.'.$productId)),
				'max_production_per_year'=>json_encode($request->input('max_production_per_year.'.$productId)),
				'max_saleable_production_per_year'=>json_encode($request->input('max_saleable_production_per_year.'.$productId)),
			] ;
			if($exists){
				$financialPlan->productCapacities()->detach($productId);			
				$financialPlan->productCapacities()->attach($productId,$pivotArr);			
			}else{
				$financialPlan->productCapacities()->attach($productId,$pivotArr);			
			}
			
			
			
			
			
			// stor raw material
			
			
			$rawMaterialType = $request->get('raw_material_type');

		$model = $financialPlan;
		foreach((array)$request->get('tableIds') as $tableId){
			$model->generateRelationDynamicallyForRowMaterial($rawMaterialType)->delete();
			foreach((array)$request->input($rawMaterialType.'.'.$productId) as  $tableDataArr){
				if(isset($tableDataArr['name'])){
					$tableDataArr['relation_name']  = $rawMaterialType ;
					$tableDataArr['company_id']  = $company->id  ;
					$tableDataArr['product_id'] = $productId;
					$tableDataArr['model_id']   = $financialPlan->id ;
					$tableDataArr['model_name']   = 'FinancialPlan' ;
					// if($tableDataArr['payment_terms'] == 'customize'){
					// 	$tableDataArr['custom_collection_policy'] = sumDueDayWithPayment($tableDataArr['payment_rate '],$tableDataArr['due_days']);
					// }
					$model->generateRelationDynamicallyForRowMaterial($rawMaterialType)->create($tableDataArr);
				}
			}
		}
		
			
			
		}
		$message = __('Expenses has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.financial.plan.production.capacity', [$company->id, $financialPlanId]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'ProductionCapacity'), [$company->id, $financialPlanId,'ManufacturingExpenses']);
		}
		return response()->json([
			'status' => true,
			'message' =>$message,
			'redirectTo' => $redirectUrl
		]);
		
	}
	
	

	
	public function create()
	{
		return view('admin.financial_plans.create', FinancialPlan::getViewVars());
	}

	public function paginate(Request $request)
	{
		return $this->financialPlanRepository->paginate($request);
	}

	public function store(Request $request)
	{
		$financialPlan = $this->financialPlanRepository->store($request);
		$companyId = getCurrentCompanyId();
		$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'financialPlan'), [$companyId, $financialPlan->id]);
		return response()->json([
			'status' => true,
			'message' => __('Financial Plan Has Been Stored Successfully'),
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
	
	
	
	public function edit(Company $company, Request $request, FinancialPlan $financialPlan)
	{
		// $redirectUrl = route('admin.view.financial.plan.ffe.cost', ['company' => $companyId, 'financial_plan_id' => $financialPlan->id]);
		return view(FinancialPlan::getCrudViewName(), array_merge(FinancialPlan::getViewVars(), [
			'type' => 'edit',
			'model' => $financialPlan,
			'financialPlan' => $financialPlan
		]));
	}

	public function updateDate(Company $company, Request $request)
	{
		$financialPlan = FinancialPlan::find($request->get('financial_plan_id'));
		$dateString = str_replace(['-', '_'], '/', $request->get('date'));
		$financialPlan->update([
			'start_from' => $dateString
		]);

		return response()->json([
			'status' => true
		]);
	}

	public function updateDurationType(Company $company, Request $request)
	{
		$financialPlan = FinancialPlan::find($request->get('financialPlanId'));
		if ($durationType = Str::slug($request->get('durationType'))) {
			$financialPlan->update([
				'duration_type' => $durationType
			]);
		}

		return response()->json([
			'status' => true
		]);
	}

	public function update(Company $company, Request $request, FinancialPlan $financialPlan)
	{
		$this->financialPlanRepository->update($financialPlan, $request);

		$companyId = getCurrentCompanyId();


		// $redirectUrl = route('admin.view.financial.plans', getCurrentCompanyId());
		$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'financialPlan'), [$companyId, $financialPlan->id]);
		
		
		// $params = ['company' => $companyId, 'financial_plan_id' => $financialPlan->id] ;
		
		// $hasSalesChannels = $request->get('has_sales_channels') && count((array) $request->get('salesChannels'));
		// $ffeId = $financialPlan->ffes->first() ? $financialPlan->ffes->first()->id : 0 ;
		// if($ffeId){
		// 	$params = array_merge($params ,  ['ffe'=>$ffeId] );
		// }
		// $redirectUrl = route('admin.view.financial.plan.ffe.cost', $params );

		return response()->json([
			'status' => true,
			'message' => __('Financial Plan Has Been Updated Successfully'),
			'redirectTo' => $redirectUrl
		]);
	}

	public function export(Request $request)
	{
		// return (new HospitalitySectorExport($this->financialPlanRepository->export($request), $request))->download();
	}

	public function exportReport(Request $request)
	{
		$formattedData = $this->formatReportDataForExport($request);
		$financialPlanId = array_key_first($request->get('valueMainRowThatHasSubItems'));
		$financialPlan = FinancialPlan::find($financialPlanId);

		// return (new HospitalitySectorExport(collect($formattedData), $request, $financialPlan))->download();
	}

	protected function combineMainValuesWithItsPercentageRows(array $firstItems, array $secondItems): array
	{
		$mergeArray = [];
		foreach ($firstItems as $financialPlanId => $financialPlanValues) {
			foreach ($financialPlanValues as $financialPlanItemId => $financialPlanItemsValues) {
				foreach ($financialPlanItemsValues as $date => $value) {
					$mergeArray[$financialPlanId][$financialPlanItemId][$date] = $value;
				}
			}
		}
		foreach ($secondItems as $financialPlanId => $financialPlanValues) {
			foreach ($financialPlanValues as $financialPlanItemId => $financialPlanItemsValues) {
				foreach ($financialPlanItemsValues as $date => $value) {
					$mergeArray[$financialPlanId][$financialPlanItemId][$date] = $value;
				}
			}
		}

		$mergeArray[$financialPlanId] = orderArrayByItemsKeys($mergeArray[$financialPlanId]);

		return $mergeArray;
	}




	protected function getCommonNavigators($companyId, $financialPlanId):array
	{
		$financialPlan = FinancialPlan::find($financialPlanId);
		$canShowConditionalPage = !in_array(Auth()->user()->email , excludeUsers());
		$ffeCosts = $financialPlan->ffes->map(function($ffe) use($companyId,$financialPlan){
			$ffeItem  =$ffe->ffesItemsFor('ffe_cost','ffe')->first();
			
			return [
				'name'=>$ffeItem ? $ffeItem->getName():null,
				'show'=>true ,
				'link'=>route('admin.view.financial.plan.ffe.cost',['company'=>$companyId,'ffe'=>$ffe->id,'financial_plan_id'=>$financialPlan->id])
			];
		})->toArray();
		return [
				'studies'=>[
					'name'=>__('Studies'),
					'link' => route('admin.view.financial.plans', [$companyId]),
					'show'=>true,
				]
			,
			'study-info' => [
				'name' => __('Study Info'),
				'link' => route('admin.edit.financial.plan', [$companyId, $financialPlanId]),
				'show'=>true,
			],
			// [
			// 	'name'=>__('Sales Projection'),
			// 	'link'=>'#',
			// 	'show'=>$financialPlan->hasVisitSection('room'),
			// 	'sub_items'=>[
			// 		[
			// 			'name'=>__('Room Sales Projection'),
			// 			'show'=>$hasRoomSectionAndVisited = true
			// 		],
			// 		[
			// 			'name'=>__('F&B Sales Projection'),
			// 			'link'=>route('admin.view.financial.plan.foods', [$companyId, $financialPlanId]),
			// 			'show'=>$hasFoodSectionAndVisited = $financialPlan->hasVisitSection('food')
			// 		],
			// 		[
			// 			'name'=>__('Gaming Sales Projection'),
			// 			'link'=>route('admin.view.financial.plan.casinos', [$companyId, $financialPlanId]),
			// 			'show'=>$hasCasinoSectionAndVisited = $financialPlan->hasCasinoSection() && $financialPlan->hasVisitSection('casino')
			// 		],
			// 		[
			// 			'name'=>__('Meeting Spaces Sales Projection'),
			// 			'link'=>route('admin.view.financial.plan.meetings', [$companyId, $financialPlanId]),
			// 			'show'=>$hasMeetingSectionAndVisited = $financialPlan->hasMeetingSection() && $financialPlan->hasVisitSection('meeting')
			// 		],
			// 		[
			// 			'name'=>__('Other Revenue Sales Projection'),
			// 			'link'=>route('admin.view.financial.plan.other.revenues', [$companyId, $financialPlanId]),
			// 			'show'=>$hasOtherRevenueAndVisited = $financialPlan->hasOtherSection() && $financialPlan->hasVisitSection('other')
			// 		],


			// 	]
			// ],
			// [
			// 	'name'=>__('Departmental Expenses'),
			// 	'link'=>'#',
			// 	'show'=>$financialPlan->hasVisitSection('room'),
			// 	'sub_items'=>[
			// 		[
			// 			'name'=>__('Room Direct Expenses'),
			// 			'link'=>route('admin.view.financial.plan.rooms.direct.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('F&B Direct Expenses'),
			// 			'link'=>route('admin.view.financial.plan.foods.direct.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasFoodSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('Gaming Direct Expenses'),
			// 			'link'=>route('admin.view.financial.plan.casinos.direct.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasCasinoSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('Meeting Spaces Direct Expenses'),
			// 			'link'=>route('admin.view.financial.plan.meeting.direct.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasMeetingSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('Other Revenue Direct Expenses'),
			// 			'link'=>route('admin.view.financial.plan.other.revenue.direct.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasOtherRevenueAndVisited
			// 		],
			// 	]
			// ],
			// [
			// 	'name'=>__('Undistributed Expenses'),
			// 	'link'=>'#',
			// 	'show'=>$financialPlan->hasVisitSection('room'),
			// 	'sub_items'=>[
			// 		[
			// 			'name'=>__('Energy Expenses'),
			// 			'link'=>route('admin.view.financial.plan.energy.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('General & Administrative Expenses'),
			// 			'link'=>route('admin.view.financial.plan.general.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		], [
			// 			'name'=>__('Sales & Marketing Expenses'),
			// 			'link'=>route('admin.view.financial.plan.marketing.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		],
			// 		 [
			// 			'name'=>__('Property Expenses'),
			// 			'link'=>route('admin.view.financial.plan.property.expenses', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('Management Fees'),
			// 			'link'=>route('admin.view.financial.plan.management.fees', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		],
			// 		[
			// 			'name'=>__('Start-up Cost & <br> Pre-operating Expense'),
			// 			'link'=>route('admin.view.financial.plan.start.up.cost', [$companyId, $financialPlanId]),
			// 			'show'=>$hasRoomSectionAndVisited
			// 		],

			// 	]
			// ],


			[
				'name'=>__('Acquisition Cost'),
				'link'=>'#',
				'show'=>$canShowConditionalPage ,
				'sub_items'=>[
					[
						'name'=>__('Property Acquisition Cost'),
						'link'=>route('admin.view.financial.plan.property.acquisition.costs', [$companyId, $financialPlanId]),
						'show'=>$canShowConditionalPage
					],
					[
						'name'=>__('Land & Construction Cost'),
						'link'=>route('admin.view.financial.plan.land.acquisition.costs', [$companyId, $financialPlanId]),
						'show'=>$canShowConditionalPage
					],
					[
						'name'=>__('FF&E Cost'),
						'link'=>route('admin.view.financial.plan.ffe.cost', [$companyId, $financialPlanId]),
						'show'=>$canShowConditionalPage,
						'sub_items'=>$ffeCosts
					]
				]
			],
			[
				'name'=>__('Expenses'),
				'link'=>'#',
				'show'=>$canShowConditionalPage ,
				'sub_items'=>[
					[
						'name'=>__('Manufacturing Expenses'),
						'link'=>route('admin.view.financial.plans.manpower.expenses', [$companyId, $financialPlanId,'expenseType'=>'ManufacturingExpenses']),
						'show'=>$financialPlan->hasManufacturingRevenueStream() && $canShowConditionalPage
					],
					[
						'name'=>__('Manpower Operational Expenses'),
						'link'=>route('admin.view.financial.plans.manpower.expenses', [$companyId, $financialPlanId,'expenseType'=>'OperationalExpenses']),
						'show'=>!$financialPlan->hasManufacturingRevenueStream() && $canShowConditionalPage
					],
					[
						'name'=>__('Manpower Sales Expenses'),
						'link'=>route('admin.view.financial.plans.manpower.expenses', [$companyId, $financialPlanId,'expenseType'=>'SalesExpenses']),
						'show'=>$canShowConditionalPage
					],
					[
						'name'=>__('Manpower Market Expenses'),
						'link'=>route('admin.view.financial.plans.manpower.expenses', [$companyId, $financialPlanId,'expenseType'=>'MarketExpense']),
						'show'=>$canShowConditionalPage
					],
					[
						'name'=>__('Manpower General Expenses'),
						'link'=>route('admin.view.financial.plans.manpower.expenses', [$companyId, $financialPlanId,'expenseType'=>'GeneralExpenses']),
						'show'=>$canShowConditionalPage
					],
					
				]
			],
			
			[
				'name'=>__('Manpower Expenses'),
				'link'=>'#',
				'show'=>$canShowConditionalPage ,
				'sub_items'=>[
					[
						'name'=>__('Manpower Manufacturing Expenses'),
						'link'=>route('admin.create.expense', [$companyId, $financialPlanId,'expenseType'=>'ManufacturingExpenses']),
						'show'=>$financialPlan->hasManufacturingRevenueStream() && $canShowConditionalPage 
					],
					[
						'name'=>__('Operational Expenses'),
						'link'=>route('admin.create.expense', [$companyId, $financialPlanId,'expenseType'=>'OperationalExpenses']),
						'show'=>!$financialPlan->hasManufacturingRevenueStream()&&$canShowConditionalPage
					],
					[
						'name'=>__('Sales Expenses'),
						'link'=>route('admin.create.expense', [$companyId, $financialPlanId,'expenseType'=>'SalesExpense']),
						'show'=>$canShowConditionalPage
					],
					[
						'name'=>__('Marketing Expenses'),
						'link'=>route('admin.create.expense', [$companyId, $financialPlanId,'expenseType'=>'MarketExpenses']),
						'show'=>$canShowConditionalPage
					],
					[
						'name'=>__('General Expenses'),
						'link'=>route('admin.create.expense', [$companyId, $financialPlanId,'expenseType'=>'GeneralExpenses']),
						'show'=>$canShowConditionalPage
					],
					
				]
			],

			
			// 'statement-reports' => [
			// 	'name' => __('Statement Reports'),
			// 	'link' => '#',
			// 	'show'=>$canShowConditionalPage&&true,

			// 	'sub_items' => [

			// 		[
			// 			'name' => __('Collection Report'),
			// 			'link' => '#',
			// 			'show'=>$canShowConditionalPage&&true,
			// 			'sub_items'=>[
			// 				[
			// 					'name'=>__('Room Collection Report'),
			// 					'link'=>route('admin.view.financial.plan.receivable.statement', [$companyId, $financialPlanId, 'rooms']),
			// 					'show'=>$canShowConditionalPage&& true,

			// 				],
			// 				[
			// 					'name'=>__('Food Collection Report'),
			// 					'link'=>route('admin.view.financial.plan.receivable.statement', [$companyId, $financialPlanId, 'foods']),
			// 					'show'=>$canShowConditionalPage&& true
			// 				],
			// 				[
			// 					'name'=>__('Gaming Collection Report'),
			// 					'link'=>route('admin.view.financial.plan.receivable.statement', [$companyId, $financialPlanId, 'gaming']),
			// 					'show'=>$canShowConditionalPage&& $financialPlan->hasCasinoSection()
			// 				],
			// 				[
			// 					'name'=>__('Meeting Spaces Collection Report'),
			// 					'link'=>route('admin.view.financial.plan.receivable.statement', [$companyId, $financialPlanId, 'meetings']),
			// 					'show'=>$canShowConditionalPage&& $financialPlan->hasMeetingSection()
			// 				],
			// 				[
			// 					'name'=>__('Other Revenue Collection Report'),
			// 					'link'=>route('admin.view.financial.plan.receivable.statement', [$companyId, $financialPlanId, 'others']),
			// 					'show'=>$canShowConditionalPage&& $financialPlan->hasOtherSection()
			// 				],
			// 				[
			// 					'name'=>__('Total Revenues Collection Report'),
			// 					'link'=>route('admin.view.financial.plan.receivable.statement', [$companyId, $financialPlanId, 'total']),
			// 					'show'=>$canShowConditionalPage&& true
			// 				]

			// 			]
			// 		],
			// 		[
			// 			'name' => __('Disposable Inventory Statement'),
			// 			'link' => '#',
			// 			'show'=>$canShowConditionalPage&&true,
			// 			'sub_items'=>[
			// 				[
			// 					'name'=>__('Room Disposable Inventory Report'),
			// 					'link'=>route('admin.view.financial.plan.inventory.statement', [$companyId, $financialPlanId, 'rooms']),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
			// 				[
			// 					'name'=>__('Food Disposable Inventory Report'),
			// 					'link'=>route('admin.view.financial.plan.inventory.statement', [$companyId, $financialPlanId, 'foods']),
			// 					'show'=>$canShowConditionalPage&&true
			// 				],
			// 				[
			// 					'name'=>__('Gaming Disposable Inventory Report'),
			// 					'link'=>route('admin.view.financial.plan.inventory.statement', [$companyId, $financialPlanId, 'gaming']),
			// 					'show'=>$canShowConditionalPage&&$financialPlan->hasCasinoSection()
			// 				],	[
			// 					'name'=>__('Total Disposables Inventory Report'),
			// 					'link'=>route('admin.view.financial.plan.inventory.statement', [$companyId, $financialPlanId, 'total']),
			// 					'show'=>$canShowConditionalPage&&true
			// 				],

			// 			]

			// 		],

			// 		[
			// 			'name' => __('Disposable Payment Statement'),
			// 			'link' => '#',
			// 			'show'=>$canShowConditionalPage&&true,
			// 			'sub_items'=>[
			// 				[
			// 					'name'=>__('Room Disposable Payment Statement Report'),
			// 					'link'=>route('admin.view.financial.plan.disposable.payment.statement', [$companyId, $financialPlanId, 'rooms']),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
			// 				[
			// 					'name'=>__('Food Disposable Payment Statement Report'),
			// 					'link'=>route('admin.view.financial.plan.disposable.payment.statement', [$companyId, $financialPlanId, 'foods']),
			// 					'show'=>$canShowConditionalPage&&true
			// 				],
			// 				[
			// 					'name'=>__('Gaming Disposable Payment Statement Report'),
			// 					'link'=>route('admin.view.financial.plan.disposable.payment.statement', [$companyId, $financialPlanId, 'gaming']),
			// 					'show'=>$canShowConditionalPage&&$financialPlan->hasCasinoSection()
			// 				],	[
			// 					'name'=>__('Total Disposables Payment Statement Report'),
			// 					'link'=>route('admin.view.financial.plan.disposable.payment.statement', [$companyId, $financialPlanId, 'total']),
			// 					'show'=>$canShowConditionalPage&&true
			// 				],

			// 			]

			// 		],

			// 		[
			// 			'name' => __('Fixed Expenses Payment Reports'),
			// 			'link' => '#',
			// 			'show'=>$canShowConditionalPage&&true,
			// 			'sub_items'=>[
			// 				[
			// 					'name'=>__('General Fixed Expenses Payment Report'),
			// 					'link'=>route('admin.view.financial.plan.prepaid-expense.general.expense.statement', [$companyId, $financialPlanId]),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
			// 				[
			// 					'name'=>__('Sales & Marketing Fixed Expenses Payment Report'),
			// 					'link'=>route('admin.view.financial.plan.prepaid-expense.marketing.expense.statement', [$companyId, $financialPlanId]),
			// 					'show'=>$canShowConditionalPage&&true,
			// 				],
			// 				[
			// 					'name'=>__('Property Fixed Expenses Payment Report'),
			// 					'link'=>route('admin.view.financial.plan.prepaid-expense.property.statement', [$companyId, $financialPlanId]),
			// 					'show'=>$canShowConditionalPage&&true,
			// 				], [
			// 					'name'=>__('Energy Fixed Expenses Payment Report'),
			// 					'link'=>route('admin.view.financial.plan.prepaid-expense.energy.statement', [$companyId, $financialPlanId]),
			// 					'show'=>$canShowConditionalPage&&true,
			// 				],
			// 				[
			// 					'name'=>__('Total Fixed Expenses Payment Report'),
			// 					'link'=>route('admin.view.financial.plan.total.fixed.expenses.statement', [$companyId, $financialPlanId]),
			// 					'show'=>$canShowConditionalPage&&true,
			// 				],


			// 			]

			// 		],
					
			// 		[
			// 			'name' => __('Management Fees'),
			// 			'link' => route('admin.view.financial.plan.management.fees.statement', [$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,
			// 			// 'sub_items'=>[
			// 			// 	[
			// 			// 		'name'=>__('General Fixed Expenses Payment Report'),
			// 			// 		'link'=>route('admin.view.financial.plan.prepaid-expense.general.expense.statement', [$companyId, $financialPlanId]),
			// 			// 		'show'=>true,

			// 			// 	],


			// 			// ]

			// 			],
						
			// 			[
			// 				'name' => __('Property Taxes Statement'),
			// 				'link' => route('admin.view.financial.plan.property.taxes.payment.statement', [$companyId, $financialPlanId]),
			// 				'show'=>$canShowConditionalPage&&true,
	
			// 				],[
			// 				'name' => __('Property Insurance Statement'),
			// 				'link' => route('admin.view.financial.plan.property.insurance.payment.statement', [$companyId, $financialPlanId]),
			// 				'show'=>$canShowConditionalPage&&true,
	
			// 				],
			// 		[
			// 			'name' => __('Corporate Taxes Statement'),
			// 			'link' => route('admin.view.financial.plan.corporate.taxes.statement', [$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,
			// 			// 'sub_items'=>[
			// 			// 	[
			// 			// 		'name'=>__('General Fixed Expenses Payment Report'),
			// 			// 		'link'=>route('admin.view.financial.plan.prepaid-expense.general.expense.statement', [$companyId, $financialPlanId]),
			// 			// 		'show'=>true,

			// 			// 	],


			// 			// ]

			// 		],
			// 		[
			// 			'name' => __('Fixed Assets Statement'),
			// 			'link' => route('admin.view.financial.plan.fixed.assets.statement', [$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,
			// 		],
					
			// 		[
			// 			'name' => __('Loan Schedule'),
			// 			'link' => '#',
			// 			'show'=>$canShowConditionalPage&&true,
			// 			'sub_items'=>[
			// 				[
			// 					'name'=>__('Property Loan Schedule'),
			// 					'link'=>route('admin.view.financial.plan.loan.schedule.report', [$companyId, $financialPlanId,'property']),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
			// 				[
			// 					'name'=>__('Land Loan Schedule'),
			// 					'link'=>route('admin.view.financial.plan.loan.schedule.report', [$companyId, $financialPlanId,'land']),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
			// 				[
			// 					'name'=>__('Hard Construction Loan Schedule'),
			// 					'link'=>route('admin.view.financial.plan.loan.schedule.report', [$companyId, $financialPlanId,'hard-construction']),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
			// 				[
			// 					'name'=>__('FFE Loan Schedule'),
			// 					'link'=>route('admin.view.financial.plan.loan.schedule.report', [$companyId, $financialPlanId,'ffe']),
			// 					'show'=>$canShowConditionalPage&&true,

			// 				],
							
							


			// 			]

			// 		],
					
					
			// 	],


			// ],
			// 'financial-statement' => [
			// 	'name' => __('Financial Statement'),
			// 	'link' => '#',
			// 	'show'=>$canShowConditionalPage&&true,
			// 	'sub_items'=>[
			// 		[
			// 			'name'=>__('Income Statement'),
			// 			'link'=>route('admin.view.financial.plan.income.statement', [$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,

			// 		], [
			// 			'name'=>__('Cash In Out Flow'),
			// 			'link'=>route('admin.view.financial.plan.cash.in.out.report', [$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,
			// 		], [
			// 			'name'=>__('Balance Sheet'),
			// 			'link'=>route('admin.view.financial.plan.balance.sheet.report',[$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,
			// 		],
			// 		[
			// 			'name'=>__('Ratio Analysis Report'),
			// 			'link'=>route('admin.view.financial.plan.ratio.analysis.report',[$companyId, $financialPlanId]),
			// 			'show'=>$canShowConditionalPage&&true,
			// 		]
			// 	]
			// ],
			// 'study-dashboard' => [
			// 	'name' => __('Study Dashboard'),
			// 	'link' => route('admin.view.financial.plan.study.dashboard', [$companyId, $financialPlanId]),
			// 	'show'=>$canShowConditionalPage&&true,
			// ],
		];
	}

	public static function getRedirectUrlName(FinancialPlan $financialPlan, string $currentModelName):string
	{
		// $currentModelName = Str::singular($currentModelName);
		$canShowConditionalPage = !in_array(Auth()->user()->email , excludeUsers());
		$redirectUrls = [
			'financialPlan'=>[
				'route'=>'#',
				'isChecked'=>true 
			],
			'ProductionCapacity'=>[
				'route'=>'admin.view.financial.plan.production.capacity',
				'isChecked'=>true 
			],
			//sssssssssssssssssssssss
			'ManpowerManufacturingExpenses'=>[
				'route'=>'admin.view.financial.plans.manpower.expenses',
				'isChecked'=>$financialPlan->hasManufacturingRevenueStream() 
			],
			'ManufacturingExpenses'=>[
				'route'=>'admin.create.expense',
				'isChecked'=>$financialPlan->hasManufacturingRevenueStream()
			],
			'ManpowerOperationalExpenses'=>[
				'route'=>'admin.view.financial.plans.manpower.expenses',
				'isChecked'=>!$financialPlan->hasManufacturingRevenueStream() 
			],
			'OperationalExpenses'=>[
				'route'=>'admin.create.expense',
				'isChecked'=>!$financialPlan->hasManufacturingRevenueStream()
			],
			'ManpowerSalesExpenses'=>[
				'route'=>'admin.view.financial.plans.manpower.expenses',
				'isChecked'=>true 
			],
			'SalesExpenses'=>[
				'route'=>'admin.create.expense',
				'isChecked'=>true
			],
			'ManpowerMarketExpense'=>[
				'route'=>'admin.view.financial.plans.manpower.expenses',
				'isChecked'=>true 
			],
			'MarketExpense'=>[
				'route'=>'admin.create.expense',
				'isChecked'=>true
			],
			'ManpowerGeneralExpense'=>[
				'route'=>'admin.view.financial.plans.manpower.expenses',
				'isChecked'=>true 
			],
			'GeneralExpense'=>[
				'route'=>'admin.create.expense',
				'isChecked'=>true
			],
			
			'landAcquisitionCost'=>[
				'route'=>'admin.view.financial.plan.land.acquisition.costs',
				'isChecked'=>$canShowConditionalPage&&true
			],
			'propertyAcquisitionCost'=>[
				'route'=>'admin.view.financial.plan.property.acquisition.costs',
				'isChecked'=>$canShowConditionalPage&&true
			],
			'ffeCost'=>[
				'route'=>'admin.view.financial.plan.ffe.cost',
				'isChecked'=>true
			],
			

		];
		$redirectUrl = null;
		while (!$redirectUrl) {
			$nextModelName = getNextDate($redirectUrls, $currentModelName);
			if (!$nextModelName) {
				$redirectUrl = 'admin.view.financial.plans';

				break;
			}
			if ($redirectUrls[$nextModelName]['isChecked']) {
				$redirectUrl = $redirectUrls[$nextModelName]['route'];
			} else {
				$currentModelName = $nextModelName;
			}
		}
		// dd($redirectUrl);
		return $redirectUrl;
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
	
	public function viewManpowerExpenses(Request $request,$companyId, $financialPlanId,$expenseType)
	{
		
		$financialPlan = FinancialPlan::find($financialPlanId);
		$cacheKeyForManpowerCount = 'manpower_expenses_count_for_company_'.$companyId.'for_financial_plan'.$financialPlanId.'for_expense_type'.$expenseType;
		$cacheKeyForManpowerRecruitDate = 'manpower_expenses_recruit_date_for_company_'.$companyId.'for_financial_plan'.$financialPlanId.'for_expense_type'.$expenseType;
		$recruitDate =Cache::get($cacheKeyForManpowerRecruitDate,null)  ;
		$noExpenses =  Cache::get($cacheKeyForManpowerCount,0) ;
		
		$datesIndexWithYearIndex = App('datesIndexWithYearIndex');
		$yearIndexWithYear =App('yearIndexWithYear');
		$dateIndexWithDate =App('dateIndexWithDate');
		$dateWithMonthNumber=App('dateWithMonthNumber');
		$datesAsStringAndIndex = $financialPlan->getDatesAsStringAndIndex();
		
		$operationDurationPerYear = $recruitDate ? $financialPlan->getOperationDurationPerYear($recruitDate,$datesAsStringAndIndex,$datesIndexWithYearIndex,$yearIndexWithYear,$dateIndexWithDate,$dateWithMonthNumber):[];
		
		return view('admin.financial_plans.general-expenses', array_merge([
			'storeRoute' => route('admin.store.financial.plans.manpower.expenses', [
				'financial_plan_id' => $financialPlanId,
				'company' => $companyId,
				'expenseType'=>$expenseType
			]),
			'type' => 'create',
			'model' => $financialPlan,
			'expenseType'=>$expenseType,
			'recruitDate'=>$recruitDate,
			'dates'=>$financialPlan->getOnlyDatesOfActiveOperation($operationDurationPerYear,$dateIndexWithDate),
			'financial_plan_id' => $financialPlanId,
			'noManpowerExpenses'=>$noExpenses,
			'studyCurrency' => $financialPlan->getCurrenciesForSelect(),
			'daysDifference' => $recruitDate ? $financialPlan->getDiffBetweenOperationStartDateAndStudyStartDate($recruitDate) : null ,
			'navigators' => array_merge($this->getCommonNavigators($companyId, $financialPlanId), []),
			'products'=>$financialPlan->manufacturingProducts
		], []));
	}
	public function storeManpowerExpenses(Request $request, Company $company, $financialPlanId,$expenseType)
	{

		$companyId = $company->id;
		$financialPlan = FinancialPlan::find($financialPlanId);
		$cacheKeyForManpowerCount = 'manpower_expenses_count_for_company_'.$companyId.'for_financial_plan'.$financialPlanId.'for_expense_type'.$expenseType;
		$cacheKeyForManpowerRecruitDate = 'manpower_expenses_recruit_date_for_company_'.$companyId.'for_financial_plan'.$financialPlanId.'for_expense_type'.$expenseType;
		$recruitDate =$request->has('recruit_date') ? $request->get('recruit_date',null) :Cache::get($cacheKeyForManpowerCount,null)  ;
		$noExpenses = $request->has('no_expenses') ? $request->get('no_expenses') : Cache::get($cacheKeyForManpowerRecruitDate,0) ;
		 cacheManpowerExpenseCount($cacheKeyForManpowerCount,$noExpenses); ;
		 cacheManpowerExpenseRecruitDate($cacheKeyForManpowerRecruitDate , $recruitDate); ;
		$modelName = $request->input('model_name');
		foreach ((array)$request->get('name') as $currentSectionName => $sectionItemsNames) {
			foreach ($sectionItemsNames as $index => $newName) {
				$oldName = $request->input('old_name.' . $currentSectionName . '.' . $index);

				$data = $this->getCommonStoreData($request, $currentSectionName, $index, $newName, $modelName, $companyId, $financialPlanId);
				if ($newName && !$oldName) {
					$financialPlan->departmentExpenses()->create($data);
				}
				if ($newName && $oldName) {
					$currentDepartmentExpense = $financialPlan->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($currentDepartmentExpense) {
						$currentDepartmentExpense->update($data);
					}
				}
				if ($oldName && !$newName) {
					$expense = $financialPlan->departmentExpensesFor($currentSectionName, $modelName)->get()[$index];
					if ($expense) {
						$expense->delete();
					}
				}
			}
		}
		if($expenseType =='ManufacturingExpenses'){
			$financialPlan->update([
				'manufacturing_products_allocations_type'=>$request->get('manufacturing_products_allocations_type')
			]);
			// foreach
			$financialPlan->manufacturingProductsAllocations()->detach();
			foreach($request->get('manufacturing_allocations',[]) as $productId=>$percentage){
				$financialPlan->manufacturingProductsAllocations()->attach($productId,[
					'percentage'=>$percentage
				]);
			}
			
		}
		$message = $expenseType. __(' has been saved successfully');
		if ($request->get('redirect-to-same-page')) {
			$redirectUrl = route('admin.view.financial.plans.manpower.expenses', [$companyId, $financialPlanId,$expenseType]);
			$message = __('Please Wait');
		} else {
			$redirectUrl = route($this->getRedirectUrlName($financialPlan, 'Manpower'.$expenseType), [$companyId, $financialPlanId,$expenseType]);
		}
		return response()->json([
			'status' => true,
			'message' => $message,
			'redirectTo' => $redirectUrl
		]);
	}	
	
	protected function storePropertyAcquisitionBreakDown(FinancialPlan $financialPlan, Request $request)
	{
		$financialPlan->propertyAcquisitionBreakDown()->delete();

		foreach ($request->get('name') as $currentSectionName=>$names) {
			foreach ($names as $currentIndex=>$name) {
				$currentPercentage = $request->input('property_cost_percentage.' . $currentSectionName . '.' . $currentIndex);
				$currentItemValue = $request->input('item_amount.' . $currentSectionName . '.' . $currentIndex);
				$depreciationDuration = $request->input('depreciation_duration.' . $currentSectionName . '.' . $currentIndex);
				$financialPlan->propertyAcquisitionBreakDown()->create([
					'property_cost_percentage'=>$currentPercentage,
					'item_amount'=>$currentItemValue,
					'depreciation_duration'=>$depreciationDuration,
					'company_id'=>$request->get('company_id'),
					'name'=>$name,
					'section_name'=>$currentSectionName,
					'financial_plan_id'=>$financialPlan->id,
					'model_name'=>$request->get('model_name')
				]);
			}
		}
	}
	
}
