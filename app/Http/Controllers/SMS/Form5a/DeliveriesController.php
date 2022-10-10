<?php


namespace App\Http\Controllers\SMS\Form5a;



use App\Http\Controllers\Controller;
use App\Models\SMS\Form5a\Deliveries;
use App\SMS\Services\WeeklyReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DeliveriesController extends Controller
{

    public function index(){
        if(\request()->ajax()){
            $deliveries = Deliveries::query()
                ->where('weekly_report_slug','=',\request('weekly_report_slug'));
            return DataTables::of($deliveries)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form5a_deliveries.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form5a_deliveries.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
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
        $d = new Deliveries;
        $d->weekly_report_slug = $request->weekly_report_slug;
        $d->slug = Str::random();
        $d->date_of_withdrawal = $request->date_of_withdrawal;
        $d->sro_no = $request->sro_no;
        $d->trader = $request->trader;
        $d->qty_standard = $request->qty_standard;
        $d->qty_premium = $request->qty_premium;
        $d->qty_total = $request->qty_standard + $request->qty_premium;
        $d->remarks = $request->remarks;
        $d->consumption = $request->consumption;
        if($d->save()){
            return $d->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form5a.delivery_edit')->with([
            'delivery' => $this->findBySlug($slug),
        ]);
    }

    public function update(Request $request, $slug, WeeklyReportService $weeklyReportService){
        $d = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($d->weekly_report_slug);
        $d->date_of_withdrawal = $request->date_of_withdrawal;
        $d->sro_no = $request->sro_no;
        $d->trader = $request->trader;
        $d->qty_standard = $request->qty_standard;
        $d->qty_premium = $request->qty_premium;
        $d->qty_total = $request->qty_standard + $request->qty_premium;
        $d->remarks = $request->remarks;
        $d->consumption = $request->consumption;
        if($d->save()){
            return $d->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function findBySlug($slug){
        $i = Deliveries::query()->where('slug','=',$slug)->first();
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