@extends('admin.client_view')

@section('content')
	<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
		<!-- <div class="alert alert-light alert-elevate" role="alert">
			<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
			<div class="alert-text">
				Each column has an optional rendering control called columns.render which can be used to process the content of each cell before the data is used.
				See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/advanced_init/column_render.html" target="_blank">here</a>.
			</div>
		</div> -->
		<div class="kt-portlet kt-portlet--mobile">
			<div class="kt-portlet__head kt-portlet__head--lg">
				<div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="kt-font-brand flaticon2-line-chart"></i>
					</span>
					<h3 class="kt-portlet__head-title">
						{{__("Agency Commission Distribution Table")}}
					</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<div class="kt-portlet__head-wrapper">
						<div class="kt-portlet__head-actions">
							<div class="dropdown dropdown-inline">
								<!-- <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="la la-download"></i> Export
								</button> -->
								<div class="dropdown-menu dropdown-menu-right">
									<ul class="kt-nav">
										<li class="kt-nav__section kt-nav__section--first">
											<span class="kt-nav__section-text">{{__("Choose an option")}}</span>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-print"></i>
												<span class="kt-nav__link-text">{{__("Print")}}</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-copy"></i>
												<span class="kt-nav__link-text">{{__("Copy")}}</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-excel-o"></i>
												<span class="kt-nav__link-text">{{__("Excel")}}</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-text-o"></i>
												<span class="kt-nav__link-text">{{__("CSV")}}</span>
											</a>
										</li>
										<li class="kt-nav__item">
											<a href="#" class="kt-nav__link">
												<i class="kt-nav__link-icon la la-file-pdf-o"></i>
												<span class="kt-nav__link-text">{{__("PDF")}}</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
							&nbsp;
							
						</div>
					</div>
				</div>
			</div>

			<div class="kt-portlet__body">

				<!--begin: Datatable -->
				<table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
					<thead>
						<tr>
							<th>{{__("Land By Sales Name")}}</th>
							<th>{{__("Sales Plan")}}</th>
							<th>{{__("Total Sales Plan Amount")}}</th>
							<th>{{__("Percentage")}}</th>
							<th>{{__("Agency Commission amount")}}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($agencies_commission as $commission)
							<tr>
								<td>{{$commission->landBySale->name}}</td>
								<td>{{$commission->distribution->salesPlan->name}}</td>
								<td>{{number_format($commission->amount,0)}}</td>
								<td>{{$commission->percentage * 100 }}  %</td>
								<?php $commition_amount = $commission->percentage * $commission->amount;  ?>
								<td>{{number_format($commition_amount,0)}}</td>
							</tr>

						@endforeach
					</tbody>
				</table>

				<!--end: Datatable -->
			</div>
		</div>
	</div>

	<!--begin::Modal Delete  -->
<!-- 	<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog"
		 aria-labelledby="myModalLabel1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{ __('Delete Agency') }}</h4>
				</div>
				<div class="modal-body">
					<h3>{{ __('Delete this Agency') }}</h3>
				</div>
				<form action="#!" method="post" id="delete_form">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
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
	</div> -->
	<!--end::Modal Delete  -->

@endsection

<!-- @section('scripts')
	<script>
        $(document).on('click','#delete-btn',function(){
            $('#delete_form').attr('action', $(this).data('url'));
        });
	</script>
@stop -->