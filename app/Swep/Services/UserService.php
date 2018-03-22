<?php
 
namespace App\Swep\Services;

use Hash;
use App\User;
use App\Menu;
use App\Submenu;
use App\UserMenu;
use App\UserSubmenu;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;

use Carbon\Carbon;
use Auth;

class UserService{


	protected $user;
    protected $menu;
    protected $user_menu;
    protected $submenu;
    protected $user_submenu;
    protected $event;



    public function __construct(User $user, Menu $menu, SubMenu $submenu, UserMenu $user_menu, UserSubMenu $user_submenu, Dispatcher $event){

        $this->user = $user;
        $this->menu = $menu;
        $this->user_menu = $user_menu;
        $this->submenu = $submenu;
        $this->user_submenu = $user_submenu;
        $this->event = $event;

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

            $this->event->fire('user.create', [$user, $request]);

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