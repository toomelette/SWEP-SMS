<?php


/** Auth Routes **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	//Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});



Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {
	
	Route::get('/home', 'HomeController@index')->name('home');

	/** USER ROUTES **/
	Route::resource('user', 'UserController');

});
