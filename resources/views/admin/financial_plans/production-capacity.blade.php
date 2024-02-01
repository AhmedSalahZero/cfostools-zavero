@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
<style>
    .sub-item-row td span {
        font-weight: 500;
    }

    tr td:first-of-type {
        max-width: 225px;
    }

    b {
        display: inline-block;
    }

    .margin-left-auto-right-init {
        margin-left: initial !important;
        margin-right: auto !important;
    }

    input,
    select,
    .filter-option,
    hr.title-hr,
    .table-border-color td {
        border: 1px solid #CCE2FD !important;
    }

    .production-q th:first-of-type,
    .production-q td:first-of-type {
        max-width: 1% !important;
        width: 1% !important;
        min-width: 1% !important;
    }

    .production-q th:first-of-type div,
    .production-q td:first-of-type div,
        {
        max-width: 30px !important;
        width: 30px !important;
        min-width: 30px !important;
    }

    .max-w-checkbox {

        min-width: 25px !important;
        width: 25px !important;
    }

    .customize-elements .bootstrap-select {
        min-width: 100px !important;
        text-align: center !important;
    }

    .customize-elements input.only-percentage-allowed {
        min-width: 100px !important;
        max-width: 100px !important;
        text-align: center !important;
    }

    [data-repeater-create] span {
        white-space: nowrap !important;
    }

    .type-btn {
        max-width: 150px;
        height: 70px;
        margin-right: 10px;
        margin-bottom: 5px !important;
    }

    .type-btn:hover {}

    .bootstrap-select {
        min-width: 200px;
    }

    input {
        min-width: 200px;
    }

    input.only-month-year-picker {
        min-width: 100px;
    }

    input.only-greater-than-or-equal-zero-allowed {
        min-width: 120px;
    }

    input.only-percentage-allowed {
        min-width: 80px;
    }

    i {
        text-align: left
    }

  

    .repeat-to-r {
        flex-basis: 100%;
        cursor: pointer
    }

    .icon-for-selector {
        background-color: white;
        color: #0742A8;
        font-size: 1.5rem;
        cursor: pointer;
        margin-left: 3px;
        transition: all 0.5s;
    }

    .icon-for-selector:hover {
        transform: scale(1.2);

    }

    .filter-option {
        text-align: center !important;
    }


    td input,
    td select,
    .filter-option {
        border: 1px solid #CCE2FD !important;
        margin-left: auto;
        margin-right: auto;
        color: black;
        font-weight: 400;
    }

    th {
        border-bottom: 1px solid #CCE2FD !important;
    }

    tr:last-of-type {}

    .table tbody+tbody {
        border-top: 1px solid #CCE2FD;
    }

</style>
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

    .table-bg th,
    .table-striped2 th {
        background-color: #074FA4 !important
    }

    .total-tr td {
        color: white !important;
    }

    .total-tr .three-dots-parent {
        margin-top: 0 !important;
    }

    html body .sub-item-row td {
        background-color: #E2EFFE !important;
        color: black !important;
        border: 1px solid white !important;
    }

</style>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Production Capacity Input Sheet Information') }}</x-main-form-title>

<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($disabled) && $disabled ? '#' :  $storeRoute  }}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">
            <input type="hidden" name="financial_plan_id" value="{{ $financial_plan_id }}">
            {{-- <input id="daysDifference" type="hidden" value="{{ $daysDifference }}"> --}}


            @foreach($products as $product)
            <input type="hidden" name="product_ids[]" value="{{ $product->id }}">
            {{-- start of kt-protlet Exhange Rate Forecast % --}}
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ $product->getName() . ' ' . __('Production Capacity')  }}
                                </h3>


                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".exhange-rate-projection{{ $product->id }}">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr class="title-hr" style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row exhange-rate-projection{{ $product->id }}">


                        <div class="table-responsive">
                            <table class="table table-border-color removeGlobalStyle table-bg  table-bordered table-hover table-checkable kt_table_2 ">
                                <thead>
                                    <tr>
                                        <th class="text-center text-white">{{ __('Item') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center  text-white"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
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
                                                {{ __('Max Operating Days Per Year') }}
                                            </b>
                                        </td>


                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            @endphp


                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($daysCountPerYear['totalOfEachYear'][$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size" data-date="#" data-section="target" aria-describedby="basic-addon2">
                                                    <span class="ml-2">
                                                        {{-- <b style="visibility:hidden">%</b> --}}
                                                    </span>
                                                </div>
                                            </div>

                                        </td>

                                        @endforeach

                                    </tr>



                                    @php
                                    $rowIndex = 0 ;
                                    @endphp

                                    {{-- <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Production Lines Count (minimum 1)'  ) }}
                                    </b>
                                    </td>
                                    @php
                                    $columIndex = 0 ;
                                    @endphp

                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>
                                        @php
                                        $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'production_lines_count') ?? 0 ;
                                        @endphp
                                        <div class="form-group three-dots-parent">
                                            <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="production_lines_count[{{ $product->id }}][{{ $year }}]">
                                                <span class="ml-2">
                                                </span>
                                            </div>
                                            <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                        </div>

                                    </td>
                                    @php
                                    $columIndex = $columIndex +1 ;
                                    @endphp

                                    @endforeach


                                    </tr> --}}

                                    @php
                                    $rowIndex ++ ;
                                    @endphp











                                    <tr data-type="production_lines_count">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                @php
                                                $productLinesCountType =$model->getProductionLineForProductAtYear($product->id,0,'production_lines_count_type');
                                                @endphp
                                                <select name="product_lines_count_type[{{ $product->id }}]" class="form-control product-line-count-js  margin-left-auto-right-init net-working-hours-js js-recalculate-max-production-per-year" style="max-width:450px;">
                                                    <option @if($productLinesCountType=='annual' ) selected @endif value="annual">{{ __('Production Lines Count Per Days (Annuall Count)'  ) }}</option>
                                                    <option @if($productLinesCountType=='quarter' ) selected @endif value="quarter">{{ __('Production Lines Count Per Days (Quarter Count)'  ) }}</option>
                                                </select>
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td class="td-for-annually">

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'production_lines_count') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input data-year="{{ $year }}" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal && !is_array($currentVal)? $currentVal:  0  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control production-line-count-js js-recalculate-max-production-per-year target_repeating_amounts  size">
                                                    <input    type="hidden" value="{{ $currentVal && !is_array($currentVal)? $currentVal:  0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="production_lines_count[{{ $product->id }}][annual][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>

                                    @php
                                    $rowIndex ++ ;
                                    @endphp

                                    @foreach(['q1','q2','q3','q4'] as $qIndex=>$quarter)
                                    <tr class="quarter-row-jsproduction_lines_count sub-item-row" style="">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <span style="padding-left:20px;">
                                                {{ __('Quarter ['. $quarter .'] - Production Lines Count Per Day') }}
                                            </span>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td class="td-for-quarters">

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'production_lines_count') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal && is_array($currentVal) ? $currentVal[$qIndex] : 0  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal && is_array($currentVal) ? $currentVal[$qIndex] : 0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="production_lines_count[{{ $product->id }}][quarter][{{ $year }}][]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>

                                    @php
                                    $rowIndex ++ ;
                                    @endphp

                                    @endforeach

                                    @php
                                    $columIndex = 0 ;
                                    @endphp












                                    <tr data-type="net_working_hours_per_days">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                @php
                                                $netWorkingType =$model->getProductionLineForProductAtYear($product->id,0,'net_working_hours_type');
                                                @endphp
                                                <select name="type[{{ $product->id }}]" class="form-control net-working-hour-type-js js-recalculate-max-production-per-year margin-left-auto-right-init net-working-hours-js" style="max-width:450px;">

                                                    <option @if($netWorkingType=='annual' ) selected @endif value="annual">{{ __('Net Working Hours Per Days (Annuall Average)'  ) }}</option>
                                                    <option @if($netWorkingType=='quarter' ) selected @endif value="quarter">{{ __('Net Working Hours Per Days (Quarter Average)'  ) }}</option>
                                                </select>
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td class="td-for-annually">

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'net_working_hours_per_days') ?? 1 ;

                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal && !is_array($currentVal)? $currentVal:  0  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-year="{{ $year }}" class="form-control net-working-count-js js-recalculate-max-production-per-year target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal && !is_array($currentVal)? $currentVal:  0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="net_working_hours_per_days[{{ $product->id }}][annual][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>

                                    @php
                                    $rowIndex ++ ;
                                    @endphp

                                    @foreach(['q1','q2','q3','q4'] as $qIndex=>$quarter)
                                    <tr class="quarter-row-jsnet_working_hours_per_days sub-item-row" style="">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <span style="padding-left:20px;">
                                                {{ __('Quarter ['. $quarter .'] - Net Working Hours Per Day') }}
                                            </span>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td class="td-for-quarters">

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'net_working_hours_per_days') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal && is_array($currentVal) ? $currentVal[$qIndex] : 0  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal && is_array($currentVal) ? $currentVal[$qIndex] : 0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="net_working_hours_per_days[{{ $product->id }}][quarter][{{ $year }}][]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>

                                    @php
                                    $rowIndex ++ ;
                                    @endphp

                                    @endforeach

                                    @php
                                    $columIndex = 0 ;
                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Maximum Working Days Per Year') }}
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'max_working_days_per_year') ?? 1 ;
											$defaultValue = $daysCountPerYear['totalOfEachYear'][$year] ?? 0 ;
											$defaultValue = $defaultValue > 300 ? 300  : $defaultValue    ;
											$currentVal = $currentVal ? $currentVal : $defaultValue ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input data-max-year="{{ $daysCountPerYear['totalOfEachYear'][$year]??0 }}" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  data-year="{{ $year }}" class="form-control max-working-days-js js-recalculate-max-production-per-year max-is-days-max target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="max_working_days_per_year[{{ $product->id }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>
                                    @php
                                    $rowIndex ++ ;
                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Production Capacity '. \App\Models\ProductionUnitOfMeasurement::getNameById($product->pivot ? $product->pivot->production_uom : 0)  .' ' . __('Per Hour')) }}
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'production_capacity_per_hour') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-year="{{ $year }}" class="form-control production-capacity-js js-recalculate-max-production-per-year target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="production_capacity_per_hour[{{ $product->id }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>






                                    @php
                                    $rowIndex ++ ;
                                    @endphp

                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Maximum Production '.  \App\Models\ProductionUnitOfMeasurement::getNameById($product->pivot ? $product->pivot->production_uom : 0) .' '.__('Per Year')   ) }}
                                                {{-- (Auto Calculated) --}}
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'max_production_per_year') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center">
                                                    <input  data-year="{{ $year }}" readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"  class="form-control recalculate-max-saleable- js-autocalculate-max-production target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="max_production_per_year[{{ $product->id }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>






                                    @php
                                    $rowIndex ++ ;
                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Product Waste Rate %') }}
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'product_waste_rate') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="product_waste_rate[{{ $product->id }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>



                                    @php
                                    $rowIndex ++ ;
                                    @endphp

                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Maximum Saleable Production '.  \App\Models\ProductionUnitOfMeasurement::getNameById($product->pivot ? $product->pivot->production_uom : 0) .' '.__('Per Year')   ) }}
                                                {{-- (Auto Calculated) --}}
                                            </b>
                                        </td>
                                        @php
                                        $columIndex = 0 ;
                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'max_saleable_production_per_year') ?? 1 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center">
                                                    <input readonly type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" name="max_saleable_production_per_year[{{ $product->id }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                {{-- <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $columIndex??1 }}" data-index="{{ $rowIndex??0 }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
                                            </div>

                                        </td>
                                        @php
                                        $columIndex = $columIndex +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>


                                    @php
                                    $rowIndex ++ ;
                                    @endphp






                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ $product->getName() . ' ' . __('Production Formula Per') . ' [ ' . \App\Models\ProductionUnitOfMeasurement::getNameById($product->pivot ? $product->pivot->production_uom : 0) . ' ]'  }}
                                </h3>


                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".production-capacity{{ $product->id }}">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr class="title-hr" style="flex:1;background-color:lightgray">
                    </div>

                    <div class="row production-capacity{{ $product->id }}">
                        <div class="col-12">
                            {{-- start of fixed monthly repeating amount --}}
                            @php
                            $rowMaterialType = 'production_capacity';
                            $tableId = $rowMaterialType.'['.$product->id.']';
                            $repeaterId = 'production_capacity_row_materia_repeater'.$product->id;

                            @endphp
                            <input type="hidden" value="{{ $rowMaterialType }}" name="raw_material_type">
                            <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
                            <x-tables.repeater-table :repeaterClass="'table-border-color removeGlobalStyle table-bg'" :actionThClass="'text-white'" :removeRepeater="false" :repeater-with-select2="true" :parentClass="'   '" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'row_materials'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                                <x-slot name="ths">
                                    <x-tables.repeater-table-th class="col-md-4 text-white" :title="__('Raw Material Name')"></x-tables.repeater-table-th>
                                    <x-tables.repeater-table-th class="col-md-1 text-white" :title="__('Raw Material UOM')" :helperTitle="__('')"></x-tables.repeater-table-th>
                                    <x-tables.repeater-table-th class="col-md-1 text-white" :title="__('Quantity')" :helperTitle="__('')"></x-tables.repeater-table-th>
                                    <x-tables.repeater-table-th class="col-md-1 text-white" :title="__('Waste Rate %')" :helperTitle="__('')"></x-tables.repeater-table-th>
                                    <x-tables.repeater-table-th class="col-md-1 text-white" :title="__('Total Quantity')" :helperTitle="__('')"></x-tables.repeater-table-th>
                                </x-slot>
                                <x-slot name="trs">
                                    @php
                                    $rows = isset($model) ? $model->generateRelationDynamicallyForRowMaterial($rowMaterialType)->get() : [-1] ;
                                    @endphp
                                    @foreach( count($rows) ? $rows : [-1] as $subModel)
                                    @php
                                    if( !($subModel instanceof \App\Models\RawMaterial) ){
                                    unset($subModel);
                                    }

                                    @endphp
                                    <tr @if($isRepeater) data-repeater-item @endif>
                                        <td class="text-center">
                                            <div class="">
                                                <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                                </i>
                                            </div>
                                        </td>


                                        <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                                        <td>
                                            <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                                        </td>
										
                                        <td>
                                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getProductUnitOfMeasurementId() : null " :options="$productionUnitOfMeasurements" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'product_unit_of_measurement_id':'['. $tableId .'][0][product_unit_of_measurement_id]' }}" id="{{$type.'_'.'duration_type' }}"></x-form.select>
                                        </td>
										
                                        <td>

                                            <div class="d-flex align-items-center js-common-parent">
                                                <input value="{{ isset($subModel) ? $subModel->getQuantity() : null }}" class="form-control " @if($isRepeater) name="quantity" @else name="{{ $tableId }}[0][quantity]" @endif type="text">
                                                @include('ul-to-trigger-popup')
                                            </div>
                                        </td>
                                        <td>
                                            <input value="{{ (isset($subModel) ? number_format($subModel->getWasteRate(),0) : 0) }}" @if($isRepeater) name="waste_rate" @else name="[{{ $tableId }}][0][waste_rate]" @endif class="form-control text-center " type="text">
                                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWasteRate() : 0) }}" @if($isRepeater) name="waste_rate" @else name="[{{ $tableId }}][0][waste_rate]" @endif>
                                        </td>

                                        <td>
											{{-- auto calculated --}}
                                            <input readonly value="{{ (isset($subModel) ? number_format($subModel->getTotalQuantity(),0) : 0) }}" @if($isRepeater) name="total_quantity" @else name="[{{ $tableId }}][0][total_quantity]" @endif class="form-control text-center " type="text">
                                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getTotalQuantity() : 0) }}" @if($isRepeater) name="total_quantity" @else name="[{{ $tableId }}][0][total_quantity]" @endif>
                                        </td>




                                    </tr>
                                    @endforeach

                                </x-slot>




                            </x-tables.repeater-table>
                            {{-- end of fixed monthly repeating amount --}}
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            {{-- end of kt-protlet Exhange Rate Forecast % --}}







































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
<script>
    $(document).on('change', 'select.net-working-hours-js', function() {
        const val = $(this).val();
        const type = $(this).closest('tr').attr('data-type');
        if (val == 'quarter') {
            $(this).closest('tr').find('.td-for-annually input').prop('disabled', true);
            $(this).closest('table').find('.quarter-row-js' + type).show();
        } else {

            $(this).closest('tr').find('.td-for-annually input').prop('disabled', false);
            $(this).closest('table').find('.quarter-row-js' + type).hide();
        }
    })
    $('select.net-working-hours-js').trigger('change');
    $('.js-parent-to-table').show()
    $(document).on('change', '.max-is-days-max', function() {
        const maxYear = $(this).attr('data-max-year')
        const value = number_unformat($(this).val())
        if (value > maxYear) {
            Swal.fire({
                icon: "warning"
                , text: '{{ __("Invalid Max Year Days") }}'
            })
            $(this).val(maxYear).trigger('change')

        }

    })
	$(document).on('change','.js-recalculate-max-production-per-year',function(){
		const parent  = $(this).closest('table') 
		const productLineCountType = parent.find('select.product-line-count-js').val() // annual or quarter
		const netWorkingHourType = parent.find('select.net-working-hour-type-js').val() // annual or quarter
		const maxProductionPerTon = parent.find('.js-autocalculate-max-production')
		if(productLineCountType == 'annual' && netWorkingHourType == 'annual'){
			$(maxProductionPerTon).each(function(index,element){
				var currentYear = $(element).attr('data-year')
				var productionLineCount = number_unformat(parent.find('.production-line-count-js[data-year="'+currentYear+'"]').val())
				var netWorkingCount = number_unformat(parent.find('.net-working-count-js[data-year="'+currentYear+'"]').val())
				var maxWorkingDaysPerYear = number_unformat(parent.find('.max-working-days-js[data-year="'+currentYear+'"]').val())
				var productCapacity = number_unformat(parent.find('.production-capacity-js[data-year="'+currentYear+'"]').val())
				var calculation = productionLineCount*netWorkingCount*maxWorkingDaysPerYear*productCapacity ;
				$(element).val(calculation).trigger('change')
				
			})
			console.log()
		}		
	})
</script>

@endsection
