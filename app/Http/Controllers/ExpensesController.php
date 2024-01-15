<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Expense;
	use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$expenses = DB::table('expenses')->where('company_id',$company->id)->get();
		$items = [];
		foreach($expenses as $index=>$expenseArr){
				$expenseType = camelizeWithSpace($expenseArr->expense_type,'-') ;
				$items[$expenseType][$index]['name'] =$expenseArr->name ;
				$items[$expenseType][$index]['id'] =$expenseArr->id ;
		}
        return view('admin.expenses.index',compact('company','expenses','items'));
    }

    public function create(Company $company)
    {
		return view('admin.expenses.crud',[
			'company'=>$company,
			'title'=>__('Create Expense'),
			'storeRoute'=>route('expenses.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('expenses.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null,
			'expenseTypes'=>Expense::getTypes()
		]);
		
    }

    public function store(Request $request , Company $company)
    {
		foreach($request->get('expenses',[]) as $expenseArr){
			$expenseType = $expenseArr['expense_type'] ;
			$expenseName = $expenseArr['name'] ; 
			$isExist = Expense::where('company_id',$company->id)->where('expense_type',$expenseType)->where('name',$expenseName )->exists();
			if(!$isExist){
				Expense::create([
					'expense_type'=>$expenseType ,
					'name'=>$expenseName ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('expenses.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,Expense $expense  )
    {
		
		return view('admin.expenses.crud',[
			'company'=>$company ,
			'title'=>__('Edit Expense'),
			'storeRoute'=>route('expenses.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('expenses.index',['company'=>$company->id]),
			'updateRoute'=>route('expenses.update',['expense'=>$expense->id,'company'=>$company->id ]) ,
			'model'=>$expense,
		'expenseTypes'=>Expense::getTypes()
			
		]);
    }

   
    public function update(Request $request, Company $company , Expense $expense)
    {
	
				$expense->update([
					'name'=>$request->get('name'),
					'expense_type'=>$request->get('expense_type'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('expenses.index',['company'=>$company->id ] );
    }

  
    public function destroy(Company $company , Expense $expense)
    {
		try{
			$expense->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Expense Can Not Be Deleted , It Related To Another Record'));
		}
		
      

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
