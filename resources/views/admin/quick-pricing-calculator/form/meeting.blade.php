				@php
				$isRepeater = !(isset($removeRepeater) && $removeRepeater) ;
				@endphp


				<div @if($isRepeater) data-repeater-item @endif class="form-group m-form__group row align-items-center 
										   @if($isRepeater)
										 repeater_item
										 @endif 
										   ">

				    <div class="col-md-8">
				        @if(isset($onlyTotal) && $onlyTotal)
				        <label class="form-label font-weight-bold">{{ __('Meeting Type') }}</label>
				        <select name="meetings[0][meeting_type_id]" class="form-control">
				            <option value="0">{{ __('Total Meeting Facility') }}</option>
				        </select>
				        @else
				        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="getMeetingTypes(true)" :add-new="false" :label="__('Meeting Facility Types')" data-filter-type="{{ $type }}" :all="false" name="meeting_type_id" id="{{$type.'_'.'meeting_type_id' }}" :selected-value="isset($meeting) ? $meeting->getMeetingTypeId(): 0 "></x-form.select>
				        @endif
				    </div>
				    <div class="col-md-2">
				        <label class="form-label font-weight-bold">{{ __('Meeting Facility Count') }} @include('star') </label>
				        <div class="kt-input-icon">
				            <div class="input-group">
				                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" @if($isRepeater) name="meeting_count" @else name="meetings[0][meeting_count]" @endif value="{{ isset($meeting) ? $meeting->getMeetingCount() : old('meeting_count') }}">
				            </div>
				        </div>
				    </div>

				    <div class="col-md-2">
				        <label class="form-label font-weight-bold">{{ __('Guest Capacity') }} </label>
				        <div class="kt-input-icon">
				            <div class="input-group">
				                <input @if($isRepeater) name="meeting_cover" @else name="meetings[0][meeting_cover]" @endif type="number" class="form-control only-greater-than-or-equal-zero-allowed " value="{{ isset($meeting) ? $meeting->getMeetingCover() : old('meeting_cover') }}" step="0.5">
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
