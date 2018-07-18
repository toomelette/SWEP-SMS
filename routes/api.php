<?php



// Universal
Route::get('/select_response_submenu_from_menu/{key}', 'Api\ApiUniversalController@selectResponseSubmenuFromMenu')
		->name('selectResponseSubmenuFromMenu');

Route::get('/select_response_department_units_from_department/{key}', 'Api\ApiUniversalController@selectResponseDepartmentUnitsFromDepartments')
		->name('selectResponseDepartmentUnitsFromDepartments');

Route::get('/select_response_project_codes_from_department/{key}', 'Api\ApiUniversalController@selectResponseProjectCodesFromDepartments')
		->name('selectResponseProjectCodesFromDepartments');

Route::get('/textbox_response_departmentName_from_departmentId/{key}', 'Api\ApiUniversalController@textboxResponseDepartmentNameFromDepartmentId')
		->name('textboxResponseDepartmentNameFromDepartmentId');




// Employee
Route::get('/employee/serviceRecord/{slug}/edit', 'Api\ApiEmployeeController@editServiceRecord')
		->name('api.employee_serviceRecord_edit');

Route::get('/employee/training/{slug}/edit', 'Api\ApiEmployeeController@editTraining')
		->name('api.employee_training_edit');




// User
Route::get('/user/response_from_employee/{key}', 'Api\ApiUserController@responseFromEmployee')
		->name('api.user_response_from_employee');