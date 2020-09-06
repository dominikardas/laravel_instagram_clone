<?php

namespace App\Repositories\Contracts;

interface ProfileRepositoryContract
{
    public function getProfileById(int $id);
    public function getPostsByProfileId(int $id);
    public function followProfile(int $id);
    public function editProfile(array $data, int $id);
}