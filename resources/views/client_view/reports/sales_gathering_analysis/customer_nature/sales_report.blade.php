@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
        <style>
            .chartdiv {
                width: 100% !important;height: 500px !important;
            }

        </style>
@endsection
@section('sub-header')
    {{ __($view_name) }}
@endsection
@section('content')

    <div class="row">
        @foreach ($reportDataFormatted as $chart_name => $chart_data)

            <div class="col-md-6">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                <b> {{__('From : ')}} </b>{{ $dates['start_date']}}
                                <b> - </b>
                                <b> {{__('To : ') }}</b> {{ $dates['end_date']}}
                                <br>

                                <span class="title-spacing"><b> {{__('Last Updated Data Date : ') }}</b> {{ $last_date}}</span>
                                <br>
                                <span class="title-spacing"><h3> {{ucwords(str_replace('_',' ',$chart_name))}}</h3></span>
                            </h3>
                        </div>

                    </div>
                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->

                        <!-- HTML -->
                        <div id="chartdiv{{formatChartNameForDom($chart_name)}}" class="chartdiv"></div>

                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
            <input type="hidden" id="data{{formatChartNameForDom($chart_name)}}" data-total="{{ json_encode($chart_data) }}">
        @endforeach
    </div>
    {{-- Tables --}}
    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">

                            <b> {{__('From : ')}} </b>{{ $dates['start_date']}}
                            <b> - </b>
                            <b> {{__('To : ') }}</b> {{ $dates['end_date']}}
                            <br>

                            <span class="title-spacing"><b> {{__('Last Updated Data Date : ') }}</b> {{ $last_date}}</span>
                        </h3>
                    </div>

                </div>
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
                        
                            @php 
                            $totalCount = array_sum(array_map("count", $customers_natures['statictics'])) ;
                            $totalSales = 0 ;
                            foreach( $customers_natures['statictics']  as $key => $val ){
                                $totalSales += array_sum ( array_column($val , 'total_sales') );
                                
                                                                }

                              @endphp

                            @foreach($customers_natures['statictics'] as $staticName=>$vals)
                            @php
                             $countVals = count($vals) ;
                            $totalSaleForCustomerType = array_sum(array_column($vals,'total_sales'));
                              @endphp
                                <tr>
                                    <th>{{$staticName}}</th>
                                    <td class="text-center">{{$countVals}}</td>
                                    <td class="text-center">{{ $totalCount ? number_format(($countVals / $totalCount)*100 , 1 ) . ' %' : 0 }}</td>

                                    <td class="text-center">{{number_format($totalSaleForCustomerType,0)}}</td>

                                    <td class="text-center">{{ $totalSales ? number_format(($totalSaleForCustomerType / $totalSales)*100 , 1 ) . ' %' : 0 }}</td>

                                    @if ($countVals > 0) 
                                    
                                        <td class="text-center"><button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{str_replace(["/" ,' ' ] , '-' , $staticName)}}"> 
                                        {{__($staticName.' - Customers')}}
                                        </button>

                                        
                                        
                                           @if ($countVals > 0)
                            <div class="modal fade" id="kt_modal_{{str_replace(["/" ,' ' ] , '-' , $staticName)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{__($staticName.' Customers')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                                    @slot('table_header')
                                                        <tr class="table-active text-center">

                                                            <th>{{ __('Customer Name') }}</th>
                                                            <th>{{ __('Sales') }}</th>
                                                            <th>{{ __('Percentage') }}</th>
                                                        </tr>
                                                    @endslot
                                                    @slot('table_body')
                                                        @php
                                                        $totalForThisCategory = array_sum(array_column($vals,'total_sales')) ;
                                                        @endphp 
                                                        @foreach ($vals as $customer)
                                                            <tr>
                                                                <td>{{$customer->customer_name}}</td>
                                                                <td>{{$customer->total_sales ? number_format($customer->total_sales) : 0}}</td>
                                                                <td>{{$customer->total_sales && $totalForThisCategory ? number_format(($customer->total_sales/$totalForThisCategory)*100 , 2) . ' %' : 0}} </td>
                                                            </tr>
                                                            @if($loop->last)
                                                            <tr>
                                                                <td>
                                                                    {{ __('Total') }}
                                                                </td>
                                                                <td>
                                                                    {{ number_format($totalForThisCategory , 2 ) }}
                                                                </td>
                                                                <td>
                                                                    100 %
                                                                </td>
                                                            </tr>
                                                            @endif 
                                                        @endforeach
                                                    @endslot
                                                </x-table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                                        </td>
                                    @else
                                        <td  class="text-center"><b>{{__('No Customers')}}</b></td>

                                    @endif
                                </tr>
                                @endforeach 
                            <tr class="table-active text-center">
                                <th>{{__('Total')}}</th>
                                <td>{{number_format($totalCount)}}</td>
                                <td>{{number_format(100) . '%'}}</td>
                                <td>{{number_format($totalSales)}}</td>
                                <td>{{number_format(100) . '%'}}</td>
                                <td><b>-</b></td>
                            </tr>
                             @php 
                            $totalCount = array_sum(array_map("count", $customers_natures['stops'])) ;
                            foreach( $customers_natures['stops']  as $key => $val ){
                                }
                              @endphp
                            @foreach ($customers_natures['stops'] as $name => $vals)
                             @php
                             $countVals = count($vals) ;
                            $totalSaleForCustomerType = array_sum(array_column($vals,'total_sales'));
                              @endphp
                                <tr>
                                    <th>{{$name}}</th>
                                    <td class="text-center">{{$countVals}}</td>
                                       <td class="text-center">
                                           --
                                           {{-- {{ $totalCount ? number_format(($countVals / $totalCount)*100 , 1 ) . ' %' : 0 }} --}}
                                           </td>
                                    <td class="text-center">{{number_format($totalSaleForCustomerType,0)}}</td>
                                   <td class="text-center">{{ $totalSales ? number_format(($totalSaleForCustomerType / $totalSales)*100 , 1 ) . ' %' : 0 }}</td>
                                    @if ($countVals > 0)
                                        <td class="text-center"><button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{str_replace(["/" .' ' ] , '-' , $name)}}"> {{__($name.' - Customers')}}</button></td>
                                    @else
                                        <td  class="text-center"><b>{{__('No Customers')}}</b></td>
                                    @endif
                                </tr>

                            @endforeach
                        @endslot
                    </x-table>

                    @foreach ($customers_natures['stops'] as $name => $vals)
                      
                        @if ($countVals > 0)
                            <div class="modal fade" id="kt_modal_{{str_replace(["/" .' ' ] , '-' , $name)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{__($name.' Customers')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                                    @slot('table_header')
                                                        <tr class="table-active text-center">

                                                            <th>{{ __('Customer Name') }}</th>

                                                                  <th>{{ __('Sales') }}</th>
                                                            <th>{{ __('Percentage') }}</th>


                                                        </tr>
                                                    @endslot
                                                    @slot('table_body')
                                                      @php
                                                        $totalForThisCategory = array_sum(array_column($vals,'total_sales')) ;
                                                        @endphp 

                                                        @foreach ($vals as $customer)
                                                            <tr>
                                                                <td>{{$customer->customer_name}}</td>
                                                                    <td>{{$customer->total_sales ? number_format($customer->total_sales) : 0}}</td>
                                                                <td>{{$customer->total_sales && $totalForThisCategory ? number_format(($customer->total_sales/$totalForThisCategory)*100 , 2) . ' %' : 0}} </td>

                                                            </tr>

                                                            @if($loop->last)
                                                            <tr>
                                                                <td>
                                                                    {{ __('Total') }}
                                                                </td>
                                                                <td>
                                                                    {{ number_format($totalForThisCategory , 2 ) }}
                                                                </td>
                                                                <td>
                                                                    100 %
                                                                </td>
                                                            </tr>
                                                            @endif 
                                                            
                                                        @endforeach
                                                    @endslot
                                                </x-table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                      @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <!-- Chart code -->
    @foreach ($reportDataFormatted as $chart_name => $chart_data)

        <script>
            
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                
                var chart = am4core.create("chartdiv"+"{{formatChartNameForDom($chart_name)}}", am4charts.PieChart);

                // Add data
                chart.data = $('#data'+"{{formatChartNameForDom($chart_name)}}").data('total');
                // Add and configure Series
                var pieSeries = chart.series.push(new am4charts.PieSeries());
                pieSeries.dataFields.value = "val";
                pieSeries.dataFields.category = "name";
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
                chart.legend.maxWidth = 300;
            }); 
        </script>
    @endforeach
@endsection
