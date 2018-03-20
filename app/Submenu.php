<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model{
	
	
    protected $table = 'submenu';


    public function menu() {

    	return $this->belongsTo('App\Menu','menu_id','menu_id');

   	}



}
