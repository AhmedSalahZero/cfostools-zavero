@php
	$sumMethodAsHelper = isset($sumMethodAsHelper) ? $sumMethodAsHelper : 'sumIntervals';


@endphp
			@foreach ($reportData as $reportName => $reportTotalWithItsSubItemsArray)
			@php
			
				$currentLoopItems = $sumMethodAsHelper(removeKeyFromArray($reportTotalWithItsSubItemsArray,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
			
			@endphp
                    @php
                    $currentTotal = 0 ;
                    @endphp
                    <tr class="first-tr text-center ">
                        <td class=" text-center"><b class="text-capitalize">{{ __($reportName) }}</b></td>
                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center ">
						
                            {{ number_format(getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0),0) }}
                        </td>
                        @php
                        $currentTotal+=getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)
                        @endphp
                        @endforeach

                    </tr>
                    @php
                    $id = 0 ;
                    @endphp
                    @foreach($reportTotalWithItsSubItemsArray['subItems']??[] as $subItemName => $subItemsTotalsAndItesSubItems )
						@php
						if($subItemName == 'Net Profit'){
							$currentLoopItems = sumIntervals(removeKeyFromArray($subItemsTotalsAndItesSubItems,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
							
						} 
						elseif($subItemName == 'Retained Earnings'){
							
							$currentNetProfit = sumIntervals($reportData['Owners Equity']['subItems']['Net Profit'] ?? [],$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
							$currentLoopItems = $hospitalitySector->calculateRetainedEarning($currentNetProfit);
						}
						else {
						$currentLoopItems = $sumMethodAsHelper(removeKeyFromArray($subItemsTotalsAndItesSubItems,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
						}
						@endphp
                    @php
                    $mainRowtotal = 0 ;
                    @endphp
				
                    <tr class="group-color main-row-tr">
                        <td class="black-text " style="cursor: pointer;" onclick="toggleRow('{{ $id }}')">

                            <div class="d-flex align-items-center ">
                                @if(count($subItemsTotalsAndItesSubItems['subItems'] ?? []))
                                <i class="row_icon{{ $id }} flaticon2-up  mr-2  "></i>
                                @endif
                                <b class="text-capitalize ">{{ __($subItemName) }}</b>
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

                    @foreach ($subItemsTotalsAndItesSubItems['subItems'] ?? [] as $subName => $subDatesAndValues)
						@php
						$currentLoopItems = $sumMethodAsHelper(removeKeyFromArray($subDatesAndValues,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);
						
						@endphp
                    @php
                    $subItemTotal = 0 ;
                    @endphp



                    <tr class="row{{ $id }}  text-center sub-item-row" style="display: none">
                        {{-- <td></td> --}}
                        <td class="text-left text-capitalize"><b class="ml-3">
                                {{ $subName }}
                            </b></td>

                        @foreach ($dates as $dateAsString=>$dateAsIndex)
                        <td class="text-center">
                            {{ number_format(getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)  , 0)}}
                        </td>
                        @php
                        $subItemTotal += getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)
                        @endphp
                        @endforeach
              
                    </tr>

                    @endforeach


                    <?php $id++ ;?>
                    @endforeach
                    @endforeach
