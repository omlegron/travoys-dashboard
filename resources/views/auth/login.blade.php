@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('login') }}" class="form-signin">
    @csrf
    <div class="mb-5">
        <span class="text-muted">Please enter your username and password <br>to login or register <a href="{{ route('register') }}">here</a>.</span>
    </div>

    <div class="form-label-group my-5">
        <input type="email" id="inputEmail" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>

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

    <div class="custom-control custom-checkbox mt-5 mb-4">
        <input type="checkbox" class="custom-control-input" name="remember" id="rememberMe" {{ old('remember') ? 'checked' : '' }}>
        <label class="custom-control-label" for="rememberMe">{{ __('Remember Me') }}</label>
    </div>
    <div class="custom-control custom-checkbox mt-5 mb-4" style="text-align: right;">
        <button class="btn btn-lg btn-primary btn-login" type="submit">{{ __('Login') }}</button>
    </div>

   {{--  <div class="footer py-3 w-50 text-left">
        @if (Route::has('password.request'))
            <a class="text-muted" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div> --}}
</form>
@endsection
