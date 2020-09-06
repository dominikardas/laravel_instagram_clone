<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

use App\Helpers\ResponseHelper;

use Illuminate\Http\Request;
use App\Http\Requests\Api\SubmitPostRequest;

use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;

use App\Services\PostService;

class PostsController extends Controller
{

    protected $postService;

    public function __construct(PostService $postService) 
    {
        $this->postService = $postService;
    }

    /**
     * Create and store a new post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SubmitPostRequest $request)
    {
        $data = $this->postService->createNewPost($request->all());
        return ResponseHelper::success($data);
    }

    /**
     * Return a post by given ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = $this->postService->getPostById($id);

        if ($post) {
            $resource = new PostResource($post);
            return ResponseHelper::success($resource);
        }

        return ResponseHelper::failure();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Get posts of authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersPosts()
    {
        $posts = $this->postService->getUsersPosts();

        if ($posts) {
            $resource = new PostsResource($posts);
            return ResponseHelper::success($resource);
        }        

        return ResponseHelper::failure();
    }

    /**
     * Get posts of followed users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsOfFollowedUsers()
    {
        $posts = $this->postService->getPostsOfFollowedUsers();

        if ($posts) {
            $resource = new PostsResource($posts);
            return ResponseHelper::success($resource);
        }        

        return ResponseHelper::failure();
    }

    /**
     * Like a post with given id
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function likePost($id)
    {
        return $this->postService->likePost($id) ? ResponseHelper::success() : ResponseHelper::failure();
    }
}
