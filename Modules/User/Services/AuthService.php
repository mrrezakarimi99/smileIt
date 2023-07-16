<?php

namespace Modules\User\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Modules\Core\Services\CoreService;
use Modules\User\Http\Resources\Auth\AuthResource;
use Modules\User\Repositories\AuthRepository;

class AuthService extends CoreService
{
    public function __construct(AuthRepository $authRepository)
    {
        $this->repository = $authRepository;
        $this->modelName = 'User';
    }

    /**
     * @param $request
     * @return JsonResponse|AuthResource
     */
    public function login($request): JsonResponse|AuthResource
    {
        return $this->loginWithPassword($request);
    }

    /**
     * @param $request
     * @return JsonResponse|AuthResource
     */
    private function loginWithPassword($request): JsonResponse|AuthResource
    {
        $token = auth()->attempt($request->validated());
        if (!$token) {
            return $this->errorResponse([] , $this->generateMessage('login' , 'fail') , 401);
        }
        $user = auth()->user();
        $user = $this->generateTokenAndExpireAt($user , $token);
        return new AuthResource($user , $this->generateMessage('login'));
    }

    /**
     * @param $user
     * @param $token
     * @return mixed
     */
    private function generateTokenAndExpireAt($user , $token): mixed
    {
        $expires_in = auth()->factory()->getTTL() * 6000;
        $user->expires_in = Carbon::now()->addSeconds($expires_in)->toDateTimeString();
        $user->access_token = $token;
        return $user;
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        if (is_null(auth()->user())) {
            return $this->errorResponse([] , "User not found!" , 404);
        }
        auth()->logout();
        return $this->successResponse([] , "User successfully signed out");
    }

}
