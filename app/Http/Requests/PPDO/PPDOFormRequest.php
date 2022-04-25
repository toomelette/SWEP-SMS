<?php


namespace App\Http\Requests\PPDO;


use Illuminate\Foundation\Http\FormRequest;

class PPDOFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'ppdo_code' => 'required|string|max:255',
            'resp_center' => 'required|string|max:255',
            'ps' => 'required',
            'co' => 'required',
            'mooe' => 'required',
        ];
    }
}