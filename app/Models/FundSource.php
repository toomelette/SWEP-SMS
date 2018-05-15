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



	protected $fillable = [

        'description',

    ];




    protected $attributes = [

        'slug' => '',
        'description' => '',
        'created_at' => null, 
        'updated_at' => null,
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
                $query->where('description', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }



    // GETTERS

    public function getLastFundSourceAttribute(){

        $fund_source = $this->select('fund_source_id')->orderBy('fund_source_id', 'desc')->first();

        if($fund_source != null){

          return str_replace('FS', '', $fund_source->fund_source_id);

        }

        return null;
        
    }




    public function getFundSourceIdIncrementAttribute(){

        $id = 'FS1001';

        if($this->lastFundSource != null){

            $num =  $this->lastFundSource + 1;
            
            $id = 'FS' . $num;
        
        }

        return $id;

    }




}
