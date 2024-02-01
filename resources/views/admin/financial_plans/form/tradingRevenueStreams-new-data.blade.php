				@php
				$isRepeater = !(isset($removeRepeater) && $removeRepeater) ;
				@endphp


				<div @if($isRepeater) data-repeater-item @endif class="form-group m-form__group row align-items-center 
										 @if($isRepeater)
										 repeater_item
										 @endif 
										 
										 ">
				   
				   
				   <input type="hidden" 
										 	@if($isRepeater)
								name="id"
								@else 
								name="manfacturing[0][id]"
								@endif
								 value="{{ isset($tradingRevenueStream) ? $tradingRevenueStream->id : 0 }}">
								 
				    <div class="
					@if(isset($onlyTotal) && $onlyTotal)
					col-md-6
					@else 
					col-md-2
					@endif 
					
					">
				 
				 
                             <div class="col-md-12 ">
				            <label class="form-label font-weight-bold">{{ __('Category Name') }}
				                {{-- <span class="is-required">*</span> --}}
				                @include('star')
				            </label>
				            <div class="input-group">
				                <input type="text" class="form-control " @if($isRepeater) name="category_name" @else name="trading[0][category_name]" @endif value="" step="any">
				            </div>
				            {{-- <x-form.select  :add-new="false" :label="__('Category')" class="select2-select category_class  " data-filter-type="{{ $type }}" :all="false" name="category_id" id="{{$type.'_'.'category_id' }}" :selected-value="isset($manufacturingRevenueStream) ? $manufacturingRevenueStream->getCategoryId() : 0"></x-form.select> --}}

				        </div>
						     
				 
				    </div>
					
				    <div class="
					@if(isset($onlyTotal) && $onlyTotal)
					col-md-6
					@else 
					col-md-3
					@endif 
					
					">
				        {{-- @if(isset($onlyTotal) && $onlyTotal)
				        <label class="form-label font-weight-bold">{{ __('Product Name') }}</label>
				        <select name="products[0][name]" class="form-control">
				            <option value="0">{{ __('All Products') }}</option>
				        </select>
				        @else --}}
						
						    <label class="form-label font-weight-bold">{{ __('Product Name') }}
				            {{-- <span class="is-required">*</span> --}}
				            @include('star')
				        </label>
				        <div class="input-group">
				            <input type="text" class="form-control " @if($isRepeater) name="product_name" @else name="trading[0][product_name]" @endif value="" step="any">
				        </div>
							
                            {{-- <x-form.select :additional-column="'model_type'" :additional-column-value="'TradingRevenueStream'" :add-new-modal="true" :add-new-modal-modal-type="''" :add-new-modal-modal-name="'Product'" :add-new-modal-modal-title="__('Product Name')" :previous-select-name-in-dB="'category_id'" :previous-select-must-be-selected="true" :previous-select-selector="'select.category_class'" :previous-select-title="__('Category')" :options="$tradingProducts" :add-new="false" :label="__('Product Name')" class="select2-select product_class  " data-filter-type="{{ $type }}" :all="false" name="product_id" id="{{$type.'_'.'product_id' }}" :selected-value="isset($tradingRevenueStream) ? $tradingRevenueStream->getProductId() : 0"></x-form.select> --}}
				        {{-- @endif --}}
				    </div>
					
					<div class="col-md-2">
                            <x-form.select :add-new-modal="true" :add-new-modal-modal-type="''" :add-new-modal-modal-name="'SellingUnitOfMeasurement'" :add-new-modal-modal-title="__('Selling Unit Of Measurement')"  :options="$sellingUnitOfMeasurements" :add-new="false" :label="__('Selling UOM')" class="select2-select selling_unit_of_measurement_class  " data-filter-type="{{ $type }}" :all="false" name="selling_uom" id="{{$type.'_'.'selling_uom' }}" :selected-value="isset($tradingRevenueStream) ? $tradingRevenueStream->getSellingUOM() : 0"></x-form.select>
					</div>	
					
					<div class="col-md-2">
                            <x-form.select :add-new-modal="true" :add-new-modal-modal-type="''" :add-new-modal-modal-name="'ProductionUnitOfMeasurement'" :add-new-modal-modal-title="__('Production Unit Of Measurement')"  :options="$productionUnitOfMeasurements" :add-new="false" :label="__('Production UOM')" class="select2-select production_unit_of_measurement_class  " data-filter-type="{{ $type }}" :all="false" name="production_uom" id="{{$type.'_'.'production_uom' }}" :selected-value="isset($tradingRevenueStream) ? $tradingRevenueStream->getProductionUOM() : 0"></x-form.select>
				        {{-- <x-form.select class="not-allowed-duplication-in-selection-inside-repeater" :is-required="true" :is-select2="false" :options="getProductionUOM()" :add-new="false" :label="__('Production UOM')" data-filter-type="{{ $type }}" :all="false" name="production_uom" id="{{$type.'_'.'production_uom' }}" :selected-value="isset($tradingRevenueStream) ? $tradingRevenueStream->getProductionUOM(): 0 "></x-form.select> --}}
					</div>	
					

				    <div class="col-md-1 seat-count-js" >
				        <label class="form-label font-weight-bold">{{ __('Conversion') }} 
						{{-- <span class="is-required">*</span> --}}
						 @include('star')
						</label>
				        <div class="kt-input-icon">
				            <div class="input-group">
				                <input type="number" class="form-control only-greater-than-zero-allowed " 
										@if($isRepeater)
								name="product_to_selling_converter"
								@else 
								name="trading[0][product_to_selling_converter]"
								@endif
								
								 value="{{ isset($tradingRevenueStream) ? $tradingRevenueStream->getProductToSellingConverter() : 1 }}" step="any">
				            </div>
				        </div>
				    </div>
					
					<x-form.date :parentClasses="'col-md-2 mb-0'"  :readonly="false" :required="true" :id="$type.'_'.'product_selling_date'" :label="__('Selling Start Date')" :name="'selling_start_date'" :value="isset($tradingRevenueStream) ? $tradingRevenueStream->getSellingStartDate() : getCurrentDateForFormDate('date') " :inputClasses="''"></x-form.date>
					
					    @if($isRepeater)
				    <div class="">
				        <i data-repeater-delete="" class="btn-sm btn btn-danger m-btn m-btn--icon m-btn--pill trash_icon fas fa-times-circle">
				        </i>
				    </div>
					@endif 


				</div>























				