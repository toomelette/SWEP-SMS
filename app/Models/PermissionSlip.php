<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class PermissionSlip extends Model{

    use Sortable;
    
	protected $table = 'permission_slip';

    protected $dates = ['date', 'created_at', 'updated_at'];

    public $sortable = ['ps_id', 'date', 'time_out', 'time_in'];

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




    /** Scopes **/
    public function scopeMonthlyPS($query, $df, $dt){

        return $query->select('ps_id', 'employee_no', 'date', 'time_out', 'time_in', 'with_ps')
                     ->whereBetween('date', [$df, $dt])
                     ->get();

    }




    public function scopeDailyPS($query, $date){

        return $query->select('date', 'time_out', 'time_in')
                     ->where('date', $date)
                     ->get();

    }



    
}
