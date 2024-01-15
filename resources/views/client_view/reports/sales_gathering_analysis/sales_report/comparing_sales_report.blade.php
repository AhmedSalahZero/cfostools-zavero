@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }
        .col-sm-6.text-left{
            display: none ;
        }

    </style>
@endsection
@section('sub-header')
    {{ __('Comparing Sales Report') }}
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


                <!--End:: Tab  EGP FX Rate Table -->

                <!--Begin:: Tab USD FX Rate Table -->
                <div class="tab-pane active" id="kt_apps_contacts_view_tab_2" role="tabpanel">

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">

                                    <b> {{ __('From : ') }} </b>{{ $request_dates['start_date'] }}
                                    <b> - </b>
                                    <b> {{ __('To : ') }}</b> {{ $request_dates['end_date'] }}
                                    <br>

                                    <span class="title-spacing"><b> {{ __('Last Updated Data Date : ') }}</b>
                                        {{ $last_date }}</span>
                                </h3>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <?php
                            $total_previous_year=0;
                            $col_num = 12;
                            if (count($report_data) == 2 ) {
                                $col_num = 6;
                            }elseif (count($report_data) > 2 ){
                                $col_num = 4;
                            }
                        ?>
                        @foreach ($report_data as $year =>$data_per_year)
                        <div class="col-md-{{$col_num}}">

                                <x-table :tableTitle="'Year -' .$year" :tableClass="'kt_table_with_no_pagination_no_search'">
                                    @slot('table_header')
                                        <tr class="table-active text-center">
                                            <th>{{ __('Month') }}</th>
                                            <th>{{ __('Sales Value') }}</th>
                                            <th>{{ __('Month Sales %') }}</th>
                                            <td>{{ __('YoY GR%') }}</td>
                                        </tr>
                                    @endslot
                                    @slot('table_body')
                                        @foreach ($data_per_year['Months'] as $date)
                                            <tr class="text-center">
                                                <td>{{$date}}</td>
                                                <td>{{number_format(($data_per_year['Sales Values'][$date]??0),0)}}</td>
                                                <td>{{number_format(($data_per_year['Month Sales %'][$date]??0),2) . ' %'}}</td>
                                                <td>{{number_format(($data_per_year['YoY GR%'][$date]??0),2) . ' %'}}</td>
                                            </tr>
                                        @endforeach
                                        <?php
                                            $total_sales_values_per_year = (array_sum($data_per_year['Sales Values']??[]));
                                            $total_yoy = $total_previous_year ==0 ? 0 : ($total_sales_values_per_year - $total_previous_year)/$total_previous_year *100;
                                        ?>
                                        <tr class="table-active text-center odd">
                                            <th>{{__('Total')}}</th>
                                            <td>{{number_format(($total_sales_values_per_year),0)}}</td>
                                            <td>{{number_format((array_sum($data_per_year['Month Sales %']??[])),2) . ' %'}}</td>
                                            <td>{{number_format($total_yoy,2) . ' %'}}</td>
                                        </tr>
                                        <?php $total_previous_year=$total_sales_values_per_year;?>
                                    @endslot
                                </x-table>
                            </div>
                        @endforeach
                    </div>






                    <div class="row">


                        <div class="col-md-6">

                                <x-table :tableTitle="'Monthly Seasonality Table'" :tableClass="'kt_table_with_no_pagination_no_search'">
                                    @slot('table_header')
                                        <tr class="table-active text-center">
                                            <th>{{ __('Month') }}</th>
                                            <th>{{ __('Month Sales %') }}</th>
                                        </tr>
                                    @endslot
                                    @slot('table_body')
                                        <?php $sum_totals = array_sum($total_full_data); ?>
                                        @foreach ($total_full_data as $date => $total)
                                            <tr class="text-center">
                                                <td>{{$date}}</td>
                                                <td>{{number_format(((($total/$sum_totals)*100)??0),2)  . ' %' }} </td>
                                            </tr>
                                        @endforeach
                                        <?php
                                            $total_sales_values_per_year = (array_sum($data_per_year['Sales Values']??[]));
                                            $total_yoy = $total_previous_year ==0 ? 0 : ($total_sales_values_per_year - $total_previous_year)/$total_previous_year *100;
                                        ?>
                                        <tr class="table-active text-center odd">
                                            <th>{{__('Total')}}</th>
                                            {{-- <td>{{number_format((array_sum($data_per_year['Month Sales %']??[])),2) . ' %'}}</td>  --}}
                                            <td>100%</td>
                                        </tr>
                                        <?php $total_previous_year=$total_sales_values_per_year;?>
                                    @endslot
                                </x-table>
                            </div>


                            <div class="col-md-6">

                                <x-table :tableTitle="'Quarterly Seasonality Table'" :tableClass="'kt_table_with_no_pagination_no_search'">
                                    @slot('table_header')
                                        <tr class="table-active text-center">
                                            <th>{{ __('Quarter') }}</th>
                                            <th>{{ __('Quarter Sales %') }}</th>
                                        </tr>
                                    @endslot
                                    @slot('table_body')
                                        <?php $sum_totals = array_sum($total_full_data); ?>
                                            <tr class="text-center">
                                                <td>{{ __('Quarter One (Jan / Feb / Mar)') }}</td>
                                                <td> {{ sumBasedOnQuarterNumber($total_full_data , ['January','February','March']  , $sum_totals) }} </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>{{ __('Quarter Two (Apr / May / Jun)') }}</td>
                                                <td> {{ sumBasedOnQuarterNumber($total_full_data , ['April','May','June'] , $sum_totals) }} </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>{{ __('Quarter Three (Jul / Aug / Sep)') }}</td>
                                                <td> {{ sumBasedOnQuarterNumber($total_full_data , ['July','August','September'] , $sum_totals) }} </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td>{{ __('Quarter Four (Oct / Nov / Dec)') }}</td>
                                                <td>{{ sumBasedOnQuarterNumber($total_full_data , ['October','November','December'] , $sum_totals) }}</td>
                                            </tr>

                                            <tr class="table-active text-center odd">
                                            <th>{{__('Total')}}</th>
                                            <td>100%</td>
                                        </tr>

                                            
                                       
                                       
                                    @endslot
                                </x-table>
                            </div>



                    </div>







                    
                 




                    <input type="hidden" id="monthly_data" data-total="{{ json_encode($chart_data??[]) }}">
                    <input type="hidden" id="accumulated_data" data-total="{{ json_encode($accumulated_chart_data??[]) }}">
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

@endsection
