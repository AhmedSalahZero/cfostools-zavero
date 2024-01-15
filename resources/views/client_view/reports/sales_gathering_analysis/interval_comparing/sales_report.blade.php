@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
        <style>
            .chartdiv {
                width: 100% !important;height: 500px !important;
            }

        </style>
@endsection
@section('sub-header')
    {{ __($view_name) }}
@endsection
@section('content')
    <div class="row">
        <?php $intervals = ['First'=>'_one', 'Second' => '_two']; ?>
        @foreach ($intervals as $interval_name => $name)

            <div class="col-md-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                <b> {{__('From : ')}} </b>{{ $dates['start_date'.$name]}}
                                <b> - </b>
                                <b> {{__('To : ') }}</b> {{ $dates['end_date'.$name]}}
                                <br>

                                <span class="title-spacing"><b> {{__('Last Updated Data Date : ') }}</b> {{ $last_date}}</span>
                                <br>
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->

                        <!-- HTML -->
                        <div id="chartdiv{{$name}}" class="chartdiv"></div>

                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <?php $report_name = 'result_for_interval'.$name?>
            <input type="hidden" id="data{{$name}}" data-total="{{ json_encode($$report_name) }}">
        @endforeach
    </div>
    <div class="row">
        {{-- Tables --}}
        @foreach ($intervals as $interval_name => $name)
            <?php
                $report_name = 'result_for_interval'.$name ;
                $report_count_data = 'count_result_for_interval'.$name ;
            ?>

            <div class="col-md-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">

                                <b> {{__('From : ')}} </b>{{ $dates['start_date'.$name]}}
                                <b> - </b>
                                <b> {{__('To : ') }}</b> {{ $dates['end_date'.$name]}}
                                <br>

                                <span class="title-spacing"><b> {{__('Last Updated Data Date : ') }}</b> {{ $last_date}}</span>
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->


                        <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll_no_search'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>#</th>
                                    <th>{{ __(ucwords(str_replace('_',' ',$type))) }}</th>
                                    <th>{{ __('Sales Values') }}</th>
                                    <th>{{ __('Sales %') }}</th>
                                    @if (isset($$report_count_data) && count($$report_count_data) > 0)
                                        <th>{{ __('Count') }}</th>
                                        <th>{{ __('Count %') }}</th>
                                    @endif
                                </tr>
                            @endslot
                            @slot('table_body')
                                <?php $total = array_sum(array_column($$report_name,'Sales Value'));
                                    $total_count = (isset($$report_count_data) && count($$report_count_data) > 0) ? array_sum(array_column($$report_count_data,'Count')) : 0; ?>
                                @foreach ($$report_name as $key => $item)
                                <tr>
                                    <th>{{$key+1}}</th>
                                    <th>{{$item['item']?? '-'}}</th>
                                    <td class="text-center">{{number_format($item['Sales Value']??0)}}</td>
                                    <td class="text-center">{{$total == 0 ? 0 : number_format((($item['Sales Value']/$total)*100) , 1) . ' %'}}</td>
                                    @if (isset($$report_count_data) && count($$report_count_data) > 0)
                                        <td class="text-center">{{ $$report_count_data[$key]['Count'] }}</td>
                                        <td class="text-center">{{$total == 0 ? 0 : number_format((($$report_count_data[$key]['Count'] /$total_count)*100) , 1) . ' %'}}</td>
                                    @endif
                                </tr>
                                @endforeach
                                <tr class="table-active text-center">
                                    <th colspan="2">{{__('Total')}}</th>
                                    <td class="hidden"></td>
                                    <td>{{number_format($total)}}</td>
                                    <td>100 %</td>
                                    @if (isset($$report_count_data) && count($$report_count_data) > 0)
                                    <th>{{ $total_count  }}</th>
                                    <td>100 %</td>
                                @endif
                                </tr>
                            @endslot
                        </x-table>

                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')

    {{-- Old Chart --}}

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
</script>
<!-- Chart code -->
@foreach ($intervals as $interval_name => $name)
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv"+'{{$name}}', am4charts.PieChart);

            // Add data
            chart.data = $('#data'+'{{$name}}').data('total');
            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "Sales Value";
            pieSeries.dataFields.category = "item";
            pieSeries.innerRadius = am4core.percent(50);
            // arrow
            pieSeries.ticks.template.disabled = true;
            //number
            pieSeries.labels.template.disabled = true;

            var rgm = new am4core.RadialGradientModifier();
            rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
            pieSeries.slices.template.fillModifier = rgm;
            pieSeries.slices.template.strokeModifier = rgm;
            pieSeries.slices.template.strokeOpacity = 0.4;
            pieSeries.slices.template.strokeWidth = 0;

            chart.legend = new am4charts.Legend();
            chart.legend.position = "right";
            chart.legend.scrollable = true;

        }); // end am4core.ready()
    </script>
@endforeach


{{-- New Chart --}}

<!-- Resources -->
{{-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            radius: am5.percent(90),
            innerRadius: am5.percent(50),
            layout: root.horizontalLayout
        }));

        // Create series
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
        var series = chart.series.push(am5percent.PieSeries.new(root, {
            name: "Series",
            valueField: "Sales Value",
            categoryField: "item"
        }));

        // Set data
        // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
        chart_data = $('#total').data('total');
        series.data.setAll(chart_data);

        // Disabling labels and ticks
        series.labels.template.set("visible", true);
        series.ticks.template.set("visible", true);

        // Adding gradients
        series.slices.template.set("strokeOpacity", 0);
        series.slices.template.set("fillGradient", am5.RadialGradient.new(root, {
            stops: [{
                brighten: -0.8
            }, {
                brighten: -0.8
            }, {
                brighten: -0.5
            }, {
                brighten: 0
            }, {
                brighten: -0.5
            }]
        }));

        // Create legend
        // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
        var legend = chart.children.push(am5.Legend.new(root, {
            centerY: am5.percent(10),
            y: am5.percent(10),
            marginTop: 15,
            marginBottom: 15,
            layout: root.verticalLayout
        }));

        legend.data.setAll(series.dataItems);


        // Play initial series animation
        // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
        series.appear(1000, 100);

    }); // end am5.ready()
</script> --}}



@endsection
