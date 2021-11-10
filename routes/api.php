<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SimpleAuthController;
use Illuminate\Support\Facades\Route;

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

Route::name('api.')->group(function(){
    Route::middleware(['core', 'throttle:5,1'])->group(function(){
        Route::post('login', [SimpleAuthController::class, 'login'])
            ->name('login');
        Route::get('forgot-password', [SimpleAuthController::class, 'forgotPassword'])
            ->name('forgot-password');
        Route::get('reset-password/{random_string}/{id}', [SimpleAuthController::class, 'resetPassword'])
            ->name('reset-password');
        Route::get('logout', [SimpleAuthController::class, 'logout'])
            ->middleware('verify.api.token')
            ->name('logout');
        Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
    });

    Route::middleware(['core', 'verify.api.token'])->group(function(){
        Route::apiResource('admins', AdminController::class)->except(['store']);
        Route::apiResource('clients', ClientController::class);
    });
});
