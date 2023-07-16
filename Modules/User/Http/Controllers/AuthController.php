<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Modules\Core\Http\Controllers\CoreController;
use Modules\User\Http\Requests\Auth\LoginRequest;
use Modules\User\Http\Resources\Auth\AuthResource;
use Modules\User\Services\AuthService;
use OpenApi\Annotations as OA;

class AuthController extends CoreController
{
    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    /**
     * @OA\Post(
     *   path="/api/v1/auth/login",
     *   tags={"Auth"},
     *   summary="Login",
     *   operationId="login",
     *   @OA\RequestBody(
     *      required=true,
     *      description="Login",
     *      @OA\JsonContent(
     *          required={"username","password"},
     *          @OA\Property(property="username", type="string", format="text", example="username"),
     *          @OA\Property(property="password", type="string", format="text", example="123456"),
     *      ),
     *    ),
     *   @OA\Parameter(
     *     name="Accept-Language",
     *     in="header",
     *     required=true,
     *     description="language",
     *     @OA\Schema(
     *      type="string",
     *      default="en",
     *      enum={"en","fa"},
     *     ),
     *   ),
     *   @OA\Response(
     *      response=200,
     *      description="Success",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     */
    public function login(LoginRequest $request): JsonResponse|AuthResource
    {
        return $this->service->login($request);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     operationId="logout",
     *     security={{"bearerAuth":{}}},
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     * )
     *
     */
    public function logout(): JsonResponse
    {
        return $this->service->logout();
    }
}
