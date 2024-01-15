@extends('layouts.dashboard')
@section('dash_nav')
@include('client_view.home_dashboard.main_navs',['active'=>'discount_dashboard'])
@endsection
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }

    </style>
@endsection
@section('content')
<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title head-title text-primary">
                {{ __('Dashboard Results') }}
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <form action="{{route('dashboard.salesDiscount',$company)}}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-md-5">
                    <label>{{ __('Start Date') }}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="start_date" required value="{{ $start_date }}"
                                max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <label>{{ __('End Date') }}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="end_date"  required value="{{ $end_date }}"
                                max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                    <label> </label>
                    <div class="kt-input-icon">
                        <button type="submit" class="btn active-style">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    {{-- Title --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{__('Sales Discounts Breakdown Analysis')}}
                        </h3>
                </div>
            </div>
        </div>
    </div>
    {{-- FIRST CARD --}}
    <div class="row">
        <div class="col-md-6">
            <div class="kt-portlet kt-portlet--mobile">

                <div class="kt-portlet__body">

                    <!--begin: Datatable -->

                    <!-- HTML -->
                    <div id="chartdiv" class="chartDiv"></div>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="kt-portlet kt-portlet--mobile">

                <div class="kt-portlet__body">

                    <!--begin: Datatable -->


                    <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>#</th>
                                <th>{{ __('Sales Discount') }}</th>
                                <th>{{ __('Discount Values') }}</th>
                                <th>{{ __('Percentages %') }}</th>

                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $total = array_sum(array_column($sales_discount_bd,'Sales Value')) ?>
                            @foreach ($sales_discount_bd as $key => $item)
                            <tr>
                                <th>{{$key+1}}</th>
                                <th>{{$item['item']?? '-'}}</th>
                                <td class="text-center">{{number_format($item['Sales Value']??0)}}</td>
                                <td class="text-center">{{$total == 0 ? 0 : number_format((($item['Sales Value']/$total)*100) , 1) . ' %'}}</td>
                            </tr>
                            @endforeach
                            <tr class="table-active text-center">
                                <th colspan="2">{{__('Total')}}</th>
                                <td class="hidden"></td>
                                <td>{{number_format($total)}}</td>
                                <td>100 %</td>
                            </tr>
                        @endslot
                    </x-table>

                    <!--end: Datatable -->
                </div>
            </div>
        </div>
        <input type="hidden" id="total" data-total="{{ json_encode($sales_discount_bd) }}">
    </div>

    {{-- Title --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{__('Sales Channels Versus Discounts')}}
                        </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Second CARD --}}
    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--mobile">

                <div class="kt-portlet__body">
                    <!--begin: Datatable -->
                    <x-table   :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">

                                <th>{{ __('Sales Channel / Discounts') }}</th>
                                <?php

                                    $all_items = $sales_channels_discounts['all_items'];
                                    $items_totals = $sales_channels_discounts['items_totals'];
                                    $report_data = $sales_channels_discounts['report_data'];
                                    $main_type_items_totals = $sales_channels_discounts['main_type_items_totals'];
                                    $totals_sales_per_main_type = $sales_channels_discounts['totals_sales_per_main_type'];
                                    $total_sales = $sales_channels_discounts['total_sales'];
                                ?>
                                @foreach ($all_items as $item)
                                    <th>{{ __($item) }}</th>
                                @endforeach
                                <td>{{ __('Total Discounts')}}</td>
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

                                            <span  ><b> {{ number_format($percentage_per_value, 1) . ' %  ' }}</b></span>


                                        </td>
                                    @endforeach
                                    <?php $total_percentage = $final_total == 0 ? 0 : ($main_item_total / $final_total) * 100; ?>
                                    <td class="text-center">
                                        <span><b> {{   number_format($total_percentage, 1) . ' %  ' }}</b></span>
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
                                <th class="text-center"> {{ __('Discounts % / Total Discounts')  }} </th>
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
                                    <th class="text-center"> {{ __('Discounts % / Sales')  }} </th>
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.PieChart);

        // Add data
        chart.data = $('#total').data('total');
        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "Sales Value";
        pieSeries.dataFields.category = "item";
        pieSeries.innerRadius = am4core.percent(50);
        // arrow
        pieSeries.ticks.template.disabled = true;
        //number
        pieSeries.labels.template.disabled = true;

        var rgm = new am4core.RadialGradientModifier();
        rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, -0.5);
        pieSeries.slices.template.fillModifier = rgm;
        pieSeries.slices.template.strokeModifier = rgm;
        pieSeries.slices.template.strokeOpacity = 0.4;
        pieSeries.slices.template.strokeWidth = 0;

        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";
    chart.legend.scrollable = true;

    }); // end am4core.ready()
</script>
@endsection
