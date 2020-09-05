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

// Index
Route::get('/', 'PostsController@index')->name('index');

// Follows
Route::post('/follow/{user}', 'FollowsController@store');

// Likes
// Route::post('/likes', 'LikesController@index');
Route::post('/like/{post_id}', 'LikesController@store');

// Comments
Route::post('/comment/resp/{post_id}', 'CommentsController@storeResp');
Route::post('/comment/{post_id}', 'CommentsController@store');

// Controllers
Route::resource('/profile', 'ProfilesController', ['only' => ['index', 'show', 'edit', 'update']]);
Route::resource('/p', 'PostsController');
