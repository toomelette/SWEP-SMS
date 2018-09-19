<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeOtherQuestionInterface;

use App\Models\EmployeeOtherQuestion;


class EmployeeOtherQuestionRepository extends BaseRepository implements EmployeeOtherQuestionInterface {
	



    protected $employee_other_question;




	public function __construct(EmployeeOtherQuestion $employee_other_question){

        $this->employee_other_question = $employee_other_question;
        parent::__construct();

    }






    public function store($request, $employee){

        $employee_oq = new EmployeeOtherQuestion;
        $employee_oq->employee_no = $employee->employee_no;
        $employee_oq->q_34_a = $this->__dataType->string_to_boolean($request->q_34_a);
        $employee_oq->q_34_b = $this->__dataType->string_to_boolean($request->q_34_b);
        $employee_oq->q_34_b_yes_details = $request->q_34_b_yes_details;
        $employee_oq->q_35_a = $this->__dataType->string_to_boolean($request->q_35_a);
        $employee_oq->q_35_a_yes_details = $request->q_35_a_yes_details;
        $employee_oq->q_35_b = $this->__dataType->string_to_boolean($request->q_35_b);
        $employee_oq->q_35_b_yes_details_1 = $request->q_35_b_yes_details_1;
        $employee_oq->q_35_b_yes_details_2 = $request->q_35_b_yes_details_2;
        $employee_oq->q_36 = $this->__dataType->string_to_boolean($request->q_36);
        $employee_oq->q_36_yes_details = $request->q_36_yes_details;
        $employee_oq->q_37 = $this->__dataType->string_to_boolean($request->q_37);
        $employee_oq->q_37_yes_details = $request->q_37_yes_details;
        $employee_oq->q_38_a = $this->__dataType->string_to_boolean($request->q_38_a);
        $employee_oq->q_38_a_yes_details = $request->q_38_a_yes_details;
        $employee_oq->q_38_b = $this->__dataType->string_to_boolean($request->q_38_b);
        $employee_oq->q_38_b_yes_details = $request->q_38_b_yes_details;
        $employee_oq->q_39 = $this->__dataType->string_to_boolean($request->q_39);
        $employee_oq->q_39_yes_details = $request->q_39_yes_details;
        $employee_oq->q_40_a = $this->__dataType->string_to_boolean($request->q_40_a);
        $employee_oq->q_40_a_yes_details = $request->q_40_a_yes_details;
        $employee_oq->q_40_b = $this->__dataType->string_to_boolean($request->q_40_b);
        $employee_oq->q_40_b_yes_details = $request->q_40_b_yes_details;
        $employee_oq->q_40_c = $this->__dataType->string_to_boolean($request->q_40_c);
        $employee_oq->q_40_c_yes_details = $request->q_40_c_yes_details;
        $employee_oq->save();
        
    }







}