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

Route::get('/', 'FrontendController@index');



Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth'],], function() {

	Route::get('/', 'BackendController@index')->name('backend.index');

	Route::resource('/user', UsersController::class); 

	Route::resource('/tag', TagController::class);

	Route::resource('/category', CategoryController::class); 

});


