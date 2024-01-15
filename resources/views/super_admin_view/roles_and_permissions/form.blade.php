@extends('layouts.dashboard')
@section('css')
    <link href="{{url('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title head-title text-primary">
                        {{__(isset($roles) ?'Edit Section' : 'Create Section')}}
                    </h3>
                </div>
            </div>
        </div>
            <!--begin::Form-->
            <?php $roles_row = isset($roles) ? $roles : old(); ?>
            <form class="kt-form kt-form--label-right" method="POST" action= {{isset($role) ? route('roles.permissions.update',[$scope,$role]): route('roles.permissions.store',$scope)}} enctype="multipart/form-data">
                @csrf
                {{isset($role) ?  method_field('PUT'): ""}}
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="form-group row section">

                                <div class="col-md-12">
                                    <label>{{__('Role Name')}} <span class="required">*</span></label>
                                    <div class="kt-input-icon">
                                        <input type="text" name="role" value="{{isset($role) ? $role->name : old('name')}}" class="form-control" placeholder="{{__('Role Name')}}" required>
                                        <x-tool-tip title="{{__('Kash Vero')}}"/>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>

                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Section Information')}}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group-marginless">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-12 " >
                                        <label class="kt-option bg-secondary">
                                            <span class="kt-option__control">
                                                <span
                                                    class="kt-checkbox kt-checkbox--bold kt-checkbox--brand kt-checkbox--check-bold"
                                                    checked>
                                                    <input type="checkbox" id="select_all"  >
                                                    <span></span>
                                                </span>
                                            </span>
                                            <span class="kt-option__label">
                                                <span class="kt-option__head">
                                                    <span class="kt-option__title"><b> {{ __('Select All') }} </b> </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @foreach ($sections as $item)
                                <?php $route_name = $item->route_name ; ?>
                                @if ($item->route !== null)
                                    <div class="form-group kt-checkbox-list">
                                        <div class="row col-md-12">
                                            <label class="col-3 col-form-label text-left"><b> {{$item->name['en']}} </b></label>
                                            <div class="col-9">
                                                <div class="kt-checkbox-inline d-flex justify-content-between">
                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success" cheched="">
                                                        <input type="checkbox" class="view" value="1" name="permissions[{{$route_name.'.view'}}]"
                                                        {{isset($role) && $role->hasPermissionTo($route_name.'.view') ? 'checked' : ''}}
                                                        > {{__('View')}}
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                                        <input type="checkbox" class="create" value="1" name="permissions[{{$route_name.'.create'}}]"
                                                        {{isset($role) && $role->hasPermissionTo($route_name.'.create') ? 'checked' : ''}}
                                                        > {{__('Create')}}
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                                        <input type="checkbox" class="edit"  value="1"name="permissions[{{$route_name.'.edit'}}]"
                                                        {{isset($role) && $role->hasPermissionTo($route_name.'.edit') ? 'checked' : ''}}
                                                        > {{__('Edit')}}
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                                        <input type="checkbox" class="delete" value="1" name="permissions[{{$route_name.'.delete'}}]"
                                                        {{isset($role) && $role->hasPermissionTo($route_name.'.delete') ? 'checked' : ''}}
                                                        > {{__('Delete')}}
                                                        <span></span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
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
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{url('assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/demo1/pages/crud/forms/widgets/bootstrap-select.js')}}" type="text/javascript"></script>
    <!--end::Page Scripts -->
    <script>
        $('#select_all').change(function(e) {
            if ($(this).prop("checked")) {
                $('.view').prop("checked", true);
                $('.create').prop("checked", true);
                $('.edit').prop("checked", true);
                $('.delete').prop("checked", true);
            } else {
                $('.view').prop("checked", false);
                $('.create').prop("checked", false);
                $('.edit').prop("checked", false);
                $('.delete').prop("checked", false);
            }
        });
    </script>
@endsection
