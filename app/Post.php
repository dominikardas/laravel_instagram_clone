<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Relationship declarations
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->where('parent_id', NULL);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * Helpers
     */
    public function postImage() {
        return '/storage/' . ($this->image ? $this->image : 'posts/NotFound.png');
    }
}
