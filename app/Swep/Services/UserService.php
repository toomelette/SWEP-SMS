<?php
 
namespace App\Swep\Services;

use Hash;
use App\User;
use App\Menu;
use App\Submenu;
use App\UserMenu;
use App\UserSubmenu;
use Illuminate\Http\Request;


 
class UserService{


	protected $user;
    protected $menu;
    protected $user_menu;
    protected $submenu;
    protected $user_submenu;



    public function __construct(User $user, Menu $menu, SubMenu $submenu, UserMenu $user_menu, UserSubMenu $user_submenu){

        $this->user = $user;
        $this->menu = $menu;
        $this->user_menu = $user_menu;
        $this->submenu = $submenu;
        $this->user_submenu = $user_submenu;

    }




    public function fetchAll(Request $request){
    	


    }




    public function store(Request $request){

        if(!$this->user->usernameExist($request->username) == 1){

            $user = new User;
            $user->firstname = $request->firstname;
            $user->middlename = $request->middlename;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->position = $request->position;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

                for($i = 0; $i < count($request->menu); $i++){

                    $menu = $this->menu->whereMenuId($request->menu[$i])->first();

                    $user_menu = new UserMenu;
                    $user_menu->user_id = $user->user_id;
                    $user_menu->menu_id = $menu->menu_id;
                    $user_menu->name = $menu->name;
                    $user_menu->route = $menu->route;
                    $user_menu->icon = $menu->icon;
                    $user_menu->is_dropdown = $menu->is_dropdown;            
                    $user_menu->save();

                }

            return 'saved';

        }
        
        return 'Error';

    }




    public function show($slug){



    }




    public function edit($slug){

    	

    }




    public function update(Request $request, $slug){



    }




    public function delete($slug){



    }




}