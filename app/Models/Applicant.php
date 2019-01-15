<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Applicant extends Model{


	use Sortable;

    protected $table = 'hr_applicants';

    protected $dates = ['date_of_birth', 'created_at', 'updated_at'];

    public $sortable = ['plantilla_id', 'course_id', 'fullname', 'date_of_birth', 'is_on_short_list'];

	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'department_unit_id' => '',
        'applicant_id' => '',
        'course_id' => '',
        'plantilla_id' => '',
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'fullname' => '',
        'gender' => '',
        'date_of_birth' => null,
        'civil_status' => '',
        'address' => '',
        'contact_no' => '',
        'school' => '',
        'remarks' => '',
        'is_on_short_list' => false,
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


    public function applicantEligibility() {
        return $this->hasMany('App\Models\ApplicantEligibility','applicant_id','applicant_id');
    }



    public function plantilla() {
        return $this->belongsTo('App\Models\Plantilla','plantilla_id','plantilla_id');
    }


    public function course() {
        return $this->belongsTo('App\Models\Course','course_id','course_id');
    }


    public function departmentUnit() {
        return $this->belongsTo('App\Models\DepartmentUnit','department_unit_id','department_unit_id');
    }
    


    
}
