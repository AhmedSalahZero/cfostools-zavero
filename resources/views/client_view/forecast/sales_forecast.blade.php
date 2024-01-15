@extends('layouts.dashboard')

@section('css')
    <link href="{{ url('assets/vendors/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        table {
            white-space: nowrap;
        }
        .hideit{
            display: none;
        }

    </style>
@endsection
@section('content')
    @if (session()->has('message'))
        <div class="row">

            <div class="col-1"></div>
            <div class="col-10">
                <div class="alert alert-danger" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">{{ __(' Please .. refill the fields according to the new dates') }}</div>
                </div>
            </div>
        </div>
    @endif
    <form action="{{ route('sales.forecast.save', $company) }}" method="POST">
        @csrf

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Sales Forecast') }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <div class="form-group row">
                    <div class="col-md-6">
                        <label>{{ __('Choose Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" name="start_date" required value="{{ $sales_forecast['start_date'] }}"
                                    class="form-control" placeholder="Select date" aria-describedby="emailHelp" />
                            </div>
                            <span class="input-note text-muted kt-font-primary kt-font-bold"> <i
                                    class="flaticon-warning note-icon"> </i>
                                {{ __('Kindly take note incase you changed the dates the info you filled will be deleted ') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('End Date') }}</label>
                        <div class="kt-input-icon">
                            <div class="input-group date">
                                <input type="date" name="end_date" disabled value="{{ $sales_forecast['end_date'] }}"
                                    class="form-control" placeholder="Select date" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin:: Widgets/Stats-->

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Sales Results') }}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body  kt-portlet__body--fit">
                <div class="row row-no-padding row-col-separator-xl">

                    {{-- Pervious Year Sales --}}
                    <div class="col-md-4 col-lg-4 col-xl-4">

                        <!--begin::New Users-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title font-size">
                                        {{ __('Pervious Year Sales (year' . $sales_forecast['previous_year'] . ' )') }}
                                    </h4>

                                </div>
                            </div>
                            <div class="kt-widget24__details">
                                <span class="kt-widget24__stats kt-font-success">
                                    {{ $previous_year_sales =  number_format($sales_forecast['previous_1_year_sales'] ?? 0) }}

                                    @php
                                        $previous_year_sales = 0;
                                    @endphp
                                </span>
                                <input type="hidden" name="previous_1_year_sales"
                                    value="{{ $sales_forecast['previous_1_year_sales'] ?? 0 }}">
                                <input type="hidden" name="previous_year" value="{{ $sales_forecast['previous_year'] }}">
                            </div>
                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-success" role="progressbar" style="width: 100%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="kt-widget24__action">

                            </div>
                        </div>

                        <!--end::New Users-->
                    </div>
                    {{-- Year  Gr Rate --}}
                    <div class="col-md-4 col-lg-4 col-xl-4">

                        <!--begin::Total Profit-->
                        <div class="kt-widget24 text-center">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title font-size">
                                        {{ __('Year ' . $sales_forecast['previous_year'] . ' Gr Rate %') }}
                                    </h4>

                                </div>
                            </div>
                            <div class="kt-widget24__details">
                                <span class="kt-widget24__stats kt-font-brand">
                                    {{ number_format($sales_forecast['previous_year_gr'] ?? 0, 2) . ' % ' }}
                                </span>
                                <input type="hidden" name="previous_year_gr"
                                    value="{{ $sales_forecast['previous_year_gr'] ?? 0 }}">
                            </div>

                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 100%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="kt-widget24__action">
                                <span class="kt-widget24__change">

                                </span>
                                <span class="kt-widget24__number">

                                </span>
                            </div>
                        </div>

                        <!--end::Total Profit-->
                    </div>
                    {{-- Average Last 3 Years --}}
                    <div class="col-md-4 col-lg-4 col-xl-4">

                        <!--begin::New Feedbacks-->
                        <div class="kt-widget24">
                            <div class="kt-widget24__details">
                                <div class="kt-widget24__info">
                                    <h4 class="kt-widget24__title font-size">
                                        {{ __('Last 3 Years Average Sales') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="kt-widget24__details">
                                <span class="kt-widget24__stats kt-font-warning">
                                    {{ number_format($sales_forecast['average_last_3_years'] ?? 0) }}
                                </span>
                                <input type="hidden" name="average_last_3_years"
                                    value="{{ $sales_forecast['average_last_3_years'] ?? 0 }}">
                            </div>
                            <div class="progress progress--sm">
                                <div class="progress-bar kt-bg-warning" role="progressbar" style="width: 100%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="kt-widget24__action">
                                <span class="kt-widget24__change">

                                </span>
                                <span class="kt-widget24__number">

                                </span>
                            </div>
                        </div>

                        <!--end::New Feedbacks-->
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Stats-->






        {{-- Previous Year Seasonality --}}
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--mobile">

                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <x-table :tableTitle="__('Previous Year Seasonality')"
                            :tableClass="'kt_table_with_no_pagination_no_scroll'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __('Dates') }}</th>
                                    @foreach ($sales_forecast['previous_year_seasonality'] ?? [] as $date => $seasonality)
                                        <th>{{ date('M-Y', strtotime($date)) }}</th>
                                    @endforeach
                                </tr>
                            @endslot
                            @slot('table_body')
                                <tr>
                                    <th class="text-center">{{ __('Seasonality') }}</th>
                                    @foreach ($sales_forecast['previous_year_seasonality'] ??[] as $date => $seasonality)
                                        <td class="text-center">

                                            {{ number_format($seasonality, 2) . ' %' }}
                                        </td>
                                        <input type="hidden" name="previous_year_seasonality[{{ $date }}]"
                                            value="{{ $seasonality ?? 0 }}">
                                    @endforeach
                                </tr>
                            @endslot
                        </x-table>


                    </div>
                </div>
            </div>
        </div>









        {{-- Last 3 Years Seasonality --}}
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <x-table :tableTitle="__('Last 3 Years Seasonality')"
                            :tableClass="'kt_table_with_no_pagination_no_scroll'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __('Dates') }}</th>
                                    @foreach ($sales_forecast['last_3_years_seasonality'] ?? [] as $month => $seasonality)
                                        <th>{{ $month }}</th>
                                    @endforeach
                                </tr>
                            @endslot
                            @slot('table_body')
                                <tr>
                                    <th class="text-center">{{ __('Seasonality') }}</th>
                                    <?php $sum_totals = array_sum($sales_forecast['last_3_years_seasonality'] ?? []); ?>
                                    @foreach ($sales_forecast['last_3_years_seasonality'] ?? [] as $month => $total)
                                        <td class="text-center">
                                            {{ number_format(($total / $sum_totals) * 100 ?? 0, 2) . ' %' }}
                                        </td>
                                        <input type="hidden" name="last_3_years_seasonality[{{ $month }}]"
                                            value="{{ ($total / $sum_totals) * 100 ?? 0 }}">
                                    @endforeach
                                </tr>
                            @endslot
                        </x-table>


                    </div>
                </div>
            </div>
        </div>






        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--mobile">
                    <?php $sales_forecast_data = App\Models\SalesForecast::company()->first() ?? old(); ?>
                    <div class="kt-portlet__body">
                        <!--begin: Datatable -->
                        <div class="row">
                            <div class="col-md-6">
                                <label>{{ __('Target Base') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group date validated">
                                        <select name="target_base" class="form-control" id="target_base">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @if(hasProductsItems($company))
                                            <option value="previous_year"
                                                {{ @$sales_forecast_data['target_base'] !== 'previous_year' ?: 'selected' }}>
                                                {{ __('Based On Pervious Year Sales') }}</option>
                                            <option value="previous_3_years"
                                                {{ @$sales_forecast_data['target_base'] !== 'previous_3_years' ?: 'selected' }}>
                                                {{ __('Based On Last 3 Years Sales') }}</option>
                                                @endif 
                                            <option value="new_start"
                                                {{ @$sales_forecast_data['target_base'] !== 'new_start' ?: 'selected' }}>
                                                {{ __('New Start') }}</option>
                                        </select>
                                        @if ($errors->has('target_base'))
                                            <div class="invalid-feedback">{{ $errors->first('target_base') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6"
                                style="display: {{ @$sales_forecast_data['target_base'] == 'new_start' ? 'block' : 'none' }}"
                                id="new_start_field">
                                <div class="form-group  form-group-marginless validated">
                                    <label>New Start</label>
                                    <div class="col-md-12 " >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span
                                                            class="kt-radio kt-radio--bold kt-radio--brand kt-radio--check-bold"
                                                            checked>
                                                            <input type="radio" name="new_start" value="annual_target"
                                                                {{ @$sales_forecast_data['new_start'] == 'annual_target' ? 'checked' : '' }}>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">
                                                                {{ __('Annual Target') }}
                                                            </span>

                                                        </span>
                                                        <span class="kt-option__body">
                                                            {{-- {{__('This Section Will Be Added In The Client Side')}} --}}
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="kt-option">
                                                    <span class="kt-option__control">
                                                        <span class="kt-radio kt-radio--bold kt-radio--brand">
                                                            <input type="radio" name="new_start" value="product_target"
                                                                {{ @$sales_forecast_data['new_start'] == 'product_target' ? 'checked' : '' }}>
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label">
                                                        <span class="kt-option__head">
                                                            <span class="kt-option__title">
                                                                {{ __('Prodcuts Targets') }}
                                                            </span>

                                                        </span>
                                                        <span class="kt-option__body">
                                                            {{-- {{__('This Section Will Be Added In The Client Side')}} --}}
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        @if ($errors->has('new_start'))
                                            <div class="invalid-feedback">{{ $errors->first('new_start') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3"
                                style="display: {{ @$sales_forecast_data['target_base'] == 'previous_year' || @$sales_forecast_data['target_base'] == 'previous_3_years'? 'block': 'none' }}"
                                id="growth_rate_field">
                                <label>{{ __('Growth Rate %') }} <span class="required">*</span></label>
                                <div class="kt-input-icon validated">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" name="growth_rate"
                                            value="{{ @$sales_forecast_data['growth_rate'] }}" id="growth_rate">
                                    </div>
                                    @if ($errors->has('growth_rate'))
                                        <div class="invalid-feedback">{{ $errors->first('growth_rate') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-{{ @$sales_forecast_data['new_start'] == 'annual_target' && @$sales_forecast_data['target_base'] == 'new_start'? '6': '3' }}"
                                style="display: {{ @$sales_forecast_data['target_base'] == 'previous_year' || @$sales_forecast_data['target_base'] == 'previous_3_years' ||@$sales_forecast_data['new_start'] == 'annual_target'? 'block': 'none' }}"
                                id="sales_target_field">
                                <label>{{ __('Annual Sales Target') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group validated">
                                        <input type="number" step="any" class="form-control" name="sales_target"
                                            value="{{ @$sales_forecast_data['sales_target'] }}"  id="sales_target">
                                        @if ($errors->has('sales_target'))
                                            <div class="invalid-feedback">{{ $errors->first('sales_target') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="kt-option bg-secondary">
                                    <span class="kt-option__control">
                                        <span
                                            class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                            checked>
                                            <input class="rows" name="add_new_products" type="checkbox" value="1"
                                                {{ @$sales_forecast_data['add_new_products'] == 0 ?: 'checked' }}
                                                id="product_item_check_box" data-old-checked="{{ @$sales_forecast_data['add_new_products']?:0 }}"> 
                                            <span></span>
                                        </span>
                                    </span>
                                    <span class="kt-option__label d-flex">
                                        <span class="kt-option__head mr-auto p-2">
                                            <span class="kt-option__title">
                                                <b>
                                                    {{ __('Add New Products Or Product Item') }}
                                                </b>
                                            </span>

                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-md-6"
                                style="display:{{ @$sales_forecast_data['add_new_products'] == 1 ? 'block' : 'none' }}"
                                id="number_of_products_field" data-old-value="{{ @$sales_forecast_data['number_of_products'] ?: 0  }}">
                                <label>{{ __('How Many Products') }} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <div class="input-group validated">
                                        <input type="number" step="any" class="form-control" name="number_of_products"
                                            value="{{ @$sales_forecast_data['number_of_products'] }}" id="number_of_products">
                                            @if ($errors->has('number_of_products'))
                                                <div class="invalid-feedback">{{ $errors->first('number_of_products') }}</div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php ?>
                                                   @if(hasProductsItems($company))

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group  form-group-marginless">
                                    <label>{{ __('Seasonality') }} <span class="required">*</span></label>
                                    <div class="kt-input-icon">
                                        <div class="input-group date validated">

                                            <select name="seasonality" class="form-control" id="seasonality">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option value="previous_year"
                                                    {{ @$sales_forecast_data['seasonality'] !== 'previous_year' ?: 'selected' }}>
                                                    {{ __('Pervious Year Seasonality') }}</option>
                                                <option value="last_3_years"
                                                    {{ @$sales_forecast_data['seasonality'] !== 'last_3_years' ?: 'selected' }}>
                                                    {{ __('Last 3 Years Seasonality') }}</option>

                                           
                                            </select>
                                            @if ($errors->has('seasonality'))
                                                <div class="invalid-feedback">{{ $errors->first('seasonality') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                                                @endif 

                    </div>
                </div>
            </div>
        </div>







        {{-- Monthly Seasonality --}}
        {{-- <div class="row" id="monthly_seasonality" style="display: {{@$sales_forecast['seasonality'] == 'new_seasonality_monthly' ? 'block' :  'none'}}">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--mobile">

                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->

                        <h4 class="text-success"><i class="fa fa-hand-point-right">
                            </i></i>{{ __('Total Percentages Must Be Equal To 100 %') }}</h4>
                        <x-table :tableTitle="__('Monthly Seasonality')"
                            :tableClass="'kt_table_with_no_pagination_no_scroll'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __('Dates') }}</th>
                                    @foreach ($sales_forecast['dates'] as $date => $value)
                                        <th>{{ date('M-Y', strtotime($date)) }}</th>
                                    @endforeach
                                    <th>{{ __('Total Values') }}</th>
                                </tr>
                            @endslot
                            @slot('table_body')
                                <tr>
                                    <th class="text-center">{{ __('Sales %') }}</th>
                                    @foreach ($sales_forecast['dates'] as $date => $value)

                                        <td class="text-center">
                                            <input type="number" class="form-control months" name="new_seasonality_monthly[{{ $date }}]" value="{{@$sales_forecast['seasonality'] == 'new_seasonality_monthly' ? @$sales_forecast['new_seasonality'][$date]:0}}"
                                                >
                                        </td>
                                    @endforeach
                                    <td> <input type="number" disabled class="form-control total_months" value=""> </td>
                                </tr>
                            @endslot
                        </x-table>


                    </div>
                </div>
            </div>
        </div> --}}
        {{-- Quarterly Seasonality --}}
        {{-- <div class="row" id="quarterly_seasonality" style="display: {{@$sales_forecast['seasonality'] == 'new_seasonality_quarterly' ? 'block' :  'none'}}">
            <div class="col-md-12">
                <div class="kt-portlet kt-portlet--mobile">

                    <div class="kt-portlet__body">

                        <!--begin: Datatable -->

                        <h4 class="text-success"><i class="fa fa-hand-point-right"> </i>
                            {{ __('Total Percentages Must Be Equal To 100 %') }}</h4>
                        <x-table :tableTitle="__('Quarterly Seasonality')"
                            :tableClass="'kt_table_with_no_pagination_no_scroll'">
                            @slot('table_header')
                                <tr class="table-active text-center">
                                    <th>{{ __('Dates') }}</th>
                                    @foreach ($sales_forecast['quarter_dates'] as $date => $value)
                                        <th>{{ date('M-Y', strtotime($date)) }}</th>
                                    @endforeach
                                    <th>{{ __('Total Values') }}</th>
                                </tr>
                            @endslot
                            @slot('table_body')

                                <tr>
                                    <th class="text-center">{{ __('Sales %') }}</th>
                                    @foreach ($sales_forecast['quarter_dates'] as $date => $value)
                                        <td class="text-center">
                                            <input type="number" name="new_seasonality_quarterly[{{ $date }}]" value="{{@$sales_forecast['seasonality'] == 'new_seasonality_quarterly' ? @$sales_forecast['new_seasonality'][$date]:0}}"
                                                class="form-control quarters">
                                        </td>
                                    @endforeach
                                    <td> <input type="number" disabled class="form-control total_quarters"></td>
                                </tr>
                            @endslot
                        </x-table>


                    </div>
                </div>
            </div>
        </div> --}}
        <x-next__button :report="true" :companyId="$company->id"> </x-next__button>

    </form>
@endsection
@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}"
        type="text/javascript">
    </script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript">
    </script>

    <script>
        // $(document).ready(function () {
        //     totalFunction('.months','.total_months',0);
        //     totalFunction('.quarters','.total_quarters',0);
        // });
        $("input[name='new_start']").change(function() {

            if ($(this).val() == 'annual_target') {
                $('#sales_target_field').attr("readonly", false);
                $('#sales_target_field').fadeIn(300);

            } else {
                $('#sales_target_field').fadeOut(300);
                $('#sales_target_field').attr("readonly", true);
            }
        });
        $('#target_base').on('change', function() {
            val = $(this).val();

            if (val == 'previous_year' || val == 'previous_3_years') {

                $('#new_start_field').fadeOut("slow", function() {
                    $('#growth_rate_field').fadeIn(300);
                    $('#sales_target_field').fadeIn(300);
                });
                $('#sales_target_field').attr("readonly", true);
            } else if (val == 'new_start') {
                $('#growth_rate_field').fadeOut("slow", function() {
                    $('#sales_target_field').fadeOut(300);
                    $('#new_start_field').fadeIn(300);
                });
                $('#sales_target_field').attr("readonly", true);
            } else {

            }
        });



        $('#growth_rate,#target_base').on('change', function() {
            val = $('#target_base').val();
            growth_rate = parseFloat($('#growth_rate').val()) / 100;
            result = 0;
            if (val == 'previous_year') {
                result = parseFloat("{{ $sales_forecast['previous_1_year_sales'] }}") * (1 + growth_rate);
            } else if (val == 'previous_3_years') {
                result = parseFloat("{{ $sales_forecast['average_last_3_years'] }}") * (1 + growth_rate);

            }
            $('#sales_target').val(result.toFixed(0));
        });











        $('#seasonality').on('change', function() {
            val = $(this).val();

            if (val == 'previous_year' || val == 'last_3_years') {

                $('#monthly_seasonality').fadeOut(300)
                $('#quarterly_seasonality').fadeOut(300)
            } else if (val == 'new_seasonality_monthly') {
                $('#quarterly_seasonality').fadeOut("slow", function() {
                    $('#monthly_seasonality').fadeIn(300);
                });
            } else if (val == 'new_seasonality_quarterly') {
                $('#monthly_seasonality').fadeOut("slow", function() {
                    $('#quarterly_seasonality').fadeIn(300);
                });

            }
        });


        $('#product_item_check_box').change(function(e) {
            if ($(this).prop("checked")) {
                $('#number_of_products_field').fadeIn(300);
            } else {
                $('#number_of_products_field').fadeOut(300);
            }
        });
        // $('.months').change(function(e) {
        //     totalFunction('.months','.total_months',0);
        // });
        // $('.quarters').change(function(e) {
        //     totalFunction('.quarters','.total_quarters',0);
        // });

        function totalFunction(field_name, total_field_name, decimals) {
            total = 0;
            $(field_name).each(function(index, element) {

                if (element.value !== '') {
                    total = parseFloat(element.value) + total;
                }

            });
            $(total_field_name).val(total.toFixed(decimals));
        }
    </script>


    <script>
        $(document).on('change' , '#product_item_check_box , #number_of_products', function(e){
            let oldIsChedked = $('#product_item_check_box').attr('data-old-checked');
            let newIsChecked = $('#product_item_check_box').is(':checked') ? 1 : 0 ;

            let oldNewProductsItems = parseFloat($('#number_of_products_field').attr('data-old-value'));
            let newProductsItems = parseFloat($('#number_of_products').val());
// alert(oldIsChedked);
// alert(newIsChecked);
// alert(oldIsChedked != newIsChecked);
// alert(oldNewProductsItems != newProductsItems);
            if(oldIsChedked != newIsChecked  || oldNewProductsItems != newProductsItems) {
                // alert('hide')
                $('#subkit_summary_report_id').addClass('hideit');
            }
            else{
                // alert('show')
                $('#subkit_summary_report_id').removeClass('hideit');
            }

        })
    </script>

    <script>
        // $('#subkit_summary_report_id').on('click',function(e){
        //     e.preventDefault();
        //     $('form').attr('action'  , "{{ route('go.to.summary.report' , $company->id) }}");
        //     $('form').submit();
        // });
    </script>
@endsection
