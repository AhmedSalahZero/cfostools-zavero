<?php
namespace App\Models\Traits\Accessors ;
trait FreelancerExpenseAccessor
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

    
    public function getPositionId():int  
    {
        return $this->pivot ? $this->pivot->position_id : 0 ;
    }
    public function getFreelancerPercentageOfPrice():float 
    {
        return $this->pivot ? $this->pivot->percentage_of_price : 0 ;
    }

    public function getWorkingDays():float 
    {
        return $this->pivot ? $this->pivot->working_days : 0 ;
    }
     public function getCostPerDay():float 
    {
        return $this->pivot ? $this->pivot->cost_per_day : 0 ;
    }
  
    public function getTotalCost():float 
    {
        return $this->pivot ? $this->pivot->total_cost : 0 ;
    }

}