<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class Course extends Model{


    use Sortable;

	protected $table = 'hr_courses';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['acronym', 'name'];

	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'course_id' => '',
        'acronym' => '',
        'name' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];
    


    
}
