<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftConstructionCost extends Model
{
	public function getName()
	{
		return $this->name ;
	}
	public function getCostAmount()
	{
		return $this->cost_amount ?:0 ;
	}
	public function getContingencyRate()
	{
		return $this->contingency_rate?:0;
	}
	public function getTotalCost()
	{
		$contingencyRate = $this->getContingencyRate() / 100 ;
		$costAmount = $this->getCostAmount();
		return $costAmount *$contingencyRate ; 
	}
}
