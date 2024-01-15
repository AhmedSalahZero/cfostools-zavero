@extends('layouts.dashboard')
@section('css')
<link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('dash_nav')
    <ul class="kt-menu__nav ">
        <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{ route('dashboard',$company) }}"
                class="kt-menu__link"><span class="kt-menu__link-text">{{__('Sales Dashboard')}}</span></a></li>
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.breakdown',$company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text">Breakdown Analysis Dashboard</span></a></li>
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.forecast',$company) }}"
                class="kt-menu__link "><span class="kt-menu__link-text">Forecast Dashboard</span></a></li>
        <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a
                href="{{ route('dashboard.contractResult',$company) }}" class="kt-menu__link active-button"><span
                    class="kt-menu__link-text active-text">Contract Result Dashboard</span></a></li>
    </ul>
@endsection

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title head-title text-primary">
                    {{ __('Dashboard Results') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="form-group row">

                <div class="col-md-3">
                    <label>{{ __('Select Contract - (Multi Selection)') }} </label>
                    <select class="form-control kt-selectpicker" multiple>
                        <option selected>{{ __('All Contracts') }}</option>
                        <option>{{ __('Contract 1') }}</option>
                        <option>{{ __('Contract 2') }}</option>
                        <option>{{ __('Contract 3') }}</option>
                        <option>{{ __('Contract 4') }}</option>
                    </select>

                </div>
                <div class="col-md-3">
                    <label>{{ __('Select Phase') }} </label>
                    <select class="form-control kt-selectpicker" multiple>
                        <option selected>{{ __('All Phases') }}</option>
                        <option>{{ __('Phase 1') }}</option>
                        <option>{{ __('Phase 2') }}</option>
                        <option>{{ __('Phase 3') }}</option>
                        <option>{{ __('Phase 4') }}</option>
                        <option>{{ __('Phase 5') }}</option>
                        <option>{{ __('Phase 6') }}</option>
                    </select>

                </div>
                <div class="col-md-3">
                    <label>{{ __('Start Date') }}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="text" name="invoice_date" class="form-control" max="{{ date('d/m/Y') }}"
                                readonly placeholder="Select date" id="kt_datepicker_2" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>{{ __('End Date') }}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="text" name="invoice_date" class="form-control" max="{{ date('d/m/Y') }}"
                                readonly placeholder="Select date" id="kt_datepicker_2" />
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- First Section --}}
    <div class="row">
        {{-- Contract Financial Results --}}
        <div class="col-md-4">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{ __('Contract Financial Results') }}
                        </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                    class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Sales</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Product Cost</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Installation Cost</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Software Cost</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Direct Labor Cost</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Operations Cost</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Other Expenses</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Profit</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                {{-- Phases Sales Breakdown --}}
                <div class="col-md-6">
                    <div class="kt-portlet ">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label col-8">
                                <h3 class="kt-portlet__head-title head-title text-primary">
                                    {{ __('Phases Sales Breakdown') }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-label col-4">
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
                                    <div class="chartdivdonut" id="chartdivDonut1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Revenues Breakdown --}}
                <div class="col-md-6">
                    <div class="kt-portlet ">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label col-8">
                                <h3 class="kt-portlet__head-title head-title text-primary">
                                    {{ __('Revenues Breakdown') }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-label col-4">
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
                                    <div class="chartdivdonut" id="chartdivDonut2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="kt-portlet ">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label col-8">
                                <h3 class="kt-portlet__head-title head-title text-primary">
                                    {{ __('Contract Financial Results') }}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-label col-4">
                                <div class="kt-align-right">
                                    <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill"><i
                                            class="fa fa-chart-line"></i> {{ __('Report') }} </button>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                        <div class="kt-portlet__body">
                                            <div class="kt-iconbox__body">
                                                <div class="kt-iconbox__desc">
                                                    <h3 class="kt-iconbox__title">
                                                        <a class="kt-link" href="#">Net Profit Margin %</a>
                                                    </h3>
                                                    <div class="kt-iconbox__content text-primary  ">
                                                        <h4>50%</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                        <div class="kt-portlet__body">
                                            <div class="kt-iconbox__body">
                                                <div class="kt-iconbox__desc">
                                                    <h3 class="kt-iconbox__title">
                                                        <a class="kt-link" href="#">Required Financing</a>
                                                    </h3>
                                                    <div class="kt-iconbox__content text-primary  ">
                                                        <h4>10,000,000</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div>

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

    {{-- Gantt Chart --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Contract Gantt Chart') }}
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
                        <div class="chartdivchart" id="chartdivgantt"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
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


    {{-- Donut --}}
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivDonut1", am4charts.PieChart);

            // Add data
            chart.data = [{
                "LGs": "Phase 1",
                "Outstanding": 500
            }, {
                "LGs": "Phase 2",
                "Outstanding": 700
            }, {
                "LGs": "Phase 3",
                "Outstanding": 1000
            }];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "Outstanding";
            pieSeries.dataFields.category = "LGs";
            pieSeries.innerRadius = am4core.percent(50);
            pieSeries.ticks.template.disabled = true;
            pieSeries.labels.template.disabled = true;

            var rgm = new am4core.RadialGradientModifier();
            rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
            pieSeries.slices.template.fillModifier = rgm;
            pieSeries.slices.template.strokeModifier = rgm;
            pieSeries.slices.template.strokeOpacity = 0.4;
            pieSeries.slices.template.strokeWidth = 0;

            chart.legend = new am4charts.Legend();
            chart.legend.position = "bottom";

        }); // end am4core.ready()

    </script>
    {{-- Donut --}}
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdivDonut2", am4charts.PieChart);

            // Add data
            chart.data = [{
                "LGs": "Products",
                "Outstanding": 500
            }, {
                "LGs": "Installations",
                "Outstanding": 700
            }, {
                "LGs": "Software",
                "Outstanding": 1000
            }];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "Outstanding";
            pieSeries.dataFields.category = "LGs";
            pieSeries.innerRadius = am4core.percent(50);
            pieSeries.ticks.template.disabled = true;
            pieSeries.labels.template.disabled = true;

            var rgm = new am4core.RadialGradientModifier();
            rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
            pieSeries.slices.template.fillModifier = rgm;
            pieSeries.slices.template.strokeModifier = rgm;
            pieSeries.slices.template.strokeOpacity = 0.4;
            pieSeries.slices.template.strokeWidth = 0;

            chart.legend = new am4charts.Legend();
            chart.legend.position = "bottom";

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
    {{-- Gantt Char --}}
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdivgantt", am4charts.XYChart);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.paddingRight = 30;
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm";

            var colorSet = new am4core.ColorSet();
            colorSet.saturation = 0.4;

            chart.data = [{
                "category": "Activity #1",
                "start": "2016-01-01",
                "end": "2016-01-14",
                "color": colorSet.getIndex(0).brighten(0),
                "task": "Gathering requirements"
            }, {
                "category": "Activity #1",
                "start": "2016-01-16",
                "end": "2016-01-27",
                "color": colorSet.getIndex(0).brighten(0.4),
                "task": "Producing specifications"
            }, {
                "category": "Activity #1",
                "start": "2016-02-05",
                "end": "2016-04-18",
                "color": colorSet.getIndex(0).brighten(0.8),
                "task": "Development"
            }, {
                "category": "Activity #1",
                "start": "2016-04-18",
                "end": "2016-04-30",
                "color": colorSet.getIndex(0).brighten(1.2),
                "task": "Testing and QA"
            }, {
                "category": "Activity #2",
                "start": "2016-01-08",
                "end": "2016-01-10",
                "color": colorSet.getIndex(2).brighten(0),
                "task": "Gathering requirements"
            }, {
                "category": "Activity #2",
                "start": "2016-01-12",
                "end": "2016-01-15",
                "color": colorSet.getIndex(2).brighten(0.4),
                "task": "Producing specifications"
            }, {
                "category": "Activity #2",
                "start": "2016-01-16",
                "end": "2016-02-05",
                "color": colorSet.getIndex(2).brighten(0.8),
                "task": "Development"
            }, {
                "category": "Activity #2",
                "start": "2016-02-10",
                "end": "2016-02-18",
                "color": colorSet.getIndex(2).brighten(1.2),
                "task": "Testing and QA"
            }, {
                "category": "Activity #3",
                "start": "2016-01-02",
                "end": "2016-01-08",
                "color": colorSet.getIndex(4).brighten(0),
                "task": "Gathering requirements"
            }, {
                "category": "Activity #3",
                "start": "2016-01-08",
                "end": "2016-01-16",
                "color": colorSet.getIndex(4).brighten(0.4),
                "task": "Producing specifications"
            }, {
                "category": "Activity #3",
                "start": "2016-01-19",
                "end": "2016-03-01",
                "color": colorSet.getIndex(4).brighten(0.8),
                "task": "Development"
            }, {
                "category": "Activity #3",
                "start": "2016-03-12",
                "end": "2016-04-05",
                "color": colorSet.getIndex(4).brighten(1.2),
                "task": "Testing and QA"
            }, {
                "category": "Activity #4",
                "start": "2016-01-01",
                "end": "2016-01-19",
                "color": colorSet.getIndex(6).brighten(0),
                "task": "Gathering requirements"
            }, {
                "category": "Activity #4",
                "start": "2016-01-19",
                "end": "2016-02-03",
                "color": colorSet.getIndex(6).brighten(0.4),
                "task": "Producing specifications"
            }, {
                "category": "Activity #4",
                "start": "2016-03-20",
                "end": "2016-04-25",
                "color": colorSet.getIndex(6).brighten(0.8),
                "task": "Development"
            }, {
                "category": "Activity #4",
                "start": "2016-04-27",
                "end": "2016-05-15",
                "color": colorSet.getIndex(6).brighten(1.2),
                "task": "Testing and QA"
            }, {
                "category": "Activity #5",
                "start": "2016-01-01",
                "end": "2016-01-12",
                "color": colorSet.getIndex(8).brighten(0),
                "task": "Gathering requirements"
            }, {
                "category": "Activity #5",
                "start": "2016-01-12",
                "end": "2016-01-19",
                "color": colorSet.getIndex(8).brighten(0.4),
                "task": "Producing specifications"
            }, {
                "category": "Activity #5",
                "start": "2016-01-19",
                "end": "2016-03-01",
                "color": colorSet.getIndex(8).brighten(0.8),
                "task": "Development"
            }, {
                "category": "Activity #5",
                "start": "2016-03-08",
                "end": "2016-03-30",
                "color": colorSet.getIndex(8).brighten(1.2),
                "task": "Testing and QA"
            }];

            chart.dateFormatter.dateFormat = "yyyy-MM-dd";
            chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

            var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "category";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.inversed = true;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.minGridDistance = 70;
            dateAxis.baseInterval = {
                count: 1,
                timeUnit: "day"
            };
            // dateAxis.max = new Date(2018, 0, 1, 24, 0, 0, 0).getTime();
            //dateAxis.strictMinMax = true;
            dateAxis.renderer.tooltipLocation = 0;

            var series1 = chart.series.push(new am4charts.ColumnSeries());
            series1.columns.template.height = am4core.percent(70);
            series1.columns.template.tooltipText = "{task}: [bold]{openDateX}[/] - [bold]{dateX}[/]";

            series1.dataFields.openDateX = "start";
            series1.dataFields.dateX = "end";
            series1.dataFields.categoryY = "category";
            series1.columns.template.propertyFields.fill = "color"; // get color from data
            series1.columns.template.propertyFields.stroke = "color";
            series1.columns.template.strokeOpacity = 1;

            chart.scrollbarX = new am4core.Scrollbar();

        }); // end am4core.ready()

    </script>
@endsection
