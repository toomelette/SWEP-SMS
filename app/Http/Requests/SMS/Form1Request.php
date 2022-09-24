<?php


namespace App\Http\Requests\SMS;


use Illuminate\Foundation\Http\FormRequest;

class Form1Request extends FormRequest
{
    public  function authorize(){
        return true;
    }

    public function rules(){
        return [
            'crop_year' => 'required|string',
            'week_ending' => 'required|date_format:Y-m-d',
            'report_no' => 'required|string',
            'dist_no' => 'required|string',

//            'children.current.*' => 'required',
            ];
    }
}