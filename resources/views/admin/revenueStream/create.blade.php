@extends('admin.client_view')
@section('Title')
<style>

</style>
<span class="kt-portlet__head-icon">
    <i class="kt-font-brand flaticon2-line-chart fa-fw flaticon-house-sketch pull-{{__('left')}}"></i>
    {{__('Add Revenue Stream')}}
</span>
<a href="{{route('revenueStream.index',['company_id' => $company->id])}}" class="btn btn-brand btn-add btn-icon-sm pull-{{__('right')}}">
    <span class="pull-{{__('left')}}"><i class="fa fa-list"></i></span>
    {{__('The List')}}
</a>
@endsection
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(Session::has('unique_alert'))
<div class="alert alert-danger">
    <ul>
        <li>{{Session::get('unique_alert')}}</li>
    </ul>
</div>
@endif
<!--begin::Form-->

<form onsubmit="return changeActionUrl();" method="POST" action="{{route('revenue.stream.add.categories',$company->id)}}" enctype="multipart/form-data">
    <input type="hidden" id="current_form_action" value="{{route('revenue.stream.add.categories',$company->id)}}">
	{{ csrf_field() }}
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="form-group row">
                <div class="col-md-5">
				@if((isset($canAddProducts) || isset($canAddNewProducts) ? ' disabled':''))
				<input type="hidden" name="type" value="{{ isset($type)? $type:'' }}">
				@endif 
                    @include('components.form.select',[
                    'label'=>__('Revenue Stream Type') ,
                    'items'=>$revenues,
                    'titleAttributeName'=>'name',
                    'valueAttributeName'=>'id',
                    'isRequired'=>true ,
					'selectedOption'=>isset($type) ? $type : 0,
                    'name'=>'type',
                    'id'=>'Revenue_Stream_Type',
                    'attributes'=>'onchange=TypeFunction()' . (isset($canAddProducts) || isset($canAddNewProducts)  ? ' disabled':'')
                    ])
                </div>
                <div class="col-md-5 text-center">
                    @include('components.form.radio',[
                    'title'=>__('Do You Want To Add New Categories'),
                    'isRequired'=>false ,
                    'name'=>'add_categories',
                    'radios'=>[
                    [
                    'radioClasses'=>'add-categories-radio',
                    'is_checked'=>true ,
                    'label'=>__('Yes'),
                    'value'=>1,
                    'color_class'=>'kt-radio--success',
					'disabled'=>false ,
					// 'disabled'=>! isset($canAddNewProducts) ,
                    ],
                    [
                    'radioClasses'=>'add-categories-radio',
                    'is_checked'=>isset($canAddNewProducts)  && $canAddNewProducts ,
                    'label'=>__('No'),
                    'value'=>0,
                    'color_class'=>'kt-radio--danger',
					'disabled'=>!\App\Category_product::where('company_id',$company_id)->count()
                    ]
                    ]
                    ])
                </div>


                <div class="col-md-2 conditional-show d-none " data-conditional-class="add-categories-radio" data-show-if="1">
                    <label class="form-label font-weight-bold">{{ __('Category Count') }}
                        <span class="text-danger ">*</span>
                    </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input type="number" class="form-control only-greater-than-zero-allowed" name="categories_count" value="{{ $noCategories??1 }}">
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 conditional-show d-none " data-conditional-class="add-categories-radio" data-show-if="0">
                    <label class="form-label font-weight-bold">{{ __('New Products Count') }}
                        <span class="text-danger ">*</span>
                    </label>
                    <div class="kt-input-icon">
                        <div class="input-group">
                            <input type="number" class="form-control only-greater-than-zero-allowed" name="product_count" value="{{ $noProducts??1 }}">
                        </div>
                    </div>
                </div>
				
                <div class="div col-md-12 text-right">
                    @include('components.form.submit',[
                    'name'=>'add_categories',
                    'value'=>__('Add Categories'),
					'action'=>route('revenue.stream.add.categories',['company_id'=>$company_id]),
                    'attributes'=>'data-conditional-class=add-categories-radio data-show-if=1',
                    'classes'=>'conditional-show d-none',
					'backRoute'=>route('revenueStream.index',['company_id'=>$company_id])
                    ])

                </div>
				
				
				
				  


            </div>
			
			      
				@if(isset($canAddCategory) && $canAddCategory)
		            @include('components.tables.revenue-type.categories',[
						'noRows'=>$noCategories,
					//	'trs'=>$firstTdTrs,
					//	'attributes'=>'data-conditional-class=add-categories-radio data-show-if=1',
					//	'headers'=>[
					//		[
					//			'title'=>'#',
					//			'classess'=>'',
					//		],
					//		[
					//			'title'=>__('Category Name'),
					//			'classess'=>''
					//		],
					//		[
					//			'title'=>__('Products Count For Each Category'),
					//			'classess'=>''
					//		]
					//	]
					])
					
					  <div class="div col-md-12 text-right">
                    @include('components.form.submit',[
                    'name'=>'add_products',
                    'value'=>__('Add Products'),
					'action'=>route('revenue.stream.add.products',['company_id'=>$company_id]),
                    'attributes'=>'data-conditional-class=add-categories-radio data-show-if=1',
                    'classes'=>'conditional-show d-none'
                    ])

                </div>
				@endif
				
				  @if(isset($canAddProducts) && $canAddProducts)
                    @include('components.tables.revenue-type.products',[
                        'noRows'=>count($storedCategories)  ,
                        'categories'=>$storedCategories  ,
                        'attributes'=>'data-conditional-class=add-categories-radio data-show-if=1',
						'type'=>isset($type) ? $type : 0
                    ])
                    
                      <div class="div col-md-12 text-right">
                    @include('components.form.submit',[
                    'name'=>'save_products',
					'action'=>route('revenue.stream.store.products',['company_id'=>$company_id]),
                    'value'=>__('Save Products'),
                    'attributes'=>'data-conditional-class=add-categories-radio data-show-if=1',
                    'classes'=>'conditional-show d-none',
					'backRoute'=>route('revenueStream.index',['company_id'=>$company_id])
                    ])

                </div>
				
				@else
				<div class="div col-md-12 text-right">
                    @include('components.form.submit',[
                    'name'=>'add_products',
                    'value'=>__('Add Products'),
					'action'=>route('revenue.stream.add.new.products',['company_id'=>$company_id]),
                    'attributes'=>'data-conditional-class=add-categories-radio data-show-if=0',
                    'classes'=>'conditional-show d-none'
                    ])

                </div>
                @endif
				
				
				 @if(isset($canAddNewProducts) && $canAddNewProducts)
                    @include('components.tables.revenue-type.products',[
                        'noRows'=>$noRows  ,
                        'attributes'=>'data-conditional-class=add-categories-radio data-show-if=0',
						'type'=>isset($type) ? $type : 0
                    ])
                    
                      <div class="div col-md-12 text-right">
			 <a class="btn btn-primary text-white  d-inline-block" href="{{ $backRoute ??'' }}">{{ __('Cancel') }}</a>
					  
                    @include('components.form.submit',[
                    'name'=>'save_products',
					'action'=>route('revenue.stream.store.products',['company_id'=>$company_id]),
                    'value'=>__('Save Products'),
                    'attributes'=>'data-conditional-class=add-categories-radio data-show-if=0',
                    'classes'=>'conditional-show d-none',
					'backRoute'=>route('revenueStream.index',['company_id'=>$company_id])
                    ])

                </div>
				
			
                @endif
				
				
				
				
				
				
		



        </div>

    </div>
    
</form>

@endsection

@section('scripts')
<script type="text/javascript">
    function categoryFunction() {
        // alert('categoryStatus');
        var categoryStatus = document.getElementById("category").value;
        if (categoryStatus == 'new') {
            $("#NewCat").show();
        } else {
            $("#NewCat").hide();
        }
    }


    function TypeFunction() {
        var Revenue_Stream_Type = document.getElementById("Revenue_Stream_Type").value;
        if (Revenue_Stream_Type == '1' || Revenue_Stream_Type == '5') {
            $.ajax({
                type: 'GET'
                , data: {
                    'revenue_stream_type_id': Revenue_Stream_Type
                }
                , url: "{{ route('get.revenue_stream_view',['company_id' => $company->id]) }}"
                , cache: false
                , success: function(result) {
                    $('#RevenueItem').html('');
                    $("#RevenueItem").show();
                    $("#RevenueItem").html(result);
                }
            });
        } else {
            $("#RevenueItem").hide();
            $("#RevenueItem").html('');
        }
    }
    $(document).on('change', '#Revenue_Stream_Type', function() {
        var revenue_stream_type_id = $(this).val();
        getCategories(revenue_stream_type_id);

    });

    function getCategories(revenue_stream_type_id) {
        $.ajax({
            type: 'GET'
            , data: {
                'revenue_stream_type_id': revenue_stream_type_id
            }
            , url: "{{ route('get.revenue_stream_categories',['company_id' => $company->id]) }}', dataType: 'json', accepts: 'application/json"
        }).done(function(data) {
            $('#category option:not(:first)').remove();
            $.each(data, function(key, val) {
                select = '<option value="' + val.id + '">' + val.name + '</option>';
                $('#category').append(select);
            });
            $('#category').append('<option value="new" @if(@old("category")=="new") selected @endif>{{__("Creat new one")}}</option>');
        });
    }

</script>

<script>
    $('[data-conditional-class]').each(function(index, element) {
        let className = $(this).attr('data-conditional-class');
        let showIf = $(this).attr('data-show-if')
        console.log('first', 'end first ')
        $('.' + className).on('change', function() {
            let value = $(this).val();
            console.log(value);
            if (value == showIf) {
                $(element).removeClass('d-none')
            } else {
                $(element).addClass('d-none')
            }
        })
        $('.' + className + ':checked').trigger('change');
        $('.' + className + ':selected').trigger('change');

    })
	$(document).on('click','[data-action-url]',function(e){
		$('#current_form_action').val($(this).attr('data-action-url'));
	})
	
	
	function changeActionUrl(){
		$('form').attr('action',$('#current_form_action').val());
		return true
	}

</script>
@endsection
