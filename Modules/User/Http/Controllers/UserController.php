<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\User\Http\Resources\User\UserResource;
use Modules\User\Services\UserService;
use OpenApi\Annotations as OA;

class UserController extends CoreController
{
    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/profile",
     *     tags={"Profile"},
     *     summary="Get User Profile",
     *     operationId="profile",
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
    public function profile(): UserResource
    {
        return $this->service->profile();
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user",
     *     tags={"Admin-User"},
     *     summary="Get User List",
     *     operationId="indexUser",
     *     security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *      name="page",
     *      description="page number",
     *      required=false,
     *      in="query",
     *      @OA\Schema(
     *           type="integer",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="per_page",
     *      description="limit number",
     *      required=false,
     *      in="query",
     *      @OA\Schema(
     *           type="integer",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="filter[search]",
     *      description="search by username",
     *      required=false,
     *      in="query",
     *      @OA\Schema(
     *           type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="sort_by",
     *      description="sort by created_at| for desc use (-) before field name like -created_at",
     *      required=false,
     *      in="query",
     *      @OA\Schema(
     *           type="string",
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="with[]",
     *      description="with balance",
     *      required=false,
     *      in="query",
     *      @OA\Schema(
     *          type="array",
     *          @OA\Items(type="string"),
     *      )
     *   ),
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
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/user/{id}",
     *     tags={"Admin-User"},
     *     summary="Get User By ID",
     *     operationId="showUser",
     *     security={{"bearerAuth":{}}},
     *   @OA\Parameter(
     *      name="id",
     *      description="User ID",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *           type="integer",
     *      )
     *   ),
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
    public function show($id)
    {
        return $this->service->show('id' , $id);
    }
}
