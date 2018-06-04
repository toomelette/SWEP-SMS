<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFormRequest extends FormRequest{




    
    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        $rows = $this->request->get('row');

        $rules = [
            
            'lastname'=>'required|string|max:90',
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'address'=>'required|string|max:90',
            'dob' => 'required|date_format:"m/d/Y"',
            'pob'=>'required|string|max:90',
            'gender'=>'required|string|max:20',
            'bloodtype'=>'nullable|string|max:45',
            'civilstat'=>'required|string|max:20',

            'undergrad'=>'nullable|string|max:90',
            'graduate1'=>'nullable|string|max:90',
            'graduate2'=>'nullable|string|max:90',
            'postgrad1'=>'nullable|string|max:90',
            'eligibility'=>'nullable|string|max:45',
            'eligibilitylevel'=>'nullable|string|max:45',

            'empno'=>'required|string|max:11',
            'active'=>'required|string|max:45',
            'dept'=>'required|string|max:45',
            'division'=>'required|string|max:45',
            'apptstat'=>'required|string|max:45',
            'itemno'=>'required|int',
            'position'=>'required|string|max:90',
            'salgrade'=>'required|int',
            'stepinc'=>'nullable|int',
            'monthlybasic'=>'required|string|max:13',
            'aca'=>'nullable|string|max:13',
            'pera'=>'nullable|string|max:13',
            'foodsubsi'=>'nullable|string|max:13',
            'allow1'=>'nullable|string|max:13',
            'allow2'=>'nullable|string|max:13',
            'govserv' => 'required|date_format:"m/d/Y"',
            'firstday' => 'required|date_format:"m/d/Y"',
            'apptdate' => 'nullable|date_format:"m/d/Y"',
            'adjdate' => 'nullable|date_format:"m/d/Y"',

            'phic'=>'nullable|string|max:45',
            'tin'=>'nullable|string|max:45',
            'gsis'=>'nullable|string|max:45',
            'hdmf'=>'nullable|string|max:45',
            'hdmfpremiums'=>'nullable|string|max:13',

        ];


        if(count($rows) > 0){

            foreach($rows as $key => $value){
                    
                $rules['row.'.$key.'.topics'] = 'required|string|max:255';
                $rules['row.'.$key.'.conductedby'] = 'required|string|max:255';
                $rules['row.'.$key.'.datefrom'] = 'required|date_format:"m/d/Y"';
                $rules['row.'.$key.'.dateto'] = 'required|date_format:"m/d/Y"';
                $rules['row.'.$key.'.hours'] = 'required|int';
                $rules['row.'.$key.'.venue'] = 'required|string|max:255';
                $rules['row.'.$key.'.remarks'] = 'nullable|string|max:255';

            } 

        }

        return $rules;
    
    }





    public function messages(){

        $rows = $this->request->get('row');

        $messages = [];

        if(count($rows) > 0){

            foreach($rows as $key => $value) {

                $messages['row.'. $key .'.topics.required'] = 'Topic Field is Required.';
                $messages['row.'. $key .'.topics.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.topics.max'] = 'The Topic field may not be greater than 255 characters.';

                $messages['row.'. $key .'.conductedby.required'] = 'Conducted by Field is Required.';
                $messages['row.'. $key .'.conductedby.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.conductedby.max'] = 'The Conducted by field may not be greater than 255 characters.';

                $messages['row.'. $key .'.datefrom.required'] = 'Date From Field is Required.';
                $messages['row.'. $key .'.datefrom.string'] = 'Invalid Format! The Date does not match the format mm/dd/yy';

                $messages['row.'. $key .'.dateto.required'] = 'Date To Field is Required.';
                $messages['row.'. $key .'.dateto.string'] = 'Invalid Format! The Date does not match the format mm/dd/yy';

                $messages['row.'. $key .'.hours.required'] = 'Hours Field is Required.';
                $messages['row.'. $key .'.hours.integer'] = 'Invalid Input! You must enter a integer value.';

                $messages['row.'. $key .'.venue.required'] = 'Venue Field is Required.';
                $messages['row.'. $key .'.venue.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.venue.max'] = 'The Venue field may not be greater than 255 characters.';

                $messages['row.'. $key .'.remarks.required'] = 'Remarks Field is Required.';
                $messages['row.'. $key .'.remarks.string'] = 'Invalid Input! You must enter a string value.';
                $messages['row.'. $key .'.remarks.max'] = 'The Remarks field may not be greater than 255 characters.';

            }
            
        }

        return $messages;

    }





}
