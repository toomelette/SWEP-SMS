<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){
        
        $rules = [
            
            'name'=>'required|string|max:45',
            'route'=>'required|string|max:45',
            'icon'=>'required|string|max:45',
            'is_menu'=>'required|string|max:5',
            'is_dropdown'=>'required|string|max:5',

        ];



        if(count($this->request->get('row')) > 0){

            foreach($this->request->get('row') as $key => $value){

                $rules['sub_name.'.$key] = 'required|string|max:45';
                $rules['sub_route.'.$key] = 'required|string|max:45';
                $rules['sub_is_nav.'.$key] = 'required|string|max:45';

            } 

        }

        return $rules;

    }





    public function messages(){

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
            'is_menu.max'  => 'The Is Menu field may not be greater than 6 characters.',

            'is_dropdown.required'  => 'Is Dropdown field is required.',
            'is_dropdown.string'  => 'Invalid Input! You must enter a string value.',
            'is_dropdown.max'  => 'The Is Dropdown field may not be greater than 6 characters.',

        ];


        foreach($this->request->get('row') as $key => $value) {

            $messages['sub_name.'. $key .'.required'] = 'Name Field is Required.';
            $messages['sub_name.'. $key .'.string'] = 'Invalid Input! You must enter a string value.';
            $messages['sub_name.'. $key .'.max'] = 'The Name field may not be greater than 45 characters.';
            
            $messages['sub_route.'. $key .'.required'] = 'Route Field is Required.';
            $messages['sub_route.'. $key .'.string'] = 'Invalid Input! You must enter a string value.';
            $messages['sub_route.'. $key .'.max'] = 'The Route field may not be greater than 45 characters.';

            $messages['sub_is_nav.'. $key .'.required'] = 'Is Nav Field is Required.';
            $messages['sub_is_nav.'. $key .'.string'] = 'Invalid Input! You must enter a string value.';
            $messages['sub_is_nav.'. $key .'.max'] = 'The Is Nav field may not be greater than 45 characters.';

        }

        return $messages;

    }





}
