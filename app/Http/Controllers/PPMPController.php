<?php


namespace App\Http\Controllers;
use App\Http\Requests\PPMP\PPMPFormRequest;
use App\Models\PapParent;
use App\Models\PPMP;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;




class PPMPController extends Controller
{
    public function index(Request $request){
        if($request->has('fiscal_year') && $request->has('resp_center') && $request->resp_center != null && $request->fiscal_year != null){
            return view('dashboard.ppmp.index')->with([
                'request' => $request,
            ]);
        }


        return view('dashboard.recommended_budget.pre_index')->with([
            'action' => route('dashboard.ppmp.index'),
        ]);

        return view('dashboard.ppmp.index');
    }

    public function store(PPMPFormRequest $request){
        if(!$request->has('fiscal_year') || !$request->has('resp_center') || $request->fiscal_year == '' || $request->resp_center == ''){
            abort(503,'No year and responsibility center assigned.');
        }
        $ppmp = new PPMP;
        $ppmp->slug = Str::random(16);
        $ppmp->ppmp_code = $request->ppmp_code;
        $ppmp->fiscal_year = $request->fiscal_year;
        $ppmp->budget_type = $request->budget_type;
        $ppmp->resp_center = $request->resp_center;
        $ppmp->total_budget = '1';
        $ppmp->pap_code = $request->pap_code;
        $ppmp->gen_desc = $request->gen_desc;
        $ppmp->unit_cost = Helper::sanitizeAutonum($request->unit_cost);
        $ppmp->qty = $request->qty;
        $ppmp->uom = $request->uom;
        $ppmp->mode_of_proc = $request->mode_of_proc;
        $ppmp->remark = $request->remark;
        $ppmp->qty_jan = $request->qty_jan;
        $ppmp->qty_feb = $request->qty_feb;
        $ppmp->qty_mar = $request->qty_mar;
        $ppmp->qty_apr = $request->qty_apr;
        $ppmp->qty_may = $request->qty_may;
        $ppmp->qty_jun = $request->qty_jun;
        $ppmp->qty_jul = $request->qty_jul;
        $ppmp->qty_aug = $request->qty_aug;
        $ppmp->qty_sep = $request->qty_sep;
        $ppmp->qty_oct = $request->qty_oct;
        $ppmp->qty_nov = $request->qty_nov;
        $ppmp->qty_dec = $request->qty_dec;
        if($ppmp->save()){
            return $ppmp->only('slug');
        }
        abort(503,'Error saving data.');
    }


}