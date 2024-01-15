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

        .fixTableHead {
            overflow-y: auto;
            height: 110px;
        }

        .fixTableHead thead th {
            position: sticky;
            top: 0;
        }

    </style>
@endsection
@section('content')
    <form action="{{ route('products.allocations', $company) }}" method="POST">
        @csrf
        <div class="kt-portlet" id="copied_company_target">

        </div>
        <?php $name = ($has_product_item == true) ? 'Items' : '' ?>
        {{-- New Products --}}
        @if ($sales_forecast['add_new_products'] == 1)
            <div class="kt-portlet">
                {{-- Monthly Seasonality --}}
                <div class="row ">
                    <div class="col-md-12">
                        <div class="kt-portlet kt-portlet--mobile">

                            <div class="kt-portlet__body">

                                <!--begin: Datatable -->
                                <x-table
                                    :tableTitle="__('New Product '.$name.' Monthly Sales Target Year ') . date('Y',strtotime($sales_forecast->start_date))"
                                    :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                    @slot('table_header')
                                        <tr class="table-active text-center">
                                            <th>{{ __('Dates') }}</th>
                                            @foreach ($new_products_totals as $date => $value)
                                                <th>{{ date('M-Y', strtotime($date)) }}</th>
                                            @endforeach
                                            <th>{{ __('Total Values') }}</th>
                                        </tr>
                                    @endslot
                                    @slot('table_body')
                                        @foreach ($new_products_seasonalities as $product_name => $product_data)
                                            <tr>
                                                <th class="text-center">{{ $product_name }}</th>
                                                @foreach ($new_products_totals as $date => $value)
                                                    <td class="text-center">
                                                        {{ number_format($product_data[$date] ?? 0) }}
                                                    </td>
                                                @endforeach
                                                <td> {{ number_format(array_sum($product_data)) }} </td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-active text-center">
                                            <th>{{ __('Month Total') }}</th>
                                            @foreach ($new_products_totals as $date => $value)
                                                <th>{{ number_format($value) }}</th>
                                            @endforeach
                                            <th> {{ number_format(array_sum($new_products_totals)) }} </th>
                                        </tr>
                                    @endslot
                                </x-table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

                @if((hasProductsItems($company)))

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Sales Forecast') }}
                    </h3>

                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            &nbsp;
                            <a href="{{ route('modify.seasonality', $company) }}" class="btn  active-style btn-icon-sm ">
                                <i class="fas fa-file-import"></i>
                                {{__("Modify Seasonality")}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body ">
                <h2>{{ __('Existing Product '.$name.' Target Year ') .date('Y', strtotime($sales_forecast->start_date)) .' : ' .number_format($existing_products_sales_targets) }}
                </h2>
                <br>
                <br>

        

                <x-table :tableTitle="__('Existing Product '.$name.' Table')" :tableClass="'kt_table_with_no_pagination'">
                    @slot('table_header')
                        <tr class="table-active text-center">
                            <th>{{ __('Product '.$name.' Name') }}</th>
                            @foreach ($monthly_dates as $date => $value)
                                <th>{{ date('M-Y', strtotime($date)) }}</th>
                            @endforeach
                            <th>{{ __('Total') }}</th>
                        </tr>
                    @endslot
                    @slot('table_body')
                        <?php 
                        $totals_per_month = [];

                        ?> 

                        @foreach ($existing_products_targets as $item => $product_data)
                            <?php $total_existing_targets = 0; ?>
                            <tr>
                                <td> <b> {{ $item ?? '-' }}</b></td>

                                @foreach ($product_data as $date => $value)
                            
                                    <?php
                                        $totals_per_month[$date] = $value + ($totals_per_month[$date] ?? 0);
                                        $total_existing_targets += $value;
                                    ?>
                                    <td class="text-center">{{ number_format(($value??0)) }}</td>
                                @endforeach
                                <td class="text-center">{{ number_format($total_existing_targets) }}</td>

                            </tr>
                        @endforeach

                        <tr class="table-active text-center">
                            <td><b> {{ __('Total') }} </b></td>
                            @foreach ($totals_per_month as $date => $value)
                                <td>{{ number_format($value) }}</td>
                            @endforeach
                            <td>{{ number_format(array_sum($totals_per_month)) }}</td>
                        </tr>
                    @endslot
                </x-table>


            </div>
        </div>




                @endif


        <div class="kt-portlet" id="company_target">
            {{-- Monthly Seasonality --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet kt-portlet--mobile">

                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <x-table :tableTitle="__('Total Company Sales Target')"
                                :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                @slot('table_header')
                                    <tr class="table-active text-center">
                                        <th>{{ __('Dates') }}</th>
                                        @foreach ($totals_per_month?:$monthly_dates as $date => $value)
                                            <th>{{ $date }}</th>
                                        @endforeach
                                        <th>{{ __('Total Values') }}</th>
                                    </tr>
                                @endslot
                                @slot('table_body')
                                    <?php $total_existing_new = []; ?>
                                    {{-- New Product Item Sales Target --}}
                                    <tr>
                                        <th>{{ __('New Product '.$name.' Sales Target') }}</th>
                                        @foreach ($new_products_totals as $date => $value)
                                            <?php $total_existing_new[$date] = ($total_existing_new[$date] ?? 0) + $value; ?>
                                            <td>{{ number_format($value) }}</td>
                                        @endforeach
                                        <?php $all_new_products_totals = array_sum($new_products_totals); ?>
                                        <td class="text-center">{{ number_format($all_new_products_totals) }}</td>
                                    </tr>

                                    {{-- Existing Product Item Sales Target --}}
                                    <tr>
                                        <th>{{ __('Existing Product '.$name.' Sales Target') }}</th>
                                        @foreach ($totals_per_month as $date => $value)
                                            <?php $total_existing_new[$date] = ($total_existing_new[$date] ?? 0) + $value; ?>
                                            <td>{{ number_format($value) }}</td>
                                        @endforeach
                                        <?php $all_existings_total = array_sum($totals_per_month); ?>
                                        <td class="text-center">{{ number_format($all_existings_total) }}</td>
                                    </tr>

                                    <tr class="table-active ">
                                        <th class="text-center ">{{ __('Total') }}</th>
                                        @foreach ($total_existing_new as $date => $value)
                                            <td class="text-center">{{ number_format($value) }}</td>
                                        @endforeach
                                        <?php $all_existing_new_total = array_sum($total_existing_new); ?>
                                        <td class="text-center">{{ number_format($all_existing_new_total) }}</td>
                                    </tr>

                                    <tr>
                                        <th>{{ __('New Product '.$name.' Sales %') }}</th>
                                        @foreach ($new_products_totals as $date => $value)
                                            <td>{{ number_format($total_existing_new[$date] == 0 ? 0 : ($value / $total_existing_new[$date]) * 100, 2) . ' %' }}
                                            </td>
                                        @endforeach
                                        <td class="text-center">
                                            {{ number_format($all_existing_new_total == 0 ? 0 : ($all_new_products_totals / $all_existing_new_total) * 100,2) . ' %' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Existing Product '.$name.' Sales %') }}</th>
                                        @foreach ($totals_per_month as $date => $value)
                                            <td>{{ number_format($total_existing_new[$date] == 0 ? 0 : ($value / $total_existing_new[$date]) * 100, 2) . ' %' }}
                                            </td>
                                        @endforeach
                                        <td class="text-center">
                                            {{ number_format($all_existing_new_total == 0 ? 0 : ($all_existings_total / $all_existing_new_total) * 100, 2) .' %' }}
                                        </td>
                                    </tr>
                                @endslot
                            </x-table>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="kt-portlet">
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <button type="submit" class="btn active-style">{{ __('Allocation') }}</button>
                            <a href="{{ route('collection.settings',$company) }}" class="btn btn-secondary active-style">{{__('Skip And Apply Collection')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
        $(document).ready(function() {
            companyTargetContent();
            for (let index = 0; index < '{{ $sales_forecast->number_of_products }}'; index++) {
                totalFunction('.months', '.total_months', index, 0);
                totalFunction('.quarters', '.total_quarters', index, 0);
            }
        });

        function companyTargetContent() {
            var company_targets = $('#company_target').html();
            $('#copied_company_target').html(company_targets);
            $('#company_target').html('');

        };


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
            $(total_field_name).eq(key).val(total.toFixed(decimals));
        }


        $('.products').on('change', function() {
            var name = $(this).find(':selected').data('name');
            var id = $(this).find(':selected').data('id');
            var index = $('.products').index(this);
            $('.categories option').eq(index).remove();
            select = '<option value="' + id + '" selected>' + name + '</option>';
            $('.categories').eq(index).append(select);
        });

        $('.sales_target_value').on('change', function() {
            var index = $('.sales_target_value').index(this);
            var sales_target_value = parseFloat($(this).val());
            var percentage = (sales_target_value / parseFloat("{{ $sales_forecast->sales_target }}")) * 100;
            $('.sales_target_percentage').eq(index).val(percentage.toFixed(2));
        });

        $('.sales_target_percentage').on('change', function() {
            var index = $('.sales_target_percentage').index(this);
            var sales_target_percentage = parseFloat($(this).val()) / 100;
            var value = (sales_target_percentage * parseFloat("{{ $sales_forecast->sales_target }}"));
            $('.sales_target_value').eq(index).val(value.toFixed(0));
        });

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
@endsection
