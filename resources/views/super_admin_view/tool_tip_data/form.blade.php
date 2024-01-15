@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{__('Create Tools Tips Per Model')}}
                    </h3>
                </div>
            </div>
        </div>
            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" method="POST" action= {{route('toolTipData.store')}} enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="form-group row section">

                                <div class="col-lg-6">
                                    <label>{{__('Model Name')}} <span class="required">*</span></label>
                                    <div class="kt-input-icon">
                                        <input type="text" name="model_name"   class="form-control" placeholder="{{__('Model Name')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>{{__('Section Name')}} <span class="required">*</span></label>
                                    <div class="kt-input-icon">
                                        <input type="text" name="section_name"   class="form-control" placeholder="{{__('Section Name')}}" required>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>

                <x-submitting/>
            </form>

            <!--end::Form-->

        <!--end::Portlet-->
    </div>
</div>
@endsection
@section('js')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <!--end::Page Scripts -->
@endsection
