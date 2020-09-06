<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Post;

use App\Http\Controllers\Controller;

use App\Helpers\ResponseHelper;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Api\EditProfileRequest;

use App\Http\Resources\ProfileResource;
use App\Http\Resources\PostsResource;

use App\Services\ProfileService;

class ProfilesController extends Controller
{    
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Return profile by given ID
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfileById(Request $request, $id)
    {
        $profile = $this->profileService->getProfileById($id);

        if ($profile) {
            $resource = new ProfileResource($profile);
            return ResponseHelper::success($resource);
        }

        return ResponseHelper::failure(null, 'No Profile with ID ' . $id, 404);
    }

    /**
     * Return posts by given profile ID
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPostsByProfileId(Request $request, $id)
    {
        $profile = $this->profileService->getProfileById($id);
        
        if ($profile) {
            $resource = new PostsResource($profile->user->posts);
            return ResponseHelper::success($resource);
        }

        return ResponseHelper::failure(null, 'Error', 404);
    }

    /**
     * Follow profile by given profile ID
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function followProfile($id)
    {
        return $this->profileService->followProfile($id) ? ResponseHelper::success() : ResponseHelper::failure();
    }
    
    /**
     * Edit profile of authorized user
     *
     * @param EditProfileRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(EditProfileRequest $request, $id) {        
        
        // Check if the user is authenticated to edit this profile
        if (Auth::user()->id != $request->id) {
            return ResponseHelper::failure(null, 'Unauthorized', 401);
        }

        $edit = $this->profileService->editProfile($request->all(), $request->id);
        return $edit ? ResponseHelper::success() : ResponseHelper::failure();
    }
}
