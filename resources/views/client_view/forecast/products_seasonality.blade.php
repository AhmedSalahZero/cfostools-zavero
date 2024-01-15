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

    </style>
@endsection
@section('content')
    <form action="{{ route('products.seasonality', $company) }}" method="POST">
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
                <h2>{{__('Sales Annual Target Year ' )  . date('Y',strtotime($sales_forecast->start_date)) .' : '. number_format($sales_forecast->sales_target)}}</h2>
                <x-table :tableTitle="__('Product Items Table')" :tableClass="'kt_table_with_no_pagination'" >
                    @slot('table_header')
                        <tr class="table-active text-center">
                            <th>{{ __('Product '.($has_product_item == true ? 'Item' : '').' Name') }}</th>
                            @if ($has_product_item == true)
                                <th>{{ __('Choose Product / Service') }}</th>
                            @endif
                            <th>{{ __('Choose Category') }}</th>
                            <th>{{ __('Sales Target Value') }}</th>
                            @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                <th>{{ __('Sales Target %') }}</th>
                            @endif

                        </tr>
                    @endslot
                    @slot('table_body')

                        <?php $key=0; $product_seasonality = count($product_seasonality)>0 ? $product_seasonality : old() ;?>
                        @for ($number = 1; $number <= $sales_forecast->number_of_products; $number++)
                            <tr>

                                <td class="text-center">
                                    <div class="input-group date validated">
                                        <input type="text" name="product_items_name[{{$key}}]" placeholder="{{__("Insert Name")}}" class="product_items_name form-control" value="{{$product_seasonality[$key]->name ?? (old('product_items_name')[$key]??'') }}">
                                        @if ($errors->has("product_items_name.".$key))
                                            <div class="invalid-feedback">{{ $errors->first("product_items_name.".$key) }}</div>
                                        @endif
                                    </div>
                                </td>
                                @if ($has_product_item == true)
                                    <?php $product_id = ($product_seasonality[$key]->product_id)??(old('products')[$key]??''); ?>
                                    <td class="text-center">
                                        <div class="kt-input-icon">
                                            <div class="input-group date validated">
                                                <select name="products[]" class="form-control products" >
                                                    <option value=""  >{{ __('Select') }}</option>
                                                    @foreach ($products as $product)
                                                    @if($product->category)
                                                        <option value="{{$product->id}}" 
                                                        data-name="{{$product->category->name}}" data-id="{{$product->category->id}}"
                                                         {{( $product_id != $product->id ) ?'': "selected" }} >{{ $product->name }}</option>
                                                    @endif
                                                    @endforeach

                                                </select>
                                                @if ($errors->has("products.".$key))
                                                    <div class="invalid-feedback">{{ $errors->first("products.".$key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                @endif
                                <td class="text-center">
                                    <div class="kt-input-icon">
                                        @if ($has_product_item == true)
                                            <?php $category = isset($product_seasonality[$key]->category_id) ?  App\Models\Category::find($product_seasonality[$key]->category_id) : null?>
                                            <div class="input-group date">
                                                <select name="categories[]" readonly class="form-control categories" required>
                                                    @if ($category !== null)
                                                        <option value="{{$category->id}}" selected>{{ $category->name }}</option>
                                                    @endif
                                                </select>
                                            </div>
                                        @else
                                            <?php $categories =  App\Models\Category::where('company_id',$company->id)->get(); ?>
                                            <div class="input-group date">
                                                <select name="categories[]" readonly class="form-control categories" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}" {{@$product_seasonality[$key]->category_id !== $category->id ?:'selected'}}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group date validated">
                                        {{-- name="sales_target_value[]"  value="{{@$product_seasonality[$key]->sales_target_value}}" --}}
                                        <input type="number" name="sales_target_value[]"  placeholder="{{__('Sales Target Value')}}" class="sales_target_value form-control" >
                                        @if ($errors->has("sales_target_value.".$key))
                                            <div class="invalid-feedback">{{ $errors->first("sales_target_value.".$key) }}</div>
                                        @endif
                                    </div>
                                </td>
                                @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                    <td class="text-center">
                                        <div class="input-group date validated">
                                            <input type="number" step="any" name="sales_target_percentage[]" placeholder="{{__('Sales Target %')}}" class="sales_target_percentage form-control" value="{{($product_seasonality[$key]->sales_target_percentage ?? (old('sales_target_percentage')[$key]??''))}}">
                                            @if ($errors->has("sales_target_percentage.".$key))
                                                <div class="invalid-feedback">{{ $errors->first("sales_target_percentage.".$key) }}</div>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                            <?php $key++; ?>
                        @endfor
                    @endslot
                </x-table>
            </div>
        </div>


        <?php $key = 0;?>
        @for ($number = 1; $number <= $sales_forecast->number_of_products; $number++)
            <div class="row">
                <div class="col-md-12">
                    <div class="kt-portlet kt-portlet--mobile">

                        <div class="kt-portlet__body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group  form-group-marginless">
                                        <label style="font-size: 1.7rem">{{ __('Seasonality For Product '. (($has_product_item == true) ? 'Item' : '')).$number }} <span class="required">*</span></label>
                                        <div class="kt-input-icon">
                                            <div class="input-group date validated">
                                                <select name="seasonality[{{$key}}]" class="form-control seasonality">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option value="new_seasonality_monthly" {{($product_seasonality[$key]->seasonality ??(old('seasonality')[$key]??'')) !== 'new_seasonality_monthly' ?:'selected' }}>{{ __('New Seasonality - Monthly') }}</option>
                                                    <option value="new_seasonality_quarterly" {{($product_seasonality[$key]->seasonality ??(old('seasonality')[$key]??'')) !== 'new_seasonality_quarterly' ?:'selected' }}>{{ __('New Seasonality - Quarterly') }}</option>
                                                </select>
                                                @if ($errors->has("seasonality.".$key))
                                                    <div class="invalid-feedback">{{ $errors->first("seasonality.".$key) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Monthly Seasonality --}}
            <div  class="row monthly_seasonality"  style="display: {{($product_seasonality[$key]['seasonality'] ?? (old('seasonality')[$key]??'') ) == 'new_seasonality_monthly' ? 'block' :  'none'}}">
                <div class="col-md-12">
                    <div class="kt-portlet kt-portlet--mobile">
                        {{-- @if ($errors->has("percentages_total.".$key))
                        <h4 style="color: red">{{$errors->first("percentages_total.".$key)}}</h4>
                    @endif --}}
                        <div class="kt-portlet__body">
                            @if ($errors->has("percentages_total.".$key))
                                <h4 style="color: red"><i class="fa fa-hand-point-right">
                                </i></i>{{$errors->first("percentages_total.".$key)}}</h4>
                                {{-- {{ __('Total Percentages Must Be Equal To 100 %') }}</h4> --}}
                            @else
                                <h4 class="text-success"><i class="fa fa-hand-point-right">
                                </i></i>{{ __('Total Percentages Must Be Equal To 100 %') }}</h4>

                            @endif
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
                                    <?php $value = $product_seasonality[$key]['seasonality_data'][$date] ?? (old('new_seasonality_monthly')[$key][$date]??0) ?>

                                            <td class="text-center">
                                                <input type="number" data-product="{{$key}}" class="form-control months"  name="new_seasonality_monthly[{{$key}}][{{ $date }}]" value="{{ ($product_seasonality[$key]['seasonality'] ?? (old('seasonality')[$key]??'')) == 'new_seasonality_monthly' ? $value : 0}}" >
                                            </td>
                                        @endforeach
                                        <td> <input type="number" disabled class="form-control total_months" value=""> </td>
                                    </tr>
                                @endslot
                            </x-table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Quarterly Seasonality --}}
            <div  class="row quarterly_seasonality"style="display: {{($product_seasonality[$key]['seasonality'] ??(old('seasonality')[$key]??'') ) == 'new_seasonality_quarterly' ? 'block' :  'none'}}">
                <div class="col-md-12">
                    <div class="kt-portlet kt-portlet--mobile">

                        <div class="kt-portlet__body">

                            <!--begin: Datatable -->

                            @if ($errors->has("percentages_total.".$key))
                                <h4 style="color: red"><i class="fa fa-hand-point-right">
                                </i></i>{{$errors->first("percentages_total.".$key)}}</h4>
                                {{-- {{ __('Total Percentages Must Be Equal To 100 %') }}</h4> --}}
                            @else
                                <h4 class="text-success"><i class="fa fa-hand-point-right">
                                </i></i>{{ __('Total Percentages Must Be Equal To 100 %') }}</h4>

                            @endif
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
                                        <?php $value = $product_seasonality[$key]['seasonality_data'][$date] ?? (old('new_seasonality_quarterly')[$key][$date]??0) ?>
                                            <td class="text-center">
                                                <input type="number" data-product="{{$key}}" name="new_seasonality_quarterly[{{$key}}][{{ $date }}]" value="{{($product_seasonality[$key]['seasonality'] ?? (old('seasonality')[$key]??''))  == 'new_seasonality_quarterly' ? $value :0}}"
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
            </div>
            <?php $key++; ?>
        @endfor
        {{-- <x-submitting /> --}}
 <x-next__button > </x-next__button>
    </form>
@endsection
@section('js')
    <script src="{{ url('assets/js/demo1/pages/crud/datatables/basic/paginations.js') }}" type="text/javascript">
    </script>
    <script src="{{ url('assets/vendors/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {

            for (let index = 0; index < '{{$sales_forecast->number_of_products}}' ; index++) {
                totalFunction('.months','.total_months',index,0);
                totalFunction('.quarters','.total_quarters',index,0);
                percentageCangeing(index,$('.sales_target_percentage').eq(index).val());
                cat(index);
            }
        });
        $('.months').on('change',function () {
            key = $(this).data('product');
            totalFunction('.months','.total_months',key,0);
        });
        $('.quarters').on('change',function () {
            key = $(this).data('product');
            totalFunction('.quarters','.total_quarters',key,0);
        });

        function totalFunction(field_name,total_field_name,key,decimals) {
            total = 0;
            $(field_name).each(function(index, element) {

                if (element.value !== '' && key ==  $(this).data('product')) {
                    total = parseFloat(element.value) + total;
                }

            });
            $(total_field_name).eq(key).val(total.toFixed(decimals));
        }


        $('.products').on('change', function () {
            var index = $('.products').index(this);
            cat(index);
        });
        function cat(index) {
            var name= $('.products').eq(index).find(':selected').data('name');
            var id= $('.products').eq(index).find(':selected').data('id');

            $('.categories option').eq(index).remove();
            select = '<option value="'+id+'" selected>'+name +'</option>';
            $('.categories').eq(index).append(select);
        }
        $('.sales_target_value').on('change', function () {
            var index = $('.sales_target_value').index(this);
            var sales_target_value = parseFloat($(this).val());
            var percentage = (sales_target_value/parseFloat("{{$sales_forecast->sales_target}}"))*100;
            $('.sales_target_percentage').eq(index).val(percentage.toFixed(2));
        });

        $('.sales_target_percentage').on('change', function () {
            var index = $('.sales_target_percentage').index(this);
            percentageCangeing(index,$(this).val());
        });

        function percentageCangeing(index,percentage) {

            var sales_target_percentage = parseFloat(percentage) /100;
            var value = (sales_target_percentage*parseFloat("{{$sales_forecast->sales_target}}")) ;
            $('.sales_target_value').eq(index).val(value.toFixed(0));
        }

        $('.seasonality').on('change', function() {
            val = $(this).val();
            var index = $('.seasonality').index(this);

              if (val == 'new_seasonality_monthly') {
                    $('.monthly_seasonality').eq(index).fadeIn(300);
                $('.quarterly_seasonality').eq(index).fadeOut("slow", function() {
                });
            } else if (val == 'new_seasonality_quarterly') {
                $('.monthly_seasonality').eq(index).fadeOut("slow", function() {
                    $('.quarterly_seasonality').eq(index).fadeIn(300);
                });

            }
        });


    </script>

@endsection
