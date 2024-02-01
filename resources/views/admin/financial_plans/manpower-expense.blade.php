	@php
	$canViewAddManpowerBtn =true;
	@endphp
	{{-- start of Rooms Manpower Expenses--}}
	<input type="hidden" name="has_manpower_expense" value="1">
	<div class="kt-portlet">
	    <div class="kt-portlet__body">
	        <div class="row">



	            <div class="col-md-10">
	                {{-- <div class="d-flex align-items-center "> --}}
	                <div class="row">
	                    <div class="col-md-4">
	                        <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('How many Positions You Want To Add') }} </h3>
	                    </div>
	                    <div class="col-md-1">
	                        <input type="numeric" class="form-control mr-4" style="max-width:200px;" name="no_expenses" value="{{ $noManpowerExpenses }}">
	                    </div>
	                    <div class="col-md-2">
	                        <div class="kt-input-icon max-w-170px mx-auto">
	                            <div class="input-group date">
	                                <input type="text" name="recruit_date" placeholder="{{ __('Recruit Date') }}" class="form-control only-month-year-picker date-input" value="{{ $recruitDate ?  $recruitDate :''   }}" />
	                                <div class="input-group-append">
	                                    <span class="input-group-text">
	                                        <i class="la la-calendar"></i>
	                                    </span>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                {{-- <input class="form-control"  type="date" name="recruit_date" value="{{ $date }}" style="width:20px;height:20px" @if(isset($model) && $model->hasRoomsManpower()) checked @elseif(!isset($model)) checked @endif > --}}
	                {{-- </div> --}}
	            </div>
	            <div class="col-md-2">
	                @if(!$noManpowerExpenses)
	                <input data-redirect-to-same-page="1" type="submit" class="btn active-style save-form" value="{{ __('Save') }}">
	                @endif
	                {{-- <div class="btn active-style show-hide-repeater" data-query=".guest-capture-meal-value-per-guest-method">{{ __('Show/Hide') }}</div> --}}
	        </div>
	    </div>
	    <div class="row">
	        <hr style="flex:1;background-color:lightgray">
	    </div>
	    @if($noManpowerExpenses)
	    <div class="row guest-capture-meal-value-per-guest-method">

	        <div class="table-responsive ">
	            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2">
	                <thead>
	                    <tr>
	                        <th class="text-center">{{ __('Department Name') }}</th>
	                        <th class="text-center">{{ __('Position Name') }}</th>
	                        <th class="text-center">{{ __('Current Net Salary') }}</th>
	                        <th class="text-center">{{ __('Choose Currency') }}</th>
	                        <th class="text-center">{{ __('Estimation Date') }}</th>
	                        <th class="text-center">{{ __('Escalation Rate %') }}</th>
	                        <th class="text-center">{{ __('Net Salary At Operation Date') }}</th>
	                        <th class="text-center">{{ __('Annual Escalation Rate %') }}</th>
	                        <th class="text-center">{{ __('Salary Taxes %') }}</th>
	                        <th class="text-center">{{ __('Social Insurance %') }}</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    {{-- we need for loop instead of foreach and it must be 6 loops  --}}
	                    {{-- @for($instance=0 ; $instance<5 ; $instance++) --}}

	                    @for($instance=0 ; $instance< $noManpowerExpenses ; $instance++) @php $directExpense=$model->getDirectExpenseForSection($modelName,$expenseType , $instance);
	                        @endphp

	                        <tr>

	                            {{-- Foods Types	 --}}
	                            @php
	                            $order = 1 ;
	                            @endphp
	                            <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
	                                <input type="text" class="form-control placeholder-light-gray exclude-text" name="department_name[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getDepartmentName() : null }}" placeholder="{{ __('Please Enter Department Name...') }}">
	                            </td>
	                            @php
	                            $order = 2 ;
	                            @endphp
	                            <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
	                                <input type="text" class="form-control placeholder-light-gray exclude-text" name="name[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}" placeholder="{{ __('Please Enter Expense Name...') }}">
	                                <input type="hidden" class="form-control placeholder-light-gray" name="old_name[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getName() : null }}" placeholder="{{ __('Please Enter Expense Name...') }}">
	                            </td>


	                            @php
	                            $order = 3 ;
	                            @endphp

	                            {{-- Cover Value	 --}}
	                            <td>
	                                <div class="form-group three-dots-parent">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <input data-calc-adr-operating-date type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{  number_format($directExpense ? $directExpense->getCurrentNetSalary() : 0)  }}" data-order="{{ $order }}" data-index="{{ $instance }}" data-id="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts avg-daily-rate   size ">
	                                        <input data-id="{{ $instance }}" type="hidden" name="current_net_salary[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getCurrentNetSalary() :0 }}" data-order="{{ $order }}" data-index="{{ $instance }}" data-id="{{ $instance }}">
	                                    </div>
	                                </div>
	                            </td>

	                            @php
	                            $order = 4 ;
	                            @endphp

	                            {{-- Choose Currency	Td --}}
	                            <td>
	                                <div class="form-group three-dots-parent">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <select name="chosen_currency[{{ $expenseType }}][{{ $instance }}]" data-order="{{ $order }}" class="form-control ">
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
	                            $order =5 ;
	                            @endphp

	                            {{-- Estimation Date	 --}}
	                            <td>
	                                <div class="form-group three-dots-parent">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <input type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $model->getStudyStartDateFormattedForView() }}" data-order="{{ $order }}" data-index="{{ $instance }}" readonly onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" class="form-control target_repeating_amounts  size">

	                                    </div>
	                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
	                                </div>
	                            </td>

	                            @php
	                            $order = 6;
	                            @endphp



	                            {{-- Cover Value Escalation Rate %	 --}}

	                            <td>

	                                <div class="form-group three-dots-parent three-dots-column">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">

	                                        <div class="custom--i-class-parent">
	                                            <input data-calc-adr-operating-date type="text" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $directExpense ? number_format($directExpense->getEscalationRate(),1):0 }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" data-id="{{ $instance }}" class="form-control target_repeating_amounts only-percentage-allowed size avg-daily-rate largest-width ">
	                                            <input class="cover-value-escalation-rate" type="hidden" name="escalation_rate[{{ $expenseType }}][{{ $instance }}]" data-id="{{ $instance }}" value="{{ $directExpense ? $directExpense->getEscalationRate() : 0  }}" data-order="{{ $order }}" data-index="{{ $instance }}">
	                                            <i data-repeating-direction="column" class="custom--i-class fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $order }}" data-section="target" title="Copy Column"></i>

	                                        </div>
	                                        <span class="ml-2">
	                                            <b>%</b>
	                                        </span>
	                                    </div>
	                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
	                                </div>

	                            </td>


	                            @php
	                            $order = 7 ;
	                            @endphp

	                            {{-- Cover Value At Operation Date	 --}}
	                            <td>

	                                <div class="form-group three-dots-parent">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <input readonly type="text" data-id="{{ $instance }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $directExpense ? number_format($directExpense->getNetSalaryAtOperationDate(),0) :0 }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size html-for-adr_at_operation_date" data-date="#" aria-describedby="basic-addon2">
	                                        <input class="value-for-adr_at_operation_date" name="net_salary_at_operation_date[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getNetSalaryAtOperationDate() : null }}" data-id="{{ $instance }}" type="hidden">

	                                    </div>
	                                </div>

	                            </td>


	                            @php
	                            $order = 8 ;
	                            @endphp


	                            {{-- Annual Escalation %	 --}}




	                            <td>

	                                <div class="form-group three-dots-parent three-dots-column">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <div class="custom--i-class-parent">
	                                            <input type="text" data-id="{{ $instance }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $directExpense ? number_format($directExpense->getAnnualEscalationRate(),1) :0 }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size largest-width" data-date="#" aria-describedby="basic-addon2">
	                                            <input name="annual_escalation_rate[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getAnnualEscalationRate() : null }}" data-id="{{ $instance }}" type="hidden">
	                                            <i data-repeating-direction="column" class="custom--i-class fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $order }}" data-section="target" title="Copy Column"></i>

	                                        </div>
	                                        {{-- <span class="ml-2">
                                                        <b>%</b>
                                                    </span> --}}
	                                    </div>
	                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
	                                </div>

	                            </td>


	                            {{-- Salary Taxes %	 --}}
	                            @php
	                            $order = 9 ;
	                            @endphp
	                            <td>

	                                <div class="form-group three-dots-parent three-dots-column">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <div class="custom--i-class-parent">
	                                            <input type="text" data-id="{{ $instance }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $directExpense ? number_format($directExpense->getSalaryTaxes(),1) :0 }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size largest-width" data-date="#" aria-describedby="basic-addon2">
	                                            <input name="salary_taxes[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getSalaryTaxes() : null }}" data-id="{{ $instance }}" type="hidden">
	                                            <i data-repeating-direction="column" class="custom--i-class fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $order }}" data-section="target" title="Copy Column"></i>

	                                        </div>

	                                    </div>
	                                </div>

	                            </td>

	                            @php
	                            $order =10 ;
	                            @endphp


	                            {{-- Social Insurance %	 --}}

	                            <td>

	                                <div class="form-group three-dots-parent three-dots-column">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center div-for-percentage">
	                                        <div class="custom--i-class-parent">
	                                            <input type="text" data-id="{{ $instance }}" style="max-width: 100px;min-width: 80px;text-align: center" value="{{ $directExpense ? number_format($directExpense->getSocialInsurance(),1) :0 }}" data-order="{{ $order }}" data-index="{{ $instance }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" step="0.1" class="form-control target_repeating_amounts size largest-width" data-date="#" aria-describedby="basic-addon2">
	                                            <input name="social_insurance[{{ $expenseType }}][{{ $instance }}]" value="{{ $directExpense ? $directExpense->getSocialInsurance() : null }}" data-id="{{ $instance }}" type="hidden">
	                                            <i data-repeating-direction="column" class="custom--i-class fa fa-ellipsis-h pull-left target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $order }}" data-section="target" title="Copy Column"></i>

	                                        </div>
	                                        {{-- <span class="ml-2">
                                                        <b>%</b>
                                                    </span> --}}
	                                    </div>
	                                    {{-- <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $instance }}" data-year="{{ $year }}" data-section="target" title="{{__('Repeat Right')}}"></i> --}}
	                                </div>

	                            </td>
	                            @php
	                            $order = $order +1 ;
	                            @endphp

	                        </tr>
	                        @endfor




	                </tbody>
	            </table>

	        </div>

	        @php
	        $canViewAddManpowerBtn = !count($model->getDirectExpensesForSection($modelName , $expenseType));
	        @endphp
	        {{-- {{ dd($canViewAddManpowerBtn) }} --}}

	        <div class="col-12 mb-3 mt-3">
	            <input type="submit" class="btn active-style save-form" data-redirect-to-same-page="1" data-add-manpower-count="1" value="{{ __('Add Manpower Count') }}">

	        </div>
	        @if(count($model->getDirectExpensesForSection($modelName , $expenseType)))
	        <div class="table-responsive " id="manpower-count-table">
	            <table class="table table-striped table-bordered table-hover table-checkable kt_table_2 ">
	                <thead>
	                    <tr>
	                        <th class="text-center" style="white-space:nowrap;">{{ __('Position Name') }}</th>
	                        @foreach($dates= getMaxNumberFromFirstArray($dates,24) as $dateString=>$date)
	                        <th class="text-center"> {{ formatDateForView($dateString) }} </th>
	                        @endforeach
	                    </tr>
	                </thead>
	                <tbody>
	                    @php
	                    $currentTotal = [];

	                    @endphp

	                    @for($instance=0 ; $instance<8 ; $instance++) @php $directExpense=$model->getDirectExpenseForSection($modelName,$expenseType , $instance);
	                        @endphp
	                        @if($directExpense)
	                        <tr>
	                            <td style="vertical-align:middle;text-transform:capitalize;text-align:left">
	                                <input style="width:max-content !important;" readonly type="text" class="form-control placeholder-light-gray trigger-change-when-start" value="{{ $directExpense ? $directExpense->getName():null }}" placeholder="{{ __('Please Position Name...') }}">
	                            </td>


	                            @php
	                            $order = 1 ;

	                            @endphp

	                            @foreach($dates as $date)

	                            <td>

	                                @php
	                                $currentVal = $directExpense ? $directExpense->getManpowerPayloadAtDate($date) : 0;
	                                $currentTotal[$date]=isset($currentTotal[$date]) ? $currentTotal[$date] + $currentVal : $currentVal;
	                                @endphp
	                                <div class="form-group three-dots-parent">
	                                    <div class="input-group input-group-sm align-items-center justify-content-center ">
	                                        <input type="text" style="max-width: 60px;min-width: 60px;text-align: center" value="{{ number_format($currentVal,0) }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" onchange="this.style.width = ((this.value.length + 1) * 10) + 'px';" data-total-must-be-100="1" class="form-control target_repeating_amounts only-greater-than-or-equal-zero-allowed size" data-year="{{ $date }}">
	                                        <input type="hidden" value="{{ $currentVal }}" data-order="{{ $order }}" data-index="{{ $instance ??0 }}" name="manpower_payload[{{ $expenseType }}][{{ $instance }}][{{ $date }}]">

	                                        <span class="ml-2">
	                                            <b>#</b>
	                                        </span>
	                                    </div>
	                                    <i class="fa fa-ellipsis-h pull-{{__('left')}} target_last_value " data-order="{{ $order }}" data-index="{{ $instance ??0 }}" data-year="{{ $date }}" data-section="target" title="{{__('Repeat Right')}}"></i>
	                                </div>

	                            </td>
	                            @php
	                            $order = $order +1 ;
	                            @endphp
	                            @endforeach

	                        </tr>
	                        @endif

	                        @endfor





	                </tbody>
	            </table>
	        </div>
	        @endif











	    </div>




	    @endif




	</div>

	</div>



	@if($noManpowerExpenses && $expenseType == 'ManufacturingExpenses')
	<div class="kt-portlet">
	    <div class="kt-portlet__body">

	        <div class="row ">
	            <div class="col-md-4">
	                <h3 class="font-weight-bold form-label kt-subheader__title small-caps mr-5" style=""> {{ __('Allocate Mnafacturing Salaries Over products') }} </h3>
	            </div>
	            <div class="col-md-4">
	                <select  name="manufacturing_products_allocations_type" class="form-control manufacturing_products_allocations_type-js" id="">
	                    @foreach(['sales-percentage'=>__('Sales Percentage') , 'equally'=>__('Equally') , 'based-on-production-working-hours' => __('Based On Production Working Hours'),'customize'=>__('Customize')] as $key=>$title)
	                    <option @if($model->manufacturing_products_allocations_type == $key) selected @endif value="{{ $key }}">{{ $title }}</option>
	                    @endforeach
	                </select>
	            </div>
	        </div>
	        {{-- @endforeach  --}}
	    </div>
	</div>

	<div class="kt-portlet" id="kt-portlet__body-js">
	    <div class="kt-portlet__body">
	        <div class="row" id="added_rows">
	            @foreach($products as $product)
				@php
					$manufacturingProductAllocation = $model->manufacturingProductsAllocations()->where('product_id',$product->id)->first() ;
				@endphp
	            <div class="col-md-6">
	                <div class="form-group validated">
	                    <label class="form-label font-weight-bold"> {{__("Product")}} @include('star') </label>
	                    <div class="form-group-sub">
	                        <input  type="text" class="form-control" readonly value="{{ $product->getName() }}" />
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="form-group validated">
	                    <label class="form-label font-weight-bold"> {{__("Percentage")}} @include('star')</label>
	                    <div class="form-group-sub">
						
	                        <input type="number" name="manufacturing_allocations[{{ $product->id }}]" class="form-control only-percentage-allowed" value="{{ $manufacturingProductAllocation ? $manufacturingProductAllocation->pivot->percentage : 0 }}"  placeholder="{{ __('Percentage') }}">
	                    </div>
	                </div>
	            </div>
	            @endforeach



	        </div>
	    </div>
	</div>
	@endif


	{{-- end of Rooms Manpower Expenses --}}
	@if(!$canViewAddManpowerBtn)
	<x-save-or-back :btn-text="__('Create')" />
	@else
	<x-save-or-back :isHidden="true" :btn-text="__('Create')" />
	@endif
	@push('js')

	@if(!$canViewAddManpowerBtn)

	@else

	<script>
	    $(document).on('change', '.manpower-select', function() {
	        let isChecked = $(this).is(':checked');
	        if (!isChecked) {
	            $('.btn-for-submit--js').removeClass('d-none')
	        } else {

	            $('.btn-for-submit--js').addClass('d-none')
	        }
	    })
	    $(function() {
	        $('.manpower-select').trigger('change');
	    })

	</script>
	@endif

	<script>
	    $(document).on('change', '[data-calc-adr-operating-date]', function() {
	        const power = parseFloat($('#daysDifference').val());
	        const roomTypeId = $(this).attr('data-id');
	        const parent = $(this).closest('table')
	        let avgDailyRate = parent.find('.avg-daily-rate[data-id="' + roomTypeId + '"]').val();
	        avgDailyRate = number_unformat(avgDailyRate)

	        const ascalationRate = parent.find('.cover-value-escalation-rate[data-id="' + roomTypeId + '"]').val() / 100;
	        const result = avgDailyRate * Math.pow(((1 + ascalationRate)), power)
	        parent.find('.value-for-adr_at_operation_date[data-id="' + roomTypeId + '"]').val(result)
	        parent.find('.html-for-adr_at_operation_date[data-id="' + roomTypeId + '"]').val(number_format(result))

	    })
		$(document).on('change','.manufacturing_products_allocations_type-js',function(){
			const val = $(this).val()
			if(val == 'customize'){
				$('#kt-portlet__body-js').show()
			}else{
				$('#kt-portlet__body-js').hide()
			}
			
		})
		$('.manufacturing_products_allocations_type-js').trigger('change');

	</script>
	@endpush
