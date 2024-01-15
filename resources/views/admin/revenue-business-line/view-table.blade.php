@php
$tableId = 'kt_table_1';
@endphp


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css" />

<style>
.removeContainer{
	background-color:transparent !important ;
	box-shadow:none !important;
}
.removePadding{
	padding:0 !important;	
	
}
    #test_filter {
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


    <div style="padding-top:20px">
        <a href="{{ route('revenue-business.create',['company'=>$company->id]) }}" class="btn btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius mr-auto">
            <span class="plus-class">+</span>{{ __('Create') }}
        </a>
    </div>
    <x-table  :tableClass="'kt_table_with_no_pagination_no_fixed main-table-class removetableContainer  removeGlobalStyle ' ">
        @slot('table_header')
			
			 <tr class=" text-center first-tr-bg ">
            <td class=" text-center"><b class="text-capitalize">{{ __('Expand') }}</b></td>
            <td data-is-collection-relation="0" data-collection-item-id="1" data-db-column-name="name" data-relation-name="BussinessLineName" data-is-relation="1" data-is-json="0" class="text-center header-th max-w-80">
                {{ __('Name') }}
            </td>
            <td class=" text-center"><b class="text-capitalize">{{ __('Actions') }}</b></td>
        </tr>
		
        {{-- <tr class=" text-center second-tr-bg">
            <th class="text-center absorbing-column "></th>
            <th class="max-w-80"></th>
            <th></th>
        </tr> --}}
        @endslot
        @slot('table_body')
        {{-- <tr class=" text-center first-tr-bg ">
            <td class=" text-center"><b class="text-capitalize">{{ __('Expand') }}</b></td>
            <td data-is-collection-relation="0" data-collection-item-id="1" data-db-column-name="name" data-relation-name="BussinessLineName" data-is-relation="1" data-is-json="0" class="text-center header-th max-w-80">
                {{ __('Name') }}
            </td>
            <td class=" text-center"><b class="text-capitalize">{{ __('Actions') }}</b></td>
        </tr> --}}
        @php
        $id = 0 ;
        @endphp
        @foreach($items as $mainId => $mainItemArr )

        <tr class="group-color main-row-tr" data-model-id="{{ $mainId }}" data-model-name="RevenueBusinessLine">
            <td class="black-text " style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                <div class="d-flex align-items-center ">
                    @if(count($mainItemArr['sub_items'] ?? []))
                    <i class="row_icon{{ $id }} flaticon2-up  mr-2  "></i>

                    @endif
                    <b class="text-capitalize"> </b>
                </div>
            </td>


            <td class=" max-w-80 editable" contenteditable="true" title="{{ __('Click To Edit The Name') }}">
                {{ $mainItemArr['data']['name'] }}
            </td>
            <td>
                <span style="overflow: visible; position: relative; width: 110px;">
                    {{-- <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href="{{ route('revenue-business.edit', ['company'=>$company->id , 'revenue_business'=>$thirdSubId]) }}"><i class="fa fa-pen-alt"></i></a> --}}
                    <a class="btn btn-secondary btn-outline-hover-danger btn-icon  " href="#" data-toggle="modal" data-target="#modal-delete-revenue-bussines-line-{{ $mainId}}" title="Delete"><i class="fa fa-trash-alt"></i>
                    </a>
                    <div id="modal-delete-revenue-bussines-line-{{ $mainId }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">{{ __('Delete Revenue Business Line ' .$mainItemArr['data']['name']) }}</h4>
                                </div>
                                <div class="modal-body">
                                    <h3>{{ __('Are You Sure To Delete Revenue Business Line With Its Items ? ') }}</h3>
                                </div>
                                <form action="{{ route('admin.delete.revenue.business.line',['company'=>$company->id,'revenueBusinessLine'=>$mainId ]) }}" method="post" id="delete_service_category">
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
                </b>

            </td>
        </tr>
        @php
        $order = 1 ;
        @endphp
        @foreach ($mainItemArr['sub_items'] ?? [] as $subItemId => $subItemArr)
        {{-- @if($subItemIndex != 'sub_items') --}}
        <tr data-model-id="{{ $subItemId }}" data-model-name="ServiceCategory" class="row{{ $id }}  text-center sub-item-row" style="display: none">
            <td data-order="{{ $order }}" class="black-text " style="cursor: pointer;" onclick="toggleRow2('{{ $id }}','{{ $order }}')">
                <div class="d-flex align-items-center ">
                    <i data-order="{{ $order }}" class="row_icon2{{ $id }} flaticon2-up  mr-2  ml-3"></i>
                    <b class="text-capitalize ">{{ __('Category') }}</b>
                </div>
            </td>
            <td class="text-left text-capitalize editable " title="{{ __('Click To Edit The Name') }}" contenteditable="true" data-db-column-name="name" data-is-relation="0" data-model-id="{{ $subItemId }}" data-model-name="ServiceCategory">
                {{ $subItemArr['data']['name'] }}
            </td>
            <td>
                <b class="ml-3">
                    <span style="overflow: visible; position: relative; width: 110px;">
                        {{-- <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href="{{ route('revenue-business.edit', ['company'=>$company->id , 'revenue_business'=>$thirdSubId]) }}"><i class="fa fa-pen-alt"></i></a> --}}
                        <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="{{ __('Edit Position') }}" href="{{ route('admin.edit.revenue', ['company'=>$company->id , 'revenueBusinessLine'=>$mainId , 'serviceCategory'=>$subItemId]) }}"><i class="fa fa-pen-alt"></i></a>

                        <a class="btn btn-secondary btn-outline-hover-danger btn-icon  " href="#" data-toggle="modal" data-target="#modal-delete-service-category-{{ $subItemId}}" title="Delete"><i class="fa fa-trash-alt"></i>
                        </a>
                        <div id="modal-delete-service-category-{{ $subItemId }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ __('Delete Service Category ' .$subItemArr['data']['name']) }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h3>{{ __('Are You Sure To Delete Service Category With Its Items ? ') }}</h3>
                                    </div>
                                    <form action="{{ route('admin.delete.service.category',['company'=>$company->id,'serviceCategory'=>$subItemId ]) }}" method="post" id="delete_service_category">
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
                </b>
            </td>
        </tr>
        {{-- @endif  --}}

        @foreach ($subItemArr['sub_items'] ?? [] as $thirdSubId => $subArr)


        <tr data-order="{{ $order }}" class="row2{{ $id }}   bg-last-row" style="display: none">
            <td>{{ __('Item Name') }}</td>
            <td title="{{ __('Click To Edit The Name') }}" class="text-left text-capitalize bg-active-style editable" contenteditable="true" data-db-column-name="name" data-is-relation="0" data-model-id="{{ $thirdSubId }}" data-model-name="ServiceItem">
                {{ $subArr['data']['name'] }}
            </td>
            <td class="text-left ">
                <b class="ml-3">
                    <span style="overflow: visible; position: relative; width: 110px;">
                        <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit Position" href="{{ route('admin.edit.revenue', ['company'=>$company->id , 'revenueBusinessLine'=>$mainId , 'serviceCategory'=>$subItemId,'serviceItem'=>$thirdSubId]) }}"><i class="fa fa-pen-alt"></i></a>
                        <a class="btn btn-secondary btn-outline-hover-danger btn-icon  " href="#" data-toggle="modal" data-target="#modal-delete-{{ $thirdSubId}}" title="Delete"><i class="fa fa-trash-alt"></i>
                        </a>
                        <div id="modal-delete-{{ $thirdSubId }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">{{ __('Delete Service Item ' .$subArr['data']['name']) }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h3>{{ __('Are You Sure To Delete This Item ? ') }}</h3>
                                    </div>
                                    <form action="{{ route('admin.delete.service.item',['company'=>$company->id,'serviceItem'=>$thirdSubId ]) }}" method="post" id="delete_form">
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
                </b>
            </td>

        </tr>





        @endforeach


        @php
        $order = $order +1 ;
        @endphp


        @endforeach
        <?php $id++ ;?>
        @endforeach
        @endslot
    </x-table>

</div>
@section('js')
<script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
</script>


<script>
    function toggleRow(rowNum) {
        $(".row" + rowNum).toggle();
        $('.row_icon' + rowNum).toggleClass("flaticon2-down flaticon2-up");
        $(".row2" + rowNum).hide();
    }

    function toggleRow2(rowNum, order) {
        $(".row2" + rowNum + '[data-order="' + order + '"]').toggle();
        $('.row_icon2' + rowNum + '[data-order="' + order + '"]').toggleClass("flaticon2-down flaticon2-up");
    }
	

</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
$('.removetableContainer').closest('.kt-portlet').addClass('removeContainer')
$('.removetableContainer').closest('.kt-portlet').find('.kt-portlet__body').addClass('removePadding')
</script>
@endsection
