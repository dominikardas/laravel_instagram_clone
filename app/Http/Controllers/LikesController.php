<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class LikesController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function store($id) {
    
        $post = Post::findOrFail($id);
        $date = strtotime($post->created_at);
        $published = date('d. m. Y', $date);

        $data = array(
            'action' => auth()->user()->likePost($id),
            'likes' => $post->likes()->count(),
            'published' => $published
        );

        return $data; //auth()->user()->likePost($id);
    }
}
