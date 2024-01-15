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

{{-- <ul class="kt-menu__nav ">

                <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--left">

                    <ul class="kt-menu__subnav">

                        <li class="kt-menu__item  kt-menu__item--submenu" data-ktmenu-submenu-toggle="hover" aria-haspopup="true"><a href="#" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">{{ __('Income Statement') }}</span><i class="kt-menu__hor-arrow la la-angle-right"></i><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
    <ul class="kt-menu__subnav">
        @foreach(['forecast'=>__('Forecast Dashboard'),'actual'=>__('Actual Dashboard'),'adjusted'=>__('Adjusted Dashboard'),'modified'=>__('Modified Dashboard'),'comparing'=>__('Comparing Dashboard')] as $reportType=>$reportName)
        <li class="kt-menu__item " aria-haspopup="true"><a href="#" class="kt-menu__link "><span class="kt-menu__link-text">{{ $reportName }}</span></a></li>
        @endforeach
    </ul>
</div>
</li>

</ul>
</div>

</ul> --}}

@endsection
@section('sub-header')

<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Ratio Analysis Report') .' - '. $hospitalitySector->getStudyName() . ' - ' . $hospitalitySector->getPropertyName() }}</x-main-form-title>
<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>


@endsection
@section('content')

<div class="kt-portlet kt-portlet--tabs">

    <div class="kt-portlet__body ">
        <div class="tab-content  kt-margin-t-20">

            <table class="table  datatables table  table-bordered table-hover table-checkable kt_table_with_no_pagination_no_fixed income-statement-table">
                {{-- DATES --}}
                <thead>
                    <tr class="first-tr-bg">
                        <th>{{ __('Collapse') }}</th>
                        <th>{{ __('Item') }}</th>
                        <th>{{ __('Description') }}</th>
                        @foreach ($dates as $dateAsString => $dateAsIndex)
                        <th>{{ formatDateForView($dateAsString) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>


                    @foreach ($ratio_analysis_report as $main_name => $main_data)
                    <?php $name_of_fiels = @explode(' ', trim($main_name))[0]; ?>
                    <!-- Total -->
                    <tr class="tr-color main-level-tr">
                        <td style="cursor: pointer;" onclick="toggleRow('{{ $name_of_fiels }}')"><i class="row_icon{{ $name_of_fiels }} fa fa-plus"></i>
                        </td>
                        <td class="align-{{__('left')}}"><b>{{ $main_name }}</b></td>
                        <td></td>
                        @foreach ($view_dates as $key => $date)
                        <td>
                        </td>

                        @endforeach
                    </tr>
                    <!-- Company Expenses -->
                    @foreach ($main_data as $sub_name => $sub_data)

                    <tr class="row{{ $main_name }} sub-level-tr" >
                        <td></td>
                        <td style="text-align: {{__('left')}}"><b>{{ $sub_name }}</b></td>
                        <?php 
                                                    $description = $sub_data['description']?? '-';
                                                    $mark = $sub_data['mark'] ??'';
                                                    $decimals = $sub_data['decimals'] ?? 0;
                                                    $multiplier = $main_name == 'Profitability Ratios' ? 100 : 1;
													if($sub_name == 'Working Capital'){
														$decimals = 0 ;
													}
                                                ?>
                        <td style="text-align: {{__('left')}}"><b>{{ $description ?? "-" }}</b></td>
                        @foreach ($view_dates as $key => $date)
                        <td class="text-nowrap">{{ (isset($sub_data['data'][$date]) ? number_format(($sub_data['data'][$date]*$multiplier),$decimals) : 0 ) }}
                            <span class="text-primary">{{$mark}} </span>
							
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>










<div class="kt-portlet">
    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row ">
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6 kt-align-right">
                    <a href="{{ route('admin.view.hospitality.sector.study.dashboard',[$company->id,$hospitality_sector_id]) }}" class="btn active-style">
                        {{ __('Study Dashboard') }} &rarr;
                    </a>
                </div>
            </div>
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
            $('.row_icon' + rowNum).toggleClass("fa-minus fa-plus");
           $('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }

    $(document).on('click', '.nav-item-interval-name', function() {
        const intervalName = $(this).data('interval-name')
        $('.kt_table_with_no_pagination_no_fixed.' + intervalName).DataTable().columns.adjust().draw()
    })

    function toggleRow2(rowNum, order) {

        $(".row2" + rowNum + '[data-order="' + order + '"]').toggle();
        $('.row_icon2' + rowNum + '[data-order="' + order + '"]').toggleClass("flaticon2-down flaticon2-up");
        //    $('.kt_table_with_no_pagination_no_fixed').DataTable().columns.adjust().draw()

    }

</script>

@endsection
