<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class FundSource extends Model{





	use Sortable;

    protected $table = 'acctg_fund_sources';

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






    /** RELATIONSHIPS **/
    public function disbursementVoucher() {
      return $this->belongsTo('App\Models\DisbursementVoucher','fund_source_id','fund_source_id');
    }








}
