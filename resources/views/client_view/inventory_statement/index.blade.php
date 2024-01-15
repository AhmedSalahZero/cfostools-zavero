@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }

        .bg-table-head {
            background-color: #075d96;
            color: white !important;
        }

    </style>
@endsection
@section('sub-header')
    Inventory Statment Section
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
    <form action="{{ route('multipleRowsDelete', [$company, 'InventoryStatement']) }}" method="POST">
        @csrf
        <x-table :tableTitle="__('Inventory Statements Table')" :tableClass="'kt_table_with_no_pagination editableTable'"
            href="#"
            :importHref="route('inventoryStatementImport',$company)"
            :exportHref="route('inventoryStatement.export',$company)"
            :exportTableHref="route('table.fields.selection.view',[$company,'InventoryStatement','inventory_statement'])"
            :truncateHref="route('truncate',[$company,'InventoryStatement'])">
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
                @foreach ($inventoryStatements as $item)
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
                                <td class="text-center">
                                    {{ isset($item->$name) ? date('d-M-Y', strtotime($item->$name)) : '-' }}</td>
                            @else
                                <td class="text-center">{{ $item->$name ?? '-' }}</td>
                            @endif
                        @endforeach

                        <td class="kt-datatable__cell--left kt-datatable__cell " data-field="Actions"
                            data-autohide-disabled="false">
                            <span class="d-flex justify-content-center"
                                style="overflow: visible; position: relative; width: 110px;">
                                {{-- <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit"
                                    href="{{ route('inventoryStatement.edit', [$company, $item]) }}"><i
                                        class="fa fa-pen-alt"></i></a> --}}
                                <form method="post" action="{{ route('inventoryStatement.destroy', [$company, $item->id]) }}"
                                    style="display: inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-outline-hover-danger btn-icon"
                                        title="Delete" href=""><i class="fa fa-trash-alt"></i></button>
                                </form>
                                {{-- <a type="button" class="btn btn-secondary btn-outline-hover-warning btn-icon"
                                    href="{{ route('adjustedCollectionDate.create', [$company]) }}"
                                    title="Adjusted Collection Date" href=""><i class="fa fa-sliders-h"></i></a> --}}
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
                {{ $inventoryStatements->links() }}
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script>

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
