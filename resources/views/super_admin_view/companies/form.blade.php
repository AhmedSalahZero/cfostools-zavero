@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
<div class="row">
    <div class="col-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{__('SECTIONS')}}
                    </h3>
                </div>
            </div>
        </div>
            <!--begin::Form-->
            <?php $row = isset($companySection) ? $companySection : old(); ?>

            <form class="kt-form kt-form--label-right" method="POST"
            action=@if (isset($company_row))
                    @if (isset($companySection) )
                        {{ route('edit.admin.company',[$company_row,$companySection])}}
                    @else
                        {{ route('admin.company',$company_row)}}
                    @endif
                @elseif (isset($companySection) )
                    {{route('companySection.update',$companySection)}}
                @else
                    {{route('companySection.store')}}
                @endif
                 enctype="multipart/form-data">
                @csrf
                {{isset($companySection) ?  method_field('PUT'): ""}}
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="form-group row col-12">
                            @foreach ($langs as $lang_row)
                                <div class="col-6">
                                    <label>{{__('Company Name ') . $lang_row->name}} <span class="required">*</span></label>
                                    <div class="kt-input-icon">
                                        <input type="text" name="name[{{$lang_row->code}}]" value="{{@$row['name'][$lang_row->code]}}" class="form-control" placeholder="{{__('Company Name ') . $lang_row->name}}" required>
                                        <x-tool-tip title="{{__('Kash Vero')}}"/>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Company Information')}}
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body">

                        <div class="form-group row col-12">

                            <div class="col-12">
                                <label>{{__('Company Image')}} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <input type="file" class="form-control" name="image" >
                                    <x-tool-tip title="{{__('Kash Vero')}}"/>
                                </div>
                            </div>
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
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <script>
        $('.company_type').change(function () {
            val = $(this).val();
            if (val == 'single') {
                $('#num_of_companies').addClass('hidden');
                $('.num_of_companies').val('');
            } else {
                $('#num_of_companies').removeClass('hidden');
            }
        });
    </script>
    <!--end::Page Scripts -->
@endsection
