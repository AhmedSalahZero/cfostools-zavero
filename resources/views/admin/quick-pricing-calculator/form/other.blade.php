@php
$isRepeater = !(isset($removeRepeater) && $removeRepeater) ;
@endphp

<div @if($isRepeater) data-repeater-item @endif class="form-group m-form__group row align-items-center 
										
										@if($isRepeater)
										repeater_item
										@endif 
										">

    <div class="col-md-8">
        @if(isset($onlyTotal))
        <label class="form-label font-weight-bold">{{ __('Other Revenue Facility Type') }}</label>
        <select name="others[0][other_type_id]" class="form-control">
            <option value="0">{{ __('Total Other Revenue Facilities') }}</option>
        </select>
        @else
        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="getOtherTypes(true)" :add-new="false" :label="__('Other Facility Types')" data-filter-type="{{ $type }}" :all="false" name="other_type_id" id="{{$type.'_'.'other_type_id' }}" :selected-value="isset($other) ? $other->getOtherTypeId(): 0 "></x-form.select>
        @endif
    </div>
    <div class="col-md-4">
        <label class="form-label font-weight-bold">{{ __('Other Facility Count') }} @include('star') </label>
        <div class="kt-input-icon">
            <div class="input-group">
                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed"
				@if($isRepeater) name="other_count" @else name="others[0][other_count]" @endif 
				  value="{{ isset($other) ? $other->getOtherCount() : old('other_count') }}">
            </div>
        </div>
    </div>




    @if($isRepeater)
    <div class="">
        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">

        </i>
    </div>
	@endif


</div>
