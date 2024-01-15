<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\PricingPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PricingPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company  $company )
    {
		$pricingPlans = PricingPlan::where('company_id',$company->id)->get();
		$items = [];
		foreach($pricingPlans as $pricingPlanIndex=>$pricingPlan){
				$pricingPlanName = $pricingPlan->getName() ;
				$pricingPlanId = $pricingPlan->id ;
				$quickPricingCalculators = $pricingPlan->quickPricingCalculators ;
				$items[$pricingPlanId]['data']=[
					'id'=>$pricingPlanId ,
					'name'=>$pricingPlanName
				];
				
				foreach($quickPricingCalculators as $quickPricingCalculator){
					$quickPricingCalculatorName = $quickPricingCalculator->getName();
					$quickPricingCalculatorId = $quickPricingCalculator->getId();
					$items[$pricingPlanId]['sub_items'][$quickPricingCalculatorId] = [
						'id'=>$quickPricingCalculatorId ,
						'name'=>$quickPricingCalculatorName
					];
				}
		}
		
        return view('admin.pricing-plans.index',compact('company','pricingPlans','items'));
    }

    public function create(Company $company)
    {
		return view('admin.pricing-plans.crud',[
			'company'=>$company,
			'title'=>__('Create Pricing Plan'),
			'storeRoute'=>route('pricing-plans.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('pricing-plans.index',['company'=>$company->id ]),
			'updateRoute'=>null ,
			'model'=>null,
		]);
		
    }

    public function store(Request $request , Company $company)
    {
		/**
		 * ? Comment This If You Enable Repeater
		 */
		// foreach($request->get('pricing_plans',[]) as $pricingPlanArr){
			// $pricingPlanName = $pricingPlanArr['name'] ; 
			$pricingPlanName = $request->get('name');
			$pricingPlan = PricingPlan::where('company_id',$company->id)->where('name',$pricingPlanName )->first();
			if(!$pricingPlan){
				$pricingPlan = PricingPlan::create([
					'name'=>$pricingPlanName,
					'company_id'=>$company->id , 
				]);
				// }
				
			}
			
			// dd('ddd');
		// dd('good');
		return response()->json([
			'status'=>true ,
			'message'=>'good'
		]);
        Session::flash('success',__('Created Successfully'));
		return redirect()->route('admin.create.quick.pricing.calculator',[
			'pricingPlanId'=>$pricingPlan->id,
			'company'=>$company->id
		]);
        // return redirect()->route('pricing-plans.index',['company'=>$company->id ]);

      
    }

    public function show($id)
    {
    }

    public function edit(Company $company,PricingPlan $pricing_plan  )
    {
		
		return view('admin.pricing-plans.crud',[
			'company'=>$company ,
			'title'=>__('Edit Pricing Plan'),
			'storeRoute'=>route('pricing-plans.store',['company'=>$company->id ]),
			'viewAllRoute'=>route('pricing-plans.index',['company'=>$company->id]),
			'updateRoute'=>route('pricing-plans.update',['pricing_plan'=>$pricing_plan->id,'company'=>$company->id ]) ,
			'model'=>$pricing_plan,			
		]);
    }

   
    public function update(Request $request, Company $company , PricingPlan $pricing_plan)
    {
	
				$pricing_plan->update([
					'name'=>$request->get('name'),
				]);
				session::flash('success',__('Updated Successfully'));
				return redirect()->route('admin.view.quick.pricing.calculator',$company->id );
				
    }

  
    public function destroy(Company $company , PricingPlan $pricing_plan)
    {
		try{
			$pricing_plan->delete();
		}
		catch(\Exception $e){
			
			return redirect()->back()->with('fail',__('This Pricing Plan Can Not Be Deleted , It Related To Another Record'));
		}
		
      

        return redirect()->back()->with('fail',__('Deleted Successfully'));

    }


    
}
