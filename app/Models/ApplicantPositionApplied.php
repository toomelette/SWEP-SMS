<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ApplicantPositionApplied extends Model
{
    protected $table = "hr_applicant_position_applied";

    public $timestamps = false;

    public function applicant(){
        return $this->belongsTo('App\Models\Applicant','applicant_slug','slug');
    }
}