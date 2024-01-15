@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>

<style>
    .max-w-170px {
        max-width: 170px;
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
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Foods & Beverage Department Expenses Projection Input Sheet') }}</x-main-form-title>
<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>

@endsection
@section('content')
@php
$studyEndDate = $model->getOperationStartDateFormatted();
$studyEndDate = \Carbon\Carbon::make($studyEndDate)->format('m/d/Y')
@endphp


<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($disabled) && $disabled ? '#' :  $storeRoute  }}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">
            <input type="hidden" name="hospitality_sector_id" value="{{ $hospitality_sector_id }}">
            {{-- <input id="daysDifference" type="hidden" value="{{ $daysDifference }}"> --}}

            @php
            $modelName = lastSegmentInRequest() ;
            @endphp
            <input type="hidden" name="model_name" value="{{ $modelName }}">







            {{-- start of Disposable Expenses --}}

            @php
            $currentSectionName = start_up_cost;
            @endphp

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Start-up Cost') }}
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


                    <div class="table-responsive guest-capture-cover-value-per-guest-method">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                            <thead>
                                <tr>

                                    <th class="text-center">{{ __('Expense Item Name') }}</th>
                                    <th class="text-center">{!! __('Currency') !!}</th>
                                    <th class="text-center">{!! __('Cost Amount') !!}</th>
                                    <th class="text-center max-w-170px">{!! __('Date') !!}</th>
                                    <th class="text-center ">{!! __('Cash Payment %') !!}</th>
                                    <th class="text-center">{!! __('Deferred Payment %') !!}</th>
                                    <th class="text-center text-nowrap">{{ __('Due Days') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentTotal = [];

                                @endphp
                                @for($instance = 0 ; $instance<3 ; $instance++) @php $directExpense=$model->getDirectExpenseForSection($modelName,$currentSectionName , $instance);
                                    $dueDays = $directExpense ? $directExpense->getDueDays() : 0
                                    @endphp
                                    <tr>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <input type="text" class="form-control placeholder-light-gray exclude-text" name="name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}" placeholder="{{ __('Please Enter Expense Name...') }}">
                                            <input type="hidden" class="form-control placeholder-light-gray" name="old_name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}" placeholder="{{ __('Please Enter Expense Name...') }}">
                                        </td>

                                        {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <select name="chosen_currency[{{ $currentSectionName }}][{{ $instance }}]" class="form-control ">
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($directExpense && $currencyId==( $directExpense->getChosenCurrency()) )
                                                            selected
                                                            @endif
                                                            >{{ $currencyName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </td>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <div class="max-w-170px mx-auto ">
                                                <input style="max-width:100%;margin-left:auto;margin-right:auto;text-align: center" type="text" step="0.1" class="form-control only-greater-than-or-equal-zero-allowed" value="{{ $directExpense ? number_format($directExpense->getStartUpCost()):0 }}">
                                                <input type="hidden" name="start_up_cost[{{ $currentSectionName }}][{{ $instance }}]" class="form-control only-greater-than-or-equal-zero-allowed" value="{{ $directExpense ? $directExpense->getStartUpCost():0 }}">

                                            </div>

                                        </td>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            {{-- <x-form.label :class="'label'" :id="'test-id'">{{ __('Date') }} @include('star') </x-form.label> --}}
                                            <div class="kt-input-icon max-w-170px mx-auto">
                                                <div class="input-group date">
                                                    <input type="text" name="date[{{ $currentSectionName }}][{{ $instance }}]" class="form-control only-month-year-picker date-input" value="{{ formatDateForInput($directExpense && $directExpense->getDate()? $directExpense->getDate() : $hospitalitySector->getStudyStartDate()) }}" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <input data-row-identifier="{{ $instance }}" style="max-width:80px;margin-left:auto;margin-right:auto;text-align: center" type="text" step="0.1" class="form-control only-greater-than-or-equal-zero-allowed recalculate-defered-payment cash-payment" value="{{ $directExpense ? number_format($directExpense->getCashPayment(),1):0 }}">
                                            <input data-row-identifier="{{ $instance }}" type="hidden" name="cash_payment_percentage[{{ $currentSectionName }}][{{ $instance }}]" class="form-control only-greater-than-or-equal-zero-allowed" value="{{ $directExpense ? $directExpense->getCashPayment():0 }}">
                                        </td>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <input data-row-identifier="{{ $instance }}" readonly style="max-width:80px;margin-left:auto;margin-right:auto;text-align: center" type="text" step="0.1" class="form-control only-greater-than-or-equal-zero-allowed deffered-payment-input-text" value="{{ $directExpense ? number_format($directExpense->getDeferredPaymentPercentage(),1):0 }}">
                                            <input data-row-identifier="{{ $instance }}" type="hidden" name="deferred_payment_percentage[{{ $currentSectionName }}][{{ $instance }}]" class="form-control only-greater-than-or-equal-zero-allowed deffered-payment-input-hidden" value="{{ $directExpense ? $directExpense->getDeferredPaymentPercentage():0 }}">
                                        </td>

                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <select class="form-control" name="due_days[{{ $currentSectionName }}][{{ $instance }}]">
                                                @foreach(dueInDays() as $dueDay)
                                                <option value="{{ $dueDay }}" @if($dueDay==$dueDays) selected @endif> {{ $dueDay }} </option>
                                                @endforeach
                                            </select>
                                        </td>


                                    </tr>
                                    @endfor




                            </tbody>
                        </table>
                    </div>







                </div>

            </div>
            {{-- end of Disposable Expenses--}}





            {{-- start of Pre operating Expense --}}

            @php
            $currentSectionName = pre_operating_expense;
            @endphp

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Pre-operating Expense') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".pre-operating-expense">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>



                    <div class="table-responsive pre-operating-expense">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                            <thead>
                                <tr>
                                    <th class="text-center" style="white-space:nowrap;">{{ __('Expense Name') }}</th>
                                    <th class="text-center" style="white-space:nowrap;">{{ __('Currency') }}</th>
                                    @foreach($studyStartDateToOperationStartDate = $hospitalitySector->studyStartDateToOperationStartDates()  as $dateString=>$date)
                                    <th class="text-center"> {{ formatDateForView($dateString) }} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentTotal = [];

                                @endphp

                                @for($instance=0 ; $instance<3 ; $instance++) @php 
								$directExpense=$model->getDirectExpenseForSection($modelName,$currentSectionName , $instance);

									@endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <input style="width:max-content !important;" name="name[{{ $currentSectionName }}][{{ $instance }}]" type="text" class="form-control exclude-text" value="{{ $directExpense ? $directExpense->getName():null }}" placeholder="{{ __('Expense Name...') }}">
                                            <input type="hidden" class="form-control placeholder-light-gray" name="old_name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}" placeholder="{{ __('Please Enter Expense Name...') }}">
											
                                        </td>
										
										   {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <select name="chosen_currency[{{ $currentSectionName }}][{{ $instance }}]" class="form-control ">
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($directExpense && $currencyId==( $directExpense->getChosenCurrency()) )
                                                            selected
                                                            @endif
                                                            >{{ $currencyName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </td>


                                        @php
                                        $order = 1 ;

                                        @endphp

                                        @foreach($studyStartDateToOperationStartDate as $date)

                                        <td>

                                            @php
                                            $currentVal = $directExpense ? $directExpense->getManpowerPayloadAtYear($date) : 0;
                                            $currentTotal[$date]=isset($currentTotal[$date]) ? $currentTotal[$date] + $currentVal : $currentVal;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,0) }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-greater-than-or-equal-zero-allowed size" data-year="{{ $date }}">
                                                    <input type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" name="manpower_payload[{{ $currentSectionName }}][{{ $instance }}][{{ $date }}]">

                                                    {{-- <span class="ml-2">
		                                                 <b>#</b>
		                                             </span> --}}
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $instance ??0 }}" data-year="{{ $date }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp
                                        @endforeach

                                    </tr>


                                    @endfor





                            </tbody>
                        </table>
                    </div>








                </div>

            </div>
            {{-- end of Disposable Expenses--}}



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
    $(document).on('change', '.recalculate-defered-payment', function() {
        const rowIdentifier = this.getAttribute('data-row-identifier');
        const cashPayment = number_unformat($('.cash-payment[data-row-identifier="' + rowIdentifier + '"]').val())
        const defferedPaymentInput = 100 - cashPayment;

        $('.deffered-payment-input-text[data-row-identifier="' + rowIdentifier + '"]').val(number_format(defferedPaymentInput, 1))
        $('.deffered-payment-input-hidden[data-row-identifier="' + rowIdentifier + '"]').val(defferedPaymentInput, 1)
    })
    $('.recalculate-defered-payment').trigger('change')
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
                , })

                return;
            }


            let form = document.getElementById('form-id');
            var formData = new FormData(form);
            $('.save-form').prop('disabled', true);
            formData.append('redirect-to-same-page', redirectToSamePage)
            if (addManpowerCount) {
                formData.append('redirect-to-section-id', '#manpower-count-table')
            }
            formData.append('has_foods_manpower', addManpowerCount)


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
