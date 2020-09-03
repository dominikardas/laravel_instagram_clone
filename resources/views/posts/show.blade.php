@extends('layouts.app')

@section('content')
    <div class="c-post-container">
        <div class="l-post-image">
            <span><img src="{{ $post->postImage() }}" alt=""></span>
        </div>
        <div class="l-post-desc">
            <div class="l-post-author">
                <span class="l-author-image">
                    <img src="{{ $post->user->profile->profileImage() }}" alt="">
                </span>
                <span>&nbsp;&nbsp;•&nbsp;&nbsp;</span>
                <span class="l-author-username">
                    <a class="link" href="/profile/{{ $post->user->id }}">{{ $post->user->username }}</a>
                </span>
            </div>
            <div class="l-post-info">
                <span>{{ $post->caption }}</span>
                <span>{{ $post->description }}</span>
            </div>
            <div class="l-post-comments">
            </div>
        </div>
    </div>
@endsection