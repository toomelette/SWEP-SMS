<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class LeaveApplication extends Model{


	use Sortable;

	protected $table = 'leave_application';

    protected $dates = ['working_days_date_from', 'working_days_date_to', 'created_at', 'updated_at'];

	public $timestamps = false;
    



	// RELATIONSHIPS
	public function user(){
        return $this->hasOne('App\Models\User', 'user_id', 'user_id');
    }




    protected $attributes = [
        
        'slug' => '',
        'leave_application_id' => '',
        'doc_no' => '',
        'agency' => 'Sugar Regulatory Administration',
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'date_of_filing' => null,
        'position' => '',
        'salary' => 0.00,
        'type' => '',
        'type_vacation' => '',
        'type_vacation_others_specific' => '',
        'type_others_specific' => '',
        'spent_vacation' => '',
        'spent_vacation_abroad_specific' => '',
        'spent_sick' => '',
        'spent_sick_inhospital_specific' => '',
        'spent_sick_outpatient_specific' => '',
        'working_days' => '',
        'working_days_date_from' => null,
        'working_days_date_to' => null,
        'commutation' => '',
        'immediate_superior' => '',
        'immediate_superior_position' => '',
        'immediate_superior_type' => null,
        'personnel_officer' => '',
        'personnel_officer_position' => '',
        'authorized_official' => '',
        'authorized_official_position' => '',
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



    public function scopePopulateByUser($query, $id){

        return $query->where('user_id', $id)->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }
    


    public function scopeSearch($query, $key){

        $query->where(function ($query) use ($key) {
            $query->where('lastname', 'LIKE', '%'. $key .'%')
                 ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                 ->orwhere('middlename', 'LIKE', '%'. $key .'%')
                 ->orwhereHas('user', function ($query) use ($key) {
                    $query->where('username', 'LIKE', '%'. $key .'%');
                });
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }





    // GETTERS
    public function getLeaveApplicationIdIncAttribute(){

        $id = 'LA1000001';

        $la = $this->select('leave_application_id')->orderBy('leave_application_id', 'desc')->first();

        if($la != null){

            $num = str_replace('LA', '', $la->leave_application_id) + 1;
            
            $id = 'LA' . $num;
        
        }
        
        return $id;
        
    }





}
