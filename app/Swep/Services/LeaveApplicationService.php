<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\LeaveApplicationInterface;
use App\Swep\BaseClasses\BaseService;


class LeaveApplicationService extends BaseService{


    protected $leave_application_repo;



    public function __construct(LeaveApplicationInterface $leave_application_repo){

        $this->leave_application_repo = $leave_application_repo;
        parent::__construct();

    }





    public function fetch($request){

        $leave_applications = $this->leave_application_repo->fetch($request);

        $request->flash();
        return view('dashboard.leave_application.index')->with('leave_applications', $leave_applications);

    }






    public function fetchByUser($request){

        $leave_applications = $this->leave_application_repo->fetchByUser($request);

        $request->flash();
        return view('dashboard.leave_application.user_index')->with('leave_applications', $leave_applications);

    }






    public function store($request){

        $leave_application = $this->leave_application_repo->store($request);

        $this->event->fire('la.store', $leave_application);
        return redirect()->back();

    }






    public function edit($slug){

        $leave_application = $this->leave_application_repo->findBySlug($slug);
        return view('dashboard.leave_application.edit')->with('leave_application', $leave_application);

    }






    public function update($request, $slug){

        $leave_application = $this->leave_application_repo->update($request, $slug);

        $this->event->fire('la.update', $leave_application);
        return redirect()->back();

    }





    public function show($slug){

        $leave_application = $this->leave_application_repo->findBySlug($slug);
        return view('dashboard.leave_application.show')->with('leave_application', $leave_application);

    }





    public function destroy($slug){

        $leave_application = $this->leave_application_repo->destroy($slug);

        $this->event->fire('la.destroy', $leave_application );
        return redirect()->route('dashboard.leave_application.index');

    }





    public function print($slug, $type){

       $leave_application = $this->leave_application_repo->findBySlug($slug);

        if($type == 'front'){
            return view('printables.leave_application.la_front')->with('leave_application', $leave_application);
        }elseif($type == 'back'){
            return view('printables.leave_application.la_back');
        }
        return abort(404);

    }





    public function saveAs($slug){

        $leave_application = $this->leave_application_repo->findBySlug($slug);
        return view('dashboard.leave_application.save_as')->with('leave_application', $leave_application);

    }






}