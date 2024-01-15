@extends('layouts.dashboard')

@section('css')
    <link href="{{ url('assets/vendors/general/select2/dist/css/select2.css') }}" rel="stylesheet" type="text/css" />
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
    <form action="{{ route('products.sales.targets', $company) }}" method="POST">

        @csrf
        <?php $total_sales_targets_values = 0; $total_sales_targets_percentages = 0;
        $name_of_product = ($has_product_item === true) ? 'Item' :'' ;?>
        @if ($sales_forecast['add_new_products'] == 1)
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
                    <x-table :tableTitle="__('New Product '.$name_of_product.' Table')" :tableClass="'kt_table_with_no_pagination'" >
                        @slot('table_header')
                            <tr class="table-active text-center">
                                <th>{{ __('Product '.$name_of_product.' Name') }}</th>
                                <th>{{ __('Sales Target Value') }}</th>
                                @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                    <th>{{ __('Sales Target %') }}</th>
                                @endif
                            </tr>
                        @endslot
                        @slot('table_body')

                            @for ($number = 0; $number < $sales_forecast->number_of_products; $number++)
                                <?php
                                    $sales_targets_value = $product_seasonality[$number]->sales_target_value??0;
                                    $sales_targets_percentage = $product_seasonality[$number]->sales_target_percentage??0;
                                    $total_sales_targets_values += $sales_targets_value;
                                    $total_sales_targets_percentages += $sales_targets_percentage;
                                ?>
                                <tr>
                                    <td class="text-center"> {{@$product_seasonality[$number]->name}}</td>

                                    <td class="text-center">{{number_format(($sales_targets_value))}}</td>
                                    @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                        <td class="text-center">{{number_format(($sales_targets_percentage),2) . ' %'}}</td>
                                    @endif

                                </tr>
                            @endfor
                            <tr>
                                <td class="text-center active-style"> {{__('Total')}}</td>

                                <td class="text-center active-style">{{ number_format($total_sales_targets_values)}}</td>
                                @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                    <td class="text-center active-style">{{ number_format($total_sales_targets_percentages). ' %'}}</td>
                                @endif
                            </tr>
                        @endslot
                    </x-table>
                </div>
            </div>
        @endif
                <?php $existing_products_sales_targets = $sales_forecast->sales_target - $total_sales_targets_values ;?>
                @if($existing_products_sales_targets > 0)
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title head-title text-primary">
                                    {{ __('Sales Forecast') }}
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <h2>{{__('Existing Product '.$name_of_product.' Target Year ' )  . date('Y',strtotime($sales_forecast->start_date)) .' : '. number_format($existing_products_sales_targets)}}</h2>
                            <br>
                            <br>

                            <div class="kt-portlet">
                                <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label>{{ __('Show From Others (Multi-Selector  - Maximum 5 )') }} <span class="required">*</span></label>

                                                    <select class="form-control kt-select2" id="kt_select2_9" name="others_target[]" multiple="multiple">
                                                        @foreach ($selector_products as $product)
                                                            <option value="{{$product}}" {{(false !== $found = array_search($product,($modified_targets->others_target??[]))) ? 'selected' : ''}}>{{$product}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label ></label>
                                                <input type="submit" class="btn active-style" name="submit" value="{{__('Show')}}" >
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="kt-option bg-secondary">
                                                    <span class="kt-option__control">
                                                        <span
                                                            class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                                            checked>
                                                            <input class="rows" name="use_modified_targets" type="checkbox"
                                                            value="1" {{ (($modified_targets['use_modified_targets'])??(old('use_modified_targets'))) == 0 ?: 'checked' }}
                                                                id="product_item_check_box">
                                                            <span></span>
                                                        </span>
                                                    </span>
                                                    <span class="kt-option__label d-flex">
                                                        <span class="kt-option__head mr-auto p-2">
                                                            <span class="kt-option__title">
                                                                <b>
                                                                    {{ __('Click To Activate Modified Targets') }}
                                                                </b>
                                                            </span>

                                                        </span>
                                                    </span>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has("percentages_total"))
                                <h4 style="color: red"><i class="fa fa-hand-point-right">
                                </i></i>{{$errors->first("percentages_total")}}</h4>
                            @endif
                            <x-table :tableTitle="__('Existing Product '.$name_of_product.' Table')" :tableClass="'kt_table_with_no_pagination'" >
                                @slot('table_header')
                                    <tr class="table-active text-center">
                                        <th>{{ __('Product '.$name_of_product.' Name') }}</th>
                                        <th>{{ __('Pervious Year Sales Value') }}</th>
                                        <th>{{ __('Sales Target Value') }}</th>
                                        <th>{{ __('Sales Target %') }}</th>
                                        <th>{{ __('Modify Sales Target') }}</th>
                                        @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                            <th>{{ __('Modify Sales %') }}</th>
                                        @endif
                                    </tr>
                                @endslot
                                @slot('table_body')
                                <?php $total = array_sum(array_column($product_item_breakdown_data,'Sales Value'));
                                    $total =  $sales_forecast->seasonality == "last_3_years" ? $total/3 : $total ;
                                    $total_existing_targets = 0;
                                ?>
                                    @foreach ($product_item_breakdown_data as $key => $product_data )
                                        <tr>
                                            <th>{{$product_data['item'] ?? '-'}}</th>
                                            <?php $sales_values  = $sales_forecast->seasonality == "last_3_years" ? (($product_data['Sales Value']??0)/3 ):$product_data['Sales Value'] ; ?>
                                            <td class="text-center">{{number_format($sales_values)}}</td>

                                            <?php
                                                $target_percentage = ($total == 0) ? 0 : (($sales_values/$total)) ;
                                                $existing_target_per_product = $target_percentage*$existing_products_sales_targets;
                                                $total_existing_targets += $existing_target_per_product;
                                            ?>
                                            <td class="text-center">{{ number_format ($existing_target_per_product)}}</td>
                                            <td class="text-center">{{ number_format ($target_percentage*100, 1). ' %'}}</td>
                                            <input type="hidden" name="sales_targets_percentages[{{$product_data['item']}}]" value="{{$target_percentage}}">


                                            <td class="text-center">
                                                <input type="number" name="modify_sales_target[{{$product_data['item']}}][value]" placeholder="{{__('Value')}}" class="modify_sales_target form-control" value="{{@$modified_targets['products_modified_targets'][$product_data['item']]['value']}}">
                                            </td>
                                            @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                                <td class="text-center">
                                                    <input type="number" name="modify_sales_target[{{$product_data['item']}}][percentage]" placeholder="{{__('%')}}" class="modify_sales_target_percentage form-control" value="{{($modified_targets['products_modified_targets'][$product_data['item']]['percentage'])?? (old('modify_sales_target')[$product_data['item']]['percentage']??0)}}">
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <tr class="table-active text-center">
                                        <th >{{__('Total')}}</th>
                                        <td>{{number_format($total)}}</td>
                                        <td>{{number_format($total_existing_targets)}}</td>
                                        <td>100 %</td>
                                        <td id="total_modify_sales_target">{{!isset($modified_targets['products_modified_targets'])  ? 0 :  number_format((array_sum(array_column($modified_targets['products_modified_targets'],'value') ?? [])))}}</td>
                                        @if ($sales_forecast->target_base !== 'new_start' || $sales_forecast->new_start !=='product_target')
                                            <td id="total_modify_sales_target_percentage">{{!isset($modified_targets['products_modified_targets'])  ? 0 :  number_format((array_sum(array_column($modified_targets['products_modified_targets'],'percentage') ?? [])))}}</td>
                                        @endif
                                    </tr>

                                @endslot
                            </x-table>

                        </div>
                    </div>

        @endif 


        <x-submitting />

    </form>
@endsection
@section('js')
    <script src="{{ url('assets/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/demo1/pages/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
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
        $('.products').on('change', function () {
            var name= $(this).find(':selected').data('name');
            var id= $(this).find(':selected').data('id');
            var index = $('.products').index(this);
            $('.categories option').eq(index).remove();
            select = '<option value="'+id+'" selected>'+name +'</option>';
            $('.categories').eq(index).append(select);
        });


        $('.modify_sales_target').on('change', function () {
            var index = $('.modify_sales_target').index(this);
            var modify_sales_target = parseFloat($(this).val());
            var percentage = (modify_sales_target/parseFloat("{{$existing_products_sales_targets}}"))*100;
            $('.modify_sales_target_percentage').eq(index).val(percentage.toFixed(2));
            totalFunction('.modify_sales_target','#total_modify_sales_target',0);
            totalFunction('.modify_sales_target_percentage','#total_modify_sales_target_percentage',2);
        });
        $('.modify_sales_target_percentage').on('change', function () {
            var index = $('.modify_sales_target_percentage').index(this);
            var modify_sales_target_percentage = parseFloat($(this).val()) /100;
            var value = (modify_sales_target_percentage*parseFloat("{{$existing_products_sales_targets}}")) ;
            $('.modify_sales_target').eq(index).val(value.toFixed(0));
            totalFunction('.modify_sales_target_percentage','#total_modify_sales_target_percentage',2);
            totalFunction('.modify_sales_target','#total_modify_sales_target',0);

        });



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
        function totalFunction(field_name,total_field_name,decimals) {
            total = 0;
            $(field_name).each(function(index, element) {

                if (element.value !== '') {
                    total = parseFloat(element.value) + total;
                }

            });
            $(total_field_name).html(total.toFixed(decimals));
        }
    </script>

@endsection
