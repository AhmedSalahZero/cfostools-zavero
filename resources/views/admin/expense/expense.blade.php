@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
@endsection
@section('sub-header')
<style>
    .max-w-checkbox {
		
        min-width: 25px !important;
        width: 25px !important;
    }

    .customize-elements .bootstrap-select {
        min-width: 100px !important;
        text-align: center !important;
    }

    .customize-elements input.only-percentage-allowed {
        min-width: 100px !important;
        max-width: 100px !important;
        text-align: center !important;
    }

    [data-repeater-create] span {
        white-space: nowrap !important;
    }

    .type-btn {
        max-width: 150px;
        height: 70px;
        margin-right: 10px;
        margin-bottom: 5px !important;
    }

    .type-btn:hover {}

    .bootstrap-select {
        min-width: 200px;
    }

    input {
        min-width: 200px;
    }

    input.only-month-year-picker {
        min-width: 100px;
    }

    input.only-greater-than-or-equal-zero-allowed {
        min-width: 120px;
    }

    input.only-percentage-allowed {
        min-width: 80px;
    }

    i {
        text-align: left
    }

    .kt-portlet .kt-portlet__body {
        overflow-x: scroll;
    }

    .repeat-to-r {
        flex-basis: 100%;
        cursor: pointer
    }

    .icon-for-selector {
        background-color: white;
        color: #0742A8;
        font-size: 1.5rem;
        cursor: pointer;
        margin-left: 3px;
        transition: all 0.5s;
    }

    .icon-for-selector:hover {
        transform: scale(1.2);

    }

    .filter-option {
        text-align: center !important;
    }


    td input,
    td select,
    .filter-option {
        border: 1px solid #CCE2FD !important;
        margin-left: auto;
        margin-right: auto;
        color: black;
        font-weight: 400;
    }

    th {
        border-bottom: 1px solid #CCE2FD !important;
    }

    tr:last-of-type {}

    .table tbody+tbody {
        border-top: 1px solid #CCE2FD;
    }

</style>
<x-main-form-title :id="'main-form-title'" :class="''">{{ $pageTitle  }}</x-main-form-title>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">

        <form id="form-id" class="kt-form kt-form--label-right" method="POST" enctype="multipart/form-data" action="{{ route('admin.store.expense',['company'=>$company->id,'expenseType'=>$expenseType ]) }}">
            @csrf
            <input type="hidden" name="model_id" value="{{ $model->id ?? 0  }}">
            <input type="hidden" name="model_name" value="IncomeStatement">
            <input type="hidden" name="expense_type" value="{{ $expenseType }}">
            <input type="hidden" name="company_id" value="{{ getCurrentCompanyId()  }}">
            <input type="hidden" name="creator_id" value="{{ \Auth::id()  }}">
            <div class="kt-portlet">


                <div class="kt-portlet__body">


                    <div class="form-group row justify-content-center">
                        @php
                        $index = 0 ;
                        @endphp
                        <div class="d-flex align-items-center justify-content-start " style="margin-right:auto">
                            @foreach(getTypesForValues() as $typeElement)
                            <button data-value="{{ $typeElement['value'] }}" class="btn mb-5 js-type-btn type-btn btn btn-outline-info {{ $index == 0 ? 'active' :''  }}">{{ $typeElement['title'] }}</button>
                            @php
                            $index++;
                            @endphp
                            @endforeach
                        </div>


                        {{-- <div class="col-md-4 ">
                            <x-form.select   :options="getTypesForValues()" :add-new="false" :label="__('Please Select Expense Type')" class="select2-select   " data-filter-type="{{ $type }}" :all="false" name="duration_type" id="{{'expense_type' }}" :selected-value="isset($model) ? $model->getDurationType() : 0"></x-form.select>
                    </div> --}}
                    {{-- start of fixed monthly repeating amount --}}
                    @php
                    $tableId = 'fixed_monthly_repeating_amount';
                    $repeaterId = 'fixed_monthly_repeating_amount_repeater';

                    @endphp
                    <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
                    <x-tables.repeater-table :removeRepeater="false" :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                        <x-slot name="ths">
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Monthly <br> Amount')" :helperTitle="__('Please insert amount excluding VAT')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th>
                        </x-slot>
                        <x-slot name="trs">
                            @php
                            $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
                            @endphp
                            @foreach( count($rows) ? $rows : [-1] as $subModel)
                            @php
                            if( !($subModel instanceof \App\Models\Expense) ){
                            unset($subModel);
                            }

                            @endphp
                            <tr @if($isRepeater) data-repeater-item @endif>
                                <td class="text-center">
                                    <div class="">
                                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                        </i>
                                    </div>
                                </td>


                                <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                                <td>
                                    <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                                </td>
                                <td>

                                    <div class="d-flex align-items-center js-common-parent">
                                        <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                                        @include('ul-to-trigger-popup')
                                    </div>
                                </td>
                                <td>
                                    <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                                </td>
                                <td>
                                    <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyAmount(),0) : 0) }}" @if($isRepeater) name="monthly_amount" @else name="{{ $tableId }}[0][monthly_amount]" @endif class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyAmount() : 0) }}" @if($isRepeater) name="monthly_amount" @else name="{{ $tableId }}[0][monthly_amount]" @endif>

                                </td>
                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select payment_terms repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]' }}"></x-form.select>
                                    <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS):0  }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                                    </div>
                                </td>

                                {{-- {{ dd($subModel->getWithholdTaxRate()) }} --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                                    </div>
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

                                    </div>
                                </td>
                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'increase_interval':$tableId.'[0][increase_interval]' }}" id="{{$type.'_'.'duration_type' }}"></x-form.select>
                                </td>


                            </tr>
                            @endforeach

                        </x-slot>




                    </x-tables.repeater-table>
                    {{-- end of fixed monthly repeating amount --}}



                    {{-- start of varying amount --}}
                    @php
                    $tableId = 'varying_amount';
                    $repeaterId = 'varying_amount_repeater';

                    @endphp
                    <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
                    <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                        <x-slot name="ths">
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
                            {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Monthly <br> Amount')" :helperTitle="__('Please insert amount excluding VAT')"></x-tables.repeater-table-th> --}}
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>


                            <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
                            @foreach($dates as $fullDate => $dateFormatted)
                            <x-tables.repeater-table-th class="col-md-1" :title="$dateFormatted . ' <br> ' . __('Amount')"></x-tables.repeater-table-th>
                            @endforeach

                        </x-slot>
                        <x-slot name="trs">
                            @php
                            $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
                            @endphp
                            @foreach( count($rows) ? $rows : [-1] as $subModel)
                            @php
                            if( !($subModel instanceof \App\Models\Expense) ){
                            unset($subModel);
                            }

                            @endphp
                            <tr @if($isRepeater) data-repeater-item @endif>
                                <td class="text-center">
                                    <div class="">
                                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                        </i>
                                    </div>
                                </td>


                                <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                                <td>
                                    <input value="{{ isset($subModel) ?  $subModel->getName() : '' }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                                </td>
                                <td>

                                    <div class="d-flex align-items-center js-common-parent">
                                        <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                                        @include('ul-to-trigger-popup')
                                    </div>
                                </td>


                                <td>

                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select payment_terms repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms': $tableId.'[0][payment_terms]'  }} "></x-form.select>
                                    <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>

                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                                    </div>
                                </td>
                                @php
                                $payloadIndex = 0 ;
                                @endphp
                                @foreach($dates as $fullDate => $dateFormatted)
                                <td>
                                    <div class="d-flex align-items-center flex-wrap text-center can-be-repeated-parent">
                                        <input data-column-index="{{ $payloadIndex }}" class="form-control can-be-repeated-text only-greater-than-or-equal-zero-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getPayloadAtDate($payloadIndex)) : 0 }}" type="text">
                                        <input class="can-be-repeated-hidden" type="hidden" value="{{ (isset($subModel) ? $subModel->getPayloadAtDate($payloadIndex) : 0) }}" multiple @if($isRepeater) name="payload" @else name="{{ $tableId }}[0][payload][{{ $fullDate }}]" @endif>
                                        <i class="fa fa-ellipsis-h repeat-to-r " title="{{ __('Repeat To Right') }}" data-column-index="{{ $payloadIndex }}" data-digit-number="0"></i>
                                    </div>
                                </td>

                                @php
                                $payloadIndex++ ;
                                @endphp

                                @endforeach






                            </tr>
                            @endforeach

                        </x-slot>




                    </x-tables.repeater-table>
                    {{-- end of varying amount --}}

                    {{-- start of fixed monthly repeating amount --}}
                    @php
                    $tableId = 'fixed_percentage_of_sales';
                    $repeaterId = 'fixed_percentage_of_sales_repeater';

                    @endphp
                    <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
                    <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                        <x-slot name="ths">
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Revenue <br> Stream')" :helperTitle="__('Revenue Stream')"></x-tables.repeater-table-th>

                            <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base1')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base2')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base3')"></x-tables.repeater-table-th>

                            <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Monthly <br> Percentage')" :helperTitle="__('Please insert percentage excluding VAT')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Conditional <br> To')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Conditional <br> Value A')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Conditional <br> Value B')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
                            <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>





                            <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
                            {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th> --}}
                            {{-- <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th> --}}
                        </x-slot>
                        <x-slot name="trs">
                            @php
                            $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
                            @endphp
                            @foreach( count($rows) ? $rows : [-1] as $subModel)
                            @php
                            if( !($subModel instanceof \App\Models\Expense) ){
                            unset($subModel);
                            }

                            @endphp
                            <tr @if($isRepeater) data-repeater-item @endif>



                                <td class="text-center">
                                    <div class="">
                                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                        </i>
                                    </div>
                                </td>


                                <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                                <td>
                                    <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                                </td>
                                <td>

                                    <div class="d-flex align-items-center js-common-parent">
                                        <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                                        @include('ul-to-trigger-popup')
                                    </div>
                                </td>
                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getRevenueStreamType() : 'service'" :options="getRevenueStreamTypes()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ?'revenue_stream_type':$tableId.'[0][revenue_stream_type]' }}"></x-form.select>

                                </td>

                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseOne() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater? 'allocation_base_1':$tableId.'[0][allocation_base_1]' }}"></x-form.select>

                                </td>

                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseTwo() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_2' : $tableId.'[0][allocation_base_2]'  }}"></x-form.select>

                                </td>

                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseThree() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_3' : $tableId.'[0][allocation_base_3]'  }}"></x-form.select>

                                </td>


                                <td>
                                    <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                                </td>
                                <td>
                                    <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyPercentage(),0) : 0) }}" class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyPercentage() : 0) }}" @if($isRepeater) name="monthly_percentage" @else name="{{ $tableId }}[0][monthly_amount]" @endif>
                                </td>

                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getConditionalTo() : ''" :options="getConditionalToSelect()" :add-new="false" class="select2-select js-condition-to-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'conditional_to' : $tableId.'[0][conditional_to]'  }}"></x-form.select>

                                </td>


                                <td>
                                    <input value="{{ (isset($subModel) ? number_format($subModel->getConditionalValueA(),0) : 0) }}" class="form-control conditional-input conditional-a-input text-center only-greater-than-or-equal-zero-allowed" type="text">
                                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getConditionalValueA() : 0) }}" @if($isRepeater) name="conditional_value_a" @else name="{{ $tableId }}[0][conditional_value_a]" @endif>
                                </td>

                                <td>
                                    <input value="{{ (isset($subModel) ? number_format($subModel->getConditionalValueB(),0) : 0) }}" class="form-control conditional-input conditional-b-input text-center only-greater-than-or-equal-zero-allowed" type="text">
                                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getConditionalValueB() : 0) }}" @if($isRepeater) name="conditional_value_b" @else name="{{ $tableId }}[0][conditional_value_b]" @endif>
                                </td>


                                <td>
                                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select repeater-select payment_terms " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                                    <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>


                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                                    </div>
                                </td>

                                {{-- {{ dd($subModel->getWithholdTaxRate()) }} --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                        <span style="margin-left:3px	">%</span>
                                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                                    </div>
                                </td>


                                {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),2) : 0 }}" type="text">
                                <span style="margin-left:3px	">%</span>
                                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

                </div>
                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="@if($isRepeater) increase_interval @else {{ $tableId }}[0][increase_interval] @endif" id="{{$type.'_'.'duration_type' }}"></x-form.select>

                </td> --}}


                </tr>
                @endforeach

                </x-slot>




                </x-tables.repeater-table>
                {{-- end of fixed monthly repeating amount --}}





                {{-- start of varying percentage --}}
                @php
                $tableId = 'varying_percentage_of_sales';
                $repeaterId = 'varying_percentage_of_sales_repeater';

                @endphp
                <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
                <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                    <x-slot name="ths">
                        <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-2" :title="__('Revenue <br> Stream')"></x-tables.repeater-table-th>

                        <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base1')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base2')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base3')"></x-tables.repeater-table-th>


                        <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
                        {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Monthly <br> Percentage')" :helperTitle="__('Please insert percentage excluding VAT')"></x-tables.repeater-table-th> --}}
                        <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
                        <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
                        @foreach($dates as $fullDate => $dateFormatted)
                        <x-tables.repeater-table-th class="col-md-1" :title="$dateFormatted . ' <br> ' . __('%')"></x-tables.repeater-table-th>
                        @endforeach
                        {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th> --}}
                        {{-- <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th> --}}
                    </x-slot>
                    <x-slot name="trs">
                        @php
                        $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
                        @endphp
                        @foreach( count($rows) ? $rows : [-1] as $subModel)
                        @php
                        if( !($subModel instanceof \App\Models\Expense) ){
                        unset($subModel);
                        }

                        @endphp
                        <tr @if($isRepeater) data-repeater-item @endif>



                            <td class="text-center">
                                <div class="">
                                    <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                    </i>
                                </div>
                            </td>


                            <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                            <td>
                                <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                            </td>
                            <td>

                                <div class="d-flex align-items-center js-common-parent">
                                    <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                                    @include('ul-to-trigger-popup')
                                </div>
                            </td>
                            <td>
                                <x-form.select :selectedValue="isset($subModel) ? $subModel->getRevenueStreamType() : 'service'" :options="getRevenueStreamTypes()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ?'revenue_stream_type':$tableId.'[0][revenue_stream_type]' }}"></x-form.select>

                            </td>

                            <td>
                                <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseOne() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater? 'allocation_base_1':$tableId.'[0][allocation_base_1]' }}"></x-form.select>

                            </td>

                            <td>
                                <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseTwo() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_2' : $tableId.'[0][allocation_base_2]'  }}" ></x-form.select>

                            </td>

                            <td>
                                <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseThree() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_3' : $tableId.'[0][allocation_base_3]'  }}"></x-form.select>

                            </td>

                            <td>
                                <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                            </td>
                            {{-- <td>
                                        <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyPercentage(),0) : 0) }}" @if($isRepeater) name="monthly_percentage" @else name="{{ $tableId }}[0][monthly_amount]" @endif class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyPercentage() : 0) }}" @if($isRepeater) name="monthly_percentage" @else name="{{ $tableId }}[0][monthly_amount]" @endif>

                            </td> --}}
                            <td>
                                <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select payment_terms repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                                <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>


                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                    <span style="margin-left:3px	">%</span>
                                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                                </div>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                                </div>
                            </td>

                            {{-- {{ dd($subModel->getWithholdTaxRate()) }} --}}
                            <td>
                                <div class="d-flex align-items-center">
                                    <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                    <span style="margin-left:3px	">%</span>
                                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                                </div>
                            </td>


                            @php
                            $payloadIndex = 0 ;
                            @endphp
                            @foreach($dates as $fullDate => $dateFormatted)
                            <td>
                                <div class="d-flex align-items-center flex-wrap text-center can-be-repeated-parent">
                                    <input data-column-index="{{ $payloadIndex }}" class="form-control can-be-repeated-text only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getPayloadAtDate($payloadIndex),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                    <input class="can-be-repeated-hidden" type="hidden" value="{{ (isset($subModel) ? $subModel->getPayloadAtDate($payloadIndex) : 0) }}" multiple @if($isRepeater) name="payload" @else name="{{ $tableId }}[0][payload][{{ $fullDate }}]" @endif>
                                    <i class="fa fa-ellipsis-h repeat-to-r " title="{{ __('Repeat To Right') }}" data-column-index="{{ $payloadIndex }}" data-digit-number="0"></i>
                                </div>
                            </td>

                            @php
                            $payloadIndex++ ;
                            @endphp

                            @endforeach


                            {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),2) : 0 }}" type="text">
                            <span style="margin-left:3px	">%</span>
                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

            </div>
            </td>
            <td>
                <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="@if($isRepeater) increase_interval @else {{ $tableId }}[0][increase_interval] @endif" id="{{$type.'_'.'duration_type' }}"></x-form.select>

            </td> --}}


            </tr>
            @endforeach

            </x-slot>




            </x-tables.repeater-table>
            {{-- end of varying percentage --}}








            {{-- start of fixed cost per unit --}}
            @php
            $tableId = 'fixed_cost_per_unit';
            $repeaterId = 'fixed_cost_per_unit_repeater';

            @endphp
            <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
            <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                <x-slot name="ths">
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Revenue <br> Stream')" :helperTitle="__('Revenue Stream')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base1')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base2')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base3')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Cost <br> Per Unit')" :helperTitle="__('Please insert Cost Per Unit excluding VAT')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Conditional <br> To')"></x-tables.repeater-table-th>

                    <x-tables.repeater-table-th class="col-md-2" :title="__('Conditional <br> Value A')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Conditional <br> Value B')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th>
                </x-slot>
                <x-slot name="trs">
                    @php
                    $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
                    @endphp
                    @foreach( count($rows) ? $rows : [-1] as $subModel)
                    @php
                    if( !($subModel instanceof \App\Models\Expense) ){
                    unset($subModel);
                    }

                    @endphp
                    <tr @if($isRepeater) data-repeater-item @endif>



                        <td class="text-center">
                            <div class="">
                                <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                </i>
                            </div>
                        </td>


                        <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                        <td>
                            <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                        </td>
                        <td>

                            <div class="d-flex align-items-center js-common-parent">
                                <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                                @include('ul-to-trigger-popup')
                            </div>
                        </td>
                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getRevenueStreamType() : 'service'" :options="getRevenueStreamTypes()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ?'revenue_stream_type':$tableId.'[0][revenue_stream_type]' }}"></x-form.select>
                        </td>


                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseOne() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater? 'allocation_base_1':$tableId.'[0][allocation_base_1]' }}"></x-form.select>

                        </td>

                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseTwo() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater? 'allocation_base_2':$tableId.'[0][allocation_base_2]' }}" ></x-form.select>

                        </td>

                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseThree() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_3' : $tableId.'[0][allocation_base_3]'  }}"></x-form.select>

                        </td>


                        <td>
                            <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                        </td>
                        <td>
                            <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyCostOfUnit(),0) : 0) }}" class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyCostOfUnit() : 0) }}" @if($isRepeater) name="monthly_cost_of_unit" @else name="{{ $tableId }}[0][monthly_cost_of_unit]" @endif>

                        </td>

                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getConditionalTo() : ''" :options="getConditionalToSelect()" :add-new="false" class="select2-select js-condition-to-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'conditional_to' : $tableId.'[0][conditional_to]'  }}"></x-form.select>

                        </td>



                        <td>
                            <input value="{{ (isset($subModel) ? number_format($subModel->getConditionalValueA(),0) : 0) }}" class="form-control conditional-input conditional-a-input text-center only-greater-than-or-equal-zero-allowed" type="text">
                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getConditionalValueA() : 0) }}" @if($isRepeater) name="conditional_value_a" @else name="{{ $tableId }}[0][conditional_value_a]" @endif>
                        </td>


                        <td>
                            <input value="{{ (isset($subModel) ? number_format($subModel->getConditionalValueB(),0) : 0) }}" class="form-control conditional-input conditional-b-input text-center only-greater-than-or-equal-zero-allowed" type="text">
                            <input type="hidden" value="{{ (isset($subModel) ? $subModel->getConditionalValueB() : 0) }}" @if($isRepeater) name="conditional_value_b" @else name="{{ $tableId }}[0][conditional_value_b]" @endif>
                        </td>




                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select repeater-select payment_terms " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                            <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>


                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                <span style="margin-left:3px	">%</span>
                                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                            </div>
                        </td>


                        <td>
                            <div class="d-flex align-items-center">
                                <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                <span style="margin-left:3px	">%</span>
                                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                            </div>
                        </td>


                        <td>
                            <div class="d-flex align-items-center">
                                <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                <span style="margin-left:3px	">%</span>
                                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

                            </div>
                        </td>
                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'increase_interval':$tableId.'[0][increase_interval]' }}" id="{{$type.'_'.'duration_type' }}"></x-form.select>

                        </td>


                    </tr>
                    @endforeach

                </x-slot>




            </x-tables.repeater-table>
            {{-- end of fixed cost per unit --}}





            {{-- start of varying cost per unit --}}
            @php
            $tableId = 'varying_cost_per_unit';
            $repeaterId = 'varying_cost_per_unit_repeater';

            @endphp
            <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
            <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
                <x-slot name="ths">
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Revenue <br> Type')"></x-tables.repeater-table-th>

                    <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base1')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base2')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Allocation <br> Base3')"></x-tables.repeater-table-th>


                    <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
                    {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Monthly <br> Percentage')" :helperTitle="__('Please insert percentage excluding VAT')"></x-tables.repeater-table-th> --}}
                    <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
                    <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
                    @foreach($dates as $fullDate => $dateFormatted)
                    <x-tables.repeater-table-th class="col-md-1" :title="$dateFormatted . ' <br> ' . __('Amount')"></x-tables.repeater-table-th>
                    @endforeach
                    {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th> --}}
                    {{-- <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th> --}}
                </x-slot>
                <x-slot name="trs">
                    @php
                    $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
                    @endphp
                    @foreach( count($rows) ? $rows : [-1] as $subModel)
                    @php
                    if( !($subModel instanceof \App\Models\Expense) ){
                    unset($subModel);
                    }

                    @endphp
                    <tr @if($isRepeater) data-repeater-item @endif>



                        <td class="text-center">
                            <div class="">
                                <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                                </i>
                            </div>
                        </td>


                        <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                        <td>
                            <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                        </td>
                        <td>

                            <div class="d-flex align-items-center js-common-parent">
                                <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                                @include('ul-to-trigger-popup')
                            </div>
                        </td>
                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getRevenueStreamType() : 'service'" :options="getRevenueStreamTypes()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ?'revenue_stream_type':$tableId.'[0][revenue_stream_type]' }}"></x-form.select>

                        </td>



                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseOne() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater? 'allocation_base_1':$tableId.'[0][allocation_base_1]' }}"></x-form.select>

                        </td>

                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseTwo() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_2' : $tableId.'[0][allocation_base_2]'  }}" ></x-form.select>

                        </td>

                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getAllocationBaseThree() : ''" :options="getAllocationsBases()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'allocation_base_3' : $tableId.'[0][allocation_base_3]'  }}"></x-form.select>

                        </td>


                        <td>
                            <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                        </td>
                        {{-- <td>
                                        <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyPercentage(),0) : 0) }}" @if($isRepeater) name="monthly_percentage" @else name="{{ $tableId }}[0][monthly_amount]" @endif class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyPercentage() : 0) }}" @if($isRepeater) name="monthly_percentage" @else name="{{ $tableId }}[0][monthly_amount]" @endif>

                        </td> --}}
                        <td>
                            <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select repeater-select payment_terms " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                            <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>

                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                <span style="margin-left:3px	">%</span>
                                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                            </div>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                            </div>
                        </td>

                        {{-- {{ dd($subModel->getWithholdTaxRate()) }} --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                                <span style="margin-left:3px	">%</span>
                                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                            </div>
                        </td>


                        @php
                        $payloadIndex = 0 ;
                        @endphp
                        @foreach($dates as $fullDate => $dateFormatted)
                        <td>
                            <div class="d-flex align-items-center flex-wrap text-center can-be-repeated-parent">
                                <input data-column-index="{{ $payloadIndex }}" class="form-control can-be-repeated-text only-greater-than-or-equal-zero-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getPayloadAtDate($payloadIndex)) : 0 }}" type="text">
                                <input class="can-be-repeated-hidden" type="hidden" value="{{ (isset($subModel) ? $subModel->getPayloadAtDate($payloadIndex) : 0) }}" multiple @if($isRepeater) name="payload" @else name="{{ $tableId }}[0][payload][{{ $fullDate }}]" @endif>
                                <i class="fa fa-ellipsis-h repeat-to-r " title="{{ __('Repeat To Right') }}" data-column-index="{{ $payloadIndex }}" data-digit-number="0"></i>
                            </div>
                        </td>

                        @php
                        $payloadIndex++ ;
                        @endphp

                        @endforeach


                        {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),2) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

    </div>
    </td>
    <td>
        <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="@if($isRepeater) increase_interval @else {{ $tableId }}[0][increase_interval] @endif" id="{{$type.'_'.'duration_type' }}"></x-form.select>

    </td> --}}


    </tr>
    @endforeach

    </x-slot>




    </x-tables.repeater-table>
    {{-- end of varying cost Per unit --}}








    {{-- start of fixed cost per unit --}}
    @php
    $tableId = 'expense_per_employee';
    $repeaterId = 'expense_per_employee_repeater';

    @endphp
    <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
    <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
        <x-slot name="ths">
            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Department')" :helperTitle="__('Department')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Employee <br> Position')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Monthly Cost <br> Per Unit')" :helperTitle="__('Please insert Cost Per Unit excluding VAT')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th>
        </x-slot>
        <x-slot name="trs">
            @php
            $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
            @endphp
            @foreach( count($rows) ? $rows : [-1] as $subModel)
            @php
            if( !($subModel instanceof \App\Models\Expense) ){
            unset($subModel);
            }

            @endphp
            <tr @if($isRepeater) data-repeater-item @endif>



                <td class="text-center">
                    <div class="">
                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                        </i>
                    </div>
                </td>


                <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                <td>
                    <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                </td>
                <td>

                    <div class="d-flex align-items-center js-common-parent">
                        <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                        @include('ul-to-trigger-popup')
                    </div>
                </td>
                <td>
                    {{-- this must be multiselect --}}
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getDepartment() : 'department'" :options="[]" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'department' : $tableId.'[0][department]'  }}" ></x-form.select>

                </td>
                <td>
                    {{-- this must be multiselect --}}
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getEmployee() : 'employee'" :options="[]" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'employee' : $tableId.'[0][employee]'  }}" ></x-form.select>

                </td>
                <td>
                    <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                </td>
                <td>
                    <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyCostOfUnit(),0) : 0) }}" class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyCostOfUnit() : 0) }}" @if($isRepeater) name="monthly_cost_of_unit" @else name="{{ $tableId }}[0][monthly_cost_of_unit]" @endif>

                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select repeater-select  payment_terms" data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                    <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>


                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                    </div>
                </td>

                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                    </div>
                </td>


                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

                    </div>
                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'increase_interval':$tableId.'[0][increase_interval]' }}" id="{{$type.'_'.'duration_type' }}"></x-form.select>

                </td>


            </tr>
            @endforeach

        </x-slot>




    </x-tables.repeater-table>
    {{-- end of expense per employee --}}




    {{-- start of intervally repeating amount --}}
    @php
    $tableId = 'intervally_repeating_amount';
    $repeaterId = 'intervally_repeating_amount_repeater';

    @endphp
    <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
    <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
        <x-slot name="ths">
            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Start <br> Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Amount')" :helperTitle="__('Please insert amount excluding VAT')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> After')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th>
        </x-slot>
        <x-slot name="trs">
            @php
            $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
            @endphp
            @foreach( count($rows) ? $rows : [-1] as $subModel)
            @php
            if( !($subModel instanceof \App\Models\Expense) ){
            unset($subModel);
            }

            @endphp
            <tr @if($isRepeater) data-repeater-item @endif>
                <td class="text-center">
                    <div class="">
                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                        </i>
                    </div>
                </td>


                <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                <td>
                    <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                </td>
                <td>

                    <div class="d-flex align-items-center js-common-parent">
                        <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                        @include('ul-to-trigger-popup')
                    </div>
                </td>
                <td>
                    <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                </td>
                <td>
                    <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyAmount(),0) : 0) }}" @if($isRepeater) name="monthly_amount" @else name="{{ $tableId }}[0][monthly_amount]" @endif class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyAmount() : 0) }}" @if($isRepeater) name="monthly_amount" @else name="{{ $tableId }}[0][monthly_amount]" @endif>

                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select repeater-select payment_terms " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                    <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>


                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getInterval() : 2" :options="getPaymentIntervals()" :add-new="false" class="select2-select repeater-select  " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'interval' : $tableId.'[0][interval]'  }}" ></x-form.select>

                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                    </div>
                </td>


                <td>
                    <div class="d-flex align-items-center">
                        <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                    </div>
                </td>

                {{-- {{ dd($subModel->getWithholdTaxRate()) }} --}}
                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                    </div>
                </td>


                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

                    </div>
                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'increase_interval':$tableId.'[0][increase_interval]' }}" id="{{$type.'_'.'duration_type' }}"></x-form.select>

                </td>


            </tr>
            @endforeach

        </x-slot>




    </x-tables.repeater-table>
    {{-- end of intervally repeating amount --}}






    {{-- start of one time expense --}}
    @php
    $tableId = 'one_time_expense';
    $repeaterId = 'one_time_expense_repeater';

    @endphp
    <input type="hidden" name="tableIds[]" value="{{ $tableId }}">
    <x-tables.repeater-table :repeater-with-select2="true" :parentClass="'js-toggle-visiability'" :tableName="$tableId" :repeaterId="$repeaterId" :relationName="'food'" :isRepeater="$isRepeater=!(isset($removeRepeater) && $removeRepeater)">
        <x-slot name="ths">
            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Name')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Expense <br> Category')" :helperTitle="__('If you have different expense items under the same category, please insert Category Name')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Date')" :helperTitle="__('Defualt date is Income Statement start date, if else please select a date')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Amount')" :helperTitle="__('Please insert amount excluding VAT')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-2" :title="__('Payment <br> Terms')" :helperTitle="__('You can either choose one of the system default terms (cash, quarterly, semi-annually, or annually), if else please choose Customize to insert your payment terms')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('VAT <br> Rate')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Is Deductible')"></x-tables.repeater-table-th>
            <x-tables.repeater-table-th class="col-md-1" :title="__('Withhold <br> Tax Rate')" :helperTitle="__('Withhold Tax rate will be calculated based on Monthly Amount excluding VAT')"></x-tables.repeater-table-th>
            {{-- <x-tables.repeater-table-th class="col-md-1" :title="__('Increase <br> Rate')"></x-tables.repeater-table-th> --}}
            {{-- <x-tables.repeater-table-th class="col-md-2" :title="__('Increase <br> Interval')"></x-tables.repeater-table-th> --}}
        </x-slot>
        <x-slot name="trs">
            @php
            $rows = isset($model) ? $model->generateRelationDynamically($tableId,$expenseType)->get() : [-1] ;
            @endphp
            @foreach( count($rows) ? $rows : [-1] as $subModel)
            @php
            if( !($subModel instanceof \App\Models\Expense) ){
            unset($subModel);
            }

            @endphp
            <tr @if($isRepeater) data-repeater-item @endif>
                <td class="text-center">
                    <div class="">
                        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
                        </i>
                    </div>
                </td>


                <input type="hidden" name="id" value="{{ isset($subModel) ? $subModel->id : 0 }}">
                <td>
                    <input value="{{ isset($subModel) ?  $subModel->getName() : old('name') }}" class="form-control" @if($isRepeater) name="name" @else name="{{ $tableId }}[0][name]" @endif type="text">
                </td>
                <td>

                    <div class="d-flex align-items-center js-common-parent">
                        <input value="{{ isset($subModel) ? $subModel->getCategoryName() : null }}" class="form-control js-show-all-categories-popup" @if($isRepeater) name="category_name" @else name="{{ $tableId }}[0][category_name]" @endif type="text">
                        @include('ul-to-trigger-popup')
                    </div>
                </td>
                <td>
                    <x-calendar :value="isset($subModel) ? $subModel->getStartDateFormatted() : null " :id="'start_date'" name="start_date"></x-calendar>
                </td>
                <td>
                    <input value="{{ (isset($subModel) ? number_format($subModel->getMonthlyAmount(),0) : 0) }}" @if($isRepeater) name="monthly_amount" @else name="{{ $tableId }}[0][monthly_amount]" @endif class="form-control text-center only-greater-than-or-equal-zero-allowed" type="text">
                    <input type="hidden" value="{{ (isset($subModel) ? $subModel->getMonthlyAmount() : 0) }}" @if($isRepeater) name="monthly_amount" @else name="{{ $tableId }}[0][monthly_amount]" @endif>

                </td>
                <td>
                    <x-form.select :selectedValue="isset($subModel) ? $subModel->getPaymentTerm() : 'cash'" :options="getPaymentTerms()" :add-new="false" class="select2-select repeater-select payment_terms " data-filter-type="{{ $type }}" :all="false" name="{{ $isRepeater ? 'payment_terms' : $tableId.'[0][payment_terms]'  }}"></x-form.select>
                    <x-modal.custom-collection :subModel="isset($subModel) ? $subModel : null " :tableId="$tableId" :isRepeater="$isRepeater" :id="$repeaterId.'test-modal-id'"></x-modal.custom-collection>


                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getVatRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getVatRate() : 0) }}" @if($isRepeater) name="vat_rate" @else name="{{ $tableId }}[0][vat_rate]" @endif>

                    </div>
                </td>

                <td>
                    <div class="d-flex align-items-center">
                        <input @if($isRepeater) name="is_deductible" @else name="{{ $tableId }}[0][is_deductible]" @endif class="form-control max-w-checkbox  text-center" value="1" @if(isset($subModel) ? $subModel->isDeductible() : false) checked @endif type="checkbox">
                    </div>
                </td>
                {{-- {{ dd($subModel->getWithholdTaxRate()) }} --}}
                <td>
                    <div class="d-flex align-items-center">
                        <input class="form-control only-percentage-allowed text-center" value="{{ isset($subModel) ? number_format($subModel->getWithholdTaxRate(),PERCENTAGE_DECIMALS) : 0 }}" type="text">
                        <span style="margin-left:3px	">%</span>
                        <input type="hidden" value="{{ (isset($subModel) ? $subModel->getWithholdTaxRate() : 0) }}" @if($isRepeater) name="withhold_tax_rate" @else name="{{ $tableId }}[0][withhold_tax_rate]" @endif>
                    </div>
                </td>


                {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" value="{{ isset($subModel) ? number_format($subModel->getIncreaseRate(),2) : 0 }}" type="text">
                <span style="margin-left:3px	">%</span>
                <input type="hidden" value="{{ (isset($subModel) ? $subModel->getIncreaseRate() : 0) }}" @if($isRepeater) name="increase_rate" @else name="{{ $tableId }}[0][increase_rate]" @endif>

</div>
</td>
<td>
    <x-form.select :selectedValue="isset($subModel) ? $subModel->getIncreaseInterval() : 'annually' " :options="getDurationIntervalTypesForSelectExceptMonthly()" :add-new="false" class="select2-select   repeater-select" data-filter-type="{{ $type }}" :all="false" name="@if($isRepeater) increase_interval @else {{ $tableId }}[0][increase_interval] @endif" id="{{$type.'_'.'duration_type' }}"></x-form.select>

</td> --}}


</tr>
@endforeach

</x-slot>




</x-tables.repeater-table>
{{-- end of one time expense --}}













































</div>


</div>
</div>
<x-save />




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
    $(document).on('change', '.financial-statement-type', function() {
        validateDuration();
    })
    $(document).on('change', 'select[name="duration_type"]', function() {
        validateDuration();
    })
    $(document).on('change', '#duration', function() {
        validateDuration();
    })

    function validateDuration() {
        let type = $('input[name="type"]:checked').val();
        let durationType = $('select[name="duration_type"]').val();
        let duration = $('#duration').val();
        let isValid = true;
        let allowedDuration = 24;
        if (type == 'forecast' && durationType == 'monthly') {
            allowedDuration = 24;
            isValid = duration <= allowedDuration;
        }
        if (type == 'forecast' && durationType == 'quarterly') {
            allowedDuration = 8;
            isValid = duration <= allowedDuration
        }
        if (type == 'forecast' && durationType == 'semi-annually') {
            allowedDuration = 4
            isValid = duration <= allowedDuration
        }
        if (type == 'forecast' && durationType == 'annually') {
            allowedDuration = 2;
            isValid = duration <= allowedDuration
        }
        if (type == 'actual' && durationType == 'monthly') {
            allowedDuration = 36;
            isValid = duration <= allowedDuration;
        }
        if (type == 'actual' && durationType == 'quarterly') {
            allowedDuration = 12
            isValid = duration <= allowedDuration;
        }
        if (type == 'actual' && durationType == 'semi-annually') {
            allowedDuration = 6;
            isValid = duration <= allowedDuration
        }
        if (type == 'actual' && durationType == 'annually') {
            allowedDuration = 3
            isValid = duration <= allowedDuration
        }
        let allowedDurationText = "{{ __('Allowed Duration') }}";

        $('#allowed-duration').html(allowedDurationText + '  ' + allowedDuration)

        if (!isValid) {
            Swal.fire({
                icon: 'error'
                , title: 'Invalid Duration. Allowed [ ' + allowedDuration + ' ]'
            , })

            $('#duration').val(allowedDuration).trigger('change');

        }


    }

    $(function() {
        $('.financial-statement-type').trigger('change')

    })

</script>

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
    $(document).find('.datepicker-input').datepicker({
        dateFormat: 'mm-dd-yy'
        , autoclose: true
    })

</script>
<script>
    function reinitalizeMonthYearInput(dateInput) {
        var currentDate = $(dateInput).val();
        var startDate = "{{ isset($studyStartDate) && $studyStartDate ? $studyStartDate : -1 }}";
        startDate = startDate == '-1' ? '' : startDate;
        var endDate = "{{ isset($studyEndDate) && $studyEndDate? $studyEndDate : -1 }}";
        endDate = endDate == '-1' ? '' : endDate;

        $(dateInput).datepicker({
                viewMode: "year"
                , minViewMode: "year"
                , todayHighlight: false
                , clearBtn: true,


                autoclose: true
                , format: "mm/01/yyyy"
            , })
            .datepicker('setDate', new Date(currentDate))
            .datepicker('setStartDate', new Date(startDate))
            .datepicker('setEndDate', new Date(endDate))


    }

    $(function() {

        $('.only-month-year-picker').each(function(index, dateInput) {
            reinitalizeMonthYearInput(dateInput)
        })



    });
    //  $(document).on('change', '#expense_type', function() {
    //      $('.js-parent-to-table').hide();
    //      let tableId = '.' + $(this).val();
    //      $(tableId).closest('.js-parent-to-table').show();
    //
    //  }) 
    $(document).on('click', '.js-type-btn', function(e) {
        e.preventDefault();
        $('.js-type-btn').removeClass('active');
        $(this).addClass('active');
        $('.js-parent-to-table').hide();
        let tableId = '.' + $(this).attr('data-value');
        $(tableId).closest('.js-parent-to-table').show();

    })
    $(function() {
        $('#expense_type').trigger('change')
        $('.js-type-btn.active').trigger('click')
    })

    $(function() {
        $(document).on('click', '.js-show-all-categories-trigger', function() {
            const elementToAppendIn = $(this).parent().find('.js-append-into');
            const texts = [];
            let lis = '';
            text = '<u><a href="#" data-close-new class="text-decoration-none mb-2 d-inline-block text-nowrap ">' + 'Add New' + '</a></u>'
            lis += '<li >' + text + '</li>'
            $(this).closest('table').find('.js-show-all-categories-popup').each(function(index, element) {
                let text = $(element).val().trim();
                if (text && !texts.includes(text)) {
                    texts.push(text)
                    text = '<a href="#" data-add-new class="text-decoration-none mb-2 d-inline-block">' + text + '</a>'
                    lis += '<li >' + text + '</li>'
                }
            })




            elementToAppendIn.removeClass('d-none');
            elementToAppendIn.find('ul').empty().append(lis);
        })


    })
    $(document).on('click', '[data-add-new]', function(e) {
        e.preventDefault();
        let content = $(this).html();
        $(this).closest('.js-common-parent').find('input').val(content);
    })
    $(document).on('click', '[data-close-new]', function(e) {
        e.preventDefault();
        $(this).closest('.js-append-into').addClass('d-none');
        $(this).closest('.js-common-parent').find('input').val('').focus();
    })
    $(document).on('click', function(e) {
        let closestParent = $(e.target).closest('.js-append-into').length;
        if (!closestParent && !$(e.target).hasClass('js-show-all-categories-trigger')) {
            $('.js-append-into').addClass('d-none');
        }
    })
    $(function() {
        // alert($('.reapter-select').length)
        $('.repeater-with-select2').closest('.repeater-class').find('[data-repeater-delete]').trigger('click');
        $('.repeater-with-select2').closest('.repeater-class').find('[data-repeater-create]').trigger('click');
    });

</script>
@endsection



@push('js_end')

<script>
    $('input:not([placeholder]):not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([readonly]):not(.exclude-text):not(.date-input)').on('focus', function() {
        oldValForInputNumber = $(this).val();
        if (isNumber(oldValForInputNumber)) {
            $(this).val('')

        }
    })
    $('input:not([placeholder]):not([type="checkbox"]):not([type="radio"]):not([type="submit"]):not([readonly]):not(.exclude-text):not(.date-input)').on('blur', function() {

        if ($(this).val() == '') {
            if (isNumber(oldValForInputNumber)) {
                $(this).val(oldValForInputNumber)
            }
        }
    })

    $(document).on('change', 'input:not([placeholder])[type="number"],input:not([placeholder])[type="password"],input:not([placeholder])[type="text"],input:not([placeholder])[type="email"],input:not(.exclude-text)', function() {
        if (!$(this).hasClass('exclude-text')) {
            let val = $(this).val()
            val = number_unformat(val)
            if (isNumber(val)) {
                $(this).parent().find('input[type="hidden"]').val(val)
            }

        }
    })
    $(document).on('click', '.repeat-to-r', function() {
        const columnIndex = $(this).data('column-index');
        const digitNumber = $(this).data('digit-number');
        const val = $(this).parent().find('input[type="hidden"]').val();
        $(this).closest('tr').find('.can-be-repeated-parent').each(function(index, parent) {
            if (index > columnIndex) {
                $(parent).find('.can-be-repeated-text').val(val);
                $(parent).find('.can-be-repeated-text').val(number_format(val, digitNumber));

            }
        })
    })


    $('select.js-condition-to-select').change(function() {
        const value = $(this).val();
        const conditionalValueTwoInput = $(this).closest('tr').find('input.conditional-b-input');
        console.log(value, value == 'between-and-equal')
        if (value == 'between-and-equal' || value == 'between') {
            conditionalValueTwoInput.prop('disabled', false).trigger('change');
        } else {
            conditionalValueTwoInput.prop('disabled', true).trigger('change');
        }
    })

    $('select.js-condition-to-select').trigger('change');
    $(document).on('change', '.conditional-input', function() {
        if (!$(this).closest('tr').find('conditional-b-input').prop('disabled')) {
            const conditionalA = $(this).closest('tr').find('.conditional-a-input').val();
            const conditionalB = $(this).closest('tr').find('.conditional-b-input').val();
            if (conditionalA >= conditionalB) {
                if (conditionalA == 0 && conditionalB == 0) {
                    return;
                }
                Swal.fire('conditional a must be less than conditional b value');
                $(this).closest('tr').find('.conditional-a-input').val($(this).closest('tr').find('.conditional-b-input').val() - 1);
            }
        }

    })

</script>
<script>
    const handlePaymentTermModal = function() {
        const parentTermsType = $(this).closest('select').val();
        console.log(parentTermsType)
        const tableId = $(this).closest('table').attr('id');
        if (parentTermsType == 'customize') {
            $(this).closest('tr').find('#' + tableId + 'test-modal-id').modal('show')
        }



    };
    $(document).on('change', 'select.payment_terms', handlePaymentTermModal)
    $('select.js-due_in_days').change(function() {
        // const selectValue = $(this).val();
        // $(this).find('option').prop('selected',false)
        // $(this).find('option[value="'+selectValue+'"]').prop('selected',true);
        // reinitializeSelect2();
    })

    //$(document).on('click','option',handlePaymentTermModal)
    $(document).on('change', '.rate-element', function() {
        let total = 0;
        const parent = $(this).closest('tbody');
        console.log(parent.find('.rate-element-hidden'));
        parent.find('.rate-element-hidden').each(function(index, element) {
            total += parseFloat($(element).val());
        });
        console.log(total);
        parent.find('td.td-for-total-payment-rate').html(number_format(total, 2) + ' %');

    })
    $(function() {
        $('.rate-element').trigger('change');
    })

</script>
@endpush
