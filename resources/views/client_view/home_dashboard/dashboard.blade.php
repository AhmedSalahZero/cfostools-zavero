@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }
        

    </style>
@endsection
@section('dash_nav')
    @include('client_view.home_dashboard.main_navs' , ['active'=>'sales_dashboard'])
@endsection

@section('content')
@php 
// $dates = [ ];
// $report_data  = []
 
@endphp 
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title head-title text-primary">
                    {{ __('Dashboard Results') }}
                </h3>
            </div>
        </div>
        {{-- Dates --}}
        <div class="kt-portlet__body">
            <form action="{{route('dashboard',$company)}}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-md-5">
                        <label>{{ __('Start Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" name="start_date" required value="{{ $start_date }}"
                                    max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label>{{ __('End Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" name="end_date" required value="{{ $end_date }}"
                                    max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-1">
                        <label> </label>
                        <div class="kt-input-icon">
                            <button type="submit" class="btn active-style">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--begin:: Widgets/Stats-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title head-title text-primary">
                    {{ __('Sales Results') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="row row-no-padding row-col-separator-xl">
                {{-- Daily --}}
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <!--begin::New Orders-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title font-size">
                                    {{ __('Day Sales') }} <span 
                                    {{-- id="end-date-id" --}}
                                    > :   {{ $end_date ?  \Carbon\Carbon::make($end_date)->format('d-M-Y') : '' }}
                                    {{-- asdasdasd --}}

                                        {{-- {{ $salesReport['last_date'] }} --}}
                                       <br>
                                        {{-- {{ $daySales[0]->day_sales }} --}}
                                           </span>
                                </h4>

                            </div>
                        </div>
                        <div class="kt-widget24__details">
                            <span class="kt-widget24__stats kt-font-dark">
                                {{ number_format($daySales) }} 
                                {{-- {{ $sales_value_data['daily_sales'] !== '-' ? number_format($sales_value_data['daily_sales']) : '-' }} --}}
                            </span>
                        </div>

                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-dark" role="progressbar" style="width: 100%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action">
                            <span class="kt-widget24__change">

                            </span>
                            <span class="kt-widget24__number">

                            </span>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                {{-- Current --}}
                <div class="col-md-6 col-lg-4 col-xl-4">

                    <!--begin::New Orders-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                   {{-- @if(isset((explode('-', $salesReport['last_date'])[1] ))) --}}
                                <h4 class="kt-widget24__title font-size">
                 

                                    {{ __('Current Month') }}   :
                                    {{ \Carbon\Carbon::make($end_date)->format('M - Y') }}
                                     {{-- {{ (explode('-', $salesReport['last_date'])[1] ?? '')  . ( ' - '  . explode('-', $salesReport['last_date'])[2] ?? '') }} --}}
                                    {{-- {{ __('Current Month') }}   :  --}}
                                   
                                </h4>

                                {{-- @endif  --}}

                            </div>
                        </div>
                        <div class="kt-widget24__details">
                            <span class="kt-widget24__stats kt-font-danger">
                                 {{ number_format($currentMonthSales) }}
                                {{-- {{ $sales_value_data['current_month'] !== '-' ? number_format($sales_value_data['current_month']) : '-' }} --}}
                                {{-- {{ $sales_value_data['current_month'] !== '-' ? number_format($sales_value_data['current_month']) : '-' }} --}}
                            </span>
                        </div>
                 
                        <?php
                        // $current_month = $sales_value_data['current_month'] !== '-' ? $sales_value_data['current_month'] : 0;
                        // $previous_month = $sales_value_data['previous_month'] !== '-' ? $sales_value_data['previous_month'] : 0;
                        // $percentage = $previous_month == 0 ? 0 : number_format((($current_month - $previous_month) / $previous_month) * 100);
                        ?>
                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-danger" role="progressbar" style="width: {{ $percentage }}%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action">
                            <span class="kt-widget24__change">
                                {{ __('Change') }}
                            </span>
                            <span class="kt-widget24__number">
                                {{-- {{ $percentage }}%  --}}
                                {{-- <br> --}}
                                 {{ number_format($percentage , 2) }} %
                            </span>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                {{-- Year To Date --}}
                <div class="col-md-6 col-lg-4 col-xl-4">

                    <!--begin::New Users-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <h4 class="kt-widget24__title font-size">
                                    {{ __('Year To Date Sales') }}
                                     ({{ $yearOfEndDate =  \Carbon\Carbon::make($end_date)->startOfMonth()->subMonth(1)->format('Y') }})
                                    
                                </h4>

                            </div>
                        </div>
                        <div class="kt-widget24__details">
                            <span class="kt-widget24__stats kt-font-success">
                                {{ number_format($salesToDate) }} 
                                {{-- <br> --}}
                                {{-- {{ $sales_value_data['year_to_date'] !== '-' ? number_format($sales_value_data['year_to_date']) : '-' }} --}}
                            </span>
                        </div>
                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-success" role="progressbar" style="width: 100%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action">

                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
                {{-- Previous 3 Months --}}
                <div class="col-md-6 col-lg-6 col-xl-6">

                    <!--begin::Total Profit-->
                    <div class="kt-widget24 text-center">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                             
                                {{-- @if($salesReport['last_date']) --}}
                                <h4 class="kt-widget24__title font-size">
                                    {{ __('Previous 3 Months') }} : ( {{ \Carbon\Carbon::make($end_date)->startOfMonth()->subMonth(3)->format('M') 
                                    . ' - ' . \Carbon\Carbon::make($end_date)->startOfMonth()->subMonth(2)->format('M') . ' - ' .
                                     \Carbon\Carbon::make($end_date)->startOfMonth()->subMonth(1)->format('M') }}  )

                                    ({{ $yearOfEndDate }})
                                    
                                </h4>
                                {{-- @endif  --}}

                            </div>
                        </div>
                        <div class="kt-widget24__details">
                            <span class="kt-widget24__stats kt-font-brand">
                                {{-- <span style="color:red !important">{{ NUMBER }}</span> --}}
                                {{-- {{ $sales_value_data['previous_three_months'] !== '-' ? number_format($sales_value_data['previous_three_months']) : '-' }} --}}
                                {{ number_format($perviousThreeMonthsSales) }}
                            </span>
                        </div>

                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 100%;" aria-valuenow="50"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action">
                            <span class="kt-widget24__change">

                            </span>
                            <span class="kt-widget24__number">

                            </span>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                {{-- Previous Month --}}
                <div class="col-md-6 col-lg-6 col-xl-6">

                    <!--begin::New Feedbacks-->
                    <div class="kt-widget24">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                {{-- @if($salesReport['last_date']) --}}
                                <h4 class="kt-widget24__title font-size">
                                    {{ __('Previous Month') }} : ( {{ 
                                      \Carbon\Carbon::make($end_date)->startOfMonth()->subMonth(1)->format('M')
                                      }} ) ({{ $yearOfEndDate ?? '' }})
                                </h4>
                                {{-- @endif  --}}
                            </div>
                        </div>
                        <div class="kt-widget24__details">
                            <span class="kt-widget24__stats kt-font-warning" >
                                <span class="text-red"></span>
                                {{ number_format($previous_month_sales) }}
                                {{-- {{ $sales_value_data['previous_month'] !== '-' ? number_format($sales_value_data['previous_month']) : '-' }} --}}
                            </span>
                        </div>
                        <div class="progress progress--sm">
                            <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 100%;"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="kt-widget24__action">
                            <span class="kt-widget24__change">

                            </span>
                            <span class="kt-widget24__number">

                            </span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
            </div>
        </div>
    </div>
    <!--end:: Widgets/Stats-->
        {{-- Title --}}
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{ __('Sales Trend Analysis Charts') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- First Section --}}
    <div class="row">
        {{-- Total Facilities --}}
        <div class="col-md-12">
            <div class="kt-portlet ">

                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-widget12__chart">
                                <h4> {{ __('Monthly Sales Values') }} </h4>
                                <div id="monthly_chartdiv" class="chartdashboard"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="kt-widget12__chart">
                                <!-- HTML -->
                                <h4> {{ __('Accumulated Sales Values') }} </h4>
                                <div id="accumulated_chartdiv" class="chartdashboard"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- @php 
    $dates = $salesReport['dates'];
    $report_data = $salesReport['report_data'];
    $gr = $salesReport['gr'];
    $last_date = $salesReport['last_date'];
  @endphp --}}
    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet ">

                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">

                                <div class="kt-portlet kt-portlet--mobile">
                                    <div class="kt-portlet__head kt-portlet__head--lg">
                                        <div class="kt-portlet__head-label">
                                            <span class="kt-portlet__head-icon">
                                                <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                                            </span>
                                            <h3 class="kt-portlet__head-title">

                                                {{__('Monthly And Accumulated Sales Table')}}

                                                {{-- <span class="title-spacing"><b> {{ __('Last Updated Data Date : ') }}</b>
                                                    {{ $last_date ?? 'Last Date' }}</span> --}}
                                            </h3>
                                        </div>

                                    </div>
                                </div>

                                <x-table :fixedColumns=[] :tableClass="'kt_table_with_no_pagination_no_search'">

                                     @slot('table_header')
                                        @php $tableHeader = $monthlyChartArr[array_key_first($monthlyChartArr)] ?? []  @endphp
                                        <tr class="table-active text-center">
                                            <th>{{ __('Sales Value / Month') }}</th>
                                         @foreach($tableHeader as $key => $date)
                                                <th>{{ $date }}</th>
                                                @if($loop->last)
                                                       <td>{{ __('Total Sales') }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endslot
                                @php array_shift($monthlyChartArr) @endphp 
                                             @slot('table_body')
                                    @foreach ($monthlyChartArr as $title => $values)
                                    @if(isset($values) && is_null($values[0]))
                   
                                             <tr class="group-color text-lg-left  ">
                                            <td colspan="{{ count($values) + 2 }}"><b
                                                    class="white-text">{{ __($title) }}</b></td>
                                            @foreach ($values as $item)
                                                <td class="hidden"> </td>
                                            @endforeach
                                            <td class="hidden"> </td>
                                        </tr>
                                        @else
                                       
                                         <tr class=" text-lg-left  ">
                                            <td ><b
                                                    class="">{{ __($title) }}</b></td>
                                            @foreach ($values as $val)
                                                <td > {!! $val !!} </td>
{{-- 
                                                @if($loop->last)
                                                <td>
                                               
                                                </td>
                                                @endif  --}}
                                            @endforeach
                                            <td class="hidden"> </td>
                                        </tr>

                                        @endif 

                                        
                                    @endforeach
                                             @endslot 
                                </x-table>







{{-- 
                                 <x-table :tableClass="'kt_table_with_no_pagination'">
                                    @slot('table_header')
                                        <tr class="table-active text-center">
                                            <th>{{ __('Sales Value / Month') }}</th>
                                            @foreach ($dates as $date)
                                                <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                            @endforeach
                                            <td>{{ __('Total Sales') }}</td>

                                        </tr>
                                    @endslot
                                    @slot('table_body')
                                        <tr class="group-color text-lg-left  ">
                                            <td colspan="{{ count($dates ?? []) + 2  }}"><b
                                                    class="white-text">{{ __('Monthly Sales') }}</b></td>
                                            @foreach ($dates as $date)
                                                <td class="hidden"> </td>
                                            @endforeach
                                            <td class="hidden"> </td>
                                        </tr>
                                        @php $chart_data = []; @endphp

                                        @foreach ($report_data as $label => $data)

                                            <tr>
                                                <th>{{ __($label) }}</th>
                                                @php $num_of_decimals = $label == 'Month Sales %' ? 1 : 0; @endphp
                                                @foreach ($dates as $date)

                                                    <td>{{ number_format($data[$date] ?? 0, $num_of_decimals) . ($label == 'Month Sales %' ? ' %' : '') }}
                                                        @if ($label == 'Sales Values')

                                                            <span class="active-text-color"><b>
                                                                    {{ '    [ GR  ' . number_format($gr[$date] ?? 0, 1) . ' % ] ' }}</b></span>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                <td>{{ number_format(array_sum($data)) . ($label == 'Month Sales %' ? ' %' : '') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="group-color text-lg-left  ">
                                            <td colspan="{{ count($dates ?? []) + 2 ?? 0 }}"><b
                                                    class="white-text">{{ __('Accumulated Sales') }}</b></td>
                                            @foreach ($dates as $date)
                                                <td class="hidden"> </td>
                                            @endforeach
                                            <td class="hidden"> </td>
                                        </tr>


                                        <tr>
                                            <th>{{ __('Sales Values') }}</th>
                                            @php $accumulated_total = 0; @endphp
                                            @foreach ($dates as $date)
                                                @php

                                                $accumulated_total += $report_data['Sales Values'][$date] ?? 0;
                                                $chart_data[] = [
                                                    'date' => date('d-M-Y', strtotime($date)),
                                                    'Sales Values' => number_format($report_data['Sales Values'][$date] ?? 0, 0),
                                                    'Month Sales %' => number_format($report_data['Month Sales %'][$date] ?? 0, 0),
                                                    'Growth Rate %' => number_format($gr[$date] ?? 0, 1),
                                                ];
                                                $accumulated_chart_data[] = [
                                                    'date' => date('d-M-Y', strtotime($date)),
                                                    'price' => number_format($accumulated_total, 0),
                                                ];
                                                @endphp
                                           
                                                <td>{{ number_format($accumulated_total) }}</td>
                                            @endforeach
                                            <td>-</td>
                                        </tr>


                                    @endslot
                                </x-table> --}}

                      
                                <input type="hidden" id="monthly_data" data-total="{{ json_encode($formattedDataForChart ?? []) }}">
                                <input type="hidden" id="accumulated_data"
                                    data-total="{{ json_encode($monthlyChartCumulative ?? []) }}">

                                    {{-- <input type="hidden" id="monthly_data" data-total="{{ json_encode($chart_data ?? []) }}">
                                <input type="hidden" id="accumulated_data"
                                    data-total="{{ json_encode($accumulated_chart_data ?? []) }}"> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection
@section('js')

    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}"
        type="text/javascript">
    </script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
    </script>


    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance

            var chart = am4core.create("monthly_chartdiv", am4charts.XYChart);

            // Increase contrast by taking evey second color
            chart.colors.step = 2;

            // Add data
            chart.data = $('#monthly_data').data('total');

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

    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("accumulated_chartdiv", am4charts.XYChart);

            // Add data
            chart.data = $('#accumulated_data').data('total');

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";


            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "price";
            series.dataFields.dateX = "date";
            series.tooltipText = "{price}"
            series.strokeWidth = 2;
            series.minBulletDistance = 5;

            // Drop-shaped tooltips
            series.tooltip.background.cornerRadius = 20;
            series.tooltip.background.strokeOpacity = 0;
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.label.minWidth = 40;
            series.tooltip.label.minHeight = 40;
            series.tooltip.label.textAlign = "middle";
            series.tooltip.label.textValign = "middle";

            // Make bullets grow on hover
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 4;
            bullet.circle.fill = am4core.color("#fff");

            var bullethover = bullet.states.create("hover");
            bullethover.properties.scale = 1.3;

            // Make a panning cursor
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;
            valueAxis.cursorTooltipEnabled = false;

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.0005;
            dateAxis.keepSelection = true;


        }); // end am4core.ready()
    </script>
    
@endsection
