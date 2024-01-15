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
			        <label class="form-label font-weight-bold">{{ __('Gaming Type') }}</label>
			        <select name="casinos[0][casino_type_id]" class="form-control">
			            <option value="0">{{ __('Total Gaming Facility') }}</option>
			        </select>
			        @else
			        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="getCasinoTypes(true)" :add-new="false" :label="__('Gaming Facility Types')" data-filter-type="{{ $type }}" :all="false" name="casino_type_id" id="{{$type.'_'.'casino_type_id' }}" :selected-value="isset($casino) ? $casino->getCasinoTypeId(): 0 "></x-form.select>

			        @endif
			    </div>
			    <div class="col-md-2">
			        <label class="form-label font-weight-bold">{{ __('Gaming Facility Count') }} @include('star') </label>
			        <div class="kt-input-icon">
			            <div class="input-group">
			                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed"
									@if($isRepeater)
							 name="casino_count"
							 @else 
							 	name="casinos[0][casino_count]"
							 @endif 
							 
							  value="{{ isset($casino) ? $casino->getCasinoCount() : old('casino_count') }}">
			            </div>
			        </div>
			    </div>

			    <div class="col-md-2">
			        <label class="form-label font-weight-bold">{{ __('Guest Capacity') }} </label>
			        <div class="kt-input-icon">
			            <div class="input-group">
			                <input type="number" class="form-control only-greater-than-or-equal-zero-allowed "
									@if($isRepeater)
							 name="casino_cover"
							 @else 
								name="casinos[0][casino_cover]"
								@endif
							  value="{{ isset($casino) ? $casino->getCasinoCover() : old('casino_cover') }}" step="0.5">
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
