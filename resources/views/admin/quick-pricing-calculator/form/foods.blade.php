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
				        <label class="form-label font-weight-bold">{{ __('F&B Type') }}</label>
				        <select name="foods[0][food_type_id]" class="form-control">
				            <option value="0">{{ __('Total F&B Facility') }}</option>
				        </select>
				        @else
				        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="getFoodsTypes(true)" :add-new="false" :label="__('F&B Facility Types')" data-filter-type="{{ $type }}" :all="false" name="food_type_id" id="{{$type.'_'.'food_type_id' }}" :selected-value="isset($food) ? $food->getFoodTypeId(): 0 "></x-form.select>
				        @endif
				    </div>
				    <div class="col-md-2">
				        <label class="form-label font-weight-bold">{{ __('F&B Facility Count') }} @include('star') </label>
				        <div class="kt-input-icon">
				            <div class="input-group">
				                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed" 
								@if($isRepeater)
								name="food_count"
								@else 
								name="foods[0][food_count]"
								@endif 
								 value="{{ isset($food) ? $food->getFoodCount() : old('food_count') }}">
				            </div>
				        </div>
				    </div>

				    <div class="col-md-2">
				        <label class="form-label font-weight-bold">{{ __('Guest Capacity') }} </label>
				        <div class="kt-input-icon">
				            <div class="input-group">
				                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed " 
										@if($isRepeater)
								name="food_cover"
								@else 
								name="foods[0][food_cover]"
								@endif
								
								 value="{{ isset($food) ? $food->getFoodCover() : old('food_cover') }}" step="0.5">
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
