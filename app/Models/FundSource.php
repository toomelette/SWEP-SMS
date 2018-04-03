<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FundSource extends Model{


    protected $table = 'fund_source';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;

}
