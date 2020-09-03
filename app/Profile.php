<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
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
    public function profileImage() {
        return $this->image ? $this->image : '/storage/profiles/NotFound.png';
    }
}
