@extends('layouts.app')

@section('content')
    <h1>Add New Post</h1>
    <div class="c-form-container">
        <div class="l-edit_profile">
            <form class="l-edit_profile-form" action="/p" method="POST" enctype="multipart/form-data">
                @csrf
    
                <div class="l-form_row">
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="description">{{ __('Post Description') }}</label>
                        <input id="description" type="text" class="@error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description">
                    </div>
                </div>
    
                <div class="l-form_row">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="l-row_input">
                        <label for="image">{{ __('Image') }}</label>
                        <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image">
                    </div>
                </div>
    
                <div class="l-form_row">            
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit Post') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

