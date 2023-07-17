<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Account\Http\Requests\AccountFormRequest;
use Modules\Account\Services\AccountService;
use Modules\Core\Http\Controllers\CoreController;
use OpenApi\Annotations as OA;

class AccountController extends CoreController
{
    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/admin/account",
     *      operationId="getAccountsList",
     *      tags={"Account"},
     *      summary="Get list of Accounts",
     *      description="Returns list of Accounts",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="per_page",
     *          description="Number of items per page",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              example="10"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="sort_by",
     *          description="sort by created_at| for desc use (-) before field name like -created_at",
     *          required=false,
     *          in="query",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="filter[search]",
     *         description="search by account_number",
     *         required=false,
     *         in="query",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="filter[bank_id]",
     *         description="filter by bank_id",
     *         required=false,
     *         in="query",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="filter[user_id]",
     *         description="filter by user_id",
     *         required=false,
     *         in="query",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *         response=200,
     *          description="Success",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *         )
     *      ),
     *      @OA\Response(
     *         response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *      ),
     *      @OA\Response(
     *         response=404,
     *         description="not found"
     *      ),
     *      @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *      )
     * )
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/admin/account/{id}",
     *      operationId="getAccount",
     *      tags={"Account"},
     *      summary="Get Account",
     *      description="Returns Account data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Account Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show($id)
    {
        return $this->service->show('id' , $id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/admin/account",
     *      operationId="storeAccount",
     *      tags={"Account"},
     *      summary="Store new Account",
     *      description="Returns Account data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"bank_id"},
     *              @OA\Property(type="integer", property="bank_id"),
     *              @OA\Property(type="integer", property="user_id"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(AccountFormRequest $request)
    {
        return $this->service->storeWithExtraData($request->validated());
    }

    /**
     * @OA\Put(
     *      path="/api/v1/admin/account/{id}",
     *      operationId="updateAccount",
     *      tags={"Account"},
     *      summary="Update existing Account",
     *      description="Returns updated Account data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Account Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"bank_id"},
     *              @OA\Property(type="integer", property="bank_id"),
     *              @OA\Property(type="integer", property="user_id"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update($id , AccountFormRequest $request)
    {
        return $this->service->updateWithExtraData($request->validated() , $id);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/admin/account/{id}",
     *      operationId="deleteAccount",
     *      tags={"Account"},
     *      summary="Delete existing Account",
     *      description="Deletes a Account record and returns no content",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Account Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="No Content",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function destroy($id)
    {
        return $this->service->destroy('id' , $id);
    }
}
