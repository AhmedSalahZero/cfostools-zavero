@extends('layouts.dashboard')
@section('css')
    <style>
        table {
            white-space: nowrap;
            table-layout: auto;
            border-collapse: collapse;
            width: 100%;
        }

        table td {
            border: 1px solid #ccc;
            color: gr
        }

        table .absorbing-column {
            width: 100%;
        }

    </style>
    {{-- <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
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
                    {{-- <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_1" role="tab">
                            <i class="flaticon-line-graph"></i> &nbsp; Charts
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                            <i class="flaticon2-checking"></i>Reports Table
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content  kt-margin-t-20">


                <!--Begin:: Tab  EGP FX Rate Table -->
                <?php
                    array_push($categories_names, 'Total');
                    array_push($categories_names, 'Sales_Channel_Sales_Percentages');
                ?>

                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                    <x-table :tableTitle="__($view_name.' Report')" :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                @if($view_name ==Customers_Against_Categories_Trend_Analysis 
                                || $view_name == Customers_Against_Products_Trend_Analysis
                                || $view_name == Customers_Against_Products_ITEMS_Trend_Analysis
                                
                                
                                )
                                <th class="text-center absorbing-column">{{ __('Customer Name') }}</th>

                                @else
                                <th class="text-center absorbing-column">{{ __('Categories') }}</th>

                                @endif 
                                @foreach ($dates as $date)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                @endforeach
                                <th>{{ __('Total') }}</th>
                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $id = 1; ?>
                             @php
                            sortReportForTotals($report_data)
                        @endphp   
                            @foreach ($report_data as $sales_channel_name => $sales_channel_channels_data)
                                <?php $chart_data = []; ?>

                                @if ($sales_channel_name != 'Total' && $sales_channel_name != 'Growth Rate %')
                                    <tr class="group-color">
                                        <td class="white-text" style="cursor: pointer;"
                                            onclick="toggleRow('{{ $id }}')">
                                            <i class="row_icon{{ $id }} flaticon2-up white-text"></i>
                                            <b>{{ __($sales_channel_name) }}</b>
                                        </td>
                                        <?php
                                        // {{-- Total --}}
                                        $total_per_sales_channel = $sales_channel_channels_data['Total'] ?? [];
                                        unset($sales_channel_channels_data['Total']);
                                        // {{-- Growth Rate % --}}
                                        $growth_rate_per_sales_channel = $sales_channel_channels_data['Growth Rate %'] ?? [];
                                        unset($sales_channel_channels_data['Growth Rate %']);
                                        ?>



                                        @foreach ($dates as $date)
                                            <td class="text-center white-text">
                                                {{ number_format($total_per_sales_channel[$date] ?? 0) .'  [ GR ' .number_format($growth_rate_per_sales_channel[$date] ?? 0) .' % ]' }}
                                            </td>
                                        @endforeach
                                        <td class="text-center white-text">
                                            {{ number_format(array_sum($total_per_sales_channel ?? []), 0) }}</td>
                                    </tr>





          @php

          sortSubItems($sales_channel_channels_data);

   

@endphp 
                                    @foreach ($sales_channel_channels_data as $channel_name => $channel_section)
                                        <tr class="row{{ $id }}  text-center" style="display: none">

                                            <td class="text-left"><b>{{ $channel_name }}</b></td>

                                            @foreach ($dates as $date)
                                                <td class="text-center">
                                                    {{ number_format($channel_section[$name_of_report_item][$date] ?? 0, 0) }}
                                                    <span class="active-text-color"><b>
                                                            {{ ' [ ' . number_format($channel_section['Growth Rate %'][$date] ?? 0, 1) . ' %  ]' }}</b></span>
                                                </td>
                                            @endforeach
                                            <td>{{ number_format(array_sum($channel_section[$name_of_report_item] ?? []), 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @elseif ($sales_channel_name == 'Total' || $sales_channel_name == 'Growth Rate %')
                                    <tr class="active-style text-center">
                                        <td class="active-style text-center"><b>{{ __($sales_channel_name) }}</b></td>

                                        <?php $decimals = $sales_channel_name == 'Growth Rate %' ? 2 : 0; ?>
                                        @foreach ($dates as $date)
                                            <td class="text-center active-style">
                                                {{ number_format($sales_channel_channels_data[$date] ?? 0, $decimals) . ($decimals == 0 ? '' : ' %') }}
                                            </td>
                                        @endforeach
                                        <td class="text-center active-style">
                                            {{ $sales_channel_name == 'Growth Rate %'? '-': number_format(array_sum($sales_channel_channels_data ?? []), 0) }}
                                        </td>
                                    </tr>
                                @endif
                                <?php $id++; ?>
                            @endforeach
                        @endslot
                    </x-table>
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
    </script>
    <script>
        function toggleRow(rowNum) {
            $(".row" + rowNum).toggle();
            $('.row_icon' + rowNum).toggleClass("flaticon2-down flaticon2-up");
        }
    </script>
    @foreach ($categories_names as $name_of_sales_channel)
        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance

                var chart = am4core.create("{{ $name_of_sales_channel }}_count_chartdiv", am4charts.XYChart);

                // Increase contrast by taking evey second color
                chart.colors.step = 2;

                // Add data
                chart.data = $('#{{ $name_of_sales_channel }}_data').data('total');
                if ("{{ $name_of_sales_channel }}" == 'Sales_Channel_Sales_Percentages') {
                    console.log($('#{{ $name_of_sales_channel }}_data').data('total'));
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
