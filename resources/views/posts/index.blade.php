@extends('layouts.app')

@section('content')
    @guest
        <div class="l-index_login">
            Welcome
        </div>
    @else
        @if (count($posts) > 0)
                @foreach($posts as $post)
                    <div class="c-post-container c-post-container-index">
                        <div class="l-post-author">
                            <span class="l-author-image">
                                <img class="rounded-circle" src="{{ $post->user->profile->profileImage() }}" alt="">
                            </span>
                            <span class="dot-separator"></span>
                            <span class="l-author-username">
                                <a href="/profile/{{ $post->user->id }}"><b>{{ $post->user->username }}</b></a>
                            </span>
                            <span class="dot-separator"></span>
                            @auth
                                <follow-button class="link" user-id="{{ $post->user->id }}" follows="{{ auth()->user()->follows($post->user->id) }}"></follow-button>
                            @endauth
                        </div>
                        <div class="l-post-image">
                            <span><img src="{{ $post->postImage() }}" alt=""></span>
                        </div>
                        <div class="l-post-desc">
                            <div class="l-post-description">
                                <span>{{ $post->caption }}</span>
                                <span>{{ $post->description }}</span>
                            </div>
                            <span class="line-separator"></span>
                            <div class="l-post-footer">
                                <div class="l-post-options">
                                    <div>
                                        <span class="icon-liked" title="Like Post"></span>
                                        {{-- <span class="icon-comment"></span>
                                        <span class="icon-favorite"></span> --}}
                                    </div>
                                    @can('update', $post->user->profile)
                                        <div>
                                            <span class="icon-delete" title="Delete Post"></span>
                                        </div>
                                    @endcan
                                </div>
                                <div class="l-post-info">
                                    <span><b>10 likes</b></span>
                                    <span>19 hours ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
        @else
            <p><b>No posts</b></p>
        @endif
    @endguest
@endsection