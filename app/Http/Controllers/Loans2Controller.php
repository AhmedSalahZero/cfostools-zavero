<?php

namespace App\Http\Controllers;
use App\FinancialPlan;
use App\Http\Controllers\LoansDistributionController;
use App\Models\Company;
use App\Models\Loan2;
use App\Models\Loan;
use App\Models\Loan_long_distribution;
use App\Models\Loan_long_update_rate;
use App\ReadyFunctions\CalculateFixedLoanAtEndService;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Session;

class Loans2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($company_id)
    {
        
        $company = Company::find($company_id);
        // $financial = FinancialPlan::with(['fundingRequired', 'loans'])->findOrFail($financial_id);

        return view('admin.loan2.index', compact('company'
        // , 'financial'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $company_id  )
    {
        
            $routeName = Request()->route()->getAction()['as'] ; 
        if($request->has('storeByAjax'))
        {
            $storeByAjax = true ;
           
        }
        else{
            $storeByAjax = false ;
            $longTermFunding = null ;
        }

        if($request->long_term_funding_id)
        {
             $longTermFunding = $request->long_term_funding_id ;
        }
        else{
            $longTermFunding = null ; 
        }
    
        if($request->has('loanType'))
        {
            $loanType = $request->get('loanType');
        }
        else{
            $loanType =null ;
        }
       if($request->trigger_click)
       {
           $triggerClick = 1 ;
       }
       else{
           $triggerClick = null;

       }
        // if($request->has('trigger_'))

        $company = Company::find($company_id);
        $longTermFunding = null ;
        // $longTermFunding = LongTermFunding::where('id',$request->long_term_funding_id)->first();

       
        if($longTermFunding)
        {
            $loan = Loan2::where('long_term_funding_id' , $longTermFunding->id)->first();
        }
        else{
            $loan = null ; 
        }
        // fixed.loan.fixed.at.end
         if($routeName === 'fixed.loan.fixed.at.end'){
            $type ='fixed';
            
            // fixed == fixed at the end 
            
            return view('admin.loan2.create', compact('company' , 'type' ,'storeByAjax','loanType','longTermFunding','loan','triggerClick'
             
        
         ));       
         }

           if($routeName === 'fixed.loan.fixed.at.beginning'){
            
            $type ='fixed';
            $position = 'at_beginning';
            return view('admin.loan2.create_at_begining', compact('company' , 'type'
            ,'position','storeByAjax','loanType','longTermFunding','loan','triggerClick'
        
         ));       
         }


         if($routeName === 'calc.loan.amount'){
            
            $type ='fixed';
            return view('admin.loan2.create_loan_amount', compact('company' , 'type','storeByAjax','loanType','longTermFunding','loan','triggerClick'
        
         ));       
         }

         if($routeName === 'calc.interest.percentage'){
            
            $type ='fixed';
            return view('admin.loan2.create_interest_percentage', compact('company' , 'type','storeByAjax','loanType','longTermFunding','loan','triggerClick'
        
         ));       
         }

         if($routeName === 'variable.payments'){

            $type ='variable';
            return view('admin.loan2.create_variable', compact('company' , 'type','storeByAjax','loanType','longTermFunding','loan','triggerClick'
         ));       
         }
         
        return view('admin.loan2.create', compact('company' , 'type','storeByAjax','loanType','longTermFunding','loan','triggerClick'
         ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $company_id, Loan $loan)
    {
        
        $company = Company::find($company_id);
        // $financial = FinancialPlan::with(['fundingRequired', 'loans'])->findOrFail($financial_id);
        // $remaining = $financial->fundingRequired->funding_required  - $financial->loans()->sum('loan_amount');
        // $this->validation($request);

        $loan->name                      = $request->name;
        // $loan->financial_plan_id         = $financial_id;
        $loan->company_id                = $company_id;
        $loan->loan_start_month          = $request->start_month;
        $loan->loan_amount               = $request->loan_amount;

        $loan->borrowing_rate            = $request->loan_type == 'variable' ? $request->borrowing_rate : 0;
        $loan->margin_interest           = $request->margin_interest;
        $loan->min_interest              = $request->loan_type == 'variable' ? $request->min_interest : 0;
        $loan->loan_type                 = $request->loan_type;


        $loan->duration               = $request->repayment_duration;
        $loan->grace_period           = $request->grace_period;
        $loan->installment_interval   = $request->installment_interval;
        $loan->interest_interval      = $request->loan_type == 'variable' ? $request->interest_interval : $request->installment_interval;

        $loan->created_by                = auth()->user()->id;
        // $loan->save();
        //////////////// LONG LOAN DISTRIBUTION ////////////////////////

        //if the margin and borrowing rate sum are less than the min interest the intrest rate will be the min interest
        $margin_borrowing_rate = $request->borrowing_rate + $request->margin_interest;
        $interest_rate = $margin_borrowing_rate > $request->min_interest ? $margin_borrowing_rate : $request->min_interest;
        //total duration is to add the repayment_duration to the grace period
        $total_duration = $loan->duration  + $loan->grace_period;
        $loan_start_date = $request->get('start_date');
        $loanLongDistribution = [];
        for ($month = 0; $month < $total_duration; $month++) {

            $loanLongDistribution[] = Loan_long_distribution::make([
                'month' => $month,
                'loan_id' => $loan->id,
                'created_by' => Auth::id()
            ]);

        }
        $loan->setRelation('longDistributions' , $loanLongDistribution );
        $loan->start_date = $loan_start_date ;
        // Saving Distribution data
        $loan_distributions = (new LoansDistributionController)->loanLongDistribution($company_id, null, $loan, 'array' , $request->get('start_date'));
        
        $loan_type = $loan->loan_type;

        $distribution_data = $this->loanSavingDistributionData($loan_distributions, $loan_type);

        $loan->distribution_data = $distribution_data;


        if($loan->loan_type == "fixed"){
            return (new LoansDistributionController())->loanLongDistribution($company->id , 0 , $loan , 'view' , $loan->start_date);
        }
        elseif($loan->loan_type == 'variable'){
            return (new LoansDistributionController())->loanLongDistribution($company->id , 0 , $loan , 'view' , $loan->start_date);
            
            // return redirect()->route('long.loan.distribution',[$company->id, 0 , $loan]);
        }
        // $loan->save()
        // return view('admin.loan2.index' , [
        //     'loans'=> [$loan] ,
        //     'type'=>$loan_type ,
        //     'company'=>$company ,
            
        // ]);

        return redirect()->route('loans2.index' , ['company_id'=> $company_id , 'type'=>$loan_type])->with([
       
        
        ]);
        

        if ($request->get('submit') == 'Submit') {
            return redirect()->route('loan2.create', compact('company', 'loans','type'))->with('success', __('Created Successfully'));
        } elseif ($request->get('submit') == 'Submit And Close') {
            return redirect()->route('loan2.index', compact('company', 'loans','type'))->with('success', __('Created Successfully'));
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company_id, $financial_id, Loan $loan)
    {
        $company = Company::find($company_id);
        $financial = FinancialPlan::with(['fundingRequired', 'loans'])->findOrFail($financial_id);

        $this->validation($request, $financial, $loan);

        $loan->name                      = $request->name;
        $loan->financial_plan_id         = $financial_id;
        $loan->company_id                = $company_id;
        $loan->loan_start_month          = $request->start_month;
        $loan->loan_amount               = $request->loan_amount;
        $loan->loan_type                 = $request->loan_type;


        //grace period
        $grace_period = $request->grace_period;
        // if ($request->loan_type == 'long') {
        //total duration is to add the repayment_duration to the grace period
        $new_duration =  $request->repayment_duration + $grace_period;
        $old_duration = $loan->duration + $loan->grace_period;
        //////////////// LONG LOAN DISTRIBUTION ////////////////////////
        //in case the old duration is not equal to the new one the old distributions rows will be deleted and the long loan will be distributed again according to the new distribution 
        if ($new_duration != $old_duration) {
            foreach ($loan->longDistributions as  $value) {
                $value->delete();
            }
            //if the margin and borrowing rate sum are less than the min interest the intrest rate will be the min interest
            // $margin_borrowing_rate = $request->borrowing_rate+$request->margin_interest;
            // $interest_rate = $margin_borrowing_rate > $request->min_interest ? $margin_borrowing_rate : $request->min_interest;
            $total_duration = $request->repayment_duration + $grace_period;
            // $loan_start_date = $loan->getStartDateAttribute();
            for ($month = 0; $month < $total_duration; $month++) {

                Loan_long_distribution::create([
                    'month' => $month,
                    'loan_id' => $loan->id,
                    'created_by' => Auth::id()
                ]);
            }
        }

        $loan->duration               = $request->repayment_duration;
        $loan->grace_period           = $grace_period;
        $loan->installment_interval   = $request->installment_interval;
        $loan->interest_interval      = $request->loan_type == 'variable' ? $request->interest_interval : $request->installment_interval;
        $loan->settlement_duration    = NULL;


        $loan->borrowing_rate            = $request->loan_type == 'variable' ? $request->borrowing_rate : 0;
        $loan->margin_interest           = $request->margin_interest;
        $loan->min_interest              = $request->loan_type == 'variable' ? $request->min_interest : 0;
        $loan->updated_by                = auth()->user()->id;
        $loan->save();


        // Saving Distribution data

        $loan_distributions = (new LoansDistributionController)->loanLongDistribution($company_id, $financial_id, $loan, 'array');
        $loan_type = $loan->loan_type;

        $distribution_data = $this->loanSavingDistributionData($loan_distributions, $loan_type);


        $loan->distribution_data = $distribution_data;
        $loan->save();
        if ($request->get('submit') == 'Submit') {
            return redirect()->route('loan.edit', compact('company', 'financial', 'loan'))->with('success', __('Updated Successfully'));
        } elseif ($request->get('submit') == 'Submit And Close') {

            return redirect()->route('loan.index', compact('company', 'financial'))->with('success', __('Updated Successfully'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id, $financial_id, Loan $loan)
    {

        $company = Company::find($company_id);
        $financial = FinancialPlan::with(['fundingRequired', 'loans'])->findOrFail($financial_id);

        return view('admin.loan.edit', compact('loan', 'company', 'financial'));
    }
    /**
     * get phase assigned to project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \json
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id, $financial_id, Loan $loan)
    {
        $company = Company::find($company_id);
        $financial = FinancialPlan::findOrFail($financial_id);
        // Users Activity
        $table = ['en' => 'Loan', 'ar' => 'القروض'];
        $action = ['en' => 'DELETE', 'ar' => 'حذف'];
        app('App\Http\Controllers\UserActivities')->addAction($company_id, Auth::user()->id, $action, $table, $loan->id);

        $loan->delete();
        Session::flash("error", __('Deleted Successfully'));
        return redirect()->route('loan.index', compact('company', 'financial'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loanBorrowingRateUpadateview($company_id, $financial_id, Loan $loan)
    {
        $company = Company::find($company_id);
        // $financial = FinancialPlan::findOrFail($financial_id);
        //the start date of the loan according for the selected project
        $loan->start_date = Request('start_date');
        return view('admin.loan2.borrowing_rate_update', compact('company', 'loan'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loanBorrowingRateUpadate($company_id, $financial_id, Loan $loan)
    {
        $financial = FinancialPlan::findOrFail($financial_id);
        $company = Company::find($company_id);
        if (count($loan->rates) > 0) {
            foreach ($loan->rates as  $value) {
                $value->delete();
            }
        }
        if (count(request()->rates) > 0) {
            foreach (request()->rates as $key => $value) {
                Loan_long_update_rate::create([
                    'loan_id' => $loan->id,
                    'month' => $value['month'],
                    'borrowing_rate' => $value['borrowing_rate'],
                    'created_by' => Auth::user()->id
                ]);
            }
        }
        if (request()->get('submit') == 'Submit') {
            return redirect()->route('long.loan.borrowing.rate', compact('company', 'financial', 'loan'))->with('success', __('Updated Successfully'));
        } elseif (request()->get('submit') == 'Submit And Close') {

            return redirect()->route('loan.index', compact('company', 'financial'))->with('success', __('Updated Successfully'));
        }
    }

    public function loanSavingDistributionData($loan_distributions, $loan_type)
    {
        $distribution_data = [];
        array_walk($loan_distributions, function ($value, $key) use (&$distribution_data, $loan_type) {
            $distribution_data[$value['loan_date']] = [
                'loan_amount' => $value['loan_amount'],
                'interest_amount' => $value['interest_amount'],
                'interest_payment' => $value['interest_payment'],
                'installment_payment' => $loan_type == 'variable' ? $value['variable_installment'] : $value['fixed_installment'],
                'principle_payment' => $loan_type == 'variable' ? $value['variable_installment'] : $value['principle_payment'],
            ];
        });



        return $distribution_data;
    }


    public function validation($request, $loan = null)
    {
      
        $validation["name"]             =  ['required', 'max:100', $loan !== null ? '' : "unique:loans"];
        $validation["loan_amount"]      ='numeric|min:0|required';
        $validation["borrowing_rate"]   =  $request->loan_type == 'variable' ? "required" : "";
        $validation["margin_interest"]  =  "required";
        $validation["start_month"]       =  "required";
        $validation["min_interest"]      =  $request->loan_type == 'variable' ? "required" : "";
        
        $this->validate($request, @$validation, [
            // 'loan_amount.size' => __('Loan Amount must be equal or less than Long Term Loan Total Amount ' . number_format($remaining))
        ]);
    }
	
	public function viewTestLoanAtEndPhp(Request $request , $company_id  )
    {
        

        $company = Company::find($company_id);
     $loan = null;
       
		return view('admin.loan2.test-loan-php', compact('company'  ,'loan'));
		
        
		
    }
	public function calculateByPhp(Request $request,$company_id)
	{
		
        $company = Company::find($company_id);
     	$loan = new Loan;
		$calculateFixedLoanAtEndService = new CalculateFixedLoanAtEndService();	
		$loanType = $request->get('fixed_loan_type');
		$loan->fixedType =$loanType; 
		$loanStartDate = $request->get('start_date');
		$loan->start_date =$loanStartDate; 
		$loanStartDate = Carbon::make($loanStartDate)->format('d-m-Y');
		$loanAmount = $request->get('loan_amount');
		$loan->loan_amount =$loanAmount; 
		$baseRate = $request->get('base_rate');
		$loan->base_rate =$baseRate; 
		$marginRate = $request->get('margin_rate');
		$loan->margin_rate =$marginRate; 
		$loan->pricing = $marginRate +$baseRate ; 
		$tenor = $request->get('duration');
		$loan->duration =$tenor; 
		$installmentPaymentIntervalName = $request->get('installment_interval');
		$loan->installment_interval = $installmentPaymentIntervalName;
		$stepUpRate = $request->get('step_up_rate');
		$loan->step_up_rate =$stepUpRate; 
		$stepUpIntervalName = $request->get('step_up_interval');
		$loan->step_up_interval =$stepUpIntervalName; 
		$stepDownRate = $request->get('step_down_rate');
		$loan->step_down_rate =$stepDownRate; 
		$stepDownIntervalName = $request->get('step_down_interval');
		$loan->step_down_interval =$stepDownIntervalName; 
		$gracePeriod = $request->get('grace_period')?:0;
		$loan->grace_period = $gracePeriod;
		$loan->is_with_capitalization = Loan::isWithCapitalization($loanType);
		$fixedAtEndResult=  $calculateFixedLoanAtEndService->__calculate($loanType,$loanStartDate,$loanAmount,$baseRate,$marginRate,$tenor,$installmentPaymentIntervalName,$stepUpRate,$stepUpIntervalName,$stepDownRate,$stepDownIntervalName,$gracePeriod);
		$loanDates = array_keys($fixedAtEndResult['beginning']);
		
		return view('admin.loan2.test-loan-php',compact('company'  ,'loan','loanDates','fixedAtEndResult'));
	}
	
}
