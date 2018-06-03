<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable{


    use Notifiable, Sortable;
    

    protected $dates = ['created_at', 'updated_at', 'last_login_time'];

    public $sortable = ['username', 'firstname', 'is_online', 'is_active'];

    public $timestamps = false;




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
        'color' => 'skin-green sidebar-mini', 
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
        'last_login_time' => null,
        'last_login_machine' => '',
        'last_login_ip' => '',

    ];





    // RELATIONSHIPS 

    public function disbursementVoucher() {
      return $this->belongsTo('App\Models\DisbursementVoucher','user_id','user_id');
    }


    public function leaveApplication() {
      return $this->belongsTo('App\Models\LeaveApplication','user_id','user_id');
    }


    public function userMenu() {
        return $this->hasMany('App\Models\UserMenu','user_id','user_id');
    }


    public function userSubmenu() {
        return $this->hasMany('App\Models\UserSubmenu','user_id','user_id');
    }


    public function employee() {
      return $this->hasOne('App\Models\Employee','user_id','user_id');
    }
    

    




    /** GETTERS **/
    
    public function getUserIdIncAttribute(){

        $id = 'U10001';

        $user = $this->select('user_id')->orderBy('user_id', 'desc')->first();

        if($user != null){

            if($user->user_id != null){

                $num = str_replace('U', '', $user->user_id) + 1;
                
                $id = 'U' . $num;
            
            }
        
        }
        
        return $id;
        
    }





    public function getFullnameShortAttribute(){

        return strtoupper(substr($this->firstname , 0, 1) . ". " . $this->lastname);

    }





    public function getFullnameAttribute(){

        return strtoupper($this->firstname . " " . substr($this->middlename , 0, 1) . ". " . $this->lastname);

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

        return $query->where('is_online', $value);

    }





    public function scopeFilterIsActive($query, $value){

        return $query->where('is_active', $value);

    }





    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->with(['userMenu', 'userMenu.userSubMenu'])->firstOrFail();

    }
    




    public function scopePopulate($query){

        return $query->select('username', 'firstname', 'middlename', 'lastname', 'is_online', 'is_active', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }





}
