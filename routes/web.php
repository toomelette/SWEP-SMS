<?php

/** Auth Routes **/

Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

});

//Auth::routes();

Route::get('admin/home', 'HomeController@index')->name('home');
