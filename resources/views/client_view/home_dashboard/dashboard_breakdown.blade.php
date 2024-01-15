@extends('layouts.dashboard')
@section('dash_nav')
@include('client_view.home_dashboard.main_navs',['active'=>'breadkdown_dashboard'])

{{-- <ul class="kt-menu__nav ">
    <li class="kt-menu__item  kt-menu__item" aria-haspopup="true"><a href="{{route('dashboard',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__('Sales Dashboard')}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.breakdown',$company)}}" class="kt-menu__link active-button"><span class="kt-menu__link-text active-text">{{__("Breakdown Dashboard")}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{route('dashboard.customers',$company)}}" class="kt-menu__link "><span class="kt-menu__link-text">{{__("Customers Dashboard")}}</span></a></li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.salesPerson', $company) }}"
        class="kt-menu__link "><span class="kt-menu__link-text">{{__("Sales Person Dashboard")}}</span></a>
    </li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.salesDiscount', $company) }}"
            class="kt-menu__link "><span class="kt-menu__link-text">{{__("Sales Discount Dashboard")}}</span></a>
    </li>
    <li class="kt-menu__item  kt-menu__item " aria-haspopup="true"><a href="{{ route('dashboard.intervalComparing', $company) }}"
            class="kt-menu__link "><span class="kt-menu__link-text">{{__("Interval Comparing Dashboard")}}</span></a>
    </li>
</ul> --}}
@endsection
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }
        /* .dataTables_wrapper{max-width: 100%;  padding-bottom: 50px !important;overflow-x: overlay;max-height: 4000px;} */
    </style>

    <style>
        .swal-wide{
    width:850px;
}

.custom_width_classs
{
    width:600px;
}
.close_custom_modal{
    position: absolute;top: 5px;right: 47px;color: #c8c3c6;font-size: 1.5rem;
}
.datatable_modal_div{
    top: 50%;
left: 50%;
transform: translate(-50% , -50%);
    position: fixed;
    overflow-y: scroll;
    overflow-x: hidden;
    max-height:80vh;
    width:90%;
    z-index: 9;
    padding:3rem 2rem ;

}
.container__fixed{
    position: fixed;
    top:0;
    left:0;
    bottom:0;
    right:0;
    background-color:rgba(0 , 0 , 0 , 0.3);
    display: none;
    overflow: scroll;

}
.header___bg
{
    background-color:#086691 !important;
    color:#fff !important; 
}
    </style>
@endsection
@section('content')

@php
     $exportableFields  = (new \App\Http\Controllers\ExportTable)->customizedTableField($company, 'SalesGathering', 'selected_fields');
     $exportableFieldsValues = array_keys($exportableFields);
    if(in_array('document_type' , $exportableFieldsValues) && in_array('document_number' , $exportableFieldsValues) )
    {
    $exportableFieldsValues[] = 'invoice_count';
    $exportableFieldsValues[] = 'product_item_avg_count';
    $exportableFieldsValues[] = 'avg_invoice_value';
    }
@endphp

    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title head-title text-primary">
                    {{ __('Dashboard Results') }}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <form action="{{route('dashboard.breakdown',$company)}}" method="POST">
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
                                <input type="date" name="end_date" required value="{{ $end_date}}"
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

            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title head-title text-primary">

                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body  kt-portlet__body--fit">
                    <div class="row row-no-padding row-col-separator-xl">
                        @foreach ($types as $type => $color)

                        
                  
                            <div class="col-md-4">
                                <!--begin::Total Profit-->
                                <div class="kt-widget24 text-center">
                                    <div class="kt-widget24__details">
                                        <div class="kt-widget24__info w-100">
                                            <h4 class="kt-widget24__title font-size justify-content-between">
                                               
                                                <span>{{ __('Top '. ucwords(str_replace('_',' ',$type))) }}</span>
                                                <p>

                                                    <button type="button" class="btn text-white btn-small btn-{{ $color }}" data-toggle="modal" data-target="#modal_for_{{ $type }}">
                                                        {{ __('Take Away') }}
                                                    </button>




                                                    {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#test_{{ $type }}" class="btn btn-{{ $color }} btn-sm text-white">{{ __('Tip') }}</button> --}}
                                                </p>
                                            </h4>
                                        </div>
                                    </div>


                                                    <div class="modal fade bd-example-modal-lg modal__class_top_bottom"  id="modal_for_{{ $type }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left"  id="exampleModalLabel " style="line-height: 2">{{ ucwords(str_replace('_',' ',$type)) . ' - ' . __('Take Aways') }} <br> 
        {{ __('From:') . ' ' .  \Carbon\Carbon::make($start_date)->format('d-M-Y')  .' ' . __('To:') . ' ' . \Carbon\Carbon::make($end_date)->format('d-M-Y')  }} 
        
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @php
              $businessSectors = getTypeFor($type,$company->id,false);
          @endphp
          <input type="hidden" name="company_id" value="{{ $company->id }}">
          <input type="hidden" name="type" value="{{ $type }}">
          <label class="text-left font-weight-bold  w-100 mb-3 text-black">{{ __('Please Select') }}  {{ ucwords(str_replace('_',' ',$type)) }}</label>
          <select id="business_sector_select_{{ $type }}" data-live-search="true" data-actions-box="true" name="selected_type" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" >
              @foreach($businessSectors as $businesSector)
              <option value="{{ $businesSector }}"> {{ __($businesSector) }} </option>
              @endforeach 
          </select>

          <table class="table table-bordered mt-5 datatable" id="" style="table-layout: fixed">
              <tr class="text-white" style="background-color:#086691">
                  <th> {{ __('Item') }} </th>
                  <th> {{ __('Value') }} </th>
              </tr>






                   <tr >
                  <td   class="text-left">{{ __(ucwords(str_replace('_',' ',$type))) . ' ' . __('Name') }} </td>
                  <td id="selected_type_name">{{ __('Value') }}</td>
              </tr>


                 <tr >
                  <td   class="text-left">{{ __('Sales Value') }} </td>
                  <td id="total_sales_value">{{ __('Value') }}</td>
              </tr>

              @foreach( getFieldsForTakeawayForType($type) as $id=>$item)
               @if(in_array($id , $exportableFieldsValues))
               <tr >
                  <td  class="text-left">{{ __($item) }} 
                  @if(hasTopAndBottom($id))

                  <div class="" style="float:right;">
                                       <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm ml-5 mr-1 ranged-button-ajax"  data-direction="top" data-type="{{ $type }}" data-column="{{ $id }}">{{ __('Top 50') }}</button>
                                           <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="{{ $id }}">{{ __('Bottom 50') }}</button>
                  </div>
                           @endif 
                  {{-- @if($id == 'customer_name')
                        <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm ml-5 mr-1 ranged-button-ajax"  data-direction="top" data-type="{{ $type }}" data-column="customer_name">{{ __('Top 50') }}</button>
                       <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="customer_name">{{ __('Bottom 50') }}</button>
                  @endif  --}}

                  {{-- @if($id == 'product_item')
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm mr-1 ml-5 ranged-button-ajax" data-direction="top" data-type="{{ $type }}" data-column="product_item"> {{ __('Top 50') }}</button>
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="product_item"> {{ __('Bottom 50') }}</button>
                  @endif 

                     @if($id == 'product_or_service')
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm mr-1 ml-5 ranged-button-ajax" data-direction="top" data-type="{{ $type }}" data-column="product_or_service"> {{ __('Top 50') }}</button>
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="product_or_service"> {{ __('Bottom 50') }}</button>
                  @endif 

                   @if($id == 'zone')
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm mr-1 ml-5 ranged-button-ajax" data-direction="top" data-type="{{ $type }}" data-column="zone"> {{ __('Top 50') }}</button>
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="zone"> {{ __('Bottom 50') }}</button>
                  @endif 



                  @if($id == 'business_sector')
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm mr-1 ml-5 ranged-button-ajax" data-direction="top" data-type="{{ $type }}" data-column="business_sector"> {{ __('Top 50') }}</button>
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="business_sector"> {{ __('Bottom 50') }}</button>
                  @endif  --}}

                  
                  </td>
                  <td id="{{ $id }}">-</td>
              </tr>
              @endif




              @endforeach 
              
          </table>
          <div class="row ">
              {{-- <div class="col-12 my-5 ">
                       <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm mr-5 ranged-button-ajax"  data-direction="top" data-type="{{ $type }}" data-column="customer_name">{{ __('Top 50 Customers') }}</button>
                       <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="customer_name">{{ __('Bottom 50 Customers') }}</button>
              </div> --}}
              {{-- <div class="col-12 pb-2">
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm mr-5 ranged-button-ajax" data-direction="top" data-type="{{ $type }}" data-column="product_item"> {{ __('Top 50 Products Item') }}</button>
                  <button style="background-color:#086691 ; color:#fff" class="btn  btn-sm text-white ranged-button-ajax" data-direction="bottom" data-type="{{ $type }}" data-column="product_item"> {{ __('Bottom 50 Products Item') }}</button>
              </div> --}}
          </div>
     
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        {{-- <button id="recalc_modal" type="button" class="btn btn-primary">{{ __('Run') }}</button> --}}
      </div>
    </div>
  </div>
</div>




                                    <div class="kt-widget24__details">
                                        <span class="kt-widget24__stats kt-font-{{$color}}" style="font-size:1.4rem">
                                            {{ __( '[ ' .($top_data[$type]['item'] ?? ' - ')) .' ]  ' .number_format(($top_data[$type]['Sales Value']??0)) }}
                                    </div>

                                    <input type="hidden" id="top_for_{{ $type }}"  value="{{ $top_data[$type]['item'] ?? '' }}">
                                    <input type="hidden" id="value_for_{{ $type }}"  value="{{ number_format(($top_data[$type]['Sales Value']??0)) }}">

                                    <div class="progress progress--sm">
                                        <div class="progress-bar kt-bg-{{$color}}" role="progressbar" style="width: 100%;" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="kt-widget24__action">
                                        <span class="kt-widget24__change">

                                        </span>
                                        <span class="kt-widget24__number">

                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        @foreach ($reports_data as $type => $report_data)
            <div class="col-sm-12 col-lg-6">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title head-title text-primary">
                                    {{ __(ucwords(str_replace('_',' ',$type)).' Breakdown Analysis') }}
                                </h3>
                        </div>
                    </div>
                </div>

                <div class="kt-portlet kt-portlet--tabs">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-toolbar">
                            <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1_{{$type}}" role="tab">
                                        <i class="flaticon-line-graph"></i> &nbsp; Charts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_2_{{$type}}" role="tab">
                                        <i class="flaticon2-checking"></i>Reports Table
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="tab-content  kt-margin-t-20">

                            <div class="tab-pane active" id="kt_apps_contacts_view_tab_1_{{$type}}" role="tabpanel">

                                {{-- Monthly Chart --}}
                                <div class="col-xl-12">
                                    <div class="kt-portlet kt-portlet--height-fluid">
                                        <div class="kt-portlet__body kt-portlet__body--fluid">
                                            <div class="kt-widget12">
                                                <div class="kt-widget12__chart">
                                                    <!-- HTML -->
                                                    <h4> {{ __('Sales Values') }} </h4>
                                                    <div id="chartdiv_{{$type}}" class="chartDiv"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="kt_apps_contacts_view_tab_2_{{$type}}" role="tabpanel">
                                <div class="col-md-12">
                                    <div class="kt-portlet kt-portlet--mobile">
                                        {{-- <div class="kt-portlet__head kt-portlet__head--lg">
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

                                        </div> --}}
                                        <div class="kt-portlet__body">

                                            <!--begin: Datatable -->
                                            <?php
                                                if ($type == 'service_provider_birth_year' || $type == 'service_provider_type') {
                                                    $report_count_data = $report_data['report_count_data'];
                                                    $total_count = ( count($report_count_data) > 0) ? array_sum(array_column($report_count_data,'Count')) : 0;
                                                    $report_data = $report_data['report_view_data']  ;

                                                }
                                                $total = array_sum(array_column(($report_data??[]),'Sales Value'));$key=0;
                                            ?>

                                            <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                                @slot('table_header')
                                                    <tr class="table-active text-center">
                                                        {{-- <th>#</th> --}}
                                                        <th>{{ __(ucwords(str_replace('_',' ',$type))) }}</th>
                                                        <th>{{ __('Sales Values') }}</th>
                                                        <th>{{ __('Percentages %') }}</th>
                                                        @if (isset($report_count_data) && count($report_count_data) > 0)
                                                            <th>{{ __('Count') }}</th>
                                                            <th>{{ __('Count %') }}</th>
                                                        @endif
                                                    </tr>
                                                @endslot
                                                @slot('table_body')



                                                    @foreach ($report_data as $key => $item)

                                                        <tr>

                                                            {{-- <th>{{($key??0)+1}}</th> --}}
                                                            <td>{{$item['item']?? '-'}}</td>
                                                            <td class="text-center">{{number_format($item['Sales Value']??0)}}</td>
                                                            <td class="text-center">{{$total == 0 ? 0 : number_format((($item['Sales Value']/$total)*100) , 1) . ' %'}}</td>
                                                            @if (isset($report_count_data) && count($report_count_data) > 0)
                                                                <td class="text-center">{{ $report_count_data[$key]['Count'] }}</td>
                                                                <td class="text-center">{{$total == 0 ? 0 : number_format((($report_count_data[$key]['Count'] /$total_count)*100) , 1) . ' %'}}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach

                                                    <tr class="table-active text-center">
                                                        <td  >{{__('Total')}}</td>
                                                        {{-- <td class="hidden"></td> --}}
                                                        <td>{{number_format($total)}}</td>
                                                        <td>100 %</td>
                                                        @if (isset($report_count_data) && count($report_count_data) > 0)
                                                            <td>{{ $total_count  }}</td>
                                                            <td>100 %</td>
                                                        @endif
                                                    </tr>
                                                @endslot
                                            </x-table>

                                            <!--end: Datatable -->
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="total_{{$type}}" data-total="{{ json_encode($report_data) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

       <div class="container__fixed custom_modal_parent">
            <div class="datatable_modal_div kt-portlet kt-portlet--mobile" >
                 <div class="" id="datatable_modal_div">
                
                </div>
                 <a class="close_custom_modal" href="#"><i class="fas fa-times"></i></a>

            </div>
           
</div>

    </div>

    
































       
           
@endsection
@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    @foreach ($types as $type => $color)
        <script>
            am4core.ready(function() {

                // Themes begin
                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create chart instance
                var chart = am4core.create("chartdiv_"+"{{$type}}", am4charts.PieChart);

                // Add data
                chart.data = $('#total_'+"{{$type}}").data('total');
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
@foreach ($types as $type=>$brand)


    <script>
        
        $(function(){

            $(document).on('show.bs.modal', '#modal_for_'+ "{{ $type }}",  function(e){
                let company_id = $(this).find('input[type="hidden"][name="company_id"]').val();
                let type = $(this).find('input[name="type"][type="hidden"]').val();
                 if(! $(this).data('target'))
                 {
                       let topTypeName = $('#top_for_'+type).val();
                let topTypeSalesValue = $('#value_for_'+type).val();
                $(this).find('#selected_type_name').html(topTypeName);
                $(this).find('#total_sales_value').html(topTypeSalesValue);
                    $(this).find(`option[value="${topTypeName}"]`).prop('selected',true);
                }

                let selectedType = $(this).find('select[name="selected_type"]').val();
                $(this).data('target' , 1);
                $.ajax({
                        type: 'post',
                        url: "{{ route('get.net.sales.modal.for.type') }}",
                        data: {
                            "company_id":company_id,
                            "selectedType":selectedType,
                            "start_date":"{{ $start_date }}",
                            "end_date":"{{ $end_date }}",
                            "type":type ,
                            "modal_id":'modal_for_' + "{{ $type }}"
                        },
                        success: function (result) {
                            if(result.data){
                                let modal_id = result.data[0].modal_id ;

                                for(index in result.data[0])
                                {
                                    // console.log(index);
                                    // console.log(result.data[0]);
                                    if(index != modal_id)
                                    {
                                        $('#'+ modal_id  ).find('#'+index).html(result.data[0][index]).attr('data-value' , result.data[0][index]);
                                    }
                                }
                            }
                        }, error: function (reject) {
                        }
                    });


            })
            
 
        });

        // $(document).on('click' , '#recalc_modal' , function(e){
        //     e.preventDefault();
        //     $('#modal_for_'+ "{{ $type }}").trigger('show.bs.modal')
        // })


        

    </script>


@endforeach  


@foreach ($types as $type=>$brand)

    <script>

          $(document).on('change' , '#business_sector_select_{{ $type }}' , function(e){
            e.preventDefault();
            $('#modal_for_'+ "{{ $type }}").trigger('show.bs.modal')
        })
    </script>

    @endforeach 

<script>
    $(document).on('click','.ranged-button-ajax',function(e){
        e.preventDefault();
        let type = $(this).data('type');
        let column = $(this).data('column');
        let direction = $(this).data('direction');
        $.ajax({
            url:"{{ route('getTopAndBottomsForDashboard') }}",
            data:{
                "type":type,
                "column":column,
                "direction":direction,
                'company_id':"{{ $company->id }}",
                'date_from':"{{ $start_date }}",
                'date_to':"{{ $end_date }}",
                'modal_id':$(this).closest('.modal__class_top_bottom').attr('id'),
                'selected_type':$(this).closest('.modal__class_top_bottom').find('select[name="selected_type"]').val() 
            },
            "type":"post",
            success:function(result)
            {
                let total_sales_values = $('#'+result.modal_id).find('#total_sales_value').attr('data-value') ;
                total_sales_values =  parseFloat(total_sales_values.replaceAll(/,/g, ''));
                if(result.data.length)
                {
                    let table = "<table id='appended_table_for_view' class='appended_table_for_view datatable table-bordered table-hover table-checkable table'> <thead class='header___bg'><tr class='header___bg'><th class='header___bg'>#</th> <th class='header___bg'>{{ __('Customer Name') }}</th> <th class='header___bg text-center'>{{ __('Value') }}</th> <th class='header___bg text-center'>{{ __('Percentage') }}</th>  </tr></thead> <tbody>"
                    let order = 1 ; 
                    let sumOfFifty = 0 ; 
                    let salesValue = 0 ;
                    let percentage = 0 ;
                    let totalPercentage = 0 ;
                    for(index in result.data)

                    {
                        sumOfFifty +=  parseFloat(result.data[index].total_sales_value) ;
                        salesValue = result.data[index].total_sales_value ;
                        percentage = salesValue/total_sales_values*100 ;
                        totalPercentage += percentage  
                        // console.log(result.data);
                        // console.log(index);
                        table += `<tr> <td>${order}</td> <td>${result.data[index].customer_name}</td><td class="text-center">${number_format( salesValue , 0) }</td> <td> ${number_format(percentage , 2) } % </td> </tr>`
                        order += 1 ;
                    }
                    table+= ('<tr class="header___bg"><td class="header___bg">-</td> <td class="header___bg">{{ __("Total") }}</td> <td class="text-center header___bg">  '+ number_format(sumOfFifty ) +'</td> <td class="header___bg">'+number_format(totalPercentage , 2)+' % </td> </tr>')
                    table+='</tbody> </table>';
                    $('#datatable_modal_div').empty().append(table);
                     $('#appended_table_for_view').DataTable({
                             paging:   false,
                        ordering: false,
                        info:false ,
                        searching : false,
                        dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
                        <'row'<'col-sm-12'tr>>
                        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

                        buttons: [
                            'print',
                            'copyHtml5',
                            'excelHtml5',
                            'csvHtml5',
                            'pdfHtml5',
                        ]
                    
                                });

                                document.querySelectorAll('.close').forEach(function(modalItemCloser){
                                       $(modalItemCloser).trigger('click');
                                });
                                $('.container__fixed').css('display','block');
                            }
            }
        });
    })
</script>
<script>
    $(document).on('click',function(e){
        let targetElement = e.target ;
        let x = $(targetElement).closest('.container__fixed').length;
        if(! x ||  targetElement.className.includes('container__fixed'))
        {
            $('.container__fixed').css('display','none');
        }   
    })
</script>

<script>
    $(document).on('click','.close_custom_modal',function(e){
        e.preventDefault();
        $('.custom_modal_parent').fadeOut(300);
    })
</script>
@endsection
