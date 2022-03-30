<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class HRTrainingsServer5 extends Model
{
    protected $connection = 'server5';
    protected $table = 'hr_employee_trainings_qc_temp';
}