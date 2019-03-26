<?php

namespace App\Models;


use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;



class DisbursementVoucher extends Model{





    use Sortable;

	protected $table = 'acctg_disbursement_vouchers';

	protected $dates = ['processed_at', 'checked_at', 'created_at', 'updated_at', 'date', 'certified_by_sig_date', 'approved_by_sig_date'];

    public $sortable = ['doc_no', 'dv_no', 'payee', 'date'];
    
	public $timestamps = false;






    protected $attributes = [

        'slug' => '',
        'user_id' => '', 
        'doc_no' => '', 
        'dv_no' => '', 
        'date' => null, 
        'project_id' => '', 
        'fund_source_id' => '', 
        'mode_of_payment' => '',
        'payee' => '', 
        'address' => '', 
        'tin' => '',
        'bur_no' => '', 
        'department_name' => '', 
        'department_unit_name' => '',
        'project_code' => '',
        'explanation' => '', 
        'amount' => 0.00,
        'certified_by' => '',
        'certified_by_position' => '',
        'approved_by' => '',
        'approved_by_position' => '',
        'processed_at' => null,
        'checked_at' => null,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];






    /** RELATIONSHIPS **/
    public function user(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }

    public function project(){
        return $this->hasOne('App\Models\Project', 'project_id', 'project_id');
    }

    public function departmentUnit(){
        return $this->hasOne('App\Models\DepartmentUnit', 'name', 'department_unit_name');
    }


    public function fundSource(){
        return $this->hasOne('App\Models\FundSource', 'fund_source_id', 'fund_source_id');
    }







}
