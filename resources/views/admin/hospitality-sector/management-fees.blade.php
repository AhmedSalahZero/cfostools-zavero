@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>

<style>
tbody td {
		font-weight:600;
		color:black;
	}
	
.removeHeight *{
	height:0 !important;
	padding:0 !important;
	font-size:0 !important;
}
    .placeholder-light-gray::placeholder {
        color: lightgrey;
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
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Management Fees Input Sheet') }}</x-main-form-title>
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

            @php
            $modelName = lastSegmentInRequest() ;
            @endphp
            <input type="hidden" name="model_name" value="{{ $modelName }}">


            {{-- start of Percenatge % From Rooms Revenues --}}
            @php
            $currentSectionName = BASE_MANAGEMENT_FEES_AS_PERCENTAGE_FROM_REVENUES;
            @endphp
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Base Management Fees As % From Revenues') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".base_management_fees_as_percentage_from_revenues">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>


                    <div class="table-responsive base_management_fees_as_percentage_from_revenues">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('Expense Item Name') }}</th>

                                    @foreach($yearsWithItsMonths = getMaxNumberOfArray($yearsWithItsMonths) as $year=>$monthsForThisYearArray)
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
                                            {{ __('Total Revenues') }}
                                        </b>
                                    </td>

                                    @php


                                    @endphp
                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        @endphp

                                        <div class="form-group three-dots-parent">

                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="text-align: center" value="{{ number_format($annuallyTotalHotelRevenue[$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>



                                @for($instance=0 ; $instance<1 ; $instance++) @php $managementFee=$model->getManagementFeeForSection($modelName,$currentSectionName , $instance);
                                    @endphp
                                    <tr>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <input readonly type="text" class="form-control placeholder-light-gray exclude-text" value="{{ __('Base Management Fees') }}">
                                            <input type="hidden" value="Base Management Fees" name="name[{{ $currentSectionName }}][{{ $instance }}]">
                                        </td>

                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $managementFee ? $managementFee->getPayloadAtYear($year) : 0;
                                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input data-has-row-total="0" data-max-row-total="0" data-has-column-total="1" data-max-column-total="100" data-is-percentage="1" data-no-digits="1" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
                                                    <input data-column-identifier="{{ $year }}" type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" name="payload[{{ $currentSectionName }}][{{ $instance }}][{{ $year }}]">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $instance ??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp
                                        @endforeach

                                    </tr>

                                    @endfor
                                    {{-- @include('admin.total-for-variable-expenses-as-percentage') --}}






                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
            {{-- end of Percenatge % From Rooms Revenues --}}









            {{-- start of Incentive Management Fees --}}
            @php
            $currentSectionName = INCENTIVE_MANAGEMENT_FEES_AS_PERCENTAGE_FROM_REVENUES;
            @endphp
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Incentive Management Fees As % From EBITDA') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".incentive_management_fees_as_percentage_from_revenues">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>


                    <div class="table-responsive incentive_management_fees_as_percentage_from_revenues">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('Expense Item Name') }}</th>

                                    @foreach($yearsWithItsMonths = getMaxNumberOfArray($yearsWithItsMonths) as $year=>$monthsForThisYearArray)
                                    <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentTotal = [];

                                @endphp
                                <tr style="visibility:hidden;" class="removeHeight">
                                    <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                        <b>
                                            {{ __('Total Revenues') }}
                                        </b>
                                    </td>

                                    @php


                                    @endphp
                                    @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                    <td>

                                        @php
                                        @endphp

                                        <div class="form-group three-dots-parent">

                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                <input type="text" style="text-align: center" value="{{ number_format($annuallyTotalHotelRevenue[$year]??0 , 0) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control size trigger-change-when-start">
                                                <span class="ml-2">
                                                    <b style="visibility:hidden">%</b>
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    @endforeach

                                </tr>



                                @for($instance=0 ; $instance<1 ; $instance++) @php $managementFee=$model->getManagementFeeForSection($modelName,$currentSectionName , $instance);
                                    @endphp
                                    <tr>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <input readonly type="text" class="form-control placeholder-light-gray exclude-text" value="{{ __('Incentive Management Fees') }}">
                                            <input type="hidden" value="Incentive Management Fees" name="name[{{ $currentSectionName }}][{{ $instance }}]">
                                        </td>

                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            $currentVal = $managementFee ? $managementFee->getPayloadAtYear($year) : 0;
                                            $currentTotal[$year]=isset($currentTotal[$year]) ? $currentTotal[$year] + $currentVal : $currentVal;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input data-has-row-total="0" data-max-row-total="0" data-has-column-total="1" data-max-column-total="100" data-is-percentage="1" data-no-digits="1" type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,1) }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-percentage-allowed size" data-year="{{ $year }}">
                                                    <input data-column-identifier="{{ $year }}" type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" name="payload[{{ $currentSectionName }}][{{ $instance }}][{{ $year }}]">

                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $instance ??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp
                                        @endforeach

                                    </tr>

                                    @endfor
                                    {{-- @include('admin.total-for-variable-expenses-as-percentage') --}}






                            </tbody>
                        </table>
                    </div>


                </div>

            </div>
            {{-- end of INCENTIVE_MANAGEMENT_FEES_AS_PERCENTAGE_FROM_REVENUES --}}









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
    $(document).on('change', 'input[type="number"]:not(.exclude-text),input[type="password"]:not(.exclude-text),input[type="text"]:not(.exclude-text),input[type="email"]:not(.exclude-text)', function() {
        let val = $(this).val()
        val = number_unformat(val)
        $(this).parent().find('input[type="hidden"]').val(val)
    })

</script>

<script>
    $(document).on('click', '.save-form', function(e) {
        e.preventDefault(); {
            let redirectToSamePage = $(this).attr('data-redirect-to-same-page') ? +$(this).attr('data-redirect-to-same-page') : 0
            let addManpowerCount = $(this).attr('data-add-manpower-count') ? +$(this).attr('data-add-manpower-count') : 0
            if ($('.manpower-select:checked').length) {
                addManpowerCount = 1;
            }

            const hasSalesChannel = $('#add-sales-channels-share-discount-id:checked').length

            let canSubmitForm = true;
            let errorMessage = '';
            let messageTitle = 'Oops...';

            if (!canSubmitForm) {
                Swal.fire({
                    icon: "warning"
                    , title: messageTitle
                    , text: errorMessage
                })

                return;
            }


            let form = document.getElementById('form-id');
            var formData = new FormData(form);
            $('.save-form').prop('disabled', true);
            formData.append('redirect-to-same-page', redirectToSamePage)
            formData.append('has_casinos_manpower', addManpowerCount)


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

        $(commonParent).find('select').each(function(index, select) {
            if (select != currentSelect) {
                if ($(select).find('option[value="' + val + '"]:selected').length) {
                    alert('This Item has been choosen before')
                    $(currentSelect).val('').trigger('change')
                }
                //.prop('disabled',true).attr('title','This Item has been choosen before')
            }
        })
    })

    $(document).on('change', '.can-be-toggle-show-repeater-btn', function() {
        let val = $(this).is(':checked')
        let repeaterQuery = $(this).attr('data-repeater-query')
        if (!val) {
            $('.show-hide-repeater[data-query="' + repeaterQuery + '"]').addClass('disabled');
            $('[data-repeater-row="' + repeaterQuery + '"]').fadeOut(300)
            $('.row' + repeaterQuery).fadeOut(300)
            $(this).val(0)
        } else {
            $('.show-hide-repeater[data-query="' + repeaterQuery + '"]').removeClass('disabled');
            $('[data-repeater-row="' + repeaterQuery + '"]').fadeIn(300)
            $(this).val(1)
            $('.row' + repeaterQuery).fadeIn(300)


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
        const roomTypeId = $(this).attr('data-id');
        const parent = $(this).closest('table')
        let avgDailyRate = parent.find('.avg-daily-rate[data-id="' + roomTypeId + '"]').val();
        avgDailyRate = number_unformat(avgDailyRate)

        let ascalationRate = parent.find('.cover-value-escalation-rate[data-id="' + roomTypeId + '"]').val() / 100;

        const result = avgDailyRate * Math.pow(((1 + ascalationRate)), power)
        parent.find('.value-for-adr_at_operation_date[data-id="' + roomTypeId + '"]').val(result)
        parent.find('.html-for-adr_at_operation_date[data-id="' + roomTypeId + '"]').val(number_format(result))

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
