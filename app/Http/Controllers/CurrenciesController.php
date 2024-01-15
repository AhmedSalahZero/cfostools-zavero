<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$currencies = DB::table('currencies')->where('company_id',$company->id)->get();
		$items = [];
		foreach($currencies as $index=>$currencyArr){
				$items[$index]['name'] =$currencyArr->name ;
				$items[$index]['id'] =$currencyArr->id ;
		}
        return view('admin.currencies.index',compact('company','currencies','items'));
    }

    public function create(Company $company)
    {
		return view('admin.currencies.crud',[
			'company'=>$company,
			'title'=>__('Create Currency'),
			'storeRoute'=>route('currencies.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('currencies.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null
		]);
		
    }

    public function store(Request $request , Company $company)
    {
	
		foreach($request->get('currencies',[]) as $currencyArr){
			$currencyName = $currencyArr['name'] ; 
			$isExist = Currency::where('company_id',$company->id)->where('name',$currencyName )->exists();
			if(!$isExist){
				Currency::create([
					'name'=>$currencyName ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('currencies.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,Currency $currency  )
    {
		
		return view('admin.currencies.crud',[
			'company'=>$company ,
			'title'=>__('Edit Currency'),
			'storeRoute'=>route('currencies.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('currencies.index',['company'=>$company->id]),
			'updateRoute'=>route('currencies.update',['currency'=>$currency->id,'company'=>$company->id ]) ,
			'model'=>$currency
			
		]);
    }

   
    public function update(Request $request, Company $company , Currency $currency)
    {
	
				$currency->update([
					'name'=>$request->get('name'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('currencies.index',['company'=>$company->id] );
			}
			
			
			public function destroy(Company $company , Currency $currency)
			{
		try{
			
			$currency->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Currency Can Not Be Deleted , It Related To Another Record'));
		}

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
