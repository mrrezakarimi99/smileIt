<?php

namespace Modules\Bank\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Bank\Http\Requests\BankFormRequest;
use Modules\Bank\Services\BankService;
use Modules\Core\Http\Controllers\CoreController;
use OpenApi\Annotations as OA;

class BankController extends CoreController
{
    public function __construct(BankService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/admin/bank",
     *      operationId="getBanksList",
     *      tags={"Bank"},
     *      summary="Get list of Banks",
     *      description="Returns list of Banks",
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
     */
    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/admin/bank/{id}",
     *      operationId="getBankById",
     *      tags={"Bank"},
     *      summary="Get Bank information",
     *      description="Returns Bank data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Bank Id",
     *          required=true,
     *          in="path",
     *      ),
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
     */
    public function show($id)
    {
        return $this->service->show('id' , $id);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/admin/bank",
     *      operationId="storeBank",
     *      tags={"Bank"},
     *      summary="Store new Bank",
     *      description="Returns Bank data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(type="string", property="name", example="Bank Name"),
     *          )
     *      ),
     *   @OA\Response(
     *      response=201,
     *       description="Created",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=422,
     *      description="Unprocessable Entity"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     * )
     */
    public function store(BankFormRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * @OA\Put(
     *      path="/api/v1/admin/bank/{id}",
     *      operationId="updateBank",
     *      tags={"Bank"},
     *      summary="Update existing Bank",
     *      description="Returns updated Bank data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Bank Id",
     *          required=true,
     *          in="path",
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name"},
     *              @OA\Property(type="string", property="name", example="Bank Name"),
     *          )
     *      ),
     *   @OA\Response(
     *      response=202,
     *       description="Accepted",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=422,
     *      description="Unprocessable Entity"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     * )
     */
    public function update($id , BankFormRequest $request)
    {
        return $this->service->update('id' , $id , $request->validated());
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/admin/bank/{id}",
     *      operationId="deleteBank",
     *      tags={"Bank"},
     *      summary="Delete existing Bank",
     *      description="Deletes a Bank record and returns no content",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Bank Id",
     *          required=true,
     *          in="path",
     *      ),
     *   @OA\Response(
     *      response=204,
     *       description="No Content",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
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
     */
    public function destroy($id)
    {
        return $this->service->destroyWithCheckAccounts($id);
    }
}
