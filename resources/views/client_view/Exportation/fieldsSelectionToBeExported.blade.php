@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{ __('Please Choose Fields That You Need To Be in Your Excel Sheet') }}
                        </h3>
                    </div>
                </div>
            </div>
            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" method="POST"
                action="{{ route('table.fields.selection.save', [$company,$model, $view]) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="model_name" value="{{$model}}">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title head-title text-primary ">
                                {{ __('Fields Names') }}
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group row form-group-marginless">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-12 " >
                                        <label class="kt-option bg-secondary">
                                            <span class="kt-option__control">
                                                <span
                                                    class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                                    checked>
                                                    <input type="checkbox" id="select_all" {{count($selected_fields) == count($columnsWithViewingNames) ? 'checked' : ''}}>
                                                    <span></span>
                                                </span>
                                            </span>
                                            <span class="kt-option__label">
                                                <span class="kt-option__head">
                                                    <span class="kt-option__title">
                                                        <b>
                                                            {{ __('Select All') }}
                                                        </b>
                                                    </span>

                                                </span>
                                                {{-- <span class="kt-option__body">
                                                    {{ __('This Section Will Be Added In The Client Side') }}
                                                </span> --}}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            {{-- {{ dd($columnsWithViewingNames) }} --}}
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($columnsWithViewingNames as $fieldName => $displayName)
                                        <?php
                                            $status_disanbeled_fields = $fieldName == 'net_sales_value' || 
                                                            ($fieldName == 'sales_value'  && count(array_intersect($selected_fields, ['quantity_discount','cash_discount','special_discount','other_discounts'])) == 0 );
                                        ?>
                                        <div class="col-lg-6">
                                            <label class="kt-option @if ($status_disanbeled_fields) not_allowed_curser @endif">
                                                <span class="kt-option__control ">

                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand
                                                        @if ($status_disanbeled_fields)
                                                            kt-checkbox--disabled
                                                        @endif">
                                                        <input   type="checkbox" name="fields[]" value="{{$fieldName}}"
                                                            @if ($fieldName != 'net_sales_value')
                                                            class="fields"
                                                            @endif
                                                            @if (((false !== $found = array_search($fieldName,$selected_fields)) || $fieldName == 'net_sales_value')   )
                                                                checked
                                                            @endif
                                                            @if ($status_disanbeled_fields)
                                                                disabled="disabled"
                                                                style="cursor: not-allowed;"
                                                            @endif
                                                          id="{{$fieldName}}">
                                                        <span></span>
                                                    </label>

                                                    {{-- <span
                                                        class="kt-checkbox  kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                                        checked>
                                                        <input class="fields" type="checkbox" name="fields[]"
                                                            value="{{$fieldName}}"
                                                            @if ((false !== $found = array_search($fieldName,$selected_fields)) || $fieldName == 'net_sales_value')
                                                                checked
                                                            @endif

                                                            >
                                                        <span></span>
                                                    </span> --}}
                                                </span>
                                                <span class="kt-option__label">
                                                    <span class="kt-option__head">
                                                        <span class="kt-option__title">
                                                            {{ $displayName}}
                                                        </span>

                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            {{-- <label class="col-lg-1 col-form-label"> </label> --}}
                        </div>
                    </div>
                </div>

                <x-custom-button-name-to-submit :displayName="__('Download')" />
            </form>

            <!--end::Form-->

            <!--end::Portlet-->
        </div>
    </div>
@endsection
@section('js')
    <!--begin::Page Scripts(used by this page) -->

    </script>
    <!--end::Page Scripts -->
        <script>
            $('#select_all').change(function(e) {
                if ($(this).prop("checked")) {
                    $('.fields').prop("checked", true);
                } else {
                    $('.fields').prop("checked", false);
                }
            });
            $('#quantity_discount,#cash_discount,#special_discount,#other_discounts').change(function(e) {
                if ($('#quantity_discount').prop("checked") || $('#cash_discount').prop("checked") || $('#special_discount').prop("checked") || $('#other_discounts').prop("checked")) {
                    $('#sales_value').prop("checked", true);
                } else {
                    $('#sales_value').prop("checked", false);
                }
            });
        </script>
@endsection
