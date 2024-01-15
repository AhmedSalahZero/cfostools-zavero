@extends('admin.client_view')
@section('Title')
<style>
#RevenueItem{
	display:flex !important;
	flex-wrap:wrap !important;
	padding-left:0 !important;
	
}
</style>
<span class="kt-portlet__head-icon">
    <i class="kt-font-brand flaticon2-line-chart fa-fw flaticon-house-sketch pull-{{__('left')}}"></i>
    {{__('Edit Revenue Stream')}}
</span>
<a href="{{route('revenueStream.index',['company_id' => $company->id])}}" class="btn btn-brand btn-add btn-icon-sm pull-{{__('right')}}">
    <span class="pull-{{__('left')}}"><i class="fa fa-list"></i></span>
    {{__('Products Table')}}
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
<form method="post" action="{{route('revenueStream.update',[$Product->id,$company->id])}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            

            <div class="form-group row">
			
                <div class="col-md-4 mb-3 ">
					 @include('components.form.label',[
						'isRequired'=>true ,
						'title'=>__('Name')
					 ])
					 
                    <input type="text" name="name" class="form-control" placeholder="{{__('Enter')}} {{__('Name')}} .." value="{{$Product->name}}">
                </div>
                <div class="col-md-4 mb-3">
				@include('components.form.label',[
						'isRequired'=>true ,
						'title'=>__('Revenue Stream Type')
					 ])
                    <select id="Revenue_Stream_Type" name="type" class="form-control" 
					onchange="TypeFunction()"
					>
                        <option value="">{{__('Select')}} ..</option>
                        @foreach($revenues as $revenue)
                        <option value="{{$revenue->id}}" {{$Product->revenue_stream_type_id == $revenue->id ?'selected' : ''}}>{{$revenue->name}}</option>
                        @endforeach
                    </select>
                </div>

        
                <div class="col-md-4 mb-3">
				@include('components.form.label',[
						'isRequired'=>true ,
						'title'=>__('Sub of')
					 ])
                    <select id="category" name="category" class="form-control" onchange="categoryFunction()">
                        <option value="">{{__('Select Category')}}</option>
                        @foreach($Category_product as $category)
                        <option value="{{ $category->id }}" @if($Product->Category_product($company->id)->id==$category->id) selected @endif
                            >{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


               
        


        <?php 
					$measurement_number=0;
					$alpha = [
						'1' => 'A',
						'2' => 'B', 
					];
					$measurement_items['Selling']="";
					$measurement_items['Stocking']=__("Conversion rate Stocking Aganist Selling");
					if($Product->revenue_stream_type_id == 1){
						$measurement_items['Purchasing']=__("Conversion rate Purchasing Aganist Stocking");
					}elseif ($Product->revenue_stream_type_id == 5) {
		            	$measurement_items['Manufacturing Batch']=__("Conversion rate Batch Aganist Stocking");	
		            }
				?>
        <?php $b=0; ?>
		
		<div id="RevenueItem" class="col-md-12">
		
		@foreach($measurement_items as $Key=>$Val)

                @for($a=0; $a<=$measurement_number; $a++ ) <?php $b++; ?> 
              
                        <div class="col-md-4 mb-3">
							@include('components.form.label',[
								'isRequired'=>true ,
								'title'=> __($Key) . ' ' . __('Unit '.@$alpha[$a]) 
							])
                            <input type="text" name="product_volume_measurement[{{$Key}}][{{$a}}][name]" class="form-control" placeholder="Enter  {{$Key}} Unit Name .." value="{{@$Product_measurement[$b]->name}}" @if($a==0) @endif>
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
        </div>
        </div>
         


    <div class="kt-portlet__foot">
        <div class="kt-form__actions">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-10">
                    {{-- <input type="submit" name="submit" value="{{__('Submit')}}" data-submit="add" class="btn btn-success submit " /> --}}
                    <input type="submit" name="submit" value="{{__('Submit And Close')}}" class="btn btn-success submit submit-sales" />
                </div>
            </div>
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
                , url: '{{ route('get.revenue_stream_view',['
                company_id ' => $company->id]) }}'
                , cache: false
                , success: function(result) {
                    $('#RevenueItem').html('');
                    $("#RevenueItem").show();
                    $("#RevenueItem").html(result);
					$("[name^='product_volume_measurement[Manufacturing Batch][0][name]']").val("{{ __('Batch') }}").prop('readonly',true)
                }
            });
        } else {
            $("#RevenueItem").hide();
            $("#RevenueItem").html('');

            @if($Product -> revenue_stream_type_id = '1')
            alert('Take care, you will lose all iformation recorded below when you save?')
            @endif
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
            , url: '{{ route('get.revenue_stream_categories',['
            company_id ' => $company->id]) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            $('#category option:not(:first)').remove();
            $.each(data, function(key, val) {
                select = '<option value="' + val.id + '">' + val.name + '</option>';
                $('#category').append(select);
            });
        });
    }

</script>

<script>
$(function(){
					$("[name^='product_volume_measurement[Manufacturing Batch][0][name]']").val("{{ __('Batch') }}").prop('readonly',true)

})
</script>
@endsection
