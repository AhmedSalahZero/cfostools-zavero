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
    <form action="{{ route('save.modify.seasonality', $company) }}" method="POST">
        @csrf



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
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <label class="kt-option bg-secondary">
                            <span class="kt-option__control">
                                <span
                                    class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                    checked>
                                    <input class="rows" name="use_modified_seasonality" type="checkbox"
                                    value="1" {{ @$modified_seasonality->use_modified_seasonality  == 0 ?: 'checked' }}
                                        id="product_item_check_box">
                                    <span></span>
                                </span>
                            </span>
                            <span class="kt-option__label d-flex">
                                <span class="kt-option__head mr-auto p-2">
                                    <span class="kt-option__title">
                                        <b>
                                            {{ __('Click To Activate Modified Seasonality') }}
                                        </b>
                                    </span>

                                </span>
                            </span>
                        </label>
                    </div>

                </div>
                <br>
                <br>

                <x-table :tableTitle="__('New Product Items Table')" :tableClass="'kt_table_with_no_pagination'">
                    @slot('table_header')
                        <tr class="table-active text-center">
                            <th>{{ __('Product Item Name') }}</th>
                            @foreach ($monthly_dates as $date => $value)
                                <th>{{ date('M-Y', strtotime($date)) }}</th>
                            @endforeach
                            <th> {{__("Total Year")}} </th>
                        </tr>
                    @endslot
                    @slot('table_body')
                    <?php $product_id = 1; ?>
                        @foreach ($product_item_breakdown_data as $key => $product_data)

                            <tr>
                                <td> <b> {{ $product_data['item'] ?? '-' }} </b></td>

                                @foreach ($monthly_dates as $date => $value)
                                    <?php
                                    $date = date('M-Y', strtotime($date));
                                    $month = date('F', strtotime($date));

                                    $item_name = $product_data['item'];

                                    $item_name = strstr($product_data['item'], 'Others') !== false ? 'Others' : $product_data['item'];

                                    $percentage = $products_items_monthly_percentage[$item_name][$month] ?? 0;

                                    ?>
                                    <td class="text-center"><input type="number" class="form-control percentage_{{$product_id}}" step="any" name="modified_seasonality[{{$product_data['item']}}][{{$month}}]" value="{{ number_format(($percentage*100) , 4) }}"></td>
                                @endforeach
                                <td class="percentage_total_{{$product_id}}">

                                </td>
                            </tr>
                            <?php $product_id++; ?>
                        @endforeach
                    @endslot
                </x-table>

            </div>
        </div>

        <div class="kt-portlet">
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                            {{-- <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <button type="submit" class="btn active-style">{{ __('Allocation') }}</button>
                            {{-- <button type="reset" class="btn btn-secondary">{{__('Cancel')}}</button> --}}
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
<?php $product_id = 1; ?>
@foreach ($product_item_breakdown_data as $key => $product_data)
    <script>
        $(document).ready(function () {
            totalPercentage("{{$product_id}}");
        });
        $('.percentage_'+"{{$product_id}}").change(function () {
            totalPercentage("{{$product_id}}");

        });

    </script>
    <?php $product_id++; ?>
@endforeach
<script>
        function totalPercentage(id) {
            total = 0;

            $('.percentage_'+id).each(function(index, element) {
                if (element.value !== '') {
                    total = parseFloat(element.value) + total;
                }

            });

                total = total.toFixed(2)+' %';


            $('.percentage_total_'+id).html(total);
         }
</script>
@endsection

