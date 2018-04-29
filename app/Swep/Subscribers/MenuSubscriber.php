<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;



class MenuSubscriber{


    protected $menu;
    protected $submenu;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(Menu $menu, SubMenu $submenu, Carbon $carbon, Str $str){

        $this->menu = $menu;
        $this->submenu = $submenu;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }



    public function subscribe($events){

        $events->listen('menu.create', 'App\Swep\Subscribers\MenuSubscriber@onCreate');

    }



    // public function onCreate($menu, $request){

    //     $this->createDefaults($menu);

    //     for($i = 0; $i < count($request->menu); $i++){



    //     }
        
    // }



    /** DEFAULTS **/

    public function createDefaults($menu){

        $menu->menu_id = $this->menu->menuIdIncrement;
        $menu->slug = $this->str->random(16);
        $menu->created_at = $this->carbon->now();
        $menu->updated_at = $this->carbon->now();
        $menu->machine_created = gethostname();
        $menu->machine_updated = gethostname();
        $menu->ip_created = request()->ip();
        $menu->ip_updated = request()->ip();
        $menu->user_created = $this->auth->user()->user_id;
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();

    }



    public function updateDefaults($menu){

        $menu->updated_at = $this->carbon->now();
        $menu->machine_updated = gethostname();
        $menu->ip_updated = request()->ip();
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();

    }



    /** UTILITY METHODS **/

    // public function createUserMenu($user_menu, $user, $menu){

    //     $user_menu->user_menu_id = $this->user_menu->userMenuIdIncrement;
    //     $user_menu->user_id = $user->user_id;
    //     $user_menu->menu_id = $menu->menu_id;
    //     $user_menu->name = $menu->name;
    //     $user_menu->route = $menu->route;
    //     $user_menu->icon = $menu->icon;
    //     $user_menu->is_menu = $menu->is_menu;
    //     $user_menu->is_dropdown = $menu->is_dropdown;
    //     $user_menu->save();

    // }





}