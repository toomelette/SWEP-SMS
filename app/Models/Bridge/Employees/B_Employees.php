<?php


namespace App\Models\Bridge\Employees;


use Illuminate\Database\Eloquent\Model;

class B_Employees extends Model
{
    protected $connection = 'swep_bridge';
    protected $table = 'hr_employees';
    protected $guarded = ['id','slug'];

    public function employeeEducationalBackground(){
        return $this->hasMany(B_EducationalBg::class, 'employee_no', 'employee_no');
    }
}