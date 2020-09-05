@extends('layouts.app')

@section('content')
    <h1>Edit Profile</h1>
    <div class="c-form-container">
        <div class="l-edit_profile">
            <div class="l-edit_profile-user">
                <img src="{{ $user->profile->image }}" alt="">
                <div class="l-user_info">
                    {{ $user->username }}
                    <a class="link" href="#">Change profile picture</a>
                </div>
            </div>
            <form class="l-edit_profile-form" method="POST" action="/profile/{{ $user->id }}">
                @csrf
                @method('PATCH')
    
                {{-- <div class="l-form_row">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="name" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name">
                    </div>
                </div>
    
                <div class="l-form_row">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="username">{{ __('Username') }}</label>
                        <input id="username" type="name" class="@error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}" autocomplete="username">
                    </div>
                </div> --}}

                <div class="l-form_row">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="title">{{ __('Post Title') }}</label>
                        <input id="title" type="text" class="@error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" autocomplete="title">
                    </div>
                </div>
    
                <div class="l-form_row">
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="description">{{ __('Description') }}</label>
                        <input id="description" type="text" class="@error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}" autocomplete="description">
                    </div>
                </div>
    
                <div class="l-form_row">
                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="url">{{ __('Website') }}</label>
                        <input id="url" type="text" class="@error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" autocomplete="url">
                    </div>
                </div>
    
                <div class="l-form_row">            
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection