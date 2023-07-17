<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\Http\Controllers\AccountController;

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
        'prefix' => 'Account'
    ] , function () {
        // Public routes
    });

});
