<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable{


    use Notifiable;

    

    protected $fillable = [

        'email', 'username', 'password', 'is_logged' 
    
    ];

    

    protected $hidden = [

        'password', 'remember_token',

    ];


    

    
}
