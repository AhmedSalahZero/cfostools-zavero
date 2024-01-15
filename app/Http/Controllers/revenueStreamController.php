<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductVolumeMeasurement;
use App\Models\RevenueStreamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class revenueStreamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($company_id)
    {
        $company= Company::find($company_id);
        $Category_products = CategoryProduct::where('company_id',$company_id)->with('revenueStreamType')->with('products')->get();
        foreach ($Category_products as $key=> $category_product){
            foreach ($category_product->products as $product){

                if($product->revenue_stream_type_id == 1 || $product->revenue_stream_type_id == 5){
                    $product['productSelling'] = $product->productUnits['productSelling'];
                    $product['productStocking'] = $product->productUnits['productStocking'];

                    if ($product->revenue_stream_type_id == 1){
                        $product['productPurchasing'] = $product->productUnits['productPurchasing'];
                    }if($product->revenue_stream_type_id == 5) {
                        $product['productmanufacturingBatch'] = $product->productUnits['productmanufacturingBatch'];
                    }
                }
            }
       
        }   
        return view('admin.revenueStream.view', compact('Category_products','company'));
    }

    public function create($company_id)
    {
        $company = Company::find($company_id);
        $revenues = RevenueStreamType::all();
		
        return view('admin.revenueStream.create', compact('company','revenues'));
    }
	
	public function addCategories(Request $request , $company_id)
	{
		
		$company = Company::find($company_id);
        $revenues = RevenueStreamType::all();
		
		if($request->get('add_categories')){
			$validator = Validator::make($request->all() , [
				'type'=>'required'
			],[
				'type.required'=>__('Please Select Revenue Stream Type')
			]);
			// dd($validator->fails(),$request->type);
			if($validator->fails()){
				return redirect()->back()->withErrors($validator)
				->withInput();
			}
			$noCategories = $request->get('categories_count') ;
			$currentSectionName = 'categories';
			
			$noRows = $noCategories ;
			// $firstTdTrs = '';
			// for($instance = 0 ; $instance < $noRows ; $instance ++){
			// 	$firstTdTrs .= generateTrFor([
			// 		[
			// 			'tdClasses'=>'align-middle',
			// 			'tdValue'=>$instance
			// 		],
			// 		[
			// 			'tdClasses'=>'align-middle text-capitalize  text-left',
			// 			'tdAttributes'=>'',
			// 			'inputClasses'=>'form-control placeholder-light-gray exclude-text',
			// 			'inputPlaceholder'=>__('Please Enter Name...'),
			// 			'inputType'=>'text',
			// 			'inputName'=>'name['. $currentSectionName .']['. $instance .']',
			// 			'inputValue'=>''
			// 		],[
			// 			'tdClasses'=>'align-middle text-capitalize  text-left',
			// 			'tdAttributes'=>'',
			// 			'inputClasses'=>'form-control only-greater-than-zero-allowed placeholder-light-gray',
			// 			'inputPlaceholder'=>__('Please Enter Count...'),
			// 			'inputType'=>'numeric',
			// 			'inputName'=>'products_count['. $instance .']',
			// 			'inputValue'=>''
			// 		]
			// 	]);
			// } 
		
			
			// dd($generateFirstTypeTds);
			$canAddCategory = true ;
			$type = $request->get('type');
			return view('admin.revenueStream.create', compact('company','revenues','canAddCategory','noCategories','type'));
		}
		return view('admin.revenueStream.create', compact('company','revenues'));
		
	}
	
	
	 public function store(Request $request,$company_id){
		dd('from request method');
	 }
	 public function storeCategoriesAndGenerateProductsTable(Request $request,$company_id)
    {

		$company = Company::find($company_id);
        $revenues = RevenueStreamType::all();
		$storedCategories = [];
			
			$validator = Validator::make($request->all() , [
				'name'=>'required|array' ,
				'type'=>'required'
			],[
				'name.required'=>__('Please Enter Products Name'),
				'type.required'=>__('Please Select Revenue Stream Type'),
				
			]);
			$canAddCategory = true ;
			$noCategories = $request->get('categories_count') ;
			if($validator->fails()){
				return redirect()->back()->withErrors($validator)
				->withInput()
					->with([
						'canAddCategory'=>$canAddCategory,
						'noCategories'=>$noCategories,
						'canAddProducts'=>true ,
						'storedCategories'=>[]
					]);
			}
			foreach($request->name['categories']??[]  ??[] as $index=>$name){
				$productsCount = $request->products_count[$index] ?? 1;
				
				// dd($name);
				// validation if category name already exist
				$checkCategoryIsset=CategoryProduct::where('name','=',$name)->where('company_id','=',$company_id)->exists();
				if($checkCategoryIsset){
					$storedCategories[$name]=[
						'category'=>CategoryProduct::where('name','=',$name)->where('company_id','=',$company_id)->first(),
						'products_count'=>$productsCount
					];
				}
				if(!$checkCategoryIsset && $name){
					$Category_product = CategoryProduct::create([
						'name' => $name,
						'revenue_stream_type_id'=>$request->type,
						'company_id' => $company_id,
						'created_by' => Auth::user()->id,
					]);
					$storedCategories[$name]=[
						'category'=>$Category_product ,
						'products_count'=>$productsCount
					];
				}
			}
			$canAddProducts = true ;
			$type=  $request->type ;
			return view('admin.revenueStream.create', compact('company','revenues','canAddProducts','storedCategories','type'));
	
		
        // $this->validation($request,$company_id,'Create');

        // if($request->category=='new'){
        //     $checkCategoryIsset=CategoryProduct::where('name','=',$request->categoryAdd)->where('company_id','=',$company_id)->count();
        //     if($checkCategoryIsset=='0'){
        //         $Category_product = CategoryProduct::create([
        //             'name' => $request->categoryAdd,
        //             'revenue_stream_type_id'=>$request->type,
        //             'company_id' => $company_id,
        //             'created_by' => Auth::user()->id,
        //         ]);
        //         $category_id=$Category_product->id;
        //     }
        // }else{
        //     $category_id=$request->category;
        // }

        // // product
        // $product = Product::create([
        //     'name' => $request->name,
        //     'category_product_id' => $category_id,
        //     'revenue_stream_type_id'=>$request->type,
        //     'company_id' => $company_id,
        //     'created_by' => Auth::user()->id,
        // ]);
        // if($request->type=='1' || $request->type=='5'){
        //     $b=0;
        //     foreach ($request->product_volume_measurement as $K => $V) {
        //         foreach ($V as $key => $value) {
        //             $b++;    
                              
        //             if($b==1  || ( isset($value['conversion']) &&  @$value['conversion'] !='' && $value['name']!=''  ) ){
        //                     $data['name'] = $value['name'];
        //                     if($b<>1){
        //                         $data['conversation_rate'] = $value['conversion'];
        //                     }
        //                     if($key==0){
        //                         $data['is_main'] = 1;
        //                     }else{
        //                         $data['is_main'] = 0;
        //                     }
        //                     $data['type'] = $K;
        //                     $data['level'] =   $b;
        //                     $data['product_id'] =   $product->id;
        //                     $data['created_by'] = Auth::user()->id;
        //                     $data['company_id'] = $company_id;
        //                     $Product_volume_measurement=ProductVolumeMeasurement::create($data);
        //             }
        //         }
        //     }
        // }

        //redirect
        return redirect()->back()->with(['success' => __('Created Successfully')]);
    }
	
	
	public function addNewProducts(Request $request,$company_id)
    {

		$company = Company::find($company_id);
        $revenues = RevenueStreamType::all();
		// dd($request->all());
		$noRows = $request->get('product_count');
		$productsCount =$noRows;
			
			$validator = Validator::make($request->all() , [
				'type'=>'required'
			],[
				'type.required'=>__('Please Select Revenue Stream Type'),
			]);
			$canAddCategory = false ;
			if($validator->fails()){
				return redirect()->back()->withErrors($validator)
				->withInput()
					->with([
						'canAddCategory'=>$canAddCategory,
						'canAddProducts'=>false ,
						'productsCount'=>$noRows
					]);
			}
		
			$canAddNewProducts = true ;
			$type=  $request->type ;
			
			return view('admin.revenueStream.create', compact('company','productsCount','revenues','canAddNewProducts','type','noRows'));
    }
	
	public function storeProducts(Request $request,$company_id)
	{
		
		$revenueStreamTypeId = $request->get('type') ;
		
		foreach($request->products as $productIndex=>$productsArr){
			foreach($productsArr as $currentIndex => $productArr){
				
				$product = Product::create([
					'name' => $productArr['product_name'],
					'category_product_id' => $productArr['category_id'],
					'revenue_stream_type_id'=>$revenueStreamTypeId,
					'company_id' => $company_id,
					'created_by' => Auth::user()->id,
				]);	
				ProductVolumeMeasurement::create([
					'name'=>$productArr['selling_unit'],
					'is_main'=>1 ,
					'product_id'=>$product->id ,
					'company_id'=>$company_id ,
					'conversation_rate'=>1 ,
					'type'=>'Selling',
					'level'=>1 ,
					'created_by' => Auth::user()->id,
					
				]);
				
			
				ProductVolumeMeasurement::create([
					'name'=>$productArr['stocking_unit'],
					'is_main'=>1 ,
					'product_id'=>$product->id ,
					'company_id'=>$company_id ,
					'conversation_rate'=>$productArr['stocking_conversion_rate']??1 ,
					'type'=>'Stocking',
					'level'=>4 ,
					'created_by' => Auth::user()->id,
				]);
				if($revenueStreamTypeId == 5){
					ProductVolumeMeasurement::create([
						'name'=>'Batch',
						'is_main'=>1 ,
						'product_id'=>$product->id ,
						'company_id'=>$company_id ,
						'conversation_rate'=>$productArr['manufacturing_conversion_rate']??1 ,
						'type'=>'Manufacturing Batch',
						'level'=>7 ,
						'created_by' => Auth::user()->id,
					]);
						
				}elseif($revenueStreamTypeId == 1){
					ProductVolumeMeasurement::create([
						'name'=>$productArr['purchasing_unit'],
						'is_main'=>1 ,
						'product_id'=>$product->id ,
						'company_id'=>$company_id ,
						'conversation_rate'=>$productArr['purchasing_conversion_rate']??1 ,
						'type'=>'Purchasing',
						'level'=>7 ,
						'created_by' => Auth::user()->id,
					]);
				}
				
			}
			
			      
				
		}
		
		return redirect()->route('revenueStream.index',['company_id'=>$company_id])->with('success',__('Revenue Stream Products Has Been Stored Successfully'));
	}
	
    // public function store(Request $request,$company_id)
    // {

	// 	$company = Company::find($company_id);
    //     $revenues = RevenueStreamType::all();
		
	// 	$storedCategories = [];
		
		
		
	// 	if($request->get('add_products')){
			
	// 		$validator = Validator::make($request->all() , [
	// 			'name'=>'required|array|unique:category_products,name,'.$company->id ,
	// 			'type'=>'required'
	// 		],[
	// 			'name.required'=>__('Please Enter Products Name'),
	// 			'type.required'=>__('Please Select Revenue Stream Type'),
				
	// 		]);
	// 		$canAddCategory = true ;
	// 		$noCategories = $request->get('categories_count') ;
	// 		if($validator->fails()){
	// 			return redirect()->back()->withErrors($validator)
	// 			->withInput()
	// 			->with([
	// 				'canAddCategory'=>$canAddCategory,
	// 				'noCategories'=>$noCategories,
	// 			]);
	// 		}
	// 		// dd($request->name,$request->name['categories']);
	// 		foreach($request->name['categories']??[]  ??[] as $index=>$name){
	// 			$productsCount = $request->products_count[$index] ?? 1;
				
	// 			// dd($name);
	// 			// validation if category name already exist
	// 			$checkCategoryIsset=CategoryProduct::where('name','=',$name)->where('company_id','=',$company_id)->exists();
	// 			if($checkCategoryIsset){
	// 				$storedCategories[$name]=[
	// 					'category'=>CategoryProduct::where('name','=',$name)->where('company_id','=',$company_id)->first(),
	// 					'products_count'=>$productsCount
	// 				];
	// 			}
	// 			if(!$checkCategoryIsset && $name){
	// 				$Category_product = CategoryProduct::create([
	// 					'name' => $name,
	// 					'revenue_stream_type_id'=>$request->type,
	// 					'company_id' => $company_id,
	// 					'created_by' => Auth::user()->id,
	// 				]);
	// 				$storedCategories[$name]=[
	// 					'category'=>$Category_product ,
	// 					'products_count'=>$productsCount
	// 				];
	// 			}
	// 		}

	// 		$canAddProducts = true ;
	// 		return view('admin.revenueStream.create', compact('company','revenues','canAddProducts','storedCategories'));
			
			
	// 		// every thing is good
			
			
			
			
			
			
	// 		// dd($validator->fails(),$request->all());
	// 	}
	// 	dd('gooddddd');
		
    //     $this->validation($request,$company_id,'Create');

    //     // insert category
    //     if($request->category=='new'){
    //         $checkCategoryIsset=CategoryProduct::where('name','=',$request->categoryAdd)->where('company_id','=',$company_id)->count();
    //         if($checkCategoryIsset=='0'){
    //             $Category_product = CategoryProduct::create([
    //                 'name' => $request->categoryAdd,
    //                 'revenue_stream_type_id'=>$request->type,
    //                 'company_id' => $company_id,
    //                 'created_by' => Auth::user()->id,
    //             ]);
    //             $category_id=$Category_product->id;
    //         }
    //     }else{
    //         $category_id=$request->category;
    //     }

    //     // product
    //     $product = Product::create([
    //         'name' => $request->name,
    //         'category_product_id' => $category_id,
    //         'revenue_stream_type_id'=>$request->type,
    //         'company_id' => $company_id,
    //         'created_by' => Auth::user()->id,
    //     ]);


    //     // product volume measurement item 
    //     if($request->type=='1' || $request->type=='5'){
    //         $b=0;
    //         foreach ($request->product_volume_measurement as $K => $V) {
    //             foreach ($V as $key => $value) {
    //                 $b++;    
                              
    //                 if($b==1  || ( isset($value['conversion']) &&  @$value['conversion'] !='' && $value['name']!=''  ) ){
    //                         $data['name'] = $value['name'];
    //                         if($b<>1){
    //                             $data['conversation_rate'] = $value['conversion'];
    //                         }
    //                         if($key==0){
    //                             $data['is_main'] = 1;
    //                         }else{
    //                             $data['is_main'] = 0;
    //                         }
    //                         $data['type'] = $K;
    //                         $data['level'] =   $b;
    //                         $data['product_id'] =   $product->id;
    //                         $data['created_by'] = Auth::user()->id;
    //                         $data['company_id'] = $company_id;
    //                         $Product_volume_measurement=ProductVolumeMeasurement::create($data);
    //                 }
    //             }
    //         }
    //     }

    //     //redirect
    //     return redirect()->back()->with(['success' => __('Created Successfully')]);
    // }

    public function edit($company_id,$revenueStream)
    {
        $Product=Product::findOrFail($revenueStream);
        $company = Company::find($company_id);
        $revenuStream = RevenueStreamType::find($Product->revenue_stream_type_id);
        $Category_product=$revenuStream->categoryProducts($company_id);
        $Product_volume_measurement=ProductVolumeMeasurement::where('product_id',$revenueStream)->get();
        $revenues = RevenueStreamType::all();
        

        $Product_measurement = [];
        foreach ($Product_volume_measurement as $key => $value) {
            $Product_measurement[$value->level]=$value;
        }
        return view('admin.revenueStream.edit', compact('Product','company','CategoryProduct','Product_measurement','revenues'));
    }

    public function update(Request $request, $revenuStream,$company_id )
    {
        $this->validation($request,$company_id,$revenuStream);

        // insert category
        if($request->category=='new'){
            $checkCategoryIsset=CategoryProduct::where('name','=',$request->categoryAdd)->where('company_id','=',$company_id)->count();
            if($checkCategoryIsset=='0'){
                $Category_product = CategoryProduct::create([
                    'name' => $request->categoryAdd,
                    'revenue_stream_type_id'=>$request->type,
                    'company_id' => $company_id,
                    'created_by' => Auth::user()->id,
                ]);
                $category_id=$Category_product->id;
            }
        }else{
            $category_id=$request->category;
        }

        // product
        $product = Product::find($revenuStream);
        $product->update([
            'name' => $request->name,
            'category_product_id' => $category_id,
            'revenue_stream_type_id' => $request->type,
            'company_id' => $company_id,
            'updated_by' => Auth::user()->id,
        ]);


        // product volume measurement item 
        if($request->type=='1' || $request->type=='5'){
            $b=0;
            foreach ($request->product_volume_measurement as $K => $V) {
                foreach ($V as $key => $value) {
                    $b++;    
                              
                    if($b==1  || ( isset($value['conversion']) &&  @$value['conversion'] !='' && $value['name']!=''  ) ){

                            $data['name'] = $value['name'];
                            if($b<>1){
                                $data['conversation_rate'] = $value['conversion'];
                            }else{
                                $data['conversation_rate'] = 1;
                            }
                            if($key==0){
                                $data['is_main'] = 1;
                            }else{
                                $data['is_main'] = 0;
                            }
                            
                            $data['type'] = $K;
							$level = null ;
							if($K == 'Selling'){
								$level = 1 ;
							}
							elseif($K == 'Stocking'){
								$level = 4;
							}
							elseif($K == 'Purchasing' || $K == 'Manufacturing Batch'){
								$level = 7 ;
							}
                            $data['level'] =$level    ;
                            $data['product_id'] =   $product->id;
                            $data['created_by'] = Auth::user()->id;
                            $data['company_id'] = $company_id;

                            $checkIsset=ProductVolumeMeasurement::where('product_id',$revenuStream)->where('level',$b)->first();

                            if($checkIsset['id']==0){
                                // create
                                $Product_volume_measurement=ProductVolumeMeasurement::create($data);
                            }else{
                                //update
                                $Product_volume_measurement=ProductVolumeMeasurement::find($checkIsset['id']);
                                $Product_volume_measurement->update($data);
                            }
                    }
                }
            }
        }else{
            $Product_volume_measurement=ProductVolumeMeasurement::where('product_id',$revenuStream);
            $Product_volume_measurement->delete();
        }
        //redirect
        if ($request->submit == 'Submit And Close') {
            return redirect()->route('revenueStream.index',$company_id)->with(['success' => __('Updated Successfully')]);
        }else{
            return redirect()->back()->with(['success' => __('Updated Successfully')]);
        }
    }

    public function destroy($company_id,$revenuStream)
    {
		$product = Product::find($revenuStream);
        $product->delete();
        return redirect()->back()->with(['success' => __('Deleted Successfully')]);
    }
    // Ajax 
    public function getCategories(Request $request,$company_id)
    { 
        $revenuStream =RevenueStreamType::find($request->revenue_stream_type_id);
        if(isset($request->financial_id)){

            $category_products = [];
            $revenuStream_id = $revenuStream->id ;
            // $financial_plan =FinancialPlan::with(['SalesPlans'=>function($sales_plan)use($revenuStream_id,&$category_products){
            //     $sales_plan->where('revenue_type_id',$revenuStream_id)->with(['salesPlanItems'=>function($item)use(&$category_products){
            //         $ids =$item->pluck('category_product_id','id')->toArray();
                
            //         $category_products = array_merge($category_products,$ids) ;
            //     return $category_products;
            //     }]);
            // }])->find($request->financial_id);
            $category_products= CategoryProduct::whereIn('id',$category_products)->get();
        }else{
            $category_products = $revenuStream->categoryProducts($company_id);
        }
        
        return $category_products;
    }
    public function getView(Request $request,$company_id)
    {
        $measurement_number=0;
        $measurement_items=[];
         
        // Tradable Product
        if ($request->revenue_stream_type_id == 1) {
            $measurement_items['Selling']="";
            $measurement_items['Stocking']=__("Conversion rate Stocking Against Selling");
            $measurement_items['Purchasing']=__("Conversion rate Purchasing Against Stocking");
        }
        // Manufacturing Dispensing Unit
        elseif ($request->revenue_stream_type_id == 5) {
            
            $measurement_items['Selling']="";
            $measurement_items['Stocking']=__("Conversion rate Stocking Against Selling");
            $measurement_items['Manufacturing Batch']=__("Conversion rate Batch Against Stocking");
            // $measurement_items['Purchasing']="Convertion rate main Purchasing VS main stocking";
        }
        return view('admin.revenueStream.tradable_manufacturing',compact('measurement_number','measurement_items'));
    }
    // Valodation
    public function validation(Request $request,$company_id,$revenuStream){
        // validation
        // validation name category
        if($request->category=='new' && $request->categoryAdd==''){
            $validation['categoryAdd']='required';
        }elseif($request->category=='new'){
            if($revenuStream>0){
                $checkCategoryIsset=CategoryProduct::where('name','=',$request->categoryAdd)->where('company_id','=',$company_id)->where('id','!=',$revenuStream)->count();
            }else{
                $checkCategoryIsset=CategoryProduct::where('name','=',$request->categoryAdd)->where('company_id','=',$company_id)->count();
            }
            if($checkCategoryIsset!='0'){
                $validation['categoryIsset']='required';
            }
        }

        // validation name product
        if($request->name<>'' && isset($revenuStream)){
            if($revenuStream>0){
                $checkCategoryIsset=Product::where('name','=',$request->name)->where('company_id','=',$company_id)->where('id','!=',$revenuStream)->count();
            }else{
                $checkCategoryIsset=Product::where('name','=',$request->name)->where('company_id','=',$company_id)->count();
            }
            if($checkCategoryIsset!='0'){
                $validation['productIsset']='required';
            }
        }

        $validation['name']='required';
        $validation['type']='required';
        $validation['category']='required';
        if($request->type=='1' || $request->type=='5'){
            $validation['product_volume_measurement.*.0.*']='required';
        }
        $this->validate($request, $validation, [
            'productIsset.required' => "Product Name is existed before.",
            'categoryIsset.required' => "New Category Name is existed before.",
            'categoryAdd.required' => "New Category is required",
        ]);

    }

}
