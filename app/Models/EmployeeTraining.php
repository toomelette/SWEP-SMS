<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class EmployeeTraining extends Model{


	use Sortable;

    protected $table = 'employee_trainings';

    protected $dates = ['datefrom', 'dateto', 'created_at', 'updated_at'];

    public $timestamps = false;




    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','empno','empno');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('seqno', 'asc')->get();

    }
    

}
