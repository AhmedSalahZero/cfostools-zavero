@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
<style>
    .ui-datepicker-calendar {
        display: none;
    }

</style>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Hospitality Sector Feasibilities & Multi-years Financial Plan Table') }}</x-main-form-title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($disabled) && $disabled ? '#' : (isset($model) ? route('admin.update.hospitality.sector',[$company->id , $model->id]) : $storeRoute)  }}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">


            <div class="kt-portlet">


                <div class="kt-portlet__body">

                    <h2 for="" class="d-block">{{ __('Study Main Information') }}</h2>



                    <div class="form-group row">

                        <div class="col-md-12 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Study Name') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="{{ __('Please Enter Study Name') }}" name="study_name" value="{{ isset($hospitalitySector) ? $hospitalitySector->getStudyName() : null }}" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-2">
                            <label class="form-label font-weight-bold">{{ __('Property Name') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input placeholder="{{ __('Please Enter Property Name') }}" type="text" class="form-control" name="property_name" value="{{ isset($hospitalitySector) ? $hospitalitySector->getPropertyName() : null }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 mb-4">
                            <x-form.select :options="[
																		'existing'=>['title'=>'Existing','value'=>'existing'],
																		'existing_need_rufurbishing'=>['title'=>'Existing Need Rufurbishing','value'=>'existing_need_rufurbishing'],
																		'under_development'=>['title'=>'Under Development / Construction','value'=>'under_development']
																	  ]" :add-new="false" :is-required="true" :label="__('Property Status')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="property_status" id="{{$type.'_'.'property_status' }}" :selected-value="isset($model) ? $model->getPropertyStatus() : 0"></x-form.select>
                        </div>



                        <div class="col-md-4 mb-4">
                            <x-form.select :options="[
																		1=>['title'=>1,'value'=>1],
																		2=>['title'=>2,'value'=>2],
																		3=>['title'=>3,'value'=>3],
																		4=>['title'=>4,'value'=>4],
																		5=>['title'=>5,'value'=>5],
																		7=>['title'=>7,'value'=>7],
																	  
																	  ]" :add-new="false" :label="__('Star Rating')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="star_rating" id="{{$type.'_'.'star_rating' }}" :selected-value="isset($model) ? $model->getStarRating() : 0"></x-form.select>
                        </div>


                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Select Country (optional)') }} </label>
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
                            <label class="form-label font-weight-bold">{{ __('Select state (optional)') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select id="state_id" data-live-search="true" name="state_id" required class="form-control  form-select form-select-2 form-select-solid fw-bolder  ">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach([] as $value=>$name)
                                        <option value="{{ $value }}" @if(isset($model) && $model->getStateId() == $value ) selected @endif>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>





                        <div class="col-md-4 mb-4 ">
                            <label class="form-label font-weight-bold">{{ __('Region (optional)') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="{{ __('Please Enter Your Region') }}" name="region" value="{{ isset($hospitalitySector) ? $hospitalitySector->getRegion() : null }}">
                                </div>
                            </div>
                        </div>




                        <div class="col-md-4 mb-4">
                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Study Start Date') }} @include('star') </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input   id="study-start-date" type="text" name="study_start_date" class="only-month-year-picker date-input form-control recalc-study-end-date study-start-date recalate-development-start-date recalate-operation-start-date" readonly 
									value="{{ isset($model) ? $model->getStudyStartDate() : getCurrentDateForFormDate('date') }}"
									  />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-4 mb-4">
                            <x-form.select :options="[
																		2=>['title'=>2 ,'value'=>'2'],
																		3=>['title'=>3 ,'value'=>'3'],
																		4=>['title'=>4 ,'value'=>'4'],
																		5=>['title'=>5 ,'value'=>'5'],
																		6=>['title'=>6 ,'value'=>'6'],
																		7=>['title'=>7 ,'value'=>'7'],
																		8=>['title'=>8 ,'value'=>'8'],
																		9=>['title'=>9 ,'value'=>'9'],
																		10=>['title'=>10,'value'=>10],
																		11=>['title'=>11,'value'=>11],
																		12=>['title'=>12,'value'=>12],
																		13=>['title'=>13,'value'=>13],
																		14=>['title'=>14,'value'=>14],
																		15=>['title'=>15,'value'=>15],
																		20=>['title'=>20,'value'=>20],
																	  
																	  ]" :add-new="false" :is-required="true" :label="__('Duration In Years')" class="select2-select recalc-study-end-date study-duration" data-filter-type="{{ $type }}" :all="false" name="duration_in_years" id="{{$type.'_'.'duration_in_years' }}" :selected-value="isset($model) ? $model->getDurationInYears() : 0"></x-form.select>
                        </div>





                        <div class="col-md-4 mb-4">

                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Study End Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input id="study-end-date" type="text" name="study_end_date" class=" form-control" readonly value="{{ isset($model) ? $model->getStudyEndDate() : getCurrentDateForFormDate('date') }}"  />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>






                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Development / Construction Will Start After (Months)') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="developement-start-after" type="number" class="form-control only-greater-than-or-equal-zero-allowed recalate-development-start-date" name="development_start_month" value="{{ isset($model) ? $model->getDevelopmentStartMonth() : 0 }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 mb-4">

                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Development / Construction Start Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input readonly type="text" id="development-start-date" name="development_start_date" class="form-control " value="{{ isset($model) ? $model->getDevelopmentStartDate() : getCurrentDateForFormDate('date') }}" id="kt_datepicker_3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Development / Construction Duration (Months)') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="development_duration" value="{{ isset($model) ? $model->getDevelopmentDuration() : 0 }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Property Will Start Operations After (Months)')  }} @include('star')</label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input id="property-will-start-after" type="number" class="form-control only-greater-than-or-equal-zero-allowed recalate-operation-start-date" name="operation_start_month" value="{{ isset($model) ? $model->getOperationStartMonth() : 0 }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 mb-4">

                            <x-form.label :class="'label'" :id="'test-id'">{{ __('Operation Start Date') }} </x-form.label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input id="operation-start-date" readonly type="text" name="operation_start_date" class="form-control" readonly value="{{ isset($model) ? $model->getOperationStartDate() : getCurrentDateForFormDate('date') }}" max="{{ date('m-d-Y') }}" id="kt_datepicker_3" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="col-md-4 mb-4">
                            <x-form.select :is-select2="false" :is-required="true" :options="getFinancialMonthsForSelect()" :add-new="false" :label="__('Financial Year Start Month')" class="" data-filter-type="{{ $type }}" :all="false" name="financial_year_start_month" id="{{$type.'_'.'financial_year_start_month' }}" :selected-value="isset($model) ? $model->financialYearStartMonth() : 0"></x-form.select>
                        </div>

                        @php
                        $mainCurrencies[] = $currencies[0]??[];
                        @endphp
                        <div class="col-md-4 mb-4">
                            <x-form.select :is-select2="false" :is-required="true" :options="$mainCurrencies" :add-new="false" :label="__('Main Functional Currency')" class="exhange-rate-recalculate main_functional_currency" data-filter-type="{{ $type }}" :all="false" name="main_functional_currency" id="{{$type.'_'.'main_functional_currency' }}" :selected-value="isset($model) ? $model->getMainFunctionalCurrency() : 0"></x-form.select>
                        </div>



                        <div class="col-md-4 mb-4">

                            <x-form.select :is-select2="false" :options="$currencies" :add-new="false" :label="__('Additional Currency (optioanl)')" class="exhange-rate-recalculate additional-currency" data-filter-type="{{ $type }}" :all="false" name="additional_currency" id="{{$type.'_'.'additional_currency' }}" :selected-value="isset($model) ? $model->getAdditionalCurrency() : 0"></x-form.select>
                        </div>





                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Exchange Rate ') }}
                                ( <span id="exhange-rate-span-id-from"></span>
                                <span id="exhange-rate-span-id-to"></span> )
                            </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-zero-allowed" name="exchange_rate" value="{{ isset($model) ? $model->getExchangeRate() : 1 }}" step="0.1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Corporate Taxes Rate %') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="corporate_taxes_rate" value="{{ isset($model) ? $model->getCorporateTaxesRate() : 0 }}" step="0.1">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Required Investment Return Rate %') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="investment_return_rate" value="{{ isset($model) ? $model->getInvestmentReturnRate() : 1 }}" step="0.1">
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 mb-4">
                            <label class="form-label font-weight-bold">{{ __('Perptual Growth Rate %') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="perpetual_growth_rate" value="{{ isset($model) ? $model->getPerpetualGrowthRate() : 0 }}" step="0.1">
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>

                    </div>
                </div>
            </div>



            {{-- Accommodation & Rooms Section  --}}

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Accommodation & Rooms Revenue Stream') }} </h3>
                                <input class="can-not-be-removed-checkbox" type="checkbox" name="has_rooms_section" value="1" style="width:20px;height:20px" checked readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".rooms-repeater">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row">

                        <div class="form-group row" style="flex:1;">
                            <div class="col-md-12 mt-3">
                                <div class="row">




                                    <div class="col-md-12 mb-0 mt-4 text-left">
                                        <label class="form-label font-weight-bold d-inline-block pl-3 font-size-15px font-size-15px">
                                            {{ __('Apply') }}
                                        </label>
                                        <label class="form-label font-weight-bold">

                                        </label>

                                        <div class="form-group d-inline-block">
                                            <div class="kt-radio-inline">
                                                <label class="mr-3">

                                                </label>
                                                <label class="kt-radio kt-radio--success text-black font-size-15px font-weight-bold">

                                                    <input id="is-total-rooms-1" type="radio" value="1" name="is_total_rooms" class="is-total-rooms " @if(isset($model) && $model->isTotalRooms()) checked @endisset> {{ __('Total Rooms') }}
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--danger text-black font-size-15px font-weight-bold">
                                                    <input type="radio" value="0" name="is_total_rooms" class="is-total-rooms " @if(!isset($model) || !$model->isTotalRooms()) checked @endisset> {{ __('Rooms Type') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="total-room-div">
                                    @if(isset($model) && $model->rooms->count() && $model->rooms->first()->room_type_id == 0 )
                                    @foreach($model->rooms as $room)

                                    @include('admin.quick-pricing-calculator.form.room' , [
                                    'room'=>$room ,
                                    'onlyTotal'=>true ,
                                    'removeRepeater'=>true
                                    ])

                                    @endforeach
                                    @else
                                    @include('admin.quick-pricing-calculator.form.room' , [
                                    'onlyTotal'=>true,
                                    'removeRepeater'=>true
                                    ])

                                    @endif
                                </div>

                                <div id="m_repeater_3" class="rooms-repeater">
                                    <div class="form-group  m-form__group row">
                                        <div data-repeater-list="rooms" class="col-lg-12">

                                            @if(isset($model) && $model->rooms->count() && $model->rooms->first()->room_type_id != 0 )
                                            @foreach($model->rooms as $room)

                                            @include('admin.quick-pricing-calculator.form.room' , [
                                            'room'=>$room
                                            ])
                                            @endforeach
                                            @else
                                            @include('admin.quick-pricing-calculator.form.room' , [
                                            ])

                                            @endif






                                        </div>

                                    </div>
                                    <div class="m-form__group form-group row">
                                        @if(! isset($disabled) || ! $disabled)
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
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>









            {{-- Food & Beverage Section  --}}

            <div class="kt-portlet">
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="d-flex align-items-center ">
                                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Food & Beverage (F&B) Revenue Stream') }} </h3>
                                <input class="can-not-be-removed-checkbox" type="checkbox" name="has_food_section" value="1" style="width:20px;height:20px" checked readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".foods-repeater">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row">

                        <div class="form-group row" style="flex:1;">
                            <div class="col-md-12 mt-3">
                                <div class="row">

                                    {{-- <div class="col-md-4 mb-4 mt-4">
										<label class="form-label font-weight-bold">{{ __('Total F&B Facility Count') }} @include('star') </label>
                                    <div class="kt-input-icon">
                                        <div class="input-group">
                                            <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="total_f&b_facility_count" value="{{ isset($model) ? $model->getTotalFAndBFacilityCount() : old('total_f&b_facility_count') }}" step="0.1">
                                        </div>
                                    </div>
                                </div> --}}


                                {{-- <div class="col-md-4 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Total Guest Capacity') }} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group">
                                        <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="total_f&b_cover_count" value="{{ isset($model) ? $model->getTotalFAndBCoverCount() : old('total_f&b_cover_count') }}" step="0.1">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12 mb-0 mt-4 text-left">
                                <label class="form-label font-weight-bold d-inline-block pl-3 font-size-15px font-size-15px">
                                    {{ __('Apply') }}
                                </label>
                                <label class="form-label font-weight-bold">

                                </label>

                                <div class="form-group d-inline-block">
                                    <div class="kt-radio-inline">
                                        <label class="mr-3">

                                        </label>

                                        <label class="kt-radio kt-radio--success text-black font-size-15px font-weight-bold">
                                            <input type="radio" id="is-total-foods-1" value="1" name="is_total_foods" class="is-total-foods " @if(isset($model) && $model->isTotalFood()) checked @endisset> {{ __('Total F&B Facilities') }}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--danger text-black font-size-15px font-weight-bold">
                                            <input type="radio" id="is-total-foods-0" value="0" name="is_total_foods" class="is-total-foods " @if(!isset($model) || !$model->isTotalFood()) checked @endisset> {{ __('F&B Facility Type') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="total-food-div">
                            @if(isset($model) && $model->foods->count() && $model->rooms->first()->food_type_id == 0 )
                            @foreach($model->foods as $food)
                            @include('admin.quick-pricing-calculator.form.foods' , [
                            'food'=>$food ,
                            'onlyTotal'=>true ,
                            'removeRepeater'=>true
                            ])
                            @endforeach
                            @else
                            @include('admin.quick-pricing-calculator.form.foods' , [
                            'onlyTotal'=>true ,
                            'removeRepeater'=>true
                            ])

                            @endif
                        </div>

                        <div id="m_repeater_4" class="foods-repeater">
                            <div class="form-group  m-form__group row">
                                <div data-repeater-list="foods" class="col-lg-12">

                                    @if(isset($model) && $model->foods->count() )
                                    @foreach($model->foods as $food)
                                    @include('admin.quick-pricing-calculator.form.foods' , [
                                    'food'=>$food
                                    ])
                                    @endforeach
                                    @else
                                    @include('admin.quick-pricing-calculator.form.foods' , [
                                    ])

                                    @endif






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
</div>
















{{-- Casino Section  --}}

<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Gaming Revenue Stream') }} </h3>
                    <input class="can-be-toggle-show-repeater-btn" data-repeater-query=".casino-repeater" type="checkbox" name="has_casino_section" value="1" style="width:20px;height:20px" @if(isset($model) && $model->hasCasinoSection()) checked @elseif(!isset($model)) checked @endif >
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".casino-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3" data-repeater-row=".casino-repeater">
                    <div class="row">

                        {{-- <div class="col-md-4 mb-4 mt-4">
										<label class="form-label font-weight-bold">{{ __('Total Gaming Facility Count') }} @include('star') </label>
                        <div class="kt-input-icon">
                            <div class="input-group">
                                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="total_casino_facility_count" value="{{ isset($model) ? $model->getTotalCasinoFacilityCount() : old('total_casino_facility_count') }}" step="0.1">
                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="col-md-4 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Total Gaming Guest Capacity') }} </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="total_casino_cover_count" value="{{ isset($model) ? $model->getTotalCasinoCoverCount() : old('total_casino_cover_count') }}" step="0.1">
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-12 mb-0 mt-4 text-left">
                    <label class="form-label font-weight-bold d-inline-block pl-3 font-size-15px font-size-15px">
                        {{ __('Apply') }}
                    </label>
                    <label class="form-label font-weight-bold">

                    </label>

                    <div class="form-group d-inline-block">
                        <div class="kt-radio-inline">
                            <label class="mr-3">

                            </label>

                            <label class="kt-radio kt-radio--success text-black font-size-15px font-weight-bold">
                                <input id="is-total-casinos-1" type="radio" value="1" name="is_total_casinos" class="is-total-casino " @if(isset($model) && $model->isTotalCasino()) checked @endisset> {{ __('Total Gaming Facilities') }}
                                <span></span>
                            </label>
                            <label class="kt-radio kt-radio--danger text-black font-size-15px font-weight-bold">
                                <input id="is-total-casinos-2" type="radio" value="0" name="is_total_casinos" class="is-total-casino " @if(!isset($model) || !$model->isTotalCasino()) checked @endisset> {{ __('Gaming Facility Type') }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="total-casino-div">
                @if(isset($model) && $model->casinos->count() && $model->casinos->first()->casino_type_id == 0 )
                @foreach($model->casinos as $casino)
                @include('admin.quick-pricing-calculator.form.casino' , [
                'casino'=>$casino ,
                'onlyTotal'=>true ,
                'removeRepeater'=>true
                ])
                @endforeach
                @else
                @include('admin.quick-pricing-calculator.form.casino' , [
                'onlyTotal'=>true ,
                'removeRepeater'=>true
                ])

                @endif
            </div>

            <div id="m_repeater_5" class="casino-repeater">
                <div class="form-group  m-form__group row">
                    <div data-repeater-list="casinos" class="col-lg-12">

                        @if(isset($model) && $model->casinos->count() )
                        @foreach($model->casinos as $casino)
                        @include('admin.quick-pricing-calculator.form.casino' , [
                        // 'positions'=>[] ,
                        'casino'=>$casino
                        ])
                        @endforeach
                        @else
                        @include('admin.quick-pricing-calculator.form.casino' , [
                        // 'positions'=>[]
                        ])

                        @endif







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
</div>












{{-- Meeting Space Section  --}}

<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Gathering & Meeting Space Revenue Stream') }} </h3>
                    <input class="can-be-toggle-show-repeater-btn" data-repeater-query=".meeting-repeater" type="checkbox" name="has_meeting_section" value="1" style="width:20px;height:20px" @if(isset($model) && $model->hasMeetingSection()) checked @elseif(!isset($model)) checked @endif >
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".meeting-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3" data-repeater-row=".meeting-repeater">
                    <div class="row">

                        {{-- <div class="col-md-4 mb-4 mt-4">
										<label class="form-label font-weight-bold">{{ __('Total Meeting Facility Count') }} @include('star') </label>
                        <div class="kt-input-icon">
                            <div class="input-group">
                                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="total_meeting_facility_count" value="{{ isset($model) ? $model->getTotalMeetingFacilityCount() : old('total_meeting_facility_count') }}" step="0.1">
                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="col-md-4 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Guest Capacity') }} @include('star') </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" name="total_meeting_cover_count" value="{{ isset($model) ? $model->getTotalMeetingCoverCount() : old('total_meeting_cover_count') }}" step="0.1">
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-12 mb-0 mt-4 text-left">
                    <label class="form-label font-weight-bold d-inline-block pl-3 font-size-15px font-size-15px">
                        {{ __('Apply') }}
                    </label>
                    <label class="form-label font-weight-bold">

                    </label>

                    <div class="form-group d-inline-block">
                        <div class="kt-radio-inline">
                            <label class="mr-3">

                            </label>

                            <label class="kt-radio kt-radio--success text-black font-size-15px font-weight-bold">
                                <input id="is-total-meetings-1" type="radio" value="1" name="is_total_meetings" class="is-total-meeting " @if(isset($model) && $model->isTotalMeeting()) checked @endisset> {{ __('Total Meeting Space Facilities') }}
                                <span></span>
                            </label>
                            <label class="kt-radio kt-radio--danger text-black font-size-15px font-weight-bold">
                                <input type="radio" value="0" name="is_total_meetings" class="is-total-meeting " @if(!isset($model) || !$model->isTotalMeeting()) checked @endisset> {{ __('Meeting Space Facility Type') }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>


            <div class="total-meeting-div">
                @if(isset($model) && $model->meetings->count() && $model->meetings->first()->meeting_type_id == 0 )
                @foreach($model->meetings as $meeting)
                @include('admin.quick-pricing-calculator.form.meeting' , [
                'meeting'=>$meeting ,
                'onlyTotal'=>true ,
                'removeRepeater'=>true
                ])
                @endforeach
                @else
                @include('admin.quick-pricing-calculator.form.meeting' , [
                'onlyTotal'=>true ,
                'removeRepeater'=>true
                ])

                @endif
            </div>


            <div id="m_repeater_6" class="meeting-repeater">
                <div class="form-group  m-form__group row">
                    <div data-repeater-list="meetings" class="col-lg-12">

                        @if(isset($model) && $model->meetings->count() )
                        @foreach($model->meetings as $meeting)
                        @include('admin.quick-pricing-calculator.form.meeting' , [
                        // 'positions'=>[] ,
                        'meeting'=>$meeting
                        ])
                        @endforeach
                        @else
                        @include('admin.quick-pricing-calculator.form.meeting' , [
                        // 'positions'=>[]
                        ])

                        @endif








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
</div>



{{-- Other Facilities Section  --}}

<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Other Facilities Revenue Stream') }} </h3>
                    <input class="can-be-toggle-show-repeater-btn" data-repeater-query=".other-repeater" type="checkbox" name="has_other_section" value="1" style="width:20px;height:20px" @if(isset($model) && $model->hasOtherSection()) checked @elseif(!isset($model)) checked @endif >
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".other-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3" data-repeater-row=".other-repeater">
                    <div class="row">




                        <div class="col-md-12 mb-0 mt-4 text-left">
                            <label class="form-label font-weight-bold pl-3 font-size-15px font-size-15px">
                                {{ __('Apply') }}
                            </label>
                            <label class="form-label font-weight-bold">

                            </label>

                            <div class="form-group">
                                <div class="kt-radio-inline">
                                    <label class="mr-3">

                                    </label>

                                    <label class="kt-radio kt-radio--success text-black font-size-15px font-weight-bold">
                                        <input id="is-total-others-1" type="radio" value="1" name="is_total_other" class="is-total-other " @if(isset($model) && $model->isTotalOther()) checked @endisset> {{ __('Total Other Revenues Facilities') }}
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--danger text-black font-size-15px font-weight-bold">
                                        <input type="radio" value="0" name="is_total_other" class="is-total-other " @if(!isset($model) || !$model->isTotalOther()) checked @endisset> {{ __('Other Revenues Facility Type') }}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="total-other-div">
                        @if(isset($model) && $model->others->count() && $model->others->first()->other_type_id == 0 )
                        @foreach($model->others as $other)
                        @include('admin.quick-pricing-calculator.form.other' , [
                        'other'=>$other ,
                        'onlyTotal'=>true ,
                        'removeRepeater'=>true
                        ])
                        @endforeach
                        @else
                        @include('admin.quick-pricing-calculator.form.other' , [
                        'onlyTotal'=>true ,
                        'removeRepeater'=>true
                        ])

                        @endif
                    </div>

                    <div id="m_repeater_7" class="other-repeater">
                        <div class="form-group  m-form__group row">
                            <div data-repeater-list="others" class="col-lg-12">
                                @if(isset($model) && $model->others->count() )
                                @foreach($model->others as $other)
                                @include('admin.quick-pricing-calculator.form.other' , [
                                // 'positions'=>[] ,
                                'other'=>$other
                                ])
                                @endforeach
                                @else
                                @include('admin.quick-pricing-calculator.form.other' , [
                                // 'positions'=>[]
                                ])

                                @endif

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
</div>





<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex align-items-center ">
                    <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Do you want to add Reservation Channels to your PLan ?') }} </h3>

                    <input class="can-be-toggle-show-repeater-btn" data-repeater-query=".sales-channels-repeater" type="checkbox" name="has_sales_channels" value="1" style="width:20px;height:20px" @if(isset($model) && $model->hasSalesChannels()) checked @elseif(!isset($model)) @endif >
                </div>
            </div>
            <div class="col-md-2">
                <div class="btn active-style show-hide-repeater" data-query=".sales-channels-repeater">{{ __('Show/Hide') }}</div>
            </div>
        </div>
        <div class="row">
            <hr style="flex:1;background-color:lightgray">
        </div>
        <div class="row">

            <div class="form-group row" style="flex:1;">
                <div class="col-md-12 mt-3" data-repeater-row=".sales-channels-repeater">
                    <div class="row">





                    </div>

                    <div id="m_repeater_8" class="sales-channels-repeater">
                        <div class="form-group  m-form__group row">
                            <div data-repeater-list="salesChannels" class="col-lg-12">

                                @if(isset($model) && $model->salesChannels->count() )
                                @foreach($model->salesChannels as $index=>$salesChannel)
                                @include('admin.quick-pricing-calculator.form.sales-channels' , [
                                // 'positions'=>[] ,
                                'salesChannel'=>$salesChannel,
                                'index'=>$index
                                ])
                                @endforeach
                                @else
                                @include('admin.quick-pricing-calculator.form.sales-channels' , [
                                'index'=>0
                                ])

                                @endif


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
</div>













{{-- <div class="kt-portlet">
          
                
                <div class="kt-portlet__body">

                 </div>
    
            </div> --}}





<div class="kt-portlet">
    <div class="kt-portlet__body">
        <x-save-or-back :btn-text="__('Create')" />
    </div>
</div>




<!--end::Form-->

<!--end::Portlet-->
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
    $(document).on('click', '.save-form', function(e) {
        e.preventDefault(); {

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

</script>

<script>
    $(document).on('change', '.is-total-rooms', function() {
        const isTotalRooms = $('#is-total-rooms-1').is(':checked');
        const parent = $(this).closest('.form-group.row')
        if (isTotalRooms) {
            parent.find('.total-room-div').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.rooms-repeater').css('display', 'none').find('input,select').prop('disabled', true)
            parent.find('.is_total_rooms').val(1)
        } else {
            parent.find('.is_total_rooms').val(0)
            parent.find('.rooms-repeater').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.total-room-div').css('display', 'none').find('input,select').prop('disabled', true)
        }
    })
    $(function() {
        $('.is-total-rooms').trigger('change');
    })

</script>



<script>
    $(document).on('change', '.is-total-foods', function() {
        const isTotalFoods = $('#is-total-foods-1').is(':checked');
        const parent = $(this).closest('.form-group.row')
        if (isTotalFoods) {
            parent.find('.total-food-div').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.foods-repeater').css('display', 'none').find('input,select').prop('disabled', true)
            parent.find('.is_total_foods').val(1)
        } else {
            parent.find('.is_total_foods').val(0)
            parent.find('.foods-repeater').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.total-food-div').css('display', 'none').find('input,select').prop('disabled', true)
        }
    })
    $(function() {
        $('.is-total-foods:checked').trigger('change');
    })

</script>


<script>
    $(document).on('change', '.is-total-casino', function() {
        const isTotalCasinos = $('#is-total-casinos-1').is(':checked');
        const parent = $(this).closest('.form-group.row')
        if (isTotalCasinos) {
            parent.find('.total-casino-div').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.casino-repeater').css('display', 'none').find('input,select').prop('disabled', true)
            parent.find('.is_total_casinos').val(1)
        } else {
            parent.find('.is_total_casinos').val(0)
            parent.find('.casino-repeater').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.total-casino-div').css('display', 'none').find('input,select').prop('disabled', true)
        }
    })
    $(function() {
        $('.is-total-casino:checked').trigger('change');
    })

</script>





<script>
    $(document).on('change', '.is-total-meeting', function() {
        const isTotalMeetings = $('#is-total-meetings-1').is(':checked');
        const parent = $(this).closest('.form-group.row')

        if (isTotalMeetings) {
            parent.find('.total-meeting-div').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.meeting-repeater').css('display', 'none').find('input,select').prop('disabled', true)
            parent.find('.is_total_meetings').val(1)
        } else {
            parent.find('.is_total_meetings').val(0)
            parent.find('.meeting-repeater').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.total-meeting-div').css('display', 'none').find('input,select').prop('disabled', true)
        }
    })
    $(function() {
        $('.is-total-meeting:checked').trigger('change');
    })

</script>


<script>
    $(document).on('change', '.is-total-other', function() {
        const isTotalOthers = $('#is-total-others-1').is(':checked');
        const parent = $(this).closest('.form-group.row')
        if (isTotalOthers) {
            parent.find('.total-other-div').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.other-repeater').css('display', 'none').find('input,select').prop('disabled', true)
            parent.find('.is_total_other').val(1)
        } else {
            parent.find('.is_total_other').val(0)
            parent.find('.other-repeater').css('display', 'initial').find('input,select').prop('disabled', false)
            parent.find('.total-other-div').css('display', 'none').find('input,select').prop('disabled', true)
        }
    })
    $(function() {
        $('.is-total-other:checked').trigger('change');
    })

</script>






<script>
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
        if (studyDuration || studyDuration == '0') {
            const numberOfMonths = (studyDuration * 12) - 1
            let studyEndDate = studyStartDate.addMonths(numberOfMonths)
            studyEndDate = formatDate(studyEndDate)
            $('#study-end-date').val(studyEndDate).trigger('change')

        }

    })


    $(document).on('change', '.recalate-development-start-date', function() {
        const studyStartDate = new Date($('.study-start-date').val());
        const developementStartAfter = parseFloat($('#developement-start-after').val())
        if (developementStartAfter || developementStartAfter == '0') {
            const developmentStartDate = formatDate(studyStartDate.addMonths(developementStartAfter))
            $('#development-start-date').val(developmentStartDate)

        }
    })

    $(document).on('change', '.recalate-operation-start-date', function() {
        const studyStartDate = new Date($('.study-start-date').val());
        const propertyWillStartAfter = parseFloat($('#property-will-start-after').val())
        if (propertyWillStartAfter || propertyWillStartAfter == '0') {
            const developmentStartDate = formatDate(new Date($('.study-start-date').val()).addMonths(propertyWillStartAfter))
            $('#operation-start-date').val(developmentStartDate)
        }
    })


    $(document).on('change', '.exhange-rate-recalculate', function() {
        let mainFunctionalCurrency = $('.main_functional_currency option:selected').html()
        let additionalCurrency = $('.additional-currency option:selected').html()
        if (additionalCurrency) {
            $('#exhange-rate-span-id-from').html('From ' + additionalCurrency)
        }
        if (mainFunctionalCurrency) {
            $('#exhange-rate-span-id-to').html(' To ' + mainFunctionalCurrency)
        }
    })
    $('.exhange-rate-recalculate').trigger('change')

    $(function() {
        $('.study-start-date').trigger('change')
        $('#developement-start-after').trigger('change')
        $('#property-will-start-after').trigger('change')

        $(document).find('.test-date').datepicker({
            dateFormat: 'mm-yy'
            , autoclose: true
        })

    })

</script>
<script>
  

</script>
@endsection
