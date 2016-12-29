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

Route::get('/', 'HomeController@index');

Route::get('posts', 'PostController@list');

Route::get('show/{post}', 'PostController@show');
Route::get('user/{user}/allposts', 'PostController@viewAllUserPosts');
Route::post('search', 'PostController@search');

Route::get('categories', 'CategoryController@list');
Route::get('categories/{category}', 'CategoryController@postsListing');

Route::auth();

// Route::get('/home', function () {
// 	return view('home');
// });

Route::group(['middleware' => ['auth']], function() {
	Route::get('admin', [
		'uses' => 'AdminController@index',
		'middleware' => ['role:admin']
		]);

	Route::get('admin/category/manage', [
		'uses' => 'CategoryController@viewManagePage',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/category/manage/new', [
		'uses' => 'CategoryController@store',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/category/manage/{category}/delete', [
		'uses' => 'CategoryController@delete',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/category/manage/{category}/update', [
		'uses' => 'CategoryController@update',
		'middleware' => ['role:admin']
		]);

	Route::get('admin/user/manage', [
		'uses' => 'UserController@viewManagePage',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/user/manage/{user}/delete', [
		'uses' => 'UserController@delete',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/user/manage/{user}/update', [
		'uses' => 'UserController@update',
		'middleware' => ['role:admin']
		]);

	Route::get('post/create', [
		'uses' => 'PostController@viewCreatePage',
		'middleware' => ['role:admin|employer']
		]);
	Route::post('post/create/new', [
		'uses' => 'PostController@store',
		'middleware' => ['role:admin|employer']
		]);
	Route::get('post/{post}/edit', [
		'uses' => 'PostController@edit',
		'middleware' => ['role:employer']
		]);
	Route::patch('post/{post}/update', [
		'uses' => 'PostController@update',
		'middleware' => ['role:employer']
		]);
	Route::post('post/{post}/delete', [
		'uses' => 'PostController@update',
		'middleware' => ['role:employer']
		]);
	Route::get('admin/post/manage', [
		'uses' => 'PostController@viewManagePage',
		'middleware' => ['role:admin']
		]);
	Route::get('admin/post/manage/{post}/edit', [
		'uses' => 'PostController@editFromManage',
		'middleware' => ['role:admin']
		]);
	Route::patch('admin/post/manage/{post}/update', [
		'uses' => 'PostController@updateFromManage',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/post/manage/{post}/delete', [
		'uses' => 'PostController@deleteFromManage',
		'middleware' => ['role:admin']
		]);

	Route::post('comment/{post}/new', 'CommentController@store');
	Route::get('admin/comment/manage/', [
		'uses' => 'CommentController@manage',
		'middleware' => ['role:admin']
		]);
	Route::post('admin/comment/manage/{comment}/delete', [
		'uses' => 'CommentController@delete',
		'middleware' => ['role:admin']
		]);
});

