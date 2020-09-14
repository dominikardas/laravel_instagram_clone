<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'post' => [
                'id'          => $this->id,
                'description' => $this->description,
                'image'       => $this->image,
                'likes'       => $this->likes()->count(),
                'created_at'  => $this->created_at
            ],
            'comments'        => new CommentsResource($this->comments),
            'author'          => new UserResource($this->user), //ProfileResource($this->user->profile),
            'isLiked'         => Auth::guard('api')->user() ? Auth::guard('api')->user()->isLikedPost($this->id, true) : false,
            'isFollowingUser' => Auth::guard('api')->user() ? Auth::guard('api')->user()->follows($this->user->profile->id, true) : false,
            // 'isOwner'   => $this->user_id == Auth::guard('api')->user()->id
        ];
    }
}
