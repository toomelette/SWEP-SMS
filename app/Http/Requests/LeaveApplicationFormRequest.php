<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationFormRequest extends FormRequest{




    
    public function authorize(){

        return true;
    }

    



    public function rules(){
            

        $rules = [

            'lastname'=>'required|string|max:90',
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'date_of_filing'=>'required|date_format:"m/d/Y"',
            'position'=>'required|string|max:90',
            'salary'=>'required|string|max:13',
            'immediate_superior_type'=>'required|int|max:30',
            'type'=>'required|string|max:5|min:5',
            'working_days'=>'required|string|max:45',
            'working_days_date_from'=>'required|date_format:"m/d/Y"',
            'working_days_date_to'=>'required|date_format:"m/d/Y"',
            'commutation'=>'required|string|max:5|min:4',

        ];



        if($this->request->get('type') == 'T1001'){

            $rules['type_vacation'] = 'required|string|min:6|max:6';

            if($this->request->get('type_vacation') == 'TV1002'){

            	$rules['type_vacation_others_specific'] = 'required|string|max:255';

            }
        }



        if($this->request->get('type') == 'T1004'){

            $rules['type_others_specific'] = 'required|string|max:255';

        }



        if($this->request->get('type') == 'T1001'){

        	$rules['spent_vacation'] = 'required|string|max:6|min:6';

            if($this->request->get('spent_vacation') == 'SV1002'){

            	$rules['spent_vacation_abroad_specific'] = 'required|string|max:255';

            }

        }



        if($this->request->get('type') == 'T1002'){

        	$rules['spent_sick'] = 'required|string|max:6|min:6';

            if($this->request->get('spent_sick') == 'SS1001'){

            	$rules['spent_sick_inhospital_specific'] = 'required|string|max:255';

            }

            if($this->request->get('spent_sick') == 'SS1002'){

            	$rules['spent_sick_outpatient_specific'] = 'required|string|max:255';

            }

        }


        return $rules;
    

    }






    public function messages(){

        return [

            'lastname.required'  => 'Lastname field is required.',
            'lastname.string'  => 'Invalid Input! You must enter a string value.',
            'lastname.max'  => 'The Lastname field may not be greater than 90 characters.',

            'firstname.required'  => 'Firstname field is required.',
            'firstname.string'  => 'Invalid Input! You must enter a string value.',
            'firstname.max'  => 'The Firstname field may not be greater than 90 characters.',

            'middlename.required'  => 'Middlename field is required.',
            'middlename.string'  => 'Invalid Input! You must enter a string value.',
            'middlename.max'  => 'The Middlename field may not be greater than 90 characters.',

            'date_of_filing.string'  => 'Invalid Input! You must enter a string value.',
            'date_of_filing.date_format'  => 'Invalid Date format!',

            'position.required'  => 'Position field is required.',
            'position.string'  => 'Invalid Input! You must enter a string value.',
            'position.max'  => 'The Position field may not be greater than 90 characters.',

            'salary.required'  => 'Salary field is required.',
            'salary.string'  => 'Invalid Input! You must enter a string value.',
            'salary.max'  => 'The Salary field may not be greater than 13 characters.',

            'immediate_superior_type.required'  => 'Immediate Superior field is required.',
            'immediate_superior_type.string'  => 'Invalid Input! You must enter a int value.',
            'immediate_superior_type.max'  => 'The Immediate Superior field may not be greater than 30 characters.',

            'type.required'  => 'Type of Leave field is required.',
            'type.string'  => 'Invalid Input! You must enter a string value.',
            'type.max'  => 'The Type of Leave field may not be greater than 5 characters.',

            'working_days.required'  => 'Number of Working Days field is required.',
            'working_days.string'  => 'Invalid Input! You must enter a string value.',
            'working_days.max'  => 'The Number of Working Days field may not be greater than 45 characters.',

            'working_days_from.string'  => 'Invalid Input! You must enter a string value.',
            'working_days_from.date_format'  => 'Invalid Date format!',

            'working_days_to.string'  => 'Invalid Input! You must enter a string value.',
            'working_days_to.date_format'  => 'Invalid Date format!',

            'commutation.required'  => 'Commutation field is required.',
            'commutation.string'  => 'Invalid Input! You must enter a string value.',
            'commutation.max'  => 'The Commutation field may not be greater than 5 characters.',
            'commutation.min'  => 'The Commutation field may not be lesser than 4 characters.',

            'type_vacation.required'  => 'Vacation Type field is required.',
            'type_vacation.string'  => 'Invalid Input! You must enter a string value.',
            'type_vacation.max'  => 'The Vacation Type field may not be greater than 6 characters.',
            'type_vacation.min'  => 'The Vacation Type field may not be lesser than 6 characters.',

            'type_vacation_others_specific.required'  => 'If (others) specify field is required.',
            'type_vacation_others_specific.string'  => 'Invalid Input! You must enter a string value.',
            'type_vacation_others_specific.max'  => 'The If (others) specify field may not be greater than 255 characters.',

            'type_others_specific.required'  => 'If (others) specify field is required.',
            'type_others_specific.string'  => 'Invalid Input! You must enter a string value.',
            'type_others_specific.max'  => 'The If (others) specify field may not be greater than 255 characters.',

            'spent_vacation.required'  => 'In case of Vacation Leave field is required.',
            'spent_vacation.string'  => 'In case of Vacation LeaveInvalid Input! You must enter a string value.',
            'spent_vacation.max'  => 'In case of Vacation Leave field may not be greater than 6 characters.',
            'spent_vacation.min'  => 'In case of Vacation Leave field may not be lesser than 6 characters.',

            'spent_vacation_abroad_specific.required'  => 'If (Abroad) specify field is required.',
            'spent_vacation_abroad_specific.string'  => 'Invalid Input! You must enter a string value.',
            'spent_vacation_abroad_specific.max'  => 'The If (Abroad) specify field may not be greater than 255 characters.',

            'spent_sick.required'  => 'In case of Sick Leave field is required.',
            'spent_sick.string'  => 'Invalid Input! You must enter a string value.',
            'spent_sick.max'  => 'In case of Sick Leave field may not be greater than 6 characters.',
            'spent_sick.min'  => 'In case of Sick Leave field may not be lesser than 6 characters.',

            'spent_sick_inhospital_specific.required'  => 'If (In Hospital) specify field is required.',
            'spent_sick_inhospital_specific.string'  => 'Invalid Input! You must enter a string value.',
            'spent_sick_inhospital_specific.max'  => 'The If (In Hospital) specify field may not be greater than 255 characters.',

            'spent_sick_outpatient_specific.required'  => 'If (Out Patient) specify field is required.',
            'spent_sick_outpatient_specific.string'  => 'Invalid Input! You must enter a string value.',
            'spent_sick_outpatient_specific.max'  => 'The If (Out Patient) specify field may not be greater than 255 characters.',

        ];

    }






}
