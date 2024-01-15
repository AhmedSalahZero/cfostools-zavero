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
    <form action="{{ route('second.allocations', $company) }}" method="POST">
        @csrf

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
                                    <div class="col-md-6">
                                        <?php $allocations_setting = isset($allocations_setting) ? $allocations_setting : old(); ?>
                                        <label>{{ __('Select Second Allocation Base') }} <span
                                                class="required">*</span></label>
                                        <div class="kt-input-icon">
                                            <div class="input-group date validated">
                                                <select name="allocation_base" class="form-control" id="allocation_base">
                                                    <option value="" disabled selected>{{ __('Select') }}</option>
                                                    @if ($first_allocations_setting->allocation_base !=='branch' && in_array('branch',getExportableFieldsKeysAsValues($company->id)) )
                                                        <option value="branch"
                                                            {{ @$allocations_setting['allocation_base'] !== 'branch' ?: 'selected' }}>
                                                            {{ __('Branches') }}</option>
                                                    @endif
                                                    @if ($first_allocations_setting->allocation_base !=='business_sector' && in_array('business_sector',getExportableFieldsKeysAsValues($company->id)))
                                                        <option value="business_sector"
                                                            {{ @$allocations_setting['allocation_base'] !== 'business_sector' ?: 'selected' }}>
                                                            {{ __('Business Sectors') }}</option>
                                                    @endif
                                                    @if ($first_allocations_setting->allocation_base !=='sales_channel' && in_array('sales_channel',getExportableFieldsKeysAsValues($company->id)) )
                                                        <option value="sales_channel"
                                                            {{ @$allocations_setting['allocation_base'] !== 'sales_channel' ?: 'selected' }}>
                                                            {{ __('Sales Channels') }}</option>
                                                    @endif
                                                    @if ($first_allocations_setting->allocation_base !== 'zone'  && in_array('zone',getExportableFieldsKeysAsValues($company->id)) )
                                                        <option value="zone"
                                                            {{ @$allocations_setting['allocation_base'] !== 'zone' ?: 'selected' }}>
                                                            {{ __('Zones') }}</option>
                                                    @endif
                                                </select>
                                                @if ($errors->has('allocation_base'))
                                                    <div class="invalid-feedback">{{ $errors->first('allocation_base') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(hasProductsItems($company))
                                    <div class="col-md-6">
                                        <div class="form-group  form-group-marginless">
                                            <label>{{ __('Select Sales Breakdown %') }} <span
                                                    class="required">*</span></label>
                                            <div class="kt-input-icon">
                                                <div class="input-group date validated">
                                                    <select name="breakdown" class="form-control" id="breakdown">
                                                        <option value="" disabled selected>{{ __('Select') }}</option>
                                                        <option value="previous_year"
                                                            {{ @$allocations_setting['breakdown'] !== 'previous_year' ?: 'selected' }}>
                                                            {{ __('Pervious Year Breakdown / New Breakdown') }}</option>
                                                        <option value="last_3_years"
                                                            {{ @$allocations_setting['breakdown'] !== 'last_3_years' ?: 'selected' }}>
                                                            {{ __('Last 3 Years Average Breakdown') }}</option>
                                                        {{-- <option value="new_breakdown_annually"
                                                            {{ @$allocations_setting['breakdown'] !== 'new_breakdown_annually' ?: 'selected' }}>
                                                            {{ __('New Breakdown - Annually') }}</option> --}}
                                                        {{-- <option value="new_breakdown_quarterly"
                                                            {{ @$allocations_setting['breakdown'] !== 'new_breakdown_quarterly' ?: 'selected' }}>
                                                            {{ __('New Breakdown - Quarterly') }}</option> --}}
                                                    </select>
                                                    @if ($errors->has('breakdown'))
                                                        <div class="invalid-feedback">{{ $errors->first('breakdown') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="col-md-6"
                                        style="display: {{ @$allocations_setting['new_start'] == 'previous_year' || @$allocations_setting['new_start'] == 'previous_3_years'? 'block': 'none' }}"
                                        id="new_start_field">
                                        <div class="form-group  form-group-marginless">
                                            <label>New Start</label>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span
                                                                    class="kt-radio kt-radio--bold kt-radio--brand kt-radio--check-bold"
                                                                    checked>
                                                                    <input type="radio" name="new_start"
                                                                        value="annual_target"
                                                                        {{ @$section_row['new_start'] == 'annual_target' ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="kt-option__label">
                                                                <span class="kt-option__head">
                                                                    <span class="kt-option__title">
                                                                        {{ __('Annual Target') }}
                                                                    </span>

                                                                </span>
                                                                <span class="kt-option__body">
                                                                    {{-- {{__('This Section Will Be Added In The Client Side')}} --}}
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="kt-option">
                                                            <span class="kt-option__control">
                                                                <span class="kt-radio kt-radio--bold kt-radio--brand">
                                                                    <input type="radio" name="new_start"
                                                                        value="product_target"
                                                                        {{ @$section_row['new_start'] == 'product_target' ? 'checked' : '' }}>
                                                                    <span></span>
                                                                </span>
                                                            </span>
                                                            <span class="kt-option__label">
                                                                <span class="kt-option__head">
                                                                    <span class="kt-option__title">
                                                                        {{ __('Prodcuts Targets') }}
                                                                    </span>

                                                                </span>
                                                                <span class="kt-option__body">
                                                                    {{-- {{__('This Section Will Be Added In The Client Side')}} --}}
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label class="kt-option bg-secondary">
                                            <span class="kt-option__control">
                                                <span
                                                    class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                                    checked>
                                                    <input class="rows" name="add_new_items" type="checkbox"
                                                        value="1" readonly
                                                        {{ @$allocations_setting['add_new_items'] == 0 ?: 'checked' }}
                                                        id="add_new_items">
                                                    <span></span>
                                                </span>
                                            </span>
                                            <span class="kt-option__label d-flex">
                                                <span class="kt-option__head mr-auto p-2">
                                                    <span class="kt-option__title">
                                                        <b>
                                                            {{ __('Add New') }} <span id="item_type"></span>
                                                        </b>
                                                    </span>

                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-md-6"
                                        style="display:{{ @$allocations_setting['add_new_items'] == 1 ? 'block' : 'none' }}"
                                        id="number_of_items">
                                        <label>{{ __('How Many ? ') }} <span class="required">*</span></label>
                                        <div class="kt-input-icon">
                                            <div class="input-group validated">
                                                <input type="number" step="any" class="form-control"
                                                    name="number_of_items" value="{{ @$allocations_setting['number_of_items'] }}"
                                                    id="number_of_items">
                                                @if ($errors->has('number_of_items'))
                                                    <div class="invalid-feedback">{{ $errors->first('number_of_items') }}</div>
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

        {{-- @if (count($allocations_setting_base_data) > 0)
            <?php $item = ucwords(str_replace('_', ' ', $allocation_base)); ?>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{ __('Sales Annual Target Year ') .date('Y', strtotime($sales_forecast->start_date)) .' : ' .number_format($sales_forecast->sales_target) }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if ($allocations_setting === 'new_breakdown_quarterly')
                        <x-table :tableTitle="__($item.' Sales Targets Values Table')"
                            :tableClass="'kt_table_with_no_pagination'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __('Item') }}</th>
                                    @foreach ($sales_targets as $quarter_name => $value)
                                        <th>{{ __($quarter_name) }}</th>
                                    @endforeach

                                </tr>
                            @endslot
                            @slot('table_body')
                                <tr>
                                    <td>{{ __('Quaterly Sales Target Values') }}</td>
                                    @foreach ($sales_targets as $quarter_name => $value)
                                        <td class="text-center">{{ number_format($value ?? 0) }}</td>
                                    @endforeach
                                </tr>
                            @endslot
                        </x-table>
                    @endif




                    <x-table :tableTitle="__($item.' Sales Target Values Table')"
                        :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __($item . ' Name') }}</th>
                                <th>{{ __(($allocations_setting == 'last_3_years' ? 'Last 3 Years Average' : 'Pervious Year') . ' Sales Value') }}
                                </th>
                                @if ($allocations_setting !== 'new_breakdown_annually')
                                    <th>{{ __('Sales Target Value') }}</th>
                                    <th>{{ __('Sales Target %') }}</th>
                                @endif
                                @if ($allocations_setting !== 'new_breakdown_quarterly')
                                    <th>{{ __(($allocations_setting !== 'new_breakdown_annually' ? 'Modify' : 'Insert') . ' Sales Target') }}
                                    </th>
                                    <th>{{ __(($allocations_setting !== 'new_breakdown_annually' ? 'Modify' : 'Insert') . ' Sales %') }}
                                    </th>
                                @else
                                    @foreach ($sales_targets as $quarter_name => $value)
                                        <th>{{ __('Modify ' . $quarter_name . ' Sales Target') }}</th>
                                        <th>{{ __('Modify ' . $quarter_name . ' Sales %') }}</th>
                                    @endforeach
                                @endif
                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $total = array_sum(array_column($allocations_setting_base_data, 'Sales Value'));
                            $allocations_setting !== 'last_3_years' ?: ($total = $total / 3);
                            $total_existing_targets = 0;
                            ?>
                            @foreach ($allocations_setting_base_data as $key => $product_data)
                                <tr>
                                    <td>{{ $product_data['item'] ?? '-' }}</td>
                                    <?php
                                    $sales_value = $allocations_setting == 'last_3_years' ? ($product_data['Sales Value'] ?? 0) / 3 : $product_data['Sales Value'] ?? 0;
                                    $target_percentage = $total == 0 ? 0 : $sales_value / $total;
                                    $existing_target_per_product = $target_percentage * $sales_forecast->sales_target;
                                    $total_existing_targets += $existing_target_per_product;
                                    ?>
                                    <td class="text-center">{{ number_format($sales_value ?? 0) }}</td>

                                    @if ($allocations_setting !== 'new_breakdown_annually')
                                        <td class="text-center">{{ number_format($existing_target_per_product) }}</td>
                                        <td class="text-center">{{ number_format($target_percentage * 100, 1) . ' %' }}
                                        </td>
                                    @endif
                                    @if ($allocations_setting !== 'new_breakdown_quarterly')
                                        <td class="text-center">
                                            <input type="number"
                                                name="modify_sales_target[{{ $product_data['item'] }}][value]"
                                                placeholder="{{ __('Value') }}" class="modify_sales_target form-control"
                                                value="{{ @$modified_targets['products_modified_targets'][$product_data['item']]['value'] }}">
                                        </td>
                                        <td class="text-center">
                                            <input type="number"
                                                name="modify_sales_target[{{ $product_data['item'] }}][percentage]"
                                                placeholder="{{ __('%') }}"
                                                class="modify_sales_target_percentage form-control"
                                                value="{{ @$modified_targets['products_modified_targets'][$product_data['item']]['percentage'] }}">
                                        </td>
                                    @else
                                        @foreach ($sales_targets as $quarter_name => $value)
                                            <?php $quarter_name = str_replace(' ', '_', $quarter_name); ?>

                                            <td class="text-center">
                                                <input type="number"
                                                    name="modify_sales_target[{{ $product_data['item'] }}][{{ $quarter_name }}][value]"
                                                    placeholder="{{ __('Value') }}"
                                                    class="modify_sales_target_{{ $quarter_name }} form-control"
                                                    data-quarter_annual_target="{{ $value }}"
                                                    value="{{ @$modified_targets['products_modified_targets'][$product_data['item']][$quarter_name]['value'] }}">
                                            </td>
                                            <td class="text-center">
                                                <input type="number"
                                                    name="modify_sales_target[{{ $product_data['item'] }}][{{ $quarter_name }}][percentage]"
                                                    data-quarter_annual_target="{{ $value }}"
                                                    placeholder="{{ __('%') }}"
                                                    class="modify_sales_target_percentage_{{ $quarter_name }} form-control"
                                                    value="{{ @$modified_targets['products_modified_targets'][$product_data['item']][$quarter_name]['percentage'] }}">
                                            </td>
                                        @endforeach
                                    @endif
                                </tr>
                            @endforeach
                            <tr class="table-active text-center">
                                <th>{{ __('Total') }}</th>
                                <td>{{ number_format($total) }}</td>
                                @if ($allocations_setting !== 'new_breakdown_annually')
                                    <td>{{ number_format($total_existing_targets) }}</td>
                                    <td>100 %</td>
                                @endif
                                @if ($allocations_setting !== 'new_breakdown_quarterly')
                                    <td id="total_modify_sales_target">
                                        {{ !isset($modified_targets['products_modified_targets'])? 0: number_format(array_sum(array_column($modified_targets['products_modified_targets'], 'value') ?? [])) }}
                                    </td>
                                    <td id="total_modify_sales_target_percentage">
                                        {{ !isset($modified_targets['products_modified_targets'])? 0: number_format(array_sum(array_column($modified_targets['products_modified_targets'], 'percentage') ?? [])) }}
                                    </td>
                                @else
                                    @foreach ($sales_targets as $quarter_name => $value)
                                        <?php $quarter_name = str_replace(' ', '_', $quarter_name); ?>
                                        <td id="total_modify_sales_target_{{ $quarter_name }}">
                                            {{ !isset($modified_targets['products_modified_targets'])? 0: number_format(array_sum(array_column($modified_targets['products_modified_targets'], 'value') ?? [])) }}
                                        </td>
                                        <td id="total_modify_sales_target_percentage_{{ $quarter_name }}">
                                            {{ !isset($modified_targets['products_modified_targets'])? 0: number_format(array_sum(array_column($modified_targets['products_modified_targets'], 'percentage') ?? [])) }}
                                        </td>
                                    @endforeach
                                @endif

                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        @endif --}}

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
    @foreach ($sales_targets as $quarter_name => $value)
        <?php $quarter_name = str_replace(' ', '_', $quarter_name); ?>
        <script>
            $('.modify_sales_target_'+'{{$quarter_name}}').on('change', function() {
                var index = $('.modify_sales_target_'+'{{$quarter_name}}').index(this);
                var modify_sales_target = parseFloat($(this).val());

                var percentage = (modify_sales_target / parseFloat("{{ $value }}")) * 100;
                $('.modify_sales_target_percentage_'+'{{$quarter_name}}').eq(index).val(percentage.toFixed(2));
                totalFunction('.modify_sales_target_'+'{{$quarter_name}}', '#total_modify_sales_target_'+'{{$quarter_name}}', 0);
                totalFunction('.modify_sales_target_percentage_'+'{{$quarter_name}}', '#total_modify_sales_target_percentage_'+'{{$quarter_name}}', 2);
            });


            $('.modify_sales_target_percentage_'+'{{$quarter_name}}').on('change', function() {
                var index = $('.modify_sales_target_percentage_'+'{{$quarter_name}}').index(this);
                var modify_sales_target_percentage = parseFloat($(this).val()) / 100;
                var value = (modify_sales_target_percentage * parseFloat("{{ $value }}"));
                $('.modify_sales_target_'+'{{$quarter_name}}').eq(index).val(value.toFixed(0));
                totalFunction('.modify_sales_target_percentage_'+'{{$quarter_name}}', '#total_modify_sales_target_percentage_'+'{{$quarter_name}}', 2);
                totalFunction('.modify_sales_target_'+'{{$quarter_name}}', '#total_modify_sales_target_'+'{{$quarter_name}}', 0);

            });
        </script>
    @endforeach

    <script>
        $('#allocation_base').on('change', function() {
            val = $(this).find('option:selected').text();
            $('#add_new_items').attr('readonly', false);

            $('#item_type').html(' ' + $.trim(val));
        });


        $('#add_new_items').change(function () {
            if ($(this).prop("checked")) {
                $('#number_of_items').fadeIn(300);
            } else {
                $('#number_of_items').fadeOut(300);
            }

        });

        $('.modify_sales_target').on('change', function () {
            var index = $('.modify_sales_target').index(this);
            var modify_sales_target = parseFloat($(this).val());
            var percentage = (modify_sales_target/parseFloat("{{$sales_forecast->sales_target??0}}"))*100;
            $('.modify_sales_target_percentage').eq(index).val(percentage.toFixed(2));
            totalFunction('.modify_sales_target','#total_modify_sales_target',0);
            totalFunction('.modify_sales_target_percentage','#total_modify_sales_target_percentage',2);
        });
        $('.modify_sales_target_percentage').on('change', function () {
            var index = $('.modify_sales_target_percentage').index(this);
            var modify_sales_target_percentage = parseFloat($(this).val()) /100;
            var value = (modify_sales_target_percentage*parseFloat("{{$sales_forecast->sales_target??0}}")) ;
            $('.modify_sales_target').eq(index).val(value.toFixed(0));
            totalFunction('.modify_sales_target_percentage','#total_modify_sales_target_percentage',2);
            totalFunction('.modify_sales_target','#total_modify_sales_target',0);

        });



        function totalFunction(field_name, total_field_name, decimals) {
            total = 0;
            $(field_name).each(function(index, element) {

                if (element.value !== '') {
                    total = parseFloat(element.value) + total;
                }

            });
            $(total_field_name).html(total.toFixed(decimals));
        }
    </script>
@endsection
