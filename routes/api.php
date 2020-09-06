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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth routes
Route::group([
    'middleware' => 'api',
    'prefix'     => 'auth'
], function() {

    Route::post('/register', 'Api\Auth\AuthController@register');
    Route::post('/login',    'Api\Auth\AuthController@login');   

    // User Info
    Route::group([
        'middleware' => 'auth:api',
        'prefix'     => 'user'
    ], function() {
        Route::get('/', 'Api\Auth\AuthController@currentUser');
    });
});

// Profiles routes
Route::group([
    'middleware' => 'api',
    'prefix'     => 'profiles'
], function() {

    Route::group([
        'prefix' => '{id}'
    ], function() {

        Route::get('/',         'Api\ProfilesController@getProfileById');
        Route::get('/posts',    'Api\ProfilesController@getPostsByProfileId');

        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::post ('/follow',    'Api\ProfilesController@followProfile');
            Route::patch('/edit',      'Api\ProfilesController@editProfile');
        });

    });
});

// Posts routes
Route::group([
    'middleware' => 'api',
    'prefix'     => 'posts'
], function() {
    
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get ('/following', 'Api\PostsController@getPostsOfFollowedUsers');
        Route::get ('/',          'Api\PostsController@getUsersPosts');
        Route::post('/new',       'Api\PostsController@store');
        Route::post('/{id}/like', 'Api\PostsController@likePost');
    });

    Route::get ('/{id}',      'Api\PostsController@show');
});

// Comments routes
Route::group([
    'middleware' => 'auth:api',
    'prefix'     => 'comments'
], function () {
    Route::post('/new/{id}', 'Api\CommentsController@store');
});