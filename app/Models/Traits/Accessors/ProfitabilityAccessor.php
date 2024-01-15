<?php
namespace App\Models\Traits\Accessors ;
trait ProfitabilityAccessor
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
    public function getCorporateTaxesPercentage()
    {
        return $this->percentage ?:0; 
    }
      public function getNetProfitAfterTaxes()
    {
        return $this->net_profit_after_taxes ?: 0 ; 
    }
      public function getVat()
    {
        return $this->vat ?:0; 
    }
    

}
