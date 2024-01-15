<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ProductionUnitOfMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductionUnitOfMeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$productionUnitOfMeasurements = DB::table('production_unit_of_measurements')->where('company_id',$company->id)->get();
		
		$items = [];
		foreach($productionUnitOfMeasurements as $index=>$productionUnitOfMeasurementArr){
				$items[$index]['name'] =$productionUnitOfMeasurementArr->name ;
				$items[$index]['id'] =$productionUnitOfMeasurementArr->id ;
		}
        return view('admin.production_unit_of_measurements.index',compact('company','productionUnitOfMeasurements','items'));
    }

    public function create(Company $company)
    {
		return view('admin.production_unit_of_measurements.crud',[
			'company'=>$company,
			'title'=>__('Create Production Unit Of Measurement'),
			'storeRoute'=>route('production-unit-of-measurements.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('production-unit-of-measurements.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null
		]);
		
    }

    public function store(Request $request , Company $company)
    {
	
		foreach($request->get('production_unit_of_measurements',[]) as $productionUnitOfMeasurementArr){
			$productionUnitOfMeasurementName = $productionUnitOfMeasurementArr['name'] ; 
			$isExist = ProductionUnitOfMeasurement::where('company_id',$company->id)->where('name',$productionUnitOfMeasurementName )->exists();
			if(!$isExist){
				ProductionUnitOfMeasurement::create([
					'name'=>$productionUnitOfMeasurementName ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('production-unit-of-measurements.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,ProductionUnitOfMeasurement $production_unit_of_measurement  )
    {
		
		return view('admin.production_unit_of_measurements.crud',[
			'company'=>$company ,
			'title'=>__('Edit Production Unit Of Measurement'),
			'storeRoute'=>route('production-unit-of-measurements.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('production-unit-of-measurements.index',['company'=>$company->id]),
			'updateRoute'=>route('production-unit-of-measurements.update',['production_unit_of_measurement'=>$production_unit_of_measurement->id,'company'=>$company->id ]) ,
			'model'=>$production_unit_of_measurement
			
		]);
    }

   
    public function update(Request $request, Company $company , ProductionUnitOfMeasurement $production_unit_of_measurement)
    {
	
		$production_unit_of_measurement->update([
					'name'=>$request->get('name'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('production-unit-of-measurements.index',['company'=>$company->id] );
			}
			
			
			public function destroy(Company $company , ProductionUnitOfMeasurement $production_unit_of_measurement)
			{
		try{
			
			$production_unit_of_measurement->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Production Unit Of Measurement Can Not Be Deleted , It Related To Another Record'));
		}

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
