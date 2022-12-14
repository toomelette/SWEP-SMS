<?php


namespace App\Http\Controllers\SMS\Form5a;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form5a\IssuancesOfSro;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\TextUI\Help;
use Yajra\DataTables\DataTables;

class IssuanceOfSroController extends Controller
{
    public function index(){
        if(\request()->ajax()){
            $issuances = IssuancesOfSro::query()
                ->where('weekly_report_slug','=',\request('weekly_report_slug'));
            return DataTables::of($issuances)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form5a_issuanceOfSro.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form5a_issuanceOfSro.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger btn-xs " data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                  
                                </div>';
                    return $button;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
    }
    public function store(Request $request, WeeklyReportService $weeklyReportService){
        $weeklyReportService->isNotSubmitted($request->weekly_report_slug);
        $i = new IssuancesOfSro;
        $i->weekly_report_slug = $request->weekly_report_slug;
        $i->slug = Str::random();
        $i->date_of_issue = $request->date_of_issue;
        $i->sro_no = $request->sro_no;
        $i->trader = $request->trader;
        $i->raw_qty = Helper::sanitizeAutonum($request->raw_qty);
        $i->monitoring_fee_or_no = $request->monitoring_fee_or_no;
        $i->rsq_no = $request->rsq_no;
        $i->liens_or = $request->liens_or;
        if($request->cropCharge == 'CURRENT'){
            $i->refined_qty = Helper::sanitizeAutonum($request->refined_qty);
        }else{
            $i->prev_refined_qty = Helper::sanitizeAutonum($request->refined_qty);
        }
        $i->consumption = $request->consumption;

        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }


    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form5a.issuance_edit')->with([
            'issuance' => $this->findBySlug($slug),
        ]);
    }

    public function update(Request $request,$slug, WeeklyReportService $weeklyReportService){
        $i = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($i->weekly_report_slug);
        $i->date_of_issue = $request->date_of_issue;
        $i->sro_no = $request->sro_no;
        $i->trader = $request->trader;
        $i->raw_qty = Helper::sanitizeAutonum($request->raw_qty);
        $i->monitoring_fee_or_no = $request->monitoring_fee_or_no;
        $i->rsq_no = $request->rsq_no;
        $i->refined_qty = $request->refined_qty;
        $i->liens_or = $request->liens_or;
        if($request->cropCharge == 'CURRENT'){
            $i->refined_qty = Helper::sanitizeAutonum($request->refined_qty);
            $i->prev_refined_qty = null;
        }else{
            $i->prev_refined_qty = Helper::sanitizeAutonum($request->refined_qty);
            $i->refined_qty = null;
        }
        $i->consumption = $request->consumption;

        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function findBySlug($slug){
        $i = IssuancesOfSro::query()->where('slug','=',$slug)->first();
        if(empty($i)){
            abort('Data not found.');
        }
        return $i;
    }

    public function destroy($slug, WeeklyReportService $weeklyReportService){
        $i = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($i->weekly_report_slug);
        if($i->delete()){
            return 1;
        }
        abort(503,'Error deleting data.');
    }

}