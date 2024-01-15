@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- Table Component ['href of Add Button'] & ['The Title Of The Table'] --}}

    <x-table :href="route('branch.create',$company)" :tableTitle="__('Branchs Table')">
        {{-- Head Of The Table --}}
        @slot('table_header')
            <tr class="table-standard-color">
                <th>{{ __('Branch Name') }}</th>
                <th>{{ __('Edit Branch') }}</th>
                <th>{{ __("Branch's Sections") }}</th>
            </tr>
        @endslot

        {{-- Body Of The Table --}}
        @slot('table_body')
            @foreach ($company->branches as $item)
                <tr class="text-center">
                    <td> {{$item->name[lang()]}} </td>
                    <td>
                        <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href="{{ route('branch.edit',[$company,$item]) }}"><i
                            class="fa fa-pen-alt"></i></a>
                    </td>
                    <td>
                        <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href="{{ route('branch.sections',[$company,$item]) }}"><i
                        class="fa fa-list "></i></a>
                    </td>


                    {{-- <td class="kt-datatable__cell--left kt-datatable__cell " data-field="Actions" data-autohide-disabled="false">
                        <span style="overflow: visible; position: relative; width: 110px;">
                            <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href="{{ route('companySection.edit', [$item]) }}"><i
                                    class="fa fa-pen-alt"></i></a>
                            <a type="button" class="btn btn-secondary btn-outline-hover-danger btn-icon" title="Delete" href=""><i
                                    class="fa fa-trash-alt"></i></a>
                        </span>
                    </td> --}}
                </tr>
            @endforeach
        @endslot
    </x-table>




@endsection

@section('js')
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
@endsection
