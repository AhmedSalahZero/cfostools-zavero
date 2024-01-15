@extends('admin.client_view')
@section('Css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>

	<style>
		td.details-control {
			background: url('{{asset('tables_imgs/details_open.png')}}') no-repeat center center;
			cursor: pointer;
		}
		tr.shown td.details-control {
			background: url('{{asset('tables_imgs/details_close.png')}}') no-repeat center center;
		}
	</style>
@stop
@section('Title')
	{{__('Revenue Streams Table')}}

	<a href="{{route('revenueStream.create',['company_id'=>$company->id])}}" class="btn btn-brand m-1 btn-add btn-icon-sm pull-{{__('right')}}">
		<div class="pull-{{__('left')}}"><i class="fa fa-plus"></i></div>
		<div class="pull-{{__('right')}}">{{__('New Record')}}</div>
	</a>

	<a href="{{route("categories_products.index",[$company->id])}}" class="btn btn-brand m-1 btn-add btn-icon-sm pull-{{__('right')}}">
		<div class="pull-{{__('left')}}"><i class="fa fa-plus"></i></div>
		<div class="pull-{{__('right')}}">{{__('Edit Categories')}}</div>
	</a>

@endsection
@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

		<button id="btn-show-all-children" id="btn-hide-all-children"type="button" class="btn btn-brand btn-elevate standared_color"><i class="fa fa-plus"></i> {{__('Expand All')}}</button>
		<button id="btn-hide-all-children" id="btn-hide-all-children"type="button" class="btn btn-brand btn-elevate standared_color"><i class="fa fa-minus"></i> {{__('Collapse All')}}</button>

		{{--<button type="button" id="btn-hide-all-children" class="btn standared_color btn-elevate btn-circle btn-icon"><i class="fa fa-minus" title="Collapse All"></i></button>--}}
		{{--<button type="button" id="btn-show-all-children" class="btn standared_color btn-elevate btn-circle btn-icon"><i class="fa fa-plus" title="Expand All"></i></button>--}}
		<hr>
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__body">

				{{-- data-url="{{route('revenueStream.destroy',['company_id' => $company->id,'id' => $Category_product->id])}}" --}}
				<table id="example"  class="display accordion-table table table-bordered table-checkable table-ocordion " >
					<thead>
						<tr>
							<th class="text-center"></th>
							<th class="text-center"><b>{{__("Name")}}</b></th>
							<th class="text-center"><b>{{__("Revenue Stream Type")}}</b></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<!--begin::Modal Delete  -->
	<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog"
		 aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{ __('Delete Revenue Stream') }}</h4>
				</div>
				<div class="modal-body">
					<h3>{{ __('Delete this Revenue Stream') }}</h3>
				</div>
				<form action="#!" method="post" id="delete_form">
					{{ csrf_field() }}
					<div class="modal-footer">
						<button class="btn btn-danger">
							{{ __('Delete') }}
						</button>
						<button class="btn btn-secondary"
								data-dismiss="modal"
								aria-hidden="true">
							{{ __('Close') }}
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--end::Modal Delete  -->
@endsection

@section('scripts')
		<script>
		function format ( d ) {
			// `d` is the original data object for the row

			 var row = '<table class="report-table" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
				 row += '<tbody>';

				$.each(d.products,function (key,product) {
					class_name = "Controls" ;
					row +=  '<tr>'+
							'<td class="text-center">Name:</td>'+
							'<td class="Text-center">'+product.name+'</td>';
						if(product.revenue_stream_type_id == 1 || product.revenue_stream_type_id == 5 )	{
							row +=  '<td>{{__("Selling Main Unit")}}:</td>'+
									'<td class="text-center">'+product.productSelling.name+'</td>'+
									'<td>Stocking Main Unit:</td>'+
									'<td class="text-center">'+product.productStocking.name+'</td>';
							if(product.revenue_stream_type_id == 1) {
								row +=  '<td>Purchasing Main Unit:</td>' +
										'<td class="text-center">' +product.productPurchasing.name +'</td>';
							}else if (product.revenue_stream_type_id == 5){
								row += '<td>Manufacturing Batch Main Unit:</td>' +
									   '<td class="text-center">' + product.productmanufacturingBatch.name + '</td>';
							}
						}else {
							class_name = "Controls left-align"
						}

					row +=      '<td>'+
									'<div class="'+class_name+'">'+
										'<a href="{{url('/')}}/{{app()->getLocale()}}/admin/{{$company->id}}/revenueStream/'+product.id+'/edit" class="edit" title="{{__('Edit')}}"><i class="fa fa-pen-alt"></i></a>'+
										'<a href="#modal-delete" role="button" id="delete-btn" class="delete" title="{{__('Delete')}}" data-toggle="modal" data-url="{{url('/')}}/{{app()->getLocale()}}/admin/{{$company->id}}/revenueStream/'+product.id+'/delete" data-id="'+product.id+'"><i class="fa fa-trash-alt"></i> </a>'+
									'</div>'+
								'</td>'+
								'</tr>';
				});


			row +=  '</tbody>'+
					'</table>';
			return row ;
		}
	var dataSet = @json($Category_products);

	$(document).ready(function() {
		var table = $('#example').DataTable( {
			ordering:false ,

		data: dataSet,
        columns: [
				{
					"className":      'details-control',
					"orderable":      false,
					"data":           null,
					"defaultContent": ''
				},
				{ "data": "name" },
				{ "data": "revenue_stream_type.name" }, 

			]
		} );

		// Add event listener for opening and closing details
		$('#example tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );

			if ( row.child.isShown() ) {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
			}
			else {
				// Open this row
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		} );
		 // Handle click on "Expand All" button
		$('#btn-show-all-children').on('click', function(){
			// Enumerate all rows
			table.rows().every(function(){
				// If row has details collapsed
				if(!this.child.isShown()){
					// Open this row
					this.child(format(this.data())).show();
					$(this.node()).addClass('shown');
				}
			});
		});

		// Handle click on "Collapse All" button
		$('#btn-hide-all-children').on('click', function(){
			// Enumerate all rows
			table.rows().every(function(){
				// If row has details expanded
				if(this.child.isShown()){
					// Collapse row details
					this.child.hide();
					$(this.node()).removeClass('shown');
				}
			});
		});
	} );
	</script>
	<script>
        $(document).on('click','#delete-btn',function(){
            $('#delete_form').attr('action', $(this).data('url'));
        });
	</script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

@stop