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

        $last_leave_card = $this->leave_card_repo->findLastByEmployeeNo($request->employee_no);

        $days = 0;
        $hrs = 0;
        $mins = 0;
        $credits = 0;
        $balance_sick = $last_leave_card->bigbal_sick_leave;
        $balance_vacation = $last_leave_card->bigbal_vacation_leave;
        $balance_overtime = $last_leave_card->bigbal_overtime;

        $date_from = $this->carbon->parse($request->date_from);


        // Leave
        if ($request->doc_type == 'LEAVE') {

            $days = $date_from->diffInWeekdays($request->date_to);

            $credits = number_format($days * 1.000, 3);

            if($request->leave_type == 'SICK') {

                if ($balance_sick < $credits) {

                    $this->session->flash('LC_INSUFFICIENT_SICK_LEAVE_CREDIT', 'The employee dont have enough Sick Leave Credit.');
                    $request->flash();
                    return redirect()->back();

                }

                $balance_sick = $balance_sick - $credits;

            }elseif($request->leave_type == 'VAC'){

                if ($balance_vacation < $credits) {

                    $this->session->flash('LC_INSUFFICIENT_VAC_LEAVE_CREDIT', 'The employee dont have enough Vacation Leave Credit.');
                    $request->flash();
                    return redirect()->back();

                }

                $balance_vacation = $balance_vacation - $credits;

            }else{

                abort(404);

            }

        }elseif($request->doc_type == 'OT'){

            $
            $credits = number_format($request->hrs * .125, 3);

        }


        $leave_card = $this->leave_card_repo->store($request, $days, $hrs, $mins, $credits, $balance_sick, $balance_vacation, $balance_overtime);

        $this->event->fire('leave_card.store', $leave_card);
        return redirect()->back();

    }






    public function store_overtime($request){

        $last_leave_card = $this->leave_card_repo->findLastByEmployeeNo($request->employee_no);

        $days = 0;
        $hrs = 0;
        $mins = 0;
        $credits = 0;
        $balance_sick = $last_leave_card->bigbal_sick_leave;
        $balance_vacation = $last_leave_card->bigbal_vacation_leave;
        $balance_overtime = $last_leave_card->bigbal_overtime;

        $date_from = $this->carbon->parse($request->date_from);


        // Leave
        if ($request->doc_type == 'LEAVE') {

            $days = $date_from->diffInWeekdays($request->date_to);

            $credits = number_format($days * .125, 3);

            if($request->leave_type == 'SICK') {

                if ($balance_sick < $credits) {

                    $this->session->flash('LC_INSUFFICIENT_SICK_LEAVE_CREDIT', 'The employee dont have enough Sick Leave Credit.');
                    $request->flash();
                    return redirect()->back();

                }

                $balance_sick = $balance_sick - $credits;

            }elseif($request->leave_type == 'VAC'){

                if ($balance_vacation < $credits) {

                    $this->session->flash('LC_INSUFFICIENT_VAC_LEAVE_CREDIT', 'The employee dont have enough Vacation Leave Credit.');
                    $request->flash();
                    return redirect()->back();

                }

                $balance_vacation = $balance_vacation - $credits;

            }else{

                abort(404);

            }

        }else{

            abort(404);

        }


        $leave_card = $this->leave_card_repo->store($request, $days, $hrs, $mins, $credits, $balance_sick, $balance_vacation, $balance_overtime);

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