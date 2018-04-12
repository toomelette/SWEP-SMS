<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        View::composer('*', 'App\Swep\ViewComposers\UserMenuComposer');

        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Swep\ViewComposers\MenuComposer');

        View::composer(['dashboard.user.create', 
                        'dashboard.user.edit'], 'App\Swep\ViewComposers\SubmenuComposer');

        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit'], 'App\Swep\ViewComposers\ProjectsComposer');

        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit'], 'App\Swep\ViewComposers\FundSourceComposer');

        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit', 
                        'printables.disbursement_voucher'], 'App\Swep\ViewComposers\ModeOfPaymentComposer');

        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit'], 'App\Swep\ViewComposers\DepartmentsComposer');

        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit'], 'App\Swep\ViewComposers\DepartmentUnitsComposer');

        View::composer(['dashboard.disbursement_voucher.create', 
                        'dashboard.disbursement_voucher.edit'], 'App\Swep\ViewComposers\AccountsComposer');
        
        View::composer(['printables.disbursement_voucher'], 'App\Swep\ViewComposers\SignatoriesComposer');
        
    }

    
    public function register(){

      
    
    }



}
