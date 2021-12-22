<?php


namespace App\Swep\ViewComposers;


use App\Models\Menu;
use App\Models\UserSubmenu;
use Illuminate\Support\Facades\Auth;

class TreeComposer
{
    public function compose($view){
        $tree = [];
        $menus = Menu::with('submenu')->get();

        $user_submenus = UserSubmenu::with('submenu')->where('user_id', Auth::user()->user_id)
            ->whereHas('submenu', function ($query) {
            return $query->where('is_nav', '=', 1);
        })->get();


        $dtr_menu = Menu::query()->where('slug','=','OjM6liSKVeDpwZQc')->first();
        $tree['HR']['GMPLGA']['menu_obj'] = $dtr_menu;
        foreach ($dtr_menu->submenu->where('is_nav','=',1)->where('route','!=','dashboard.dtr.extract')->where('route','!=','dashboard.dtr.index') as $submenu){
            $tree['HR']['GMPLGA']['submenus'][$submenu->submenu_id] = $submenu;
        }


        foreach ($user_submenus as $user_submenu){
            $tree[$user_submenu->submenu->menu->category][$user_submenu->submenu->menu->menu_id]['menu_obj'] = $user_submenu->submenu->menu;
            $tree[$user_submenu->submenu->menu->category][$user_submenu->submenu->menu->menu_id]['submenus'][$user_submenu->submenu_id] = $user_submenu->submenu;
        }





        $view->with(['tree' => $tree]);

    }


}