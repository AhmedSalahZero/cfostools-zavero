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
            <?php $user_row = isset($user) ? $user : old(); ?>

            <form class="kt-form kt-form--label-right" method="POST" action= {{isset($user) ? route('user.update',$user): route('user.store')}} enctype="multipart/form-data">
                @csrf
                {{isset($user) ?  method_field('PUT'): ""}}
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="form-group row col-12 col-12">
                            <div class="col-12">
                                <label>{{__('Name')}} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <input type="text" name="name" value="{{@$user_row['name']}}" class="form-control" placeholder="{{__('Name')}}" required>
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
                                {{__('User Information')}}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group row col-12">
                            <div class="col-6">
                                <label>{{__('Email')}} <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                                    <input type="email" name="email" value="{{@$user_row['email']}}" class="form-control" placeholder="{{__('Email')}}" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-6">
                                <label>{{__('User Image')}} <span class="required">*</span></label>
                                <div class="kt-input-icon">
                                    <input type="file" class="form-control" name="avatar" >
                                    <x-tool-tip title="{{__('Kash Vero')}}"/>
                                </div>
                            </div>
                        </div>
                        @if(!isset($user))
                        <div class="form-group row col-12">
                            <div class="col-6">
                                <label>{{__('Password')}} <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                                    <input id="password" type="password" name="password"  value="{{@$user_row['email']}}" class="form-control" placeholder="{{__('Password')}}" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-6">
                                <label>{{__('Confirm Password')}} <span class="required">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-key"></i></span></div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('Password')}}" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>


                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title head-title text-primary">
                                {{__('Assign Companies To This User')}}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group row col-12">

                            <div class="col-6">
                                <label>{{__('Select Companies - (Multi Selection)')}} </label>
                                <select name="companies[]" class="form-control kt-selectpicker" multiple>
                                    <?php $selectedcompanies = isset($user) ?  $user->companies->pluck('id')->toArray() : []; ?>
                                    @foreach ($companies as $item)
                                        <option {{ old('companies') == $item->id || in_array($item->id, $selectedcompanies) ? 'selected' : ''}}  value="{{$item->id}}">{{$item->name[$lang]}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-6">
                                <label>{{__('Role')}} </label>
                                <select name="role" class="form-control kt-selectpicker"  >
                                    <option value="">{{__('Select')}}</option>
                                    <option {{ (isset($user) && $user->hasRole('super-admin')) ? 'selected' : ''}}  value="super-admin">{{__("Super Admin")}}</option>
                                    <option {{ (isset($user) && $user->hasRole('Admin') )? 'selected' : ''}}  value="Admin">{{__("Admin")}}</option>

                                </select>

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
    <!--end::Page Scripts -->
@endsection
