<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model{


    protected $table = 'accounts';

    protected $dates = ['date_started', 'projected_date_end', 'created_at', 'updated_at'];

	public $timestamps = false;



	public function departments() {
      
      return $this->belongsTo('App\Models\Departments','department_id','department_id');

    }



}
