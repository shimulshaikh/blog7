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

Route::get('/post-details/{slug}', 'PostDetailsController@postDetails')->name('post.details');
Route::get('/category/{slug}', 'PostDetailsController@postByCategory')->name('category.posts');
Route::get('/tag/{slug}', 'PostDetailsController@postByTag')->name('tag.posts');

Route::get('/search', 'SearchController@search')->name('search');


View::composer('website.frontend.layouts.footer', function($view){
	$categories = App\Category::paginate(3);
	$view->with('categories', $categories);
});



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'],], function() {

	Route::get('/', 'BackendController@index')->name('backend.index');

	Route::resource('/user', UsersController::class); 

	Route::resource('/tag', TagController::class);

	Route::resource('/category', CategoryController::class);

	Route::resource('/post', PostController::class); 
	Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
	Route::put('/post/{id}/status', 'PostController@status')->name('post.status');
	Route::get('/pending', 'PostController@getPending')->name('post.pending');
	Route::get('/trash-list', 'PostController@getTrash')->name('post.trash');
	Route::get('/trash-list/restore/{id}', 'PostController@restore')->name('post.restore');
	Route::delete('/trash-list/p_delere/{id}', 'PostController@parmanentDelete')->name('post.p_delere');

	Route::get('/subscriber', 'ManageSubscribeController@index')->name('subscribe.index');
	Route::delete('/subscriber/{id}', 'ManageSubscribeController@destroy')->name('subscribe.destroy');

	Route::get('/favorite', 'ShowFavoriteController@index')->name('favorite.index');

});


