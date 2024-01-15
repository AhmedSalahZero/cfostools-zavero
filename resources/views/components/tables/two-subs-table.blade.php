@foreach ($reportData as $reportName => $reportTotalWithItsSubItemsArray)
                    @php
                    $currentTotal = 0 ;
				$currentLoopItems = sumIntervals(removeKeyFromArray($reportTotalWithItsSubItemsArray,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
                    @endphp

                    <tr class=" text-center second-tr-bg second-tr-bg-more-padding">
                        
						<th class="text-center absorbing-column"></th>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <th></th>
                        @endforeach
                   
                    </tr>

                    <tr class="text-center first-tr">
                        <td class=" text-center"><b class="text-capitalize ">{{ __($reportName) }}</b></td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center ">
                            {{ number_format($currentValue = getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0),0) }}
                        </td>
                        @php
                        $currentTotal+=$currentValue
                        @endphp
                        @endforeach
                        
                    </tr>


                    @php
                    $id = 1 ;
                    @endphp

                    @foreach($reportTotalWithItsSubItemsArray['subItems']??[] as $subItemName => $subItemsTotalsAndItesSubItems )
                    @php
                    $mainRowtotal = 0 ;
					$currentLoopItems = sumIntervals(removeKeyFromArray($subItemsTotalsAndItesSubItems,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

                    @endphp
                    <tr class="group-color main-row-tr">
                        <td class="black-text" style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">
                            <div class="d-flex align-items-center ">
                                @if(count($subItemsTotalsAndItesSubItems['subItems']??[]))
                                <i class="row_icon{{ $id }} flaticon2-up  mr-2  "></i>
                                @endif
                                <b class="text-capitalize ">{{ __($subItemName) }}</b>
                            </div>
                        </td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center black-text">
                            {{ number_format($currentValue = getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0),0) }}
                        </td>
                        @php
                        $mainRowtotal += $currentValue ;
                        @endphp
                        @endforeach
                    
                    </tr>
                    @php
                    $order = 1 ;
                    @endphp
                    @foreach ( $subItemsTotalsAndItesSubItems['subItems']??[] as $subItemNameOfSubItem =>$subItemsTotalsAndItesSubItemsLast)

                    @php
                    $mainRowtotal = 0 ;
					$currentLoopItems = sumIntervals(removeKeyFromArray($subItemsTotalsAndItesSubItemsLast,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

                    @endphp
                    <tr data-order="{{ $order }}" class="row{{ $id }}  text-center sub-item-row" style="display: none">


                        <td data-order="{{ $order }}" class="black-text " style="cursor: pointer;" onclick="toggleRow2('{{ $id }}','{{ $order }}')">
                            <div class="d-flex align-items-center ">
                                <i  class="row_icon2{{ $id }} flaticon2-up  mr-2  ml-3"></i>
                                <b class="text-capitalize ">{{ __(str_replace('_',' ',$subItemNameOfSubItem)) }}</b>
                            </div>
                        </td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center black-text">
                            {{ number_format(getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0) ,0) }}
                        </td>
                        @php
                        $mainRowtotal += getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0) ;
                        @endphp
                        @endforeach
                    
                    </tr>

                    @foreach ($subItemsTotalsAndItesSubItemsLast['subItems'] ?? [] as $subNameOfThirdSubItem => $subDatesAndValues)
                    @php
					$currentLoopItems = sumIntervals(removeKeyFromArray($subDatesAndValues,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

                    $subItemTotal = 0 ;
                    @endphp

                    <tr data-order="{{ $order }}" class="row2{{ $id }}  text-center bg-last-row" style="display: none">
                        <td class="text-left text-capitalize bg-active-style"><b class="active-style ml-5">
                                {{ \App\Models\DepartmentExpense::getNameFromId($subNameOfThirdSubItem,$hospitalitySector->departmentExpenses) }}
                            </b></td>

                        @foreach ($dates as $dateAsString => $dateAsIndex)
                        <td class="text-center active-style">
                            {{ number_format(getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)   , 0)}}
                        </td>
                        @php
                        $subItemTotal += $subDatesAndValues[$date] ?? 0
                        @endphp
                        @endforeach
                    
                    </tr>





                    @endforeach


                    @php
                    $order = $order +1 ;
                    @endphp

                    @endforeach

                    <?php $id++ ;?>
                    @endforeach

                    @endforeach
