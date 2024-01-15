@extends('layouts.dashboard')
@section('css')

    {{-- <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <style>
        table {
            white-space: nowrap;
        }

        .dataTables_wrapper{max-width: 100%;  padding-bottom: 50px !important;overflow-x: overlay;max-height: 4000px;}
    </style>


@endsection


@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css"/>

<style>
      table.dataTable thead tr > .dtfc-fixed-left, table.dataTable thead tr > .dtfc-fixed-right{
        background-color:#086691;
    }
    .dataTables_wrapper .dataTable th, .dataTables_wrapper .dataTable td{
        /* color:#595d6e ; */
    }
    table.dataTable tbody tr.group-color > .dtfc-fixed-left, table.dataTable tbody tr.group-color > .dtfc-fixed-right{
        background-color:#086691 !important;
    }
    
    
  .dataTables_wrapper .dataTable th, .dataTables_wrapper .dataTable td{
      color:#595d6e;
  }
    thead *{
        text-align:center !important;
    }
</style>
@endpush 
@push('js')
@include('js_datatable')
@endpush


@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (session('warning'))
                <div class="alert alert-warning">
                    <ul>
                        <li>{{ session('warning') }}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1" role="tab">
                            <i class="flaticon-line-graph"></i> &nbsp; Charts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                            <i class="flaticon2-checking"></i>Reports Table
                        </a>
                    </li>

                 

                </ul>
            </div>
        </div>
        <div class="kt-portlet__body" >
            <div class="tab-content  kt-margin-t-20">

                <!--Begin:: Tab  EGP FX Rate Table -->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
                    <?php
                    array_push($branches_names, 'Total');
                    array_push($branches_names, 'Branch_Sales_Percentages');
                    $totalArrys = array();
                    ?>
                    @foreach ($branches_names as $name_of_zone)
                        {{-- Monthly Chart --}}
                        <div class="col-xl-12">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__body kt-portlet__body--fluid">
                                    <div class="kt-widget12">
                                        <div class="kt-widget12__chart">
                                            <!-- HTML -->
                                            <h4>{{ str_replace('_', ' ', $name_of_zone) . ($name_of_zone ==  "Branch_Sales_Percentages" ? ' Against Total Sales' : ' Sales Trend Analysis Chart') }}
                                            </h4>
                                            <div id="{{ $name_of_zone }}_count_chartdiv" class="chartdashboard"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--End:: Tab  EGP FX Rate Table -->

                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">

                     



                  
                  
                    <x-table :tableTitle="__('Branch Sales Trend Analysis Report')"
                        :tableClass="'kt_table_with_no_pagination_no_search'">
                        @slot('table_header')
                            <tr class="table-active">
                                <th>{{ __('Branch') }}</th>
                                @foreach ($total_branches as $date => $total)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                    @if($loop->last)
                                    <th>{{ __("Total") }}</th>

                                    @endif 
                                @endforeach
                            </tr>
                        @endslot
                        @slot('table_body')
                        <?php 
                              (uasort($final_report_data, function($a, $b) {
                                return ($a['Sales Values'] < $b['Sales Values']);

}));

                        ?>

                            @foreach ($final_report_data as $zone_name => $zoone_data)
                      
                                <?php $chart_data = []; ?>
                                <tr class="group-color text-lg-left  ">
                                    <td colspan="{{ count($total_branches) + 2 }}"><b
                                            class="white-text">
                                            {{ __($zone_name) }}</b>
                                    </td>
                                    @foreach ($total_branches as $date => $total)
                                        <td class="hidden"> </td>
                                    @endforeach
                                        <td class="hidden"> </td>

                                </tr>
                                <tr>
                                    <th>{{ __('Sales Values') }}</th>
                                    @foreach ($total_branches as $date => $total)
                                        <?php
                                        $chart_data[] = [
                                            'date' => date('d-M-Y', strtotime($date)),
                                            'Sales Value' => number_format($zoone_data['Sales Values'][$date] ?? 0),
                                            'Sales GR %' => number_format($zoone_data['Growth Rate %'][$date] ?? 0, 2),
                                        ]; ?>
                                        <td class="text-center">
                                              {{ number_format($zoone_data['Sales Values'][$date] ?? 0) }}</td>

                                             @if($loop->last)
                                         <td class="text-center">
                                             @php $totalForBranch[$zone_name] = ($totalForSingleBranch = array_sum($zoone_data['Sales Values']) ?? 0)    @endphp 
                                            {{ number_format($totalForSingleBranch) }}
                                        </td>
                                         @endif 

                                    @endforeach

                                </tr>
                                <tr>
                                    <th>{{ __('Growth Rate %') }}</th>
                                    @foreach ($total_branches as $date => $total)
                                        <td class="text-center">
                                            {{ number_format($zoone_data['Growth Rate %'][$date] ?? 0, 2) . ' %' }}</td>

                                             @if($loop->last)
                       <td class="text-center"> 
                           </td>

                                    @endif 

                                    @endforeach
                                    
                                </tr>
                                <input type="hidden" id="{{ str_replace(' ', '_', $zone_name) }}_data"
                                    data-total="{{ json_encode($chart_data) }}">
                            @endforeach

                                                                <?php $sumOfTotalsOfBranchSales = 0 ?>

                            <tr>
                                <th class="active-style text-center">{{ __('TOTAL') }}</th>
                                @foreach ($total_branches as $date => $total)
                                    <td class="text-center active-style">{{ number_format($total ?? 0) }}</td>
                                    <?php $sumOfTotalsOfBranchSales += $total ?>

                                    @if($loop->last)
                                    <td class="text-center active-style">
                                        {{ number_format($sumOfTotalsOfBranchSales ?? 0) }}
                                    </td>

                                    @endif 
                                @endforeach
                            </tr>

                            <tr>
                                <th class="active-style text-center">{{ __('GROWTH RATE %') }}</th>
                                <?php $chart_data = []; ?>

                                @foreach ($total_branches_growth_rates as $date => $total)
                                    <?php
                                    $chart_data[] = [
                                        'date' => date('d-M-Y', strtotime($date)),
                                        'Total Sales Values' => number_format($total_branches[$date] ?? 0),
                                        'Sales GR %' => number_format($total ?? 0, 2),
                                    ]; ?>
                                    <td class="text-center active-style">{{ number_format($total ?? 0, 2) . ' %' }}</td>




                                      @if($loop->last)
                                    <td class="text-center active-style">
                                    </td>
                                    
                                    @endif 

                                    
                                @endforeach
                            </tr>

                            <input type="hidden" id="Total_data" data-total="{{ json_encode($chart_data) }}">

                        @endslot
                    </x-table>

                    <x-table :tableTitle="__('Branch Sales Percentage (%) Against Total Sales')"
                        :tableClass="'kt_table_with_no_pagination_no_search'">
                        @slot('table_header')
                            <tr class="table-active">
                                <th>{{ __('Branch') }}</th>


                                @foreach ($total_branches as $date => $total)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>



                                          @if($loop->last)
                                            <th>{{ __("Total") }}</th>

                                            @endif 


                                @endforeach

                                
                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $chart_data = []; ?>
                            @foreach ($final_report_data as $zone_name => $zoone_data)
                                <tr class="group-color text-lg-left  ">
                                    <td colspan="{{ count($total_branches) + 2 }}"><b
                                            class="white-text">{{ __($zone_name) }}</b></td>
                                    @foreach ($total_branches as $date => $total)
                                        <td class="hidden"> </td>
                                        @if($loop->last)
                                         <td class="hidden"> </td>
                                        @endif 
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>{{ __('Percent %') }}</th>
                                    @foreach ($total_branches as $date => $total)
                                        <?php
                                        $percentage = $total == 0 ? 0 : number_format((($zoone_data['Sales Values'][$date] ?? 0) / ($total ?? 0)*100), 2);
                                        $chart_data[$date][$zone_name] = [$zone_name . ' %' => $percentage, ];
                                        ?>

                                        <td class="text-center">
                                            {{ $percentage . ' %' }}
                                        </td>

                                        @if($loop->last)
                                        <td class="text-center">
                                            {{ $sumOfTotalsOfBranchSales ? number_format((($totalForBranch[$zone_name] / $sumOfTotalsOfBranchSales) * 100  ) , 2) . ' %': 0   }} 
                                        </td>
                                        @endif 
                                    @endforeach
                                </tr>





                            

                            @endforeach
                            <?php
                                $return = array();
                                array_walk($chart_data, function($values,$date) use (&$return) {
                                    $return[] =array_merge(['date'=>date('d-M-Y', strtotime($date))], array_merge(...array_values($values)));
                                });
                            ?>
                            <input type="hidden" id="Branch_Sales_Percentages_data" data-total="{{ json_encode($return) }}">


                            <tr>
                                <th class="active-style text-center">{{ __('TOTAL %') }}</th>
                                @foreach ($total_branches as $date => $total)
                                    <td class="text-center active-style"> {{ $sumOfTotalsOfBranchSales && $total ? number_format(   ($total / $sumOfTotalsOfBranchSales)*100  ,  2) : 0 }} % </td>

                                    @if($loop->last)
                                    <td class="text-center active-style">
                                       {{ $sumOfTotalsOfBranchSales ? '100%' : 0 }}
                                    </td>

                                    @endif 
                                @endforeach
                            </tr>


                        @endslot
                    </x-table>

                      @include('seasonality_table' , ['totalArrys'=>array()])

                </div>


                
                <!--End:: Tab USD FX Rate Table -->
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    {{-- <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> --}}
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    // {{-- </script> --}}
    @foreach ($branches_names as $name_of_zone)
        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance

                var chart = am4core.create("{{ $name_of_zone }}_count_chartdiv", am4charts.XYChart);

                // Increase contrast by taking evey second color
                chart.colors.step = 2;

                // Add data
                chart.data = $('#{{ $name_of_zone }}_data').data('total');
                if("{{ $name_of_zone }}"== 'Branch_Sales_Percentages'){
                    console.log($('#{{ $name_of_zone }}_data').data('total'));
                }
                chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
                // Create axes
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 50;

                // Create series
                function createAxisAndSeries(field, name, opposite, bullet) {
                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                    if (chart.yAxes.indexOf(valueAxis) != 0) {
                        valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
                    }

                    var series = chart.series.push(new am4charts.LineSeries());
                    series.dataFields.valueY = field;
                    series.dataFields.dateX = "date";
                    series.strokeWidth = 2;
                    series.yAxis = valueAxis;
                    series.name = name;
                    series.tooltipText = "{name}: [bold]{valueY}[/]";
                    series.tensionX = 0.8;
                    series.showOnInit = true;

                    var interfaceColors = new am4core.InterfaceColorSet();

                    switch (bullet) {
                        case "triangle":
                            var bullet = series.bullets.push(new am4charts.Bullet());
                            bullet.width = 12;
                            bullet.height = 12;
                            bullet.horizontalCenter = "middle";
                            bullet.verticalCenter = "middle";

                            var triangle = bullet.createChild(am4core.Triangle);
                            triangle.stroke = interfaceColors.getFor("background");
                            triangle.strokeWidth = 2;
                            triangle.direction = "top";
                            triangle.width = 12;
                            triangle.height = 12;
                            break;
                        case "rectangle":
                            var bullet = series.bullets.push(new am4charts.Bullet());
                            bullet.width = 10;
                            bullet.height = 10;
                            bullet.horizontalCenter = "middle";
                            bullet.verticalCenter = "middle";

                            var rectangle = bullet.createChild(am4core.Rectangle);
                            rectangle.stroke = interfaceColors.getFor("background");
                            rectangle.strokeWidth = 2;
                            rectangle.width = 10;
                            rectangle.height = 10;
                            break;
                        default:
                            var bullet = series.bullets.push(new am4charts.CircleBullet());
                            bullet.circle.stroke = interfaceColors.getFor("background");
                            bullet.circle.strokeWidth = 2;
                            break;
                    }

                    valueAxis.renderer.line.strokeOpacity = 1;
                    valueAxis.renderer.line.strokeWidth = 2;
                    valueAxis.renderer.line.stroke = series.stroke;
                    valueAxis.renderer.labels.template.fill = series.stroke;
                    valueAxis.renderer.opposite = opposite;
                }
                $.each(chart.data[0], function(key, val) {
                    if (key != 'date') {
                        createAxisAndSeries(key, key, true, "circle");
                    }
                });



                // Add legend
                chart.legend = new am4charts.Legend();

                // Add cursor
                chart.cursor = new am4charts.XYCursor();


            }); // end am4core.ready()
        </script>
    @endforeach
@endsection
