<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




class ApplicantEducationalBackground extends Model{


    protected $table = 'applicant_educational_background';

	public $timestamps = false;





    protected $attributes = [

        'applicant_id' => '',
        'course' => '',
        'school' => '',
        'units' => '',
        'graduate_year' => '',

    ];





    /** RELATIONSHIPS **/
    public function employee() {
        return $this->belongsTo('App\Models\Applicant','applicant_id','applicant_id');
    }





}
