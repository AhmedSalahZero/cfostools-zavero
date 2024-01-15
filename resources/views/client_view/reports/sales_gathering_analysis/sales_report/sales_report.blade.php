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
    {{ __('Sales Report') }}
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
                                        <h4> {{ __('Monthly Sales Values') }} </h4>
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
                                        <h4> {{ __('Accumulated Sales Values') }} </h4>
                                        <div id="accumulated_chartdiv" class="chartdashboard"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--End:: Tab  EGP FX Rate Table -->

                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">

                                    <b> {{ __('From : ') }} </b>{{ $request_dates['start_date'] }}
                                    <b> - </b>
                                    <b> {{ __('To : ') }}</b> {{ $request_dates['end_date'] }}
                                    <br>

                                    <span class="title-spacing"><b> {{ __('Last Updated Data Date : ') }}</b>
                                        {{ $last_date }}</span>
                                </h3>
                            </div>

                        </div>
                    </div>



                    <!--begin: Datatable -->

                    <x-table :tableClass="'kt_table_with_no_pagination_no_search'">
                    {{-- <x-table :tableClass="'kt_table_with_no_pagination'"> --}}
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
                                <td colspan="{{ count($dates) + 2 }}"><b
                                        class="white-text">{{ __('Monthly Sales') }}</b></td>
                                @foreach ($dates as $date)
                                    <td class="hidden"> </td>
                                @endforeach
                                <td class="hidden"> </td>
                            </tr>
                            <?php $chart_data = []; ?>

                            @foreach ($report_data as $label => $data)
                                <tr>
                                    <th>{{ __($label) }}</th>
                                    <?php $num_of_decimals = $label == 'Month Sales %' ? 1 : 0; ?>
                                    @foreach ($dates as $date)

                                        <td>{{ number_format($data[$date] ?? 0, $num_of_decimals) . ($label == 'Month Sales %' ? ' %' : '') }}
                                            @if ($label == 'Sales Values')

                                                <span class="active-text-color "><b>
                                                        {{ '    [ GR  ' . number_format($gr[$date] ?? 0, 1) . ' % ] ' }}</b></span>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>{{ number_format(array_sum($data)) . ($label == 'Month Sales %' ? ' %' : '') }}</td>
                                </tr>
                            @endforeach
                            <tr class="group-color text-lg-left  ">
                                <td colspan="{{ count($dates) + 2 }}"><b
                                        class="white-text">{{ __('Accumulated Sales') }}</b></td>
                                @foreach ($dates as $date)
                                    <td class="hidden"> </td>
                                @endforeach
                                <td class="hidden"> </td>
                            </tr>


                            <tr>
                                <th>{{ __('Sales Values') }}</th>
                                <?php $accumulated_total = 0; ?>
                                @foreach ($dates as $date)
                                    <?php
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
                                    ?>
                                    <?php ?>
                                    <td>{{ number_format($accumulated_total) }}</td>
                                @endforeach
                                <td>-</td>
                            </tr>


                        @endslot
                    </x-table>
                    <input type="hidden" id="monthly_data" data-total="{{ json_encode($chart_data??[]) }}">
                    <input type="hidden" id="accumulated_data" data-total="{{ json_encode($accumulated_chart_data??[]) }}">
                    <!--end: Datatable -->
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

    <script>
        $(function(){
            // $('.kt_table_with_no_pagination').DataTable().columns.adjust();
        })
    </script>
@endsection
