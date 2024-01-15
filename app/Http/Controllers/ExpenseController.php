<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\IncomeStatement;
use Illuminate\Http\Request;
//ManufacturingExpenses 
// SalesExpenses
// GeneralExpense
// OperationalExpenses
// MarketExpense
class ExpenseController 
{
	public function create(Company $company,$expenseType)
	{
		$model = IncomeStatement::first();
		return view('admin.expense.expense',[
			'company'=>$company , 
			'pageTitle'=>__(preg_replace('/(?<!\ )[A-Z]/', ' $0', $expenseType)),
			'storeRoute'=>route('admin.store.expense',['company'=>$company->id,'expenseType'=>$expenseType]),
			'type'=>'create',
			'dates'=>$model->getIntervalFormatted()	,
			'category'=>'expense',
			'model'=>$model ,
			'expenseType'=>$expenseType
		]);
	}
	public function store($company_id,Request $request,$expenseType){
		$modelId = $request->get('model_id');
		$modelName = $request->get('model_name');
		$model = ('\App\Models\\'.$modelName)::find($modelId);
		// dd($modelId,$modelName , (array)$request->get('tableIds'),$model);
		foreach((array)$request->get('tableIds') as $tableId){
			// delete all first 
			#::delete all
			// dd($request->get($tableId));
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
		
		return response()->json([
			'status'=>true ,
			'message'=>__('Done'),
			'redirectTo'=>route('admin.create.expense',['company'=>$company_id,'expenseType'=>$expenseType])
		]);
		return redirect()->back()->with('success',__('Done'));
	}
}
