<?php 
namespace App\Swep\Services;


use App\Swep\Interfaces\LeaveCardInterface;
use App\Swep\Interfaces\EmployeeInterface;
use App\Swep\BaseClasses\BaseService;


class LeaveCardService extends BaseService{


    protected $leave_card_repo;
    protected $employee_repo;



    public function __construct(LeaveCardInterface $leave_card_repo, EmployeeInterface $employee_repo){

        $this->leave_card_repo = $leave_card_repo;
        $this->employee_repo = $employee_repo;
        parent::__construct();

    }






    public function fetchAll($request){

        $leave_cards = $this->leave_card_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.leave_card.index')->with('leave_cards', $leave_cards);

    }






    public function store($request){

        $year = 0;
        $month = 0;
        $days = 0;
        $hrs = 0;
        $mins = 0;
        $credits = 0;

        $date_from = $this->carbon->parse($request->date_from);


        // Leave
        if ($request->doc_type == 'LEAVE') {

            $year = $request->year;
            $month = $request->month;
            $days = $date_from->diffInWeekdays($request->date_to) + 1;
            $credits = number_format($days * 1.000, 3);

        }


        //  OT, TARDY, UT
        if($request->doc_type == 'OT' || $request->doc_type == 'TARDY' || $request->doc_type == 'UT'){

            $year = $this->__dataType->date_parse($request->date, 'Y');
            $month = $this->__dataType->date_parse($request->date, 'm');
            $hrs = $request->hrs;
            $mins = $request->mins;
            $credits_hrs = number_format($hrs * .125, 3);
            $credits_mins = number_format($mins * .125/60, 3);

            $credits = $credits_hrs + $credits_mins;

        }


        $leave_card = $this->leave_card_repo->store($request, $year, $month, $days, $hrs, $mins, $credits);

        $this->event->fire('leave_card.store', $leave_card);
        return redirect()->back();

    }







    public function edit($slug){

        $leave_card = $this->leave_card_repo->findBySlug($slug);
        return view('dashboard.leave_card.edit')->with('leave_card', $leave_card);

    }







    public function update($request, $slug){

        $year = 0;
        $month = 0;
        $days = 0;
        $hrs = 0;
        $mins = 0;
        $credits = 0;

        $date_from = $this->carbon->parse($request->date_from);


        // Leave
        if ($request->doc_type == 'LEAVE') {

            $year = $request->year;
            $month = $request->month;
            $days = $date_from->diffInWeekdays($request->date_to) + 1;
            $credits = number_format($days * 1.000, 3);

        }


        // OT, TARDY, UT
        if($request->doc_type == 'OT' || $request->doc_type == 'TARDY' || $request->doc_type == 'UT'){

            $year = $this->__dataType->date_parse($request->date, 'Y');
            $month = $this->__dataType->date_parse($request->date, 'm');
            $hrs = $request->hrs;
            $mins = $request->mins;
            $credits_hrs = number_format($hrs * .125, 3);
            $credits_mins = number_format($mins * .125/60, 3);

            $credits = $credits_hrs + $credits_mins;

        }

        $leave_card = $this->leave_card_repo->update($request, $year, $month, $days, $hrs, $mins, $credits, $slug);

        $this->event->fire('leave_card.update', $leave_card);
        return redirect()->route('dashboard.leave_card.index');

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






    public function reportGenerate($request){

        if($request->r_type == 'loat'){

            $employees = $this->employee_repo->fetchByIsActive('ACTIVE');
            return view('printables.leave_card_loat')->with('employees', $employees);

        }elseif($request->r_type == 'ledger'){

            $employee = $this->employee_repo->findBySlug($request->s);
            return view('printables.leave_card_ledger')->with('employee', $employee);

        }else{

            abort(404);

        }
        

    }







}