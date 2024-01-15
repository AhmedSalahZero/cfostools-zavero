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
<x-main-form-title :id="'main-form-title'" :class="''">{{ __('Feasibilities & Multi-years Financial Plan') }}</x-main-form-title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{  isset($disabled) && $disabled ? '#' : (isset($model) ? route('admin.update.financial.plan',[$company->id , $model->id]) : $storeRoute)  }}">

            @csrf
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">


            <div class="kt-portlet">


                <div class="kt-portlet__body">

                    <h2 for="" class="d-block">{{ __('Study Main Information') }}</h2>



                    <div class="form-group row">

                        <div class="col-md-4 mb-4 mt-4">
                            <label class="form-label font-weight-bold">{{ __('Study Name') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="{{ __('Please Enter Study Name') }}" name="study_name" value="{{ isset($financialPlan) ? $financialPlan->getStudyName() : null }}" required>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="col-lg-4 col-md-2">
                            <label class="form-label font-weight-bold">{{ __('Property Name') }} </label>
                        <div class="kt-input-icon">
                            <div class="input-group">
                                <input placeholder="{{ __('Please Enter Property Name') }}" type="text" class="form-control" name="property_name" value="{{ isset($financialPlan) ? $financialPlan->getPropertyName() : null }}">
                            </div>
                        </div>
                    </div> --}}



                    <div class="col-md-4 mb-4 mt-4">
                        <x-form.select :options="[
																		'feasibility-study'=>['title'=>'Feasibility Study','value'=>'feasibility-study'],
																		'busniess-plan'=>['title'=>'Business Plan','value'=>'business-plan'],
																	  ]" :add-new="false" :is-required="true" :label="__('Study Status')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="study_status" id="{{$type.'_'.'study_status' }}" :selected-value="isset($model) ? $model->getStudyStatus() : 0"></x-form.select>
                    </div>


                    <div class="col-md-4 mb-4 mb-4 mt-4">
                        <x-form.select :is-required="true" :options="[
																		'manufacturing'=>['title'=>'Manufacturing','value'=>'manufacturing'],
																		'trading'=>['title'=>'Trading','value'=>'trading'],
																		'service'=>['title'=>'Service','value'=>'service'],
																		'service-with-inventory'=>['title'=>'Service With Inventory','value'=>'service-with-inventory'],
																	  
																	  ]" :add-new="false" :multiple="true" :label="__('Revenue Stream')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="revenue_streams[]" id="{{$type.'_'.'revenue_streams' }}" :selected-value="isset($model) ? $model->getRevenueStreamTypes() : 0"></x-form.select>
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
                                <input type="text" class="form-control" placeholder="{{ __('Please Enter Your Region') }}" name="region" value="{{ isset($financialPlan) ? $financialPlan->getRegion() : null }}">
                            </div>
                        </div>
                    </div>




                    <div class="col-md-4 mb-4">
                        <x-form.label :class="'label'" :id="'test-id'">{{ __('Study Start Date') }} @include('star') </x-form.label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input id="study-start-date" type="text" name="study_start_date" class="only-month-year-picker date-input form-control recalc-study-end-date study-start-date recalate-development-start-date recalate-operation-start-date" readonly value="{{ isset($model) ? $model->getStudyStartDate() : getCurrentDateForFormDate('date') }}" />
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
                                <input id="study-end-date" type="text" name="study_end_date" class=" form-control" readonly value="{{ isset($model) ? $model->getStudyEndDate() : getCurrentDateForFormDate('date') }}" />
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
                                <input readonly type="text" id="development-start-date" name="development_start_date" class="form-control development-start-date recalc-development-end-date" value="{{ isset($model) ? $model->getDevelopmentStartDate() : getCurrentDateForFormDate('date') }}" id="kt_datepicker_3" />
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
                                <input type="number" class="form-control development-duration recalc-development-end-date only-greater-than-or-equal-zero-allowed" name="development_duration" value="{{ isset($model) ? $model->getDevelopmentDuration() : 0 }}">
                            </div>
                        </div>
                    </div>
					
					
                    <div class="col-md-4 mb-4">

                        <x-form.label :class="'label'" :id="'test-id'">{{ __('Development / Construction End Date') }} </x-form.label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input id="development-end-date" type="text" name="development_end_date" class=" form-control" readonly value="{{ isset($model) ? $model->getDevelopmentEndDate() : getCurrentDateForFormDate('date') }}" />
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="la la-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
					








                    @php
                    $mainCurrencies[] = $currencies[0]??[];
                    @endphp
                    <div class="col-md-4 mb-4">
                        <x-form.select :is-select2="false" :is-required="true" :options="$mainCurrencies" :add-new="false" :label="__('Main Functional Currency')" class="exhange-rate-recalculate main_functional_currency" data-filter-type="{{ $type }}" :all="false" name="main_functional_currency" id="{{$type.'_'.'main_functional_currency' }}" :selected-value="isset($model) ? $model->getMainFunctionalCurrency() : 0"></x-form.select>
                    </div>



                    <div class="col-md-4 mb-4">
                        <x-form.select :add-new-modal="true" :add-new-modal-modal-type="''" :add-new-modal-modal-name="'Currency'" :add-new-modal-modal-title="__('Currency')" :previous-select-name-in-dB="'category_id'" :options="$currencies" :add-new="false" :label="__('Additional Currency (optioanl)')" class="select2-select additional-currency additional_currency_class exhange-rate-recalculate " data-filter-type="{{ $type }}" :all="false" name="additional_currency" id="{{$type.'_'.'additional_currency' }}" :selected-value="isset($model) ? $model->getAdditionalCurrency() : 0"></x-form.select>
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


                  

                    <div class="col-md-4 mb-4">

                        <x-form.label :class="'label'" :id="'test-id'">{{ __('Operation Start Date') }} 
						    @include('star')
						</x-form.label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input id="operation-start-date" type="text" name="operation_start_date" class="only-month-year-picker date-input form-control"  value="{{ isset($model) ? $model->getOperationStartDate() : getCurrentDateForFormDate('date') }}" max="{{ date('m-d-Y') }}" id="kt_datepicker_3" />
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

                    <br>
                    <hr>

                </div>
            </div>
    </div>



    {{-- Start Manufacturing Revenue Stream Section  --}}

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-10">
                    <div class="d-flex align-items-center ">
                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Manufacturing Revenue Stream') }} </h3>
                        <input class="can-not-be-removed-checkbox" type="checkbox" style="width:20px;height:20px" checked readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn active-style show-hide-repeater" data-query=".manufacturing-repeater">{{ __('Show/Hide') }}</div>
                </div>
            </div>
            <div class="row">
                <hr style="flex:1;background-color:lightgray">
            </div>
            <div class="row manufacturing-repeater">

                <div class="form-group row" style="flex:1;">
                    <div class="col-md-12 mt-3">

                        <div id="m_repeater_4" class="products-repeater">
                            <div class="form-group  m-form__group row">
                                <div data-repeater-list="manufacturingRevenueStreams" class="col-lg-12">

                                    @if(isset($model) && $model->manufacturingRevenueStreams->count() )
                                    @foreach($model->manufacturingRevenueStreams as $manufacturingRevenueStreams)
                                    @include('admin.financial_plans.form.manufacturingRevenueStreams' , [
                                    'manufacturingRevenueStream'=>$manufacturingRevenueStreams
                                    ])
                                    @endforeach
                                    @else
                                    @include('admin.financial_plans.form.manufacturingRevenueStreams' , [
                                    ])

                                    @endif






                                </div>
                            </div>
                            <div class="m-form__group form-group row">

                                <div class="col-lg-12">
                                    <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide {{__('right')}}" id="add-row">
                                        <span>
                                            <i class="fa fa-plus"> </i>
                                            <span>
                                                {{ __('Add') }}
                                            </span>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-4 mt-4">
                                    <x-form.select :options="getInventoryCoverageDays()" :add-new="false" :is-required="true" :label="__('Finished Goods Inventory Coverage Days')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="finished_goods_inventory_coverage_days" id="{{$type.'_'.'finished_goods_inventory_coverage_days' }}" :selected-value="isset($model) ? $model->getFinishedGoodsInventoryCoverageDays() : 0"></x-form.select>
                                </div>

                                <div class="col-md-3 mb-4 mt-4">

                                    <x-form.select :options="getInventoryCoverageDays()" :add-new="false" :is-required="true" :label="__('Raw Material Inventory Coverage Days')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="raw_materials_inventory_coverage_days" id="{{$type.'_'.'raw_materials_inventory_coverage_days' }}" :selected-value="isset($model) ? $model->getRawMaterialsInventoryCoverageDays() : 0"></x-form.select>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    {{-- End Manufacturing Revenue Stream Section  --}}





    {{-- Start Trading Revenue Stream Section  --}}

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-10">
                    <div class="d-flex align-items-center ">
                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Trading Revenue Stream') }} </h3>
                        <input class="can-not-be-removed-checkbox" type="checkbox" style="width:20px;height:20px" checked readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn active-style show-hide-repeater" data-query=".trading-repeater">{{ __('Show/Hide') }}</div>
                </div>
            </div>
            <div class="row">
                <hr style="flex:1;background-color:lightgray">
            </div>
            <div class="row trading-repeater">

                <div class="form-group row" style="flex:1;">
                    <div class="col-md-12 mt-3">


                        <div id="m_repeater_3" class="products-repeater">
                            <div class="form-group  m-form__group row">
                                <div data-repeater-list="tradingRevenueStreams" class="col-lg-12">

                                    @if(isset($model) && $model->tradingRevenueStreams->count() )
                                    @foreach($model->tradingRevenueStreams as $tradingRevenueStreams)
                                    @include('admin.financial_plans.form.tradingRevenueStreams' , [
                                    'tradingRevenueStream'=>$tradingRevenueStreams
                                    ])
                                    @endforeach
                                    @else
                                    @include('admin.financial_plans.form.tradingRevenueStreams' , [
                                    ])

                                    @endif






                                </div>
                            </div>
                            <div class="m-form__group form-group row">

                                <div class="col-lg-12">
                                    <div data-repeater-create="" class="btn btn btn-sm btn-success m-btn m-btn--icon m-btn--pill m-btn--wide {{__('right')}}" id="add-row">
                                        <span>
                                            <i class="fa fa-plus"> </i>
                                            <span>
                                                {{ __('Add') }}
                                            </span>
                                        </span>
                                    </div>
                                </div>


                                <div class="col-md-3 mb-4 mt-4">
                                    <x-form.select :options="getInventoryCoverageDays()" :add-new="false" :is-required="true" :label="__('Finished Goods Inventory Coverage Days')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="finished_goods_inventory_coverage_days_for_trading" id="{{$type.'_'.'finished_goods_inventory_coverage_days_for_trading' }}" :selected-value="isset($model) ? $model->getFinishedGoodsInventoryCoverageDaysForTrading() : 0"></x-form.select>
                                </div>




                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>


    {{-- End Trading Revenue Stream Section  --}}


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
	
	
	    $(document).on('change', '.recalc-development-end-date', function(e) {
        e.preventDefault()
        const developmentStartDate = new Date($('.development-start-date').val());
        const developmentDuration = parseFloat($('.development-duration').val());
        if (developmentDuration || developmentDuration == '0') {
            const numberOfMonths = (developmentDuration ) - 1
            let developmentEndDate = developmentStartDate.addMonths(numberOfMonths)
            developmentEndDate = formatDate(developmentEndDate)
            $('#development-end-date').val(developmentEndDate).trigger('change')

        }

    })
	


    $(document).on('change', '.recalate-development-start-date', function() {
        const studyStartDate = new Date($('.study-start-date').val());
        const developementStartAfter = parseFloat($('#developement-start-after').val())
        if (developementStartAfter || developementStartAfter == '0') {
            const developmentStartDate = formatDate(studyStartDate.addMonths(developementStartAfter))
            $('#development-start-date').val(developmentStartDate).trigger('change')

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
<script>
    var openedSelect = null;
    var modalId = null



    $(document).on('click', '.trigger-add-new-modal', function() {
        var additionalName = '';
        if ($(this).attr('data-previous-must-be-opened')) {
            const previosSelectorQuery = $(this).attr('data-previous-select-selector');
            const previousSelectorValue = $(previosSelectorQuery).val()
            const previousSelectorTitle = $(this).attr('data-previous-select-title');
            if (!previousSelectorValue) {
                Swal.fire({
                    text: "{{ __('Please Select') }}" + ' ' + previousSelectorTitle
                    , icon: 'warning'
                })
                return;
            }
            const previousSelectorVal = $(previosSelectorQuery).val();
            const previousSelectorHtml = $(previosSelectorQuery).find('option[value="' + previousSelectorVal + '"]').html();
            additionalName = "{{' '. __('For')  }}  [" + previousSelectorHtml + ' ]'
        }
        const parent = $(this).closest('label').parent();
        parent.find('select');
        const type = $(this).attr('data-modal-title')
        const name = $(this).attr('data-modal-name')
        $('.modal-title-add-new-modal-' + name).html("{{ __('Add New ') }}" + type + additionalName);
        parent.find('.modal').modal('show')
    })
    $(document).on('click', '.store-new-add-modal', function() {
        const that = $(this);
        $(this).attr('disabled', true);
        const modalName = $(this).attr('data-modal-name');
        const modalType = $(this).attr('data-modal-type');
        const modal = $(this).closest('.modal');
        const value = modal.find('input.name-class-js').val();
        const previousSelectorSelector = $(this).attr('data-previous-select-selector');
        const previousSelectorValue = previousSelectorSelector ? $(previousSelectorSelector).val() : null;
        const previousSelectorNameInDb = $(this).attr('data-previous-select-name-in-db');

        $.ajax({
            url: "{{ route('admin.store.new.modal',['company'=>$company->id ?? 0  ]) }}"
            , data: {
                "_token": "{{ csrf_token() }}"
                , "modalName": modalName
                , "modalType": modalType
                , "value": value
                , "previousSelectorNameInDb": previousSelectorNameInDb
                , "previousSelectorValue": previousSelectorValue
            }
            , type: "POST"
            , success: function(response) {
                $(that).attr('disabled', false);
                modal.find('input').val('');
                $('.modal').modal('hide')
                if (response.status) {
                    const allSelect = $('select[data-modal-name="' + modalName + '"][data-modal-type="' + modalType + '"]');
                    const allSelectLength = allSelect.length;
                    allSelect.each(function(index, select) {
                        var isSelected = '';
                        if (index == (allSelectLength - 1)) {
                            isSelected = 'selected';
                        }
                        $(select).append(`<option ` + isSelected + ` value="` + response.id + `">` + response.value + `</option>`).selectpicker('refresh').trigger('change')
                    })

                }
            }
            , error: function(response) {}
        });
    })

</script>

@endsection
