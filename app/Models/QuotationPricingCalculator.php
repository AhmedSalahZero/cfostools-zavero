<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Interfaces\Models\IHaveAllRelations;
use App\Interfaces\Models\IShareable;
use App\Models\Repositories\CurrencyRepository;
use App\Models\Repositories\CustomerRepository;
use App\Models\Repositories\PositionRepository;
use App\Models\Repositories\RevenueBusinessLineRepository;
use App\Models\Repositories\ServiceCategoryRepository;
use App\Models\Repositories\ServiceItemRepository;
use App\Models\Repositories\ServiceNatureRepository;
use App\Models\Traits\Accessors\QuotationPricingCalculatorAccessor;
use App\Models\Traits\Mutators\QuotationPricingCalculatorMutator;
use App\Models\Traits\Relations\QuotationPricingCalculatorRelation;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\Globals\StateCountryScope;
use App\Models\Traits\Scopes\withAllRelationsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationPricingCalculator extends Model implements IBaseModel , IHaveAllRelations , IExportable , IShareable
{
    use HasFactory , QuotationPricingCalculatorAccessor,QuotationPricingCalculatorMutator , QuotationPricingCalculatorRelation , CompanyScope , withAllRelationsScope ;
         
    public function getName(): string { return ''; }
    
    public function getRouteKeyName()
    {
        return 'quotation_pricing_calculators.id' ;
    }
    public static function getShareableEditViewVars($model):array 
    {
        
        return [
            'pageTitle'=>QuotationPricingCalculator::getPageTitle(),
             'revenueBusinessLines'=>App(RevenueBusinessLineRepository::class)->oneFormattedForSelect($model),
            'serviceCategories'=>App(ServiceCategoryRepository::class)->oneFormattedForSelect($model),
            'serviceItems'=>App(ServiceItemRepository::class)->oneFormattedForSelect($model),
            'serviceNatures'=>App(ServiceNatureRepository::class)->oneFormattedForSelect($model),
            'positions'=>App(PositionRepository::class)->oneFormattedForSelect($model),

            'currencies'=>App(CurrencyRepository::class)->oneFormattedForSelect($model),
            'customersAndLeads'=>App(CustomerRepository::class)->formattedForSelect($model)
            
        ];   
    }
    
    public static function exportViewName():string {
        return __('Quotation Pricing Calculator'); 
    }
     public static function getFileName():string 
    {
        return __('Quotation Pricing Calculator');
    }

    protected static function booted()
    {
        static::addGlobalScope(new StateCountryScope);
    }

    public static function getCrudViewName():string 
    {
        return 'admin.quotation-pricing-calculator.create';
    }
    
    public static function getViewVars():array 
    {
        $currentCompanyId =  getCurrentCompanyId();
        
        return [
            'getDataRoute'=>route('admin.get.quotation.pricing.calculator' , ['company'=>$currentCompanyId]) ,
            'modelName'=>'QuotationPricingCalculator',
            'exportRoute'=>route('admin.export.quotation.pricing.calculator' , $currentCompanyId),
            'createRoute'=>route('admin.create.quotation.pricing.calculator',$currentCompanyId),
            'storeRoute'=>route('admin.store.quotation.pricing.calculator',$currentCompanyId),
            // 'updateRoute'=>route('admin.update.quotation.pricing.calculator',[$currentCompanyId ]),
            'hasChildRows'=>true ,
            'pageTitle'=>QuotationPricingCalculator::getPageTitle(),
             'revenueBusinessLines'=>App(RevenueBusinessLineRepository::class)->allFormattedForSelect($currentCompanyId),
            'serviceCategories'=>App(ServiceCategoryRepository::class)->allFormattedForSelect($currentCompanyId),
            'serviceItems'=>App(ServiceItemRepository::class)->allFormattedForSelect($currentCompanyId),
            'serviceNatures'=>App(ServiceNatureRepository::class)->allFormattedForSelect($currentCompanyId),
            'positions'=>App(PositionRepository::class)->allFormattedForSelect($currentCompanyId),
            'currencies'=>App(CurrencyRepository::class)->allFormattedForSelect($currentCompanyId),
             'customersAndLeads'=>App(CustomerRepository::class)->allFormattedForSelect($currentCompanyId),
            'redirectAfterSubmitRoute'=>route('admin.view.quotation.pricing.calculator',$currentCompanyId),
            'type'=>'create'
        ];
        
    }

    public static function getPageTitle()
    {
        return __('Quotation Pricing Calculator'); 
    }
    

    public function getAllRelationsNames():array 
    {
        return [
            'revenueBusinessLine',
            'serviceCategory','serviceItem','serviceNatureRelation','currency','otherVariableManpowerExpenses',
            'directManpowerExpenses','salesAndMarketingExpenses','otherDirectOperationExpenses','generalExpenses','freelancerExpensePositions',
            'directManpowerExpensePositions','freelancerExpenses','profitability'
        ];
    }
    
    
}
