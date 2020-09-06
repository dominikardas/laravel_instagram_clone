@extends('layouts.app')

@section('content')
    <div class="c-post-container">
        <div class="l-post-image">
            <span><img src="{{ $post->postImage() }}" alt=""></span>
        </div>
        <div class="l-post-desc">
            <div class="l-post-author">
                <span class="l-author-image">
                    <img class="l-profile-image__preview" src="{{ $post->user->profile->profileImage() }}" alt="">
                </span>
                <span class="dot-separator"></span>
                <span class="l-author-username">
                    <a href="/profile/{{ $post->user->id }}"><b>{{ $post->user->username }}</b></a>
                </span>
                @auth
                    <span class="dot-separator"></span>
                    <follow-button class="link" user-id="{{ $post->user->id }}" follows="{{ auth()->user()->follows($post->user->id) }}"></follow-button>
                @endauth
            </div>
            <span class="line-separator"></span>
            <div class="l-post-description">
                <span>{{ $post->description }}</span>
            </div>
            <span class="line-separator"></span>
            <div class="l-post-comments">
                @if(count($post->comments) > 0)
                    @foreach($post->comments as $comment)
                        <div class="l-post-comment">
                            <img src="{{ $comment->user->profile->image }}" alt="" class="l-profile-image__preview">
                            <div class="l-comment">
                                <div class="l-comment-content">
                                    <span><b>{{ $comment->user->username }}</b></span>
                                    <span>{{ $comment->content }}</span>
                                </div>
                                <div class="l-comment-actions">
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="l-post-comment">
                        <div class="l-comment">
                            <b><p style="text-align: center">No comments yet.<br>Be the first one to submit a comment!</p></b>
                        </div>
                    </div>
                @endif
            </div>
            <span class="line-separator"></span>
            <div class="l-post-likes">
                <div class="l-post-options">
                    <div>
                        @auth
                        <like-button post-id="{{ $post->id }}" liked="{{ auth()->user()->isLikedPost($post->id) }}"></like-button>
                        @endauth
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
                    <span><b>{{ $post->likes()->count() }} likes</b></span>
                    <span>{{ $post->created_at }}</span>
                </div>
            </div>
            <span class="line-separator"></span>
            <div class="l-post_new-comment">
                <form class="" method="POST" action="/comment/{{ $post-> id }}">
                    @csrf
                    {{-- <input id="parent_id" name="parent_id" type="hidden" value="3">  --}}
                    <input id="comment" name="comment" type="text" value="{{ old('comment') }}" placeholder="Add a comment..." required>
                    <button type="submit" class="hidden">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection