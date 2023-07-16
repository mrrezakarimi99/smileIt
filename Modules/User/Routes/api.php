<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;
use Modules\User\Http\Controllers\UserController;

Route::group([
    'prefix'     => 'api/v1' ,
    'middleware' => [
        'api' ,
    ]
] , function () {

    Route::group([
        'prefix' => 'auth'
    ] , function () {
        Route::post('/login' , [AuthController::class , 'login'])->name('login');
        Route::post('/logout' , [AuthController::class , 'logout'])->name('logout')->middleware('auth:api');
    });


    Route::group([
        'middleware' => ['auth:api'] ,
        'prefix'     => 'user'
    ] , function () {
        Route::get('/profile' , [UserController::class , 'profile']);
        Route::get('/' , [UserController::class , 'index']);
        Route::get('/{id}' , [UserController::class , 'show']);
    });
});


