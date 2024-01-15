@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('sub-header')
{{__('Outstanding Customers Invoices')}}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" method="POST" action={{ route('end.balance.analysis.result',$company) }}   enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet">

                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            {{-- <div class="col-md-3">
                                <label>{{__('From')}}</label>
                                <div class="kt-input-icon">
                                    <div class="input-group date">
                                        <input type="date" name="from"   class="form-control"  placeholder="Select date" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-3">
                                <label>{{__('Duration')}} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group date">
                                        <select name="duration"  required class="form-control">
                                            <option value="3">3     {{__('Months')}}</option>
                                            <option value="6">6     {{__('Months')}}</option>
                                            <option value="9">9     {{__('Months')}}</option>
                                            <option value="12">12   {{__('Months')}}</option>
                                            <option value="15">15  {{__('Months')}}</option>
                                            <option value="18">18   {{__('Months')}}</option>
                                            <option value="21">21   {{__('Months')}}</option>
                                            <option value="24">24   {{__('Months')}}</option>
                                            <option value="36">36   {{__('Months')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{__('Select Interval')}} </label>
                                <div class="kt-input-icon">
                                    <div class="input-group date">
                                        <select name="interval"  required  class="form-control">
                                            <option value="" selected>{{__('Select')}}</option>
                                            {{-- <option value="daily">{{__('Daily')}}</option>
                                            <option value="monthly">{{__('Monthly')}}</option> --}}
                                            <option value="quarterly">{{__('Quarterly')}}</option>
                                            <option value="semi-annually">{{__('Semi-Annually')}}</option>
                                            <option value="annually">{{__('Annually')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>{{__('Report Type')}} </label>
                                <div class="kt-input-icon">
                                    <input type="text" disabled value="{{__('Quantity')}}" class="form-control" placeholder="{{__('Type')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet">

                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <input type="hidden" name="company_id" value="{{$company->id}}">

                            @if (false !== $found = array_search('Category',$selected_fields))
                                <?php $inventories_categories =  App\Models\InventoryStatement::whereNotNull('category')->groupBy('category')->get() ;

                                ?>
                                <div class="col-md-3">
                                    <label>{{__('Category')}} </label>
                                    <div class="kt-input-icon">
                                        <div class="input-group date">
                                            <select name="category" class="form-control">
                                                <option value="" selected>{{__('Select')}}</option>
                                                @foreach ($inventories_categories as $inventory_category)

                                                    <option value="{{$inventory_category->category}}">{{__($inventory_category->category)}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (false !== $found = array_search('Sub Category',$selected_fields))

                                <?php $inventories_sub_categories =  App\Models\InventoryStatement::whereNotNull('sub_category')->groupBy('sub_category')->get() ;
                                ?>
                                <div class="col-md-3">
                                    <label>{{__('Sub Category')}} </label>
                                    <div class="kt-input-icon">
                                        <div class="input-group date">
                                            <select name="sub_category"  required class="form-control">
                                                <option value="" selected>{{__('Select')}}</option>
                                                @foreach ($inventories_sub_categories as $inventory_sub_category)

                                                    <option value="{{$inventory_sub_category->sub_category}}">{{__($inventory_sub_category->sub_category)}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (false !== $found = array_search('Product',$selected_fields))
                                <?php $inventories_products =  App\Models\InventoryStatement::whereNotNull('product')->groupBy('product')->get() ;
                                ?>
                                <div class="col-md-3">
                                    <label>{{__('Product')}} </label>
                                    <div class="kt-input-icon">
                                        <div class="input-group date">
                                            <select name="product"  required class="form-control">
                                                <option value="" selected>{{__('Select')}}</option>
                                                @foreach ($inventories_products as $inventory_product)

                                                    <option value="{{$inventory_product->product}}">{{__($inventory_product->product)}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (false !== $found = array_search('Product Item',$selected_fields))
                                <?php $inventories_product_Items =  App\Models\InventoryStatement::whereNotNull('product_item')->groupBy('product_item')->get() ;
                                ?>
                                <div class="col-md-3">
                                    <label>{{__('Product Item')}} </label>
                                    <div class="kt-input-icon">
                                        <div class="input-group date">
                                            <select name="product_item"  required class="form-control">
                                                <option value="" selected>{{__('Select')}}</option>
                                                @foreach ($inventories_product_Items as $inventory_product_item)

                                                    <option value="{{$inventory_product_item->product_item}}">{{__($inventory_product_item->product_item)}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
    <script src="{{url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/jquery.repeater/src/lib.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/jquery.repeater/src/jquery.input.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/vendors/general/jquery.repeater/src/repeater.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/form-repeater.js')}}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endsection
