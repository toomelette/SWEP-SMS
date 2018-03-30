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
	Route::post('/dashboard/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/dashboard/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::post('/dashboard/user/logout/{slug}', 'UserController@logout')->name('user.logout');
	Route::resource('user', 'UserController');

});
