<?php


namespace App\Http\Controllers\SMS\Form5;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form5\IssuanceFormRequest;
use App\Models\SMS\Form5\IssuancesOfSro;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class IssuanceOfSroController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $issuances = IssuancesOfSro::query()
                ->where('weekly_report_slug','=',$request->weekly_report_slug);
            return DataTables::of($issuances)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form5_issuanceOfSro.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form5_issuanceOfSro.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger btn-xs " data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                  
                                </div>';
                    return $button;
                })
                ->editColumn('qty',function($data){
                    return number_format($data->qty,3);
                })
                ->editColumn('sugar_class',function($data){
                    return $data->sugar_class. ' '. ($data->refining == 1 ? ' - Refining' : '');
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->with('totals',$this->getTotalIssuances($request->weekly_report_slug))
                ->toJson();
        }
    }
    private function getTotalIssuances($weeklyReport){
        $i = IssuancesOfSro::query()->where('weekly_report_slug','=',$weeklyReport)->sum('qty');
        return [
            'totalIssuances' => number_format($i,3),
        ];
    }
    public function store(IssuanceFormRequest $request,WeeklyReportService $weeklyReportService){
        $weeklyReportService->isNotSubmitted($request->weekly_report_slug);
        $i = new IssuancesOfSro;
        $i->slug = Str::random();
        $i->weekly_report_slug = $request->weekly_report_slug;
        $i->sro_no = $request->sro_no;
        $i->trader = $request->trader;
        $i->cea = $request->cea;
        $i->date_of_issue = $request->date_of_issue;
        $i->liens_or = $request->liens_or;
        $i->sugar_class = $request->sugar_class;
        $i->qty = Helper::sanitizeAutonum($request->qty);
        if($request->has('refining')){
            $i->refining = 1;
        }

        if($i->save()){
            return [
                'slug' => $i->slug,
            ];
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form5.issuance_edit')->with([
            'issuance' => $this->findBySlug($slug),
        ]);
    }
    public function update(IssuanceFormRequest $request,$slug, WeeklyReportService $weeklyReportService){
        $i = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($i->weekly_report_slug);
        $i->sro_no = $request->sro_no;
        $i->trader = $request->trader;
        $i->cea = $request->cea;
        $i->date_of_issue = $request->date_of_issue;
        $i->liens_or = $request->liens_or;
        $i->sugar_class = $request->sugar_class;
        $i->qty = Helper::sanitizeAutonum($request->qty);
        $i->refining = null;
        if($request->has('refining')){
            $i->refining = 1;
        }

        if($i->save()){
            return [
                'slug' => $i->slug,
            ];
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