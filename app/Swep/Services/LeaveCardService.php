<?php 
namespace App\Swep\Services;


use App\Swep\Interfaces\LeaveCardInterface;
use App\Swep\BaseClasses\BaseService;


class LeaveCardService extends BaseService{


    protected $leave_card_repo;



    public function __construct(LeaveCardInterface $leave_card_repo){

        $this->leave_card_repo = $leave_card_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        $leave_cards = $this->leave_card_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.leave_card.index')->with('leave_cards', $leave_cards);

    }






    public function store($request){

        $days = 0;
        $hrs = 0;
        $mins = 0;
        $credits = 0;
        $bb_sick = $this->leave_card_repo->findLastSickLeaveBalanceByEmployee($request->employee_no);
        $bb_vac = $this->leave_card_repo->findLastVacationLeaveBalanceByEmployee($request->employee_no);
        $bb_overtime = $this->leave_card_repo->findLastOvertimeBalanceByEmployee($request->employee_no);

        $date_from = $this->carbon->parse($request->date_from);

        if ($request->doc_type == 'LEAVE') {

            $days = $date_from->diffInWeekdays($request->date_to);

            $credits = number_format($days * .125, 3);

            if($request->leave_type == 'SICK') {

                $bb_sick = $bb_sick->bigbal_sick_leave - $credits;

            }elseif($request->leave_type == 'VAC'){

                $bb_sick = $bb_vac->bigbal_vac_leave - $credits;

            }else{

                abort(404);

            }

        }
        
        $leave_card = $this->leave_card_repo->store($request, $days, $hrs, $mins, $credits, $bb_sick, $bb_vac, $bb_overtime);

        $this->event->fire('leave_card.store', $leave_card);
        return redirect()->back();

    }






    public function edit($slug){

        $leave_card = $this->leave_card_repo->findBySlug($slug);
        return view('dashboard.leave_card.edit')->with('leave_card', $leave_card);

    }






    public function update($request, $slug){

        $leave_card = $this->leave_card_repo->update($request, $slug);

        $this->event->fire('leave_card.update', $leave_card);
        return redirect()->back();

    }





    public function show($slug){

        $leave_card = $this->leave_card_repo->findBySlug($slug);
        return view('dashboard.leave_card.show')->with('leave_card', $leave_card);

    }





    public function destroy($slug){

        $leave_card = $this->leave_card_repo->destroy($slug);

        $this->event->fire('leave_card.destroy', $leave_card );
        return redirect()->route('dashboard.leave_card.index');

    }





    public function print($slug, $type){

       $leave_card = $this->leave_card_repo->findBySlug($slug);

        if($type == 'front'){
            return view('printables.leave_card')->with('leave_card', $leave_card);
        }elseif($type == 'back'){
            return view('printables.leave_card_back');
        }
        return abort(404);

    }







}