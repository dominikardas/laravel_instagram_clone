<?php

namespace App\Repositories\Contracts;

interface PostRepositoryContract
{
    public function createNewPost(array $data);
    public function getPostById(int $id);
    public function getPostCreator(int $id);
    public function getPostsOfFollowedUsers();
}