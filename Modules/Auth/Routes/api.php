<?php

use Modules\Auth\Http\Controllers\Api\LoginController;
use Modules\UserAndRoles\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('/user')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register',[UserController::class,'register']);
    Route::post('/sendVerificationCode',[UserController::class,'sendVerificationCode']);
    Route::post('/checkVerificationCode',[UserController::class,'checkVerificationCode']);
    Route::post('/forgotPassword',[UserController::class,'forgotPassword']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/logout', [LoginController::class, 'logout']);
        Route::get('/details',[UserController::class,'details']);
        Route::post('/update',[UserController::class,'updateProfile']);
        Route::post('/changepassword',[UserController::class,'changePassword']);
    });
});

// Route::prefix('/user')->group(function () {
//     Route::post('/login', 'Api\LoginController@login');
//     // Route::post('/register',[UserController::class,'register');
//     // Route::post('/sendVerificationCode',[UserController::class,'sendVerificationCode');
//     // Route::post('/checkVerificationCode',[UserController::class,'checkVerificationCode');

//     Route::group(['middleware' => 'auth:api'], function () {
//      Route::get('/logout', 'Api\LoginController@logout');
//     //  Route::post('/update',[UserController::class,'updateProfile');
//     //  Route::post('/changepassword',[UserController::class,'changePassword');
//     });
//    });
