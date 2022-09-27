<?php


namespace App\Http\Controllers\SMS\Form5a;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form5a\ServedSros;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ServedSrosController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $s = ServedSros::query();
            return DataTables::of($s)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form5a_servedSros.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form5a_servedSros.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
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

    public function store(Request $request){
        $s = new ServedSros;
        $s->weekly_report_slug = $request->weekly_report_slug;
        $s->slug = Str::random();
        $s->sro_no = $request->sro_no;
        $s->trader = $request->trader;
        $s->quedan_pcs = $request->quedan_pcs;

        if($s->save()){
            return $s->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form5a.servedSro_edit')->with([
            'servedSro' => $this->findBySlug($slug),
        ]);
    }

    public function update(Request $request,$slug){
        $s = $this->findBySlug($slug);
        $s->sro_no = $request->sro_no;
        $s->trader = $request->trader;
        $s->quedan_pcs = $request->quedan_pcs;

        if($s->save()){
            return $s->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function findBySlug($slug){
        $i = ServedSros::query()->where('slug','=',$slug)->first();
        if(empty($i)){
            abort('Data not found.');
        }
        return $i;
    }
    public function destroy($slug){
        $i = $this->findBySlug($slug);
        if($i->delete()){
            return 1;
        }
        abort(503,'Error deleting data.');
    }
}