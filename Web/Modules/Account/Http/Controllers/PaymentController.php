<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Account\Http\Requests\AccountFormRequest;
use Modules\Account\Http\Requests\ChargeRequest;
use Modules\Account\Http\Requests\TransferRequest;
use Modules\Account\Services\AccountService;
use Modules\Core\Http\Controllers\CoreController;
use OpenApi\Annotations as OA;

class PaymentController extends CoreController
{
    public function __construct(AccountService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Post(
     *      path="/api/v1/account/charge",
     *      operationId="charge",
     *      tags={"Payment-Account"},
     *      summary="Charge an account",
     *      description="Charge an account",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"account_number","amount"},
     *              @OA\Property(type="string", property="account_number", example="6037-9974-0000-0000"),
     *              @OA\Property(type="number", property="amount", example="1000"),
     *              @OA\Property(type="string", property="description", example="Charge account"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Charge an account",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *       )
     * )
     */
    public function charge(ChargeRequest $request)
    {
        return $this->service->charge($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/account/withdraw",
     *      operationId="withdraw",
     *      tags={"Payment-Account"},
     *      summary="Withdraw from an account",
     *      description="Withdraw from an account",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"account_number","amount"},
     *              @OA\Property(type="string", property="account_number", example="6037-9974-0000-0000"),
     *              @OA\Property(type="number", property="amount", example="1000"),
     *              @OA\Property(type="string", property="description", example="Withdraw from account"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Withdraw from an account",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *       )
     * )
     */
    public function withdraw(ChargeRequest $request)
    {
        return $this->service->withdraw($request);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/account/transfer",
     *      operationId="transfer",
     *      tags={"Payment-Account"},
     *      summary="Transfer from an account to another account",
     *      description="Transfer from an account to another account",
     *      security={
     *         {"bearerAuth": {}},
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"from_account_number","to_account_number","amount"},
     *              @OA\Property(type="string", property="from_account_number", example="6037-9974-0000-0000"),
     *              @OA\Property(type="string", property="to_account_number", example="6037-9974-0000-0000"),
     *              @OA\Property(type="number", property="amount", example="1000"),
     *              @OA\Property(type="string", property="description", example="Transfer from account to account"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Transfer from an account to another account",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found",
     *       ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *       )
     * )
     */
    public function transfer(TransferRequest $request): JsonResponse
    {
        return $this->service->transfer($request);
    }
}
