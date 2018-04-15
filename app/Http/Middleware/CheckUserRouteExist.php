<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserMenu;
use App\Models\UserSubmenu;

class CheckUserRouteExist{


    protected $user_menu;
    protected $user_submenu;


    public function __construct(UserMenu $user_menu, UserSubmenu $user_submenu){

        $this->user_menu = $user_menu;
        $this->user_submenu = $user_submenu;
        
    }
  



    public function handle($request, Closure $next){
        
        if($this->user_menu->getCountUserMenu() == 1 || $this->user_submenu->getCountUserSubmenu() == 1){

            return $next($request);

        }

        return abort(403);
    
    }




}
