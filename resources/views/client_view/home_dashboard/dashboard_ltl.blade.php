@extends('layouts.dashboard')
@section('dash_nav')
<ul class="kt-menu__nav ">
    <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{route('dashboard',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Sales Dashboard')}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.breakdown',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">Breakdown Analysis Dashboard</span></a></li>
    {{-- <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.ltl')}}" class="kt-menu__link active-button"><span class="kt-menu__link-text">Long Term Facilities Dashboard</span></a></li> --}}
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.forecast',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">Forecast Dashboard</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.contractResult',$company) }}"
        class="kt-menu__link "><span class="kt-menu__link-text">Contract Result Dashboard</span></a></li>
</ul>
@endsection
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


{{-- Title --}}
<div class="row">
    <div class="kt-portlet ">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{__('Letters Of Guarentee Facilities Position')}}
                    </h3>
            </div>
        </div>
    </div>
</div>
{{-- FIRST CARD --}}
<div class="row">
    {{-- First Section --}}
    <div class="col-md-4">
        {{-- Bid Bonds --}}
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Bid Bonds')}}
                            </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Outstanding</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Cash Cover</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>30,000,000</h4>
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
        {{-- Final LGs --}}
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Final LGs')}}
                            </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Outstanding</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Cash Cover</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>30,000,000</h4>
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
        {{-- Advanced Payment LGs --}}
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Advanced Payment LGs')}}
                            </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Outstanding</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Cash Cover</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>30,000,000</h4>
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
    <div class="col-md-4">
        {{-- <div class="col-md-12"> --}}
            <div class="chartdivdonut" id="chartdivDonut"></div>
        {{-- </div> --}}
    </div>
     {{-- Total Letters Of Guarentee --}}
     <div class="col-md-4">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label col-8">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{__('Total Letters Of Guarentee')}}
                        </h3>
                </div>
                <div class="kt-portlet__head-label col-4">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                            <a class="kt-link" href="#">Limit</a>
                                        </h3>
                                        <div class="kt-iconbox__content text-primary  ">
                                            <h4>50,000,000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                            <a class="kt-link" href="#">Outstanding</a>
                                        </h3>
                                        <div class="kt-iconbox__content text-primary  ">
                                            <h4>30,000,000</h4>
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
                                            <a class="kt-link" href="#">Available</a>
                                        </h3>
                                        <div class="kt-iconbox__content text-primary  ">
                                            <h4>20,000,000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="chartdiv" id="chartdiv1"></div>
                    </div>
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
                        {{__('Letters Of Credit Facilities Position')}}
                    </h3>
            </div>
        </div>
    </div>
</div>
{{-- SECOND CARD --}}
<div class="row">
    {{-- First Section --}}
    <div class="col-md-4">
        {{-- Site LCs --}}
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Site LCs')}}
                            </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Outstanding</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Cash Cover</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>30,000,000</h4>
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
        {{-- Deffered LCs --}}
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Deffered LCs')}}
                            </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Outstanding</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--success kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Cash Cover</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>30,000,000</h4>
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
        {{-- Cash Against Documents --}}
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label col-8">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Cash Against Documents')}}
                            </h3>
                    </div>
                    <div class="kt-portlet__head-label col-4">
                        <div class="kt-align-right">
                            <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Outstanding</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>50,000,000</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-iconbox kt-iconbox--warning kt-iconbox--animate-slower">
                                <div class="kt-portlet__body">
                                    <div class="kt-iconbox__body">
                                        <div class="kt-iconbox__desc">
                                            <h3 class="kt-iconbox__title">
                                                <a class="kt-link" href="#">Cash Cover</a>
                                            </h3>
                                            <div class="kt-iconbox__content text-primary  ">
                                                <h4>30,000,000</h4>
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
    <div class="col-md-4">
        {{-- <div class="col-md-12"> --}}
            <div class="chartdivdonut" id="chartdivDonut1"></div>
        {{-- </div> --}}
    </div>
     {{-- Total Letters Of Guarentee --}}
     <div class="col-md-4">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label col-8">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{__('Total Letters Of Guarentee')}}
                        </h3>
                </div>
                <div class="kt-portlet__head-label col-4">
                    <div class="kt-align-right">
                        <button type="button" class="btn btn-sm btn-brand btn-elevate btn-pill" ><i class="fa fa-chart-line"></i> {{__('Report')}} </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                            <a class="kt-link" href="#">Limit</a>
                                        </h3>
                                        <div class="kt-iconbox__content text-primary  ">
                                            <h4>50,000,000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="kt-portlet kt-iconbox kt-iconbox--brand kt-iconbox--animate-slower">
                            <div class="kt-portlet__body">
                                <div class="kt-iconbox__body">
                                    <div class="kt-iconbox__desc">
                                        <h3 class="kt-iconbox__title">
                                            <a class="kt-link" href="#">Outstanding</a>
                                        </h3>
                                        <div class="kt-iconbox__content text-primary  ">
                                            <h4>30,000,000</h4>
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
                                            <a class="kt-link" href="#">Available</a>
                                        </h3>
                                        <div class="kt-iconbox__content text-primary  ">
                                            <h4>20,000,000</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Chart --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="chartdiv" id="chartdiv2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <!-- Chart code -->
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv1", am4charts.PieChart);
            chart.startAngle = 160;
            chart.endAngle = 380;

            // Let's cut a hole in our Pie chart the size of 40% the radius
            chart.innerRadius = am4core.percent(40);

            // Add data
            chart.data = [{
            "country": "Cash Cover",
            "litres": 0,
            "bottles": 30000000
            }, {
            "country": "Available",
            "litres": 20000000,
            "bottles": 20000000
            }];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "litres";
            pieSeries.dataFields.category = "country";
            pieSeries.slices.template.stroke = new am4core.InterfaceColorSet().getFor("background");
            pieSeries.slices.template.strokeWidth = 1;
            pieSeries.slices.template.strokeOpacity = 1;

            // Disabling labels and ticks on inner circle
            pieSeries.labels.template.disabled = true;
            pieSeries.ticks.template.disabled = true;

            // Disable sliding out of slices
            pieSeries.slices.template.states.getKey("hover").properties.shiftRadius = 0;
            pieSeries.slices.template.states.getKey("hover").properties.scale = 1;
            pieSeries.radius = am4core.percent(40);
            pieSeries.innerRadius = am4core.percent(30);

            var cs = pieSeries.colors;
            cs.list = [am4core.color(new am4core.ColorSet().getIndex(0))];

            cs.stepOptions = {
            lightness: -0.05,
            hue: 0
            };
            cs.wrap = false;


            // Add second series
            var pieSeries2 = chart.series.push(new am4charts.PieSeries());
            pieSeries2.dataFields.value = "bottles";
            pieSeries2.dataFields.category = "country";
            pieSeries2.slices.template.stroke = new am4core.InterfaceColorSet().getFor("background");
            pieSeries2.slices.template.strokeWidth = 1;
            pieSeries2.slices.template.strokeOpacity = 1;
            pieSeries2.slices.template.states.getKey("hover").properties.shiftRadius = 0.05;
            pieSeries2.slices.template.states.getKey("hover").properties.scale = 1;

            pieSeries2.labels.template.disabled = true;
            pieSeries2.ticks.template.disabled = true;


            var label = chart.seriesContainer.createChild(am4core.Label);
            label.textAlign = "middle";
            label.horizontalCenter = "middle";
            label.verticalCenter = "middle";
            label.adapter.add("text", function(text, target){
            return "[font-size:18px]Available[/]:\n[bold font-size:30px]" + pieSeries.dataItem.values.value.sum + "[/]";
            })

        }); // end am4core.ready()
    </script>
    <script>
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv2", am4charts.PieChart);
            chart.startAngle = 160;
            chart.endAngle = 380;

            // Let's cut a hole in our Pie chart the size of 40% the radius
            chart.innerRadius = am4core.percent(40);

            // Add data
            chart.data = [{
            "country": "Cash Cover",
            "litres": 0,
            "bottles": 30000000
            }, {
            "country": "Available",
            "litres": 20000000,
            "bottles": 20000000
            }];

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "litres";
            pieSeries.dataFields.category = "country";
            pieSeries.slices.template.stroke = new am4core.InterfaceColorSet().getFor("background");
            pieSeries.slices.template.strokeWidth = 1;
            pieSeries.slices.template.strokeOpacity = 1;

            // Disabling labels and ticks on inner circle
            pieSeries.labels.template.disabled = true;
            pieSeries.ticks.template.disabled = true;

            // Disable sliding out of slices
            pieSeries.slices.template.states.getKey("hover").properties.shiftRadius = 0;
            pieSeries.slices.template.states.getKey("hover").properties.scale = 1;
            pieSeries.radius = am4core.percent(40);
            pieSeries.innerRadius = am4core.percent(30);

            var cs = pieSeries.colors;
            cs.list = [am4core.color(new am4core.ColorSet().getIndex(0))];

            cs.stepOptions = {
            lightness: -0.05,
            hue: 0
            };
            cs.wrap = false;


            // Add second series
            var pieSeries2 = chart.series.push(new am4charts.PieSeries());
            pieSeries2.dataFields.value = "bottles";
            pieSeries2.dataFields.category = "country";
            pieSeries2.slices.template.stroke = new am4core.InterfaceColorSet().getFor("background");
            pieSeries2.slices.template.strokeWidth = 1;
            pieSeries2.slices.template.strokeOpacity = 1;
            pieSeries2.slices.template.states.getKey("hover").properties.shiftRadius = 0.05;
            pieSeries2.slices.template.states.getKey("hover").properties.scale = 1;

            pieSeries2.labels.template.disabled = true;
            pieSeries2.ticks.template.disabled = true;


            var label = chart.seriesContainer.createChild(am4core.Label);
            label.textAlign = "middle";
            label.horizontalCenter = "middle";
            label.verticalCenter = "middle";
            label.adapter.add("text", function(text, target){
            return "[font-size:18px]Available[/]:\n[bold font-size:30px]" + pieSeries.dataItem.values.value.sum + "[/]";
            })

        }); // end am4core.ready()
    </script>

    {{-- Donut --}}
    <!-- Chart code -->
    <script>
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdivDonut", am4charts.PieChart);

        // Add data
        chart.data = [{
        "LGs": "Bid Bond",
        "Outstanding": 500
        }, {
        "LGs": "Final LGs",
        "Outstanding": 700
        }, {
        "LGs": "Advanced Payment LGs",
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
        rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
        pieSeries.slices.template.fillModifier = rgm;
        pieSeries.slices.template.strokeModifier = rgm;
        pieSeries.slices.template.strokeOpacity = 0.4;
        pieSeries.slices.template.strokeWidth = 0;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";

        }); // end am4core.ready()
    </script>
    <script>
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdivDonut1", am4charts.PieChart);

        // Add data
        chart.data = [{
        "LCs": "Site LCs",
        "Outstanding": 501.9
        }, {
        "LCs": "Deffered LCs",
        "Outstanding": 501.9
        }, {
        "LCs": "CAsh Aganist Documents",
        "Outstanding": 501.9
        }];

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "Outstanding";
        pieSeries.dataFields.category = "LCs";
        pieSeries.innerRadius = am4core.percent(50);
        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;

        var rgm = new am4core.RadialGradientModifier();
        rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
        pieSeries.slices.template.fillModifier = rgm;
        pieSeries.slices.template.strokeModifier = rgm;
        pieSeries.slices.template.strokeOpacity = 0.4;
        pieSeries.slices.template.strokeWidth = 0;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "bottom";

        }); // end am4core.ready()
    </script>
@endsection
