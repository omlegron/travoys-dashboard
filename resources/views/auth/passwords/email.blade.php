@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.email') }}" class="form-signin">
    @csrf

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="mb-5">
        <span class="text-muted">Please enter your email <br>to reset password.</span>
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

    <button class="btn btn-lg btn-primary btn-login" type="submit">{{ __('Send Password Reset Link') }}</button>

    <div class="footer py-3 w-50 text-left">
        @if (Route::has('password.request'))
            <a class="text-muted" href="{{ route('login') }}">
                {{ __('Login to another account?') }}
            </a>
        @endif
    </div>
</form>
@endsection
