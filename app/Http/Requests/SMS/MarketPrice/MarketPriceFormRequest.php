<?php


namespace App\Http\Requests\SMS\MarketPrice;


use Illuminate\Foundation\Http\FormRequest;

class MarketPriceFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    
    public function rules(){
        return [
           'store' => 'required|max:255',
            'geog_loc' => 'required|max:255',
        ];
    }
}