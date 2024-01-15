@extends('layouts.dashboard')
@section('css')
<style>
.w-49{
	width:49% !important;
}
</style>
<x-styles.commons></x-styles.commons>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{ $pageTitle }}</x-main-form-title>
@endsection
@section('content')


<div class="row">
    <div class="col-md-12">

        @csrf
        {{-- {{ dd($revenueBusinessLines[0]['value']) }} --}}
        {{-- {{ dd() }} --}}
		{{-- {{ dd($editMode) }} --}}
        <x-form.body method="post" action="{{ !isset($editMode) ? route('admin.store.revenue-business-line',$company->getIdentifier()) : route('admin.update.revenue',$company->getIdentifier()) }}">
            <x-form.hidden id="current_service_category_id" value="{{ isset($model) ? $model->getServiceCategoryId() : 0 }}"></x-form.hidden>
            <x-form.hidden name="old_revenue_business_line_id" value="{{ isset($revenueBusinessLineId) ? $revenueBusinessLineId : ''  }}"></x-form.hidden>
            <x-form.hidden name="old_service_category__id" value="{{ isset($serviceCategoryId) ? $serviceCategoryId : ''  }}"></x-form.hidden>
            <x-form.hidden name="old_service_item_id" value="{{ isset($serviceItemId) ? $serviceItemId : '' }}"></x-form.hidden>
            <x-form.bg-white :body-class="'min-height-170px justify-content-center '">
			{{-- <input type="hidden" name="old" --}}
                <x-form.row>
                    <x-form.wrapper class="flex-grow-1 mr-2">
                        <x-form.select :selected-value="isset($revenueBusinessLineId) ? $revenueBusinessLineId : '' " :options="$revenueBusinessLines" :add-new="!isset($editMode)" data-trigger-id="child-trigger-1" :label="__('Revenue Business Line')" class="select2-select revenue_business_line_class trigger-select-class " data-filter-type="{{ isset($model) ? 'update' : 'create' }}" :all="false" name="revenue_business_line_id" id="{{'revenue_business_line_id' }}">
                        </x-form.select>
                    </x-form.wrapper>

                    <x-form.wrapper class="flex-grow-1 mr-2">
                        <x-form.select :disabled="isset($editMode) && !isset($serviceItemId) " :selected-value="isset($serviceCategoryId) ? $serviceCategoryId : '' " :options="$serviceCategories" :add-new="!isset($editMode)" data-trigger-id="child-trigger-2" :label="__('Service Category')" class="select2-select service_category_class trigger-select-class " data-filter-type="{{ isset($model) ? 'update' : 'create' }}" :all="false" name="service_category_id" id="{{'service_category_id' }}"></x-form.select>
                    </x-form.wrapper>
					@if(!isset($editMode)  || (isset($serviceItemId) )  )
                    <x-form.wrapper class="flex-grow-1 mr-2">
                        <x-form.select :disabled="isset($editMode)"  :selected-value="isset($serviceItemId) ? $serviceItemId : ''" :options="$serviceItems" :add-new="!isset($editMode)" data-trigger-id="child-trigger-3" :label="__('Service Item')" class="select2-select service_item_class trigger-select-class " data-filter-type="{{ isset($model) ? 'update' : 'create' }}" :all="false" name="service_item_id" id="{{'service_item_id' }}"></x-form.select>
                    </x-form.wrapper>
					@endif 

                </x-form.row>





            </x-form.bg-white>


			@if(!isset($editMode))
            <x-form.bg-white id="child-trigger-1" class="child-trigger ">
               
                <x-form.row>
                        <x-form.wrapper class="child-trigger col-md-6  business_line_name">
                            <x-form.text :id="'revenue_business_line_name'" :model="@$model" label="{{__('Revenue Business Line Name')}}" name="revenue_business_line_name"></x-form.text>
                        </x-form.wrapper>
                        <x-form.wrapper class="child-trigger col-md-6  service_category_name">
                            <x-form.text :id="'service_category_name'" :model="@$model" label="{{__('Service Category Name')}}" name="service_category_name"></x-form.text>
                        </x-form.wrapper>

                        <x-helpers.repeater :item-classes="'w-49 mt-3 '" :instance-no="'1'" :group-name="'service_item'">
                            <x-form.row class="child-trigger col-md-12 ">
                                <x-form.wrapper class="col-md-12">
                                    <x-form.text :id="'service_item_name'" :model="@$model" label="{{__('Service Item Name')}}" name="service_item_name"></x-form.text>
                                </x-form.wrapper>
                </x-form.row>
                </x-helpers.repeater>

                </x-form.row>


                <!--End row-->

            </x-form.bg-white>
			@endif 






            <!-- End Row -->

            <x-form.submit></x-form.submit>
        </x-form.body>



    </div>
</div>

@endsection
@section('js')
@if(!isset($editMode))
<x-js.commons></x-js.commons>
@endif 



@endsection
