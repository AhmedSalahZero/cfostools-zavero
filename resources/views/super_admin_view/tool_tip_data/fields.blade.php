@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet" type="text/css" />

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

    <x-table :tableTitle="__('Outstanding Customers Invoices Table')" :tableClass="'kt_table_with_no_pagination table table-striped'" href="{{route('toolTipData.create')}}" >
        @slot('table_header')
            <tr class="table-standard-color">
                <th>#</th>
                <th>{{ __('Field Name') }}</th>
                <th>{{ __('Control') }}</th>
            </tr>
        @endslot
        @slot('table_body')
        <?php $num = 1 ; ?>
            @foreach ($fields as $item)
                <tr>
                    <td>{{$num}}</td>
                    <td>{{$item->field}}</td>


                    <td class="kt-datatable__cell--left kt-datatable__cell " data-field="Actions" data-autohide-disabled="false">
                        <span class="d-flex justify-content-center" style="overflow: visible; position: relative; width: 110px;">
                            <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="{{__("Fields")}}" href="{{route('toolTipData.edit',$item->id)}}"><i class="fa fa-pen-alt"></i>  </a>
                        </span>
                    </td>
                </tr>
                <?php $num++ ; ?>
            @endforeach

        @endslot

    </x-table>
@endsection

@section('js')
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>

@endsection
