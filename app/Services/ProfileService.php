<?php

namespace App\Services;

use App\Post;
use App\Profile;

use Illuminate\Support\Facades\Auth;

use App\Repositories\Contracts\ProfileRepositoryContract;

class ProfileService
{
    protected $profileRepositoryContract;

    public function __construct(ProfileRepositoryContract $profileRepositoryContract)
    {
        $this->profileRepositoryContract = $profileRepositoryContract;
    }

    public function getProfileById(int $id)
    {
        return $this->profileRepositoryContract->getProfileById($id);
    }

    public function getPostsByProfileId(int $id)
    {
        return $this->profileRepositoryContract->getPostsByProfileId($id); // $posts;
    }

    public function followProfile(int $id)
    {
        return $this->profileRepositoryContract->followProfile($id);
    }

    public function editProfile(array $data, int $id)
    {
        return $this->profileRepositoryContract->editProfile($data, $id);
    }
}