<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Analysis\SalesGathering\ZoneAgainstAnalysisReport;
use App\Models\AllocationSetting;
use App\Models\CollectionSetting;
use App\Models\Company;
use App\Models\ExistingProductAllocationBase;
use App\Models\ModifiedTarget;
use App\Models\NewProductAllocationBase;
use App\Models\SalesForecast;
use App\Models\SecondAllocationSetting;
use App\Models\SecondExistingProductAllocationBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SummaryController extends Controller
{
    public function forecastReport(Request $request, Company $company)
    {
        // Forecast
        $sales_forecast = SalesForecast::company()->first();
        // Company Sales Target
        $detailed_company_sales_target = (new SalesForecastReport)->productsAllocations($company, $request, 'detailed_company_sales_target');


        // Calculation of Total Company Sales Target In Quarters
        $total = $total = array_sum($detailed_company_sales_target['total']);
        $quarters = $this->companySalesTargetsQuarters($sales_forecast, $detailed_company_sales_target['total'], $total);
        //  Total Company Sales Target Data For Chart
        $chart_data = $this->totalCompanySalesTargetsChartData($detailed_company_sales_target['total'], $total);
        $new_products_targets_data['value'] = array_sum($detailed_company_sales_target['new']);
        $existing_products_targets_data['value'] = array_sum($detailed_company_sales_target['existing']);
        $new_products_targets_data['percentage'] = $total == 0 ? 0 : (($new_products_targets_data['value'] / $total) * 100);
        $existing_products_targets_data['percentage'] = $total == 0 ? 0 : (($existing_products_targets_data['value'] / $total) * 100);


        return view('client_view.forecast_summary_reports.dashboard', compact(
            'company',
            'quarters',
            'chart_data',
            'new_products_targets_data',
            'existing_products_targets_data'
        ));
    }

    public function companySalesTargetsQuarters($sales_forecast, $total_company_sales_target)
    {
        $quarters = [
            'Quarter One' => 0,
            'Quarter Two' => 0,
            'Quarter Three' => 0,
            'Quarter Four' => 0,
        ];
        $counter = 1;
        $total_quarter = 0;
        foreach ($total_company_sales_target as $date => $value) {
            $total_quarter += $value;
            if ($counter == 3) {
                $quarters['Quarter One'] = ['value' => $total_quarter, 'color_class' => 'warning'];
                $total_quarter = 0;
            } elseif ($counter == 6) {
                $quarters['Quarter Two'] = ['value' => $total_quarter, 'color_class' => 'danger'];
                $total_quarter = 0;
            } elseif ($counter == 9) {
                $quarters['Quarter Three'] = ['value' => $total_quarter, 'color_class' => 'success'];
                $total_quarter = 0;
            } elseif ($counter == 12) {
                $quarters['Quarter Four'] = ['value' => $total_quarter, 'color_class' => 'dark'];
                $total_quarter = 0;
            }

            $counter++;
        }
        $quarters['Total'] = ['value' => array_sum(array_column($quarters, 'value')), 'color_class' => 'brand'];

        return $quarters;
    }

    public function totalCompanySalesTargetsChartData($total_company_sales_target, $total)
    {

        $gr = (new ZoneAgainstAnalysisReport)->growthRate($total_company_sales_target);

        $multi_chart_data = [];
        $accumulated_chart_data = [];
        $month_sales_percentage = [];
        $accumulated_data = [];
        $accumulated_value = 0;
        foreach ($total_company_sales_target as $date => $value) {
            $formated_date = date('d-M-Y', strtotime(('01-' . $date)));

            $month_sales = $total == 0 ?  0 : (($value / $total) * 100);
            $month_sales_percentage[$formated_date] = $month_sales;
            $multi_chart_data[] = [
                'date' => $formated_date,
                'Sales Values' => number_format(($value ?? 0), 0),
                'Month Sales %' => number_format(($month_sales ?? 0), 0),
                'Growth Rate %' => number_format(($gr[$date] ?? 0), 1),
            ];

            // Accumulated Data
            $accumulated_value += $value;
            $accumulated_chart_data[] = [
                'date' => $formated_date,
                'price' => number_format($accumulated_value, 0),
            ];
            $accumulated_data[$formated_date] =  $accumulated_value;
        }
        return ['accumulated_chart' => $accumulated_chart_data, 'multi_chart' => $multi_chart_data, 'gr' =>  $gr, 'month_sales_percentage' => $month_sales_percentage, 'sales' => $total_company_sales_target, 'accumulated_data' => $accumulated_data];
    }

    public function breakdownForecastReport(Request $request, Company $company)
    {
        // First Allocation Setting
        $first_allocation_setting_base = AllocationSetting::company()->first() ;
        // Second Allocation Setting
        $second_allocation_setting_base = SecondAllocationSetting::company()->first();
        // Company Sales Target
        $company_sales_targets = (new SalesForecastReport)->productsAllocations($company, $request, 'total_sales_target');
        $reports_data['product_sales_target'] = $this->breakdownData($company_sales_targets);
        $types['product_sales_target'] = 'brand';
        $top_data['product_sales_target'] = $reports_data['product_sales_target'][0] ?? '-';
        // First Allocation sales targets
        $first_allocation_total_sales_targets = [];
        if (isset($first_allocation_setting_base)) {
            $first_allocation_total_sales_targets = (new AllocationsReport)->NewProductsSeasonality($request, $company, 'array');
            $base = $first_allocation_setting_base->allocation_base;
            arsort($first_allocation_total_sales_targets);
            $name = $base.'_sales_targets';
            $reports_data[$name] = $this->breakdownData($first_allocation_total_sales_targets);
            $types[$name] = 'warning';
            $top_data[$name] = $reports_data[$name][0] ?? '-';
        }
        // Second Allocation sales targets
        $second_allocation_total_sales_targets = [];
        if (isset($second_allocation_setting_base)) {
            $second_allocation_total_sales_targets = (new SecondAllocationsReport)->NewProductsSeasonality($request, $company, 'array');
            $base = $second_allocation_setting_base->allocation_base;
            arsort($second_allocation_total_sales_targets);
            $name = $base.'_sales_targets';
            $reports_data[$name] = $this->breakdownData($second_allocation_total_sales_targets);
            
            $types[$name] = 'danger';
            
            $top_data[$name] = $reports_data[$name][0] ?? '-';
        
        }
        return view('client_view.forecast_summary_reports.breakdown_dashboard', compact(
                'company',
            'reports_data',
            'types',
            'top_data',
        ));
    }

    public function breakdownData($data)
    {
  
        $result = collect($data)->flatMap(function($values,$name){
            return [[
                "item" => $name ,
                "Sales Value" => array_sum($values),
            ]];
        })->toArray();
        
       
        return $result;
    }

    public function collectionForecastReport(Request $request, Company $company)
    {
        $collection_data = (new CollectionController)->collectionReport($request,$company,'array');
        $forecast_year = $collection_data['forecast_year'];
        $monthly_dates =$collection_data['monthly_dates'] ;
        $collection = $collection_data['collection'] ;
        $collection_settings = $collection_data['collection_settings'] ;

        return view('client_view.forecast_summary_reports.collection_dashboard', compact(
            'company',
            'forecast_year',
            'monthly_dates',
            'collection',
            'collection_settings'
        ));
    }

    public function goToSummaryReport(Request $request , Company $company)
    {

        $request['company_id'] = $company->id ;

        // 1 - first page 
        
      
            unset($request['summary_report']);
        
          (new SalesForecastReport())->save($company , $request , true );
        

           // second page request
          $modified_targets = ModifiedTarget::company()->first();
          $request['use_modified_targets'] = $modified_targets->use_modified_targets ;
          $request['sales_targets_percentages'] = $modified_targets->sales_targets_percentages;
          $request['modify_sales_target'] = $modified_targets->products_modified_targets;
          $request['others_target'] =  $modified_targets->others_target ;
            (new SalesForecastReport)->productsSalesTargets($company , $request , true);

          //third page request
            (new SalesForecastReport())->productsAllocations($company , $request,'view',true);
            
          // fourth page request 
            $allocationSetting = AllocationSetting::company()->first();
            if($allocationSetting){
                $request['allocation_base'] = $allocationSetting->allocation_base;
                $request['breakdown'] = $allocationSetting->breakdown;
                $request['add_new_items'] = $allocationSetting->add_new_items;
                $request['number_of_items'] =$allocationSetting->number_of_items;
                (new AllocationsReport())->allocationSettings($request , $company);
                
                        
            }
          
           // fourth page 
            // $allocations_base_row = NewProductAllocationBase::company()->first();
            $cachedAllocation = Cache::get(getCacheKeyForFirstAllocationReport($company->id)) ?? [];
           $request['allocation_base_data'] = $cachedAllocation['allocation_base_data'] ?? [];
           $request['new_allocation_base_items'] = $cachedAllocation['new_allocation_base_items'] ?? [];
          (new AllocationsReport())->NewProductsAllocationBase($request , $company);
        
        //FIFTH PAGE REQUEST
        $existingAllocationBase = ExistingProductAllocationBase::company()->first();
        if($existingAllocationBase)
        {
              $request['existing_products_target']  = $existingAllocationBase['existing_products_target'];
                $request['total_existing_target']  = $existingAllocationBase['total_existing_target'];
                $request['modify_sales_target']  =  $existingAllocationBase['allocation_base_percentages'];
                $request['use_modified_targets']  = $existingAllocationBase['use_modified_targets'];
                    
        }
      
         (new AllocationsReport())->existingProductsAllocationBase($request , $company);
        // end of first allocation 

        // start of second allocation 


           //  page request 
            $allocationSetting = AllocationSetting::company()->first();
            
          $request['allocation_base'] = $allocationSetting->allocation_base;
          $request['breakdown'] = $allocationSetting->breakdown;
          $request['add_new_items'] = $allocationSetting->add_new_items;
          $request['number_of_items'] =$allocationSetting->number_of_items;
           (new AllocationsReport())->allocationSettings($request , $company);
           //  page 
            // $allocations_base_row = NewProductAllocationBase::company()->first();
                   $existingAllocationBase = SecondExistingProductAllocationBase::company()->first();
           
        // PAGE REQUEST
 
        if($existingAllocationBase)
        {
             $cachedAllocation = Cache::get(getCacheKeyForSecondAllocationReport($company->id)) ?? [];
           $request['allocation_base_data'] = $cachedAllocation['allocation_base_data'] ?? [];
           $request['new_allocation_base_items'] = $cachedAllocation['new_allocation_base_items'] ?? [];
           
         (new SecondAllocationsReport())->NewProductsAllocationBase($request , $company);
         
            $request['existing_products_target']  = $existingAllocationBase['existing_products_target'];
            $request['total_existing_target']  = $existingAllocationBase['total_existing_target'];
            $request['modify_sales_target']  =  $existingAllocationBase['allocation_base_percentages'];
            $request['use_modified_targets']  = $existingAllocationBase['use_modified_targets'];
            (new SecondAllocationsReport())->existingProductsAllocationBase($request , $company);
            
        }
        
          $collectionSetting = CollectionSetting::company()->first();
          $request['collection_base'] = $collectionSetting->collection_base ;
          $request['general_collection']  = $collectionSetting->general_collection ;
          $request['first_allocation_collection']= $collectionSetting->first_allocation_collection ;
          $request['second_allocation_collection'] = $collectionSetting->second_allocation_collection;
          
          (new CollectionController())->collectionSettings($request , $company);
          return redirect()->route('forecast.report' , [$company->id]);
        
    }
}
