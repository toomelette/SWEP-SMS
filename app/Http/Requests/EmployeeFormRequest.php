<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFormRequest extends FormRequest{




    
    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        $rows_children = $this->request->get('row_children');
        $rows_eb = $this->request->get('row_eb');
        $rows_training = $this->request->get('row_training');
        $rows_eligibility = $this->request->get('row_eligibility');
        $rows_we = $this->request->get('row_we');
        $rows_vw = $this->request->get('row_vw');
        $rows_recognition = $this->request->get('row_recognition');
        $rows_org = $this->request->get('row_org');
        $rows_ss = $this->request->get('row_ss');
        $rows_reference = $this->request->get('row_reference');

        $rules = [
            
            // Personal Info
            'lastname'=>'required|string|max:90',
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'name_ext'=>'required|string|max:11',
            'date_of_birth' => 'required|date_format:"m/d/Y"',
            'place_of_birth'=>'required|string|max:255',
            'sex'=>'required|string|max:20',
            'civil_status'=>'required|string|max:45',
            'height'=>'nullable|string|max:45',
            'weight'=>'nullable|string|max:45',
            'blood_type'=>'nullable|string|max:45',
            'tel_no'=>'nullable|string|max:45',
            'cell_no'=>'nullable|string|max:45',
            'email'=>'nullable|string|max:45',
            'citizenship'=>'nullable|string|max:45',
            'citizenship_type'=>'nullable|string|max:45',
            'dual_citizenship_country'=>'nullable|string|max:45',
            'agency_no'=>'nullable|string|max:45',
            'gov_id'=>'nullable|string|max:45',
            'license_passport_no'=>'nullable|string|max:45',
            'id_date_issue'=>'nullable|string|max:45',


            // Address
            'res_address_block'=>'required|string|max:90',
            'res_address_street'=>'required|string|max:90',
            'res_address_village'=>'required|string|max:90',
            'res_address_barangay'=>'required|string|max:90',
            'res_address_city'=>'required|string|max:90',
            'res_address_province'=>'required|string|max:90',
            'res_address_zipcode'=>'required|string|max:90',
            'perm_address_block'=>'required|string|max:90',
            'perm_address_street'=>'required|string|max:90',
            'perm_address_village'=>'required|string|max:90',
            'perm_address_barangay'=>'required|string|max:90',
            'perm_address_city'=>'required|string|max:90',
            'perm_address_province'=>'required|string|max:90',
            'perm_address_zipcode'=>'required|string|max:90',


            // Family Info
            'father_lastname'=>'required|string|max:90',
            'father_firstname'=>'required|string|max:90',
            'father_middlename'=>'required|string|max:90',
            'father_name_ext'=>'required|string|max:90',
            'mother_lastname'=>'required|string|max:90',
            'mother_firstname'=>'required|string|max:90',
            'mother_middlename'=>'required|string|max:90',
            'mother_name_ext'=>'required|string|max:90',
            'spouse_lastname'=>'required|string|max:90',
            'spouse_firstname'=>'required|string|max:90',
            'spouse_middlename'=>'required|string|max:90',
            'spouse_name_ext'=>'required|string|max:90',
            'spouse_occupation'=>'required|string|max:90',
            'spouse_employer'=>'required|string|max:90',
            'spouse_business_address'=>'required|string|max:90',
            'spouse_tel_no'=>'required|string|max:90',


            // Personal ID's
            'gsis'=>'required|string|max:90',
            'philhealth'=>'required|string|max:90',
            'tin'=>'required|string|max:90',
            'sss'=>'required|string|max:90',
            'hdmf'=>'required|string|max:90',
            'hdmfpremiums'=>'required|string|max:90',


            // Appointment Status
            'employee_no'=>'required|string|max:11',
            'position'=>'required|string|max:45',
            'item_no'=>'required|string|max:45',
            'appointment_status'=>'required|string|max:45',
            'salary_grade'=>'required|string|max:45',
            'step_inc'=>'required|int',
            'department_id'=>'required|int',
            'department_unit_id'=>'required|int',
            'monthlybasic'=>'required|int',
            'aca'=>'required|int',
            'pera'=>'required|int',
            'food_subsidy'=>'required|int',
            'ra'=>'required|int',
            'ta'=>'required|int',
            'firstday_gov' => 'required|date_format:"m/d/Y"',
            'firstday_sra' => 'required|date_format:"m/d/Y"',
            'appointment_date' => 'nullable|date_format:"m/d/Y"',
            'adjustment_date' => 'nullable|date_format:"m/d/Y"',
            'is_active' => 'nullable|date_format:"m/d/Y"',


            // Questions
            'q_34_a'=>'required|string|max:11',
            'q_34_b'=>'required|string|max:45',
            'q_34_b_yes_details'=>'required|string|max:45',
            'q_35_a'=>'required|string|max:45',
            'q_35_a_yes_details'=>'required|string|max:45',
            'q_35_b'=>'required|int',
            'q_35_b_yes_details'=>'required|int',
            'q_36'=>'required|int',
            'q_36_yes_details'=>'required|int',
            'q_37'=>'required|int',
            'q_37_yes_details'=>'required|int',
            'q_38_a'=>'required|int',
            'q_38_a_yes_details'=>'required|int',
            'q_38_b'=>'required|int',
            'q_38_b_yes_details' => 'required|date_format:"m/d/Y"',
            'q_39' => 'required|date_format:"m/d/Y"',
            'q_39_yes_details' => 'nullable|date_format:"m/d/Y"',
            'q_40_a' => 'nullable|date_format:"m/d/Y"',
            'q_40_a_yes_details' => 'nullable|date_format:"m/d/Y"',
            'q_40_b' => 'nullable|date_format:"m/d/Y"',
            'q_40_b_yes_details' => 'nullable|date_format:"m/d/Y"',
            'q_40_c' => 'nullable|date_format:"m/d/Y"',
            'q_40_c_yes_details' => 'nullable|date_format:"m/d/Y"',

        ];


        // Children
        if(count($rows_children) > 0){
            foreach($rows_children as $key => $value){   
                $rules['row_children.'.$key.'.fullname'] = 'required|string|max:255';
                $rules['row_children.'.$key.'.date_of_birth'] = 'required|string|max:255';
            } 
        }


        // Educational background
        if(count($rows_eb) > 0){
            foreach($rows_eb as $key => $value){   
                $rules['row_eb.'.$key.'.level'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.school_name'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.course'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.date_from'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.date_to'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.units'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.year'] = 'required|string|max:255';
                $rules['row_eb.'.$key.'.scholarship'] = 'required|string|max:255';
            } 
        }


        // Trainings
        if(count($rows_training) > 0){
            foreach($rows_eb as $key => $value){   
                $rules['row_training.'.$key.'.title'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.type'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.conducted_by'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.date_from'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.date_to'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.hours'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.venue'] = 'required|string|max:255';
                $rules['row_training.'.$key.'.remarks'] = 'required|string|max:255';
            } 
        }


        // Eligibility
        if(count($rows_eligibility) > 0){
            foreach($rows_eligibility as $key => $value){   
                $rules['row_eligibility.'.$key.'.eligibility'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.level'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.rating'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.exam_place'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.exam_date'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.license_no'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.venue'] = 'required|string|max:255';
                $rules['row_eligibility.'.$key.'.license_validity'] = 'required|string|max:255';
            } 
        }


        // Work Experience
        if(count($rows_we) > 0){
            foreach($rows_we as $key => $value){   
                $rules['row_we.'.$key.'.date_from'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.date_to'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.company'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.position'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.salary'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.salary_grade'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.appointment_status'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.is_gov_service'] = 'required|string|max:255';
            } 
        }


        // Voluntary Works
        if(count($rows_vw) > 0){
            foreach($rows_vw as $key => $value){   
                $rules['row_vw.'.$key.'.name'] = 'required|string|max:255';
                $rules['row_vw.'.$key.'.address'] = 'required|string|max:255';
                $rules['row_vw.'.$key.'.date_from'] = 'required|string|max:255';
                $rules['row_vw.'.$key.'.date_to'] = 'required|string|max:255';
                $rules['row_vw.'.$key.'.hours'] = 'required|string|max:255';
                $rules['row_vw.'.$key.'.position'] = 'required|string|max:255';
            } 
        }


        // Recognition
        if(count($rows_recognition) > 0){
            foreach($rows_recognition as $key => $value){   
                $rules['row_recognition.'.$key.'.title'] = 'required|string|max:255';
            } 
        }


        // Organizations
        if(count($rows_org) > 0){
            foreach($rows_org as $key => $value){   
                $rules['row_org.'.$key.'.name'] = 'required|string|max:255';
            } 
        }


        // Special Skills
        if(count($rows_ss) > 0){
            foreach($rows_ss as $key => $value){   
                $rules['row_ss.'.$key.'.description'] = 'required|string|max:255';
            } 
        }


        // Voluntary Works
        if(count($rows_reference) > 0){
            foreach($rows_reference as $key => $value){   
                $rules['row_reference.'.$key.'.fullname'] = 'required|string|max:255';
                $rules['row_reference.'.$key.'.address'] = 'required|string|max:255';
                $rules['row_reference.'.$key.'.tel_no'] = 'required|string|max:255';
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
