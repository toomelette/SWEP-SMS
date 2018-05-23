<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class FundSource extends Model{

	use Sortable;

    protected $table = 'fund_sources';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['description'];

	public $timestamps = false;



    protected $attributes = [

        'slug' => '',
        'fund_source_id' => '',
        'description' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    // RELATIONSHIPS

    public function disbursementVoucher() {
      
      return $this->belongsTo('App\Models\DisbursementVoucher','fund_source_id','fund_source_id');

    }



    // SCOPES

    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('description', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }



    // GETTERS

    public function getFundSourceIdIncAttribute(){

        $id = 'FS1001';

        $fund_source = $this->select('fund_source_id')->orderBy('fund_source_id', 'desc')->first();

        if($fund_source != null){

            $num = str_replace('FS', '', $fund_source->fund_source_id) + 1;
            
            $id = 'FS' . $num;
        
        }
        
        return $id;
        
    }





}
