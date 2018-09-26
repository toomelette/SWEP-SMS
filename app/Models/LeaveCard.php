<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class LeaveCard extends Model{


	use Sortable;

	protected $table = 'leave_card';

    protected $dates = ['date_from', 'date_to', 'created_at', 'updated_at'];

	public $timestamps = false;




	protected $attributes = [
        
        'slug' => '',
        'leave_card_id' => '',
        'employee_no' => '',
        'doc_type' => '',
        'leave_type' => '',
        'month' => '',
        'year' => 0,
        'date_from' => null,
        'date_to' => null,
        'time_from' => null,
        'time_to' => null,
        'days' => 0,
        'hrs' => 0,
        'mins' => 0,
        'credits' => 0.00,
        'bigbal_sick_leave' => 0.00,
        'bigbal_vacation_leave' => 0.00,
        'bigbal_overtime' => 0.00,
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
