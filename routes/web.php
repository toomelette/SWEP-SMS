<?php


/** Auth **/
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

});




/** Dashboard **/
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.', 'middleware' => ['check.user_status', 'check.user_route']], function () {

	/** HOME **/	
	Route::get('/home', 'HomeController@index')->name('home');

	/** USER **/   
	Route::post('/dashboard/user/activate/{slug}', 'UserController@activate')->name('user.activate');
	Route::post('/dashboard/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
	Route::post('/dashboard/user/logout/{slug}', 'UserController@logout')->name('user.logout');
	Route::get('/dashboard/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
	Route::post('/dashboard/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
	Route::resource('user', 'UserController');

	/** DISBURSEMENT VOUCHERS **/
	Route::get('/disbursement_voucher/user_index', 'DisbursementVoucherController@userIndex')->name('disbursement_voucher.user_index');
	Route::get('/disbursement_voucher/print/{slug}/{type}', 'DisbursementVoucherController@print')->name('disbursement_voucher.print');
	Route::post('/disbursement_voucher/set_no/{slug}', 'DisbursementVoucherController@setNo')->name('disbursement_voucher.set_no_post');
	Route::post('/disbursement_voucher/confirm_check/{slug}', 'DisbursementVoucherController@confirmCheck')->name('disbursement_voucher.confirm_check');
	Route::get('/disbursement_voucher/{slug}/save_as', 'DisbursementVoucherController@saveAs')->name('disbursement_voucher.save_as');
	Route::resource('disbursement_voucher', 'DisbursementVoucherController');

	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::post('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::post('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::post('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');

	/** MENU **/
	Route::resource('menu', 'MenuController');

	/** SUBMENU **/
	Route::resource('submenu', 'SubmenuController');

	/** SIGNATORIES **/
	Route::resource('signatory', 'SignatoryController');

	/** DEPARTMENTS **/
	Route::resource('department', 'DepartmentController');

	/** DEPARTMENT UNITS **/
	Route::resource('department_unit', 'DepartmentUnitController');

	/** PROJECT CODES **/
	Route::resource('project_code', 'ProjectCodeController');

	/** FUND SOURCE **/
	Route::resource('fund_source', 'FundSourceController');

	/** LEAVE APPLICATION **/
	Route::get('/leave_application/user_index', 'LeaveApplicationController@userIndex')->name('leave_application.user_index');
	Route::get('/leave_application/print/{slug}/{type}', 'LeaveApplicationController@print')->name('leave_application.print');
	Route::resource('leave_application', 'LeaveApplicationController');

	/** EMPLOYEE **/
	Route::get('/employee/print_pds/{slug}/{page}', 'EmployeeController@printPds')->name('employee.print_pds');
	Route::get('/employee/print_info/{slug}', 'EmployeeController@printInfo')->name('employee.print_info');
	Route::get('/employee/service_record/{slug}', 'EmployeeController@serviceRecord')->name('employee.service_record');
	Route::post('/employee/service_record/store/{slug}', 'EmployeeController@serviceRecordStore')->name('employee.service_record_store');
	Route::post('/employee/service_record/update/{slug}', 'EmployeeController@serviceRecordUpdate')->name('employee.service_record_update');
	Route::delete('/employee/service_record/destroy/{slug}', 'EmployeeController@serviceRecordDestroy')->name('employee.service_record_destroy');
	Route::resource('employee', 'EmployeeController');
	
});



/** Testing **/

Route::get('/dashboard/test', function(){

	return dd(Illuminate\Support\Str::random(16));

});