<?php

namespace Modules\Core\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait CoreApiResponser
{
    public function successResponse($data , $message = null , $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status'  => trans('core::response.success') ,
            'message' => $message ,
            'data'    => $data
        ] , $code);
    }

    public function errorResponse($data , $message = null , $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'status'  => trans('core::response.failed') ,
            'message' => $message ,
            'data'    => $data
        ] , $code
        );
    }
}
