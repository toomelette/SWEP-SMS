<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use App\Models\DisbursementVouchers;
use Illuminate\Cache\Repository as Cache;

class DisbursementVoucherService{



	protected $disbursement_voucher;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;




    public function __construct(DisbursementVouchers $disbursement_voucher, Dispatcher $event, Cache $cache){

        $this->disbursement_voucher = $disbursement_voucher;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function store(Request $request){

        $disbursement_voucher = $this->disbursement_voucher->create($request->except(['amount', 'payee', 'address']));
        $this->event->fire('dv.create', [ $disbursement_voucher, $request ]);
        $this->session->flash('SESSION_DV_CREATE_SUCCESS_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_CREATE_SUCCESS', 'Your Voucher has been successfully Created!');
        return redirect()->back();

    }




    public function show($slug){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });     

        return view('dashboard.disbursement_voucher.show')->with('disbursement_voucher', $disbursement_voucher);

    }




}