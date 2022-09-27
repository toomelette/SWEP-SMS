<?php


namespace App\Http\Controllers\SMS\Form6a;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form6a\QuedanRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class QuedanRegistryController extends Controller
{
    public function index(){
        if(\request()->ajax()){
            $registry = QuedanRegistry::query();
            return DataTables::of($registry)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.form6a_quedanRegistry.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" uri="'.route("dashboard.form6a_quedanRegistry.edit",$data->slug).'" class="btn btn-sm view_form6aQuedanRegistry_btn btn-xs form5_edit_btn" data-toggle="modal" data-target="#form5_editModal" title="Edit" data-placement="top">
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
        $i = new QuedanRegistry();
        $i->weekly_report_slug = $request->weekly_report_slug;
        $i->slug = Str::random();
        $i->delivery_no = $request->delivery_no;
        $i->trader = $request->trader;
        $i->refined_quedan_sn = $request->refined_quedan_sn;
        $i->refined_sugar = $request->refined_sugar;

        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function edit($slug){
        return view('sms.weekly_report.sms_forms.form6a.quedan_registry_edit')->with([
            'registry' => $this->findBySlug($slug),
        ]);
    }
    public function update(Request $request,$slug){
        $i = $this->findBySlug($slug);
        $i->delivery_no = $request->delivery_no;
        $i->trader = $request->trader;
        $i->refined_quedan_sn = $request->refined_quedan_sn;
        $i->refined_sugar = $request->refined_sugar;
        if($i->save()){
            return $i->only('slug');
        }
        abort(503,'Error saving data.');
    }

    public function findBySlug($slug){
        $i = QuedanRegistry::query()->where('slug','=',$slug)->first();
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