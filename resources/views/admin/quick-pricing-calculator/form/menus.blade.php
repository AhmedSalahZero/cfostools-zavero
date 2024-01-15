@php
$isRepeater = !(isset($removeRepeater) && $removeRepeater) ;
@endphp
<div @if($isRepeater) data-repeater-item @endif class="form-group  row align-items-center 
 m-form__group
 @if($isRepeater)
 repeater_item
 @endif
 ">
    <div class="col-md-4">
     
        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater " :is-required="true" :is-select2="false" :options="[]" :add-new="true" :label="__('Item Name')" data-filter-type="{{ $type }}" :all="false" name="item_name" id="{{$type.'_'.'item_name' }}" :selected-value="isset($menu) ? $menu->getItemName(): 0 "></x-form.select>
    </div>
	    <div class="col-md-4">
           <x-form.select class="not-allowed-duplication-in-selection-inside-repeater " :is-required="true" :is-select2="false" :options="[]" :add-new="true" :label="__('Category Name')" data-filter-type="{{ $type }}" :all="false" name="category_name" id="{{$type.'_'.'category_name' }}" :selected-value="isset($menu) ? $menu->getCategoryName(): 0 "></x-form.select>
</div>
	
	    <div class="col-md-4">
        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater " :is-required="true" :is-select2="false" :options="getItemsType()" :add-new="false" :label="__('Item Type')" data-filter-type="{{ $type }}" :all="false" name="item_type" id="{{$type.'_'.'item_type' }}" :selected-value="isset($menu) ? $menu->getItemType(): 0 "></x-form.select>
	</div>
    {{-- <div class="col-md-2">
        <label class="form-label font-weight-bold">{{ __('Average Guest Per Room') }} @include('star') </label>
        <div class="kt-input-icon">
            <div class="input-group">
                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed " @if($isRepeater) name="guest_per_room" @else name="rooms[0][guest_per_room]" @endif value="{{ isset($room) ? $room->getGuestPerRoom() : old('guest_per_room') }}" step="0.5">
            </div>
        </div>
    </div> --}}


    @if($isRepeater)
    <div class="">
        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">

        </i>
    </div>
    @endif
</div>
