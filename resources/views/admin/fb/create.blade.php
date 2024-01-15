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
<x-main-form-title :id="'main-form-title'" :class="''">{{ $pageTitle }}</x-main-form-title>
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

                        <div class="col-md-4 mt-3">
                            <label class="form-label font-weight-bold">{{ __('Study Name') }} @include('star') </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="{{ __('Please Enter Study Name') }}" name="study_name" value="{{ isset($hospitalitySector) ? $hospitalitySector->getStudyName() : null }}" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-2 mt-3">
                            <label class="form-label font-weight-bold">{{ __('Property Name') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input placeholder="{{ __('Please Enter Property Name') }}" type="text" class="form-control" name="property_name" value="{{ isset($hospitalitySector) ? $hospitalitySector->getPropertyName() : null }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-md-4 mb-4 mt-3">
                            <x-form.select :options="[
																		'yes'=>['title'=>'Yes','value'=>'yes'],
																		'no'=>['title'=>'No','value'=>'no']
																	  ]" :add-new="false" :is-required="true" :label="__('Do You Have Seating Area')" class="select2-select  property-status-js " data-filter-type="{{ $type }}" :all="false" required name="property_status" id="{{$type.'_'.'property_status' }}" :selected-value="isset($model) ? $model->getPropertyStatus() : 0"></x-form.select>
                        </div>



                        {{-- <div class="col-md-4 mb-4">
                            <x-form.select :options="[
																		1=>['title'=>1,'value'=>1],
																		2=>['title'=>2,'value'=>2],
																		3=>['title'=>3,'value'=>3],
																		4=>['title'=>4,'value'=>4],
																		5=>['title'=>5,'value'=>5],
																		7=>['title'=>7,'value'=>7],
																	  
																	  ]" :add-new="false" :label="__('Star Rating')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="star_rating" id="{{$type.'_'.'star_rating' }}" :selected-value="isset($model) ? $model->getStarRating() : 0"></x-form.select>
                    </div> --}}









                    <x-form.date :readonly="false" :required="true" :id="'study-start-date'" :label="__('Study Start Date')" :name="'study_start_date'" :value="isset($model) ? $model->getStudyStartDate() : getCurrentDateForFormDate('date')" :inputClasses="'recalc-study-end-date study-start-date recalate-development-start-date recalate-operation-start-date'"></x-form.date>





                    <div class="col-md-4 mb-4">
                        <x-form.select :options="[
																		2=>['title'=>2 ,'value'=>'2'],
																		3=>['title'=>3 ,'value'=>'3'],
																		4=>['title'=>4 ,'value'=>'4'],
																		5=>['title'=>5 ,'value'=>'5'],
																		6=>['title'=>6 ,'value'=>'6'],
																		7=>['title'=>7 ,'value'=>'7'],
																		
																	  
																	  ]" :add-new="false" :is-required="true" :label="__('Duration In Years')" class="select2-select recalc-study-end-date study-duration" data-filter-type="{{ $type }}" :all="false" name="duration_in_years" id="{{$type.'_'.'duration_in_years' }}" :selected-value="isset($model) ? $model->getDurationInYears() : 0"></x-form.select>
                    </div>




                    <x-form.date :readonly="false" :required="true" :id="'study-end-date'" :label="__('Study End Date')" :name="'study_end_date'" :value="isset($model) ? $model->getStudyEndDate() : getCurrentDateForFormDate('date') " :inputClasses="''"></x-form.date>

                    <div class="col-md-4 mb-4">
                        <x-form.select :multiple="true" :options="getWeekDaysFormatted()" :add-new="false" :pleaseSelect="true" :is-required="true" :label="__('Choose Weekend Days')" class="select2-select " data-filter-type="{{ $type }}" :all="false" name="weekend_days" id="{{$type.'_'.'week_end_days' }}" :selected-value="isset($model) ? $model->getWeekEndDays() : 0"></x-form.select>
                    </div>

                    <div class="col-md-4 mb-4">
                        <x-form.select :multiple="false" :options="getWeekDaysFormatted()" :add-new="false" :is-required="false" :pleaseSelect="true" :label="__('Choose Day Off')" class="select2-select " data-filter-type="{{ $type }}" :all="false" name="day_off" id="{{$type.'_'.'day_off' }}" :selected-value="isset($model) ? $model->getDayOff() : 0"></x-form.select>
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


    {{-- Branches Section  --}}

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-10">
                    <div class="d-flex align-items-center ">
                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Branches [Planning Base]') }} </h3>
                        <input class="can-not-be-removed-checkbox" type="checkbox" name="has_branch_section" value="1" style="width:20px;height:20px" checked readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn active-style show-hide-repeater" data-query=".branch-repeater">{{ __('Show/Hide') }}</div>
                </div>
            </div>
            <div class="row">
                <hr style="flex:1;background-color:lightgray">
            </div>
            <div class="row">

                <div class="form-group row" style="flex:1;">
                    <div class="col-md-12 mt-3">
                        <div class="row">


                            <div class="col-md-12 mb-0 mt-0 text-left">
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
                                            <input type="radio" id="is-total-branches-1" value="1" name="is_total_branches" class="is-total-branches " @if(isset($model) && $model->isTotalBranch()) checked @endisset> {{ __('All Branches') }}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--danger text-black font-size-15px font-weight-bold">
                                            <input type="radio" id="is-total-branches-0" value="0" name="is_total_branches" class="is-total-branches " @if(!isset($model) || !$model->isTotalBranch()) checked @endisset> {{ __('Per Branch') }}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="total-branch-div">
                            @if(isset($model) && $model->branches->count() && $model->rooms->first()->food_type_id == 0 )
                            @foreach($model->branches as $branch)
                            @include('admin.quick-pricing-calculator.form.branches' , [
                            'branch'=>$branch ,
                            'onlyTotal'=>true ,
                            'removeRepeater'=>true
                            ])
                            @endforeach
                            @else
                            @include('admin.quick-pricing-calculator.form.branches' , [
                            'onlyTotal'=>true ,
                            'removeRepeater'=>true
                            ])

                            @endif
                        </div>

                        <div id="m_repeater_4" class="branches-repeater">
                            <div class="form-group  m-form__group row">
                                <div data-repeater-list="branches" class="col-lg-12">

                                    @if(isset($model) && $model->branches->count() )
                                    @foreach($model->branches as $branch)
                                    @include('admin.quick-pricing-calculator.form.branches' , [
                                    'branch'=>$branch
                                    ])
                                    @endforeach
                                    @else
                                    @include('admin.quick-pricing-calculator.form.branches' , [
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



    {{-- Accommodation & Rooms Section  --}}

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-10">
                    <div class="d-flex align-items-center ">
                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Menu Items') }} </h3>
                        <input class="can-not-be-removed-checkbox" type="checkbox" name="has_menu_section" value="1" style="width:20px;height:20px" checked readonly>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="btn active-style show-hide-repeater" data-query=".menus-repeater">{{ __('Show/Hide') }}</div>
                </div>
            </div>
            <div class="row">
                <hr style="flex:1;background-color:lightgray">
            </div>
            <div class="row">

                <div class="form-group row" style="flex:1;">
                    <div class="col-md-12 mt-3">
                        {{-- <div class="row">
                        <div class="col-md-12 mb-0 mt-0 text-left">
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
                </div> --}}

                {{-- <div class="total-room-div">
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
                    </div> --}}

                <div id="m_repeater_3" class="menus-repeater">
                    <div class="form-group  m-form__group row">
                        <div data-repeater-list="rooms" class="col-lg-12">

                            @if(isset($model) && $model->menus->count() && $model->rooms->first()->room_type_id != 0 )
                            @foreach($model->menus as $room)

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
                                @include('admin.quick-pricing-calculator.form.sales-channels-fb' , [
                                // 'positions'=>[] ,
                                'salesChannel'=>$salesChannel,
                                'index'=>$index
                                ])
                                @endforeach
                                @else
                                @include('admin.quick-pricing-calculator.form.sales-channels-fb' , [
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


<script src="{{ asset('custom/js/fb.js') }}"></script>

<script>
    $(function() {
        $('.is-total-branches:checked').trigger('change');
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
