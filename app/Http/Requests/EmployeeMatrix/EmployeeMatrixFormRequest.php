<?php

namespace App\Http\Requests\EmployeeMatrix;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeMatrixFormRequest extends FormRequest{



    
    public function authorize(){

        return true;

    }




    public function rules(){

        return [
            
            'educ_bachelors_degree' => 'nullable|numeric|max:5',
            'educ_undergrad_bachelor_units_earned' => 'nullable|numeric|max:160',
            'educ_undergrad_bachelor' => 'nullable|numeric|max:5',
            'educ_masters_degree' => 'nullable|numeric|max:2',
            'educ_doctoral_degree' => 'nullable|numeric|max:2',
            'educ_undergrad_masteral_units_earned' => 'nullable|numeric|max:42',
            'educ_undergrad_masteral' => 'nullable|numeric|max:1',
            'educ_grad_certificate_course' => 'nullable|numeric|max:2',
            'educ_distinctions_summa_cum_laude' => 'nullable|numeric|max:3',
            'educ_distinctions_magna_cum_laude' => 'nullable|numeric|max:2',
            'educ_distinctions_cum_laude' => 'nullable|numeric|max:2',
            'educ_distinctions_pres_awardee' => 'nullable|numeric|max:3',
            'educ_distinctions_csc_sra_da_awardee' => 'nullable|numeric|max:3',
            'educ_distinctions_top_gov_exam' => 'nullable|numeric|max:3',

            'experience' => 'nullable|numeric|max:20',
            'training' => 'nullable|numeric|max:10',
            'eligibility' => 'nullable|numeric|max:5',
            'performance' => 'nullable|numeric|max:20',
            'behavior_point_score' => 'nullable|numeric|max:5',
            'behavior' => 'nullable|numeric|max:13',
            'psycho_test_point_score' => 'nullable|numeric|max:5',
            'psycho_test' => 'nullable|numeric|max:5',
        
        ];
    
    }




}
