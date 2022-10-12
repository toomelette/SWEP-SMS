<?php

/** Auth **/

use App\Swep\Helpers\Helper;
use Rats\Zkteco\Lib\ZKTeco;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




//PUBLIC ROUTES
Route::group(['as' => 'auth.'], function () {
	
	Route::get('/', 'Auth\LoginController@showLoginForm')->name('showLogin');
	Route::post('/', 'Auth\LoginController@login')->name('login');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/username_lookup','Auth\AccountRecoveryController@username_lookup')->name('username_lookup');
    Route::post('/reset_password','Auth\AccountRecoveryController@reset_password')->name('reset_password');
    Route::post('/verify_email','Auth\AccountRecoveryController@verify_email')->name('verify_email');
    Route::get('/reset_password_via_email','Auth\AccountRecoveryController@reset_password_via_email')->name('reset_password_via_email');
});


/** HOME **/
Route::get('dashboard/home', 'HomeController@index')->name('dashboard.home')->middleware(['check.user_status']);


Route::get('/dashboard/plantilla/print','PlantillaController@print')->name('plantilla.print');


//USER LEVEL ROUTES
Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.',
    'middleware' => ['check.user_status', 'last_activity','sidenav_mw']
], function () {
    Route::get('/dtr/my_dtr', 'DTRController@myDtr')->name('dtr.my_dtr');
    Route::get('/dtr/download','DTRController@download')->name('dtr.download');
    Route::get('/dtr/fetch_by_user_and_month', 'DTRController@fetchByUserAndMonth')->name('dtr.fetch_by_user_and_month');
    Route::post('dashboard/changePass','UserController@changePassword')->name('all.changePass');
    Route::post('/change_side_nav','SidenavController@change')->name('sidenav.change');
    Route::post('/dtr/update_time_record','DTRController@updateTimeRecord')->name('dtr.update_time_record');
    Route::post('/dtr/update_remarks','DTRController@updateRemarks')->name('dtr.update_remarks');

    /** PROFILE **/
    Route::get('/profile', 'ProfileController@details')->name('profile.details');
    Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
    Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
    Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');
    Route::get('/profile/print_pds/{slug}/{page}', 'ProfileController@printPds')->name('profile.print_pds');
    Route::post('/profile/save_family_info','ProfileController@saveFamilyInfo')->name('profile.save_family_info');

    /** PROFILE SERVICE RECORD**/
    Route::get('/profile/service_record','ProfileController@serviceRecord')->name('profile.service_record');
    Route::post('/profile/service_record_store','ProfileController@serviceRecordStore')->name('profile.service_record_store');
    Route::put('/profile/service_record_update/{slug}','ProfileController@serviceRecordUpdate')->name('profile.service_record_update');
    Route::delete('/profile/service_record/destroy/{slug}','ProfileController@serviceRecordDestroy')->name('profile.service_record_destroy');

    Route::get('/profile/training','ProfileController@training')->name('profile.training');
    Route::post('/profile/training_store','ProfileController@trainingStore')->name('profile.training_store');
    Route::put('/profile/training_update/{slug}','ProfileController@trainingUpdate')->name('profile.training_update');
    Route::delete('/profile/training_destroy/{slug}','ProfileController@trainingDestroy')->name('profile.training_destroy');

    Route::get('/ajax/{for}','AjaxController@get')->name('ajax.get');
    Route::post('/ajaxPost/{for}','AjaxPostController@post')->name('ajax.post');
    Route::post('/profile/educ_bg_store','ProfileController@educationalBackgroundStore')->name('profile.educ_bg_store');
    Route::post('/profile/eligibility_store','ProfileController@eligibilityStore')->name('profile.eligibility_store');
    Route::post('/profile/work_experience_store','ProfileController@workExperienceStore')->name('profile.work_experience_store');

    Route::post('/profile/select_theme','ProfileController@selectTheme')->name('profile.select_theme');

    Route::get('/view_doc/{id}','NewsController@viewDoc')->name('news.view_doc');
    Route::get('/view_document/{id}/{type}','ViewDocument@index')->name('view_document.index');

    /** PERMISSION SLIPS **/
    Route::get('/permission_slips/my_permission_slips','PermissionSlipController@myPermissionSlips')->name('permission_slip.my_permission_slips');

    Route::resource('sms_form1','SMS\WeeklyReport\Form1Controller');
    Route::resource('sms_form2','SMS\WeeklyReport\Form2Controller');
    /** WEEKLY REPORT **/

    Route::get('/weekly_report/{slug}/print','SMS\WeeklyReportController@print')->name('weekly_report.print');

    Route::resource('signatories','SMS\SignatoryController');
    Route::resource('weekly_report','SMS\WeeklyReportController');
    Route::resource('weekly_report_raw','SMS\WeeklyReport\RawSugarController');
    Route::resource('form5_issuanceOfSro','SMS\Form5\IssuanceOfSroController');
    Route::resource('form5_deliveries','SMS\Form5\DeliveriesController');
    Route::resource('form5_servedSros','SMS\Form5\ServedSrosController');

    Route::resource('form5a_issuanceOfSro','SMS\Form5a\IssuanceOfSroController');
    Route::resource('form5a_deliveries','SMS\Form5a\DeliveriesController');
    Route::resource('form5a_servedSros','SMS\Form5a\ServedSrosController');

    Route::resource('form6a_rawSugarReceipts','SMS\Form6a\RawSugarReceiptsController');

    Route::resource('form6a_quedanRegistry','SMS\Form6a\QuedanRegistryController');
    Route::get('/form_6a/{slug}/print','SMS\WeeklyReportController@printForm6a')->name('form_6a.print_form6a_form');

});

    //ADMIN LEVEL ROUTES
    /** Dashboard **/
    Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.',
        'middleware' => ['check.user_status', 'check.user_route', 'last_activity']
    ], function () {

        /** USER **/

        Route::post('/user/activate/{slug}', 'UserController@activate')->name('user.activate');
        Route::post('/user/deactivate/{slug}', 'UserController@deactivate')->name('user.deactivate');
        Route::get('/user/{slug}/reset_password', 'UserController@resetPassword')->name('user.reset_password');
        Route::patch('/user/reset_password/{slug}', 'UserController@resetPasswordPost')->name('user.reset_password_post');
        Route::get('/user/{slug}/sync_employee', 'UserController@syncEmployee')->name('user.sync_employee');
        Route::patch('/user/sync_employee/{slug}', 'UserController@syncEmployeePost')->name('user.sync_employee_post');
        Route::post('/user/unsync_employee/{slug}', 'UserController@unsyncEmployee')->name('user.unsync_employee');

        Route::resource('user', 'UserController');

        /** MENU **/
        Route::resource('menu', 'MenuController');

        /** MENU **/
        Route::get('/submenu/fetch','SubmenuController@fetch')->name('submenu.fetch');
        Route::resource('submenu','SubmenuController');
        Route::get('/employee/report', 'EmployeeController@report')->name('employee.report');

        Route::resource('employee', 'EmployeeController');
        /** Activity Logs **/
        Route::get('/activity_logs/fetch_properties', 'ActivityLogsController@fetch_properties')->name('activity_logs_fetch_properties');


});

