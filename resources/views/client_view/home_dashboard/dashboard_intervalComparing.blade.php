@extends('layouts.dashboard')
@section('dash_nav')
@include('client_view.home_dashboard.main_navs',['active'=>'interval_dashboard'])

@endsection
@section('css')
<link href="{{ url('assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
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
        <form action="{{route('dashboard.intervalComparing',$company)}}" method="POST">
            @csrf
              <div class="form-group row ">
                  <div class="col-md-3">
                        <label style="margin-right: 10px;"><b>{{__('Comparing Types')}}</b></label>
                  </div>
                <div class="col-md-9">
                    <div class="input-group date" >
                                        <select  data-live-search="true" data-max-options="2" name="types[]" required class="form-control select2-select form-select form-select-2 form-select-solid fw-bolder"
                                            id="types" multiple>
                                            <option disabled value="0
                                            ">{{ __('Types (Two Options As Maxium)') }}</option>
                                            @foreach ($permittedTypes as $name=>$zone)
                                                <option value="{{ $name }}"> {{ __(preg_replace('/(?<!\ )[A-Z]/', ' $0', $zone )) }}</option>
                                                {{-- <option value="{{ $name }}"> {{ __($zone) }}</option> --}}
                                            @endforeach
                                        </select>
                                    </div>
                </div>
                
             
            </div>
            <div class="form-group row ">
              
                <div class="col-md-3">
                    <label><b>{{__('First Inteval')}}</b></label>
                </div>
                <div class="col-md-3">
                    <label>{{__('Start Date One')}}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="start_date_one"  required value="{{$start_date_0}}"  class="form-control"  placeholder="Select date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>{{__('End Date One')}}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="end_date_one" required value="{{$end_date_0}}" max="{{date('Y-m-d')}}"  class="form-control"  placeholder="Select date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>{{__('Note')}} </label>
                    <div class="kt-input-icon">
                        <div class="input-group ">
                                <input type="text" class="form-control" disabled value="{{__('The Report Will Show Max Top 50')}}"  >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row ">
                <div class="col-md-3">
                    <label><b>{{__('Second Inteval')}}</b></label>
                </div>
                <div class="col-md-3">
                    <label>{{__('Start Date Two')}}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="start_date_two"  required value="{{$start_date_1}}"  class="form-control"  placeholder="Select date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>{{__('End Date Two')}}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="end_date_two"  required  value="{{$end_date_1}}" max="{{date('Y-m-d')}}"  class="form-control"  placeholder="Select date" />
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <label>{{__('Data Type')}} </label>
                    <div class="kt-input-icon">
                        <div class="input-group ">
                            <input type="text" class="form-control" disabled value="{{__('Value')}}"  >
                        </div>
                    </div>
                </div>
            </div>



            {{-- <div class="form-group row ">
                <div class="col-md-3">
                    <label><b>{{__('Third Inteval')}}</b></label>
                </div>
                <div class="col-md-3">
                    <label>{{__('Start Date Three')}}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="start_date_three"  required value="{{$start_date_2}}"  class="form-control"  placeholder="Select date" />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>{{__('End Date Three')}}</label>
                    <div class="kt-input-icon">
                        <div class="input-group date">
                            <input type="date" name="end_date_three"  required  value="{{$end_date_2}}" max="{{date('Y-m-d')}}"  class="form-control"  placeholder="Select date" />
                        </div>
                    </div>
                </div>



                <div class="col-md-3">
                    <label>{{__('Data Type')}} </label>
                    <div class="kt-input-icon">
                        <div class="input-group ">
                            <input type="text" class="form-control" disabled value="{{__('Value')}}"  >
                        </div>
                    </div>
                </div>
            </div> --}}

            <x-submitting/>
        </form>
    </div>
</div>

{{-- Title --}}
{{-- <div class="row">
    <div class="kt-portlet ">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{__('Products Items Sales Interval Comparing Analysis')}}
                    </h3>
            </div>
        </div>
    </div>
</div> --}}
   
    {{-- FIRST CARD --}}
    <div class="row">

        
@php $i = 0 @endphp 
@php $k = 0 @endphp 

        @foreach ($intervalComparing as $theType => $intervals)

    <div class="row w-100" style="order:{{ ++$i }}">

          <div style="width:100%" class=" text-center mt-3 mb-3">
                        <div class="kt-portlet ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title head-title text-primary " style="text-transform: capitalize">
                                    <b>{{ (ucfirst(str_replace('_',' ' ,$theType))) . ' Sales Interval Comparing Analysis ' }}</b>
                                </h3>
                        </div>
                    </div>
                </div>
          </div>

        @foreach ($intervals as $intervalName => $data  )
            <div class="col-md-6" >
                <div class="kt-portlet kt-portlet--mobile">
                                    @include('interval_date' , ['k'=>$k % 2 ])

                    <div class="kt-portlet__body">



                        <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll_no_search'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>#</th>
                                    <th>{{ __('Product Items')}}</th>
                                    <th>{{ __('Sales Values') }}</th>
                                    <th>{{ __('Percentages %') }}</th>

                                </tr>
                            @endslot
                            @slot('table_body')
                                @php $total = array_sum(array_column($data,'Sales Value')) @endphp 
                                @foreach ($data as $key => $item)
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

                    </div>
                </div>
            </div>
@php $k = $k+ 1 @endphp 
        
        @endforeach
    </div>


@php $i = $i + 2 @endphp 

     
        @endforeach



























        @php $i =  0  @endphp 
          @foreach ($intervalComparing as $theType => $intervals)
        <div class="row w-100" style="order:{{ ++$i }}">

           <div style="width:100%" class=" text-center mt-3 mb-3">
                        <div class="kt-portlet ">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title head-title text-primary" style="text-transform: capitalize">
                                    <b>{{ (ucfirst(str_replace('_',' ' ,$theType))) . ' Sales Interval Comparing Analysis ' }}</b>
                                </h3>
                        </div>
                    </div>
                </div>
          </div>

          {{-- <div class="container text-center mt-3 mb-3">
              <h2>{{ (ucfirst(str_replace('_',' ' ,$theType))) . ' Sales Interval Comparing Analysis ' }}</h2>
          </div> --}}
        @foreach ($intervals as $intervalName => $data  )
                  <div class="col-md-6">
                <div class="kt-portlet kt-portlet--mobile">

                    

                                 @include('interval_date' , ['i'=>$i %2 ])


                    <div class="kt-portlet__body">


                        <!--begin: Datatable -->

                        <!-- HTML -->
                        <div id="chartdiv{{$theType.$intervalName}}_product_items" class="chartDiv"></div>

                        <!--end: Datatable -->
                    </div>
                </div>
            </div>
       
            <input type="hidden" id="data{{$theType.$intervalName}}_product_items" data-total="{{ json_encode($data) }}">


        @endforeach

    </div>
        @php $i =  $i + 2   @endphp 


        @endforeach



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

    <script src="{{ url('assets/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
<script>
        reinitializeSelect2();
</script>


    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <!-- Chart code -->
    @foreach ($intervalComparing as $theType => $intervals)

        @foreach ($intervals as $intervalName => $data)

        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("chartdiv"+'{{$theType . $intervalName }}'+'_product_items', am4charts.PieChart);

                // Add data
                chart.data = $('#data'+'{{$theType . $intervalName}}'+'_product_items').data('total');
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
    @endforeach
    @endforeach
    <!-- Chart code -->
  @foreach ($intervalComparing as $theType => $intervals)

        @foreach ($intervals as $intervalName => $data)
        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("chartdiv"+'{{$theType .  $intervalName}}', am4charts.PieChart);

                // Add data
                chart.data = $('#data'+'{{$theType . $intervalName}}').data('total');
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
    @endforeach
    @endforeach 
@endsection
