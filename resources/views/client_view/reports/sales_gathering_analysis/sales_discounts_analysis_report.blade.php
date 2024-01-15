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

    @include('datatable_css')
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
                    array_push($zones_names, 'Total');
                    array_push($zones_names, 'Zone_Sales_Percentages');
                    ?>
                {{-- <div class="tab-pane " id="kt_apps_contacts_view_tab_1" role="tabpanel">
                    @foreach ($zones_names as $name_of_zone)

                        <div class="col-xl-12">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__body kt-portlet__body--fluid">
                                    <div class="kt-widget12">
                                        <div class="kt-widget12__chart">
                                            <!-- HTML -->
                                            <h4>{{ str_replace('_', ' ', $name_of_zone) . ($name_of_zone == 'Zone_Sales_Percentages' ? ' Against Total Sales' : ' Sales Trend Analysis Chart') }}
                                            </h4>
                                            <div id="{{ $name_of_zone }}_count_chartdiv" class="chartdashboard"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
                <!--End:: Tab  EGP FX Rate Table -->

                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                    <x-table :tableTitle="__($view_name.' Report')"
                        :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th class="text-center absorbing-column">{{ __($type_name) }}</th>
                                @foreach ($dates as $date)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                @endforeach
                                <th>{{ __('Total') }}</th>
                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $id =1 ;?>
                            @foreach ($report_data as $zone_name => $zone_channels_data)

                                <?php $chart_data = [];?>

                                @if ($zone_name != 'Total' && $zone_name != 'Discount % / Total Sales')
                                    <?php
                                    // $row_name = str_replace(' ', '_', $zone_name);
                                    // $row_name = str_replace(['&','(',')','{','}'], '_', $row_name);
                                    ?>

                                    <tr class="group-color">
                                        <td class="white-text"  style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                                            <i class="row_icon{{ $id }} flaticon2-up white-text"></i>
                                            <b>{{ __($zone_name) }}</b>
                                        </td>
                                        {{-- Total --}}
                                        <?php $total_per_zone = $zone_channels_data['Total'] ?? [];
                                        unset($zone_channels_data['Total']); ?>
                                        {{-- Perc.% / Sales --}}


                                        @foreach ($dates as $date)
                                        <?php $growth_rate_per_zone = ($report_data['Total'][$date]??0) == 0 ? 0 :(($total_per_zone[$date] ?? 0) /( ($report_data['Total'][$date]??0))*100); ?>

                                            <td class="text-center white-text">{{ number_format($total_per_zone[$date] ?? 0) . '  [ Dist '.number_format($growth_rate_per_zone ,1) . ' % ]'}}
                                            </td>
                                        @endforeach
                                        <td class="text-center white-text">{{number_format(array_sum($total_per_zone??[]),0)}}</td>
                                    </tr>
                                    @foreach ($zone_channels_data as $channel_name => $channel_section)

                                        @foreach ($channel_section as $section => $channel_data)
                                            <tr class="row{{ $id }} {{ ($section == 'Perc.% / Sales') ? 'secondary-row-color' : '' }} text-center"
                                                style="display: none">
                                                {{-- <td></td> --}}
                                                <?php $name_ofdiscount = ucwords(str_replace('_',' ' ,$channel_name)) ?>
                                                <td class="text-left"><b>{{ $name_ofdiscount . ' ' . $section }}</b></td>
                                                <?php
                                                    $decimals = ($section == 'Perc.% / Sales') ? 2 : 0;

                                                ?>
                                                @foreach ($dates as $date)
                                                    <?php
                                                        $result = ($section == 'Perc.% / Sales') ?(($channel_data[$date] ?? 0)*100) : ($channel_data[$date] ?? 0);
                                                    ?>
                                                    <td class="text-center">
                                                        {{ number_format($result, $decimals) . ($decimals == 0 ? '' : ' %') }}
                                                    </td>
                                                    @endforeach
                                                <td>{{($section == 'Perc.% / Sales') ? '-' : number_format(array_sum($channel_data??[]),0)}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach




















                                @elseif ($zone_name == 'Total' || $zone_name == 'Discount % / Total Sales')
                                    <tr class="active-style text-center">
                                        <td class="active-style text-center" ><b>{{ __($zone_name) }}</b></td>
                                       

                                        <?php
                                            $decimals =  $zone_name == 'Discount % / Total Sales'  ? 1 : 0;

                                        ?>
                                        @foreach ($dates as $date)
                                            <?php
                                                $result = $zone_name == 'Discount % / Total Sales' ?(($zone_channels_data[$date] ?? 0)*100) : ($zone_channels_data[$date] ?? 0);
                                            ?>
                                            <td class="text-center active-style">
                                                {{ number_format($result,$decimals)  . ($decimals == 0 ? '' : ' %')}}</td>
                                        @endforeach
                                        <td class="text-center active-style">{{$zone_name == 'Growth Rate %' ? "-" : number_format(array_sum($zone_channels_data  ?? []),0)}}</td>
                                    </tr>
                                @endif
                                <?php $id++;?>
                            @endforeach


                        @endslot
                    </x-table>

                    {{-- <x-table :tableTitle="__('Zone Sales Percentage (%) Against Total Sales')"
                        :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active">
                                <th>{{ __('Zone') }}</th>


                                @foreach ($total_zones as $date => $total)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                @endforeach
                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $chart_data = []; ?>
                            @foreach ($final_report_data as $zone_name => $zone_data)
                                <tr class="group-color text-lg-left  ">
                                    <td colspan="{{ count($total_zones) + 1 }}"><b
                                            class="white-text">{{ __($zone_name) }}</b></td>
                                    @foreach ($total_zones as $date => $total)
                                        <td class="hidden"> </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>{{ __('Percent %') }}</th>
                                    @foreach ($total_zones as $date => $total)
                                        <?php
                                        $percentage = $total == 0 ? 0 : number_format(($zone_data['Sales Values'][$date] ?? 0) / ($total ?? 0), 2);
                                        $chart_data[$date][$zone_name] = [$zone_name . ' %' => $percentage];
                                        ?>

                                        <td class="text-center">
                                            {{ $percentage . ' %' }}
                                        </td>
                                    @endforeach
                                </tr>

                            @endforeach
                            <?php
                            $return = [];
                            array_walk($chart_data, function ($values, $date) use (&$return) {
                                $return[] = array_merge(['date' => date('d-M-Y', strtotime($date))], array_merge(...array_values($values)));
                            });
                            ?>
                            <input type="hidden" id="Zone_Sales_Percentages_data" data-total="{{ json_encode($return) }}">


                        @endslot
                    </x-table> --}}
                </div>
                <!--End:: Tab USD FX Rate Table -->
            </div>
        </div>
    </div>

@endsection

@section('js')

@include('js_datatable')
    <!-- Resources -->
    {{-- <script src="https://cdn.amcharts.com/lib/4/core.js"></script> --}}
    {{-- <script src="https://cdn.amcharts.com/lib/4/charts.js"></script> --}}
    {{-- <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script> --}}
    {{-- <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> --}}
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script>
        function toggleRow(rowNum) {
            $(".row" + rowNum).toggle();
            $('.row_icon' + rowNum).toggleClass("flaticon2-down flaticon2-up");
        }
    </script>
    @foreach ($zones_names as $name_of_zone)
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
                if ("{{ $name_of_zone }}" == 'Zone_Sales_Percentages') {
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
