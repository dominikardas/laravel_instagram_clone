<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\CommentRepositoryContract;

class CommentService
{
    protected $commentRepositoryContract;

    public function __construct(CommentRepositoryContract $commentRepositoryContract)
    {
        $this->commentRepositoryContract = $commentRepositoryContract;
    }

    public function submitComment(array $data, $id)
    {
        $data = [
            'user_id'   => Auth::user()->id,
            'post_id'   => $id,
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : null,
            'content'   => $data['comment']
        ];

        return $this->commentRepositoryContract->submitComment($data);
    }
}