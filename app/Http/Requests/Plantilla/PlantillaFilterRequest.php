<?php

namespace App\Http\Requests\Plantilla;

use Illuminate\Foundation\Http\FormRequest;

class PlantillaFilterRequest extends FormRequest{
   



    public function authorize(){

        return true;
    
    }





    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            'du' => 'nullable|string|max:20',

        ];
    
    }




}
