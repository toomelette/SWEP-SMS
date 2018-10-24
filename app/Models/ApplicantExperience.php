<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




class ApplicantExperience extends Model{
    


	protected $table = 'hr_applicant_experiences';

    protected $dates = ['date_from', 'date_to'];

	public $timestamps = false;




    protected $attributes = [

        'applicant_id' => '',
        'date_from' => null,
        'date_to' => null,
        'position' => '',
        'company' => '',
        'is_gov_service' => false,

    ];





    /** RELATIONSHIPS **/
    public function employee() {
        return $this->belongsTo('App\Models\Applicant','applicant_id','applicant_id');
    }





}
