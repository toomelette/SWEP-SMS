<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Account extends Model{

	use Sortable;

    protected $table = 'accounts';

    protected $dates = ['date_started', 'projected_date_end', 'created_at', 'updated_at'];

    public $sortable = ['department_name', 'account_code', 'description', 'project_in_charge'];

	public $timestamps = false;



	protected $fillable = [

        'department_id',
        'department_name',
        'account_code',
        'description',
        'mooe',
        'co',
        'date_started',
        'projected_date_end',
        'project_in_charge',

    ];




    protected $attributes = [

        'slug' => '',
        'department_id' => '',
        'department_name' => '',
        'account_code' => '',
        'description' => '',
        'mooe' => 0.00,
        'co' => 0.00,
        'date_started' => null,
        'projected_date_end' => null,
        'project_in_charge' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



	public function department() {
      
      return $this->belongsTo('App\Models\Department','department_id','department_id');

    }




    // SCOPES

    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('department_name', 'LIKE', '%'. $key .'%')
                	  ->orwhere('account_code', 'LIKE', '%'. $key .'%')
                	  ->orwhere('description', 'LIKE', '%'. $key .'%')
                	  ->orwhere('project_in_charge', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }




    // GETTERS

    public function getAccountIdIncrementAttribute(){

        $account = $this->select('account_id')->orderBy('account_id', 'desc')->first();

        if($account->account_id != null){

            $id = str_replace('A', '', $account->account_id);
            $num = $id + 1;
            
            return 'A' . $num;
        
        }
        
        return 'A1001';
        
    }




}