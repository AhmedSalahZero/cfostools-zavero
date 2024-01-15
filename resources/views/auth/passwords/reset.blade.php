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
            <div class="intro-banner-search-form margin-top-49" style="background-color:none">
                <form class="login100-form validate-form flex-sb flex-w" method="POST"
                    action="{{ route('password.update') }}">
                    <div class="row col-md-12 text-center">
                        <h1>{{ __('Reset Password') }}</h1>
                    </div>
                    <!-- Search Field -->
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="intro-search-field with-autocomplete">
                        <div class="input-with-icon">
                            <input class="input100 @error('email') is-invalid @enderror" style="color:white" type="email"
                                name="email" placeholder="Username" value=" {{ $email ?? old('email') }}" required />
                            <i class="icon-material-outline-location-on"></i>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <!-- Search Field -->
                    <div class="intro-search-field">
                        <input class="input100 @error('password') is-invalid @enderror" style=" color:white"
                            type="password" name="password" placeholder="Password" value="" required="" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="clearfix"></div>
                    <!-- Search Field -->
                    <div class="intro-search-field">
                        <input class="input100 " style=" color:white"
                            type="password"
                            id="password-confirm"
                            name="password_confirmation" placeholder="Confirm Password" value="" required="" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="clearfix"></div>

                    <!-- Button -->
                    <div style="width: 100%;">
                        <div>
                            <button type="submit" style="color:white;" class="btn btn-link"><b>{{ __('Reset Password') }}</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection












 