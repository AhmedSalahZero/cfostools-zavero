@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css" />

<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
	 #chartdiv2 {
        width: 100%;
        height: 500px;
    }

    .first-tr-bg,
    .first-tr-bg td,
    .first-tr-bg th {
        background-color: #074FA4 !important;
        color: white !important;
    }

    .first-tr th {
        background-color: #e2effe !important;
    }

    .first-tr>* {
        border: 1px solid #CCE2FD !important;
    }

</style>

@endsection
@section('sub-header')

<x-main-form-title :id="'main-form-title'" :class="''">{{ __('S Cruve Chart ') .' - '. $hospitalitySector->getStudyName() . ' - ' . $hospitalitySector->getPropertyName() }}</x-main-form-title>


@endsection
@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <form id="form-id" class="kt-form kt-form--label-right" method="GET" enctype="multipart/form-data" action="{{  isset($disabled) && $disabled ? '#' :  $storeRoute  }}">

                    <input type="hidden" name="hospitality_sector_id" value="{{ $hospitality_sector_id }}">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="font-weight-bold form-label label">Amount</label>
                                <input type="text" class="form-control placeholder-light-gray exclude-text" name="amount" value="{{ $amount }}" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="font-weight-bold form-label label">Duration</label>
                                <input type="text" class="form-control placeholder-light-gray exclude-text" name="duration" value="{{ $duration }}" placeholder="" required>
                            </div>
                        </div>
						
						     <div class="col-md-3">
								<div class="form-group">
									<label for="font-weight-bold form-label label">Third Int</label>
									<input type="text" class="form-control placeholder-light-gray exclude-text" name="third_int" value="{{ $thirdInt }}" placeholder="" required>
								</div>
                      		  </div>  
							  <div class="col-md-3">
								<div class="form-group">
									<label for="font-weight-bold form-label label">Initial Factor</label>
									<input type="text" class="form-control placeholder-light-gray exclude-text" name="initial_factor" value="{{ $initialFactor }}" placeholder="" required>
								</div>
                      		  </div>
						
						@for($i = 0 ;$i<4 ; $i++)
						 <div class="col-md-3">
                            <div class="form-group">
                                <label for="font-weight-bold form-label label">Quarter Factors [{{ $i+1 }}]</label>
                                <input type="text" class="form-control placeholder-light-gray exclude-text" name="quartersFactors[]" value="{{ $quartersFactors[$i] ?? 0 }}" placeholder="" required>
                            </div>
                        </div>
						@endfor 
						@for($i = 0 ; $i<4 ; $i++)
						<div class="col-md-3">
                            <div class="form-group">
                                <label for="font-weight-bold form-label label">Quarter Amount [{{ $i+1 }}]</label>
                                <input readonly type="text" class="form-control placeholder-light-gray exclude-text" value="{{ number_format($sumForEachDuration[$i],0) }}" >
                            </div>
                        </div>
						@endfor 
						
						@for($i = 0 ; $i<4 ; $i++)
						<div class="col-md-3">
                            <div class="form-group">
                                <label for="font-weight-bold form-label label">Quarter % [{{ $i+1 }}]</label>
                                <input readonly type="text" class="form-control placeholder-light-gray exclude-text" value="{{ number_format($amount ? $sumForEachDuration[$i] / $amount *100 : 0  ,2) }}" >
                            </div>
                        </div>
						@endfor 
						

                    </div>
					
					<x-save-or-back :btn-text="__('Create')" />
					
                </form>
            </div>
        </div>
    </div>
</div>
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
            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                        <i class="flaticon2-checking"></i>{{ __('Monthly Report') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body ">
        <div class="tab-content  kt-margin-t-20">

            <!--Begin:: Tab  EGP FX Rate Table -->

            <!--End:: Tab  EGP FX Rate Table -->

            <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">

                <div id="chartdiv"></div>
                <div id="chartdiv2" class="mt-5"></div>



            </div>





            <!--End:: Tab USD FX Rate Table -->
        </div>
    </div>
</div>


@endsection
@section('js')
<x-js.commons></x-js.commons>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
</script>
<script>
    function toggleRow(rowNum) {
        $(".row" + rowNum).toggle();
        $('.row_icon' + rowNum).toggleClass("flaticon2-down flaticon2-up");
        $(".row2" + rowNum).hide();
        $('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }

    function toggleRow2(rowNum, order) {
        console.log(order)
        $(".row2" + rowNum + '[data-order="' + order + '"]').toggle();
        $('.row_icon2' + rowNum + '[data-order="' + order + '"]').toggleClass("flaticon2-down flaticon2-up");
        $('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }

</script>

<script>

    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Add data
        chart.data = @json($sCurveChart);

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


    }); 
	
	
	
	
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end
        // Create chart instance
        var chart2 = am4core.create("chartdiv2", am4charts.XYChart);

        // Add data
        chart2.data = @json($sCurveChartAccumulated);

        // Set input format for the dates
        chart2.dateFormatter.inputDateFormat = "yyyy-MM-dd";

        // Create axes
        var dateAxis = chart2.xAxes.push(new am4charts.DateAxis());
        var valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series2 = chart2.series.push(new am4charts.LineSeries());
        series2.dataFields.valueY = "value";
        series2.dataFields.dateX = "date";
        series2.tooltipText = "{value}"
        series2.strokeWidth = 2;
        series2.minBulletDistance = 15;

        // Drop-shaped tooltips
        series2.tooltip.background.cornerRadius = 20;
        series2.tooltip.background.strokeOpacity = 0;
        series2.tooltip.pointerOrientation = "vertical";
        series2.tooltip.label.minWidth = 40;
        series2.tooltip.label.minHeight = 40;
        series2.tooltip.label.textAlign = "middle";
        series2.tooltip.label.textValign = "middle";

        // Make bullets grow on hover
        var bullet = series2.bullets.push(new am4charts.CircleBullet());
        bullet.circle.strokeWidth = 2;
        bullet.circle.radius = 4;
        bullet.circle.fill = am4core.color("#fff");

        var bullethover2 = bullet.states.create("hover");
        bullethover2.properties.scale = 1.3;

        // Make a panning cursor
        chart2.cursor = new am4charts.XYCursor();
        chart2.cursor.behavior = "panXY";
        chart2.cursor.xAxis = dateAxis;
        chart2.cursor.snapToSeries = series2;

        // Create vertical scrollbar and place it before the value axis
        chart2.scrollbarY = new am4core.Scrollbar();
        chart2.scrollbarY.parent = chart2.leftAxesContainer;
        chart2.scrollbarY.toBack();

        // Create a horizontal scrollbar with previe and place it underneath the date axis
        chart2.scrollbarX = new am4charts.XYChartScrollbar();
        chart2.scrollbarX.series.push(series2);
        chart2.scrollbarX.parent =chart2.bottomAxesContainer;

        dateAxis.start = 0.79;
        dateAxis.keepSelection = true;


    }); 

</script>

@endsection
