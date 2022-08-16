<?php

use Modules\Auth\Http\Controllers\Backend\AuthController;


//Backend Login/Logout
Route::get('cd-admin/login', [AuthController::class, 'index'])->name('login');
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('cd-admin/loginSubmit', [AuthController::class, 'login'])->name('loginSubmit');
Route::get('cd-admin/logout', [AuthController::class, 'logout'])->name('logout');
