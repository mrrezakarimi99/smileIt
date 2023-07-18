<?php

use Illuminate\Support\Facades\Route;
use Modules\Transaction\Http\Controllers\TransactionController;

Route::group([
    'prefix'     => 'api/v1' ,
    'middleware' => [
        'api'
    ]
] , function () {
    Route::group([
        'middleware' => ['auth:api'] ,
        'prefix'     => 'admin'
    ] , function () {
        Route::get('/transaction',[TransactionController::class,'index']);
    });

    Route::group([
        'prefix' => 'Transaction'
    ] , function () {
        // Public routes
    });

});
