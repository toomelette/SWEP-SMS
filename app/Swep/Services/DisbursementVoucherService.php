<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use App\Models\DisbursementVouchers;
use Illuminate\Support\Facades\Validator;
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




    public function fetchAll(Request $request){

        $key = str_slug($request->fullUrl(), '_');

        $disbursement_vouchers = $this->cache->remember('disbursement_voucher:all:'. $key, 240, function() use ($request){
            $disbursement_voucher = $this->fetchRequest($request);
            return $disbursement_voucher->populate();
        });

        $request->flash();

        return view('dashboard.disbursement_voucher.index')->with('disbursement_vouchers', $disbursement_vouchers);

    }




    public function fetchByUser(Request $request){

        $key = str_slug($request->fullUrl(), '_');

        $disbursement_vouchers = $this->cache->remember('disbursement_voucher:byUser:'. $this->auth->user()->user_id .':' . $key, 240, function() use ($request){
            $disbursement_voucher = $this->fetchRequest($request);
            return $disbursement_voucher->populateByUser($this->auth->user()->user_id);
        });

        $request->flash();

        return view('dashboard.disbursement_voucher.user_index')->with('disbursement_vouchers', $disbursement_vouchers);

    }




    public function store(Request $request){

        $disbursement_voucher = $this->disbursement_voucher->create($request->except(['amount', 'payee', 'address']));
        $this->event->fire('dv.create', [ $disbursement_voucher, $request ]);
        $this->session->flash('SESSION_DV_CREATE_SUCCESS_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_CREATE_SUCCESS', 'Your Voucher has been successfully Created!');
        return redirect()->back();

    }




    public function update(Request $request, $slug){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });

        $disbursement_voucher->update($request->except(['amount', 'payee', 'address']));
        $this->event->fire('dv.update', [ $disbursement_voucher, $request ]);
        $this->session->flash('SESSION_DV_UPDATE_SUCCESS_SLUG', $disbursement_voucher->slug);
        $this->session->flash('SESSION_DV_UPDATE_SUCCESS', 'Your Voucher has been successfully Updated!');
        return redirect()->back();

    }




    public function show($slug){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });     

        return view('dashboard.disbursement_voucher.show')->with('disbursement_voucher', $disbursement_voucher);

    }




    public function edit($slug){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });     

        return view('dashboard.disbursement_voucher.edit')->with('disbursement_voucher', $disbursement_voucher);

    }




    public function destroy($slug){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });

        $disbursement_voucher->delete();
        $this->event->fire('dv.destroy', $disbursement_voucher);
        $this->session->flash('SESSION_DV_DELETE_SUCCESS', 'Your Voucher has been successfully Deleted!');
        return redirect()->back();

    }




    public function print($slug, $type){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });    

        if($type == 'front'){
            return view('printables.disbursement_voucher')->with('disbursement_voucher', $disbursement_voucher);
        }elseif($type == 'back'){
            return view('printables.disbursement_voucher_back');
        }
        return abort(404);

    }




    public function setNo(Request $request, $slug){

        $disbursement_voucher = $this->cache->remember('disbursement_voucher:bySlug:' . $slug, 240, function() use ($slug){
            return $this->disbursement_voucher->findSlug($slug);
        });    

        $disbursement_voucher->update(['dv_no' => $request->dv_no]);
        $this->event->fire('dv.set_no', $disbursement_voucher);
        $this->session->flash('SESSION_DV_SET_NO_SUCCESS', 'DV No. successfully set!');
        return redirect()->back();

    }




    //Utility Methods
    
    public function fetchRequest(Request $request){

        $df = Carbon::parse($request->df)->format('Y-m-d');
        $dt = Carbon::parse($request->dt)->format('Y-m-d');

        $disbursement_voucher = $this->disbursement_voucher->newQuery();

        if($request->q != null){
           $disbursement_voucher->search($request->q);
        }

        if($request->fs != null){
           $disbursement_voucher->whereFundSource($request->fs); 
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

        if($request->ac != null){
            $disbursement_voucher->whereAccountCode($request->ac);
        }

        if($request->df != null || $request->dt != null){
            $disbursement_voucher->whereBetween('date', [$df, $dt]);
        }

        return $disbursement_voucher;

    }



}