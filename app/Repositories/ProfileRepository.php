<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

use App\Profile;
use App\Repositories\Contracts\ProfileRepositoryContract;

class ProfileRepository implements ProfileRepositoryContract
{
    public function getProfileById(int $id)
    {
        try                   { return Profile::findOrFail($id); }
        catch (\Exception $e) { return false; }
    }
    
    public function getPostsByProfileId(int $id)
    {    
        try {
            $user_id = Profile::findOrFail($id)->user_id;
            $posts   = \App\Post::where('user_id', $user_id)->latest()->get(); 
            return $posts;
        }
        catch (\Exception $e) { return false; }
    }

    public function followProfile(int $id)
    {
        try {
            $user = \App\User::findOrFail($id);
            return Auth::user()->following()->toggle($user->profile);
        }
        catch (\Exception $e) { return false; }
    }

    public function editProfile(array $data, int $id)
    {
        try {
            $profile = Profile::findOrFail($id);
            return $profile->update($data);
        }
        catch (\Exception $e) { return false; }
    }
}