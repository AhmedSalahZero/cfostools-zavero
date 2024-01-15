<?php
namespace App\Models\Traits\Mutators ;

use App\Interfaces\Models\IBaseModel;
use App\Models\DirectManpowerExpense;
use App\Models\FreelancerExpense;
use App\Models\GeneralExpense;
use App\Models\OtherDirectOperationExpense;
use App\Models\OtherVariableManpowerExpense;
use App\Models\Position;
use App\Models\QuickPricingCalculator;
use App\Models\SalesAndMarketingExpense;
use Illuminate\Http\Request;

trait QuickPricingCalculatorMutator
{

    
   
    public function storeOfferedServiceSectionWithResult(Request $request):IBaseModel  
    {
        
        foreach(
            ['date','revenue_business_line_id','service_category_id','service_category_id','name',
            'service_item_id','service_nature_id','delivery_days','country_id',
            'state_id','currency_id','price_sensitivity','use_freelancer',
            'total_recommend_price_without_vat','total_recommend_price_with_vat','price_per_day_without_vat','price_per_day_with_vat'
            ,'total_net_profit_after_taxes','net_profit_after_taxes_per_day','total_sensitive_price_without_vat','total_sensitive_price_with_vat'
            ,'sensitive_price_per_day_without_vat','sensitive_price_per_day_with_vat',
            'sensitive_total_net_profit_after_taxes','sensitive_net_profit_after_taxes_per_day','sensitive_net_profit_after_taxes_percentage',
			'pricing_plan_id'
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
    public function  storeDirectManpowerExpense(Request $request)
    {
		
        foreach($request->manpower_expenses as $manpowerExpenseArray)
        {
            $directManpowerExpense = DirectManpowerExpense::create();
         $this->directManpowerExpenses()->attach([
            'direct_expense_id'=>$directManpowerExpense->id 
        ]  , [
             'working_days'=>$manpowerExpenseArray['manpower_expense_working_days']?:0 ,
            'cost_per_day' =>$manpowerExpenseArray['manpower_expense_cost_per_day']?:0 ,
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
 
		foreach($request->get('other_variable_direct_operation_expenses',[]) as $otherVariableDirectOperationExpenseArr){
			$expenseId = $otherVariableDirectOperationExpenseArr['expense_id']??null ;
			if($expenseId){
				$costPerUnit =  $otherVariableDirectOperationExpenseArr['mp_cost_per_unit'] ?:0;
			$unitCost = $otherVariableDirectOperationExpenseArr['mp_units_count'] ?:0;
			if($costPerUnit || $unitCost )
			{
				$expense_id = $this->otherVariableManpowerExpenses->where('expense_id',$expenseId)->first();
			// 	$otherVariableManpowerExpenses->create( [
			// 		'name'=>$name , 
			// 	'percentage_of_price'=>$otherVariableDirectOperationExpenseArr['variable_mp_expense_percentage'] ,
			// 	'cost_per_unit'=>  $costPerUnit ?: 0,
			// 	'unit_cost'=> $unitCost?: 0 ,
			// 	'total_cost' => $costPerUnit + $unitCost  ,
			// 	'company_id'=>getCurrentCompanyId() ,
			// 	'creator_id'=>Auth()->user()->id ,
			//  ]);
			// OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->where('otherVariableManpowerExpenseAble_id',0)->delete();
			 $this->otherVariableManpowerExpenses()->create( [
					'expense_id'=>$expense_id , 
				'percentage_of_price'=>$otherVariableDirectOperationExpenseArr['variable_mp_expense_percentage']?:0 ,
				'cost_per_unit'=>  $costPerUnit ?: 0,
				'unit_cost'=> $unitCost?: 0 ,
				'total_cost' => $costPerUnit + $unitCost  ,
				'company_id'=>getCurrentCompanyId() ,
				'creator_id'=>Auth()->user()->id ,
			 ]);
				
			}
			}
			
		}
       
        
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
                $freelancerPercentage = $freelancerExpenseArray['freelancer_percentage']?:0 ;
                $workingDays = $freelancerExpenseArray['freelancer_working_days']?:0 ;
                $costPerDay = $freelancerExpenseArray['freelancer_cost_per_day'] ?:0 ;
                $totalCost = $workingDays * $costPerDay ;
                
                $this->freelancerExpenses()->attach([
                    'freelancer_expense_id'=>FreelancerExpense::create()->id
                    ]  , 
                    [
                        'percentage_of_price'=> $freelancerPercentage,
                        'working_days'=> $workingDays ,
                        'cost_per_day' => $costPerDay ,
                        'total_cost'=> $totalCost  ,
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
		foreach($request->get('other_direct_operation_expenses' ,[]) as  $otherDirectExpenseArr){
			$expenseId = $otherDirectExpenseArr['expense_id'] ?? null;
			$percentageOfPrice = $otherDirectExpenseArr['direct_opex_expense_percentage'] ?:0;
              $costPerUnit = $otherDirectExpenseArr['direct_opex_cost_per_unit']?:0;
              $directOpexUnit = $otherDirectExpenseArr['direct_opex_units_count']?:0 ;
			  if($expenseId){
				$this->otherDirectOperationExpenses()->attach([
					'other_direct_operation_expense_id'=>$expenseId
					// 'other_direct_operation_expense_id'=>OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->first()->id
				]  , [
					'percentage_of_price'=>$percentageOfPrice ,
					'cost_per_unit'=> $costPerUnit ,
					// 'expense_id'=>$expenseId ,
					'unit_cost'=>$directOpexUnit ,
					'total_cost' => $directOpexUnit  * $costPerUnit ,
					'company_id'=>getCurrentCompanyId() ,
					'creator_id'=>Auth()->user()->id ,
				]);
			  }
			//   dd(OtherDirectOperationExpense::all());
        	
		}
              
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
		foreach($request->get('sales_and_marketing_expenses',[]) as $salesAndExpenseArr){
			$expenseId =$salesAndExpenseArr['expense_id'] ?? null ; 
			if($expenseId){
				$percentageOfPrice =$salesAndExpenseArr['smex_expense_percentage'] ?:0 ;
			$salesAndMarketingCostPerUnit =$salesAndExpenseArr['smex_cost_per_unit'] ?:0 ;
			$salesAndMarketingUnitCount =$salesAndExpenseArr['smex_units_count'] ?: 0 ; 
			
			$this->salesAndMarketingExpenses()->attach([
				'sales_and_marketing_expense_id'=>$expenseId
				// 'sales_and_marketing_expense_id'=>SalesAndMarketingExpense::where('company_id',getCurrentCompanyId())->where('expense_id',$expenseId)->first()->id
				]  , [
					'percentage_of_price'=> $percentageOfPrice ,
					'cost_per_unit'=>  $salesAndMarketingCostPerUnit,
					'unit_cost'=> $salesAndMarketingUnitCount ,
					// 'expense_id'=> $expenseId ,
					'total_cost' => $salesAndMarketingUnitCount  * $salesAndMarketingCostPerUnit  ,
					'company_id'=>getCurrentCompanyId() ,
					'creator_id'=>Auth()->user()->id ,
				]);
			}
			
			}
			
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
		foreach($request->get('general_expenses',[]) as $generalExpenseArr){
			$expenseId = $generalExpenseArr['expense_id'] ??  null ;
			if($expenseId){
				
				$percentageOfPrice = $generalExpenseArr['gaex_expense_percentage'] ?:0;
			$generalExpenseCostPerUnit = $generalExpenseArr['gaex_cost_per_unit'] ?:0;
			$generalExpenseUnitCount = $generalExpenseArr['gaex_units_count'] ?: 0 ;
			$this->generalExpenses()->attach([
				'general_expense_id'=>$expenseId
				// 'general_expense_id'=>GeneralExpense::where('company_id',getCurrentCompanyId())->where('expense_id',$expenseId)->first()->id
			]  , [
				'percentage_of_price'=> $percentageOfPrice ,
				'cost_per_unit'=>   $generalExpenseCostPerUnit ,
				'unit_cost'=> $generalExpenseUnitCount ,
				// 'expense_id'=> $expenseId ,
				'total_cost' => $generalExpenseUnitCount  * $generalExpenseCostPerUnit  ,
				'company_id'=>getCurrentCompanyId() ,
				'creator_id'=>Auth()->user()->id ,
			]);
			
			}
			
		}
       
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
        $percentage = $request->get('corporate_taxes_percentage') ;
        $vatPercentage  = $request->get('vat_percentage');
        $netProfitAfterTaxes = $request->get('net_profit_after_taxes_percentage') ;
        $this->profitability()->create([
            'percentage'=>$percentage ,
            'net_profit_after_taxes'=> $netProfitAfterTaxes ,
            'vat'=> $vatPercentage,            
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
