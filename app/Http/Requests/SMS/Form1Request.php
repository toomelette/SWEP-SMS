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
//            'crop_year' => 'required|string',
//            'week_ending' => 'required|date_format:Y-m-d',
//            'report_no' => 'required|string',
//            'dist_no' => 'required|string',

            'quedanIssuances.seriesTo.*' => 'gte:quedanIssuances.seriesFrom.*',

//            'children.current.*' => 'required',
            ];
    }
    public function messages()
    {
        return [
            'quedanIssuances.seriesTo.*.gte' => 'This field must be greater than or equal to the Series From field.'
        ];
    }
}