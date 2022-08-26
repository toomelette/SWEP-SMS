<?php


namespace App\Models\Bridge\Employees;


use Illuminate\Database\Eloquent\Model;

class B_EducationalBg extends Model
{
    protected $connection = 'swep_bridge';
    protected $table = 'hr_employee_educational_background';
    protected $guarded = ['id'];



}