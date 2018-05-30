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

        $messages = [

            'lastname.required'  => 'Lastname field is required.',
            'lastname.string'  => 'Invalid Input! You must enter a string value.',
            'lastname.max'  => 'The Lastname field may not be greater than 90 characters.',

            'firstname.required'  => 'Firstname field is required.',
            'firstname.string'  => 'Invalid Input! You must enter a string value.',
            'firstname.max'  => 'The Firstname field may not be greater than 90 characters.',

            'middlename.required'  => 'Middlename field is required.',
            'middlename.string'  => 'Invalid Input! You must enter a string value.',
            'middlename.max'  => 'The Middlename field may not be greater than 90 characters.',

            'address.required'  => 'Address field is required.',
            'address.string'  => 'Invalid Input! You must enter a string value.',
            'address.max'  => 'The Address field may not be greater than 90 characters.',

            'dob.required'  => 'Date of Birth field is required.',
            'dob.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

            'pob.required'  => 'Place of Birth field is required.',
            'pob.string'  => 'Invalid Input! You must enter a string value.',
            'pob.max'  => 'The Place of Birth field may not be greater than 90 characters.',

            'gender.required'  => 'Gender field is required.',
            'gender.string'  => 'Invalid Input! You must enter a string value.',
            'gender.max'  => 'The Gender field may not be greater than 20 characters.',

            'bloodtype.string'  => 'Invalid Input! You must enter a string value.',
            'bloodtype.max'  => 'The Blood Type field may not be greater than 45 characters.',

            'civilstat.required'  => 'Civil Status field is required.',
            'civilstat.string'  => 'Invalid Input! You must enter a string value.',
            'civilstat.max'  => 'The Civil Status field may not be greater than 20 characters.',



            'undergrad.string'  => 'Invalid Input! You must enter a string value.',
            'undergrad.max'  => 'The College field may not be greater than 90 characters.',

            'graduate1.string'  => 'Invalid Input! You must enter a string value.',
            'graduate1.max'  => 'The Masteral field may not be greater than 90 characters.',

            'graduate2.string'  => 'Invalid Input! You must enter a string value.',
            'graduate2.max'  => 'The Other Masteral field may not be greater than 90 characters.',

            'postgrad1.string'  => 'Invalid Input! You must enter a string value.',
            'postgrad1.max'  => 'The PHD field may not be greater than 90 characters.',

            'eligibility.string'  => 'Invalid Input! You must enter a string value.',
            'eligibility.max'  => 'The Elegibility field may not be greater than 45 characters.',

            'eligibilitylevel.string'  => 'Invalid Input! You must enter a string value.',
            'eligibilitylevel.max'  => 'The Elegibility Level field may not be greater than 45 characters.',



            'empno.required'  => 'Employee No. field is required.',
            'empno.string'  => 'Invalid Input! You must enter a string value.',
            'empno.max'  => 'The Employee No. field may not be greater than 11 characters.',

            'active.required'  => 'Status field is required.',
            'active.string'  => 'Invalid Input! You must enter a string value.',
            'active.max'  => 'The Status field may not be greater than 45 characters.',

            'dept.required'  => 'Department field is required.',
            'dept.string'  => 'Invalid Input! You must enter a string value.',
            'dept.max'  => 'The Department field may not be greater than 45 characters.',

            'division.required'  => 'Division field is required.',
            'division.string'  => 'Invalid Input! You must enter a string value.',
            'division.max'  => 'The Division field may not be greater than 45 characters.',

            'apptstat.required'  => 'Appointment Status field is required.',
            'apptstat.string'  => 'Invalid Input! You must enter a string value.',
            'apptstat.max'  => 'The Appointment Status field may not be greater than 45 characters.',

            'itemno.required'  => 'Item No. field is required.',
            'itemno.integer'  => 'Invalid Input! You must enter a integer value.',

            'position.required'  => 'Position field is required.',
            'position.string'  => 'Invalid Input! You must enter a string value.',
            'position.max'  => 'The Appointment Status field may not be greater than 90 characters.',

            'itemno.required'  => 'Item No. field is required.',
            'itemno.integer'  => 'Invalid Input! You must enter a integer value.',

            'salgrade.required'  => 'Salary Grade field is required.',
            'salgrade.integer'  => 'Invalid Input! You must enter a integer value.',

            'stepinc.integer'  => 'Invalid Input! You must enter a integer value.',

            'monthlybasic.required'  => 'Monthly Basic field is required.',
            'monthlybasic.string'  => 'Invalid Input! You must enter a string value.',
            'monthlybasic.max'  => 'The Monthly Basic field may not be greater than 13 characters.',

            'aca.string'  => 'Invalid Input! You must enter a string value.',
            'aca.max'  => 'The ACA field may not be greater than 13 characters.',

            'pera.string'  => 'Invalid Input! You must enter a string value.',
            'pera.max'  => 'The PERA field may not be greater than 13 characters.',

            'foodsubsi.string'  => 'Invalid Input! You must enter a string value.',
            'foodsubsi.max'  => 'The Food Subsidy field may not be greater than 13 characters.',

            'allow1.string'  => 'Invalid Input! You must enter a string value.',
            'allow1.max'  => 'The RA field may not be greater than 13 characters.',

            'allow2.string'  => 'Invalid Input! You must enter a string value.',
            'allow2.max'  => 'The TA field may not be greater than 13 characters.',

            'govserv.required'  => 'First Day to serve Government field is required.',
            'govserv.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

            'firstday.required'  => 'First Day in SRA field is required.',
            'firstday.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

            'apptdate.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

            'firstday.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',



            'phic.string'  => 'Invalid Input! You must enter a string value.',
            'phic.max'  => 'The PHIC field may not be greater than 45 characters.',

            'tin.string'  => 'Invalid Input! You must enter a string value.',
            'tin.max'  => 'The TIN field may not be greater than 45 characters.',

            'gsis.string'  => 'Invalid Input! You must enter a string value.',
            'gsis.max'  => 'The GSIS field may not be greater than 45 characters.',

            'hdmf.string'  => 'Invalid Input! You must enter a string value.',
            'hdmf.max'  => 'The HDMF field may not be greater than 45 characters.',

            'hdmfpremiums.string'  => 'Invalid Input! You must enter a string value.',
            'hdmfpremiums.max'  => 'The HDMF Premiums field may not be greater than 13 characters.',

        ];

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
