<?php

namespace App\Http\Requests\DepartmentUnit;

use App\Swep\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property mixed description
 * @property mixed id
 * @property mixed slug
 * @property mixed department_id
 * @property mixed name
 * @property mixed department_no
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed user_created
 * @property mixed user_updated
 * @property mixed ip_created
 * @property mixed ip_updated
 */
class DepartmentUnitFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'department_id' => [
                'required',
                'max:11',
                'string',
                Rule::in(array_keys(Helper::departmentsArray())),
            ],
            'name' => [
                'required',
                'max:45',
                'string',
                Rule::unique('su_department_units','name')->ignore($this->slug,'slug'),
            ],
            'description' => 'required|max:45|string',
//            'description' => 'required|max:90|string',
        
        ];

    }




}
