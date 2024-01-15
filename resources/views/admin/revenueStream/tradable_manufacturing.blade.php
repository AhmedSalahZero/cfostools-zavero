<div class="d-flex flex-wrap w-100">
    <?php 
	$alpha = [
		'1' => 'A',
		'2' => 'B', 
	];
	$b = 0;
	?>
    @foreach($measurement_items as $Key=>$Val)

    @for($a=0; $a<=$measurement_number; $a++ ) <?php $b++; ?> <div class="col-md-4 mb-3">
        @include('components.form.label',[
        'isRequired'=>true ,
        'title'=> __($Key) . ' ' . __('Unit '.@$alpha[$a])
        ])

        <input type="text" name="product_volume_measurement[{{$Key}}][{{$a}}][name]" class="form-control" placeholder="Enter  {{$Key}} Unit Name .." value="{{@$Product_measurement[$b]->name}}" >
</div>
@if($a!=0 || $Key!='Selling')
<div class="col-md-4 mb-3">
    @include('components.form.label',[
    'isRequired'=>true ,
    'title'=> $Val
    ])
    <input type="text" name="product_volume_measurement[{{$Key}}][{{$a}}][conversion]" class="form-control only-greater-than-zero-allowed" placeholder="{{__('Enter')}} {{__('Conversion Rate')}} " value="{{@$Product_measurement[$b]->conversation_rate}}" @if($a==0) @endif>
</div>
@endif

@endfor
@endforeach
</div>
