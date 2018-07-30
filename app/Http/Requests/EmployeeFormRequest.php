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
            'name_ext'=>'nullable|string|max:11',
            'date_of_birth' => 'required|date_format:"m/d/Y"',
            'place_of_birth'=>'required|string|max:255',
            'sex'=>'required|string|max:20',
            'civil_status'=>'required|string|max:45',
            'height'=>'nullable|string|max:20',
            'weight'=>'nullable|string|max:20',
            'blood_type'=>'required|string|max:11',
            'tel_no'=>'nullable|string|max:20',
            'cell_no'=>'required|string|max:20',
            'email'=>'nullable|email|max:90',
            'citizenship'=>'required|string|max:20',
            'citizenship_type'=>'required|string|max:20',
            'dual_citizenship_country'=>'nullable|string|max:90',
            'agency_no'=>'nullable|string|max:20',
            'gov_id'=>'nullable|string|max:20',
            'license_passport_no'=>'nullable|string|max:20',
            'id_date_issue'=>'nullable|string|max:45',


            // Address
            'res_address_block'=>'nullable|string|max:90',
            'res_address_street'=>'nullable|string|max:90',
            'res_address_village'=>'nullable|string|max:90',
            'res_address_barangay'=>'nullable|string|max:90',
            'res_address_city'=>'required|string|max:90',
            'res_address_province'=>'required|string|max:90',
            'res_address_zipcode'=>'required|string|max:20',
            'perm_address_block'=>'nullable|string|max:90',
            'perm_address_street'=>'nullable|string|max:90',
            'perm_address_village'=>'nullable|string|max:90',
            'perm_address_barangay'=>'nullable|string|max:90',
            'perm_address_city'=>'required|string|max:90',
            'perm_address_province'=>'required|string|max:90',
            'perm_address_zipcode'=>'required|string|max:20',


            // Family Info
            'father_lastname'=>'required|string|max:90',
            'father_firstname'=>'required|string|max:90',
            'father_middlename'=>'required|string|max:90',
            'father_name_ext'=>'nullable|string|max:11',
            'mother_lastname'=>'required|string|max:90',
            'mother_firstname'=>'required|string|max:90',
            'mother_middlename'=>'required|string|max:90',
            'mother_name_ext'=>'nullable|string|max:11',
            'spouse_lastname'=>'nullable|string|max:90',
            'spouse_firstname'=>'nullable|string|max:90',
            'spouse_middlename'=>'nullable|string|max:90',
            'spouse_name_ext'=>'nullable|string|max:11',
            'spouse_occupation'=>'nullable|string|max:90',
            'spouse_employer'=>'nullable|string|max:255',
            'spouse_business_address'=>'nullable|string|max:255',
            'spouse_tel_no'=>'nullable|string|max:45',


            // Personal ID's
            'gsis'=>'nullable|string|max:20',
            'philhealth'=>'nullable|string|max:20',
            'tin'=>'nullable|string|max:20',
            'sss'=>'nullable|string|max:20',
            'hdmf'=>'nullable|string|max:20',
            'hdmfpremiums'=>'nullable|string|max:13',


            // Appointment Status
            'employee_no'=>'required|string|max:20',
            'position'=>'required|string|max:90',
            'item_no'=>'nullable|string|max:11',
            'appointment_status'=>'required|string|max:45',
            'salary_grade'=>'nullable|int',
            'step_inc'=>'nullable|int',
            'department_id'=>'required|string|max:11',
            'department_unit_id'=>'required|string|max:11',
            'monthly_basic'=>'required|string|max:13',
            'aca'=>'nullable|string|max:13',
            'pera'=>'nullable|string|max:13',
            'food_subsidy'=>'nullable|string|max:13',
            'ra'=>'nullable|string|max:13',
            'ta'=>'nullable|string|max:13',
            'firstday_gov' => 'required|date_format:"m/d/Y"',
            'firstday_sra' => 'required|date_format:"m/d/Y"',
            'appointment_date' => 'nullable|date_format:"m/d/Y"',
            'adjustment_date' => 'nullable|date_format:"m/d/Y"',
            'project_id' => 'required|string|min:5|max:5',
            'is_active' => 'required|string|min:6|max:8',


            // Questions
            'q_34_a'=>'required|string|max:5|min:4',
            'q_34_b'=>'required|string|max:5|min:4',
            'q_34_b_yes_details'=>'nullable|string|max:255',
            'q_35_a'=>'required|string|max:5|min:4',
            'q_35_a_yes_details'=>'nullable|string|max:255',
            'q_35_b'=>'required|string|max:5|min:4',
            'q_35_b_yes_details_1'=>'nullable|string|max:255',
            'q_35_b_yes_details_2'=>'nullable|string|max:255',
            'q_36'=>'required|string|max:5|min:4',
            'q_36_yes_details'=>'nullable|string|max:255',
            'q_37'=>'required|string|max:5|min:4',
            'q_37_yes_details'=>'nullable|string|max:255',
            'q_38_a'=>'required|string|max:5|min:4',
            'q_38_a_yes_details'=>'nullable|string|max:255',
            'q_38_b'=>'required|string|max:5|min:4',
            'q_38_b_yes_details' => 'nullable|string|max:255',
            'q_39' => 'required|string|max:5|min:4',
            'q_39_yes_details' => 'nullable|string|max:255',
            'q_40_a' => 'required|string|max:5|min:4',
            'q_40_a_yes_details' => 'nullable|string|max:255',
            'q_40_b' => 'required|string|max:5|min:4',
            'q_40_b_yes_details' => 'nullable|string|max:255',
            'q_40_c' => 'required|string|max:5|min:4',
            'q_40_c_yes_details' => 'nullable|string|max:255',

        ];


        // Children
        if(!empty($rows_children)){
            foreach($rows_children as $key => $value){   
                $rules['row_children.'.$key.'.fullname'] = 'required|string|max:255';
                $rules['row_children.'.$key.'.date_of_birth'] = 'required|date_format:"m/d/Y"';
            } 
        }


        // Educational background
        if(!empty($rows_eb)){
            foreach($rows_eb as $key => $value){   
                $rules['row_eb.'.$key.'.level'] = 'required|string|max:90';
                $rules['row_eb.'.$key.'.school_name'] = 'nullable|string|max:255';
                $rules['row_eb.'.$key.'.course'] = 'nullable|string|max:90';
                $rules['row_eb.'.$key.'.date_from'] = 'nullable|string|max:45';
                $rules['row_eb.'.$key.'.date_to'] = 'nullable|string|max:45';
                $rules['row_eb.'.$key.'.units'] = 'nullable|numeric';
                $rules['row_eb.'.$key.'.graduate_year'] = 'nullable|string|max:45';
                $rules['row_eb.'.$key.'.scholarship'] = 'nullable|string|max:90';
            } 
        }


        // Eligibility
        if(!empty($rows_eligibility)){
            foreach($rows_eligibility as $key => $value){   
                $rules['row_eligibility.'.$key.'.eligibility'] = 'required|string|max:250';
                $rules['row_eligibility.'.$key.'.level'] = 'nullable|string|max:20';
                $rules['row_eligibility.'.$key.'.rating'] = 'nullable|numeric';
                $rules['row_eligibility.'.$key.'.exam_place'] = 'nullable|string|max:255';
                $rules['row_eligibility.'.$key.'.exam_date'] = 'nullable|date_format:"m/d/Y"';
                $rules['row_eligibility.'.$key.'.license_no'] = 'nullable|string|max:90';
                $rules['row_eligibility.'.$key.'.license_validity'] = 'nullable|string|max:255';
            } 
        }


        // Work Experience
        if(!empty($rows_we)){
            foreach($rows_we as $key => $value){   
                $rules['row_we.'.$key.'.date_from'] = 'required|date_format:"m/d/Y"';
                $rules['row_we.'.$key.'.date_to'] = 'required|date_format:"m/d/Y"';
                $rules['row_we.'.$key.'.company'] = 'required|string|max:255';
                $rules['row_we.'.$key.'.position'] = 'required|string|max:90';
                $rules['row_we.'.$key.'.salary'] = 'required|string|max:13';
                $rules['row_we.'.$key.'.salary_grade'] = 'nullable|int';
                $rules['row_we.'.$key.'.appointment_status'] = 'required|string|max:45';
                $rules['row_we.'.$key.'.is_gov_service'] = 'required|string|min:4|max:5';
            } 
        }


        // Voluntary Works
        if(!empty($rows_vw)){
            foreach($rows_vw as $key => $value){   
                $rules['row_vw.'.$key.'.name'] = 'required|string|max:255';
                $rules['row_vw.'.$key.'.address'] = 'nullable|string|max:255';
                $rules['row_vw.'.$key.'.date_from'] = 'required|date_format:"m/d/Y"';
                $rules['row_vw.'.$key.'.date_to'] = 'required|date_format:"m/d/Y"';
                $rules['row_vw.'.$key.'.hours'] = 'nullable|numeric';
                $rules['row_vw.'.$key.'.position'] = 'nullable|string|max:90';
            } 
        }


        // Recognition
        if(!empty($rows_recognition)){
            foreach($rows_recognition as $key => $value){   
                $rules['row_recognition.'.$key.'.title'] = 'required|string|max:255';
            } 
        }


        // Organizations
        if(!empty($rows_org)){
            foreach($rows_org as $key => $value){   
                $rules['row_org.'.$key.'.name'] = 'required|string|max:255';
            } 
        }


        // Special Skills
        if(!empty($rows_ss)){
            foreach($rows_ss as $key => $value){   
                $rules['row_ss.'.$key.'.description'] = 'required|string|max:255';
            } 
        }


        // Voluntary Works
        if(!empty($rows_reference)){
            foreach($rows_reference as $key => $value){   
                $rules['row_reference.'.$key.'.fullname'] = 'required|string|max:255';
                $rules['row_reference.'.$key.'.address'] = 'required|string|max:255';
                $rules['row_reference.'.$key.'.tel_no'] = 'required|string|max:20';
            } 
        }


        return $rules;
    
    }





}
