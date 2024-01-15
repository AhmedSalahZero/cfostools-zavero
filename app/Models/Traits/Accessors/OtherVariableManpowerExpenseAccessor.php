<?php
namespace App\Models\Traits\Accessors ;
trait OtherVariableManpowerExpenseAccessor
{
    public function getId():int
    {
        return $this->id ; 
    }

     public function getCompanyId():int
    {
        return $this->company->id ?? $this->company_id ; 
    }
    public function getCompanyName():string
    {
        return $this->company->getName() ;
    }
    public function getCreatorName():string
    {
        return $this->creator->name ?? __('N/A');
    }
	public function getName():?string 
    {
		return $this->getExpenseName();
    }
    public function getPercentageOfPrice():float 
    {
        return  $this->percentage_of_price ?: 0 ;
    }
     public function getCostPerUnit():float 
    {
        return  $this->cost_per_unit ?: 0 ;
    }
     public function getUnitCost():float 
    {
        return  $this->unit_cost ?: 0 ;
    }
    public function getTotalCost():float 
    {
        return  $this->total_cost ?: 0 ;
    }

}
