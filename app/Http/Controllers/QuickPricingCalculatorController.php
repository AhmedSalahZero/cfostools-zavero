<?php

namespace App\Http\Controllers;

use App\Exports\QuickPricingCalculatorExport;
use App\Http\Requests\QuickPricingCalculatorRequest;
use App\Models\Company;
use App\Models\PricingPlan;
use App\Models\QuickPricingCalculator;
use App\Models\Repositories\QuickPricingCalculatorRepository;
use Illuminate\Http\Request;

class QuickPricingCalculatorController extends Controller
{
    private QuickPricingCalculatorRepository $quickPricingCalculatorRepository ; 
    
    public function __construct(QuickPricingCalculatorRepository $quickPricingCalculatorRepository )
    {
        // $this->middleware('permission:view branches')->only(['index']);
        // $this->middleware('permission:create branches')->only(['store']);
        // $this->middleware('permission:update branches')->only(['update']);
        $this->quickPricingCalculatorRepository = $quickPricingCalculatorRepository;
    }
    
    public function view()
    {
		$pricingPlans = PricingPlan::where('company_id',getCurrentCompanyId())->get();
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
					$quickPricingCalculatorServiceItemName = $quickPricingCalculator->getServiceItemName();
					$quickPricingCalculatorId = $quickPricingCalculator->getId();
					$quickPricingCalculatorCountOrDays = $quickPricingCalculator->getCountOrDays();
					$totalRecommendedWithoutVatFormatted = $quickPricingCalculator->getTotalRecommendPriceWithoutVatFormatted();
					$totalNetProfitAfterTaxesFormatted = $quickPricingCalculator->getTotalNetProfitAfterTaxesFormatted();
					$totalNetProfitAfterTaxesPercentageFormatted = $quickPricingCalculator->getTotalNetProfitAfterTaxesPercentageFormatted();
					$items[$pricingPlanId]['sub_items'][$quickPricingCalculatorId] = [
						'id'=>$quickPricingCalculatorId ,
						'name'=>$quickPricingCalculatorName,
						'service_item_name'=>$quickPricingCalculatorServiceItemName,
						'count_or_days'=>$quickPricingCalculatorCountOrDays , 
						'total_recommended_without_vat_formatted'=>$totalRecommendedWithoutVatFormatted,
						// 'total_recommended_without_vat'=>$totalRecommendedWithoutVat,
						'total_net_profit_after_taxes_formatted'=>$totalNetProfitAfterTaxesFormatted,
						'total_net_profit_after_taxes_percentage_formatted'=>$totalNetProfitAfterTaxesPercentageFormatted,
					];
				}
		}
        return view('admin.quick-pricing-calculator.view' , array_merge(
			QuickPricingCalculator::getViewVars(),
			[
				'items'=>$items
			]
			
		));
    }
    public function create(Company $company,$pricingPlanId = 0 )
    {
        return view('admin.quick-pricing-calculator.create' , array_merge(
			QuickPricingCalculator::getViewVars(),
			['pricingPlanId'=>$pricingPlanId]
		));
    }

     public function paginate(Request $request)
    {
        return $this->quickPricingCalculatorRepository->paginate($request);
    }
	
    public function store(QuickPricingCalculatorRequest $request)
    {		
        App(QuickPricingCalculatorRepository::class)->store($request);
        return response()->json([
            'status'=>true ,
            'message'=>__('Pricing Calculator Has Been Stored Successfully')
        ]);
       
    }

    public function edit(Company $company , Request $request , QuickPricingCalculator $quickPricingCalculator)
    {
        return view(QuickPricingCalculator::getCrudViewName() , array_merge(QuickPricingCalculator::getViewVars() , [
            'type'=>'edit',
            'model'=>$quickPricingCalculator,
        ]));
    }

    public function update(Company $company , Request $request , QuickPricingCalculator $quickPricingCalculator)
    {
        App(QuickPricingCalculatorRepository::class)->update($quickPricingCalculator , $request);
        return response()->json([
            'status'=>true ,
            'message'=>__('Quick Pricing Calculator Has Been Updated Successfully')
        ]);
        
    }

    public function export(Request $request )
    {
        
        return (new QuickPricingCalculatorExport(
            // $this->quickPricingCalculatorRepository->export($request)
            $dataCollectionHere
             , $request ))->download();
    }
	public function destroy(Company $company , QuickPricingCalculator $quickPricingCalculator){
		$quickPricingCalculator->delete();
		return redirect()->back()->with('success',__('Done'));
	}
    
}
