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

Route::get('/', 'FrontendController@index')->name('home.index');
Route::get('/all-post', 'FrontendController@getPost')->name('all-post');

Route::post('/subscriber', 'SubscribeController@store')->name('subscribe.store');

Route::post('/favorite/{id}/add', 'FavoriteController@addFavorite')->name('post.favorite');



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'],], function() {

	Route::get('/', 'BackendController@index')->name('backend.index');

	Route::resource('/user', UsersController::class); 

	Route::resource('/tag', TagController::class);

	Route::resource('/category', CategoryController::class);

	Route::resource('/post', PostController::class); 
	Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
	Route::get('/pending', 'PostController@getPending')->name('post.pending');

	Route::get('/subscriber', 'ManageSubscribeController@index')->name('subscribe.index');
	Route::delete('/subscriber/{id}', 'ManageSubscribeController@destroy')->name('subscribe.destroy');

});


