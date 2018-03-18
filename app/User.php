<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable{


    use Notifiable;



    protected $fillable = [

        'user_id', 
        'email', 
        'username', 
        'password', 
        'lastname', 
        'middlename', 
        'firstname', 
        'position', 
        'is_logged', 
        'is_active',
        'color', 
        'created_at', 
        'updated_at',
        'machine_created',
        'machine_updated', 
        'ip_created',
        'ip_updated',
        'user_created',
        'user_updated',
        'last_login_time',
        'last_login_machine',
        'last_login_ip',
    ];

    


    protected $hidden = [

        'password', 'remember_token',

    ];



    /** RELATIONSHIPS **/

    public function userMenu() {

        return $this->hasMany('App\UserMenu','user_id','user_id');

    }
    



    
}
