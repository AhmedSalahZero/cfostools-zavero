<?php

namespace App\Http\Controllers;

use App\Exports\QuotationPricingCalculatorExport;
use App\Http\Requests\QuotationPricingCalculatorRequest;
use App\Models\Company;
use App\Models\QuotationPricingCalculator;
use App\Models\Repositories\QuotationPricingCalculatorRepository;
use Illuminate\Http\Request;

class QuotationPricingCalculatorController extends Controller
{
    private QuotationPricingCalculatorRepository $quotationPricingCalculatorRepository ; 
    
    public function __construct(QuotationPricingCalculatorRepository $quotationPricingCalculatorRepository )
    {
        // $this->middleware('permission:view branches')->only(['index']);
        // $this->middleware('permission:create branches')->only(['store']);
        // $this->middleware('permission:update branches')->only(['update']);
        $this->quotationPricingCalculatorRepository = $quotationPricingCalculatorRepository;
    }
    
    public function view()
    {
        return view('admin.quotation-pricing-calculator.view' , QuotationPricingCalculator::getViewVars());
    }
    public function create()
    {
        return view('admin.quotation-pricing-calculator.create' , QuotationPricingCalculator::getViewVars());
    }

     public function paginate(Request $request)
    {
        return $this->quotationPricingCalculatorRepository->paginate($request);
    }
    
    public function store(QuotationPricingCalculatorRequest $request)
    {
        App(QuotationPricingCalculatorRepository::class)->store($request);

        return response()->json([
            'status'=>true ,
            'message'=>__('Quotation Pricing Calculator Has Been Stored Successfully')
        ]);
       
    }

    public function edit(Company $company , Request $request , QuotationPricingCalculator $quotationPricingCalculator)
    {
        return view( QuotationPricingCalculator::getCrudViewName() , array_merge(QuotationPricingCalculator::getViewVars() , [
            'type'=>'edit',
            'model'=>$quotationPricingCalculator
        ]));
    }

    public function update(Company $company , Request $request , QuotationPricingCalculator $quotationPricingCalculator)
    {
        App(QuotationPricingCalculatorRepository::class)->update($quotationPricingCalculator , $request);
        return response()->json([
            'status'=>true ,
            'message'=>__('Quotation Pricing Calculator Has Been Updated Successfully')
        ]);
        
    }

    public function export(Request $request )
    {
        
        return (new QuotationPricingCalculatorExport($this->quotationPricingCalculatorRepository->export($request) , $request ))->download();
    }
    
}
