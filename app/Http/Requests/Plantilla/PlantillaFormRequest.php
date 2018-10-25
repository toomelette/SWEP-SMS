<?php

namespace App\Http\Requests\Plantilla;

use Illuminate\Foundation\Http\FormRequest;

class PlantillaFormRequest extends FormRequest{
   



    public function authorize(){

        return true;
    
    }





    public function rules(){

        return [

            'department_unit_id' => 'required|max:11|string',
            'name' => 'required|max:255|string',
            'is_vacant' => 'required|max:11|string',

        ];
    
    }




}
