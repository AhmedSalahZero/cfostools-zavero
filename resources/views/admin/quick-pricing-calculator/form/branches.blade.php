				@php
				$isRepeater = !(isset($removeRepeater) && $removeRepeater) ;
				@endphp


				<div @if($isRepeater) data-repeater-item @endif class="form-group m-form__group row align-items-center 
										 @if($isRepeater)
										 repeater_item
										 @endif 
										 
										 ">
				    <div class="
					@if(isset($onlyTotal) && $onlyTotal)
					col-md-6
					@else 
					col-md-3
					@endif 
					
					">
				        @if(isset($onlyTotal) && $onlyTotal)
				        <label class="form-label font-weight-bold">{{ __('Branch Name') }}</label>
				        <select name="branches[0][name]" class="form-control">
				            <option value="0">{{ __('All Branches') }}</option>
				        </select>
				        @else
				        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="[]" :add-new="true" :label="__('Branch Name')" data-filter-type="{{ $type }}" :all="false" name="name" id="{{$type.'_'.'name' }}" :selected-value="isset($branch) ? $branch->getBranchName(): 0 "></x-form.select>
				        @endif
				    </div>
					@if(isset($onlyTotal)&&$onlyTotal )
				    <div class="col-md-3">
				        <label class="form-label font-weight-bold">{{ __('Branches Count') }} @include('star') </label>
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
					@else
					<div class="col-md-3">
				        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="[]" :add-new="true" :label="__('Location')" data-filter-type="{{ $type }}" :all="false" name="location" id="{{$type.'_'.'location' }}" :selected-value="isset($branch) ? $branch->getBranchName(): 0 "></x-form.select>
					</div>	
					
					<div class="col-md-3">
				        <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="[]" :add-new="true" :label="__('Area')" data-filter-type="{{ $type }}" :all="false" name="area" id="{{$type.'_'.'area' }}" :selected-value="isset($branch) ? $branch->getBranchName(): 0 "></x-form.select>
					</div>
					@endif 

				    <div class="col-md-1 seat-count-js" >
				        <label class="form-label font-weight-bold">{{ __('Seats Count') }} </label>
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
					
					<x-form.date :parentClasses="'col-md-2 mb-0'"  :readonly="false" :required="true" :id="$type.'_'.'branch_opeartion_date'" :label="__('Operation Start Date')" :name="'operation_start_date'" :value="isset($model) ? $model->getOperationStartDate() : getCurrentDateForFormDate('date') " :inputClasses="''"></x-form.date>
					
					    @if($isRepeater)
				    <div class="">
				        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
				        </i>
				    </div>
					@endif 


				</div>























				
