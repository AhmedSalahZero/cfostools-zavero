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
      .dtfc-fixed-left,  .dtfc-fixed-right{
        background-color:#086691 !important;
    }
    .dtfc-fixed-left , .dtfc-fixed-right{
        color:white !important;
    }
    thead *{
        text-align:center !important;
    }
    .bg-white{
        background-color:#fff !important;
    }
    .text-black{
        color:black !important;

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
                    // array_push($branches_names, 'Total');
                    // array_push($branches_names, 'Branch_Sales_Percentages');
                    ?>
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">
                    <x-table :tableTitle="__($view_name.' Report')"
                        :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th class="text-center absorbing-column">{{ __(spaceAfterCapitalLetters(camelize($type))) }}</th>
                             @php
                                 $colsSpans = arrayCountAllLongest($sumForEachInterval) + 1 ;
                             @endphp
                                @foreach (getLongestArray($sumForEachInterval)  as $year => $d )
                                @foreach ($d  as $month=>$value )
                                    <th>
                                       {{ $endOfMonth=\Carbon\Carbon::parse($year.'-'.$month)->endOfMonth()->format('d-M-Y') }}
                                        
                                        </th>
                                @endforeach
                                    
                                @endforeach
                                    {{-- <th>{{ date('d-M-Y', strtotime($date)) }}</th> --}}
                                {{-- <th>{{ __('Total') }}</th> --}}
                            </tr>
                        @endslot
                        @slot('table_body')

                            <?php $idd =1 ;?>

                            @foreach ($sumForEachInterval as $zone_name => $data)
                                            @php
                                                $totalCountInvoiceNumber = 0 ;
                                            @endphp
                                    <tr class="group-color">
                                        <td  colspan="{{ $colsSpans }}" class=" bg-white text-black"  style="cursor: pointer;" onclick="toggleRow('{{ $idd }}')">
                                            <i class="row_icon{{ $idd }} flaticon2-up text-black"></i>
                                            <b>
                                                {{ __($zone_name) }}
                                            
                                            </b>
                                        </td>
                                           @foreach (getLongestArray($sumForEachInterval)  as $year => $d )
                                        @foreach ($d as $interval=>$q)
                                            <td hidden>
                                            </td>
                                            @endforeach
                                            @endforeach
                                    </tr>


                                      <tr class="row{{ $idd }}  active-style text-center" style="display: none">
                                            <td class="text-left"><b>{{ __('Invoice Count')  }}</b></td>

                                          
                                        @foreach (getLongestArray($sumForEachInterval)  as $year => $d )
                                        @foreach ($d as $interval=>$q)
                                                <td class="text-center">
                                                    <span class="white-text"><b> 
                                                        @php
                                                           $countInvoiceNumber =  ($sumForEachInterval[$zone_name][$year][$interval]['invoice_number']) ?? 0
                                                        @endphp
                                                        {{ number_format( $countInvoiceNumber )}}

                                                        </b></span>
                                                </td>

                                          @endforeach
                                        @endforeach

                                       

                                        </tr>

                                        @if($type != 'product_item')

                                         <tr class="row{{ $idd }}  active-style text-center" style="display: none">
                                            <td class="text-left"><b>{{ __('Avg Product Items Count Per Invoice')  }}</b></td>

                                        @foreach (getLongestArray($sumForEachInterval)  as $year => $d )
                                        @foreach ($d as $interval=>$q)

                                        @php
                                            $invoiceNumber = ($sumForEachInterval[$zone_name][$year][$interval]['invoice_number']) ?? 0 ;
                                        @endphp
                                                <td class="text-center">
                                                    <span class="white-text"><b> 
                                                        {{ 
                                                          round(($sumForEachInterval[$zone_name][$year][$interval]['avg']) ?? 0)
                                                        }}
                                                        </b></span>
                                                </td>
                                          @endforeach
                                        @endforeach

                                        </tr>










                                         <tr class="row{{ $idd }}  active-style text-center" style="display: none">
                                            <td class="text-left"><b>{{ __('Avg Invoice Value')  }}</b></td>

                                       
                                        @foreach (getLongestArray($sumForEachInterval)  as $year => $d )
                                        @foreach ($d as $interval=>$q)

                                        
                                                <td class="text-center">
                                                    <span class="white-text"><b>
                                                        @php
                                                            $intervalFormatted=\Carbon\Carbon::parse($year.'-'.$interval)->endOfMonth()->format('d-m-Y');
                                                        $invoiceNumber = ($sumForEachInterval[$zone_name][$year][$interval]['invoice_number']) ?? 0 ;
                                                        $salesValue = $reportSalesValues[$zone_name][$intervalFormatted] ?? 0 ;
                                                        $avg_invoice_value = $invoiceNumber ? number_format($salesValue / $invoiceNumber) : 0;
                                                        @endphp 
                                                        {{-- // ; --}}
                                                        {{ 
                                                          $avg_invoice_value
                                                        }}
                                                        </b></span>
                                                </td>
                                          @endforeach
                                        @endforeach
                                    
                                        </tr>

                                        @endif


                                       
                                    @php
                                        $idd = $idd + 1 ;
                                    @endphp

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
