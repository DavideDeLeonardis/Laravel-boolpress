<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('home');
        Route::get('/myposts', 'PostController@indexUser')
            ->name('posts.indexUser');
        Route::resource('categories', 'CategoryController');
        Route::resource('posts', 'PostController');
    });

Route::get('{any?}', function ($name = null) {
    return view('guest.home');
})->where('any', '.*');
