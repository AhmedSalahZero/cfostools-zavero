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
    <form action="{{ route('new.product.seasonality', $company) }}" method="POST">
        @csrf

        @if($new_products_allocations)
        <?php $total_products_items = [];
              $allocation_base = str_replace('_', ' ', ucwords($new_products_allocations->allocation_base)) ;?>

        @if (count($products_seasonality)>0)
            <div class="kt-portlet">
                <div class="kt-portlet__body ">

                    <x-table :tableTitle="__($allocation_base.' Against New Product Items Table')" :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __($allocation_base .' / Months') }}</th>
                                @foreach ($allocation_data_total['Total'] as $date => $value)
                                    <th>{{ $date }}</th>
                                @endforeach
                                <th> {{ __('Total Year') }} </th>
                            </tr>
                        @endslot
                        @slot('table_body')
                                @php
                                    sortTwoDimensionalExcept($allocation_data_total , ['Total'] );

                                @endphp
                            @foreach ($allocation_data_total as $base_name => $value)
                            <?php $class_name = $base_name == 'Total' ? 'active-style' : '' ; ?>
                                <tr>
                                    <td class="{{$class_name}}">{{ $base_name }}</td>
                                    @foreach ($allocation_data_total['Total'] as $date => $total)
                                        <?php
                                            $total_products_items[$base_name][$date] = ($value[$date] ?? 0);
                                        ?>
                                        <td class="text-center {{$class_name}}"> {{ number_format($value[$date] ?? 0) }} </td>
                                    @endforeach
                                    <td class="{{$class_name}}" >{{number_format(array_sum($value))}}</td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>

                </div>
            </div>
        @endif
        @else
        @php
            $allocation_base = '';
        @endphp
        @endif
        {{-- Existing Products  --}}

        @if(hasProductsItems($company))
        <div class="kt-portlet">
            <div class="kt-portlet__body ">
                <x-table :tableTitle="__($allocation_base.' Against Existing Product Items Table')" :tableClass="'kt_table_with_no_pagination'">
                    @slot('table_header')
                        <tr class="table-active text-center">
                            <th>{{ __($allocation_base .' / Months') }}</th>
                            @foreach ($existing_product_data['Total'] ?? [] as $date => $value)
                                <th>{{ date('M-Y',strtotime('01-'.$date.'-'.$year)) }}</th>
                            @endforeach
                            <th> {{ __('Total Year') }} </th>
                        </tr>
                    @endslot
                    @slot('table_body')
                    @php

                 sortTwoDimensionalExcept($existing_product_data , ['Total'] );

                       @endphp
                        @foreach ($existing_product_data as $base_name => $value)
                            <?php
                                $class_name = $base_name == 'Total' ? 'active-style' : '' ;

                            ?>
                            <tr>
                                <td class="{{$class_name}}">{{ $base_name }}</td>
                                @foreach ($existing_product_data['Total'] ?? [] as $date => $total)
                                    <?php
                                        $full_date = date('M-Y',strtotime('01-'.$date.'-'.$year));
                                        $total_products_items[$base_name][$full_date] = ($value[$date] ?? 0) + ($total_products_items[$base_name][$full_date]??0);
                                    ?>
                                    <td class="text-center {{$class_name}}"> {{ number_format($value[$date] ?? 0) }} </td>
                                @endforeach
                                <td class="{{$class_name}}" >{{number_format(array_sum($value))}}</td>
                            </tr>
                        @endforeach

                    @endslot
                </x-table>

            </div>
        </div>
        @endif 
             @if (count($products_seasonality)>0)
            {{-- Total --}}
            <div class="kt-portlet">
                <div class="kt-portlet__body ">
                    <?php
                        $total = $total_products_items['Total'] ?? [];
                        unset($total_products_items['Total']);
                        arsort($total_products_items);
                        $total_products_items['Total'] = $total;
                    ?>
                    <x-table :tableTitle="__('Total '.$allocation_base.' Monthly Sales Target Table')" :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __($allocation_base .' / Months') }}</th>
                                @foreach ($total_products_items['Total'] as $date => $value)
                                    <th>{{ $date }}</th>
                                @endforeach
                                <th> {{ __('Total Year') }} </th>
                            </tr>
                        @endslot
                        @slot('table_body')
          @php

    sortTwoDimensionalExcept($total_products_items , ['Total'] );

@endphp
                            @foreach ($total_products_items as $base_name => $value)
                            <?php $class_name = $base_name == 'Total' ? 'active-style' : '' ; ?>
                                <tr>
                                    <td class="{{$class_name}}">{{ $base_name }}</td>
                                    @foreach ($total_products_items['Total'] as $date => $total)
                                        <?php $total_value = ($existing_product_data_with_dates[$base_name][$date]??0) + ($value[$date]??0) ?>
                                        <td class="text-center {{$class_name}}"> {{ number_format($total_value ?? 0) }} </td>
                                    @endforeach
                                    <td class="{{$class_name}}" >{{number_format(array_sum($value))}}</td>
                                </tr>
                            @endforeach
                        @endslot
                    </x-table>

                </div>
            </div>
        @endif
        {{-- Submit --}}
        <div class="kt-portlet">
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                            {{-- <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <button type="submit" class="btn active-style">{{ __('Second Allocation') }}</button>
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
@endsection
