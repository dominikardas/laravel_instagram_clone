<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->collection->transform(function($comment){
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'username' => $comment->user->username,
                    'profileImage' => $comment->user->profile->image,
                ];
            })
        ];
    }
}
