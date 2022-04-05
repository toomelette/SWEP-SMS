<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\DisbursementVoucherInterface;
use App\Swep\BaseClasses\BaseService;




class DisbursementVoucherService extends BaseService{



    protected $dv_repo;




    public function __construct(DisbursementVoucherInterface $dv_repo){

        $this->dv_repo = $dv_repo;
        parent::__construct();

    }





    public function fetch($request){

        $disbursement_vouchers = $this->dv_repo->fetch($request);

        $request->flash();
        return view('dashboard.disbursement_voucher.index')->with('disbursement_vouchers', $disbursement_vouchers);

    }






    public function fetchByUser($request){

        $disbursement_vouchers = $this->dv_repo->fetchByUser($request);

        $request->flash();
        return view('dashboard.disbursement_voucher.user_index')->with('disbursement_vouchers', $disbursement_vouchers);

    }






    public function store($request){

        $disbursement_voucher = $this->dv_repo->store($request);
        return $disbursement_voucher;
//        $this->event->fire('dv.store', $disbursement_voucher);
//        return redirect()->back();

    }






    public function update($request, $slug){

        $disbursement_voucher = $this->dv_repo->update($request, $slug);
        return $disbursement_voucher;
//        $this->event->fire('dv.update', $disbursement_voucher);
//        return redirect()->back();

    }






    public function show($slug){

        $disbursement_voucher = $this->dv_repo->findBySlug($slug);     
        return view('dashboard.disbursement_voucher.show')->with('disbursement_voucher', $disbursement_voucher);

    }






    public function edit($slug){

        $disbursement_voucher = $this->dv_repo->findBySlug($slug);     
        return view('dashboard.disbursement_voucher.edit')->with('disbursement_voucher', $disbursement_voucher);

    }






    public function destroy($slug){

        $disbursement_voucher = $this->dv_repo->destroy($slug);
        return $disbursement_voucher;
//        $this->event->fire('dv.destroy', $disbursement_voucher);
//        return redirect()->back();

    }






    public function print($slug, $type){

       $disbursement_voucher = $this->dv_repo->findBySlug($slug);

        if($type == 'front'){
            return view('printables.disbursement_voucher.dv_front')->with('disbursement_voucher', $disbursement_voucher);
        }elseif($type == 'fb'){
            return view('printables.disbursement_voucher.dv_front_and_back')->with('disbursement_voucher', $disbursement_voucher);;
        }elseif($type == 'back'){
            return view('printables.disbursement_voucher.dv_back');
        }
        return abort(404);

    }






    public function setNo($request, $slug){

        $disbursement_voucher = $this->dv_repo->setNo($request, $slug);
        return $disbursement_voucher;

    }






    public function confirmCheck($slug){

        $disbursement_voucher = $this->dv_repo->findBySlug($slug);

        if(isset($disbursement_voucher->processed_at)){

            $this->dv_repo->confirmCheck($disbursement_voucher);

            $this->event->fire('dv.confirm_check', $disbursement_voucher);
            return redirect()->back();

        }

        $this->session->flash('SESSION_DV_CONFIRM_CHECK_FAILED_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_CONFIRM_CHECK_FAILED', 'Voucher Status failed to update! Please check the DV No if it is set.');
        return redirect()->back();

    }






    public function saveAs($slug){

        $disbursement_voucher = $this->dv_repo->findBySlug($slug);   
        return view('dashboard.disbursement_voucher.save_as')->with('disbursement_voucher', $disbursement_voucher);

    }








}