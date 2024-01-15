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
    <form action="{{ route('products.create', $company) }}" method="POST">
        @csrf
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{ __('Sales Forecast') }}
                    </h3>
                </div>
            </div>

        </div>








        <div class="kt-portlet kt-portlet--mobile">

            <div class="kt-portlet__body">
                @for ($number = 1; $number <= $sales_forecast->number_of_products; $number++)
                    <div class="row">
                        <div class="col-md-6" >
                            <label> <b> {{ __('Product Name') . ' ' .$number }} </b><span class="required">*</span></label>
                            <div class="kt-input-icon">
                                <div class="input-group">
                                    <input type="text" step="any" class="form-control" placeholder="{{__("Insert Name")}}" name="product_name[]" value="{{@$products[$number-1]['name']}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label><b>{{ __('Category') }} </b><span class="required">*</span></label>
                            <div class="kt-input-icon">
                                <div class="input-group date">
                                    <select name="category[]" class="form-control" >
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{($products[$number-1]->category->id ?? 0) == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endfor
            </div>
        </div>

        <div class="kt-portlet">
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-6">
                            {{-- <button type="submit" class="btn btn-primary">Save</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button> --}}
                        </div>
                        <div class="col-lg-6 kt-align-right">
                            <input type="submit" class="btn active-style" name="submit" value="{{__('Save')}}" >
                            <input type="submit" class="btn btn-danger " name="submit" value="{{__('Skip')}}" >
                        </div>
                    </div>
                </div>
            </div>
        </div>

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


@endsection
