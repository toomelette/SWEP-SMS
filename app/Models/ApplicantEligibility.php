<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantEligibility extends Model{
    
	protected $table = 'hr_applicant_eligibilities';

    protected $dates = ['exam_date'];

	public $timestamps = false;




    protected $attributes = [

        'applicant_id' => '',
        'eligibility' => '',
        'level' => '',
        'rating' => 0.00,
        'exam_place' => '',
        'exam_date' => null,

    ];





    /** RELATIONSHIPS **/
    public function applicant() {
        return $this->belongsTo('App\Models\Applicant','applicant_id','applicant_id');
    }


}
