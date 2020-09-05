<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentsController extends Controller
{

    public function store(Request $request, $id) {
        
        $data = request()->validate([
            'comment' => ['required', 'string', 'max:200'],
        ]);

        $comment = new Comment();
        $comment->create([
            'user_id' => auth()->user()->id,
            'post_id' => $id,
            'content' => $data['comment']
        ]);

        return redirect('/p/' . $id);
    }

    public function storeResp(Request $request, $id) {
        
        $data = request()->validate([     
            'comment'   => ['required', 'string', 'max:200'],       
            'parent_id' => ['required', 'exists:comments,id']
        ]);

        $comment = new Comment();
        $comment->create([
            'user_id' => auth()->user()->id,
            'post_id' => $id,
            'parent_id' => $data['parent_id'],
            'content' => $data['comment']
        ]);
        
        return redirect('/p/' . $id);
    }
}
