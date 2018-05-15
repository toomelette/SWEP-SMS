<?php

namespace App\Models;

use Auth;
use Route;
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

    public function getUserNav() {

    	return $this->userSubmenu->where('is_nav', true);

    }



    public function getFetchUserSubmenu() {

        return $this->userSubmenu->where('user_menu_id', $this->user_menu_id);



    }



    public function getCountUserMenu() {

      return count($this->where('route', Route::currentRouteName())
                            ->where('user_id', Auth::user()->user_id)
                            ->first());

    }




    public function getLastUserMenuAttribute(){

        $usermenu = $this->select('user_menu_id')->orderBy('user_menu_id', 'desc')->first();
        
        if($usermenu != null){

          return str_replace('UM', '', $usermenu->user_menu_id);

        }

        return null; 

    }




    public function getUserMenuIdIncrementAttribute(){

        $id = '10000001';

        if($this->lastUserMenu != null){

            $num =  $this->lastUserMenu + 1;
            
            $id = 'UM' . $num;

        }

        return $id;

    }




}
