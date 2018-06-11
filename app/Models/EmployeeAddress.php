<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model{



	protected $table = 'employee_address';

    public $timestamps = false;
    

	protected $attributes = [
        
        'employee_no' => '',
        'res_address_block' => '',
        'res_address_street' => '',
        'res_address_village' => '',
        'res_address_barangay' => '',
        'res_address_city' => '',
        'res_address_province' => '',
        'res_address_zipcode' => '',
        'perm_address_block' => '',
        'perm_address_street' => '',
        'perm_address_village' => '',
        'perm_address_barangay' => '',
        'perm_address_city' => '',
        'perm_address_province' => '',
        'perm_address_zipcode' => '',

    ];



    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }


    
}
