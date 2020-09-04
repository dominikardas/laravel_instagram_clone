@extends('layouts.app')

@section('content')
    @guest
        <div class="l-index_login">
            Welcome
        </div>
    @else
        <div>You are logged in</div>
        User ID: {{ auth()->user()->profile->user_id }}
    @endguest
@endsection