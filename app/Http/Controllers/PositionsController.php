<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$positions = DB::table('positions')->where('company_id',$company->id)->get();
		// $headers = [
		// 	'name'=>[
		// 		'title'=>__('Name'),
		// 		'class'=>'text-center'
		// 	],
		// 	'position-type'=>[
		// 		'title'=>__('Position Type'),
		// 		'class'=>'text-center'
		// 	]
		// ];
		$items = [];
		foreach($positions as $index=>$positionArr){
				$positionType = camelizeWithSpace($positionArr->position_type,'-') ;
				$items[$positionType][$index]['name'] =$positionArr->name ;
				$items[$positionType][$index]['id'] =$positionArr->id ;
		}
        return view('admin.positions.index',compact('company','positions','items'));
    }

    public function create(Company $company)
    {
		return view('admin.positions.crud',[
			'company'=>$company,
			'title'=>__('Create Position'),
			'storeRoute'=>route('positions.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('positions.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null,
			'positionTypes'=>Position::getTypes()
		]);
		
    }

    public function store(Request $request , Company $company)
    {
	
		foreach($request->get('positions',[]) as $positionArr){
			$positionType = $positionArr['position_type'] ;
			$positionName = $positionArr['name'] ; 
			$isExist = Position::where('company_id',$company->id)->where('position_type',$positionType)->where('name',$positionName )->exists();
			if(!$isExist){
				Position::create([
					'position_type'=>$positionType ,
					'name'=>$positionName ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('positions.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,Position $position  )
    {
		
		return view('admin.positions.crud',[
			'company'=>$company ,
			'title'=>__('Edit Position'),
			'storeRoute'=>route('positions.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('positions.index',['company'=>$company->id]),
			'updateRoute'=>route('positions.update',['position'=>$position->id,'company'=>$company->id ]) ,
			'model'=>$position,
		'positionTypes'=>Position::getTypes()
			
		]);
    }

   
    public function update(Request $request, Company $company , Position $position)
    {
	
				$position->update([
					'name'=>$request->get('name'),
					'position_type'=>$request->get('position_type'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('positions.index',['company'=>$company->id] );
			}
			
			
			public function destroy(Company $company , Position $position)
			{
		try{
			
			$position->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Position Can Not Be Deleted , It Related To Another Record'));
		}

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
