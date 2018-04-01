<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{


    protected $table = 'menu';


    public function user() {

    	return $this->belongsTo('App\Models\User','user_id','user_id');

   	}


    public function submenu() {

    	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');

   	}



}
