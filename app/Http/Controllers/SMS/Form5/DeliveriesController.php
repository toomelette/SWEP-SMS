<?php


namespace App\Http\Controllers\SMS\Form5;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form5\DeliveryFormRequest;
use App\Models\SMS\Form5\Deliveries;
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
                    $destroy_route = "'".route("dashboard.form5_deliveries.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form5_deliveries.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger btn-xs " data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                  
                                </div>';
                    return $button;
                })
                ->editColumn('qty',function($data){
                    return number_format($data->qty ?? $data->qty_prev,3);
                })
                ->editColumn('sugar_class',function($data){
                    if($data->refining == 1){
                        return $data->sugar_class .' - For Refining';
                    }
                    return $data->sugar_class;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->with('totals',$this->getTotalDeliveries($request->weekly_report_slug))
                ->toJson();
        }
    }

    private function getTotalDeliveries($weeklyReport){
        $i = Deliveries::query()->selectRaw('sum(qty) as qty, sum(qty_prev) as qty_prev')->where('weekly_report_slug','=',$weeklyReport)->first();

        return [
            'totalDeliveries' => [
                'current' => number_format($i->qty,3),
                'prev' => number_format($i->qty_prev,3),
                'total' => number_format($i->qty + $i->qty_prev,3),
            ],
        ];
    }
    public function store(DeliveryFormRequest $request, WeeklyReportService $weeklyReportService){
        $weeklyReportService->isNotSubmitted($request->weekly_report_slug);
        $d = new Deliveries;
        $d->weekly_report_slug =  $request->weekly_report_slug;
        $d->slug = Str::random();
        $d->sro_no = $request->sro_no;
        $d->trader = $request->trader;
        $d->start_of_withdrawal = $request->start_of_withdrawal;
        $d->sugar_class = $request->sugar_class;
        $d->remarks = $request->remarks;
        if($request->cropCharge == 'PREVIOUS'){
            $d->qty_prev = Helper::sanitizeAutonum($request->qty);
            $d->qty = null;
        }else{
            $d->qty = Helper::sanitizeAutonum($request->qty);
            $d->qty_prev = null;
        }

        if($request->has('refining')){
            $d->refining = 1;
        }
        if($d->save()){
            return $d->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form5.delivery_edit')->with([
            'delivery' => $this->findBySlug($slug),
        ]);
    }

    public function update(DeliveryFormRequest $request,$slug, WeeklyReportService $weeklyReportService){
        $d = $this->findBySlug($slug);
        $weeklyReportService->isNotSubmitted($d->weekly_report_slug);
        $d->sro_no = $request->sro_no;
        $d->trader = $request->trader;
        $d->start_of_withdrawal = $request->start_of_withdrawal;
        $d->sugar_class = $request->sugar_class;
        $d->for_swapping = $request->for_swapping;
        $d->qty = $request->qty;
        $d->remarks = $request->remarks;
        if($request->cropCharge == 'PREVIOUS'){
            $d->qty_prev = Helper::sanitizeAutonum($request->qty);
            $d->qty = null;
        }else{
            $d->qty = Helper::sanitizeAutonum($request->qty);
            $d->qty_prev = null;
        }

        $d->refining = null;
        if($request->has('refining')){
            $d->refining = 1;
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