<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class LeaveCard extends Model{


	use Sortable;

	protected $table = 'leave_card';

    protected $dates = ['date', 'date_from', 'date_to', 'created_at', 'updated_at'];

	public $timestamps = false;




	protected $attributes = [
        
        'slug' => '',
        'leave_card_id' => '',
        'employee_no' => '',
        'doc_type' => '',
        'leave_type' => '',
        'month' => '',
        'year' => 0,
        'date' => null,
        'date_from' => null,
        'date_to' => null,
        'days' => 0,
        'hrs' => 0,
        'mins' => 0,
        'credits' => 0.00, 
        'remarks' => '',         
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




    /** Scopes **/
    public function scopeCountTardy($query, $month, $year){

        return $query->where('month', $month)
                     ->where('year', $year)
                     ->where('doc_type', 'TARDY')
                     ->get()
                     ->count();

    }





    public function scopeCountUndertime($query, $month, $year){

        return $query->where('month', $month)
                     ->where('year', $year)
                     ->where('doc_type', 'UT')
                     ->get()
                     ->count();

    }





    public function scopeGetLeave($query, $month, $year){

        return $query->select('leave_type', 'date_from', 'date_to', 'days')
                     ->where('month', $month)
                     ->where('year', $year)
                     ->where('doc_type', 'LEAVE')
                     ->get();

    }





    public function scopeGetLeaveVacation($query, $month, $year){

        return $query->select('leave_type', 'date_from', 'date_to', 'days')
                     ->where('month', $month)
                     ->where('year', $year)
                     ->where('doc_type', 'LEAVE')
                     ->where('leave_type', 'VL')
                     ->get();

    }





    public function scopeGetLeaveSick($query, $month, $year){

        return $query->select('leave_type', 'date_from', 'date_to', 'days')
                     ->where('month', $month)
                     ->where('year', $year)
                     ->where('doc_type', 'LEAVE')
                     ->where('leave_type', 'SL')
                     ->get();

    }





    public function scopeGetLeaveForced($query, $month, $year){

        return $query->select('leave_type', 'date_from', 'date_to', 'days')
                     ->where('month', $month)
                     ->where('year', $year)
                     ->where('doc_type', 'LEAVE')
                     ->where('leave_type', 'FL')
                     ->get();

    }





    
}
