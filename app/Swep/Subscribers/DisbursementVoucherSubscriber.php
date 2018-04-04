<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Models\Signatories;
use App\Models\DisbursementVouchers;
use Illuminate\Cache\Repository as Cache;


class DisbursementVoucherSubscriber{


	protected $disbursement_vouchers;
	protected $signatory;
	protected $carbon;
    protected $cache;
	protected $auth;
    protected $str;
    



	public function __construct(DisbursementVouchers $disbursement_voucher, Signatories $signatory, Carbon $carbon, Cache $cache, Str $str){

		$this->disbursement_voucher = $disbursement_voucher;
		$this->signatory = $signatory;
		$this->carbon = $carbon;
        $this->cache = $cache;
		$this->str = $str;
        $this->auth = auth();


	}



	public function subscribe($events){

		$events->listen('dv.create', 'App\Swep\Subscribers\DisbursementVoucherSubscriber@onCreate');

	}



	public function onCreate($disbursement_voucher, $request){

		$this->createDefaults($disbursement_voucher);

        $disbursement_voucher->payee = strtoupper($request->payee);
        $disbursement_voucher->address = strtoupper($request->address);
        $disbursement_voucher->amount = str_replace(',', '', $request->amount);
        $disbursement_voucher->certified_by = $this->getSignatory('2')->employee_name;
        $disbursement_voucher->certified_by_position = $this->getSignatory('2')->employee_position;
        $disbursement_voucher->approved_by = $this->getSignatory('1')->employee_name;
        $disbursement_voucher->approved_by_position = $this->getSignatory('1')->employee_position;
        $disbursement_voucher->save();
        
	}




	// Defaults
	public function createDefaults($disbursement_voucher){

		$disbursement_voucher->slug = $this->str->random(32);
        $disbursement_voucher->user_id = $this->auth->user()->user_id;
        $disbursement_voucher->doc_no = 'DV' . rand(10000000, 99999999);
        $disbursement_voucher->date = $this->carbon->format('Y-m-d');
        $disbursement_voucher->created_at = $this->carbon->now();
        $disbursement_voucher->updated_at = $this->carbon->now();
        $disbursement_voucher->machine_created = gethostname();
        $disbursement_voucher->machine_updated = gethostname();
        $disbursement_voucher->ip_created = request()->ip();
        $disbursement_voucher->ip_updated = request()->ip();
        $disbursement_voucher->user_created = $this->auth->user()->user_id;
        $disbursement_voucher->user_updated = $this->auth->user()->user_id;
        $disbursement_voucher->save();

	}




	// Utility Methods
	public function getSignatory($type){

		$signatory = $this->cache->remember('signatories:byType:' . $type, 240, function() use ($type){
            return $this->signatory->whereType($type)->first();
        }); 

		return $signatory;

	}




}