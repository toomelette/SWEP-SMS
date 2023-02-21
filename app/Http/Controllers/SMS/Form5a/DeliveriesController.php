<?php


namespace App\Http\Controllers\SMS\Form5a;



use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form5a\DeliveryFormRequest;
use App\Models\SMS\Form5a\Deliveries;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class DeliveriesController extends Controller
{

    public function index(Request $request){
        if($request->ajax()){
            $deliveries = Deliveries::query()
                ->where('weekly_report_slug','=',$request->weekly_report_slug);
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
                ->editColumn('qty_standard',function($data){
                    if($data->qty_standard != null){
                        return number_format($data->qty_standard,3);
                    }
                })
                ->editColumn('qty_premium',function($data){
                    if($data->qty_premium != null){
                        return number_format($data->qty_premium,3);
                    }
                })
                ->editColumn('qty_total',function($data){
                    return number_format($data->qty_total,3);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->with('totals',$this->getTotalDeliveries($request->weekly_report_slug))
                ->toJson();
        }
    }

    private function getTotalDeliveries($weeklyReport){
        $i = Deliveries::query()->selectRaw('sum(qty_standard) as qty_standard, sum(qty_premium) as qty_premium , sum(qty_total) as qty_total')->where('weekly_report_slug','=',$weeklyReport)->first();

        return [
            'totalDeliveries' => [
                'qty_standard' => number_format($i->qty_standard,3),
                'qty_premium' => number_format($i->qty_premium,3),
                'total' => number_format($i->qty_total,3),
            ],
        ];
    }
    public function store(DeliveryFormRequest $request, WeeklyReportService $weeklyReportService){

        $weeklyReportService->isNotSubmitted($request->weekly_report_slug);
        $d = new Deliveries;
        $d->weekly_report_slug = $request->weekly_report_slug;
        $d->slug = Str::random();
        $d->date_of_withdrawal = $request->date_of_withdrawal;
        $d->sro_no = $request->sro_no;
        $d->trader = $request->trader;
        $d->qty_standard = Helper::sanitizeAutonum($request->qty_standard);
        $d->qty_premium = Helper::sanitizeAutonum($request->qty_premium);
        $d->qty_total = $d->qty_standard + $d->qty_premium;
        if($request->chargeTo == 'CURRENT'){
            $d->qty_current = $d->qty_total;
            $d->qty_prev = null;
        }else{
            $d->qty_current = null;
            $d->qty_prev = $d->qty_total;
        }

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

    public function update(DeliveryFormRequest $request, $slug, WeeklyReportService $weeklyReportService){
        $d = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($d->weekly_report_slug);
        $d->date_of_withdrawal = $request->date_of_withdrawal;
        $d->sro_no = $request->sro_no;
        $d->trader = $request->trader;
        $d->qty_standard =  Helper::sanitizeAutonum($request->qty_standard);
        $d->qty_premium = Helper::sanitizeAutonum($request->qty_premium);
        $d->qty_total = $d->qty_standard + $d->qty_premium;
        $d->remarks = $request->remarks;
        $d->consumption = $request->consumption;
        if($request->chargeTo == 'CURRENT'){
            $d->qty_current = $d->qty_total;
            $d->qty_prev = null;
        }else{
            $d->qty_current = null;
            $d->qty_prev = $d->qty_total;
        }
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