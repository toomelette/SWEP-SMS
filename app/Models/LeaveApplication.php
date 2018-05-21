<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model{

	protected $table = 'leave_application';

    protected $dates = ['working_days_date_from', 'working_days_date_to', 'created_at', 'updated_at'];

	public $timestamps = false;
    
}
