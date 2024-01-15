@php
$isRepeater = !(isset($removeRepeater) && $removeRepeater) ;
@endphp
<div @if($isRepeater) data-repeater-item @endif class="form-group  row align-items-center 
 m-form__group
 @if($isRepeater)
 repeater_item
 @endif
 ">
    <div class="col-md-8">
        @if(isset($onlyTotal))
        <label class="form-label font-weight-bold">{{ __('Rooms Type') }}</label>
        <select name="rooms[0][room_type_id]" class="form-control">
            <option value="0">{{ __('Total Rooms') }}</option>
        </select>
        @else
        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater rooms-select-item" :is-required="true" :is-select2="false" :options="getRoomsTypes(true)" :add-new="false" :label="__('Rooms Types')" data-filter-type="{{ $type }}" :all="false" name="room_type_id" id="{{$type.'_'.'room_type_id' }}" :selected-value="isset($room) ? $room->getRoomIdentifier(): 0 "></x-form.select>
        @endif
    </div>
    <div class="col-md-2">
        <label class="form-label font-weight-bold">{{ __('Room Count') }} @include('star') </label>
        <div class="kt-input-icon">
            <div class="input-group">
                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" @if($isRepeater) name="room_count" @else name="rooms[0][room_count]" @endif {{-- name="" --}} value="{{ isset($room) ? $room->getRoomCount() : old('room_count') }}">
            </div>
        </div>
    </div>

    <div class="col-md-2">
        <label class="form-label font-weight-bold">{{ __('Average Guest Per Room') }} @include('star') </label>
        <div class="kt-input-icon">
            <div class="input-group">
                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed " @if($isRepeater) name="guest_per_room" @else name="rooms[0][guest_per_room]" @endif value="{{ isset($room) ? $room->getGuestPerRoom() : old('guest_per_room') }}" step="0.5">
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
