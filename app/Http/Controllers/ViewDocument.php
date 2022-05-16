<?php


namespace App\Http\Controllers;


use __static;
use App\Models\EmployeeFile201;
use App\Models\NewsAttachments;
use App\Swep\Repositories\UserSubmenuRepository;
use File;
use Route;

class ViewDocument extends Controller
{
    protected $userSubmenuRepo;
    public function __construct(UserSubmenuRepository $user_submenu_repo)
    {
        $this->userSubmenuRepo = $user_submenu_repo;
    }

    public function index($id,$type){
        if($id == null || $type == null){
            abort(505,'Missing Parameters');
        }
        if($type == 'view_201File'){
            if(!$this->userSubmenuRepo->isExist('dashboard.file201.index')){
                abort(405);
            }
            $attachment = EmployeeFile201::query()->where('slug','=',$id)->first();
            $n = new File201Controller;
            $path = $n->path.$attachment->employee_no.'/';
            $filename = $attachment->filename;
            if(\request()->has('download')){
                return $dl = Storage::disk('local')->download($path.$filename);
            }
            $path = __static::archive_dir().$path.$filename;
            if (!File::exists($path)) { abort(404); }
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }
        abort(504,'Invalid type: <b>'.$type.'</b>');
    }
}