<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/userandroles', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->group(function () {
    Route::post('/register', 'Api\UserController@register');
    Route::post('/register/send-verifycode', 'Api\UserController@registerVerification');
    Route::post('/sendVerificationCode', 'Api\UserController@sendVerificationCode');
    Route::post('/checkVerificationCode', 'Api\UserController@checkVerificationCode');
    Route::post('/forgotPassword/changepassword', 'Api\UserController@changeForgotPassword');
    Route::get('/get/{id}', 'Api\UserController@getuserById');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/update', 'Api\UserController@updateProfile');
        Route::post('/changepassword', 'Api\UserController@changePassword');
    });
});
