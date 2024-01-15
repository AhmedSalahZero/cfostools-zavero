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
        <form class="kt-form kt-form--label-right" method="POST" action={{  $name_of_selector_label == 'Sales Discount' ? route('branches.salesDiscount.analysis.result', $company) : route('branches.analysis.result', $company) }} enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet">
                <?php 
                    // $branches = App\Models\SalesGathering::company()
                    //     ->whereNotNull('branch')
                    //     ->where('branch','!=','')
                    //     ->groupBy('branch')
                    //     ->selectRaw('branch')
                    //     ->get()
                    //     ->pluck('branch')
                    //     ->toArray();
                        $branches = getTypeFor('branch',$company->id,false);



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
                            <label>{{ __('Select Branches') }}
                                @include('max-option-span')

                            </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select data-live-search="true" data-actions-box="true" name="branches[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" id="branches" multiple>
                                        {{-- <option value="{{ json_encode($branches) }}">{{ __('All branches') }}</option> --}}
                                        @foreach ($branches as $branch)
                                        <option value="{{ $branch }}"> {{ __($branch) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if ($name_of_selector_label == 'Products / Services' || $name_of_selector_label == 'Products Items')

                        <div class="col-md-{{$column}}">
                            <label>{{ __('Select Categories ') }}<span class="multi_selection">
                                    {{-- {{__('( Multi Selection )')}} --}}
                                </span>
                                @include('max-option-span')
                            </label>
                            <div class="kt-input-icon">
                                <div class="input-group date" id="categories">
                                    <select data-live-search="true" data-actions-box="true" name="categories[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" multiple>

                                    </select>
                                </div>
                            </div>
                        </div>

                        @endif

                        @if ( $name_of_selector_label == 'Products Items')

                        <div class="col-md-{{$column}}">
                            <label>{{ __('Select Products ') }}<span class="multi_selection">
                                    {{-- {{__('( Multi Selection )')}} --}}
                                </span>

                                @include('max-option-span')

                            </label>
                            <div class="kt-input-icon">
                                <div class="input-group date" id="products">
                                    <select data-live-search="true" data-actions-box="true" name="products[]" required class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" multiple>

                                    </select>
                                </div>
                            </div>
                        </div>

                        @endif
                        @if ( $name_of_selector_label == 'Sales Discount')

                        <div class="col-md-{{$column}}">
                            <label>{{ __('Select '.$name_of_selector_label
                                    // .' ( Multi Selection )'
                                    )
                                    
                                     }}
                                     
                                     </label>
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
                            <label>{{ __('Select '.$name_of_selector_label.' ') }}<span class="multi_selection">
                                    {{-- {{__('( Multi Selection )')}} --}}
                                </span> @include('max-option-span') </label>
                            <div class="kt-input-icon">
                                <div class="input-group date" id="sales_channels">
                                    <select data-live-search="true" data-actions-box="true" name="sales_channels[]" required class="form-control kt-bootstrap-select select2-select kt_bootstrap_select" multiple>

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
{{-- <script src="{{ url('assets/js/demo1/pages/crud/forms/validation/form-widgets.js') }}" type="text/javascript"> --}}
{{-- </script> --}}

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
        $('#branches option:selected').prop('selected', false);

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
    $(document).on('change', '#branches', function() {

        clearTimeout(wto);
        wto = setTimeout(() => {
            if (tryParseJSONObject($(this).val()[0])) {
                branches = JSON.parse($(this).val()[0]);
            } else {
                branches = $(this).val();
            }
            type_of_data = "{{$type}}";
            if ("{{$name_of_selector_label}}" == 'Products / Services' || "{{$name_of_selector_label}}" == 'Products Items') {
                getCategories(branches, 'category');
            } else {
                getSalesChannales(branches, type_of_data);
            }

        }, getNumberOfMillSeconds());


    });
    $(document).on('change', '[name="categories[]"]', function() {


        clearTimeout(wto);
        wto = setTimeout(() => {
            if (tryParseJSONObject($('#branches').val()[0])) {
                branches = JSON.parse($('#branches').val()[0]);
            } else {
                branches = $('#branches').val();
            }
            type_of_data = "{{$type}}";

            categories = $(this).val();

            getProducts(branches, categories, 'product_or_service', type_of_data)

        }, getNumberOfMillSeconds());



    });
    $(document).on('change', '[name="products[]"]', function() {

        clearTimeout(wto);
        wto = setTimeout(() => {

            if (tryParseJSONObject($('#branches').val()[0])) {
                branches = JSON.parse($('#branches').val()[0]);
            } else {
                branches = $('#branches').val();
            }
            categories = $('[name="categories[]"]').val();
            products = $(this).val();

            type_of_data = "{{$type}}";
            getProductItems(branches, categories, products, type_of_data)


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
    function getSalesChannales(branches, type_of_data) {
        if (branches.length) {
            $.ajax({
                type: 'POST'
                , data: {
                    'main_data': branches
                    , 'main_field': 'branch'
                    , 'field': type_of_data
                }
                , url: '{{ route('get.zones.data',$company) }}'
                , dataType: 'json'
                , accepts: 'application/json'
                // ,complete:function(){
                //     $('select.select2-select').prop('disabled',false);   
                // },
                // beforeSend:function(){
                //     $('select.select2-select').prop('disabled',true);   
                // }
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

    }

    // Categories
    function getCategories(branches, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': branches
                , 'main_field': 'branch'
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
            // var data_type = '';
            // }
            row = '<select data-live-search="true" data-actions-box="true" name="categories[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select" ' + data_type + '  required >\n';
            if ($('#data_type').val() !== 'value') {
                row += '<option value="">Select</option>\n';
            }
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
    function getProducts(branches, categories, type_of_data, type) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': branches
                , 'main_field': 'branch'
                , 'second_main_data': categories
                , 'sub_main_field': 'category'
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

                row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required >\n';
                if ($('#data_type').val() !== 'value') {
                    row += '<option value="">Select</option>\n';
                }


                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                console.log(row);
                $('#sales_channels').html('');
                $('#sales_channels').append(row);
                reinitializeSelect2();
            } else {
                row = '<select data-live-search="true" data-actions-box="true" name="products[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required  >\n';
                if ($('#data_type').val() !== 'value') {
                    row += '<option value="">Select</option>\n';
                }

                $.each(data, function(key, val) {
                    row += '<option value*="' + val + '">' + val + '</option>\n';

                });
                row += '</select>';
                console.log(row);
                $('#products').html('');
                $('#products').append(row);
                reinitializeSelect2();
            }
        });
    }
    // Product Or Services
    function getProductItems(branches, categories, products, type_of_data) {
        $.ajax({
            type: 'POST'
            , data: {
                'main_data': branches
                , 'main_field': 'branch'
                , 'second_main_data': categories
                , 'sub_main_field': 'category'
                , 'third_main_data': products
                , 'third_main_field': 'product_or_service'
                , 'field': type_of_data
            , }
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
            row = '<select data-live-search="true" data-actions-box="true" name="sales_channels[]" class="select2-select form-control kt-bootstrap-select kt_bootstrap_select"  ' + data_type + '  required  >\n';
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

</script>
<script>
    $(function() {
        reinitializeSelect2();
        $('#branches').trigger('change');
    })

</script>
@endsection
