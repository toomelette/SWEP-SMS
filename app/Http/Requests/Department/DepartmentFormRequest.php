<?php

namespace App\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed department_name
 * @property mixed department_id
 * @property mixed slug
 */
class DepartmentFormRequest extends FormRequest{



    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            'department_id' => [
                'required',
                'max:45,',
                'string',
                Rule::unique('su_departments','department_id')->ignore($this->slug ,'slug'),
            ],
            'name' => 'required|max:255|string',
        ];

    }




}
