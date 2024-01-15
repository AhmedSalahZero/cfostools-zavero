<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class DepartmentExpense extends Model
{
	use HasFactory;

	protected $guarded = [];

	protected $casts = [
		'payload'=>'array',
		'manpower_payload'=>'array'
	];

	public function hospitalitySector()
	{
		return $this->belongsTo(HospitalitySector::class, 'hospitality_sector_id', 'id');
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDepartmentName()
	{
		return $this->department_name;
	}

	public function getPayloadAtYear(int $year)
	{
		$payload = $this->payload;
		$payload = arrayToValueIndexes($payload);

		return isset($payload[$year]) ? $payload[$year] : 0;
	}

	public function getManpowerPayloadAtDate(string $date, $repeatingDates = null)
	{
		$payload = $this->manpower_payload;
		if ($repeatingDates && $payload) {
			$payload = sortDatesAsIndex($payload);
			$payload = repeatLastKeyForUnExistingKeysIn($payload, $repeatingDates);
		}
		$payload = arrayToValueIndexes($payload);

		return isset($payload[$date]) ? $payload[$date] : 0;
	}

	public function getExpensePerNightSold()
	{
		return $this->expense_per_night_sold ?: 0;
	}

	public function getExpensePerGuest()
	{
		return $this->expense_per_guest ?: 0;
	}

	public function getInventoryCoverageDays()
	{
		return $this->inventory_coverage_days ?: 0;
	}

	public function beginningInventoryBalanceValue()
	{
		return $this->beginning_inventory_balance_value ?: 0;
	}

	public function getCashPayment()
	{
		return $this->cash_payment_percentage ?: 0;
	}

	public function getDeferredPaymentPercentage()
	{
		return $this->deferred_payment_percentage ?: 0;
	}

	public function getDueDays()
	{
		return $this->due_days ?: 0;
	}

	public function getCurrentNetSalary()
	{
		return $this->current_net_salary ?: 0;
	}

	public function getChosenCurrency()
	{
		return $this->chosen_currency;
	}

	public function getEscalationRate()
	{
		return $this->escalation_rate ?: 0;
	}

	public function getNetSalaryAtOperationDate()
	{
		return $this->net_salary_at_operation_date ?: 0;
	}

	public function getAnnualEscalationRate()
	{
		return $this->annual_escalation_rate ?: 0;
	}

	public function getSalaryTaxes()
	{
		return $this->salary_taxes ?: 0;
	}

	public function getSocialInsurance()
	{
		return $this->social_insurance ?: 0;
	}

	public function getNightExpenseEscalationRate()
	{
		return $this->night_expense_escalation_rate ?: 0;
	}

	public function getNightAnnualEscalationRate()
	{
		return $this->night_annual_escalation_rate ?: 0;
	}

	public function getNightExpenseAtOperationDate()
	{
		return $this->night_expense_at_operation_date ?: 0;
	}

	public function getNightExpenseChosenCurrency()
	{
		return $this->chosen_night_expense_currency ?: 0;
	}

	public function getGuestAnnualEscalationRate()
	{
		return $this->guest_annual_escalation_rate ?: 0;
	}

	public function getPercentageFromFixedAssets()
	{
		return $this->percentage_from_fixed_assets ?: 0;
	}

	public function getPaymentMonth()
	{
		return $this->payment_month ?: 0;
	}

	public function getGuestExpenseAtOperationDate()
	{
		return $this->guest_expense_at_operation_date;
	}

	public function getGuestExpenseEscalationRate()
	{
		return $this->guest_expense_escalation_rate;
	}

	public function getExpensePerGuestSold()
	{
		return $this->expense_per_guest_sold ?: 0;
	}

	public function getGuestExpenseChosenCurrency()
	{
		return $this->chosen_guest_expense_currency;
	}

	public function getIdentifier()
	{
		return $this->id;
	}

	public static function getIdentifierName()
	{
		return 'id';
	}

	public function getAnnualEscalationPercentage($type)
	{
		if ($type == variable_expenses_as_cost_per_night_sold) {
			return  $this->getNightAnnualEscalationRate();
		} elseif ($type ==variable_expenses_as_cost_per_guest) {
			return  $this->getGuestAnnualEscalationRate();
		} elseif ($type == rooms_manpower_expense) {
			return $this->getAnnualEscalationRate();
		} elseif ($type == fixed_monthly_expenses) {
			return $this->getGuestAnnualEscalationRate();
		}
		dd('Department Expense Percentage .php');
	}

	public function getBaseValueBeforeEscalation($type)
	{
		if ($type == variable_expenses_as_cost_per_night_sold) {
			return $this->getNightExpenseAtOperationDate();
		} elseif ($type ==variable_expenses_as_cost_per_guest) {
			return $this->getGuestExpenseAtOperationDate();
		} elseif ($type == rooms_manpower_expense) {
			$netSalaryAtOperationDate = $this->getNetSalaryAtOperationDate();
			$salaryTax = $this->getSalaryTaxes();
			$socialInsurance = $this->getSocialInsurance();
			$grossSalaryAtOperationDate  = $netSalaryAtOperationDate  / (1-($salaryTax/100) - ($socialInsurance/100));

			return $grossSalaryAtOperationDate;
		} elseif ($type ==fixed_monthly_expenses) {
			return $this->getGuestExpenseAtOperationDate();
		}
		dd('Department Expense .php');
	}

	public function getBeginningInventoryBalanceValue()
	{
		return $this->beginning_inventory_balance_value ?: 0;
	}

	public function getOpexPaymentTerm()
	{
		return $this->opex_payment_terms;
	}

	public function setPayloadAttribute($jsonValue)
	{
		$this->attributes['payload'] = repeatJson($jsonValue, true);
	}

	public static function getNameFromId($id, Collection $departmentExpenses, string $totalNaming = null):string
	{
		if ($id ==0&&$totalNaming) {
			return $totalNaming;
		}

		if (is_numeric($id)) {
			return $departmentExpenses->where('id', $id)->first()->getName();
		}

		return $id;
	}

	public function getStartUpCost()
	{
		return $this->start_up_cost ?: 0;
	}

	public function getDate()
	{
		return $this->date ?: null;
	}
	public function getDateFormatted()
	{
		return Carbon::make($this->getDate())->format('d-m-Y');
	}
	public function getDateAsIndex(array $dateWithDateIndex)
	{
		return $dateWithDateIndex[$this->getDateFormatted()] ;
	}

}
