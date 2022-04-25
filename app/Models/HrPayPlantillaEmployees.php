<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class HrPayPlantillaEmployees extends Model
{
    protected $table = 'hr_pay_plantilla_employees';
    protected $fillable = ['item_no','employee_no','appointment_date'];
    public function employee(){
        return $this->hasOne(Employee::class,'employee_no','employee_no');
    }
}