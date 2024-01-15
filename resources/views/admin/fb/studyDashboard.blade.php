@extends('layouts.dashboard')

@section('css')
<x-styles.commons></x-styles.commons>

<style>
    .kt-iconbox--brand.kt-iconbox--animate,
    .kt-iconbox--brand.kt-iconbox--animate-slow,
    .kt-iconbox--brand.kt-iconbox--animate-slower,
    .kt-iconbox--brand.kt-iconbox--animate-fast,
    .kt-iconbox--brand.kt-iconbox--animate-faster {
        background-color: #CCE2FD !important;
    }

    .fs-15px {
        font-size: 15px !important;
    }

    .table-right-border {
        border-right: 5px solid #747DDE !important;
    }

    .pt-25 {
        padding-top: 25px !important;
    }


    .sub-item-row,
    table.dataTable tbody tr.second-tr-bg>.dtfc-fixed-left,
    table.dataTable tbody tr.second-tr-bg.sub-item-row>.dtfc-fixed-right {}

    .bg-last-row,
    .bg-last-row td,
    .bg-last-row th {
        background-color: #F2F2F2 !important;
        color: black !important;
        border: 1px solid white !important;
    }

    .first-tr,
    .first-tr td,
    .first-tr th {
        background-color: #9FC9FB !important;
    }

    .sub-item-row,
    table.dataTable tbody tr.second-tr-bg>.dtfc-fixed-left,
    table.dataTable tbody tr.second-tr-bg.sub-item-row>.dtfc-fixed-right {
        background-color: white !important;
        color: black !important;
    }

    .sub-item-row td {
        background-color: #E2EFFE !important;
        color: black !important;
        border: 1px solid white !important;
    }

    .main-row-tr {
        background-color: white !important
    }

    .main-row-tr td {
        border: 1px solid #CCE2FD !important;

    }

    .first-tr-bg,
    .first-tr-bg td,
    .first-tr-bg th {
        background-color: #074FA4 !important;
        color: white !important;
    }

    .second-tr-bg,
    .second-tr-bg td,
    .second-tr-bg th {
        background-color: white !important;
        color: black !important;
        padding: 3px !important;
        border: none !important;
    }

    .second-tr-bg.second-tr-bg-more-padding,
    .second-tr-bg.second-tr-bg-more-padding td,
    .second-tr-bg.second-tr-bg-more-padding th {
        padding: 7px !important;

    }

    td:not(:first-of-type):hover,
    th:not(:first-of-type):hover {
        background-color: #074FA4 !important;
        color: white !important;
    }



    body .table-active,
    .table-active>th,
    .table-active>td {
        background-color: white !important
    }

    #DataTables_Table_0_filter {
        float: left !important;
    }

    div.dt-buttons {
        float: right !important;
    }

    body table.dataTable tbody tr.group-color>.dtfc-fixed-left,
    table.dataTable tbody tr.group-color>.dtfc-fixed-right {
        background-color: white !important;
    }

    .text-capitalize {
        text-transform: capitalize;
    }

    .placeholder-light-gray::placeholder {
        color: lightgrey;
    }

    .kt-header-menu-wrapper {
        margin-left: 0 !important;
    }

    .kt-header-menu-wrapper .kt-header-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link {
        padding: 0.60rem 1.25rem !important;
    }

    .max-w-22 {
        max-width: 22%;
    }

    .form-label {
        white-space: nowrap !important;
    }

    .visibility-hidden {
        visibility: hidden !important;
    }

    input.form-control[readonly] {
        background-color: #F7F8FA !important;
        font-weight: bold !important;

    }

    .three-dots-parent {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 0 !important;
        margin-top: 10px;

    }

    .blue-select {
        border-color: #7096f6 !important;
    }

    .div-for-percentage {
        flex-wrap: nowrap !important;
    }

    b {
        white-space: nowrap;
    }

    i.target_last_value {
        margin-left: -60px;
    }

    .total-tr {
        background-color: #074FA4 !important
    }

    .table-striped th,
    .table-striped2 th {
        background-color: #074FA4 !important
    }

    .total-tr td {
        color: white !important;
    }

    .total-tr .three-dots-parent {
        margin-top: 0 !important;
    }

</style>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css" />

<style>
    table.dataTable thead tr>.dtfc-fixed-left,
    table.dataTable thead tr>.dtfc-fixed-right {
        background-color: #086691;
    }

    .dataTables_wrapper .dataTable th,
    .dataTables_wrapper .dataTable td {
        font-weight: bold;
        color: black;
    }

    table.dataTable tbody tr.group-color>.dtfc-fixed-left,
    table.dataTable tbody tr.group-color>.dtfc-fixed-right {
        background-color: white !important;
    }


    .dataTables_wrapper .dataTable th,
    .dataTables_wrapper .dataTable td {
        color: black;
        font-weight: bold;
    }

    thead * {
        text-align: center !important;
    }

</style>

@endsection
@section('dash_nav')


@endsection
@section('sub-header')

<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Study Dashboard') .' - '. $hospitalitySector->getStudyName() . ' - ' . $hospitalitySector->getPropertyName() }}</x-main-form-title>
<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>


@endsection
@section('content')



@php
$earningBeforeTaxes = 0 ;
$totalOfDepreactionAndAmortization = 0;


@endphp

{{-- <div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title head-title text-primary">
                {{ __('Dashboard Results') }}
</h3>
</div>
</div>
<div class="kt-portlet__body">
    <form action="#" method="POST">
        @csrf
        <div class="form-group row">

            <div class="col-md-3">
                <label>{{ __('Start Date') }}</label>
                <div class="kt-input-icon">
                    <div class="input-group date">
                        <input type="date" id="start_date_input_id" name="start_date" required value="" max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <label>{{ __('End Date') }}</label>
                <div class="kt-input-icon">
                    <div class="input-group date">
                        <input type="date" id="end_date_input_id" name="end_date" required value="" class="form-control" placeholder="Select date" />
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
</div> --}}
{{-- Title --}}
<form action="{{ route('admin.view.hospitality.sector.study.dashboard',[$company_id,$hospitality_sector_id]) }}" type="get">
    <div class="row">
        <input type="hidden" id="hotel_revenue_chart_data" data-total="{{ json_encode($revenueStreamChart ?? []) }}">
        <input type="hidden" id="hotel-revenue-breakdown-data" data-total="{{ json_encode($hotelRevenuesBreakdownChart ?? []) }}">
        <input type="hidden" id="hotel-revenue-accumulated-chart-data" data-total="{{ json_encode($revenueStreamAccumulatedData ?? []) }}">
        <input type="hidden" id="adr-chart-data" data-total="{{ json_encode($adrChart ?? []) }}">
        <input type="hidden" id="revpar-chart-data" data-total="{{ json_encode($revparChart ?? []) }}">
        <input type="hidden" id="occupancy-chart-data" data-total="{{ json_encode($occupancyChart ?? []) }}">
        <input type="hidden" id="gross-profit-chart-data" data-total="{{ json_encode($grossProfitDepartmentChart ?? []) }}">
        <input type="hidden" id="gross-profit-accumulated-chart-data" data-total="{{ json_encode($grossAccumulatedProfitDepartmentAccumulatedChart ?? []) }}">
        <input type="hidden" id="ebitda-chart-data" data-total="{{ json_encode($ebitdaChart ?? []) }}">
        <input type="hidden" id="ebit-chart-data" data-total="{{ json_encode($ebitChart ?? []) }}">
        <input type="hidden" id="ebt-chart-data" data-total="{{ json_encode($ebtChart ?? []) }}">
        <input type="hidden" id="net-profit-chart-data" data-total="{{ json_encode($netProfitChart ?? []) }}">

        <div class="kt-portlet w-100">
            <div class="kt-portlet__body pt-25">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center ">
                            <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Choose Revenue Stream') }} </h3>

                            <select class="form-control text-dark font-weight-bold fs-15px" name="revenue_stream_type" style="max-width:50%;">
                                <option value="Total Hotel Revenues" @if($revenueStreamType=='Total Hotel Revenues' ) selected @endif> {{ __('Total Hotel Revenue') }}</optionc>
                                <option value="Total Hotel Revenues.subItems.Total Rooms Revenue" @if($revenueStreamType=='Total Hotel Revenues.subItems.Total Rooms Revenue' ) selected @endif>{{ __('Accommodation & Rooms Revenue Stream') }}</optionc>
                                <option value="Total Hotel Revenues.subItems.Total F&B Revenues" @if($revenueStreamType=='Total Hotel Revenues.subItems.Total F&B Revenues' ) selected @endif>{{ __('Food & Beverage (F&B) Revenue Stream') }}</optionc>
                                <option value="Total Hotel Revenues.subItems.Total Gaming Revenues" @if($revenueStreamType=='Total Hotel Revenues.subItems.Total Gaming Revenues' ) selected @endif>{{ __('Gaming Revenue Stream') }}</optionc>
                                <option value="Total Hotel Revenues.subItems.Total Meeting Spaces Revenues" @if($revenueStreamType=='Total Hotel Revenues.subItems.Total Meeting Spaces Revenues' ) selected @endif>{{ __('Gathering & Meeting Space Revenue Stream') }}</optionc>
                                <option value="Total Hotel Revenues.subItems.Total Other Revenues" @if($revenueStreamType=='Total Hotel Revenues.subItems.Total Other Revenues' ) selected @endif>{{ __('Other Facilities Revenue Stream') }}</optionc>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn active-style refresh-charts " data-chart-name="revenue-stream">{{ __('Go') }}</button>
                    </div>
                </div>
                <div class="row">
                    <hr style="flex:1;background-color:lightgray">
                </div>
                <div class="row">

                    <div class="form-group row" style="flex:1;">
                        <div class="col-md-12 mt-3">
                            <div class="row">

                                <div class="col-md-6 table-right-border">

                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('Annual Sales Revenues') }} </h3>
                                        <div id="hotel_revenue_chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="kt-widget12__chart">
                                        <!-- HTML -->
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('Accumulated Sales Revenues') }} </h3>
                                        <div id="accumulated_chartdiv" class="chartdashboard"></div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>

        <div class="kt-portlet w-100">
            <div class="kt-portlet__body pt-25">

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex align-items-center ">
                            <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Hotel Department Revenues Breakdown (Figs\'000\')') }} </h3>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <hr style="flex:1;background-color:lightgray">
                </div>


                <div class="row">

                    <div class="form-group row" style="flex:1;">
                        <div class="col-md-12 mt-3">
                            <div class="row">


                                <div class="col-md-12">
                                    <div class="kt-widget12__chart">
                                        <!-- HTML -->
                                        <div id="chartdiv__test" class="chartdashboard"></div>
                                        {{-- <div id="hotel-revenues-breakdown" class="chartdashboard"></div> --}}
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>



        <div class="kt-portlet w-100">
            <div class="kt-portlet__body pt-25">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center ">
                            <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Average Daily Rate [ADR], Revenue Per Room [RevPAR] & Annual Occupancy Rate') }} </h3>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <hr style="flex:1;background-color:lightgray">
                </div>
                <div class="row">

                    <div class="form-group row" style="flex:1;">
                        <div class="col-md-12 mt-3">
                            <div class="row">

                                <div class="col-md-6 table-right-border">

                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('ADR') }} </h3>
                                        <div id="adr-chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('RevPAR') }} </h3>
                                        <div id="revpar-chart" class="chartdashboard"></div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="kt-widget12__chart">
                                        <!-- HTML -->
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('Annual Occupancy Rate') }} </h3>
                                        <div id="occupancy-chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>



        <div class="kt-portlet w-100">
            <div class="kt-portlet__body pt-25">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center ">
                            <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Gross Profit') }} </h3>

                            <select class="form-control text-dark font-weight-bold fs-15px" name="gross_profit_type" style="max-width:50%;">
                                <option value="Departments Gross Profit" @if($grossProfitDepartmentType=='Departments Gross Profit' ) selected @endif> {{ __('Total Hotel Gross Profit ') }}</optionc>
                                <option value="Departments Gross Profit.subItems.Rooms Gross Profit" @if($grossProfitDepartmentType=='Departments Gross Profit.subItems.Rooms Gross Profit' ) selected @endif>{{ __('Accommodation & Rooms Gross Profit') }}</optionc>
                                <option value="Departments Gross Profit.subItems.F&B Gross Profit" @if($grossProfitDepartmentType=='Departments Gross Profit.subItems.F&B Gross Profit' ) selected @endif>{{ __('Food & Beverage (F&B) Gross Profit') }}</optionc>
                                <option value="Departments Gross Profit.subItems.Gaming Gross Profit" @if($grossProfitDepartmentType=='Departments Gross Profit.subItems.Gaming Gross Profit' ) selected @endif>{{ __('Gaming Gross Profit') }}</optionc>
                                <option value="Departments Gross Profit.subItems.Meeting Spaces Gross Profit" @if($grossProfitDepartmentType=='Departments Gross Profit.subItems.Meeting Spaces Gross Profit' ) selected @endif>{{ __('Gathering & Meeting Space Gross Profit') }}</optionc>
                                <option value="Departments Gross Profit.subItems.Other Revenues Gross Profit" @if($grossProfitDepartmentType=='Departments Gross Profit.subItems.Other Revenues Gross Profit' ) selected @endif>{{ __('Other Facilities Gross Profit') }}</optionc>
                            </select>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn active-style refresh-charts " data-chart-name="gross-profit">{{ __('Go') }}</button>
                    </div>
                </div>
                <div class="row">
                    <hr style="flex:1;background-color:lightgray">
                </div>
                <div class="row">

                    <div class="form-group row" style="flex:1;">
                        <div class="col-md-12 mt-3">
                            <div class="row">

                                <div class="col-md-6 table-right-border">

                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('Annual Gross Profit') }} </h3>
                                        <div id="gross-profit-chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="kt-widget12__chart">
                                        <!-- HTML -->
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('Accumulated Gross Profit') }} </h3>
                                        <div id="gross-profit-accumulated-chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>


        <div class="kt-portlet w-100">
            <div class="kt-portlet__body pt-25">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center ">
                            <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Profitability Results') }} </h3>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <hr style="flex:1;background-color:lightgray">
                </div>
                <div class="row">

                    <div class="form-group row" style="flex:1;">
                        <div class="col-md-12 mt-3">
                            <div class="row">

                                <div class="col-md-6 table-right-border">

                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('EBITDA') }} </h3>
                                        <div id="ebitda-chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('EBIT') }} </h3>
                                        <div id="ebit-chart" class="chartdashboard"></div>
                                    </div>
                                </div>


                                <div class="col-md-6 table-right-border">

                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('EBT') }} </h3>
                                        <div id="ebt-chart" class="chartdashboard"></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="kt-widget12__chart">
                                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps " style=""> {{ __('Net Profit') }} </h3>
                                        <div id="net-profit-chart" class="chartdashboard"></div>
                                    </div>
                                </div>





                            </div>



                        </div>

                    </div>


                </div>

            </div>
        </div>



        <div class="kt-portlet w-100">
            <div class="kt-portlet__body pt-25">
                <div class="row">
                    <div class="col-md-7">
                        <div class="d-flex align-items-center ">
                            <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Investment Feasibility Results') }} </h3>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <hr style="flex:1;background-color:lightgray">
                </div>
                <div class="row">

                    <div class="form-group row" style="flex:1;">
                        <div class="col-md-12 mt-3">
                            <div class="row">

                                @foreach($cardItems as $cardItem)
                                <div class="col-md-4">
                                    <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                        <div class="kt-portlet__body">
                                            <div class="kt-iconbox__body">
                                                <div class="kt-iconbox__desc">
                                                    <h3 class="kt-iconbox__title">
                                                        <a class="kt-link" href="#">{{ $cardItem['title'] }}</a>
                                                    </h3>
                                                    <div class="kt-iconbox__content text-primary  ">
                                                        <h4>
                                                            {{ $cardItem['value'] }}
                                                        </h4>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach




                            </div>


                        </div>

                    </div>


                </div>

            </div>
        </div>


    </div>
</form>

@endsection
@section('js')
<x-js.commons></x-js.commons>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
</script>

<script>
    var hotelRevenueChart = null;
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance

        hotelRevenueChart = am4core.create("hotel_revenue_chart", am4charts.XYChart);

        // Increase contrast by taking evey second color
        hotelRevenueChart.colors.step = 2;

        // Add data
        var chartData = $('#hotel_revenue_chart_data').data('total')
        chartData.forEach(function(objVal) {
            initialDate = getDateFormatted(new Date(objVal.date));
            if (initialDate.split('-').length == 4) {
                year = initialDate.split('-')[1];
                month = initialDate.split('-')[2]
                date = initialDate.split('-')[3];
            } else {
                year = initialDate.split('-')[0];
                month = initialDate.split('-')[1]
                date = initialDate.split('-')[2];
            }
            objVal.date = parseInt(year) + '-' + month + '-' + date;


        });

        hotelRevenueChart.data = chartData;
        hotelRevenueChart.numberFormatter.numberFormat = "#,###.";
        hotelRevenueChart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
        // Create axes
        var dateAxis = hotelRevenueChart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 50;

        // Create series
        function createAxisAndSeries(field, name, opposite, bullet) {
            var valueAxis = hotelRevenueChart.yAxes.push(new am4charts.ValueAxis());
            if (hotelRevenueChart.yAxes.indexOf(valueAxis) != 0) {
                valueAxis.syncWithAxis = hotelRevenueChart.yAxes.getIndex(0);
            }

            var series = hotelRevenueChart.series.push(new am4charts.LineSeries());
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
        $.each(hotelRevenueChart.data[0], function(key, val) {
            if (key != 'date') {
                createAxisAndSeries(key, key, true, "circle");
            }
        });



        // Add legend
        hotelRevenueChart.legend = new am4charts.Legend();

        // Add cursor
        hotelRevenueChart.cursor = new am4charts.XYCursor();


    }); // end am4core.ready()

</script>



@foreach(['ebitda-chart'=>'ebitda-chart-data','ebit-chart'=>'ebit-chart-data','ebt-chart'=>'ebt-chart-data','net-profit-chart'=>'net-profit-chart-data'] as $chartName=>$chartData)
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance

        var chart = am4core.create("{{ $chartName }}", am4charts.XYChart);

        // Increase contrast by taking evey second color
        chart.colors.step = 2;

        // Add data
        var chartData = $('#' + "{{ $chartData }}").data('total')
        chartData.forEach(function(objVal) {
            initialDate = getDateFormatted(new Date(objVal.date));
            if (initialDate.split('-').length == 4) {
                year = initialDate.split('-')[1];
                month = initialDate.split('-')[2]
                date = initialDate.split('-')[3];
            } else {
                year = initialDate.split('-')[0];
                month = initialDate.split('-')[1]
                date = initialDate.split('-')[2];
            }
            objVal.date = parseInt(year) + '-' + month + '-' + date;


        });

        chart.data = chartData;
        chart.numberFormatter.numberFormat = "#,###.";
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
<script>
    var grossProfitChart = null;
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance

        grossProfitChart = am4core.create("gross-profit-chart", am4charts.XYChart);

        // Increase contrast by taking evey second color
        grossProfitChart.colors.step = 2;

        // Add data
        var chartData = $('#gross-profit-chart-data').data('total')
        chartData.forEach(function(objVal) {
            initialDate = getDateFormatted(new Date(objVal.date));
            if (initialDate.split('-').length == 4) {
                year = initialDate.split('-')[1];
                month = initialDate.split('-')[2]
                date = initialDate.split('-')[3];
            } else {
                year = initialDate.split('-')[0];
                month = initialDate.split('-')[1]
                date = initialDate.split('-')[2];
            }
            objVal.date = parseInt(year) + '-' + month + '-' + date;


        });

        grossProfitChart.data = chartData;
        grossProfitChart.numberFormatter.numberFormat = "#,###.";
        grossProfitChart.dateFormatter.inputDateFormat = "yyyy-MM-dd";
        // Create axes
        var dateAxis = grossProfitChart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 50;

        // Create series
        function createAxisAndSeries(field, name, opposite, bullet) {
            var valueAxis = grossProfitChart.yAxes.push(new am4charts.ValueAxis());
            if (grossProfitChart.yAxes.indexOf(valueAxis) != 0) {
                valueAxis.syncWithAxis = grossProfitChart.yAxes.getIndex(0);
            }

            var series = grossProfitChart.series.push(new am4charts.LineSeries());
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
        $.each(grossProfitChart.data[0], function(key, val) {
            if (key != 'date') {
                createAxisAndSeries(key, key, true, "circle");
            }

        });
        // Add legend
        grossProfitChart.legend = new am4charts.Legend();

        // Add cursor
        grossProfitChart.cursor = new am4charts.XYCursor();


    }); // end am4core.ready()

</script>




<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance

        var chart = am4core.create("adr-chart", am4charts.XYChart);

        // Increase contrast by taking evey second color
        chart.colors.step = 2;

        // Add data
        var chartData = $('#adr-chart-data').data('total')


        chart.data = chartData;
        chart.numberFormatter.numberFormat = "#,###.";
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

        var chart = am4core.create("revpar-chart", am4charts.XYChart);

        // Increase contrast by taking evey second color
        chart.colors.step = 2;

        // Add data
        var chartData = $('#revpar-chart-data').data('total')


        chart.data = chartData;
        chart.numberFormatter.numberFormat = "#,###.";
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

        var chart = am4core.create("occupancy-chart", am4charts.XYChart);

        // Increase contrast by taking evey second color
        chart.colors.step = 2;

        // Add data
        var chartData = $('#occupancy-chart-data').data('total')


        chart.data = chartData;
        chart.numberFormatter.numberFormat = "#,###.%";
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
    var accumulatedChart = null;
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        accumulatedChart = am4core.create("accumulated_chartdiv", am4charts.XYChart);

        // Add data



        chartData = $('#hotel-revenue-accumulated-chart-data').data('total');
        chartData.forEach(function(objVal) {
            initialDate = getDateFormatted(new Date(objVal.date));
            if (initialDate.split('-').length == 4) {
                year = initialDate.split('-')[1];
                month = initialDate.split('-')[2]
                date = initialDate.split('-')[3];
            } else {
                year = initialDate.split('-')[0];
                month = initialDate.split('-')[1]
                date = initialDate.split('-')[2];
            }
            objVal.date = parseInt(year) + '-' + month + '-' + date;


        });
        accumulatedChart.data = chartData;
        accumulatedChart.numberFormatter.numberFormat = "#,###.";
        // Set input format for the dates
        accumulatedChart.dateFormatter.inputDateFormat = "yyyy-MM-dd";


        // Create axes
        var dateAxis = accumulatedChart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = accumulatedChart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = accumulatedChart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "Value";
        series.dataFields.dateX = "date";
        series.tooltipText = "{Value}"
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
        accumulatedChart.cursor = new am4charts.XYCursor();
        accumulatedChart.cursor.behavior = "panXY";
        accumulatedChart.cursor.xAxis = dateAxis;
        accumulatedChart.cursor.snapToSeries = series;
        valueAxis.cursorTooltipEnabled = false;

        // Create vertical scrollbar and place it before the value axis
        accumulatedChart.scrollbarY = new am4core.Scrollbar();
        accumulatedChart.scrollbarY.parent = accumulatedChart.leftAxesContainer;
        accumulatedChart.scrollbarY.toBack();

        // Create a horizontal scrollbar with previe and place it underneath the date axis
        accumulatedChart.scrollbarX = new am4charts.XYChartScrollbar();
        accumulatedChart.scrollbarX.series.push(series);
        accumulatedChart.scrollbarX.parent = accumulatedChart.bottomAxesContainer;

        dateAxis.start = 0.0005;
        dateAxis.keepSelection = true;


    });

</script>




<script>
    var accumulatedGrossProfitChart = null;
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        accumulatedGrossProfitChart = am4core.create("gross-profit-accumulated-chart", am4charts.XYChart);

        // Add data



        chartData = $('#gross-profit-accumulated-chart-data').data('total');
        chartData.forEach(function(objVal) {
            initialDate = getDateFormatted(new Date(objVal.date));
            if (initialDate.split('-').length == 4) {
                year = initialDate.split('-')[1];
                month = initialDate.split('-')[2]
                date = initialDate.split('-')[3];
            } else {
                year = initialDate.split('-')[0];
                month = initialDate.split('-')[1]
                date = initialDate.split('-')[2];
            }
            objVal.date = parseInt(year) + '-' + month + '-' + date;


        });

        accumulatedGrossProfitChart.data = chartData;
        accumulatedGrossProfitChart.numberFormatter.numberFormat = "#,###.";
        // Set input format for the dates
        accumulatedGrossProfitChart.dateFormatter.inputDateFormat = "yyyy-MM-dd";


        // Create axes
        var dateAxis = accumulatedGrossProfitChart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = accumulatedGrossProfitChart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = accumulatedGrossProfitChart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "Value";
        series.dataFields.dateX = "date";
        series.tooltipText = "{Value}"
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
        accumulatedGrossProfitChart.cursor = new am4charts.XYCursor();
        accumulatedGrossProfitChart.cursor.behavior = "panXY";
        accumulatedGrossProfitChart.cursor.xAxis = dateAxis;
        accumulatedGrossProfitChart.cursor.snapToSeries = series;
        valueAxis.cursorTooltipEnabled = false;

        // Create vertical scrollbar and place it before the value axis
        accumulatedGrossProfitChart.scrollbarY = new am4core.Scrollbar();
        accumulatedGrossProfitChart.scrollbarY.parent = accumulatedGrossProfitChart.leftAxesContainer;
        accumulatedGrossProfitChart.scrollbarY.toBack();

        // Create a horizontal scrollbar with previe and place it underneath the date axis
        accumulatedGrossProfitChart.scrollbarX = new am4charts.XYChartScrollbar();
        accumulatedGrossProfitChart.scrollbarX.series.push(series);
        accumulatedGrossProfitChart.scrollbarX.parent = accumulatedGrossProfitChart.bottomAxesContainer;

        dateAxis.start = 0.0005;
        dateAxis.keepSelection = true;


    });

</script>


<script>
    var AccumulatedRevenuechart = null;
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        AccumulatedRevenuechart = am4core.create("accumulated_chartdiv", am4charts.XYChart);

        // Add data



        chartData = $('#hotel-revenue-accumulated-chart-data').data('total');
        chartData.forEach(function(objVal) {
            initialDate = getDateFormatted(new Date(objVal.date));
            if (initialDate.split('-').length == 4) {
                year = initialDate.split('-')[1];
                month = initialDate.split('-')[2]
                date = initialDate.split('-')[3];
            } else {
                year = initialDate.split('-')[0];
                month = initialDate.split('-')[1]
                date = initialDate.split('-')[2];
            }
            objVal.date = parseInt(year) + '-' + month + '-' + date;


        });

        AccumulatedRevenuechart.data = chartData;
        AccumulatedRevenuechart.numberFormatter.numberFormat = "#,###.";
        // Set input format for the dates
        AccumulatedRevenuechart.dateFormatter.inputDateFormat = "yyyy-MM-dd";


        // Create axes
        var dateAxis = AccumulatedRevenuechart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = AccumulatedRevenuechart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = AccumulatedRevenuechart.series.push(new am4charts.LineSeries());
        series.dataFields.valueY = "Value";
        series.dataFields.dateX = "date";
        series.tooltipText = "{Value}"
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
        AccumulatedRevenuechart.cursor = new am4charts.XYCursor();
        AccumulatedRevenuechart.cursor.behavior = "panXY";
        AccumulatedRevenuechart.cursor.xAxis = dateAxis;
        AccumulatedRevenuechart.cursor.snapToSeries = series;
        valueAxis.cursorTooltipEnabled = false;

        // Create vertical scrollbar and place it before the value axis
        AccumulatedRevenuechart.scrollbarY = new am4core.Scrollbar();
        AccumulatedRevenuechart.scrollbarY.parent = AccumulatedRevenuechart.leftAxesContainer;
        AccumulatedRevenuechart.scrollbarY.toBack();

        // Create a horizontal scrollbar with previe and place it underneath the date axis
        AccumulatedRevenuechart.scrollbarX = new am4charts.XYChartScrollbar();
        AccumulatedRevenuechart.scrollbarX.series.push(series);
        AccumulatedRevenuechart.scrollbarX.parent = AccumulatedRevenuechart.bottomAxesContainer;

        dateAxis.start = 0.0005;
        dateAxis.keepSelection = true;


    }); // end am4core.ready()



    function getDateFormatted(yourDate) {
        const offset = yourDate.getTimezoneOffset()
        yourDate = new Date(yourDate.getTime() - (offset * 60 * 1000))
        return yourDate.toISOString().split('T')[0]
    }

</script>




<script>


</script>



<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<!-- Chart code -->
<script>
    am5.ready(function() {

        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("chartdiv__test");
        root.numberFormatter.set("numberFormat", "#,###.");

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);


        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false
            , panY: false
            , wheelX: "panX"
            , wheelY: ""
            , layout: root.verticalLayout
        }));

        // Add scrollbar
        // https://www.amcharts.com/docs/v5/charts/xy-chart/scrollbars/
        chart.set("scrollbarX", am5.Scrollbar.new(root, {
            orientation: "horizontal"
        }));
        var chartData = $('#hotel-revenue-breakdown-data').data('total')
        var data = chartData;





        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {});
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "year"
            , renderer: xRenderer
            , tooltip: am5.Tooltip.new(root, {})
        }));

        xRenderer.grid.template.setAll({
            location: 1
        })

        xAxis.data.setAll(data);

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            min: 0
            , renderer: am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })
        }));


        // Add legend
        // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
        var legend = chart.children.push(am5.Legend.new(root, {
            centerX: am5.p50
            , x: am5.p50
        }));


        // Add series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        function makeSeries(name, fieldName) {
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: name
                , stacked: true
                , xAxis: xAxis
                , yAxis: yAxis
                , valueYField: fieldName
                , categoryXField: "year"
            }));

            series.columns.template.setAll({
                tooltipText: "{name}, {categoryX}: {valueY}"
                , tooltipY: am5.percent(10)
            });
            series.data.setAll(data);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear();

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Label.new(root, {
                        text: "{valueY}"
                        , fill: root.interfaceColors.get("alternativeText")
                        , centerY: am5.p50
                        , centerX: am5.p50
                        , populateText: true
                    })
                });
            });

            legend.data.push(series);
        }

        makeSeries("Rooms", "value1");
        makeSeries("F&B", "value2");
        makeSeries("Gaming", "value3");
        makeSeries("Meeting Spaces", "value4");
        makeSeries("Other Revenues", "value5");


        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        chart.appear(1000, 100);

    }); // end am5.ready()

    $(document).on('click', '.refresh-charts', function(e) {
        e.preventDefault();
        const revenue_stream_type = $(this).attr('data-chart-name').trim();

        const revenueStreamType = $('select[name="revenue_stream_type"]').val();
        const grossProfitType = $('select[name="gross_profit_type"]').val();


        let data = {}
        $.ajax({
            url: "{{ route('admin.view.hospitality.sector.study.dashboard',['company'=>$company->id,'hospitality_sector_id'=>$hospitality_sector_id]) }}"
            , data: {
                "revenue_stream_type": revenueStreamType
                , "gross_profit_type": grossProfitType
                , 'is_ajax': 1
                , 'chart_name': revenue_stream_type

            }
            , success: function(res) {




                if (revenue_stream_type == 'revenue-stream') {
                    var chartData = res.chart_data;
                    chartData.forEach(function(objVal) {

                        initialDate = getDateFormatted(new Date(objVal.date));
                        if (initialDate.split('-').length == 4) {
                            year = initialDate.split('-')[1];
                            month = initialDate.split('-')[2]
                            date = initialDate.split('-')[3];
                        } else {
                            year = initialDate.split('-')[0];
                            month = initialDate.split('-')[1]
                            date = initialDate.split('-')[2];
                        }
                        objVal.date = parseInt(year) + '-' + month + '-' + date;
                        hotelRevenueChart.data = chartData;
                        console.log('first chart data', chartData);
                    });

                    var chartData = res.accumulated_revenue_chart_data;
                    chartData.forEach(function(objVal) {

                        initialDate = getDateFormatted(new Date(objVal.date));
                        if (initialDate.split('-').length == 4) {
                            year = initialDate.split('-')[1];
                            month = initialDate.split('-')[2]
                            date = initialDate.split('-')[3];
                        } else {
                            year = initialDate.split('-')[0];
                            month = initialDate.split('-')[1]
                            date = initialDate.split('-')[2];
                        }
                        objVal.date = parseInt(year) + '-' + month + '-' + date;


                    });
                    console.log('second cgart data', chartData);
                    AccumulatedRevenuechart.data = chartData;
                }


                if (revenue_stream_type == 'gross-profit') {

                    var chartData = res.gross_profit_data;

                    chartData.forEach(function(objVal) {

                        initialDate = getDateFormatted(new Date(objVal.date));
                        if (initialDate.split('-').length == 4) {
                            year = initialDate.split('-')[1];
                            month = initialDate.split('-')[2]
                            date = initialDate.split('-')[3];
                        } else {
                            year = initialDate.split('-')[0];
                            month = initialDate.split('-')[1]
                            date = initialDate.split('-')[2];
                        }
                        objVal.date = parseInt(year) + '-' + month + '-' + date;


                    });

                    grossProfitChart.data = chartData;

                    var chartData = res.accumulated_gross_profit_data;
                    chartData.forEach(function(objVal) {

                        initialDate = getDateFormatted(new Date(objVal.date));
                        if (initialDate.split('-').length == 4) {
                            year = initialDate.split('-')[1];
                            month = initialDate.split('-')[2]
                            date = initialDate.split('-')[3];
                        } else {
                            year = initialDate.split('-')[0];
                            month = initialDate.split('-')[1]
                            date = initialDate.split('-')[2];
                        }
                        objVal.date = parseInt(year) + '-' + month + '-' + date;


                    });

                    accumulatedGrossProfitChart.data = chartData;

                }





            }
            , type: "get"
        });
    })

</script>

<!-- HTML -->

<!-- HTML -->
@endsection
