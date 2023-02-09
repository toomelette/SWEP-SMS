<?php


namespace App\Http\Controllers\SMS\Form3b;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form3b\ServedSros;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ServedSrosController extends Controller
{
    public function index(){
        if (\request()->ajax()){
            $s = ServedSros::query()
                ->where('weekly_report_slug','=',\request('weekly_report_slug'));
            return DataTables::of($s)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form3b_servedSros.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form3b_servedSros.edit",$data->slug).'" class="btn btn-sm view_form5Issuance_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
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
        $s = new ServedSros();
        $s->slug = Str::random();
        $s->weekly_report_slug = $request->weekly_report_slug;
        $s->mro_no = $request->mro_no;
        $s->trader = $request->trader;
        $s->pcs = $request->pcs;
        if($s->save()){
            return $s->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form3b.servedSro_edit')->with([
            'servedSro' => $this->findBySlug($slug),
        ]);
    }

    public function update(Request $request, $slug){
        $s = $this->findBySlug($slug);
        $s->mro_no = $request->mro_no;
        $s->trader = $request->trader;
        $s->pcs = $request->pcs;
        if($s->save()){
            return $s->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function destroy($slug){
        if($this->findBySlug($slug)->delete()){
            return 1;
        }
        abort(503, 'Error deleting data.');
    }

    public function findBySlug($slug){
        $s = ServedSros::query()->where('slug','=',$slug)->first();
        return $s ?? abort(503,'Data not found');
    }
}