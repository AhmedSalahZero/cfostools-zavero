<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$categories = DB::table('categories')->where('company_id',$company->id)->get();
		// $headers = [
		// 	'name'=>[
		// 		'title'=>__('Name'),
		// 		'class'=>'text-center'
		// 	],
		// 	'category-type'=>[
		// 		'title'=>__('Category Type'),
		// 		'class'=>'text-center'
		// 	]
		// ];
		$items = [];
		foreach($categories as $index=>$categoryArr){
				$items[$index]['name'] =$categoryArr->name ;
				$items[$index]['id'] =$categoryArr->id ;
		}
        return view('admin.categories.index',compact('company','categories','items'));
    }

    public function create(Company $company)
    {
		return view('admin.categories.crud',[
			'company'=>$company,
			'title'=>__('Create Category'),
			'storeRoute'=>route('categories.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('categories.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null
		]);
		
    }

    public function store(Request $request , Company $company)
    {
	
		foreach($request->get('categories',[]) as $categoryArr){
			$categoryName = $categoryArr['name'] ; 
			$isExist = Category::where('company_id',$company->id)->where('name',$categoryName )->exists();
			if(!$isExist){
				Category::create([
					'name'=>$categoryName ,
					'company_id'=>$company->id , 
					'created_by'=>auth()->user()->id ,
				]);
			}
		}
	
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('categories.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,Category $category  )
    {
		
		return view('admin.categories.crud',[
			'company'=>$company ,
			'title'=>__('Edit Category'),
			'storeRoute'=>route('categories.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('categories.index',['company'=>$company->id]),
			'updateRoute'=>route('categories.update',['category'=>$category->id,'company'=>$company->id ]) ,
			'model'=>$category
			
		]);
    }

   
    public function update(Request $request, Company $company , Category $category)
    {
	
				$category->update([
					'name'=>$request->get('name'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('categories.index',['company'=>$company->id] );
			}
			
			
			public function destroy(Company $company , Category $category)
			{
		try{
			
			$category->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Category Can Not Be Deleted , It Related To Another Record'));
		}

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
