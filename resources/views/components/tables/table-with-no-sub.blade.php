@php
	$sumMethodAsHelper = isset($sumMethodAsHelper) ? $sumMethodAsHelper : 'sumIntervals';
@endphp
@foreach ($reportData as $reportName => $reportTotalWithItsSubItemsArray)

@if(true)
@php
$currentTotal = 0 ;



$currentLoopItems = $sumMethodAsHelper(removeKeyFromArray($reportTotalWithItsSubItemsArray,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

@endphp
<tr class="{{ $firstTrClass ??'' }} first-tr text-center ">
    <td class=" text-left"><b class="text-capitalize">{{ __($reportName) }}</b></td>

    @foreach ($dates as $dateAsString=>$dateAsIndex)
    <td class="  text-center">
        @if($reportName == 'Accumulated Net Cash')
  
        {{ number_format($currentValue = getValueFromArrayStringAndIndex(\App\Helpers\HArr::accumulateArray($reportData['Net Cash Report']),$dateAsString,$dateAsIndex,0) ,0) }}
        @else
        {{ number_format($currentValue = getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0) ,0) }}
        @endif
    </td>
    @php
    $currentTotal+=$currentValue;
    @endphp
    @endforeach

</tr>
@php
$id = 2 ;
@endphp

@foreach($reportTotalWithItsSubItemsArray['subItems']??[] as $subItemName => $subItemsTotalsAndItesSubItems )

@php
$mainRowtotal = 0 ;
$currentLoopItems = $sumMethodAsHelper(removeKeyFromArray($subItemsTotalsAndItesSubItems,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

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

        {{ number_format($currentValue=getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0),0) }}
    </td>
    @php
    $mainRowtotal += $currentValue ;
    @endphp
    @endforeach

</tr>

@foreach ($subItemsTotalsAndItesSubItems['subItems'] ?? [] as $subName => $subDatesAndValues)
@php
$subItemTotal = 0 ;

$currentLoopItems = $sumMethodAsHelper(removeKeyFromArray($subDatesAndValues,'subItems'),$interval,$hospitalitySector->financialYearStartMonth(),$dateIndexWithDate);

@endphp



<tr class="row{{ $id }}  text-center sub-item-row" style="display: none">
    {{-- <td></td> --}}
    <td class="text-left text-capitalize"><b class="ml-3">
            {{ $subName }}
        </b></td>

    @foreach ($dates as $dateAsString=>$dateAsIndex)
    <td class="text-center">
        {{ number_format($currentValue=getValueFromArrayStringAndIndex($currentLoopItems,$dateAsString,$dateAsIndex,0)   , 0)}}
    </td>
    @php
    $subItemTotal += $currentValue;

    @endphp
    @endforeach

</tr>



@endforeach


<?php $id++ ;?>
@endforeach



@endif
@endforeach
