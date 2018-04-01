<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model{
	
	
    protected $table = 'submenu';


    public function menu() {

    	return $this->belongsTo('App\Models\Menu','menu_id','menu_id');

   	}



}
