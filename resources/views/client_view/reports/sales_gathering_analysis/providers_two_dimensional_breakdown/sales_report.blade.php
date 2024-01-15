@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }

    </style>
@endsection
@section('sub-header')
    {{ __($view_name) }}
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



    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                </span>
                <h3 class="kt-portlet__head-title">

                    <b> {{ __('From : ') }} </b>{{ $dates['start_date'] }}
                    <b> - </b>
                    <b> {{ __('To : ') }}</b> {{ $dates['end_date'] }}
                    <br>

                    <span class="title-spacing"><b> {{ __('Last Updated Data Date : ') }}</b> {{ $last_date }}</span>
                </h3>
            </div>

        </div>
    </div>

    {{-- <input type="hidden" id="total" data-total="{{ json_encode($report_view_data??[]) }}"> --}}

    <!--begin: Datatable -->

    <x-table   :tableClass="'kt_table_with_no_pagination '">
        @slot('table_header')
            <tr class="table-active text-center">
                <?php $main_type_name = ucwords(str_replace('_', ' ', $main_type)); ?>
                <th>{{ __($main_type_name) . ' / ' . __(ucwords(str_replace('_', ' ', $type))) }}</th>
                @foreach ($all_items as $item)
                    <th>{{ __($item) }}</th>
                @endforeach
                <td>{{ __('Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }}</td>
                @if (isset($totals_sales_per_main_type))
                    <td>{{ __((  'Discounts %'  )) }}</td>
                @endif

            </tr>
        @endslot
        @slot('table_body')
            <?php $total_per_item = []; ?>
            <?php $final_total = array_sum($items_totals);
            $final_percentage = $final_total == 0 ? 0 : (($final_total ?? 0) / $final_total) * 100; ?>
            @foreach ($main_type_items_totals as $main_type_item_name => $main_item_total)
                <tr>
                    <th> {{ __($main_type_item_name) }} </th>

                    @foreach ($all_items as $item)
                        <?php $value = $report_data[$main_type_item_name][$item] ?? 0;
                        $percentage_per_value = $main_item_total == 0 ? 0 : ($value / $main_item_total) * 100; ?>
                        <td class="text-center">
                                {{ number_format($value) }}
                                 {{-- <span class="active-text "><b> {{ '    [ Perc% / ' . $main_type_name . ' ' . number_format($percentage_per_value, 1) . ' % ] ' }}</b></span> --}}


                        </td>
                    @endforeach
                    <?php $total_percentage = $final_total == 0 ? 0 : ($main_item_total / $final_total) * 100; ?>
                    <td class="text-center">
                        {{ number_format($main_item_total) }}
                    </td>
                    @if (isset($totals_sales_per_main_type))
                        <td class="text-center">
                            {{ ($totals_sales_per_main_type[$main_type_item_name]??0) ==0 ?  0  : number_format((($main_item_total/$totals_sales_per_main_type[$main_type_item_name] )*100) , 1) .' %' }}
                        </td>
                    @endif
                </tr>


                {{-- Percentages --}}
                <tr class="secondary-row-color ">
                    <th> {{ __($main_type_item_name) .' %' }} </th>

                    @foreach ($all_items as $item)
                        <?php $value = $report_data[$main_type_item_name][$item] ?? 0;
                        $percentage_per_value = $main_item_total == 0 ? 0 : ($value / $main_item_total) * 100; ?>
                        <td class="text-center">

                            <span class="active-text "><b> {{ number_format($percentage_per_value, 1) . ' %  ' }}</b></span>


                        </td>
                    @endforeach
                    <?php $total_percentage = $final_total == 0 ? 0 : ($main_item_total / $final_total) * 100; ?>
                    <td class="text-center">
                        <span class="active-text "><b> {{   number_format($total_percentage, 1) . ' %  ' }}</b></span>
                    </td>
                    @if (isset($totals_sales_per_main_type))
                        <td class="text-center">-</td>
                    @endif
                </tr>

            @endforeach





            <tr class="table-active text-center">
                <th class="text-center"> {{ __('Total') }} </th>
                @foreach ($all_items as $item_name)
                    <td class="text-center">
                        {{ number_format($items_totals[$item_name] ?? 0) }}
                    </td>
                @endforeach
                <td>{{ number_format($final_total) }}
                    <b>{{ ' [ ' . number_format($final_percentage, 1) . ' % ] ' }}</b>
                </td>
                @if (isset($totals_sales_per_main_type))
                    <td class="text-center">-</td>
                @endif
            </tr>


            <tr class="table-active text-center">
                <th class="text-center"> {{ __(ucwords(str_replace('_', ' ', $type))) . ' % / ' . __('Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }} </th>
                @foreach ($all_items as $item_name)
                    <?php $items_percentage = $final_total == 0 ? 0 : (($items_totals[$item_name] ?? 0) / $final_total) * 100; ?>
                    <td class="text-center">
                        <b> {{   number_format($items_percentage, 1) . ' %' }}</b>
                    </td>
                @endforeach

                <td><b>{{ number_format($final_percentage, 1) . ' %' }}</b></td>
                @if (isset($totals_sales_per_main_type))
                    <td>-</td>
                @endif

            </tr>
            @if (isset($totals_sales_per_main_type))
                <tr class="table-active text-center">
                    <th class="text-center"> {{ __(ucwords(str_replace('_', ' ', $type))) . ' % / Sales'   }} </th>
                    @foreach ($all_items as $item_name)
                        <?php $items_percentage = $total_sales == 0 ? 0 : (($items_totals[$item_name] ?? 0) / $total_sales) * 100; ?>
                        <td class="text-center">
                            <b> {{   number_format($items_percentage, 1) . ' %' }}</b>
                        </td>
                    @endforeach

                    <td><b>{{ number_format((( $total_sales == 0 ? 0 : ($final_total/$total_sales) * 100)), 1) . ' %' }}</b></td>
                    <td class="text-center">-</td>
                </tr>
            @endif
        @endslot
    </x-table>

    <!--end: Datatable -->
@endsection

@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

@endsection
