@extends('layouts.dashboard')

@section('css')
<x-styles.commons></x-styles.commons>

<style>

    .kt-portlet__body {
        padding-top: 0 !important;
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

<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Cash In & Out Flow Report') .' - '. $hospitalitySector->getStudyName() . ' - ' . $hospitalitySector->getPropertyName() }}</x-main-form-title>
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
                @foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted)
                <li class="nav-item nav-item-interval-name" data-interval-name="{{ $intervalName }}">
                    <a class="nav-link {{ $intervalName == 'monthly'?'active':'' }}" data-toggle="tab" href="#kt_apps_contacts_view_tab_2{{ $intervalName }}" role="tab">
                        <i class="flaticon2-checking"></i>{{ __($intervalNameFormatted.' Report') }}
                    </a>
                </li>
                @endforeach
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
            <!--Begin:: Tab USD FX Rate Table -->
			@foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted)
			@php
				$interval = $intervalName ;
			@endphp
            @php
            $dates = sumIntervals($originalDates , $intervalName , $hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
            $dates = $hospitalitySector->convertArrayOfStringDatesToStringDatesAndDateIndex($dates,$dateIndexWithDate,$dateWithDateIndex);
            @endphp
            <div class="tab-pane {{ $intervalName =='monthly' ? 'active' :'' }}" id="kt_apps_contacts_view_tab_2{{ $intervalName }}" role="tabpanel">
                <x-table :tableClass="'kt_table_with_no_pagination_no_fixed  removeGlobalStyle '.$intervalName ">
                    @slot('table_header')
                    <tr class=" text-center first-tr-bg">
                        <th class="text-center absorbing-column first-column-width">{{ __('Item Name') }}</th>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        @if($intervalName == 'annually')
                        <th>{{ 'Yr-'.explode('-',$dateAsString)[2] }}</th>
						@else 
                        <th>{{ formatDateForView($dateAsString) }}</th>
						@endif 
                        @endforeach
                    </tr>

                    <tr class=" text-center second-tr-bg ">
                        <th class="text-center absorbing-column first-column-width"></th>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <th></th>
                        @endforeach
                    </tr>
                    @endslot
                    @slot('table_body')

                    @foreach ($reportItems['cashInReport']??[] as $reportName => $reportTotalWithItsSubItemsArray)
					@php
			
						$currentLoopItems = sumIntervals(removeKeyFromArray($reportTotalWithItsSubItemsArray,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
			
			@endphp
                    @php
                    $currentTotal = 0 ;
                    @endphp
                    <tr class="first-tr text-center ">
                        <td class=" text-center first-column-width"><b class="text-capitalize">{{ __($reportName) }}</b></td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
						<td class="text-center">
                            {{ number_format($currentValue =getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0),0) }}
                        </td>
                        @php
                        $currentTotal+=$currentValue
                        @endphp
                        @endforeach

                    </tr>
                    @php
                    $id = 0 ;
                    @endphp

                    @foreach($reportTotalWithItsSubItemsArray['subItems']??[] as $subItemName => $subItemsTotalsAndItesSubItems )
			@php
			
						$currentLoopItems = sumIntervals(removeKeyFromArray($subItemsTotalsAndItesSubItems,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

						@endphp
                    @php
                    $mainRowtotal = 0 ;
                    @endphp
                    <tr class="group-color main-row-tr">

                        <td class="black-text first-column-width" style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                            <div class="d-flex align-items-center ">
                                <i class="row_icon{{ $id }} flaticon2-up  mr-2  "></i>
                                <b class="text-capitalize ">{{ __($subItemName) }}</b>
                            </div>
                        </td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center black-text">
                            {{ number_format(getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0),0) }}
                        </td>
                        @php
                        $mainRowtotal += $currentLoopItems[$dateAsString] ?? 0 ;
                        @endphp
                        @endforeach

                    </tr>

                    @foreach ($subItemsTotalsAndItesSubItems['subItems'] ?? [] as $subName => $subDatesAndValues)
					@php
						$currentLoopItems = sumIntervals(removeKeyFromArray($subDatesAndValues,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
						
						@endphp
                    @php
                    $subItemTotal = 0 ;
                    @endphp



                    <tr class="row{{ $id }}  text-center sub-item-row" style="display: none">
                        {{-- <td></td> --}}
                        <td class="text-left text-capitalize first-column-width"><b class="ml-3">

                                {{ \App\Models\DepartmentExpense::getNameFromId($subName,$hospitalitySector->departmentExpenses,'Total '.explode(' ',$subItemName)[1]) }}
                            </b></td>

                        @foreach ($dates as $dateAsString=>$date)
                        <td class="text-center">
                            {{ number_format($currentValue  =getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)  , 0)}}
							

                        </td>
                        @php
                        $subItemTotal += $currentValue;
                        @endphp
                        @endforeach

                    </tr>



                    @endforeach


                    <?php $id++ ;?>
                    @endforeach
                    @endforeach

                    <tr class=" text-center second-tr-bg second-tr-bg-more-padding">
                        {{-- <th>{{ __('Collapse') }}</th> --}}
                        <th class="text-center absorbing-column first-column-width"></th>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <th></th>
                        @endforeach
                        {{-- <th>   </th> --}}
                    </tr>

                    @foreach ($reportItems['cashOutReport']??[] as $reportName => $reportTotalWithItsSubItemsArray)
					@php
			
				$currentLoopItems = sumIntervals(removeKeyFromArray($reportTotalWithItsSubItemsArray,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
			
			@endphp
                    @php
                    $currentTotal = 0 ;
                    @endphp
                    <tr class="first-tr text-center ">
                        <td class=" text-center first-column-width"><b class="text-capitalize">{{ __($reportName) }}</b></td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center ">
                            {{ number_format($currentValue = getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0) ,0) }}
                        </td>
                        @php
                        $currentTotal+=$currentValue
                        @endphp
                        @endforeach

                    </tr>
                  

                    @foreach($reportTotalWithItsSubItemsArray['subItems']??[] as $subItemName => $subItemsTotalsAndItesSubItems )
	@php
			
						$currentLoopItems = sumIntervals(removeKeyFromArray($subItemsTotalsAndItesSubItems,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

						@endphp
                    @php
                    $mainRowtotal = 0 ;
                    @endphp
                    <tr class="group-color main-row-tr">

                        <td class="black-text first-column-width" style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                            <div class="d-flex align-items-center ">
                                <i class="row_icon{{ $id }} flaticon2-up  mr-2  "></i>
                                <b class="text-capitalize ">{{ __($subItemName) }}</b>
                            </div>
                        </td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
						
                        <td class="text-center black-text">
                            {{ number_format($currentValue = getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0) ,0) }}
                        </td>
                        @php
                        $mainRowtotal += $currentValue ;
                        @endphp
                        @endforeach

                    </tr>

                    @foreach ($subItemsTotalsAndItesSubItems['subItems'] ?? [] as $subName => $subDatesAndValues)
					
						@php
						$currentLoopItems = sumIntervals(removeKeyFromArray($subDatesAndValues,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
						
						@endphp
						
                    @php
                    $subItemTotal = 0 ;
                    @endphp



                    <tr class="row{{ $id }}  text-center sub-item-row" style="display: none">
                        {{-- <td></td> --}}
                        <td class="text-left text-capitalize first-column-width"><b class="ml-3">

                                {{ \App\Models\DepartmentExpense::getNameFromId($subName,$hospitalitySector->departmentExpenses,'Total Collection') }}
                            </b></td>

                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center">
                            {{ number_format($currentValue =getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)    , 0)}}

                        </td>
                        @php
                        $subItemTotal += $currentValue ; 
                        @endphp
                        @endforeach

                    </tr>



                    @endforeach


                    <?php $id++ ;?>
                    @endforeach
                    @endforeach
					
						
						@include('components.tables.table-with-no-sub',[
						'reportData'=>$reportItems['netCash']??[],
						'interval'=>$intervalName
						])










                    @endslot
                </x-table>

            </div>
			@endforeach 



<div class="kt-portlet">
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row ">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6 kt-align-right">
                    <a  href="{{ route('admin.view.hospitality.sector.study.dashboard',[$company->id,$hospitality_sector_id]) }}" class="btn active-style">
					{{ __('Study Dashboard') }} &rarr;
					</a>
                </div>
            </div>
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
      //  $('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }
	
		$(document).on('click','.nav-item-interval-name',function(){
			 const intervalName = $(this).data('interval-name')
			 $('.kt_table_with_no_pagination_no_fixed.'+intervalName).DataTable().columns.adjust().draw()
		})
		

    function toggleRow2(rowNum, order) {

        $(".row2" + rowNum + '[data-order="' + order + '"]').toggle();
        $('.row_icon2' + rowNum + '[data-order="' + order + '"]').toggleClass("flaticon2-down flaticon2-up");
        //$('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }

</script>

@endsection
