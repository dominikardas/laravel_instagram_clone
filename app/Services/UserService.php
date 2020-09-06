<?php

namespace App\Services;

use App\User;
use App\Post;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\UserRepositoryContract;


class UserService
{
    protected $userRepositoryContract;

    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->userRepositoryContract = $userRepositoryContract;
    }

    public function registerUser(array $data)
    {
        $userData = [
            'username' => $data['username'],
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password'])
        ];

        return $this->userRepositoryContract->registerUser($userData);
    }

    public function loginUser(array $data)
    {
        if (Auth::attempt([
            'email'     => $data['email'],
            'password'  => $data['password']
        ]))
        {
            $user = Auth::user();
            return $user;
        }

        return false; 
    }

    public function getAuthUser() {
        return Auth::user();
    }
}