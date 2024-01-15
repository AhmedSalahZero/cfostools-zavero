<?php
namespace App\Models\Traits\Accessors ;
trait QuickPricingCalculatorAccessor
{
    public function getId():int
    {
        return $this->id ; 
    }
    public function getName():string 
    {
        return $this->name ;
    }
     public function getCompanyId():int
    {
        return $this->company->id ?? 0; 
    }
    public function getCompanyName():string
    {
        return $this->company->getName() ;
    }
    public function getCreatorName():string
    {
        return $this->creator->name ?? __('N/A');
    }
    public function getRevenueBusinessLineName():string 
    {
        $revenueBusinessLine = $this->revenueBusinessLine ;
        return $revenueBusinessLine ?   $revenueBusinessLine->getName() : __('N/A')   ;
    }
    public function getRevenueBusinessLineId():int 
    {
         $revenueBusinessLine = $this->revenueBusinessLine ;
        return $revenueBusinessLine ?   $revenueBusinessLine->getId() : 0   ;
    }
    public function getServiceCategoryName():string 
    {
        $serviceCategory = $this->serviceCategory ;
        return $serviceCategory ?   $serviceCategory->getName() : __('N/A')   ;
    }

      public function getServiceCategoryId():int 
    {
        $serviceCategory = $this->serviceCategory ;
        return $serviceCategory ?   $serviceCategory->getId() : 0   ;
    }

    public function getServiceItemName():string 
    {
        $serviceItem = $this->serviceItem ;

        return $serviceItem ?   $serviceItem->getName() : __('N/A')   ;
    }

    public function getServiceItemId():int  
    {
        $serviceItem = $this->serviceItem ;

        return $serviceItem ?   $serviceItem->getId() : 0   ;
    }
    public function getServiceNatureId():int  
    {
        $serviceNature = $this->serviceNature ;
        return $serviceNature ?   $serviceNature->getId() : 0   ;
    } 
	 public function getPricingPlanId():int  
    {
        $pricingPlan = $this->pricingPlan ;
        return $pricingPlan ?   $pricingPlan->getId() : 0   ;
    }

    public function getCurrencyId():int  
    {
        $currency = $this->currency ;

        return $currency ?   $currency->getId() : 0   ;
    }

    public function getCurrencyName():?string 
    {
        $currency = $this->currency ; 
        return $currency ? $currency->getName() : null ;
    }
    
    public function getCountryId():int 
    {
        return $this->country_id ?: 0 ; 
    }

     public function getStateId():int 
    {
        return $this->state_id ?: 0 ; 
    }

    public function getDate():?string 
    {
        return $this->date ;
    }
    public function getDeliveryDays():float  
    {
        return $this->delivery_days ;
    }
	public function getCountOrDays()
	{
		return $this->getDeliveryDays();
	}
    public function isUseFreelancer():bool 
    {
        return (bool)$this->use_freelancer ; 
    }

    public function getPriceSensitivity()
    {
        return $this->price_sensitivity ;
    }

    public function getTotalRecommendPriceWithoutVat():?string
    {
		
        return unformat_number($this->total_recommend_price_without_vat ?: 0 )  ;
    }
     public function getTotalRecommendPriceWithoutVatFormatted():?string
    {
        return $this->total_recommend_price_without_vat . ' ' . $this->getCurrencyName() ;
    }

    public function getTotalRecommendPriceWithVat():?string
    {
        return $this->total_recommend_price_with_vat ;
    }

    public function getTotalRecommendPriceWithVatFormatted():?string
    {
        return $this->total_recommend_price_with_vat . ' ' . $this->getCurrencyName() ;
    }

    public function getPricePerDayWithoutVat():?string
    {
        return $this->price_per_day_without_vat ;
    }
    public function getPricePerDayWithVat():?string
    {
        return  $this->price_per_day_with_vat ; 
    }
    public function getTotalNetProfitAfterTaxes():?string
    {
        return $this->total_net_profit_after_taxes ;
    }
      public function getTotalNetProfitAfterTaxesFormatted():?string
    {
        return $this->total_net_profit_after_taxes . ' ' . $this->getCurrencyName() ;
    }

    public function getNetProfitAfterTaxesPerDay():?string
    {
        return $this->net_profit_after_taxes_per_day ;
    }
    public function getTotalSensitivePriceWithoutVat():?string
    {
        return $this->total_sensitive_price_without_vat; 
    }
    public function getTotalSensitivePriceWithVat():?string
    {
        return $this->total_sensitive_price_with_vat ;
    }
    public function getSensitivePricePerDayWithoutVat():?string
    {
        return $this->sensitive_price_per_day_without_vat ;
    }
    public function getSensitivePricePerDayWithVat():?string
    {
        return $this->sensitive_price_per_day_with_vat ;
    }
    public function getSensitiveTotalNetProfitAfterTaxes():?string
    {
        return $this->sensitive_total_net_profit_after_taxes ;
    }
    public function getSensitiveNetProfitAfterTaxesPerDay():?string
    {
        return $this->sensitive_net_profit_after_taxes_per_day ;
    }
    public function getSensitiveNetProfitAfterTaxesPercentage():?string
    {
        return $this->sensitive_net_profit_after_taxes_percentage ;
    }
	public function getTotalNetProfitAfterTaxesPercentage()
	{
		$totalNetProfitAfterTaxes = $this->getTotalNetProfitAfterTaxes();
		$totalRecommendedWithoutVat = $this->getTotalRecommendPriceWithoutVat();
		return $totalRecommendedWithoutVat ? $totalNetProfitAfterTaxes / $totalRecommendedWithoutVat * 100 : 0 ; 
	}
	public function getTotalNetProfitAfterTaxesPercentageFormatted()
	{
		return number_format($this->getTotalNetProfitAfterTaxesPercentage() , 2 ) . ' %'; 
	}
	
	// Total Net Profit After Taxes  %  
}
