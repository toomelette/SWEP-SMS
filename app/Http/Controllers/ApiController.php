<?php

namespace App\Http\Controllers;

use App\SubMenu;
use Illuminate\Http\Request;


class ApiController extends Controller{


	protected $submenu;


	public function __construct(SubMenu $submenu){

		$this->submenu = $submenu;

	}



	public function dropdownResponseSubmenuFromMenu(Request $request, $key){

    	if($request->Ajax()){

	    	$response_submenu = $this->submenu->select('submenu_id', 'name')->where('menu_id', $key)->get();
	    	return json_encode($response_submenu);

	    }

	    return abort(404);

    }


    
}
