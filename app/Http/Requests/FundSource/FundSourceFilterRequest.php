<?php

namespace App\Http\Requests\FundSource;

use Illuminate\Foundation\Http\FormRequest;

class FundSourceFilterRequest extends FormRequest{
    


    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',

        ];

    }





}
