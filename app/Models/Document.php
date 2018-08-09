<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model{


	use Sortable;

    protected $table = 'documents';

    protected $dates = ['date', 'year', 'created_at', 'updated_at'];

    public $sortable = ['reference_no', 'date', 'person_to', 'person_from', 'subject', 'folder_code'];

	public $timestamps = false;




    protected $attributes = [
        
        'slug' => '',
        'doc_id' => '',
        'folder_code' => '',
        'reference_no' => '',
        'date' => null,
        'person_to' => '',
        'person_from' => '',
        'type' => '',
        'subject' => '',
        'category' => '',
        'filename' => '',
        'year' => '',
        'remarks' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];

    



}
