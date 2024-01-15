<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$products = Product::where('company_id',$company->id)->get();
		$items = [];
		foreach($products as $index=>$product){
				$categoryName = camelizeWithSpace($product->getCategoryName(),'-') ;
				$items[$categoryName][$index]['name'] =$product->name ;
				$items[$categoryName][$index]['id'] =$product->id ;
		}
        return view('admin.products.index',compact('company','products','items'));
    }

    public function create(Company $company)
    {
		return view('admin.products.crud',[
			'company'=>$company,
			'title'=>__('Create Product'),
			'storeRoute'=>route('products.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('products.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null,
			'categories'=>Category::where('company_id',$company->id)->get()
		]);
		
    }
	
    public function store(Request $request , Company $company)
    {
		
		foreach($request->get('products',[]) as $productArr){
			$categoryId = $productArr['category_id'] ;
			$productName = $productArr['name'] ; 
			$isExist = Product::where('company_id',$company->id)->where('name',$productName )->exists();
			if(!$isExist){
				Product::create([
					'category_id'=>$categoryId ,
					'name'=>$productName ,
					'company_id'=>$company->id , 
					// 'created_by'=>auth()->user()->id ,
				]);
			}
		}
		
        Session::flash('success',__('Created Successfully'));
        return redirect()->route('products.index',['company'=>$company->id ]);
		
		
    }

    public function show($id)
    {
	}
	
    public function edit(Company $company,Product $product  )
    {
		
		return view('admin.products.crud',[
			'company'=>$company ,
			'title'=>__('Edit Product'),
			'storeRoute'=>route('products.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('products.index',['company'=>$company->id]),
			'updateRoute'=>route('products.update',['product'=>$product->id,'company'=>$company->id ]) ,
			'model'=>$product,
			'categories'=>Category::where('company_id',$company->id)->get()
			
		]);
    }

   
    public function update(Request $request, Company $company , Product $product)
    {
	
				$product->update([
					'name'=>$request->get('name'),
					'product_type'=>$request->get('product_type'),
					'updated_by'=>auth()->user()->id 
				]);
				
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('products.index',['company'=>$company->id] );
			}
			
			
			public function destroy(Company $company , Product $product)
			{
		try{
			
			$product->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Product Can Not Be Deleted , It Related To Another Record'));
		}

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
