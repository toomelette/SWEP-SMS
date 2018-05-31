<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Signatory extends Model{

    use Sortable;

    protected $table = 'signatories';

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




    // SCOPES
    public function scopePopulate($query){

        return $query->select('employee_name', 'employee_position', 'type', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

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



    // GETTERS

    public function getSignatoryIdIncAttribute(){

        $id = 'S1001';

        $signatory = $this->select('signatory_id')->orderBy('signatory_id', 'desc')->first();

        if($signatory != null){
            
            if($signatory->signatory_id != null){

                $num = str_replace('S', '', $signatory->signatory_id) + 1;
                
                $id = 'S' . $num;
            
            }
        
        }
        
        return $id;
          
    }




}