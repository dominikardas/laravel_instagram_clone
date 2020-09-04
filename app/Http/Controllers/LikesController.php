<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function store($id) {
    
        $data = array(
            'action' => auth()->user()->likePost($id),
            'likes' => \App\Post::findOrFail($id)->likes()->count()
        );

        return $data; //auth()->user()->likePost($id);
    }
}
