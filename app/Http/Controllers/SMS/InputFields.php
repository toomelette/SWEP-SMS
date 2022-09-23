<?php


namespace App\Http\Controllers\SMS;


use Illuminate\Database\Eloquent\Model;

class InputFields extends Model
{
    protected $table = 'su_input_fields';

    public function getFields($for){
        return InputFields::query()->where('for','=',$for)->get();
    }

    public function getFieldsAsArray($for){
        $input_fields = InputFields::query()->where('for','=',$for)->get();
        $arr = [];
        if(!empty($input_fields)){
            foreach ($input_fields as $input_field){
                $arr[$input_field->field] = $input_field->display_name;
            }
        }
        return $arr;
    }
}