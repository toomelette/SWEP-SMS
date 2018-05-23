<?php
 
namespace App\Swep\Services;


use Hash;
use App\Models\User;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\UserMenu;
use App\Models\UserSubmenu;
use App\Swep\BaseClasses\BaseService;



class UserService extends BaseService{



	protected $user;
    protected $menu;
    protected $submenu;
    protected $user_menu;
    protected $user_submenu;



    public function __construct(User $user, Menu $menu, SubMenu $submenu, UserMenu $user_menu, UserSubmenu $user_submenu){

        $this->user = $user;
        $this->menu = $menu;
        $this->submenu = $submenu;
        $this->user_menu = $user_menu;
        $this->user_submenu = $user_submenu;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $users = $this->cache->remember('users:all:' . $key, 240, function() use ($request){

            $user = $this->user->newQuery();
            
            if($request->q != null){
                $user->search($request->q);
            }
            
            if($request->ol != null){
                $user->filterIsOnline($this->dataTypeHelper->string_to_boolean($request->ol));
            }

            if($request->a != null){
                 $user->filterIsActive($this->dataTypeHelper->string_to_boolean($request->a));
            }

            return $user->populate();

        });

        $request->flash();
        
        return view('dashboard.user.index')->with('users', $users);

    }






    public function store($request){

        if(!$this->user->usernameExist($request->username) == 1){

            $user = new User;
            $user->slug = $this->str->random(16);
            $user->user_id = $this->user->userIdInc;
            $user->firstname = $request->firstname;
            $user->middlename = $request->middlename;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->position = $request->position;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->created_at = $this->carbon->now();
            $user->updated_at = $this->carbon->now();
            $user->ip_created = request()->ip();
            $user->ip_updated = request()->ip();
            $user->user_created = $this->auth->user()->username;
            $user->user_updated = $this->auth->user()->username;
            $user->save();

            if(count($request->menu) > 0){

                for($i = 0; $i < count($request->menu); $i++){

                    $menu = $this->menu->whereMenuId($request->menu[$i])->first();

                    $user_menu = new UserMenu;
                    $this->storeUserMenu($user_menu, $user, $menu);

                    if($request->submenu > 0){

                        foreach($request->submenu as $data_submenu){

                            $submenu = $this->submenu->whereSubmenuId($data_submenu)->first();

                            if($menu->menu_id === $submenu->menu_id){

                                $user_submenu = new UserSubMenu;
                                $this->storeUserSubmenu($user_submenu, $submenu, $user_menu);

                            }

                        }

                    }

                }

            }

            $this->event->fire('user.store', $request);
            return redirect()->back();

        }

        $this->session->flash('USER_FORM_FAIL_USERNAME_EXIST', 'The username you provided is already used by an existing account. Please provide another username.');
        return redirect()->back()->withInput();

    }






    public function show($slug){
        
        $user = $this->userBySlug($slug);  
        return view('dashboard.user.show')->with('user', $user);

    }






    public function edit($slug){

    	$user = $this->userBySlug($slug);  
        return view('dashboard.user.edit')->with('user', $user);

    }






    public function update($request, $slug){

        $user = $this->userBySlug($slug);
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->username = $request->username;
        $user->updated_at = $this->carbon->now();
        $user->ip_updated = request()->ip();
        $user->user_updated = $this->auth->user()->username;
        $user->save();

        $user->userMenu()->delete();
        $user->userSubmenu()->delete();

        if(count($request->menu) > 0){

            for($i = 0; $i < count($request->menu); $i++){

                $menu = $this->menu->whereMenuId($request->menu[$i])->first();

                $user_menu = new UserMenu;
                $this->storeUserMenu($user_menu, $user, $menu);

                if($request->submenu > 0){

                    foreach($request->submenu as $data_submenu){

                        $submenu = $this->submenu->whereSubmenuId($data_submenu)->first();

                        if($menu->menu_id === $submenu->menu_id){

                            $user_submenu = new UserSubMenu;
                            $this->storeUserSubmenu($user_submenu, $submenu, $user_menu);

                        }

                    }

                }

            }
            
        }

        $this->event->fire('user.update', $user);
        return redirect()->route('dashboard.user.index');

    }






    public function delete($slug){

        $user = $this->userBySlug($slug);  
        $user->delete();
        $user->userMenu()->delete();
        $user->userSubmenu()->delete();

        $this->event->fire('user.destroy', $user);
        return redirect()->back();

    }






    public function activate($slug){

        $user = $this->userBySlug($slug);  

        if($user->is_active == 0){

            $user->is_active = 1;
            $user->save();

            $this->event->fire('user.activate', $user);
            return redirect()->back();

        }

        return redirect()->back();

    }






    public function deactivate($slug){

        $user = $this->userBySlug($slug);  

        if($user->is_active == 1){
            
            $user->is_active = 0;
            $user->is_online = 0;
            $user->save();
            
            $this->event->fire('user.deactivate', $user);
            return redirect()->back();

        }

        return redirect()->back();

    }






    public function logout($slug){

        $user = $this->userBySlug($slug);  

        if($user->is_active == 1 && $user->is_online == 1){

            $user->is_online= 0;
            $user->save();

            $this->event->fire('user.logout', $user);
            return redirect()->back();

        }

        return redirect()->back();

    }






    public function resetPassword($slug){

        $user = $this->userBySlug($slug); 
        return view('dashboard.user.reset_password')->with('user', $user);

    }






    public function resetPasswordPost($request, $slug){

        $user = $this->userBySlug($slug);  

        if ($request->username == $this->auth->user()->username && Hash::check($request->user_password, $this->auth->user()->password)) {
            
            if($user->username == $this->auth->user()->username){

                $this->session->flash('USER_RESET_PASSWORD_OWN_ACCOUNT_FAIL', 'Please refer to profile page if you want to reset your own password.');
                return redirect()->back();

            }else{

                $user->password = Hash::make($request->password);
                $user->is_online = 0;
                $user->save();

                $this->event->fire('user.reset_password_post', $user);
                return redirect()->route('dashboard.user.index');

            }
            
        }

        $this->session->flash('USER_RESET_PASSWORD_CONFIRMATION_FAIL', 'The credentials you provided does not match the current user!');
        return redirect()->back();

    }





    // Utility Methods

    public function userBySlug($slug){

        $user = $this->cache->remember('users:bySlug:' . $slug, 240, function() use ($slug){
            return $this->user->findSlug($slug);
        }); 
        
        return $user;

    }





    public function storeUserMenu($user_menu, $user, $menu){

        $user_menu->user_menu_id = $this->user_menu->userMenuIdInc;
        $user_menu->user_id = $user->user_id;
        $user_menu->menu_id = $menu->menu_id;
        $user_menu->name = $menu->name;
        $user_menu->route = $menu->route;
        $user_menu->icon = $menu->icon;
        $user_menu->is_menu = $menu->is_menu;
        $user_menu->is_dropdown = $menu->is_dropdown; 
        $user_menu->save();

    }





    public function storeUserSubmenu($user_submenu, $submenu, $user_menu){

        $user_submenu->submenu_id = $submenu->submenu_id;
        $user_submenu->user_menu_id = $user_menu->user_menu_id;
        $user_submenu->user_id = $user_menu->user_id;
        $user_submenu->is_nav = $submenu->is_nav;
        $user_submenu->name = $submenu->name;
        $user_submenu->route = $submenu->route;
        $user_submenu->save();

    }





}