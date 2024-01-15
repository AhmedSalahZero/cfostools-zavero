@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Property Acquisition Cost Input Sheet') }}</x-main-form-title>
<x-navigators-dropdown :navigators="$navigators"></x-navigators-dropdown>

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{$storeRoute}}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">
            <input type="hidden" name="hospitality_sector_id" value="{{ $hospitalitySector->id  }}">



            {{-- Land Acquisition Cost Section  --}}

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Land Acquisition Cost') }} </h3>
                                <input class="can-not-be-removed-checkbox" type="checkbox" name="has_land_section" value="1" style="width:20px;height:20px" checked readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".land-repeater">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row land-repeater" data-repeater-row=".land-repeater">

                        <div class="form-group row" style="flex:1;">
                            <div class="col-md-12 mt-3">
                                <div class="row mb-5">

                                    <div class="col-md-2 ">

                                        <x-form.label :class="'label'" :id="'test-id'">{{ __('Purchase Date') }} @include('star') </x-form.label>
                                        <div class="kt-input-icon">
                                            <div class="input-group date">
                                                <input type="text" name="purchase_date" class="form-control only-month-year-picker date-input" value="{{ formatDateForInput(isset($model) && $model->getLandPurchaseDate()? $model->getLandPurchaseDate() : $hospitalitySector->getStudyStartDate()) }}"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-3 ">
                                        <label class="form-label font-weight-bold">{{ __('Purchase Cost') }} @include('star') </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-greater-than-or-equal-zero-allowed reclaulate-total-purchase-cost purchase-cost" value="{{  number_format($model->getLandPurchaseCost(),0)  }}" step="0.1">
                                                <input name="land_purchase_cost" class="" type="hidden" value="{{  $model->getLandPurchaseCost()  }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-2 ">
                                        <label class="form-label font-weight-bold">{{ __('Contingency Rate (%)') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-percentage-allowed reclaulate-total-purchase-cost land-contingency-rate" name="land_contingency_rate" value="{{  $model->getLandContingencyRate()  }}" step="0.1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 ">
                                        <label class="form-label font-weight-bold">{{ __('Total Purchase Cost') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control recalaculate-debt-amount reclculate-equity-amount recalculate-hard-debet-amount  total-purchase-cost-input-text" value="{{  number_format($model->getTotalPurchaseCost())  }}" step="0.1">
                                                <input type="hidden" class=" total-purchase-cost-input-hidden" value="{{  $model->getTotalPurchaseCost()  }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <label class="form-label font-weight-bold">{{ __('Select Land Payment Method') }} @include('star') </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group ">
                                                <select data-live-search="true" name="land_payment_method" required class="form-control land-payment-method-class  form-select form-select-2 form-select-solid fw-bolder">
                                                    @foreach(getLandPaymentMethod() as $value=>$name)
                                                    <option value="{{ $value }}" @if(isset($model) && $model->getLandPaymentMethod() == $value ) selected @endif> {{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>












                                </div>

                                <div class="row d-none installment-section" data-land-payment-method="installment">
                                    <div class="col-md-2 mb-5 ">
                                        <label class="form-label font-weight-bold">{{ __('First Down payment %') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-percentage-allowed reclulate-land-balance-sheet " value="{{  number_format($model->getFirstLandDownPaymentPercentage(),1)   }}" step="0.1">
                                                <input type="hidden" class="reclulate-land-balance-sheet first-land-down-payment-percentage" name="first_land_down_payment_percentage" value="{{  $model->getFirstLandDownPaymentPercentage()   }}" step="0.1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-5 ">
                                        <label class="form-label font-weight-bold">{{ __('Second Down payment %') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="text" class="form-control only-percentage-allowed reclulate-land-balance-sheet " value="{{   number_format($model->getSecondLandDownPaymentPercentage(),1)   }}" step="0.1">
                                                <input type="hidden" class="second-land-down-payment-percentage" name="second_land_down_payment_percentage" value="{{  $model->getSecondLandDownPaymentPercentage()   }}" step="0.1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-5 ">
                                        <label class="form-label font-weight-bold">{{ __('After Month') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input type="numeric" class="form-control only-greater-than-or-equal-zero-allowed" name="land_after_month" value="{{  $model->getLandAfterMonthDays()   }}" step="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-5 ">
                                        <label class="form-label font-weight-bold">{{ __('Balance Rate') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input readonly type="text" class="form-control land-balance-rate" value="{{  number_format($model->getLandBalanceRate(),1)   }}" step="1">
                                                <input type="hidden" class="form-control land-balance-rate" name="land_balance_rate" value="{{  $model->getLandBalanceRate()   }}" step="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-5 ">
                                        <label class="form-label font-weight-bold">{{ __('Installment Count') }} </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group">
                                                <input name="land_installment_count" type="numeric" class="form-control only-greater-than-or-equal-zero-allowed" value="{{  $model->getLandInstallmentCount()   }}" step="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-5 ">
                                        <label class="form-label font-weight-bold">{{ __('Installment Interval') }} @include('star') </label>
                                        <div class="kt-input-icon">
                                            <div class="input-group ">
                                                <select data-live-search="true" name="installment_interval" required class="form-control  form-select form-select-2 form-select-solid fw-bolder">
                                                    @foreach(getDurationIntervalTypesForSelect() as $intervalTypeArr)
                                                    <option value="{{ $intervalTypeArr['value'] }}" @if(isset($model) && $model->getLandPaymentMethod() == $intervalTypeArr['value'] ) selected @endif> {{ $intervalTypeArr['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                </div>



                                <div class="row collection-policy-row d-none" data-land-payment-method="customize">

                                    <div class="table-responsive" data-name="per-sales-channel-collection">
                                        <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 table-for-collection-policy removeGlobalStyle">

                                            <tbody class="">

                                                @php
                                                $currentTotal = [];
                                                $subItemIndex=0;

                                                @endphp



                                                <tr>

                                                    @php
                                                    $order = 1 ;
                                                    @endphp

                                                    <td class="align-middle ">

                                                        @php
                                                        $currentVal = 0 ;


                                                        @endphp
                                                        <div class="form-group three-dots-parent" style="
								
																	flex-direction: row !important;
																	width:100%;
																	gap: 40px !important;
																	
																	">



                                                            <div class="basis-100 for-only-one-checked w-100 " data-item="customize">
                                                                <div class="customize-content" style="display:flex;flex-direction:row !important;flex-wrap:wrap !important;width:100%;background-color:#F2F2F2 !important;padding-top:10px;padding-bottom:10px;">
                                                                    <div class="collection-rate d-flex flex-wrap w-100 mb-2 align-items-center ">
                                                                        <div class="d-flex align-items-center justify-content-center w-100 mb-3 ">

                                                                            <label class="label-clr label-size form-label font-weight-bold mb-0 ml-5 " style="white-space:nowrap;">{{ __('Collection Rate %') }} </label>
                                                                        </div>
                                                                        @for($i = 0 ; $i<4 ; $i++) <div class="collection-rate-item mb-3 d-flex flex-column align-items-start col">
                                                                            <label class="form-label label-text label-clr form-label font-weight-bold"> Rate {{ $i+1 }} % </label>
                                                                            <div class="d-flex">
                                                                                <div class="d-inline-flex align-items-center ">
                                                                                    <input class="form-control collection_rate_input mr-2 only-percentage-allowed" type="text" name="sub_items[collection_policy][type][value][rate][{{ $i }}]" value="{{ $model->getSalesChannelRateAndDueInDays($i,'rate')??0 }}">
                                                                                </div>
                                                                                <span class="percentage-weight">%</span>
                                                                            </div>
                                                                    </div>
                                                                    @endfor
                                                                    <div class="d-flex align-items-center justify-content-center" style="margin-left:10px;margin-bottom:1rem">
                                                                        <div class="d-inline-flex align-items-center flex-column">
                                                                            <label class="label form-label ">{{ __('Total') }}</label>
                                                                            <input style="width:240px;margin-left:20px" value="{{ $model->isCustomizeCollectionPolicy()?100:0 }}" class="form-control collection_rate_total_class mr-2" readonly name="sub_items[collection_rate_total][{{ $i }}]">
                                                                        </div>

                                                                        <span class="percentage-weight">%</span>
                                                                    </div>
                                                                </div>
                                                                <div class="due-in-days d-flex flex-wrap w-100">
                                                                    <div class="d-flex align-items-center justify-content-center w-100 mb-3">

                                                                        <label class="label-clr label-size form-label font-weight-bold label form-label mb-0 ml-5">{{ __('Due In Days') }}</label>
                                                                    </div>


                                                                    @for($i=0;$i<4;$i++) <div class="collection-rate-item mb-3  d-flex align-content-center col ">
                                                                        <select style="" name="sub_items[collection_policy][type][value][due_in_days][{{ $i }}]" class="form-control mr-2 ">
                                                                            @foreach(dueInDaysInAcquisition() as $dueDay=>$dueDayName)
                                                                            <option value="{{ $dueDay }}" @if($model->getSalesChannelRateAndDueInDays($i,'due_in_days') == $dueDay)
                                                                                selected
                                                                                @endif

                                                                                >{{ $dueDayName }}

                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="percentage-weight visibility-hidden">%</span>
                                                                </div>
                                                                @endfor

                                                                <div class="d-flex align-items-center justify-content-center" style="margin-left:10px;margin-bottom:1rem;visibility:hidden">
                                                                    <div class="d-inline-flex align-items-center flex-column">
                                                                        <input style="width:240px;margin-left:20px" value="0" class="form-control collection_rate_total_class mr-2" readonly>
                                                                    </div>

                                                                    <span class="percentage-weight">%</span>
                                                                </div>





                                                            </div>
                                                        </div>
                                    </div>


                                </div>

                                </td>

                                @php
                                $order = $order +1 ;
                                @endphp
                                {{-- @endforeach --}}

                                </tr>
                                @php
                                $subItemIndex = $subItemIndex +1 ;
                                @endphp





                                </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 mb-4 ">
                                <label class="form-label font-weight-bold">{{ __('Equity Funding %') }} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="text" class="form-control only-percentage-allowed reclculate-equity-amount  equity-funding-percentage-text recalulate-debt-funding" value="{{  $model->getLandEquityFundingRate()   }}" step="0.1">
                                        <input type="hidden" name="land_equity_funding_rate" class="equity-funding-percentage-hidden" value="{{  $model->getLandEquityFundingRate()   }}" step="0.1">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4 ">
                                <label class="form-label font-weight-bold">{{ __('Equity Amount') }} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input readonly type="text" class="form-control equity-amount-text" name="equity_amount" value="{{  number_format($model->getEquityAmount())   }}" step="0.1">
                                        <input type="hidden" class="form-control equity-amount-hidden" name="equity_amount" value="{{  $model->getEquityAmount()   }}">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3 mb-4 ">
                                <label class="form-label font-weight-bold">{{ __('Debt Funding %') }} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input readonly type="text" class="form-control loan-form-trigger recalaculate-debt-amount recalculate-hard-debet-amount only-percentage-allowed debt-funding-input-text" value="{{  number_format($model->getDebtFundingPercentage(),1)   }}" step="0.1">
                                        <input type="hidden" class="debt-funding-input-text-hidden " value="{{  $model->getDebtFundingPercentage()   }}" step="0.1">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4 ">
                                <label class="form-label font-weight-bold">{{ __('Debt Amount') }} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input readonly type="text" class="form-control debt-amount-input-text" name="debt_amount" value="{{  number_format($model->getDebtAmount(),0)   }}" step="0.1">
                                        <input type="hidden" class="form-control debt-amount-input-hidden" name="debt_amount" value="{{  $model->getDebtAmount()   }}" step="0.1">
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-2 mb-4 ">
                                <label class="form-label font-weight-bold" style="visibility:hidden">{{ 1 }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <button class="btn active-style mx-auto" show-loan-type="{{ LAND_LOAN }}"> {{ __('Create Loan') }} </button>
                                </div>
                            </div>
                        </div> --}}


                    </div>

                    @include('loan-form',[
                    'currentSectionName'=>LAND_LOAN
                    ])


                </div>
            </div>
    </div>
</div>






<!--end::Form-->

</div>






<!--end::Form-->

</div>


</div>

<!--end::Portlet-->









{{-- start of hard construction --}}
<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Construction Cost [Hard Cost]') }} </h3>
                    <input class="can-not-be-removed-checkbox" type="checkbox" name="has_hard_construction_cost_section" value="1" style="width:20px;height:20px" checked readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".hard-cost-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row hard-cost-repeater" data-repeater-row=".hard-cost-repeater">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3">
                    <div class="row">




                        <div class="col-md-4 ">
                            <label class="form-label font-weight-bold">{{ __('Construction Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-greater-than-or-equal-zero-allowed reculate-hard-construction-contingency-rate hard-construction-cost" value="{{  number_format($model->getHardConstructionCost())  }}" step="0.1">
                                    <input name="hard_construction_cost" type="hidden" value="{{  $model->getHardConstructionCost()  }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 ">
                            <label class="form-label font-weight-bold">{{ __('Contingency Rate (%)') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed reculate-hard-construction-contingency-rate hard-construction-contingency-rate" value="{{  number_format($model->getHardConstructionContingencyRate(),1)  }}" step="0.1">
                                    <input type="hidden" name="hard_construction_contingency_rate" value="{{  $model->getHardConstructionContingencyRate()  }}" step="0.1">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 ">
                            <label class="form-label font-weight-bold">{{ __('Total Construction Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="recalculate-hard-debt-amount form-control reclaulate-hard-equity-amount total-hard-construction-cost-text" value="{{  number_format($model->getTotalHardConstructionCost(),0)  }}" step="0.1">
                                    <input  type="hidden" class="total-hard-construction-cost-hidden" value="{{  $model->getTotalHardConstructionCost()  }}" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mt-4">

                            <x-form.label :class="'label'" :id="'test-id'"> {{ __('Start Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="text" name="hard_construction_start_date" class="form-control recalc-hard-end-date hard-start-date only-month-year-picker date-input" value="{{ formatDateForInput($model->getHardConstructionStartDate($hospitalitySector) ?:  ($model->hospitalitySector ? $model->hospitalitySector->development_start_date : null))  }} " />
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
                                    <input type="numeric" name="hard_construction_duration" class="form-control hard-duration recalc-hard-end-date" value="{{ $model->getHardConstructionDuration()?:($hospitalitySector ? $hospitalitySector->development_duration : 0) }}" step="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-4">

                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Construction End Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input id="hard-construction-end-date" type="text" name="hard_construction_end_date" class="form-control" readonly value="{{ $model->getConstructionEndDate()  }}" />
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
                                    <select data-live-search="true" name="hard_execution_method" required class="form-control   form-select form-select-2 form-select-solid fw-bolder">
                                        @foreach(getHardExecutionMethod() as $value=>$name)
                                        <option value="{{ $value }}" @if(isset($model) && $model->getHardExecutionMethod() == $value ) selected @endif> {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>












                    </div>
                    @include('title',['title'=>__('Payment Terms')])

                    <div class="row installment-section">
                        <div class="col-md-2  mt-2 mb-5" >
                            <label class="form-label font-weight-bold">{{ __('Down payment %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed reclaulate-hard-balance-rate-two" value="{{  number_format($model->getHardDownPaymentPercentage(),1)   }}" step="0.1">
                                    <input type="hidden" name="hard_down_payment" class=" hard-down-payment" value="{{  $model->getHardDownPaymentPercentage()   }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2  mt-2">
                            <label class="form-label font-weight-bold">{{ __('Balance Rate One %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed reclaulate-hard-balance-rate-two" value="{{   number_format($model->getHardBalanceRateOne(),1)   }}" step="0.1">
                                    <input type="hidden" class=" hard-balance-rate-one-percentage" name="hard_balance_rate_one" value="{{  $model->getHardBalanceRateOne()   }}" step="0.1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2  mt-2 d-flex flex-column">

                            <label class="form-label font-weight-bold text-left">{{ __('Due One') }}</label>
                            <select name="hard_due_one" class="form-control mr-2 ">
                                @foreach(dueInDays() as $dueDay)
                                <option value="{{ $dueDay }}" @if($model->getHardDueOne()== $dueDay)
                                    selected
                                    @endif

                                    >{{ $dueDay }}

                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-2  mt-2">
                            <label class="form-label font-weight-bold">{{ __('Balance Rate Two %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control only-percentage-allowed hard-balance-rate-two" value="{{   number_format($model->getHardBalanceRateTwo(),1)   }}" step="0.1">
                                    <input type="hidden" class="hard-balance-rate-two-hidden" name="hard_balance_rate_two" value="{{  $model->getHardBalanceRateTwo()   }}" step="0.1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2  mt-2 d-flex flex-column">

                            <label class="form-label font-weight-bold text-left">{{ __('Due Two') }}</label>
                            <select style="width:240px !important" name="hard_due_two" class="form-control mr-2 ">
                                @foreach(dueInDays() as $dueDay)
                                <option value="{{ $dueDay }}" @if($model->getHardDueTwo()== $dueDay)
                                    selected
                                    @endif

                                    >{{ $dueDay }}

                                </option>
                                @endforeach
                            </select>

                        </div>








                    </div>

                    <div class="row">
                        <div class="col-12">
                            @include('title',['title'=>__('Funding Structure')])
                        </div>
                        <div class="col-md-3 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Equity Funding %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed recalculate-hard-debet-funding reclaulate-hard-equity-amount hard-equity-funding hard-equity-funding-input-text" value="{{  number_format($model->getHardEquityFunding(),1)   }}" step="0.1">
                                    <input type="hidden" name="hard_equity_funding" class="hard-equity-funding-input-hidden" value="{{  $model->getHardEquityFunding()   }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Equity Amount') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control equity-amount-input-text" value="{{  number_format($model->getHardEquityAmount())   }}" step="0.1">
                                    <input type="hidden" value="{{  $model->getHardEquityAmount()   }}" class="equity-amount-input-hidden">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Debt Funding') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="recalculate-hard-debt-amount form-control loan-form-trigger only-percentage-allowed hard-debt-funding-input-text" value="{{  number_format($model->getHardDebtFunding(),1)   }}" step="0.1">
                                    <input type="hidden" class="hard-debt-funding-input-hidden " value="{{  $model->getHardDebtFunding()   }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Debt Amount') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="hard-debt-amount-text form-control" value="{{  number_format($model->getHardDebtAmount())   }}" step="0.1">
                                    <input name="hard_debt_amount" class="hard-debt-amount-hidden" type="hidden" value="{{  $model->getHardDebtAmount()   }}">
                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="row collection-policy-row d-none" data-land-payment-method="customize">

                        <div class="table-responsive" data-name="per-sales-channel-collection">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 table-for-collection-policy removeGlobalStyle">

                                <tbody class="">

                                    @php
                                    $currentTotal = [];
                                    $subItemIndex=0;

                                    @endphp



                                    <tr>

                                        @php
                                        $order = 1 ;
                                        @endphp

                                        <td class="align-middle">

                                            @php
                                            $currentVal = 0 ;


                                            @endphp
                                            <div class="form-group three-dots-parent" style="
								
																	flex-direction: row !important;
																	width:100%;
																	gap: 40px !important;
																	
																	">




                                            </div>

                        </div>

                        </td>

                        @php
                        $order = $order +1 ;
                        @endphp
                        {{-- @endforeach --}}

                        </tr>
                        @php
                        $subItemIndex = $subItemIndex +1 ;
                        @endphp





                        </tbody>
                        </table>
                    </div>


                </div>




                <div class="row">
                    {{-- <div class="col-md-2 mb-4 mt-4">
                        <label class="form-label font-weight-bold" style="visibility:hidden">{{ 1 }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <button class="btn active-style create-loan-btn-js" show-loan-type="{{ HARD_COST_CONSTRUCTION }}"> {{ __('Create Loan') }} </button>
                        </div>
                    </div>
                </div> --}}


            </div>
            @php
            $currentSectionName = HARD_COST_CONSTRUCTION
            @endphp
            @include('loan-form',[
            'currentSectionName'=>$currentSectionName
            ])


        </div>
    </div>
</div>
</div>
{{-- end of hard costruction --}}














</div>

{{-- start of soft construction --}}

<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Construction Cost [Soft Cost]') }} </h3>
                    <input class="can-not-be-removed-checkbox" type="checkbox" name="has_soft_construction_cost_section" value="1" style="width:20px;height:20px" checked readonly>
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".soft-cost-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row soft-cost-repeater" data-repeater-row=".soft-cost-repeater">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3">
                    <div class="row">




							{{-- <div class="col-md-3 ">
								<label class="form-label font-weight-bold">{{ __('Name') }} </label>
								<div class="kt-input-icon">
									<div class="input-group">
										<input readonly type="text" class="form-control" value="{{ __('Name Here') }}" step="0.1">
										<input name="soft_name" type="hidden" value="">
									</div>
								</div>
							</div> --}}
							
						   <div class="col-md-4 ">
                            <label class="form-label font-weight-bold">{{ __('Soft Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-greater-than-or-equal-zero-allowed reculate-soft-construction-contingency-rate soft-construction-cost" value="{{  number_format($model->getSoftConstructionCost())  }}" step="0.1">
                                    <input name="soft_construction_cost" type="hidden" value="{{  $model->getSoftConstructionCost()  }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 ">
                            <label class="form-label font-weight-bold">{{ __('Contingency Rate (%)') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed reculate-soft-construction-contingency-rate soft-construction-contingency-rate" value="{{  number_format($model->getSoftConstructionContingencyRate(),1)  }}" step="0.1">
                                    <input type="hidden" name="soft_construction_contingency_rate" value="{{  $model->getSoftConstructionContingencyRate()  }}" step="0.1">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 ">
                            <label class="form-label font-weight-bold">{{ __('Total Soft Cost') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control total-soft-construction-cost-text" value="{{  number_format($model->getTotalSoftConstructionCost(),0)  }}" step="0.1">
                                    <input  type="hidden" class="total-soft-construction-cost-hidden" value="{{  $model->getTotalSoftConstructionCost()  }}" >
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 mt-4">

                            <x-form.label :class="'label'" :id="'test-id'"> {{ __('Start Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="text" name="soft_construction_start_date" class="form-control recalc-soft-end-date soft-start-date only-month-year-picker date-input" value="{{ formatDateForInput($model->getSoftConstructionStartDate($hospitalitySector) ?:  ($model->hospitalitySector ? $model->hospitalitySector->development_start_date : null))  }} " />
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
                                    <input type="numeric" name="soft_construction_duration" class="form-control soft-duration recalc-soft-end-date" value="{{ $model->getSoftConstructionDuration()?:($hospitalitySector ? $hospitalitySector->development_duration : 0) }}" step="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mt-4">

                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Construction End Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input id="soft-construction-end-date" type="text" name="soft_construction_end_date" class="form-control" readonly value="{{ $model->getConstructionEndDate()  }}" />
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
                                    <select data-live-search="true" name="soft_execution_method" required class="form-control   form-select form-select-2 form-select-solid fw-bolder">
                                        @foreach(getSoftExecutionMethod() as $value=>$name)
                                        <option value="{{ $value }}" @if(isset($model) && $model->getSoftExecutionMethod() == $value ) selected @endif> {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>












                    </div>
                    @include('title',['title'=>__('Payment Terms')])

                    <div class="row installment-section">
                        <div class="col-md-2  mt-2 mb-5" >
                            <label class="form-label font-weight-bold">{{ __('Down payment %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed reclaulate-soft-balance-rate-two" value="{{  number_format($model->getSoftDownPaymentPercentage(),1)   }}" step="0.1">
                                    <input type="hidden" name="soft_down_payment" class=" soft-down-payment" value="{{  $model->getSoftDownPaymentPercentage()   }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2  mt-2">
                            <label class="form-label font-weight-bold">{{ __('Balance Rate One %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control only-percentage-allowed reclaulate-soft-balance-rate-two" value="{{   number_format($model->getSoftBalanceRateOne(),1)   }}" step="0.1">
                                    <input type="hidden" class=" soft-balance-rate-one-percentage" name="soft_balance_rate_one" value="{{  $model->getSoftBalanceRateOne()   }}" step="0.1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2  mt-2 d-flex flex-column">

                            <label class="form-label font-weight-bold text-left">{{ __('Due One') }}</label>
                            <select name="soft_due_one" class="form-control mr-2 ">
                                @foreach(dueInDays() as $dueDay)
                                <option value="{{ $dueDay }}" @if($model->getSoftDueOne()== $dueDay)
                                    selected
                                    @endif

                                    >{{ $dueDay }}

                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-2  mt-2">
                            <label class="form-label font-weight-bold">{{ __('Balance Rate Two %') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input readonly type="text" class="form-control only-percentage-allowed soft-balance-rate-two" value="{{   number_format($model->getSoftBalanceRateTwo(),1)   }}" step="0.1">
                                    <input type="hidden" class="soft-balance-rate-two-hidden" name="soft_balance_rate_two" value="{{  $model->getSoftBalanceRateTwo()   }}" step="0.1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2  mt-2 d-flex flex-column">

                            <label class="form-label font-weight-bold text-left">{{ __('Due Two') }}</label>
                            <select style="width:240px !important" name="soft_due_two" class="form-control mr-2 ">
                                @foreach(dueInDays() as $dueDay)
                                <option value="{{ $dueDay }}" @if($model->getSoftDueTwo()== $dueDay)
                                    selected
                                    @endif

                                    >{{ $dueDay }}

                                </option>
                                @endforeach
                            </select>

                        </div>








                    </div>




                   


                </div>




                <div class="row">
                  

            </div>
            @php
            $currentSectionName = SOFT_COST_CONSTRUCTION
            @endphp
            


        </div>
    </div>
</div>
</div>

{{-- end of soft costruction --}}










<div class="kt-portlet">
    <div class="kt-portlet__body">
        <x-save-or-back :btn-text="__('Create')" />
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
    $(document).on('click', '[show-loan-type]', function(e) {
        e.preventDefault();
        const loanType = $(this).attr('show-loan-type')
        $('[data-loan="' + loanType + '"]').toggleClass('d-none')
    })

    $(document).on('keyup', '.pricing-calc-item', function() {
        let base_rate = $('#base_rate').val();
        let margin_rate = $('#margin_rate').val();
        if (isPercentageNumber(base_rate) && isPercentageNumber(margin_rate)) {
            let pricing = parseFloat(base_rate) + parseFloat(margin_rate);
            $('#pricing').val(pricing);
        } else if (isPercentageNumber(base_rate)) {
            let pricing = parseFloat(base_rate);
            $('#pricing').val(pricing);
        } else if (isPercentageNumber(margin_rate)) {
            let pricing = parseFloat(margin_rate);
            $('#pricing').val(pricing);
        } else {
            $('#pricing').val(0);
        }

    })

    $(document).on('change', '.land-payment-method-class', function() {
        $('[data-land-payment-method]').addClass('d-none');
        const paymentMethod = $(this).val();

        if (paymentMethod) {

            $('[data-land-payment-method="' + paymentMethod + '"]').removeClass('d-none');
        }

    })

   

    $(document).on('change', '.reclulate-land-balance-sheet', function() {
        let firstLandDownPaymentPercentage = number_unformat($('.first-land-down-payment-percentage').val());
        let secondLandDownPaymentPercentage = number_unformat($('.second-land-down-payment-percentage').val());
        let landBalanceRate = 100 - firstLandDownPaymentPercentage - secondLandDownPaymentPercentage;
        $('.land-balance-rate').val(landBalanceRate).trigger('change');
    })
    $('.reclulate-land-balance-sheet').trigger('change')
    $(document).on('change', '.reculate-hard-construction-contingency-rate', function() {
        let hardConstructionCost = number_unformat($('.hard-construction-cost').val());
        hardConstructionCost = hardConstructionCost;
        let hardConstructionContingencyRate = number_unformat($('.hard-construction-contingency-rate').val());
        hardConstructionContingencyRate = hardConstructionContingencyRate / 100;
        let totalConstructionCost = hardConstructionCost * ( 1 + hardConstructionContingencyRate);
        $('.total-hard-construction-cost-hidden').val(totalConstructionCost);
        $('.total-hard-construction-cost-text').val(number_format(totalConstructionCost,0)).trigger('change');

    })
    $('.reculate-hard-construction-contingency-rate').trigger('change')
	
	$(document).on('change', '.reculate-soft-construction-contingency-rate', function() {
        let softConstructionCost = number_unformat($('.soft-construction-cost').val());
        softConstructionCost = softConstructionCost;
        let softConstructionContingencyRate = number_unformat($('.soft-construction-contingency-rate').val());
        softConstructionContingencyRate = softConstructionContingencyRate / 100;
        let totalConstructionCost = softConstructionCost * ( 1 + softConstructionContingencyRate);
        $('.total-soft-construction-cost-hidden').val(totalConstructionCost);
        $('.total-soft-construction-cost-text').val(number_format(totalConstructionCost,0)).trigger('change');
    })
    $('.reculate-soft-construction-contingency-rate').trigger('change')
	
    $(document).on('change', '.reclaulate-hard-balance-rate-two', function() {
        let hardDownPayment = number_unformat($('.hard-down-payment').val());
        let hardBalanceRateOnePercentage = number_unformat($('.hard-balance-rate-one-percentage').val());
        let hardBalanceRateTwo = 100 - hardDownPayment - hardBalanceRateOnePercentage;
        $('.hard-balance-rate-two').val(number_format(hardBalanceRateTwo, 1)).trigger('change');
        $('.hard-balance-rate-two-hidden').val(hardBalanceRateTwo);
    })
    $('.reclaulate-hard-balance-rate-two').trigger('change')
	
	$(document).on('change', '.reclaulate-soft-balance-rate-two', function() {
        let softDownPayment = number_unformat($('.soft-down-payment').val());
        let softBalanceRateOnePercentage = number_unformat($('.soft-balance-rate-one-percentage').val());
        let softBalanceRateTwo = 100 - softDownPayment - softBalanceRateOnePercentage;
        $('.soft-balance-rate-two').val(number_format(softBalanceRateTwo, 1)).trigger('change');
        $('.soft-balance-rate-two-hidden').val(softBalanceRateTwo);
    })
    $('.reclaulate-soft-balance-rate-two').trigger('change')


    $(document).on('change', '.recalulate-debt-funding', function() {
        let equityFundingPercentage = number_unformat($('.equity-funding-percentage-hidden').val());
        let debtFunding = 100 - equityFundingPercentage;
        $('.debt-funding-input-hidden').val(debtFunding);
        $('.debt-funding-input-text').val(number_format(debtFunding, 1)).trigger('change');
    })
    $('.recalulate-debt-funding').trigger('change')



    $(document).on('change', '.reclaulate-hard-equity-amount', function() {
        let totalHardConstructionCost = number_unformat($('.total-hard-construction-cost-hidden').val());
        let hardEquityFunding = number_unformat($('.hard-equity-funding').val());
        hardEquityFunding = hardEquityFunding / 100;
        let hardEquityAmount = hardEquityFunding * totalHardConstructionCost;
        $('.equity-amount-input-text').val(number_format(hardEquityAmount)).trigger('keyup');
        $('.equity-amount-input-hidden').val(hardEquityAmount);
    })
    $('.reclaulate-hard-equity-amount').trigger('change')   
	
	
	
	 $(document).on('change', '.recalculate-hard-debt-amount', function() {
        let totalHardConstructionCost = number_unformat($('.total-hard-construction-cost-hidden').val());
        let hardDebtFunding = number_unformat($('.hard-debt-funding-input-hidden').val());
        hardDebtFunding = hardDebtFunding / 100;
        let hardDebtAmount = hardDebtFunding * totalHardConstructionCost;
	    $('.hard-debt-amount-hidden').val(hardDebtAmount);
        $('.hard-debt-amount-text').val(number_format(hardDebtAmount)).trigger('keyup');
    })
    $('.recalculate-hard-debt-amount').trigger('change')



    $(document).on('change', '.reclaulate-total-purchase-cost', function() {
        let purchaseCost = number_unformat($('.purchase-cost').val());
        let landContingencyRate = number_unformat($('.land-contingency-rate').val());
        landContingencyRate = landContingencyRate / 100;
        let landTotalPurchaseCost = (1 + landContingencyRate) * purchaseCost;
        $('.total-purchase-cost-input-text').val(number_format(landTotalPurchaseCost, 0));

        $('.total-purchase-cost-input-hidden').val(landTotalPurchaseCost);
    })
    $('.reclaulate-total-purchase-cost').trigger('change')
    $(document).on('change', '.recalculate-hard-debet-amount', function() {
        let totalPurchaseCost = number_unformat($('.total-purchase-cost-input-hidden').val());
        let hardDebtFundingPercentage = number_unformat($('.hard-debt-funding-input-text-hidden').val()) / 100;
        let hardDebtAmount = totalPurchaseCost * hardDebtFundingPercentage;
        $('.hard-debt-amount-input-hidden').val(hardDebtAmount);
        $('.hard-debt-amount-input-text').val(number_format(hardDebtAmount, 0));
    })
    $('.recalculate-hard-debet-amount').trigger('change')

    $('.land-payment-method-class').trigger('change')


    $(document).on('change', '.reclculate-equity-amount', function() {
        let totalPurchaseCost = number_unformat($('.total-purchase-cost-input-hidden').val());
        let equityFundingPercentage = number_unformat($('.equity-funding-percentage-hidden').val()) / 100;
        let equityAmount = totalPurchaseCost * equityFundingPercentage;
        $('.equity-amount-text').val(number_format(equityAmount, 1)).trigger('change');
        $('.equity-amount-hidden').val(equityAmount);
    })
    $('.reclculate-equity-amount').trigger('change')


    $(document).on('change', '.recalaculate-debt-amount', function() {
        let totalPurchaseCost = number_unformat($('.total-purchase-cost-input-hidden').val());
        let debtFunding = number_unformat($('.debt-funding-input-text-hidden').val());
        debtFunding = debtFunding / 100;
        let debtAmount = debtFunding * totalPurchaseCost;
        $('.debt-amount-input-text').val(number_format(debtAmount)).trigger('keyup');
        $('.debt-amount-input-hidden').val(debtAmount);
    })
    $('.recalaculate-debt-amount').trigger('change')

 $(document).on('change', '.recalc-hard-end-date', function(e) {
        e.preventDefault()
        const studyStartDate = new Date($('.hard-start-date').val());
        const studyDuration = parseFloat($('.hard-duration').val());
        if (studyDuration) {
            // const numberOfMonths = (studyDuration * 12) - 1
            const numberOfMonths = studyDuration
            let studyEndDate = studyStartDate.addMonths(numberOfMonths)
            studyEndDate = formatDate(studyEndDate)
            $('#hard-construction-end-date').val(studyEndDate).trigger('change')
        }

    })
	$(function(){
	$('.recalc-hard-end-date').trigger('change')
		
	})
	

 $(document).on('change', '.recalc-soft-end-date', function(e) {
        e.preventDefault()
        const studyStartDate = new Date($('.soft-start-date').val());
        const studyDuration = parseFloat($('.soft-duration').val());
        if (studyDuration) {
            const numberOfMonths = studyDuration
            let studyEndDate = studyStartDate.addMonths(numberOfMonths)
            studyEndDate = formatDate(studyEndDate)
            $('#soft-construction-end-date').val(studyEndDate).trigger('change')
        }

    })
	
		$(function(){
	$('.recalc-soft-end-date').trigger('change')
		
	})
    $(document).on('click', '.save-form', function(e) {
        e.preventDefault(); {

            let form = document.getElementById('form-id');
            var formData = new FormData(form);
            //   alert(document.body.getAttribute('data-token'))
            //	formData.append('_token',document.body.getAttribute('data-token'))
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

    $(document).on('change', '.recalc-study-end-date', function(e) {
        e.preventDefault()
        const studyStartDate = new Date($('.study-start-date').val());
        const studyDuration = parseFloat($('.study-duration option:selected').attr('value'));
        if (studyDuration) {
            const numberOfMonths = (studyDuration * 12) - 1
            let studyEndDate = studyStartDate.addMonths(numberOfMonths)
            studyEndDate = formatDate(studyEndDate)
            $('#study-end-date').val(studyEndDate).trigger('change')

        }

    })
    $(document).on('change', '.recalculate-hard-debet-funding', function(e) {
        e.preventDefault()
        let hardEquityFunding = $('.hard-equity-funding-input-hidden').val();
        hardEquityFunding = number_unformat(hardEquityFunding);
        const hardDebetFunding = (100 - hardEquityFunding);
        $('.hard-debt-funding-input-hidden').val(hardDebetFunding);
        $('.hard-debt-funding-input-text').val(number_format(hardDebetFunding, 1)).trigger('change');
    })
    $('.recalculate-hard-debet-funding').trigger('change')

    $(document).on('change', '.recalate-development-start-date', function() {
        const studyStartDate = new Date($('.study-start-date').val());
        const developementStartAfter = parseFloat($('#developement-start-after').val())
        if (developementStartAfter) {
            const developmentStartDate = formatDate(studyStartDate.addMonths(developementStartAfter))
            $('#development-start-date').val(developmentStartDate)

        }
    })

    $(document).on('change', '.recalate-operation-start-date', function() {
        const studyStartDate = new Date($('.study-start-date').val());
        const propertyWillStartAfter = parseFloat($('#property-will-start-after').val())
        if (propertyWillStartAfter) {
            const developmentStartDate = formatDate(new Date($('.study-start-date').val()).addMonths(propertyWillStartAfter))
            $('#operation-start-date').val(developmentStartDate)
        }
    })

    // 
    $(document).on('change', '.exhange-rate-recalculate', function() {
        let mainFunctionalCurrency = $('.main_functional_currency option:selected').html()
        let additionalCurrency = $('.additional-currency option:selected').html()
        if (mainFunctionalCurrency) {
            $('#exhange-rate-span-id-from').html('From ' + mainFunctionalCurrency)
        }
        if (additionalCurrency) {
            $('#exhange-rate-span-id-to').html(' To ' + additionalCurrency)
        }
    })
    $('.exhange-rate-recalculate').trigger('change')

</script>



<script>
    var type = "{{$loanType}}";

</script>

<script>
    let start_date = '';

    //on change for the borrowing rate
    $(document).on('keyup', '#borrowing_rate', function() {
        loanInterest();
    });
    //on change for the margin_interest rate
    $(document).on('keyup', '#margin_interest', function() {
        loanInterest();
    });
    //calculate loaninterest
    function loanInterest() {
        var margin_interest = +$('#margin_interest').val();
        var borrowing_rate = +$('#borrowing_rate').val();
        var total = borrowing_rate + margin_interest;
        $('#loan_interest').val(total + " % ");
    }




    //installment_interval
    function installmentIntervalChange() {

        var interval = $('#installment_interval').val();
        var select = '';
        if (interval != '') {
            $('#interest_interval option:not(:first)').remove();
            var loan_amount = +$('#loan_amount').val();
            var repayment_duration = +$('#repayment_duration').val();
            var installment_amount = 0;
            if (interval == 'monthly') {
                select = '<option value="monthly">Monthly</option>\n';

                if (loan_amount != '' && repayment_duration != '') {
                    var installment_amount = loan_amount / (repayment_duration);
                }

            } else if (interval == 'quartly') {
                select = '<option value="monthly">{{__("Monthly")}}</option>\n' +
                    '<option value="quartly">{{__("Quarterly")}}</option>\n';
                if (loan_amount != '' && repayment_duration != '') {
                    var installment_amount = loan_amount / ((repayment_duration / 12) * 4);
                }
            } else if (interval == 'semi annually') {

                select = '<option value="monthly">{{__("Monthly")}}</option>\n' +
                    '<option value="quartly">{{__("Quarterly")}}</option>\n' +
                    '<option value="semi annually">{{__("Semi-annually")}}</option>\n';

                if (loan_amount != '' && repayment_duration != '') {
                    var installment_amount = loan_amount / ((repayment_duration / 12) * 2);
                }
            }

            $('#interest_interval').append(select);
            $('#installment_amount').val(installment_amount.toFixed(2));
        }
    }

    function installmentIntervalOld(loan_interval) {
        var interval = $('#installment_interval').val();
        var select = '';
        if (interval != '') {
            if (interval == 'monthly') {

                select = '<option value="monthly" selected >{{__("Monthly")}}</option>\n';


            } else if (interval == 'quartly') {
                if (loan_interval == 'monthly') {
                    select = '<option value="monthly" selected>{{__("Monthly")}}</option>\n' +
                        '<option value="quartly" >{{__("Quarterly")}}</option>\n';
                } else {
                    select = '<option value="monthly">{{__("Monthly")}}</option>\n' +
                        '<option value="quartly" selected>{{__("Quarterly")}}</option>\n';
                }


            } else if (interval == 'semi annually') {
                if (loan_interval == 'monthly') {
                    select = '<option value="monthly" selected>{{__("Monthly")}}</option>\n' +
                        '<option value="quartly">{{__("Quarterly")}}</option>\n' +
                        '<option value="semi annually">{{__("Semi-annually")}}</option>\n';
                } else if (loan_interval == 'quartly') {
                    select = '<option value="monthly">{{__("Monthly")}}</option>\n' +
                        '<option value="quartly" selected>{{__("Quarterly")}}</option>\n' +
                        '<option value="semi annually">Semi-{{__("Annually")}}</option>\n';
                } else {
                    select = '<option value="monthly">{{__("Monthly")}}</option>\n' +
                        '<option value="quartly">{{__("Quarterly")}}</option>\n' +
                        '<option value="semi annually" selected>{{__("Semi-annually")}}</option>\n';
                }

            }

            $('#interest_interval').append(select);
        }
    }
    $(document).on('change', '#installment_interval', function() {
        installmentIntervalChange();

    });
    //Installment Amount

    function instalmentAmount() {
        var interval = $('#installment_interval').val();
        if (interval != '') {
            var loan_amount = +$('#loan_amount').val();
            var repayment_duration = +$('#repayment_duration').val();
            var installment_amount = 0;
            if (interval == 'monthly') {
                if (loan_amount != '' && repayment_duration != '') {
                    var installment_amount = loan_amount / (repayment_duration);
                }

            } else if (interval == 'quartly') {
                if (loan_amount != '' && repayment_duration != '') {
                    var installment_amount = loan_amount / ((repayment_duration / 12) * 4);
                }
            } else if (interval == 'semi annually') {
                if (loan_amount != '' && repayment_duration != '') {
                    var installment_amount = loan_amount / ((repayment_duration / 12) * 2);
                }
            }

            $('#installment_amount').val(installment_amount.toFixed(0));
        }
    }
    $(document).on('change', '#repayment_duration', function() {
        instalmentAmount();
    });
    $(document).on('change', '#loan_amount', function() {
        instalmentAmount();
    });




    $(document).on('keypress', '.number', function(e) {
        var keyCode = (e.which) ? e.which : e.keyCode;;
        /*
        8 - (backspace)
        32 - (space)
        48-57 - (0-9)Numbers
        */
        if ((keyCode != 8 || keyCode == 32) && (keyCode != 46 && keyCode > 31) && (keyCode < 48 || keyCode > 57)) {
            return false;
        }
    });

</script>


{{-- salah --}}

<script>
    $(function() {
        $(document).on('change', '.loan-form-trigger', function() {
            const value = $(this).val();
            const parent = $(this).closest('[data-repeater-row]')
            if (value > 0) {
                parent.find('[data-loan]').removeClass('d-none')
            } else {
                parent.find('[data-loan]').addClass('d-none')
            }
        })
        $('.loan-form-trigger').trigger('change')
    })

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js" type="text/javascript">

</script>


@endsection
