<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Models\User;
use App\Notifications\TaskCompleted;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/notification', function () {
    User::find(1)->notify(new TaskCompleted);
    dd('success');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Route::get('/mailTestSuccessful',[TestController::class, 'sendMail']);

Route::get('/mailTestSuccessful', function () {
    $job = (new SendEmailJob())
        ->delay(Carbon::now()->addSeconds(5));

    dispatch($job);
    dd('email send successfully');
});

Route::get('/login', function () {
    return redirect('/cd-admin/login');
});
