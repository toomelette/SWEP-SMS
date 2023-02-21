<?php


namespace App\Http\Requests\SMS\Form5;


use Illuminate\Foundation\Http\FormRequest;

class ServedFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    
    public function rules(){
        return [

        ];
    }
}