<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'PostsController@index')->name('index');
Route::post('follows/{user}', 'FollowsController@store');

Route::resource('/profile', 'ProfilesController', ['only' => ['index', 'show', 'edit', 'update']]);
Route::resource('/p', 'PostsController');
