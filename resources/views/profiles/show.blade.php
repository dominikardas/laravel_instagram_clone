@extends('layouts.app')

@section('content')
    <div class="l-profile-header">
        <div class="l-profile-image">
            <img class="rounded-circle" src="{{ $user->profile->profileImage()}}">
        </div>
        <div class="l-profile-info">
            <div class="l-profile-name">
                <span>
                    {{ $user->username }}
                </span>
                <a class="btn btn-primary" href="#">Follow</a>
            </div>
            
            @can('update', $user->profile)
                <div class="l-profile-edit">
                    <a class="link" href="/profile/{{ Auth::user()->id }}/edit">
                        Edit Profile
                    </a>
                    <a class="link" href="/p/create">
                        Add New Post
                    </a>
                </div>
            @endcan
            <div class="l-profile-details">
                <span><b>23</b> posts</span>
                <span><b>0</b> followers</span>
                <span><b>0</b> following</span>
            </div>
            <div class="l-profile-description">
                <span><b>{{ $user->profile->title }}</b></span>
                <span>{{ $user->profile->description }}</span>
                <a class="link" target="_blank" href="{{ $user->profile->url }}">{{ $user->profile->url }}</a>
            </div>
        </div>
    </div> 
    @if (count($user->posts) > 0)
        <div class="l-profile-posts">
            @foreach($user->posts as $post)
                <div class="l-profile-post">
                    <div>
                        <a href="/p/{{ $post->id }}"><img src="{{ $post->postImage() }}"></a>
                    </div>                
                </div>
            @endforeach
        </div>
    @else
        <p><b>This user has no posts</b></p>
    @endif
@endsection