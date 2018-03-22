<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable{


    use Notifiable;


    protected $dates = ['created_at', 'updated_at', 'last_login_time'];
   

    public $timestamps = false;


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



    protected $attributes = [

        'user_id' => '', 
        'email' => '', 
        'username' => '', 
        'password' => '', 
        'lastname' => '', 
        'middlename' => '', 
        'firstname' => '', 
        'position' => '', 
        'is_logged' => false, 
        'is_active' => false,
        'color' => '', 
        'created_at' => null, 
        'updated_at' => null,
        'machine_created' => '',
        'machine_updated' => '', 
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
        'last_login_time' => null,
        'last_login_machine' => '',
        'last_login_ip' => '',

    ];



    /** RELATIONSHIPS **/

    public function userMenu() {

        return $this->hasMany('App\UserMenu','user_id','user_id');

    }
    

    /** SCOPES **/

    public function scopeUsernameExist($query, $value){

        return $query->where('username', $value)->count();

    }
    

    /** GETTERS **/
    
    public function getLastUserAttribute(){

        $user = $this->select('user_id')->orderBy('user_id', 'desc')->first();

        if($user != null){

          return str_replace('U', '', $user->user_id);

        }

        return null;

    }



    public function getUserIdIncrementAttribute(){

        $id = '10001';

        if($id != null){

            $num =  $this->lastUser + 1;
            
            $id = 'U' . $num;
        
        }

        return $id;

    }



}
