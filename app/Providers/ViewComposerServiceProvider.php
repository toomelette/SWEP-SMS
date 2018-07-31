<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        
        // USERMENU
        View::composer('*', 'App\Swep\ViewComposers\UserMenuComposer');


        // MENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Swep\ViewComposers\MenuComposer');
        

        // SUBMENU
        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Swep\ViewComposers\SubmenuComposer');


        // PROJECT
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index',
                        'dashboard.disbursement_voucher.save_as',
                        'dashboard.employee.create',
                        'dashboard.employee.edit',], 'App\Swep\ViewComposers\ProjectComposer');


        // FUND SOURCE
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.save_as',
                        'dashboard.disbursement_voucher.user_index'], 'App\Swep\ViewComposers\FundSourceComposer');


        // Disbursement Voucher
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit', 
                        'dashboard.disbursement_voucher.save_as',
                        'printables.disbursement_voucher'], 'App\Swep\ViewComposers\DisbursementVoucherComposer');


        // DEPARTMENT
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index',
                        'dashboard.disbursement_voucher.save_as',
                        'dashboard.department_unit.create',
                        'dashboard.department_unit.edit',
                        'dashboard.project_code.create',
                        'dashboard.project_code.edit',
                        'dashboard.employee.create',
                        'dashboard.employee.edit'], 'App\Swep\ViewComposers\DepartmentComposer');


        // DEPARTMENT UNITS
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index',
                        'dashboard.disbursement_voucher.save_as',
                        'dashboard.employee.create',
                        'dashboard.employee.edit'], 'App\Swep\ViewComposers\DepartmentUnitComposer');


        // PROJECT CODES
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.save_as',
                        'dashboard.disbursement_voucher.user_index'], 'App\Swep\ViewComposers\ProjectCodeComposer');
        

        // SIGNATORIES
        View::composer(['printables.disbursement_voucher',
                        'dashboard.leave_application.create',
                        'dashboard.leave_application.edit',
                        'dashboard.signatory.create',
                        'dashboard.signatory.edit'], 'App\Swep\ViewComposers\SignatoryComposer');



        // EMPLOYEES
        View::composer(['dashboard.user.sync_employee',], 'App\Swep\ViewComposers\EmployeeComposer');

        
    }

    
    
    public function register(){

      
    
    }




}
