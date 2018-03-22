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




    public function getLastUserMenuAttribute(){

        $usermenu = $this->select('user_menu_id')->orderBy('user_menu_id', 'desc')->first();
        
        if($usermenu != null){

          return str_replace('UM', '', $usermenu->user_menu_id);

        }

        return null; 

    }




    public function getUserMenuIdIncrementAttribute(){

        $id = 'UM10000001';

        if($this->lastUserMenu != null){

            $num =  $this->lastUserMenu + 1;
            
            $id = 'UM' . $num;

        }

        return $id;

    }




}
