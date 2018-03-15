<?php

namespace App;

use Auth;
use Route;
use Illuminate\Database\Eloquent\Model;

class UserSubmenu extends Model{


    protected $table = 'user_submenu';



    /** RELATIONSHIPS **/

    public function userMenu() {

    	return $this->belongsTo('App\UserMenu','user_menu_id','user_menu_id');

   	}



   	/** GETTERS **/

   	public function getCountUserSubmenu() {

      return count($this->where('route', Route::currentRouteName())
                            ->where('user_id', Auth::user()->user_id)
                            ->first());

    }



}
