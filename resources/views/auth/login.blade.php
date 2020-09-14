@extends('layouts.auth')

@section('content')
    <h1>vue</h1>
        <login-form></login-form>
    <h1>blade</h1>
    <div class="c-form-container c-form-auth-container">
        <div class="l-form-header">
            Login
        </div>
        <form class="l-auth-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="l-form_row">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail address" required autocomplete="email" autofocus>
            </div>

            <div class="l-form_row">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
            </div>

            <div class="l-form_row">            
                <button type="submit" class="btn btn-primary">
                    {{ __('Log In') }}
                </button>
                <span class="line-through">OR</span>
                <a class="btn btn-link center" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            </div>

            {{-- <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div> --}}
        </form>
    </div>
    <div class="c-form-container c-form-auth-container">
        <span>Don't have an account? <a class="link" href="/register">Sign up</a></span>
    </div>
@endsection
