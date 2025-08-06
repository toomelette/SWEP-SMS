<?php


namespace App\Http\Requests\SMS;


use Illuminate\Foundation\Http\FormRequest;

class CancellationFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    
    public function rules(){
        return [
           'reason' => 'required|string',
        ];
    }
}