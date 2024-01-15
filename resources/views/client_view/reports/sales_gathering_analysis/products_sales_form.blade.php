@extends('layouts.dashboard')
@section('css')
<link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('sub-header')
{{ __('Sales Channel Sales Analysis') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">



        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" method="POST" action={{ route('categories.sales.analysis.result', $company) }} enctype="multipart/form-data">
            @csrf
            <div class="kt-portlet">
                <?php $categoriesData = App\Models\SalesGathering::company()
                        ->whereNotNull('category')
                        ->where('category','!=','')
                        ->groupBy('category')
                        ->selectRaw('category')
                        ->get()
                        ->pluck('category')
                        ->toArray();

                    ?>

                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>{{ __('Select Categories') }}

                                @include('max-option-span')

                            </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select data-live-search="true" data-actions-box="true" data-max-options="{{ maxOptionsForOneSelector() }}" name="categoriesData[]" required class="form-control select2-select kt-bootstrap-select kt_bootstrap_select" id="categoriesData" multiple>
                                        {{-- <option value="{{ json_encode($categoriesData) }}">
                                        {{ __('All Categories') }}</option> --}}
                                        @foreach ($categoriesData as $category)
                                        <option value="{{ $category }}"> {{ __($category) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>{{ __('Select Products ( Multi Selection )') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date" id="products">
                                    <select name="products[]" required class="form-control kt-bootstrap-select kt_bootstrap_select" multiple>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label>{{ __('Start Date') }}</label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="date" name="start_date" required class="form-control" placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{ __('End Date') }}</label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <input type="date" name="end_date" required value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" class="form-control" placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{ __('Select Interval') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="interval" required class="form-control">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        {{-- <option value="daily">{{__('Daily')}}</option> --}}
                                        <option value="monthly">{{ __('Monthly') }}</option>
                                        <option value="quarterly">{{ __('Quarterly') }}</option>
                                        <option value="semi-annually">{{ __('Semi-Annually') }}</option>
                                        <option value="annually">{{ __('Annually') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>{{ __('Data Type') }} </label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="interval" disabled class="form-control">

                                        <option selected value="value">{{ __('Value') }}</option>
                                        <option value="quantity">{{ __('Quantity') }}</option>
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
    $(document).on('change', '#categoriesData', function() {

        if (tryParseJSONObject($(this).val()[0])) {
            alert($(this).val());
            categoriesData = JSON.parse($(this).val()[0]);
        } else {
            categoriesData = $(this).val();
        }

        getProducts(categoriesData, 'product_or_service');

    });
    // Sub Categories
    function getProducts(categories, type_of_data) {
        $.ajax({
            type: 'GET'
            , data: {
                'main_data': categories
                , 'main_field': 'category'
                , 'field': type_of_data
            }
            , url: '{{ route('get.zones.data', $company) }}'
            , dataType: 'json'
            , accepts: 'application/json'
        }).done(function(data) {


            row =
                '<select name="products[]" class="form-control kt-bootstrap-select kt_bootstrap_select" required multiple>\n';
            $.each(data, function(key, val) {
                row += '<option value*="' + val + '">' + val + '</option>\n';

            });
            row += '</select>';
            console.log(row);
            $('#products').html('');
            $('#products').append(row);


        });
    }

</script>
@endsection
