@extends('layouts.LoginDashboard')
@section('content')

<div class="row">
    <div class="col-md-6" id="LoginForm">
        @if ($errors->any())
            <div class="alert alert-danger errorMessage">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="clearfix"></div>
        {{-- <div class="float-right" >
            <a href="{{route('free.user.subscription')}}" class="btn "  style="margin: 19px;color: #fff;background-color: #1a5798;border-color: #007bff;">{{__("Free Trail")}}</a>
        </div> --}}
        <div class="intro-banner-search-form margin-top-49" style="background-color:none">
            <form class="login100-form validate-form flex-sb flex-w" method="POST"
            action="{{ route('login') }}">
            <!-- Search Field -->
            {{ csrf_field() }}

                <div class="intro-search-field with-autocomplete">
                    <div class="input-with-icon">
                        <input class="input100" style="color:white" type="email" name="email"
                            placeholder="Username" value="" required="" />
                        <i class="icon-material-outline-location-on"></i>
                    </div>
                </div>
                <div class="clearfix"></div>

                <!-- Search Field -->
                <div class="intro-search-field">
                    <input class="input100" style="color:white" type="password" name="password"
                        placeholder="Password" value="" required="" />
                </div>
                <div class="clearfix"></div>

                <!-- Button -->
                <div style="width: 100%;">
                    <div style="float:left">
                        <button type="submit" style="color:white;" class="btn btn-link"><b>Let's
                                GO</b></button>
                    </div>
                    {{-- <div style="float:right">
                        <a type="submit"
                            style="color:white;font-family:  nunito,helveticaneue,helvetica neue,Helvetica,Arial,sans-serif"
                            href="{{ route('password.request') }}" class="btn btn-link"><b> Forget
                                Password / Change Password</b></a>
                    </div> --}}
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
