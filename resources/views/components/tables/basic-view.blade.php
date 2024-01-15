@props([
	'wrapWithForm'=>false ,
	'formAction'=>'#',
	'method'=>'post',
	'formId'=>''
])
@php
    $basicTableClasses = 'table table-striped- table-bordered  table-checkable' ;
@endphp

<input type="hidden" id="no-ajax-loader">
{{ $filter }}
{{ $export }}

	@if($wrapWithForm)
	<form action="{{ $formAction }}" method="{{$method  }}" id="{{$formId  }}">
	@csrf
	{{-- </form> --}}
	@endif 
	<table {{$attributes->merge(['class'=>$basicTableClasses ])}} id="{{ '#'.$attributes->get('id') }}">
		
										<thead>
                                            {{ $headerTr }}
										
										</thead>

									
									</table>

									@if($wrapWithForm)
									<x-submitting></x-submitting>
									{{-- <button class="btn btn-success">Save</button> --}}
										</form>
									@endif 

{{ $js }}
