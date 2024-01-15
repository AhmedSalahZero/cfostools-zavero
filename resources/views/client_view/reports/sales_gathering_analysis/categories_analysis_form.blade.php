@extends('layouts.dashboard')
@section('css')
<link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('sub-header')
{{ __($view_name) }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action=@if($name_of_selector_label=='Sales Discount' ) {{ route('categories.salesDiscount.analysis.result', $company)}} @elseif ($type=='averagePrices' ) {{ route('averagePrices.result', $company) }} @else {{route('categories.analysis.result', $company) }} @endif enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet" style="overflow:hidden">
                @if ($type == 'averagePrices')
                <input type="hidden" name="type_of_report" value="categories_products_avg">
                <?php
                            $type = 'product_or_service'  ;
                        ?>
                @endif


                <?php 
                    // $categoriesData = App\Models\SalesGathering::company()
                    //     ->whereNotNull('category')
                    //     ->where('category','!=','')
                    //     ->groupBy('category')
                    //     ->selectRaw('category')
                    //     ->get()
                    //     ->pluck('category')
                    //     ->toArray();
                    if(isCustomerExceptionalCase($type , $name_of_selector_label) 
                    || isCustomerExceptionalForProducts($type , $name_of_selector_label)
                    || isCustomerExceptionalForProductsItems($type , $name_of_selector_label))
                    // in this case we will get customers instead of categories
                    $categoriesData = getTypeFor('customer_name',$company->id , false);
                    // else if()
                    // {
                        // $categoriesData = getTypeFor('',$company->id , false);
                    // }
                    else
                    {
                    $categoriesData = getTypeFor('category',$company->id , false);

                    }

                        if ($name_of_selector_label == 'Products Items') {
                            $column =  3 ;
                            $data_type_selector = '';
                        }elseif ($name_of_selector_label == 'Products / Services') {
                            $column =  4 ;
                            $data_type_selector = '';
                        }else {
                            $column =  6 ;
                            $data_type_selector = 'disabled';
                        }
                        if($name_of_selector_label == 'Products Items' && $type == 'product_item' && $view_name =='Categories Against Products Items Trend Analysis' )
                        {
                            $column =  4 ;
                        }

                        if($name_of_selector_label == 'Products / Services')
                        {
                            $column = 6 ; 
                        }


                    ?>

                <input type="hidden" name="type" value="{{$type}}">
                <input type="hidden" name="view_name" value="{{$view_name}}">
                <div class="kt-portlet__body">
                    @if(! (in_array('CategoriesProductsAveragePricesView',Request()->segments())))
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>{{ __('Data Type') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="data_type" id="data_type" {{$data_type_selector}} class="form-control">

                                        <option selected value="value">{{ __('Value') }}</option>
                                        <option value="quantity">{{ __('Quantity') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @include('comparing_type_selector')

                    </div>
                    @else
                    <input type="hidden" name="data_type" id="data_type" {{$data_type_selector}} value="value">
                    @endif
                    <div class="form-group row">
                        <div class="col-md-{{$column}}">

                            @if(isCustomerExceptionalCase($type , $name_of_selector_label)
                            ||
                            isCustomerExceptionalForProducts($type , $name_of_selector_label )
                            ||
                            isCustomerExceptionalForProductsItems($type , $name_of_selector_label )

                            )
                            <label>{{ __('Select Customers') }} @include('max-option-span') </label>
                            @else

                            <label>{{ __('Select Categories') }} @include('max-option-span') </label>
                            @endif



                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="categoriesData[]" required data-live-search="true" data-actions-box="true" class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" id="categoriesData" multiple>
                                        {{-- <option value="{{ json_encode($categoriesData) }}">{{ __('All Categories') }}</option> --}}
                                        @foreach ($categoriesData as $category)
                                        <option value="{{ $category }}"> {{ __($category) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- @if ($name_of_selector_label == 'Products / Services' || $name_of_selector_label == 'Products Items')

                                <div class="col-md-{{$column}}">
                        <label>{{ __('Select Categories ( Multi Selection )') }} </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="categories">
                                <select name="categories[]" class="form-control kt-bootstrap-select kt_bootstrap_select" multiple>

                                </select>
                            </div>
                        </div>
                    </div>

                    @endif --}}
                    @if ( $name_of_selector_label == 'Products Items')

                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select Products ') }} <span class="multi_selection"></span> @include('max-option-span') </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="products">
                                <select data-live-search="true" data-actions-box="true" name="products[]" required class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" multiple>

                                </select>
                            </div>
                        </div>
                    </div>

                    @endif


                    @if ( $name_of_selector_label == 'Sales Discount')

                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select '.$name_of_selector_label) }} </label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <select data-live-search="true" data-actions-box="true" name="sales_discounts_fields[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" id="sales_discounts_fields" multiple>
                                    <option value="quantity_discount">{{ __('Quantity Discount') }}</option>
                                    <option value="cash_discount">{{ __('Cash Discount') }}</option>
                                    <option value="special_discount">{{ __('Special Discount') }}</option>
                                    <option value="other_discounts">{{ __('Other Discounts') }}</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    @else

                    @if($name_of_selector_label == 'Customers Against Categories' )
                    @php
                    $name_of_selector_label = "Categories";
                    @endphp
                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select '.$name_of_selector_label.' ') }} <span class="multi_selection"></span> @include('max-option-span') </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="sales_channels">
                                <select data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" multiple>
                                </select>
                            </div>
                        </div>
                    </div>

                    @elseif($name_of_selector_label == 'Customers Against Products')

                    @php
                    $name_of_selector_label = "Products";
                    @endphp
                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select '.$name_of_selector_label.' ') }} <span class="multi_selection"></span> @include('max-option-span') </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="sales_channels">
                                <select data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" multiple>
                                </select>
                            </div>
                        </div>
                    </div>


                    @elseif($name_of_selector_label == 'Customers Against Products Items')

                    @php
                    $name_of_selector_label = "Product Items";
                    @endphp
                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select '.$name_of_selector_label.' ') }} <span class="multi_selection"></span> @include('max-option-span') </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="sales_channels">
                                <select data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" multiple>
                                </select>
                            </div>
                        </div>
                    </div>


                    @else

                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select '.$name_of_selector_label.' ') }} <span class="multi_selection"></span> @include('max-option-span') </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="sales_channels">
                                <select data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" multiple>

                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>{{ __('Start Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" name="start_date" required class="form-control" placeholder="Select date" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('End Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" name="end_date" required value="{{date('Y-m-d')}}" max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('Select Interval') }} </label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <select name="interval" required class="form-control">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    {{-- <option value="daily">{{ __('Daily') }}</option> --}}
                                    <option value="monthly">{{ __('Monthly') }}</option>
                                    <option value="quarterly">{{ __('Quarterly') }}</option>
                                    <option value="semi-annually">{{ __('Semi-Annually') }}</option>
                                    <option value="annually">{{ __('Annually') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <x-submitting />
    </div>





    </form>

    <!--end::Form-->

    <!--end::Portlet-->
</div>
</div>
@endsection
@section('js')
<!--begin::Page Scripts(used by this page) -->
<script src="{{ url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript">
</script>
<script src="{{ url('assets/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/form-repeater.js') }}" type="text/javascript"></script>
{{-- <script src="{{ url('assets/js/demo1/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript">
</script> --}}

<!--end::Page Scripts -->
<script>
    $('#data_type').change(function(e) {


        // if($('#data_type').val()  == 'value'){
        var data_type = 'multiple';
        // $('.multi_selection').html("{{__('( Multi Selection )')}}");

        // }
        // else{
        //     var data_type = '';
        //     $('.multi_selection').html("");
        // }
        $('#categoriesData option:selected').prop('selected', false);

        $('.filter-option-inner-inner').html('Nothing selected');
        $('#sales_channels').html('');
        row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control kt-bootstrap-select kt_bootstrap_select" required ' + data_type + ' ></select>';
        $('#sales_channels').append(row)
        $('#categories').html('');
        row = '<select data-live-search="true" data-actions-box="true" name="categories[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" ' + data_type + '  required ></select>';
        $('#categories').append(row);
        $('#products').html('');
        row = '<select data-live-search="true" data-actions-box="true" name="products[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required  ></select>';
        $('#products').append(row);
        reinitializeSelect2();

    });
    $(document).on('change', '#categoriesData', function() {


        clearTimeout(wto);
        wto = setTimeout(() => {

            //    alert("{{ $name_of_selector_label }}")
            if (tryParseJSONObject($(this).val()[0])) {
                categoriesData = JSON.parse($(this).val()[0]);
            } else {
                categoriesData = $(this).val();
            }
            type_of_data = "{{$type}}";
            if ("{{$name_of_selector_label}}" == 'Products / Services' || "{{$name_of_selector_label}}" == 'Products Items') {
                getProducts(categoriesData, 'product_or_service', type_of_data);
            } else {


                if ("{{ isCustomerExceptionalCase($type , $name_of_selector_label) }}") {
                    // alert('if')
                    getCategories(categoriesData, 'category');
                } else if ("{{ isCustomerExceptionalForProducts($type , $name_of_selector_label) }}") {
                    // alert('else if')
                    getProductsForCustomers(categoriesData, 'product_or_service', 'product_or_service');
                } else if ("{{ isCustomerExceptionalForProductsItems($type , $name_of_selector_label) }}") {
                    // alert('else if')
                    getProductItemsForCustomers(categoriesData, 'product_item');
                } else {
                    // alert('else')
                    getSalesChannales(categoriesData, type_of_data);

                }
                // wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
            }

        }, getNumberOfMillSeconds());


    });
    $(document).on('change', '[name="categories[]"]', function() {

        clearTimeout(wto);
        wto = setTimeout(() => {


            if (tryParseJSONObject($('#categoriesData').val()[0])) {
                categoriesData = JSON.parse($('#categoriesData').val()[0]);
            } else {
                categoriesData = $('#categoriesData').val();
            }
            type_of_data = "{{$type}}";

            categories = $(this).val();

            getProducts(categoriesData, categories, 'product_or_service', type_of_data)

        }, getNumberOfMillSeconds());


    });
    $(document).on('change', '[name="products[]"]', function() {

        clearTimeout(wto);
        wto = setTimeout(() => {


            if (tryParseJSONObject($('#categoriesData').val()[0])) {
                categoriesData = JSON.parse($('#categoriesData').val()[0]);
            } else {
                categoriesData = $('#categoriesData').val();
            }
            categories = $('[name="categories[]"]').val();
            products = $(this).val();

            type_of_data = "{{$type}}";
            getProductItems(categoriesData, products, type_of_data)


        }, getNumberOfMillSeconds());

    });

    function tryParseJSONObject(jsonString) {
        try {
            var o = JSON.parse(jsonString);

        } catch (e) {
            return false;
        }

        return true;
    };

    // Sales Channales
    function getSalesChannales(categoriesData, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': categoriesData
                , 'main_field': 'category'
                , 'field': type_of_data
            }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {

            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" required multiple>\n';
            $.each(data, function(key, val) {
                row += '<option value*="' + val + '">' + val + '</option>\n';

            });
            row += '</select>';
            console.log(row);
            $('#sales_channels').html('');
            $('#sales_channels').append(row);
            reinitializeSelect2();
        });
    }

    // Categories
    function getCategories(categoriesData, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': categoriesData
                , 'main_field': 'customer_name'
                , 'field': type_of_data
            }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            // if($('#data_type').val()  == 'value'){
            var data_type = 'multiple';
            // }
            // else{
            //     var data_type = '';
            // }
            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" ' + data_type + '  required >\n';
            // if($('#data_type').val()  !== 'value'){
            //     row += '<option value="">Select</option>\n' ;
            // }

            $.each(data, function(key, val) {
                row += '<option value*="' + val + '">' + val + '</option>\n';

            });
            row += '</select>';
            // console.log(row);
            $('#sales_channels').html('');
            $('#sales_channels').append(row);
            reinitializeSelect2();
        });
    }
    // Sub Categories
    function getProducts(categories, type_of_data, type) {

        $.ajax({
            type: 'POST'
            , data: {
                'main_data': categories
                , 'main_field': 'category'
                , 'field': type_of_data
            }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            // if($('#data_type').val()  == 'value'){
            var data_type = 'multiple';
            // }
            // else{
            //     var data_type = '';
            // }

            if (type == 'product_or_service') {

                row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required >\n';
                // if($('#data_type').val()  !== 'value'){
                //     row += '<option value="">Select</option>\n' ;
                // }

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                console.log(row);
                $('#sales_channels').html('');
                $('#sales_channels').append(row);
                reinitializeSelect2();
            } else {
                row = '<select data-live-search="true" data-actions-box="true" name="products[]" class="form-control kt-bootstrap-select select2-select kt_bootstrap_select"  ' + data_type + '  required  >\n';
                // if($('#data_type').val()  !== 'value'){
                //     row += '<option value="">Select</option>\n' ;
                // }

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                // console.log(row);
                $('#products').html('');
                $('#products').append(row);
                reinitializeSelect2();
            }
        });
    }



    function getProductsForCustomers(categories, type_of_data, type) {
        // alert('q');
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': categories
                , 'main_field': 'customer_name'
                , 'field': type_of_data
            }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            // if($('#data_type').val()  == 'value'){
            var data_type = 'multiple';
            // }
            // else{
            //     var data_type = '';
            // }
            // alert(type);
            if (type == 'product_or_service') {

                row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required >\n';
                // if($('#data_type').val()  !== 'value'){
                //     row += '<option value="">Select</option>\n' ;
                // }

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                // console.log(row);
                $('#sales_channels').html('');
                $('#sales_channels').append(row);
                reinitializeSelect2();
            } else {
                row = '<select data-live-search="true" data-actions-box="true" name="products[]" class="form-control kt-bootstrap-select select2-select kt_bootstrap_select"  ' + data_type + '  required  >\n';
                // if($('#data_type').val()  !== 'value'){
                //     row += '<option value="">Select</option>\n' ;
                // }

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                // console.log(row);
                $('#products').html('');
                $('#products').append(row);
                reinitializeSelect2();
            }
        });
    }

    // Product Or Services
    function getProductItems(categoriesData, products, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': categoriesData
                , 'main_field': 'category'
                , 'third_main_data': products
                , 'third_main_field': 'product_or_service'
                , 'field': type_of_data
            , }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select select2 kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required multiple >\n';
            // if($('#data_type').val()  !== 'value'){
            //     row += '<option value="">Select</option>\n' ;
            // }

            $.each(data, function(key, val) {
                row += '<option value*="' + val + '">' + val + '</option>\n';

            });
            row += '</select>';
            $('#sales_channels').html('');
            $('#sales_channels').append(row);
            reinitializeSelect2();
        });
    }


    function getProductItemsForCustomers(categoriesData, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': categoriesData
                , 'main_field': 'customer_name'
                , 'field': type_of_data
            , }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select select2 kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required multiple >\n';
            // if($('#data_type').val()  !== 'value'){
            //     row += '<option value="">Select</option>\n' ;
            // }

            $.each(data, function(key, val) {
                row += '<option value*="' + val + '">' + val + '</option>\n';

            });
            row += '</select>';
            $('#sales_channels').html('');
            $('#sales_channels').append(row);
            reinitializeSelect2();
        });
    }

</script>
<script>
    $(function() {
        $('#categoriesId').trigger('change');
    })

</script>
@endsection
