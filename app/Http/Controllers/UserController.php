<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserEditFormRequest;
use App\Models\Menu;
use App\Models\User;
use App\Models\UserSubmenu;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use App\Swep\Services\UserService;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Requests\User\UserFilterRequest;
use App\Http\Requests\User\UserResetPasswordRequest;
use App\Http\Requests\User\UserSyncEmployeeRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;
use function foo\func;


class UserController extends Controller{



    protected $user_service;



    public function __construct(UserService $user_service){
        $this->user_service = $user_service;
    }




    public function index(UserFilterRequest $request){
        $menus = Menu::with('submenu')->get();
        $users = User::with('userSubmenu');
        if(request()->ajax()){

            if($request->has('is_online') || $request->has('is_active')){
                if($request->is_online == 'online'){
                    $users = $users->where('is_online',true);
                }elseif ($request->is_online == "offline"){
                    $users = $users->where('is_online',false);
                }

                if($request->is_active == "active"){
                    $users = $users->where('is_active',true);
                }elseif ($request->is_active == "inactive"){
                    $users = $users->where('is_active',false);
                }
            }

            $users->get();
            $dt = DataTables::of($users)
                ->addColumn('action', function($data){
                    if($data->is_active == 0){
                        $a = "Activate";
                        $stat = "inactive";
                    }else{
                        $a = "Deactivate";
                        $stat = "active";
                    }
                    $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm view_user_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_user_modal" title="View more" data-placement="left">
                                    <i class="fa fa-file-text"></i>
                                </button>
                               
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_user_btn" data-toggle="modal" data-target="#edit_user_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_user_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                  <span class="caret"></span></button>
                                  <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a user="'.ucwords(strtolower($data->firstname)).'" href="#" data="'.$data->slug.'" name="'.strtoupper($data->firstname).' '.strtoupper($data->lastname).'" class="ac_dc" status="'.$stat.'" >'.$a.'</a>
                                    </li>
                                    <li><a href="#" class="reset_password_btn" data="'.$data->slug.'" data-toggle="modal" data-target="#reset_password_modal" >Change Username/Password</a></li>
                                  </ul>
                                </div>
                                </div>';
                    return $button;
                })
                ->addColumn('fullname', function ($data){
                    return $data->lastname.', '.$data->firstname;
                })
                ->editColumn('is_online', function($data){
                    return Helper::online_badge($data->last_activity);
                })
                ->addColumn('account_status', function($data){
                    if($data->is_activated == 1){
                        return '<span class="label bg-green col-md-12">ACTIVE</span>';
                    }else if($data->is_activated == 0){
                        return '<span class="label bg-red col-md-12">INACTIVE</span>';
                    }
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);

            return $dt;
        }
        return view('dashboard.user.index')->with('menus', $menus);


    }




    public function create(){

        return view('dashboard.user.create');

    }




    public function store(UserFormRequest $request){

        return $this->user_service->store($request);

    }




    public function show($slug){
        $user = User::where('slug',$slug)->first();

        $user_submenus = UserSubmenu::with('submenu')->where('user_id', $user->user_id)->get();
        $tree = [];
        $menus_with_count_submenus = [];
        foreach ($user_submenus as $user_submenu){
            $tree[$user_submenu->submenu->menu->menu_id]['menu_obj'] = $user_submenu->submenu->menu;
            $tree[$user_submenu->submenu->menu->menu_id]['submenus'][$user_submenu->submenu_id] = $user_submenu->submenu;
        }
        $menus = Menu::withCount('submenu')->get();
        foreach ($menus as $menu){
            $menus_with_count_submenus[$menu->menu_id] = $menu->submenu_count;
        }




        return view('dashboard.user.show')->with([
            'user'=>$user,
            'tree'=>$tree,
            'menus_with_count_submenus' => $menus_with_count_submenus,
        ]);

    }




    public function edit($slug){
        $all_menus = Menu::get();
        $user = User::where('slug',$slug)->first();
        $user_submenus_arr = [];
        foreach ($user->userSubmenu as $submenu){
            $user_submenus_arr[$submenu->submenu_id] = 1;
        }

        return view('dashboard.user.edit')->with([
            'all_menus' => $all_menus,
            'user' => $user,
            'user_submenus_arr' => $user_submenus_arr,
        ]);
        return $this->user_service->edit($slug);

    }




    public function update(UserEditFormRequest $request, $slug){


        return $this->user_service->update($request, $slug);

    }




    public function destroy($slug){

        return $this->user_service->delete($slug);

    }




    public function activate($slug){

        $user = User::where('slug',$slug)->first();
        $user->is_active = 1;
        if($user->update()){
            return $user->only('slug');
        }else{
            abort(500,'Error Activating!');
        }

    }




    public function deactivate($slug){

        $user = User::where('slug',$slug)->first();
        $user->is_active = 0;
        if($user->update()){
            return $user->only('slug');
        }else{
            abort(500,'Error deactivating!');
        }

    }




    public function resetPassword($slug){

        return $this->user_service->resetPassword($slug);

    }




    public function resetPasswordPost(UserResetPasswordRequest $request, $slug){

        return $this->user_service->resetPasswordPost($request, $slug);

    }




    public function syncEmployee($slug){

        return $this->user_service->syncEmployee($slug);

    }




    public function syncEmployeePost(UserSyncEmployeeRequest $request, $slug){

        return $this->user_service->syncEmployeePost($request, $slug);

    }




    public function unsyncEmployee($slug){

        return $this->user_service->unsyncEmployee($slug);

    }




}
