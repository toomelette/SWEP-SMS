<?php


namespace App\Http\Requests\MisRequests;


use Illuminate\Foundation\Http\FormRequest;

class MisRequestsStatusFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'status' => 'required|string|max:255',
        ];
    }
}