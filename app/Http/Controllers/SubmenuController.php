<?php


namespace App\Http\Controllers;
use App\Http\Requests\Submenu\SubmenuFormRequest;
use App\Http\Requests\Submenu\SubmenuFormRequestEdit;
use App\Models\Menu;
use App\Models\Submenu;
use App\Swep\Helpers\__dataType;
use App\Swep\Helpers\__static;
use App\Swep\ViewHelpers\__html;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\EloquentDataTable;

class SubmenuController extends Controller
{
    public function index(Request $request){
        $menu = Menu::where('slug',$request->menu_slug)->first();


        return view('dashboard.submenu.index')->with([
            'menu' => $menu
        ]);


    }

    public function store(SubmenuFormRequest $request){

        $submenu = new Submenu;
        $submenu->slug = Str::random(15);
        $submenu->submenu_id = strtoupper(Str::random(7));
        $submenu->name = $request->name;
        $submenu->route = $request->route;
        $submenu->nav_name = $request->nav_name;
        $submenu->is_nav = $request->is_nav;
        $submenu->menu_id = $request->menu_id;
        $submenu->save();

        return $submenu->only('slug');
    }

    public function edit($slug){
        $submenu = Submenu::where('slug',$slug)->first();

        return view('dashboard.submenu.edit')->with([
            'submenu' => $submenu
        ]);
    }

    public function update($slug, SubmenuFormRequestEdit $request){
        $submenu = Submenu::where('slug',$slug)->first();
        $submenu->name = $request->name;
        $submenu->nav_name = $request->nav_name;
        $submenu->route = $request->route;
        $submenu->is_nav = $request->is_nav;
        $submenu->update();
        return $submenu->only('slug');
    }

    public function fetch(Request $request){

        if(request()->has('draw')){
            $submenus = Submenu::where('menu_id',$request->menu_id)->get();


            $dt = DataTables::of($submenus)
                ->addColumn('action',function ($data){
                    $slug = "'".$data->slug."'";
                    $destroy_route = "'".route("dashboard.submenu.destroy","slug")."'";
                    return '<div class="btn-group">
                                <button type="button" onclick="edit_submenu_modal('.$slug.')" data="'.$data->slug.'" class="btn btn-default btn-xs edit_submenu_btn" data-toggle="modal" data-target="#edit_submenu_modal" title="" data-placement="top" data-original-title="Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" onclick="delete_data('.$slug.','.$destroy_route.')" data="'.$data->slug.'" class="btn btn-xs btn-danger delete_submenu_btn" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                })
                ->editColumn('is_nav', function ($data){
                    return __html::boolToCheck($data->is_nav);
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();

            return $dt;
        }
    }

    public function destroy($slug){
        $submenu = Submenu::where('slug',$slug)->first();
        if($submenu->delete()){
            return 1;
        }

    }
}