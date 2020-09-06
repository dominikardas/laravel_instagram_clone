<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Post;
use App\User;

use App\Repositories\Contracts\PostRepositoryContract;

class PostRepository implements PostRepositoryContract
{
    public function createNewPost(array $data)
    {
        try {
            $newPost = new Post();
            $newPost->fill($data);
            $newPost->save();

            return $newPost;
        }
        catch (\Exception $e) { return false; } // $e->getMessage();
    }

    public function getPostById(int $id)
    {
        try {
            $post = Post::findOrFail($id);
            return $post;
        }
        catch (\Exception $e) { return false; }
    }

    public function getPostCreator(int $id)
    {
        try {    
            $post = Post::findOrFail($id);
            $user = User::with('profile')->where('id', $post->user_id)->get();

            return $user;
        }
        catch (\Exception $e) { return false; }
    }

    public function getPostsOfFollowedUsers() 
    {
        try {
            // Get the profiles the authenticated user is following
            $users = Auth::user()->following()->pluck('profiles.user_id');
            // Get their posts
            $posts = Post::whereIn('user_id', $users)->latest()->get();
            return $posts;
        }
        catch (\Exception $e) { return false; }
    }
}