				@props([
				'id'=>$id ,
				'name'=>$name ,
				'value'=>$value ,
				'required'=>$required ?? false ,
				'inputClasses'=>$inputClasses ?? '',
				'label'=>$label,
				'readonly'=>$readonly ?? false,
				'cols'=>$cols ?? 'col-md-4',
				'parentClasses'=>$parentClasses ?? 'col-md-4 mb-4'
				])
				<div class="{{ $parentClasses }}" >
				    <x-form.label :class="'label'" :id="$id"> {{ $label }} @if($required) @include('star') @endif </x-form.label>
				    <div class="kt-input-icon">
				        <div class="input-group date">
				            <input id="{{ $id }}" type="text" name="{{ $name }}" class="
							@if(!$readonly)
							only-month-year-picker date-input
							@endif 
							 form-control {{ $inputClasses }}" readonly value="{{ $value }}" />
				            <div class="input-group-append">
				                <span class="input-group-text">
				                    <i class="la la-calendar"></i>
				                </span>
				            </div>
				        </div>
				    </div>
				</div>
