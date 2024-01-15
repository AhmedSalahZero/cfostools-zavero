@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>

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
                                    {{ $product->getName() . ' / ' . __('Production Capacity')  }}
                                </h3>


                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="btn active-style show-hide-repeater" data-query=".exhange-rate-projection{{ $product->id }}">{{ __('Show/Hide') }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <hr style="flex:1;background-color:lightgray">
                    </div>
                    <div class="row exhange-rate-projection{{ $product->id }}">


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('Item') }}</th>
                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)
                                        <th class="text-center"> {{ __('Yr-') }}{{$yearIndexWithYear[$year]}} </th>
                                        @endforeach
                                        {{-- <th class="text-center">{{__('Total')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $currentTotal = [];

                                    @endphp
                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Operating Months Per Year') }}
                                            </b>
                                        </td>
                                        @php
                                        //$order = 1 ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>

                                            @php
                                            @endphp


                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ sumNumberOfOnes($yearsWithItsMonths,$year,$datesIndexWithYearIndex) }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-percentage-allowed size" data-date="#" data-section="target" aria-describedby="basic-addon2">
                                                    <span class="ml-2">
                                                        <b style="visibility:hidden">%</b>
                                                    </span>
                                                </div>
                                            </div>

                                        </td>

                                        @endforeach

                                    </tr>




                                    <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Production Lines Count (minimum 1)'  ) }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 2 + $product->id  ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td>
                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'production_lines_count') ?? 0 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size" data-year="{{ $year }}">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="production_lines_count[{{ $product->id }}][{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                    </tr>
									
									
									
									
									
									
									
									
									   <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
											@php
												$netWorkingType   =$model->getProductionLineForProductAtYear($product->id,0,'net_working_hours_type');
											@endphp
                                                <select name="type[{{ $product->id }}]"  class="form-control net-working-hours-js" style="max-width:450px;">
												
													<option @if($netWorkingType == 'annual')  selected @endif  value="annual">{{ __('Net Working Hours Per Days (Annuall Average)'  ) }}</option>
													<option @if($netWorkingType == 'quarter')  selected  @endif  value="quarter">{{ __('Net Working Hours Per Days (Quarter Average)'  ) }}</option>
												</select>
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 + $product->id  ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td class="td-for-annually">

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'net_working_hours_per_days') ?? 0 ;
										
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal && !is_array($currentVal)? $currentVal:  0  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size" data-year="{{ $year }}">
                                                    <input type="hidden" value="{{ $currentVal && !is_array($currentVal)? $currentVal:  0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="net_working_hours_per_days[{{ $product->id }}][annual][{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                  	  </tr>
									  
									  @foreach(['q1','q2','q3','q4'] as $qIndex=>$quarter)
									  {{-- {{ dd($currentVal,'w') }} --}}
									   <tr class="quarter-row-js" style="">
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b style="padding-left:20px;">
                                                {{ __('Quarter ['. $quarter .'] - Net Working Hours Per Day') }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 1 + $product->id +  ($qIndex+1) ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td class="td-for-quarters">

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'net_working_hours_per_days') ?? 0 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal && is_array($currentVal) ? $currentVal[$qIndex] : 0  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size" data-year="{{ $year }}">
                                                    <input type="hidden" value="{{ $currentVal && is_array($currentVal) ? $currentVal[$qIndex] : 0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="net_working_hours_per_days[{{ $product->id }}][quarter][{{ $year }}][]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                  	  </tr>
									  
									  @endforeach 
									  
									  
									  <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Maximum Working Days Per Year') }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 3 + $product->id  ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td >

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'max_working_days_per_year') ?? 0 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size" data-year="{{ $year }}">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="max_working_days_per_year[{{ $product->id }}][{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                  	  </tr> 
									  <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Production Capacity '. \App\Models\ProductionUnitOfMeasurement::getNameById($product->pivot ? $product->pivot->production_uom : 0)  .'/Hour') }}
                                            </b>
                                        </td>
                                        @php
                                        $order = 3 + $product->id  ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td >

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'production_capacity_per_hour') ?? 0 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size" data-year="{{ $year }}">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="production_capacity_per_hour[{{ $product->id }}][{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                  	  </tr> 
									  <tr>
                                        <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
                                            <b>
                                                {{ __('Maximum Production '.  \App\Models\ProductionUnitOfMeasurement::getNameById($product->pivot ? $product->pivot->production_uom : 0) .'/Hour'   ) }}
												{{-- (Auto Calculated) --}}
                                            </b>
                                        </td>
                                        @php
                                        $order = 3 + $product->id  ;

                                        @endphp

                                        @foreach($yearsWithItsMonths as $year=>$monthsForThisYearArray)

                                        <td >

                                            @php
                                            $currentVal = $model->getProductionLineForProductAtYear($product->id,$year,'max_production_per_hour') ?? 0 ;
                                            @endphp
                                            <div class="form-group three-dots-parent">
                                                <div class="input-group input-group-sm align-items-center justify-content-center ">
                                                    <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ $currentVal  }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts only-greater-than-zero-allowed size" data-year="{{ $year }}">
                                                    <input type="hidden" value="{{ $currentVal ??0 }}" data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" name="max_production_per_hour[{{ $product->id }}][{{ $year }}]" data-year="{{ $year }}">
                                                    <span class="ml-2">
                                                        {{-- <b>%</b> --}}
                                                    </span>
                                                </div>
                                                <i class="fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order??1 }}" data-index="{{ $index??0 }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i>
                                            </div>

                                        </td>
                                        @php
                                        $order = $order +1 ;
                                        @endphp

                                        @endforeach


                                  	  </tr>
									  
									





                                </tbody>
                            </table>
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
$(document).on('change','.net-working-hours-js',function(){
	const val = $(this).val();
	if(val == 'quarter'){
		$('.td-for-annually input').val(1).trigger('change').prop('disabled',true);		
		$('.quarter-row-js').show();
	}else{
		$('.td-for-annually input').val(1).prop('disabled',false);		
		$('.quarter-row-js').hide();
	}
})
$('.net-working-hours-js').trigger('change');
</script>

@endsection
