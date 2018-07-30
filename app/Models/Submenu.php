<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Submenu extends Model{
	



	use Sortable;

    protected $table = 'submenus';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['name', 'route', 'is_nav'];

    public $timestamps = false;





    /** RELATIONSHIPS **/
    public function menu() {

    	return $this->belongsTo('App\Models\Menu','menu_id','menu_id');

   	}







}
