<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentDisseminationLog extends Model{


    protected $table = 'rec_document_dissemination_logs';

    protected $dates = ['sent_at'];

	public $timestamps = false;



    protected $attributes = [
        
        'slug' => '',
        'document_id' => '',
        'employee_no' => '',
        'email' => '',
        'subject' => '',
        'content' => '',
        'status' => '',
        'sent_at' => null,
        'ip_sent' => '',
        'user_sent' => '',

    ];
    


    
}
