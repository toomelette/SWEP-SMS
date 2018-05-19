<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{


    protected $table = 'projects';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;




	// RELATIONSHIPS 

	public function disbursementVoucher() {
      
      return $this->belongsTo('App\Models\DisbursementVoucher','project_id','project_id');

    }




    
}
