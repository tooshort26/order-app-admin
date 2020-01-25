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

Route::get('/', 'WelcomeController@index');

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
	// Route::resource('order', 'Admin\OrderController');
	Route::get('order', 'Admin\OrderController@index')->name('order.index');
	Route::get('order/{customerId}/{orderNo}', 'Admin\OrderController@show')
				->name('order.show');
	Route::post('order/print', 'Admin\OrderPrintController')->name('order.print');

	Route::get('/prepare/order', 'Admin\OrderPrepareController@index')->name('prepare.order.index');
	Route::get('/cancelled/order', 'Admin\CancelledOrderController@index')->name('cancelled.order.index');
	Route::get('/deliver/pickup/order', 'Admin\DeliverOrPickUpController@index')->name('deliver-pickup.index');
	Route::get('/paid/order', 'Admin\PaidOrderController@index')->name('paid-order.index');

	Route::get('/sales/daily', 'Admin\DailySalesReportController@index')->name('daily.sales');
	Route::get('/sales/daily/print', 'Admin\DailySalesReportController@print')->name('daily.sales.print');

	Route::get('/sales/monthly', 'Admin\MonthlySalesReportController@index')->name('monthly.sales');

	Route::get('/sales/weekly', 'Admin\WeeklySalesReportController@index')->name('weekly.sales');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', 'Auth\LoginController@logout');
