@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    
@endsection
@section('sub-header')
    {{__('Sales Channel Sales Analysis')}}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action={{ route('salesChannels.sales.analysis.result',$company) }}   enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet">
                <?php $sales_channels =  App\Models\SalesGathering::company()->whereNotNull('sales_channel')->where('sales_channel','!=','')->groupBy('sales_channel')->selectRaw('sales_channel')->get()->pluck('sales_channel')->toArray();

                ?>

                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>{{__('Select Sales Channels ' )}}
                            
                            @include('max-option-span')
                            
                             </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select data-max-options="{{ maxOptionsForOneSelector() }}" data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  multiple>
                                        {{-- <option value="{{json_encode($sales_channels)}}">{{__('All Sales Channels')}}</option> --}}
                                        @foreach ($sales_channels as $sales_channel)
                                            <option value="{{$sales_channel}}"> {{__($sales_channel)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{__('Start Date')}}</label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="date" name="start_date"  required class="form-control"  placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{__('End Date')}}</label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="date" name="end_date" required value="{{date('Y-m-d')}}"  max="{{date('Y-m-d')}}"  class="form-control"  placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{__('Select Interval')}} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="interval" required class="form-control">
                                        <option value="" selected>{{__('Select')}}</option>
                                        {{-- <option value="daily">{{__('Daily')}}</option> --}}
                                        <option value="monthly">{{__('Monthly')}}</option>
                                        <option value="quarterly">{{__('Quarterly')}}</option>
                                        <option value="semi-annually">{{__('Semi-Annually')}}</option>
                                        <option value="annually">{{__('Annually')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{__('Data Type')}} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="interval" disabled class="form-control">

                                        <option selected value="value">{{__('Value')}}</option>
                                        <option value="quantity">{{__('Quantity')}}</option>
                                    </select>
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
