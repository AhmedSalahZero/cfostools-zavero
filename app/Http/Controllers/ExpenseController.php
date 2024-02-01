<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FinancialPlan;
use App\Models\IncomeStatement;
use Carbon\Carbon;
use Illuminate\Http\Request;
//ManufacturingExpenses 
// SalesExpenses
// GeneralExpense
// OperationalExpenses
// MarketExpense
class ExpenseController 
{
	public function create(Company $company,FinancialPlan $financialPlan,$expenseType)
	{
		// dd($financialPlan);
		// $model = IncomeStatement::first();
		// model here must be financialPlan not incomestatement 
		// and dates must be from operation start date to study end date
		$model = $financialPlan;
		$operationStartDate = Carbon::make($financialPlan->getOperationStartDate());
		$studyEndDate = Carbon::make($financialPlan->getStudyEndDate());
			$dates = generateDatesBetweenTwoDates($operationStartDate,$studyEndDate,'addMonth','M\'Y', false, 'Y-m-d');
		
		return view('admin.expense.expense',[
			'company'=>$company , 
			'pageTitle'=>__(preg_replace('/(?<!\ )[A-Z]/', ' $0', $expenseType)),
			'storeRoute'=>route('admin.store.expense',['company'=>$company->id,'expenseType'=>$expenseType,'financialPlan'=>$financialPlan->id]),
			'type'=>'create',
			'dates'=>$dates	,
			'category'=>'expense',
			'model'=>$model ,
			'expenseType'=>$expenseType
		]);
	}
	public function store($company_id,$financial_plan_id,Request $request,$expenseType){
		$financialPlan = FinancialPlan::find($financial_plan_id);
		
		$modelId = $request->get('model_id');
		$modelName = $request->get('model_name');
		$model = ('\App\Models\\'.$modelName)::find($modelId);
		foreach((array)$request->get('tableIds') as $tableId){
			$model->generateRelationDynamically($tableId,$expenseType)->delete();
			foreach((array)$request->get($tableId) as  $tableDataArr){
				if(isset($tableDataArr['name'])){
					$tableDataArr['relation_name']  = $tableId ;
					$tableDataArr['company_id']  = $company_id ;
					$tableDataArr['model_id']   = $modelId ;
					$tableDataArr['model_name']   = $modelName ;
					$tableDataArr['expense_type']   = $expenseType ;
					if($tableDataArr['payment_terms'] == 'customize'){
						$tableDataArr['custom_collection_policy'] = sumDueDayWithPayment($tableDataArr['payment_rate '],$tableDataArr['due_days']);
					}
					$model->generateRelationDynamically($tableId,$expenseType)->create($tableDataArr);
				}
			}
		}
		
		
		
		$redirectUrl = route(App(FinancialPlanController::class)->getRedirectUrlName($financialPlan, $expenseType), [$company_id, $financialPlan->id ,[
						'ManufacturingExpenses'=>'OperationalExpenses',
						'OperationalExpenses'=>'SalesExpenses',
						'SalesExpenses'=>'MarketExpense',
						'MarketExpense'=>'GeneralExpense',
						'GeneralExpense'=>null
				][$expenseType]
			]);
		// dd($redirectUrl,$expenseType,);
				
		return response()->json([
			'status'=>true ,
			'message'=>__('Done'),
			'redirectTo'=>$redirectUrl
		]);
		return redirect()->back()->with('success',__('Done'));
	}
}
