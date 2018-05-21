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




    protected $fillable = [
        
        'name',
        'route',
        'is_nav',

    ];




    protected $attributes = [

        'slug' => '',
        'submenu_id' => '',
        'menu_id' => '',
        'is_nav' => false,
        'name' => '',
        'route' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    // RELATIONSHIPS
    public function menu() {

    	return $this->belongsTo('App\Models\Menu','menu_id','menu_id');

   	}




    // SCOPES

    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('name', 'LIKE', '%'. $key .'%')
                      ->orwhere('route', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }




   	// GETTERS

    public function getSubmenuIdIncAttribute(){

        $id = 'SM100001';

        $submenu = $this->select('submenu_id')->orderBy('submenu_id', 'desc')->first();

        if($submenu != null){

            $num = str_replace('SM', '', $submenu->submenu_id) + 1;
            
            $id = 'SM' . $num;
        
        }
        
        return $id;
        
    }




}
