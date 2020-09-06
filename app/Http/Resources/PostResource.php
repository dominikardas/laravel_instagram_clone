<?php

namespace App\Http\Resources;

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
                'description' => $this->description,
                'image'       => $this->image,
                'likes'       => $this->likes()->count(),
                'created_at'  => $this->created_at
            ],
            'comments'  => new CommentsResource($this->comments),
            'creator'   => new UserResource($this->user) //ProfileResource($this->user->profile)
        ];
    }
}
