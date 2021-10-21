<?php


namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class UserEditFormRequest extends FormRequest
{
    public function authorize(){

        return true;

    }



    public function rules(){


        $rules = [

            'employee_sync'=>'nullable|string|max:45',
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'lastname'=>'required|string|max:90',
            'email'=>'required|string|email|max:90',
            'position'=>'required|string|max:90',

        ];


        return $rules;

    }
}