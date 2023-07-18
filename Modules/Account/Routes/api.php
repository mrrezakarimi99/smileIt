<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\Http\Controllers\AccountController;
use Modules\Account\Http\Controllers\PaymentController;

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
        Route::resource('account' , AccountController::class);
    });

    Route::group([
        'prefix' => 'account',
        'middleware' => ['auth:api'] ,
    ] , function () {
        Route::post('charge' , [PaymentController::class , 'charge']);
        Route::post('withdraw' , [PaymentController::class , 'withdraw']);
        Route::post('transfer' , [PaymentController::class , 'transfer']);
    });

});
