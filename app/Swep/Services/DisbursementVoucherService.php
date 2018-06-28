<?php
 
namespace App\Swep\Services;


use App\Models\Signatory;
use App\Models\DisbursementVoucher;
use App\Swep\BaseClasses\BaseService;




class DisbursementVoucherService extends BaseService{



    protected $signatory;
	protected $disbursement_voucher;




    public function __construct(Signatory $signatory, DisbursementVoucher $disbursement_voucher){

        $this->signatory = $signatory;
        $this->disbursement_voucher = $disbursement_voucher;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $disbursement_vouchers = $this->cache->remember('disbursement_vouchers:all:'. $key, 240, function() use ($request){

            $disbursement_voucher = $this->fetchRequest($request);

            return $disbursement_voucher->populate();

        });

        $request->flash();

        return view('dashboard.disbursement_voucher.index')->with('disbursement_vouchers', $disbursement_vouchers);

    }






    public function fetchByUser($request){

        $key = str_slug($request->fullUrl(), '_');

        $disbursement_vouchers = $this->cache->remember('disbursement_vouchers:byUser:'. $this->auth->user()->user_id .':' . $key, 240, function() use ($request){

            $disbursement_voucher = $this->fetchRequest($request);

            return $disbursement_voucher->populateByUser($this->auth->user()->user_id);
            
        });

        $request->flash();

        return view('dashboard.disbursement_voucher.user_index')->with('disbursement_vouchers', $disbursement_vouchers);

    }






    public function store($request){

        $disbursement_voucher = new DisbursementVoucher;
        $disbursement_voucher->slug = $this->str->random(32);
        $disbursement_voucher->dv_id = $this->disbursement_voucher->dvIdInc;
        $disbursement_voucher->user_id = $this->auth->user()->user_id;
        $disbursement_voucher->doc_no = 'DV' . rand(10000000, 99999999);
        $disbursement_voucher->date = $this->carbon->format('Y-m-d');
        $disbursement_voucher->project_id = $request->project_id;
        $disbursement_voucher->fund_source_id = $request->fund_source_id;
        $disbursement_voucher->mode_of_payment_id = $request->mode_of_payment_id;
        $disbursement_voucher->payee = $request->payee;
        $disbursement_voucher->address =  $request->address;
        $disbursement_voucher->tin = $request->tin;
        $disbursement_voucher->bur_no = $request->bur_no;
        $disbursement_voucher->department_name = $request->department_name;
        $disbursement_voucher->department_unit_name = $request->department_unit_name;
        $disbursement_voucher->project_code = $request->project_code;
        $disbursement_voucher->explanation = $request->explanation;
        $disbursement_voucher->amount = $this->dataTypeHelper->string_to_num($request->amount);
        $disbursement_voucher->certified_by = $this->signatoryByType('2')->employee_name;
        $disbursement_voucher->certified_by_position = $this->signatoryByType('2')->employee_position;
        $disbursement_voucher->approved_by = $this->signatoryByType('1')->employee_name;
        $disbursement_voucher->approved_by_position = $this->signatoryByType('1')->employee_position;
        $disbursement_voucher->created_at = $this->carbon->now();
        $disbursement_voucher->updated_at = $this->carbon->now();
        $disbursement_voucher->ip_created = request()->ip();
        $disbursement_voucher->ip_updated = request()->ip();
        $disbursement_voucher->user_created = $this->auth->user()->user_id;
        $disbursement_voucher->user_updated = $this->auth->user()->user_id;
        $disbursement_voucher->save();

        $this->event->fire('dv.store', $disbursement_voucher);
        return redirect()->back();

    }






    public function update($request, $slug){

        $disbursement_voucher = $this->dvBySlug($slug);
        $disbursement_voucher->project_id = $request->project_id;
        $disbursement_voucher->fund_source_id = $request->fund_source_id;
        $disbursement_voucher->mode_of_payment_id = $request->mode_of_payment_id;
        $disbursement_voucher->payee = $request->payee;
        $disbursement_voucher->address =  $request->address;
        $disbursement_voucher->tin = $request->tin;
        $disbursement_voucher->bur_no = $request->bur_no;
        $disbursement_voucher->department_name = $request->department_name;
        $disbursement_voucher->department_unit_name = $request->department_unit_name;
        $disbursement_voucher->project_code = $request->project_code;
        $disbursement_voucher->explanation = $request->explanation;
        $disbursement_voucher->amount = $this->dataTypeHelper->string_to_num($request->amount);
        $disbursement_voucher->updated_at = $this->carbon->now();
        $disbursement_voucher->ip_updated = request()->ip();
        $disbursement_voucher->user_updated = $this->auth->user()->user_id;
        $disbursement_voucher->save();

        $this->event->fire('dv.update', $disbursement_voucher);
        return redirect()->back();

    }






    public function show($slug){

        $disbursement_voucher = $this->dvBySlug($slug);     
        return view('dashboard.disbursement_voucher.show')->with('disbursement_voucher', $disbursement_voucher);

    }






    public function edit($slug){

        $disbursement_voucher = $this->dvBySlug($slug);     
        return view('dashboard.disbursement_voucher.edit')->with('disbursement_voucher', $disbursement_voucher);

    }






    public function destroy($slug){

        $disbursement_voucher = $this->dvBySlug($slug);
        $disbursement_voucher->delete();

        $this->event->fire('dv.destroy', $disbursement_voucher);
        return redirect()->back();

    }






    public function print($slug, $type){

       $disbursement_voucher = $this->dvBySlug($slug);

        if($type == 'front'){
            return view('printables.disbursement_voucher')->with('disbursement_voucher', $disbursement_voucher);
        }elseif($type == 'back'){
            return view('printables.disbursement_voucher_back');
        }
        return abort(404);

    }






    public function setNo($request, $slug){

        $disbursement_voucher = $this->dvBySlug($slug);
        $disbursement_voucher->dv_no = $request->dv_no;
        $disbursement_voucher->processed_at = $this->carbon->now();
        $disbursement_voucher->save();

        $this->event->fire('dv.set_no', $disbursement_voucher);
        return redirect()->back();

    }






    public function confirmCheck($slug){

        $disbursement_voucher = $this->dvBySlug($slug);

        if($disbursement_voucher->processed_at != null){

            $disbursement_voucher->checked_at = $this->carbon->now();
            $disbursement_voucher->save();

            $this->event->fire('dv.confirm_check', $disbursement_voucher);
            return redirect()->back();

        }

        $this->session->flash('SESSION_DV_CONFIRM_CHECK_FAILED_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_CONFIRM_CHECK_FAILED', 'Voucher Status failed to update! Please check the DV No. if it is set.');
        return redirect()->back();

    }






    public function saveAs($slug){

        $disbursement_voucher = $this->dvBySlug($slug);     
        return view('dashboard.disbursement_voucher.save_as')->with('disbursement_voucher', $disbursement_voucher);

    }





    // Utility Methods
    
    public function dvBySlug($slug){

        $disbursement_voucher = $this->cache->remember('disbursement_vouchers:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });
        
        return $disbursement_voucher;

    }






    public function signatoryByType($type){

        $signatory = $this->cache->remember('signatories:byType:' . $type, 240, function() use ($type){
            return $this->signatory->whereType($type)->first();
        }); 

        return $signatory;

    }






    public function fetchRequest($request){

        $df = $this->carbon->parse($request->df)->format('Y-m-d');
        $dt = $this->carbon->parse($request->dt)->format('Y-m-d');

        $disbursement_voucher = $this->disbursement_voucher->newQuery();

        if($request->q != null){
           $disbursement_voucher->search($request->q);
        }

        if($request->fs != null){
           $disbursement_voucher->whereFundSourceId($request->fs); 
        }
        
        if($request->pi != null){
            $disbursement_voucher->whereProjectId($request->pi);
        }

        if($request->dn != null){
            $disbursement_voucher->whereDepartmentName($request->dn);
        }

        if($request->dun != null){
            $disbursement_voucher->whereDepartmentUnitName($request->dun);
        }

        if($request->pc != null){
            $disbursement_voucher->whereProjectCode($request->pc);
        }

        if($request->df != null || $request->dt != null){
            $disbursement_voucher->whereBetween('date', [$df, $dt]);
        }

        return $disbursement_voucher;

    }





}