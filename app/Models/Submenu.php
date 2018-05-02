<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model{
	
	
    protected $table = 'submenu';


    public function menu() {

    	return $this->belongsTo('App\Models\Menu','menu_id','menu_id');

   	}





   	// GETTERS

    public function getLastSubmenuAttribute(){

        $submenu = $this->select('submenu_id')->orderBy('submenu_id', 'desc')->first();

        if($submenu != null){

          return str_replace('SM', '', $submenu->submenu_id);

        }

        return null;

    }



    public function getSubmenuIdIncrementAttribute(){

        $id = '100001';

        if($id != null){

            $num =  $this->lastSubmenu + 1;
            
            $id = 'SM' . $num;
        
        }

        return $id;

    }




}
