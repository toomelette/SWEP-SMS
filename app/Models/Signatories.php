<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signatories extends Model{


    protected $table = 'signatories';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;
	

}