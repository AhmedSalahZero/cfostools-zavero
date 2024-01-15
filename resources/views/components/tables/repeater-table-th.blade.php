@props([
'title'=>$title,
'helperTitle'=>$hasHelper ?? '',
// 'helperPrependTitle'=> '',
// 'helperAppendTitle'=> '',

])

<th {{ $attributes->merge(['class'=>'form-label font-weight-bold  text-center align-middle']) }}>
	<div class="d-flex align-items-center justify-content-center">
	<span>{!! $title !!}</span>
    @if($helperTitle)
    <span class="kt-input-icon__icon kt-input-icon__icon--right ml-2" tabindex="0" role="button" data-toggle="kt-tooltip" data-trigger="focus" title="{{ str_replace('{title}',$title,$helperTitle) }}">
        <span><i class="fa fa-question text-primary"></i></span>
    </span>
    @endif
	    {{-- @if($helperPrependTitle)
    <span class="kt-input-icon__icon kt-input-icon__icon--right ml-2" tabindex="0" role="button" data-toggle="kt-tooltip" data-trigger="focus" title="{{ $helperPrependTitle   }} {!! $title !!} {{ $helperAppendTitle }}" >
        <span><i class="fa fa-question text-primary"></i></span>
    </span>
    @endif --}}
	</div>

</th>
