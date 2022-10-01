<?php


namespace App\Http\Requests\SMS;


use Illuminate\Foundation\Http\FormRequest;

class SignatoryFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
//            'signatories.*.certified.*' => 'required|string',
//            'signatories.*.verified.*' => 'required|string',
//            'signatories.*.verifiedSra.*' => 'required|string',
        ];
    }
}