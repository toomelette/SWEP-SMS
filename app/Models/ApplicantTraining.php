<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantTraining extends Model{
    


	protected $table = 'applicant_trainings';

    protected $dates = ['date_from', 'date_to'];

	public $timestamps = false;





    protected $attributes = [

        'applicant_id' => '',
        'title' => '',
        'date_from' => null,
        'date_to' => null,
        'venue' => '',
        'conducted_by' => '',
        'remarks' => '',

    ];





    /** RELATIONSHIPS **/
    public function employee() {
        return $this->belongsTo('App\Models\Applicant','applicant_id','applicant_id');
    }



}
