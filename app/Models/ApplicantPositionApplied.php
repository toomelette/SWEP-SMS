<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;




class ApplicantPositionApplied extends Model{
    



	protected $table = 'applicant_position_applied';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['position'];

	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'applicant_pa_id' => '',
        'position' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];






}
