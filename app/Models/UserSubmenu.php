<?php

namespace App\Models;

use Auth;
use Route;
use Illuminate\Database\Eloquent\Model;

class UserSubmenu extends Model{


    protected $table = 'user_submenu';
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

      return count($this->where('route', Route::currentRouteName())
                            ->where('user_id', Auth::user()->user_id)
                            ->first());

    }



}
