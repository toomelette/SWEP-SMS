<?php


namespace App\Swep\ViewComposers;


use App\Models\Menu;
use App\Models\UserSubmenu;
use App\Swep\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class TreeComposer
{
    public function compose($view){
        $tree = [];

        $user_submenus = UserSubmenu::with('submenu.menu')->where('user_id', Auth::user()->user_id)
            ->whereHas('submenu', function ($query) {
                return $query->where('is_nav', '=', 1);
            });

        //FETCH USER LEVEL MENUS
        if(Auth::user()->no_user_access  != 1){
            $userLevelMenus = Menu::query()->where('category','=','USER')->orderBy('created_at','asc')->get();

            if(!empty($userLevelMenus)){
                foreach ($userLevelMenus as $userLevelMenu){
                    if(!empty($userLevelMenu->submenu)){
                        foreach ($userLevelMenu->submenu as $submenu){
                            $tree[$userLevelMenu->category][$userLevelMenu->menu_id]['menu_obj']= $userLevelMenu;
                            $tree[$userLevelMenu->category][$userLevelMenu->menu_id]['submenus'][$submenu->submenu_id] = $submenu;
                        }
                    }
                }
            }
        }
        $user_submenus = $user_submenus->get();





        foreach ($user_submenus as $user_submenu){
   
            if($user_submenu->submenu->menu->category != 'PPU'){
            $tree[$user_submenu->submenu->menu->category][$user_submenu->submenu->menu->menu_id]['menu_obj'] = $user_submenu->submenu->menu;
            $tree[$user_submenu->submenu->menu->category][$user_submenu->submenu->menu->menu_id]['submenus'][$user_submenu->submenu_id] = $user_submenu->submenu;
            }
        }

        $view->with(['tree' => $tree]);

    }


}