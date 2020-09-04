<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship declerations
     */
    public function profile() {
        return $this->hasOne(Profile::class);
    }

    public function posts() {
        return $this->hasMany(Post::class)->latest();
    }

    public function following() {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();

        // Create a profile for the new user
        static::created(function ($user){
            $user->profile()->create();
        });
    }

    /**
     * Helpers
     */
    public function follows($id) {
        $user = User::findOrFail($id);
        return (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
    }
}
