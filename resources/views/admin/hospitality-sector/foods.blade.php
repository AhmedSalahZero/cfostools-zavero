@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>

<style>
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
        background-color: #074FA4 !important;
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
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Food & Beverage "F&B" Sales Projection Input Sheet') }}</x-main-form-title>
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
                            {{ __('Choose F&B Sales Projection Method') }}
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
                                    <th class="text-center">{{ __('F&B Facility') }}</th>
                                    <th class="text-center">{{ __('Select Projection Method') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>

                                    {{-- Foods Types	 --}}
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <b>
                                                    {{ __('Same Method For All F&B Facilities') }}
                                                </b>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                    $order = 1 ;
                                    @endphp
                                    {{-- Foods Count TD	 --}}
                                    @php


                                    @endphp
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <select name="f&b_facilities[all]" class="form-control blue-select all-faciltiies-select">
                                                    <option selected value="">{{ __('Select Method') }}</option>
                                                    <option value="{{ guest_capture_x_cover_value_per_guest_method }}">{{ __('Guest Capture % x Cover Value Per Guest Method') }}</option>
                                                    <option value="{{ guest_capture_x_meals_per_guest_x_cover_value_per_meal_method }}">{{ __('Guest Capture % x Meals Per Guest x Cover Value Per Meal Method') }}</option>
                                                    <option value="{{ cover_count_target_per_day_x_cover_value_method }}">{{ __('Cover Count Target Per Day x Cover Value Method') }}</option>
                                                    <option value="{{ percentage_from_rooms_revenue }}">{{ __('Percenatge % From Rooms Revenues') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>

                                    @php
                                    $order = $order +1 ;
                                    @endphp

                                </tr>

                                @foreach($foods as $index=>$food)

                                <tr>

                                    {{-- Foods Types	 --}}
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <div class="row ">
                                            <div class="col-md-4">
                                                <b>
                                                    {{ $food->getName() }}
                                                </b>
                                            </div>
                                        </div>
                                    </td>
                                    @php
                                    $order = 2 ;
                                    @endphp
                                    {{-- Foods Count TD	 --}}
                                    <td>
                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <select name="f&b_facilities[{{ $food->getFoodIdentifier() }}]" class="form-control blue-select facilities-per-food-select">
                                                    <option value="">{{ __('Select Method') }}</option>
                                                    <option value="{{ guest_capture_x_cover_value_per_guest_method }}" @if( $food->getFAndBFacilities() == guest_capture_x_cover_value_per_guest_method ) selected @endif>{{ __('Guest Capture % x Cover Value Per Guest Method') }}</option>
                                                    <option value="{{ guest_capture_x_meals_per_guest_x_cover_value_per_meal_method }}" @if( $food->getFAndBFacilities() == guest_capture_x_meals_per_guest_x_cover_value_per_meal_method ) selected @endif>{{ __('Guest Capture % x Meals Per Guest x Cover Value Per Meal Method') }}</option>
                                                    <option value="{{ cover_count_target_per_day_x_cover_value_method }}" @if( $food->getFAndBFacilities() == cover_count_target_per_day_x_cover_value_method ) selected @endif>{{ __('Cover Count Target Per Day x Cover Value Method') }}</option>
                                                    <option value="{{ percentage_from_rooms_revenue }}" @if( $food->getFAndBFacilities() == percentage_from_rooms_revenue ) selected @endif>{{ __('Percenatge % From Rooms Revenues') }}</option>
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
                            <input type="submit" class="btn active-style save-form " data-redirect-to-same-page="1" value="{{ __('Go') }}">
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Choose F&B Sales Projection Method --}}
            @php
            $currentSectionName = guest_capture_x_cover_value_per_guest_method ;
            @endphp
            {{-- start of Guest Capture % x Cover Value Per Guest Method --}}
            <div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif ">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Guest Capture % x Cover Value Per Guest Method') }}
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
                                        <th class="text-center">{{ __('F&B Facility') }}</th>
                                        <th class="text-center">{{ __('F&B Facility Count') }}</th>
                                        <th class="text-center">{{ __('Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Total Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Cover Value Per Guest') }}</th>
                                        <th class="text-center">{{ __('Choose Currency') }}</th>
                                        <th class="text-center">{{ __('Estimation Date') }}</th>
                                        <th class="text-center">{{ __('Cover Value Escalation Rate %') }}</th>
                                        <th class="text-center">{{ __('Cover Value At Operation Date') }}</th>
                                        <th class="text-center">{{ __('Cover Value Annual Escalation Rate %') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)
                                    <tr>

                                        {{-- Foods Types	 --}}
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ $food->getName() }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;
                                        @endphp
                                        {{-- Foods Count TD	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $food->getFoodCount() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Daily Cover Count Per Facility --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  $food->getFoodCover()  }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts size">
                                                    <input type="hidden" value="{{ $food->getFoodCover() }}">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Total Guest Capacity  --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getTotalGuestCapacityCount() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input name="total_daily_cover_count[{{ $food->getFoodIdentifier() }}]" type="hidden" value="{{ $food->getTotalGuestCapacityCount() ?? 0 }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Cover Value	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">

                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($food->getCoverValue() ?? 0)  }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $food->getFoodIdentifier() }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size " data-calc-adr-operating-date>
                                                    <input class="avg-daily-rate" type="hidden" name="cover_value[{{ $food->getFoodIdentifier() }}]" value="{{ $food->getCoverValue() ?? 0 }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $food->getFoodIdentifier() }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <select name="chosen_food_currency[{{ $food->getFoodIdentifier() }}]" data-order="{{ $order }}" class="form-control " @if($order !=1) disabled @endif>
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($currencyId==( old('chosen_food_currency')?:$food->getChosenCurrency()) )
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
                                                    <input name="estimation_date[{{ $food->getFoodIdentifier() }}]" type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $model->getStudyStartDateFormattedForView() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">

                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>
                                        </td>







                                        {{-- Cover Value Escalation Rate %	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getCoverValueEscalationRate(),1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-calc-adr-operating-date data-room-type-id="{{ $food->getFoodIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" class="cover-value-escalation-rate" name="cover_value_escalation_rate[{{ $food->getFoodIdentifier() }}]" data-room-type-id="{{ $food->getFoodIdentifier() }}" value="{{ $food->getCoverValueEscalationRate() ?? 0  }}" data-order="{{ $order }}" data-index="{{ $index }}">

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
                                                    <input name="cover_value_at_operation_date[{{ $food->getFoodIdentifier() }}]" value="{{ $food->getCoverValueAtOperationDate()  }}" data-room-type-id="{{ $food->getFoodIdentifier() }}" type="hidden" class="value-for-adr_at_operation_date">
                                                    <input type="text" readonly data-room-type-id="{{ $food->getFoodIdentifier() }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $food->getCoverValueAtOperationDate() ??0 }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">

                                                </div>
                                            </div>

                                        </td>


                                        {{-- Cover Value Annual  Escalation Rate % --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- average_daily_rate_annual_escalation_rate --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getCoverValueAnnualEscalationRate() ?? 0,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" name="cover_value_annual_escalation_rate[{{ $food->getFoodIdentifier() }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-room-type-id="{{ $food->getFoodIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" value="{{ $food->getCoverValueAnnualEscalationRate() ??0  }}">
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
                                            {{ __('Total Guest Count') }}
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
                                                <input type="text" style="text-align: center" value="{{ number_format($annualGuestCountPerRoom[$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>

                                @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)
                                {{-- @foreach($foods as $index=>$food) --}}

                                <tr>
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ str_to_upper($food->getName()) }}
                                        </b>
                                    </td>

                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ __('Guest Capture %') }}
                                        </b>
                                    </td>

                                    @php
                                    $order = 1 ;

                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        $currentVal = $food->getGuestCaptureCoverPercentage($year);
                                        $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
                                                <input type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="guest_capture_cover_percentage[{{ $food->getFoodIdentifier() }}][{{ $year }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
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
            {{-- end of Guest Capture % x Cover Value Per Guest Method --}}

            {{-- start of Guest Capture % x Meals Per Guest x Cover Value Per Meal Method --}}
            @php
            $currentSectionName = guest_capture_x_meals_per_guest_x_cover_value_per_meal_method ;
            @endphp
            <div class="kt-portlet  @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Guest Capture % x Meals Per Guest x Cover Value Per Meal Method') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".guest-capture-meal-value-per-guest-method">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row guest-capture-meal-value-per-guest-method">

                        <div class="table-responsive ">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('F&B Facility') }}</th>
                                        <th class="text-center">{{ __('F&B Facility Count') }}</th>
                                        <th class="text-center">{{ __('Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Total Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Cover Value Per Meal') }}</th>
                                        <th class="text-center">{{ __('Choose Currency') }}</th>
                                        <th class="text-center">{{ __('Estimation Date') }}</th>
                                        <th class="text-center">{{ __('Cover Value Escalation Rate %') }}</th>
                                        <th class="text-center">{{ __('Cover Value At Operation Date') }}</th>
                                        <th class="text-center">{{ __('Cover Value Annual Escalation Rate %') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)

                                    <tr>

                                        {{-- Foods Types	 --}}
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ $food->getName() }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;
                                        @endphp
                                        {{-- Foods Count TD	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $food->getFoodCount() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Daily Cover Count Per Facility --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  $food->getFoodCover()  }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts size">
                                                    <input type="hidden" value="{{ $food->getFoodCover() }}">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Total Guest Capacity  --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getTotalGuestCapacityCount() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input name="total_daily_cover_count[{{ $food->getFoodIdentifier() }}]" type="hidden" value="{{ $food->getTotalGuestCapacityCount() ?? 0 }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Cover Value	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">

                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($food->getCoverValue() ?? 0)  }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $food->getFoodIdentifier() }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size " data-calc-adr-operating-date>
                                                    <input class="avg-daily-rate" type="hidden" name="cover_value[{{ $food->getFoodIdentifier() }}]" value="{{ $food->getCoverValue() ?? 0 }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $food->getFoodIdentifier() }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <select name="chosen_food_currency[{{ $food->getFoodIdentifier() }}]" data-order="{{ $order }}" class="form-control " @if($order !=1) disabled @endif>
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($currencyId==( old('chosen_food_currency')?:$food->getChosenCurrency()) )
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
                                                    <input name="estimation_date[{{ $food->getFoodIdentifier() }}]" type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $model->getStudyStartDateFormattedForView() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">

                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>
                                        </td>







                                        {{-- Cover Value Escalation Rate %	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getCoverValueEscalationRate(),1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-calc-adr-operating-date data-room-type-id="{{ $food->getFoodIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" class="cover-value-escalation-rate" name="cover_value_escalation_rate[{{ $food->getFoodIdentifier() }}]" data-room-type-id="{{ $food->getFoodIdentifier() }}" value="{{ $food->getCoverValueEscalationRate() ?? 0  }}" data-order="{{ $order }}" data-index="{{ $index }}">

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
                                                    <input name="cover_value_at_operation_date[{{ $food->getFoodIdentifier() }}]" value="{{ $food->getCoverValueAtOperationDate()  }}" data-room-type-id="{{ $food->getFoodIdentifier() }}" type="hidden" class="value-for-adr_at_operation_date">
                                                    <input type="text" readonly data-room-type-id="{{ $food->getFoodIdentifier() }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $food->getCoverValueAtOperationDate() ??0 }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">

                                                </div>
                                            </div>

                                        </td>


                                        {{-- Cover Value Annual  Escalation Rate % --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- average_daily_rate_annual_escalation_rate --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getCoverValueAnnualEscalationRate() ?? 0,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" name="cover_value_annual_escalation_rate[{{ $food->getFoodIdentifier() }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-room-type-id="{{ $food->getFoodIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" value="{{ $food->getCoverValueAnnualEscalationRate() ??0  }}">
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

                    <div class="table-responsive guest-capture-meal-value-per-guest-method">
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
                                            {{ __('Total Guest Count') }}
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
                                                <input type="text" style="text-align: center" value="{{ number_format($annualGuestCountPerRoom[$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>

                                @php
                                $newIndex = 0 ;
                                @endphp
                                @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)

                                {{-- @foreach($foods as $index=>$food) --}}

                                <tr>
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left;border-bottom:1px solid #0A6590;" rowspan="2">
                                        <b>
                                            {{ str_to_upper($food->getName()) }}
                                        </b>
                                    </td>

                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <div class="d-flex">

                                            <b class="d-block">
                                                {{ __('Guest Capture %') }}


                                            </b>


                                        </div>
                                    </td>

                                    @php
                                    $order = 1 ;

                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        $currentVal = old('guest_capture_cover_percentage') ?: $food->getGuestCaptureCoverPercentage($year);
                                        $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $newIndex }}" name="guest_capture_cover_percentage[{{ $food->getFoodIdentifier() }}][{{ $year }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
                                                <span class="ml-2">
                                                    <b>%</b>
                                                </span>
                                            </div>
                                            <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $newIndex }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                        </div>

                                    </td>
                                    @php
                                    $order = $order +1 ;
                                    @endphp
                                    @endforeach

                                </tr>


                                @php
                                $newIndex = $newIndex+1 ;
                                @endphp

                                <tr>


                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <div class="d-flex">

                                            <b class="d-block">
                                                {{ __('Meal Per Guest') }}


                                            </b>


                                        </div>
                                    </td>

                                    @php
                                    $order = 1 ;

                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        $currentVal = $food->getMealPerGuest($year);
                                        $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $newIndex }}" name="meal_per_guest[{{ $food->getFoodIdentifier() }}][{{ $year }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control exclude-from-totals target_repeating_amounts only-greater-than-or-equal-zero size" data-year="{{ $year }}">
                                                <span class="ml-2">
                                                    <b>#</b>
                                                </span>
                                            </div>
                                            <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $newIndex }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                        </div>

                                    </td>
                                    @php
                                    $order = $order +1 ;
                                    @endphp
                                    @endforeach

                                </tr>
                                @php
                                $newIndex = $newIndex+1 ;
                                @endphp
                                @endforeach




                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
            {{-- end of Guest Capture % x Meals Per Guest x Cover Value Per Meal Method --}}

            {{-- start of Cover Count Target Per Day x Cover Value Method --}}
            @php
            $currentSectionName =cover_count_target_per_day_x_cover_value_method
            @endphp
            <div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Cover Count Target Per Day x Cover Value Method') }}
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
                                        <th class="text-center">{{ __('F&B Facility') }}</th>
                                        <th class="text-center">{{ __('F&B Facility Count') }}</th>
                                        <th class="text-center">{{ __('Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Total Guest Capacity') }}</th>
                                        <th class="text-center">{{ __('Cover Value') }}</th>
                                        <th class="text-center">{{ __('Choose Currency') }}</th>
                                        <th class="text-center">{{ __('Estimation Date') }}</th>
                                        <th class="text-center">{{ __('Cover Value Escalation Rate %') }}</th>
                                        <th class="text-center">{{ __('Cover Value At Operation Date') }}</th>
                                        <th class="text-center">{{ __('Cover Value Annual Escalation Rate %') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)

                                    <tr>

                                        {{-- Foods Types	 --}}
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ $food->getName() }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 ;
                                        @endphp
                                        {{-- Foods Count TD	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $food->getFoodCount() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Daily Cover Count Per Facility --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  $food->getFoodCover()  }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts size">
                                                    <input type="hidden" value="{{ $food->getFoodCover() }}">
                                                </div>
                                            </div>
                                        </td>
                                        {{-- Total Guest Capacity  --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getTotalGuestCapacityCount() ?? 0) }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input name="total_daily_cover_count[{{ $food->getFoodIdentifier() }}]" type="hidden" value="{{ $food->getTotalGuestCapacityCount() ?? 0 }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Cover Value	 --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($food->getCoverValue() ?? 0)  }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $food->getFoodIdentifier() }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size " data-calc-adr-operating-date>
                                                    <input class="avg-daily-rate" type="hidden" name="cover_value[{{ $food->getFoodIdentifier() }}]" value="{{ $food->getCoverValue() ?? 0 }}" data-order="{{ $order }}" data-index="{{ $index }}" data-room-type-id="{{ $food->getFoodIdentifier() }}">
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <select name="chosen_food_currency[{{ $food->getFoodIdentifier() }}]" data-order="{{ $order }}" class="form-control " @if($order !=1) disabled @endif>
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($currencyId==( old('chosen_food_currency')?:$food->getChosenCurrency()) )
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
                                                    <input name="estimation_date[{{ $food->getFoodIdentifier() }}]" type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $model->getStudyStartDateFormattedForView() }}" data-order="{{ $order }}" data-index="{{ $index }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">

                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $index }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>
                                        </td>







                                        {{-- Cover Value Escalation Rate %	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getCoverValueEscalationRate(),1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-calc-adr-operating-date data-room-type-id="{{ $food->getFoodIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" class="cover-value-escalation-rate" name="cover_value_escalation_rate[{{ $food->getFoodIdentifier() }}]" data-room-type-id="{{ $food->getFoodIdentifier() }}" value="{{ $food->getCoverValueEscalationRate() ?? 0  }}" data-order="{{ $order }}" data-index="{{ $index }}">

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
                                                    <input name="cover_value_at_operation_date[{{ $food->getFoodIdentifier() }}]" value="{{ $food->getCoverValueAtOperationDate()  }}" data-room-type-id="{{ $food->getFoodIdentifier() }}" type="hidden" class="value-for-adr_at_operation_date">
                                                    <input type="text" readonly data-room-type-id="{{ $food->getFoodIdentifier() }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $food->getCoverValueAtOperationDate() ??0 }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">

                                                </div>
                                            </div>

                                        </td>


                                        {{-- Cover Value Annual  Escalation Rate % --}}
                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    {{-- average_daily_rate_annual_escalation_rate --}}
                                                    <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ number_format($food->getCoverValueAnnualEscalationRate() ?? 0,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" name="cover_value_annual_escalation_rate[{{ $food->getFoodIdentifier() }}]" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-room-type-id="{{ $food->getFoodIdentifier() }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" value="{{ $food->getCoverValueAnnualEscalationRate() ??0  }}">
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
                                    <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year] }} </th>
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
                                            {{ __('Total Guest Count') }}
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
                                                <input type="text" style="text-align: center" value="{{ number_format($annualGuestCountPerRoom[$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>
                                @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)

                                {{-- @foreach($foods as $index=>$food) --}}

                                <tr>
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ str_to_upper($food->getName()) }}
                                        </b>
                                    </td>

                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ __('Cover Count Target Per Day') }}
                                        </b>
                                    </td>

                                    @php
                                    $order = 1 ;

                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        $currentVal = $food->getCoverPerDay($year);
                                        $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-greater-than-or-equal-zero size" data-year="{{ $year }}">
                                                <input type="hidden" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="cover_per_day[{{ $food->getFoodIdentifier() }}][{{ $year }}]" data-year="{{ $year }}">
                                                <span class="ml-2">
                                                    <b>#</b>
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
            {{-- end of Cover Count Target Per Day x Cover Value Method --}}

            {{-- start of Percenatge % From Rooms Revenues --}}
            @php
            $currentSectionName = percentage_from_rooms_revenue ;
            @endphp
            <div class="kt-portlet @if(isset($itemsInEachSection[$currentSectionName]))  @else d-none  @endif">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Percenatge % From Rooms Revenues') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".percenatge-from-rooms-revenues-method">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>


                    <div class="table-responsive percenatge-from-rooms-revenues-method">
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
                                            {{ __('Total Rooms Revenues') }}
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
                                                <input type="text" style="text-align: center" value="{{ number_format($totalOfEachYearOfRevenueSharePerSalesChannel[$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <input type="hidden" style="text-align: center" value="{{ $totalOfEachYearOfRevenueSharePerSalesChannel[$year]??0  }}">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>


                                @foreach($itemsInEachSection[$currentSectionName]??[] as $index=>$food)

                                <tr>
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ str_to_upper($food->getName()) }}
                                        </b>
                                    </td>

                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ __('% From Rooms Revenues') }}
                                        </b>
                                    </td>

                                    @php
                                    $order = 1 ;

                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        $currentVal = $food->getPercentageFromRevenue($year);
                                        $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $index }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
                                                <input type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $index }}" name="percentage_from_rooms_revenues[{{ $food->getFoodIdentifier() }}][{{ $year }}]">
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

            {{-- end of Percenatge % From Rooms Revenues --}}
            @include('admin.hospitality-sector.collection-policy',[
            'collectionPolicyFirstLabel'=>__('Collection Terms Per Facility'),
            'firstHeader'=>__('Facility Name'),
            'collectionPolicyItems'=>$foods,
            'modelName'=>'food',
            'isGeneralCollectionPolicy'=>$model->isFoodGeneralCollection(),
            'isCollectionTermPerItem'=>$model->isFoodCollectionTermPerSalesChannel(),
            'onlyGeneralExpense'=>isTotal($foods)
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
            formData.append('redirect-to-same-page', redirectToSamePage)

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
        const parent = $(this).closest('table')
        let avgDailyRate = parent.find('.avg-daily-rate[data-room-type-id="' + roomTypeId + '"]').val();
        avgDailyRate = number_unformat(avgDailyRate)
        let ascalationRate = parent.find('.cover-value-escalation-rate[data-room-type-id="' + roomTypeId + '"]').val() / 100;
        const result = avgDailyRate * Math.pow(((1 + ascalationRate)), power)
        parent.find('.value-for-adr_at_operation_date[data-room-type-id="' + roomTypeId + '"]').val(result)
        parent.find('.html-for-adr_at_operation_date[data-room-type-id="' + roomTypeId + '"]').val(number_format(result))
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
    $(document).on('change', '.all-faciltiies-select', function() {
        let val = $(this).val()
        if (val) {
            $('.facilities-per-food-select').prop('disabled', true)
            $('.facilities-per-food-select').val(val).trigger('change')
        } else {
            $('.facilities-per-food-select').val('').trigger('change')
            $('.facilities-per-food-select').prop('disabled', false)
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
