<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionSlip extends Model{


	protected $table = 'permission_slip';

    protected $dates = ['date', 'time_out', 'time_in', 'created_at', 'updated_at'];

	public $timestamps = false;



    protected $attributes = [

        'slug' => '',
        'ps_id' => '',
        'employee_no' => '',
        'date' => null,
        'time_out' => null,
        'time_in' => null,
        'with_ps' => false,
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    /** RELATIONSHIPS **/
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }





    
}
