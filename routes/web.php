<?php

/** Auth **/

use App\Swep\Helpers\Helper;
use Rats\Zkteco\Lib\ZKTeco;

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
Route::get('dashboard/home', 'HomeController@index')->name('dashboard.home')->middleware('check.user_status');


Route::group(['prefix'=>'dashboard', 'as' => 'dashboard.',
    'middleware' => ['check.user_status', 'last_activity','sidenav_mw']
], function () {
    Route::get('/dtr/my_dtr', 'DTRController@myDtr')->name('dtr.my_dtr');
    Route::get('/dtr/download','DTRController@download')->name('dtr.download');
    Route::get('/dtr/fetch_by_user_and_month', 'DTRController@fetchByUserAndMonth')->name('dtr.fetch_by_user_and_month');
    Route::post('dashboard/changePass','UserController@changePassword')->name('all.changePass');
    Route::post('/change_side_nav','SidenavController@change')->name('sidenav.change');

    Route::get('/mis_requests/my_requests','MisRequestsController@myRequests')->name('mis_requests.my_requests');
    Route::post('/mis_requests/store','MisRequestsController@store')->name('mis_requests.store');
    Route::post('/mis_requests/cancel_request','MisRequestsController@cancelRequest')->name('mis_requests.cancel_request');
    Route::get('/mis_requests/{slug}/print','MisRequestsController@printRequestForm')->name('mis_requests.print_request_form');
    Route::post('/mis_requests/store_img','MisRequestsController@storeImg')->name('mis_requests.store_img');
    Route::get('/mis_requests_status/index_open','MisRequestsStatusController@indexOpen')->name('mis_requests_status.index_open');
});

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


	/** DISBURSEMENT VOUCHERS **/
	Route::get('/disbursement_voucher/user_index', 'DisbursementVoucherController@userIndex')->name('disbursement_voucher.user_index');
	Route::get('/disbursement_voucher/print/{slug}/{type}', 'DisbursementVoucherController@print')->name('disbursement_voucher.print');
    Route::get('/disbursement_voucher/print_preview/{slug}', 'DisbursementVoucherController@printPreview')->name('disbursement_voucher.print_preview');
	Route::patch('/disbursement_voucher/set_no/{slug}', 'DisbursementVoucherController@setNo')->name('disbursement_voucher.set_no_post');
	Route::post('/disbursement_voucher/confirm_check/{slug}', 'DisbursementVoucherController@confirmCheck')->name('disbursement_voucher.confirm_check');
	Route::get('/disbursement_voucher/{slug}/save_as', 'DisbursementVoucherController@saveAs')->name('disbursement_voucher.save_as');
	Route::resource('disbursement_voucher', 'DisbursementVoucherController');


	/** PROFILE **/
	Route::get('/profile', 'ProfileController@details')->name('profile.details');
	Route::patch('/profile/update_account_username/{slug}', 'ProfileController@updateAccountUsername')->name('profile.update_account_username');
	Route::patch('/profile/update_account_password/{slug}', 'ProfileController@updateAccountPassword')->name('profile.update_account_password');
	Route::patch('/profile/update_account_color/{slug}', 'ProfileController@updateAccountColor')->name('profile.update_account_color');
	Route::get('/profile/print_pds/{slug}/{page}', 'ProfileController@printPds')->name('profile.print_pds');


	/** MENU **/
	Route::resource('menu', 'MenuController');

    /** MENU **/
    Route::get('/submenu/fetch','SubmenuController@fetch')->name('submenu.fetch');
	Route::resource('submenu','SubmenuController');

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
	Route::get('/leave_application/{slug}/save_as', 'LeaveApplicationController@saveAs')->name('leave_application.save_as');
	Route::resource('leave_application', 'LeaveApplicationController');


	/** EMPLOYEE **/
    Route::get('/employee/edit_bm_uid','EmployeeController@edit_bm_uid')->name('employee.edit_bm_uid');
    Route::post('/employee/update_bm_uid','EmployeeController@update_bm_uid')->name('employee.update_bm_uid');
	Route::get('/employee/print_pds/{slug}/{page}', 'EmployeeController@printPds')->name('employee.print_pds');
	
	Route::get('/employee/service_record/{slug}', 'EmployeeController@serviceRecord')->name('employee.service_record');
	Route::post('/employee/service_record/store/{slug}', 'EmployeeController@serviceRecordStore')->name('employee.service_record_store');
	Route::put('/employee/service_record/update/{slug}', 'EmployeeController@serviceRecordUpdate')->name('employee.service_record_update');
	Route::delete('/employee/service_record/destroy/{slug}', 'EmployeeController@serviceRecordDestroy')->name('employee.service_record_destroy');
	Route::get('/employee/service_record/print/{slug}', 'EmployeeController@serviceRecordPrint')->name('employee.service_record_print');

	Route::get('/employee/training/{slug}', 'EmployeeController@training')->name('employee.training');
	Route::post('/employee/training/store/{slug}', 'EmployeeController@trainingStore')->name('employee.training_store');
	Route::put('/employee/training/update/{slug}', 'EmployeeController@trainingUpdate')->name('employee.training_update');
	Route::delete('/employee/training/destroy/{slug}', 'EmployeeController@trainingDestroy')->name('employee.training_destroy');
	Route::get('/employee/training/print/{slug}', 'EmployeeController@trainingPrint')->name('employee.training_print');

	Route::get('/employee/matrix/{slug}', 'EmployeeController@matrix')->name('employee.matrix');
	Route::post('/employee/matrix/update/{slug}', 'EmployeeController@matrixUpdate')->name('employee.matrix_update');
	Route::get('/employee/matrix/show/{slug}', 'EmployeeController@matrixShow')->name('employee.matrix_show');
	Route::get('/employee/matrix/print/{slug}', 'EmployeeController@matrixPrint')->name('employee.matrix_print');

	Route::get('/employee/report', 'EmployeeController@report')->name('employee.report');
	Route::get('/employee/report_generate', 'EmployeeController@reportGenerate')->name('employee.report_generate');
	Route::resource('employee', 'EmployeeController');


	/** DOCUMENTS **/
	Route::get('/document/report', 'DocumentController@report')->name('document.report');
	Route::get('/document/report_generate', 'DocumentController@report_generate')->name('document.report_generate');

	Route::get('/document/view_file/{slug}', 'DocumentController@viewFile')->name('document.view_file');
	Route::get('/document/download', 'DocumentController@download')->name('document.download');
	Route::post('/document/download_direct/{slug}', 'DocumentController@downloadDirect')->name('document.download_direct');
	Route::get('/document/dissemination/{slug}', 'DocumentController@dissemination')->name('document.dissemination');
	Route::post('/document/dissemination_post/{slug}', 'DocumentController@disseminationPost')->name('document.dissemination_post');

	Route::get('/document/rename_all', 'DocumentController@rename_all')->name('document.rename_all');

	Route::resource('document', 'DocumentController');

	Route::get('/document/dissemination/print/{slug}', 'DocumentController@print')->name('document.dissemination.print');

	




	/** Document Folder Codes **/
	Route::get('/document_folder/browse/{folder_code}', 'DocumentFolderController@browse')->name('document_folder.browse');
	Route::resource('document_folder', 'DocumentFolderController');


	/** Email Contacts **/
	Route::resource('email_contact', 'EmailContactController');


	/** Permission Slip **/
	Route::get('/permission_slip/report', 'PermissionSlipController@report')->name('permission_slip.report');
	Route::get('/permission_slip/report_generate', 'PermissionSlipController@reportGenerate')->name('permission_slip.report_generate');
	Route::resource('permission_slip', 'PermissionSlipController');


	/** Leave Card **/
	Route::get('/leave_card/report', 'LeaveCardController@report')->name('leave_card.report');
	Route::get('/leave_card/report_generate', 'LeaveCardController@reportGenerate')->name('leave_card.report_generate');
	Route::resource('leave_card', 'LeaveCardController');


	/** Applicant **/
	Route::post('/applicant/addToShortList/{slug}', 'ApplicantController@addToShortList')->name('applicant.add_to_shortlist');
	Route::post('/applicant/removeToShortList/{slug}', 'ApplicantController@removeToShortList')->name('applicant.remove_to_shortlist');
	Route::get('/applicant/report', 'ApplicantController@report')->name('applicant.report');
	Route::get('/applicant/report_generate', 'ApplicantController@reportGenerate')->name('applicant.report_generate');
	Route::resource('applicant', 'ApplicantController');


	/** Course **/
	Route::resource('course', 'CourseController');


	/** Plantilla **/
	Route::resource('plantilla', 'PlantillaController');


    /** Activity Logs **/
    Route::get('/activity_logs/fetch_properties', 'ActivityLogsController@fetch_properties')->name('activity_logs_fetch_properties');

    /** PAP **/
    Route::resource('pap', 'PapController');

    /** PAP  Parents**/
    Route::resource('pap_parent', 'PapParentController');

    Route::resource('ppmp', 'PPMPController');

    /** DTR **/
    Route::get('/dtr/extract', 'DTRController@extract2')->name('dtr.extract');
    Route::get('/dtr/reconstruct', 'DTRController@reconstruct')->name('dtr.reconstruct');
//    Route::get('/dtr/my_dtr', 'DTRController@myDtr')->name('dtr.my_dtr');
//    Route::post('/dtr/download','DTRController@download')->name('dtr.download');

    Route::resource('dtr', 'DTRController');

    /** DTR **/
    Route::resource('jo_employees','JOEmployeesController');

    /** DTR **/
    Route::get('holidays/fetch_google','HolidayController@fetchGoogleApi')->name('holidays.fetch_google');
    Route::resource('holidays','HolidayController');

    /** Biometric Devices **/
    Route::get('biometric_devices','BiometricDevicesController@index')->name('biometric_devices.index');
    Route::post('biometric_devices/extract','BiometricDevicesController@extract')->name('biometric_devices.extract');
    Route::post('biometric_devices/restart','BiometricDevicesController@restart')->name('biometric_devices.restart');
    Route::get('biometric_devices/attendances','BiometricDevicesController@attendances')->name('biometric_devices.attendances');
    Route::post('biometric_devices/clear_attendance','BiometricDevicesController@clear_attendance')->name('biometric_devices.clear_attendance');

    Route::get('mis_requests','MisRequestsController@index')->name('mis_requests.index');
    Route::get('mis_requests/{slug}/edit','MisRequestsController@edit')->name('mis_requests.edit');
    Route::put('mis_requests/{request_slug}/update','MisRequestsController@update')->name('mis_requests.update');
    Route::resource('mis_requests_status','MisRequestsStatusController');

    /** Budget Proposal**/
    Route::resource('budget_proposal', 'BudgetProposalController');

    /** PPMP **/
    Route::resource('ppmp', 'PPMPController');
});





Route::get('/dtr', function (){
    return redirect('/dashboard/dtr/my_dtr');
});
Route::get('/assign',function (){
    $users = \App\Models\User::query()->where('user_id','=','')->get();
    foreach ($users as $user){
        $user->user_id = rand(1111111,9999999);
        $user->update();
    }
    return 1;
});

Route::get('/dashboard/compute', function (\App\Swep\Services\DTRService $service){

    return $service->compute();


});

Route::get('/dashboard/tree', function (){
    return view('dashboard.blank');
});

Route::get('/file_explorer',function (){

   return view('dashboard.file_explorer.index');
})->name('dashboard.documents.file_explorer.index');

/** Test Route **/

Route::get('/dashboard/test', function(){

//    $zk = new ZKTeco('10.36.1.23');
//    //ini_set('max_execution_time', 300);
//    $zk->connect();
//    $zk->testVoice();
//    $zk->setTime('2022-01-04 14:59:03');
//
//    $zk->disconnect();

	return dd([
	    'slug' => Illuminate\Support\Str::random(16),
        'small' => strtoupper(Illuminate\Support\Str::random(7)),
    ]);

});

Route::get('dashboard/prayer', function (){
    $path = asset('json/quotes.json');
    $content = json_decode(file_get_contents($path),true);

    $today = Carbon::now()->format('Y-m-d');
    $qod_db = \App\Models\QuoteOfTheDay::query()->where('date',$today)->first();
    if(empty($qod_db)){
        $random = rand(0,1643);
        $qod = new \App\Models\QuoteOfTheDay();
        $qod->quote = $random;
        $qod->date = $today;
        $qod->save();

    }
    $qod_db_2 = \App\Models\QuoteOfTheDay::query()->where('date',$today)->first();
    return view('dashboard.prayer.index')->with([
        'qod' => $content[$qod_db_2->quote],
    ]);
})->name('dashboard.prayer');

Route::get('dashboard/zk_test',function (){

    $zk = new \Rats\Zkteco\Lib\ZKTeco('10.36.1.21');
    $zk->connect();

    return $zk->getUser();
    //return $zk->serialNumber();
});


Route::get('jo',function (){
   return view('dashboard.public.jo_entry')->with([
       'user_menus_records ' => '',

   ]);
});

Route::get('check_device',function (\App\Swep\Services\DTRService $DTRService){
    if(!request()->has('ip')){
        return 'Missing IP';
    }
    $ip = request()->get('ip');
    $zk = new ZKTeco($ip);
    $zk->connect();
    return $zk->getAttendance();
//    return $DTRService->clearAttendance('10.36.1.23');
});

Route::get('dashboard/set', function (){
    if(request()->ajax()){
        if(request()->has('set')){
            $zk = new ZKTeco('10.36.1.'.request()->get('dev'));
            $zk->connect();
            $zk->setTime(request()->get('date').' '.request()->get('time'));
            return 1;
        }
        if (request()->has('reset')){
            $zk = new ZKTeco('10.36.1.'.request()->get('dev'));
            $zk->connect();
            $zk->setTime(\Carbon\Carbon::now()->format('Y-m-d H:i:s'));
            return 1;
        }
        if(request()->has('verify')){
            if(request()->get('password') === 'superadmin'){
                request()->session()->put('verify',['expires_on'=>\Carbon\Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s'),'type'=>'su']);
                return 1;
            }
            if(request()->get('password') ==='misvis'){
                request()->session()->put('verify',['expires_on'=>\Carbon\Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s'),'type'=>'u']);
                return 1;
            }
        }
    }

    if (request()->session()->exists('verify')) {
        if(request()->session()->get('verify')['expires_on'] < \Carbon\Carbon::now()->format('Y-m-d H:i:s')){
            request()->session()->forget('verify');
            return view('dashboard.set.verify');
        }else{
            request()->session()->get('verify')['type'];
            if(request()->session()->get('verify')['type'] == 'su'){
                return view('dashboard.set.index');
            }elseif(request()->session()->get('verify')['type'] == 'u'){
                return view('dashboard.set.lower');
            }
        }
    }


    return view('dashboard.set.verify');

})->name('dashboard.set');

Route::get('/pdo',function(){

    $db = \App\Models\SqlServer\EmpMaster::query()->where('EmpNo','=','0090-8')->first();
    return dd($db);
    $serverName = "10.36.1.105\SRA";

    $connectionInfo = array("Database"=>"GASS","UID" => "sa", "PWD" => 'noliboy');
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if($conn){
        echo "Connection established. <br>";
        $tsql = "SELECT * FROM dbo.EmpMaster";

        $stmt = sqlsrv_query( $conn, $tsql );

        if( $stmt === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            echo $row['LastName'].", ".$row['FirstName']."<br />";
        }

        sqlsrv_free_stmt( $stmt);


    }else{
        echo "Connection failed: <br>";
        die(print_r(sqlsrv_errors(), true));
    }
});

