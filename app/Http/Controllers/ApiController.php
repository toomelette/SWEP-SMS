<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Cache\Repository as Cache;

class ApiController extends Controller{


	protected $cache;
	protected $submenu;




	public function __construct(SubMenu $submenu, Cache $cache){

		$this->submenu = $submenu;
		$this->cache = $cache;

	}



	public function dropdownResponseSubmenuFromMenu(Request $request, $key){

    	if($request->Ajax()){

    		$response_submenu = $this->cache->remember('api:response_submenu_from_menu:byMenuId:'. $key .'', 240, function() use ($key){
        		return $this->submenu->select('submenu_id', 'name')->where('menu_id', $key)->get();
       		});

	    	return json_encode($response_submenu);

	    }

	    return abort(404);

    }




    
}
