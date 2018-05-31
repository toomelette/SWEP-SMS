<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class EmployeeTraining extends Model{




	use Sortable;

    protected $table = 'employee_trainings';

    protected $dates = ['datefrom', 'dateto', 'created_at', 'updated_at'];

    public $timestamps = false;





    protected $attributes = [
        
        'employee_id' => '',
        'empno' => '',
        'seqno' => null,
        'topics' => '',
        'conductedby' => '',
        'datefrom' => null,
        'dateto' => null,
        'venue' => '',
        'hours' => null,
        'remarks' => '',

    ];






    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','empno','empno');
    }
    




    // SCOPES
    public function scopePopulate($query){

        return $query->select('topics', 'conductedby', 'datefrom', 'dateto', 'venue')
                     ->orderBy('seqno', 'asc')
                     ->get();

    }
    


}
