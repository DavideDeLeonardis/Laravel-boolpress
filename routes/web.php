<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Any\HomeController;

Auth::routes();

Route::get('/', 'Guest\HomeController@index');

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('home');
        Route::get('/myposts', 'PostController@indexUser')
            ->name('posts.indexUser');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
    });

Route::get('/{any?}', [HomeController::class, 'index'])->where('any', '.*');
