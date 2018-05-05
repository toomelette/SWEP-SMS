<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Menu extends Model{

    use Sortable;

    protected $table = 'menu';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;



    protected $fillable = [
		
        'slug',
        'menu_id',
        'name',
        'route',
        'icon',
        'is_menu',
        'is_dropdown',

        'created_at',
        'updated_at',
        'machine_created',
        'machine_updated',
        'ip_created',
        'ip_updated',
        'user_created',
        'user_updated',

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
        'machine_created' => '',
        'machine_updated' => '',
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

        return $query->sortable()->paginate(10);

    }




    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }





    // GETTERS

    public function getLastMenuAttribute(){

        $menu = $this->select('menu_id')->orderBy('menu_id', 'desc')->first();

        if($menu != null){

          return str_replace('M', '', $menu->menu_id);

        }

        return null;
        
    }




    public function getMenuIdIncrementAttribute(){

        $id = '10001';

        if($id != null){

            $num =  $this->lastMenu + 1;
            
            $id = 'M' . $num;
        
        }

        return $id;

    }




}
