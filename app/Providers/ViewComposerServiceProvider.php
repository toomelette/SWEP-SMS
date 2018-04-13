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
                        'dashboard.disbursement_voucher.index'], 'App\Swep\ViewComposers\ProjectsComposer');


        // FUND SOURCE
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index'], 'App\Swep\ViewComposers\FundSourceComposer');


        // MODE OF PAYMENT
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit', 
                        'printables.disbursement_voucher'], 'App\Swep\ViewComposers\ModeOfPaymentComposer');


        // DEPARTMENT
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index'], 'App\Swep\ViewComposers\DepartmentsComposer');


        // DEPARTMENT UNITS
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index'], 'App\Swep\ViewComposers\DepartmentUnitsComposer');


        //ACCOUNTS
        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit',
                        'dashboard.disbursement_voucher.index'], 'App\Swep\ViewComposers\AccountsComposer');
        

        //SIGNATORIES
        View::composer(['printables.disbursement_voucher'], 'App\Swep\ViewComposers\SignatoriesComposer');

        
    }

    
    public function register(){

      
    
    }



}
