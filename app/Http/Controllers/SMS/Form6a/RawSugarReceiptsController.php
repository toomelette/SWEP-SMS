<?php


namespace App\Http\Controllers\SMS\Form6a;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form6a\RawSugarReceipts;
use App\SMS\Services\WeeklyReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class RawSugarReceiptsController extends Controller
{
    public function index(){
        if(\request()->ajax()){
            $receipts = RawSugarReceipts::query()
                ->where('weekly_report_slug','=',\request('weekly_report_slug'));
            return DataTables::of($receipts)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form6a_rawSugarReceipts.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form6a_rawSugarReceipts.edit",$data->slug).'" class="btn btn-sm view_form6aReceipts_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
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
        $i = new RawSugarReceipts();
        $i->weekly_report_slug = $request->weekly_report_slug;
        $i->slug = Str::random();
        $i->delivery_no = $request->delivery_no;
        $i->trader = $request->trader;
        $i->mill_source = $request->mill_source;
        $i->raw_sro_sn = $request->raw_sro_sn;
        $i->liens_or = $request->liens_or;
        $i->qty = $request->qty;
        $i->refined_sugar_equivalent = $request->refined_sugar_equivalent;

        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form6a.raw_sugar_receipts_edit')->with([
            'receipts' => $this->findBySlug($slug),
        ]);
    }
    public function update(Request $request,$slug, WeeklyReportService $weeklyReportService){
        $i = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($i->weekly_report_slug);
        $i->delivery_no = $request->delivery_no;
        $i->trader = $request->trader;
        $i->mill_source = $request->mill_source;
        $i->raw_sro_sn = $request->raw_sro_sn;
        $i->liens_or = $request->liens_or;
        $i->qty = $request->qty;
        $i->refined_sugar_equivalent = $request->refined_sugar_equivalent;
        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function findBySlug($slug){
        $i = RawSugarReceipts::query()->where('slug','=',$slug)->first();
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