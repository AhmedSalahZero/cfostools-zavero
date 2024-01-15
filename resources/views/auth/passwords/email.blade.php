
@extends('layouts.LoginDashboard')
@section('content')
<div class="row">

    <div class="col-md-6" id="LoginForm">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="clearfix"></div>

        <div class="intro-banner-search-form margin-top-49" style="background-color:none">
            <form class="login100-form validate-form flex-sb flex-w" method="POST"
                action="{{ route('password.email') }}">
                <div class="row col-md-12 text-center">
                    <h1>{{ __('Reset Password') }}</h1>
                </div>
                <!-- Search Field -->
                {{ csrf_field() }}

                <div class="intro-search-field with-autocomplete">
                    <div class="input-with-icon">
                        <input class="input100  @error('email') is-invalid @enderror" style="color:white" type="email" name="email"
                            placeholder="Username" value="" required="" />
                        <i class="icon-material-outline-location-on"></i>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="clearfix"></div>


                <div class="clearfix"></div>

                <!-- Button -->
                <div style="width: 100%;">
                    <div>
                        <button type="submit" style="color:white;" class="btn btn-link"><b>{{ __('Send Password Reset Link') }}</b></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection



























{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
