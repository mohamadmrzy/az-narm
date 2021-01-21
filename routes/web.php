<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class ,'index']);
Route::get('/home', ['as' => 'home', 'uses' =>  [PostController::class ,'index']]);

//authentication
// Route::resource('auth', 'Auth\AuthController');
// Route::resource('password', 'Auth\PasswordController');
Route::get('/logout', [UserController::class,'logout']);
Route::group(['prefix' => 'auth'], function () {
    Auth::routes();
});

// check for logged in user
Route::middleware(['auth'])->group(function () {
    // show new post form
    Route::get('new-post', [PostController::class,'create']);
    // save new post
    Route::post('new-post', [PostController::class,'store']);
    // edit post form
    Route::get('edit/{slug}', [PostController::class,'edit']);
    // update post
    Route::post('update', [PostController::class,'update']);
    // delete post
    Route::get('delete/{id}', [PostController::class,'destroy']);
    // display user's all posts
    Route::get('my-all-posts', [UserController::class,'user_posts_all']);
    // display user's drafts
    Route::get('my-drafts', [UserController::class,'user_posts_draft']);
    // add comment
    Route::post('comment/add', [CommentController::class,'store']);
    // delete comment
    Route::post('comment/delete/{id}', [CommentController::class,'distroy']);
});

//users profile
Route::get('user/{id}', [UserController::class,'profile'])->where('id', '[0-9]+');
// display list of posts
Route::get('user/{id}/posts', [UserController::class,'user_posts'])->where('id', '[0-9]+');
// display single post
Route::get('/{slug}', ['as' => 'post', 'uses' => [PostController::class,'show']])->where('slug', '[A-Za-z0-9-_]+');
