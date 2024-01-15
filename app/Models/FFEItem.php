<?php

namespace App\Models;

use App\Models\Traits\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class  FFEItem extends Model 
{
	use   CompanyScope;
	
	protected $table ='ffe_items';
	
	protected $guarded = [
		'id'
	];
	public function ffe()
	{
		return $this->belongsTo(FFE::class , 'ffe_id','id');
	}
	
	public function getName()
	{
		return $this->name ;
	}
	
	public function getDepreciationDuration()
	{
		return $this->depreciation_duration?:0;
	}
	public function getDepreciationDurationInMonths()
	{
		return $this->getDepreciationDuration() * 12;
	}
	public function getCurrencyName()
	{
		return $this->currency_name ;
	}
	public function getContingencyRate()
	{
		return $this->contingency_rate?:0 ;
	}
	public function getItemCost()
	{
		return $this->item_cost?:0;
	}
	public function getItemCostAfterContingency()
	{
		return $this->getItemCost() * ($this->getContingencyRate()/100) ;
	}
	public function getTotalCost()
	{
		return (1+($this->getContingencyRate()/100))*$this->getItemCost();
	}
	public function getReplacementCostRate()
	{
		return $this->replacement_cost_rate?:0;
	}	
	public function getReplacementInterval()
	{
		return $this->replacement_interval?:0 ;
	}
	public function getReplacementIntervalInMonths()
	{
		return $this->getReplacementInterval() * 12  ;
	}
	public function getWeightedAverageReplacementCost()
	{
		return 0 ;
	}
	
}
