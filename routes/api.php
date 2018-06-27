<?php

Route::get('/select_response_submenu_from_menu/{key}', 'ApiController@selectResponseSubmenuFromMenu')
		->name('selectResponseSubmenuFromMenu');

Route::get('/select_response_department_units_from_department/{key}', 'ApiController@selectResponseDepartmentUnitsFromDepartments')
		->name('selectResponseDepartmentUnitsFromDepartments');

Route::get('/select_response_project_codes_from_department/{key}', 'ApiController@selectResponseProjectCodesFromDepartments')
		->name('selectResponseProjectCodesFromDepartments');

Route::get('/textbox_response_departmentName_from_departmentId/{key}', 'ApiController@textboxResponseDepartmentNameFromDepartmentId')
		->name('textboxResponseDepartmentNameFromDepartmentId');