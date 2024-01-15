@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Quotation Pricing Calculator') }}</x-main-form-title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form id="quotation-pricing-calculator-form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($model) ? route('admin.update.quotation.pricing.calculator',[$company->id , $model->id]) : $storeRoute  }}">

            @csrf
            <input type="hidden" id="current_state_id" name="current_state_id" data-state-id="{{ isset($model) ? $model->getStateId() : 0  }}">
            <input type="hidden" id="current_service_item_id" name="current_service_item_id" data-value="{{ isset($model) ? $model->getServiceItemId() : 0  }}">
            <input type="hidden" id="current_service_category_id" name="current_service_category_id" data-value="{{ isset($model) ? $model->getServiceCategoryId() : 0  }}">
            <input type="hidden" id="name-for-calculator" name="name">
            <div class="kt-portlet">


                <div class="kt-portlet__body">

                    <h2 for="" class="d-bloxk">{{ __('Offered Service Section') }}</h2>



                    <div class="form-group row">
                        <div class="col-md-4 mb-4">

                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Date') }}</x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="text" name="date" class="form-control" readonly value="{{ isset($model) ? $model->getDate() : getCurrentDateForFormDate('date') }}" max="{{ date('m-d-Y') }}" id="kt_datepicker_3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <select id="youssef" name="sector" class="form-control ng-valid ng-scope ng-touched ng-not-empty ng-dirty ng-valid-parse" ng-model="vm.search.sector" ng-options="sector as sector.sector_Name for sector in vm.sectors track by sector.sector_Id" ng-change="vm.onSectorChanged()" style=""><option value="" ng-show="!vm.sectorsLoading" class="" style="">All Sectors</option><option label="Accounting" value="2" selected="selected">Accounting</option><option label="Agriculture" value="4">Agriculture</option><option label="Automotive" value="5">Automotive</option><option label="Building Materials" value="6">Building Materials</option><option label="Chemical Products" value="7">Chemical Products</option><option label="Construction Engineering Services" value="8">Construction Engineering Services</option><option label="Consultancy" value="9">Consultancy</option><option label="Defense" value="11">Defense</option><option label="Diplomatic Missions" value="31">Diplomatic Missions</option><option label="Education/Research and Professional Development" value="1">Education/Research and Professional Development</option><option label="Environment" value="13">Environment</option><option label="Financial Sector" value="14">Financial Sector</option><option label="Food &amp; Beverages" value="15">Food &amp; Beverages</option><option label="Furniture, Wooden, Metallic &amp; Accessories" value="16">Furniture, Wooden, Metallic &amp; Accessories</option><option label="Healthcare" value="39">Healthcare</option><option label="Hospitality/Tourism/Travel" value="29">Hospitality/Tourism/Travel</option><option label="Human Resources" value="17">Human Resources</option><option label="Industrial Machinery" value="21">Industrial Machinery</option><option label="Information &amp; Communication Technology" value="18">Information &amp; Communication Technology</option><option label="Insurance" value="32">Insurance</option><option label="Investment" value="33">Investment</option><option label="Legal Services" value="20">Legal Services</option><option label="Marketing, Advertising Services" value="40">Marketing, Advertising Services</option><option label="Media Services (Print, Broadcast and Online)" value="41">Media Services (Print, Broadcast and Online)</option><option label="Mining/Minerals and Precious Metals" value="22">Mining/Minerals and Precious Metals</option><option label="Non-Banking Financial Services" value="42">Non-Banking Financial Services</option><option label="Non-Governmental Organizations (NGOs)" value="35">Non-Governmental Organizations (NGOs)</option><option label="Paper/Printing/Publishing &amp; Packaging" value="23">Paper/Printing/Publishing &amp; Packaging</option><option label="Petroleum" value="24">Petroleum</option><option label="Pharmaceuticals" value="25">Pharmaceuticals</option><option label="Power and Renewable Energy Services" value="12">Power and Renewable Energy Services</option><option label="Public &amp; Governmental Organizations" value="36">Public &amp; Governmental Organizations</option><option label="Real Estate" value="26">Real Estate</option><option label="Retail" value="37">Retail</option><option label="Security Systems (Alarms, Fire Fighting, Video Cameras, etc.)" value="27">Security Systems (Alarms, Fire Fighting, Video Cameras, etc.)</option><option label="Service Providers" value="34">Service Providers</option><option label="Tanneries Leather &amp; Footwear" value="19">Tanneries Leather &amp; Footwear</option><option label="Textiles" value="28">Textiles</option><option label="Transportation" value="30">Transportation</option><option label="Utilities" value="43">Utilities</option></select> --}}
                        <div class="col-md-4 mb-4">
                            <x-form.select :is-select2="true" :options="$customersAndLeads" :add-new="true" :add-new-text="__('Add New Lead')" :add-with-popup="true" :add-model-name="'Customer'" :add-modal-title="__('Add New Customer / Lead')" :append-new-option-to-select-selector="'#'.$type.'_customer_id'" :add-new-with-form-popup-class="'add-customers-and-leads-form'" :label="__('Customer / Lead')" class="add-with-form-select" data-filter-type="{{ $type }}" :all="false" name="customer_id" id="{{$type.'_'.'customer_id' }}" :selected-value="isset($model) ? $model->getCustomerId() : 0"></x-form.select>
                        </div>

                        <div class="col-md-4 mb-4">
                            <x-form.select :is-select2="true" :options="[]" :add-new="true" :add-new-text="__('Add New Business Sector')" :add-with-popup="true" :add-model-name="'BusinessSector'" :add-modal-title="__('Add New Business Sector')" :append-new-option-to-select-selector="'#'.$type.'_business_sector_id'" :add-new-with-form-popup-class="'add-business-sectors-form'" :label="__('Business Sector')" class="add-with-form-select business-sector-class" data-filter-type="{{ $type }}" name="business_sector_id" :all="false" id="{{$type.'_business_sector_id' }}" :selected-value="isset($model) ? $model->getBusinessSectorId() : 0"></x-form.select>
                        </div>

                        {{-- <div class="col-md-4 mb-4">
                                                <x-form.select :is-select2="true" :options="[]" :add-new="false"   :label="__('Business Sector')" class="" data-filter-type="{{ $type }}" :all="false" name="business_sector_id" id="{{$type.'_'.'business_sector_id' }}" :selected-value="isset($model) ? $model->getBusinessSectorId() : 0" ></x-form.select>
                    </div> --}}

                    <x-helpers.repeater :repeater-with-select2="true" :item-classes="'w-full'" :instance-no="'1'" :group-name="'services'" class="w-full d-none repeater-with-select2">
                        <x-form.row class="col-md-12">
                            <x-form.wrapper class="col-lg-2 col-md-4">
                                <x-form.select :options="$revenueBusinessLines" :add-new="false" :label="__('Revenue Business Line')" :is-select2="false" class="repeater-select revenue_business_line_class  " data-filter-type="{{ $type }}" :all="false" name="revenue_business_line_id" :selected-value="isset($model) ? $model->getRevenueBusinessLineId() : 0"></x-form.select>
                            </x-form.wrapper>
                            <x-form.wrapper class="col-lg-3 col-md-4 mb-4">
                                <x-form.select :is-select2="false" :options="$serviceCategories" :add-new="false" :label="__('Service Category')" class="repeater-select service_category_class  " data-filter-type="{{ $type }}" :all="false" name="service_category_id" :selected-value="isset($model) ? $model->getServiceCategoryId() : 0"></x-form.select>
                            </x-form.wrapper>

                            <x-form.wrapper class="col-lg-3 col-md-4 mb-4">
                                <x-form.select :options="$serviceItems" :add-new="false" :label="__('Service Item')" :is-select2="false" class="repeater-select service_item_class  main-service-item" data-filter-type="{{ $type }}" :all="false" name="service_item_id" :selected-value="isset($model) ? $model->getServiceItemId() : 0"></x-form.select>
                            </x-form.wrapper>

                            <x-form.wrapper class="col-lg-2 col-md-4 ">
                                <x-form.select :options="$serviceNatures" :add-new="false" :label="__('Service Nature')" :is-select2="false" class="repeater-select" data-filter-type="{{ $type }}" :all="false" name="service_nature_id" id="{{$type.'_'.'service_nature_id' }}" :selected-value="isset($model) ? $model->getServiceNatureId() : 0"></x-form.select>
                            </x-form.wrapper>
                            <x-form.wrapper class="col-lg-2 col-md-4">
                                <label>{{ __('Delivery Days') }} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input id="delivery-days" type="number" class="form-control only-greater-than-zero-allowed" name="delivery_days" value="{{ isset($model) ? $model->getDeliveryDays() : old('delivery_days') }}" step="any">
                                    </div>
                                </div>
                            </x-form.wrapper>

                        </x-form.row>
                    </x-helpers.repeater>




                    <div class="col-md-4 mb-4">
                        <label>{{ __('Select Country') }} </label>
                        <div class="kt-input-icon">
                            <div class="input-group ">
                                <select id="country_id" data-live-search="true" name="country_id" required class="form-control  form-select form-select-2 form-select-solid fw-bolder">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach(getCountries() as $value=>$name)
                                    <option value="{{ $value }}" @if(isset($model) && $model->getCountryId() == $value ) selected @endif> {{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label>{{ __('Select state') }} </label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <select id="state_id" data-live-search="true" name="state_id" required class="form-control  form-select form-select-2 form-select-solid fw-bolder">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach([] as $value=>$name)
                                    <option value="{{ $value }}" @if(isset($model) && $model->getStateId() == $value ) selected @endif>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <x-form.select :is-select2="false" :options="$currencies" :add-new="false" :label="__('Currency')" class="" data-filter-type="{{ $type }}" :all="false" name="currency_id" id="{{$type.'_'.'currency_id' }}" :selected-value="isset($model) ? $model->getCurrencyId() : 0"></x-form.select>
                    </div>


                    <br>
                    <hr>

                </div>
            </div>
    </div>
    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">

                <div class="col-md-12">
                    <h2 for="" class="d-bloxk">{{ __('Direct Manpower Expenses') }}</h2>
                    <div id="m_repeater_2">
                        <div class="form-group  m-form__group row">
                            <div data-repeater-list="manpower_expenses" class="col-lg-12">
                                <div data-repeater-item class="form-group m-form__group row align-items-center repeater_item">
                                    @if(isset($model) && $model->directManpowerExpenses->count() )
                                    @foreach($model->directManpowerExpenses as $directManpowerExpense)
                                    @include('admin.quotation-pricing-calculator.form.direct-manpower-expenses' , [
                                    'positions'=>$positions ,
                                    'directManpowerExpense'=>$directManpowerExpense
                                    ])
                                    @endforeach
                                    @else
                                    @include('admin.quotation-pricing-calculator.form.direct-manpower-expenses' , [
                                    'positions'=>$positions
                                    ])

                                    @endif





                                    <div class="">
                                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">

                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group form-group row">


                            <div class="col-lg-6">
                                <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide {{__('right')}}" id="add-row">
                                    <span>
                                        <i class="fa fa-plus"> </i>
                                        <span>
                                            {{ __('Add') }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <hr>
                    <h4 class="h4 mb-4"> {{ __('Other Variable Direct Manpower Expense') }} </h4>

                </div>
                @if(isset($model) && $model->otherVariableManpowerExpenses->count())
                @foreach($model->otherVariableManpowerExpenses as $otherVariableManpowerExpense)
                @include('admin.quotation-pricing-calculator.form.other-variable-manpower-expense',[
                'otherVariableManpowerExpense'=>$otherVariableManpowerExpense
                ])
                @endforeach
                @else
                @include('admin.quotation-pricing-calculator.form.other-variable-manpower-expense')

                @endif
            </div>

        </div>

    </div>

    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">

                <div class="col-md-12">
                    <h2 for="" class="d-bloxk">{{ __('Freelancers Expenses') }}</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-6">

                                <div class="form-group">
                                    <div class="kt-radio-inline">
                                        <label class="mr-3">
                                            {{ __('Do You Use Freelancer') }}
                                        </label>

                                        <label class="kt-radio kt-radio--success ">
                                            <input type="radio" value="1" name="use_freelancer" class="use-freelancer" @if(isset($model) && $model->isUseFreelancer()) checked @endisset> {{ __('Yes') }}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--danger ">
                                            <input type="radio" value="0" name="use_freelancer" class="use-freelancer" @if(!isset($model) || !$model->isUseFreelancer()) checked @endisset> {{ __('No') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div id="m_repeater_3" class="use-freelancer-repeater">
                        <div class="form-group  m-form__group row">
                            <div data-repeater-list="freelancer_expenses" class="col-lg-12">
                                <div data-repeater-item class="form-group m-form__group row align-items-center repeater_item">
                                    @if(isset($model) && $model->freelancerExpenses->count() )
                                    @foreach($model->freelancerExpenses as $freelancerExpense)
                                    @include('admin.quotation-pricing-calculator.form.freelancer-expense' , [
                                    'positions'=>$positions ,
                                    'freelancerExpense'=>$freelancerExpense
                                    ])
                                    @endforeach
                                    @else
                                    @include('admin.quotation-pricing-calculator.form.freelancer-expense' , [
                                    'positions'=>$positions
                                    ])

                                    @endif





                                    <div class="">
                                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">

                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-form__group form-group row">

                            <div class="col-lg-6">
                                <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide {{__('right')}}" id="add-row">
                                    <span>
                                        <i class="fa fa-plus"> </i>
                                        <span>
                                            {{ __('Add') }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">

                <div class="col-12">
                    <h2 class="h2 mb-4"> {{ __('Other Direct Operations Expenses') }} </h2>
                    <hr>
                </div>
                <x-helpers.repeater :repeater-with-select2="true" :item-classes="'w-full'" :instance-no="'5'" :group-name="'other_direct_opertaion_expenses'" class="w-full repeater-with-select2">



                    @if(isset($model) && $model->otherDirectOperationExpenses->count())
                    @foreach($model->otherDirectOperationExpenses as $otherDirectOperationExpense)
                    @include('admin.quotation-pricing-calculator.form.other-direct-operations-expenses',[
                    'otherDirectOperationExpense'=>$otherDirectOperationExpense
                    ])
                    @endforeach
                    @else
                    @include('admin.quotation-pricing-calculator.form.other-direct-operations-expenses')

                    @endif
                </x-helpers.repeater>






            </div>

        </div>

    </div>


    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">

                <div class="col-12">
                    <h2 class="h2 mb-4"> {{ __('Sales Commission Expenses') }} </h2>
                    <hr>
                </div>
                <x-helpers.repeater :repeater-with-select2="true" :item-classes="'w-full'" :instance-no="'6'" :group-name="'sales_commission_expenses'" class="w-full repeater-with-select2">

                    @if(isset($model) && $model->otherDirectOperationExpenses->count())
                    @foreach($model->otherDirectOperationExpenses as $otherDirectOperationExpense)
                    @include('admin.quotation-pricing-calculator.form.sales-commission-expenses',[
                    'otherDirectOperationExpense'=>$otherDirectOperationExpense
                    ])
                    @endforeach
                    @else
                    @include('admin.quotation-pricing-calculator.form.sales-commission-expenses')

                    @endif
                </x-helpers.repeater>






            </div>

        </div>

    </div>




    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">

                <div class="col-12">
                    <h2 class="h2 mb-4"> {{ __('Other Sales & Marketing Expenses') }} </h2>
                    <hr>
                </div>

                @if(isset($model) && $model->salesAndMarketingExpenses->count())
                @foreach($model->salesAndMarketingExpenses as $salesAndMarketingExpense)
                @include('admin.quotation-pricing-calculator.form.sales-and-marketing-expenses',[
                'salesAndMarketingExpense'=>$salesAndMarketingExpense
                ])
                @endforeach
                @else
                @include('admin.quotation-pricing-calculator.form.sales-and-marketing-expenses')

                @endif

            </div>

        </div>

    </div>


    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">


                <div class="col-12">
                    <h2 class="h2 mb-4"> {{ __('General & Administrative Expenses') }} </h2>
                    <hr>
                </div>



                @if(isset($model) && $model->generalExpenses->count())
                @foreach($model->generalExpenses as $generalExpense)
                @include('admin.quotation-pricing-calculator.form.general-expenses',[
                'generalExpense'=>$generalExpense
                ])
                @endforeach
                @else
                @include('admin.quotation-pricing-calculator.form.general-expenses')

                @endif







            </div>

        </div>

    </div>













    <div class="kt-portlet">


        <div class="kt-portlet__body">

            <div class="form-group row">
                <div class="col-12">
                    <h2 class="h2 mb-4"> {{ __('Profitability Section') }} </h2>
                    <hr>
                </div>


                @if(isset($model) && $model->profitability)
                {{-- @foreach($model->generalExpenses as $generalExpense)     --}}
                @include('admin.quotation-pricing-calculator.form.profitability',[
                'profitability'=>$model->profitability
                ])
                {{-- @endforeach  --}}
                @else
                @include('admin.quotation-pricing-calculator.form.profitability')

                @endif









            </div>

        </div>

    </div>




    <x-calculate-btn />



    <!--end::Form-->

    <!--end::Portlet-->
</div>

<div class="col-md-12">


    <div class="kt-portlet">


        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-12">
                    <h2>{{ __('Recommended Calculated Pricing & Profitability') }}</h2>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('Total Recommend Price Without VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="total-recommend-price-without-vat" readonly class="form-control disabled-custom text-center" name="total_recommend_price_without_vat" value="{{ isset($model) ? $model->getTotalRecommendPriceWithoutVat() : old('total_recommend_price_without_vat') }}" step="any">
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <label>{{ __('Total Recommend Price With VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="total-recommend-price-with-vat" readonly class="form-control disabled-custom text-center" name="total_recommend_price_with_vat" value="{{ isset($model) ? $model->getTotalRecommendPriceWithVat() : old('total_recommend_price_with_vat') }}" step="any">
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <label>{{ __('Price Per Day Without VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="price-per-day-without-vat" readonly class="form-control disabled-custom text-center" name="price_per_day_without_vat" value="{{ isset($model) ? $model->getPricePerDayWithoutVat() : old('price_per_day_without_vat') }}" step="any">
                        </div>
                    </div>

                </div>




                <div class="col-md-3">
                    <label>{{ __('Price Per Day With VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="price-per-day-with-vat" readonly class="form-control disabled-custom text-center" name="price_per_day_with_vat" value="{{ isset($model) ? $model->getPricePerDayWithVat() : old('price_per_day_with_vat') }}" step="any">
                        </div>
                    </div>

                </div>


                <div class="col-md-6 mt-4">
                    <label>{{ __('Total Net Profit After Taxes') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="total-net-profit-after-taxes" readonly class="form-control disabled-custom text-center" name="total_net_profit_after_taxes" value="{{ isset($model) ? $model->getTotalNetProfitAfterTaxes() : old('total_net_profit_after_taxes') }}" step="any">
                        </div>
                    </div>

                </div>





                <div class="col-md-6 mt-4">
                    <label>{{ __('Net Profit After Taxes Per Day') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="net-profit-after-taxes-per-day" readonly class="form-control disabled-custom text-center" name="net_profit_after_taxes_per_day" value="{{ isset($model) ? $model->getNetProfitAfterTaxesPerDay() : old('net_profit_after_taxes_per_day') }}" step="any">
                        </div>
                    </div>

                </div>






            </div>
        </div>

    </div>



    <div class="kt-portlet">


        <div class="kt-portlet__body">
            <div class="row ">
                <div class="col-12">
                    <h2>{{ __('Sensitivity Section') }}</h2>
                    <hr>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <label>{{ __('Apply Price Sensitivity (+/- %) ') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="price-sensitiviy" name="price_sensitivity" class="form-control only-percentage-allowed-between-minus-plus-hundred " name="price_sensitiviy" value="{{ isset($model) ? $model->getPriceSensitivity() : old('price_sensitiviy') }}" step="any">
                        </div>
                    </div>

                </div>

            </div>


            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('Total Sensitive Price Without VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="total-sensitive-price-without-vat" readonly class="form-control disabled-custom text-center" name="total_sensitive_price_without_vat" value="{{ isset($model) ? $model->getTotalSensitivePriceWithoutVat() : old('total_sensitive_price_without_vat') }}" step="any">
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <label>{{ __('Total Sensitive Price With VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="total-sensitive-price-with-vat" readonly class="form-control disabled-custom text-center" name="total_sensitive_price_with_vat" value="{{ isset($model) ? $model->getTotalSensitivePriceWithVat() : old('total_sensitive_price_with_vat') }}" step="any">
                        </div>
                    </div>

                </div>
                <div class="col-md-3">
                    <label>{{ __('Sensitive Price Per Day Without VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="sensitive-price-per-day-without-vat" readonly class="form-control disabled-custom text-center" name="sensitive_price_per_day_without_vat" value="{{ isset($model) ? $model->getSensitivePricePerDayWithoutVat() : old('sensitive_price_per_day_without_vat') }}" step="any">
                        </div>
                    </div>

                </div>




                <div class="col-md-3">
                    <label>{{ __('Sensitive Price Per Day With VAT') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="sensitive-price-per-day-with-vat" readonly class="form-control disabled-custom text-center" name="sensitive_price_per_day_with_vat" value="{{ isset($model) ? $model->getSensitivePricePerDayWithVat() : old('sensitive_price_per_day_with_vat') }}" step="any">
                        </div>
                    </div>

                </div>


                <div class="col-md-4 mt-4">
                    <label>{{ __('Sensitive Total Net Profit After Taxes') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="sensitive-total-net-profit-after-taxes" readonly class="form-control disabled-custom text-center" name="sensitive_total_net_profit_after_taxes" value="{{ isset($model) ? $model->getSensitiveTotalNetProfitAfterTaxes() : old('sensitive_total_net_profit_after_taxes') }}" step="any">
                        </div>
                    </div>

                </div>







                <div class="col-md-4 mt-4">
                    <label>{{ __('Sensitive Net Profit After Taxes Per Day') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="sensitive-net-profit-after-taxes-per-day" readonly class="form-control disabled-custom text-center" name="sensitive_net_profit_after_taxes_per_day" value="{{ isset($model) ? $model->getSensitiveNetProfitAfterTaxesPerDay() : old('sensitive_net_profit_after_taxes_per_day') }}" step="any">
                        </div>
                    </div>

                </div>


                <div class="col-md-4 mt-4">
                    <label>{{ __('Sensitive Net Profit After Taxes %') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input id="sensitive-net-profit-after-taxes-percentage" readonly class="form-control disabled-custom text-center" name="sensitive_net_profit_after_taxes_percentage" value="{{ isset($model) ? $model->getSensitiveNetProfitAfterTaxesPercentage() : old('sensitive_net_profit_after_taxes_percentage') }}" step="any">
                        </div>
                    </div>

                </div>





            </div>


        </div>
        <x-calculate-btn />
    </div>

    </form>


    <x-form.bs-modal :id="'enter-name'" :modalTitle="__('Quotation Pricing Calculator Name')" :hasSaveBtn="true" :saveBtnTitle="__('Save')" :submitBtnClass="'save-calc-btn submit-form-btn-new'">
        <input type="text" class="form-control" id="calculator-name">
    </x-form.bs-modal>


</div>
@endsection
@section('js')
<x-js.commons></x-js.commons>



<script>
    $(document).on('keyup', '.total-cost-calculations-class', function() {
        let index = $(this).closest("[data-repeater-item]").index();
        let workingDays = parseFloat($('[name="manpower_expenses[' + index + '][manpower_expense_working_days]"]').val());
        let costPerDay = parseFloat($('[name="manpower_expenses[' + index + '][manpower_expense_cost_per_day]"]').val());
        let totalCost = parseFloat(costPerDay * workingDays);
        $('[name="manpower_expenses[' + index + '][manpower_expense_total_cost]"]').val(number_format(totalCost, 0));

    });
    $(document).on('change', '.use-freelancer', function() {
        let useFreelancer = +$(this).val();
        if (useFreelancer) {
            $('.use-freelancer-repeater').fadeIn(300)
        } else {
            $('.use-freelancer-repeater').fadeOut(300);
            $('input[name*="freelancer_expenses"]').val(0);
        }
    });

</script>

<script>
    $(document).on('keyup', '.mp-total-cost-class', function() {
        let mpCostPerUnit = parseFloat($('[name="mp_cost_per_unit"]').val());
        let mpUnitsCount = parseFloat($('[name="mp_units_count"]').val());
        let totalCost = parseFloat(mpCostPerUnit * mpUnitsCount);
        $('[name="mp_total_cost"]').val(number_format(totalCost, 0));
    });


    $(document).on('keyup', '.direct-opex-total-cost-class', function() {
        let directOpexCostPerUnit = parseFloat($('[name="direct_opex_cost_per_unit"]').val());
        directOpexCostPerUnit = directOpexCostPerUnit ? directOpexCostPerUnit : 0;
        let directOpexUnitsCount = parseFloat($('[name="direct_opex_units_count"]').val());
        directOpexUnitsCount = directOpexUnitsCount ? directOpexUnitsCount : 0;
        let totalCost = parseFloat(directOpexCostPerUnit * directOpexUnitsCount);
        $('[name="direct_opex_total_cost"]').val(number_format(totalCost, 0));
    });

    $(document).on('keyup', '.smex-total-cost-class', function() {
        let SalesAndMarketingCostPerUnit = parseFloat($('[name="smex_cost_per_unit"]').val());
        SalesAndMarketingCostPerUnit = SalesAndMarketingCostPerUnit ? SalesAndMarketingCostPerUnit : 0;
        let SalesAndMarketingUnitsCount = parseFloat($('[name="smex_units_count"]').val());
        SalesAndMarketingUnitsCount = SalesAndMarketingUnitsCount ? SalesAndMarketingUnitsCount : 0;
        let totalCost = parseFloat(SalesAndMarketingCostPerUnit * SalesAndMarketingUnitsCount);
        $('[name="smex_total_cost"]').val(number_format(totalCost, 0));
    });

    $(document).on('keyup', '.gaex-total-cost-class', function() {
        let GeneralCostPerUnit = parseFloat($('[name="gaex_cost_per_unit"]').val());
        GeneralCostPerUnit = GeneralCostPerUnit ? GeneralCostPerUnit : 0;
        let GeneralUnitsCount = parseFloat($('[name="gaex_units_count"]').val());
        GeneralUnitsCount = GeneralUnitsCount ? GeneralUnitsCount : 0;
        let totalCost = parseFloat(GeneralCostPerUnit * GeneralUnitsCount);
        $('[name="gaex_total_cost"]').val(number_format(totalCost, 0));
    });

    $(document).on('keyup', '.freelancer-total-cost-calculations-class', function() {
        let index = $(this).closest("[data-repeater-item]").index();

        let workingDays = parseFloat($('[name="freelancer_expenses[' + index + '][freelancer_working_days]"]').val());
        let costPerDay = parseFloat($('[name="freelancer_expenses[' + index + '][freelancer_cost_per_day]"]').val());
        workingDays = workingDays ? workingDays : 0;
        costPerDay = costPerDay ? costPerDay : 0;
        let totalCost = parseFloat(costPerDay * workingDays);
        $('[name="freelancer_expenses[' + index + '][freelancer_total_cost]"]').val(number_format(totalCost, 0));
    });

    function calculateDirectManpower() {
        $('data-repeater-list="manpower_expenses"');
    }
    $(document).on('click', '.calculate-class', function(e) {
        calculateDirectManpower();
        e.preventDefault();
        totalPercentage = 0;
        $('.percentage-summation').each(function(index, field) {
            val = $(field).val();

            if (val && val != undefined) {
                totalPercentage += parseFloat(val);
            }

        });
        totalPercentage = totalPercentage / 100; /////////1 
        totalPercentage = totalPercentage ? totalPercentage : 0;
        corporateTaxes = parseFloat($('#corporate_taxes_percentage').val()) / 100;
        corporateTaxes = corporateTaxes ? corporateTaxes : 0;
        var netProfitPercentage = parseFloat($('#net_profit_after_taxes_percentage').val()) / 100;
        netProfitPercentage = netProfitPercentage ? netProfitPercentage : 0;
        ebt = (netProfitPercentage) / (1 - corporateTaxes);
        var grantTotalPercentage = ebt + totalPercentage;
        var totalCost = 0;

        $('.total-cost-summation').each(function(index, field) {
            val = parseFloat($(field).val().replace(/,/g, ''));
            if (val && val != undefined) {
                totalCost += parseFloat(val);
            }
        });
        var vatPercentage = parseFloat($('#vat-percentage').val()) / 100;
        vatPercentage = vatPercentage ? vatPercentage : 0;
        var recommendPrice = totalCost / (1 - grantTotalPercentage);
        var deliver_days = parseFloat($('#delivery-days').val());
        deliver_days = deliver_days ? deliver_days : 1;
        $('#total-recommend-price-without-vat').val(number_format(recommendPrice, 0));
        var totalRecommendPriceWithVat = recommendPrice * (1 + vatPercentage);
        $('#total-recommend-price-with-vat').val(number_format(totalRecommendPriceWithVat, 0));
        var pricePerDayWithoutVat = 0;
        if (deliver_days) {
            pricePerDayWithoutVat = recommendPrice / (deliver_days);
            $('#price-per-day-without-vat').val(number_format(pricePerDayWithoutVat, 0));
        } else {
            $('#price-per-day-without-vat').val(0);

        }
        var pricePerDayWithVat = pricePerDayWithoutVat * (1 + vatPercentage);
        $('#price-per-day-with-vat').val(number_format(pricePerDayWithVat, 0));
        let TotalNetProfitAfterTax = recommendPrice * netProfitPercentage;
        $('#total-net-profit-after-taxes').val(number_format(TotalNetProfitAfterTax, 0));
        var netProfitAfterTaxesPerDay = deliver_days ? TotalNetProfitAfterTax / deliver_days : 0;
        $('#net-profit-after-taxes-per-day').val(number_format(netProfitAfterTaxesPerDay, 0));

        let priceSensitive = parseFloat($('#price-sensitiviy').val()) / 100;
        priceSensitive = priceSensitive ? priceSensitive : 0;
        let totalSensitivePriceWithoutVat = recommendPrice * (1 + priceSensitive);
        $('#total-sensitive-price-without-vat').val(number_format(totalSensitivePriceWithoutVat, 0));

        $('#total-sensitive-price-with-vat').val(number_format(totalRecommendPriceWithVat * (1 + priceSensitive), 0));
        var sensitivePricePerDayWithoutVat = pricePerDayWithoutVat * (1 + priceSensitive);
        $('#sensitive-price-per-day-without-vat').val(number_format(sensitivePricePerDayWithoutVat, 0));

        var sensitivePricePerDayWithVat = pricePerDayWithVat * (1 + priceSensitive);
        $('#sensitive-price-per-day-with-vat').val(number_format(sensitivePricePerDayWithVat, 0));

        let sensitiveTotalNetProfitAfterTaxes = (totalSensitivePriceWithoutVat - (totalSensitivePriceWithoutVat * totalPercentage) - totalCost) * (1 - corporateTaxes);

        $('#sensitive-total-net-profit-after-taxes').val(number_format(sensitiveTotalNetProfitAfterTaxes, 0));

        var sensitiveNetProfitAfterTaxesPerDay = deliver_days ? sensitiveTotalNetProfitAfterTaxes / deliver_days : 0;
        $('#sensitive-net-profit-after-taxes-per-day').val(number_format(sensitiveNetProfitAfterTaxesPerDay, 0));
        var sensitiveNetProfitAfterTaxesPercentage = totalSensitivePriceWithoutVat ? sensitiveTotalNetProfitAfterTaxes / totalSensitivePriceWithoutVat * 100 : 0;
        $('#sensitive-net-profit-after-taxes-percentage').val(number_format(sensitiveNetProfitAfterTaxesPercentage, 2) + ' %');

        if ($(this).hasClass('calculate-and-save')) {
            $('#enter-name').modal('show');
        }

    });

</script>
<script>
    $('.use-freelancer:checked').trigger('change');

</script>
<script>
    $(function() {
        $(document).on('click', '[data-repeater-create]', function() {
            // reinitializeSelect2();
            // $('select.select2-select').selectpicker('destroy');
            $('select.select2-select').selectpicker('refresh');
        });
    })

</script>
<script>
    $(document).on('change', 'select:visible.main-service-item', function() {
        let options = "";
        let uniqueOptions = [];

        console.log($('select:visible.main-service-item'));

        $('select.main-service-item:visible option:selected').each(function(index, item) {
            if (index == 0) {
                option = '<option value="">{{ __("All") }}</option>';
                options = options + option;
            }
            if (!uniqueOptions.includes(item.value)) {
                option = '<option value="' + item.value + '"> ' + item.innerHTML.replace(/^\s+|\s+$/gm, '') + '</option>';
                options = options + option;
                uniqueOptions.push(item.value);
            }

        });
        $('select.service-item-class-append').empty().append(options).selectpicker('refresh').trigger('change');

    });
    // $('.main-service-item').o

</script>


<script>
    $(document).on('click', '.save-calc-btn', function() {
        const name = $('#calculator-name').val();
        if (name) {
            $('#name-for-calculator').val(name);
            let form = document.getElementById('quotation-pricing-calculator-form-id');
            var formData = new FormData(form);
            $('.submit-form-btn-new').prop('disabled', true);
            $.ajax({
                cache: false
                , contentType: false
                , processData: false
                , url: form.getAttribute('action')
                , data: formData
                , type: form.getAttribute('method')
                , success: function(res) {
                    $('.submit-form-btn-new').prop('disabled', false)

                    Swal.fire({
                        icon: 'success'
                        , title: res.message,

                    });

                    window.location.href = "{{ $redirectAfterSubmitRoute }}"



                }
                , complete: function() {
                    $('#enter-name').modal('hide');
                    $('#name-for-calculator').val('');

                }
                , error: function(res) {
                    $('.submit-form-btn-new').prop('disabled', false);
                    const firstError = Object.keys(res.responseJSON.errors)[0];
                    Swal.fire({
                        icon: 'error'
                        , title: res.responseJSON.errors[firstError][0]
                    , });
                }
            });
        } else {
            alert('{{ __("Please Enter Calculator Name") }}')
        }
    })

</script>

<script>
    $(function() {
        $('[data-repeater-item]  input:not(:visible) , [data-repeater-item]  select:not(:visible)').prop('disabled', true);
    })
    // let options = '['
    // $('#youssef option').each(function(index,option){
    //     // console.log();
    //     options += ($(option).html() + ',') 
    // });
    // options = options.trim(',');
    // options += ']';
    // console.log(options)

</script>
@endsection
