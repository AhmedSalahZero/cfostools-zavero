<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Analysis\SalesGathering\CustomersNaturesAnalysisReport;
use App\Http\Controllers\Analysis\SalesGathering\DiscountsAnalysisReport;
use App\Http\Controllers\Analysis\SalesGathering\IntervalsComparingReport;
use App\Http\Controllers\Analysis\SalesGathering\SalesBreakdownAgainstAnalysisReport;
use App\Models\Company;
use App\Services\Caching\CashingService;
use App\Traits\GeneralFunctions;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    use GeneralFunctions;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user =  Auth::user() ;
        $companies = $user->companies;
        if (count($user->companies) > 1) {
            return view('client_view.home',compact('companies'));
        } else {
            $company =$user->companies[0];
            return view('client_view.homePage',compact('company'));
        }



    }
    public function redirectFun(Company $company)
    {
       return   redirect()->route('viewHomePage',[$company]);
    }
    public function welcomePage(Request $request,Company $company)
    {

        return view('client_view.homePage',compact('company'));


    }

    public function dashboard(Request $request,Company $company)
    {
        $start_date = date('2021-01-01');
        $end_date   = date('2021-12-31');

        if ($request->isMethod('GET')) {
            $request['start_date'] =$start_date;
            $request['end_date'] =$end_date;
        }elseif ($request->isMethod('POST')){
            $start_date = $request['start_date'] ;
            $end_date = $request['end_date'] ;
        }



        $end_date_month = date('m-Y',strtotime($end_date));
        $formated_end_date =  date('d-m-Y',strtotime($end_date));
        $previous_month = $this->dateCalc(date('01-m-Y',strtotime($end_date)),-1);
        $formated_previous_month =  date('d-m-Y',strtotime($previous_month));
        $previous_month = date('m-Y',strtotime($previous_month));
        $currentMonth = explode('-',$end_date_month)[0];
        $currentYear = explode('-',$end_date_month)[1];
        // $daily_sales = SalesGathering::company()->whereDate('date',$end_date)->sum('net_sales_value');
        
        // $sales_value_data = [
        //     'daily_sales' => $daily_sales??0,
        //     'current_month' => '-',
        //     'previous_month' => '-' ,
        //     'year_to_date' => array_sum($sale_values),
        //     'previous_three_months' =>array_sum(array_slice($sale_values,   -4,3, true)??[])
        // ];
        
        // array_walk($sale_values,function($value,$date) use(&$sales_value_data,$previous_month,$formated_previous_month,$formated_end_date,$end_date_month){
        //     $current_date = date('m-Y',strtotime($date));
        //     if ($end_date_month == $current_date) {
        //         $sales_value_data['current_month']= $value;
        //     }
        //     if ($previous_month == $current_date) {
        //         $sales_value_data['previous_month'] = $value;
        //     }
        // });
        


        /* Salah */
        
        // why we uses end date [need to be the current day regarding $end_date]
        $daySales = DB::select(DB::raw(
            "
            select sum(net_sales_value) as day_sales from sales_gathering where date = '". $end_date ."' and company_id = 
            " . $company->id  
        ));

        $daySales = $daySales[0]->day_sales ?: 0 ;

        $currentMonthSales = DB::select(DB::raw(
            
            "
            select sum(net_sales_value) as current_month_sales from sales_gathering where Year = ". $currentYear ." and Month=" . $currentMonth ." and company_id = 
            " . $company->id 
        ));

        $currentMonthSales = $currentMonthSales[0]->current_month_sales?:0;
        $previousMonth = Carbon::make($end_date)->startOfMonth()->subMonths(1)->month ;
        
        $previousMonthYear = Carbon::make($end_date)->startOfMonth()->subMonths(1)->year ;
        $previous2Month = Carbon::make($end_date)->startOfMonth()->subMonths(2)->month ;
        $previous2MonthYear = Carbon::make($end_date)->startOfMonth()->subMonths(2)->year ;
                $previous3Month = Carbon::make($end_date)->startOfMonth()->subMonths(3)->month ;
        $previous3MonthYear = Carbon::make($end_date)->startOfMonth()->subMonths(3)->year ;

        
         $perviousMonthSales = DB::select(DB::raw(
            
            "
            select sum(net_sales_value) as previous_month_sales from sales_gathering where Year = ". $previousMonthYear ." and Month=" . $previousMonth ." and company_id = 
            " . $company->id  
        ));
        $salesToDate = DB::select(DB::raw(
            "select sum(net_sales_value) total_sales_to_date from sales_gathering where date >= '". $start_date ."' and date <= '". $end_date ."' and company_id = " . $company->id  
        ));

        $perviousThreeMonthsSales = DB::select(DB::raw(
            "select sum(net_sales_value ) previous_three_months_sales from sales_gathering 
            where (
            (Year  =  ". $previousMonthYear  ." and Month=  ". $previousMonth ." ) 
            OR 
            (Year  = ". $previous2MonthYear  ." and Month= ". $previous2Month .") 
            OR 
            (Year  = ".  $previous3MonthYear  ." and Month= ".($previous3Month).") 
            )
                and company_id = " . $company->id
        ));

        $perviousThreeMonthsSales = $perviousThreeMonthsSales[0]->previous_three_months_sales ?:0 ;

        $salesToDate = $salesToDate[0]->total_sales_to_date ?:0 ;
        
        $previous_month_sales = $perviousMonthSales[0]->previous_month_sales ; 

        $percentage = $previous_month_sales ? ((($currentMonthSales - $previous_month_sales)/ $previous_month_sales) *100)   : 0 ; 
        $monthlyChart = $this->formatMonthlyChars($company , $start_date, $end_date); 
        $monthlyChartArr =  $monthlyChart['formattedData'];
        $monthlyChartCumulative =  $monthlyChart['cumulative'];
        $formattedDataForChart =  $monthlyChart['formattedDataForChart'];

        return view('client_view.home_dashboard.dashboard',
        compact('company',

        // 'salesReport',
        'start_date','end_date','daySales','currentMonthSales','previous_month_sales','perviousThreeMonthsSales'
        ,'percentage','salesToDate','monthlyChartArr','monthlyChartCumulative','formattedDataForChart'
        // ,'reportDataa'
        ));
    }
    public function formatMonthlyChars($company , $start_date , $end_date){
        $months = DB::select(DB::RAW(
        "select sum(net_sales_value) 'Sales Values' , month , count(*) as dd, year  , concat(date_format(LAST_DAY(concat(year , '-' ,month ,'-',1)) , '%d') , '-', MONTHNAME(concat(year , '-' ,month ,'-',1)) , '-', year  ) as date  
         from sales_gathering where company_id = ". $company->id ." 
            and  date between '". $start_date . "' and '". $end_date ."' group by month , year  order by 'sales values' desc"
        )); 
        $totalSums = array_sum(array_column($months , 'Sales Values')) ; 
        
        $formattedData = [];
        $cumulative = [];
        $reportData['Monthly Sales'] = null ;
        $reportData['Month Sales %'] = null ;
        $reportData['Accumulated Sales'] = null ;
        $reportData['Accumulated Sales'] = null ;
        $reportData['Sales Values'] = null ;
        $formattedDataForChart = [];
        
        
        for($i = 0 ; $i<count($months) ; $i++){
        // for($i = 0 ; $i<count($months) ; $i++){
            $monthSales = number_format((($months[$i]->{'Sales Values'}/$totalSums)*100),1) ;
            $growthRate =  $i == 0 || ! $months[$i]->{'Sales Values'} ? 0 : number_format((($months[$i]->{'Sales Values'}-$months[$i-1]->{'Sales Values'})/$months[$i-1]->{'Sales Values'})*100 , 1) ;
            $accumulatedSalesValue = $i==  0 ? $months[$i]->{'Sales Values'} : $months[$i]->{'Sales Values'} + $cumulative[$i-1]['price'] ;
            
            $formattedDataForChart[$i]['Sales Values'] = $months[$i]->{'Sales Values'};
            $formattedDataForChart[$i]['date'] = $months[$i]->date;
            $formattedDataForChart[$i]['Month Sales %']= $monthSales; 
            $formattedDataForChart[$i]['Growth Rate %']= $growthRate; 

             $formattedData['Sales Values / Month'][$i] = $months[$i]->{'date'};
             $formattedData['Monthly Sales'][$i] = null ;
            $formattedData['Sales Values'][$i] = number_format($months[$i]->{'Sales Values'}) . ' <span class="spanSales active-text-color font-weight-bold"> [ '. $growthRate   . ' % ] </span>';
            $formattedData['Month Sales %'][$i]= $monthSales . ' %'; 
            $formattedData['Accumulated Sales'][$i] = null ;
            $formattedData['Sales Values '][$i] = number_format($accumulatedSalesValue) ;
            $cumulative[$i]['date'] = $months[$i]->date  ;
            $cumulative[$i]['price'] =$accumulatedSalesValue  ;
        }
        if($i > 0)
        {
            $formattedData['Sales Values'][$i] = number_format($accumulatedSalesValue);
            $formattedData['Month Sales %'][$i] = '100 %' ; 
            $formattedData['Sales Values '][$i] = '-' ; 
        }
        

        // dd();
        
        return [
        'cumulative'=>$cumulative,
        'formattedData'=>$formattedData,
        'formattedDataForChart'=>$formattedDataForChart
        ] ;
       
        
        
    }
    public function dashboardBreakdownAnalysis(Request $request,Company $company)
    {
        $start_date = date('2021-01-01');
        $end_date   = date('2021-12-31');

        if ($request->isMethod('GET')) {
            $request['start_date'] =$start_date;
            $request['end_date'] =$end_date;
        }elseif ($request->isMethod('POST')){
            $start_date = $request['start_date'] ;
            $end_date = $request['end_date'] ;
        }

        $exportableFields  = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
        $db_names = array_keys($exportableFields);

        $types =  [
                'zone'=>'brand',
                'sales_channel'=>'warning',
                'branch'=>'danger',
                'category'=>'success',
                'product_or_service'=>'brand',
                'product_item'=>'warning',
                'business_sector'=>'brand',
                'service_provider_name'=>'warning',
                'service_provider_type'=>'danger',
                'service_provider_birth_year'=>'success',
                ];
                $reports_data =[];
                $top_data =[];
                
                /*
                tops
                 */

        //         $topes = [];
        //         $fullReport = [];
        //         foreach($types as $type=>$color ){
        //             if(array_search($type , $db_names) !== false ){
        //                 $request['type'] = $type ; 
        //                  $breakdown_data = (new SalesBreakdownAgainstAnalysisReport)->salesBreakdownAnalysisResult($request,$company,'array');
        //                  $fullReport[$type] = $breakdown_data ; 
        //                  $topes[$type] = $breakdown_data[0] ?? [] ;   
                         
        //             }
        //             else{
        //             unset($types[$type]);
        //             }
        //         }
                
        // return view('client_view.home_dashboard.dashboard_breakdown',compact('company','reports_data','types','top_data','start_date','end_date','fullReport','topes'));
        foreach ($types as  $type => $color) {
            if (false !== $found = array_search($type,$db_names)) {
                $request['type'] = $type;
                
                $breakdown_data = (new SalesBreakdownAgainstAnalysisReport)->salesBreakdownAnalysisResult($request,$company,'array');
                
                if ($type == 'service_provider_birth_year' || $type == 'service_provider_type') {
                    $first_item = collect($breakdown_data['report_view_data'])->sortByDesc(function ($data, $key)   {
                        return [$data['Sales Value']];
                    })->toArray();
                    $first_item = ($first_item??[]);
                    $top_data[$type] = array_shift($first_item);

                }else{
                    $top_data[$type] = $breakdown_data[0] ?? '-';
                }
                $reports_data[$type] = $breakdown_data;
            }else{
                unset($types[$type]);
            }
        }

        return view('client_view.home_dashboard.dashboard_breakdown',compact('company','reports_data','types','top_data','start_date','end_date'
        // ,'fullReport','topes'
        ));
    }


    // public function dashboardBreakdownAnalysis(Request $request,Company $company)
    // {
    //     $start_date = date('2021-01-01');
    //     $end_date   = date('2021-12-31');

    //     if ($request->isMethod('GET')) {
    //         $request['start_date'] =$start_date;
    //         $request['end_date'] =$end_date;
    //     }elseif ($request->isMethod('POST')){
    //         $start_date = $request['start_date'] ;
    //         $end_date = $request['end_date'] ;
    //     }

    //     $exportableFields  = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
    //     $db_names = array_keys($exportableFields);

    //     $types =  [
    //             'zone'=>'brand',
    //             'sales_channel'=>'warning',
    //             'branch'=>'danger',
    //             'category'=>'success',
    //             'product_or_service'=>'brand',
    //             'product_item'=>'warning',
    //             'business_sector'=>'brand',
    //             'service_provider_name'=>'warning',
    //             'service_provider_type'=>'danger',
    //             'service_provider_birth_year'=>'success',
    //             ];
    //             $reports_data =[];
    //             $top_data =[];

    //     foreach ($types as  $type => $color) {
    //         if (false !== $found = array_search($type,$db_names)) {
    //             $request['type'] = $type;
    //             $breakdown_data = (new SalesBreakdownAgainstAnalysisReport)->salesBreakdownAnalysisResult($request,$company,'array');
                
    //             if ($type == 'service_provider_birth_year' || $type == 'service_provider_type') {
    //                 $first_item = collect($breakdown_data['report_view_data'])->sortByDesc(function ($data, $key)   {
    //                     return [$data['Sales Value']];
    //                 })->toArray();
    //                 $first_item = ($first_item??[]);
    //                 $top_data[$type] = array_shift($first_item);

    //             }else{
                    
    //                 $top_data[$type] = $breakdown_data[0] ?? '-';
    //             }
    //             $reports_data[$type] = $breakdown_data;
    //         }else{
    //             unset($types[$type]);
    //         }
    //     }

    //     return view('client_view.home_dashboard.dashboard_breakdown',compact('company','reports_data','types','top_data','start_date','end_date'));
    // }
    
    public function dashboardCustomers(Request $request,Company $company)
    {
        
        $cashingService = new CashingService($company);
        $years = $cashingService->getIntervalYearsFormCompany();
        if($request->isMethod('GET') && $years['end_year']){
        $date   = date( $years['end_year'] . '-12-31' );
                        
        }
        else{
            $date =date( '2021-12-31' ) ;
        }

        if ($request->isMethod('GET')) {
            $request['date'] =$date;
        }elseif ($request->isMethod('POST')){
            $date = $request['date'] ;
        }
        $request['type'] = 'customer_name';

        $request['start_date'] =date('Y',strtotime($date)).'-01-01';
        $request['end_date'] =$date;
        
        $customers_breakdown_data = [];
        $request['type'] = 'customer_nature';
        $request['date'] = $date;

        $customers_natures = (new CustomersNaturesAnalysisReport)->result($request,$company,'array');


        // dd($customers_natures);;

        return view('client_view.home_dashboard.dashboard_customers',compact('company','customers_breakdown_data','customers_natures','date'));
    }
    public function dashboardSalesPerson(Request $request,Company $company)
    {
        $start_date = date('2021-01-01');
        $end_date   = date('2021-12-31');

        if ($request->isMethod('GET')) {
            $request['start_date'] =$start_date;
            $request['end_date'] =$end_date;
        }elseif ($request->isMethod('POST')){
            $start_date = $request['start_date'] ;
            $end_date = $request['end_date'] ;
        }
        $request['type'] = 'sales_person';
        $sale_person =  (new SalesBreakdownAgainstAnalysisReport)->salesBreakdownAnalysisResult($request, $company,'array');


        return view('client_view.home_dashboard.dashboard_salesPerson',compact('company','sale_person','start_date','end_date'));
    }
    public function dashboardSalesDiscount(Request $request,Company $company)
    {
        $start_date = date('2021-01-01');
        $end_date   = date('2021-12-31');

        if ($request->isMethod('GET')) {
            $request['start_date'] =$start_date;
            $request['end_date'] =$end_date;
        }elseif ($request->isMethod('POST')){
            $start_date = $request['start_date'] ;
            $end_date = $request['end_date'] ;
        }

        $sales_discount_bd = (new SalesBreakdownAgainstAnalysisReport)->discountsSalesBreakdownAnalysisResult($request,$company,'array');

        $request['main_type'] = 'sales_channel';

        $sales_channels_discounts = (new DiscountsAnalysisReport)->result($request,$company,'array');
        // [$report_data,$all_items,$items_totals]
        return view('client_view.home_dashboard.dashboard_salesDiscount',compact('company','sales_discount_bd','sales_channels_discounts','start_date','end_date'));
    }
    public function dashboardIntervalComparing(Request $request,Company $company)
    {

        
        $start_date_0 = date('2021-01-01');
        $end_date_0   = date('2021-12-31');
        $start_date_1 = date('2020-01-01');
        $end_date_1   = date('2020-12-31');
        // $start_date_2 = date('2019-01-01');
        // $end_date_2   = date('2019-12-31');

             $allTypes =  [
                'zone'=>'brand',
                'sales_channel'=>'warning',
                'branch'=>'danger',
                'category'=>'success',
                'product_or_service'=>'brand',
                'product_item'=>'warning',
                'business_sector'=>'brand',
                'service_provider_name'=>'warning',
                'service_provider_type'=>'danger',
                'service_provider_birth_year'=>'success',
                'customer_name'=>'success'
                ];
                
         $exportableFields  = (new ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
            $db_names = array_keys($exportableFields);

                $permittedTypes = [];
                        foreach ($allTypes as  $type => $color) {
                             if (false !== $found = array_search($type,$db_names)) {
                                 $permittedTypes[$type] = camelize($type) ; 
                             }
                        }
                        $selectedTypes = (array)$request->types ;
        $intervalComparing = [];
       

        if ($request->isMethod('GET')) {
            $keys = array_keys($permittedTypes);
            $firstKey = $keys[0] ?? 0;
            // dd();
            $secondKey = $keys[1] ?? 0;
            // $thirdKey = $keys[2] ?? 0;
         
             $request['types']=[
                $firstKey,$secondKey 
                // ,$thirdKey 
            ];
            // dd($firstType, $secondType);
            $request['start_date_one'] = $start_date_0;
            $request['end_date_one'] = $end_date_0;
            $request['start_date_two'] = $start_date_1;
            $request['end_date_two'] = $end_date_1;

            //  $request['start_date_three'] = $start_date_2;
            // $request['end_date_three'] = $end_date_2;
            
        }elseif ($request->isMethod('POST')){
            
            
            $start_date_0  = $request['start_date_one'];
            $end_date_0  = $request['end_date_one'];
            $start_date_1  = $request['start_date_two'];
            $end_date_1  = $request['end_date_two'];
            // $start_date_2  = $request['start_date_three'];
            // $end_date_2  = $request['end_date_three'];
        }

         foreach((array)$request->types as $t ){
             $request['type'] = $t;
        $intervalComparing[$t] = (new IntervalsComparingReport)->result($request, $company,'array');   
        }
        
        $customers_natures = [] ;
        // dd($intervalComparing);

        return view('client_view.home_dashboard.dashboard_intervalComparing',compact('company'
        // ,'product_items','sales_channels'
        ,
        'start_date_0','end_date_0','start_date_1','end_date_1'
        ,
        // 'start_date_2', 'end_date_2',
        
        'permittedTypes','selectedTypes' , 'intervalComparing'));
    }

}
