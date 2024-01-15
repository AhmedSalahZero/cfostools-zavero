<form class="kt-form kt-form--label-right" id="create-form" method="POST" action="{{isset($manpower_plan) ? route('ManPowers.update',['company_id' => $company->id,'financial_id'=>$financial->id,'manpower_plan_id'=>$manpower_plan->id]):route('ManPowers.store',['company_id'=>$company_id,'financial_id'=>$financial->id])}}">
    {{ csrf_field() }}
    {{isset($manpower_plan) ?  method_field('PUT') : ''}}
    <!-- Name -->
    <div class="kt-portlet">
        <div class="kt-portlet__body" >
            <div class="form-group row validated">
                <label class="col-form-label col-lg-2 col-sm-12 take">{{__('Name')}} <span class="astric">*</span></label>
                <div class="col-lg-10 col-md-10 col-sm-12 form-group-sub">
                    <input type="text" name="name" class="form-control" placeholder="{{__('Enter')}} {{__('Name')}}" value="{{@$plan['name']}}" />
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                    @if ($errors->has('name_count'))
                    <div class="invalid-feedback">{{ $errors->first('name_count') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->

    <!-- Duration -->
    <?php 
        $financial_start_date = date('m/d/Y',strtotime($financial->start_date));
      ?>
    <!-- ////////////////////////////////////// -->

    <!-- Department information -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <h4>{{__('Department information')}}</h4>

            <div class="row">
                <!-- Department -->
                <div class="col-md-4">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Department')}}</label>
                        <div class="form-group-sub">
                            <select name="department" id="department" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" @if(isset($manpower_plan) ) {{((isset($manpower_plan_department)) && ($manpower_plan_department != 0) && ($manpower_plan_department == $department->id)) ? 'selected' : ''}} @else {{@old('department') == $department->id ? 'selected' : '' }} @endif>{{$department->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('department'))
                            <div class="invalid-feedback">{{ $errors->first('department') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Position -->
                <div class="col-md-4">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Position')}}</label>
                        <div class="form-group-sub">
                            <select name="position" id="position" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                @if(isset($manpower_plan) )
                                @if(isset($positions))
                                @foreach($positions as $position)
                                <option value="{{$position->id}}" {{((isset($manpower_plan_position)) && ($manpower_plan_position != 0) && ($manpower_plan_position == $position->id)) ? 'selected' : ''}}>{{$position->name}}</option>
                                @endforeach
                                @endif
                                @endif
                            </select>
                            @if ($errors->has('position'))
                            <div class="invalid-feedback">{{ $errors->first('position') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!--  Cost Center -->
                <div class="col-md-4">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Cost Center')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="cost_center" id="expenses" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                @foreach($expenses as $expense)
                                <option value="{{$expense->id}}" {{ isset($manpower_plan) ? $manpower_plan->expenses_id  == $expense->id ? 'selected' : ''  : @old('cost_center') == $expense->id ? 'selected' : '' }}>{{$expense->expenseName(app()->getLocale())}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('cost_center'))
                            <div class="invalid-feedback">{{ $errors->first('cost_center') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->


    <!-- Employees Count -->
    <!-- Count Section Setting -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <h4>{{__('Employees Count Section')}}</h4>
            <div class="row">

                <!-- Count Nature -->
                <div class="col-md-12">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Count Nature')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="employee_count_target_nature" id="employee_count_nature" data-section="employee_count" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                <option value="repeating" {{ @$plan['employee_count_target_nature'] == 'repeating' ? 'selected' : '' }}>{{__('Repeating')}} ..</option>
                                <option value="varying" {{ @$plan['employee_count_target_nature'] == 'varying' ? 'selected' : '' }}>{{__('Varying')}} ..</option>
                            </select>
                            @if ($errors->has('employee_count_target_nature'))
                            <div class="invalid-feedback">{{ $errors->first('employee_count_target_nature') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Repeating Count -->
                <div class="col-md-12 employee_count_repeating {{ @$plan['employee_count_target_nature']  == 'repeating' ? '' : 'hidden'}}" id="kt_repeater_1">
                    <div class="form-group form-group-last row" id="kt_repeater_1">
                        <label class="col-lg-2 col-form-label"> {{__('Repeating Count')}} :</label>
                        <div data-repeater-list="employee_count_repeating" class="col-lg-10">
                            @if(!empty(@old('employee_count_repeating'))>0 || (isset($manpower_plan) && @count($manpower_plan->repeatingEmployeeCounts)>0 ))

                            <?php $employee_count_repeating = isset($manpower_plan) ? $manpower_plan->repeatingEmployeeCounts : @old('employee_count_repeating'); ?>

                            @foreach($employee_count_repeating as $key => $interval)
                            <div data-repeater-item class="form-group row align-items-center">

                                <div class="col-md-3">
                                    <div class="kt-form__group--inline validated">
                                        <div class="kt-form__label">
                                            <label>{{__('Repeating Count')}}</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="number" step="any" name="{{'employee_count_repeating['.$key.'][repeating_count]'}}" value="{{$interval['repeating_count']}}" class="form-control repeating_count" placeholder="{{__('Repeating Count')}}">
                                            @if ($errors->has('employee_count_repeating.'.$key.'.repeating_count'))
                                            <div class="invalid-feedback">{{ $errors->first('employee_count_repeating.'.$key.'.repeating_count') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline validated">
                                        <div class="kt-form__label">
                                            <label class="kt-label m-label--single">{{__('Start Month')}}</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="number" step="any" name="{{'employee_count_repeating['.$key.'][start_month]'}}" data-date="{{$financial_start_date}}" value="{{$interval['start_month']}}" class="form-control start_month" placeholder="{{__('Start Month')}}">
                                            @if ($errors->has('employee_count_repeating.'.$key.'.start_month'))
                                            <div class="invalid-feedback">{{ $errors->first('employee_count_repeating.'.$key.'.start_month') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline validated">
                                        <div class="kt-form__label">
                                            <label>{{__('Start Date')}}</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text" disabled class="form-control current_date" placeholder="mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>

                                <div class="col-md-3">
                                    <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                        <i class="la la-trash-o"></i>
                                        {{__('Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div data-repeater-item class="form-group row align-items-center">

                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>{{__('Repeating Count')}}</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="number" step="any" name="repeating_count" class="form-control repeating_count" placeholder="{{__('Repeating Count')}}">
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label class="kt-label m-label--single">{{__('Start Month')}}</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="number" step="any" name="start_month" class="form-control start_month" data-date="{{$financial_start_date}}" placeholder="{{__('Start Month')}}">
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>{{__('Start Date')}}</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <input type="text" disabled name="start_date" class="form-control current_date" placeholder="mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="d-md-none kt-margin-b-10"></div>
                                </div>

                                <div class="col-md-3">
                                    <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                        <i class="la la-trash-o"></i>
                                        {{__('Delete')}}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-group-last row">
                        <label class="col-lg-2 col-form-label"></label>
                        <div class="col-lg-4">
                            <a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
                                <i class="la la-plus"></i> {{__('Add')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Varing Employees Count Setting Distribution -->
    <div class="kt-portlet {{@$plan['employee_count_target_nature']  == 'varying'  ? '' : 'hidden'}}" id="employee_count_varying_table">
        <div class="kt-portlet__body">
            <h4>{{__('Varying Distribution')}}</h4>

            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <!-- <th>{{__('Year / Month')}}</th> -->
                        <th>{{__('Jan')}}</th>
                        <th>{{__('Feb')}}</th>
                        <th>{{__('Mar')}}</th>
                        <th>{{__('APR')}}</th>
                        <th>{{__('May')}}</th>
                        <th>{{__('Jun')}}</th>
                        <th>{{__('July')}}</th>
                        <th>{{__('Aug')}}</th>
                        <th>{{__('Sep')}}</th>
                        <th>{{__('Oct')}}</th>
                        <th>{{__('Nov')}}</th>
                        <th>{{__('Dec')}}</th>
                        <th>{{__('Total')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $years= 0;$month_number = 0; $years_array=[];?>
                    @foreach($duration_monthes_in_years as $year => $months)
                    <?php
                    array_push($years_array,$year);
                    $years++;
                ?>
                    <tr>
                        @foreach($months as $month => $value)
                        <td>
                            @if($value == 0)
                            <b>-</b>
                            @else
                            <?php $month_value =isset($manpower_plan) && $manpower_plan->employee_count_target_nature == 'varying'  ?  number_format(@$manpower_plan->employeeCountVaryingValues->where('month_number',$month_number)->first()->value,0, '.', '') ?? 0 : null ;  ?>

                            <div class="form-group">
                                <label class="col-form-label take" style="text-decoration: underline;">{{date("M'y",strtotime($month))}}</label>
                                <div class="input-group input-group-sm ">

                                    <input type="text" class="form-control employee_count_repeating_amounts" data-month="{{date("M",strtotime($month))}}" data-section="employee_count" name="employee_count_varing_values[{{$month_number}}]" value="{{ isset($manpower_plan) ? $month_value : number_format(@old('employee_count_varing_values')[$month_number],0, '.', '')}}" data-year="{{$year}}" aria-describedby="basic-addon2">

                                </div>
                                <i class="fa fa-ellipsis-h pull-{{__('left')}} employee_count_last_value" data-section="employee_count" data-year="{{$year}}" data-month="{{date("M",strtotime($month))}}" title="Copy Right"></i>
                            </div>
                            <?php $month_number++ ;?>
                            @endif
                        </td>
                        @endforeach
                        <td>
                            <div class="form-group">
                                <label class="col-form-label take" style="text-decoration: underline;">{{ __('Yr- ')}}{{$year}}</label>
                                <div class="input-group input-group-sm ">

                                    <input type="text" class="form-control employee_count_total" data-section="employee_count" data-date="{{date("M-y",strtotime($month))}}" data-year="{{$year}}" aria-describedby="basic-addon2" disabled>

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ////////////////////////////////////// -->

    <!-- Employees Salary -->
    <!-- Employees Salary Section Setting -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <h4>{{__('Employees Net Salary Section')}}</h4>
            <div class="row">

                <!-- Count Nature -->
                <div class="col-md-12">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Net Salary Nature')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="employee_salary_target_nature" id="employee_salary_nature" data-section="employee_salary" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                <option value="repeating" {{ @$plan['employee_salary_target_nature'] == 'repeating' ? 'selected' : '' }}>{{__('Repeating')}} ..</option>
                                <option value="varying" {{ @$plan['employee_salary_target_nature'] == 'varying' ? 'selected' : '' }}>{{__('Varying')}} ..</option>
                                <option value="percentage" {{ @$plan['employee_salary_target_nature'] == 'percentage' ? 'selected' : '' }}>{{__('Percentage')}} ..</option>
                            </select>
                            @if ($errors->has('employee_salary_target_nature'))
                            <div class="invalid-feedback">{{ $errors->first('employee_salary_target_nature') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Repeating -->
                <!-- Fixed Amount / Month -->
                <div class="col-md-6 employee_salary_repeating {{@$plan['employee_salary_target_nature'] == 'repeating' ? '' : 'hidden'}} ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Fixed Amount / Month')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" step="any" step="any" name="fixed_amount" id="fixed_amount" class="form-control" placeholder="{{__('Enter')}} {{__('Fixed Amount / Month')}}" value="{{@$plan['fixed_amount'] }}" />
                            @if ($errors->has('fixed_amount'))
                            <div class="invalid-feedback">{{ $errors->first('fixed_amount') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Salary Annual Increase Rate -->
                <div class="col-md-6 employee_salary_repeating {{@$plan['employee_salary_target_nature'] == 'repeating'   ? '' : 'hidden'}} ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Salary Annual Increase Rate')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" step="any" step="any" name="annual_increase_rate" id="annual_increase_rate" class="form-control" placeholder="{{__('Enter')}} {{__('Salary Annual Increase Rate')}}" value="{{isset($manpower_plan) ? $manpower_plan->annual_increase_rate : $financial->human_salary_rate}}" />
                            @if ($errors->has('annual_increase_rate'))
                            <div class="invalid-feedback">{{ $errors->first('annual_increase_rate') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bouns (How Many Salary Months) -->
                <div class="col-md-4 employee_salary_repeating {{@$plan['employee_salary_target_nature'] == 'repeating'   ? '' : 'hidden'}}  ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Bouns (How Many Salary Months)')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" step="any" name="bouns_salary_months" id="bouns_salary_months" class="form-control" placeholder="{{__('Enter')}} {{__('Bouns (How Many Salary Months)')}}" value="{{isset($manpower_plan) ? $manpower_plan->bouns_salary_months : @old('bouns_salary_months')}}" />
                            @if ($errors->has('bouns_salary_months'))
                            <div class="invalid-feedback">{{ $errors->first('bouns_salary_months') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Bouns Interval -->
                <div class="col-md-4 employee_salary_repeating {{@$plan['employee_salary_target_nature'] == 'repeating'   ? '' : 'hidden'}}  ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Bouns Interval')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="bouns_interval" id="bouns_interval" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                <option value="quarterly" {{ isset($manpower_plan) ? $manpower_plan->bouns_interval == 'quarterly' ? 'selected' : ''  : @old('bouns_interval') == 'quarterly' ? 'selected' : '' }}> {{__('Quarterly')}}</option>
                                <option value="semi-annually" {{ isset($manpower_plan) ? $manpower_plan->bouns_interval == 'semi-annually' ? 'selected' : ''  : @old('bouns_interval') == 'semi-annually' ? 'selected' : '' }}> {{__('Semi Annually')}}</option>
                                <option value="annually" {{ isset($manpower_plan) ? $manpower_plan->bouns_interval == 'annually' ? 'selected' : ''  : @old('bouns_interval') == 'annually' ? 'selected' : '' }}> {{__('Annually')}}</option>
                            </select>
                            @if ($errors->has('bouns_interval'))
                            <div class="invalid-feedback">{{ $errors->first('bouns_interval') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Paid After Interval By (Months Count) -->
                <div class="col-md-4 employee_salary_repeating {{@$plan['employee_salary_target_nature'] == 'repeating'   ? '' : 'hidden'}}  ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Paid After Interval By (Months Count)')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" step="any" name="months_bouns_paid_after" id="months_bouns_paid_after" class="form-control" placeholder="{{__('Enter')}} {{__('Paid After Interval By (Months Count)')}}" value="{{isset($manpower_plan) ? $manpower_plan->months_bouns_paid_after : @old('months_bouns_paid_after')}}" />
                            @if ($errors->has('months_bouns_paid_after'))
                            <div class="invalid-feedback">{{ $errors->first('months_bouns_paid_after') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- ////////////////////////////////////// -->

                <!-- Percentage -->
                <!-- As A Percentage -->
                <div class="col-md-12 employee_salary_percentage {{@$plan['employee_salary_target_nature'] == 'percentage'  ? '' : 'hidden'}}">
                    <div class="form-group validated">
                        <label class="col-form-label take">{{__('As A Percentage')}} </label>
                        <div class="form-group-sub">
                            <input type="number" step="any" min="0" name="percentage" class="form-control" placeholder="{{__('Enter')}} {{__('As A Percentage')}} .." value="{{@$plan['percentage']}}" />
                            @if ($errors->has('percentage'))
                            <div class="invalid-feedback">{{ $errors->first('percentage') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Varing Employees Salary Setting Distribution -->
    <div class="kt-portlet {{@$plan['employee_salary_target_nature']   == 'varying'  ? '' : 'hidden'}}" id="employee_salary_varying_table">
        <div class="kt-portlet__body">
            <h4>{{__('Salary Per Employee Varying Distribution')}}</h4>

            <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <!-- <th>{{__('Year / Month')}}</th> -->
                        <th>{{__('Jan')}}</th>
                        <th>{{__('Feb')}}</th>
                        <th>{{__('Mar')}}</th>
                        <th>{{__('APR')}}</th>
                        <th>{{__('May')}}</th>
                        <th>{{__('Jun')}}</th>
                        <th>{{__('July')}}</th>
                        <th>{{__('Aug')}}</th>
                        <th>{{__('Sep')}}</th>
                        <th>{{__('Oct')}}</th>
                        <th>{{__('Nov')}}</th>
                        <th>{{__('Dec')}}</th>
                        {{-- <th>{{__('Total')}}</th>--}}
                    </tr>
                </thead>
                <tbody>
                    <?php $years= 0;$month_number = 0;?>
                    @foreach($duration_monthes_in_years as $year => $months)
                    <?php $years++;?>
                    <tr>
                        @foreach($months as $month => $value)
                        <td>
                            @if($value == 0)
                            <b>-</b>
                            @else
                            <?php $month_value =isset($manpower_plan) && $manpower_plan->employee_salary_target_nature == 'varying'  ?  number_format($manpower_plan->employeeSalaryVaryingValues->where('month_number',$month_number)->first()->value??0,0, '.', '') : null ;  ?>

                            <div class="form-group">
                                <label class="col-form-label take" style="text-decoration: underline;">{{date("M'y",strtotime($month))}}</label>
                                <div class="input-group input-group-sm ">

                                    <input type="text" class="form-control employee_salary_repeating_amounts" data-section="employee_salary" name="employee_salary_varing_values[{{$month_number}}]" value="{{ isset($manpower_plan) ? $month_value : number_format(@old('employee_salary_varing_values')[$month_number],0, '.', '')}}" data-year="{{$year}}" aria-describedby="basic-addon2">

                                </div>
                                <i class="fa fa-ellipsis-h pull-{{__('left')}} employee_salary_last_value " data-year="{{$year}}" data-section="employee_salary" title="Copy Right"></i>
                            </div>
                            <?php $month_number++ ;?>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->

    <!-- Taxes Section -->
    <?php $taxes_salary_rate= isset($plan['taxes_salary_rate']) && $plan['taxes_salary_rate'] !== null ? @$plan['taxes_salary_rate']: $financial->taxes_salary_rate ?>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <h4>{{__('Taxes & Social Insurance Section')}}</h4>
            <div class="row">
                <!-- Salary  -->
                <!-- Salary Tax Rate -->
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take">{{__('Salary Tax Rate')}} </label>
                        <div class="form-group-sub">
                            <input type="number" step="any" min="0" name="taxes_salary_rate" class="form-control" placeholder="{{__('Enter')}} {{__('Salary Tax Rate')}} .." value="{{$taxes_salary_rate}}" />
                            @if ($errors->has('taxes_salary_rate'))
                            <div class="invalid-feedback">{{ $errors->first('taxes_salary_rate') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Social Insurance Rate -->

                <?php $social_insurance= isset($plan['human_social_rate']) && $plan['human_social_rate'] !== null ? @$plan['human_social_rate']: $financial->human_social_rate ?>
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take">{{__('Social Insurance Rate')}} </label>
                        <div class="form-group-sub">
                            <input type="number" step="any" min="0" name="human_social_rate" class="form-control number" placeholder="{{__('Enter')}} {{__('Social Insurance Rate')}} .." value="{{$social_insurance }}" />
                            @if ($errors->has('human_social_rate'))
                            <div class="invalid-feedback">{{ $errors->first('human_social_rate') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- ///////////////////////////////// -->
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->

    <!-- Allocations Section -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <h4>{{__('Allocation Section')}}</h4>
            <div class="row">
                <!-- Select Allocation Base -->
                <div class="col-md-4 ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{ __('Select Allocation Base Type') }} </label>
                        <div class="form-group-sub">
                            <select name="allocation_base" id="allocation_base" class="form-control" {{(count($allocation_bases)>0 ?:'disabled' )}}>
                                <option value="">{{ __('Select') }} ..</option>
                                @foreach ($allocation_bases as $base)
                                <option value="{{$base}}" {{ @$plan['allocation_base'] == $base ? 'selected' : '' }}>
                                    {{ __(ucwords(str_replace('_',' ',$base))) }}
                                </option>
                                @endforeach
                            </select>

                            @if ($errors->has('allocation_base'))
                            <div class="invalid-feedback">{{ $errors->first('allocation_base') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Select Allocate -->
                <div class="col-md-4 ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{ __('Select Allocation Item') }} </label>
                        <div class="form-group-sub">
                            <select name="allocation_base_id" id="base" {{(count($allocation_bases)>0 ?:'disabled' )}} class="form-control" {{isset($manpower_plan) && $manpower_plan->expense_category == '12' ? 'disabled' : '' }}>
                                <option value="">{{ __('Select') }} ..</option>
                                @if (isset($allocations))
                                @foreach ($allocations as $allocate)
                                <option value="{{ $allocate->id }}" {{ isset($manpower_plan) ? $manpower_plan->allocation_base_id  == $allocate->id ? 'selected' : ''  : @old('allocation_base_id') == $allocate->id ? 'selected' : '' }}>
                                    {{ $allocate->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @if ($errors->has('allocation_base_id'))
                            <div class="invalid-feedback">{{ $errors->first('allocation_base_id') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Select Revenue Stream -->
                <div class="col-md-4 ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Revenue Stream')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="revenue_stream_type" id="revenue_stream_type" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                <option value="all" {{ isset($manpower_plan) ? $manpower_plan->revenue_stream_type_id  == 'all' ? 'selected' : ''  : @old('revenue_stream_type') == 'all' ? 'selected' : '' }}>{{__('All')}} ..</option>
                                @foreach($revenues as $revenue)
                                <option value="{{$revenue->id}}" {{ isset($manpower_plan) ? $manpower_plan->revenue_stream_type_id  == $revenue->id ? 'selected' : ''  : @old('revenue_stream_type') == $revenue->id ? 'selected' : '' }}>{{$revenue->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('revenue_stream_type'))
                            <div class="invalid-feedback">{{ $errors->first('revenue_stream_type') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Select Category -->
                <div class="col-md-4 ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Category')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="category_product" id="category_product" class="form-control" {{( isset($manpower_plan) && ($manpower_plan->revenue_stream_type_id == 'all') ) ? 'disabled' : (@old('revenue_stream_type') == 'all') ? 'disabled' : ''  }}>
                                <option value="">{{__('Select')}} ..</option>
                                @if(isset($categories_products) && @count($categories_products)>0)
                                @foreach($categories_products as $cat_product)
                                <option value="{{$cat_product->id}}" {{ $manpower_plan->category_product_id == $cat_product->id ? 'selected' : '' }}>{{$cat_product->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @if ($errors->has('category_product'))
                            <div class="invalid-feedback">{{ $errors->first('category_product') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Select Product -->
                <div class="col-md-4 ">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Product / Service')}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <select name="product" id="product" class="form-control" {{( isset($manpower_plan) && ($manpower_plan->revenue_stream_type_id == 'all') ) ? 'disabled' : (@old('revenue_stream_type') == 'all') ? 'disabled' : ''  }}>
                                <option value="">{{__('Select')}} ..</option>
                                @if(isset($products) && @count($products)>0)
                                @foreach($products as $product)
                                <option value="{{$product->id}}" {{ $manpower_plan->product_id == $product->id ? 'selected' : '' }}>{{$product->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @if ($errors->has('product'))
                            <div class="invalid-feedback">{{ $errors->first('product') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- ////////////////////////////////////// -->
                <!-- Select Allocation Base -->
                <div class="col-md-4">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__('Select Allocation Type')}} </label>
                        <div class="form-group-sub">
                            <select name="allocation_type" id="allocation" class="form-control">
                                <option value="">{{__('Select')}} ..</option>
                                @if((@old() != null && @old('product') == null ) || (@old() == null && !isset($manpower_plan)) || (isset($manpower_plan) && !isset($manpower_plan->product_id)))
                                <option value="equally" {{ isset($manpower_plan) ? $manpower_plan->allocation_type  == "equally" ? 'selected' : ''  : @old('allocation_type') == "equally" ? 'selected' : '' }}>{{__('Equally')}} ..</option>
                                <option value="sales_percentage" {{ isset($manpower_plan) ? $manpower_plan->allocation_type  == "sales_percentage" ? 'selected' : ''  : @old('allocation_type') == "sales_percentage" ? 'selected' : '' }}>{{__('Sales Percentage')}} ..</option>
                                <option value="customized" {{ isset($manpower_plan) ? $manpower_plan->allocation_type  == "customized" ? 'selected' : ''  : @old('allocation_type') == "customized" ? 'selected' : '' }}>{{__('Customized')}} ..</option>
                                @endif
                            </select>
                            @if ($errors->has('allocation_type'))
                            <div class="invalid-feedback">{{ $errors->first('allocation_type') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->

    <!-- Customized Allocation -->
    <div class="kt-portlet  {{(@old('product') == null) && (@old('allocation_type') == 'customized' ) || (isset($manpower_plan) && $manpower_plan->allocation_type == 'customized' ) ? '' : 'hidden'}}" id="custom_allocation">
        <div class="kt-portlet__body">
            <h4>{{__('Customized Allocation')}}</h4>
            <div class="kt-portlet">
                @if($errors->has('customized_percentage'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ $errors->first('customized_percentage') }}</li>
                    </ul>
                </div>
                @endif
            </div>
            <div class="row" id="added_rows">
                @if(( (@old('product') == null ) && (@old('allocation_type') == "customized" ) && (@old('revenue_stream_type') != null) && (@old('revenue_stream_type') != 'all') ) || ( isset($manpower_plan) && ($manpower_plan->project_id == null) && $manpower_plan->allocation_type == 'customized' ))

                @if(( @old('allocation_base') != null && @old('allocation_base_id') == null) || ( isset($manpower_plan) && ($manpower_plan->allocation_base != null) && $manpower_plan->allocation_base_id == null ))
                <?php
                  if (!isset($manpower_plan) ) {
                    $revenuStream = App\RevenueStreamType::find(@old('revenue_stream_type'));
                    $customized_allocations = $revenuStream->categoryProducts($company->id); 
                  }
                ?>
                @foreach($allocations as $key => $item)
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Category")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="text" class="form-control" data-section="target" value="{{$item->name}}" />
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$item->id}}" name="customized_allocations[]">
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Percentage")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" name="customized_allocations_percentage[{{$item->id}}]" class="form-control" value="{{isset($manpower_plan) ? @$manpower_plan->customizedAllocations()->where('foriegn_id',$item->id)->first()->percentage : @old('customized_allocations_percentage')[$item->id]}}" data-section="target" placeholder="{{__('Enter')}} {{__('Percentage')}}">
                            @if($errors->has("customized_allocations_percentage.".$item->id))
                            <div class="invalid-feedback">{{ $errors->first("customized_allocations_percentage.".$revenue->id) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

                @elseif(((@old('revenue_stream_type') != null) && (@old('revenue_stream_type') == 'all') ) || ( isset($manpower_plan) && ($manpower_plan->revenue_stream_type_id !=null) && ($manpower_plan->revenue_stream_type_id == 'all' ) ))
                @foreach($revenues as $key => $revenue)
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Category")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="text" class="form-control" data-section="target" value="{{$revenue->name}}" />
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$revenue->id}}" name="customized_allocations[]">
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Percentage")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" name="customized_allocations_percentage[{{$revenue->id}}]" class="form-control" value="{{isset($manpower_plan) ? @$manpower_plan->customizedAllocations()->where('foriegn_id',$revenue->id)->first()->percentage : @old('customized_allocations_percentage')[$revenue->id]}}" data-section="target" placeholder="{{__('Enter')}} {{__('Percentage')}}">
                            @if($errors->has("customized_allocations_percentage.".$revenue->id))
                            <div class="invalid-feedback">{{ $errors->first("customized_allocations_percentage.".$revenue->id) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @elseif(((@old('category_product') == null) && (@old('revenue_stream_type') != null) && (@old('revenue_stream_type') != 'all') ) || ( isset($manpower_plan) && ($manpower_plan->category_product_id == null) && ($manpower_plan->revenue_stream_type_id !=null) && ($manpower_plan->revenue_stream_type_id != 'all' ) ))
                <?php
                  if (!isset($manpower_plan) ) {
                    $revenuStream = App\RevenueStreamType::find(@old('revenue_stream_type'));
                    $customized_allocations = $revenuStream->categoryProducts($company->id); 
                  }
                ?>
                @foreach($customized_allocations as $key => $category)
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Category")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="text" class="form-control" data-section="target" value="{{$category->name}}" />
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$category->id}}" name="customized_allocations[]">
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Percentage")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" name="customized_allocations_percentage[{{$category->id}}]" class="form-control" value="{{isset($manpower_plan) ? @$manpower_plan->customizedAllocations()->where('foriegn_id',$category->id)->first()->percentage : @old('customized_allocations_percentage')[$category->id]}}" data-section="target" placeholder="{{__('Enter')}} {{__('Percentage')}}">
                            @if($errors->has("customized_allocations_percentage.".$category->id))
                            <div class="invalid-feedback">{{ $errors->first("customized_allocations_percentage.".$category->id) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @elseif(((@old('category_product') != null) && (@old('revenue_stream_type') !=null) && (@old('revenue_stream_type') != 'all') ) || ( isset($manpower_plan) && ($manpower_plan->category_product_id != null) && ($manpower_plan->revenue_stream_type_id !=null) && ($manpower_plan->revenue_stream_type_id != 'all' )))
                <?php
                  if (!isset($manpower_plan) ) {
                    $category = App\Category_product::find( @old('category_product'));
                    $customized_allocations = $category->Product($company_id);
                  }
                ?>
                @foreach($customized_allocations as $key => $product)
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Product")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="text" class="form-control" data-section="target" value="{{$product->name}}" />
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{$product->id}}" name="customized_allocations[]">
                <div class="col-md-6">
                    <div class="form-group validated">
                        <label class="col-form-label take"> {{__("Percentage")}} <span class="astric">*</span></label>
                        <div class="form-group-sub">
                            <input type="number" name="customized_allocations_percentage[{{$product->id}}]" class="form-control" value="{{isset($manpower_plan) ? $manpower_plan->customizedAllocations()->where('foriegn_id',$product->id)->first()->percentage : @old('customized_allocations_percentage')[$product->id]}}" data-section="target" placeholder="{{__('Enter')}} {{__('Percentage')}}">
                            @if($errors->has("customized_allocations_percentage.".$product->id))
                            <div class="invalid-feedback">{{ $errors->first("customized_allocations_percentage.".$product->id) }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @endif
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->

    <!-- Submit -->
    <div class="kt-portlet">
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-12">
                        <input type="submit" name="submit" value="{{__('Submit')}}" class="btn btn-success submit">
                        <input type="submit" name="submit" value="{{__('Submit And Close')}}" class="btn btn-success submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////// -->
</form>