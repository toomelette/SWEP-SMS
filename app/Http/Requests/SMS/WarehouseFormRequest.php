<?php


namespace App\Http\Requests\SMS;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WarehouseFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        $request = $this->request;
        return [
            'alias' => [
                'required',
                'string',
                'max:20',
                Rule::unique('warehouses')->where(function ($query) use ($request){
                    $query->where('alias','=',$request->get('alias'))
                        ->where('for','=',$request->get('for'))
                        ->where('millCode','=',\Auth::user()->mill_code);
                })
                ->ignore($request->get('slug'),'slug')
            ],
            'name' => 'required|string|max:100',
        ];
    }
}