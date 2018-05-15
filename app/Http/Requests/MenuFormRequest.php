<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rows = $this->request->get('row');

        $rules = [
            
            'name'=>'required|string|max:45',
            'route'=>'required|string|max:45',
            'icon'=>'required|string|max:45',
            'is_menu'=>'required|string|max:5',
            'is_dropdown'=>'required|string|max:5',

        ];



        if(count($rows) > 0){

            foreach($rows as $key => $value){
                    
                $rules['row.'.$key.'.sub_name'] = 'required|string|max:45';
                $rules['row.'.$key.'.sub_route'] = 'required|string|max:45';
                $rules['row.'.$key.'.sub_is_nav'] = 'required|string|max:5';

            } 

        }

        return $rules;

    }





    public function messages(){

        $rows = $this->request->get('row');

        $messages = [

            'name.required'  => 'Name field is required.',
            'name.string'  => 'Invalid Input! You must enter a string value.',
            'name.max'  => 'The Name field may not be greater than 45 characters.',

            'route.required'  => 'Route field is required.',
            'route.string'  => 'Invalid Input! You must enter a string value.',
            'route.max'  => 'The Route field may not be greater than 45 characters.',

            'icon.required'  => 'Icon field is required.',
            'icon.string'  => 'Invalid Input! You must enter a string value.',
            'icon.max'  => 'The Icon field may not be greater than 45 characters.',

            'is_menu.required'  => 'Is Menu field is required.',
            'is_menu.string'  => 'Invalid Input! You must enter a string value.',
            'is_menu.max'  => 'The Is Menu field may not be greater than 5 characters.',

            'is_dropdown.required'  => 'Is Dropdown field is required.',
            'is_dropdown.string'  => 'Invalid Input! You must enter a string value.',
            'is_dropdown.max'  => 'The Is Dropdown field may not be greater than 5 characters.',

        ];

        if(count($rows) > 0){

            foreach($rows as $key => $value) {

                $messages['row.'. $key .'.sub_name.required'] = 'Name Field is Required.';
                $messages['row.'. $key .'.sub_name.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.sub_name.max'] = 'The Name field may not be greater than 45 characters.';
                
                $messages['row.'. $key .'.sub_route.required'] = 'Route Field is Required.';
                $messages['row.'. $key .'.sub_route.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.sub_route.max'] = 'The Route field may not be greater than 45 characters.';

                $messages['row.'. $key .'.sub_is_nav.required'] = 'Is Nav Field is Required.';
                $messages['row.'. $key .'.sub_is_nav.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.sub_is_nav.max'] = 'The Is Nav field may not be greater than 5 characters.';

            }
            
        }
        return $messages;

    }





}
