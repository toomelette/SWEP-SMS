<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class Course extends Model{



	protected $table = 'courses';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['acronym', 'description'];

	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'course_id' => '',
        'acronym' => '',
        'description' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    


    
}
