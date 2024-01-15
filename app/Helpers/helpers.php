<?php


use App\Http\Controllers\ExportTable;
use App\Models\AllocationSetting;
use App\Models\Casino;
use App\Models\Company;
use App\Models\Country;
use App\Models\CustomizedFieldsExportation;
use App\Models\DepartmentExpense;
use App\Models\ExistingProductAllocationBase;
use App\Models\Food;
use App\Models\HospitalitySector;
use App\Models\Meeting;
use App\Models\ModifiedSeasonality;
use App\Models\ModifiedTarget;
use App\Models\NewProductAllocationBase;
use App\Models\Other;
use App\Models\TablesField;
use App\ReadyFunctions\CalculateDurationService;
use App\ReadyFunctions\IntervalEndBalancesService;
use App\ReadyFunctions\IntervalSummationOperations;
use App\Traits\Intervals;
use Carbon\Carbon;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
const LAND_LOAN = 'land' ;
const FFE_COST = 'ffe_cost' ;
const HARD_COST_CONSTRUCTION = 'hard_cost_construction' ;
const SOFT_COST_CONSTRUCTION= 'soft_cost_construction' ;
const PROPERTY_LOAN = 'property_loan' ;
const BASE_MANAGEMENT_FEES_AS_PERCENTAGE_FROM_REVENUES = 'base_management_fees_as_percentage_from_revenues' ;
const INCENTIVE_MANAGEMENT_FEES_AS_PERCENTAGE_FROM_REVENUES = 'incentive_management_fees_as_percentage_from_revenues' ;
const fbUrlName = 'food-and-beverage-outlets';

const MAX_RANKING = 5;
const Customers_Against_Products_Trend_Analysis = 'Customers Against Products Trend Analysis';
const Customers_Against_Categories_Trend_Analysis = 'Customers Against Categories Trend Analysis';
const Customers_Against_Products_ITEMS_Trend_Analysis = 'Customers Against Products Items Trend Analysis';
const INVOICES = 'Invoices';
// food revenue projection constant 
const guest_capture_x_cover_value_per_guest_method = 'guest_capture_x_cover_value_per_guest_method';
const guest_capture_x_meals_per_guest_x_cover_value_per_meal_method = 'guest_capture_x_meals_per_guest_x_cover_value_per_meal_method';
const cover_count_target_per_day_x_cover_value_method = 'cover_count_target_per_day_x_cover_value_method';
const percentage_from_rooms_revenue = 'percentage_from_rooms_revenue';

const guest_capture_casino_charges_per_guest_method = 'guest_capture_casino_charges_per_guest_method';
const guest_count_target_per_day_charges_per_guest_method = 'guest_count_target_per_day_charges_per_guest_method';

const guest_count_charges_per_guest_occupancy_rate_method = 'guest_count_charges_per_guest_occupancy_rate_method';
const facility_count_daily_rent_occupancy_rate_method = 'facility_count_daily_rent_occupancy_rate_method';
const percentage_from_f_b_revenue = 'percentage_from_f_b_revenue';
const guest_capture_x_charges_per_guest_method = "guest_capture_x_charges_per_guest_method";

const variable_expenses_as_percentage_from_rooms_revenues = 'variable_expenses_as_percentage_from_rooms_revenues';
const variable_expenses_as_cost_per_night_sold = 'variable_expenses_as_cost_per_night_sold';
const variable_expenses_as_cost_per_guest = 'variable_expenses_as_cost_per_guest';
const disposable_expenses_rate = 'disposable_expenses_rate';
const rooms_manpower_expense = 'rooms_manpower_expense';
const gaming = 'gaming';

const other_property_fixed_expenses = 'other_property_fixed_expenses';

const fixed_monthly_expenses = 'fixed_monthly_expenses';

const variable_expenses_as_percentage_from_total_revenues = 'variable_expenses_as_percentage_from_total_revenues';
const start_up_cost = 'start_up_cost';
const pre_operating_expense = 'pre_operating_expense';
const MAX_YEARS_COUNT = 20 ;
const PROPERTY_ACQUISITION = 'property_acquisition';

function spaceAfterCapitalLetters($string)
{
	return preg_replace('/(?<!\ )[A-Z]/', ' $0', $string);;
}
function getYearsFromInterval($start, $end)
{
	return [
		'start_year' => explode('-', $start)[0],
		'end_year' => explode('-', $end)[0],
	];
}

function array_unique_value(array $array, string $key)
{
	
	$uniqueItems = [];
	foreach ($array as $arr) {
		foreach ($arr as $ar) {
			$uniqueItems[$ar[$key]] = $ar;
		}
	}
	return $uniqueItems;
}

function getPeriods($interval)
{

	if ($interval == 'monthly') {
		return  [
			1 => [1],
			2 => [2],
			3 => [3],
			4 => [4],
			5 => [5],
			6 => [6],
			7 => [7],
			8 => [8],
			9 => [9],
			10 => [10],
			11 => [11],
			12 => [12],
		];
	}
	if ($interval == 'quarterly') {

		return [
			3 => [1, 2, 3], 6 => [4, 5, 6], 9 => [7, 8, 9], 12 => [10, 11, 12]
		];
	}
	if ($interval == 'semi-annually') {
		return [
			6 => [1, 2, 3, 4, 5, 6], 12 => [7, 8, 9, 10, 11, 12]
		];
	}

	if ($interval == 'annually') {
		return [
			12 => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]
		];
	}
}
function getLongestArray($array)
{
	$result = [];
	foreach ($array as $arr) {
		if (count($arr) > count($result)) {
			$result = $arr;
		}
	}

	return $result;
}
function arrayCountAllLongest(array $array)
{
	$longestArray = getLongestArray($array);

	$counter = 0;

	foreach ($longestArray as $arr) {
		$counter += count($arr);
	}

	return $counter;
}
function flatten(array $array)
{
	$return = array();
	array_walk_recursive($array, function ($a) use (&$return) {
		$return[] = $a;
	});
	return $return;
}
function countTotalForBranch(array $array): int
{
	$total = 0;
	foreach ($array as $arr) {
		$total += count($arr);
	}

	return $total;
}

function countSumForAllRank(array $array, $i): array
{
	$total = [
		'total' => 0,
		'values' => 0,
		'percentages' => 0
	];
	foreach ($array as $arr) {
		if (isset($arr[$i])) {
			$total['total'] += count($arr[$i]);
			$total['values'] += array_sum(flatten($arr[$i]));
			$total['percentages'] += 0;
		}
	}

	return $total;
}
function camelize($input, $separator = '_')
{
	return str_replace($separator, '', ucwords($input, $separator));
}
function camelizeWithSpace($input, $separator = '-')
{
	return str_replace($separator, ' ', ucwords($input, $separator));
}

if (!function_exists('lang')) {
	function lang()
	{
		return  app()->getLocale();
	}
}

if (!function_exists('company')) {
	function company()
	{
		if (Auth::check()) {
			$company =   Auth::user()->companies()->where('type', 'single')->first();

			$company = $company ?? Auth::user()->companies()->where('type', 'group')->first()->subCompanies()->first();

			return  $company;
		}
	}
}
if (!function_exists('company')) {
	function setCompany($company_id)
	{
		if (Auth::check()) {
			$company = Company::find($company_id);
			return  $company;
		}
	}
}
if (!function_exists('exportableFields')) {
	function exportableFields($company_id, $model)
	{
		if (Auth::check()) {
			$fields = CustomizedFieldsExportation::where('model_name', $model)->where('company_id', $company_id)->first();
			return  $fields;
		}
	}
}

if (!function_exists('strip_strings')) {
	function strip_strings(string $sentence)
	{
		$removeHtml =  strip_tags($sentence);

		return str_replace(['&amp;', '&nbsp;', 'nbsp;'],  '', $removeHtml);
	}
}

if (!function_exists('dateFormating')) {
	function dateFormating($date, $formate = "d-m-Y")
	{
		return date($formate, strtotime($date));
	}
}
if (!function_exists('routeName')) {
	function routeName($route)
	{
		$route_array = explode('.', $route);
		$route = $route_array[0];
		return $route;
	}
}
function getOrderMaxForBranch(string $branchName,  array $data)
{

	$arr_data = $data;

	uasort($arr_data, function ($a, $b) {
		return $a < $b;
	});
	$uniques = array_unique($arr_data);
	for ($i = 0; $i < count($uniques); $i++) {
		$key = array_values($uniques)[$i];
		$new["$key"] = $i + 1;
	};

	$value = $arr_data[$branchName];

	return $new[strval($value)];
}
function array_sort_multi_levels(&$array)
{
	uasort($array, function ($a, $b) {
		$sumA = 0;
		foreach ($a as $year => $data) {
			foreach ($data as $quarter => $data) {
				$sumA += $data['invoice_number'];
			}
		}

		$sumB = 0;
		foreach ($b as $year => $data) {
			foreach ($data as $quarter => $data) {
				$sumB += $data['invoice_number'];
			}
		}


		if ($sumA == $sumB) {
			return 0;
		}
		return ($sumA > $sumB) ? -1 : 1;
	});
}
// function $productName
function getMaxNthFromArray()
{
	$args = func_get_args();
	$max = 0;
	foreach ($args as $arg) {
		if ($arg > $max) {
			$max = $arg;
		}
	}
	return $max;
}
// caching
// miscelinuous
function getCompanyTagName(Company $company)
{
	return 'company_' . $company->id;
}
function getExportableFields($companyId = null): array
{

	$company  = Company::find($companyId ?: Request()->segment(2));
	if ($company) {
		return (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
	}
	return [];
}
function getExportableFieldsKeysAsValues($companyId)
{
	return array_keys(getExportableFields($companyId)) ?? [];
}

function canViewCustomersDashboard(array $exportables)
{
	return in_array('Customer Name', $exportables) || in_array('Customer Code', $exportables);
}
// 1- customers dashboard
function getNewCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'new_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}
function getNewCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'new_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_' . $type;
}


function getTotalCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'total_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_' . $type;
}


// 
function getRepeatingCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'repeating_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}

function getRepeatingCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'repeating_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_'  . $type;
}

function getActiveCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'active_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}

function getActiveCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'active_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_'  . $type;
}



function getStopReactivatedCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'stop_reactivated_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}
function getStopReactivatedCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'stop_reactivated_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_'  . $type;
}
function getDeadReactivatedCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'dead_reactivated_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}

function getDeadReactiveCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'dead_reactivated_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_'  . $type;
}
// getStopRepeatingCacheNameForCompanyInYearForType
// getDeadReactiveCacheNameForCompanyInYearForType
function getStopRepeatingCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'stop_repeating_reactivated_customers_for_company_' . $companyId->id . 'for_year_' . $year;
}
function getStopRepeatingCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'stop_repeating_reactivated_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_' . $type;
}
function getStopCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'stop_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}

function getStopCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'stop_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_' . $type;
}


function getDeadCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'dead_customers_for_company_' . $companyId->id . '_for_year_' . $year;
}
function getDeadCustomersCacheNameForCompanyInYearForType(Company $companyId, string $year, $type)
{
	return 'dead_customers_for_company_' . $companyId->id . '_for_year_' . $year . 'for_type_' . $type;
}

function getTotalCustomersCacheNameForCompanyInYear(Company $companyId, string $year)
{
	return 'total_customers_dashboard_for_company_' . $companyId->id . '_for_year_' . $year;
}

// intervalYearsForCompany (max date and min date in database for sales gatering)


function getIntervalYearsFormCompanyCacheNameForCompany(Company $companyId)
{
	return 'interval_years_for_company_' . $companyId->id;
}
function formatChartNameForDom($chartName)
{
	return str_replace(["/", ' '], '-', $chartName);
}





function sortReportForTotals(&$report_data)
{
	(uasort(
		$report_data,
		function ($a, $b) use (&$report_data) {
			if (isset($b['Total']) && isset($a['Total'])) {


				$a = array_sum($a['Total']);
				$b = array_sum($b['Total']);

				if ($a == $b) {
					return 0;
				}
				return ($a > $b) ? -1 : 1;
			}

			if (!is_multi_array($a) &&  is_multi_array($b)) {
				return 1;
			}

			if (is_multi_array($a) &&  !is_multi_array($b)) {
				return -1;
			}

			if (isset($a['Total']) && !isset($b['Total'])) {
				return -1;
			}

			if (!isset($a['Total']) && isset($b['Total'])) {
				return 1;
			}



			return -1;
		}

	)
	);
}

function sortSubItems(&$sales_channel_channels_data)
{

	(uasort(
		$sales_channel_channels_data,
		function ($a, $b) {

			if (isset($a['Sales Values']) && isset($b['Sales Values'])) {

				$a = array_sum($a['Sales Values']);
				$b = array_sum($b['Sales Values']);


				if ($a == $b) {
					return 0;
				}
				return ($a > $b) ? -1 : 1;
			}
			return;
		}

	)
	);
}
function sortTwoDimensionalArr(array &$arr)
{
	uasort($arr, function ($a, $b) {
		if ($a == $b) {
			return 0;
		}
		return ($a > $b) ? -1 : 1;
	});
}
function sortOneDimensionalArr(array &$arr)
{
	uasort($arr, function ($a, $b) {
		if ($a == $b) {
			return 0;
		}
		return ($a > $b) ? -1 : 1;
	});
}

function sortTwoDimensionalBaseOnKey(array &$arr, $key)
{
	uasort($arr, function ($a, $b) use ($key) {
		if ($a[$key] == $b[$key]) {
			return 0;
		}
		return ($a[$key] > $b[$key]) ? -1 : 1;
	});
}
function sortTwoDimensionalExcept(array &$arr, array $exceptKeys)
{
	uksort($arr, function ($key1, $key2) use ($exceptKeys, $arr) {
		if (!in_array($key1, $exceptKeys) && !in_array($key2, $exceptKeys)) {
			if ($arr[$key1] == $arr[$key2]) {
				return 0;
			}
			return $arr[$key1] > $arr[$key2] ? -1 : 1;
		} elseif (!in_array($key1, $exceptKeys) && in_array($key2, $exceptKeys)) {
			return -1;
		} elseif (in_array($key1, $exceptKeys) && !in_array($key2, $exceptKeys)) {
			return -1;
		} else {
			return -1;
		}
	});
}
function getTypeFor($type, $companyId, $formatted = false)
{
	if ($formatted) {
		return  DB::table('sales_gathering')->where('company_id', $companyId)->orderBy($type)->distinct()->select($type)->get()->pluck($type, $type)->toArray();;
	} else {
		$data = DB::table('sales_gathering')->where('company_id', $companyId)->orderBy($type)->distinct()->select($type)->get()->pluck($type)->toArray();
		$data = array_filter($data, function ($item) {

			return $item;
		});
		return $data;
	}
	//   return  DB::table('sales_gathering')->where('company_id', $companyId)->distinct()->select($type)->get()->pluck($type)->toArray(); ;
}

function getLargestArrayDates(array $array)
{

	if (count($array) == count($array, COUNT_RECURSIVE)) {
		$dates = [];
		foreach ($array as $date => $val) {
			if ($date) {
				try {
					$dates[] =
						Carbon::make($date)->format('d-M-Y');
				} catch (\Exception $e) {
					return $dates;
				}
			} else {
				return $dates;
			}
		}
		return $dates;
	} else {
		$largestArray = getLargestArray($array);
		return getLargestArrayDates($largestArray);
	}
}
function getLargestArray($array)
{
	$largestArr = [];
	foreach ($array as $arr) {
		if (count($arr) > count($largestArr)) {
			$largestArr = $arr;
		}
	}
	return $largestArr;
}
function getDateBetween(array $dates)
{
	$smallest = null;
	$largest = null;
	if (count($dates)) {

		foreach ($dates as $type => $date) {
			if (is_array($date)) {
				foreach ($date as $d => $k) {
					$d = Carbon::make($d);
					if (is_null($smallest)) {
						$smallest = $d;
					} else {
						if (!$d->greaterThan($smallest)) {
							$d = $smallest;
						}
					}

					if (is_null($largest)) {
						$largest = $d;
					} else {
						if ($d->greaterThan($largest)) {
							$largest = $d;
						}
					}
				}
			} else {
				$newDates = array_keys($dates);
				$smallest = Carbon::make($newDates[0]) ?? null;
				$largest = Carbon::make($newDates[count($newDates) - 1]) ?? null;
			}
		}



		$period = new DatePeriod(
			new DateTime($smallest->format('Y-m-d')),
			new DateInterval('P1M'),
			new DateTime($largest->format('Y-m-d'))
		);

		$per = [];
		foreach ($period as $p) {
			$per[] = $p->format('d-M-Y');
		}

		return $per;
	}


	return [];
}


function generateIdForExcelRow(int $companyId)
{
	return uniqid('company_' . $companyId) . Str::random(9) . $companyId . uniqid();
}

function getCanReloadUploadPageCachingForCompany($companyId)
{
	return 'can_reload_caching_page_for_company_' . $companyId;
}
function getCanReloadUploadPageCachingForUploadExcelForCompany($companyId)
{
	return 'can_reload_caching_page_for_upload_excel_for_company_' . $companyId;
}
function getCanReloadUploadPageCachingForUploadSupplierInvoiceForCompany($companyId)
{
	return 'can_reload_caching_page_for_upload_customer_invoice_for_company_' . $companyId;
}
function getTotalUploadCacheKey($company_id, $jobId)
{
	return 'total_uploaded_for_company_' . $company_id  . 'for_job_' . $jobId;
}

function getTotalUploadForUploadExcelCacheKey($company_id, $jobId)
{
	return 'upload_excel_total_uploaded_for_company_' . $company_id  . 'for_job_' . $jobId;
}
function getTotalUploadForUploadSupplierInvoiceCacheKey($company_id, $jobId)
{
	return 'upload_supplier_invoice_total_uploaded_for_company_' . $company_id  . 'for_job_' . $jobId;
}
function getShowCompletedTestMessageCacheKey($companyId)
{
	return 'show_complete_test_phase_' . $companyId;
}
function getShowCompletedTestMessageCacheKeyForUploadSupplierInvoice($companyId)
{
	return 'show_complete_test_phase_for_upload_supplier_invoice_' . $companyId;
}


function getUploadingCustomerInvoiceShowCompletedTestMessageCacheKey($companyId)
{
	return 'upload_customer_invoice_show_complete_test_phase_' . $companyId;
}
function getUploadingExcelShowCompletedTestMessageCacheKey($companyId)
{
	return 'upload_excel_show_complete_test_phase_' . $companyId;
}
function getUploadingShowCompletedTestMessageForUploadSupplierInvoiceCacheKey($companyId)
{
	return 'upload_excel_show_complete_test_phase_for_supplier_invoice_' . $companyId;
}


function is_multi_array($arr)
{
	rsort($arr);
	return isset($arr[0]) && is_array($arr[0]);
}

function maxOptionsForOneSelector(): int
{
	// return 2 ; 
	return 12;
}

function isCustomerExceptionalCase($type, $name_of_selector_label)
{
	$conditionOne = ($type == 'category' && ($name_of_selector_label == 'Customers Against Categories' || $name_of_selector_label == 'Categories'));

	return $conditionOne;
}

function isCustomerExceptionalForProducts($type, $name_of_selector_label)
{

	$conditionTwo = ($type == 'product_or_service' && ($name_of_selector_label == 'Customers Against Products' ||  $name_of_selector_label == 'Products'));

	return $conditionTwo;
}

function isCustomerExceptionalForProductsItems($type, $name_of_selector_label)
{

	$conditionTwo = ($type == 'product_item' && ($name_of_selector_label == 'Customers Against Products Items' ||  $name_of_selector_label == 'Product Items'));

	return $conditionTwo;
}

function orderTotalsForRanking(array &$array)
{
	(uasort(
		$array,
		function ($a, $b) {

			if (isset($a['total']) && isset($b['total'])) {

				$a = ($a['total']);

				$b = ($b['total']);


				if ($a == $b) {
					return 0;
				}
				return ($a > $b) ? -1 : 1;
			}
			return;
		}

	)
	);


		// $data[$branchName][$rankNumber] ?? []
	;
}



function failAllocationMessage($allocation_type)
{
	return __('Please Add New') . ' ' . capitializeType($allocation_type);
}
function hasProductsItems($company)
{

	$productItems = DB::select(DB::raw('select count(*) as has_product_item from sales_gathering where company_id = ' . $company->id . ' and product_item is not null'));
	return $productItems[0]->has_product_item ?? 0;
}
function hasAtLeastOneOfType($company, $type)
{
	$productItems = DB::select(DB::raw('select count(*) as has_product_item from sales_gathering where company_id = ' . $company->id . ' and ' . $type . ' is not null'));
	return $productItems[0]->has_product_item ?? 0;
}
function count_array_values(array $array)
{
	$counter = 0;
	foreach ($array as $arr) {
		$counter += count($arr);
	}
	return $counter;
}
function countExistingTypeFor($type,  $company)
{
	$productItems = DB::select(DB::raw('select count(*) as has_product_item from sales_gathering where company_id = ' . $company->id . ' and ' . $type . ' is not null'));
	return $productItems[0]->has_product_item ?? 0;
}


function capitializeType($type)
{
	return __(spaceAfterCapitalLetters(camelize($type)));
}


function getTypeSalesAnalysisData(Request $request, Company $company, $type)
{
	$dimension = $request->report_type;

	$report_data = [];
	$growth_rate_data = [];

	$sales_channels = is_array(json_decode(($request->sales_channels[0]))) ? json_decode(($request->sales_channels[0])) : $request->sales_channels;

	foreach ($sales_channels as  $sales_channel) {

		$sales_channels_data = collect(DB::select(DB::raw(
			"
                SELECT DATE_FORMAT(LAST_DAY(date),'%d-%m-%Y') as gr_date  , net_sales_value ," . $type . "
                FROM sales_gathering
                WHERE ( company_id = '" . $company->id . "'AND " . $type . " = '" . $sales_channel . "' AND date between '" . $request->start_date . "' and '" . $request->end_date . "')
                ORDER BY id "
		)))->groupBy('gr_date')->map(function ($item) {
			return $item->sum('net_sales_value');
		})->toArray();

		$interval_data_per_item = [];
		$years = [];
		if (count($sales_channels_data) > 0) {
			array_walk($sales_channels_data, function ($val, $date) use (&$years) {
				$years[] = date('Y', strtotime($date));
			});
			$years = array_unique($years);
			$report_data[$sales_channel] = $sales_channels_data;
			$interval_data_per_item[$sales_channel] = $sales_channels_data;
			$interval_data = Intervals::intervals($interval_data_per_item, $years, $request->interval);

			$report_data[$sales_channel] = $interval_data['data_intervals'][$request->interval][$sales_channel] ?? [];
		}
	}

	$final_report_data = [];
	$sales_channels_names = [];
	foreach ($sales_channels as  $sales_channel) {
		$final_report_data[$sales_channel]['Sales Values'] = ($report_data[$sales_channel] ?? []);
		$final_report_data[$sales_channel]['Growth Rate %'] = ($growth_rate_data[$sales_channel] ?? []);
		$sales_channels_names[] = (str_replace(' ', '_', $sales_channel));
	}

	return $report_data;
}


function sumBasedOnQuarterNumber($array, array $quarters, $total)
{
	$result = 0;
	foreach ($array as $month => $val) {
		if (in_array($month, $quarters)) {
			$result += $val;
		}
	}
	return $result ? number_format($result / $total  * 100, 2) . ' % ' : '-';
}

function indexIsExistIn(string $indexName, string $tableName)
{
	$indexesFound = (Schema::getConnection()->getDoctrineSchemaManager())->listTableIndexes($tableName);

	return array_key_exists($indexName, $indexesFound);
}

function getAllColumnsTypesForCaching($companyId)
{
	$exportables = array_keys(getExportableFields($companyId));
	$cacheablesFields = [
		'country', 'branch', 'sales_person', 'customer_name', 'business_sector', 'zone', 'sales_channel', 'category', 'product_or_service', 'product_item'
	];
	return array_intersect($exportables, $cacheablesFields);
}

function getCustomerNature(string $customerName, array $allDataArray)
{
	unset($allDataArray['totals']);
	foreach ($allDataArray as $key => $array) {
		// dump($array);
		foreach ($array as $type => $arr) {
			foreach ($arr as $ar) {
			
				if ($ar->customer_name === $customerName) {
					return str_replace(' ', '', $type);
				}
			}
		}
	}
	return '';
}

function getSummaryCustomerDashboardForEachType($allFormattedWithOthers, $customerNature)
{
	$dataFormatted = [];
	foreach ($allFormattedWithOthers as $customerObject) {
		$userType = getCustomerNature($customerObject->customer_name, $customerNature);
		isset($dataFormatted[$userType]) ? $dataFormatted[$userType] = [
			'count' => $dataFormatted[$userType]['count'] + 1,
			'sales' => $dataFormatted[$userType]['sales'] + $customerObject->val
		]
			: $dataFormatted[$userType] = [
				'count' => 1,
				'sales' => $customerObject->val
			];
	}
	$dataFormatted = array_filter($dataFormatted);

	// foreach($dataFormatted as $key=>$val)
	// {
	//     if(! $key )
	//     {
	//         unset($dataFormatted[$key]);
	//     }
	// }
	return array_sort_type($dataFormatted);
}
function array_sort_type($array)
{
	(uasort(
		$array,
		function ($firstElement, $secondElement) {
			if (isset($firstElement['sales']) && isset($secondElement['sales'])) {

				$firstElement = $firstElement['sales'];

				$secondElement = $secondElement['sales'];
				if ($firstElement == $secondElement) {
					return 0;
				}
				return ($firstElement > $secondElement) ? -1 : 1;
			}
			return;
		}

	)
	);

	return $array;
}

function sum_array_of_std_objects(array $array,  string $key)
{

	$totalSum =  0;
	foreach ($array as $arr) {
		foreach ($arr as $ar) {
			$totalSum += $ar->{$key} ?? 0;
		}
	}
	return $totalSum;
}
function getIterableItems($array)
{
	$iterables = [];
	foreach ($array as $key => $arrVal) {
		foreach ($arrVal as $item => $val) {
			if (!isset($iterables[$item])) {
				$iterables[$item] = getTotalForThisTypeExceptDead($array, $item, 'total_sales');
			}
		}
	}
	sortTwoDimensionalArr($iterables);
	return $iterables;
}

function getTotalForSingleType($array, $key)
{
	$totals = 0;
	foreach ($array as $arr) {
		foreach ($arr as $ar) {
			$totals += $ar->{$key};
		}
	}
	return $totals;
}
function countTotalForSingleType($array)
{
	$totals = 0;
	foreach ($array as $arr) {
		foreach ($arr as $ar) {
			$totals += 1;
		}
	}
	return $totals;
}
function calcTotalsForTotalsActiveItems(array $array, $key)
{

	$totals = 0;
	foreach ($array as $arr) {
		foreach ($arr as $ar) {
			foreach ($ar as $item) {
				$totals += $item->{$key} ?? 0;
			}
		}
	}
	return $totals;
}

function countTotalsForTotalsActiveItems(array $array, $key)
{
	$totals = 0;
	foreach ($array as $arr) {
		foreach ($arr as $ar) {
			foreach ($ar as $item) {
				$totals += 1;
			}
		}
	}
	return $totals;
}


function getTotalForThisTypeExceptDead(array $array, $iterableSingleItem, $key)
{

	$total = 0;
	foreach ($array as $index => $arrayOfValues) {
		if (!in_array($index, ['Dead', 'Stop'])) {
			$items =  $arrayOfValues[$iterableSingleItem] ?? [];

			foreach ($items as $item) {
				$total += $item->{$key};
			}
		}
	}
	return $total;
}

function getTotalForThisType(array $array, $iterableSingleItem, $key)
{

	$total = 0;
	foreach ($array as $arrayOfValues) {
		$items =  $arrayOfValues[$iterableSingleItem] ?? [];
		foreach ($items as $item) {
			$total += $item->{$key};
		}
	}
	return $total;
}

function countTotalForThisType(array $array, $iterableSingleItem)
{

	$total = 0;
	foreach ($array as $arrayOfValues) {
		$items =  $arrayOfValues[$iterableSingleItem] ?? [];
		foreach ($items as $item) {
			$total += 1;
		}
	}
	return $total;
}

function sum_array_of_std_objectsForSubType(array $array, $key)
{
	$sum =  0;
	foreach ($array as $arr) {
		$sum += $arr->{$key};
	}
	return $sum;
}

function count_array_of_std_objects(array $array)
{
	$counter = 0;
	foreach ($array as $arr) {
		$counter += 1;
	}
	return $counter;
}

function formatInvoiceForEachInterval(array $array, $selectedType)
{
	$finalResult = [];
	$result = [
		'product_item' => 0,
		'invoice_number' => 0
	];

	$finalResult = [
		'product_item_avg_count' => 0,
		'invoice_count' => 0,
		'avg_invoice_value' => 0
	];
	foreach ($array['sumForEachInterval'][$selectedType] ?? [] as $year => $data) {
		$result['product_item'] =  isset($result['product_item']) ? $result['product_item'] + $data[12]['product_item'] : $data[12]['product_item'];
		$result['invoice_number'] =  isset($result['invoice_number']) ? $result['invoice_number'] + $data[12]['invoice_number'] : $data[12]['invoice_number'];
	}
	$resultForSales = 0;
	foreach ($array['reportSalesValues'][$selectedType] ?? [] as $data => $saleValue) {
		$resultForSales += $saleValue;
	}

	$finalResult['invoice_count'] = $result['invoice_number'] ?? 0;
	$finalResult['product_item_avg_count'] = $result['invoice_number'] ? round($result['product_item'] / $result['invoice_number']) : 0;
	$finalResult['avg_invoice_value'] = $result['invoice_number'] ? number_format($resultForSales / $result['invoice_number'], 0) : 0;
	return $finalResult;
}
function getFieldsForTakeawayForType(string $type)
{
	$commonFields = ['customer_name' => __('Customers Count'), 'category' => __('Categories Count'), 'product_or_service' => __('Products/Service Count'), 'product_item' => __('Products Item Count'), 'sales_person' => __('Salesperson Count'), 'branch' => __('Branch Count'), 'invoice_count' => __('Invoices Count'), 'product_item_avg_count' => __('Avg Products Item Per Invoice'), 'avg_invoice_value' => __('Avg Invoice Values')];
	return [
		'business_sector' => array_merge($commonFields, []),
		'category' => array_merge(Arr::except($commonFields, ['category']), [
			'business_sector' => __('Business Sectors Count'),
			'sales_channel' => __('Sales Channel Count'),
			'zone' => __('Zone Count')
		]),
		'sales_channel' => array_merge($commonFields, [
			'business_sector' => __('Business Sectors Count'),
			'zone' => __('Zone Count')
		]),
		'branch' => array_merge($commonFields, [
			'business_sector' => __('Business Sectors Count'),
			'sales_channel' => __('Sales Channel Count'),

		]),
		'zone' => array_merge($commonFields, [
			'sales_channel' => __('Sales Channel Count'),
		]),
		'product_or_service' => array_merge(Arr::except($commonFields, ['category', 'product_or_service']), [
			'business_sector' => __('Business Sectors Count'),
			'sales_channel' => __('Sales Channel Count'),
			'zone' => __('Zone Count')
		]),

		'product_item' => array_merge(Arr::except($commonFields, ['category', 'product_or_service', 'product_item']), [
			'business_sector' => __('Business Sectors Count'),
			'sales_channel' => __('Sales Channel Count'),
			'zone' => __('Zone Count')
		])
	][$type] ?? $commonFields;
}
function orderStdClassBy($stdObjArray, $orderKey, $direction = 'desc')
{
	(uasort(
		$stdObjArray,
		function ($a, $b) {
			if (isset($a->total_sales_value) && isset($b->total_sales_value)) {

				$a = $a->total_sales_value;;

				$b = $b->total_sales_value;


				if ($a == $b) {
					return 0;
				}
				return ($a > $b) ? -1 : 1;
			}
			return;
		}

	)
	);
	return $stdObjArray;
}

function hasTopAndBottom($type)
{
	$allowedTypes = [
		'zone', 'product_or_service', 'product_item', 'customer_name', 'business_sector', 'category', 'sales_channel', 'sales_person', 'branch'
	];

	return in_array($type, $allowedTypes);
}

function forecastHasBeenChanged($sales_forecast, array $newData)
{

	if (is_null($sales_forecast)) {
		return true;
	}



	foreach (['previous_1_year_sales', 'previous_year', 'previous_year_gr', 'average_last_3_years', 'target_base', 'sales_target', 'new_start', 'growth_rate', 'add_new_products', 'number_of_products', 'sales_target', 'seasonality', 'start_date'] as $index => $field) {
		if (@$newData[$field] != $sales_forecast->{$field}) {
			return true;
		}
	}
	return false;
}

function getCacheKeyForFirstAllocationReport($companyId)
{
	return 'first_allocation_report_for_company_' . $companyId;
}


function getCacheKeyForSecondAllocationReport($companyId)
{
	return 'second_allocation_report_for_company_' . $companyId;
}
function formatExistingFormNewAllocation($newAllocation)
{
	if ($newAllocation) {
		$allocationsNames = $newAllocation->new_allocation_bases_names;
		$data = $newAllocation->allocation_base_data;
		if (!$data) {
			return [];
		}
		$sums = [];
		foreach ($data as $productItem => $newData) {
			foreach ($newData as  $branchName => $values) {
				$sums[$branchName] = ($sums[$branchName] ?? 0) + ($values['actual_value'] ?? 0);
			}
		}
		return $sums;
	}
	return [];
}

function formatDateVariable($dates, $start_date, $end_date)
{
	if (!$dates) {
		return [];
	}
	if (!$start_date || !$end_date) {
		return $dates;
	}
	$start_date = Carbon::make($start_date);
	$end_date = Carbon::make($end_date);
	$filteredDates = [];
	foreach ($dates as $date) {
		$dateWithoutFormatting = $date;
		$date = Carbon::make($date);
		if ($date >= $start_date && $date <= $end_date) {
			$filteredDates[] = $dateWithoutFormatting;
		}
	}
	return count($filteredDates) ? $filteredDates : $dates;
}
// function array_sort_sales(&$array)
// {
//     uasort($array , function($a , $b){
//        sortSubItems($ar);
//     });
// }

function getTotalsOfTotal($reportArray)
{
	$totalForEachItem = [];
	foreach ($reportArray  as $itemName => $data) {

		// sortSubItems($data);
		foreach ($data as $reportKey => $valueArr) {

			if ($reportKey != 'Growth Rate %' && $reportKey != 'Total' && $itemName != 'Total' && $itemName != 'Growth Rate %') {
				$totalForEachItem[$itemName][$reportKey] = 0;

				if (isset($reportArray[$itemName][$reportKey]['Sales Values'])) {
					$totalForEachItem[$itemName][$reportKey] += array_sum($reportArray[$itemName][$reportKey]['Sales Values']);
				}
			}
		}
	}

	$newArray = [];

	foreach ($totalForEachItem as $key => $arr) {


		uasort($arr, function ($a, $b) {
			$a = ($a);
			$b = ($b);

			if ($a == $b) {
				return 0;
			}
			return ($a > $b) ? -1 : 1;
		});

		$newArray[$key] = $arr;
	}
	return $newArray;
	// return $totalForEachItem ;
}

function getLopeItemsFromEachReport($firstReport, $secondReport)
{
	$first = [];
	$second = [];
	foreach ($secondReport as $key => $arrayOfValues) {
		foreach ($arrayOfValues as $itemName => $value) {
			$second[$itemName] = $itemName;
		}
	}
	foreach ($firstReport as $key => $arrayOfValues) {
		sortOneDimensionalArr($arrayOfValues);
		foreach ($arrayOfValues as $itemName => $value) {
			$first[$itemName] = $itemName;
		}
	}
	return array_unique(array_merge($second, $first));

	// return $data ;
}

function getMainItemsNameFromEachInterval($firstReport, $secondReport)
{
	array_sort_products($secondReport);

	$firstReportProductsItems = array_keys($firstReport);
	$secondReportProductsItems = array_keys($secondReport);
	return array_unique(array_merge($secondReportProductsItems, $firstReportProductsItems));
}
function array_sort_products(&$secondReport)
{
	uasort($secondReport, function ($a, $b) {
		//   foreach( )
		$a = array_sum($a);
		$b = array_sum($b);

		if ($a == $b) {
			return 0;
		}
		return ($a > $b) ? -1 : 1;
	});
}
function sum_all_array_values($array)
{
	$total = 0;
	foreach ($array as $key => $value) {
		$total += $value;
	}

	return $total;
}

function preventUserFromForeCast()
{
	return [12, 13, 14, 15, 16];
}


function getCurrentCompany()
{
	$companyIdentifier = Request()->segment(2);
	return Company::find($companyIdentifier);
}
function getCurrentCompanyId(): int
{
	return Request()->segment(2) ?? 31;
}
function getCurrentDateForFormDate()
{
	return  date('m/01/Y');
}
function getCompanyId()
{
	//  admin.get.revenue-business-line
	return Request()->segment(2);
}
function getRevenueBusinessLineOptions(): array
{

	// used by seeder 

	return [
		'training_service' => __('Training Service'),
		'consulting_service' => __('Consulting Service'),
		'internship_service' => __('Internship Service'),
		'internship_service' => __('Internship Service'),
		'externship_service' => __('Externship Service'),
		'observership_service' => __('Observership Service'),
		'observership_service' => __('Observership Service'),
		'scholarship_service' => __('Scholarship Service'),
		'fellowship_service' => __('Fellowship Service'),

	];
}
function getServiceCategories(): array
{

	return [
		'financial_courses' => __('Financial Courses'),
		'marketing_courses' => __('Marketing Courses'),
		'hr_courses' => __('Hr Courses'),
		'financial_consulting' => __('Financial Consulting'),
		'marketing_consulting' => __('Marketing Consulting'),
		'hr_consulting' => __('Hr Consulting'),
	];
}
function getServiceName(): array
{

	return [
		'accounting' => __('Accounting'),
		'costing' => __('Costing'),
		'budget' => __('Budget'),
		'feasibility_study' => __('Feasibility Study'),
		'valuation' => __('Valuation'),
		'performance_analysis' => __('Performance Analysis'),
	];
}
function getServicesNature(): array
{
	return [
		'online' => __('Online'),
		'physical' => __('Physical')
	];
}
function getCountries(): array
{
	$countries = Country::whereNotIn('name_en', ['United States', 'Kenya'])
		->get()->pluck('name_' . App()->getLocale(), 'id')->toArray();
	return $countries;
}
function getPositions(): array
{
	return [
		'executive' => __('Executive'),
		'senior' => __('Senior'),
		'officer' => __('Officer')
	];
}
function getCurrency()
{
	return [
		'egp' => __('EGP'),
		'usd' => __('USD'),
		'euro' => __('EURO')
	];
}
function getDefaultCurrencies()
{
	return [
		[
			'name'=>'EGP',
		],
		[
			'name'=>'USD'
		],
		[
			'name'=>'EURO'
		],
		[
			'name'=>'AED'
		],
		[
			'name'=>'SAR'
		],
		[
			'name'=>'QAR'
		]
	];
}
if (!function_exists('str_to_upper')) {
	function str_to_upper($str)
	{
		return ucwords(str_replace(['_', '-'], ' ', $str));
	}
}
if (!function_exists('getFixedLoanTypes')) {
	function getFixedLoanTypes()
	{
		return [
			'normal', 'step-up', 'step-down', 'grace_period_with_capitalization', 'grace_period_without_capitalization', 'grace_step-up_with_capitalization', 'grace_step-up_without_capitalization',
			'grace_step-down_with_capitalization', 'grace_step-down_without_capitalization',
		];
	}
}
function getModelNamespace()
{
	return '\App\Models\\';
}
function getDefaultOrderBy(): array
{
	return [
		'column' => 'created_at',
		'direction' => 'desc'
	];
}

function formatOptionsForSelect(Collection $items, $idFun = 'getId', $valueFun = 'getName'): array
{
	$ids = [];
	$formattedData = [];
	foreach ($items as $item) {
		$id = $item->$idFun() ;
		if(!in_array($id,$ids )){
			$ids[] = $id ;
			$formattedData[] = [
				'value' => $id ,
				'title' => $item->$valueFun(),
			];	
		}
		
		
	}
	return $formattedData;
}

function formatSelects($selects, $selectedItem, $id, $value, $addNew = false, $selectAll = false): string
{
	$result = '';
	if ($addNew) {
		// $result = '<option class="add-new-item" >'. __('Add New')  .' </option>';
	} elseif ($selectAll) {
		$result = '<option>' . __('All') . '</option> ';
	} else {
		$result = '';
	}

	foreach ($selects as $select) {
		$ID = $select->{$id};
		$val = $select->{$value};

		if (
			in_array($ID, explode(',', $selectedItem))
		) {
			$result .= "<option value='$ID' selected> $val </option> ";
		} else {
			$result .= "<option value='$ID' > $val </option> ";
		}
	}

	return $result;
}
function getFileExtension(string $mimeType): string
{
	return str_contains($mimeType, 'pdf') ? 'pdf' : ucfirst($mimeType);
}

function getExportFormat()
{
	return
		[
			[
				'title' => __('Excel'),
				'value' => 'Xlsx'
			],
			[
				'title' => __('PDF'),
				'value' => 'Dompdf'
			]

		];
}
function formatDateFromString(string $date): string
{
	if ($date) {
		return \Carbon\Carbon::make($date)->format(defaultUserDateFormat());
	}

	return __('N/A');
}
function defaultUserDateFormat()
{
	return 'd-M-Y';
}
function getAddNewFieldRule($fieldName)
{
	return Rule::requiredIf(Request()->get($fieldName) == 'Add New');
}

function getExportDateTime(): string
{
	return now()->toDateTimeString();
}
function getExportUserName()
{
	return Auth()->user()->getName();
}


function generateUniqueStringOfLengthTo($length, $model = null, $columns = [], $onlyNumeric = false)
{
	// modes [string , numeric , string_numeric]
	if ($onlyNumeric === false) {
		$randomString = Str::random($length);
	} else {
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= mt_rand(0, 9);
		}

		return $randomString;
	}
	if ($model && $columns) {
		$query  =  ('App\Models\\' . $model)::query();
		foreach ($columns as $column) {
			$query->orWhere($column, $randomString);
		}
		if ($query->exists()) {
			return generateUniqueStringOfLengthTo($length, $model, $columns);
		}
		return $randomString;
	}

	return $randomString;
}
const SHAREABLE_LINKS = 'sharable-links';
function generateShareableLink($shareableType): string
{
	$shareableUrl = SHAREABLE_LINKS;
	return Request()->root() . '/' . App()->getLocale() . '/' . $shareableUrl . '/' . $shareableType . '/' . generateUniqueStringOfLengthTo(30, 'SharingLink', ['link']);
}
function camel2dashed($className)
{
	return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
}
function getLastWordInString(string $str, $separator = '/')
{
	$explodedStr = explode($separator, $str);
	return $explodedStr[count($explodedStr) - 1];
}
function getExcelFieldsForModel($modelName): Collection
{
	return TablesField::where('TablesField', $modelName)->get();
}
function generateDatesBetweenTwoDates(Carbon $start_date, Carbon $end_date, $method = 'addMonth', $format = 'Y-m-d', $indexedArray = true, $indexFormat = "Y-m-d")
{
	$dates = [];

	for ($date = $start_date->copy(); $date->lte($end_date); $date->{$method}()) {
		if ($indexedArray) {
			$dates[] = $date->format($format);
		} else {
			$dates[$date->format($indexFormat)] = $date->format($format);
		}
	}

	return $dates;
}

function getMonthsForSelect(): array
{
	$months = [

		'january' => [
			'value'=>"01",
			"title"=>__('Jan') 
		], 'february' => 
		[
			'value'=>'02',
			'title'=>__('Feb') 
		]
		, "march" => [
			'value'=>'03',
			'title'=>__('Mar') 
		], "april" => [
			'title'=>__('Apr') ,
			'value'=>"04"
		], "may" => [
			'title'=>__('May'),
			'value'=>"05"
		], "june" => [
			'title'=>__('Jun') ,
			'value'=>"06"
		], 'July' => [
			'title'=>__('Jul') ,
			'value'=>"07"
		],
		'august' => [
			'title'=>__('Aug'),
			'value'=>"08"
		], 'september' => [
			'title'=>__('Sep') ,
			'value'=>"09"
		], "october" => [
			'title'=>__('Oct') ,
			'value'=>"10"
		], "november" => [
			'title'=>__('Nov') ,
			'value'=>"11"
		], "december" => [
			'title'=>__('Dec') ,
			'value'=>"12"
		]
	];
	return $months ; 
	// foreach ($months as $monthName => $monthNameFormatted) {
	// 	$formattedMonths[$monthName] = ['title' => $monthNameFormatted, 'value' => $monthName];
	// }
	// return $formattedMonths;
}
function getFinancialMonthsForSelect(): array
{
	$formattedMonths = [];
	$months = [

		'january' => __('January'), "april" => __('April'), 'july' => __('July')
	];
	foreach ($months as $monthName => $monthNameFormatted) {
		$formattedMonths[$monthName] = ['title' => $monthNameFormatted, 'value' => $monthName];
	}
	return $formattedMonths;
}
function getSalesChannelsForSelection()
{
	$formattedMonths = [];
	return
		[
			[
				'title' => __('Direct Reservations'),
				'value' => 'direct-reservations'
			],
			[
				'title' => __('Travel Agency'),
				'value' => 'travel-agency'
			],
			[
				'title' => __('Online Booking Engine'),
				'value' => 'online-booking-engine'
			],
			[
				'title' => __('Corporates'),
				'value' => 'corporates',

			],
			[
				'title' => __('Others Channels'),
				'value' => 'others-channels'
			]

		];
}
function getSalesChannelsForSelectionForFb()
{

	return
		[
			[
				'title' => __('Sit-down'),
				'value' => 'Sit-down'
			],
			[
				'title' => __('Takeaway'),
				'value' => 'takeaway'
			],
			[
				'title' => __('Online'),
				'value' => 'online'
			],
			[
				'title' => __('Distribution'),
				'value' => 'distribution',

			],
			[
				'title' => __('Catering'),
				'value' => 'catering'
			]

		];
}
function getRoomsTypes(bool $onlyTotal = false ): array
{
	$rooms = [
		0=> [
			'title'=>__('Total Rooms'),
			'value'=>0
		],
		1 => [
			'title' => __('Standard Room'),
			'value' => 1
		],
		2=> [
			'title' => __('Standard Single Room'),
			'value' => 2
		],
		3=> [
			'title' => __('Standard Double Room'),
			'value' => 30
		],
		4 => [
			'title' => __('Deluxe Room'),
			'value' => 4
		],
		5 => [
			'title' => __('Deluxe Single Room'),
			'value' => 5
		],
		6 => [
			'title' => __('Deluxe Double Room'),
			'value' => 6
		],
		7 => [
			'title' => __('Premier Room'),
			'value' => 7
		],
		8 => [
			'title' => __('Premier Single Room'),
			'value' => 8
		],
		9 => [
			'title' => __('Premier Double Room'),
			'value' => 9
		],
		10 => [
			'title' => __('Junior Suite'),
			'value' => 10
		],
		11 => [
			'title' => __('Regular Suite'),
			'value' => 11
		],
		12 => [
			'title' => __('Presidential Suite'),
			'value' => 12
		],
		13 => [
			'title' => __('Royal Suite'),
			'value' => 13
		],




	];
	if($onlyTotal){
		unset($rooms[0]);
	}
	return $rooms;
}
function getFoodsTypes(bool $onlyTotal = false )
{
	$foods =  [
		0 => [
			'title' => __('Total F&B Facility'),
			'value' => 0
		],
		1 => [
			'title' => __('Restaurant'),
			'value' => 1
		],
		
		2 => [
			'title' => __('Lobby Lounge & Bar'),
			'value' => 2
		],
		3 => [
			'title' => __('Café'),
			'value' => 3
		]
		
	];
	
		if($onlyTotal){
			unset($foods[0]);
		}
		return $foods ;
	
}
function getCasinoTypes(bool $onlyTotal = false)
{
	$casinos =  [
		0 => [
			'title' => __('Total Gaming Facilities'),
			'value' => 0
		],
		1 => [
			'title' => __('Large Gaming Hall'),
			'value' => 1
		],
		2 => [
			'title' => __('Small Gaming Hall'),
			'value' => 2
		]
	];
	
	if($onlyTotal){
		unset($casinos[0]);
	}
	return $casinos ;
	
}
function getMeetingTypes(bool $onlyTotal = false)
{
	$meetings =  [
		0 => [
			'title' => __('Total Meeting Spaces Facilities'),
			'value' => 0
		],
		1 => [
			'title' => __('Wedding Halls'),
			'value' => 1
		],
		2 => [
			'title' => __('Meeting Rooms'),
			'value' => 2
		],

	];
	
	if($onlyTotal){
		unset($meetings[0]);
	}
	return $meetings ;
}
function getOtherTypes(bool $onlyTotal = false): array
{
	$others =  [
		0 => [
			'title' => __('Total Other Revenues Facilities'),
			'value' => 0
		],
		1 => [
			'title' => __('GYM & SPA'),
			'value' => 1
		],
		2 => [
			'title' => __('Laundry'),
			'value' => 2
		],
		3 => [
			'title' => __('Commercial Shops'),
			'value' => 3
		]
	];
	
	if($onlyTotal){
		unset($others[0]);
	}
	return $others ;
}
function formatDurationFromStudyStartDateToStudyEndDate(string $studyStartDate, string $studyEndDate, string $studyDurationInYears, string $operationStartDate)
{
	$calculateDurationService = new CalculateDurationService();
	$operationDurationPerYear = $calculateDurationService->calculateMonthsDurationPerYear($operationStartDate, $studyEndDate, $studyDurationInYears);
	$studyDurationPerYear = $calculateDurationService->calculateMonthsDurationPerYear($studyStartDate, $studyEndDate, $studyDurationInYears);
}

function sumNumberOfOnes(array $items, int $year,array $datesIndexWithYearIndex)
{

	$counter = [];
	foreach ($items as $loopYear => $dateAndValues) {
		foreach ($dateAndValues as $dateIndex => $value) {
			$loopYear = $datesIndexWithYearIndex[$dateIndex];
			if ($value == 1) {
				$counter[$loopYear] = isset($counter[$loopYear]) ? $counter[$loopYear] + 1 : $value;
			}
		}
	}
	return $counter[$year] ?? 0;
}
function getDurationIntervalTypesForSelect(): array
{
	return [
		[
			'value' => 'monthly',
			'title' => __('Monthly')
		],
		[
			'value' => 'quarterly',
			'title' => __('Quarterly')
		],
		[
			'value' => 'semi-annually',
			'title' => __('Semi Annually')
		],
		[
			'value' => 'annually',
			'title' => __('Annually')
		],
	];
}
function getFlatSeasonality():float
{
	return 1/12 ;
}
function quartersNames()
{
	return [
		'quarter-one'=>__('Quarter One'),
		'quarter-two'=>__('Quarter Two'),
		'quarter-three'=>__('Quarter Three'),
		'quarter-four'=>__('Quarter Four'),
	];
}
function convertJsonToArray($jsonString)
{
	if(!$jsonString){
		return [];
	}
	if(is_array($jsonString)){
		return $jsonString;
	}
	return (array) json_decode($jsonString);
}
function convertArrayToJson(?array $item):?string  
{
	if(is_array($item)){
		return json_encode($item);
	}
	return null ;	
}


function unformat_number($money)
{
    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

    return (float) str_replace(',', '.', $removedThousandSeparator);
}
function dueInDays()
{
	return [
		0,15,30,45,60,75,90,120,150,180
	];
}
function dueInDaysInAcquisition()
{
	return [
		0=>0,
		30=> '1 Month',
		60=>'2 Months',
		90=>'3 Months',
		120=>'4 Months',
		150=>'5 Months',
		180=>'6 Months',
		270=>'9 Months',
		360=>'12 Months'
	];
}
// function generateTotalRoomInstance($hospitalitySector)
// {
// 	$room = new Room();
// 	$room->id = 0 ;
// 	$room->room_type_id = 0 ;
// 	$room->room_count = $hospitalitySector->rooms_count?:0 ;
// 	$room->guest_per_room = $hospitalitySector->average_guest_count?:0 ;
// 	$room->seasonality = $hospitalitySector->general_seasonality;
// 	return collect([$room]);
	
// }
function generateTotalCasinoInstance($hospitalitySector)
{
	$casino = new Casino();
	$casino->id = 0 ;
	$casino->casino_type_id = 0 ;
	$casino->casino_count = $hospitalitySector->casinos_count?:0 ;
	return collect([$casino]);
	
}
 function generateTotalOtherInstance($hospitalitySector)
{
	$other = new Other();
	$other->id = 0 ;
	$other->other_type_id = 0 ;
	$other->other_count = $hospitalitySector->others_count?:0 ;
	$other->guest_per_other = $hospitalitySector->average_guest_count?:0 ;
	// $other->seasonality = $hospitalitySector->general_seasonality;
	return collect([$other]);	
}
// function generateTotalFoodInstance(HospitalitySector $hospitalitySector)
// {
// 	$food = new Food();
// 	$food->id = 0 ;
// 	$food->food_type_id = 0 ;
// 	$food->food_count = $hospitalitySector['total_f&b_facility_count']?:0 ;
// 	$food->food_cover = $hospitalitySector['total_f&b_cover_count']?:0 ;
// 	$food->hospitality_sector_id = $hospitalitySector->id;
// 	return collect([$food]); 
// }
function generateTotalMeetingInstance(HospitalitySector $hospitalitySector)
{
	$meeting = new Meeting();
	$meeting->id = 0 ;
	$meeting->meeting_type_id = 0 ;
	$meeting->meeting_count = $hospitalitySector['total_f&b_facility_count']?:0 ;
	$meeting->meeting_cover = $hospitalitySector['total_f&b_cover_count']?:0 ;
	$meeting->hospitality_sector_id = $hospitalitySector->id;
	return collect([$meeting]); 
}


function getAmount($str)
{
    return preg_replace("/([^0-9\\.])/i", "", $str);
}
function getMonthNumberFromDate(string $date){
	// 01-01-2023
	// return 08 for august
		if(Str::contains($date,'-')){
			return explode('-',$date)[1] ;
		}
		throw new \Exception('Custom Exception .. Invalid Date String Format .. [ ' . $date . ' ] Passed And Expected ' . 'dd-mm-yyyy');
		
	
	// return  ;
	// 
}

function getYearFromDate(string $date)
{
	return explode('-',$date)[2];	
}
function getDayFromDate(string $date){
	return explode('-',$date)[0];
}
function getMonthFromDate(string $date){
	return explode('-',$date)[1];
}
function sumAllOfDates(array $items)
{
	$result = [];
	foreach($items as $id=>$datesAndValues){
		foreach($datesAndValues as $date=>$value)
		{
			$result[$date] = isset($result[$date]) ? $result[$date]+ $value : $value ;  
		}
	}
	return $result ;
}

function applyInflationRate(float $base , float $percentage ,float $power)
{
	return $base * pow( 1+($percentage / 100) , $power);
}
function getValueOfFirstKey(array $items , $makeArrayKeysAsValues=true):array 
{
	$firstKeyAtArray = array_keys($items)[0]??null;
	if(is_null($firstKeyAtArray)){
		return [];
	}
	if($makeArrayKeysAsValues){
		return array_keys($items[$firstKeyAtArray]);	
	}
	return $items[$firstKeyAtArray] ;
	
}
function extraKeysFromTwoDimArr(array $items , $key):array 
{
	$result=[];
	foreach($items as $item){
		if(isset($item[$key]) && is_numeric($item[$key]) || $key == 'name'){
			$result[]=$item[$key];	
		}else{
			$result[]=0;	
		}
	}
	return $result ; 
}
function searchKeyFromTwoDimArray($items , $searchKey , $searchValue):array {
	
	foreach($items as $index=>$values){
		foreach($values as $key=>$value){
			if($key == $searchKey && $searchValue == $value){
				return $values ;
			}		
		}
	}
	return [];
}
function sumForEachYear(array $items,array $datesIndexWithYearIndex)
{
	// pass -1 to $hospitalitySector if non
	
	$result = [];

		foreach($items as $date=>$value){
			if($date != 'subItems' && $date != 'total'){
				$year = $datesIndexWithYearIndex[$date];
				$result[$year] = isset($result[$year]) ? $result[$year] + $value : $value ;
			}
		}
	return $result;
}
function getMaxNumberOfArray(array $items)
{
	return array_slice($items , 0 , 5,true);
}
function getMaxNumberFromFirstArray(array $items,$length)
{
	return array_slice($items , 0 , $length,true);
}
function formatDateForView(string $date)
{
	return Carbon::make($date)->format('M\'Y') ;
}
function lastSegmentInRequest()
{
	$segments=  Request()->segments() ;
	return explode('-',$segments[count($segments) - 1 ])[0];
}
function getYearsFromDates(array $dates)
{
	
	$result = [];
	foreach($dates as $date)
	{
		$year = getYearFromDate($date);
		$result[$year] = $year ;
	}
	$result = array_values($result);
	// $message = microtime(true)-$x;
	// Log::info($message);
	return $result;
}
function removeFirstLevelKeysFromArray(array $items)
{
	$result = [];
	foreach($items as $key => $values)
	{
		foreach($values as $k=>$v){
			$result[$k]=$v;
		}
	}
	return array_keys($result);
}
function getTotalOfArraysOf2Depth(array $items,bool $debug =false )
{
	$totalAtDates = [];
	foreach($items as $identifier=>$dateAndValues)
	{
		if(!is_iterable($dateAndValues)){
			dd('e',$items,debug_backtrace()[1]['function']);
		}
		// if($debug){
		// 	dump('before',$dateAndValues);
		// }
		ksort($dateAndValues);
		
		foreach($dateAndValues as $date=>$value){
			if(is_numeric($value)){
				$totalAtDates[$date] = isset($totalAtDates[$date]) ? $totalAtDates[$date] + $value : $value ; 
			}
		}
	}
	return $totalAtDates;
}
function getTotalOfArraysOf3Depth(array $items){
	$totalAtDates = [];
		foreach($items as $identifiersWithValues){
			foreach($identifiersWithValues as $identifier =>$dateValues){
				foreach($dateValues as $date => $value){
					if(is_numeric($value)){
						$totalAtDates[$date] = isset($totalAtDates[$date]) ? $totalAtDates[$date] + $value : $value ; 
					}
				}
			}

	}
	return $totalAtDates;
}

function getTotalOfArraysOf4Depth(array $items){
	$totalAtDates = [];
	foreach($items as $name=>$dateAndValues)
	{
		foreach($dateAndValues as $identifiersWithValues){
			foreach($identifiersWithValues as $identifier =>$dateValues){
				foreach($dateValues as $date => $value){
					if(is_numeric($value)){
						$totalAtDates[$date] = isset($totalAtDates[$date]) ? $totalAtDates[$date] + $value : $value ; 
					}
				}
			}

		}
	}
	return $totalAtDates;
}
function sortDatesAsIndex(array $payload  ){
	uksort($payload,'date_compare');
	return $payload ; 
}

function date_compare($a, $b)
{
    $t1 = strtotime($a);
    $t2 = strtotime($b);
    return $t1 - $t2;
}  
function repeatLastKeyForUnExistingKeysIn(array $payload , array $dates)
{
	
	if(!count($payload)){
		return [];
	}
	$repeatedArray = [];
	$lastIndex = array_key_last($payload);
	$lastValue = $payload[$lastIndex];
	$dates = makeArrayKeysEqualToIndexes($dates);
	foreach($dates as $index=>$dateAsIndex)
	{
		if(isset($payload[$index]))
		{
			$repeatedArray[$index] = $payload[$index];
		}
		elseif($index > $lastIndex){
			$repeatedArray[$dateAsIndex] = $lastValue;
		}
	
	}
	return $repeatedArray;
}
function totalOf5Arr(array $totalRoomsRevenue , array $totalFAndBFacilityRevenue,array $totalCasinoFacilityRevenue,array $totalMeetingFacilityRevenue,array $totalOtherFacilityRevenue,array $dates):array
{
	$result = [];
	foreach($dates as $date)
	{
		$totalOfRoomAtDate = $totalRoomsRevenue[$date] ?? 0 ;
		$totalOfFoodsAtDate = $totalFAndBFacilityRevenue[$date] ?? 0 ;
		$totalOfGamingsAtDate = $totalCasinoFacilityRevenue[$date] ?? 0 ;
		$totalOfMeetingsAtDate = $totalMeetingFacilityRevenue[$date] ?? 0 ;
		$totalOfOtherRevenueAtDate = $totalOtherFacilityRevenue[$date] ?? 0 ;
		$result[$date] =$totalOfRoomAtDate + $totalOfFoodsAtDate + $totalOfGamingsAtDate + $totalOfMeetingsAtDate + $totalOfOtherRevenueAtDate ;
		
	}	
	return $result ;
}
// function multiplyWith(array $items , array $zerosAndOnes , array $datesIndexWithYearIndex)
// {
// 	$result = [];
// 	foreach($items as $identifier => $datesAndValues){
// 		foreach($datesAndValues as $date=>$value)
// 		{
// 			$year = $datesIndexWithYearIndex[$date];
// 			$zeroOrOne = $zerosAndOnes[$year][$date] ?? 0 ;
// 			$result[$identifier][$date] = $value * $zeroOrOne ;
// 		}
// 	}
// 	return $result ;
// }
function arrayToValueIndexes(?array $items):array 
{
	
	if($items && count($items)){
		return $items ;
	}
	return [];
}
function isLoanRoute()
{
	$requestName = Request()->route()->getName() ;
	
	return str_contains($requestName , 'loan.')||str_contains($requestName , 'calc.interest.percentage') ;
}
function repeatJson($jsonItems )
{


	$itemsArray = convertJsonToArray($jsonItems);
	if(!count($itemsArray)){
		return null ;
	}
	$lastKey = array_key_last($itemsArray);
	$loopingKey = $lastKey+1;
	for($loopingKey ; $loopingKey < MAX_YEARS_COUNT ; $loopingKey++){
		$itemsArray[$loopingKey] =$itemsArray[$lastKey];  
	}
	return json_encode($itemsArray);
}
function getTotalOfTwoDimArr(array $items){
	$totals = [] ;
	foreach($items as $key=>$datesAndValues){
		foreach($datesAndValues as $date=>$value){
			$totals[$date] = isset($totals[$date]) ? $totals[$date] + $value : $value ; 			
		}
	}
	return $totals ; 
}

function  sumSecondKeyInThreeDimArr(array $items){

	$result = [];
	foreach($items as $identifier => $intervalWithItems){
		foreach($intervalWithItems as $intervalName => $reportTypeWithDatesAndValues){
			foreach($reportTypeWithDatesAndValues as $reportType => $datesAndValues){
				foreach($datesAndValues as $date=>$value){
					$result[$intervalName][$reportType][$date] = isset($result[$intervalName][$reportType][$date]) ? $result[$intervalName][$reportType][$date] + $value : $value ;
				}
			}
		}
	}
	return $result ;
}
function  sumSecondKeyInFourDimArr(array $arrayOfItems){
	$result = [];
	
	foreach($arrayOfItems as $name => $items){
		
		foreach($items as $itemKeyName => $reportNameWithItsDatesAndValues){
			if($itemKeyName == 'intervalsReport'){
				foreach($reportNameWithItsDatesAndValues as $quarterName => $reportItems){
					foreach($reportItems as $reportName => $values){
						foreach($values as $date => $value){
									
							$result['intervalsReport'][$quarterName][$reportName][$date] = isset($result['intervalsReport'][$quarterName][$reportName][$date]) ? $result['intervalsReport'][$quarterName][$reportName][$date] + $value : $value ;
						}
					}
				}
					
			}
			
		}
	}
	return $result;
}
function getLandPaymentMethod():array 
{
	return [
		'cash'=>__('Cash'),
		'installment'=>__('Installment'),
		'customize'=>__('Customize')
	];
}
function getPropertyPaymentMethod():array 
{
	return [
		'cash'=>__('Cash'),
		'installment'=>__('Installment'),
		'customize'=>__('Customize')
	];
}
function getHardExecutionMethod():array 
{
	return [
		'straight-line'=>__('Straight Line'),
		's-curve'=>__('S-Curve')
	];
}
function getSoftExecutionMethod():array 
{
	return [
	'straight-line'=>__('Straight Line'),
	'steady-growth'=>__('Steady Growth'),
	'steady-decline'=>__('Steady Decline'),
];
	
}
function getFFEExecutionMethod():array 
{
	return [
		'straight-line'=>__('Straight Line'),
		's-curve'=>__('S-Curve'),
		'steady-growth'=>__('Steady Growth'),
		'steady-decline'=>__('Steady Decline'),
	];	
}
function getPreviousDate(?array $array, ?string $date, $datesExistsAsKeys = true)
{

	$searched = array_search($date, $datesExistsAsKeys ? array_keys($array) : $array);
	$arrayPlusOne = $datesExistsAsKeys ? @array_keys($array)[$searched - 1] : @($array)[$searched - 1];
	if ($searched !== null &&  isset($arrayPlusOne)) {
		return $datesExistsAsKeys ? array_keys($array)[$searched - 1] : ($array)[$searched - 1];
	}
	return null;
}
function getNextDate(?array $array, ?string $date, $datesExistsAsKeys = true)
{

	$searched = array_search($date, $datesExistsAsKeys ? array_keys($array) : $array);
	$arrayPlusOne = $datesExistsAsKeys ? @array_keys($array)[$searched +1] : @($array)[$searched +1];
	if ($searched !== null &&  isset($arrayPlusOne)) {
		return $datesExistsAsKeys ? array_keys($array)[$searched +1] : ($array)[$searched +1];
	}
	return null;
}
	function getDifferenceBetweenTwoDatesInDays(Carbon $firstDate, Carbon $secondDate)
	{
		return $secondDate->diffInDays($firstDate);
	}
	
function array_pluck_total_key_then_rename_it(array $items,string $newSubKeyName ){
	/**
	 * * $key => ['room','food',..etc]
	 */
	$newItems = [];
	foreach($items as $key=>$itemArray){
		foreach($itemArray as $totalKeyName=>$dateAndValues){
			$newItems[$key][$newSubKeyName] = $dateAndValues;
		}
	}
	return $newItems;
}
function arrayMergeTwoDimArray(...$args)
{
	$mergedArray = [];
	foreach($args as $index=>$array){
		foreach($array as $key=>$values){
				$mergedArray[$key] = $values;
		}
	}
	return $mergedArray ;
}
function formatDateForInput(?string $date)
{
	if(!$date){
		return null ;
	}
	return Carbon::make($date)->format('m/d/Y');
}
function getMonthNumberFromMonthFullName($fullMonthName): ?string
{
	$months = [

		'january' => [
			'value'=>"01",
			"title"=>__('Jan') 
		], 'february' => 
		[
			'value'=>'02',
			'title'=>__('Feb') 
		]
		, "march" => [
			'value'=>'03',
			'title'=>__('Mar') 
		], "april" => [
			'title'=>__('Apr') ,
			'value'=>"04"
		], "may" => [
			'title'=>__('May'),
			'value'=>"05"
		], "june" => [
			'title'=>__('Jun') ,
			'value'=>"06"
		], 'July' => [
			'title'=>__('Jul') ,
			'value'=>"07"
		],
		'august' => [
			'title'=>__('Aug'),
			'value'=>"08"
		], 'september' => [
			'title'=>__('Sep') ,
			'value'=>"09"
		], "october" => [
			'title'=>__('Oct') ,
			'value'=>"10"
		], "november" => [
			'title'=>__('Nov') ,
			'value'=>"11"
		], "december" => [
			'title'=>__('Dec') ,
			'value'=>"12"
		]
	];
	return $months[$fullMonthName]['value'] ??null ; 
	
}
function getMonthsArray(): array 
{
	return [

		'january' => [
			'value'=>"01",
			"title"=>__('Jan') 
		], 'february' => 
		[
			'value'=>'02',
			'title'=>__('Feb') 
		]
		, "march" => [
			'value'=>'03',
			'title'=>__('Mar') 
		], "april" => [
			'title'=>__('Apr') ,
			'value'=>"04"
		], "may" => [
			'title'=>__('May'),
			'value'=>"05"
		], "june" => [
			'title'=>__('Jun') ,
			'value'=>"06"
		], 'July' => [
			'title'=>__('Jul') ,
			'value'=>"07"
		],
		'august' => [
			'title'=>__('Aug'),
			'value'=>"08"
		], 'september' => [
			'title'=>__('Sep') ,
			'value'=>"09"
		], "october" => [
			'title'=>__('Oct') ,
			'value'=>"10"
		], "november" => [
			'title'=>__('Nov') ,
			'value'=>"11"
		], "december" => [
			'title'=>__('Dec') ,
			'value'=>"12"
		]
	];
	
}

function sort_date($a, $b) {
    return \DateTime::createFromFormat('m-d-Y', $a) <=> \DateTime::createFromFormat('m-d-Y', $b);
}

function isValidDateFormat($date)
{
	if(is_null($date)){
		return false ;
	}
	return isset(explode('-',$date)[2]) && !isset(explode('-',$date)[3]);
	
}
function getDateFromTwoArrays(array $first,array $second)
{
	return array_values(array_unique(array_merge(array_keys($first),array_keys($second))));
}
function getDateFromThreeArrays(array $first,array $second,array $third)
{
	return array_values(array_unique(array_merge(array_keys($first),array_keys($second),array_keys($third))));
}
function subtractTwoArray(array $first , array $second)
{
	$result  =[ ];
	$dates =getDateFromTwoArrays($first,$second);
	//  array_values(array_unique(array_merge(array_keys($first),array_keys($second))));
	if(!count($dates)){
		return [];
	}
	$firstIndex = Arr::first($dates);
	if(is_numeric($firstIndex)){
		asort($dates);
	}
	elseif(isValidDateFormat($firstIndex))
	{
		usort($dates, "sort_date");
	}
	foreach($dates as $date)
	{
		if(is_numeric($date)){
			$secondVal = $second[$date] ?? 0;
			$value = $first[$date] ?? 0;
			$result[$date] = $value  - $secondVal ;
		}
	}
	return $result ; 
}
 function isTotal(Collection $items)
{
	return $items && count($items) && $items->first()->getTypeId() == 0 ;
}
function convertZeroToTotalString($str)
{
	return $str == 0  ? __('Total') : $str ; 
}
function removeTotalTableIfFirstIsZero(array $items)
{
	$newItems = [];
	if(count($items) && $items[0] == 0)
	{
		$newItems[0] = 0 ;
	}else{
		$newItems = $items; 
	}
	return $newItems ;
	  
}
/**
 * remove single key from array 
 *
 * @param array $items ['key'=>'value'] one dim array 
 * @param string $keyName 
 * @return array 
 */
function removeKeyFromArray(array $items  , string $keyName ):array 
{
	$newItems = [];
	foreach($items as $key=>$value)
	{
		if($key != $keyName){
			$newItems[$key]=$value;
		}
	}
	return $newItems ; 
}

function sumTwoArray(array $first , array $second)
{
	$result  =[];
	$dates = array_values(array_unique(array_merge(array_keys($first),array_keys($second))));
	foreach($dates as $date)
	{
			$secondVal = $second[$date] ?? 0;
			$value = $first[$date] ?? 0;
			$result[$date] = $value  + $secondVal ;
	}
	return $result ; 
}


function sumFourArray(array $first , array $second,array $third,array $fourth)
{
	
	$result  =[];
	$dates = array_values(array_unique(array_merge(array_keys($first),array_keys($second),array_keys($third),array_keys($fourth))));
	foreach($dates as $date)
	{

			$secondVal = $second[$date] ?? 0;
			$thirdVal = $third[$date] ?? 0;
			$fourthVal =$fourth[$date] ?? 0;
			$value = $first[$date] ?? 0;
			$result[$date] = $value  + $secondVal+$thirdVal+$fourthVal ;
	}
	return $result ; 
}


function sumFiveArrays(array $first , array $second,array $third,array $fourth,array $fifth)
{
	
	$result  =[];
	$dates = array_values(array_unique(array_merge(array_keys($first),array_keys($second),array_keys($third),array_keys($fourth),array_keys($fifth))));
	foreach($dates as $date)
	{
			$secondVal = $second[$date] ?? 0;
			$thirdVal = $third[$date] ?? 0;
			$fourthVal =$fourth[$date] ?? 0;
			$fifthVal =$fifth[$date] ?? 0;
			$value = $first[$date] ?? 0;
			$result[$date] = $value  + $secondVal+$thirdVal+$fourthVal+$fifthVal ;
	}
	return $result ; 
}


function sumSixArrays(array $first , array $second,array $third,array $fourth,array $fifth,array $sixth)
{
	
	$result  =[];
	$dates = array_values(array_unique(array_merge(array_keys($first),array_keys($second),array_keys($third),array_keys($fourth),array_keys($fifth),array_keys($sixth))));
	foreach($dates as $date)
	{
			$secondVal = $second[$date] ?? 0;
			$thirdVal = $third[$date] ?? 0;
			$fourthVal =$fourth[$date] ?? 0;
			$fifthVal =$fifth[$date] ?? 0;
			$sixthVal =$sixth[$date] ?? 0;
			$value = $first[$date] ?? 0;
			$result[$date] = $value  + $secondVal+$thirdVal+$fourthVal+$fifthVal+$sixthVal ;
	}
	return $result ; 
}



function getIntervalFormatted():array 
{
	return ['monthly'=>__('Monthly'),'quarterly'=>__('Quarterly'),'semi-annually'=>__('Semi-annually'),'annually'=>__('Annually')];
}

function getIntervalOnlyMonthlyAndAnnuallyFormatted():array 
{
	return ['monthly'=>__('Monthly'),'annually'=>__('Annually')];
}

function formatDataForChart(array $reportDateAndValueArray , bool $indexIsOnlyYear = false , bool $includeGrowthRate = true , bool $includePercentageFromRevenue =false , array $totalHotelRevenue =[] ): array
{
	$formattedReport = [];
	foreach ($reportDateAndValueArray as $date => $value) {
		
		$previousDate = getPreviousDate($reportDateAndValueArray, $date);
		$previousMonthSales = $previousDate  ? $reportDateAndValueArray[$previousDate] : 0;
		$growthRate = [];
		$percentagesFromRevenue = [];
		$valueAndDate = [
			'Value' =>  $value ?? 0,
			'date' => $date = $indexIsOnlyYear ? Carbon::make('01-01-'.$date)->format('d-M-Y') : Carbon::make($date)->format('d-M-Y'),
			
		];
		if($includeGrowthRate){
			$growthRate = [
				'Growth %' => $previousDate && $previousMonthSales ?  number_format(($value - $previousMonthSales)  / ($previousMonthSales? $previousMonthSales:1) * 100, 2) : 0
			];
		}
		if($includePercentageFromRevenue){
			$dateAsString = Carbon::make($date)->format('d-m-Y') ;
			$totalHotelRevenueAtDate = $totalHotelRevenue[$dateAsString] ?? 0;
			$percentage = ($totalHotelRevenueAtDate ? $value / $totalHotelRevenueAtDate : 0 )*100; 
			$percentagesFromRevenue = [
				'% From Revenue' => number_format( $percentage ,2) 
			];
		}
		$formattedReport[] = array_merge(
			$valueAndDate,
			$growthRate,
			$percentagesFromRevenue
				);
	}
	return $formattedReport;
}

function formatAccumulatedDataForChart(array $items)
{
	$result =[];
	$index = 0 ;
	foreach($items as $date=>$value){
		$previousValue = $result[$index-1]['Value'] ??0 ;
		$currentVal = $previousValue + $value ; 
		$result[$index] = [
			'Value'=>$currentVal,
			'date'=>Carbon::make($date)->format('Y-m-d')
		];
		$index++;
	}
	return $result;
}

function getPropertyAcquisitionNameForIndex(int $index = null)
{
	$propertyBreakDown =   [
		__('Land Cost'),
		__('Building Cost'),
		__('Furniture, Fixture & Equipment Cost')
	];
	return is_null($index) ? $propertyBreakDown : $propertyBreakDown[$index]   ;
	
}
function getPropertyExpensesFroIndex(int $index):string 
{
	return [
		__('Property Taxes'),
		__('Property Insurance')
	][$index];
}
function getValueFromArrayStringAndIndex(array $items  , $dateAsString , $dateAsIndex,$defaultValue = 0)
{
	if(isset($items[$dateAsString])){
		return $items[$dateAsString];
	}
	if(isset($items[$dateAsIndex])){
		return $items[$dateAsIndex];
	}
	return $defaultValue ;
}
function sumIntervals(array $dateValues, string $intervalName,string $financialYearStartMonth,array $dateIndexWithDate ){
	return (new IntervalSummationOperations())->sumForInterval( $dateValues, $intervalName,$financialYearStartMonth,$dateIndexWithDate);
}
function intervalsEndBalance(array $dateValues,string $intervalName,string $financialYearStartMonth ,array $dateIndexWithDate ){
	return (new IntervalEndBalancesService())->__calculate( $dateValues, $financialYearStartMonth,$intervalName,$dateIndexWithDate);
}
function convertValuesToZero(array $items):array 
{
	$newItems = [];
	foreach($items as $date=>$value){
		$newItems[$date] = 0 ;
	}
	return $newItems ; 
}
function zeroValueForIndexesBeforeIndex(array $items  , $date)
	{
		if(!$date){
			return $items ; 
		}
		$date = Carbon::make($date);
		$result = [ ];
		foreach($items as $dateAsString=>$value){
			$currentDate = Carbon::make($dateAsString);
			if($currentDate->lessThanOrEqualTo($date)){
				$result[$dateAsString]=0;
			}else{
				$result[$dateAsString]=$value;
			}
		}
		return $result ;
	}
	
function formatStackedChart(array $items,array $datesIndexWithYearIndex,array $yearIndexWithYear)
{
	$chartData = [];
	$finalResult = [];

	foreach($items as $reportName => $reportDataAndValues){
		$chartData[$reportName] = sumForEachYear($reportDataAndValues,$datesIndexWithYearIndex) ;
	}

	$years = array_keys(Arr::first($chartData,null,[]));
	foreach($years as $yearAsIndex){
		$values = [];
		$index = 1 ;
		foreach($chartData as $reportName=>$yearWithValue){
			$currentValue = $yearWithValue[$yearAsIndex]??0 ;
			$values['value'.$index]= $currentValue /1000;
			$index++;
		}
			$finalResult[] = array_merge(
				
				['year'=> $yearIndexWithYear[$yearAsIndex] ],
				$values 
			) ;
	}	
	return $finalResult;
}
function sumTwoDimArr($items){
	$sum = 0 ;
	foreach($items as $item){
		foreach($item as $index =>$value){
			$sum += $value ;
		}
	}
	return $sum ;
}
function getMinAtEveryIndex(array $keyAndValues)
{
	$result = [];
	foreach($keyAndValues as $index=>$values)
	{
		$result[$index] = min($values);
	}
	return $result;
}
function eachIndexMinusPreviousIfNegative(array $items )
{
	$result = [];
	foreach($items as $index=>$value)
	{
		$previousIndex = getPreviousDate($items,$index);
		$previousValue  = $items[$previousIndex] ?? 0;
		$newValue = 0 ;
		if($value < 0){
			$newValue = ($value - $previousValue) * -1;
			if($newValue <0){
				$newValue = 0;	
			}
		}
		$result[$index] = $newValue ;
	}
	return $result ; 
}
function makeArrayKeysEqualToIndexes($arrItems)
{
	$result = [];
	foreach($arrItems as $key=>$item)
	{
		$result[$item] = $item ;
	}
	return $result ; 
}
function excludeUsers()
{
	return ['remonsamuel1@gmail.com'];
}
function getFinancialPlanDateInterval($financialPlan, $interval = 'Monthly', $format = 'd-m-Y')
{
	if (!$financialPlan) {
		return null;
	}

	$loopingIntervals = [
		'Monthly' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
		'Quarterly' => [3, 6, 9, 12],
		'Semi Annually' => [6, 12],
		'Annually' => [12]
	][$interval];

	$monthIndex = count(explode('-', $format)) == 2 ? 0 : 1;
	$dateBetweenInterval = generateDatesBetweenTwoDates(Carbon::make($financialPlan->start_date), Carbon::make($financialPlan->start_date)->addMonths($financialPlan->duration - 1), $format);
	$dateBetweenInterval = array_filter($dateBetweenInterval, function ($date) use ($loopingIntervals, $monthIndex) {
		$month = explode('-', $date)[$monthIndex];
		return in_array($month, $loopingIntervals);
	});

	return array_values($dateBetweenInterval);
}
function array_first($array, callable $callback = null, $default = null)
    {
        return Arr::first($array, $callback, $default);
    }
function getWeekDays()
{
	return array('friday'=>__('Friday'), 'saturday'=>__('Saturday'), 'sunday'=>__('Sunday'),'monday'=>__('Monday'), 'tuesday'=>__('Tuesday'), 'wednesday'=>__('Wednesday'), 'thursday'=>__('Thursday'));
}

function getWeekDaysFormatted()
{
	$daysFormatted = [];
	foreach(getWeekDays() as $dayName=>$dayFormatted){
		$daysFormatted[$dayName] =[
			'title'=>$dayFormatted , 
			'value'=>$dayName
		];
	}
	return $daysFormatted ;
}
function getItemsType():array 
{
	return [
		'processed'=>__('Processed'),
		'tradable'=>__('Tradable')
	];
}
function getSalesChannels()
{
	return [];
}
function getTypesForValues():array
{
    return [
        'fixed_monthly_repeating_amount'=>[
            'title'=>__('Fixed Monthly Repeating Amount'),
            'value'=>'fixed_monthly_repeating_amount',
        ],
        'varying_amount'=>[
            'title'=>__('Varying Amount'),
            'value'=>'varying_amount',
        ],
        'fixed_percentage_of_sales'=>[
            'title'=>__('Fixed Percentage Of Sales'),
            'value'=>'fixed_percentage_of_sales',
        ],
        'varying_percentage_of_sales'=>[
            'title'=>__('Varying Percentage Of Sales'),
            'value'=>'varying_percentage_of_sales',
        ],
        'fixed_cost_per_unit'=>[
            'title'=>__('Fixed Cost Per Unit'),
            'value'=>'fixed_cost_per_unit',
        ],
        'varying_cost_per_unit'=>[
            'title'=>__('Varying Cost Per Unit'),
            'value'=>'varying_cost_per_unit',
        ],
        'intervally_repeating_amount'=>[
            'title'=>__('Intervally Repeating Amount'),
            'value'=>'intervally_repeating_amount',
        ],
        'one_time_expense'=>[
            'title'=>__('One Time Expense'),
            'value'=>'one_time_expense',
        ],
        'expense_per_employee'=>[
            'title'=>__('Expense Per Employee'),
            'value'=>'expense_per_employee',
        ],
        
        
        
        
    ];
}
function getPaymentTerms(): array
{
    
    return [
        [
            'value' => 'customize',
            'title' => __('Customize')
        ],
        [
            'value' => 'cash',
            'title' => __('Cash')
        ],
        [
            'value' => 'quarterly',
            'title' => __('Quarterly')
        ],
        [
            'value' => 'semi-annually',
            'title' => __('Semi Annually')
        ],
        [
            'value' => 'annually',
            'title' => __('Annually')
        ],
    ];
}
function getDurationIntervalTypesForSelectExceptMonthly(): array
{
    return [
    
        [
            'value' => 'quarterly',
            'title' => __('Quarterly')
        ],
        [
            'value' => 'semi-annually',
            'title' => __('Semi Annually')
        ],
        [
            'value' => 'annually',
            'title' => __('Annually')
        ],
    ];
}function getRevenueStreamTypes(): array
{
    return [
        [
            'value' => 'service',
            'title' => __('Service')
        ],
        [
            'value' => 'trading',
            'title' => __('Trading')
        ],
        [
            'value' => 'manufacturing',
            'title' => __('Manufacturing')
        ]
    ];
}

function getPaymentIntervals(): array
{
    $elements = [];
    for($i = 2  ; $i<=12 ; $i++) {
        $elements[]=[
            'value' => $i,
            'title' => __('Every').' ' . $i  . ' ' . __('Months')
        ];
    }
    return $elements ;
}
function replaceSingleQuote($string)
{
    return str_replace("'", "\'", $string) ;
}
function replace_all_spacial_character_in_array_values(array $items)
{
    
    $newItems = [];
    foreach($items as $key => $value) {
        $newItems[$key]=$value ? str_replace(array('"', "'","\\"), ' ', $value) : $value;
    }
    return $newItems ;
}
function getAllocationsBases()
{
    return [];
}
function getConditionalToSelect()
{
    return
        [
            [
                'title' => __('Greater Than'),
                'value' => 'greater-than'
            ],
            [
                'title' => __('Greater Than Or Equal'),
                'value' => 'greater-than-or-equal'
            ],
            [
                'title' => __('Less Than'),
                'value' => 'less-than'
            ],
            [
                'title' => __('Less Than Or Equal'),
                'value' => 'less-than-or-equal'
            ],
            [
                'title'=>__('Between & Equal'),
                'value'=>'between-and-equal'
            ],
            [
                'title'=>__('Between'),
                'value'=>'between'
            ],
            [
                'title'=>__('Equal'),
                'value'=>'equal'
            ]

        ];
}

function getDueInDays()
{
    return [
        [
            'value'=>0 ,
            'title'=>0
        ],
        [
            'value'=>15 ,
            'title'=>15
        ],
        [
            'value'=>30,
            'title'=>30
        ],
        [
            'value'=>60,
            'title'=>60
        ],
        [
            'value'=>90 ,
            'title'=>90
        ],
        [
            'value'=> 120 ,
            'title'=>120
        ],
        [
            'value'=>150,
            'title'=>150
        ],
        [
            'value'=> 180 ,
            'title'=>180
        ]

    ];
}
function formatRatesWithDueDays(array $ratesAndDueDays): array
{
    $result = [];
    foreach ($ratesAndDueDays['due_in_days'] ?? [] as $index => $dueDay) {
        $rate = $ratesAndDueDays['rate'][$index] ?? 0;
        if ($rate) {
            if (isset($result[$dueDay])) {
                $result[$dueDay] += $rate;
            } else {
                $result[$dueDay] = $rate;
            }
        }
    }

    return $result;
}
function sumDueDayWithPayment($paymentRate, $dueDays)
{
    $items = [];
    // dd($dueDays);
    foreach($dueDays as $index=>$dueDay) {
        $currentPaymentRate = $paymentRate[$index]??0 ;
        $items[$dueDay] = isset($items[$dueDay]) ? $items[$dueDay] + $currentPaymentRate : $currentPaymentRate;
    }
    return $items;
}
function getDefaultSellingUOM()
{
	return [
		[
			'title'=>'Ton',
		'value'=>'Ton'
		],
		[
			'title'=>'Kg',
		'value'=>'Kg'
		],
		[
			'title'=>'gm',
			'value'=>'gm'
		],
		[
			'title'=>'Carton',
			'value'=>'carton'
		],
		[
			'title'=>'Box',
			'value'=>'box'
		],
		[
			'title'=>'Piece',
			'value'=>'piece'
		],
		[
			'title'=>'Barrel',
			'value'=>'barrel'
		],
		[
			'title'=>'Bottles',
			'value'=>'bottles'
		],
		[
			'title'=>'M2',
			'value'=>'m2'
		],
		[
			'title'=>'M3',
			'value'=>'m3'
		]
	];
}
function getSellingUOM()
{
	return getDefaultSellingUOM();
}
function getDefaultProductionUOM()
{
	return getProductionUOM();
}
function getProductionUOM():array 
{
	
	return [
		[
			'title'=>'Ton',
		'value'=>'Ton'
		],
		[
			'title'=>'Kg',
		'value'=>'Kg'
		],
		[
			'title'=>'gm',
			'value'=>'gm'
		],
		[
			'title'=>'Carton',
			'value'=>'carton'
		],
		[
			'title'=>'Box',
			'value'=>'box'
		],
		[
			'title'=>'Piece',
			'value'=>'piece'
		],
		[
			'title'=>'Barrel',
			'value'=>'barrel'
		],
		[
			'title'=>'Bottles',
			'value'=>'bottles'
		],
		[
			'title'=>'Meter square',
			'value'=>'meter-square'
		],
		[
			'title'=>'Meter cube',
			'value'=>'meter-cube'
		]
	];
	
}
function getInventoryCoverageDays()
{
	// 0,15,30,45,60,75,90,120,150,180
	return [
		[
			'title'=>0 ,
			'value'=>0
		],
		[
			'title'=>7 ,
			'value'=>7
		],
		[
			'title'=>15 ,
			'value'=>15
		],
		[
			'title'=>30 ,
			'value'=>30
		],
		[
			'title'=>45 ,
			'value'=>45
		],
		[
			'title'=>60 ,
			'value'=>60
		],
		[
			'title'=>75 ,
			'value'=>75
		],
		[
			'title'=>90 ,
			'value'=>90
		],
		[
			'title'=>120 ,
			'value'=>120
		],
		[
			'title'=>150 ,
			'value'=>150
		],
		[
			'title'=>180 ,
			'value'=>180
		],
	];
}
function cacheManpowerExpenseCount($cacheKey , $noExpenses)
{
	Cache::forever($cacheKey,$noExpenses);
	return $noExpenses;
}
function cacheManpowerExpenseRecruitDate($cacheKey,$recruitDate)
{
	
	Cache::forever($cacheKey,$recruitDate);
	return $recruitDate;
}
