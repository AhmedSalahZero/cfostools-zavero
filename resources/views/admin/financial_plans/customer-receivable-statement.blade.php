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

    .kt-portlet__body {
        padding-top: 0 !important;
    }

    #DataTables_Table_0_filter,
    #DataTables_Table_1_filter,
    #DataTables_Table_2_filter #DataTables_Table_3_filter {
        float: left !important;
    }

    div.dt-buttons {
        float: right !important;
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

<x-main-form-title :id="'main-form-title'" :class="''">{{ __(ucfirst($type).' Receivables Statement Report') .' - '. $hospitalitySector->getStudyName() . ' - ' . $hospitalitySector->getPropertyName() }}</x-main-form-title>
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
                @include('intervalTabs')
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
            <div class="tab-pane {{ $intervalName =='monthly' ? 'active' :'' }}" id="kt_apps_contacts_view_tab_2{{ $intervalName }}" role="tabpanel" >
                @foreach(removeTotalTableIfFirstIsZero($salesChannelsNames) as $salesChannelAndTotalName)

                <x-table :tableClass="'kt_table_with_no_pagination_no_fixed removeGlobalStyle '.$intervalName">
                    @slot('table_header')
                    <tr class="first-tr-bg text-center">
                        <th style="text-transform:capitalize;white-space:nowrap;">{{ str_replace(['_','-'],' ',convertZeroToTotalString($salesChannelAndTotalName)) }}</th>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <th class="text-center"> {{ formatDateForView($dateAsString) }}</th>
                        @endforeach
                    </tr>
                    @endslot
                    @slot('table_body')
                    @foreach ($dashboardItems['collectionPoliciesAndReceivableEndBalances']['receivable_end_balance'][$type][$salesChannelAndTotalName]['intervalsReport'][$intervalName] as $reportName=>$datesAndValues)
                    <tr class="first-tr">
                        <th class="text-capitalize text-nowrap ">{{ str_replace(['_','-'],' ',$reportName) }}</th>
                        @foreach($dates as $dateAsString => $dateAsIndex)
                        <td class="text-center">{{ number_format(getValueFromArrayStringAndIndex($datesAndValues,$dateAsString,$dateAsIndex,0) ?? 0,0) }}</td>
                        @endforeach
                    </tr>

                    @endforeach


                    <tr style="visibility:hidden;" class="removeHeight">
                        <td></td>
                        @foreach($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center">0</td>
                        @endforeach
                    </tr>


                    @endslot
                </x-table>
                @endforeach


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

@endsection
