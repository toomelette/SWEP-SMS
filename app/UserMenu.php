<?php

namespace App;

use Auth;
use Route;
use Illuminate\Database\Eloquent\Model;



class UserMenu extends Model{



	protected $table = 'user_menu';
  public $timestamps = false;
    

	/** RELATIONSHIPS **/

	public function user() {
      
      return $this->belongsTo('App\User','user_id','user_id');

    }




    public function userSubMenu() {

    	return $this->hasMany('App\UserSubMenu','user_menu_id','user_menu_id');

   	}



    /** GETTERS **/

    public function getUserNav() {

    	return $this->userSubmenu->where('is_nav', true);

    }




    public function getCountUserMenu() {

      return count($this->where('route', Route::currentRouteName())
                            ->where('user_id', Auth::user()->user_id)
                            ->first());

    }




}
