<?php


namespace App\Http\Controllers;


use App\Models\PapParent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PapParentController extends Controller
{
    public function index(){
        if(request()->ajax()){
            $pap_parents = PapParent::get();
            return DataTables::of($pap_parents)
                ->addColumn('action',function ($data){
                    $destroy_route = "'".route("dashboard.pap_parent.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    return '<div class="btn-group">
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_pap_parent_btn" data-toggle="modal" data-target="#edit_pap_parent_modal" title="" data-placement="top" data-original-title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" onclick="delete_data('.$slug.','.$destroy_route.')" data="'.$data->slug.'" class="btn btn-sm btn-danger" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                })
                ->setRowId('slug')
                ->escapeColumns([])
                ->toJson();
        }
        return view('dashboard.pap_parent.index');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:pap_parents|string|max:255',
        ]);

        $pap_parent = new PapParent;
        $pap_parent->slug = Str::random(15);
        $pap_parent->name = $request->name;
        $pap_parent->save();

        return $pap_parent->only('slug');
    }

    public function edit($slug){
        $pap_parent = PapParent::query()->where('slug','=',$slug)->first();
        return view('dashboard.pap_parent.edit')->with([
            'pap_parent' => $pap_parent,
        ]);
    }

    public function update(Request $request,$slug){
        $request->validate([
            'name' => 'required|unique:pap_parents|string|max:255',
        ]);

        $pap_parent = PapParent::query()->where('slug','=',$slug)->first();
        if($pap_parent->count() > 0){
            $pap_parent->name = $request->name;
            $pap_parent->update();
            return $pap_parent->only('slug');
        }
    }

    public function destroy($slug){
        $pap_parent = PapParent::query()->where('slug','=',$slug)->first();
        if($pap_parent->count() > 0){
            $pap_parent->delete();
        }
        return 1;
    }
}