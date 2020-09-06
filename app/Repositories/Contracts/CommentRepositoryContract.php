<?php

namespace App\Repositories\Contracts;

interface CommentRepositoryContract
{
    public function submitComment(array $data);
}