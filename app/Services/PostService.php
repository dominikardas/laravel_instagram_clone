<?php

namespace App\Services;

use App\Post;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\PostRepositoryContract;


class PostService
{
    protected $postRepositoryContract;

    public function __construct(PostRepositoryContract $postRepositoryContract)
    {
        $this->postRepositoryContract = $postRepositoryContract;
    }

    public function createNewPost(array $data)
    {
        $newData = [
            'user_id'     => Auth::user()->id,
            'description' => $data['description'],
            'image'       => 'posts/SN3Z3KbZ10olN7K3kWWasNJQs6Ykm4aVMVdi65wz.jpeg' // TODO: replace later
        ];

        return $this->postRepositoryContract->createNewPost($newData);
    }

    public function getUsersPosts()
    {
        return Auth::user()->posts;
    }

    public function getPostsOfFollowedUsers()
    {
        return $this->postRepositoryContract->getPostsOfFollowedUsers();
    }

    public function likePost(int $postId)
    {
        return Auth::user()->likePost($postId);
    }

    public function getPostById(int $id)
    {
        return $this->postRepositoryContract->getPostById($id);
    }

    public function getPostCreator(int $id) 
    {
        return $this->postRepositoryContract->getPostCreator($id);
    }
}