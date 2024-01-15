@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>

<style>
    .main-seasonality-select {
        min-width: 250px;
    }

    .kt-header-menu-wrapper {
        margin-left: 0 !important;
    }

    .kt-header-menu-wrapper .kt-header-menu .kt-menu__nav>.kt-menu__item>.kt-menu__link {
        padding: 0.60rem 1.25rem !important;
    }

    .max-w-22 {
        max-width: 22%;
    }

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
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Meeting Spaces Sales Projection Input Sheet') }}</x-main-form-title>
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

            {{-- Start Choose F&B Sales Projection Method --}}

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="d-flex align-items-center ">
                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                            {{ __('Choose Meeting Spaces Sales Projection Method') }}
                        </h3>
                        <div class="col-md-2" style="margin-left:auto">
                            <div class="btn active-style show-hide-repeater" data-query=".f-b-sales-project-method">{{ __('Show/Hide') }}</div>
                        </div>

                    </div>

                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>



                    <div class="table-responsive f-b-sales-project-method">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('Meeting Spaces Facility') }}</th>
                                    <th class="text-center">{{ __('Select Projection Method') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>

                                    {{-- Meetings Types	 --}}
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>
                                                    {{ __('Same Method For All Meeting Spaces Facilities') }}
                                                </b>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                    $order = 1 ;
                                    @endphp
                                    {{-- Meetings Count TD	 --}}
                             
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <select name="f&b_facilities[all]" class="form-control blue-select all-faciltiies-select">
                                                    <option selected value="">{{ __('Select Method') }}</option>
                                                    <option  value="{{ guest_count_charges_per_guest_occupancy_rate_method }}">{{ __('Guest Count x Charges Per Guest x Occupancy Rate Method') }}</option>
                                                    <option  value="{{ facility_count_daily_rent_occupancy_rate_method }}">{{ __('Facility Count x Daily Rent x Occupancy Rate Method') }}</option>
                                                    <option  value="{{ percentage_from_f_b_revenue }}">{{ __('Percentage % From F&B Revenues') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $order = $order +1 ;
                                    @endphp

                                </tr>

                                @foreach(count($meetings) ? $meetings : generateTotalMeetingInstance($model) as $index=>$meeting)

                                <tr>

                                    {{-- Meetings Types	 --}}
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <div class="row ">
                                            <div class="col-md-4">
                                                <b>
                                                    {{ $meeting->getName() }}
                                                </b>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                    $order = 2 ;
                                    @endphp
                                    {{-- Meetings Count TD	 --}}
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <select name="f&b_facilities[{{ $meeting->getMeetingIdentifier() }}]" class="form-control blue-select facilities-per-meeting-select">
                                                    <option  selected value="">{{ __('Select Method') }}</option>
                                                    <option @if($meeting->getFAndBFacilities()==guest_count_charges_per_guest_occupancy_rate_method) selected @endif value="{{ guest_count_charges_per_guest_occupancy_rate_method }}">{{ __('Guest Count x Charges Per Guest x Occupancy Rate Method') }}</option>
                                                    <option @if( $meeting->getFAndBFacilities() == facility_count_daily_rent_occupancy_rate_method) selected @endif value="{{ facility_count_daily_rent_occupancy_rate_method }}">{{ __('Facility Count x Daily Rent x Occupancy Rate Method') }}</option>
                                                    <option @if( $meeting->getFAndBFacilities()==percentage_from_f_b_revenue) selected @endif value="{{ percentage_from_f_b_revenue }}">{{ __('Percentage % From F&B Revenues') }}</option>

                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $order = $order +1 ;
                                    @endphp

                                </tr>
                                @endforeach




                            </tbody>
                        </table>




                    </div>

                    <div class="row">
                        <div class="col-lg-11 kt-align-right">
                            <input data-redirect-to-same-page="1" type="submit" class="btn active-style save-form" value="{{ __('Go') }}">
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Choose F&B Sales Projection Method --}}


            {{-- <x-go></x-go> --}}
			
				@php
				 $currentSectionName = guest_count_charges_per_guest_occupancy_rate_method ;
							 @endphp


				
            {{-- start of Guest Count x Charges Per Guest x Occupancy Rate Method --}}
            <div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Guest Count x Charges Per Guest x Occupancy Rate Method') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".guest-capture-cover-value-per-guest-method">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row guest-capture-cover-value-per-guest-method">

                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Meeting Spaces Facility') }}</th>
                                        <th class="text-center">{{ __('Meeting Spaces Facility Count') }}</th>
                                        <th class="text-center">{{ __('Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Total Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Charges Value Per Guest') }}</th>
                                        <th class="text-center">{{ __('Choose Currency') }}</th>
                                        <th class="text-center">{{ __('Estimation Date') }}</th>
                                        <th class="text-center">{{ __('Charges Value Escalation Rate %') }}</th>
                                        <th class="text-center">{{ __('Charges Value At Operation Date') }}</th>
                                        <th class="text-center">{{ __('Charges Value Annual Escalation Rate %') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)

                                    <tr>

                                        {{-- Meetings Types	 --}}
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ $meeting->getName() }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;
                                        @endphp
                                        {{-- Meetings Count TD	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $meeting->getMeetingCount() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Daily Cover Count Per Facility --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  $meeting->getMeetingCover()  }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts size">
                                                    <input type="hidden" value="{{ $meeting->getMeetingCover() }}">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Total Guest Capacity  --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($meeting->getTotalGuestCapacityCount() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size">
                                                    <input name="total_daily_cover_count[{{ $meeting->getMeetingIdentifier() }}]" type="hidden" value="{{ $meeting->getTotalGuestCapacityCount() ?? 0 }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Cover Value	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($meeting->getChargesValuePerGuest() ?? 0)  }}" data-order="{{ $order }}" data-index="{{ $index }}" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size " data-calc-adr-operating-date>
                                                    <input class="avg-daily-rate" type="hidden" name="charges_value_per_guest[{{ $meeting->getMeetingIdentifier() }}]" value="{{ $meeting->getChargesValuePerGuest() ?? 0 }}" data-order="{{ $order }}" data-index="{{ $index }}" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <select name="chosen_meeting_currency[{{ $meeting->getMeetingIdentifier() }}]" data-order="{{ $order }}" class="form-control " @if($order !=1) disabled @endif>
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($currencyId==( old('chosen_meeting_currency')?:$meeting->getChosenCurrency()) )
                                                            selected
                                                            @endif
                                                            >{{ $currencyName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </td>



                                        {{-- Estimation Date	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input  type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $model->getStudyStartDateFormattedForView() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size">

                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>
                                        </td>







                                        {{-- Cover Value Escalation Rate %	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($meeting->getChargesValueEscalationRate(),1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1"  data-calc-adr-operating-date data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" class="cover-value-escalation-rate" name="charges_value_escalation_rate[{{ $meeting->getMeetingIdentifier() }}]" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" value="{{ $meeting->getChargesValueEscalationRate() ?? 0  }}" data-order="{{ $order }}" data-index="{{ $index }}">

                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>

                                        </td>



                                        {{-- Cover Value At Operation Date	 --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input name="charges_value_at_operation_date[{{ $meeting->getMeetingIdentifier() }}]" value="{{ $meeting->getChargesValueAtOperationDate()  }}" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" type="hidden" class="value-for-adr_at_operation_date">
                                                    <input type="text" readonly data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $meeting->getChargesValueAtOperationDate() ??0 }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1"  class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">

                                                </div>
                                            </div>

                                        </td>


                                        {{-- Cover Value Annual  Escalation Rate % --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- average_daily_rate_annual_escalation_rate --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($meeting->getChargesValueAnnualEscalationRate() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}"  onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1"  data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input name="charges_value_annual_escalation_rate[{{ $meeting->getMeetingIdentifier() }}]" type="hidden" value="{{ $meeting->getChargesValueAnnualEscalationRate() ??0  }}">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>

                                        </td>






                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                    </tr>
                                    @endforeach




                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row" style="width:100%">
                        <hr style="flex:1;background-color:lightgray">
                    </div>

                    <div class="table-responsive guest-capture-cover-value-per-guest-method">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('Facility Types') }}</th>
                                    <th class="text-center">{{ __('Input') }}</th>
                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                    <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentTotal = [];

                                @endphp
                                <tr>
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ __('Total Days Count') }}
                                        </b>
                                    </td>
                                    <td></td>
                                    @php


                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        @endphp


                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="text-align: center" value="{{ number_format($daysCountPerYear['totalOfEachYear'][$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>


                                @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)

                                <tr>
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ str_to_upper($meeting->getName()) }}
                                        </b>
                                    </td>

                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ __('Occupency %') }}
                                        </b>
                                    </td>

                                    @php
                                    $order = 1 ;

                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        $currentVal =  $meeting->getGuestFacilityOccupancyRateAtYear($year);
                                        $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="guest_capture_cover_percentage[{{ $meeting->getMeetingIdentifier() }}][{{ $year }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
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


                </div>

            </div>
            {{-- end of Guest Count x Charges Per Guest x Occupancy Rate Method  --}}
            
				
							 
			{{-- start of Occupancy Rate Seasonality --}}
			
            <div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Occupancy Rate % Seasonality Projection') }}
                                </h3>
                                <div class="form-group mb-0 d-flex " style="margin-left:auto;margin-right:auto;gap:20px;">
                                    <select name="guest_meeting_seasonality_type" class="form-control blue-select  seasonlity-select main-seasonality-select">
                                        <option value="">{{ __('Select Seasonality Type') }}</option>
                                        <option @if($model->getGuestMeetingSeasonalityType() == 'general-seasonality' || ! count($meetings))
                                            selected
                                            @endif
                                            value="general-seasonality">{{ __('General Seasonality') }}</option>
                                        <option value="per-meeting-type-seasonality" @if($model->getGuestMeetingSeasonalityType() == 'per-meeting-type-seasonality' && count($meetings) )
                                            selected
                                            @endif

                                            @if(! count($meetings))
                                            disabled
                                            @endif

                                            >{{ __('Per Facility Seasonality Rate') }}</option>
                                    </select>

                                    <select name="guest_meeting_seasonality_interval" class="form-control blue-select seasonlity-select secondary-seasonality-select">
                                        <option value="">{{ __('Select') }}</option>
                                        <option value="flat-seasonality" @if($model->getGuestMeetingSeasonalityInterval() == 'flat-seasonality' )
                                            selected
                                            @endif
                                            >



                                            {{ __('Flat Seasonality') }}</option>
                                        <option @if($model->getGuestMeetingSeasonalityInterval() == 'quarterly-seasonality' )
                                            selected
                                            @endif

                                            value="quarterly-seasonality">{{ __('Quarterly Seasonality') }}</option>
                                        <option @if($model->getGuestMeetingSeasonalityInterval() == 'monthly-seasonality' )
                                            selected
                                            @endif
                                            value="monthly-seasonality">{{ __('Monthly Seaonality') }}</option>
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

                                        @foreach($months as $monthName=>$monthNameFormattedArray)

                                        <td>

                                            @php
                                            $currentVal = 1/12 ;
                                            $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                                                    <input 
														data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
													type="hidden" value="1/12" name="guest_flat_general_seasonality[{{ $monthNameFormattedArray['value'] }}]">
                                                    <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value visibility-hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>

                                        @if($monthName =='december')

                                        {{-- add total td --}}

                                        <td style="vertical-align:middle">


												<div class="form-group three-dots-parent">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input
													

														class="form-control allows-readonly result-of-total-row  size" 
														
														 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  >
                                        <span class="ml-2">
                                            <b>%</b>
                                        </span>
                        </div>
                        <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
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

                                @foreach($months as $monthName=>$monthNameFormattedArray)

                                <td>

                                    @php
                                    $currentVal = $model->getGuestGeneralSeasonalityAtDateOrQuarter($monthNameFormattedArray['value']) ?? 0 ;
                                    $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                                    @endphp
                                    <div class="form-group three-dots-parent">
                                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                            <input
											data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
											 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                            <input type="hidden" name="guest_monthly_general_seasonality[{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal }}">
                                            <span class="ml-2">
                                                <b>%</b>
                                            </span>
                                        </div>
                                        <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                    </div>

                                </td>
                                {{-- @dd('d') --}}

                                @if($monthName =='december')

                                {{-- add total td --}}

                         
								<td style="vertical-align:middle">


												<div class="form-group three-dots-parent">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input 

														 
														 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control allows-readonly result-of-total-row  size" >
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                </div>
                <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
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
                        $currentVal = $generalGuestSeasonality[$qName] ?? 0 ;
                        $currentColTotal[$qName]=isset($currentTotal[$qName]) ? $currentTotal[$qName] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                                <input
								data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
								 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $qName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $qName }}"  onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts  only-percentage-allowed size" data-closest-parent-query="tr">
                                <input type="hidden"  value="{{ $currentVal }}"  name="guest_quarterly_general_seasonality[{{ $qName }}]" >
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
	
                                <input
								
								
								 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control allows-readonly result-of-total-row  size" >
                                {{-- <span class="ml-2">
                                    <b>%</b>
                                </span> --}}
                            </div>
                            {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}}  " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
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




    {{-- start per meeting flat-seasonality --}}
    <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-meeting-type-seasonality" data-select-2="flat-seasonality">
        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="flat-seasonality">
            <thead>
                <tr>
                    <th class="text-center">{{ __('Seasonality Type') }}</th>
                    @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                    <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                    @endforeach
                    <th class="text-center">{{ __('Total') }}</th>

                </tr>
            </thead>
            <tbody>

                @php
                $currentColTotal = [];

                @endphp

                @foreach($meetings as $index=>$meeting)
                <tr>
                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                        <b>
                            {{ $meeting->getName() }}
                        </b>
                    </td>
                    @php
                    $order = 1 ;

                    @endphp

                    @foreach($months as $monthName=>$monthNameFormattedArray)

                    <td>

                        @php
                        $currentVal = 1/12 ;
                        $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden"  value="{{ $currentVal }}"> --}}
                                <input
								data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
								 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                <input type="hidden" name="guest_flat_per_meeting_seasonality[{{ $meeting->getMeetingIdentifier() }}][{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal*100 }}">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value visibility-hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>

                    </td>

                    @if($monthName =='december')

                    {{-- add total td --}}
					
					
						<td style="vertical-align:middle">


												<div class="form-group three-dots-parent">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input
														

														
														 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control allows-readonly result-of-total-row  size" >
                    <span class="ml-2">
                        <b>%</b>
                    </span>
    </div>
    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
</div>


</td> 

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

    {{-- end per meeting flat seasonality --}}



    {{-- start per meeting monthly-seasonality --}}

    <div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-meeting-type-seasonality" data-select-2="monthly-seasonality">
        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="monthly-seasonality">
            <thead>
                <tr>
                    <th class="text-center">{{ __('Seasonality Type') }}</th>
                    @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                    <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                    @endforeach
                    <th class="text-center">{{ __('Total') }}</th>

                </tr>
            </thead>
            <tbody>

                @php
                $currentColTotal = [];

                @endphp

                @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)
                <tr>
                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                        <b>
                            {{ $meeting->getName() }}
                        </b>
                    </td>
                    @php
                    $order = 1 ;

                    @endphp

                    @foreach($months as $monthName=>$monthNameFormattedArray)

                    <td>

                        @php
                        $currentVal = $meeting->getGuestPerMeetingSeasonalityForMonthOrQuarter($monthNameFormattedArray['value']) ;
                        $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                                <input 
								data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
								
								type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                <input type="hidden" name="guest_monthly_per_meeting_seasonality[{{ $meeting->getMeetingIdentifier() }}][{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal }}">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>

                    </td>

                    @if($monthName =='december')

                    {{-- add total td --}}

               
					<td style="vertical-align:middle">


												<div class="form-group three-dots-parent">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input 
														

														
														readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control allows-readonly result-of-total-row  size">
                    <span class="ml-2">
                        <b>%</b>
                    </span>
    </div>
    <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
</div>


</td> 

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

{{-- end per meeting monthly seasonality --}}




{{-- start per meeting quarterly seasonality --}}

<div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-meeting-type-seasonality" data-select-2="quarterly-seasonality">
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

            @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)
            <tr>
                <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                    <b>
                        {{ $meeting->getName() }}
                    </b>
                </td>
                @php
                $order = 1 ;

                @endphp

                @foreach(quartersNames() as $qName=>$qNameFormatted)

                <td>

                    @php
                    $currentVal = $meeting->getGuestPerMeetingSeasonalityForMonthOrQuarter($qName) ;
                    $currentColTotal[$qName]=isset($currentTotal[$qName]) ? $currentTotal[$qName] + $currentVal : $currentVal;

                    @endphp
                    <div class="form-group three-dots-parent">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            <input
							data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
							
							 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $qName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                            <input type="hidden" name="guest_quarterly_per_meeting_seasonality[{{ $meeting->getIdentifier() }}][{{ $qName }}]" value="{{ $currentVal }}">
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
														<input
													
														 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control allows-readonly result-of-total-row  size" >
                <span class="ml-2">
                    <b>%</b>
                </span>
</div>
{{-- <i class="fa fa-ellipsis-h pull-{{__('left')}}  " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
</div>


</td> 
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


{{-- end per meeting quarterly seasonality --}}

































</div>

</div>
</div>

{{-- {{ end of  Occupancy Rate Seasonality }} --}}






	@php
				 $currentSectionName = facility_count_daily_rent_occupancy_rate_method ;
							 @endphp
							 
{{-- start of Facility Count x Daily Rent x Occupancy Rate Method --}}
<div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                        {{ __('Facility Count x Daily Rent x Occupancy Rate Method') }}
                    </h3>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".cover-target-per-day-method">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row cover-target-per-day-method">

            <div class="table-responsive ">
                <table class="table table-striped table-bordered table-hover table-checkable kt_table_2">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('Meeting Sapces Facility') }}</th>
                            <th class="text-center">{{ __('Meeting Sapces Facility Count') }}</th>
                            <th class="text-center">{{ __('Guest Capacity') }}</th>
                            <th class="text-center">{{ __('Total Guest Capacity') }}</th>
                            <th class="text-center">{{ __('Daily Rent Per Facility') }}</th>
                            <th class="text-center">{{ __('Choose Currency') }}</th>
                            <th class="text-center">{{ __('Estimation Date') }}</th>
                            <th class="text-center">{{ __('Daily Rent Escalation Rate %') }}</th>
                            <th class="text-center">{{ __('Daily Rent At Operation Date') }}</th>
                            <th class="text-center">{{ __('Daily Rent Annual Escalation Rate %') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)

                        <tr>

                            {{-- Meetings Types	 --}}
                            <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                <b>
                                    {{ $meeting->getName() }}
                                </b>
                            </td>
                            @php
                            $order = 1 ;
                            @endphp
                            {{-- Meetings Count TD	 --}}
                            <td>
                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $meeting->getMeetingCount() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size">
                                    </div>
                                </div>
                            </td>
                            {{-- Daily Cover Count Per Facility --}}
                            <td>

                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  $meeting->getMeetingCover()  }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts size">
                                        <input type="hidden" value="{{ $meeting->getMeetingCover() }}">
                                    </div>
                                </div>
                            </td>
                            {{-- Total Guest Capacity  --}}
                            <td>
                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($meeting->getTotalGuestCapacityCount() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size">
                                        <input name="total_daily_cover_count[{{ $meeting->getMeetingIdentifier() }}]" type="hidden" value="{{ $meeting->getTotalGuestCapacityCount() ?? 0 }}">
                                    </div>
                                </div>
                            </td>

                            {{-- Cover Value	 --}}
                            <td>
                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">

                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($meeting->getCoverValue() ?? 0)  }}" data-order="{{ $order }}" data-index="{{ $index }}" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size " data-calc-adr-operating-date>
                                        <input class="avg-daily-rate" type="hidden" name="cover_value[{{ $meeting->getMeetingIdentifier() }}]" value="{{ $meeting->getCoverValue() ?? 0 }}" data-order="{{ $order }}" data-index="{{ $index }}" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}">
                                    </div>
                                </div>
                            </td>

                            {{-- Choose Currency	Td --}}
                            <td>
                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <select name="chosen_meeting_currency[{{ $meeting->getMeetingIdentifier() }}]" data-order="{{ $order }}" class="form-control " @if($order !=1) disabled @endif>
                                            @foreach($studyCurrency as $currencyId=>$currencyName)
                                            <option value="{{ $currencyId }}" @if($currencyId==( old('chosen_meeting_currency')?:$meeting->getChosenCurrency()) )
                                                selected
                                                @endif
                                                >{{ $currencyName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </td>



                            {{-- Estimation Date	 --}}
                            <td>
                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                        <input name="estimation_date[{{ $meeting->getMeetingIdentifier() }}]" type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $model->getStudyStartDateFormattedForView() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts  size">

                                    </div>
                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                </div>
                            </td>







                            {{-- Cover Value Escalation Rate %	 --}}

                            <td>

                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($meeting->getChargesValueEscalationRate()) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1"  data-calc-adr-operating-date data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                        <input type="hidden" class="cover-value-escalation-rate" name="charges_value_escalation_rate[{{ $meeting->getMeetingIdentifier() }}]" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" value="{{ $meeting->getChargesValueEscalationRate() ?? 0  }}" data-order="{{ $order }}" data-index="{{ $index }}">

                                        <span class="ml-2">
                                            <b>%</b>
                                        </span>
                                    </div>
                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                </div>

                            </td>



                            {{-- Cover Value At Operation Date	 --}}
                            <td>

                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        <input name="charges_value_at_operation_date[{{ $meeting->getMeetingIdentifier() }}]" value="{{ $meeting->getChargesValueAtOperationDate()  }}" data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" type="hidden" class="value-for-adr_at_operation_date">
                                        <input type="text" readonly data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $meeting->getChargesValueAtOperationDate() ??0 }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1"  class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">

                                    </div>
                                </div>

                            </td>


                            {{-- Cover Value Annual  Escalation Rate % --}}
                            <td>

                                <div class="form-group three-dots-parent">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        {{-- average_daily_rate_annual_escalation_rate --}}
                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($meeting->getChargesValueAnnualEscalationRate() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}"  onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1"  data-meeting-type-id="{{ $meeting->getMeetingIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                        <input type="hidden" name="charges_value_annual_escalation_rate[{{ $meeting->getMeetingIdentifier() }}]" value="{{ $meeting->getChargesValueAnnualEscalationRate() ??0  }}">
                                        <span class="ml-2">
                                            <b>%</b>
                                        </span>
                                    </div>
                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                </div>

                            </td>






                            @php
                            $order = $order +1 ;
                            @endphp

                        </tr>
                        @endforeach




                    </tbody>
                </table>

            </div>
        </div>
        <div class="row" style="width:100%">
            <hr style="flex:1;background-color:lightgray">
        </div>

        <div class="table-responsive cover-target-per-day-method">
            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('Facility Types') }}</th>
                        <th class="text-center">{{ __('Input') }}</th>
                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentTotal = [];

                    @endphp
                    <tr>
                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <b>
                                {{ __('Total Days Count') }}
                            </b>
                        </td>
                        <td></td>
                        @php


                        @endphp

                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                        <td>

                            @php
                            @endphp


                            <div class="form-group three-dots-parent">
                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                    <input type="text" style="text-align: center" value="{{ number_format($daysCountPerYear['totalOfEachYear'][$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                    <span class="ml-2">
                                        <b style="visibility:hidden">%</b>
                                    </span>
                                </div>
                            </div>
                        </td>

                        @endforeach

                    </tr>


                    @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)

                    <tr>
                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <b>
                                {{ str_to_upper($meeting->getName()) }}
                            </b>
                        </td>

                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <b>
                                {{ __('Occupancy Rate %') }}
                            </b>
                        </td>

                        @php
                        $order = 1 ;

                        @endphp

                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                        <td>

                            @php
                            $currentVal =  $meeting->getGuestFacilityOccupancyRateAtYear($year);
                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                            @endphp
                            <div class="form-group three-dots-parent">
                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="guest_capture_cover_percentage[{{ $meeting->getMeetingIdentifier() }}][{{ $year }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
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


    </div>

</div>
{{-- end of Facility Count x Daily Rent x Occupancy Rate Method --}}





{{-- start of Occupancy Rate Seasonality --}}
<div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                        {{ __('Occupancy Rate % Seasonality Projection') }}
                    </h3>
                    <div class="form-group mb-0 d-flex " style="margin-left:auto;margin-right:auto;gap:20px;">
                        <select name="rent_meeting_seasonality_type" class="form-control blue-select  seasonlity-select main-seasonality-select">
                            <option value="">{{ __('Select Seasonality Type') }}</option>
                            <option @if($model->getRentMeetingSeasonalityType() == 'general-seasonality' || ! count($meetings))
                                selected
                                @endif
                                value="general-seasonality">{{ __('General Seasonality') }}</option>
                            <option value="per-meeting-type-seasonality" @if($model->getRentMeetingSeasonalityType() == 'per-meeting-type-seasonality' && count($meetings) )
                                selected
                                @endif

                                @if(! count($meetings))
                                disabled
                                @endif

                                >{{ __('Per Facility Seasonality Rate') }}</option>
                        </select>

                        <select name="rent_meeting_seasonality_interval" class="form-control blue-select seasonlity-select secondary-seasonality-select">
                            <option value="">{{ __('Select') }}</option>
                            <option value="flat-seasonality" @if($model->getRentMeetingSeasonalityInterval() == 'flat-seasonality' )
                                selected
                                @endif
                                >



                                {{ __('Flat Seasonality') }}</option>
                            <option @if($model->getRentMeetingSeasonalityInterval() == 'quarterly-seasonality' )
                                selected
                                @endif

                                value="quarterly-seasonality">{{ __('Quarterly Seasonality') }}</option>
                            <option @if($model->getRentMeetingSeasonalityInterval() == 'monthly-seasonality' )
                                selected
                                @endif
                                value="monthly-seasonality">{{ __('Monthly Seaonality') }}</option>
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

                            @foreach($months as $monthName=>$monthNameFormattedArray)

                            <td>

                                @php
                                $currentVal = 1/12 ;
                                $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                                @endphp
                                <div class="form-group three-dots-parent ">
                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                        {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                                        <input type="hidden" value="1/12" name="rent_flat_general_seasonality[{{ $monthNameFormattedArray['value'] }}]">
                                        <input
										data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
										 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                        <span class="ml-2">
                                            <b>%</b>
                                        </span>
                                    </div>
                                    <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value visibility-hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                </div>

                            </td>

                            @if($monthName =='december')

                            {{-- add total td --}}

							<td style="vertical-align:middle">


												<div class="form-group three-dots-parent mt-0">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input
														data-max-total-value="0"
														data-total-type="row"
														data-number-format-digits="2" 
														data-is-percentage="1"
														data-fixed-number="100"

														 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control allows-readonly result-of-total-row  size" >
                            <span class="ml-2">
                                <b>%</b>
                            </span>
            </div>
            {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
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

                    @foreach($months as $monthName=>$monthNameFormattedArray)

                    <td>

                        @php
                        $currentVal = $model->getRentGeneralSeasonalityAtDateOrQuarter($monthNameFormattedArray['value']) ?? 0 ;
                        $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                        @endphp
                        <div class="form-group three-dots-parent">
                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                <input
									data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
								 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                                <input type="hidden" name="rent_monthly_general_seasonality[{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal }}">
                                <span class="ml-2">
                                    <b>%</b>
                                </span>
                            </div>
                            <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                        </div>

                    </td>
                    {{-- @dd('d') --}}

                    @if($monthName =='december')

                    {{-- add total td --}}

					<td style="vertical-align:middle">


												<div class="form-group three-dots-parent">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input 
													

														 class="form-control allows-readonly result-of-total-row  size"  type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" >
                    <span class="ml-2">
                        <b>%</b>
                    </span>
    </div>
    <i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
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
                    $currentVal = $generalRentSeasonality[$qName] ?? 0 ;
                    $currentColTotal[$qName]=isset($currentTotal[$qName]) ? $currentTotal[$qName] + $currentVal : $currentVal;

                    @endphp
                    <div class="form-group three-dots-parent">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                            <input 
								data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
							
							type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $qName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $qName }}"  onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                            <input type="hidden"  value="{{ $currentVal }}" name="rent_quarterly_general_seasonality[{{ $qName }}]" >
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
                            <input 
								
							

							class="form-control"
							readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" >
                            <span class="ml-2">
                                <b>%</b>
                            </span>
                        </div>
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




{{-- start per meeting flat-seasonality --}}
<div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-meeting-type-seasonality" data-select-2="flat-seasonality">
    <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="flat-seasonality">
        <thead>
            <tr>
                <th class="text-center">{{ __('Seasonality Type') }}</th>
                @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                @endforeach
                <th class="text-center">{{ __('Total') }}</th>

            </tr>
        </thead>
        <tbody>

            @php
            $currentColTotal = [];

            @endphp

            @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)
            <tr>
                <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                    <b>
                        {{ $meeting->getName() }}
                    </b>
                </td>
                @php
                $order = 1 ;

                @endphp

                @foreach($months as $monthName=>$monthNameFormattedArray)

                <td>

                    @php
                    $currentVal = 1/12 ;
                    $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                    @endphp
                    <div class="form-group three-dots-parent">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            {{-- <input type="hidden"  value="{{ $currentVal }}"> --}}
                            <input 
							
								data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
							type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal*100,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                            <input type="hidden" name="rent_flat_per_meeting_seasonality[{{ $meeting->getMeetingIdentifier() }}][{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal*100 }}">
                            <span class="ml-2">
                                <b>%</b>
                            </span>
                        </div>
                        <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value visibility-hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                    </div>

                </td>

                @if($monthName =='december')

                {{-- add total td --}}
				
				
				    <td style="vertical-align:middle">


                    <div class="form-group three-dots-parent mt-0">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            {{-- <input type="hidden" name="total_of_flat"  value="{{ 100 }}" class="result-of-total"> --}}
                            <input 
							 class="form-control allows-readonly result-of-total-row  size"
						

							
							readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" >
                            <span class="ml-2">
                                <b>%</b>
                            </span>
                        </div>
                    </div>


                </td>

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

{{-- end per meeting flat seasonality --}}



{{-- start per meeting monthly-seasonality --}}

<div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-meeting-type-seasonality" data-select-2="monthly-seasonality">
    <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 " data-table-name="monthly-seasonality">
        <thead>
            <tr>
                <th class="text-center">{{ __('Seasonality Type') }}</th>
                @foreach($months = getMonthsForSelect() as $monthName=>$monthNameFormattedArray)
                <th class="text-center"> {{$monthNameFormattedArray['title']}} </th>
                @endforeach
                <th class="text-center">{{ __('Total') }}</th>

            </tr>
        </thead>
        <tbody>

            @php
            $currentColTotal = [];

            @endphp

            @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)
            <tr>
                <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                    <b>
                        {{ $meeting->getName() }}
                    </b>
                </td>
                @php
                $order = 1 ;

                @endphp

                @foreach($months as $monthName=>$monthNameFormattedArray)

                <td>

                    @php
                    $currentVal = $meeting->getRentPerMeetingSeasonalityForMonthOrQuarter($monthNameFormattedArray['value']) ;
                    $currentColTotal[$monthNameFormattedArray['value']]=isset($currentTotal[$monthNameFormattedArray['value']]) ? $currentTotal[$monthNameFormattedArray['value']] + $currentVal : $currentVal;

                    @endphp
                    <div class="form-group three-dots-parent">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            {{-- <input type="hidden" class="" value="{{ $currentVal }}"> --}}
                            <input 
								data-has-row-total="1"
										data-max-row-total="100"
										data-has-column-total="0"
										data-max-column-total="0"
										data-is-percentage="1"
										data-no-digits="1"
										
							type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $monthNameFormattedArray['value'] }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $monthNameFormattedArray['value'] }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                            <input type="hidden" name="rent_monthly_per_meeting_seasonality[{{ $meeting->getMeetingIdentifier() }}][{{ $monthNameFormattedArray['value'] }}]" value="{{ $currentVal }}">
                            <span class="ml-2">
                                <b>%</b>
                            </span>
                        </div>
                        <i data-year="{{ $monthNameFormattedArray['value'] }}" class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                    </div>

                </td>

                @if($monthName =='december')

                {{-- add total td --}}

             
				<td style="vertical-align:middle">


												<div class="form-group three-dots-parent">
													<div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
														<input
										
														
														 readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="100" data-month-name="{{ $monthName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control allows-readonly result-of-total-row size" >
                <span class="ml-2">
                    <b>%</b>
                </span>
</div>
<i class="fa fa-ellipsis-h pull-{{__('left')}}  " style="visibility:hidden" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
</div>


</td> 

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

{{-- end per meeting monthly seasonality --}}




{{-- start per meeting quarterly seasonality --}}

<div class="table-responsive one-of-seasonality-tables-parent d-none" data-select-1="per-meeting-type-seasonality" data-select-2="quarterly-seasonality">
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

            @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)
            <tr>
                <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                    <b>
                        {{ $meeting->getName() }}
                    </b>
                </td>
                @php
                $order = 1 ;

                @endphp

                @foreach(quartersNames() as $qName=>$qNameFormatted)

                <td>

                    @php
                    $currentVal = $meeting->getRentPerMeetingSeasonalityForMonthOrQuarter($qName) ;
					
                    $currentColTotal[$qName]=isset($currentTotal[$qName]) ? $currentTotal[$qName] + $currentVal : $currentVal;

                    @endphp
                    <div class="form-group three-dots-parent">
                        <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                            <input
															data-has-row-total="1"
															data-max-row-total="100"
															data-has-column-total="0"
															data-max-column-total="0"
															data-is-percentage="1"
															
							
							 type="text" style="max-width: 60px;min-width: 60px;text-align: center" data-year="{{ $qName }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="{{ number_format($currentVal,1) }}" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control has-total-cell target_repeating_amounts only-percentage-allowed size" data-closest-parent-query="tr">
                            <input type="hidden" name="rent_quarterly_per_meeting_seasonality[{{ $meeting->getIdentifier() }}][{{ $qName }}]" value="{{ $currentVal }}">
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
														<input
															


														 class="form-control allows-readonly result-of-total-row size" 
														 
														 readonly type="text" style="max-width: 80px;min-width: 80px;text-align: center" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" value="0" data-month-name="{{ $qName }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" >
                
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
@endforeach





</tbody>
</table>
</div>


{{-- end per meeting quarterly seasonality --}}

</div>

</div>
</div>

{{-- {{ end of  Occupancy Rate Seasonality }} --}}



			@php
				 $currentSectionName = percentage_from_f_b_revenue ;
							 @endphp
							 
{{-- start of Percenatge % From F & b Revenues --}}
<div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                        {{ __('Percenatge % From F&B Revenues') }}
                    </h3>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".percenatge-from-meetings-revenues-method">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>


        <div class="table-responsive percenatge-from-meetings-revenues-method">
            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('Facility Types') }}</th>
                        <th class="text-center">{{ __('Input') }}</th>
                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                    $currentTotal = [];

                    @endphp
                    <tr>
                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <b>
                                {{ __('Total F&B Revenues') }}
                            </b>
                        </td>
                        <td></td>
                        @php


                        @endphp

                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                        <td>

                            @php
                            @endphp


                            <div class="form-group three-dots-parent">

                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                    <input type="text" style="text-align: center" value="{{ number_format($fAndBFacilityRevenue['totalOfEachYear'][$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                    <span class="ml-2">
                                        <b style="visibility:hidden">%</b>
                                    </span>
                                </div>
                            </div>
                        </td>

                        @endforeach

                    </tr>


                    @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$meeting)

                    <tr>
                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <b>
                                {{ str_to_upper($meeting->getName()) }}
                            </b>
                        </td>

                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                            <b>
                                {{ __('% From F&B Revenues') }}
                            </b>
                        </td>

                        @php
                        $order = 1 ;

                        @endphp

                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                        <td>

                            @php
                            $currentVal =  $meeting->getPercentageFromRevenue($year);
                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                            @endphp
                            <div class="form-group three-dots-parent">
                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="percentage_from_f_and_b_revenues[{{ $meeting->getMeetingIdentifier() }}][{{ $year }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
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


    </div>

</div>
{{-- end of Percenatge % From F & b Revenues --}}








	@include('admin.hospitality-sector.collection-policy',[
	'collectionPolicyFirstLabel'=>__('Collection Terms Per Facility'),
	'firstHeader'=>__('Facility Name'),
	'collectionPolicyItems'=>$meetings,
	'modelName'=>'meeting',
	'isGeneralCollectionPolicy'=>$model->isMeetingGeneralCollection(),
	'isCollectionTermPerItem'=>$model->isMeetingCollectionTermPerSalesChannel(),
		'onlyGeneralExpense'=>isTotal($meetings)
])



<x-save-or-back :btn-text="__('Create')" />
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
		let redirectToSamePage = $(this).attr('data-redirect-to-same-page') ? +$(this).attr('data-redirect-to-same-page') : 0
		
        e.preventDefault(); {

            const hasSalesChannel = $('#add-sales-channels-share-discount-id:checked').length

            let canSubmitForm = true;
            let errorMessage = '';
            let messageTitle = 'Oops...';

            

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
			formData.append('redirect-to-same-page',redirectToSamePage)
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


    $(document).on('change', '.use-meetings', function() {
        let useMeetings = $("#use-meetings-1").is(':checked')
        if (useMeetings) {
            $('.meetings-repeater').fadeIn(300)
            $('input[type="radio"][name*="meetings"]').val(1);

        } else {
            $('.meetings-repeater').fadeOut(300);
            $('input[type="radio"][name*="meetings"]').val(0);
        }
    });

    $('.use-meetings').trigger('change')




    $(document).on('change', '.use-meetings', function() {
        let useMeetings = $("#use-meetings-1").is(':checked')
        if (useMeetings) {
            $('.meetings-repeater').fadeIn(300)
            $('input[type="radio"][name*="meetings"]').val(1);

        } else {
            $('.meetings-repeater').fadeOut(300);
            $('input[type="radio"][name*="meetings"]').val(0);
        }
    });
    $('.use-meetings').trigger('change')



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
    $('.use-meetings:checked').trigger('change');

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
        const meetingTypeId = $(this).attr('data-meeting-type-id');
        const parent = $(this).closest('table')
        let avgDailyRate = parent.find('.avg-daily-rate[data-meeting-type-id="' + meetingTypeId + '"]').val();
        avgDailyRate = number_unformat(avgDailyRate)
		let ascalationRate = parent.find('.cover-value-escalation-rate[data-meeting-type-id="' + meetingTypeId + '"]').val() / 100;
        const result = avgDailyRate * Math.pow(((1 + ascalationRate)), power)
        parent.find('.value-for-adr_at_operation_date[data-meeting-type-id="' + meetingTypeId + '"]').val(result)
        parent.find('.html-for-adr_at_operation_date[data-meeting-type-id="' + meetingTypeId + '"]').val(number_format(result))
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
            $('[data-name="occupancy_rate_per_meeting"]').fadeOut(300)
        } else {
            $('[data-name="general_occupancy_rate"]').fadeOut(300)
            $('[data-name="occupancy_rate_per_meeting"]').fadeIn(300)

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
		const parent  = $(this).closest('.kt-portlet__body')
        const mainSelect = parent.find('.main-seasonality-select').val()
        const secondarySelect = parent.find('.secondary-seasonality-select').val();
        parent.find('.one-of-seasonality-tables-parent').addClass('d-none');
        parent.find('[data-select-1*="' + mainSelect + '"][data-select-2*="' + secondarySelect + '"]').removeClass('d-none')
    })
   
    $(document).on('change', '.collection_rate_input', function() {
        let salesChannelName = $(this).attr('data-sales-channel-name')
        let total = 0;
        $('.collection_rate_input[data-sales-channel-name="' + salesChannelName + '"]').each(function(index, input) {
            total += parseFloat(input.value)
        })
        $('.collection_rate_total_class[data-sales-channel-name="' + salesChannelName + '"]').val(total)
    })
    $(document).on('change', '.all-faciltiies-select', function() {
        let val = $(this).val()
        if (val) {
            $('.facilities-per-meeting-select').prop('disabled', true)
            $('.facilities-per-meeting-select').val(val).trigger('change')
        } else {
            $('.facilities-per-meeting-select').val('').trigger('change')
            $('.facilities-per-meeting-select').prop('disabled', false)
        }
    })
    $(function() {
        $('[data-calc-adr-operating-date]').trigger('change')
        $('.occupancy-rate:checked').trigger('change')
        $('.collection_rate_class:checked').trigger('change')
        $('.add-sales-channels-share-discount:checked').trigger('change')
        $('.main-seasonality-select').trigger('change')
        $('.trigger-change-when-start').trigger('change')

    })

</script>



<script>

</script>


@endsection
