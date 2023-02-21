<?php


namespace App\Http\Requests\SMS\Form5a;


use Illuminate\Foundation\Http\FormRequest;

class IssuanceFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    
    public function rules(){
        return [
           'trader' => 'required|string|max:255',
        ];
    }
}