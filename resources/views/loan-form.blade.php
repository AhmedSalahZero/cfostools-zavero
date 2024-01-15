@php
	$loan = $model->getLoanForSection($currentSectionName);
@endphp
<div class="row d-none " data-loan="{{ $currentSectionName }}">
				{{-- <input type="hidden" name="loans[{{ $currentSectionName }}][section_name]" value="{{ $currentSectionName }}"> --}}
                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">{{__('Fixed Loan Type')}}</label><span class="astric">*</span>
                        <div class="form-group-sub">
                            <select name="loans[{{ $currentSectionName }}][loan_type]" id="fixed_loan_type{{ $currentSectionName }}" class="form-control">
                                @foreach(getFixedLoanTypes() as $fixedType)
                                <option value="{{ $fixedType }}" 
                                {{ isset($loan) && ($loan->loan_type == $fixedType) ? 'selected' : ''  }}
                                >{{str_to_upper($fixedType)}}</option>
                                @endforeach
                            </select>
                           
                        </div>
                    </div>
                </div>


                {{-- <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">{{__('Loan Start Date')}}
                            <span class="astric">*</span>

                        </label>
                        <div class="form-group-sub">
                            <input
							value="{{ $loan ? $loan->start_date : null }}"
                            type="date" id="start-date{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][start_date]" class="form-control number interval-calcs" placeholder="{{__('Loan Start Date')}} {{__('Autoload')}}  .." />
                        </div>
                    </div>
                </div> --}}

{{-- 
                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Loan Amount')}}
                            <span class="astric">*</span>
                        </label>
                       
                        <div class="form-group-sub">
                            <input
                          
                                value="{{ $loan ? $loan->loan_amount:0 }}"
                            
                             type="number" step="any" id="loan_amount{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][loan_amount]" class="form-control number" placeholder="{{__('Loan Amount')}} .." required />
                           
                        </div>
                    </div>
                </div> --}}

                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Base Rate % ')}}
                            <span class="astric">*</span>
                        </label>
                        <div class="form-group-sub">
                            <input 
                            @if($loan && $loan->base_rate)
                            value="{{$loan->base_rate ?: old('base_rate')}}"
                            @endif 
                            type="number" step="any" id="base_rate{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][base_rate]" class="form-control number pricing-calc-item{{ $currentSectionName }}" placeholder="{{__('Base Rate')}} .." required />
                        
                        </div>
                    </div>
                </div>


                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Margin Rate % ')}}
                            <span class="astric">*</span>
                        </label>
                        <div class="form-group-sub">
                            <input
                              @if($loan && $loan->margin_rate)
                              value="{{$loan->margin_rate ?: old('margin_rate') }}"
                              @endif 
                             type="number" step="any" id="margin_rate{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][margin_rate]"  class="form-control number pricing-calc-item{{ $currentSectionName }}" placeholder="{{__('Margin Rate')}} .." required />
                            
                        </div>
                    </div>
                </div>



                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Pricing %')}}
                            {{-- <span class="astric">*</span> --}}
                        </label>
                        <div class="form-group-sub">
                            <input
                                value="{{$loan ? $loan->pricing : 0 }}"

                             readonly type="number" step="any" min="0" id="pricing{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][pricing]"  class="form-control number pricing-calc-item{{ $currentSectionName }}" placeholder="{{__('Pricing')}} .." required />
                         
                        </div>
                    </div>
                </div>

           
                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Tenor (Duration In Months) ')}}
                        </label><span class="astric">*</span>
                        <div class="form-group-sub">
                            <input 
                                value="{{$loan ? $loan->period :0 }}"
                            type="number" step="1" min="1" max="600" id="duration{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][period]"  class="form-control number grace_period_calc{{ $currentSectionName }} max-tenor-limit installment_condition" placeholder="{{__('Duration In Months')}} .." required />
                          
                        </div>
                    </div>
                </div>

                <div class="col-md-4 item-main-parent" style="display: none">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Grace Period')}} ( {{__('Months')}} )
                            <span class="astric">*</span>
                        </label>
                        <div class="form-group-sub">
                            <input 
                         
                                value="{{$loan ? $loan->getGracePeriod() : 0 }}"
                            
                          

                            type="text" step="any" id="grace_periodid{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][grace_period]" class="form-control number grace_period_calc{{ $currentSectionName }} installment_condition" placeholder="{{__('Grace Period')}} .." />
                           
                        </div>
                    </div>
                </div>


                <div class="col-md-4 item-main-parent" style="display: none">
                    <div class="form-group validated">
                        
						<label class="form-label font-weight-bold">{{__('Capitalization Type')}}</label>
						
                        <div class="form-group-sub">
                            <select disabled  id="capitalization_type{{ $currentSectionName }}" class="form-control">
                                <option value="with_capitalization" {{ @old('capitalization_type') == 'with_capitalization' ? 'selected' : '' }}
                                
                                          @if($loan && $loan->capitalization_type == 'with_capitalization')
                            selected
                 
                             @endif 

                                >{{__('With Capitalization')}}</option>
                                <option 
                                    @if($loan && $loan->capitalization_type == 'without_capitalization')
                            selected
                 
                             @endif 

                                
                                value="without_capitalization" >{{__('Without Capitalization')}}</option>
                            </select>
                         <input type="hidden" name="loans[{{ $currentSectionName }}][capitalization_type]" value="{{ $loan && $loan->capitalization_type ? $loan->capitalization_type:null }}">
                        </div>
                    </div>
                </div>



                <div class="col-md-4 item-main-parent">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">{{__('Installment Payment Interval')}}</label><span class="astric">*</span>
                        <div class="form-group-sub">
                            <select name="loans[{{ $currentSectionName }}][installment_interval]" id="installment_interval{{ $currentSectionName }}" class="form-control installment_condition">
                                <option value="" selected disabled>{{__('Select')}} ..</option>
                                <option
                                  @if($loan && $loan->installment_interval == 'monthly')
    		                        selected
	
                             @endif 

                                 value="monthly"  data-order="1">{{__('Monthly')}}</option>
                                <option 
                                  @if($loan && $loan->installment_interval == 'quartly')
                            selected
                 
                             @endif 

                                value="quartly" {{ @old('installment_interval') == 'quartly' ? 'selected' : '' }} data-order="2">{{__('Quarterly')}}</option>
                                <option
                                @if($loan && $loan->installment_interval == 'semi annually')
                            selected
                 
                             @endif 

                                 value="semi annually" {{ @old('installment_interval') == 'semi annually' ? 'selected' : '' }} data-order="3">{{__('Semi-annually')}}</option>
                            </select>
                           
                        </div>
                    </div>
                </div>






                <div class="col-md-4 item-main-parent" style="display: none">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Step-up Rate ( % ) ')}}
                            {{-- <span class="astric">*</span> --}}
                        </label><span class="astric">*</span>
                        <div class="" id="step-up-id{{ $currentSectionName }}">
                            <div class="form-group-sub">
                                <input 
                                value="{{$loan ? $loan->step_up_rate : 0  }}"

                                type="number" step="any" min="0" max="100" id="step_up_rate{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][step_up_rate]" class="form-control number" placeholder="{{__('Step-up Rate')}} .."  />
                               
                            </div>
                        </div>
                    </div>
                </div>

       

                <div class="col-md-4 item-main-parent" style="display: none">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">{{__('Step-up Interval')}}</label><span class="astric">*</span>
                        <div class="form-group-sub">
                            <select name="loans[{{ $currentSectionName }}][step_up_interval]" id="step_up_interval{{ $currentSectionName }}" class="form-control interval-calcs">
                                <option value="" selected disabled>{{__('Select')}} ..</option>
                                {{-- <option value="monthly" {{ @old('step_up_interval') == 'monthly' ? 'selected' : '' }}>{{__('Monthly')}}</option> --}}
                                <option
                                 value="quartly" {{ @old('step_up_interval') == 'quartly' ? 'selected' : '' }}>{{__('Quarterly')}}</option>
                                <option
                                   @if($loan && $loan->step_up_interval == 'semi annually')
                            selected
                 
                             @endif 


                                 value="semi annually" >{{__('Semi-annually')}}</option>
                                <option
                                
                                    @if($loan && $loan->step_up_interval == 'annually')
                            selected
                 
                             @endif 

                                 value="annually" {{ @old('step_up_interval') == 'annually' ? 'selected' : '' }}>{{__('Annually')}}</option>
                            </select>
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-4 item-main-parent" style="display: none">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">
                            {{__('Step-down Rate ( % ) ') . ' ' . __('Please Insert Negative Number')}}
                            {{-- <span class="astric">*</span> --}}
                        </label>
                        <div class="form-group-sub">
                            <input
                            



                                value="{{$loan ? $loan->step_down_rate :0 }}"
	                             type="text" 
                             
                             step="any" id="step_down_rate{{ $currentSectionName }}" name="loans[{{ $currentSectionName }}][step_down_rate]"  class="form-control negative-numbers" placeholder="{{__('Step-down Rate')}} .."  />
                           
                        </div>
                    </div>
                </div>


                <div class="col-md-4 item-main-parent" style="display: none">
                    <div class="form-group validated">
                        <label class="form-label font-weight-bold">{{__('Step-down Interval')}}</label> <span class="astric">*</span>
                        <div class="form-group-sub">
                            <select name="loans[{{ $currentSectionName }}][step_down_interval]" id="step_down_interval{{ $currentSectionName }}" class="form-control interval-calcs">
                                <option value="" selected disabled>{{__('Select')}} ..</option>
                                <option 
                                      @if($loan && $loan->step_down_interval == 'quartly')
                            selected
                 
                             @endif 

                                value="quartly">{{__('Quarterly')}}</option>
                                <option 
                                      @if($loan && $loan->step_down_interval == 'semi annually')
                            selected
                 
                             @endif 

                                value="semi annually" {{ @old('step_down_interval') == 'semi annually' ? 'selected' : '' }}>{{__('Semi-annually')}}</option>
                                <option 
                                      @if($loan && $loan->step_down_interval == 'annually')
                            selected
                 
                             @endif 

                                value="annually" {{ @old('step_down_interval') == 'annually' ? 'selected' : '' }}>{{__('Annually')}}</option>
                            </select>
                           
                        </div>
                    </div>
                </div>

            </div>
@push('js')
	
<script>
    $('#fixed_loan_type{{ $currentSectionName }}').on('change', function() {
        let loanType = $(this).val();
        if (loanType == 'step-up' ||
            loanType == 'grace_step-up_with_capitalization' ||
            loanType == 'grace_step-up_without_capitalization'
        ) {
            $('#step_up_rate{{ $currentSectionName }}').closest('.item-main-parent').fadeIn(300);
            $('#step_up_interval{{ $currentSectionName }}').closest('.item-main-parent').fadeIn(300);
        } else {

            $('#step_up_rate{{ $currentSectionName }}').val(0).closest('.item-main-parent').fadeOut(300);
            $('#step_up_interval{{ $currentSectionName }}').val(0).closest('.item-main-parent').fadeOut(300);
        }


        if (loanType == 'step-down' ||
            loanType == 'grace_step-down_with_capitalization' ||
            loanType == 'grace_step-down_without_capitalization'

        ) {
            $('#step_down_rate{{ $currentSectionName }}').closest('.item-main-parent').fadeIn(300);
            $('#step_down_interval{{ $currentSectionName }}').closest('.item-main-parent').fadeIn(300);
        } else {

            $('#step_down_rate{{ $currentSectionName }}').val(0).closest('.item-main-parent').fadeOut(300);
            $('#step_down_rate{{ $currentSectionName }}').val(0).trigger('change');
            $('#step_down_interval{{ $currentSectionName }}').val(0).closest('.item-main-parent').fadeOut(300);
        }

        if (loanType != 'normal' && loanType != 'step-down' && loanType != 'step-up') {
		 // FIXME:grace period 
            $('#grace_periodid{{ $currentSectionName }}').closest('.item-main-parent').fadeIn(300);
            $('#capitalization_type{{ $currentSectionName }}').val(0).closest('.item-main-parent').fadeIn(300);
            if (loanType == 'grace_step-up_with_capitalization' || loanType == 'grace_period_with_capitalization' ||
                loanType == 'grace_step-down_with_capitalization'

            ) {
                $('#capitalization_type{{ $currentSectionName }}').find('option:nth-child(1)').prop('selected', true);

            } else {
                $('#capitalization_type{{ $currentSectionName }}').find('option:nth-child(2)').prop('selected', true);
            }
        } else {
		
            $('#grace_periodid{{ $currentSectionName }}').closest('.item-main-parent').fadeOut(300);
            $('#capitalization_type{{ $currentSectionName }}').closest('.item-main-parent').fadeOut(300);
        }


    }).trigger('change')


    $(document).on('keyup', '.pricing-calc-item{{ $currentSectionName }}', function() {
        let base_rate = $('#base_rate{{ $currentSectionName }}').val();
        let margin_rate = $('#margin_rate{{ $currentSectionName }}').val();
        if (isPercentageNumber(base_rate) && isPercentageNumber(margin_rate)) {
            let pricing = parseFloat(base_rate) + parseFloat(margin_rate);
            $('#pricing{{ $currentSectionName }}').val(pricing);
        } else if (isPercentageNumber(base_rate)) {
            let pricing = parseFloat(base_rate);
            $('#pricing{{ $currentSectionName }}').val(pricing);
        } else if (isPercentageNumber(margin_rate)) {
            let pricing = parseFloat(margin_rate);
            $('#pricing{{ $currentSectionName }}').val(pricing);
        } else {
            $('#pricing{{ $currentSectionName }}').val(0);
        }

    })

    $(document).on('keyup', '.grace_period_calc{{ $currentSectionName }}', function() {
        let duration = parseFloat($('#duration{{ $currentSectionName }}').val());
        let gracePeriod = parseFloat($('#grace_periodid{{ $currentSectionName }}').val()) ? parseFloat($('#grace_periodid{{ $currentSectionName }}').val()) : 0;
        if (gracePeriod != 0 && gracePeriod >= duration - 1) {
            $('#grace_periodid{{ $currentSectionName }}').val(duration - 2);
        }
    });
    // $('#fixed_loan_type')

</script>




<script>
    $('#installment_interval{{ $currentSectionName }}').on('change', function() {
        let selectedOption = $(this).find('option:selected').data('order');
        $('#step_up_interval{{ $currentSectionName }}').find('option').each(function(index, opt) {
            if ($(opt).data('order') < selectedOption) {
                $(opt).prop('disabled', true);
                $(opt).css('display', 'none');
            } else {
                $(opt).prop('disabled', false);
                $(opt).css('display', 'initial');

            }
        });



        $('#step_down_interval{{ $currentSectionName }}').find('option').each(function(index, opt) {
            if ($(opt).data('order') < selectedOption) {
                $(opt).prop('disabled', true);
                $(opt).css('display', 'none');
            } else {
                $(opt).prop('disabled', false);
                $(opt).css('display', 'initial');

            }
        });
        if (!$('#step_up_interval{{ $currentSectionName }}').find('option:nth-child(4):selected').length) {
            if (!$('#page-is-loading').length) {
                $('#step_up_interval{{ $currentSectionName }}').find('option:nth-child(1)').prop('selected', 1);

            }
        }

        if (!$('#step_down_interval{{ $currentSectionName }}').find('option:nth-child(4):selected').length) {
            if (!$('#page-is-loading').length) {
                $('#step_down_interval{{ $currentSectionName }}').find('option:nth-child(1)').prop('selected', 1);
            }
        }

        $('#page-is-loading').remove();
    }).trigger('change');

</script>
@endpush
