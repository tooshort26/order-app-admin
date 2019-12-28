<?php

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

Route::get('/', function () {
	return redirect('login');
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
	Route::resource('dashboard', 'Admin\DashboardController');
	Route::get('/account/settings', 'Admin\AccountSettingController@edit')
		->name('account.setting');
	Route::put('/account/settings', 'Admin\AccountSettingController@update')
		->name('account.setting.update');

	Route::get('/category/{id}/foods', 'Admin\CategoryController@foods');
	Route::post('/uploader' , 'Admin\CategoryController@uploader');
	Route::resource('category', 'Admin\CategoryController');
	Route::resource('food', 'Admin\FoodController');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', 'Auth\LoginController@logout');
