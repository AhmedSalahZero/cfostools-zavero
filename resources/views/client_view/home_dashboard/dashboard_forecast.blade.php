@extends('layouts.dashboard')
@section('dash_nav')
    <ul class="kt-menu__nav ">
        <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{ route('dashboard',$company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text">{{__('Sales Dashboard')}}</span></a></li>
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.breakdown',$company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text">Breakdown Analysis Dashboard</span></a></li>
        {{-- <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.ltl')}}" class="kt-menu__link "><span class="kt-menu__link-text">Long Term Facilities Dashboard</span></a></li> --}}
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.forecast',$company) }}"
                class="kt-menu__link active-button"><span class="kt-menu__link-text">Forecast Dashboard</span></a></li>
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.contractResult',$company) }}"
                    class="kt-menu__link "><span class="kt-menu__link-text">Contract Result Dashboard</span></a></li>
    </ul>
@endsection
@section('css')
@endsection
@section('content')

    {{-- Title --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Cash Inflow/Outflow Forecast') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Multi Line Chart --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Monthly Cash Flow') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-label ">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="chartdivchart" id="chartdivmulti"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single Line Chart --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Monthly Accumulated Cash Flow') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-label ">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="chartdivchart" id="chartdivline1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Title --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __("Receivables & Payables Aging ") }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Customers Invoices Aging --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Customers Invoices Aging') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-label ">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-sm table-striped table-head-bg-brand ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>{{ __('Invoices Aging') }}</th>
                                    <th class="text-center">{{ __('Invoices Amount') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Past Dues More Than -120 Days</td>
                                    <td class="text-center">500,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -120 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -90 Days</td>
                                    <td class="text-center">700,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -60 Days</td>
                                    <td class="text-center">800,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -30 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -15 Days</td>
                                    <td class="text-center">1,000,000</td>
                                </tr>
                                <tr>
                                    <td>From (0-7) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (8-15) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (16-30) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (31-60) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (61-90) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (91-120) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>More Than +120 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-center">1,600,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div class="chartdivchart" id="chartdiv3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Customers Cheques Aging --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Customers Cheques Aging') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-label ">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                        <button type="button" class="btn btn-sm btn-pill color-rose"><i
                            class="fa fa-chart-line"></i> {{ __('Rejected Cheques Report') }} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-sm table-striped table-head-bg-brand ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>{{ __('Cheques Aging') }}</th>
                                    <th class="text-center">{{ __('Cheques Amount') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>From (0-7) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (8-15) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (16-30) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (31-60) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (61-90) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (91-120) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>More Than +120 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-center">1,600,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div class="chartdivchart" id="chartdivline2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Suppliers Invoices Aging --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Suppliers Invoices Aging') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-label ">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-sm table-striped table-head-bg-brand ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>{{ __('Invoices Aging') }}</th>
                                    <th class="text-center">{{ __('Invoices Amount') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Past Dues More Than -120 Days</td>
                                    <td class="text-center">500,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -120 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -90 Days</td>
                                    <td class="text-center">700,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -60 Days</td>
                                    <td class="text-center">800,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -30 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Past Dues -15 Days</td>
                                    <td class="text-center">1,000,000</td>
                                </tr>
                                <tr>
                                    <td>From (0-7) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (8-15) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (16-30) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (31-60) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (61-90) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (91-120) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>More Than +120 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-center">1,600,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div class="chartdivchart" id="chartdiv4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Suppliers Cheques Aging --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Suppliers Cheques Aging') }}
                    </h3>
                </div>
                <div class="kt-portlet__head-label ">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-sm table-striped table-head-bg-brand ">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>{{ __('Cheques Aging') }}</th>
                                    <th class="text-center">{{ __('Cheques Amount') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>From (0-7) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (8-15) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (16-30) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (31-60) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (61-90) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>From (91-120) Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>More Than +120 Days</td>
                                    <td class="text-center">600,000</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td class="text-center">1,600,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <div class="chartdivchart" id="chartdivline3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Title --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __("Long & Short Term Facilities Comming Dues ") }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Short Term Facilities Comming Dues --}}
        <div class="col-md-4">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{ __('Short Term Facilities Comming Dues') }}
                        </h3>
                    </div>
                    <div class="kt-portlet__head-label ">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                    class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{-- Chart --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-sm table-striped table-head-bg-brand ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>{{ __('Date') }}</th>
                                            <th class="text-center">{{ __('Amount') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Date 1</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 2</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 3</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 4</td>
                                            <td class="text-center">600,000</td>
                                        </tr>

                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="chartdivchart" id="chartdivline4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Long Term Facilities Comming Dues --}}
        <div class="col-md-4">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{ __('Long Term Facilities Comming Dues') }}
                        </h3>
                    </div>
                    <div class="kt-portlet__head-label ">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                    class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{-- Chart --}}
                    <div class="row">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-sm table-striped table-head-bg-brand ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>{{ __('Date') }}</th>
                                            <th class="text-center">{{ __('Amount') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Date 1</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 2</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 3</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 4</td>
                                            <td class="text-center">600,000</td>
                                        </tr>

                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="chartdivchart" id="chartdivline5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Leasing Facilities Comming Dues --}}
        <div class="col-md-4">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{ __('Leasing Facilities Comming Dues') }}
                        </h3>
                    </div>
                    <div class="kt-portlet__head-label ">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                    class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    {{-- Chart --}}
                    <div class="row">


                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                <table class="table table-sm table-striped table-head-bg-brand ">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>{{ __('Date') }}</th>
                                            <th class="text-center">{{ __('Amount') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Date 1</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 2</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 3</td>
                                            <td class="text-center">600,000</td>
                                        </tr>
                                        <tr>
                                            <td>Date 4</td>
                                            <td class="text-center">600,000</td>
                                        </tr>

                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="chartdivchart" id="chartdivline6"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Data -->
    <script>
        var ammount_array = [{
                "date": "2012-07-27",
                "value": 13
            }, {
                "date": "2012-07-28",
                "value": 11
            }, {
                "date": "2012-07-29",
                "value": 15
            }, {
                "date": "2012-07-30",
                "value": 16
            }, {
                "date": "2012-07-31",
                "value": 18
            }, {
                "date": "2012-08-01",
                "value": 13
            }, {
                "date": "2012-08-02",
                "value": 22
            }, {
                "date": "2012-08-03",
                "value": 23
            }, {
                "date": "2012-08-04",
                "value": 20
            }, {
                "date": "2012-08-05",
                "value": 17
            }, {
                "date": "2012-08-06",
                "value": 16
            }, {
                "date": "2012-08-07",
                "value": 18
            }, {
                "date": "2012-08-08",
                "value": 21
            }, {
                "date": "2012-08-09",
                "value": 26
            }, {
                "date": "2012-08-10",
                "value": 24
            }, {
                "date": "2012-08-11",
                "value": 29
            }, {
                "date": "2012-08-12",
                "value": 32
            }, {
                "date": "2012-08-13",
                "value": 18
            }, {
                "date": "2012-08-14",
                "value": 24
            }, {
                "date": "2012-08-15",
                "value": 22
            }, {
                "date": "2012-08-16",
                "value": 18
            }, {
                "date": "2012-08-17",
                "value": 19
            }, {
                "date": "2012-08-18",
                "value": 14
            }, {
                "date": "2012-08-19",
                "value": 15
            }, {
                "date": "2012-08-20",
                "value": 12
            }, {
                "date": "2012-08-21",
                "value": 8
            }, {
                "date": "2012-08-22",
                "value": 9
            }, {
                "date": "2012-08-23",
                "value": 8
            }, {
                "date": "2012-08-24",
                "value": 7
            }, {
                "date": "2012-08-25",
                "value": 5
            }, {
                "date": "2012-08-26",
                "value": 11
        }];
    </script>


    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv3", am4charts.XYChart);

            // Add data
            chart.data = [{
                    "region": "Past Dues",
                    "state": "More Than (-120) Days",
                    "sales": 920
                },
                {
                    "region": "Past Dues",
                    "state": "(-91 To -120) Days",
                    "sales": 1317
                },
                {
                    "region": "Past Dues",
                    "state": "(-61 To -90) Days",
                    "sales": 2916
                },
                {
                    "region": "Past Dues",
                    "state": "(-31 To -60) Days",
                    "sales": 40577
                },
                {
                    "region": "Past Dues",
                    "state": "(-15 To -30) Days",
                    "sales": 274064
                },
                {
                    "region": "Past Dues",
                    "state": "(-8 To -15) Days",
                    "sales": 170686
                },

                {
                    "region": "Past Dues",
                    "state": "(-7) Days",
                    "sales": 109187
                },
                {
                    "region": "Coming Dues",
                    "state": "(+7) Days",
                    "sales": 1209
                },
                {
                    "region": "Coming Dues",
                    "state": "(+8 To +15) Days",
                    "sales": 1270
                },
                {
                    "region": "Coming Dues",
                    "state": "(+16 To +30) Days",
                    "sales": 2866
                },
                {
                    "region": "Coming Dues",
                    "state": "(+31 To +60) Days",
                    "sales": 7294
                },
                {
                    "region": "Coming Dues",
                    "state": "(+61 To +90) Days",
                    "sales": 8929
                },
                {
                    "region": "Coming Dues",
                    "state": "(+91 To +120) Days",
                    "sales": 13386
                },
                {
                    "region": "Coming Dues",
                    "state": "More Than (+120) Days",
                    "sales": 310914
                }

            ];

            // Create axes
            var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            yAxis.dataFields.category = "state";
            yAxis.renderer.grid.template.location = 0;
            yAxis.renderer.labels.template.fontSize = 10;
            yAxis.renderer.minGridDistance = 10;

            var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = "sales";
            series.dataFields.categoryY = "state";
            series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
            series.columns.template.strokeWidth = 0;
            series.columns.template.adapter.add("fill", function(fill, target) {
                if (target.dataItem) {
                    switch (target.dataItem.dataContext.region) {
                        case "Past Dues":
                            return "#C70039";
                            break;
                        case "Coming Dues":
                            return "#1D9D23";
                            break;
                    }
                }
                return fill;
            });

            var axisBreaks = {};
            var legendData = [];

            // Add ranges
            function addRange(label, start, end, color) {
                var range = yAxis.axisRanges.create();
                range.category = start;
                range.endCategory = end;
                range.label.text = label;
                range.label.disabled = false;
                range.label.fill = color;
                range.label.location = 0;
                range.label.dx = -145;
                range.label.dy = 12;
                range.label.fontWeight = "bold";
                range.label.fontSize = 16;
                range.label.horizontalCenter = "left"
                range.label.inside = true;

                range.grid.stroke = am4core.color("#396478");
                range.grid.strokeOpacity = 1;
                range.tick.length = 200;
                range.tick.disabled = false;
                range.tick.strokeOpacity = 1;
                range.tick.stroke = am4core.color("#396478");
                range.tick.location = 0;

                range.locations.category = 1;
                var axisBreak = yAxis.axisBreaks.create();
                axisBreak.startCategory = start;
                axisBreak.endCategory = end;
                axisBreak.breakSize = 1;
                axisBreak.fillShape.disabled = true;
                axisBreak.startLine.disabled = true;
                axisBreak.endLine.disabled = true;
                axisBreaks[label] = axisBreak;

                legendData.push({
                    name: label,
                    fill: color
                });
            }

            addRange("Past Dues", "(-7) Days", "More Than (-120) Days", "#C70039");
            addRange("Coming Dues", "More Than (+120) Days", "(+7) Days", "#1D9D23");
            // addRange("South", "Florida", "South Carolina", chart.colors.getIndex(2));
            // addRange("West", "California", "Wyoming", chart.colors.getIndex(3));

            chart.cursor = new am4charts.XYCursor();
            0
            var legend = new am4charts.Legend();
            legend.position = "bottom";
            legend.scrollable = true;
            legend.valign = "top";
            legend.reverseOrder = true;

            chart.legend = legend;
            legend.data = legendData;

            legend.itemContainers.template.events.on("toggled", function(event) {
                var name = event.target.dataItem.dataContext.name;
                var axisBreak = axisBreaks[name];
                if (event.target.isActive) {
                    axisBreak.animate({
                        property: "breakSize",
                        to: 0
                    }, 1000, am4core.ease.cubicOut);
                    yAxis.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.hide(1000, 500);
                        }
                    })
                    series.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.hide(1000, 0, 0, ["valueX"]);
                        }
                    })
                } else {
                    axisBreak.animate({
                        property: "breakSize",
                        to: 1
                    }, 1000 , am4core.ease.cubicOut);
                    yAxis.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.show(1000);
                        }
                    })

                    series.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.show(1000, 0, ["valueX"]);
                        }
                    })
                }
            })

        }); // end am4core.ready()

    </script>
    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv4", am4charts.XYChart);

            // Add data
            chart.data = [{
                    "region": "Past Dues",
                    "state": "More Than (-120) Days",
                    "sales": 920
                },
                {
                    "region": "Past Dues",
                    "state": "(-91 To -120) Days",
                    "sales": 1317
                },
                {
                    "region": "Past Dues",
                    "state": "(-61 To -90) Days",
                    "sales": 2916
                },
                {
                    "region": "Past Dues",
                    "state": "(-31 To -60) Days",
                    "sales": 40577
                },
                {
                    "region": "Past Dues",
                    "state": "(-15 To -30) Days",
                    "sales": 274064
                },
                {
                    "region": "Past Dues",
                    "state": "(-8 To -15) Days",
                    "sales": 170686
                },

                {
                    "region": "Past Dues",
                    "state": "(-7) Days",
                    "sales": 109187
                },
                {
                    "region": "Payable Dues",
                    "state": "(+7) Days",
                    "sales": 1209
                },
                {
                    "region": "Payable Dues",
                    "state": "(+8 To +15) Days",
                    "sales": 1270
                },
                {
                    "region": "Payable Dues",
                    "state": "(+16 To +30) Days",
                    "sales": 2866
                },
                {
                    "region": "Payable Dues",
                    "state": "(+31 To +60) Days",
                    "sales": 7294
                },
                {
                    "region": "Payable Dues",
                    "state": "(+61 To +90) Days",
                    "sales": 8929
                },
                {
                    "region": "Payable Dues",
                    "state": "(+91 To +120) Days",
                    "sales": 13386
                },
                {
                    "region": "Payable Dues",
                    "state": "More Than (+120) Days",
                    "sales": 310914
                }

            ];

            // Create axes
            var yAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            yAxis.dataFields.category = "state";
            yAxis.renderer.grid.template.location = 0;
            yAxis.renderer.labels.template.fontSize = 10;
            yAxis.renderer.minGridDistance = 10;

            var xAxis = chart.xAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = "sales";
            series.dataFields.categoryY = "state";
            series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
            series.columns.template.strokeWidth = 0;
            series.columns.template.adapter.add("fill", function(fill, target) {
                if (target.dataItem) {
                    switch (target.dataItem.dataContext.region) {
                        case "Past Dues":
                            return "#C70039";
                            break;
                        case "Payable Dues":
                            return "#1D9D23";
                            break;
                    }
                }
                return fill;
            });

            var axisBreaks = {};
            var legendData = [];

            // Add ranges
            function addRange(label, start, end, color) {
                var range = yAxis.axisRanges.create();
                range.category = start;
                range.endCategory = end;
                range.label.text = label;
                range.label.disabled = false;
                range.label.fill = color;
                range.label.location = 0;
                range.label.dx = -145;
                range.label.dy = 12;
                range.label.fontWeight = "bold";
                range.label.fontSize = 16;
                range.label.horizontalCenter = "left"
                range.label.inside = true;

                range.grid.stroke = am4core.color("#396478");
                range.grid.strokeOpacity = 1;
                range.tick.length = 200;
                range.tick.disabled = false;
                range.tick.strokeOpacity = 1;
                range.tick.stroke = am4core.color("#396478");
                range.tick.location = 0;

                range.locations.category = 1;
                var axisBreak = yAxis.axisBreaks.create();
                axisBreak.startCategory = start;
                axisBreak.endCategory = end;
                axisBreak.breakSize = 1;
                axisBreak.fillShape.disabled = true;
                axisBreak.startLine.disabled = true;
                axisBreak.endLine.disabled = true;
                axisBreaks[label] = axisBreak;

                legendData.push({
                    name: label,
                    fill: color
                });
            }

            addRange("Past Dues", "(-7) Days", "More Than (-120) Days", "#C70039");
            addRange("Payable Dues", "More Than (+120) Days", "(+7) Days", "#1D9D23");
            // addRange("South", "Florida", "South Carolina", chart.colors.getIndex(2));
            // addRange("West", "California", "Wyoming", chart.colors.getIndex(3));

            chart.cursor = new am4charts.XYCursor();
            0
            var legend = new am4charts.Legend();
            legend.position = "bottom";
            legend.scrollable = true;
            legend.valign = "top";
            legend.reverseOrder = true;

            chart.legend = legend;
            legend.data = legendData;

            legend.itemContainers.template.events.on("toggled", function(event) {
                var name = event.target.dataItem.dataContext.name;
                var axisBreak = axisBreaks[name];
                if (event.target.isActive) {
                    axisBreak.animate({
                        property: "breakSize",
                        to: 0
                    }, 1000, am4core.ease.cubicOut);
                    yAxis.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.hide(1000, 500);
                        }
                    })
                    series.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.hide(1000, 0, 0, ["valueX"]);
                        }
                    })
                } else {
                    axisBreak.animate({
                        property: "breakSize",
                        to: 1
                    }, 1000 , am4core.ease.cubicOut);
                    yAxis.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.show(1000);
                        }
                    })

                    series.dataItems.each(function(dataItem) {
                        if (dataItem.dataContext.region == name) {
                            dataItem.show(1000, 0, ["valueX"]);
                        }
                    })
                }
            })

        }); // end am4core.ready()

    </script>


    <!-- Single Chart code 1 -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivline1", am4charts.XYChart);

            // Add data
            chart.data = [{
                "date": "2012-07-27",
                "value": 13
            }, {
                "date": "2012-07-28",
                "value": 11
            }, {
                "date": "2012-07-29",
                "value": 15
            }, {
                "date": "2012-07-30",
                "value": 16
            }, {
                "date": "2012-07-31",
                "value": 18
            }, {
                "date": "2012-08-01",
                "value": 13
            }, {
                "date": "2012-08-02",
                "value": 22
            }, {
                "date": "2012-08-03",
                "value": 23
            }, {
                "date": "2012-08-04",
                "value": 20
            }, {
                "date": "2012-08-05",
                "value": 17
            }, {
                "date": "2012-08-06",
                "value": 16
            }, {
                "date": "2012-08-07",
                "value": 18
            }, {
                "date": "2012-08-08",
                "value": 21
            }, {
                "date": "2012-08-09",
                "value": 26
            }, {
                "date": "2012-08-10",
                "value": 24
            }, {
                "date": "2012-08-11",
                "value": 29
            }, {
                "date": "2012-08-12",
                "value": 32
            }, {
                "date": "2012-08-13",
                "value": 18
            }, {
                "date": "2012-08-14",
                "value": 24
            }, {
                "date": "2012-08-15",
                "value": 22
            }, {
                "date": "2012-08-16",
                "value": 18
            }, {
                "date": "2012-08-17",
                "value": 19
            }, {
                "date": "2012-08-18",
                "value": 14
            }, {
                "date": "2012-08-19",
                "value": 15
            }, {
                "date": "2012-08-20",
                "value": 12
            }, {
                "date": "2012-08-21",
                "value": 8
            }, {
                "date": "2012-08-22",
                "value": 9
            }, {
                "date": "2012-08-23",
                "value": 8
            }, {
                "date": "2012-08-24",
                "value": 7
            }, {
                "date": "2012-08-25",
                "value": 5
            }, {
                "date": "2012-08-26",
                "value": 11
            }, {
                "date": "2012-08-27",
                "value": 13
            }, {
                "date": "2012-08-28",
                "value": 18
            }, {
                "date": "2012-08-29",
                "value": 20
            }, {
                "date": "2012-08-30",
                "value": 29
            }, {
                "date": "2012-08-31",
                "value": 33
            }, {
                "date": "2012-09-01",
                "value": 42
            }, {
                "date": "2012-09-02",
                "value": 35
            }, {
                "date": "2012-09-03",
                "value": 31
            }, {
                "date": "2012-09-04",
                "value": 47
            }, {
                "date": "2012-09-05",
                "value": 52
            }, {
                "date": "2012-09-06",
                "value": 46
            }, {
                "date": "2012-09-07",
                "value": 41
            }, {
                "date": "2012-09-08",
                "value": 43
            }, {
                "date": "2012-09-09",
                "value": 40
            }, {
                "date": "2012-09-10",
                "value": 39
            }, {
                "date": "2012-09-11",
                "value": 34
            }, {
                "date": "2012-09-12",
                "value": 29
            }, {
                "date": "2012-09-13",
                "value": 34
            }, {
                "date": "2012-09-14",
                "value": 37
            }, {
                "date": "2012-09-15",
                "value": 42
            }, {
                "date": "2012-09-16",
                "value": 49
            }, {
                "date": "2012-09-17",
                "value": 46
            }, {
                "date": "2012-09-18",
                "value": 47
            }, {
                "date": "2012-09-19",
                "value": 55
            }, {
                "date": "2012-09-20",
                "value": 59
            }, {
                "date": "2012-09-21",
                "value": 58
            }, {
                "date": "2012-09-22",
                "value": 57
            }, {
                "date": "2012-09-23",
                "value": 61
            }, {
                "date": "2012-09-24",
                "value": 59
            }, {
                "date": "2012-09-25",
                "value": 67
            }, {
                "date": "2012-09-26",
                "value": 65
            }, {
                "date": "2012-09-27",
                "value": 61
            }, {
                "date": "2012-09-28",
                "value": 66
            }, {
                "date": "2012-09-29",
                "value": 69
            }, {
                "date": "2012-09-30",
                "value": 71
            }, {
                "date": "2012-10-01",
                "value": 67
            }, {
                "date": "2012-10-02",
                "value": 63
            }, {
                "date": "2012-10-03",
                "value": 46
            }, {
                "date": "2012-10-04",
                "value": 32
            }, {
                "date": "2012-10-05",
                "value": 21
            }, {
                "date": "2012-10-06",
                "value": 18
            }, {
                "date": "2012-10-07",
                "value": 21
            }, {
                "date": "2012-10-08",
                "value": 28
            }, {
                "date": "2012-10-09",
                "value": 27
            }, {
                "date": "2012-10-10",
                "value": 36
            }, {
                "date": "2012-10-11",
                "value": 33
            }, {
                "date": "2012-10-12",
                "value": 31
            }, {
                "date": "2012-10-13",
                "value": 30
            }, {
                "date": "2012-10-14",
                "value": 34
            }, {
                "date": "2012-10-15",
                "value": 38
            }, {
                "date": "2012-10-16",
                "value": 37
            }, {
                "date": "2012-10-17",
                "value": 44
            }, {
                "date": "2012-10-18",
                "value": 49
            }, {
                "date": "2012-10-19",
                "value": 53
            }, {
                "date": "2012-10-20",
                "value": 57
            }, {
                "date": "2012-10-21",
                "value": 60
            }, {
                "date": "2012-10-22",
                "value": 61
            }, {
                "date": "2012-10-23",
                "value": 69
            }, {
                "date": "2012-10-24",
                "value": 67
            }, {
                "date": "2012-10-25",
                "value": 72
            }, {
                "date": "2012-10-26",
                "value": 77
            }, {
                "date": "2012-10-27",
                "value": 75
            }, {
                "date": "2012-10-28",
                "value": 70
            }, {
                "date": "2012-10-29",
                "value": 72
            }, {
                "date": "2012-10-30",
                "value": 70
            }, {
                "date": "2012-10-31",
                "value": 72
            }, {
                "date": "2012-11-01",
                "value": 73
            }, {
                "date": "2012-11-02",
                "value": 67
            }, {
                "date": "2012-11-03",
                "value": 68
            }, {
                "date": "2012-11-04",
                "value": 65
            }, {
                "date": "2012-11-05",
                "value": 71
            }, {
                "date": "2012-11-06",
                "value": 75
            }, {
                "date": "2012-11-07",
                "value": 74
            }, {
                "date": "2012-11-08",
                "value": 71
            }, {
                "date": "2012-11-09",
                "value": 76
            }, {
                "date": "2012-11-10",
                "value": 77
            }, {
                "date": "2012-11-11",
                "value": 81
            }, {
                "date": "2012-11-12",
                "value": 83
            }, {
                "date": "2012-11-13",
                "value": 80
            }, {
                "date": "2012-11-14",
                "value": 81
            }, {
                "date": "2012-11-15",
                "value": 87
            }, {
                "date": "2012-11-16",
                "value": 82
            }, {
                "date": "2012-11-17",
                "value": 86
            }, {
                "date": "2012-11-18",
                "value": 80
            }, {
                "date": "2012-11-19",
                "value": 87
            }, {
                "date": "2012-11-20",
                "value": 83
            }, {
                "date": "2012-11-21",
                "value": 85
            }, {
                "date": "2012-11-22",
                "value": 84
            }, {
                "date": "2012-11-23",
                "value": 82
            }, {
                "date": "2012-11-24",
                "value": 73
            }, {
                "date": "2012-11-25",
                "value": 71
            }, {
                "date": "2012-11-26",
                "value": 75
            }, {
                "date": "2012-11-27",
                "value": 79
            }, {
                "date": "2012-11-28",
                "value": 70
            }, {
                "date": "2012-11-29",
                "value": 73
            }, {
                "date": "2012-11-30",
                "value": 61
            }, {
                "date": "2012-12-01",
                "value": 62
            }, {
                "date": "2012-12-02",
                "value": 66
            }, {
                "date": "2012-12-03",
                "value": 65
            }, {
                "date": "2012-12-04",
                "value": 73
            }, {
                "date": "2012-12-05",
                "value": 79
            }, {
                "date": "2012-12-06",
                "value": 78
            }, {
                "date": "2012-12-07",
                "value": 78
            }, {
                "date": "2012-12-08",
                "value": 78
            }, {
                "date": "2012-12-09",
                "value": 74
            }, {
                "date": "2012-12-10",
                "value": 73
            }, {
                "date": "2012-12-11",
                "value": 75
            }, {
                "date": "2012-12-12",
                "value": 70
            }, {
                "date": "2012-12-13",
                "value": 77
            }, {
                "date": "2012-12-14",
                "value": 67
            }, {
                "date": "2012-12-15",
                "value": 62
            }, {
                "date": "2012-12-16",
                "value": 64
            }, {
                "date": "2012-12-17",
                "value": 61
            }, {
                "date": "2012-12-18",
                "value": 59
            }, {
                "date": "2012-12-19",
                "value": 53
            }, {
                "date": "2012-12-20",
                "value": 54
            }, {
                "date": "2012-12-21",
                "value": 56
            }, {
                "date": "2012-12-22",
                "value": 59
            }, {
                "date": "2012-12-23",
                "value": 58
            }, {
                "date": "2012-12-24",
                "value": 55
            }, {
                "date": "2012-12-25",
                "value": 52
            }, {
                "date": "2012-12-26",
                "value": 54
            }, {
                "date": "2012-12-27",
                "value": 50
            }, {
                "date": "2012-12-28",
                "value": 50
            }, {
                "date": "2012-12-29",
                "value": 51
            }, {
                "date": "2012-12-30",
                "value": 52
            }, {
                "date": "2012-12-31",
                "value": 58
            }, {
                "date": "2013-01-01",
                "value": 60
            }, {
                "date": "2013-01-02",
                "value": 67
            }, {
                "date": "2013-01-03",
                "value": 64
            }, {
                "date": "2013-01-04",
                "value": 66
            }, {
                "date": "2013-01-05",
                "value": 60
            }, {
                "date": "2013-01-06",
                "value": 63
            }, {
                "date": "2013-01-07",
                "value": 61
            }, {
                "date": "2013-01-08",
                "value": 60
            }, {
                "date": "2013-01-09",
                "value": 65
            }, {
                "date": "2013-01-10",
                "value": 75
            }, {
                "date": "2013-01-11",
                "value": 77
            }, {
                "date": "2013-01-12",
                "value": 78
            }, {
                "date": "2013-01-13",
                "value": 70
            }, {
                "date": "2013-01-14",
                "value": 70
            }, {
                "date": "2013-01-15",
                "value": 73
            }, {
                "date": "2013-01-16",
                "value": 71
            }, {
                "date": "2013-01-17",
                "value": 74
            }, {
                "date": "2013-01-18",
                "value": 78
            }, {
                "date": "2013-01-19",
                "value": 85
            }, {
                "date": "2013-01-20",
                "value": 82
            }, {
                "date": "2013-01-21",
                "value": 83
            }, {
                "date": "2013-01-22",
                "value": 88
            }, {
                "date": "2013-01-23",
                "value": 85
            }, {
                "date": "2013-01-24",
                "value": 85
            }, {
                "date": "2013-01-25",
                "value": 80
            }, {
                "date": "2013-01-26",
                "value": 87
            }, {
                "date": "2013-01-27",
                "value": 84
            }, {
                "date": "2013-01-28",
                "value": 83
            }, {
                "date": "2013-01-29",
                "value": 84
            }, {
                "date": "2013-01-30",
                "value": 81
            }];

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

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

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

        }); // end am4core.ready()

    </script>
    <!-- Single Chart code 2  -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivline2", am4charts.XYChart);

            // Add data
            chart.data =// Add data
            chart.data =ammount_array;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

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

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

        }); // end am4core.ready()

    </script>
    <!-- Single Chart code 3  -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivline3", am4charts.XYChart);

            // Add data
            chart.data = ammount_array;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

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

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

        }); // end am4core.ready()

    </script>
    <!-- Single Chart code 4  -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivline4", am4charts.XYChart);

            // Add data
            chart.data =ammount_array;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

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

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

        }); // end am4core.ready()

    </script>
    <!-- Single Chart code 5  -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivline5", am4charts.XYChart);

            // Add data
            chart.data =ammount_array;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

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

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

        }); // end am4core.ready()

    </script>
    <!-- Single Chart code 6  -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivline6", am4charts.XYChart);

            // Add data
            chart.data =ammount_array;

            // Set input format for the dates
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            // Create axes
            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            // Create series
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "value";
            series.dataFields.dateX = "date";
            series.tooltipText = "{value}"
            series.strokeWidth = 2;
            series.minBulletDistance = 15;

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

            // Create vertical scrollbar and place it before the value axis
            chart.scrollbarY = new am4core.Scrollbar();
            chart.scrollbarY.parent = chart.leftAxesContainer;
            chart.scrollbarY.toBack();

            // Create a horizontal scrollbar with previe and place it underneath the date axis
            chart.scrollbarX = new am4charts.XYChartScrollbar();
            chart.scrollbarX.series.push(series);
            chart.scrollbarX.parent = chart.bottomAxesContainer;

            dateAxis.start = 0.79;
            dateAxis.keepSelection = true;

        }); // end am4core.ready()

    </script>






    <!-- Multi Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivmulti", am4charts.XYChart);

            //

            // Increase contrast by taking evey second color
            chart.colors.step = 2;

            // Add data
            chart.data = generateChartData();

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

            createAxisAndSeries("visits", "Cash Inflow", false, "circle");
            createAxisAndSeries("views", "Cash Outflow", true, "circle");
            // createAxisAndSeries("hits", "Hits", true, "rectangle");

            // Add legend
            chart.legend = new am4charts.Legend();

            // Add cursor
            chart.cursor = new am4charts.XYCursor();

            // generate some random data, quite different range
            function generateChartData() {
                var chartData = [];
                var firstDate = new Date();
                firstDate.setDate(firstDate.getDate() - 100);
                firstDate.setHours(0, 0, 0, 0);

                var visits = 1600;
                var hits = 2900;
                var views = 8700;

                for (var i = 0; i < 15; i++) {
                    // we create date objects here. In your data, you can have date strings
                    // and then set format of your dates using chart.dataDateFormat property,
                    // however when possible, use date objects, as this will speed up chart rendering.
                    var newDate = new Date(firstDate);
                    newDate.setDate(newDate.getDate() + i);

                    visits += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
                    hits += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);
                    views += Math.round((Math.random() < 0.5 ? 1 : -1) * Math.random() * 10);

                    chartData.push({
                        date: newDate,
                        visits: visits,
                        hits: hits,
                        views: views
                    });
                }
                return chartData;
            }

        }); // end am4core.ready()

    </script>


@endsection
