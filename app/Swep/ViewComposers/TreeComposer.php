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


        $dtr_menus = Menu::query()
            ->where('slug','=','OjM6liSKVeDpwZQc')
            ->orWhere('slug','=','ptQX7MfbtJR2EtIf')
            ->get();
        foreach ($dtr_menus as $dtr_menu){
            $tree[$dtr_menu->category][$dtr_menu->menu_id]['menu_obj'] = $dtr_menu;
            foreach (
                $dtr_menu->submenu->
                where('is_nav','=',1)
                    ->where('route','!=','dashboard.dtr.extract')
                    ->where('route','!=','dashboard.dtr.index')
                    ->where('route','!=','dashboard.mis_requests.index')
                as $submenu){
                $tree[$dtr_menu->category][$dtr_menu->menu_id]['submenus'][$submenu->submenu_id] = $submenu;
            }
        }




        foreach ($user_submenus as $user_submenu){
            $tree[$user_submenu->submenu->menu->category][$user_submenu->submenu->menu->menu_id]['menu_obj'] = $user_submenu->submenu->menu;
            $tree[$user_submenu->submenu->menu->category][$user_submenu->submenu->menu->menu_id]['submenus'][$user_submenu->submenu_id] = $user_submenu->submenu;
        }





        $view->with(['tree' => $tree]);

    }


}