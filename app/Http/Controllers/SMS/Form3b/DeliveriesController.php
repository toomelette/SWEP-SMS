<?php


namespace App\Http\Controllers\SMS\Form3b;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form3b\Deliveries;
use App\Swep\Helpers\Helper;
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
                    $destroy_route = "'".route("dashboard.form3b_deliveries.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form3b_deliveries.edit",$data->slug).'" class="btn btn-sm view_form3bIssuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger btn-xs " data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                  
                                </div>';
                    return $button;
                })
                ->editColumn('qty',function($data){
                    return $data->qty ?? $data->qty_prev;
                })

                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
    }

    public function store(Request $request){
        $d = new Deliveries();
        $d->slug = Str::random();
        $d->weekly_report_slug = $request->weekly_report_slug;
        $d->mro_no = $request->mro_no;
        $d->trader = $request->trader;
        $d->date_of_withdrawal = $request->date_of_withdrawal;
        $d->qty = Helper::sanitizeAutonum($request->qty);
        $d->remarks = $request->remarks;
        if($d->save()){
            return $d->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form3b.delivery_edit')->with([
            'delivery' => $this->findBySlug($slug),
        ]);
    }

    public function findBySlug($slug){
        $d = Deliveries::query()->where('slug','=',$slug)->first();
        return $d ?? abort(503,'Delivery not found.');
    }

    public function update(Request $request, $slug){
        $d = $this->findBySlug($slug);
        $d->mro_no = $request->mro_no;
        $d->trader = $request->trader;
        $d->date_of_withdrawal = $request->date_of_withdrawal;
        $d->qty = Helper::sanitizeAutonum($request->qty);
        $d->remarks = $request->remarks;
        if($d->save()){
            return $d->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function destroy($slug){
        if($this->findBySlug($slug)->delete()){
            return 1;
        }
        abort(503, 'Error deleting data.');
    }
}