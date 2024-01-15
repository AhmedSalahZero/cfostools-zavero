@extends('layouts.dashboard')
@section('dash_nav')
<ul class="kt-menu__nav ">
    <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{route('dashboard',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Sales Dashboard')}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.breakdown',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Breakdown Dashboard')}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.customers',$company)}}" class="kt-menu__link active-button"><span class="kt-menu__link-text active-text">{{__('Customers Dashboard')}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.salesPerson', $company) }}"
        class="kt-menu__link "><span class="kt-menu__link-text">{{__("Sales Person Dashboard")}}</span></a>
    </li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.salesDiscount', $company) }}"
            class="kt-menu__link "><span class="kt-menu__link-text">{{__("Sales Discount Dashboard")}}</span></a>
    </li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.intervalComparing', $company) }}"
            class="kt-menu__link "><span class="kt-menu__link-text">{{__("Interval Comparing Dashboard")}}</span></a>
    </li>
</ul>
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
        <form action="{{route('dashboard.customers',$company)}}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-md-10">
                    <label>{{ __('Choose Date') }}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="date" required value="{{ $date }}"
                                max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-5">
                    <label>{{ __('End Date') }}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="end_date"  required value="{{ $end_date }}"
                                max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                        </div>
                    </div>
                </div> --}}
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
                        {{__('Customers Sales Breakdown Analysis')}}
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
                                <th>{{ __('Customers') }}</th>
                                <th>{{ __('Sales Values') }}</th>
                                <th>{{ __('Percentages %') }}</th>

                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php $total = array_sum(array_column($customers_breakdown_data,'Sales Value')) ?>
                            @foreach ($customers_breakdown_data as $key => $item)
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
        <input type="hidden" id="total" data-total="{{ json_encode($customers_breakdown_data) }}">
    </div>

    {{-- Title --}}
    <div class="row">
        <div class="kt-portlet ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">
                            {{__('Customers Natures Analysis')}}
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


                    <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __('Customer Nature') }}</th>
                                <th>{{ __('Count') }}</th>
                                <th>{{ __('Count %') }}</th>
                                <th>{{ __('Sales Value [Yr -') . date('Y',strtotime($date)) .']'}}</th>
                                <th>{{ __('Sales Value %') }}</th>
                                <th>{{ __('View') }}</th>

                            </tr>
                        @endslot
                        @slot('table_body')
                            <?php
                                $data_without_dead_stop = $customers_natures;
                                $dead_stop_data = [
                                    'Stop'=> $customers_natures['Stop'],
                                    'Dead'=> $customers_natures['Dead'],
                                ];
                                unset($data_without_dead_stop['Stop']);
                                unset($data_without_dead_stop['Dead']);
                                $total_count = array_sum(array_column($data_without_dead_stop,'count')) ;



                                $total_sales_values = array_sum(array_column($data_without_dead_stop,'Total Sales Values')) ;
                                $total_count_percentage = 0;
                                $total_sales_values_percentage = 0;
                            ?>
                            @foreach ($data_without_dead_stop as $customer_nature => $customer_data)
                                <?php
                                    $id = str_replace(['/',' '],'',$customer_nature);
                                ?>
                                <?php
                                    $customer_count = $customer_data['count'] ?? 0;
                                    $customer_sales_value = $customer_data['Total Sales Values'] ?? 0;
                                    $count_percentage = $total_count == 0 ? 0 : (($customer_count/$total_count)*100) ;
                                    $sales_values_percentage = $total_sales_values == 0 ? 0 : (($customer_sales_value/$total_sales_values)*100) ;
                                    $total_count_percentage += $count_percentage;
                                    $total_sales_values_percentage += $sales_values_percentage;
                                ?>
                                <tr>
                                    <th>{{$customer_nature}}</th>
                                    <td class="text-center">{{$customer_count}}</td>
                                    <td class="text-center">{{ number_format($count_percentage , 1) . ' %'}}</td>
                                    <td class="text-center">{{number_format($customer_sales_value)}}</td>
                                    <td class="text-center">{{number_format($sales_values_percentage , 1) . ' %'}}</td>
                                    @if ($customer_count > 0)
                                        <td class="text-center"><button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{$id}}"> {{__($customer_nature.' - Customers')}}</button></td>
                                    @else
                                        <td  class="text-center"><b>{{__('No Customers')}}</b></td>
                                    @endif
                                </tr>

                            @endforeach
                            <tr class="table-active text-center">
                                <th>{{__('Total')}}</th>
                                <td>{{number_format($total_count)}}</td>
                                <td>{{number_format($total_count_percentage) . '%'}}</td>
                                <td>{{number_format($total_sales_values)}}</td>
                                <td>{{number_format($total_sales_values_percentage) . '%'}}</td>
                                <td><b>-</b></td>
                            </tr>
                            {{-- Dead & Stop --}}
                            @foreach ($dead_stop_data as $customer_nature => $customer_data)
                                <?php
                                    $id = str_replace(['/',' '],'',$customer_nature);
                                ?>
                                <?php
                                    $customer_count = $customer_data['count'] ?? 0;
                                    $customer_sales_value = $customer_data['Total Sales Values'] ?? 0;
                                    $count_percentage = $total_count == 0 ? 0 : (($customer_count/$total_count)*100) ;
                                    $sales_values_percentage = $total_sales_values == 0 ? 0 : (($customer_sales_value/$total_sales_values)*100) ;
                                    // $total_count_percentage += $count_percentage;
                                    // $total_sales_values_percentage += $sales_values_percentage;
                                ?>
                                <tr>
                                    <th>{{$customer_nature}}</th>
                                    <td class="text-center">{{$customer_count}}</td>
                                    <td class="text-center">{{ number_format($count_percentage , 1) . ' %'}}</td>
                                    <td class="text-center">{{number_format($customer_sales_value)}}</td>
                                    <td class="text-center">{{number_format($sales_values_percentage , 1) . ' %'}}</td>
                                    @if ($customer_count > 0)
                                        <td class="text-center"><button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{$id}}"> {{__($customer_nature.' - Customers')}}</button></td>
                                    @else
                                        <td  class="text-center"><b>{{__('No Customers')}}</b></td>
                                    @endif
                                </tr>

                            @endforeach
                        @endslot
                    </x-table>

                    <!--end: Datatable -->

                    @foreach ($customers_natures as $customer_nature => $customer_data)
                        <?php
                            $id = str_replace(['/',' '],'',$customer_nature);
                        ?>
                        {{-- View Modals --}}
                        @if (($customer_data['count'] ??0) > 0)
                            <!--begin::Modal-->
                            <div class="modal fade" id="kt_modal_{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{__($customer_nature.' Customers')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <div class="kt-scroll" data-scroll="true" data-height="200"> --}}
                                                <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                                    @slot('table_header')
                                                        <tr class="table-active text-center">

                                                            <th>{{ __('Customer Name') }}</th>
                                                            {{-- <th>{{ __('Sales Values') }}</th> --}}
                                                        </tr>
                                                    @endslot
                                                    @slot('table_body')

                                                        @foreach ($customer_data['customers']??[] as $customer)
                                                            <tr>
                                                                <td>{{$customer}}</td>
                                                                {{-- <td>{{number_format($customer['sales_value']??0)}}</td> --}}
                                                            </tr>
                                                        @endforeach
                                                    @endslot
                                                </x-table>
                                            {{-- </div> --}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal-->
                        @endif
                @endforeach
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
