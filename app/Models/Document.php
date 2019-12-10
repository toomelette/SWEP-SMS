<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Document extends Model{


	use Sortable;

    protected $table = 'rec_documents';

    protected $dates = ['date', 'created_at', 'updated_at'];

    public $sortable = ['reference_no', 'date', 'person_to', 'person_from', 'subject'];

	public $timestamps = false;




    protected $attributes = [
        
        'slug' => '',
        'document_id' => '',
        'folder_code' => '',
        'folder_code2' => '',
        'reference_no' => '',
        'date' => null,
        'person_to' => '',
        'person_from' => '',
        'type' => '',
        'subject' => '',
        'category' => '',
        'filename' => '',
        'year' => null,
        'remarks' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];

    

    // Relationships

    public function documentDisseminationLog(){
        return $this->hasMany('App\Models\DocumentDisseminationLog', 'document_id', 'document_id');
    }



}
