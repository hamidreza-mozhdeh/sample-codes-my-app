<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/login', 'pages.login')->name('login');
Route::view('/register', 'pages.register')->name('register');
Route::view('/forgot-password', 'pages.forgot-password')->name('forgot-password');
Route::view('/logout', 'pages.forgot-password')->name('logout');

Route::prefix('clients')
    ->name('clients.')
    ->group(function(){
        Route::view('', 'pages.clients-index')->name('index');
        Route::view('create', 'pages.clients-create')->name('create');
        Route::view('show', 'pages.clients-show')->name('show');
//    Route::view('index', 'pages.clients-edit')->name('index');
    });

Route::prefix('admins')
    ->name('admins.')
    ->group(function(){
        Route::view('', 'pages.admins-index')->name('index');
        Route::view('create', 'pages.admins-create')->name('create');
        Route::view('show', 'pages.admins-show')->name('show');
//    Route::view('index', 'pages.admins-edit')->name('index');
    });

Route::get('/images/clients/{image}/{width?}', [ImageController::class, 'getImage']);

Route::get('/command/{call}', function ($call) {
    dd(Artisan::call($call));
});


Route::get('/clear', function () {

    Artisan::call('config:clear');
    Artisan::call('config:cache');

    Artisan::call('clear-compiled');
    Artisan::call('auth:clear-resets');
    Artisan::call('cache:clear');

    Artisan::call('view:clear');
    Artisan::call('view:cache');

    Artisan::call('route:clear');
    Artisan::call('optimize');

    Artisan::call('dump-autoload');

    return 'DONE';
});
