<?php


namespace App\Http\Controllers\SMS\Form3b;



use App\Models\SMS\Form3b\IssuancesOfMro;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class IssuanceOfMroController
{
    public function index(){
        if(\request()->ajax()){
            $issuances = IssuancesOfMro::query()
                ->where('weekly_report_slug','=',\request('weekly_report_slug'));
            return DataTables::of($issuances)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form3b_issuanceOfSro.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form3b_issuanceOfSro.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger btn-xs " data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                  
                                </div>';
                    return $button;
                })->editColumn('qty',function($data){
                    return number_format($data->qty,3);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
    }

    public function store(Request $request){
        $i = new IssuancesOfMro();
        $i->slug = Str::random();
        $i->weekly_report_slug = $request->weekly_report_slug;
        $i->mro_no = $request->mro_no;
        $i->trader = $request->trader;
        $i->date_of_issue = $request->date_of_issue;
        $i->liens_or = $request->liens_or;
        $i->qty = Helper::sanitizeAutonum($request->qty);
        $i->type = $request->type;
        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form3b.issuance_edit')->with([
            'issuance' => $this->findBySlug($slug),
        ]);
    }

    public function update(Request $request,$slug){
        $i = $this->findBySlug($slug);
        $i->mro_no = $request->mro_no;
        $i->trader = $request->trader;
        $i->date_of_issue = $request->date_of_issue;
        $i->liens_or = $request->liens_or;
        $i->qty = Helper::sanitizeAutonum($request->qty);
        $i->type = $request->type;
        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function findBySlug($slug){
        $i = IssuancesOfMro::query()->where('slug','=',$slug)->first();
        return $i ?? abort(503,'Data not found.');
    }

    public function destroy($slug){
        if($this->findBySlug($slug)->delete()){
            return 1;
        }
        abort(503,'Error deleting item.');
    }
}