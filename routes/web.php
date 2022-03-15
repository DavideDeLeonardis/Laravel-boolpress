<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return view('guest.home');
});

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

Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');
