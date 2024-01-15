<?php
namespace App\Models\Traits\Mutators ;

use App\Interfaces\Models\IBaseModel;
use App\Models\DirectManpowerExpense;
use App\Models\FreelancerExpense;
use App\Models\GeneralExpense;
use App\Models\OtherDirectOperationExpense;
use App\Models\SalesAndMarketingExpense;
use Illuminate\Http\Request;

trait QuotationPricingCalculatorMutator
{

    
   
    public function storeOfferedServiceSectionWithResult(Request $request):IBaseModel  
    {
        
        foreach(
            ['date','customer_id','business_sector_id','country_id','state_id','currency_id','price_sensitivity','use_freelancer',
            'total_recommend_price_without_vat','total_recommend_price_with_vat','price_per_day_without_vat','price_per_day_with_vat'
            ,'total_net_profit_after_taxes','net_profit_after_taxes_per_day','total_sensitive_price_without_vat','total_sensitive_price_with_vat'
            ,'sensitive_price_per_day_without_vat','sensitive_price_per_day_with_vat',
            'sensitive_total_net_profit_after_taxes','sensitive_net_profit_after_taxes_per_day','sensitive_net_profit_after_taxes_percentage'
            ] as $field)
            {
                $this->{$field} = $request->{$field} ;
            }
        $this->company_id =getCurrentCompanyId()  ;        
        $this->creator_id =Auth()->user()->id ;
        $this->created_at = now();     
        $this->save();   
        return $this ;
    }

    public function updateOfferedServiceSectionWithResult(Request $request)
    {
        $this->storeOfferedServiceSectionWithResult($request);
        $this->updated_at = now();
        return $this ;
    }
    
    public function storeServices(Request $request)
    {
        foreach($request->services as $service)
        {
            $this->revenueBusinessLines()->attach($service['revenue_business_line_id'] , [
                'service_category_id'=>$service['service_category_id'],
                'service_item_id'=>$service['service_item_id'],
                'service_nature_id'=>$service['service_nature_id'],
                'delivery_days'=>$service['delivery_days'],
                'created_at'=>now()
            ] );
        }
        
        return $this ; 
    }
    public function  storeDirectManpowerExpense(Request $request)
    {
        foreach($request->manpower_expenses as $manpowerExpenseArray)
        {
            $directManpowerExpense = DirectManpowerExpense::create();
         $this->directManpowerExpenses()->attach([
            'direct_expense_id'=>$directManpowerExpense->id 
        ]  , [
             'working_days'=>$manpowerExpenseArray['manpower_expense_working_days'] ,
            'cost_per_day' =>$manpowerExpenseArray['manpower_expense_cost_per_day'] ,
            'total_cost'=> $manpowerExpenseArray['manpower_expense_cost_per_day'] * $manpowerExpenseArray['manpower_expense_working_days'] ,
            'company_id'=>getCurrentCompanyId() ,
            'creator_id'=>Auth()->user()->id  ,
            'position_id'=>$manpowerExpenseArray['manpower_expense_position_id']
        ]) ;
        }
        

        return $this ; 
    }

    public function updateDirectManpowerExpense(Request $request)
    {
        $this->directManpowerExpenses()->detach();
        $this->storeDirectManpowerExpense($request);
        return $this ;
    }

     public function storeOtherVariableManpowerExpense(Request $request)
    {
        $this->otherVariableManpowerExpenses()->create( [
            'percentage_of_price'=>$request->get('variable_mp_expense_percentage') ,
            'cost_per_unit'=> $costPerUnit =  $request->get('mp_cost_per_unit') ,
            'unit_cost'=> $unitCost = $request->get('mp_units_count'),
            'total_cost' => $costPerUnit + $unitCost ,
            'company_id'=>getCurrentCompanyId() ,
            'creator_id'=>Auth()->user()->id ,
        ]);
        return $this ; 
    }

    public function updateOtherVariableManpowerExpense(Request $request)
    {
        $this->otherVariableManpowerExpenses()->delete();
        $this->storeOtherVariableManpowerExpense($request);
        return $this ;
    }
    

     public function storeFreelancersExpense(Request $request)
    {
        if($request->boolean('use_freelancer'))
        {
            foreach($request->freelancer_expenses as $freelancerExpenseArray)
            {
                
                $this->freelancerExpenses()->attach([
                    'freelancer_expense_id'=>FreelancerExpense::create()->id
                    ]  , 
                    [
                        'percentage_of_price'=>$freelancerExpenseArray['freelancer_percentage'] ,
                        'working_days'=>$freelancerExpenseArray['freelancer_working_days'] ,
                        'cost_per_day' =>$freelancerExpenseArray['freelancer_cost_per_day']  ,
                        'total_cost'=> $freelancerExpenseArray['freelancer_working_days'] * $freelancerExpenseArray['freelancer_cost_per_day'] ,
                        'company_id'=>getCurrentCompanyId() ,
                        'creator_id'=>Auth()->user()->id  ,
                        'position_id'=>$freelancerExpenseArray['freelancer_position_id']
                        ]);
                    }
                }
                return $this ; 
    }

    public function updateFreelancersExpense(Request $request)
    {
        $this->freelancerExpenses()->detach();
        $this->storeFreelancersExpense($request);
        return $this ;
    }

     public function storeOtherDirectOperationsExpense(Request $request)
    {
        $this->otherDirectOperationExpenses()->attach([
           
            'other_direct_operation_expense_id'=>OtherDirectOperationExpense::create()->id
        ]  , [
            'percentage_of_price'=>$request->get('direct_opex_expense_percentage') ,
            'cost_per_unit'=> $costPerUnit = $request->get('direct_opex_cost_per_unit') ,
            'unit_cost'=>$directOpexUnit = $request->get('direct_opex_units_count'),
            'total_cost' => $directOpexUnit  * $costPerUnit  ,
            'company_id'=>getCurrentCompanyId() ,
            'creator_id'=>Auth()->user()->id ,
        ]);
        return $this ; 
    }

    public function updateOtherDirectOperationsExpense(Request $request)
    {
        $this->otherDirectOperationExpenses()->detach();
        $this->storeOtherDirectOperationsExpense($request);
        return $this ;
    }

    public function storeSalesAndMarketingExpense(Request $request)
    {
        $this->salesAndMarketingExpenses()->attach([
            'sales_and_marketing_expense_id'=>SalesAndMarketingExpense::create()->id
        ]  , [
            'percentage_of_price'=>$request->get('smex_expense_percentage')?:0 ,
            'cost_per_unit'=> $salesAndMarketingCostPerUnit = $request->get('smex_cost_per_unit') ?: 0 ,
            'unit_cost'=>$salesAndMarketingUnitCount = $request->get('smex_units_count')?:0,
            'total_cost' => $salesAndMarketingUnitCount  * $salesAndMarketingCostPerUnit  ,
            'company_id'=>getCurrentCompanyId() ,
            'creator_id'=>Auth()->user()->id ,
        ]);
        return $this ; 
    }

    public function updateSalesAndMarketingExpense(Request $request)
    {
        $this->salesAndMarketingExpenses()->detach();
        $this->storeSalesAndMarketingExpense($request);
        return $this ; 
    }
    
     public function storeGeneralExpense(Request $request)
    {
        $this->generalExpenses()->attach([
            'general_expense_id'=>GeneralExpense::create()->id
        ]  , [
            'percentage_of_price'=>$request->get('gaex_expense_percentage') ,
            'cost_per_unit'=> $generalExpenseCostPerUnit = $request->get('gaex_cost_per_unit') ,
            'unit_cost'=>$generalExpenseUnitCount = $request->get('gaex_units_count'),
            'total_cost' => $generalExpenseUnitCount  * $generalExpenseCostPerUnit  ,
            'company_id'=>getCurrentCompanyId() ,
            'creator_id'=>Auth()->user()->id ,
        ]);
        return $this ; 
    }

    public function updateGeneralExpense(Request $request)
    {
        $this->generalExpenses()->detach();
        $this->storeGeneralExpense($request);
        return $this ; 
    }


    public function storeProfitability(Request $request)
    {
        $this->profitability()->create([
            'percentage'=>$request->get('corporate_taxes_percentage'),
            'net_profit_after_taxes'=>$request->get('net_profit_after_taxes_percentage'),
            'vat'=>$request->get('vat_percentage'),           
            'company_id'=>getCurrentCompanyId() ,
            'creator_id'=>Auth()->user()->id 
            
        ]);
        return $this ; 
    }

    public function updateProfitability(Request $request)
    {
        $this->profitability()->delete();
        $this->storeProfitability($request);
        return $this ;
    }

    public function setPriceSensitivityAttribute($val)
    {
        return $this->attributes['price_sensitivity']  = $val ?: 0 ;
    }
    
    
    
    


    
}