<?php


namespace App\Http\Requests\AccountRecovery;


use Illuminate\Foundation\Http\FormRequest;

class UsernameLookupFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public  function rules(){
        return [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birthday' => 'required|date_format:"Y-m-d"',
        ];
    }
}