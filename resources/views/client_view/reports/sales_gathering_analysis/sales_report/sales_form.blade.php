@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('sub-header')
    {{__('Sales Report')}}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action="{{  route('salesReport.result',$company)}}" enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet">

                <div class="kt-portlet__body">
                    <div class="form-group row">
                        {{-- <div class="col-md-4">
                            <label>{{__('Select Zones ( Multi Selection )')}} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="zones[]" class="form-control kt-bootstrap-select kt_bootstrap_select"  multiple>
                                        <option value="{{json_encode($zones)}}">{{__('All Zones')}}</option>
                                        @foreach ($zones as $zone)
                                            <option value="{{$zone}}"> {{__($zone)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-2">
                            <label>{{__('Start Date')}}</label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="date" name="start_date" required  value="2020-01-01"  class="form-control"  placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{__('End Date')}}</label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="date" name="end_date" required value="{{date('Y-m-d')}}" max="{{date('Y-m-d')}}"  class="form-control"  placeholder="Select date" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{ __('Report Type') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="report_type" required class="form-control">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        {{-- <option value="daily">{{ __('Daily') }}</option> --}}
                                        <option value="trend">{{ __('Trend') }}</option>
                                        <option value="comparing">{{ __('Interval Comparing - Recommended Choose More Than 1 Year') }}  </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{__('Data Type')}} </label>
                            <div class="kt-input-icon">
                                <div class="input-group ">
                                    <input type="text" class="form-control" disabled value="{{__('Value')}}"  >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-submitting/>
            </div>





        </form>

        <!--end::Form-->

        <!--end::Portlet-->
    </div>
</div>
@endsection
@section('js')
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>
    {{-- <script src="{{url('assets/js/demo1/pages/crud/forms/validation/form-widgets.js')}}" type="text/javascript"></script> --}}

    <!--end::Page Scripts -->
@endsection
