<?php

Route::get('/dropdown_response_submenu_from_menu/{key}', 'ApiController@dropdownResponseSubmenuFromMenu')->name('dropdownResponseSubmenuFromMenu');

Route::get('/dropdown_response_department_units_from_department/{key}', 'ApiController@dropdownResponseDepartmentUnitsFromDepartments')->name('dropdownResponseDepartmentUnitsFromDepartments');

Route::get('/dropdown_response_accounts_from_department/{key}', 'ApiController@dropdownResponseAccountsFromDepartments')->name('dropdownResponseAccountsFromDepartments');