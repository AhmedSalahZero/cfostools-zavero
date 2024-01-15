@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title  text-primary">
                        {{__('Tool Tip Data For').' [ '.@$toolTipData->model_name.' - '.@$toolTipData->field.' ] '}}
                    </h3>
                </div>
            </div>
        </div>
            <!--begin::Form-->
            <form class="kt-form kt-form--label-right" method="POST" action= {{route('toolTipData.update',$toolTipData->id)}} enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="form-group row section">
                            @foreach ($langs as  $lang_row)
                            <div class="col-md-12">
                                <label for="exampleInputsubject1">{{__('Data In')}} {{$lang_row->name}}</label>
                                <textarea class="form-control @error('data.'.$lang_row->code) is-invalid @enderror" name="data[{{$lang_row->code}}]">{!! @$toolTipData->data[$lang_row->code] !!}</textarea>
                                @error('data.'.$lang_row->code)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @endforeach
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
<script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
    <!--begin::Page Scripts(used by this page) -->
    <script>
        var langs_array = @JSON($langs);

        $.each(langs_array, function (index, language) {

            var name = "data["+language.code+"]";
            CKEDITOR.replace(name);
        });

    </script>
    <!--end::Page Scripts -->
@endsection
