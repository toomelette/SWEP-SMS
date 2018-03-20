<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        View::composer('*', 'App\Swep\ViewComposers\UserMenuComposer');
        View::composer(['dashboard.user.create'], 'App\Swep\ViewComposers\MenuComposer');
        
    }

    
    public function register(){

      
    
    }



}
