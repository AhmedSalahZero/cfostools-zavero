@extends('layouts.dashboard')

@section('css')

<x-styles.commons></x-styles.commons>

<style>
    .div-for-percentage {
        max-width: 50%;
        margin: auto;
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
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Furniture, Fixtures, and Equipment (FF&E) Input Sheet') }}</x-main-form-title>
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

            @php
            $modelName = lastSegmentInRequest() ;
            @endphp
            <input type="hidden" name="model_name" value="{{ $modelName }}">


            @php
            $currentSectionName = FFE_COST;
            @endphp

            {{-- start of FFE COST --}}
            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style="">
                                    {{ __('Furniture, Fixtures, and Equipment (FF&E) Cost') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".cost">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>


                    <div class="table-responsive cost">
                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('FFE Item Name') }}</th>
                                    <th class="text-center">{{ __('Choose Currency') }}</th>
                                    <th class="text-center">{!! __('Item Cost') !!}</th>
                                    <th class="text-center">{{ __('Contingency Rate %') }}</th>
                                    <th class="text-center">{{ __('Total Cost') }}</th>
                                    <th class="text-center">{{ __('Depreciation Duration') }}</th>
                                    <th class="text-center">{!! __('Replacement <br> Cost Rate') !!}</th>
                                    <th class="text-center">{!! __('Replacement Interval') !!}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $currentTotal = [];

                                @endphp

                                @for($instance = 0 ; $instance<4 ; $instance++) @php $ffeItem=$hospitalitySector->getFFEItemForSection($modelName,$currentSectionName , $instance);
                                    @endphp

                                    <tr>
                                        @php
                                        $order =1 ;
                                        @endphp
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <input type="text" class="form-control placeholder-light-gray exclude-text" name="name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $ffeItem ? $ffeItem->getName() : null }}" placeholder="{{ __('FFE Item Name...') }}">
                                            <input type="hidden" class="form-control" name="old_name[{{ $currentSectionName }}][{{ $instance }}]" value="{{ $ffeItem ? $ffeItem->getName() : null }}">
                                        </td>
                                        @php
                                        $order =2 ;
                                        @endphp
                                        {{-- Choose Currency	Td --}}
                                        <td>
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <select name="currency_name[{{ $currentSectionName }}][{{ $instance }}]" data-order="{{ $order }}" class="form-control ">
                                                        @foreach($studyCurrency as $currencyId=>$currencyName)
                                                        <option value="{{ $currencyId }}" @if($currencyId==($ffeItem ? $ffeItem->getCurrencyName() : 0) )
                                                            selected
                                                            @endif
                                                            >{{ $currencyName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </td>

                                        @php
                                        $order =3 ;
                                        @endphp

                                        {{-- Item Cost --}}


                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <input data-has-row-total="0" data-max-row-total="0" data-has-column-total="1" data-max-column-total="0" data-is-percentage="0" data-no-digits="0" data-order="{{ $order }}" data-year="1" data-index="{{ $instance }}" data-id="{{ $instance  }}" 
											
											 type="text" step="0.1" class="item-cost-text mx-auto reculate-contingency-rate form-control only-greater-than-or-equal-zero-allowed target_repeating_amounts" value="{{ $ffeItem ? number_format($ffeItem->getItemCost()):0 }}"
											
											style="min-width: 80px;text-align: center" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"
											>
                                            <input data-index="{{ $instance }}" data-column-identifier="1" type="hidden" name="item_cost[{{ $currentSectionName }}][{{ $instance }}]" class="form-control item-cost-hidden " value="{{ $ffeItem ? $ffeItem->getItemCost():0 }}">
                                        </td>

                                        @php
                                        $order =4 ;
                                        @endphp



                                        {{-- Contingency Rate %	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input data-index="{{ $instance }}" type="text" class="contingency-rate-text reculate-contingency-rate form-control"  value="{{ number_format($ffeItem ? $ffeItem->getContingencyRate() : 0 ) }}" data-order="{{ $order }}" data-index="{{ $instance }}" style="max-width: 50%;min-width: 80px;text-align: center" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-id="{{ $instance }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input data-index="{{ $instance }}" type="hidden" class="contingency-rate-hidden" name="contingency_rate[{{ $currentSectionName }}][{{ $instance }}]" data-id="{{ $instance}}" value="{{ $ffeItem ? $ffeItem->getContingencyRate():0 }}" data-order="{{ $order }}" data-index="{{ $instance }}">
													
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>

                                        @php
                                        $order =5 ;
                                        @endphp

                                        {{-- Total Cost --}}
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center " style="max-width:initial">
                                                    <input
													onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';"
													style="min-width: 80px;text-align: center"
													
													 data-has-row-total="0" data-max-row-total="0" data-has-column-total="1" data-max-column-total="0" data-is-percentage="0" data-no-digits="0" data-order="{{ $order }}" data-year="2" readonly type="text"  value="{{ number_format($ffeItem ? $ffeItem->getTotalCost() : 0 ) }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-id="{{ $instance }}" class="total-cost-text form-control target_repeating_amounts size">
                                                    <input data-column-identifier="2" type="hidden" class="total-cost-hidden" name="total_cost[{{ $currentSectionName }}][{{ $instance }}]" data-id="{{ $instance}}" value="{{ $ffeItem ? $ffeItem->getTotalCost():0 }}" data-order="{{ $order }}" data-index="{{ $instance }}">
                                                </div>
                                            </div>

                                        </td>

                                        @php
                                        $order =6 ;
                                        @endphp


                                        {{--Depreciation Duration	 --}}

                                        @php
                                        $order =7 ;
                                        @endphp

                                        <td>
                                            @php
                                            $currentVal = $ffeItem ? $ffeItem->getDepreciationDuration():0;
                                            @endphp

                                            <select name="depreciation_duration[{{ $currentSectionName }}][{{ $instance }}]" class="form-control">
                                                @for($year = 3 ; $year<=25 ;$year++) <option value="{{ $year }}" @if($currentVal==$year) selected @endif> {{ $year . ' ' . __('Years')  }} </option>
                                                    @endfor
                                            </select>

                                        </td>

                                        @php
                                        $order =7 ;
                                        @endphp


                                        {{-- Replacement Cost Rate %	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    {{-- <input type="hidden"   class="target_repeating_values  " value="0"> --}}
                                                    <input type="text" class="form-control" style="max-width: 50%;min-width: 80px;text-align: center" value="{{ number_format($ffeItem ? $ffeItem->getReplacementCostRate() : 0 ) }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-id="{{ $instance }}" class="form-control target_repeating_amounts only-percentage-allowed size ">
                                                    <input type="hidden" class="" name="replacement_cost_rate[{{ $currentSectionName }}][{{ $instance }}]" data-id="{{ $instance}}" value="{{ $ffeItem ? $ffeItem->getReplacementCostRate():0 }}" data-order="{{ $order }}" data-index="{{ $instance }}">
                                                    <span class="ml-2">
                                                        <b>%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>

                                        @php
                                        $order =8 ;
                                        @endphp


                                        {{-- Replacement Interval	 --}}

                                        <td>

                                            <div class="form-group three-dots-parent">
                                                <div class="kt-input-icon">
                                                    <div class="input-group ">
                                                        <select data-live-search="true" name="replacement_interval[{{ $currentSectionName }}][{{ $instance }}]" required class="form-control   form-select form-select-2 form-select-solid fw-bolder">
                                                            @for($year = 1 ; $year<=5 ;$year++) <option value="{{ $year }}" @if($ffeItem ? $ffeItem->getReplacementInterval() ==$year : false ) selected @endif> {{ $year . ' ' . __('Years')  }} </option>
                                                                @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>




                                    </tr>
                                    @endfor

                                    {{-- totals row  --}}

                                    <tr class="total-tr">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:center">
                                            <b>
                                                {{ __('Total') }}
                                            </b>
                                        </td>




                                        <td>

                                        </td>



                                        <td>
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage sss">
                                                <input data-column-identifier="{{ 1 }}" data-order="{{ 1 }}" data-index="{{ $instance }}" data-year="1" type="text" style="form-conrol" value="{{ 0 }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control text-center  size">
                                                {{-- <span class="ml-2">
                                                    <b>%</b>
                                                </span> --}}
                                            </div>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage ">
                                                <input data-column-identifier="{{ 2 }}" data-order="{{ 2 }}" data-index="{{ $instance }}" data-year="2" readonly data-order="{{ 2 }}" data-index="{{ $instance }}" data-year="{{ 2 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control  text-center size total-cost-item">
                                                <span class="ml-2">
                                                    <b></b>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                        <td></td>
                                        <td></td>

                                    </tr>



                                    {{-- end total rows --}}




                            </tbody>
                        </table>
                    </div>


                    <div class="row cost-repeater" data-repeater-row=".cost-repeater">
                        <div class="form-group row" style="flex:1;">
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    <div class="col-md-3 mt-4">
                                        <x-form.label :class="'label'" :id="'test-id'"> {{ __('Start Date') }} </x-form.label>
                                        <div class="kt-input-icon">
                                            <div class="input-group date">
                                                <input type="text" name="start_date" class="only-month-year-picker date-input form-control recalc-end-date start-date " value="{{ formatDateForInput($model->getStartDate($hospitalitySector) ?:  ($model->hospitalitySector ? $model->hospitalitySector->development_start_date : null))  }} " />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <label class="form-label font-weight-bold">{{ __('Duration (Months)') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="numeric" name="duration" class="form-control duration recalc-end-date" value="{{ $model->getDuration()?:($hospitalitySector ? $hospitalitySector->development_duration : 0) }}" step="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <x-form.label :class="'label'" :id="'test-id'">{{ __(' End Date') }}
                                        </x-form.label>
                                        <div class="kt-input-icon">
                                            <div class="input-group date">
                                                <input id="end-date" type="text" name="end_date" class="form-control" readonly value="{{ $model->getEndDate()  }}" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <label class="form-label font-weight-bold">{{ __('Select Execution Method') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group ">
                                                <select data-live-search="true" name="execution_method" required class="form-control   form-select form-select-2 form-select-solid fw-bolder">
                                                    @foreach(getFFEExecutionMethod() as $value=>$name) <option value="{{ $value }}" @if(isset($model) && $model->getExecutionMethod() == $value ) selected
                                                        @endif> {{ $name }}</option> @endforeach </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> @include('title',['title'=>__('Payment Terms')]) <div class="row installment-section">
                                    <div class="col-md-2  mt-2 mb-5">
                                        <label class="form-label font-weight-bold">{{ __('Down payment %') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-percentage-allowed reclaulate-balance-rate-two" value="{{  number_format($model->getDownPaymentPercentage(),1)   }}" step="0.1">
                                                <input type="hidden" name="down_payment" class=" down-payment" value="{{  $model->getDownPaymentPercentage()   }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2  mt-2">
                                        <label class="form-label font-weight-bold">{{ __('Balance Rate One %') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-percentage-allowed reclaulate-balance-rate-two" value="{{   number_format($model->getBalanceRateOne(),1)   }}" step="0.1">
                                                <input type="hidden" class=" balance-rate-one-percentage" name="balance_rate_one" value="{{  $model->getBalanceRateOne()   }}" step="0.1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2  mt-2 d-flex flex-column">
                                        <label class="form-label font-weight-bold text-left">{{ __('Due One') }}</label>
                                        <select name="due_one" class="form-control mr-2 "> @foreach(dueInDays() as $dueDay)
                                            <option value="{{ $dueDay }}" @if($model->getDueOne()== $dueDay) selected @endif >{{
									$dueDay }} </option> @endforeach </select>
                                    </div>
                                    <div class="col-md-2  mt-2">
                                        <label class="form-label font-weight-bold">{{ __('Balance Rate Two %') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control only-percentage-allowed balance-rate-two" value="{{   number_format($model->getBalanceRateTwo(),1)   }}" step="0.1">
                                                <input type="hidden" class="balance-rate-two-hidden" name="balance_rate_two" value="{{  $model->getBalanceRateTwo()   }}" step="0.1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2  mt-2 d-flex flex-column">
                                        <label class="form-label font-weight-bold text-left">{{ __('Due Two') }}</label>
                                        <select style="width:240px !important" name="due_two" class="form-control mr-2 ">
                                            @foreach(dueInDays() as $dueDay) <option value="{{ $dueDay }}" @if($model->
                                                getDueTwo()== $dueDay) selected @endif >{{ $dueDay }} </option> @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12"> @include('title',['title'=>__('Funding Structure')]) </div>
                                    <div class="col-md-3 mb-4 mt-4">
                                        <label class="form-label font-weight-bold">{{ __('Equity Funding %') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-percentage-allowed recalculate-debet-funding reclaulate-equity-amount equity-funding equity-funding-input-text" value="{{  number_format($model->getEquityFunding(),1)   }}" step="0.1">
                                                <input type="hidden" name="equity_funding" class="equity-funding-input-hidden" value="{{  $model->getEquityFunding()   }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4 mt-4">
                                        <label class="form-label font-weight-bold">{{ __('Equity Amount') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control equity-amount-input-text" value="{{  number_format($model->getEquityAmount())   }}" step="0.1">
                                                <input type="hidden" value="{{  $model->getEquityAmount()   }}" class="equity-amount-input-hidden">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4 mt-4">
                                        <label class="form-label font-weight-bold">{{ __('Debt Funding') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input readonly type="text" class="recalculate-debt-amount form-control loan-form-trigger only-percentage-allowed debt-funding-input-text" value="{{  number_format($model->getDebtFunding(),1)   }}" step="0.1">
                                                <input type="hidden" class="debt-funding-input-hidden " value="{{  $model->getDebtFunding()   }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-4 mt-4">
                                        <label class="form-label font-weight-bold">{{ __('Debt Amount') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input readonly type="text" class="debt-amount-text form-control" value="{{  number_format($model->getDebtAmount())   }}" step="0.1">
                                                <input name="debt_amount" class="debt-amount-hidden" type="hidden" value="{{  $model->getDebtAmount()   }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row collection-policy-row d-none" data-land-payment-method="customize">
                                    <div class="table-responsive" data-name="per-sales-channel-collection">
                                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 table-for-collection-policy removeGlobalStyle">
                                            <tbody class=""> @php $currentTotal = []; $subItemIndex=0; @endphp <tr> @php $order = 1
                                                    ; @endphp <td class="align-middle"> @php $currentVal = 0 ; @endphp <div class="form-group three-dots-parent" style="
								
																	flex-direction: row !important;
																	width:100%;
																	gap: 40px !important;
																	
																	">
                                                        </div>
                                    </div>
                                    </td> @php $order = $order +1 ; @endphp {{-- @endforeach --}}
                                    </tr> @php $subItemIndex = $subItemIndex +1 ; @endphp </tbody>
                                    </table>
                                </div>
                            </div>

                            @php $currentSectionName = FFE_COST @endphp
                            @include('loan-form',[
                            'currentSectionName'=>$currentSectionName ])
                        </div>
                    </div>





                </div>

            </div>
    </div>
    {{-- end of FFE COST --}}



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

    $(document).on('change', '.reculate-contingency-rate', function() {
        let index = $(this).attr('data-index')
        let ffeItemCost = number_unformat($('.item-cost-hidden[data-index="' + index + '"]').val());
        let ffeItemContingencyRate = number_unformat($('.contingency-rate-hidden[data-index="' + index + '"]').val());

        ffeItemContingencyRate = ffeItemContingencyRate / 100;
        let totalFFECost = ffeItemCost * (1 + ffeItemContingencyRate);
        $('.total-cost-text[data-index="' + index + '"]').val(totalFFECost);
        $('.total-cost-hidden[data-index="' + index + '"]').val(number_format(totalFFECost, 0)).trigger('change');
        $('.total-cost-text[data-index="' + index + '"]').trigger('keyup')
        $('.equity-funding').trigger('change')
    })



    $(document).on('change', '.recalc-end-date', function(e) {
        e.preventDefault()
        const studyStartDate = new Date($('.start-date').val());
        const studyDuration = parseFloat($('.duration').val());
        if (studyDuration) {
            const numberOfMonths = studyDuration
            let studyEndDate = studyStartDate.addMonths(numberOfMonths)
            studyEndDate = formatDate(studyEndDate)
            $('#end-date').val(studyEndDate).trigger('change')
        }

    })

    $(function() {
        $('.recalc-end-date').trigger('change')

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
        $('.reculate-contingency-rate').trigger('change')

    })

</script>



<script>
    $(document).on('change', '.reclaulate-equity-amount', function() {
        let totalCost = number_unformat($('.total-cost-item').val());
        let equityFunding = number_unformat($('.equity-funding').val());
        equityFunding = equityFunding / 100;
        let equityAmount = equityFunding * totalCost;
        console.log(totalCost, equityFunding, equityAmount, '--')
        $('.equity-amount-input-text').val(number_format(equityAmount)).trigger('keyup');
        $('.equity-amount-input-hidden').val(equityAmount);
    })
    $(document).on('change', '.recalculate-debet-funding', function(e) {
        e.preventDefault()
        let equityFunding = $('.equity-funding-input-hidden').val();
        equityFunding = number_unformat(equityFunding);
        const debetFunding = (100 - equityFunding);
        $('.debt-funding-input-hidden').val(debetFunding);
        $('.debt-funding-input-text').val(number_format(debetFunding, 1)).trigger('change');
    })

    $(document).on('change', '.recalculate-debt-amount', function() {
        let totalCost = number_unformat($('.total-cost-item').val());
        let debtFunding = number_unformat($('.debt-funding-input-hidden').val());
        debtFunding = debtFunding / 100;
        let debtAmount = debtFunding * totalCost;
        $('.debt-amount-hidden').val(debtAmount);
        $('.debt-amount-text').val(number_format(debtAmount)).trigger('keyup');
    })

    $(document).on('change', '.reclaulate-balance-rate-two', function() {
        let downPayment = number_unformat($('.down-payment').val());
        let balanceRateOnePercentage = number_unformat($('.balance-rate-one-percentage').val());
        let balanceRateTwo = 100 - downPayment - balanceRateOnePercentage;
        $('.balance-rate-two').val(number_format(balanceRateTwo, 1)).trigger('change');
        $('.balance-rate-two-hidden').val(balanceRateTwo);
    })
    $('.reclaulate-balance-rate-two').trigger('change')
    $(function() {
        $(document).on('change', '.loan-form-trigger', function() {
            const value = $(this).val();
            const parent = $(this).closest('[data-repeater-row]')
            console.log(value, parent, parent.find('[data-loan]').length)
            if (value > 0) {
                parent.find('[data-loan]').removeClass('d-none')
            } else {
                parent.find('[data-loan]').addClass('d-none')
            }
        })
        $('.loan-form-trigger').trigger('change')
        $('.reclaulate-equity-amount').trigger('change')
        $('.recalculate-debet-funding').trigger('change')
        $('.recalculate-debt-amount').trigger('change')
    })

</script>


@endsection
