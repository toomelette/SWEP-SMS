<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Signatory extends Model{




    use Sortable;

    protected $table = 'su_signatories';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['employee_name', 'employee_position', 'type'];

	public $timestamps = false;






    protected $attributes = [

        'slug' => '',
        'signatory_id' => '',
        'employee_name' => '', 
        'employee_position' => '', 
        'type' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];







}