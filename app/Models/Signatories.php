<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Signatories extends Model{

    use Sortable;

    protected $table = 'signatories';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['employee_name', 'employee_position', 'type'];

	public $timestamps = false;



	protected $fillable = [

        'slug',
        'employee_name', 
        'employee_position', 
        'type',
        'created_at', 
        'updated_at',
        'machine_created',
        'machine_updated', 
        'ip_created',
        'ip_updated',
        'user_created',
        'user_updated',

    ];



    protected $attributes = [

        'slug' => '',
        'employee_name' => '', 
        'employee_position' => '', 
        'type' => '',
        'created_at' => null, 
        'updated_at' => null,
        'machine_created' => '',
        'machine_updated' => '', 
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    // SCOPES
    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('employee_name', 'LIKE', '%'. $key .'%')
                      ->orwhere('employee_position', 'LIKE', '%'. $key .'%')
                      ->orwhere('type', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }


}