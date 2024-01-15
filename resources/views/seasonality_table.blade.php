
<?php
$TheMainSectionTitle = @explode('Sales', Request()->segments()[count(Request()->segments()) - 2])[0] ?? '' ;

 ?>

<x-table :tableTitle="$TheMainSectionTitle . __(' Seasonality Sales Trend Analysis Report')"
                        :tableClass="'kt_table_with_no_pagination_no_search'">
                        @slot('table_header')
                            <tr class="table-active">
                                <th>{{ $TheMainSectionTitle }}</th>
                                {{-- <th>{{ __('Branch') }}</th> --}}
                                @foreach ($total_branches as $date => $total)
                                    <th>{{ date('d-M-Y', strtotime($date)) }}</th>
                                    @if($loop->last)
                                    <th>{{ __('Total') }}</th>
                                    @endif 
                                @endforeach
                            </tr>
                        @endslot
                        @slot('table_body')
     
                            @foreach ($final_report_data as $zone_name => $zoone_data)
                           
                              
                                <tr class="group-color text-lg-left  ">
                                    <td colspan="{{ count($total_branches) + 2 }}"><b
                                            class="white-text">{{ __($zone_name) }}</b>
                                    </td>
                                    @foreach ($total_branches as $date => $total)
                                        <td class="hidden"> </td>
                                    @endforeach
                                        <td class="hidden"> </td>

                                </tr>
                                <tr>
                                    <th>{{ __('Seasonality %') }}</th>
                                         <?php $totalSum = array_sum($zoone_data['Sales Values'])  ?>
                                         <?php   $totals = 0 ;  ?>
                                    @foreach ($total_branches as $date => $total)
                                        <td class="text-center">
                                            
                                            <?php $totals = $totals + ($totalss = number_format(isset($zoone_data['Sales Values'][$date])  && $totalSum  ? (($zoone_data['Sales Values'][$date] / $totalSum)*100      ) : 0,2) )  ?>
                                            
                                            <?php 

                                            if (isset($totalArrys[$date]['value']))
                                            {
                                               
                                                $totalArrys[$date]['value'] = $totalArrys[$date]['value'] + (isset(($zoone_data['Sales Values'][$date])) ? ($zoone_data['Sales Values'][$date]) : 0)  ;
                                                $totalArrys[$date]['total'] = $totalArrys[$date]['total'] +  array_sum(isset($zoone_data['Sales Values']) ? $zoone_data['Sales Values'] : [])  ;
                                               
                                            }
                                            else
                                            {
                                                $totalArrys[$date]['value'] = (isset($zoone_data['Sales Values'][$date])) ?$zoone_data['Sales Values'][$date] : 0 ;
                                                $totalArrys[$date]['total'] =   array_sum(isset($zoone_data['Sales Values']) ? $zoone_data['Sales Values'] : []) ;
                                                
                                            }

                                            
                                            
                                            
                                            
                                            
                                            ?>
                                          
                                                
                                            {{  number_format($totalss , 2) }} %


                                         
                                        
                                        </td>
                                         @if($loop->last)
                                         <td class="text-center">
                                            {{ number_format($totals )  }} %
                                        </td>
                                         @endif 

                                    @endforeach
                                </tr>

                            @endforeach



                            <tr>
                                <th class="active-style text-center">{{ __('TOTAL') }}</th>
                                @foreach ($totalArrys as $date => $total)
                                    <td class="text-center active-style">{{ isset($total['total']) && $total['total'] ? number_format($total['value']/ $total['total'] * 100 , 2) : 0 }} %</td>
                                @endforeach
                                <td class="text-center active-style">100 %</td>
                            </tr>

                          

                        @endslot
                      </x-table>