<?php

namespace App\Repositories;

use App\User;
use App\Repositories\Contracts\UserRepositoryContract;

class UserRepository implements UserRepositoryContract
{
    public function registerUser($data) {
        try {
            $newUser = new User();
            $newUser->fill($data);
            $newUser->save();
            $newUser->profile()->create(); // Create a profile for the new user

            return $newUser;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}