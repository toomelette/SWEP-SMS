<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeOfPayment extends Model{


    protected $table = 'mode_of_payment';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;

}
