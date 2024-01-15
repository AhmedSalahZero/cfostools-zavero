@extends('layouts.dashboard')
@section('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sl-1.4.0/sr-1.1.1/datatables.min.css"/>


    {{-- <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    <style>
        table {
            white-space: nowrap;
        }

    </style>
<style>
    .table-active .dtfc-fixed-left,
    .table-active .dtfc-fixed-right
    {
 background-color:#086691 !important;
color: white !important;

    }
</style>

@include('datatable_css')

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

    <!--Sales Values Table -->
    @php

        $getIterableTimes = getIterableItems(array_merge($customersNaturesActive , $customersNaturesDead));

    @endphp



    <x-table :tableTitle="__('Sales Values Table')"   :tableClass="'kt_table_with_no_pagination'">
        @slot('table_header')
            <tr class="table-active text-center">
                @php $main_type_name = ucwords(str_replace('_', ' ', $type)); @endphp
                <th>{{ __($main_type_name) . ' / ' . __('Customers Natures') }}</th>
                @foreach ($customersNaturesActive as $reportType=>$reportDataArray)
                    <th>{{ __($reportType) }}</th>
                    <th>{{ __('% / '.$main_type_name) }}</th>
                @endforeach
                <th>{{ __('Total'.($type ==  'discounts' ? 'Discounts' : 'Sales')) }}</th>
                <th>{{ __('% / Total'.($type ==  'discounts' ? 'Discounts' : 'Sales')) }}</th>

                   @foreach ($customersNaturesDead as $reportType=>$reportDataArray)
                    <th>{{ __($reportType) }}</th>
                    <th>{{ __('% / '.$main_type_name) }}</th>
                @endforeach

            </tr>
        @endslot
        @slot('table_body')
        @php
        $totalForTotalSales = calcTotalsForTotalsActiveItems($customersNaturesActive , 'total_sales') ;
        @endphp 
        @foreach($getIterableTimes as $mainTypeItem=>$totalPerType)
                <tr>
                    <th> {{ __($mainTypeItem) }} </th>
                    @php
                        $totalForActiveRaw = 0 ;
                    @endphp
                      @foreach ($customersNaturesActive as $mainType => $mainTypeValueArray)
                        @php
                                // $totalPerType = getTotalForThisType($customersNaturesActive , $mainTypeItem , 'total_sales') ;
                                $accumlatedValuesFor[$mainTypeItem][$mainType] = $value = sum_array_of_std_objectsForSubType($mainTypeValueArray[$mainTypeItem]??[]  ,'total_sales') ; 
                                $percentage_per_value = $totalPerType  == 0 ? 0 : ($value / $totalPerType) * 100;
                                $totalForActiveRaw += $value ;
                        @endphp

                        <td class="text-center"> {{ number_format($value) }}</td>
                        <td class="text-center">
                            <span class="active-text-color "><b> {{  number_format($percentage_per_value, 1).' % ' }}</b></span>
                        </td>

                    @endforeach

                    <td class="text-center">
                        {{ number_format($totalForActiveRaw) }}
                    </td>
                    <td class="text-center">
                        <span class="active-text-color text-center"><b> {{ $totalForTotalSales ? number_format(($totalForActiveRaw/$totalForTotalSales)*100, 1) . ' % '  : 0}}</b></span>
                    </td>
                    @foreach($customersNaturesDead as $mainType => $mainTypeValueArray )
                      @php
                    //   year for $customersNaturesActive not $customersNaturesDead
                                $totalPerType = getTotalForThisType($customersNaturesActive , $mainTypeItem , 'total_sales') ;
                                  $accumlatedValuesFor[$mainTypeItem][$mainType]  = $value = sum_array_of_std_objectsForSubType($mainTypeValueArray[$mainTypeItem]??[]  ,'total_sales') ; 
                               $percentage_per_value = $totalPerType  == 0 ? 0 : ($value / $totalPerType) * 100;
                        @endphp

                        <td class="text-center"> {{ number_format($value) }}</td>
                        <td class="text-center">
                            <span class="active-text-color "><b> {{  number_format($percentage_per_value, 1).' % ' }}</b></span>
                        </td>

                    @endforeach
                </tr>
            @endforeach


             <tr class="table-active text-center">
                <th class="text-center"> {{ __('Total') }} </th>
                @foreach ($customersNaturesActive   as $keyy=>$item_name)
               @php
                   $totalForVerticalTypes[$keyy] = getTotalForSingleType($customersNaturesActive[$keyy] ?? [] , 'total_sales');


               @endphp
                    <td class="text-center">
                        {{ $totalForVerticalTypes[$keyy] ? number_format($totalForVerticalTypes[$keyy]) : 0 }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach


                <td class="text-center">{{ number_format($totalForTotalSales) }}</td>
                <td class="text-center"><b>{{  '100 %' }}</b></td>
              

                  @foreach ($customersNaturesDead   as  $keyy=>$item_name)
               @php
                   $totalForVerticalTypes[$keyy] = getTotalForSingleType($customersNaturesDead[$keyy] ?? [] , 'total_sales');
               @endphp

               
                    <td class="text-center">
                        {{ $totalForVerticalTypes[$keyy] ? number_format($totalForVerticalTypes[$keyy]) : 0 }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

            </tr>




             <tr class="table-active text-center">
                <th class="text-center"> {{  'Nature % / ' . __('Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }} </th>
                @foreach ($customersNaturesActive   as $keyy=>$item_name)
                    <td class="text-center">
                      {{ $totalForTotalSales ? number_format($totalForVerticalTypes[$keyy]  / $totalForTotalSales * 100 , 1 ) . ' %'  : 0 }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach


                <td class="text-center">{{ '100 %' }}</td>
                <td class="text-center"><b>-</b></td>
              

                  @foreach ($customersNaturesDead   as  $keyy=>$item_name)
               @php
                   
               @endphp

               
                    <td class="text-center">
                        {{ $totalForTotalSales ? number_format($totalForVerticalTypes[$keyy]  / $totalForTotalSales * 100 , 1 ) . ' %'  : 0 }}
                    
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

            </tr>

        @endslot
    </x-table>















     <x-table :tableTitle="__('Counts Table')"   :tableClass="'kt_table_with_no_pagination'">
        @slot('table_header')
            <tr class="table-active text-center">
                <?php $main_type_name = ucwords(str_replace('_', ' ', $type)); ?>
                <th>{{ __($main_type_name) . ' / ' . __('Customers Natures') }}</th>
                @foreach ($customersNaturesActive as $reportType=>$reportDataArray)
                    <th>{{ __($reportType) }}</th>
                    <th>{{ __('% / '.$main_type_name) }}</th>
                @endforeach
                <th>{{ __('Total'.($type ==  'discounts' ? 'Discounts' : 'Count')) }}</th>
                <th>{{ __('% / Total'.($type ==  'discounts' ? 'Discounts' : 'Count')) }}</th>

                   @foreach ($customersNaturesDead as $reportType=>$reportDataArray)
                    <th>{{ __($reportType) }}</th>
                    <th>{{ __('% / '.$main_type_name) }}</th>
                @endforeach

            </tr>
        @endslot
        @slot('table_body')
        @php
        $totalForTotalSales = countTotalsForTotalsActiveItems($customersNaturesActive , 'no_customers') ;
        @endphp 
        @foreach($getIterableTimes as $mainTypeItem=>$totalPerType)
                <tr>
                    <th> {{ __($mainTypeItem) }} </th>
                    @php
                        $totalForActiveRaw = 0 ;
                    @endphp
                      @foreach ($customersNaturesActive as $mainType => $mainTypeValueArray)
                        @php
                                $totalPerType = countTotalForThisType($customersNaturesActive , $mainTypeItem ) ;
                                $value = count_array_of_std_objects($mainTypeValueArray[$mainTypeItem]??[]  ) ; 
                                $percentage_per_value = $totalPerType  == 0 ? 0 : ($value / $totalPerType) * 100;
                                $totalForActiveRaw += $value ;
                   
                                
                        @endphp
                         <td class="text-center"><button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{str_replace(["/" ,' ','&' ] , '-' , $mainTypeItem) . str_replace(["/" ,' ','&'] , '-' , $mainType)}}"> 
                                        {{ $value }}

                                        </button>
                                        
                                          <div class="modal fade" id="kt_modal_{{str_replace(["/" ,' ' ,'&'] , '-' , $mainTypeItem) . str_replace(["/" ,' ' ,'&'] , '-' , $mainType)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $mainTypeItem }} {{ $mainType }}</h5>
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
                                                                    $totalForModalItem = 0; 
                                                                @endphp
                                                                @foreach($customersNaturesActive[$mainType][$mainTypeItem] ?? [] as $iterationModalItem)
                                                                <tr>
                                                                    <td>
                                                                        {{$iterationModalItem->customer_name}}
                                                                    </td>
                                                                    <td>
                                                                        {{ number_format($iterationModalItem->total_sales) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $accumlatedValuesFor[$mainTypeItem][$mainType] ? (number_format($iterationModalItem->total_sales / $accumlatedValuesFor[$mainTypeItem][$mainType] *100  , 1) . ' %') : 0 }}
                                                                    </td>
                                                                </tr>
                                                                @endforeach 
                                                                <tr class="table-active text-center">
                                                                    <td>
                                                                        {{ __('Total') }}
                                                                    </td>
                                                                    <td>

                                                                        {{$accumlatedValuesFor[$mainTypeItem][$mainType] ?  number_format($accumlatedValuesFor[$mainTypeItem][$mainType]) : 0 }}
                                                                    </td>
                                                                    <td>
                                                                        100 %
                                                                    </td>
                                                                </tr>
                                                                @endslot
                                                            </x-table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </td>

                        <td class="text-center">
                            <span class="active-text-color "><b> {{  number_format($percentage_per_value, 1).' % ' }}</b></span>
                        </td>

                    @endforeach

                    <td class="text-center">
                        {{ ($totalForActiveRaw) }}
                    </td>
                    <td class="text-center">
                        <span class="active-text-color text-center"><b> {{ $totalForTotalSales ? number_format(($totalForActiveRaw/$totalForTotalSales)*100, 1) . ' % '  : 0}}</b></span>
                    </td>
                    @foreach($customersNaturesDead as $mainType => $mainTypeValueArray )
                      @php
                    //   yes for $customersNaturesActive not for $customersNaturesDead
                                $totalPerType = countTotalForThisType($customersNaturesActive , $mainTypeItem) ;
                               $value = count_array_of_std_objects($mainTypeValueArray[$mainTypeItem]??[] ) ; 
                               $percentage_per_value = $totalPerType  == 0 ? 0 : ($value / $totalPerType) * 100;
                        @endphp

                           <td class="text-center"><button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{str_replace(["/" ,' ','&' ] , '-' , $mainTypeItem) . str_replace(["/" ,' ','&'] , '-' , $mainType)}}"> 
                                        {{ $value }}

                                        </button>
                                        
                                          <div class="modal fade" id="kt_modal_{{str_replace(["/" ,' ' ,'&'] , '-' , $mainTypeItem) . str_replace(["/" ,' ' ,'&'] , '-' , $mainType)}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">{{ $mainTypeItem }} {{ $mainType }}</h5>
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
                                                                    $totalForModalItem = 0; 
                                                                @endphp
                                                                @foreach($customersNaturesDead[$mainType][$mainTypeItem] ?? [] as $iterationModalItem)
                                                                <tr>
                                                                    <td>
                                                                        {{$iterationModalItem->customer_name}}
                                                                    </td>
                                                                    <td>
                                                                        {{ number_format($iterationModalItem->total_sales) }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $accumlatedValuesFor[$mainTypeItem][$mainType] ? (number_format($iterationModalItem->total_sales / $accumlatedValuesFor[$mainTypeItem][$mainType] *100  , 1) . ' %') : 0 }}
                                                                    </td>
                                                                </tr>
                                                                @endforeach 
                                                                <tr class="table-active text-center">
                                                                    <td>
                                                                            {{ __('Total') }}
                                                                    </td>
                                                                    <td>

                                                                        {{$accumlatedValuesFor[$mainTypeItem][$mainType] ?  number_format($accumlatedValuesFor[$mainTypeItem][$mainType]) : 0 }}
                                                                    </td>
                                                                    <td>
                                                                        100 %
                                                                    </td>
                                                                </tr>
                                                                @endslot
                                                            </x-table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </td>

                        <td class="text-center">
                            <span class="active-text-color "><b> {{  number_format($percentage_per_value, 1).' % ' }}</b></span>
                        </td>

                    @endforeach
                </tr>
            @endforeach


             <tr class="table-active text-center">
                <th class="text-center"> {{ __('Total') }} </th>
                @foreach ($customersNaturesActive   as $keyy=>$item_name)
               @php
                   $totalForVerticalTypes[$keyy] = countTotalForSingleType($customersNaturesActive[$keyy] ?? [] );
               @endphp
                    <td class="text-center">
                        {{ $totalForVerticalTypes[$keyy] ? ($totalForVerticalTypes[$keyy]) : 0 }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

                <td class="text-center">{{ ($totalForTotalSales) }}</td>
                <td class="text-center"><b>{{  '100 %' }}</b></td>
              

                  @foreach ($customersNaturesDead   as  $keyy=>$item_name)
               @php
                   $totalForVerticalTypes[$keyy] = countTotalForSingleType($customersNaturesDead[$keyy] ?? [] );
               @endphp

               
                    <td class="text-center">
                        {{ $totalForVerticalTypes[$keyy] ? ($totalForVerticalTypes[$keyy]) : 0 }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

            </tr>

             <tr class="table-active text-center">
                <th class="text-center"> {{  'Nature % / ' . __('Total '.($type ==  'discounts' ? 'Discounts' : 'Count')) }} </th>
                @foreach ($customersNaturesActive   as $keyy=>$item_name)
                    <td class="text-center">
                      {{ $totalForTotalSales ? number_format($totalForVerticalTypes[$keyy]  / $totalForTotalSales * 100 , 1 ) . ' %'  : 0 }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach


                <td class="text-center">{{ '100 %' }}</td>
                <td class="text-center"><b>-</b></td>
              

                  @foreach ($customersNaturesDead   as  $keyy=>$item_name)
               @php
                   
               @endphp

               
                    <td class="text-center">
                        {{ $totalForTotalSales ? number_format($totalForVerticalTypes[$keyy]  / $totalForTotalSales * 100 , 1 ) . ' %'  : 0 }}
                    
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

            </tr>

        @endslot
    </x-table>
    

     <!--Counts Table -->








     {{-- <x-table :tableTitle="__('Counts Table')"   :tableClass="'kt_table_with_no_pagination'">
        @slot('table_header')
            <tr class="table-active text-center">
                <?php $main_type_name = ucwords(str_replace('_', ' ', $type)); ?>
                <th>{{ __($main_type_name) . ' / ' . __('Customers Natures') }}</th>
                @foreach ($all_items as $item)
                    <th>{{ __($item) }}</th>
                    <th>{{ __('% / '.$main_type_name) }}</th>
                @endforeach
                <th>{{ __('Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }}</th>
                <th>{{ __('% / Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }}</th>
                <th>{{ __('Stop') }}</th>
                <th>{{ __('% / '.$main_type_name) }}</th>
                <th>{{ __('Dead') }}</th>
                <th>{{ __('% / '.$main_type_name) }}</th>
            </tr>
        @endslot
        @slot('table_body')
            <?php $total_per_item = []; ?>
            <?php
                $dead_stop_totals = [ 'Stop' =>$items_totals_counts['Stop'] ?? 0, 'Dead' =>$items_totals_counts['Dead'] ?? 0];
                unset($items_totals_counts['Dead']);
                unset($items_totals_counts['Stop']);
                $final_total = array_sum($items_totals_counts);
                $final_percentage = $final_total == 0 ? 0 : (($final_total ?? 0) / $final_total) * 100;
            ?>

            @foreach ($report_totals_counts as $main_type_item_name => $main_item_total)
                <tr>
                    <th> {{ __($main_type_item_name) }} </th>
                    @foreach ($all_items as $item)
                        <?php $value = $report_counts[$main_type_item_name][$item] ?? 0;
                        $percentage_per_value = $main_item_total == 0 ? 0 : ($value / $main_item_total) * 100; ?>
                        <td class="text-center">{{ number_format($value) }}</td>
                        <td class="text-center">
                            <span class="active-text-color "><b> {{  number_format($percentage_per_value, 1).' % ' }}</b></span>
                        </td>
                    @endforeach
                    <?php $total_percentage = $final_total == 0 ? 0 : ($main_item_total / $final_total) * 100; ?>
                    <td class="text-center">
                        {{ number_format($main_item_total) }}

                    </td>
                    <td class="text-center">
                        <span class="active-text-color "><b> {{ number_format($total_percentage, 1) . ' % ' }}</b></span>
                    </td>
                    <?php $items_after_total = ['Stop','Dead']; ?>
                    @foreach ($items_after_total as $item)

                        <?php
                            $value = $report_counts[$main_type_item_name][$item] ?? 0;
                            $percentage_per_value = $main_item_total == 0 ? 0 : ($value / $main_item_total) * 100;

                        ?>
                        <td class="text-center"> {{ number_format($value) }}</td>
                        <td class="text-center">
                            <span class="active-text-color "><b> {{  number_format($percentage_per_value, 1).' % ' }}</b></span>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            <tr class="table-active text-center">
                <th class="text-center"> {{ __('Total') }} </th>
                @foreach ($all_items as $item_name)
                    <td class="text-center">
                        {{ number_format($items_totals_counts[$item_name] ?? 0) }}
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

                <td>{{ number_format($final_total) }}
                </td>
                <td>-</td>
                @foreach ($dead_stop_totals as $total)
                    <td class="text-center">
                        {{ number_format($total ?? 0) }}
                    </td>
                    <td class="text-center">
                        <b>{{  number_format($final_percentage, 1) . ' % ' }}</b>
                    </td>
                @endforeach

            </tr>
            <tr class="table-active text-center">
                <th class="text-center"> {{ 'Nature % / ' . __('Total '.($type ==  'discounts' ? 'Discounts' : 'Count')) }} </th>

                @foreach ($all_items as $item_name)
                    <?php $items_percentage = $final_total == 0 ? 0 : (($items_totals_counts[$item_name] ?? 0) / $final_total) * 100; ?>
                    <td class="text-center">
                        <b> {{   number_format($items_percentage, 1) . ' %' }}</b>
                    </td>
                    <td class="text-center">
                        -
                    </td>
                @endforeach

                <td><b>{{ number_format($final_percentage, 1) . ' %' }}</b></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        @endslot
    </x-table> --}}
@endsection

@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    @include('js_datatable')

    {{-- <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> --}}

@endsection
