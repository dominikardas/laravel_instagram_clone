<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;

use App\Helpers\ResponseHelper;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Requests\Api\RegisterUserRequest;

use App\Services\UserService;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }    
    
    /**
     * Register a user
     * 
     * @param RegisterUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUserRequest $request)
    {    
        $user  = $this->userService->registerUser($request->all());
        $token = $user->createToken('token')->accessToken;

        $data = array(
            'user'         => $user,
            'access_token' => $token,
            'success'      => true,
        );

        return ResponseHelper::success($data);
    }
    
    /**
     * Login a user
     *
     * @param LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        $user = $this->userService->loginUser($request->all());

        if ($user) {
            $token = $user->createToken('token')->accessToken;

            $data = array(
                'user'         => $user,
                'access_token' => $token
            );

            return ResponseHelper::success($data);
        }

        return ResponseHelper::failure(null, 'Unauthorized', 401);
    }

    /**
     * Get authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function currentUser()
    {
        return ResponseHelper::success($this->userService->getAuthUser());
    }
}
