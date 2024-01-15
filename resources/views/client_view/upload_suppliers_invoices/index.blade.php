@extends('layouts.dashboard')
@section('css')
    <style>
        table {
            white-space: nowrap;
            
        }
    
#kt_header{
    /* display:none; */
}
.kt_table_with_no_pagination {
    /* top:63px !important ; */
}






    </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
<style>
    table.dataTable thead tr > .dtfc-fixed-left, table.dataTable thead tr > .dtfc-fixed-right{
        background-color:#086691;
    }
    thead *{
        text-align:center !important;
    }
</style>
    {{-- <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('sub-header')
    Upload Supplier Invoice Section
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
    <form action="{{ route('multipleRowsDelete', [$company, 'UploadSupplierInvoice']) }}" method="POST">
        @csrf
        <x-table :tableTitle="__('Upload Supplier Invoice Table')" :tableClass="'kt_table_with_no_pagination'" href="#" :importHref="route('uploadSupplierInvoiceImport',$company)" :exportHref="route('uploadSupplierInvoices.export',$company)" :exportTableHref="route('table.fields.selection.view',[$company,'uploadSupplierInvoice','upload_suppliers_invoices'])"
        :truncateHref="route('truncate',[$company,'UploadSupplierInvoice'])">
            @slot('table_header')
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12 ">
                            <label class="kt-option bg-secondary">
                                <span class="kt-option__control">
                                    <span class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                        checked>
                                        <input class="rows" type="checkbox" id="select_all">
                                        <span></span>
                                    </span>
                                </span>
                                <span class="kt-option__label d-flex">
                                    <span class="kt-option__head mr-auto p-2">
                                        <span class="kt-option__title">
                                            <b>
                                                {{ __('Select All') }}
                                            </b>
                                        </span>

                                    </span>
                                    <span class="kt-option__body p-2">
                                        <button type="submit" class="btn active-style btn-icon-sm">
                                            <i class="fas fa-trash-alt"></i>
                                            {{ __('Delete Selected Rows') }}
                                        </button>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <tr class="table-active text-center">
                    <th>{{__("Select To Delete")}} </th>
                    @foreach ($viewing_names as $name)
                        <th>{{ __($name) }}</th>
                    @endforeach
                    <th>{{ __('Actions') }}</th>
                </tr>
            @endslot
            @slot('table_body')
                @foreach ($uploadSupplierInvoices as $item)
                    <tr>
                        <td class="text-center">
                            <label class="kt-option">
                                <span class="kt-option__control">
                                    <span class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                        checked>
                                        <input class="rows" type="checkbox" name="rows[]" value="{{ $item->id }}">
                                        <span></span>
                                    </span>
                                </span>
                                <span class="kt-option__label">
                                    <span class="kt-option__head">

                                    </span>
                                    {{-- <span class="kt-option__body">
                                    {{ __('This Section Will Be Added In The Client Side') }}
                                </span> --}}
                                </span>
                            </label>
                        </td>
                        @foreach ($db_names as $name)
                            @if ($name == 'date')
                                <td class="text-center">{{ isset($item->$name) ? date('d-M-Y',strtotime($item->$name)):  '-' }}</td>
                            @else
                                <td class="text-center">{{ $item->$name ?? '-' }}</td>
                            @endif
                        @endforeach

                        <td class="kt-datatable__cell--left kt-datatable__cell " data-field="Actions" data-autohide-disabled="false">
                            <span class="d-flex justify-content-center" style="overflow: visible; position: relative; width: 110px;">
                                <form method="post"   action="{{route('uploadSupplierInvoice.destroy',[$company,$item->id])}}" style="display: inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-outline-hover-danger btn-icon" title="Delete" href=""><i class="fa fa-trash-alt"></i></button>
                                </form>
                                {{-- <a type="button" class="btn btn-secondary btn-outline-hover-warning btn-icon" href="{{route('adjustedCollectionDate.create',[$company])}}" title="Adjusted Collection Date" href=""><i class="fa fa-sliders-h"></i></a> --}}
                            </span>
                        </td>
                    </tr>

                @endforeach
            @endslot
        </x-table>
    </form>
    <div class="kt-portlet">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label d-flex justify-content-start">
                {{ $uploadSupplierInvoices->links() }}
            </div>
        </div>
    </div>
    <div class="modal fade" id="kt_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{__("Instructions")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <p class="pop-up-font">
                        <b> 1. Click on Template Download button </b>
                    </p>
                    <p class="pop-up-font">
                        <b> 2. Select the fields that suits your sales data structure </b>
                    </p>
                    <p class="pop-up-font">
                        <b> 3. Click download </b>
                    </p>
                    <p class="pop-up-font">
                        <b> 4. Fill your excel template </b>
                    </p>
                    <p class="pop-up-font">
                        <b> 5. Click Upload Data, choose your excel file then select date format finally click save </b>
                    </p>
                    <p class="pop-up-font">
                        <b> 6. Review your data, and then click Save Table </b>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
@include('js_datatable')
    {{-- <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> --}}
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){ $('#kt_modal_2').modal('show'); });
        $('#select_all').change(function(e) {
            if ($(this).prop("checked")) {
                $('.rows').prop("checked", true);
            } else {
                $('.rows').prop("checked", false);
            }
        });
        $(function () {
            $("td").dblclick(function () {
                var OriginalContent = $(this).text();
                $(this).addClass("cellEditing");
                $(this).html("<input type='text' value='" + OriginalContent + "' />");
                $(this).children().first().focus();
                $(this).children().first().keypress(function (e) {
                    if (e.which == 13) {
                        var newContent = $(this).val();
                        $(this).parent().text(newContent);
                        $(this).parent().removeClass("cellEditing");
                    }
                });
            $(this).children().first().blur(function(){
                $(this).parent().text(OriginalContent);
                $(this).parent().removeClass("cellEditing");
            });
                $(this).find('input').dblclick(function(e){
                    e.stopPropagation();
                });
            });
        });
    </script>

  
@endsection
