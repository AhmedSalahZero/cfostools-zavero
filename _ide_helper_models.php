<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Acquisition
 *
 * @property int $id
 * @property string|null $land_installment_count
 * @property string|null $land_after_month
 * @property string|null $second_land_down_payment_percentage
 * @property string|null $first_land_down_payment_percentage
 * @property string|null $land_payment_method
 * @property string|null $land_contingency_rate
 * @property string|null $land_purchase_cost
 * @property string|null $purchase_date
 * @property string|null $land_equity_funding_rate
 * @property string|null $installment_interval
 * @property string|null $collection_policy_interval
 * @property string|null $collection_policy_type
 * @property string|null $collection_policy_value
 * @property int|null $hospitality_sector_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $has_land_section
 * @property string|null $hard_construction_contingency_rate
 * @property string|null $hard_construction_cost
 * @property string|null $has_hard_construction_cost_section
 * @property string|null $hard_construction_duration
 * @property string|null $hard_construction_start_date
 * @property string|null $hard_construction_end_date
 * @property string|null $hard_execution_method
 * @property string|null $hard_down_payment
 * @property string|null $hard_balance_rate_one
 * @property string|null $hard_balance_rate_two
 * @property string|null $hard_due_one
 * @property string|null $hard_due_two
 * @property string|null $hard_equity_funding
 * @property string|null $soft_due_two
 * @property string|null $soft_balance_rate_two
 * @property string|null $soft_due_one
 * @property string|null $soft_balance_rate_one
 * @property string|null $soft_down_payment
 * @property string|null $soft_construction_end_date
 * @property string|null $soft_execution_method
 * @property string|null $soft_construction_contingency_rate
 * @property string|null $soft_construction_cost
 * @property string|null $has_soft_construction_cost_section
 * @property string|null $soft_construction_duration
 * @property-read \App\Models\HospitalitySector|null $hospitalitySector
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SoftConstructionCost[] $softConstructionCosts
 * @property-read int|null $soft_construction_costs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereFirstLandDownPaymentPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardBalanceRateOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardBalanceRateTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardConstructionContingencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardConstructionCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardConstructionDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardConstructionEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardConstructionStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardDueOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardDueTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardEquityFunding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHardExecutionMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHasHardConstructionCostSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHasLandSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHasSoftConstructionCostSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereInstallmentInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereLandAfterMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereLandContingencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereLandEquityFundingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereLandInstallmentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereLandPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereLandPurchaseCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSecondLandDownPaymentPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftBalanceRateOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftBalanceRateTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftConstructionContingencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftConstructionCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftConstructionDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftConstructionEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftDueOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftDueTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereSoftExecutionMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Acquisition whereUpdatedAt($value)
 */
	class Acquisition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ActiveJob
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $status
 * @property string $model_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob company()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActiveJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ActiveJob extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AllocationSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting company()
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting query()
 * @mixin \Eloquent
 */
	class AllocationSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BusinessSector
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessSector whereUpdatedAt($value)
 */
	class BusinessSector extends \Eloquent implements \App\Interfaces\Models\IBaseModel {}
}

namespace App\Models{
/**
 * App\Models\CachingCompany
 *
 * @property int $id
 * @property int $company_id
 * @property int $job_id
 * @property string $key_name
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CachingCompany whereKeyName($value)
 * @mixin \Eloquent
 */
	class CachingCompany extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Casino
 *
 * @property int $id
 * @property int|null $casino_type_id
 * @property int|null $casino_count
 * @property string|null $f&b_facilities
 * @property int|null $casino_cover
 * @property int $hospitality_sector_id
 * @property array|null $percentage_from_rooms_revenues
 * @property string|null $collection_policy_type
 * @property string $collection_policy_value
 * @property string|null $collection_policy_interval
 * @property array|null $cover_per_day
 * @property array|null $guest_capture_cover_percentage
 * @property string|null $charges_value_at_operation_date
 * @property string|null $charges_value_escalation_rate
 * @property string|null $charges_value_annual_escalation_rate
 * @property string|null $chosen_casino_currency
 * @property string|null $cover_value
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\HospitalitySector $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|Casino newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Casino newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Casino query()
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCasinoCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCasinoCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCasinoTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereChargesValueAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereChargesValueAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereChargesValueEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereChosenCasinoCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCoverPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCoverValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereF&bFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereGuestCaptureCoverPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino wherePercentageFromRoomsRevenues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Casino whereUpdatedAt($value)
 */
	class Casino extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category company()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @mixin \Eloquent
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CollectionSetting
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $collection_base
 * @property array|null $general_collection
 * @property array|null $first_allocation_collection
 * @property array|null $second_allocation_collection
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting company()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereCollectionBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereFirstAllocationCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereGeneralCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereSecondAllocationCollection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CollectionSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CollectionSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Company
 *
 * @property int $id
 * @property array $name
 * @property string $sub_of
 * @property string $type
 * @property int $users_number
 * @property int|null $companies_number
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Company[] $RevenueBusinessLines
 * @property-read int|null $revenue_business_lines_count
 * @property-read mixed $branches_with_sections
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Company[] $subCompanies
 * @property-read int|null $sub_companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompaniesNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereSubOf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUsersNumber($value)
 * @mixin \Eloquent
 */
	class Company extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \App\Interfaces\Models\IHaveIdentifier, \App\Interfaces\Models\IHaveName {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name_en
 * @property string|null $name_ar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\State[] $states
 * @property-read int|null $states_count
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent implements \App\Interfaces\Models\IBaseModel {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $name
 * @property int $business_sector_id
 * @property string $type
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BusinessSector $businessSector
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereBusinessSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 */
	class Customer extends \Eloquent implements \App\Interfaces\Models\IBaseModel {}
}

namespace App\Models{
/**
 * App\Models\CustomersInvoice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice company()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|CustomersInvoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice query()
 * @method static \Illuminate\Database\Query\Builder|CustomersInvoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CustomersInvoice withoutTrashed()
 * @mixin \Eloquent
 */
	class CustomersInvoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomizedFieldsExportation
 *
 * @property int $id
 * @property array $fields
 * @property string $model_name
 * @property int $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation company()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomizedFieldsExportation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CustomizedFieldsExportation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepartmentExpense
 *
 * @property int $id
 * @property string|null $model_name
 * @property int|null $hospitality_sector_id
 * @property string|null $section_name
 * @property string|null $name
 * @property array|null $payload
 * @property array|null $manpower_payload
 * @property string|null $expense_per_night_sold
 * @property string|null $expense_per_guest
 * @property string|null $inventory_coverage_days
 * @property string|null $beginning_inventory_balance_value
 * @property string|null $cash_payment_percentage
 * @property string|null $deferred_payment_percentage
 * @property string|null $due_days
 * @property string|null $current_net_salary
 * @property string|null $chosen_currency
 * @property string|null $escalation_rate
 * @property string|null $net_salary_at_operation_date
 * @property string|null $annual_escalation_rate
 * @property string|null $salary_taxes
 * @property string|null $social_insurance
 * @property string|null $night_expense_escalation_rate
 * @property string|null $chosen_night_expense_currency
 * @property int|null $company_id
 * @property string|null $night_annual_escalation_rate
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $night_expense_at_operation_date
 * @property string|null $guest_annual_escalation_rate
 * @property string|null $guest_expense_at_operation_date
 * @property string|null $guest_expense_escalation_rate
 * @property string|null $expense_per_guest_sold
 * @property string|null $chosen_guest_expense_currency
 * @property string|null $opex_payment_terms
 * @property string|null $payment_month
 * @property string|null $percentage_from_fixed_assets
 * @property-read \App\Models\HospitalitySector|null $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereBeginningInventoryBalanceValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereCashPaymentPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereChosenCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereChosenGuestExpenseCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereChosenNightExpenseCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereCurrentNetSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereDeferredPaymentPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereDueDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereExpensePerGuest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereExpensePerGuestSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereExpensePerNightSold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereGuestAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereGuestExpenseAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereGuestExpenseEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereInventoryCoverageDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereManpowerPayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereNetSalaryAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereNightAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereNightExpenseAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereNightExpenseEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereOpexPaymentTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense wherePaymentMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense wherePercentageFromFixedAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereSalaryTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereSocialInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DepartmentExpense whereUpdatedAt($value)
 */
	class DepartmentExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DirectManpowerExpense
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $directManpowerExpensePositions
 * @property-read int|null $direct_manpower_expense_positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|DirectManpowerExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DirectManpowerExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DirectManpowerExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|DirectManpowerExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectManpowerExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DirectManpowerExpense whereUpdatedAt($value)
 */
	class DirectManpowerExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FFE
 *
 * @property int $id
 * @property int|null $hospitality_sector_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $duration
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $execution_method
 * @property string|null $down_payment
 * @property string|null $balance_rate_one
 * @property string|null $balance_rate_two
 * @property string|null $due_one
 * @property string|null $due_two
 * @property string|null $ffe_equity_funding
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FFEItem[] $ffeItems
 * @property-read int|null $ffe_items_count
 * @property-read \App\Models\HospitalitySector|null $hospitalitySector
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|FFE newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FFE newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FFE onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE query()
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereBalanceRateOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereBalanceRateTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereDueOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereDueTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereExecutionMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereFfeEquityFunding($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFE whereUpdatedAt($value)
 */
	class FFE extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FFEItem
 *
 * @property int $id
 * @property int|null $hospitality_sector_id
 * @property int|null $ffe_id
 * @property string|null $section_name
 * @property string|null $model_name
 * @property string|null $name
 * @property string|null $depreciation_duration
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $item_cost
 * @property string|null $contingency_rate
 * @property int|null $company_id
 * @property string|null $currency_name
 * @property string|null $replacement_cost_rate
 * @property-read \App\Models\FFE|null $ffe
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereContingencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereDepreciationDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereFfeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereItemCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereReplacementCostRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FFEItem whereUpdatedAt($value)
 */
	class FFEItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Food
 *
 * @property int $id
 * @property int|null $food_type_id
 * @property int|null $food_count
 * @property int|null $food_cover
 * @property string|null $total_daily_cover_count
 * @property string|null $f&b_facilities
 * @property string|null $cover_value
 * @property string|null $estimation_date
 * @property string|null $chosen_food_currency
 * @property string|null $cover_value_escalation_rate
 * @property string|null $cover_value_at_operation_date
 * @property string|null $cover_value_annual_escalation_rate
 * @property array|null $guest_capture_cover_percentage
 * @property array|null $cover_per_day
 * @property int $hospitality_sector_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $meal_per_guest
 * @property array|null $percentage_from_rooms_revenues
 * @property string|null $collection_policy_type
 * @property string $collection_policy_value
 * @property string|null $collection_policy_interval
 * @property-read \App\Models\HospitalitySector $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereChosenFoodCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCoverPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCoverValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCoverValueAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCoverValueAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCoverValueEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereEstimationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereF&bFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereFoodCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereFoodCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereFoodTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereGuestCaptureCoverPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereMealPerGuest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food wherePercentageFromRoomsRevenues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereTotalDailyCoverCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Food whereUpdatedAt($value)
 */
	class Food extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FreelancerExpense
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $freelancerPositions
 * @property-read int|null $freelancer_positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|FreelancerExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreelancerExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreelancerExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|FreelancerExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelancerExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreelancerExpense whereUpdatedAt($value)
 */
	class FreelancerExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GeneralExpense
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralExpense whereUpdatedAt($value)
 */
	class GeneralExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\HospitalitySector
 *
 * @property int $id
 * @property string|null $study_name
 * @property string|null $property_name
 * @property array|null $operation_dates
 * @property string|null $region
 * @property array|null $study_dates
 * @property string|null $operation_start_date
 * @property int|null $star_rating
 * @property int|null $country_id
 * @property string|null $property_status
 * @property int|null $state_id
 * @property int|null $duration_in_years
 * @property string|null $type
 * @property string $duration_type
 * @property string $study_start_date
 * @property string $study_end_date
 * @property int $development_start_month
 * @property string $development_start_date
 * @property int $company_id
 * @property int $development_duration
 * @property int $operation_start_month
 * @property string $additional_currency
 * @property string $exchange_rate
 * @property string $corporate_taxes_rate
 * @property string $investment_return_rate
 * @property string $perpetual_growth_rate
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $casino_cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property string $main_functional_currency
 * @property string|null $financial_year_start_month
 * @property int|null $total_f&b_facility_count
 * @property int|null $total_f&b_cover_count
 * @property int|null $total_casino_facility_count
 * @property int|null $total_casino_cover_count
 * @property int|null $total_meeting_cover_count
 * @property int|null $total_meeting_facility_count
 * @property-read int|null $rooms_count
 * @property string|null $average_guest_count
 * @property string|null $is_total_rooms
 * @property int|null $is_total_foods
 * @property int|null $is_total_casinos
 * @property int|null $has_casino_section
 * @property int|null $has_meeting_section
 * @property int|null $has_other_section
 * @property int|null $is_total_other
 * @property int|null $is_total_meetings
 * @property int|null $has_sales_channels
 * @property mixed|null $selected_sales_revenues
 * @property mixed|null $general_occupancy_rate
 * @property string|null $room_collection_policy_type
 * @property string|null $seasonality_interval
 * @property string|null $seasonality_type
 * @property mixed|null $general_seasonality
 * @property string|null $add_sales_channels_share_discount
 * @property mixed|null $study_navigators
 * @property string|null $guest_meeting_seasonality_type
 * @property mixed|null $guest_meeting_general_seasonality
 * @property string|null $guest_meeting_seasonality_interval
 * @property string|null $rent_meeting_seasonality_type
 * @property mixed|null $rent_meeting_general_seasonality
 * @property string|null $rent_meeting_seasonality_interval
 * @property string|null $has_rooms_manpower
 * @property string|null $has_foods_manpower
 * @property string|null $has_casinos_manpower
 * @property string|null $has_sales_and_general_manpower
 * @property string|null $has_other_revenue_manpower
 * @property string|null $other_collection_policy_type
 * @property string|null $meeting_collection_policy_type
 * @property string|null $casino_collection_policy_type
 * @property string|null $food_collection_policy_type
 * @property string|null $rooms_general_collection_policy_interval
 * @property string|null $rooms_general_collection_policy_value
 * @property string|null $rooms_general_collection_policy_type
 * @property string|null $others_general_collection_policy_value
 * @property string|null $others_general_collection_policy_interval
 * @property string|null $others_general_collection_policy_type
 * @property string|null $meetings_general_collection_policy_interval
 * @property string|null $meetings_general_collection_policy_value
 * @property string|null $meetings_general_collection_policy_type
 * @property string|null $foods_general_collection_policy_value
 * @property string|null $foods_general_collection_policy_interval
 * @property string|null $foods_general_collection_policy_type
 * @property string|null $casinos_general_collection_policy_value
 * @property string|null $casinos_general_collection_policy_interval
 * @property string|null $casinos_general_collection_policy_type
 * @property int $has_visit_room_section
 * @property int $has_visit_food_section
 * @property int $has_visit_casino_section
 * @property int $has_visit_meeting_section
 * @property int $has_visit_other_section
 * @property-read \App\Models\Acquisition|null $acquisition
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Casino[] $casinos
 * @property-read int|null $casinos_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DepartmentExpense[] $departmentExpenses
 * @property-read int|null $department_expenses_count
 * @property-read \App\Models\FFE|null $ffe
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FFEItem[] $ffeItems
 * @property-read int|null $ffe_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Food[] $foods
 * @property-read int|null $foods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ManagementFee[] $managementFees
 * @property-read int|null $management_fees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meeting[] $meetings
 * @property-read int|null $meetings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Other[] $others
 * @property-read int|null $others_count
 * @property-read \App\Models\PropertyAcquisition|null $propertyAcquisition
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PropertyAcquisitionBreakDown[] $propertyAcquisitionBreakDown
 * @property-read int|null $property_acquisition_break_down_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesChannel[] $salesChannels
 * @property-read int|null $sales_channels_count
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector query()
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereAddSalesChannelsShareDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereAdditionalCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereAverageGuestCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCasinoCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCasinoCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCasinosGeneralCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCasinosGeneralCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCasinosGeneralCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCorporateTaxesRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereDevelopmentDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereDevelopmentStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereDevelopmentStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereDurationInYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereDurationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereExchangeRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereFinancialYearStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereFoodCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereFoodsGeneralCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereFoodsGeneralCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereFoodsGeneralCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereGeneralOccupancyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereGeneralSeasonality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereGuestMeetingGeneralSeasonality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereGuestMeetingSeasonalityInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereGuestMeetingSeasonalityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasCasinoSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasCasinosManpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasFoodsManpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasMeetingSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasOtherRevenueManpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasOtherSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasRoomsManpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasSalesAndGeneralManpower($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasSalesChannels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasVisitCasinoSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasVisitFoodSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasVisitMeetingSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasVisitOtherSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereHasVisitRoomSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereInvestmentReturnRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereIsTotalCasinos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereIsTotalFoods($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereIsTotalMeetings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereIsTotalOther($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereIsTotalRooms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereMainFunctionalCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereMeetingCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereMeetingsGeneralCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereMeetingsGeneralCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereMeetingsGeneralCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOperationDates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOperationStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOperationStartMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOtherCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOthersGeneralCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOthersGeneralCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereOthersGeneralCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector wherePerpetualGrowthRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector wherePropertyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector wherePropertyStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRentMeetingGeneralSeasonality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRentMeetingSeasonalityInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRentMeetingSeasonalityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRoomCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRoomsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRoomsGeneralCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRoomsGeneralCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereRoomsGeneralCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereSeasonalityInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereSeasonalityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereSelectedSalesRevenues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStarRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStudyDates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStudyEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStudyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStudyNavigators($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereStudyStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereTotalCasinoCoverCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereTotalCasinoFacilityCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereTotalF&bCoverCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereTotalF&bFacilityCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereTotalMeetingCoverCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereTotalMeetingFacilityCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HospitalitySector withAllRelations(?int $companyId = null)
 */
	class HospitalitySector extends \Eloquent implements \App\Interfaces\Models\IBaseModel, \App\Interfaces\Models\IHaveAllRelations, \App\Interfaces\Models\IExportable, \App\Interfaces\Models\IShareable {}
}

namespace App\Models{
/**
 * App\Models\IncomeStatement
 *
 * @property int $id
 * @property string $name
 * @property string $duration
 * @property string $duration_type
 * @property string $start_from
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeStatementItem[] $mainItems
 * @property-read int|null $main_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SharingLink[] $sharingLinks
 * @property-read int|null $sharing_links_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeStatementItem[] $subItems
 * @property-read int|null $sub_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereDurationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereStartFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatement withAllRelations(?int $companyId = null)
 */
	class IncomeStatement extends \Eloquent implements \App\Interfaces\Models\IBaseModel, \App\Interfaces\Models\IHaveAllRelations, \App\Interfaces\Models\IExportable, \App\Interfaces\Models\IShareable {}
}

namespace App\Models{
/**
 * App\Models\IncomeStatementItem
 *
 * @property int $id
 * @property string $name
 * @property int $has_sub_items
 * @property int $has_depreciation_or_amortization
 * @property int $is_main_for_all_calculations
 * @property int $is_sales_rate
 * @property string|null $depends_on auto-calculated
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeStatement[] $incomeStatements
 * @property-read int|null $income_statements_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SharingLink[] $sharingLinks
 * @property-read int|null $sharing_links_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\IncomeStatement[] $subItems
 * @property-read int|null $sub_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereDependsOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereHasDepreciationOrAmortization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereHasSubItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereIsMainForAllCalculations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereIsSalesRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatementItem whereUpdatedAt($value)
 */
	class IncomeStatementItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Language newQuery()
 * @method static \Illuminate\Database\Query\Builder|Language onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Language whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Language withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Language withoutTrashed()
 * @mixin \Eloquent
 */
	class Language extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Loan
 *
 * @property int $id
 * @property int $company_id
 * @property string|null $section_name
 * @property int|null $acquisition_id
 * @property int|null $ffe_id
 * @property string|null $loan_type
 * @property string|null $grace_period
 * @property string|null $loan_amount
 * @property string|null $installment_interval
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $period
 * @property string|null $applied_step
 * @property string|null $stepRate
 * @property string|null $fixedType
 * @property string|null $step_down
 * @property string|null $step_up
 * @property string|null $base_rate
 * @property string|null $margin_rate
 * @property string|null $pricing
 * @property string|null $duration tenor
 * @property string|null $step_down_rate
 * @property string|null $step_up_rate
 * @property string|null $step_up_interval
 * @property string|null $step_down_interval
 * @property string|null $borrowing_rate
 * @property string|null $capitalization_type
 * @property string|null $margin_interest
 * @property string|null $loan_interest
 * @property string|null $min_interest
 * @property string|null $repayment_duration
 * @property string|null $installment_amount
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Acquisition|null $acquisition
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan onlyForSection(string $sectionName)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereAcquisitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereAppliedStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereBaseRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereBorrowingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCapitalizationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereFfeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereFixedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereGracePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereInstallmentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereInstallmentInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereLoanAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereLoanInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereLoanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereMarginInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereMarginRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereMinInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePricing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRepaymentDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepDown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepDownInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepDownRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepUpInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStepUpRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUpdatedAt($value)
 */
	class Loan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ManagementFee
 *
 * @property int $id
 * @property string|null $model_name
 * @property int|null $hospitality_sector_id
 * @property string|null $section_name
 * @property string|null $name
 * @property array|null $payload
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HospitalitySector|null $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee query()
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManagementFee whereUpdatedAt($value)
 */
	class ManagementFee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Meeting
 *
 * @property int $id
 * @property string|null $collection_policy_type
 * @property string $collection_policy_value
 * @property string|null $collection_policy_interval
 * @property int|null $meeting_type_id
 * @property int|null $meeting_count
 * @property int|null $meeting_cover
 * @property int $hospitality_sector_id
 * @property string|null $f&b_facilities
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array|null $guest_capture_cover_percentage
 * @property array|null $guest_seasonality
 * @property array|null $rent_seasonality
 * @property string|null $charges_value_escalation_rate
 * @property string|null $chosen_meeting_currency
 * @property string|null $cover_value
 * @property string|null $charges_value_per_guest
 * @property string|null $charges_value_at_operation_date
 * @property string|null $charges_value_annual_escalation_rate
 * @property array|null $percentage_from_f_and_b_revenues
 * @property-read \App\Models\HospitalitySector $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereChargesValueAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereChargesValueAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereChargesValueEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereChargesValuePerGuest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereChosenMeetingCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCoverValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereF&bFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereGuestCaptureCoverPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereGuestSeasonality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting wherePercentageFromFAndBRevenues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereRentSeasonality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUpdatedAt($value)
 */
	class Meeting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Other
 *
 * @property int $id
 * @property string|null $collection_policy_type
 * @property string $collection_policy_value
 * @property string|null $collection_policy_interval
 * @property int|null $other_type_id
 * @property string|null $f&b_facilities
 * @property int|null $other_count
 * @property string|null $chosen_other_currency
 * @property int $hospitality_sector_id
 * @property string|null $charges_per_guest_escalation_rate
 * @property string|null $charges_per_guest
 * @property string|null $charges_per_guest_annual_escalation_rate
 * @property string|null $charges_per_guest_at_operation_date
 * @property array|null $guest_capture_cover_percentage
 * @property array|null $percentage_from_rooms_revenues
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\HospitalitySector $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|Other newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Other newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Other query()
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereChargesPerGuest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereChargesPerGuestAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereChargesPerGuestAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereChargesPerGuestEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereChosenOtherCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereF&bFacilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereGuestCaptureCoverPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereOtherCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereOtherTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other wherePercentageFromRoomsRevenues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Other whereUpdatedAt($value)
 */
	class Other extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OtherDirectOperationExpense
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|OtherDirectOperationExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtherDirectOperationExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtherDirectOperationExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|OtherDirectOperationExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherDirectOperationExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherDirectOperationExpense whereUpdatedAt($value)
 */
	class OtherDirectOperationExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OtherVariableManpowerExpense
 *
 * @property int $id
 * @property string $otherVariableManpowerExpenseAble_type
 * @property int $otherVariableManpowerExpenseAble_id
 * @property float $percentage_of_price
 * @property float $cost_per_unit
 * @property float $unit_cost
 * @property float $total_cost
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $otherVariableManpowerExpenseAble
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereCostPerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereOtherVariableManpowerExpenseAbleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereOtherVariableManpowerExpenseAbleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense wherePercentageOfPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereTotalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereUnitCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OtherVariableManpowerExpense whereUpdatedAt($value)
 */
	class OtherVariableManpowerExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $directManpowerExpenseAble
 * @property-read int|null $direct_manpower_expense_able_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $freelancerExpenseAble
 * @property-read int|null $freelancer_expense_able_count
 * @method static \Illuminate\Database\Eloquent\Builder|Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Position whereUpdatedAt($value)
 */
	class Position extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|Product company()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductSeasonality
 *
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeasonality company()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeasonality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeasonality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductSeasonality query()
 * @mixin \Eloquent
 */
	class ProductSeasonality extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profitability
 *
 * @property int $id
 * @property string $profitabilityAble_type
 * @property int $profitabilityAble_id
 * @property float $percentage
 * @property float $net_profit_after_taxes
 * @property float $vat
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereNetProfitAfterTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereProfitabilityAbleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereProfitabilityAbleType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profitability whereVat($value)
 */
	class Profitability extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PropertyAcquisition
 *
 * @property int $id
 * @property string|null $property_installment_count
 * @property string|null $property_after_month
 * @property string|null $second_property_down_payment_percentage
 * @property string|null $first_property_down_payment_percentage
 * @property string|null $property_payment_method
 * @property string|null $property_contingency_rate
 * @property string|null $property_purchase_cost
 * @property string|null $purchase_date
 * @property string|null $property_equity_funding_rate
 * @property string|null $installment_interval
 * @property string|null $collection_policy_interval
 * @property string|null $collection_policy_type
 * @property string|null $collection_policy_value
 * @property int|null $hospitality_sector_id
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $has_land_section
 * @property-read \App\Models\HospitalitySector|null $hospitalitySector
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Loan[] $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereFirstPropertyDownPaymentPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereHasLandSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereInstallmentInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePropertyAfterMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePropertyContingencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePropertyEquityFundingRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePropertyInstallmentCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePropertyPaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePropertyPurchaseCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereSecondPropertyDownPaymentPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisition whereUpdatedAt($value)
 */
	class PropertyAcquisition extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PropertyAcquisitionBreakDown
 *
 * @property int $id
 * @property string|null $model_name
 * @property int|null $hospitality_sector_id
 * @property string|null $section_name
 * @property string|null $name
 * @property string|null $property_cost_percentage
 * @property string|null $item_amount
 * @property string|null $depreciation_duration
 * @property int|null $company_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HospitalitySector|null $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereDepreciationDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereItemAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown wherePropertyCostPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyAcquisitionBreakDown whereUpdatedAt($value)
 */
	class PropertyAcquisitionBreakDown extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\QuickPricingCalculator
 *
 * @property int $id
 * @property int $revenue_business_line_id
 * @property int $service_category_id
 * @property int $service_item_id
 * @property int $service_nature_id
 * @property float $delivery_days
 * @property string|null $name
 * @property string $date
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $currency_id
 * @property float $price_sensitivity
 * @property int $use_freelancer
 * @property string $total_recommend_price_without_vat
 * @property string $total_recommend_price_with_vat
 * @property string $price_per_day_without_vat
 * @property string $price_per_day_with_vat
 * @property string $total_net_profit_after_taxes
 * @property string $net_profit_after_taxes_per_day
 * @property string $total_sensitive_price_without_vat
 * @property string $total_sensitive_price_with_vat
 * @property string $sensitive_price_per_day_without_vat
 * @property string $sensitive_price_per_day_with_vat
 * @property string $sensitive_total_net_profit_after_taxes
 * @property string $sensitive_net_profit_after_taxes_per_day
 * @property string $sensitive_net_profit_after_taxes_percentage
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $directManpowerExpensePositions
 * @property-read int|null $direct_manpower_expense_positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DirectManpowerExpense[] $directManpowerExpenses
 * @property-read int|null $direct_manpower_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $freelancerExpensePositions
 * @property-read int|null $freelancer_expense_positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FreelancerExpense[] $freelancerExpenses
 * @property-read int|null $freelancer_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeneralExpense[] $generalExpenses
 * @property-read int|null $general_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OtherDirectOperationExpense[] $otherDirectOperationExpenses
 * @property-read int|null $other_direct_operation_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OtherVariableManpowerExpense[] $otherVariableManpowerExpenses
 * @property-read int|null $other_variable_manpower_expenses_count
 * @property-read \App\Models\Profitability|null $profitability
 * @property-read \App\Models\RevenueBusinessLine $revenueBusinessLine
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesAndMarketingExpense[] $salesAndMarketingExpenses
 * @property-read int|null $sales_and_marketing_expenses_count
 * @property-read \App\Models\ServiceCategory $serviceCategory
 * @property-read \App\Models\ServiceItem $serviceItem
 * @property-read \App\Models\ServiceNature $serviceNature
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SharingLink[] $sharingLinks
 * @property-read int|null $sharing_links_count
 * @property-read \App\Models\State|null $state
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereDeliveryDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereNetProfitAfterTaxesPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator wherePricePerDayWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator wherePricePerDayWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator wherePriceSensitivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereRevenueBusinessLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereSensitiveNetProfitAfterTaxesPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereSensitiveNetProfitAfterTaxesPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereSensitivePricePerDayWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereSensitivePricePerDayWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereSensitiveTotalNetProfitAfterTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereServiceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereServiceItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereServiceNatureId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereTotalNetProfitAfterTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereTotalRecommendPriceWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereTotalRecommendPriceWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereTotalSensitivePriceWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereTotalSensitivePriceWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator whereUseFreelancer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuickPricingCalculator withAllRelations(?int $companyId = null)
 */
	class QuickPricingCalculator extends \Eloquent implements \App\Interfaces\Models\IBaseModel, \App\Interfaces\Models\IHaveAllRelations, \App\Interfaces\Models\IExportable, \App\Interfaces\Models\IShareable {}
}

namespace App\Models{
/**
 * App\Models\QuotationPricingCalculator
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $business_sector_id
 * @property string|null $name
 * @property string $date
 * @property int|null $country_id
 * @property int|null $state_id
 * @property int|null $currency_id
 * @property float $price_sensitivity
 * @property int $use_freelancer
 * @property string $total_recommend_price_without_vat
 * @property string $total_recommend_price_with_vat
 * @property string $price_per_day_without_vat
 * @property string $price_per_day_with_vat
 * @property string $total_net_profit_after_taxes
 * @property string $net_profit_after_taxes_per_day
 * @property string $total_sensitive_price_without_vat
 * @property string $total_sensitive_price_with_vat
 * @property string $sensitive_price_per_day_without_vat
 * @property string $sensitive_price_per_day_with_vat
 * @property string $sensitive_total_net_profit_after_taxes
 * @property string $sensitive_net_profit_after_taxes_per_day
 * @property string $sensitive_net_profit_after_taxes_percentage
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $directManpowerExpensePositions
 * @property-read int|null $direct_manpower_expense_positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceItem[] $directManpowerExpenseServiceItems
 * @property-read int|null $direct_manpower_expense_service_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DirectManpowerExpense[] $directManpowerExpenses
 * @property-read int|null $direct_manpower_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Position[] $freelancerExpensePositions
 * @property-read int|null $freelancer_expense_positions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FreelancerExpense[] $freelancerExpenses
 * @property-read int|null $freelancer_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GeneralExpense[] $generalExpenses
 * @property-read int|null $general_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OtherDirectOperationExpense[] $otherDirectOperationExpenses
 * @property-read int|null $other_direct_operation_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OtherVariableManpowerExpense[] $otherVariableManpowerExpenses
 * @property-read int|null $other_variable_manpower_expenses_count
 * @property-read \App\Models\Profitability|null $profitability
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RevenueBusinessLine[] $revenueBusinessLines
 * @property-read int|null $revenue_business_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SalesAndMarketingExpense[] $salesAndMarketingExpenses
 * @property-read int|null $sales_and_marketing_expenses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceCategory[] $serviceCategories
 * @property-read int|null $service_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceItem[] $serviceItems
 * @property-read int|null $service_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceNature[] $serviceNatures
 * @property-read int|null $service_natures_count
 * @property-read \App\Models\State|null $state
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator query()
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereBusinessSectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereNetProfitAfterTaxesPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator wherePricePerDayWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator wherePricePerDayWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator wherePriceSensitivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereSensitiveNetProfitAfterTaxesPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereSensitiveNetProfitAfterTaxesPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereSensitivePricePerDayWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereSensitivePricePerDayWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereSensitiveTotalNetProfitAfterTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereTotalNetProfitAfterTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereTotalRecommendPriceWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereTotalRecommendPriceWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereTotalSensitivePriceWithVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereTotalSensitivePriceWithoutVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator whereUseFreelancer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QuotationPricingCalculator withAllRelations(?int $companyId = null)
 */
	class QuotationPricingCalculator extends \Eloquent implements \App\Interfaces\Models\IBaseModel, \App\Interfaces\Models\IHaveAllRelations, \App\Interfaces\Models\IExportable, \App\Interfaces\Models\IShareable {}
}

namespace App\Models{
/**
 * App\Models\RevenueBusinessLine
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuotationPricingCalculator[] $QuotationPricingCalculators
 * @property-read int|null $quotation_pricing_calculators_count
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceCategory[] $serviceCategories
 * @property-read int|null $service_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceItem[] $serviceItems
 * @property-read int|null $service_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine forCurrentCompany()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine query()
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RevenueBusinessLine whereUpdatedAt($value)
 */
	class RevenueBusinessLine extends \Eloquent implements \App\Interfaces\Models\IHaveView, \App\Interfaces\Models\IHaveCompany, \App\Interfaces\Models\IHaveCreator, \App\Interfaces\Models\IBaseModel, \App\Interfaces\Models\IExportable {}
}

namespace App\Models{
/**
 * App\Models\Room
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $room_type_id
 * @property int|null $room_count
 * @property string|null $guest_per_room
 * @property int $hospitality_sector_id
 * @property string|null $average_daily_rate
 * @property string|null $chosen_room_currency
 * @property string|null $average_daily_rate_at_operation_date
 * @property string|null $average_daily_rate_annual_escalation_rate
 * @property string|null $occupancy_rate_type
 * @property string|null $average_daily_rate_escalation_rate
 * @property mixed|null $occupancy_rate_per_room
 * @property mixed|null $seasonality
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\HospitalitySector $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAverageDailyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAverageDailyRateAnnualEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAverageDailyRateAtOperationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAverageDailyRateEscalationRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereChosenRoomCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereGuestPerRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereOccupancyRatePerRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereOccupancyRateType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereRoomCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereRoomTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereSeasonality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 */
	class Room extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalesAndMarketingExpense
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculators
 * @property-read int|null $quick_pricing_calculators_count
 * @method static \Illuminate\Database\Eloquent\Builder|SalesAndMarketingExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesAndMarketingExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesAndMarketingExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesAndMarketingExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesAndMarketingExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesAndMarketingExpense whereUpdatedAt($value)
 */
	class SalesAndMarketingExpense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalesChannel
 *
 * @property int $id
 * @property string|null $name
 * @property int $hospitality_sector_id
 * @property mixed|null $percentages
 * @property mixed|null $revenue_share_percentage
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed|null $discount_or_commission
 * @property string|null $collection_policy_type
 * @property string|null $collection_policy_value
 * @property string|null $collection_policy_interval
 * @property-read \App\Models\HospitalitySector $hospitalitySector
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereCollectionPolicyInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereCollectionPolicyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereCollectionPolicyValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereDiscountOrCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereHospitalitySectorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel wherePercentages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereRevenueSharePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesChannel whereUpdatedAt($value)
 */
	class SalesChannel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalesGathering
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $date
 * @property int|null $Year
 * @property int|null $Month
 * @property int|null $Day
 * @property string|null $country
 * @property string|null $local_or_export
 * @property string|null $branch
 * @property string|null $document_type
 * @property string|null $document_number
 * @property string|null $sales_person
 * @property string|null $customer_code
 * @property string|null $customer_name
 * @property string|null $business_sector
 * @property string|null $zone
 * @property string|null $sales_channel
 * @property string|null $service_provider_type
 * @property string|null $service_provider_name
 * @property int|null $service_provider_birth_year
 * @property string|null $principle
 * @property string|null $category
 * @property string|null $sub_category
 * @property string|null $product_or_service
 * @property string|null $product_item
 * @property string|null $measurment_unit
 * @property string|null $return_reason
 * @property string|null $quantity
 * @property string|null $quantity_status
 * @property string|null $quantity_bonus
 * @property string|null $price_per_unit
 * @property string|null $sales_value
 * @property string|null $quantity_discount
 * @property string|null $cash_discount
 * @property string|null $special_discount
 * @property string|null $other_discounts
 * @property string|null $net_sales_value
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $min_year
 * @property string|null $prev_year
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering company()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereBusinessSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCashDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCustomerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereLocalOrExport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereMeasurmentUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereMinYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereNetSalesValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereOtherDiscounts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering wherePrevYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering wherePricePerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering wherePrinciple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereProductItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereProductOrService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantityBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantityDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantityStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereReturnReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSalesChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSalesPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSalesValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereServiceProviderBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereServiceProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereServiceProviderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSpecialDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSubCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereZone($value)
 * @mixin \Eloquent
 */
	class SalesGathering extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalesGatheringTest
 *
 * @method static Builder|SalesGatheringTest company()
 * @method static Builder|SalesGatheringTest newModelQuery()
 * @method static Builder|SalesGatheringTest newQuery()
 * @method static Builder|SalesGatheringTest query()
 * @mixin \Eloquent
 */
	class SalesGatheringTest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Section
 *
 * @property int $id
 * @property array $name
 * @property string $sub_of
 * @property string $icon
 * @property string|null $route
 * @property int $order
 * @property int $trash
 * @property string $section_side
 * @property int|null $updated_by
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read string $route_name
 * @property-read Section $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|Section[] $subSections
 * @property-read int|null $sub_sections_count
 * @method static Builder|Section mainClientSideSections()
 * @method static Builder|Section mainSections()
 * @method static Builder|Section mainSuperAdminSections()
 * @method static Builder|Section newModelQuery()
 * @method static Builder|Section newQuery()
 * @method static \Illuminate\Database\Query\Builder|Section onlyTrashed()
 * @method static Builder|Section query()
 * @method static Builder|Section whereCreatedAt($value)
 * @method static Builder|Section whereCreatedBy($value)
 * @method static Builder|Section whereDeletedAt($value)
 * @method static Builder|Section whereIcon($value)
 * @method static Builder|Section whereId($value)
 * @method static Builder|Section whereName($value)
 * @method static Builder|Section whereOrder($value)
 * @method static Builder|Section whereRoute($value)
 * @method static Builder|Section whereSectionSide($value)
 * @method static Builder|Section whereSubOf($value)
 * @method static Builder|Section whereTrash($value)
 * @method static Builder|Section whereUpdatedAt($value)
 * @method static Builder|Section whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Section withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Section withoutTrashed()
 * @mixin \Eloquent
 */
	class Section extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceCategory
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $revenue_business_line_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RevenueBusinessLine $RevenueBusinessLine
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculator
 * @property-read int|null $quick_pricing_calculator_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceItem[] $serviceItems
 * @property-read int|null $service_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereRevenueBusinessLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuotationPricingCalculator[] $QuotationPricingCalculators
 * @property-read int|null $quotation_pricing_calculators_count
 */
	class ServiceCategory extends \Eloquent implements \App\Interfaces\Models\IHaveCompany, \App\Interfaces\Models\IHaveCreator, \App\Interfaces\Models\IBaseModel {}
}

namespace App\Models{
/**
 * App\Models\ServiceItem
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $service_category_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\ServiceCategory $serviceCategory
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereServiceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuotationPricingCalculator[] $QuotationPricingCalculators
 * @property-read int|null $quotation_pricing_calculators_count
 */
	class ServiceItem extends \Eloquent implements \App\Interfaces\Models\IHaveCompany, \App\Interfaces\Models\IHaveCreator, \App\Interfaces\Models\IBaseModel {}
}

namespace App\Models{
/**
 * App\Models\ServiceNature
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuotationPricingCalculator[] $QuotationPricingCalculators
 * @property-read int|null $quotation_pricing_calculators_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculator
 * @property-read int|null $quick_pricing_calculator_count
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceNature whereUpdatedAt($value)
 */
	class ServiceNature extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SharingLink
 *
 * @property int $id
 * @property string $link
 * @property string $identifier
 * @property string|null $user_name
 * @property string $shareable_type
 * @property int $shareable_id
 * @property int $is_active
 * @property float $number_of_views
 * @property int $company_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $shareable
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereNumberOfViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereShareableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereShareableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SharingLink whereUserName($value)
 */
	class SharingLink extends \Eloquent implements \App\Interfaces\Models\IBaseModel, \App\Interfaces\Models\IExportable, \App\Interfaces\Models\IHaveView {}
}

namespace App\Models{
/**
 * App\Models\SoftConstructionCost
 *
 * @property int $id
 * @property string $name
 * @property string $cost_amount
 * @property string $contingency_rate
 * @property int $acquisition_id
 * @property int $company_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost query()
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereAcquisitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereContingencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereCostAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SoftConstructionCost whereUpdatedAt($value)
 */
	class SoftConstructionCost extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\State
 *
 * @property int $id
 * @property int $country_id
 * @property string $name_ar
 * @property string $name_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @property-read State $state
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|State whereUpdatedAt($value)
 */
	class State extends \Eloquent implements \App\Interfaces\Models\IBaseModel {}
}

namespace App\Models{
/**
 * App\Models\TablesField
 *
 * @property int $id
 * @property string|null $model_name
 * @property string|null $field_name
 * @property string|null $view_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField query()
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereFieldName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TablesField whereViewName($value)
 * @mixin \Eloquent
 */
	class TablesField extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ToolTipData
 *
 * @property int $id
 * @property string $model_name
 * @property string $section_name
 * @property string|null $field
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData query()
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereSectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ToolTipData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ToolTipData extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UploadExcel
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $date
 * @property string|null $invoice_date
 * @property string|null $customer_name
 * @property string|null $invoice_number
 * @property string|null $invoice_amount
 * @property string|null $due_collection_days
 * @property string|null $due_date
 * @property string|null $contract_code
 * @property string|null $contract_date
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel company()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel query()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereContractCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereContractDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereDueCollectionDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereInvoiceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadExcel whereUpdatedBy($value)
 */
	class UploadExcel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalesGatheringTest
 *
 * @method static Builder|SalesGatheringTest company()
 * @method static Builder|SalesGatheringTest newModelQuery()
 * @method static Builder|SalesGatheringTest newQuery()
 * @method static Builder|SalesGatheringTest query()
 * @mixin \Eloquent
 */
	class UploadExcelTest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UploadSupplierInvoice
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $date
 * @property string|null $invoice_date
 * @property string|null $supplier_name
 * @property string|null $invoice_number
 * @property string|null $invoice_amount
 * @property string|null $due_collection_days
 * @property string|null $due_date
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice company()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereDueCollectionDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereInvoiceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereInvoiceDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereSupplierName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UploadSupplierInvoice whereUpdatedBy($value)
 */
	class UploadSupplierInvoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalesGatheringTest
 *
 * @method static Builder|SalesGatheringTest company()
 * @method static Builder|SalesGatheringTest newModelQuery()
 * @method static Builder|SalesGatheringTest newQuery()
 * @method static Builder|SalesGatheringTest query()
 * @mixin \Eloquent
 */
	class UploadSupplierInvoiceTest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $subscription
 * @property string|null $expiration_date
 * @property int|null $acceptance_of_privacy_policy
 * @property string|null $remember_token
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RevenueBusinessLine[] $RevenueBusinessLines
 * @property-read int|null $revenue_business_lines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAcceptanceOfPrivacyPolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

