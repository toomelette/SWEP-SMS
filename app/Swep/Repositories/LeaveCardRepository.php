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

        $key = str_slug($request->fullUrl(), '_');

        $leave_cards = $this->cache->remember('leave_cards:all:' . $key, 240, function() use ($request){

            $df = $this->__dataType->date_parse($request->df);
            $dt = $this->__dataType->date_parse($request->dt);

            $leave_card = $this->leave_card->newQuery();
            
            if(isset($request->q)){
                $this->search($leave_card, $request->q);
            }

            if(isset($request->emp)){
                $leave_card->whereEmployeeNo($request->emp);
            }

            if(isset($request->doc_t)){
                $leave_card->whereDocType($request->doc_t);
            }

            if(isset($request->leave_t)){
                $leave_card->whereLeaveType($request->leave_t);
            }

            if(isset($request->df) || isset($request->dt)){
                $leave_card->whereBetween('date', [$df, $dt])
                           ->orwhereBetween('date_from', [$df, $dt]);
            }

            return $this->populate($leave_card);

        });

        return $leave_cards;

    }






    public function store($request, $year, $month, $days, $hrs, $mins, $credits){

        $leave_card = new LeaveCard;
        $leave_card->slug = $this->str->random(32);
        $leave_card->leave_card_id = $this->getLeaveCardIdInc();
        $leave_card->doc_type = $request->doc_type;
        $leave_card->employee_no = $request->employee_no;
        $leave_card->leave_type = $request->leave_type;
        $leave_card->charge_to = $request->charge_to;
        $leave_card->month = $month;
        $leave_card->year = $year;
        $leave_card->date = $this->__dataType->date_parse($request->date);
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







    public function update($request, $year, $month, $days, $hrs, $mins, $credits, $slug){

        $leave_card = $this->findBySlug($slug);
        $leave_card->slug = $this->str->random(32);
        $leave_card->leave_card_id = $this->getLeaveCardIdInc();
        $leave_card->doc_type = $request->doc_type;
        $leave_card->employee_no = $request->employee_no;
        $leave_card->leave_type = $request->leave_type;
        $leave_card->charge_to = $request->charge_to;
        $leave_card->month = $month;
        $leave_card->year = $year;
        $leave_card->date = $this->__dataType->date_parse($request->date);
        $leave_card->date_from = $this->__dataType->date_parse($request->date_from);
        $leave_card->date_to = $this->__dataType->date_parse($request->date_to);
        $leave_card->days = $days;
        $leave_card->hrs = $hrs;
        $leave_card->mins = $mins;
        $leave_card->credits = $credits;
        $leave_card->remarks = $request->remarks;
        $leave_card->updated_at = $this->carbon->now();
        $leave_card->ip_updated = request()->ip();
        $leave_card->user_updated = $this->auth->user()->user_id;
        $leave_card->save();

        return $leave_card;

    }







    public function destroy($slug){

       $leave_card = $this->findBySlug($slug);
       $leave_card->delete();

       return $leave_card;

    }
    






    public function findBySlug($slug){

        $leave_card = $this->cache->remember('leave_cards:bySlug:' . $slug, 240, function() use ($slug){
            return $this->leave_card->where('slug', $slug)->first();
        });
        
        if(empty($leave_card)){
            abort(404);
        }
        
        return $leave_card;

    }







    public function search($model, $key){

        $model->where(function ($model) use ($key) {
            $model->where('employee_no', 'LIKE', '%'. $key .'%')
                  ->orwhereHas('employee', function ($model) use ($key) {
                    $model->where('fullname', 'LIKE', '%'. $key .'%')
                          ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                          ->orwhere('middlename', 'LIKE', '%'. $key .'%')
                          ->orwhere('lastname', 'LIKE', '%'. $key .'%');
                });
        });

    }







    public function populate($model){

        return $model->select('employee_no', 'doc_type', 'leave_type', 'date', 'date_from', 'date_to', 'credits', 'slug')
                     ->sortable()
                     ->with('employee')
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









}