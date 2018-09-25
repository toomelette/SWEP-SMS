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






    public function store($request){

        

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

        $id = 'LA1000001';

        $la = $this->leave_card->select('leave_card_id')->orderBy('leave_card_id', 'desc')->first();

        if($la != null){

            if($la->leave_card_id != null){
                $num = str_replace('LA', '', $la->leave_card_id) + 1;
                $id = 'LA' . $num;
            }
            
        }
        
        return $id;
        
    }









}