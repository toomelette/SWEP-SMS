<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeOfPayment extends Model{


    protected $table = 'modes_of_payment';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;



	// RELATIONSHIPS 

	public function disbursementVoucher() {
      
      return $this->belongsTo('App\Models\DisbursementVoucher','mode_of_payment_id','mode_of_payment_id');

    }




}
