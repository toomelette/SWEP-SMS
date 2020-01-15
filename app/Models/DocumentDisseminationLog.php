<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentDisseminationLog extends Model{


    protected $table = 'rec_document_dissemination_logs';

    protected $dates = ['sent_at'];

	public $timestamps = false;



    protected $attributes = [
        
        'slug' => '',
        'type' => '',
        'document_id' => '',
        'employee_no' => '',
        'department_unit_id' => '',
        'email' => '',
        'subject' => '',
        'content' => '',
        'status' => '',
        'sent_at' => null,
        'ip_sent' => '',
        'user_sent' => '',

    ];

    

    // Relationships

    public function document(){
        return $this->belongsTo('App\Models\Document', 'document_id', 'document_id');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee', 'employee_no', 'employee_no');
    }

    public function departmentUnit(){
        return $this->belongsTo('App\Models\DepartmentUnit', 'department_unit_id', 'department_unit_id');
    }
    


    
}
