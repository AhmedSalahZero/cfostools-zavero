<?php
namespace App\Models\Traits\Accessors ;
trait OtherDirectOperationExpenseAccessor
{
    public function getId():int
    {
        return $this->id ; 
    }

     public function getCompanyId():int
    {
        return $this->company->id ?? $this->pivot->company_id ; 
    }
    public function getCompanyName():string
    {
        return $this->company->getName() ;
    }
    public function getCreatorName():string
    {
        return $this->creator->name ?? __('N/A');
    }
    
    public function getPercentageOfPrice():float 
    {
        return $this->pivot ? $this->pivot->percentage_of_price : 0 ;
    }
     public function getCostPerUnit():float 
    {
        return $this->pivot ? $this->pivot->cost_per_unit : 0 ;
    }
     public function getUnitCost():float 
    {
        return $this->pivot ? $this->pivot->unit_cost : 0 ;
    }
	public function getName():?string  
    {
		return $this->getExpenseName();
		// return $this->name ;
        // return $this->pivot ? $this->pivot->name : null ;
    }
    public function getTotalCost():float 
    {
        return $this->pivot ? $this->pivot->total_cost : 0 ;
    }

}
// salesAndMarketExpenses
