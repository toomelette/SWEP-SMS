<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DepartmentTree extends Model
{
    protected $table = 'new_table';


    public function children(){
        return $this->hasMany(DepartmentTree::class ,'parent_id','item_id');
    }

    public function parent(){
        return $this->belongsTo(DepartmentTree::class,'parent_id','item_id');
    }

    public function plantillas(){
        return $this->hasMany(HrPlantilla::class,'parent_id','item_id');
    }
}