<?php

namespace App\Http\Controllers;

use App\Imports\ImportData;
use App\Jobs\Caches\HandleCustomerDashboardCashingJob;
use App\Jobs\Caches\HandleCustomerNatureCashingJob;
use App\Jobs\Caches\RemoveIntervalYearCashingJob;
use App\Jobs\NotifyUserOfCompletedDataSavedUploadExcel;
use App\Jobs\NotifyUserOfCompletedImport;
use App\Jobs\NotifyUserOfCompletedImportForUploadExcel;
use App\Jobs\RemoveCachingCompaniesDataForUploadExcel;
use App\Jobs\ShowCompletedMessageForSuccessJob;
use App\Jobs\ShowCompletedMessageForUploadExcelForSuccessJob;
use App\Jobs\UploadExcelTestJob;
use App\Models\ActiveJob;
use App\Models\CachingCompany;
use App\Models\Company;
use App\Models\UploadExcelTest;
use App\Services\Caching\CashingService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcelsTestController extends Controller
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
        $exportableFields = exportableFields($company_id, 'UploadExcel');
        if ($exportableFields === null) {
            toastr()->warning('Please choose exportable fields first');
            return redirect()->back();
        }
        

        if (request()->method()  == 'GET') {
            $cacheKeys = CachingCompany::where('company_id',$company_id)->get();
            $uploadExcels = [];
            foreach($cacheKeys as $cacheKey)
            {
                $uploadExcels = array_merge(Cache::get($cacheKey->key_name) ?:[]  , $uploadExcels );
            }
$uploadExcels = $this->paginate($uploadExcels);

            $exportableFields  = (new ExportTable)->customizedTableField($company, 'UploadExcel', 'selected_fields');
            $viewing_names = array_values($exportableFields);
            $db_names = array_keys($exportableFields);
            return view('client_view.upload_excels.import', compact('company', 'uploadExcels', 'viewing_names', 'db_names'));
        } else {


            // Get The Selected exportable fields returns a pair of ['field_name' => 'viewing name']
            $exportable_fields = (new ExportTable)->customizedTableField($company, 'UploadExcel', 'selected_fields');

            // Customizing the collection to be exported

            $salesGathering_fields = [];
            foreach ($exportable_fields as $field_name => $column_name) {
                $salesGathering_fields[$field_name] = $column_name;
            }
            $salesGathering_fields['company_id'] = $company_id;
            $salesGathering_fields['created_by'] = $user_id;

            $active_job = ActiveJob::where('company_id',  $company_id)->where('status', 'test_table')->where('model_name', 'UploadExcelTest')->first();
            if ($active_job === null) {

                $active_job = ActiveJob::create([
                    'company_id'  => $company_id,
                    'model_name'  => 'UploadExcelTest',
                    'status'  => 'test_table',
                ]);
            }

            $fileUpload = new  ImportData($company_id, request()->format, 'UploadExcelTest', $salesGathering_fields, $active_job->id )   ;
              Excel::queueImport($fileUpload,request()->file('excel_file'))->chain([
                new NotifyUserOfCompletedDataSavedUploadExcel(request()->user(), $active_job->id),
                new ShowCompletedMessageForUploadExcelForSuccessJob($company_id , $active_job->id)
            ]);
            
            toastr('Import started!', 'success');

            return redirect()->back();
        }
    }
    public function insertToMainTable(Company $company)
    {
        $active_job = ActiveJob::where('company_id',  $company->id)->where('status', 'save_to_table')->where('model_name', 'UploadExcelTest')->first();
        if ($active_job === null) {

            $active_job = ActiveJob::create([
                'company_id'  => $company->id,
                'model_name'  => 'UploadExcelTest',
                'status'  => 'save_to_table',
            ]);
        }
        Cache::forget(getUploadingExcelShowCompletedTestMessageCacheKey($company->id  )   );
        
        UploadExcelTestJob::withChain([
            // new RemoveIntervalYearCashingJob($company) , 
            // new HandleCustomerDashboardCashingJob($company) , 
            new NotifyUserOfCompletedImportForUploadExcel(request()->user(), $active_job->id,$company->id),
            // new HandleCustomerNatureCashingJob($company) , 
            new RemoveCachingCompaniesDataForUploadExcel($company->id)
        ])->dispatch($company->id);
        
        // remove old cashing for these company 

        // $cashingService = new CashingService($company);
        

        
        return redirect()->back();
    
    }


    public function edit(Company $company, UploadExcelTest $uploadExcelTest)
    {
        $exportableFields  = (new ExportTable)->customizedTableField($company, 'UploadExcel', 'selected_fields');
        $db_names = array_keys($exportableFields);
        return view('client_view.upload_excels.importRowForm', compact('company','exportableFields','db_names', 'uploadExcelTest'));
    }

    public function update(Request $request, Company $company, UploadExcelTest $uploadExcelTest)
    {
        $uploadExcelTest->update($request->all());
        toastr()->success('Updated Successfully');
        return redirect()->route('uploadExcelImport', $company);
    }

    public function destroy(Company $company, UploadExcelTest $uploadExcelTest)
    {
        
        $uploadExcelTest->delete();
        toastr()->error('Deleted Successfully');
        return redirect()->back();
    }

    public function activeJob(Request $request, Company $company)
    {
        $row = DB::table('active_jobs')
            ->where('company_id', $company->id)
            ->where('status', 'test_table')
            ->where('model_name', 'UploadExcelTest')->first();
        return ($row === null) ? 0 :  1;
    }
}
