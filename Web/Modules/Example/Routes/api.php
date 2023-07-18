<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'api/v1' ,
    'middleware' => [
        'api'
    ]
] , function () {
    Route::group([
        'middleware' => ['auth:api'] ,
        'prefix'     => 'admin/Example'
    ] , function () {
        // Admin routes
    });

    Route::group([
        'prefix' => 'Example'
    ] , function () {
        // Public routes
    });

});
