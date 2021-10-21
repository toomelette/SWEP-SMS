<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\Traits\LogsActivity;


class Submenu extends Model{
	



	use Sortable, LogsActivity;

    protected $table = 'su_submenus';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['name', 'route', 'is_nav'];

    public $timestamps = false;

    protected static $logName = 'submenu';
    protected static $logAttributes = ['*'];
    protected static $ignoreChangedAttributes = ['updated_at','ip_updated','user_updated'];
    protected static $logOnlyDirty = true;



    /** RELATIONSHIPS **/
    public function menu() {
    	return $this->belongsTo('App\Models\Menu','menu_id','menu_id');
   	}







}
