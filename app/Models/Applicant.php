<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Applicant extends Model{

	use Sortable;

    protected $table = 'applicants';

    protected $dates = ['date_of_birth', 'created_at', 'updated_at'];

    public $sortable = ['applicant_id', 'fullname', 'gender'];

	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'applicant_id' => '',
        'course_id' => '',
        'applicant_pa_id' => '',
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'fullname' => '',
        'gender' => '',
        'date_of_birth' => null,
        'civil_status' => '',
        'address' => '',
        'contact_no' => '',
        'remarks' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





    /** RELATIONSHIPS **/
    public function applicantEducationalBackground() {
        return $this->hasMany('App\Models\ApplicantEducationalBackground','applicant_id','applicant_id');
    }


	public function applicantExperience() {
        return $this->hasMany('App\Models\ApplicantExperience','applicant_id','applicant_id');
    }


    public function applicantTraining() {
        return $this->hasMany('App\Models\ApplicantTraining','applicant_id','applicant_id');
    }
    


    
}
