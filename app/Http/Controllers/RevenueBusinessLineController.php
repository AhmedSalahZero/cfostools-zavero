<?php

namespace App\Http\Controllers;

use App\Exports\RevenueBusinessLineExport;
use App\Http\Requests\RevenueBusinessGroupingRequest;
use App\Http\Requests\RevenueBusinessLineRequest;
use App\Http\Requests\ServiceItemRequest;
use App\Models\BusinessSector;
use App\Models\Category;
use App\Models\Company;
use App\Models\Repositories\RevenueBusinessLineRepository;
use App\Models\RevenueBusinessLine;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Validators\RevenueBusinessLineValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueBusinessLineController extends Controller
{
    private RevenueBusinessLineRepository $revenueBusinessLineRepository ;
    
    public function __construct(RevenueBusinessLineRepository $revenueBusinessLineRepository)
    {
        // $this->middleware('permission:view branches')->only(['index']);
        // $this->middleware('permission:create branches')->only(['store']);
        // $this->middleware('permission:update branches')->only(['update']);

        $this->revenueBusinessLineRepository = $revenueBusinessLineRepository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        $tableVars = RevenueBusinessLine::getViewVars() ;
        
        $items = [];
        $revenueBusinessLines = RevenueBusinessLine::with('serviceCategories.serviceItems')->where('company_id', $company->id)->get();
        // dd($revenueBusinessLines[0]);
        foreach($revenueBusinessLines as $index=>$revenueBusinessLine) {
            $revenueBusinessLineName = $revenueBusinessLine->getName();
			if($revenueBusinessLineName){
				$revenueBusinessLineId = $revenueBusinessLine->id;
				$items[$revenueBusinessLineId]['data'] = ['name'=>$revenueBusinessLineName];
				foreach($revenueBusinessLine->serviceCategories as $category) {
					$categoryName = $category->getName();
					$categoryId = $category->id;
					$items[$revenueBusinessLineId]['sub_items'][$categoryId]['data'] = ['name'=>$categoryName];
					foreach($category->serviceItems as $serviceItem) {
						$serviceName = $serviceItem->getName() ;
						
						$items[$revenueBusinessLineId]['sub_items'][$categoryId]['sub_items'][$serviceItem->id]['data'] = ['name'=>$serviceName];
					   
						
					}
				}	
			}
            
        }
        // dd($items);
        return view('admin.revenue-business-line.view', array_merge($tableVars, ['items'=>$items,'company'=>$company ]));
    }
    public function paginate(Request $request)
    {
        return $this->revenueBusinessLineRepository->paginate($request);
    }


    public function create()
    {
        
        return view(
            'admin.revenue-business-line.create',
            array_merge([], RevenueBusinessLine::getViewVars())
        );
    }

    public function store(
        // Request $request
        RevenueBusinessGroupingRequest $request
    ) {
        
        $this->revenueBusinessLineRepository->store($request);
        return response()->json([
            'status'=>true ,
            'message'=>__('Revenue Business Line Has Been Created Successfully'),
            'redirectTo'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company,$id)
    {
		// dd($revenueBusinessLine,$serviceCategory , $serviceItem);
    }
	
	public function editForm(Company $company,  $revenueBusinessLine ,  $serviceCategory = null, $serviceItem = null )
    {
		// dd(RevenueBusinessLine::getViewVars());
		return view(
            'admin.revenue-business-line.create',
            array_merge([
				'editMode'=>true ,
				'revenueBusinessLineId'=>$revenueBusinessLine , 
				'serviceCategoryId'=>$serviceCategory , 
				'serviceItemId'=>$serviceItem, 
				
			], RevenueBusinessLine::getViewVars())
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateForm(Request $request)
    {
		$oldRevenueBusinessLine = RevenueBusinessLine::find($request->get('old_revenue_business_line_id'));
		$oldServiceCategory = ServiceCategory::find($request->get('old_service_category__id'));
		$oldServiceItem = ServiceItem::find($request->get('old_service_item_id'));
		// dd($oldServiceItem,$oldServiceCategory);
		if($oldServiceCategory && !$oldServiceItem){
			$oldServiceCategory->revenue_business_line_id = $request->get('revenue_business_line_id');
			$oldServiceCategory->save();
		}
		if($oldServiceCategory && $oldServiceItem){
			$oldServiceItem->service_category_id = $request->get('service_category_id');
			$oldServiceItem->save();
			$newServiceCategory = ServiceCategory::find($request->get('service_category_id'));
			$newServiceCategory->revenue_business_line_id = $request->get('revenue_business_line_id');
			$newServiceCategory->save();
		}
		
		RevenueBusinessLine::removeUnusedCategories();
		return response()->json([
            'status'=>true ,
            'message'=>__('Done'),
            'redirectTo'=>route('admin.view.revenue.business.line',['company'=>getCurrentCompanyId()])
        ]);
		
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export(Request $request)
    {
        
        return (new RevenueBusinessLineExport($this->revenueBusinessLineRepository->export($request), $request))->download();
    
	}
	
	public function deleteServiceItem(Company $company ,ServiceItem $serviceItem){
		try{
			$serviceItem->delete();
			return redirect()->back()->with('success',__('Service Item Has Been Deleted'));
		}
		catch(\Exception $e){
			return redirect()->back()->with('fail',__('This Service Item Line Can Not Be Deleted .. It Used By Another Record'));
		}
		
	}
	public function deleteServiceCategory(Company $company ,ServiceCategory $serviceCategory){
		try{
			foreach($serviceCategory->serviceItems as $serviceItem){
				$serviceItem->delete();
			}
			$serviceCategory->delete();
			return redirect()->back()->with('success',__('Service Category With Its items Has Been Deleted'));
		}
		catch(\Exception $e){
			return redirect()->back()->with('fail',__('This Service Category Line Can Not Be Deleted .. It Used By Another Record'));
		}
		
		
		
		
	}
	public function deleteRevenueBusinessLine(Company $company ,RevenueBusinessLine $revenueBusinessLine){
		try{
			foreach($revenueBusinessLine->serviceCategories as  $serviceCategory){
				foreach($serviceCategory->serviceItems as $serviceItem){
					$serviceItem->delete();
				}
				$serviceCategory->delete();
			}
			$revenueBusinessLine->delete();
			
		}
		catch(\Exception $e){
			return redirect()->back()->with('fail',__('This Revenue Business Line Can Not Be Deleted .. It Used By Another Record'));
		}
		
		return redirect()->back()->with('success',__('Revenue Business Line With Its items Has Been Deleted'));
		
	}
	



}
