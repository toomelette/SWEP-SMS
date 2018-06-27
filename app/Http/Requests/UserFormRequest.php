<?php

namespace App\Http\Requests;


use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;


class UserFormRequest extends FormRequest{


    protected $user;


    public function __construct(User $user){

        $this->user = $user;

    }


    public function authorize(){

        return true;
    }

    
    public function rules(){

        $menus = $this->request->get('menu');

        $rules = [
            
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'lastname'=>'required|string|max:90',
            'email'=>'required|string|email|max:90',
            'position'=>'required|string|max:90',
            'username'=>'required|string|max:45',

        ];
        

        if($this->request->get('password') != null){

            $rules['password'] = 'required|min:6|max:45|string|confirmed';

        }


        if(count($menus) > 0){


            if(count($this->request->get('menu')) > 0){

                foreach($this->request->get('menu') as $key => $value){

                    $rules['menu.'.$key] = 'required|string';

                } 

            }



            if(count($this->request->get('submenu')) > 0){

                foreach($this->request->get('submenu') as $key => $value){

                    $rules['submenu.'.$key] = '';

                }
            }


        }


        return $rules;


    }


     public function messages(){

        $menus = $this->request->get('menu');

        $messages = [];


        if(count($menus) > 0){

            foreach($this->request->get('menu') as $key => $value) {

                $messages['menu.'.$key.'.required'] = 'Menu Field is Required.';
                $messages['menu.'.$key.'.string'] = ' Invalid Input! You must enter a string value.';

            }

        }


        return $messages;


    }



}
