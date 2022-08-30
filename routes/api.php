<?php

use Illuminate\Http\Request;
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

Route::get('v1/posts', 'Api\PostController@index');
Route::get('v1/posts/random', 'Api\PostController@inRandomOrder');
Route::get('v1/posts/search', 'Api\PostController@search');
Route::get('v1/posts/{slug}', 'Api\PostController@show')
    ->middleware('api.auth');
Route::post('v1/contacts', 'Api\ContactController@sendMessage')
    ->middleware('api.auth');

Route::get('v1/tags', 'Api\TagController@index');
