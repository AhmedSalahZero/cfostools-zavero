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
            .dataTables_wrapper{max-width: 100%;  padding-bottom: 50px !important;overflow-x: overlay;max-height: 4000px;}
            .dataTables_wrapper{max-width: 100%;  padding-bottom: 50px !important;overflow-x: overlay;max-height: 4000px;}
    </style>
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
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
                    <li class="nav-item ">
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
                    array_push($names, 'Total');
                    array_push($names, 'Sales_Channel_Sales_Percentages');
                    ?>
                {{-- <div class="tab-pane " id="kt_apps_contacts_view_tab_1" role="tabpanel">
                    @foreach ($names as $name_of_sales_channel)

                        <div class="col-xl-12">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__body kt-portlet__body--fluid">
                                    <div class="kt-widget12">
                                        <div class="kt-widget12__chart">
                                            <!-- HTML -->
                                            <h4>{{ str_replace('_', ' ', $name_of_sales_channel) . ($name_of_sales_channel == 'Sales_Channel_Sales_Percentages' ? ' Against Total Sales' : ' Sales Trend Analysis Chart') }}
                                            </h4>
                                            <div id="{{ $name_of_sales_channel }}_count_chartdiv" class="chartdashboard"></div>
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
                    <x-table :tableTitle="__($view_name.' Report')" :tableClass="'kt_table_with_no_pagination'">
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th class="text-center absorbing-column">{{ __($type) }}</th>
                                @foreach ($dates as $date)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                @endforeach
                            </tr>
                        @endslot
                        @slot('table_body')

                            <?php $id =1 ;?>
                            @foreach ($report_data as $sales_channel_name => $sales_channel_channels_data)

                                {{-- <?php $chart_data = [];?> --}}

                                @if ($sales_channel_name != 'Total' && $sales_channel_name != 'Growth Rate %')
                                    <?php
                                    // $row_name = str_replace(' ', '_', $sales_channel_name);
                                    // $row_name = str_replace(['&','(',')','{','}'], '_', $row_name);
                                    ?>

                                    <tr class="group-color">
                                        <td class="white-text"  style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                                            <i class="row_icon{{ $id }} flaticon2-down white-text"></i>
                                            <b>{{ __($sales_channel_name) }}</b>
                                        </td>
                                        {{-- Total --}}
                                        <?php $total_per_sales_channel = $sales_channel_channels_data['Total'] ?? [];
                                        unset($sales_channel_channels_data['Total']); ?>
                                        {{-- Growth Rate % --}}
                                        <?php $growth_rate_per_sales_channel = $sales_channel_channels_data['Growth Rate %'] ?? [];
                                        unset($sales_channel_channels_data['Growth Rate %']); ?>
                                        @foreach ($dates as $date)
                                            <td class="text-center white-text">
                                                {{-- {{ number_format($total_per_sales_channel[$date] ?? 0)}} --}}
                                            {{-- . '  [ GR '.number_format($growth_rate_per_sales_channel[$date] ?? 0) . ' % ]' --}}
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach ($sales_channel_channels_data as $channel_name => $channel_section)
                                        <tr class="row{{ $id }}   text-center"
                                            >
                                            <td class="text-left"><b>{{ $channel_name . ' - Avg. Prices'  }}</b></td>

                                            @foreach ($dates as $date)
                                                <td class="text-center">
                                                    {{ number_format($channel_section['Avg. Prices'][$date] ?? 0  , 2  )  }}
                                                    <span ><b> {{ ' [ '.number_format(($channel_section['Growth Rate %'][$date]??0), 1) . ' %  ]' }}</b></span>
                                                </td>
                                            @endforeach
                                        </tr>
                                    {{-- @endforeach --}}
                                @endforeach
                                {{-- @elseif ($sales_channel_name == 'Total' || $sales_channel_name == 'Growth Rate %')
                                    <tr class="active-style text-center">
                                        <td class="active-style text-center" colspan="2"><b>{{ __($sales_channel_name) }}</b></td>
                                        <td class="hidden"></td>
                                        <?php $decimals = $sales_channel_name == 'Growth Rate %' ? 2 : 0; ?>
                                        @foreach ($dates as $date)

                                            <td class="text-center active-style">
                                                {{ number_format($sales_channel_channels_data[$date] ?? 0,$decimals) . ($decimals == 0 ? '' : ' %')}}</td>
                                        @endforeach
                                    </tr> --}}
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
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script>
        function toggleRow(rowNum) {
            $(".row" + rowNum).toggle();
            $('.row_icon' + rowNum).toggleClass("flaticon2-up flaticon2-down");
            
        }
    </script>
@endsection
