<?php

namespace App\Repositories;

use App\Comment;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\CommentRepositoryContract;

class CommentRepository implements CommentRepositoryContract
{
    public function submitComment(array $data)
    {
        try {
            $newComment = new Comment();
            $newComment->fill($data);
            $newComment->save();

            return true;
        }
        catch (\Exception $e) { dd($e->getMessage()); return false; }
    }

}