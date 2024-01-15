@extends('layouts.dashboard')
@section('css')
<link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<style>
    div.dropdown-menu.show{
        max-width:400px !important;
    }
</style>
@endsection
@section('sub-header')
{{ __($view_name) }}

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action={{  $name_of_selector_label == 'Sales Discount' ? route('salesPersons.salesDiscount.analysis.result', $company) : route('salesPersons.analysis.result', $company) }} enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet">
                <?php 
                    
                    // $salesPersonsData = App\Models\SalesGathering::company()
                    //     ->whereNotNull('sales_person')
                    //     ->where('sales_person','!=','')
                    //     ->groupBy('sales_person')
                    //     ->selectRaw('sales_person')
                    //     ->get()
                    //     ->pluck('sales_person')
                    //     ->toArray();


                         $salesPersonsData = getTypeFor('sales_person',$company->id,false);
                         

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
                    ?>
                <input type="hidden" name="type" value="{{$type}}">
                <input type="hidden" name="view_name" value="{{$view_name}}">
                <div class="kt-portlet__body">
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
                    <div class="form-group row">
                        <div class="col-md-{{$column}}">
                            <label>{{ __('Select Sales Persons') }} @include('max-option-span') </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select data-live-search="true" data-actions-box="true" name="salesPersonsData[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" id="salesPersonsData" multiple>
                                        {{-- <option value="{{ json_encode($salesPersonsData) }}">{{ __('All Sales Persons') }}</option> --}}
                                        @foreach ($salesPersonsData as $category)
                                        <option value="{{ $category }}"> {{ __($category) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if ($name_of_selector_label == 'Products / Services' || $name_of_selector_label == 'Sales Persons' || $name_of_selector_label =='Products Items')

                                <div class="col-md-{{$column}}">
                        <label>{{ __('Select Categories') }}
                         
                         @include('max-option-span')

                         </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="categories">
                                <select data-live-search="true" data-actions-box="true" name="sales_discounts_fields[]" name="categories[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" multiple>

                                </select>
                            </div>
                        </div>
                    </div>

                    @endif
                    @if($name_of_selector_label == 'Products Items' )

                     <div class="col-md-{{$column}}">
                        <label>{{ __('Select Products') }}
                         
                         @include('max-option-span')

                         </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="products__">
                                <select data-live-search="true" data-actions-box="true" name="products[]"  class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" multiple>

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
                    <div class="col-md-{{$column}}">
                        <label>{{ __('Select '.$name_of_selector_label.' ') }} <span class="multi_selection">@include('max-option-span') </span> </label>
                        <div class="kt-input-icon">
                            <div class="input-group date" id="sales_channels">
                                <select data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" multiple>

                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label>{{ __('Start Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" required name="start_date" class="form-control" placeholder="Select date" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('End Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" required name="end_date" value="{{date('Y-m-d')}}" max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
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
            @if('salesPersons.Items.analysis' == Request()->route()->getName())
            <input type="hidden" id="has_product_item">
            @endif 
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

        // }else{
        // var data_type = '';
        // $('.multi_selection').html("");
        // }
        $('#salesPersonsData option:selected').prop('selected', false);

        $('.filter-option-inner-inner').html('Nothing selected');
        $('#sales_channels').html('');
        row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" required ' + data_type + ' ></select>';
        $('#sales_channels').append(row)
        $('#categories').html('');
        row = '<select data-live-search="true" data-actions-box="true" name="categories[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" ' + data_type + '  required ></select>';
        $('#categories').append(row);
        $('#products').html('');
        row = '<select data-live-search="true" data-actions-box="true" name="products[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required  ></select>';
        $('#products').append(row);
        reinitializeSelect2();
    });
    $(document).on('change', '#salesPersonsData', function() {

        clearTimeout(wto);
        wto = setTimeout(() => {

            if (tryParseJSONObject($(this).val()[0])) {
                salesPersonsData = JSON.parse($(this).val()[0]);
            } else {
                salesPersonsData = $(this).val();
            }
            type_of_data = "{{$type}}";
            if(type_of_data == 'product_item' || type_of_data == 'product_or_service' )
            {
                type_of_data = 'category';
            }
            getCategories(salesPersonsData, type_of_data);

        }, getNumberOfMillSeconds());


    });
    $(document).on('change', '[name="categories[]"]', function() {

        clearTimeout(wto);
        wto = setTimeout(() => {

            if (tryParseJSONObject($('#salesPersonsData').val()[0])) {
                salesPersonsData = JSON.parse($('#salesPersonsData').val()[0]);
            } else {
                salesPersonsData = $('#salesPersonsData').val();
            }
            type_of_data = "{{$type}}";

            categories = $(this).val();
            getProducts(salesPersonsData, categories , 'product_or_service' , type_of_data)
        }, getNumberOfMillSeconds());



    });
    $(document).on('change', '[name="products[]"]', function() {
        clearTimeout(wto);
        wto = setTimeout(() => {

            if (tryParseJSONObject($('#salesPersonsData').val()[0])) {
                salesPersonsData = JSON.parse($('#salesPersonsData').val()[0]);
            } else {
                salesPersonsData = $('#salesPersonsData').val();
            }
            // categories = $('[name="categories[]"]').val();
            categories = $('[name="categories[]"]').val();
            products = $(this).val();

            type_of_data = "{{$type}}";
            getProductItems(salesPersonsData ,categories, products)

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
    function getSalesChannales(salesPersonsData, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': salesPersonsData
                , 'main_field': 'sales_person'
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
            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" required ' + data_type + '  >\n';
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
        });
    }

    // Categories
    function getCategories(salesPersonsData, type_of_data) {
        // console.log(salesPersonsData, type_of_data);
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': salesPersonsData
                , 'main_field': 'sales_person'
                , 'field': type_of_data
            }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            // if($('#data_type').val()  == 'value'){
            var data_type = 'multiple';
            // }else{
            //     var data_type = '';
            // }
            row = '<select data-live-search="true" data-actions-box="true" name="categories[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" ' + data_type + '  required >\n';
            // if($('#data_type').val()  !== 'value'){
            //     row += '<option value="">Select</option>\n' ;
            // }

            $.each(data, function(key, val) {
                row += '<option value*="' + val + '">' + val + '</option>\n';

            });
            row += '</select>';
            console.log(row);
            $('#categories').html('');
            $('#categories').append(row);
            reinitializeSelect2();
        });
    }
    // Sub Categories
    function getProducts(salesPersonsData , categories, type_of_data, type) {
        // alert(categories)
        console.log(type_of_data);
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': salesPersonsData
                , 'main_field': 'sales_person'
                , 'second_main_data': categories
                , 'sub_main_field': 'category'
                // , 'third_main_data': products
                // , 'third_main_field': 'product_or_service'
                , 'field':type_of_data
            , }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            // if($('#data_type').val()  == 'value'){
            var data_type = 'multiple';
            // }else{
            //     var data_type = '';
            // }
            // console.log(type);
            if (type == 'sales_person' || type == 'product_or_service' 
            // || type == 'product_item'
            ) {

                row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="form-control select2-select kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required >\n';

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                appendTo = '';
                if(type == 'product_item')
                {
                    appendTo ='#products__'
                }
                else{
                    appendTo ='#sales_channels';
                }
                row += '</select>';
                $(appendTo).html('');
                $(appendTo).append(row);
                reinitializeSelect2();
            } else {

                    appendTo = '';
                if(type == 'product_item')
                {
                    appendTo ='#products__'
                }
                else{
                    appendTo ='#sales_channels';
                }

                row = '<select data-live-search="true" data-actions-box="true" name="products[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required  >\n';
                // if($('#data_type').val()  !== 'value'){
                //     row += '<option value="">Select</option>\n' ;
                // }

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                $(appendTo).html('');
                $(appendTo).append(row);
                reinitializeSelect2();
            }
        });
    }
    // Product Or Services
    function getProductItems(salesPersonsData,categories , products) {
        // if(! document.getElementById('has_product_item'))
        // {
            // return ;
        // }

        

        $.ajax({
            type: 'POST'
            , data: 
            {
                'main_data': salesPersonsData
                , 'main_field': 'sales_person'
                , 'second_main_data': categories
                , 'sub_main_field': 'category'
                , 'third_main_data': products
                , 'third_main_field': 'product_or_service'
                , 'field': 'product_item'
            , }

            // {
            //     'main_data': salesPersonsData
            //     , 'main_field': 'category'
            //     , 'third_main_data': products
            //     , 'third_main_field': 'sales_person'
            //     , 'field': type_of_data
            // , }
            , url: '{{ route('get.zones.data',$company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {
            var data_type = 'multiple';
        
            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required  >\n';
          

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

</script>
@endsection
