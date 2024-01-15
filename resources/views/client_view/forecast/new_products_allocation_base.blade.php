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
        .small_table_class{
            width:50%;
            margin:auto;
        }

    </style>
@endsection
@section('content')
    <form action="{{ route('new.product.allocation.base', $company) }}" method="POST">
        @csrf
        <?php $total_sales_targets_values = 0;
        $total_sales_targets_percentages = 0; ?>
        @if (1)
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3>
                            {{ __('New Products Item Sales Annual Target Year ') .date('Y', strtotime($sales_forecast->start_date)) .' : ' .number_format($product_seasonality->sum('sales_target_value')) }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    @if ($errors->has('percentages_total'))
                        <h4 style="color: red"><i class="fa fa-hand-point-right">
                            </i></i>{{ $errors->first('percentages_total') }}</h4>

                    @else
                        <h4 class="text-success"><i class="fa fa-hand-point-right">
                            </i></i>{{ __('Total Percentages Must Be Equal To 100 %') }}</h4>
                    @endif
                    <x-table :tableTitle="__('New Product Items Table')" :tableClass="(! ($sales_forecast->add_new_products || $sales_forecast->add_new_products > 0)) ? 'small_table_class' : '' . 'kt_table_with_no_pagination ' ">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __(str_replace('_', ' ', ucwords($allocation_base))) }}</th>
                                @forelse ($product_seasonality as $index=> $product)
                                    <th style="width: 8%">{{ $product->name }}</th>
                                    <th class="sales_target_total" data-index="{{ $index }}" data-value="{{ $product->sales_target_value ?? 0 }}">{{ __('Sales Target [ ') . number_format($product->sales_target_value ?? 0) . ' ]' }}
                                    </th>
                                     @empty


                                 @endforelse

                            </tr>
                        @endslot
                        
                        @slot('table_body')
                            <input type="hidden" name="allocation_base" value="{{ $allocation_base }}">
                            <?php $key = 0; ?>
                            <?php $key_for_new_items = 0; ?>

                            @foreach ($allocation_bases_items as $item => $type)
                                <tr class="text-center">
                                    @if ($type == 'new')
                                    <?php $name = ($allocations_base_row->new_allocation_bases_names[$key_for_new_items]) ?? (old('new_allocation_base_items')[$key_for_new_items]??''); ?>
                                        <td class="text-center light-gray-bg">
                                            <div class="input-group validated">
                                                <input type="text" name="new_allocation_base_items[{{ $key_for_new_items }}]"
                                                    value="{{ $name }}"
                                                    placeholder="{{ __('Insert ' . str_replace('_', ' ', ucwords($allocation_base))) }}"
                                                    class="form-control">
                                                @if ($errors->has('new_allocation_base_items.' . $key_for_new_items))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('new_allocation_base_items.' . $key_for_new_items) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <?php $key_for_new_items++; ?>
                                    @else
                                        <td> {{ $item }} </td>
                                    @endif
                                    @foreach ($product_seasonality as $index2=>$product)
                                        <?php
                                            if($allocations_base_row === null){
                                                $value = (old('allocation_base_data')[$product->name][$item][$type] ?? '' );
                                            }else{

                                                $value = @$allocations_base_row->allocation_base_data[$product->name][$item][$type];
                                                if ($type == 'new') {
                                                    $value = @$allocations_base_row->allocation_base_data[$product->name][$name][$type];
                                                }
                                            }

                                        ?>
                                        <?php $product_name = str_replace(' ', '_', strtolower($product->name)); ?>
                                        <td class="text-center" style="background-color:lightgrey;">
                                            <input data-index="{{ $index2 }}" data-column="{{ $key_for_new_items }}"  type="number" step="any"
                                                name="allocation_base_data[{{ $product->name }}][{{ $item }}][{{ $type }}]"
                                                value="{{ $value ?? '' }}" placeholder="{{ __('Insert %') }}"
                                                class="sales_target_percentage_{{ $product_name }} form-control sales_target_percentage_class">
                                        </td>
                                        <td class="text-center">
                                            {{-- salah --}}
                                            <input type="hidden" name="totalsss" value="{{ $product_seasonality->sum('sales_target_value') ?? 0 }}">
                                            <input 
                                            {{-- @if($type == 'new')
                                            name="allocation_base_data_existing[{{ $product->name }}][{{ $item }}][existing_custom]"
                                            @endif --}}
                                             data-index="{{ $index2  }}" data-column="{{ $key_for_new_items }}" type="number" step="any" placeholder="{{ __('Insert Value') }}"
                                                class="sales_target_value_{{ $product_name }} form-control sales_values_class">
                                        </td>
                                        <?php $key++; ?>



                                
                                    @endforeach

                                </tr>
                            @endforeach
                            {{-- Totals --}}
                            <tr>
                                <td class="text-center active-style">{{ __('Total') }}</td>
                                @foreach ($product_seasonality as $index=>$product)
                                    <?php $product_name = str_replace(' ', '_', strtolower($product->name)); ?>
                                    <td class="text-center active-style"
                                        id="total_sales_target_percentage_{{ $product_name }}">
                                        {{ !isset($modified_targets['products_modified_targets'])? 0: number_format(array_sum(array_column($modified_targets['products_modified_targets'], 'percentage') ?? [])) }}
                                    </td>
                                    <td class="text-center active-style total_sales_values_id total_sales_values_class" data-index="{{ $index }}" id="total_sales_target_value_{{ $product_name }}">
                                        {{ !isset($modified_targets['products_modified_targets'])? 0: number_format(array_sum(array_column($modified_targets['products_modified_targets'], 'value') ?? [])) }}
                                    </td>
                                @endforeach
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        @endif
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


    @foreach ($product_seasonality as $product)
        <?php $product_name = str_replace(' ', '_', strtolower($product->name));
        $value = $product->sales_target_value; ?>

        <script>
            $(document).ready(function() {

                $('.sales_target_percentage_' + '{{ $product_name }}').each(function(index, element) {
                    var index = $('.sales_target_percentage_' + '{{ $product_name }}').index(this);
                    var sales_target_percentage = parseFloat($(this).val()) / 100;
                    targetpercentage(index, sales_target_percentage, "{{ $value }}",
                        "{{ $product_name }}");

                });
            });

            $('.sales_target_value_' + '{{ $product_name }}').on('change', function() {
                var index = $('.sales_target_value_' + '{{ $product_name }}').index(this);
                var sales_target = parseFloat($(this).val());
                targetValue(index, sales_target, "{{ $value }}", "{{ $product_name }}");

            });




            $('.sales_target_percentage_' + '{{ $product_name }}').on('change', function() {

                var index = $('.sales_target_percentage_' + '{{ $product_name }}').index(this);
                var sales_target_percentage = parseFloat($(this).val()) / 100;
                targetpercentage(index, sales_target_percentage, "{{ $value }}", "{{ $product_name }}");

            });
        </script>
    @endforeach




    <script>
        function targetValue(index, sales_target, value, product_name) {
            var percentage = (sales_target / parseFloat(value)) * 100;
            $('.sales_target_percentage_' + product_name).eq(index).val(percentage.toFixed(2));
            totalFunction('.sales_target_value_' + product_name, '#total_sales_target_value_' + product_name, 0);
            totalFunction('.sales_target_percentage_' + product_name, '#total_sales_target_percentage_' + product_name, 2);
        }

        function targetpercentage(index, sales_target_percentage, value, product_name) {
            var value = (sales_target_percentage * parseFloat(value));
            $('.sales_target_value_' + product_name).eq(index).val(value.toFixed(0));
            totalFunctionForProducts('.sales_target_percentage_' + product_name, '#total_sales_target_percentage_' +
                product_name, 2, '%');
            totalFunctionForProducts('.sales_target_value_' + product_name, '#total_sales_target_value_' + product_name, 0);
        }

        function totalFunctionForProducts(field_name, total_field_name, decimals, character = null) {
            total = 0;
            $(field_name).each(function(index, element) {

                if (element.value !== '') {
                    total = parseFloat(element.value) + total;
                }

            });
            if (character !== null) {
                total = (total.toFixed(decimals)) + ' ' + character;
            } else {
                total = (total.toFixed(decimals));
            }
            $(total_field_name).html(total);
        }



        $('.months').on('change', function() {
            key = $(this).data('product');
            totalFunction('.months', '.total_months', key, 0);
        });
        $('.quarters').on('change', function() {
            key = $(this).data('product');
            totalFunction('.quarters', '.total_quarters', key, 0);
        });

        function totalFunction(field_name, total_field_name, key, decimals) {
            total = 0;
            $(field_name).each(function(index, element) {

                if (element.value !== '' && key == $(this).data('product')) {
                    total = parseFloat(element.value) + total;
                }

            });
            character = null ;
            $(total_field_name).eq(key).val((total.toFixed(decimals) + ' ' + character));
        }


        $('.products').on('change', function() {
            var name = $(this).find(':selected').data('name');
            var id = $(this).find(':selected').data('id');
            var index = $('.products').index(this);
            $('.categories option').eq(index).remove();
            select = '<option value="' + id + '" selected>' + name + '</option>';
            $('.categories').eq(index).append(select);
        });

        // $('.sales_target_value').on('change', function () {
        //     var index = $('.sales_target_value').index(this);
        //     var sales_target_value = parseFloat($(this).val());
        //     var sales_target = $('.sales_target').eq(index).val();
        //     var percentage = (sales_target_value/parseFloat(sales_target))*100;
        //     $('.sales_target_percentage').eq(index).val(percentage.toFixed(2));
        // });

        // $('.sales_target_percentage').on('change', function () {
        //     var index = $('.sales_target_percentage').index(this);
        //     var sales_target = $('.sales_target').eq(index).val();
        //     percentageChangeing(index,$(this).val(),sales_target);
        // });

        // function percentageChangeing(index,percentage,sales_target) {

        //     var sales_target_percentage = parseFloat(percentage) /100;
        //     var value = (sales_target_percentage*parseFloat(sales_target)) ;
        //     $('.sales_target_value').eq(index).val(value.toFixed(0));
        // }

        $('.seasonality').on('change', function() {
            val = $(this).val();
            var index = $('.seasonality').index(this);

            if (val == 'new_seasonality_monthly') {
                $('.monthly_seasonality').eq(index).fadeIn(300);
                $('.quarterly_seasonality').eq(index).fadeOut("slow", function() {});
            } else if (val == 'new_seasonality_quarterly') {
                $('.monthly_seasonality').eq(index).fadeOut("slow", function() {
                    $('.quarterly_seasonality').eq(index).fadeIn(300);
                });

            }
        });
    </script>

    <script>
        $(document).on('keyup','.sales_values_class',function(e){
            let index = $(this).data('index');
             let totalValues = 0 ;
             $('.sales_values_class[data-index="'+ index +'"]').each(function(index , field){
                 totalValues+= (isNaN(parseFloat($(field).val())) ? 0 : parseFloat($(field).val()) );
            });
            $(`#total_sales_target_value_item${index + 1 }` ).html(number_format(totalValues));
            updatePercentageFields(index , $(this));            
        });

        function updatePercentageFields(index ,field)
        {
            let columnIndex = field.data('column');
            let totalSalesTarget = parseFloat($('.sales_target_total[data-index="'+ index +'"]').attr('data-value'));
            let value = parseFloat(field.val());
            let percentage = parseFloat((value/totalSalesTarget * 100).toFixed(2)) ;
            $('.sales_target_percentage_class[data-index="'+ index +'"][data-column="'+ columnIndex +'"]' ).val(percentage);
            updateTotalPercentage(index);
        }
        function updateTotalPercentage(index)
        {
            let totalPercentage = 0 ;
            $('.sales_target_percentage_item'+(index+1)).each(function(i , field){
                value = $(field).val() ;
                totalPercentage += (isNaN(value) || value == '' ? 0 : parseFloat(value));
            })
            $('#total_sales_target_percentage_item'+ (index + 1)).html(totalPercentage  + ' %');

        }
    </script>
@endsection
