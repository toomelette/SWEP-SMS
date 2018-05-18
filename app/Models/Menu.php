<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Menu extends Model{

    use Sortable;

    protected $table = 'menus';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;



    protected $fillable = [
		
        'menu_id',
        'name',
        'route',
        'icon',
        'is_menu',
        'is_dropdown',

    ];




    protected $attributes = [

        'slug' => '',
        'menu_id' => '',
        'name' => '',
        'route' => '',
        'icon' => '',
        'is_menu' => false,
        'is_dropdown' => false,

        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    public function user() {

    	return $this->belongsTo('App\Models\User','user_id','user_id');

   	}




    public function submenu() {

    	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');

   	}

    


    // SCOPE

    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('name', 'LIKE', '%'. $key .'%');
        });

    }




    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }




    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }





    // GETTERS

    public function getMenuIdIncAttribute(){

        $id = 'M10001';

        $menu = $this->select('menu_id')->orderBy('menu_id', 'desc')->first();

        if($menu != null){

            $num = str_replace('M', '', $menu->menu_id) + 1;
            
            $id = 'M' . $num;
        
        }
        
        return $id;
        
    }


}
