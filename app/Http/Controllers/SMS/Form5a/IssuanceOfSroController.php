<?php


namespace App\Http\Controllers\SMS\Form5a;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form5a\IssuancesOfSro;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class IssuanceOfSroController extends Controller
{
    public function index(){
        if(\request()->ajax()){
            $issuances = IssuancesOfSro::query();
            return DataTables::of($issuances)
                ->addColumn('action',function($data){
                    return 1;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
    }
    public function store(Request $request){
        $i = new IssuancesOfSro;
        $i->weekly_report_slug = $request->weekly_report_slug;
        $i->slug = Str::random();
        $i->date_of_issue = $request->date_of_issue;
        $i->sro_no = $request->sro_no;
        $i->trader = $request->trader;
        $i->raw_qty = $request->raw_qty;
        $i->monitoring_fee_or_no = $request->monitoring_fee_or_no;
        $i->rsq_no = $request->rsq_no;
        $i->refined_qty = $request->refined_qty;

        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }
}