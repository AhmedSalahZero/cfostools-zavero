@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }

    </style>
@endsection
@section('sub-header')
    {{ __('Collection Report For Year [ ' . $forecast_year . ' ]') }}
@endsection
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
        <div class="kt-portlet__body">
            <div class="tab-content  kt-margin-t-20">

                <!--Begin:: Tab  EGP FX Rate Table -->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">

                    {{-- Monthly Chart --}}
                    <div class="col-xl-12">
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__body kt-portlet__body--fluid">
                                <div class="kt-widget12">
                                    <div class="kt-widget12__chart">
                                        <!-- HTML -->
                                        <h4> {{ __('Monthly Collection Values') }} </h4>
                                        <div id="monthly_chartdiv" class="chartdashboard"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__body kt-portlet__body--fluid">
                                <div class="kt-widget12">
                                    <div class="kt-widget12__chart">
                                        <!-- HTML -->
                                        <h4> {{ __('Accumulated Collection Values') }} </h4>
                                        <div id="accumulated_chartdiv" class="chartdashboard"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--End:: Tab  EGP FX Rate Table -->
                <?php
                $monthly_chart_data = [];
                $accumulated_chart_data = [];
                $accumulated_value = 0;
                $dates = getLargestArrayDates($collection);
                ?>
                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                    <?php $collection_base = ucwords(str_replace('_', ' ', $collection_settings->collection_base)); ?>
                    @if ($collection_settings->collection_base == 'general_collection_policy')
                        <x-table :tableTitle="__($collection_base.' Collection Policy')"
                            :tableClass="'kt_table_with_no_pagination_no_scroll'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __('Collection / Months') }}</th>

                                      @foreach ($dates as $date )
                                        <th>{{ $date }}</th>
                                        {{-- <th>{{ date('M-Y', strtotime($date)) }}</th> --}}
                                    @endforeach

                                    {{-- @foreach ($monthly_dates as $date => $value)
                                        <th>{{ date('M-Y', strtotime($date)) }}</th>
                                    @endforeach --}}
                                    <th> {{ __('Total Year') }} </th>
                                </tr>
                            @endslot
                            @slot('table_body')
                                <tr>
                                    <td><b>{{ __('Collection') }}</b></td>
                                    @foreach ($dates as $date )
                                     @php
                                            $numericDate = \Carbon\Carbon::make($date)->format('d-m-Y');
                                        @endphp

                                        <td class="text-center"> {{ number_format($collection[$numericDate] ?? 0) }}
                                        </td>
                                        <?php
                                        $accumulated_value += $collection[$numericDate] ?? 0;
                                        $monthly_chart_data[] = [
                                            'date' => date('d-M-Y', strtotime($numericDate)),
                                            'price' => number_format($collection[$numericDate] ?? 0, 0),
                                        ];
                                        $accumulated_chart_data[] = [
                                            'date' => date('d-M-Y', strtotime($numericDate)),
                                            'price' => number_format($accumulated_value, 0),
                                        ];
                                        ?>
                                    @endforeach
                                    <td class="text-center active-style">{{ number_format(array_sum($collection)) }}</td>
                                </tr>
                            @endslot
                        </x-table>
                    @else
                        <x-table :tableTitle="__($collection_base.' Collection Policy')"
                            :tableClass="'kt_table_with_no_pagination_no_scroll'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __($collection_base . ' / Months') }}</th>
                                    @foreach ($dates as $date )
                                        <th>{{ $date }}</th>
                                        {{-- <th>{{ date('M-Y', strtotime($date)) }}</th> --}}
                                    @endforeach
                                    <th> {{ __('Total Year') }} </th>
                                </tr>
                            @endslot
                            @slot('table_body')
                                <?php $total = []; ?>
                                @foreach ($collection as $base_name => $base_collection)
                                    <tr>
                                        <td> <b> {{ $base_name }} </b></td>
                                        @php
                                            $totalForThisRow = 0 ;
                                        @endphp
                                        @foreach ($dates as $date )
                                        @php
                                            $numericDate = \Carbon\Carbon::make($date)->format('d-m-Y');
                                            $totalForThisRow += $base_collection[$numericDate]??0 ; 
                                        @endphp
                                            <?php $total[$numericDate] = ($base_collection[$numericDate] ?? 0) + ($total[$numericDate] ?? 0); ?>
                                            <td class="text-center"> {{ number_format($base_collection[$numericDate] ?? 0) }}
                                            </td>
                                        @endforeach
                                        <td class="text-center active-style">{{ number_format($totalForThisRow) }} </td>
                                        {{-- <td class="text-center active-style">{{ number_format(array_sum($base_collection)) }} </td> --}}
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="active-style"> <b> {{ __('Total') }} </b></td>
                                        @foreach ($dates as $date )

                                         @php
                                            $numericDate = \Carbon\Carbon::make($date)->format('d-m-Y');
                                        @endphp

                                        <td class="active-style">{{ number_format($total[$numericDate] ?? 0) }}</td>
                                        <?php
                                        $accumulated_value += $total[$numericDate] ?? 0;
                                        $monthly_chart_data[] = [
                                            'date' => date('d-M-Y', strtotime($numericDate)),
                                            'price' => number_format($total[$numericDate] ?? 0, 0),
                                        ];
                                        $accumulated_chart_data[] = [
                                            'date' => date('d-M-Y', strtotime($numericDate)),
                                            'price' => number_format($accumulated_value, 0),
                                        ];
                                        ?>
                                    @endforeach
                                    <td class="text-center active-style">{{ number_format(array_sum($total)) }}</td>
                                </tr>



                                


                                 <tr class="table-active text-center">
                                    <th>{{ __( 'Accumulation / Months') }}</th>
                                    {{-- <th>{{ __($collection_base . ' / Months') }}</th> --}}
                                    @foreach ($dates as $date )
                                    
                                        <th>{{ $date }}</th>
                                        {{-- <th>{{ date('M-Y', strtotime($date)) }}</th> --}}
                                    @endforeach
                                    <th>  </th>
                                </tr>


                                @foreach ($collection as $base_name => $base_collection)
                                @php
                                $currentAccumlation = 0 ;     
                                @endphp
                                
                                      
                                
                                    <tr>
                                        <td> <b> {{ $base_name }} </b></td>
                                        @foreach ($dates as $date )
                                           @php
                                            $numericDate = \Carbon\Carbon::make($date)->format('d-m-Y');
                                        @endphp
                                        @php
                                        $currentAccumlation += $base_collection[$numericDate] ?? 0 ;
                                        @endphp
                                            <td class="text-center"> {{ number_format($currentAccumlation) }}
                                            </td>
                                        @endforeach
                                        <td class="text-center active-style">

                                        </td>
                                    </tr>
                                @endforeach
                                

                            @endslot
                        </x-table>
                    @endif
                    <input type="hidden" id="monthly_data" data-total="{{ json_encode($monthly_chart_data ?? []) }}">
                    <input type="hidden" id="accumulated_data"
                        data-total="{{ json_encode($accumulated_chart_data ?? []) }}">
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        {{-- Submit --}}
        <div class="kt-portlet">
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                            {{-- <button type="submit" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <a href="{{ route('forecast.report', $company) }}" class="btn active-style">{{ __('Sales Forecast Dashboard') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>

    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
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

            // Add data
            chart.data = $('#monthly_data').data('total');

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
