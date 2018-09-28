<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\LeaveCardInterface;
use App\Swep\Interfaces\SignatoryInterface;


use App\Models\LeaveCard;


class LeaveCardRepository extends BaseRepository implements LeaveCardInterface {
	



    protected $leave_card;




	public function __construct(LeaveCard $leave_card){

        $this->leave_card = $leave_card;
        parent::__construct();

    }






    public function fetchAll($request){

       

    }






    public function store($request, $days, $hrs, $mins, $credits){

        $leave_card = new LeaveCard;
        $leave_card->slug = $this->str->random(32);
        $leave_card->leave_card_id = $this->getLeaveCardIdInc();
        $leave_card->doc_type = $request->doc_type;
        $leave_card->employee_no = $request->employee_no;
        $leave_card->leave_type = $request->leave_type;
        $leave_card->month = $request->month;
        $leave_card->year = $request->year;
        $leave_card->date_from = $this->__dataType->date_parse($request->date_from);
        $leave_card->date_to = $this->__dataType->date_parse($request->date_to);
        $leave_card->days = $days;
        $leave_card->hrs = $hrs;
        $leave_card->mins = $mins;
        $leave_card->credits = $credits;
        $leave_card->remarks = $request->remarks;
        $leave_card->created_at = $this->carbon->now();
        $leave_card->updated_at = $this->carbon->now();
        $leave_card->ip_created = request()->ip();
        $leave_card->ip_updated = request()->ip();
        $leave_card->user_created = $this->auth->user()->user_id;
        $leave_card->user_updated = $this->auth->user()->user_id;
        $leave_card->save();

        return $leave_card;


    }







    public function update($request, $slug){



    }







    public function destroy($slug){

       

    }
    






    public function findBySlug($slug){



    }







    public function requestFilter($request){


    }







    public function search($model, $key){

        $model->where(function ($model) use ($key) {
            $model->where('lastname', 'LIKE', '%'. $key .'%')
                  ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                  ->orwhere('middlename', 'LIKE', '%'. $key .'%')
                  ->orwhereHas('user', function ($model) use ($key) {
                    $model->where('username', 'LIKE', '%'. $key .'%');
                });
        });

    }







    public function populate($model){

        return $model->select('user_id', 'firstname', 'middlename', 'lastname', 'type', 'date_of_filing', 'slug')
                     ->sortable()
                     ->with('user')
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }







    public function getLeaveCardIdInc(){

        $id = 'LC1000001';

        $lc = $this->leave_card->select('leave_card_id')->orderBy('leave_card_id', 'desc')->first();

        if($lc != null){

            if($lc->leave_card_id != null){
                $num = str_replace('LC', '', $lc->leave_card_id) + 1;
                $id = 'LC' . $num;
            }
            
        }
        
        return $id;
        
    }






    public function apiGetByEmployeeNo($emp_no){

        return $this->leave_card->select('bigbal_sick_leave', 'bigbal_vacation_leave', 'bigbal_overtime')
                                ->where('employee_no', $emp_no)
                                ->orderBy('updated_at', 'desc')
                                ->take(1)
                                ->get();

    }









}