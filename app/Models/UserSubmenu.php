<?php

namespace App\Models;

use Auth;
use Route;
use Cache;
use Illuminate\Database\Eloquent\Model;

class UserSubmenu extends Model{


    protected $table = 'user_submenus';
    public $timestamps = false;



    /** RELATIONSHIPS **/

    public function userMenu() {

    	return $this->belongsTo('App\Models\UserMenu','user_menu_id','user_menu_id');

   	}



    public function user() {
      
      return $this->belongsTo('App\Models\User','user_id','user_id');

    }



   	/** GETTERS **/

   	public function getCountUserSubmenu() {

      $userSubMenu = Cache::remember('nav:user_submenus:byUserId:' . Auth::user()->user_id .':byRoute:'. Route::currentRouteName(), 240, function(){
            return $this->where('route', Route::currentRouteName())
                        ->where('user_id', Auth::user()->user_id)
                        ->first();
        });

      return count($userSubMenu);

    }



}
