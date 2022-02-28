<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')
    ->namespace('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('home');
        Route::resource('posts', 'PostController');
    });
