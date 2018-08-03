<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class Memo extends Model{



	use Sortable;

    protected $table = 'memos';

    protected $dates = ['date', 'created_at', 'updated_at'];

    public $sortable = ['reference_no', 'date', 'subject', 'remarks'];

	public $timestamps = false;





    protected $attributes = [
        
        'slug' => '',
        'memo_id' => '',
        'reference_no' => '',
        'date' => null,
        'person_to' => '',
        'person_from' => '',
        'type' => '',
        'subject' => '',
        'remarks' => '',
        'category' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    






}
