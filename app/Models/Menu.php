<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{

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



}
