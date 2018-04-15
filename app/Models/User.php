<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable{


    use Notifiable;
    

    protected $dates = ['created_at', 'updated_at', 'last_login_time'];

    public $timestamps = false;


    protected $fillable = [

        'slug',
        'user_id', 
        'email', 
        'username', 
        'password', 
        'lastname', 
        'middlename', 
        'firstname', 
        'position', 
        'is_online', 
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

        'slug' => '',
        'user_id' => '', 
        'email' => '', 
        'username' => '', 
        'password' => '', 
        'lastname' => '', 
        'middlename' => '', 
        'firstname' => '', 
        'position' => '', 
        'is_online' => false, 
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


    public function disbursementVouchers() {
      
      return $this->belongsTo('App\Models\DisbursementVouchers','user_id','user_id');

    }



    public function userMenu() {

        return $this->hasMany('App\Models\UserMenu','user_id','user_id');

    }



    public function userSubmenu() {

        return $this->hasMany('App\Models\UserSubmenu','user_id','user_id');

    }
    


    /** GETTERS **/
    
    public function getFullnameShortAttribute(){

        return strtoupper(substr($this->firstname , 0, 1) . ". " . $this->lastname);

    }


    public function getFullnameAttribute(){

        return strtoupper($this->firstname . " " . substr($this->middlename , 0, 1) . ". " . $this->lastname);

    }
    

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



    /** SCOPES **/

    public function scopeUsernameExist($query, $value){

        return $query->where('username', $value)->count();

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('firstname', 'LIKE', '%'. $key .'%')
                      ->orwhere('middlename', 'LIKE', '%'. $key .'%')
                      ->orwhere('lastname', 'LIKE', '%'. $key .'%')
                      ->orwhere('username', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFilterIsOnline($query, $value){

        return $query->where('is_online', $this->getBoolean($value));

    }



    public function scopeFilterIsActive($query, $value){

        return $query->where('is_active', $this->getBoolean($value));

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }
    


    public function scopePopulate($query){

        return $query->orderBy('updated_at', 'DESC')->paginate(10);

    }



    /** UTILS **/

    public function getBoolean($value){

        if($value == 'true'){

            return true;

        }elseif($value == 'false'){

            return false;

        }
        
    }



}
