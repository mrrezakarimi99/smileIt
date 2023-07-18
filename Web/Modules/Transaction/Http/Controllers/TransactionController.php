<?php

namespace Modules\Transaction\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Transaction\Services\TransactionService;
use OpenApi\Annotations as OA;

class TransactionController extends CoreController
{
    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/admin/transaction",
     *      operationId="getTransactionsList",
     *      tags={"Transaction"},
     *      summary="Get list of Transactions",
     *      description="Returns list of Transactions",
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
     *         description="search by description",
     *         required=false,
     *         in="query",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="filter[type]",
     *         description="filter by type (deposit,withdraw,transfer)",
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
     *      @OA\Parameter(
     *         name="filter[from_account_id]",
     *         description="filter by from_account_id",
     *         required=false,
     *         in="query",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="filter[to_account_id]",
     *         description="filter by to_account_id",
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
     *      path="/api/v1/admin/transaction/{id}",
     *      operationId="getTransactionById",
     *      tags={"Transaction"},
     *      summary="Get Transaction information",
     *      description="Returns Transaction data",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Transaction id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *              example="1"
     *          )
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
    public function show($id)
    {
        return $this->service->show('id' , $id);
    }
}
