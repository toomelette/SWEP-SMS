<?php


namespace App\Http\Controllers\SMS\Form3;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form3\Withdrawals;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class WithdrawalsController extends Controller
{
    public function index(Request $request){
        $w = Withdrawals::query()->where('weekly_report_slug','=',$request->weekly_report_slug);

        return DataTables::of($w)
            ->addColumn('action',function($data){
                $destroy_route = "'".route("dashboard.form3_withdrawals.destroy","slug")."'";
                $slug = "'".$data->slug."'";
                $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form3_withdrawals.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
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

    public function store(Request $request){
        $w = new Withdrawals;
        $w->weekly_report_slug = $request->weekly_report_slug;
        $w->slug = Str::random();
        $w->date = $request->date;
        $w->mro_no = $request->mro_no;
        $w->trader = $request->trader;
        $w->withdrawal_type = $request->withdrawal_type;
        $w->qty = Helper::sanitizeAutonum($request->qty);
        $w->sugar_type = $request->type;
        $w->qty_prev = null;
        $w->qty_current = null;
        if($request->cropCharge == 'CURRENT'){
            $w->qty_current = Helper::sanitizeAutonum($request->qty);
        }else{
            $w->qty_prev = Helper::sanitizeAutonum($request->qty);
        }
        if($w->save()){
            return $w->only('slug');
        }
        abort(503, 'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form3.withdrawal_edit')->with([
            'withdrawal' => $this->findBySlug($slug),
        ]);
    }

    public function update(Request $request,$slug){
        $w = $this->findBySlug($slug);
        $w->date = $request->date;
        $w->mro_no = $request->mro_no;
        $w->trader = $request->trader;
        $w->withdrawal_type = $request->withdrawal_type;
        $w->qty = Helper::sanitizeAutonum($request->qty);
        $w->sugar_type = $request->type;
        $w->qty_prev = null;
        $w->qty_current = null;
        if($request->cropCharge == 'CURRENT'){
            $w->qty_current = Helper::sanitizeAutonum($request->qty);
        }else{
            $w->qty_prev = Helper::sanitizeAutonum($request->qty);
        }
        if($w->save()){
            return $w->only('slug');
        }
        abort(503, 'Error saving data.');
    }

    public function findBySlug($slug){
        $i = Withdrawals::query()->where('slug','=',$slug)->first();
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