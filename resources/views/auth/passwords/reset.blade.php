@extends('layouts.auth')

@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="form-signin">
        @csrf

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-5">
            <span class="text-muted">Please enter your email and new password <br>to login.</span>
        </div>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-label-group my-5">
            <input type="email" id="inputEmail" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ $email ?? old('email') }}" required autofocus>

            <label for="inputEmail">{{ __('E-Mail Address') }}</label>

            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-label-group my-5">
            <input type="password" id="inputPassword" name="password" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}" required>

            <label for="inputPassword">{{ __('Password') }}</label>

            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-label-group my-5">
            <input type="password" id="inputPasswordConfirm" name="password_confirmation" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}" value="{{ old('password_confirmation') }}" required>

            <label for="inputPasswordConfirm">{{ __('Confirm Password') }}</label>

            @if ($errors->has('password_confirmation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <button class="btn btn-lg btn-primary btn-login" type="submit">{{ __('Reset Password') }}</button>

        <div class="footer py-3 w-50 text-left">
            @if (Route::has('password.request'))
                <a class="text-muted" href="{{ route('login') }}">
                    {{ __('Login to another account?') }}
                </a>
            @endif
        </div>
    </form>
@endsection
