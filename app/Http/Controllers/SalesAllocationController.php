<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Expense;
use App\Models\SalesAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SalesAllocationController extends Controller
{

    public function index(Company  $company )
    {
		$salesAllocations = SalesAllocation::where('company_id',$company->id)->get();
		$items = [];
		foreach($salesAllocations as $index=>$salesAllocation){
				$type = camelizeWithSpace($salesAllocation->type,'-') ;
				$items[$type][$index]['name'] =$salesAllocation->name ;
				$items[$type][$index]['id'] =$salesAllocation->id ;
		}
        return view('admin.sales-allocation.index',compact('company','salesAllocations','items'));
    }

    public function create(Company $company)
    {
		return view('admin.sales-allocation.create',[
			'company'=>$company,
			'title'=>__('Create Sales Allocations Types'),
			'storeRoute'=>route('sales-allocations.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('sales-allocations.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null,
			'types'=>SalesAllocation::getTypes()
		]);
		
    }

    public function store(Request $request , Company $company)
    {
	foreach(SalesAllocation::getTypes() as $typeId => $typeTitle){
		foreach($request->get($typeId,[]) as $salesAllocationArr){
			$name = $salesAllocationArr['name'] ; 
			$isExist = SalesAllocation::where('company_id',$company->id)->where('type',$typeId)->where('name',$name )->exists();
			if(!$isExist){
				SalesAllocation::create([
					'type'=>$typeId ,
					'name'=>$name ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	}		
	// dd('good');
		
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('sales-allocations.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,SalesAllocation $sales_allocation  )
    {
		
		return view('admin.sales-allocation.edit',[
			'company'=>$company ,
			'title'=>__('Edit Sales Allocation'),
			'storeRoute'=>route('sales-allocations.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('sales-allocations.index',['company'=>$company->id]),
			'updateRoute'=>route('sales-allocations.update',['sales_allocation'=>$sales_allocation->id,'company'=>$company->id ]) ,
			'model'=>$sales_allocation,
			'types'=>SalesAllocation::getTypes()
			
		]);
    }

   
    public function update(Request $request, Company $company , SalesAllocation $sales_allocation)
    {
				$sales_allocation->update([
					'name'=>$request->get('name'),
					'type'=>$request->get('type'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('sales-allocations.index',['company'=>$company->id ] );
    }

  
    public function destroy(Company $company , SalesAllocation $sales_allocation)
    {
		try{
			$sales_allocation->delete();
		}
		catch(\Exception $e){
			return redirect()->back()->with('fail',__('This Sales Allocation Can Not Be Deleted , It Related To Another Record'));
		}
        return redirect()->back()->with('fail',__('Deleted Successfully'));
    }
}
