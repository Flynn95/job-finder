<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('posts', 'PostController@list');

Route::get('show/{post}', 'PostController@show');
Route::get('post/create', 'PostController@viewCreatePage');
Route::post('post/create/new', 'PostController@store');
Route::get('post/{post}/edit', 'PostController@edit');
Route::patch('post/{post}/update', 'PostController@update');
Route::post('post/{post}/delete', 'PostController@delete');

Route::post('comment/{post}/new', 'CommentController@store');

Route::get('category/manage', 'CategoryController@viewManagePage');
Route::post('category/new', 'CategoryController@store');
Route::get('categories', 'CategoryController@list');
Route::get('categories/{category}', 'CategoryController@postsListing');

Route::auth();

Route::get('/home', 'HomeController@index');

