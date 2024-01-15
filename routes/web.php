<?php

use App\Http\Controllers\BusinessSectorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeleteAllRowsFromCaching;
use App\Http\Controllers\DeleteMultiRowsFromCaching;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FBController;
use App\Http\Controllers\FinancialPlanController;
use App\Http\Controllers\getUploadPercentage;
use App\Http\Controllers\getUploadPercentageForUploadExcel;
use App\Http\Controllers\getUploadPercentageForUploadSupplierInvoice;
use App\Http\Controllers\Helpers\DeleteSingleRecordController;
use App\Http\Controllers\Helpers\EditTableCellsController;
use App\Http\Controllers\Helpers\getEditFormController;
use App\Http\Controllers\Helpers\UpdateBasedOnGlobalController;
use App\Http\Controllers\Helpers\UpdateCitiesBasedOnCountryController;
use App\Http\Controllers\HospitalitySectorController;
use App\Http\Controllers\IncomeStatementController;
use App\Http\Controllers\MarketExpenseController;
use App\Http\Controllers\QuickPricingCalculatorController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationPricingCalculatorController;
use App\Http\Controllers\RemoveCompanycontroller;
use App\Http\Controllers\RemoveUsercontroller;
use App\Http\Controllers\RevenueBusinessLineController;
use App\Http\Controllers\ViewShareableLinkController;
use App\Http\Livewire\AdjustedCollectionDatesForm;
use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::middleware([])->group(function () {


	Route::any('FreeUserSubscription', 'UserController@freeSubscription')->name('free.user.subscription');
	Auth::routes();
	Route::group(
		[
			'prefix' => LaravelLocalization::setLocale(),
			'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
		],
		function () {


			//
			Route::get(SHAREABLE_LINKS . '/{shareableModel}/{uniqueString}', [ViewShareableLinkController::class, '__invoke'])->name('generate.shareable.link')->withoutMiddleware(['auth']);
			// Route::post('get-net-sales-for-type/'  , [SalesBreakdownAgainstAnalysisReport::class , 'getNetSalesValueSum'])->name('get.net.sales.modal.for.type');
			// Route::post('getTopAndBottomsForDashboard' , [SalesBreakdownAgainstAnalysisReport::class , 'topAndBottomsForDashboard'])->name('getTopAndBottomsForDashboard');
			Route::post('remove-user', [RemoveUsercontroller::class, '__invoke'])->name('remove.user');
			Route::post('remove-company', [RemoveCompanycontroller::class, '__invoke'])->name('remove.company');
			Route::get('/client', function () {
				return view('client_view.supplier_invoices.form');
			});

			Route::resource('section', 'SectionController');
			Route::resource('companySection', 'CompanyController');
			Route::resource('user', 'UserController');
			// Route::resource('deduction', 'DeductionController');
			Route::resource('toolTipData', 'ToolTipDataController');



			// Route::resource('Roles&Permissions', 'RolesAndPermissionsController');
			Route::group(['prefix' => 'RolesPermissions/{scope}/', 'as' => 'roles.permissions.'], function () {
				Route::get('/index', 'RolesAndPermissionsController@index')->name('index');
				Route::get('/create', 'RolesAndPermissionsController@create')->name('create');
				Route::post('/store', 'RolesAndPermissionsController@store')->name('store');
				Route::get('/edit/{role}', 'RolesAndPermissionsController@edit')->name('edit');
				Route::post('/update/{role}', 'RolesAndPermissionsController@update')->name('update');
			});
			Route::get('toolTipSectionsFields/{id}', 'ToolTipDataController@sectionFields')->name('section.fields');


			############ Client View ############
			Route::get('/', 'HomeController@index')->name('home');

			Route::delete('delete-model', [DeleteSingleRecordController::class, '__invoke'])->name('delete.model');
			Route::prefix('{company}')->group(function () {


				// customers and leads 

				Route::post('customers/store', [CustomerController::class, 'store'])->name('admin.store.customers');
				Route::post('business-sectors/store', [BusinessSectorController::class, 'store'])->name('admin.store.business.sector');

				############ Import Routs ############
				// Route::any('inventoryStatementImport', 'InventoryStatementTestController@import')->name('inventoryStatementImport');
				// Route::get('inventoryStatement/insertToMainTable', 'InventoryStatementTestController@insertToMainTable')->name('inventoryStatementTest.insertToMainTable');
				Route::any('salesGatheringImport', 'SalesGatheringTestController@import')->name('salesGatheringImport');
				Route::any('uploadExcelImport', 'UploadExcelsTestController@import')->name('uploadExcelImport');
				Route::any('uploadSupplierInvoiceImport', 'UploadSuppliersInvoicesTestController@import')->name('uploadSupplierInvoiceImport');
				Route::get('SalesGathering/insertToMainTable', 'SalesGatheringTestController@insertToMainTable')->name('salesGatheringTest.insertToMainTable');
				Route::get('UploadExcel/insertToMainTable', 'UploadExcelsTestController@insertToMainTable')->name('uploadExcelTest.insertToMainTable');
				Route::get('UploadSupplierInvoice/insertToMainTable', 'UploadSuppliersInvoicesTestController@insertToMainTable')->name('uploadSupplierInvoiceTest.insertToMainTable');
				Route::post('toggleSharingLinkStatus', 'SharingLinkController@toggleSharingLinkStatus')->name('admin.toggle.sharing.links');
				
				
				Route::resource('sharing-links', 'SharingLinkController');
				Route::get('shareable-paginate', 'SharingLinkController@paginate')->name('admin.get.sharing.links');
				Route::get('export-shareable-link', 'SharingLinkController@export')->name('admin.export.sharing.link');

				
				Route::post('edit-table-cell', [EditTableCellsController::class, '__invoke'])->name('admin.edit.table.cell');
				Route::delete('delete-revenue-business-line/{revenueBusinessLine}', [RevenueBusinessLineController::class, 'deleteRevenueBusinessLine'])->name('admin.delete.revenue.business.line');
				Route::delete('delete-service-category/{serviceCategory}', [RevenueBusinessLineController::class, 'deleteServiceCategory'])->name('admin.delete.service.category');
				Route::delete('delete-service-item/{serviceItem}', [RevenueBusinessLineController::class, 'deleteServiceItem'])->name('admin.delete.service.item');

				//helpers
				Route::get('get-edit-form', [getEditFormController::class, '__invoke']);
				Route::get('helpers/updateCitiesBasedOnCountry', [UpdateCitiesBasedOnCountryController::class, '__invoke']);
				Route::get('helpers/updateBasedOnGlobalController', [UpdateBasedOnGlobalController::class, '__invoke']);
				//Quick pricing calculator
				Route::get('quick-pricing-calculator', [QuickPricingCalculatorController::class, 'view'])->name('admin.view.quick.pricing.calculator');

				Route::get('quick-pricing-calculator/create/{pricingPlanId?}', [QuickPricingCalculatorController::class, 'create'])->name('admin.create.quick.pricing.calculator');
				Route::get('quick-pricing-calculator/{quickPricingCalculator}/edit', [QuickPricingCalculatorController::class, 'edit'])->name('admin.edit.quick.pricing.calculator');
				Route::post('quick-pricing-calculator/{quickPricingCalculator}/update', [QuickPricingCalculatorController::class, 'update'])->name('admin.update.quick.pricing.calculator');
				Route::post('quick-pricing-calculator/store', [QuickPricingCalculatorController::class, 'store'])->name('admin.store.quick.pricing.calculator');
				Route::get('export-quick-pricing-calculator', 'QuickPricingCalculatorController@export')->name('admin.export.quick.pricing.calculator');
				Route::get('get-quick-pricing-calculator', 'QuickPricingCalculatorController@paginate')->name('admin.get.quick.pricing.calculator');
				Route::delete('delete-quick-pricing-calculator/{quickPricingCalculator}', 'QuickPricingCalculatorController@destroy')->name('admin.delete.quick.pricing.calculator');


				//Quotation pricing calculator
				Route::get('quotation-pricing-calculator', [QuotationPricingCalculatorController::class, 'view'])->name('admin.view.quotation.pricing.calculator');
				Route::get('quotation-pricing-calculator/create', [QuotationPricingCalculatorController::class, 'create'])->name('admin.create.quotation.pricing.calculator');
				Route::get('quotation-pricing-calculator/{quotationPricingCalculator}/edit', [QuotationPricingCalculatorController::class, 'edit'])->name('admin.edit.quotation.pricing.calculator');
				Route::post('quotation-pricing-calculator/{quotationPricingCalculator}/update', [QuotationPricingCalculatorController::class, 'update'])->name('admin.update.quotation.pricing.calculator');
				Route::post('quotation-pricing-calculator/store', [QuotationPricingCalculatorController::class, 'store'])->name('admin.store.quotation.pricing.calculator');
				Route::get('export-quotation-pricing-calculator', 'QuotationPricingCalculatorController@export')->name('admin.export.quotation.pricing.calculator');
				Route::get('get-quotation-pricing-calculator', 'QuotationPricingCalculatorController@paginate')->name('admin.get.quotation.pricing.calculator');


				
			
				
				//Revenue Business Line 
				Route::get('get-revenue-business-line', 'RevenueBusinessLineController@paginate')->name('admin.get.revenue-business-line');
				Route::get('get-revenue-business-line/create', 'RevenueBusinessLineController@create')->name('admin.create.revenue-business-line');
				Route::post('get-revenue-business-line/create', 'RevenueBusinessLineController@store')->name('admin.store.revenue-business-line');
				Route::get('export-revenue-business-line', 'RevenueBusinessLineController@export')->name('admin.export.revenue-business-line');
				Route::resource('revenue-business', 'RevenueBusinessLineController')->names([
					'index' => 'admin.view.revenue.business.line',
				]);
				Route::get('revenue-business-edit/{revenueBusinessLine}/{serviceCategory?}/{serviceItem?}','RevenueBusinessLineController@editForm')->name('admin.edit.revenue');
				Route::post('admin.update.revenue-business','RevenueBusinessLineController@updateForm')->name('admin.update.revenue');
				

				//Income Statement
				Route::get('income-statement', [IncomeStatementController::class, 'view'])->name('admin.view.income.statement');

				Route::get('income-statement/create', [IncomeStatementController::class, 'create'])->name('admin.create.income.statement');
				Route::get('income-statement-report/{incomeStatement}/edit', [IncomeStatementController::class, 'editItems']);
				// Route::get('income-statement/{incomeStatement}/edit',[IncomeStatementController::class , 'edit'])->name('admin.edit.income.statement');
				Route::post('income-statement/{incomeStatement}/update', [IncomeStatementController::class, 'update'])->name('admin.update.income.statement');
				Route::post('income-statement/store', [IncomeStatementController::class, 'store'])->name('admin.store.income.statement');
				Route::get('export-income-statement', 'IncomeStatementController@export')->name('admin.export.income.statement');
				Route::get('get-income-statement', 'IncomeStatementController@paginate')->name('admin.get.income.statement');


				//Income Statement Report
				// Route::get('income-statement-report',[IncomeStatementReportController::class , 'view'])->name('admin.view.income.statement.report');

				Route::get('income-statement/{incomeStatement}/report', [IncomeStatementController::class, 'createReport'])->name('admin.create.income.statement.report');
				// Route::get('income-statement-report/{incomeStatementReport}/edit',[IncomeStatementReportController::class , 'edit'])->name('admin.edit.income.statement.report');
				// Route::post('income-statement-report/{incomeStatementReport}/update',[IncomeStatementReportController::class , 'update'])->name('admin.update.income.statement.report');
				Route::post('income-statement/storeReport', [IncomeStatementController::class, 'storeReport'])->name('admin.store.income.statement.report');
				Route::get('export-income-statement-report', 'IncomeStatementController@exportReport')->name('admin.export.income.statement.report');
				Route::post('get-income-statement-report/{incomeStatement}', 'IncomeStatementController@paginateReport')->name('admin.get.income.statement.report');




				// Revenue Business Line

				Route::resource('/loan2', 'Loans2Controller')->names([
					'index' => 'loans2.index',
					'create' => 'loan2.create',
					'store' => 'loan2.store',
					'show' => 'loan2.show',
					'edit' => 'loan2.edit',
					'update' => 'loan2.update',
					'destroy' => 'loan2.destroy',
				])->except('create');
				Route::post('loan-by-php','Loans2Controller@calculateByPhp')->name('loan2.store.php');
				
				

				
				
				
				Route::resource('revenueStream', 'revenueStreamController');
				
				
					// add new modal dynamic
				Route::post('store-new', [HospitalitySectorController::class, 'storeNewModal'])->name('admin.store.new.modal');
				Route::delete('delete-multi-rows', [HospitalitySectorController::class, 'deleteMulti'])->name('delete.multi');
				// start hospitality sector
				
				
				// zaveroplanner [Feasibility &Multi-years Financial Plan Form ]
				Route::get('financial-plans', [FinancialPlanController::class, 'view'])->name('admin.view.financial.plans');
				Route::get('get-financial-plans', 'FinancialPlanController@paginate')->name('admin.get.financial.plans');
				Route::get('financial-plans/create', [FinancialPlanController::class, 'create'])->name('admin.create.financial.plan');
				Route::get('export-financial-plans', [FinancialPlanController::class, 'export'])->name('admin.export.financial.plan');
				Route::get('financial-plans/{financialPlan}/edit', [FinancialPlanController::class, 'edit'])->name('admin.edit.financial.plan');
				Route::post('financial-plans/store', [FinancialPlanController::class, 'store'])->name('admin.store.financial.plan');
				Route::post('financial-plans/{financialPlan}/update', [FinancialPlanController::class, 'update'])->name('admin.update.financial.plan');
				Route::get('update-financial-plans-date', [FinancialPlanController::class, 'updateDate'])->name('admin.update.financial.plans.date');
				Route::delete('update-financial-plan-duration-type', [FinancialPlanController::class, 'updateDurationType'])->name('admin.update.financial.plan.duration.type');
				Route::get('financial-plans/{financial_plan_id}/ffe-cost/create/{ffe?}', [FinancialPlanController::class, 'viewFFECost'])->name('admin.view.financial.plan.ffe.cost');
				Route::post('financial-plans/{financial_plan_id}/ffe-cost', [FinancialPlanController::class, 'storeFFECost'])->name('admin.store.financial.plan.ffe.cost');
				
				Route::get('financial-plans/{financial_plan_id}/land-acquisition-costs', [FinancialPlanController::class, 'viewLandAcquisitionCosts'])->name('admin.view.financial.plan.land.acquisition.costs');
				Route::post('financial-plans/{financial_plan_id}/land-acquisition-costs', [FinancialPlanController::class, 'storeLandAcquisitionCosts'])->name('admin.store.financial.plan.land.acquisition.costs');				

				
				Route::get('financial-plans/{financial_plan_id}/property-acquisition-costs', [FinancialPlanController::class, 'viewPropertyAcquisitionCosts'])->name('admin.view.financial.plan.property.acquisition.costs');
				Route::post('financial-plans/{financial_plan_id}/property-acquisition-costs', [FinancialPlanController::class, 'storePropertyAcquisitionCosts'])->name('admin.store.financial.plan.property.acquisition.costs');
				
				
				
				Route::get('financial-plans/{financialPlan}/expenses/create/{expenseType}', [ExpenseController::class, 'create'])->name('admin.create.expense');
				Route::post('financial-plans/{financialPlan}/expenses/create/{expenseType}', [ExpenseController::class, 'store'])->name('admin.store.expense');
				
				// Route::get('expenses/create/{expenseType}', [ExpenseController::class, 'create'])->name('admin.create.expense');
				// Route::post('expenses/create/{expenseType}', [ExpenseController::class, 'store'])->name('admin.store.expense');
				
				
				Route::resource('expenses', 'ExpensesController');
				Route::resource('positions', 'PositionsController');
				Route::resource('categories', 'CategoriesController');
				Route::resource('currencies', 'CurrenciesController');
				Route::resource('products', 'ProductsController');
				Route::resource('selling-unit-of-measurements', 'SellingUnitOfMeasurementController');
				Route::resource('production-unit-of-measurements', 'ProductionUnitOfMeasurementController');
				Route::resource('pricing-plans', 'PricingPlansController');
				Route::get('financial-plans/{financial_plan_id}/manpower-expenses/{expenseType}', [FinancialPlanController::class, 'viewManpowerExpenses'])->name('admin.view.financial.plans.manpower.expenses');
				Route::post('financial-plans/{financial_plan_id}/manpower-expenses/{expenseType}', [FinancialPlanController::class, 'storeManpowerExpenses'])->name('admin.store.financial.plans.manpower.expenses');
				Route::get('financial-plans/{financial_plan_id}/production-capacity/', [FinancialPlanController::class, 'viewProductCapacity'])->name('admin.view.financial.plan.production.capacity');
				Route::post('financial-plans/{financial_plan_id}/production-capacity/', [FinancialPlanController::class, 'storeProductionCapacity'])->name('admin.store.financial.plan.production.capacity');
				
				
				//ManufacturingExpenses  // for only manufacturing
				// SalesExpenses
				// GeneralExpense
				// OperationalExpenses // for not checked for manufacturing 
				// MarketExpense
			
				
				
				
				
				
				// end zaveo
				// start hospitality sector
				Route::get('hospitality-sector/create', [HospitalitySectorController::class, 'create'])->name('admin.create.hospitality.sector');
				Route::get('update-hospitality-sector-date', [HospitalitySectorController::class, 'updateDate'])->name('admin.update.hospitality.sector.date');
				Route::delete('update-hospitality-sector-duration-type', [HospitalitySectorController::class, 'updateDurationType'])->name('admin.update.hospitality.sector.duration.type');
				Route::get('hospitality-sector', [HospitalitySectorController::class, 'view'])->name('admin.view.hospitality.sector');
				Route::get('hospitality-sector/{hospitalitySector}/edit', [HospitalitySectorController::class, 'edit'])->name('admin.edit.hospitality.sector');
				Route::post('hospitality-sector/{hospitalitySector}/update', [HospitalitySectorController::class, 'update'])->name('admin.update.hospitality.sector');
				Route::post('hospitality-sector/store', [HospitalitySectorController::class, 'store'])->name('admin.store.hospitality.sector');
				Route::get('export-hospitality-sector', 'HospitalitySectorController@export')->name('admin.export.hospitality.sector');

				Route::get('get-hospitality-sector', 'HospitalitySectorController@paginate')->name('admin.get.hospitality.sector');
				Route::get('hospitality-sector/{hospitality_sector_id}/rooms', [HospitalitySectorController::class, 'viewRooms'])->name('admin.view.hospitality.sector.sales.channels');
				Route::post('hospitality-sector/{hospitality_sector_id}/rooms', [HospitalitySectorController::class, 'storeRooms'])->name('admin.store.hospitality.sector.sales.channels');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/foods', [HospitalitySectorController::class, 'viewFoods'])->name('admin.view.hospitality.sector.foods');
				Route::post('hospitality-sector/{hospitality_sector_id}/foods', [HospitalitySectorController::class, 'storeFoods'])->name('admin.store.hospitality.sector.foods');
				
				
				Route::get('hospitality-sector/{hospitality_sector_id}/gamings', [HospitalitySectorController::class, 'viewCasinos'])->name('admin.view.hospitality.sector.casinos');
				Route::post('hospitality-sector/{hospitality_sector_id}/gamings', [HospitalitySectorController::class, 'storeCasinos'])->name('admin.store.hospitality.sector.casinos');

				
				
				Route::get('hospitality-sector/{hospitality_sector_id}/meetings', [HospitalitySectorController::class, 'viewMeetings'])->name('admin.view.hospitality.sector.meetings');
				Route::post('hospitality-sector/{hospitality_sector_id}/meetings', [HospitalitySectorController::class, 'storeMeetings'])->name('admin.store.hospitality.sector.meetings');

				Route::get('hospitality-sector/{hospitality_sector_id}/other-revenues', [HospitalitySectorController::class, 'viewOtherRevenues'])->name('admin.view.hospitality.sector.other.revenues');
				Route::post('hospitality-sector/{hospitality_sector_id}/other-revenues', [HospitalitySectorController::class, 'storeOtherRevenues'])->name('admin.store.hospitality.sector.other.revenues');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/rooms-direct-expenses', [HospitalitySectorController::class, 'viewRoomsDirectExpenses'])->name('admin.view.hospitality.sector.rooms.direct.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/rooms-direct-expenses', [HospitalitySectorController::class, 'storeRoomsDirectExpenses'])->name('admin.store.hospitality.sector.rooms.direct.expenses');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/foods-direct-expenses', [HospitalitySectorController::class, 'viewFoodsDirectExpenses'])->name('admin.view.hospitality.sector.foods.direct.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/foods-direct-expenses', [HospitalitySectorController::class, 'storeFoodsDirectExpenses'])->name('admin.store.hospitality.sector.foods.direct.expenses');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/'.gaming.'-direct-expenses', [HospitalitySectorController::class, 'viewCasinosDirectExpenses'])->name('admin.view.hospitality.sector.casinos.direct.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/'.gaming.'-direct-expenses', [HospitalitySectorController::class, 'storeCasinosDirectExpenses'])->name('admin.store.hospitality.sector.casinos.direct.expenses');
						
				Route::get('hospitality-sector/{hospitality_sector_id}/meetings-direct-expenses', [HospitalitySectorController::class, 'viewMeetingExpenses'])->name('admin.view.hospitality.sector.meeting.direct.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/meetings-direct-expenses', [HospitalitySectorController::class, 'storeMeetingExpenses'])->name('admin.store.hospitality.sector.meeting.direct.expenses');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/other-revenue-direct-expenses', [HospitalitySectorController::class, 'viewOtherRevenueExpenses'])->name('admin.view.hospitality.sector.other.revenue.direct.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/other-revenue-direct-expenses', [HospitalitySectorController::class, 'storeOtherRevenueExpenses'])->name('admin.store.hospitality.sector.other.revenue.direct.expenses');
				
				
				
				Route::get('hospitality-sector/{hospitality_sector_id}/general-expenses', [HospitalitySectorController::class, 'viewGeneralExpenses'])->name('admin.view.hospitality.sector.general.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/general-expenses', [HospitalitySectorController::class, 'storeGeneralExpenses'])->name('admin.store.hospitality.sector.general.expenses');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/marketing-expenses', [HospitalitySectorController::class, 'viewMarketingExpenses'])->name('admin.view.hospitality.sector.marketing.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/marketing-expenses', [HospitalitySectorController::class, 'storeMarketingExpenses'])->name('admin.store.hospitality.sector.marketing.expenses');

				Route::get('hospitality-sector/{hospitality_sector_id}/property-expenses', [HospitalitySectorController::class, 'viewPropertyExpenses'])->name('admin.view.hospitality.sector.property.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/property-expenses', [HospitalitySectorController::class, 'storePropertyExpenses'])->name('admin.store.hospitality.sector.property.expenses');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/management-fees', [HospitalitySectorController::class, 'viewManagementFees'])->name('admin.view.hospitality.sector.management.fees');
				Route::post('hospitality-sector/{hospitality_sector_id}/management-fees', [HospitalitySectorController::class, 'storeManagementFees'])->name('admin.store.hospitality.sector.management.fees');
				
				
				Route::get('hospitality-sector/{hospitality_sector_id}/start-up-cost', [HospitalitySectorController::class, 'viewStartUpCost'])->name('admin.view.hospitality.sector.start.up.cost');
				Route::post('hospitality-sector/{hospitality_sector_id}/start-up-cost', [HospitalitySectorController::class, 'storeStartUpCost'])->name('admin.store.hospitality.sector.start.up.cost');
				
				
				Route::get('hospitality-sector/{hospitality_sector_id}/energy-expenses', [HospitalitySectorController::class, 'viewEnergyExpenses'])->name('admin.view.hospitality.sector.energy.expenses');
				Route::post('hospitality-sector/{hospitality_sector_id}/energy-expenses', [HospitalitySectorController::class, 'storeEnergyExpenses'])->name('admin.store.hospitality.sector.energy.expenses');
				
					
				Route::get('hospitality-sector/{hospitality_sector_id}/income-statement', [HospitalitySectorController::class, 'viewIncomeStatementDashboard'])->name('admin.view.hospitality.sector.income.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/cash-in-out-report', [HospitalitySectorController::class, 'viewCashInOutReport'])->name('admin.view.hospitality.sector.cash.in.out.report');
				Route::get('hospitality-sector/{hospitality_sector_id}/balance-sheet-report', [HospitalitySectorController::class, 'viewBalanceSheetReport'])->name('admin.view.hospitality.sector.balance.sheet.report');
				Route::get('hospitality-sector/{hospitality_sector_id}/ratio-analysis-report', [HospitalitySectorController::class, 'viewRatioAnalysisReport'])->name('admin.view.hospitality.sector.ratio.analysis.report');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/study-dashboard', [HospitalitySectorController::class, 'viewStudyDashboard'])->name('admin.view.hospitality.sector.study.dashboard');
				Route::get('hospitality-sector/{hospitality_sector_id}/receivable-statement/{type}', [HospitalitySectorController::class, 'viewReceivableStatement'])->name('admin.view.hospitality.sector.receivable.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-assets-suppliers-statement', [HospitalitySectorController::class, 'viewFixedAssetsSuppliersStatement'])->name('admin.view.hospitality.sector.fixed.assets.suppliers.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/management-fees-statement', [HospitalitySectorController::class, 'viewManagementFeesStatement'])->name('admin.view.hospitality.sector.management.fees.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/corporate-taxes-statement', [HospitalitySectorController::class, 'viewCorporateTaxesStatement'])->name('admin.view.hospitality.sector.corporate.taxes.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/inventory-statement/{type}', [HospitalitySectorController::class, 'viewInventoryStatement'])->name('admin.view.hospitality.sector.inventory.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-assets-statement', [HospitalitySectorController::class, 'viewFixedAssetsStatement'])->name('admin.view.hospitality.sector.fixed.assets.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-expense/general-expense', [HospitalitySectorController::class, 'viewPrepaidExpenseGeneralExpenseStatement'])->name('admin.view.hospitality.sector.prepaid-expense.general.expense.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-expense/marketing-expense', [HospitalitySectorController::class, 'viewPrepaidExpenseMarketingExpenseStatement'])->name('admin.view.hospitality.sector.prepaid-expense.marketing.expense.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-expense/property-expense', [HospitalitySectorController::class, 'viewPrepaidExpensePropertyStatement'])->name('admin.view.hospitality.sector.prepaid-expense.property.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-expense/energy-expense', [HospitalitySectorController::class, 'viewPrepaidExpenseEnergyStatement'])->name('admin.view.hospitality.sector.prepaid-expense.energy.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/fixed-expense/total', [HospitalitySectorController::class, 'viewTotalFixedExpenseStatement'])->name('admin.view.hospitality.sector.total.fixed.expenses.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/disposable-payment-statement/{type}', [HospitalitySectorController::class, 'viewDisposablePaymentStatement'])->name('admin.view.hospitality.sector.disposable.payment.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/property-taxes-payment-statement', [HospitalitySectorController::class, 'viewPropertyTaxesPaymentStatement'])->name('admin.view.hospitality.sector.property.taxes.payment.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/property-insurance-payment-statement', [HospitalitySectorController::class, 'viewPropertyInsurancePaymentStatement'])->name('admin.view.hospitality.sector.property.insurance.payment.statement');
				Route::get('hospitality-sector/{hospitality_sector_id}/loan-schedule-report/{loanType}', [HospitalitySectorController::class, 'viewLoanScheduleReport'])->name('admin.view.hospitality.sector.loan.schedule.report');
				Route::get('hospitality-sector/{hospitality_sector_id}/land-acquisition-costs', [HospitalitySectorController::class, 'viewLandAcquisitionCosts'])->name('admin.view.hospitality.sector.land.acquisition.costs');
				Route::post('hospitality-sector/{hospitality_sector_id}/land-acquisition-costs', [HospitalitySectorController::class, 'storeLandAcquisitionCosts'])->name('admin.store.hospitality.sector.land.acquisition.costs');				
				Route::get('hospitality-sector/{hospitality_sector_id}/ffe-cost', [HospitalitySectorController::class, 'viewFFECost'])->name('admin.view.hospitality.sector.ffe.cost');
				Route::post('hospitality-sector/{hospitality_sector_id}/ffe-cost', [HospitalitySectorController::class, 'storeFFECost'])->name('admin.store.hospitality.sector.ffe.cost');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/property-acquisition-costs', [HospitalitySectorController::class, 'viewPropertyAcquisitionCosts'])->name('admin.view.hospitality.sector.property.acquisition.costs');
				Route::post('hospitality-sector/{hospitality_sector_id}/property-acquisition-costs', [HospitalitySectorController::class, 'storePropertyAcquisitionCosts'])->name('admin.store.hospitality.sector.property.acquisition.costs');
				
				Route::get('hospitality-sector/{hospitality_sector_id}/s-curve-chart', [HospitalitySectorController::class, 'viewSCurveChart'])->name('admin.view.hospitality.sector.s-curve-chart');
				
				
				// end hospitality sector
				
				
				
				// start hospitality sector
				Route::get('update-'.fbUrlName.'-date', [FBController::class, 'updateDate'])->name('admin.update.fb.date');
				Route::delete('update-'.fbUrlName.'-duration-type', [FBController::class, 'updateDurationType'])->name('admin.update.fb.duration.type');
				Route::get(fbUrlName.'', [FBController::class, 'view'])->name('admin.view.fb');
				Route::get(fbUrlName.'/create', [FBController::class, 'create'])->name('admin.create.fb');
				Route::get(fbUrlName.'/{hospitalitySector}/edit', [FBController::class, 'edit'])->name('admin.edit.fb');
				Route::post(fbUrlName.'/{hospitalitySector}/update', [FBController::class, 'update'])->name('admin.update.fb');
				Route::post(fbUrlName.'/store', [FBController::class, 'store'])->name('admin.store.fb');
				Route::get('exportfbUrlName.-', 'FBController@export')->name('admin.export.fb');

				Route::get('getfbUrlName.-', 'FBController@paginate')->name('admin.get.fb');
				Route::get(fbUrlName.'/{hospitality_sector_id}/rooms', [FBController::class, 'viewRooms'])->name('admin.view.fb.sales.channels');
				Route::post(fbUrlName.'/{hospitality_sector_id}/rooms', [FBController::class, 'storeRooms'])->name('admin.store.fb.sales.channels');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/foods', [FBController::class, 'viewFoods'])->name('admin.view.fb.foods');
				Route::post(fbUrlName.'/{hospitality_sector_id}/foods', [FBController::class, 'storeFoods'])->name('admin.store.fb.foods');
				
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/gamings', [FBController::class, 'viewCasinos'])->name('admin.view.fb.casinos');
				Route::post(fbUrlName.'/{hospitality_sector_id}/gamings', [FBController::class, 'storeCasinos'])->name('admin.store.fb.casinos');

				
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/meetings', [FBController::class, 'viewMeetings'])->name('admin.view.fb.meetings');
				Route::post(fbUrlName.'/{hospitality_sector_id}/meetings', [FBController::class, 'storeMeetings'])->name('admin.store.fb.meetings');

				Route::get(fbUrlName.'/{hospitality_sector_id}/other-revenues', [FBController::class, 'viewOtherRevenues'])->name('admin.view.fb.other.revenues');
				Route::post(fbUrlName.'/{hospitality_sector_id}/other-revenues', [FBController::class, 'storeOtherRevenues'])->name('admin.store.fb.other.revenues');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/rooms-direct-expenses', [FBController::class, 'viewRoomsDirectExpenses'])->name('admin.view.fb.rooms.direct.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/rooms-direct-expenses', [FBController::class, 'storeRoomsDirectExpenses'])->name('admin.store.fb.rooms.direct.expenses');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/foods-direct-expenses', [FBController::class, 'viewFoodsDirectExpenses'])->name('admin.view.fb.foods.direct.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/foods-direct-expenses', [FBController::class, 'storeFoodsDirectExpenses'])->name('admin.store.fb.foods.direct.expenses');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/'.gaming.'-direct-expenses', [FBController::class, 'viewCasinosDirectExpenses'])->name('admin.view.fb.casinos.direct.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/'.gaming.'-direct-expenses', [FBController::class, 'storeCasinosDirectExpenses'])->name('admin.store.fb.casinos.direct.expenses');
						
				Route::get(fbUrlName.'/{hospitality_sector_id}/meetings-direct-expenses', [FBController::class, 'viewMeetingExpenses'])->name('admin.view.fb.meeting.direct.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/meetings-direct-expenses', [FBController::class, 'storeMeetingExpenses'])->name('admin.store.fb.meeting.direct.expenses');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/other-revenue-direct-expenses', [FBController::class, 'viewOtherRevenueExpenses'])->name('admin.view.fb.other.revenue.direct.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/other-revenue-direct-expenses', [FBController::class, 'storeOtherRevenueExpenses'])->name('admin.store.fb.other.revenue.direct.expenses');
				
				
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/general-expenses', [FBController::class, 'viewGeneralExpenses'])->name('admin.view.fb.general.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/general-expenses', [FBController::class, 'storeGeneralExpenses'])->name('admin.store.fb.general.expenses');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/marketing-expenses', [FBController::class, 'viewMarketingExpenses'])->name('admin.view.fb.marketing.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/marketing-expenses', [FBController::class, 'storeMarketingExpenses'])->name('admin.store.fb.marketing.expenses');

				Route::get(fbUrlName.'/{hospitality_sector_id}/property-expenses', [FBController::class, 'viewPropertyExpenses'])->name('admin.view.fb.property.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/property-expenses', [FBController::class, 'storePropertyExpenses'])->name('admin.store.fb.property.expenses');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/management-fees', [FBController::class, 'viewManagementFees'])->name('admin.view.fb.management.fees');
				Route::post(fbUrlName.'/{hospitality_sector_id}/management-fees', [FBController::class, 'storeManagementFees'])->name('admin.store.fb.management.fees');
				
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/start-up-cost', [FBController::class, 'viewStartUpCost'])->name('admin.view.fb.start.up.cost');
				Route::post(fbUrlName.'/{hospitality_sector_id}/start-up-cost', [FBController::class, 'storeStartUpCost'])->name('admin.store.fb.start.up.cost');
				
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/energy-expenses', [FBController::class, 'viewEnergyExpenses'])->name('admin.view.fb.energy.expenses');
				Route::post(fbUrlName.'/{hospitality_sector_id}/energy-expenses', [FBController::class, 'storeEnergyExpenses'])->name('admin.store.fb.energy.expenses');
				
					
				Route::get(fbUrlName.'/{hospitality_sector_id}/income-statement', [FBController::class, 'viewIncomeStatementDashboard'])->name('admin.view.fb.income.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/cash-in-out-report', [FBController::class, 'viewCashInOutReport'])->name('admin.view.fb.cash.in.out.report');
				Route::get(fbUrlName.'/{hospitality_sector_id}/balance-sheet-report', [FBController::class, 'viewBalanceSheetReport'])->name('admin.view.fb.balance.sheet.report');
				Route::get(fbUrlName.'/{hospitality_sector_id}/ratio-analysis-report', [FBController::class, 'viewRatioAnalysisReport'])->name('admin.view.fb.ratio.analysis.report');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/study-dashboard', [FBController::class, 'viewStudyDashboard'])->name('admin.view.fb.study.dashboard');
				Route::get(fbUrlName.'/{hospitality_sector_id}/receivable-statement/{type}', [FBController::class, 'viewReceivableStatement'])->name('admin.view.fb.receivable.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-assets-suppliers-statement', [FBController::class, 'viewFixedAssetsSuppliersStatement'])->name('admin.view.fb.fixed.assets.suppliers.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/management-fees-statement', [FBController::class, 'viewManagementFeesStatement'])->name('admin.view.fb.management.fees.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/corporate-taxes-statement', [FBController::class, 'viewCorporateTaxesStatement'])->name('admin.view.fb.corporate.taxes.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/inventory-statement/{type}', [FBController::class, 'viewInventoryStatement'])->name('admin.view.fb.inventory.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-assets-statement', [FBController::class, 'viewFixedAssetsStatement'])->name('admin.view.fb.fixed.assets.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-expense/general-expense', [FBController::class, 'viewPrepaidExpenseGeneralExpenseStatement'])->name('admin.view.fb.prepaid-expense.general.expense.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-expense/marketing-expense', [FBController::class, 'viewPrepaidExpenseMarketingExpenseStatement'])->name('admin.view.fb.prepaid-expense.marketing.expense.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-expense/property-expense', [FBController::class, 'viewPrepaidExpensePropertyStatement'])->name('admin.view.fb.prepaid-expense.property.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-expense/energy-expense', [FBController::class, 'viewPrepaidExpenseEnergyStatement'])->name('admin.view.fb.prepaid-expense.energy.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/fixed-expense/total', [FBController::class, 'viewTotalFixedExpenseStatement'])->name('admin.view.fb.total.fixed.expenses.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/disposable-payment-statement/{type}', [FBController::class, 'viewDisposablePaymentStatement'])->name('admin.view.fb.disposable.payment.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/property-taxes-payment-statement', [FBController::class, 'viewPropertyTaxesPaymentStatement'])->name('admin.view.fb.property.taxes.payment.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/property-insurance-payment-statement', [FBController::class, 'viewPropertyInsurancePaymentStatement'])->name('admin.view.fb.property.insurance.payment.statement');
				Route::get(fbUrlName.'/{hospitality_sector_id}/loan-schedule-report/{loanType}', [FBController::class, 'viewLoanScheduleReport'])->name('admin.view.fb.loan.schedule.report');
				Route::get(fbUrlName.'/{hospitality_sector_id}/land-acquisition-costs', [FBController::class, 'viewLandAcquisitionCosts'])->name('admin.view.fb.land.acquisition.costs');
				Route::post(fbUrlName.'/{hospitality_sector_id}/land-acquisition-costs', [FBController::class, 'storeLandAcquisitionCosts'])->name('admin.store.fb.land.acquisition.costs');				
				Route::get(fbUrlName.'/{hospitality_sector_id}/ffe-cost', [FBController::class, 'viewFFECost'])->name('admin.view.fb.ffe.cost');
				Route::post(fbUrlName.'/{hospitality_sector_id}/ffe-cost', [FBController::class, 'storeFFECost'])->name('admin.store.fb.ffe.cost');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/property-acquisition-costs', [FBController::class, 'viewPropertyAcquisitionCosts'])->name('admin.view.fb.property.acquisition.costs');
				Route::post(fbUrlName.'/{hospitality_sector_id}/property-acquisition-costs', [FBController::class, 'storePropertyAcquisitionCosts'])->name('admin.store.fb.property.acquisition.costs');
				
				Route::get(fbUrlName.'/{hospitality_sector_id}/s-curve-chart', [FBController::class, 'viewSCurveChart'])->name('admin.view.fb.s-curve-chart');
				
				
				// end hospitality sector

				Route::get('fixed-payments-at-end-php', 'Loans2Controller@viewTestLoanAtEndPhp')->name('fixed.loan.fixed.at.end.php');
				Route::get('fixed-payments-at-end', 'Loans2Controller@create')->name('fixed.loan.fixed.at.end');
				Route::get('calculate-loan-amount', 'Loans2Controller@create')->name('calc.loan.amount');
				Route::get('calculate-interest-percentage', 'Loans2Controller@create')->name('calc.interest.percentage');
				Route::get('fixed-payments-at-beginning', 'Loans2Controller@create')->name('fixed.loan.fixed.at.beginning');
				Route::get('variable-payments', 'Loans2Controller@create')->name('variable.payments');

				// quotation

				Route::get('quotation/all', [QuotationController::class, 'viewAll'])->name('admin.view.all.quotation');
				Route::get('quotation/win', [QuotationController::class, 'viewWin'])->name('admin.view.win.quotation');
				// Route::resource('quotation' , [QuotationController::class , 'viewAll'] );
				// Route::get();

				//Ajax
				// Route::post('get/ZoneZonesData/', 'Analysis\SalesGathering\ZoneAgainstAnalysisReport@ZonesData')->name('get.zones.data');
				// Route::get('get/viewData/', 'Analysis\SalesGathering\ZoneAgainstAnalysisReport@dataView')->name('get.view.data');
				Route::get('checkIfJobFinished', 'SalesGatheringTestController@activeJob')->name('active.job');
				Route::get('checkIfJobFinishedExcel', 'UploadExcelsTestController@activeJob')->name('active.job.excel');
				Route::get('checkIfJobFinishedSupplierInvoice', 'UploadSuppliersInvoicesTestController@activeJob')->name('active.job.supplier.invoice');

				Route::get('/redirect', 'HomeController@redirectFun')->name('home.redirect');
				############ Dashboard ############
				Route::get('/companyGroup', 'HomeController@companyGroup')->name('company.group');
				Route::any('Admin_Company', 'CompanyController@adminCompany')->name('admin.company');
				Route::any('Edit_Admin_Company/{companySection}', 'CompanyController@editAdminCompany')->name('edit.admin.company');

				############ Dashboards Links ############
				Route::prefix('/dashboard')->group(function () {

					Route::any('/', 'HomeController@dashboard')->name('dashboard');
					Route::get('/HomePage', 'HomeController@welcomePage')->name('viewHomePage');
					//     Route::any('/breakdown', 'HomeController@dashboardBreakdownAnalysis')->name('dashboard.breakdown');
					//     Route::any('/salesPerson', 'HomeController@dashboardSalesPerson')->name('dashboard.salesPerson');
					//     Route::any('/salesDiscount', 'HomeController@dashboardSalesDiscount')->name('dashboard.salesDiscount');
					//     Route::any('/intervalComparing', 'HomeController@dashboardIntervalComparing')->name('dashboard.intervalComparing');
				});






				############ Export Routes ############
				// Route::get('inventoryStatement/export', 'InventoryStatementController@export')->name('inventoryStatement.export');
				Route::get('salesGathering/export', 'SalesGatheringController@export')->name('salesGathering.export');
				Route::get('uploadExcel/export', 'UploadExcelsController@export')->name('uploadExcels.export');
				Route::get('uploadSupplierInvoice/export', 'UploadSupplierInvoicesController@export')->name('uploadSupplierInvoices.export');



				// ->parameters(['name-of-route'=> inventoryStatement [dependancies injection of model]])

				############ test table for uploading ############
				// Route::resource('inventoryStatementTest', InventoryStatementTestController::class)
				// ->only(['edit', 'update', 'destroy']);
				Route::resource('salesGatheringTest', SalesGatheringTestController::class)
					->only(['edit', 'update', 'destroy']);

				############ Sections Resources ############

				// Route::resource('inventoryStatement', InventoryStatementController::class);
				Route::resource('salesGathering', SalesGatheringController::class);
				Route::resource('uploadExcel', UploadExcelsController::class);
				Route::resource('uploadSupplierInvoice', UploadSupplierInvoicesController::class);

				############  (TRUNCATE) ############
				Route::get('Truncate/{model}', 'DeletingClass@truncate')->name('truncate');
				Route::delete('DeleteMultipleRows/{model}', 'DeletingClass@multipleRowsDeleting')->name('multipleRowsDelete');






				// Route::resource('adjustedCollectionDate', AdjustedCollectionDateController::class);


				############ Exportable Fields Selection Routes ############
				Route::get('fieldsToBeExported/{model}/{view}', 'ExportTable@customizedTableField')->name('table.fields.selection.view');
				Route::post('fieldsToBeExportedSave/{model}/{view}', 'ExportTable@customizedTableFieldSave')->name('table.fields.selection.save');
			});











			############ Live Wire ########
			// Route::get('/post', AdjustedCollectionDatesForm::class)->name('adjusted_collection.view');
			// Route::any('adjusted_collection_view', AdjustedCollectionDatesForm::class)->name('adjusted_collection.view');

			Route::post('/adjusted_collection_view', [AdjustedCollectionDatesForm::class, 'render']);
		}
	);
});

Route::delete('deleteMultiRowsFromCaching/{company}', [DeleteMultiRowsFromCaching::class, '__invoke'])->name('deleteMultiRowsFromCaching');
Route::get('deleteAllRowsFromCaching/{company}', [DeleteAllRowsFromCaching::class, '__invoke'])->name('deleteAllCaches');
Route::post('get-uploading-percentage/{companyId}', [getUploadPercentage::class, '__invoke']);
Route::post('get-uploading-percentage-for-excel/{companyId}', [getUploadPercentageForUploadExcel::class, '__invoke']);
Route::post('get-uploading-percentage-for-supplier-invoice/{companyId}', [getUploadPercentageForUploadSupplierInvoice::class, '__invoke']);

// Route::group('lang')



Route::get('{lang}/remove-company-image/{company}', function ($lang, Company $company) {
	if ($company->getFirstMedia('default')) {
		$company->getFirstMedia('default')->delete();
	}
	return redirect()->back()->with('success', __('Company Image Has Been Deleted Successfully'));
})->name('remove.company.image');

// Route::post('save-fixed-at-end', 'SaveFixedAtEndController@__invoke')->name('save.fixed.at.end');
// Route::post('save-loan-dates', 'SaveLoanDatesController@__invoke')->name('save.loan.dates');

// Route::group([
//         'prefix' => LaravelLocalization::setLocale(),
//         'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
//     ],function(){
            
        
//     });
