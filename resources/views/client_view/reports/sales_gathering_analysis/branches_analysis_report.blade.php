@extends('layouts.dashboard')
@section('css')

    <style>
        table {
            white-space: nowrap;
            table-layout: auto;
            border-collapse: collapse;
            width: 100%;
        }
        table td {
        border: 1px solid #ccc;
        color: gr
        }
        table .absorbing-column {
            width: 100%;
        }
    </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css"/>
<style>
    table.dataTable thead tr > .dtfc-fixed-left, table.dataTable thead tr > .dtfc-fixed-right{
        background-color:#086691 !important;
    }
    .dtfc-fixed-left:not(.active-style),  .dtfc-fixed-right:not(.active-style){
        background-color:white !important;
        color:black;
    } 
      .group-color > .dtfc-fixed-left,  .group-color > .dtfc-fixed-right{
        background-color:#086691 !important;
           color:white !important;
         }
    .dtfc-fixed-left , .dtfc-fixed-right{
        /* color:white !important; */
    }
    
    thead *{
        text-align:center !important;
    }
</style>
    {{-- <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
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

    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand"
                    role="tablist">
                    {{-- <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_apps_contacts_view_tab_1" role="tab">
                            <i class="flaticon-line-graph"></i> &nbsp; Charts
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_2" role="tab">
                            <i class="flaticon2-checking"></i>Reports Table
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content  kt-margin-t-20">

                <!--Begin:: Tab  EGP FX Rate Table -->
                    <?php
                    array_push($branches_names, 'Total');
                    array_push($branches_names, 'Branch_Sales_Percentages');
                    ?>
                {{-- <div class="tab-pane " id="kt_apps_contacts_view_tab_1" role="tabpanel">
                    @foreach ($branches_names as $name_of_zone)

                        <div class="col-xl-12">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__body kt-portlet__body--fluid">
                                    <div class="kt-widget12">
                                        <div class="kt-widget12__chart">
                                            <!-- HTML -->
                                            <h4>{{ str_replace('_', ' ', $name_of_zone) . ($name_of_zone == 'Branch_Sales_Percentages' ? ' Against Total Sales' : ' Sales Trend Analysis Chart') }}
                                            </h4>
                                            <div id="{{ $name_of_zone }}_count_chartdiv" class="chartdashboard"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
                <!--End:: Tab  EGP FX Rate Table -->
                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                    <x-table :tableTitle="__($view_name.' Report')"
                        :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th class="text-center absorbing-column">{{ __('Branch') }}</th>
                                @foreach ($dates as $date)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                @endforeach
                                <th>{{ __('Total') }}</th>
                            </tr>
                        @endslot
                        @slot('table_body')
@php

sortReportForTotals($report_data)
// (uasort($report_data,  function($a,$b) use($report_data){

// if(isset($b['Total']) && $a['Total']){
// $a = array_sum($a['Total']);
// $b = array_sum($b['Total']);

//      if ($a == $b) {
//         return 0;
//     }
//     return ($a > $b) ? -1 : 1;
//     }
//     return ;
// }

// )
//     );
   

@endphp 
                            <?php $id =1 ;?>
                            @foreach ($report_data as $zone_name => $data)

                                <?php $chart_data = [];?>

                                @if ($zone_name != 'Total' && $zone_name != 'Growth Rate %')
                                <?php
                                    // $row_name = str_replace(' ', '_', $zone_name);
                                    // $row_name = str_replace(['&','(',')','{','}'], '_', $row_name);
                                 ?>

                                    <tr class="group-color">
                                        <td class="white-text"  style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                                            <i class="row_icon{{ $id }} flaticon2-up white-text"></i>
                                            <b>{{ __($zone_name) }}</b>
                                        </td>
                                        {{-- Total --}}
                                        <?php $total_per_zone = $data['Total'] ?? [];
                                        unset($data['Total']); ?>
                                        {{-- Growth Rate % --}}
                                        <?php $growth_rate_per_zone = $data['Growth Rate %'] ?? [];
                                        unset($data['Growth Rate %']); ?>

                                        @foreach ($dates as $date)
                                            <td class="text-center white-text">{{ number_format($total_per_zone[$date] ?? 0) . '  [ GR '.number_format($growth_rate_per_zone[$date] ?? 0) . ' % ]'}}
                                            </td>
                                        @endforeach
                                        <td class="text-center white-text">{{number_format(array_sum($total_per_zone??[]),0)}}</td>
                                    </tr>
                           

                                    @php
                                        sortSubItems($data)
                                    @endphp
                                    @foreach ($data as $channel_name => $channel_section)



          
                                        <tr class="row{{ $id }}  text-center" style="display: none">
                                            <td class="text-left"><b>{{ $channel_name  }}</b></td>


                                            @foreach ($dates as $date)
                                                <td class="text-center">
                                                    {{ number_format(($channel_section['Sales Values'][$date] ?? 0),0)   }}
                                                    <span class="active-text-color "><b> {{ ' [ '.number_format(($channel_section['Growth Rate %'][$date]??0), 1) . ' %  ]' }}</b></span>
                                                </td>
                                            @endforeach
                                            <td>{{number_format(array_sum($channel_section['Sales Values']??[]),0)}}</td>
                                        </tr>

                                    @endforeach






                                @elseif ($zone_name == 'Total' || $zone_name == 'Growth Rate %')
                                    <tr class="active-style text-center">
                                        <td class="active-style text-center" ><b>{{ __($zone_name) }}</b></td>
                                        <?php $decimals = $zone_name == 'Growth Rate %' ? 2 : 0; ?>
                                        @foreach ($dates as $date)
                                            <td class="text-center active-style">
                                                {{ number_format($data[$date] ?? 0,$decimals) . ($decimals == 0 ? '' : ' %')}}</td>
                                        @endforeach
                                        <td class="text-center active-style">{{$zone_name == 'Growth Rate %' ? "-" : number_format(array_sum($data  ?? []),0)}}</td>
                                    </tr>
                                @endif
                                <?php $id++ ;?>
                            @endforeach


                        @endslot
                    </x-table>

                </div>
                <!--End:: Tab USD FX Rate Table -->
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
@include('js_datatable')
  
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript"></script>

     <script>
        function toggleRow(rowNum) 
        {
            $(".row" + rowNum).toggle();
            $('.row_icon' + rowNum).toggleClass("flaticon2-down flaticon2-up");
        }
        </script> 
@endsection
