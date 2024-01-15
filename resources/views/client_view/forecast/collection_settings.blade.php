@extends('layouts.dashboard')

@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }

    </style>
@endsection
@section('content')
    <form action="{{ route('collection.settings', $company) }}" method="POST">
        @csrf
        <?php $collection_settings = isset($collection_settings) ? $collection_settings : old(); ?>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Sales Annual Target Year ') .date('Y', strtotime($sales_forecast->start_date)) .' : ' .number_format($sales_forecast->sales_target) }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="kt-portlet kt-portlet--mobile">

                            <div class="kt-portlet__body">
                                <!--begin: Datatable -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>{{ __('Select Collection Base') }} <span
                                                class="required">*</span></label>
                                        <div class="kt-input-icon">
                                            <div class="input-group date validated">
                                                <select name="collection_base" class="form-control" id="collection_base">
                                                    <option value="" disabled selected>{{ __('Select') }}</option>
                                                    <option id="general_collection_policy" value="general_collection_policy"
                                                        {{ @$collection_settings['collection_base'] !== 'general_collection_policy' ?: 'selected' }}>
                                                        {{ __('General Collection Policy') }}</option>
                                                    @if (isset($first_allocation_setting_base))

                                                        <option id="first_allocation_setting_base"
                                                            value="{{ $first_allocation_setting_base }}"
                                                            {{ @$collection_settings['collection_base'] !== $first_allocation_setting_base ?: 'selected' }}>
                                                            {{ __(ucwords(str_replace('_', ' ', $first_allocation_setting_base))) }}
                                                        </option>
                                                    @endif
                                                    @if (isset($second_allocation_setting_base))

                                                        <option id="second_allocation_setting_base"
                                                            value="{{ $second_allocation_setting_base }}"
                                                            {{ @$collection_settings['collection_base'] !== $second_allocation_setting_base ?: 'selected' }}>
                                                            {{ __(ucwords(str_replace('_', ' ', $second_allocation_setting_base))) }}
                                                        </option>
                                                    @endif

                                                </select>
                                                @if ($errors->has('seasonality'))
                                                    <div class="invalid-feedback">{{ $errors->first('seasonality') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet" id="general_collection_policy_view"
            style="display:{{ @$collection_settings['collection_base'] == 'general_collection_policy' ? 'block' : 'none' }}">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('General Collection Policy') }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @if ($errors->has('general_collection_rates_total'))
                    <h4 style="color: red"><i class="fa fa-hand-point-right">
                        </i></i>{{ $errors->first('general_collection_rates_total') }}</h4>
                @endif

                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__body">
                        @if ($errors->has('total_rate.general_collection_policy'))
                            <h3 style="color: red"><i class="fa fa-hand-point-right">
                                </i></i>{{ $errors->first('total_rate.general_collection_policy') }}</h3>
                        @endif
                        <div class="row">
                            {{-- A --}}
                            <div class="col-md-3">
                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[a][rate]"
                                            value="{{ @$collection_settings['general_collection']['a']['rate'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[a][due_days]"
                                            value="{{ @$collection_settings['general_collection']['a']['due_days'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- B --}}
                            <div class="col-md-3">
                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[b][rate]"
                                            value="{{ @$collection_settings['general_collection']['b']['rate'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[b][due_days]"
                                            value="{{ @$collection_settings['general_collection']['b']['due_days'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- C --}}
                            <div class="col-md-3">
                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[c][rate]"
                                            value="{{ @$collection_settings['general_collection']['c']['rate'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[c][due_days]"
                                            value="{{ @$collection_settings['general_collection']['c']['due_days'] }}">
                                    </div>
                                </div>
                            </div>
                            {{-- D --}}
                            <div class="col-md-3">
                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[d][rate]"
                                            value="{{ @$collection_settings['general_collection']['d']['rate'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control"
                                            name="general_collection[d][due_days]"
                                            value="{{ @$collection_settings['general_collection']['d']['due_days'] }}">
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="kt-portlet" id="first_allocation_setting_base_view"
            style="display:{{ @$collection_settings['collection_base'] == $first_allocation_setting_base ? 'block' : 'none' }}">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __(ucwords(str_replace('_', ' ', $first_allocation_setting_base))) . ' Collection Policy' }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-portlet kt-portlet--mobile">

                    <x-table :tableClass="'kt_table_with_no_pagination_no_search'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __(ucwords(str_replace('_', ' ', $first_allocation_setting_base))) }}</th>
                                <th> {{ __('Collection A') }} </th>
                                <th> {{ __('Collection B') }} </th>
                                <th> {{ __('Collection C') }} </th>
                                <th> {{ __('Collection D') }} </th>
                            </tr>
                        @endslot
                        @slot('table_body')
                            @foreach ($first_allocation_base_items as $base_name => $value)
                                <tr>

                                    <td>
                                        <b>{{ $base_name }}</b>
                                        @if ($errors->has('total_rate.' . $base_name))
                                            <h5 style="color: red"><i class="fa fa-hand-point-right">
                                                </i></i>{{ $errors->first('total_rate.' . $base_name) }}</h5>
                                        @endif
                                    </td>
                                    {{-- A --}}
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][a][rate]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['a']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][a][due_days]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['a']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- B --}}
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][b][rate]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['b']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][b][due_days]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['b']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- C --}}
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][c][rate]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['c']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][c][due_days]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['c']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- D --}}
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][d][rate]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['d']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="first_allocation_collection[{{ $base_name }}][d][due_days]"
                                                            value="{{ @$collection_settings['first_allocation_collection'][$base_name]['d']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>

                </div>
            </div>
        </div>
        {{-- First Allocation Base Items Collection --}}
        <div class="kt-portlet" id="second_allocation_setting_base_view"
            style="display:{{ @$collection_settings['collection_base'] == $second_allocation_setting_base ? 'block' : 'none' }}">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __(ucwords(str_replace('_', ' ', $second_allocation_setting_base))) . ' Collection Policy' }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="kt-portlet kt-portlet--mobile">

                    <x-table :tableClass="'kt_table_with_no_pagination_no_search'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __(ucwords(str_replace('_', ' ', $second_allocation_setting_base))) }}</th>
                                <th> {{ __('Collection A') }} </th>
                                <th> {{ __('Collection B') }} </th>
                                <th> {{ __('Collection C') }} </th>
                                <th> {{ __('Collection D') }} </th>
                            </tr>
                        @endslot
                        @slot('table_body')
                            @foreach ($second_allocation_base_items as $base_name => $value)
                                <tr>

                                    <td>
                                        <b>{{ $base_name }}</b>
                                        @if ($errors->has('total_rate.' . $base_name))
                                            <h5 style="color: red"><i class="fa fa-hand-point-right">
                                                </i></i>{{ $errors->first('total_rate.' . $base_name) }}</h5>
                                        @endif
                                    </td>
                                    {{-- A --}}
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][a][rate]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['a']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][a][due_days]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['a']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- B --}}
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][b][rate]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['b']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][b][due_days]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['b']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- C --}}
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][c][rate]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['c']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][c][due_days]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['c']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row">
                                            {{-- D --}}
                                            <div class="col-md-6">
                                                <label>{{ __('Rate %') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][d][rate]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['d']['rate'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>{{ __('Due Days') }} <span class="required">*</span></label>
                                                <div class="kt-input-icon">
                                                    <div class="input-group">
                                                        <input type="number" step="any" class="form-control"
                                                            name="second_allocation_collection[{{ $base_name }}][d][due_days]"
                                                            value="{{ @$collection_settings['second_allocation_collection'][$base_name]['d']['due_days'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>

                </div>
            </div>
        </div>

        <x-submitting />

    </form>
@endsection
@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}"
        type="text/javascript">
    </script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
    </script>

    <script>
        $('#collection_base').on('change', function() {
            id = $(this).children(":selected").attr("id");
            if (id == "general_collection_policy") {
                $('#general_collection_policy_view').fadeIn(300);
                $('#first_allocation_setting_base_view').fadeOut(300);
                $('#second_allocation_setting_base_view').fadeOut(300);
            } else if (id == "first_allocation_setting_base") {
                $('#first_allocation_setting_base_view').fadeIn(300);
                $('#general_collection_policy_view').fadeOut(300);
                $('#second_allocation_setting_base_view').fadeOut(300);
            } else if (id == "second_allocation_setting_base") {
                $('#second_allocation_setting_base_view').fadeIn(300);
                $('#first_allocation_setting_base_view').fadeOut(300);
                $('#general_collection_policy_view').fadeOut(300);
            }

        });
    </script>
@endsection
