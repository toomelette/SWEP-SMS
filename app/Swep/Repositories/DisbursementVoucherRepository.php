<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Helpers\Helper;
use App\Swep\Interfaces\DisbursementVoucherInterface;
use App\Swep\Interfaces\SignatoryInterface;


use App\Models\DisbursementVoucher;


class DisbursementVoucherRepository extends BaseRepository implements DisbursementVoucherInterface {
	



    protected $disbursement_voucher;
    protected $signatory_repo;




	public function __construct(DisbursementVoucher $disbursement_voucher, SignatoryInterface $signatory_repo){

        $this->disbursement_voucher = $disbursement_voucher;
        $this->signatory_repo = $signatory_repo;
        parent::__construct();

    }







//    public function fetch($request){
//
//        $key = str_slug($request->fullUrl(), '_');
//        $entries = isset($request->e) ? $request->e : 20;
//
//        $disbursement_vouchers = $this->cache->remember('disbursement_vouchers:fetch:'. $key, 240, function() use ($request, $entries){
//            $disbursement_voucher = $this->requestFilters($request);
//            return $this->populate($disbursement_voucher, $entries);
//        });
//
//        return $disbursement_vouchers;
//
//    }







//    public function fetchByUser($request){
//
//        $key = str_slug($request->fullUrl(), '_');
//        $entries = isset($request->e) ? $request->e : 20;
//
//        $disbursement_vouchers = $this->cache->remember('disbursement_vouchers:fetchByUser:'. $this->auth->user()->user_id .':' . $key, 240, function() use ($request, $entries){
//            $disbursement_voucher = $this->requestFilters($request);
//            return $this->populateByUser($disbursement_voucher, $this->auth->user()->user_id, $entries);
//        });
//
//        return $disbursement_vouchers;
//
//    }








    public function store($request){

        $disbursement_voucher = new DisbursementVoucher;
        $disbursement_voucher->slug = $this->str->random(32);
        $disbursement_voucher->dv_id = $this->getDvIdInc();
        $disbursement_voucher->user_id = $this->auth->user()->user_id;
        $disbursement_voucher->doc_no = 'DV' . rand(10000000, 99999999);
        $disbursement_voucher->date = $this->carbon->now()->format('Y-m-d');
        $disbursement_voucher->project_id = $request->project_id;
        $disbursement_voucher->fund_source_id = $request->fund_source_id;
        $disbursement_voucher->mode_of_payment = $request->mode_of_payment;
        $disbursement_voucher->payee = $request->payee;
        $disbursement_voucher->address =  $request->address;
        $disbursement_voucher->tin = $request->tin;
        $disbursement_voucher->bur_no = $request->bur_no;
        $disbursement_voucher->department_name = $request->department_name;
        $disbursement_voucher->department_unit_name = $request->department_unit_name;
        $disbursement_voucher->project_code = $request->project_code;
        $disbursement_voucher->explanation = $request->explanation;
        $disbursement_voucher->amount = Helper::sanitizeAutonum($request->amount);
        $disbursement_voucher->certified_by = $request->certified_by;
        $disbursement_voucher->certified_by_position =  $request->certified_by_position;
        $disbursement_voucher->approved_by = $request->approved_by;
        $disbursement_voucher->approved_by_position = $request->approved_by_position;
        $disbursement_voucher->created_at = $this->carbon->now();
        $disbursement_voucher->updated_at = $this->carbon->now();
        $disbursement_voucher->ip_created = request()->ip();
        $disbursement_voucher->ip_updated = request()->ip();
        $disbursement_voucher->user_created = $this->auth->user()->user_id;
        $disbursement_voucher->user_updated = $this->auth->user()->user_id;
        $disbursement_voucher->save();

        return $disbursement_voucher;

    }








    public function update($request, $slug){

        $disbursement_voucher = $this->findBySlug($slug);
        $disbursement_voucher->project_id = $request->project_id;
        $disbursement_voucher->fund_source_id = $request->fund_source_id;
        $disbursement_voucher->mode_of_payment = $request->mode_of_payment;
        $disbursement_voucher->payee = $request->payee;
        $disbursement_voucher->address =  $request->address;
        $disbursement_voucher->tin = $request->tin;
        $disbursement_voucher->bur_no = $request->bur_no;
        $disbursement_voucher->department_name = $request->department_name;
        $disbursement_voucher->department_unit_name = $request->department_unit_name;
        $disbursement_voucher->project_code = $request->project_code;
        $disbursement_voucher->explanation = $request->explanation;
        $disbursement_voucher->amount = Helper::sanitizeAutonum($request->amount);
        $disbursement_voucher->certified_by = $request->certified_by;
        $disbursement_voucher->certified_by_position =  $request->certified_by_position;
        $disbursement_voucher->approved_by = $request->approved_by;
        $disbursement_voucher->approved_by_position = $request->approved_by_position;
        $disbursement_voucher->ip_updated = request()->ip();
        $disbursement_voucher->user_updated = $this->auth->user()->user_id;
        $disbursement_voucher->save();

        return $disbursement_voucher;

    }








    public function destroy($slug){

        $disbursement_voucher = $this->findBySlug($slug);
        $disbursement_voucher->delete();

        return $disbursement_voucher;

    }







    public function setNo($request, $slug){
        if($request->dv_no === null){
            $request->dv_no  = '';
        }
        $disbursement_voucher = $this->findBySlug($slug);
        $disbursement_voucher->dv_no = $request->dv_no;
        $disbursement_voucher->processed_at = $this->carbon->now();
        $disbursement_voucher->save();

        return $disbursement_voucher;

    }







    public function confirmCheck($disbursement_voucher){

        $disbursement_voucher->checked_at = $this->carbon->now();
        $disbursement_voucher->save();

        return $disbursement_voucher;

    }







    public function findBySlug($slug){


        $disbursement_voucher = $this->disbursement_voucher->where('slug', $slug)
                                              ->with('project', 'fundSource')
                                              ->first();

        
        if(empty($disbursement_voucher)){
            abort(404);
        }
        return $disbursement_voucher;

    }








    public function requestFilters($request){

        $df = $this->__dataType->date_parse($request->df);
        $dt = $this->__dataType->date_parse($request->dt);

        $disbursement_voucher = $this->disbursement_voucher->newQuery();

        if(isset($request->q)){
           $this->search($disbursement_voucher, $request->q);
        }

        if(isset($request->fs)){
           $disbursement_voucher->whereFundSourceId($request->fs); 
        }
        
        if(isset($request->pi)){
            $disbursement_voucher->whereProjectId($request->pi);
        }

        if(isset($request->dn)){
            $disbursement_voucher->whereDepartmentName($request->dn);
        }

        if(isset($request->dun)){
            $disbursement_voucher->whereDepartmentUnitName($request->dun);
        }

        if(isset($request->pc)){
            $disbursement_voucher->whereProjectCode($request->pc);
        }

        if(isset($request->df) || isset($request->dt)){
            $disbursement_voucher->whereBetween('date', [$df, $dt]);
        }

        return $disbursement_voucher;

    }







    public function search($model, $key){

        $model->where(function ($model) use ($key) {
            $model->where('payee', 'LIKE', '%'. $key .'%')
                 ->orwhere('dv_no', 'LIKE', '%'. $key .'%')
                 ->orwhere('doc_no', 'LIKE', '%'. $key .'%')
                 ->orwhere('department_name', 'LIKE', '%'. $key .'%')
                 ->orwhere('department_unit_name', 'LIKE', '%'. $key .'%')
                 ->orwhere('project_code', 'LIKE', '%'. $key .'%')
                 ->orwhere('fund_source_id', 'LIKE', '%'. $key .'%')
                 ->orwhereHas('user', function ($model) use ($key) {
                    $model->where('firstname', 'LIKE', '%'. $key .'%')
                          ->orwhere('middlename', 'LIKE', '%'. $key .'%')
                          ->orwhere('lastname', 'LIKE', '%'. $key .'%')
                          ->orwhere('username', 'LIKE', '%'. $key .'%');
                });
        });

    }







    public function populate($model, $entries){

        return $model->select('payee', 'dv_no', 'explanation', 'date', 'amount', 'checked_at', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->with('user')
                     ->paginate($entries);

    }







     public function populateByUser($model, $id, $entries){

        return $model->select('payee', 'explanation', 'date', 'amount', 'checked_at', 'slug')
                     ->where('user_id', $id)
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }







    public function getDvIdInc(){

        $id = 'DV1000001';

        $dv = $this->disbursement_voucher->select('dv_id')->orderBy('dv_id', 'desc')->first();

        if($dv != null){

            if($dv->dv_id != null){
                $num = str_replace('DV', '', $dv->dv_id) + 1;
                $id = 'DV' . $num;
            }
        
        }
        
        return $id;
        
    }






}