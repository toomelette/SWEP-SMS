<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisbursementVouchers extends Model{

	protected $table = 'disbursement_vouchers';

	protected $dates = ['created_at', 'updated_at', 'date'];

	public $timestamps = false;


	protected $fillable = [
		
        'slug',
        'user_id', 
        'doc_no', 
        'dv_no', 
        'date', 
        'project_id', 
        'fund_source', 
        'mode_of_payment', 
        'payee', 
        'address', 
        'tin',
        'bur_no', 
        'department_code', 
        'unit_code',
        'account_code',
        'explanation', 
        'amount',
        'certified_by',
        'certified_by_position',
        'certified_by_sig_date',
        'approved_by',
        'approved_by_position',
        'approved_by_sig_date',
        'created_at',
        'updated_at',
        'machine_created',
        'machine_updated',
        'ip_created',
        'ip_updated',

    ];


    protected $attributes = [

        'slug' => '',
        'user_id' => '', 
        'doc_no' => '', 
        'dv_no' => '', 
        'date' => '', 
        'project_id' => '', 
        'fund_source' => '', 
        'mode_of_payment' => '', 
        'payee' => '', 
        'address' => '', 
        'tin' => '',
        'bur_no' => '', 
        'department_code' => '', 
        'unit_code' => '',
        'account_code' => '',
        'explanation' => '', 
        'amount' => '',
        'certified_by' => '',
        'certified_by_position' => '',
        'certified_by_sig_date' => '',
        'approved_by' => '',
        'approved_by_position' => '',
        'approved_by_sig_date' => '',
        'created_at' => null,
        'updated_at' => null,
        'machine_created' => '',
        'machine_updated' => '',
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



    
}
