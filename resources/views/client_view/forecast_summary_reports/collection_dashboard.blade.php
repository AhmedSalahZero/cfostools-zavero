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
    <ul class="kt-menu__nav ">

        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('forecast.report', $company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text">{{ __('Sales Target Dashboard') }}</span></a>
        </li>
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a
                href="{{ route('breakdown.forecast.report', $company) }}" class="kt-menu__link "><span
                    class="kt-menu__link-text">{{ __('Target Breakdown Dashboard') }}</span></a>
        </li>

        <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a
                href="{{ route('collection.forecast.report', $company) }}" class="kt-menu__link active-button"><span
                    class="kt-menu__link-text active-text">{{ __('Target Collection Dashboard') }}</span></a>

    </ul>
@endsection

@section('content')



    {{-- First Section --}}
    <div class="row">
        {{-- Total Facilities --}}
        <div class="col-md-12">
            <div class="kt-portlet ">

                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-widget12__chart">
                                <h4> {{ __('Monthly Collection Values') }} </h4>
                                <div  id="monthly_chartdiv" class="chartdashboard"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
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
    </div>


    <?php
    $monthly_chart_data = [];
    $accumulated_chart_data = [];
    $accumulated_value = 0;
    ?>
    {{-- First Section --}}
    <div class="row">
        {{-- Total Facilities --}}
        <div class="col-md-12">
            <div class="kt-portlet ">

                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">

                                <?php $collection_base = ucwords(str_replace('_', ' ', $collection_settings->collection_base)); ?>
                                {{-- General Collection Policy --}}
                                @if ($collection_settings->collection_base == 'general_collection_policy')
                                    <x-table :tableTitle="__($collection_base.' Collection Policy')"
                                        :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                        @slot('table_header')
                                            <tr class="table-active text-center">
                                                <th>{{ __('Collection / Months') }}</th>
                                                @foreach ($monthly_dates as $date => $value)
                                                    <th>{{ date('M-Y', strtotime($date)) }}</th>
                                                @endforeach
                                                <th> {{ __('Total Year') }} </th>
                                            </tr>
                                        @endslot
                                        @slot('table_body')
                                            <tr>
                                                <td><b>{{ __('Collection') }}</b></td>
                                                @foreach ($monthly_dates as $date => $value)
                                                    <td class="text-center"> {{ number_format($collection[$date] ?? 0) }}
                                                    </td>
                                                    <?php
                                                    $accumulated_value += $collection[$date] ?? 0;
                                                    $monthly_chart_data[] = [
                                                        'date' => date('d-M-Y', strtotime($date)),
                                                        'price' => number_format($collection[$date] ?? 0, 0),
                                                    ];
                                                    $accumulated_chart_data[] = [
                                                        'date' => date('d-M-Y', strtotime($date)),
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
                                                @foreach ($monthly_dates as $date => $value)
                                                    <th>{{ date('M-Y', strtotime($date)) }}</th>
                                                @endforeach
                                                <th> {{ __('Total Year') }} </th>
                                            </tr>
                                        @endslot
                                        @slot('table_body')
                                            <?php $total = []; ?>
                                            @foreach ($collection as $base_name => $base_collection)
                                                <tr>
                                                    <td> <b> {{ $base_name }} </b></td>
                                                    @foreach ($monthly_dates as $date => $value)
                                                        <?php $total[$date] = ($base_collection[$date] ?? 0) + ($total[$date] ?? 0); ?>
                                                        <td class="text-center"> {{ number_format($base_collection[$date] ?? 0) }}
                                                        </td>
                                                    @endforeach
                                                    <td class="text-center active-style">{{ number_format(array_sum($base_collection)) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="active-style"> <b> {{ __('Total') }} </b></td>
                                                @foreach ($monthly_dates as $date => $value)
                                                    <td class="active-style">{{ number_format($total[$date] ?? 0) }}</td>
                                                    <?php
                                                    $accumulated_value += $total[$date] ?? 0;
                                                    $monthly_chart_data[] = [
                                                        'date' => date('d-M-Y', strtotime($date)),
                                                        'price' => number_format($total[$date] ?? 0, 0),
                                                    ];
                                                    $accumulated_chart_data[] = [
                                                        'date' => date('d-M-Y', strtotime($date)),
                                                        'price' => number_format($accumulated_value, 0),
                                                    ];
                                                    ?>
                                                @endforeach
                                                <td class="text-center active-style">{{ number_format(array_sum($total)) }}</td>
                                            </tr>
                                        @endslot
                                    </x-table>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <input type="hidden" id="monthly_data" data-total="{{ json_encode($monthly_chart_data ?? []) }}">
    <input type="hidden" id="accumulated_data" data-total="{{ json_encode($accumulated_chart_data ?? []) }}">





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
