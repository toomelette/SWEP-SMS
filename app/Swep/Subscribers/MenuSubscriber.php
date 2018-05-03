<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class MenuSubscriber{


    protected $menu;
    protected $submenu;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(Menu $menu, Submenu $submenu, Carbon $carbon, Str $str){

        $this->menu = $menu;
        $this->submenu = $submenu;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('menu.create', 'App\Swep\Subscribers\MenuSubscriber@onCreate');

    }



    public function onCreate($menu, $request){

        $this->menuCreateDefaults($menu);

        $rows = $request->row;

        foreach ($rows as $row) {
            
            $submenu = new Submenu;
            $submenu->menu_id = $menu->menu_id;
            $submenu->name = $row['sub_name'];
            $submenu->route = $row['sub_route'];
            $submenu->is_nav = DataTypeHelper::boolean($row['sub_is_nav']);
            $this->submenuCreateDefaults($submenu);    
            $submenu->save();

        }

        CacheHelper::deletePattern('swep_cache:menu:all');

    }



    /** DEFAULTS **/

    public function menuCreateDefaults($menu){

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



    public function submenuCreateDefaults($submenu){

        $submenu->submenu_id = $this->submenu->submenuIdIncrement;
        $submenu->created_at = $this->carbon->now();
        $submenu->updated_at = $this->carbon->now();
        $submenu->machine_created = gethostname();
        $submenu->machine_updated = gethostname();
        $submenu->ip_created = request()->ip();
        $submenu->ip_updated = request()->ip();
        $submenu->user_created = $this->auth->user()->user_id;
        $submenu->user_updated = $this->auth->user()->user_id;
        $submenu->save();

    }



    public function updateDefaults($menu){

        $menu->updated_at = $this->carbon->now();
        $menu->machine_updated = gethostname();
        $menu->ip_updated = request()->ip();
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();

    }




}