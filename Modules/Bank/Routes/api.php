<?php

use Illuminate\Support\Facades\Route;
use Modules\Bank\Http\Controllers\BankController;

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
        Route::resource('bank' , BankController::class);
    });

    Route::group([
        'prefix' => 'bank'
    ] , function () {
        // Public routes
    });
});
