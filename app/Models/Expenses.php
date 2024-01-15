<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
	protected $table ='expense';
	
	protected $guarded = ['id'];
	
	protected $casts = [
		'payload'=>'array',
		'custom_collection_policy'=>'array'
	];
	
	public function company()
	{
		return $this->belongsTo(Company::class , 'company_id','id');
	}
	public function model()
	{
		$modelName = '\App\Models\\'.$this->model_name ;
		return $this->belongsTo($modelName , 'model_id','id');
		
	}
	public function getName()
	{
		return $this->name ;
	}
	public function getCategoryName()
	{
		return $this->category_name ;
	}
	public function getStartDateFormatted()
	{
		return $this->start_date ;
	}
	public function getMonthlyAmount()
	{
		return $this->monthly_amount ?: 0 ;
	}
	
	public function getPaymentTerm()
	{
		return $this->payment_terms ;
	}
	public function getVatRate()
	{
		return $this->vat_rate ?: 0;
	}
	public function getWithholdTaxRate()
	{
		return $this->withhold_tax_rate?:0;
	}	
	public function getIncreaseRate()
	{
		return $this->increase_rate ?: 0;
	}
	public function getIncreaseInterval()
	{
		return $this->increase_interval ;
	}
	public function getPayloadAtDate(string $date)
	{
		return $this->payload[$date] ?? 0 ;
	}
	public function getRevenueStreamType()
	{
		return $this->revenue_stream_type ;
	}	
	public function getMonthlyPercentage()
	{
		return $this->monthly_percentage ?:0;
	}
	public function getMonthlyCostOfUnit()
	{
		return $this->monthly_cost_of_unit ?:0;
	}
	public function getDepartment()
	{
		// this must be multiple 
		return '';
	}
	public function getEmployee()
	{
		// this must be multiple 
		return '';
	}
	public function getInterval()
	{
		return $this->interval ;
	}
	public function getAllocationBaseOne()
	{
		return $this->allocation_base_1 ; 
	}
	public function getAllocationBaseTwo()
	{
		return $this->allocation_base_2; 
	}
	public function getAllocationBaseThree()
	{
		return $this->allocation_base_3; 
	}
	public function getConditionalTo()
	{
		return $this->conditional_to ;
	}
	public function getConditionalValueA()
	{
		return $this->conditional_value_a ;
	}
	public function getConditionalValueB()
	{
		return $this->conditional_value_b ;
	}
	public function getPaymentRate(int $rateIndex){
		return array_values($this->custom_collection_policy ?? [])[$rateIndex] ?? 0 ;
	}
	public function getPaymentRateAtDueInDays($rateIndex)
	{
		return array_keys($this->custom_collection_policy ?? [])[$rateIndex] ?? 0 ; 
	}
	public function isDeductible()
	{
		return $this->is_deductible;
	}
   
	
	
}
