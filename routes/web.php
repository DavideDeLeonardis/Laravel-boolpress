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
        Route::resource('posts', 'PostController');
    });

// Create una tabella UserInfos e aggiungete una relazione tra Posts e Users come fatto in classe
// User one to one Userinfo
// User one to many Post
// Poi aggiungete i relativi seeder come fatto assieme e aggiornate la crud Post
// Fatto questo dedicatevi alla parte frontend

// aggiungete
// model, migration, seeder di Category
// Aggiungete relazione one to many con Post
// Modificate create ed edit per inserire le select con le categorie
