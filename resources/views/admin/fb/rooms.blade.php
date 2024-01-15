@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>

<style>
    .form-label {
        white-space: nowrap !important;
    }



    .visibility-hidden {
        visibility: hidden !important;
    }



    .three-dots-parent {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 0 !important;
        margin-top: 10px;

    }

    .blue-select {
        border-color: #7096f6 !important;
    }

    .div-for-percentage {
        flex-wrap: nowrap !important;
    }

    b {
        white-space: nowrap;
    }

    i.target_last_value {
        margin-left: -60px;
    }

    .total-tr {
        background-color: #074FA4 !important
    }

    .table-striped th,
    .table-striped2 th {
        background-color: #074FA4 !important
    }

    .total-tr td {
        color: white !important;
    }

    .total-tr .three-dots-parent {
        margin-top: 0 !important;
    }

</style>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Rooms Sales Projection Input Sheet Information') }}</x-main-form-title>

<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>

@endsection
@section('content')

<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($disabled) && $disabled ? '#' :  $storeRoute  }}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">
            <input type="hidden" name="hospitality_sector_id" value="{{ $hospitality_sector_id }}">
            <input id="daysDifference" type="hidden" value="{{ $daysDifference }}">

            {{-- Start Accomodation & Rooms Revenue Stream Information --}}

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                        {{ __('Accomodation & Rooms Revenue Stream Information') }}
                    </h3>

                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('Rooms Types') }}</th>
                                    <th class="text-center">{{ __('Rooms Count') }}</th>
                                    <th class="text-center">{{ __('Available Annual Rooms Nights') }}</th>
                                    <th class="text-center">{{ __('Average Guest Per Room') }}</th>
                                    <th class="text-center">{{ __('Average Daily Rate (ADR)') }}</th>
                                    <th class="text-center">{{ __('Choose Currency') }}</th>
                                    <th class="text-center">{{ __('ADR Estimation Date') }}</th>
                                    <th class="text-center">{{ __('ADR Escalation Rate %') }}</th>
                                    <th class="text-center">{{ __('ADR At Operation Date') }}</th>
                                    <th class="text-center">{!! __('Annual Escalation Rate %') !!}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{dd($rooms)}} --}}
                                @foreach($rooms as $index=>$room)

                                <tr>

                                    {{-- Rooms Types	 --}}
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ $room->getName() }}
                                        </b>
                                    </td>
                                    @php
                                    $order = 1 ;
                                    @endphp
                                    {{-- Rooms Count TD	 --}}
                                    <td>
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $room->getRoomCount() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-of-products="1" class="form-control target_repeating_amounts  size">
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                    $order = 2 ;
                                    @endphp
                                    {{-- Available Annual Rooms Nights TD	 --}}
                                    <td>

                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{   number_format($annualAvailableRoomsNights[$room->getRoomIdentifier()])  }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-of-products="1" class="form-control target_repeating_amounts size">
                                                <input type="hidden" value="{{ $annualAvailableRoomsNights[$room->getRoomIdentifier()] }}">
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $order = 3 ;
                                    @endphp

                                    {{-- Average Guest Per Room	Td  --}}
                                    <td>
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $room->getGuestPerRoom() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-of-products="1" class="form-control target_repeating_amounts  size">
                                                <input type="hidden" value="{{ $room->getGuestPerRoom() ?? 0 }}">
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $order = 4 ;
                                    @endphp

                                    {{-- Average Daily Rate (ADR) TD	 --}}
                                    <td>
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                {{-- average_daily_rate --}}
                                                <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($room->getAverageDailyRate() ?? 0)  }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $room->getRoomIdentifier() }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-of-products="1" class="form-control target_repeating_amounts  size " data-calc-adr-operating-date>
                                                <input class="avg-daily-rate" type="hidden" name="average_daily_rate[{{ $room->getRoomIdentifier() }}]" value="{{ $room->getAverageDailyRate() ?? 0 }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $room->getRoomIdentifier() }}">
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $order = 5 ;
                                    @endphp

                                    {{-- Choose Currency	Td --}}
                                    <td>
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <select name="chosen_room_currency[{{ $room->getRoomIdentifier() }}]" data-order="{{ $order }}" class="form-control choosen-currency-class" @if($index !=0) disabled @endif>
                                                    @foreach($studyCurrency as $currencyId=>$currencyName)
                                                    <option value="{{ $currencyId }}" @if($currencyId==( $room->getChosenCurrency()) )
                                                        selected
                                                        @endif
                                                        >{{ $currencyName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </td>

                                    @php
                                    $order = 6 ;
                                    @endphp


                                    {{-- ADR Estimation Date	 --}}
                                    <td>
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ ($model->getStudyStartDateFormattedForView()) }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-of-products="1" class="form-control target_repeating_amounts  size" data-date="#" aria-describedby="basic-addon2">

                                            </div>
                                            {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                        </div>
                                    </td>

                                    @php
                                    $order = 7 ;
                                    @endphp





                                    {{-- ADR Escalation Rate %	 --}}

                                    <td>

                                        <div class="form-group three-dots-parent three-dots-column">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($room->getAverageDailyRateEscalationRate()) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-total-of-products="1" data-calc-adr-operating-date data-room-type-id="{{ $room->getRoomIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                <input type="hidden" class="adr-escalation-rate" name="average_daily_rate_escalation_rate[{{ $room->getRoomIdentifier() }}]" data-room-type-id="{{ $room->getRoomIdentifier() }}" value="{{ $room->getAverageDailyRateEscalationRate() }}" data-order="{{ $order }}" data-index="{{ $index }}">

                                                <span class="ml-2">
                                                    <b>%</b>
                                                </span>
                                            </div>
                                            <i data-repeating-direction="column" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $order }}" data-section="target" title="{{__('Copy Column')}}"></i>

                                        </div>

                                    </td>

                                    @php
                                    $order = 8 ;
                                    @endphp



                                    {{-- ADR At Operation Date	 --}}
                                    <td>

                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input name="average_daily_rate_at_operation_date[{{ $room->getRoomIdentifier() }}]" value="{{ $room->getAverageDailyRateAtOperationDate() }}" data-room-type-id="{{ $room->getRoomIdentifier() }}" type="hidden" class="value-for-adr_at_operation_date">
                                                <input type="text" readonly data-room-type-id="{{ $room->getRoomIdentifier() }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $room->getAverageDailyRateAtOperationDate() }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-total-of-products="1" class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">

                                            </div>


                                        </div>


                                    </td>

                                    @php
                                    $order = 9 ;
                                    @endphp


                                    {{-- ADR Annual Escalation Rate % --}}
                                    <td>

                                        <div class="form-group three-dots-parent three-dots-column">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                {{-- average_daily_rate_annual_escalation_rate --}}
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($room->getAverageDailyRateAnnualEscalationRate()) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-total-of-products="1" data-room-type-id="{{ $room->getRoomIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                <input name="average_daily_rate_annual_escalation_rate[{{ $room->getRoomIdentifier() }}]" type="hidden" value="{{ $room->getAverageDailyRateAnnualEscalationRate() }}">
                                                <span class="ml-2">
                                                    <b>%</b>
                                                </span>
                                            </div>
                                            <i data-repeating-direction="column" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $order }}"></i>
                                        </div>

                                    </td>








                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{-- Start Accomodation & Rooms Revenue Stream Information --}}


            {{-- start of kt-protlet Exhange Rate Forecast % --}}
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Echange Rate Projection') }}
                                </h3>
                                {{-- <div class="form-group mb-0" style="margin-left:auto;margin-right:auto">
                                    <div class="kt-radio-inline">
                                        <label class="mr-3">

                                        </label>

                                        <label class="kt-radio kt-radio--success ">
                                            <input id="occupancy-rate-per-room-id" type="radio" name="occupancy_rate_type" value="occupancy_rate_per_room" class="occupancy-rate" @if($room->isOccupancyRatePerRoom() && count($rooms)) checked @endisset @if(isTotal($rooms)) disabled @endif>
                                            <label for="occupancy-rate-per-room-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                                {{ __('Occupancy Rate Per Room Type') }}
                                            </label>

                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--success ">
                                            <input type="radio" id="gerenal-id" value="general_occupancy_rate" name="occupancy_rate_type" class="occupancy-rate" @if( !$room->isOccupancyRatePerRoom() || isTotal($rooms) ) checked @endisset>
                                            <label for="gerenal-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                                {{ __('General Occupancy Rate') }}
                                            </label>
                                            <span></span>
                                        </label>
                                    </div>
                                </div> --}}

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".exhange-rate-projection">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row exhange-rate-projection">

                
                        <div class="table-responsive" >
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Item') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                        @endforeach
                                        {{-- <th class="text-center">{{__('Total')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $currentTotal = [];

                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Operating Months Per Year') }}
                                            </b>
                                        </td>
                                        @php
                                        //$order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            @endphp


                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ sumNumberOfOnes($yearsWithItsMonths,$year,$datesIndexWithYearIndex) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-percentage-allowed size" data-date="#" data-section="target" aria-describedby="basic-addon2">
                                                    <span class="ml-2">
                                                        <b style="visibility:hidden">%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>

                                        @endforeach

                                    </tr>




                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Echange Rate From ' . $model->getAdditionalCurrencyFormatted() . ' '.__('To') . ' ' . $model->getMainFunctionalCurrencyFormatted() ) }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getExchangeRateAtYear($year) ?? 0 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1)  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size"  data-year="{{ $year }}" >
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="exchange_rates[{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>





                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            {{-- end of kt-protlet Exhange Rate Forecast % --}}
			
			
			        {{-- start of kt-protlet Prjected Occupancy Rate % --}}
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Targeted Annual Occupancy Rate % Projection') }}
                                </h3>
                                <div class="form-group mb-0" style="margin-left:auto;margin-right:auto">
                                    <div class="kt-radio-inline">
                                        <label class="mr-3">

                                        </label>

                                        <label class="kt-radio kt-radio--success ">
                                            <input id="occupancy-rate-per-room-id" type="radio" name="occupancy_rate_type" value="occupancy_rate_per_room" class="occupancy-rate" @if($room->isOccupancyRatePerRoom() && count($rooms)) checked @endisset @if(isTotal($rooms)) disabled @endif>
                                            <label for="occupancy-rate-per-room-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                                {{ __('Occupancy Rate Per Room Type') }}
                                            </label>

                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--success ">
                                            <input type="radio" id="gerenal-id" value="general_occupancy_rate" name="occupancy_rate_type" class="occupancy-rate" @if( !$room->isOccupancyRatePerRoom() || isTotal($rooms) ) checked @endisset>
                                            <label for="gerenal-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                                {{ __('General Occupancy Rate') }}
                                            </label>
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".projected-occupancy-rate">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row projected-occupancy-rate">

                        <div class="table-responsive" data-name="occupancy_rate_per_room">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Rooms Types') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                        @endforeach
                                        {{-- <th class="text-center">{{__('Total')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- {{dd($salesChannelsNames)}} --}}
                                    {{-- <@php  $years= 0;$month_number = $salesPlan->start_from;$key=0;@endphp --}}
                                    @php
                                    $currentTotal = [];

                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Operating Months Per Year') }}
                                            </b>
                                        </td>
                                        @php
                                        //$order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            // $currentVal = $businessSectorsPercentages[$room->getRoomIdentifier()][$year] ?? 0 ;
                                            // $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp


                                            {{-- onkeypress="this.style.width = ((this.value.length + 1) * 8) + 'px';"    width-dynamic proba dva--}}
                                            <div class="form-group three-dots-parent">
                                                {{-- <label class="col-form-label take" style="text-decoration: underline;">{{date("M'y",strtotime($year))}}</label> --}}
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ sumNumberOfOnes($yearsWithItsMonths,$year,$datesIndexWithYearIndex) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" {{-- data-total-must-be-100="1" --}} class="form-control target_repeating_amounts only-percentage-allowed size" data-date="#" data-section="target" aria-describedby="basic-addon2" {{-- {{(@$salesPlan_item->target_nature  == 'varying' ||  old('target_nature') == 'varying')  ? '' : 'disabled'}} --}}>
                                                    <span class="ml-2">
                                                        <b style="visibility:hidden">%</b>
                                                    </span>
                                                </div>
                                            </div>
                                            {{-- <@php $month_number++ ;$key++ @endphp  --}}
                                        </td>

                                        @endforeach

                                    </tr>


                                    @foreach($rooms as $index=>$room)

                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ str_to_upper($room->getName()) }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $room->getOccupancyRateForRoomAtYear($year);
                                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input class="form-control target_repeating_amounts only-percentage-allowed size" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';">
                                                    <input type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="occupancy_rate_per_room[{{ $room->getRoomIdentifier() }}][{{ $year }}]" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp
                                        @endforeach

                                    </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" data-name="general_occupancy_rate">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Rooms Types') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                        @endforeach
                                        {{-- <th class="text-center">{{__('Total')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $currentTotal = [];

                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Operating Months Per Year') }}
                                            </b>
                                        </td>
                                        @php
                                        //$order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            // $currentVal = $businessSectorsPercentages[$room->getRoomIdentifier()][$year] ?? 0 ;
                                            // $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp


                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ sumNumberOfOnes($yearsWithItsMonths,$year,$datesIndexWithYearIndex) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-percentage-allowed size" data-date="#" data-section="target" aria-describedby="basic-addon2">
                                                    <span class="ml-2">
                                                        <b style="visibility:hidden">%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>

                                        @endforeach

                                    </tr>




                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('General Occupancy Rate') }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getGeneralOccupancyRateForYear($year) ?? 0 ;
                                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1)  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-date="#" data-year="{{ $year }}" data-section="target" aria-describedby="basic-addon2">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="general_occupancy_rate[{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>





                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            {{-- end of kt-protlet Prjected Occupancy Rate % --}}





            {{-- {{ end of Projected Occupancy Rate }} --}}


            {{-- start of Occupancy Rate Seasonality --}}
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Maximum Monthly Occupancy Rate % Projection') }}
                                </h3>
                                <div class="form-group mb-0 d-flex " style="margin-left:auto;margin-right:auto;gap:20px;">
                                    <select name="seasonality_type" class="form-control blue-select  seasonlity-select main-seasonality-select">
                                        <option value="">{{ __('Select Practical Occupancy Type') }}</option>
                                        <option @if($model->getSeasonalityType() == 'general-seasonality' || isTotal($rooms))
                                            selected
                                            @endif
                                            value="general-seasonality">{{ __('General Practical Rate') }}</option>
                                        <option value="per-room-type-seasonality" @if($model->getSeasonalityType() == 'per-room-type-seasonality' && !isTotal($rooms) )
                                            selected
                                            @endif

                                            @if(isTotal($rooms))
                                            disabled
                                            @endif

                                            >{{ __('Per Room Type Occupancy Rate') }}</option>
                                    </select>

                                    <select name="seasonality_interval" class="form-control blue-select seasonlity-select secondary-seasonality-select">
                                        <option value="">{{ __('Select') }}</option>
                                        <option value="flat-seasonality" @if($model->getSeasonalityInterval() == 'flat-seasonality' )
                                            selected
                                            @endif
                                            >



                                            {{ __('100% Max. Practical Occupancy') }}</option>
                                        {{-- <option 
								@if($model->getSeasonalityInterval() == 'quarterly-seasonality' )
								selected 
								@endif 
							
							value="quarterly-seasonality">{{ __('Quarterly Seasonality') }}</option> --}}
                                        <option @if($model->getSeasonalityInterval() == 'monthly-seasonality' )
                                            selected
                                            @endif
                                            value="monthly-seasonality">{{ __('Monthly Max. Practical Occupancy') }}</option>
                                    </select>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".occupancy-seasonality">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row occupancy-seasonality">

                        {{-- {{ start flat seasonlity }} --}}
                        <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="general-seasonality" data-select-2="flat-seasonality">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="flat-seasonality">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Seasonality Type') }}</th>
                                        @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                                        <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                                        @endforeach
                                        {{-- <th class="text-center">{{ __('Total') }}</th> --}}

                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                    $currentColTotal = [];

                                    @endphp


                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('General Seasonality') }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($months as $monthName=>$monthNameFormattedArray)

                                        <td>

                                            @php
                                            $currentVal = 100 ;
                                            $currentColTotal[$monthName]=isset($currentTotal[$monthName]) ? $currentTotal[$monthName] + $currentVal : $currentVal;

                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ 100 }}" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                                    <input type="hidden" value="100" name="flat_general_seasonality[{{ $monthNameFormattedArray['value'] }}]">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i data-year="{{ $monthName }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value visibility-hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>

                                        @if($monthName =='december')

                                        {{-- add total td --}}

                                        {{-- <td style="vertical-align:middle">


                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control allows-readonly result-of-total-row only-percentage-allowed size" data-number-format-digits="2" data-is-percentage="1">
                                        <span class="ml-2">
                                            <b>%</b>
                                        </span>
                        </div>
                        <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                    </div>


                    </td> --}}
                    @endif
                    @php
                    $order = $order +1 ;
                    @endphp
                    @endforeach

                    </tr>






                    </tbody>
                    </table>
                </div>
                {{-- {{ end flat seasonlity }} --}}



                {{-- start monthly-seasonality --}}
                <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="general-seasonality" data-select-2="monthly-seasonality">
                    <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="monthly-seasonality">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('Seasonality Type') }}</th>
                                @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                                <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                                @endforeach
                                {{-- <th class="text-center">{{ __('Total') }}</th> --}}

                            </tr>
                        </thead>
                        <tbody>

                            @php
                            $currentColTotal = [];

                            @endphp


                            <tr>
                                <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                    <b>
                                        {{ __('General Seasonality') }}
                                    </b>
                                </td>
                                @php
                                $order = 1 ;

                                @endphp

                                @foreach($months as $monthName=>$monthNameFormattedArray)

                                <td>

                                    @php
                                    $currentVal = $model->getGeneralSeasonalityAtDateOrQuarter($monthName) ?? 0 ;
                                    $currentColTotal[$monthName]=isset($currentTotal[$monthName]) ? $currentTotal[$monthName] + $currentVal : $currentVal;

                                    @endphp
                                    <div class="form-group three-dots-parent">
                                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                            <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                            <input type="hidden" name="monthly_general_seasonality[{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal*100 }}">
                                            <span class="ml-2">
                                                <b>%</b>
                                            </span>
                                        </div>
                                        <i data-year="{{ $monthName }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                    </div>

                                </td>
                                {{-- @dd('d') --}}

                                @if($monthName =='december')

                                {{-- add total td --}}

                                {{-- <td style="vertical-align:middle">


                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input  type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control allows-readonly result-of-total-row only-percentage-allowed size" data-number-format-digits="2" data-is-percentage="1">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                </div>
                <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
            </div>


            </td> --}}
            @endif
            @php
            $order = $order +1 ;
            @endphp
            @endforeach

            </tr>






            </tbody>
            </table>
    </div>
    {{-- end monthly-seasonality --}}

    {{-- Start quarterly-seasonality	 --}}
    <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="general-seasonality" data-select-2="quarterly-seasonality">
        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="quarterly-seasonality">
            <thead>
                <tr>
                    <th class="text-center">{{ __('Seasonality Type') }}</th>
                    @foreach(quartersNames() as $qName=>$qNameFormatted)
                    <th class="text-center"> {{ $qNameFormatted }}</th>
                    @endforeach

                    <th class="text-center">{{ __('Total') }}</th>

                </tr>
            </thead>
            <tbody>

                @php
                $currentColTotal = [];

                @endphp


                <tr>
                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                        <b>
                            {{ __('General Seasonality') }}
                        </b>
                    </td>
                    @php
                    $order = 1 ;

                    @endphp

                    @foreach(quartersNames() as $qName=>$qNameFormatted)

                    <td>

                        @php
                        $currentVal = $generalSeasonality[$qName] ?? 0 ;
                        $currentColTotal[$qName]=isset($currentTotal[$qName]) ? $currentTotal[$qName] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $qName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $qName }}" name="quarterly_general_seasonality[{{ $qName }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i data-year="{{ $qName }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>

                    </td>

                    @if($qName =='quarter-four')

                    {{-- add total td --}}

                    <td style="vertical-align:middle">


                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden" name="total_of_flat"  value="{{ 100 }}" class="result-of-total"> --}}
                                <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control allows-readonly result-of-total-row only-percentage-allowed size" data-number-format-digits="2" data-is-percentage="1">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i class="fa fa-ellipsis-h pull-{{__('left')}}  " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>


                    </td>
                    @endif
                    @php
                    $order = $order +1 ;
                    @endphp
                    @endforeach

                </tr>






            </tbody>
        </table>
    </div>
    {{-- end of quarterly-seasonality --}}




    {{-- start per room flat-seasonality --}}
    <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-room-type-seasonality" data-select-2="flat-seasonality">
        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="flat-seasonality">
            <thead>
                <tr>
                    <th class="text-center">{{ __('Seasonality Type') }}</th>
                    @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                    <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                    @endforeach
                    {{-- <th class="text-center">{{ __('Total') }}</th> --}}

                </tr>
            </thead>
            <tbody>

                @php
                $currentColTotal = [];

                @endphp

                @foreach($rooms as $index=>$room)
                <tr>
                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                        <b>
                            {{ $room->getName() }}
                        </b>
                    </td>
                    @php
                    $order = 1 ;

                    @endphp

                    @foreach($months as $monthName=>$monthNameFormattedArray)

                    <td>

                        @php
                        $currentVal = 1 ;
                        $currentColTotal[$monthName]=isset($currentTotal[$monthName]) ? $currentTotal[$monthName] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden"  value="{{ $currentVal }}"> --}}
                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                <input type="hidden" name="flat_per_room_seasonality[{{ $room->getRoomIdentifier() }}][{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal*100 }}">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i data-year="{{ $monthName }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value visibility-hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>

                    </td>

                    @if($monthName =='december')

                    {{-- add total td --}}

                    @endif
                    @php
                    $order = $order +1 ;
                    @endphp
                    @endforeach

                </tr>
                @endforeach





            </tbody>
        </table>
    </div>

    {{-- end per room flat seasonality --}}



    {{-- start per room monthly-seasonality --}}

    <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-room-type-seasonality" data-select-2="monthly-seasonality">
        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="monthly-seasonality">
            <thead>
                <tr>
                    <th class="text-center">{{ __('Seasonality Type') }}</th>
                    @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                    <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                    @endforeach
                    {{-- <th class="text-center">{{ __('Total') }}</th> --}}

                </tr>
            </thead>
            <tbody>

                @php
                $currentColTotal = [];

                @endphp

                @foreach($rooms as $index=>$room)
                <tr>
                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                        <b>
                            {{ $room->getName() }}
                        </b>
                    </td>
                    @php
                    $order = 1 ;

                    @endphp

                    @foreach($months as $monthName=>$monthNameFormattedArray)

                    <td>

                        @php
                        $currentVal = $room->getPerRoomSeasonalityForMonthOrQuarter($monthName) ;
                        $currentColTotal[$monthName]=isset($currentTotal[$monthName]) ? $currentTotal[$monthName] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                <input type="hidden" name="monthly_per_room_seasonality[{{ $room->getRoomIdentifier() }}][{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal }}">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i data-year="{{ $monthName }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>

                    </td>

                    @if($monthName =='december')

                    {{-- add total td --}}

                    {{-- <td style="vertical-align:middle">


                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control allows-readonly result-of-total-row only-percentage-allowed size" data-number-format-digits="2" data-is-percentage="1">
                    <span class="ml-2">
                        <b>%</b>
                    </span>
    </div>
    <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
</div>


</td> --}}
@endif
@php
$order = $order +1 ;
@endphp
@endforeach

</tr>
@endforeach





</tbody>
</table>
</div>

{{-- end per room monthly seasonality --}}




{{-- start per room quarterly seasonality --}}

<div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-room-type-seasonality" data-select-2="quarterly-seasonality">
    <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="quarterly-seasonality">
        <thead>
            <tr>
                <th class="text-center">{{ __('Seasonality Type') }}</th>
                @foreach(quartersNames() as $qName=>$qNameFormatted)
                <th class="text-center"> {{ $qNameFormatted }}</th>
                @endforeach

                {{-- <th class="text-center">{{ __('Total') }}</th> --}}

            </tr>
        </thead>
        <tbody>

            @php
            $currentColTotal = [];

            @endphp

            @foreach($rooms as $index=>$room)
            <tr>
                <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                    <b>
                        {{ $room->getName() }}
                    </b>
                </td>
                @php
                $order = 1 ;

                @endphp

                @foreach(quartersNames() as $qName=>$qNameFormatted)

                <td>

                    @php
                    $currentVal = $room->getPerRoomSeasonalityForMonthOrQuarter($qName) ;
                    $currentColTotal[$qName]=isset($currentTotal[$qName]) ? $currentTotal[$qName] + $currentVal : $currentVal;

                    @endphp
                    <div class="form-group three-dots-parent">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $qName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                            <input type="hidden" name="quarterly_per_room_seasonality[{{ $qName }}]" value="{{ $currentVal*100 }}">
                            <span class="ml-2">
                                <b>%</b>
                            </span>
                        </div>
                        <i data-year="{{ $qName }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                    </div>

                </td>

                @if($qName =='quarter-four')

                {{-- add total td --}}

                {{-- <td style="vertical-align:middle">


                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control allows-readonly result-of-total-row only-percentage-allowed size" data-number-format-digits="2" data-is-percentage="1">
                <span class="ml-2">
                    <b>%</b>
                </span>
</div>
<i class="fa fa-ellipsis-h pull-{{__('left')}}  " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
</div>


</td> --}}
@endif
@php
$order = $order +1 ;
@endphp
@endforeach

</tr>
@endforeach





</tbody>
</table>
</div>


{{-- end per room quarterly seasonality --}}

































</div>

</div>
</div>

{{-- {{ end of  Occupancy Rate Seasonality }} --}}











	@if(count($salesChannels))
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                        {{ __('Add Reservation Channels Revenues Share & Discount Rates %') }}
                    </h3>
				
                    {{-- <div class="form-group mb-0" style="margin-left:auto;margin-right:auto">
                        <div class="kt-radio-inline">
                            <label class="mr-3">

                            </label>

                            <label class="kt-radio kt-radio--success ">
                                <input @if(!count($salesChannels)) disabled @endif id="add-sales-channels-share-discount-id" type="radio" name="add_sales_channels_share_discount" value="1" class="add-sales-channels-share-discount" @if(isset($model) && $model->isAddSalesChannelsShareDiscount()) checked @endisset>
                                <label for="add-sales-channels-share-discount-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                    {{ __('Yes') }}
                                </label>
                                <span></span>
                            </label>
                            <label class="kt-radio kt-radio--danger ">
                                <input id="no-add-sales-channels-share-discount-id" type="radio" name="add_sales_channels_share_discount" value="0" class="add-sales-channels-share-discount" @if((isset($model) && !$model->isAddSalesChannelsShareDiscount()) || !count($salesChannels) ) checked @endisset @if(!count($salesChannels)) disabled @endif>
                                <label for="no-add-sales-channels-share-discount-id" class="font-weight-bold form-label" style="font-size:15px !important">
                                    {{ __('No') }}
                                </label>
                                <span></span>
                            </label>
                        </div>
                    </div> --}}
			

                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater
				@if(!count($salesChannels))
				disabled 
				pointer-events-none
				@endif 
				" data-query=".add-sales-channel-class">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row add-sales-channel-class" data-is-sales-channel-revenue-discount-section>
            <div class="col-md-12">

                {{-- Start of Sales Channel Revenue Share Percentage Table --}}
                <div class="kt-portlet">

                    <div class="kt-portlet__body" style="padding:0 !important">

                        <h4>{{__('Reservation Channel Revenue Share Percentage')}}</h4>


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 total-products-calcs share-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Reservation Channel') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $currentTotal = [];

                                    @endphp
                                    @foreach($salesChannels as $index=>$salesChannel)

                                    @php
                                    $salesChannelName = $salesChannel->getName();
                                    @endphp

                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ str_to_upper($salesChannelName) }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            // dd($salesChannel->getRevenueSharePercentageAtYear($year),$year);
                                            $currentVal = $salesChannel->getRevenueSharePercentageAtYear($year) ?? 0 ;
                                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">

                                                    <input data-year="{{ $year }}" data-has-row-total="0" data-max-row-total="0" data-has-column-total="1" data-max-column-total="100" data-is-percentage="1" data-no-digits="1" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size recalc-avg-weight-total revenue-share-percentage">
                                                    <input data-year="{{ $year }}" data-column-identifier="{{ $year }}" type="hidden" value="{{ $currentVal }}" name="revenue_share_percentage[{{ $salesChannelName }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp
                                        @endforeach

                                    </tr>
                                    @endforeach


                                    <tr class="total-tr">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <b>
                                                {{ __('Total') }}
                                            </b>
                                        </td>

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input data-column-identifier="{{ $year }}" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentTotal[$year] ?? 0 }}" readonly data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control   size">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order+ 1 ;
                                        @endphp
                                        @endforeach

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

                {{-- End of Sales Channel Revenue Share Percentage Table --}}



                {{-- Start Sales Channel Discount Rates % Table --}}
                <hr style="flex:1;background-color:lightgray;margin-bottom:30px">
                <div class="kt-portlet">
                    <div class="kt-portlet__body" style="padding:0 !important">
                        <h4>{{__('Reservation Channel Discount / Commission')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 discount-table total-products-calcs">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Reservation Channel') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salesChannels as $index=>$salesChannel)
                                    @php
                                    $salesChannelName = $salesChannel->getName();
                                    @endphp

                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ str_to_upper($salesChannelName) }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;
                                        @endphp
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input class="form-control target_repeating_amounts only-percentage-allowed size recalc-avg-weight-total discount-commission-percentage" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($salesChannel->getDiscountOrCommissionAtYear($year),1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-year="{{ $year }}">
                                                    <input type="hidden" name="discount_or_commission[{{ $salesChannelName }}][{{ $year }}]" value="{{ $salesChannel->getDiscountOrCommissionAtYear($year) }}">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp
                                        @endforeach

                                    </tr>
                                    @endforeach


                                    <tr class="total-tr">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <b>
                                                {{ __('Weighted Average Total') }}
                                            </b>
                                        </td>
                                        @php
                                        $order =1 ;
                                        @endphp
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>


                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="hidden" class="weight-avg-total-hidden" value="0" data-order="{{ $order }}">
                                                    <input class="form-control size weight-avg-total" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="0" readonly data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        @php
                                        $order = $order+ 1 ;
                                        @endphp
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- End Of Sales Channel Discount Rates % Table --}}





            </div>
        </div>

    </div>
</div>
@endif


@include('admin.hospitality-sector.collection-policy',[
'collectionPolicyFirstLabel'=>__('Collection Terms Per Reservation Channel'),
'firstHeader'=>__('Reservation Channels'),
'collectionPolicyItems'=>$salesChannels,
'modelName'=>'room',
'isGeneralCollectionPolicy'=>$model->isRoomGeneralCollection(),
'isCollectionTermPerItem'=>$model->isRoomCollectionTermPerSalesChannel(),
'onlyGeneralExpense'=>!count($salesChannels)
])




















<x-save-or-back :btn-text="__('Create')" />
</div>

</div>

</div>




</div>









</div>
</div>
</form>

</div>
@endsection
@section('js')
<x-js.commons></x-js.commons>

<script>


</script>

<script>
    $(document).on('click', '.save-form', function(e) {
        e.preventDefault(); {

            const hasSalesChannel = $('#add-sales-channels-share-discount-id:checked').length

            let canSubmitForm = true;
            let errorMessage = '';
            let messageTitle = 'Oops...';


            // if (!$('#sales_revenues_id').val().length) {
            //     canSubmitForm = false;
            //     errorMessage = "{{ __('Please Select At Least One Sales Revenue') }}"
            // }

            if (!canSubmitForm) {
                Swal.fire({
                    icon: "warning"
                    , title: messageTitle
                    , text: errorMessage
                , })

                return;
            }


            let form = document.getElementById('form-id');
            var formData = new FormData(form);
            $('.save-form').prop('disabled', true);


            $.ajax({
                cache: false
                , contentType: false
                , processData: false
                , url: form.getAttribute('action')
                , data: formData
                , type: form.getAttribute('method')
                , success: function(res) {
                    $('.save-form').prop('disabled', false)

                    Swal.fire({
                        icon: 'success'
                        , title: res.message,

                    });

                    window.location.href = res.redirectTo;




                }
                , complete: function() {
                    $('#enter-name').modal('hide');
                    $('#name-for-calculator').val('');

                }
                , error: function(res) {
                    $('.save-form').prop('disabled', false);
                    $('.submit-form-btn-new').prop('disabled', false)
                    Swal.fire({
                        icon: 'error'
                        , title: res.responseJSON.message
                    , });
                }
            });
        }
    })


    $(document).on('change', '.use-rooms', function() {
        let useRooms = $("#use-rooms-1").is(':checked')
        if (useRooms) {
            $('.rooms-repeater').fadeIn(300)
            $('input[type="radio"][name*="rooms"]').val(1);

        } else {
            $('.rooms-repeater').fadeOut(300);
            $('input[type="radio"][name*="rooms"]').val(0);
        }
    });

    $('.use-rooms').trigger('change')




    $(document).on('change', '.use-foods', function() {
        let useFoods = $("#use-foods-1").is(':checked')
        if (useFoods) {
            $('.foods-repeater').fadeIn(300)
            $('input[type="radio"][name*="foods"]').val(1);

        } else {
            $('.foods-repeater').fadeOut(300);
            $('input[type="radio"][name*="foods"]').val(0);
        }
    });
    $('.use-foods').trigger('change')



    $(document).on('change', '.use-casino', function() {
        let useCasino = $("#use-casinos-1").is(':checked')

        if (useCasino) {
            $('.casino-repeater').fadeIn(300)
            $('input[type="radio"][name*="casinos"]').val(1);
        } else {
            $('.casino-repeater').fadeOut(300);
            $('input[type="radio"][name*="casinos"]').val(0);
        }
    });

    $('.use-casino').trigger('change')


    $(document).on('change', '.use-meeting', function() {
        let useCasino = $("#use-meetings-1").is(':checked')

        if (useCasino) {
            $('.meeting-repeater').fadeIn(300)
            $('input[type="radio"][name*="meetings"]').val(1);
        } else {
            $('.meeting-repeater').fadeOut(300);
            $('input[type="radio"][name*="meetings"]').val(0);
        }
    })
    $('.use-meeting').trigger('change')


    $(document).on('change', '.use-other', function() {
        let useCasino = $("#use-others-1").is(':checked')

        if (useCasino) {
            $('.other-repeater').fadeIn(300)
            $('input[type="radio"][name*="other"]').val(1);
        } else {
            $('.other-repeater').fadeOut(300);
            $('input[type="radio"][name*="other"]').val(0);
        }
    })
    $('.use-other').trigger('change')

</script>

<script>
    $('.use-rooms:checked').trigger('change');

</script>

<script>
    $(document).find('.datepicker-input').datepicker({
        dateFormat: 'mm-dd-yy'
        , autoclose: true
    })
    $(document).on('change', '.can-not-be-removed-checkbox', function() {
        $(this).prop('checked', true)
    })

    $(document).on('click', '.show-hide-repeater', function() {
        const query = this.getAttribute('data-query')
        $(query).fadeToggle(300)

    })
    $(document).on('change', '.not-allowed-duplication-in-selection-inside-repeater', function() {
        const val = $(this).val()
        const currentSelect = this
        const currentSelectedOption = $(currentSelect).find('option[value="' + val + '"]')
        const commonParent = $(this).closest('[data-repeater-list]')
        // let selectItems = []
        // $(commonParent).find('select').each(function(index,select){
        // 	selectItems.push($(select).val())
        // })
        $(commonParent).find('select').each(function(index, select) {
            if (select != currentSelect) {
                if ($(select).find('option[value="' + val + '"]:selected').length) {
                    alert('This Item has been choosen before')
                    $(currentSelect).val('').trigger('change')

                }

                //.prop('disabled',true).attr('title','This Item has been choosen before')
            } else {}
        })
    })

    $(document).on('change', '.can-be-toggle-show-repeater-btn', function() {
        let val = $(this).is(':checked')
        let repeaterQuery = $(this).attr('data-repeater-query')
        if (!val) {
            $('.show-hide-repeater[data-query="' + repeaterQuery + '"]').addClass('disabled');
            $('[data-repeater-row="' + repeaterQuery + '"]').fadeOut(300)
            $(this).val(0)
        } else {
            $('.show-hide-repeater[data-query="' + repeaterQuery + '"]').removeClass('disabled');
            $('[data-repeater-row="' + repeaterQuery + '"]').fadeIn(300)
            $(this).val(1)

        }

    })
    $('.can-be-toggle-show-repeater-btn').trigger('change')

    $(function() {
        $('.discount-table tr:first-of-type td .target_repeating_amounts').trigger('keyup')
    })

</script>
<script>
    $(document).on('change', '[data-calc-adr-operating-date]', function() {
        const power = parseFloat($('#daysDifference').val());
        const roomTypeId = $(this).attr('data-room-type-id');
        let avgDailyRate = $('.avg-daily-rate[data-room-type-id="' + roomTypeId + '"]').val();
        avgDailyRate = number_unformat(avgDailyRate)
        let ascalationRate = $('.adr-escalation-rate[data-room-type-id="' + roomTypeId + '"]').val() / 100;

        const result = avgDailyRate * Math.pow(((1 + ascalationRate)), power)
        $('.value-for-adr_at_operation_date[data-room-type-id="' + roomTypeId + '"]').val(result)
        $('.html-for-adr_at_operation_date[data-room-type-id="' + roomTypeId + '"]').val(number_format(result))
    })
    $(document).on('change', '.add-sales-channels-share-discount', function() {
        let val = +$(this).attr('value');
        if (val) {
            $('[data-is-sales-channel-revenue-discount-section]').show();
        } else {
            $('[data-is-sales-channel-revenue-discount-section]').hide();

        }
    })
    $(document).on('change', '.occupancy-rate', function() {
        let val = $(this).attr('value');

        if (val == 'general_occupancy_rate') {
            $('[data-name="general_occupancy_rate"]').fadeIn(300)
            $('[data-name="occupancy_rate_per_room"]').fadeOut(300)
        } else {
            $('[data-name="general_occupancy_rate"]').fadeOut(300)
            $('[data-name="occupancy_rate_per_room"]').fadeIn(300)

        }
    })
    $(document).on('change', '.collection_rate_class', function() {
        let val = $(this).val();
        if (val == 'terms_per_sales_channel') {
            $('[data-name="per-sales-channel-collection"]').fadeIn(300)
            $('[data-name="general-collection-policy"]').fadeOut(300)
        } else {
            $('[data-name="per-sales-channel-collection"]').fadeOut(300)
            $('[data-name="general-collection-policy"]').fadeIn(300)

        }
    })

    $(document).on('change', '.seasonlity-select', function() {
        const mainSelect = $('.main-seasonality-select').val()
        const secondarySelect = $('.secondary-seasonality-select').val();
        $('.one-of-seasonality-tables-parent').addClass('d-none');
        $('[data-select-1*="' + mainSelect + '"][data-select-2*="' + secondarySelect + '"]').removeClass('d-none')

    })

    $(document).on('change', '.collection_rate_input', function() {
        let salesChannelName = $(this).attr('data-sales-channel-name')
        let total = 0;
        $('.collection_rate_input[data-sales-channel-name="' + salesChannelName + '"]').each(function(index, input) {
            total += parseFloat(input.value)
        })
        $('.collection_rate_total_class[data-sales-channel-name="' + salesChannelName + '"]').val(total)
    })


    $(function() {
        $('[data-calc-adr-operating-date]').trigger('change')
        $('.occupancy-rate:checked').trigger('change')
        $('.collection_rate_class:checked').trigger('change')
        $('.add-sales-channels-share-discount:checked').trigger('change')
        $('.main-seasonality-select').trigger('change')
        $('[data-repeater-create]').trigger('')
    })

    $(document).on('change keyup', '.recalc-avg-weight-total', function() {
        const order = this.getAttribute('data-order')
        let currentTotal = 0;
        $('.revenue-share-percentage[data-order="' + order + '"]').each(function(i, revenueSharePercentageInput) {
            var currentIndex = revenueSharePercentageInput.getAttribute('data-index');
            var revenueSharePercentageAtIndex = $(revenueSharePercentageInput).parent().find('input[type="hidden"]').val();
            revenueSharePercentageAtIndex = revenueSharePercentageAtIndex ? revenueSharePercentageAtIndex / 100 : 0;
            var discountSharePercentageAtIndex = $('.discount-commission-percentage[data-order="' + order + '"][data-index="' + currentIndex + '"]').parent().find('input[type="hidden"]').val();
            discountSharePercentageAtIndex = discountSharePercentageAtIndex ? discountSharePercentageAtIndex / 100 : 0;
            currentTotal += discountSharePercentageAtIndex * revenueSharePercentageAtIndex;
        })
        currentTotal = currentTotal * 100;
        $('.weight-avg-total-hidden[data-order="' + order + '"]').val(currentTotal);
        $('.weight-avg-total[data-order="' + order + '"]').val(number_format(currentTotal, 1)).trigger('keyup');
    })


    $(function() {



        $('.recalc-avg-weight-total').trigger('change')
    })
    $(function() {
        $('.choosen-currency-class').on('change', function() {
            $('.choosen-currency-class').val($(this).val())
        })
        $('.choosen-currency-class').trigger('change');
    })

</script>


@endsection
