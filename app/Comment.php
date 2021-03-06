<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    /**
     * Relationship declarations
     */
    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Helpers
     */

    public function replies() {
        return Comment::where('parent_id', $this->id)->get();
    }
}
