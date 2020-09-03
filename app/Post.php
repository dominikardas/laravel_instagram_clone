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

    /**
     * Helpers
     */
    public function postImage() {
        return '/storage/' . ($this->image ? $this->image : 'posts/NotFound.png');
    }
}
