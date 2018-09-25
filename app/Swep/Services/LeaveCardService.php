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






    public function fetchByUser($request){

        $leave_cards = $this->leave_card_repo->fetchByUser($request);

        $request->flash();
        return view('dashboard.leave_card.user_index')->with('leave_cards', $leave_cards);

    }






    public function store($request){

        $leave_card = $this->leave_card_repo->store($request);

        $this->event->fire('la.store', $leave_card);
        return redirect()->back();

    }






    public function edit($slug){

        $leave_card = $this->leave_card_repo->findBySlug($slug);
        return view('dashboard.leave_card.edit')->with('leave_card', $leave_card);

    }






    public function update($request, $slug){

        $leave_card = $this->leave_card_repo->update($request, $slug);

        $this->event->fire('la.update', $leave_card);
        return redirect()->back();

    }





    public function show($slug){

        $leave_card = $this->leave_card_repo->findBySlug($slug);
        return view('dashboard.leave_card.show')->with('leave_card', $leave_card);

    }





    public function destroy($slug){

        $leave_card = $this->leave_card_repo->destroy($slug);

        $this->event->fire('la.destroy', $leave_card );
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