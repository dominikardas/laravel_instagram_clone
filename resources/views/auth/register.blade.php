@extends('layouts.auth')

@section('content')
    <h1>vue</h1>
    <register-form></register-form>
    <h1>blade</h1>
    <div class="c-form-container c-form-auth-container">
        <div class="l-form-header">
            Sign Up
        </div>
        <form class="l-auth-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="l-form_row">
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="username" type="text" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="username" autofocus>
            </div>

            <div class="l-form_row">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name">
            </div>
            
            <div class="l-form_row">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail address" required autocomplete="email"> 
            </div>
            
            <div class="l-form_row">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
            </div>
            
            <div class="l-form_row">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
            </div>

            <div class="l-form_row">            
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
    <div class="c-form-container c-form-auth-container">
        <span>Have an account? <a class="link" href="/login">Log in</a></span>
    </div>
@endsection
