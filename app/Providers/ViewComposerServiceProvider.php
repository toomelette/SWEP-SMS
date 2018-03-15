<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        View::composer('*', 'App\Swep\ViewComposers\UserMenuComposer');
        
    }

    
    public function register(){

      
    
    }



}
