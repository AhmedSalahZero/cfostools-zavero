<?php

namespace App\Http\Controllers;

use App\Imports\ImportData;
use App\Jobs\NotifyUserOfCompletedDataSavedUploadSupplierInvoice;
use App\Jobs\NotifyUserOfCompletedImportForUploadSupplierInvoice;
use App\Jobs\RemoveCachingCompaniesDataForUploadSupplierInvoice;
use App\Jobs\ShowCompletedMessageForUploadSupplierInvoiceForSuccessJob;
use App\Jobs\UploadSupplierInvoiceTestJob;
use App\Models\ActiveJob;
use App\Models\CachingCompany;
use App\Models\Company;
use App\Models\UploadSupplierInvoiceTest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class UploadSuppliersInvoicesTestController extends Controller
{
    public function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return (new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
    'path'  => Request()->url(),
    'query' => Request()->query(),
]));
    }
    
    public function import(Company $company)
    {
  
        $company_id = $company->id;
        $user_id = Auth::user()->id;
        $exportableFields = exportableFields($company_id, 'UploadSupplierInvoice');
        if ($exportableFields === null) {
            toastr()->warning('Please choose exportable fields first');
            return redirect()->back();
        }
        

        if (request()->method()  == 'GET') {
            $cacheKeys = CachingCompany::where('company_id',$company_id)->get();
            $uploadSupplierInvoices = [];
            foreach($cacheKeys as $cacheKey)
            {
                $uploadSupplierInvoices = array_merge(Cache::get($cacheKey->key_name) ?:[]  , $uploadSupplierInvoices );
            }
            $uploadSupplierInvoices = $this->paginate($uploadSupplierInvoices);

            $exportableFields  = (new ExportTable)->customizedTableField($company, 'UploadSupplierInvoice', 'selected_fields');
            $viewing_names = array_values($exportableFields);
            $db_names = array_keys($exportableFields);
            return view('client_view.upload_suppliers_invoices.import', compact('company', 'uploadSupplierInvoices', 'viewing_names', 'db_names'));
        } else {


            // Get The Selected exportable fields returns a pair of ['field_name' => 'viewing name']
            $exportable_fields = (new ExportTable)->customizedTableField($company, 'UploadSupplierInvoice', 'selected_fields');

            // Customizing the collection to be exported

            $salesGathering_fields = [];
            foreach ($exportable_fields as $field_name => $column_name) {
                $salesGathering_fields[$field_name] = $column_name;
            }
            $salesGathering_fields['company_id'] = $company_id;
            $salesGathering_fields['created_by'] = $user_id;

            $active_job = ActiveJob::where('company_id',  $company_id)->where('status', 'test_table')->where('model_name', 'UploadSupplierInvoiceTest')->first();
            if ($active_job === null) {

                $active_job = ActiveJob::create([
                    'company_id'  => $company_id,
                    'model_name'  => 'UploadSupplierInvoiceTest',
                    'status'  => 'test_table',
                ]);
            }

            $fileUpload = new  ImportData($company_id, request()->format, 'UploadSupplierInvoiceTest', $salesGathering_fields, $active_job->id )   ;
              Excel::queueImport($fileUpload,request()->file('excel_file'))->chain([
                new NotifyUserOfCompletedDataSavedUploadSupplierInvoice(request()->user(), $active_job->id),
                new ShowCompletedMessageForUploadSupplierInvoiceForSuccessJob($company_id , $active_job->id)
            ]);
            
            toastr('Import started!', 'success');

            return redirect()->back();
        }
    }
    public function insertToMainTable(Company $company)
    {
        $active_job = ActiveJob::where('company_id',  $company->id)->where('status', 'save_to_table')->where('model_name', 'UploadSupplierInvoiceTest')->first();
        if ($active_job === null) {

            $active_job = ActiveJob::create([
                'company_id'  => $company->id,
                'model_name'  => 'SupplierInvoiceTest',
                'status'  => 'save_to_table',
            ]);
        }
        Cache::forget(getUploadingShowCompletedTestMessageForUploadSupplierInvoiceCacheKey($company->id  )   );
        
        UploadSupplierInvoiceTestJob::withChain([
            // new RemoveIntervalYearCashingJob($company) , 
            // new HandleCustomerDashboardCashingJob($company) , 
            new NotifyUserOfCompletedImportForUploadSupplierInvoice(request()->user(), $active_job->id,$company->id),
            // new HandleCustomerNatureCashingJob($company) , 
            new RemoveCachingCompaniesDataForUploadSupplierInvoice($company->id)
        ])->dispatch($company->id);
        
        // remove old cashing for these company 

        // $cashingService = new CashingService($company);
        

        
        return redirect()->back();
    
    }


    public function edit(Company $company, UploadSupplierInvoiceTest $uploadSupplierInvoiceTest)
    {
        $exportableFields  = (new ExportTable)->customizedTableField($company, 'SupplierInvoice', 'selected_fields');
        $db_names = array_keys($exportableFields);
        return view('client_view.upload_suppliers_invoices.importRowForm', compact('company','exportableFields','db_names', 'uploadSupplierInvoiceTest'));
    }

    public function update(Request $request, Company $company, UploadSupplierInvoiceTest $uploadSupplierInvoiceTest)
    {
        $uploadSupplierInvoiceTest->update($request->all());
        toastr()->success('Updated Successfully');
        return redirect()->route('uploadSupplierInvoiceImport', $company);
    }

    public function destroy(Company $company, UploadSupplierInvoiceTest $uploadSupplierInvoiceTest)
    {
        
        $uploadSupplierInvoiceTest->delete();
        toastr()->error('Deleted Successfully');
        return redirect()->back();
    }

    public function activeJob(Request $request, Company $company)
    {
        $row = DB::table('active_jobs')
            ->where('company_id', $company->id)
            ->where('status', 'test_table')
            ->where('model_name', 'UploadSupplierInvoiceTest')->first();
        return ($row === null) ? 0 :  1;
    }
}
