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
                        'dashboard.disbursement_voucher.user_index'], 'App\Swep\ViewComposers\ProjectComposer');


        // FUND SOURCE
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index'], 'App\Swep\ViewComposers\FundSourceComposer');


        // MODE OF PAYMENT
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit', 
                        'printables.disbursement_voucher'], 'App\Swep\ViewComposers\ModeOfPaymentComposer');


        // DEPARTMENT
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index',
                        'dashboard.department_unit.create',
                        'dashboard.department_unit.edit',
                        'dashboard.account.create',
                        'dashboard.account.edit',], 'App\Swep\ViewComposers\DepartmentComposer');


        // DEPARTMENT UNITS
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index'], 'App\Swep\ViewComposers\DepartmentUnitComposer');


        //ACCOUNTS
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index',
                        'dashboard.disbursement_voucher.user_index'], 'App\Swep\ViewComposers\AccountComposer');
        

        //SIGNATORY
        View::composer(['printables.disbursement_voucher'], 'App\Swep\ViewComposers\SignatoryComposer');

        
    }

    
    
    public function register(){

      
    
    }




}
