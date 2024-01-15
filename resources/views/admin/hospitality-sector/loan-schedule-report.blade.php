@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>




<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css" />

<style>
tbody td {
		font-weight:600;
		color:black;
	}
	
    .removeHeight * {
        height: 0 !important;
        padding: 6px !important;
        font-size: 0 !important;
    }

      #DataTables_Table_0_filter,
  #DataTables_Table_1_filter,
  #DataTables_Table_2_filter
  #DataTables_Table_3_filter {
        float: left !important;
    }

    div.dt-buttons {
        float: right !important;
    }


    .kt-portlet__body {
        padding-top: 0 !important;
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


    .first-tr[data-report-name="total_due"] td,
    .first-tr[data-report-name="end_balance"] td {
        background-color: #e2effe !important;
    }

</style>

@endsection
@section('sub-header')

<x-main-form-title :id="'main-form-title'" :class="''">{{ __($title) .' - '. $hospitalitySector->getStudyName() . ' - ' . $hospitalitySector->getPropertyName() }}</x-main-form-title>
<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>


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
            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                {{-- @include('intervalTabs') --}}
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body ">
        <div class="tab-content  kt-margin-t-20">
@php
				$originalDates = $dates; 
			@endphp
			
            <!--Begin:: Tab  EGP FX Rate Table -->

            <!--End:: Tab  EGP FX Rate Table -->
            @foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted)
			
			@php
            $dates = sumIntervals($originalDates , $intervalName , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
			 $dates = $hospitalitySector->convertArrayOfStringDatesToStringDatesAndDateIndex($dates,$dateIndexWithDate,$dateWithDateIndex);

            @endphp
			
            <div class="tab-pane {{ $intervalName =='monthly' ? 'active' :'' }}" id="kt_apps_contacts_view_tab_2{{ $intervalName }}" role="tabpanel">

                <table class='table table-striped table-bordered table-hover table-checkable'>
	<thead>
		   <th class="text-center">{{__("Payment No.")}}</th>
                            <th class="text-center">{{__("Date")}}</th>
                            <th class="text-center">{{__("Begining Balance")}}</th>
                            <th class="text-center">{{__("Schedule Payment")}}</th>
                            <th class="text-center">{{__("Interest Amount")}}</th>
                            <th class="text-center">{{__("Principle Amount")}}</th>
                            <th class="text-center">{{__("End Balance")}}</th>
							
	</thead>
	<tbody>
	@php
		$index = 1 ;
	@endphp
		@foreach($loanDates as $date )
		<tr>
			<td>{{ $index }}</td>
			<td>{{ $date  }}</td>
			<td>{{ number_format($fixedAtEndResult['beginning'][$date] ?? 0) }}</td>
			<td>{{ number_format($fixedAtEndResult['schedulePayment'][$date] ?? 0) }}</td>
			<td>{{ number_format($fixedAtEndResult['interestAmount'][$date] ?? 0) }}</td>
			<td>{{ number_format($fixedAtEndResult['principleAmount'][$date] ?? 0) }}</td>
			<td>{{ number_format($fixedAtEndResult['endBalance'][$date] ?? 0) }}</td>
		</tr>
		@php
			$index++;
		@endphp
		@endforeach 
		@if(count($loanDates))
		<tr class="custom-color-for-last-tr">
			<th>{{ __('Total') }}</th>
			<th>-</th>
			<th>-</th>
			<th>-</th>
			<th> {{ number_format($fixedAtEndResult['totals']['totalSchedulePayment'] ?? 0) }} </th>
			<th> {{ number_format($fixedAtEndResult['totals']['totalPrincipleAmount'] ?? 0 )}} </th>
			<th> {{ number_format($fixedAtEndResult['totals']['totalInterestAmount'] ?? 0) }} </th>
		</tr>
		@endif
	</tbody>
</table>



            </div>
            @endforeach





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
        $(".row2" + rowNum + '[data-order="' + order + '"]').toggle();
        $('.row_icon2' + rowNum + '[data-order="' + order + '"]').toggleClass("flaticon2-down flaticon2-up");
        $('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }

</script>
<script>


</script>
@endsection
