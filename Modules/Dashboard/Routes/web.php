<?php

use Modules\Dashboard\Http\Controllers\Backend\DashboardController;

Route::prefix('cd-admin')->name('cd-admin.')->middleware('auth')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
 });



