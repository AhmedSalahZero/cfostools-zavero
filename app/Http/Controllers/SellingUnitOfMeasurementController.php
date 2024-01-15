<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SellingUnitOfMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SellingUnitOfMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$sellingUnitOfMeasurements = DB::table('selling_unit_of_measurements')->where('company_id',$company->id)->get();
		
		$items = [];
		foreach($sellingUnitOfMeasurements as $index=>$sellingUnitOfMeasurementArr){
				$items[$index]['name'] =$sellingUnitOfMeasurementArr->name ;
				$items[$index]['id'] =$sellingUnitOfMeasurementArr->id ;
		}
        return view('admin.selling_unit_of_measurements.index',compact('company','sellingUnitOfMeasurements','items'));
    }

    public function create(Company $company)
    {
		return view('admin.selling_unit_of_measurements.crud',[
			'company'=>$company,
			'title'=>__('Create Selling Unit Of Measurement'),
			'storeRoute'=>route('selling-unit-of-measurements.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('selling-unit-of-measurements.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null
		]);
		
    }

    public function store(Request $request , Company $company)
    {
	
		foreach($request->get('selling_unit_of_measurements',[]) as $sellingUnitOfMeasurementArr){
			$sellingUnitOfMeasurementName = $sellingUnitOfMeasurementArr['name'] ; 
			$isExist = SellingUnitOfMeasurement::where('company_id',$company->id)->where('name',$sellingUnitOfMeasurementName )->exists();
			if(!$isExist){
				SellingUnitOfMeasurement::create([
					'name'=>$sellingUnitOfMeasurementName ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('selling-unit-of-measurements.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,SellingUnitOfMeasurement $selling_unit_of_measurement  )
    {
		
		return view('admin.selling_unit_of_measurements.crud',[
			'company'=>$company ,
			'title'=>__('Edit Selling Unit Of Measurement'),
			'storeRoute'=>route('selling-unit-of-measurements.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('selling-unit-of-measurements.index',['company'=>$company->id]),
			'updateRoute'=>route('selling-unit-of-measurements.update',['selling_unit_of_measurement'=>$selling_unit_of_measurement->id,'company'=>$company->id ]) ,
			'model'=>$selling_unit_of_measurement
			
		]);
    }

   
    public function update(Request $request, Company $company , SellingUnitOfMeasurement $selling_unit_of_measurement)
    {
	
		$selling_unit_of_measurement->update([
					'name'=>$request->get('name'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('selling-unit-of-measurements.index',['company'=>$company->id] );
			}
			
			
			public function destroy(Company $company , SellingUnitOfMeasurement $selling_unit_of_measurement)
			{
		try{
			
			$selling_unit_of_measurement->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Selling Unit Of Measurement Can Not Be Deleted , It Related To Another Record'));
		}

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
