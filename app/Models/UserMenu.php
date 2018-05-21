<?php

namespace App\Models;

use Auth;
use Route;
use Cache;
use Illuminate\Database\Eloquent\Model;



class UserMenu extends Model{


    protected $table = 'user_menus';
    
    public $timestamps = false;
    


	/** RELATIONSHIPS **/

	public function user() {
      
      return $this->belongsTo('App\Models\User','user_id','user_id');

    }





    public function userSubMenu() {

    	return $this->hasMany('App\Models\UserSubmenu','user_menu_id','user_menu_id');

   	}





    /** GETTERS **/

    public function getUserMenuIdIncAttribute(){

        $id = 'UM10000001';

        $usermenu = $this->select('user_menu_id')->orderBy('user_menu_id', 'desc')->first();

        if($usermenu != null){

            $num = str_replace('UM', '', $usermenu->user_menu_id) + 1;
            
            $id = 'UM' . $num;
        
        }
        
        return $id;
        
    }





    public function getUserNav() {

    	return $this->userSubmenu->where('is_nav', true);

    }





    public function getFetchUserSubmenu() {

        return $this->userSubmenu->where('user_menu_id', $this->user_menu_id);



    }



    /** GETTERS **/

    public function getCountUserMenu() {

        $userMenu = Cache::remember('nav:user_menus:byUserId:' . Auth::user()->user_id .':byRoute:'. Route::currentRouteName(), 240, function(){
            $num = $this->where('route', Route::currentRouteName())->where('user_id', Auth::user()->user_id)->first();
            return count($num);
        });

        return $userMenu;

    }





}
