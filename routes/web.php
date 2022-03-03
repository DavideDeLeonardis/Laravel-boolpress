<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

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
