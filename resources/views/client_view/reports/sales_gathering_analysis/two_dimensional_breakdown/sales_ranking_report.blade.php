@extends('layouts.dashboard')
@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }

    </style>
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

    <!--begin: Datatable -->

    <x-table   :tableClass="'kt_table_with_no_pagination '">
        @slot('table_header')
            <tr class="table-active text-center">
                <?php $main_type_name = ucwords(str_replace('_', ' ', $main_type));  ?>
                <th>{{ __($main_type_name) 
                 }}</th>
                @for($i = 1 ; $i <= count($data) ; $i++)
                @foreach(['Rank [ '.$i.' ] '.ucwords(str_replace('_', ' ', $type))  , 'Percentage %' , 'Value' , 'Percentage %'] as $item)
                    <th>{{ __($item) }}</th>
                    @endforeach 
                @endfor 
                {{-- <td>{{ __('Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }}</td> --}}
                {{-- @if (isset($totals_sales_per_main_type)) --}}
                    {{-- <td>{{ __((  'Discounts %'  )) }}</td> --}}
                {{-- @endif --}}

            </tr>
        @endslot
        @slot('table_body')
            {{-- $final_percentage = $final_total == 0 ? 0 : (($final_total ?? 0) / $final_total) * 100; ?> --}}
            @foreach ($data as $branchName => $statistics)
                <tr>
                    <th> {{ __($branchName) }} </th>
        @for($rankNumber = 1 ;$rankNumber <= count($data) ; $rankNumber++ )
        
        @php $totalForBranch = countTotalForBranch($data[$branchName]) @endphp 
        @php $allRanksTotals =  countSumForAllRank($data , $rankNumber) @endphp 
                        <td class="text-center">
                            {{-- <td class="text-center"> --}}
                            

                                <button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal" data-target="#kt_modal_{{str_replace(' ' , '-' , $branchName) . $rankNumber}}"> 

                                {{ $countItemsPerBranch = (isset($statistics[$rankNumber]) ? count($statistics[$rankNumber]) : 0) }}
                            </button>


                               <div class="modal " id="kt_modal_{{str_replace(' ' , '-' , $branchName) . $rankNumber}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="text-align: left !important" class="modal-title " id="exampleModalLongTitle">
                                                {{ $branchName . ' [ ' . $rankNumber . ' ]' }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- <div class="kt-scroll" data-scroll="true" data-height="200"> --}}
                                                <x-table  :tableClass="'kt_table_with_no_pagination_no_scroll'">
                                                    @slot('table_header')
                                                        <tr class="table-active ">

                                                            <th style="text-align: left !important">{{ __('Product Name ') }}</th>
                                                            <th>{{ __('Sales Values') }}</th>
                                                        </tr>
                                                    @endslot
                                                    @slot('table_body')
                                                                @php $produtNumber = 0;$dataForRankings = $data[$branchName][$rankNumber] ?? [];
                                                                orderTotalsForRanking($dataForRankings);
                                                                 @endphp 
                                                                
                                                                @foreach( $dataForRankings as $productName=>$val)
                                                            <tr>

                                                                <td style="text-align: left !important"> {{ ++$produtNumber }} - {{ $productName }}</td>
                                                                <td>{{number_format($val['total'] ?? 0)}}</td>
                                                            </tr>
                                                                @endforeach 

                                                        {{-- @endforeach --}}
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

                              

                        </td>
                        

 <td class="text-center">

     {{ number_format(($countItemsPerBranch / $totalForBranch) * 100 , 1)  }}  % 
                             
                        </td>

                         <td class="text-center">
                             {{ isset($statistics[$rankNumber]) ? number_format(array_sum(flatten($statistics[$rankNumber])) , 0 ) : 0 }}
                        </td>


                            <td class="text-center">
                                
                             {{ isset($statistics[$rankNumber]) && $allRanksTotals['values'] ? number_format( (array_sum(flatten($statistics[$rankNumber])) / $allRanksTotals['values'])*100 , 1 ) : 0 }} % 

                            {{-- {{(isset($statistics[$rankNumber]) ? count($statistics[$rankNumber]) : 0) }} --}}
                        </td>


                        
            @endfor 
                        


                    {{-- <td class="text-center">
                     tet
                    </td>
                    @if (isset($totals_sales_per_main_type))
                        <td class="text-center">
                            www
                            {{ ($totals_sales_per_main_type[$main_type_item_name]??0) ==0 ?  0  : number_format((($main_item_total/$totals_sales_per_main_type[$main_type_item_name] )*100) , 1) .' %' }}
                        </td>
                    @endif --}}



                   

                </tr>


            @endforeach





            <tr class="table-active text-center">
                <th class="text-center"> {{ __('Total') }} </th>
                 @foreach ($data as $branchName => $statistics)
                @for($rankNumber = 1 ;$rankNumber <= count($data) ; $rankNumber++ )
                @php $allRanksTotals =  countSumForAllRank($data , $rankNumber) @endphp 
                    <td class="text-center">
                        {{ $allRanksTotals['total'] }}
                    </td>

                   

                      <td class="text-center">
                {{-- {{ $allRanksTotals['percentages'] }} --}}
                    </td>

                       <td class="text-center">
                        {{ number_format($allRanksTotals['values'] , 0) }}
                    </td>

                    <td class="text-center">
                {{-- {{ $allRanksTotals['percentages'] }} --}}
                    </td>


                    @endfor 

                    @break 

                    @endforeach
                    {{-- {{ number_format($final_total) }} --}}
                    {{-- <b>{{ ' [ ' . number_format($final_percentage, 1) . ' % ] ' }}</b> --}}
                {{-- @if (isset($totals_sales_per_main_type)) --}}
                    {{-- <td class="text-center">-</td> --}}
                {{-- @endif --}}
            </tr>


            {{-- <tr class="table-active text-center">
                <th class="text-center"> 
                    {{ __(ucwords(str_replace('_', ' ', $type))) . ' % / ' . __('Total '.($type ==  'discounts' ? 'Discounts' : 'Sales')) }} 
                    
                    </th>
                @foreach ($all_items as $item_name)
                    <td class="text-center">
                        <b> {{   number_format($items_percentage, 1) . ' %' }}</b>
                    11
                    </td>
                @endforeach

                <td>
                    <b>{{ number_format($final_percentage, 1) . ' %' }}</b>
                    </td>
                @if (isset($totals_sales_per_main_type))
                    <td>-</td>
                @endif

            </tr> --}}
            {{-- @if (isset($totals_sales_per_main_type))
                <tr class="table-active text-center">
                    <th class="text-center"> {{ __(ucwords(str_replace('_', ' ', $type))) . ' % / Sales'   }} </th>
                    @foreach ($all_items as $item_name)
                        @php $items_percentage = $total_sales == 0 ? 0 : (($items_totals[$item_name] ?? 0) / $total_sales) * 100; @endphp
                        <td class="text-center">
                            <b> {{   number_format($items_percentage, 1) . ' %' }}</b>
                        </td>
                    @endforeach

                    <td><b>{{ number_format((( $total_sales == 0 ? 0 : ($final_total/$total_sales) * 100)), 1) . ' %' }}</b></td>
                    <td class="text-center">-</td>
                </tr>
            @endif --}}
        @endslot
    </x-table>

    <!--end: Datatable -->
@endsection

@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

@endsection
