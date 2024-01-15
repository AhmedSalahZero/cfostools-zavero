<?php

namespace App\Http\Controllers;

use App\Imports\ImportData;
use App\Jobs\Caches\HandleCustomerDashboardCashingJob;
use App\Jobs\Caches\HandleCustomerNatureCashingJob;
use App\Jobs\Caches\RemoveIntervalYearCashingJob;
use App\Jobs\NotifyUserOfCompletedImport;
use App\Jobs\RemoveCachingCompaniesData;
use App\Jobs\SalesGatheringTestJob;
use App\Jobs\ShowCompletedMessageForSuccessJob;
use App\Models\ActiveJob;
use App\Models\CachingCompany;
use App\Models\Company;
use App\Models\SalesGatheringTest;
use App\Services\Caching\CashingService;
use Auth;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
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

class SalesGatheringTestController extends Controller
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
        $exportableFields = exportableFields($company_id, 'SalesGathering');
        if ($exportableFields === null) {
            toastr()->warning('Please choose exportable fields first');
            return redirect()->back();
        }
        // $salesGatherings = SalesGatheringTest::company()->paginate(50);
        

        if (request()->method()  == 'GET') {
            $cacheKeys = CachingCompany::where('company_id',$company_id)->get();
            $salesGatherings = [];
            foreach($cacheKeys as $cacheKey)
            {
                $salesGatherings = array_merge(Cache::get($cacheKey->key_name) ?:[]  , $salesGatherings );
            }
            // $salesGatherings = Arr::flatten($SalesGathering) ;

            // $products = $this->getAllCategoriesProducts(31);
// $total = count($salesGatherings);
// $perPage = 5; // How many items do you want to display.
// $currentPage = 1; // The index page.
// $paginator = new LengthAwarePaginator($salesGatherings, $total, $perPage, $currentPage);
$salesGatherings = $this->paginate($salesGatherings);

            $exportableFields  = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
            $viewing_names = array_values($exportableFields);
            $db_names = array_keys($exportableFields);
            return view('client_view.sales_gathering.import', compact('company', 'salesGatherings', 'viewing_names', 'db_names'));
        } else {


            // Get The Selected exportable fields returns a pair of ['field_name' => 'viewing name']
            $exportable_fields = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');

            // $salesGathering = SalesGathering::where('company_id',$company_id)->get();
            // Customizing the collection to be exported

            $salesGathering_fields = [];
            foreach ($exportable_fields as $field_name => $column_name) {
                $salesGathering_fields[$field_name] = $column_name;
            }
            $salesGathering_fields['company_id'] = $company_id;
            $salesGathering_fields['created_by'] = $user_id;

            $active_job = ActiveJob::where('company_id',  $company_id)->where('status', 'test_table')->where('model_name', 'SalesGatheringTest')->first();
            if ($active_job === null) {

                $active_job = ActiveJob::create([
                    'company_id'  => $company_id,
                    'model_name'  => 'SalesGatheringTest',
                    'status'  => 'test_table',
                ]);
            }

            $fileUpload = new  ImportData($company_id, request()->format, 'SalesGatheringTest', $salesGathering_fields, $active_job->id )   ;
              Excel::queueImport($fileUpload,request()->file('excel_file'))->chain([
                new NotifyUserOfCompletedImport(request()->user(), $active_job->id),
                new ShowCompletedMessageForSuccessJob($company_id , $active_job->id)
            ]);




            toastr('Import started!', 'success');

            return redirect()->back();
        }
    }
    public function insertToMainTable(Company $company)
    {
        $active_job = ActiveJob::where('company_id',  $company->id)->where('status', 'save_to_table')->where('model_name', 'SalesGatheringTest')->first();
        if ($active_job === null) {

            $active_job = ActiveJob::create([
                'company_id'  => $company->id,
                'model_name'  => 'SalesGatheringTest',
                'status'  => 'save_to_table',
            ]);
        }
        Cache::forget(getShowCompletedTestMessageCacheKey($company->id  )   );
        
        SalesGatheringTestJob::withChain([
            new RemoveIntervalYearCashingJob($company) , 
            new HandleCustomerDashboardCashingJob($company) , 
            new NotifyUserOfCompletedImport(request()->user(), $active_job->id,$company->id),
            new HandleCustomerNatureCashingJob($company) , 
            new RemoveCachingCompaniesData($company->id)
        ])->dispatch($company->id);
        
        // remove old cashing for these company 

        // $cashingService = new CashingService($company);
        

        
        return redirect()->back();
    
    }


    public function edit(Company $company, SalesGatheringTest $salesGatheringTest)
    {
        $exportableFields  = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
        $db_names = array_keys($exportableFields);
        return view('client_view.sales_gathering.importRowForm', compact('company','exportableFields','db_names', 'salesGatheringTest'));
    }

    public function update(Request $request, Company $company, SalesGatheringTest $salesGatheringTest)
    {
        $salesGatheringTest->update($request->all());
        toastr()->success('Updated Successfully');
        return redirect()->route('salesGatheringImport', $company);
    }

    public function destroy(Company $company, SalesGatheringTest $salesGatheringTest)
    {
        
        $salesGatheringTest->delete();
        toastr()->error('Deleted Successfully');
        return redirect()->back();
    }

    public function activeJob(Request $request, Company $company)
    {
        $row = DB::table('active_jobs')
            ->where('company_id', $company->id)
            ->where('status', 'test_table')
            ->where('model_name', 'SalesGatheringTest')->first();
        return ($row === null) ? 0 :  1;
    }
}
