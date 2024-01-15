@php
$tableId = 'kt_table_1';
@endphp

<style>

    .color-active {
        color: #366cf3 !important;
        font-weight: bold !important;
    }

    .btn-pricing-plan {
        width: 60%;
    }

    .btn-pricing-plan form>div:first-of-type {
        flex: 1;
    }

    .btn-pricing-plan>span,
    .btn-pricing-plan form {
        display: flex;
        align-items: center;
        gap: 35px;
    }

    .btn-pricing-plan form {
        flex: 1;
    }

    .btn.btn-secondary.btn-pricing-plan:hover {
        background-color: transparent !important;
        border: 1px solid #e2e5ec !important;
    }

    #test_filter,
    #kt_table_1_filter {
        display: none !important;
    }



    .max-w-80 {
        width: 80% !important;
    }

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



    body .table-active,
    .table-active>th,
    .table-active>td {
        background-color: white !important
    }

    #DataTables_Table_0_filter {
        float: left !important;
    }

    #DataTables_Table_1_filter {
        float: left !important;
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
<style>
    td.details-control {
        background: url('{{asset('tables_imgs/details_open.png')}}') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('{{asset('tables_imgs/details_close.png')}}') no-repeat center center;
    }

</style>

<style>
    table:not(.exclude-table) tbody tr:not(.table-active):not(.active-style):not(.is-rate):not(.is-sub-row):not(.group-color)>td:not(.dtfc-fixed-left):not(.active-style) {
        color: black !important;
        font-weight: bold !important;
    }

    .dt-buttons.btn-group {
        display: flex;
        align-items: flex-start;
        justify-content: flex-end;
        margin-bottom: 1rem;
    }

    .btn-border-radius {
        border-radius: 10px !important;
    }

</style>
<div class="table-custom-container position-relative  ">

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar justify-content-between flex-grow-1">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ !Request('active') || Request('active') == 'pricing-plans' ?'active':'' }}" data-toggle="tab" href="#pricing-plans" role="tab">
                            <i class="fa fa-money-check-alt"></i> {{ __('Pricing Plans Table') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request('active') == 'quick-price-calculator' ? 'active':''  }}" data-toggle="tab" href="#quick-price-calculator" role="tab">
                            <i class="fa fa-money-check-alt"></i> {{ __('Quick Pricing Calculators Table') }}
                        </a>
                    </li>


                </ul>

                {{-- <a href="{{route('create.money.receive',['company'=>$company->id])}}" class="btn active-style btn-icon-sm align-self-center">
                <i class="fas fa-plus"></i>
                {{ __('New Record') }}
                </a> --}}
                {{-- <a href="" class="btn  active-style btn-icon-sm  align-self-center ">
				<i class="fas fa-plus"></i>
				<span>{{ __('New Record') }}</span>
                </a> --}}
            </div>
        </div>
    </div>
    <div class="tab-content  kt-margin-t-20">
        <div class="tab-pane {{ !Request('active') || Request('active') == 'pricing-plans' ?'active':'' }}" id="pricing-plans" role="tabpanel">

            <x-table :tableClass="'kt_table_with_no_pagination_no_fixed_custom_create_btn  removeGlobalStyle ' ">
                @slot('table_header')
                <tr class=" text-center second-tr-bg">
                    <th class="text-center absorbing-column max-w-80"></th>
                    <th></th>
                </tr>
                @endslot
                @slot('table_body')
                <tr class=" text-center first-tr-bg ">
                    <td class="max-w-80 text-center"><b class="text-capitalize text-white">{{ __('Name') }}</b></td>


                    <td class="text-center text-white" style="color:white !important;">
                        {{ __('Actions') }}
                    </td>
                </tr>
                @php
                $id = 0 ;
                @endphp
                @foreach($items as $mainItemId => $mainItemData )

                <tr class="group-color main-row-tr">
                    <td class="black-text max-w-80" style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">

                        <div class="d-flex align-items-center ">
                            @if(isset($mainItemData['sub_items'])&&count($mainItemData['sub_items']))
                            <i class="row_icon{{ $id }} flaticon2-up  mr-2  "></i>
                            @endif
                            {{-- <b class="text-capitalize ">{{ $mainItemData['data']['name'] }}</b> --}}
                            <b class="text-capitalize ">{{ $mainItemData['data']['name'] }}</b>
                        </div>
                    </td>


                    <td class="text-left text-capitalize"><b class="ml-3">
                            <span style="overflow: visible; position: relative; width: 110px;">
                                <a type="button" class="btn btn-secondary color-active " title="{{ __('Start Pricing') }}" href="{{ route('admin.create.quick.pricing.calculator', ['company'=>$company->id , 'pricingPlanId'=> $mainItemData['data']['id'] ]) }}">{{ __('Start Pricing') }}</a>
                                <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" data-toggle="modal" data-target="#modal-1-edit-{{ $mainItemData['data']['id'] }}" title="Edit" href="{{ route('pricing-plans.edit', ['company'=>$company->id , 'pricing_plan'=>$mainItemData['data']['id']]) }}"><i class="fa fa-pen-alt"></i></a>
                                <a class="btn btn-secondary btn-outline-hover-danger btn-icon  " href="#" data-toggle="modal" data-target="#modal-1-delete-{{ $mainItemData['data']['id'] }}" title="Delete"><i class="fa fa-trash-alt"></i>
                                </a>

                                <div id="modal-1-edit-{{ $mainItemData['data']['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ __('Edit Pricing Plan ' .$mainItemData['data']['name']) }}</h4>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                            <form action="{{ route('pricing-plans.update',['company'=>$company->id , 'pricing_plan'=> $mainItemData['data']['id'] ]) }}" method="post" id="delete_form">
                                                <div class="container">
												<div class="row">
                                                    <div class="col-md-6">
                                                        <label for="edit_pricing_plan_namd" class="form-label font-weight-bold"> {{ __('Name') }}</label>
                                                        <input type="text" class="form-control exclude-text" name="name" value="{{ $mainItemData['data']['name'] }}">
                                                    </div>
                                                </div>
												</div>
                                                {{ csrf_field() }}
                                                @method('put')
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary">
                                                        {{ __('Update') }}
                                                    </button>
                                                    <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">
                                                        {{ __('Close') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="modal-1-delete-{{ $mainItemData['data']['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ __('Delete Pricing Plan ' .$mainItemData['data']['name']) }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h3>{{ __('Are You Sure To Delete Pricing Plan With Its All Quick Pricing Calculators ? ') }}</h3>
                                            </div>
                                            <form action="{{ route('pricing-plans.destroy',['company'=>$company->id , 'pricing_plan'=> $mainItemData['data']['id'] ]) }}" method="post" id="delete_form">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger">
                                                        {{ __('Delete') }}
                                                    </button>
                                                    <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">
                                                        {{ __('Close') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </span>
                        </b></td>






                </tr>
                @foreach ($mainItemData['sub_items'] ?? [] as $subItemId => $subItemArr)
                <tr class="row{{ $id }}  text-center sub-item-row" style="display: none">
                    <td class="text-center max-w-80 text-capitalize"><b class="ml-3">
                            {{-- {{ __('Equal To Delete ') }} --}}
                            {{-- {{ $subItemArr['name'] }} --}}
                            <table class="table table-striped- table-bordered table-hover table-checkable  ">
                                <tr>
                                    <td>{{ __('Name') }}</td>
                                    <td>{{ $subItemArr['name'] }}</td>
                                    <td>{{ __('Service Item') }}</td>
                                    <td>{{ $subItemArr['service_item_name'] }}</td>
                                    <td>{{ __('Count Or Days') }}</td>
                                    <td>{{ $subItemArr['count_or_days'] }}</td>
                                    <td>{{ __('Count Or Days') }}</td>
                                    <td>{{ $subItemArr['count_or_days'] }}</td>
                                </tr>

                                <tr>

                                    <td>{{ __('Total Recommend Withhout Vat') }}</td>
                                    <td>{{ $subItemArr['total_recommended_without_vat_formatted'] }}</td>
                                    <td>{{ __('Total Net Profit After Taxes Amount') }}</td>
                                    <td>{{ $subItemArr['total_net_profit_after_taxes_formatted'] }}</td>
                                    <td>{{ __('Total Net Profit After Taxes Percentage') }}</td>
                                    <td>{{ $subItemArr['total_net_profit_after_taxes_percentage_formatted'] }}</td>
                                </tr>

                            </table>


                        </b></td>
                    <td class="text-left text-capitalize"><b class="ml-3">
                            <span style="overflow: visible; position: relative; width: 110px;">
                                <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href="{{ route('admin.edit.quick.pricing.calculator', ['company'=>$company->id , 'quickPricingCalculator'=>$subItemArr['id']]) }}"><i class="fa fa-pen-alt"></i></a>
                                <a class="btn btn-secondary btn-outline-hover-danger btn-icon  " href="#" data-toggle="modal" data-target="#modal-delete-{{ $subItemArr['id']}}" title="Delete"><i class="fa fa-trash-alt"></i>
                                </a>
                                <div id="modal-delete-{{ $subItemArr['id'] }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">{{ __('Delete Quick Price Calculator ' .$subItemArr['name']) }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h3>{{ __('Are You Sure To Delete This Item ? ') }}</h3>
                                            </div>
                                            <form action="{{ route('admin.delete.quick.pricing.calculator',['company'=>$company->id , 'quickPricingCalculator'=> $subItemArr['id'] ]) }}" method="post" id="delete_form">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger">
                                                        {{ __('Delete') }}
                                                    </button>
                                                    <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">
                                                        {{ __('Close') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </span>
                        </b></td>
                </tr>
                @endforeach
                <?php $id++ ;?>
                @endforeach
                @endslot
            </x-table>

        </div>
        <div class="tab-pane {{  Request('active') == 'quick-price-calculator' ?'active':'' }}" id="quick-price-calculator" role="tabpanel">
            <x-tables.basic-view class="position-relative  main-table-class" id="{{ $tableId }}">
                <x-slot name="filter">
                    @include('admin.quick-pricing-calculator.filter' , [
                    'type'=>'filter'
                    ])
                </x-slot>

                <x-slot name="export">
                    @include('admin.quick-pricing-calculator.export' , [
                    'type'=>'export'
                    ])
                </x-slot>


                <x-slot name="headerTr">
                    <tr class="header-tr " data-model-name="{{ $modelName }}">
                        @if($hasChildRows)
                        {{-- <th class="view-table-th header-th trigger-child-row-1" >
                {{ __('Expand') }}
                        </th> --}}
                        @endif

                        <th class="view-table-th header-th" data-db-column-name="id" data-is-relation="0" class="header-th" data-is-json="0">
                           -
                        </th>
						           <th class="view-table-th header-th" data-db-column-name="id" data-is-relation="0" class="header-th" data-is-json="0">
                            {{ __('#') }}
                        </th>
                        <th class="view-table-th header-th" data-db-column-name="name" data-is-relation="0" class="header-th" data-is-json="0">
                            {{ __('Name') }}
                        </th>

                        <th class="view-table-th header-th" data-db-column-name="name" data-relation-name="RevenueBusinessLine" data-is-relation="1" class="header-th" data-is-json="0">
                            {{ __('Business Line') }}
                        </th>

                        <th class="view-table-th header-th" data-db-column-name="name" data-relation-name="ServiceCategory" data-is-relation="1" class="header-th" data-is-json="0">
                            {{ __('Service Category') }}
                        </th>

                        <th class="view-table-th header-th" data-db-column-name="name" data-relation-name="ServiceItem" data-is-relation="1" class="header-th" data-is-json="0">
                            {{ __('Service Item') }}
                        </th>

                        <th data-db-column-name="delivery_days" data-is-relation="0" data-relation-name="" class="header-th view-table-th" data-is-json="0">
                            {!! __('Count Or Days') !!}
                        </th>

                        <th data-db-column-name="total_recommend_price_without_vat" data-is-relation="0" data-relation-name="" class="header-th view-table-th" data-is-json="0">
                            {!! __('Total Recommend <br> Price Without VAT') !!}
                        </th>
                        <th data-db-column-name="total_recommend_price_with_vat" data-is-relation="0" data-relation-name="" class="header-th view-table-th" data-is-json="0">
                            {!! __('Total Recommend <br> Price With VAT') !!}
                        </th>
                        <th data-db-column-name="total_net_profit_after_taxes" data-is-relation="0" data-relation-name="" class="header-th view-table-th" data-is-json="0">
                            {!! __('Total Net Profit <br> After Taxes') !!}
                        </th>

                        <th class="view-table-th header-th" data-db-column-name="name" data-is-relation="1" data-relation-name="creator" class="header-th" data-is-json="0">
                            {{ __('Creator Name') }}
                        </th>
                        <th class="view-table-th header-th" data-db-column-name="created_at" data-is-relation="0" class="header-th" data-is-json="0">
                            {{ __('Created At') }}
                        </th>
                        {{--
            <th class="view-table-th header-th" data-db-column-name="updated_at" data-is-relation="0"  class="header-th" data-is-json="0">
                {{ __('Update At') }}
                        </th> --}}


                        <th class="view-table-th" class="header-th">
                            {{ __('Actions') }}
                        </th>
                    </tr>

                </x-slot>

                <x-slot name="js">
                    <script>
                        window.addEventListener('DOMContentLoaded', function() {
                            (function() {
                                // Add event listener for opening and closing details
                                $(document).on('click', '.trigger-child-row-1', function() {
                                    var table = $(this).closest('table').DataTable();
                                    var tr = $(this).closest('tr');

                                    var row = table.row(tr);

                                    if (row.child.isShown()) {
                                        // This row is already open - close it
                                        row.child.hide();
                                        tr.removeClass('shown');
                                        $('#maintable-1-row-class' + row.data().id).closest('tbody').find('.subtable-1-class').DataTable().destroy();

                                    } else {
                                        modelName = 'ServiceCategory';
                                        // Open this row
                                        window['row_' + row.data().id] = row.data();
                                        dd = formatsubrow1(row.data());
                                        row.child(dd).show();
                                        var data = [];
                                        row.data().serviceCategories.forEach(function(item) {
                                            // do not change [1] index of item.id
                                            serviceCategoryId = item.id;
                                            mainRowId = row.data().id;
                                            data.push([mainRowId, serviceCategoryId, getExpandAndCollpaseIcon(), item.name, ` <a data-model-name="${modelName}" data-table-id="subtable-level-1-id" data-record-id="${serviceCategoryId}"   class="btn btn-sm btn-clean  delete-record-btn btn-icon btn-icon-md" title="{{ __('Delete') }}"><i class="la la-trash"></i></a>`])
                                        })
                                        $('#subtable-1-id' + row.data().id).DataTable({
                                            dom: 't'
                                            , "processing": false
                                            , "ordering": false
                                            , "serverSide": false
                                            , "responsive": true
                                            , "pageLength": 88888
                                            , createdRow: function(row, data, dataIndex, cells) {
                                                $(row).addClass('subtable-1-row-class' + (data[0]));
                                                $(cells).filter(".editable").attr('contenteditable', true).attr('data-is-relation', 1)
                                                    .attr('data-db-column-name', 'name').attr('data-relation-name', "serviceCategories")
                                                    .attr('data-is-collection-relation', 1).attr('data-collection-item-id', data[1])
                                                    .attr('data-model-name', 'RevenueBusinessLine').attr('data-model-id', data[0])
                                                    .attr('data-table-id', "{{$tableId}}");
                                            }
                                            , columnDefs: [{
                                                target: [0, 1]
                                                , visible: false
                                            }]
                                            , columns: [
                                                null
                                                , null
                                                , null
                                                , {
                                                    className: 'trigger-child-row-2'
                                                }
                                                , {
                                                    className: 'editable'
                                                }
                                                , null
                                                , null
                                                , null
                                                , null
                                                , {
                                                    className: 'second-subrow-last-td'
                                                }
                                            , ]
                                            , "data": data
                                        , });

                                        tr.addClass('shown');
                                    }
                                })



                                function formatsubrow1(d) {
                                    // `d` is the original data object for the row
                                    let subtable = `<table id="subtable-1-id${d.id}" class="subtable-1-class table table-striped- kt_table_with_no_pagination table-bordered table-hover table-checkable dataTable no-footer" > <thead style="display:none"><tr><td></td> <td></td> <td></td> <td></td><td></td></tr> </thead> `;

                                    subtable += '</table>';

                                    return (subtable);
                                }

                                "use strict";
                                var KTDatatablesDataSourceAjaxServer = function() {

                                    var initTable1 = function() {
                                        var tableId = '#' + "{{ $tableId }}";

                                        var table = $(tableId);
                                        // begin first table
                                        table.DataTable({


                                                dom: 'Bfrtip',
                                                // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                                                "ajax": {
                                                    "url": "{{ $getDataRoute }}"
                                                    , "type": "GET"
                                                    , "dataSrc": "data", // they key in the jsom response from the server where we will get our data
                                                    "data": function(d) {
                                                        // tableId +'_filter'+ ' label input'
                                                        d.search_input = $(getSearchInputSelector(tableId)).val();
                                                        d.service_category_id = $('#filter_service_category_id').val();
                                                        d.revenue_business_line_id = $('#filter_revenue_business_line_id').val();
                                                        d.service_item_id = $('#filter_service_item_id').val();
                                                    }

                                                }
                                                , "processing": false
                                                , "ordering": false
                                                , "serverSide": true
                                                , "responsive": true
                                                , "pageLength": 25
                                                , "columns": [
													{
                                                        render: function(d, b, row) {
                                                            return `<input style="width:20px;height:20px" class="form-control checkbox delete-multi-class " type="checkbox" value="${row.id}" >`
                                                        }
                                                        , data: 'order'
                                                        , className: ''
                                                    },
													{
                                                        data: 'order'
                                                        , searchable: false
                                                        , orderable: false
                                                    }
                                                    , {
                                                        data: 'name'
                                                        , searchable: false
                                                        , orderable: false
                                                    }
                                                    , {
                                                        render: function(d, b, row) {
                                                            return row['revenueBusinessLineName']
                                                        }
                                                        , data: 'order'
                                                        , className: 'editable'
                                                    },

                                                    {
                                                        render: function(d, b, row) {
                                                            // return " " ;
                                                            return row['serviceCategoryName']
                                                        }
                                                        , data: 'order'
                                                        , className: 'editable'
                                                    },

                                                    {
                                                        render: function(d, b, row) {
                                                            return row['serviceItemName']
                                                        }
                                                        , data: 'order'
                                                        , className: 'editable'
                                                    }
                                                    , {
                                                        data: 'delivery_days'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: "text-center"
                                                    }
                                                    , {
                                                        data: 'totalRecommendPriceWithoutVatFormatted'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: "text-center"
                                                    }
                                                    , {
                                                        data: 'totalRecommendPriceWithVatFormatted'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: "text-center"
                                                    }
                                                    , {
                                                        data: 'totalNetProfitAfterTaxesFormatted'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: "text-center"
                                                    }
                                                    , {
                                                        data: 'creator_name'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: "text-center"
                                                    }
                                                    , {
                                                        data: 'created_at_formatted'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: 'text-nowrap'
                                                    }
                                                    // , 
                                                    // {
                                                    //     data: 'updated_at_formatted'  , searchable: false
                                                    //     , orderable: false
                                                    // }
                                                    , {
                                                        data: 'id'
                                                        , searchable: false
                                                        , orderable: false
                                                        , className: "text-center",


                                                        render: function(d, b, row) {
                                                            return `
                    <a data-toggle="modal" data-target="#sharing_link_model_${row.id}" data-model-name="{{$modelName}}" data-table-id="${tableId.replace('#','')}" data-record-id="${row.id}"   class="btn btn-sm btn-clean cursor-pointer btn-icon btn-icon-md" title="{{ __('Share') }}">
                           <i class="la la-share icon-lg"></i>
                        </a>

                        <a href="/` + $('body').data('lang') + '/' + $('body').data('current-company-id') + `/quick-pricing-calculator/${row.id}/edit"  data-id="${row.id}" data-model-name="{{$modelName}}" class="btn btn-sm cursor-pointer btn-clean btn-icon btn-icon-md" title="{{ __('Edit') }}">
                          <i class="la la-edit icon-lg"></i>
                        </a>
                          

                        <a data-model-name="{{$modelName}}" data-table-id="${tableId.replace('#','')}" data-record-id="${row.id}"   class="btn btn-sm btn-clean delete-record-btn btn-icon btn-icon-md" title="{{ __('Delete') }}">
                          <i class="la la-trash icon-lg"></i>
                        </a>

                        `

                                                            ;
                                                        }
                                                    }
                                                ]
                                                , columnDefs: [{
                                                    targets: 0
                                                    , defaultContent: 'salah'
                                                    , className: 'red reset-table-width'
                                                }]
                                                , buttons: [{
                                                        "text": '<span class="delete-class">×</span>' + "{{ __('Delete Selected') }}"
                                                        , 'className': 'btn btn-bold btn-danger delete-select-js mr-2 flex-grow-0 btn-border-radius '
                                                        , "action": function() {
                                                         //   window.location.href = "{{ $createRoute }}"
                                                        }
                                                    },
													{
                                                        "text": '<span class="plus-class">+</span>' + "{{ __('Create') }}"
                                                        , 'className': 'btn btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius mr-auto'
                                                        , "action": function() {
                                                            window.location.href = "{{ $createRoute }}"
                                                        }
                                                    }
                                                    , {
                                                        "attr": {
                                                            'data-table-id': tableId.replace('#', ''),
                                                            // 'id':'test'
                                                        }
                                                        , "text": '<svg style="margin-right:10px;position:relative;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"/><path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" id="Shape" fill="#000000" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/></g></svg>' + '{{ __("Shareable Links") }}'
                                                        , 'className': 'btn btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius do-not-close-when-click-away'
                                                        , "action": function() {
                                                            window.location.href = "{{ route('sharing-links.index',getCurrentCompanyId() ) }}"
                                                        }
                                                    }
                                                    , {
                                                        "attr": {
                                                            'data-table-id': tableId.replace('#', ''),
                                                            // 'id':'test'
                                                        }
                                                        , "text": '<svg style="margin-right:10px;position:relative;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" id="Path-33" fill="#000000"/></g></svg>' + '{{ __("Filter") }}'
                                                        , 'className': 'btn btn-bold btn-secondary ml-2 filter-table-btn  flex-1 flex-grow-0 btn-border-radius do-not-close-when-click-away'
                                                        , "action": function() {
                                                            $('#filter_form-for-' + tableId.replace('#', '')).toggleClass('d-none');
                                                        }
                                                    }
                                                    , {
                                                        "text": '<svg style="margin-right:10px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z" id="Path-103" fill="#000000" fill-rule="nonzero" opacity="0.3"/><rect id="Rectangle" fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="2" width="2" height="12" rx="1"/><path d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z" id="Path-104" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) "/></g></svg>' + '{{ __("Export") }}'
                                                        , 'className': 'btn btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius ml-2 do-not-close-when-click-away'
                                                        , "action": function() {
                                                            $('#export_form-for-' + tableId.replace('#', '')).toggleClass('d-none');
                                                        }
                                                    },

                                                ]
                                                , createdRow: function(row, data, dataIndex, cells) {
                                                    $(row).addClass('edit-info-row').attr('data-model-id', data.id).attr('data-model-name', '{{ $modelName }}');
                                                    $(cells).filter(".editable").attr('contenteditable', true);
                                                    $(row).append(`
                    <!-- Modal -->
		<div class="modal fade" id="sharing_link_model_${data.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
		<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Shareable Link') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="sharable-form-id-${data.id}" data-shareable-type="{{ $modelName }}"  data-shareable-id="${data.id}" class="create-shareable-link">
            <label class="form-label"> {{ __('Add the name you want to share this record with') }} </label>
            <input class="form-control mb-3" name="user_name" type="text" placeholder="{{ __('Name') }}">
            <label class="form-label"> {{ __('Link') }}  </label>
            <input class="form-control shareable-field-value copyableField" name="link" value="" readonly>

       
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
			<button data-shareable-id="${data.id}" type="button" class="btn btn-primary submit-modal-class shareable-btn">{{ __('Generate Link') }}</button>
		</div>

      
      </div>
      
      </form>
		</div>
		</div>
			</div>
                    `)

                                                }
                                                , drawCallback: function(settings) {
                                                    reinitializeSelect2();
                                                }



                                            }

                                        );
                                    };

                                    return {

                                        //main function to initiate the module
                                        init: function() {
                                            initTable1();
                                        },

                                    };

                                }();

                                jQuery(document).ready(function() {
                                    KTDatatablesDataSourceAjaxServer.init();
                                });
                            })(jQuery);
                        });

                        function getSearchInputSelector(tableId) {
                            return tableId + '_filter' + ' label input';
                        }

                    </script>
                </x-slot>
                @push('js')

                <script>
                    $(function() {
                        $(document).on('click', '.submit-modal-class:not(.copy-btn)', function(e) {
                            $('.submit-modal-class').prop('disabled', true);
                            e.preventDefault();

                            const formData = {
                                user_name: $(this).closest('form').find('input[name="user_name"]').val()
                                , shareable_id: $(this).closest('form').data('shareable-id')
                                , shareable_type: $(this).closest('form').data('shareable-type')
                            }

                            $.ajax({
                                url: "{{ route('sharing-links.store' , getCurrentCompanyId()) }}"
                                , type: 'post',

                                data: formData
                                , success: function(res) {
                                    $('.submit-modal-class').prop('disabled', false);
                                    $('#sharable-form-id-' + res.shareable_id).find('.shareable-field-value').val(res.link);
                                    $('.submit-modal-class[data-shareable-id="' + res.shareable_id + '"]').html("{{ __('Copy') }}").addClass('copy-btn');

                                }
                                , error: function() {
                                    $('.submit-modal-class').prop('disabled', false);
                                }
                            });
                        });
                    })

                </script>
                @endpush
            </x-tables.basic-view>
        </div>
    </div>


</div>

@section('js')
<script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
{{-- <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"> --}}
</script>

<script>
    $(document).on('click', '#delete-btn', function() {
        $('#delete_form').attr('action', $(this).data('url'));
    });

    function toggleRow(rowNum) {
        $(".row" + rowNum).toggle();
        $('.row_icon' + rowNum).toggleClass("flaticon2-down flaticon2-up");
        $(".row2" + rowNum).hide();
    }


    var table = $('.kt_table_with_no_pagination_no_fixed_custom_create_btn');
    // table.fixedHeader.adjust();
    // begin first table
    table.DataTable({
        scrollY: true
        , scrollX: true
        , search: false
        , pageLength: 100
        , scrollCollapse: true
        , header: true,



        paging: false,

        paging: false
        , ordering: false
        , dom: 'Bfrtip',

        buttons: [{
                "text": '<div ><span class="plus-class">+</span>' + "{{ __('Create') }}</div> <form><div><input type='text' class='form-control' id='pricing-plan-input-js' name='name'>  </div> <div><button type='submit'  class='btn btn-bold active-style  btn-pricing-plan-inisde flex-1 flex-grow-0  btn-border-radius'>Save</button></div></form>   "
                , 'className': 'btn btn-pricing-plan btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius mr-auto'
                , "action": function() {
                    //window.location.href = "{{ route('pricing-plans.create',['company'=>$company->id]) }}"
                }
            }
            , {
                "attr": {
                    'data-table-id': 'test',
                    // 'id':'test'
                }
                , "text": '<svg style="margin-right:10px;position:relative;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" id="Path-33" fill="#000000"/></g></svg>' + '{{ __("Filter") }}'
                , 'className': 'btn btn-bold btn-secondary ml-2 filter-table-btn  flex-1 flex-grow-0 btn-border-radius do-not-close-when-click-away'
                , "action": function() {
                    $('#filter_form-for-' + 'test').toggleClass('d-none');
                }
            }
            , {
                "text": '<svg style="margin-right:10px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z" id="Path-103" fill="#000000" fill-rule="nonzero" opacity="0.3"/><rect id="Rectangle" fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="2" width="2" height="12" rx="1"/><path d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z" id="Path-104" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) "/></g></svg>' + '{{ __("Export") }}'
                , 'className': 'btn btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius ml-2 do-not-close-when-click-away'
                , "action": function() {
                    $('#export_form-for-' + 'test').toggleClass('d-none');
                }
            },

        ]
    });

    $(document).on('click', '.btn-pricing-plan-inisde', function(e) {
        e.preventDefault();
        const value = $('#pricing-plan-input-js').val();
        if (value) {
            $.ajax({
                url: "{{ route('pricing-plans.store',['company'=>$company->id]) }}"
                , data: {
                    name: value
                , }
                , type: "POST"
                , success: function(res) {
                    window.location.href = "{{ route('admin.view.quick.pricing.calculator',['company'=>$company->id , 'active'=>'pricing-plans']) }}";
                }
            })
        }
    })
	
	$(document).on('click','.delete-select-js',function(e){
		e.preventDefault();
		const checkboxLength = $('.delete-multi-class:checked').length;
		const ids = [] ;
		$('.delete-multi-class:checked').each(function(index,checkbox){
			ids.push($(checkbox).val());
		})
		
		
		if(checkboxLength){
			Swal.fire({
				text:"Delete Selected Items" ,
				icon:"error",
				confirmButtonText: "Delete",
				denyButtonText: `Cancel`,
				showCancelButton: true,
			}).then(function(){
				$.ajax({
					url:"{{ route('delete.multi',['company'=>$company->id]) }}",
					data:{
						"ids":ids
					},
					type:"DELETE"
				}).then(function(res){
					window.location.href= res.link ; 
				})
			})
		}else{
			Swal.fire({
				text:"No Items Selected" ,
				icon:"warning",
			})
		}
	})

</script>

@endsection
