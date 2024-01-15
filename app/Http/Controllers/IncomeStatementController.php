<?php

namespace App\Http\Controllers;

use App\Exports\IncomeStatementExport;
use App\Http\Requests\IncomeStatementRequest;
use App\Models\Company;
use App\Models\IncomeStatement;
use App\Models\Repositories\IncomeStatementRepository;
use Illuminate\Http\Request;

class IncomeStatementController extends Controller
{
    private IncomeStatementRepository $incomeStatementRepository ; 
    
    public function __construct(IncomeStatementRepository $incomeStatementRepository )
    {
        // $this->middleware('permission:view branches')->only(['index']);
        // $this->middleware('permission:create branches')->only(['store']);
        // $this->middleware('permission:update branches')->only(['update']);
        $this->incomeStatementRepository = $incomeStatementRepository;
    }
    
    public function view()
    {
        return view('admin.income-statement.view' , IncomeStatement::getViewVars());
    }
    public function create()
    {
        return view('admin.income-statement.create' , IncomeStatement::getViewVars());
    }
    
    public function createReport(Company $company , IncomeStatement $incomeStatement)
    {
        return view('admin.income-statement.report.view' , IncomeStatement::getReportViewVars([
            'income_statement_id'=>$incomeStatement->id 
            ,'incomeStatement'=>$incomeStatement
        ]));
    }

     public function paginate(Request $request)
    {
        return $this->incomeStatementRepository->paginate($request);
    }
     public function paginateReport(Request $request ,Company $company, IncomeStatement $incomeStatement)
    {
        return $this->incomeStatementRepository->paginateReport($request,$incomeStatement);
    }
    

    public function store(IncomeStatementRequest $request)
    {
        
        $incomeStatement = $this->incomeStatementRepository->store($request);
        return response()->json([
            'status'=>true ,
            'message'=>__('Income Statement Has Been Stored Successfully') , 
            'redirectTo'=>route('admin.create.income.statement.report',['company'=>getCurrentCompanyId() , 'incomeStatement'=>$incomeStatement->id ])
        ]);
       
    }

    public function storeReport(Request $request)
    {
  
        $this->incomeStatementRepository->storeReport($request);

        return response()->json([
            'status'=>true ,
            'message'=>__('Income Statement Has Been Stored Successfully')
        ]);
       
    }

    public function edit(Company $company , Request $request , IncomeStatement $incomeStatement)
    {
        return view(IncomeStatement::getCrudViewName() , array_merge(IncomeStatement::getViewVars() , [
            'type'=>'edit',
            'model'=>$incomeStatement
        ]));
    }

    public function update(Company $company , Request $request , IncomeStatement $incomeStatement)
    {
        $this->incomeStatementRepository->update($incomeStatement , $request);
        return response()->json([
            'status'=>true ,
            'message'=>__('Income Statement Has Been Updated Successfully')
        ]);
        
    }

    public function export(Request $request )
    {
        
        return (new IncomeStatementExport($this->incomeStatementRepository->export($request) , $request ))->download();
    }
    
}
