<?php


namespace App\Http\Controllers;


use App\Http\Requests\MisRequests\MisRequestsFormRequest;
use App\Models\MisRequests;
use App\Models\MisRequestsNature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MisRequestsController extends Controller
{
    public function myRequests(){
        if(\request()->ajax() && \request()->has('draw')){
            $mis_requests = MisRequests::query()->where('user_created','=',Auth::user()->user_id);
            return DataTables::of($mis_requests)
                ->addColumn('action',function ($data){
                    if($data->cancelled_at != null){
                        return '<p class="text-muted no-margin">Cancelled</p>';
                    }
                    return '<div class="btn-group">
                            <button class="btn btn-default btn-sm print_request_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>"><i class="fa fa-print"></i></button>
                            <button class="btn btn-danger btn-sm cancel_request_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>">Cancel</button>
                        </div>';
                })
                ->addColumn('status', function ($data){
                    return '';
                })
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('M. d, Y | h:i A');
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('dashboard.mis_requests.my_requests');
    }

    public  function store(MisRequestsFormRequest $request){
        $r = new MisRequests;
        $r->slug = Str::random(16);
        $r->request_no = $this->createNewRequstNo();;
        $r->nature_of_request = MisRequestsNature::query()->where('slug','=',$request->nature_of_request)->first()->nature_of_request;
        $r->requisitioner = Auth::user()->user_id;
        $r->request_details = $request->details;
        if($r->save()){
            return $r->only(['slug','request_no']);
        }
        abort(503,'Error creating request.');
    }


    private function createNewRequstNo(){

        $r = MisRequests::query()->orderBy('id','desc')->first();
        if(empty($r)){
            $new_no = Carbon::now()->format('Y').'-0001';
        }else{
            if(explode('-',$r->request_no)[0] == Carbon::now()->format('Y')){
                $new_no =  Carbon::now()->format('Y').'-'.str_pad(explode('-',$r->request_no)[1]+1,4,'0',STR_PAD_LEFT);
            }else{
                $new_no = Carbon::now()->format('Y').'-0001';
            }
        }
        return $new_no;
    }

    private  function findBySlug($slug){
        $r = MisRequests::query()->where('slug','=',$slug)->first();
        if(empty($r)){
            abort(503,'Service request not found.');
        }
        return $r;
    }

    public function cancelRequest(Request $request){
        $r = $this->findBySlug($request->id);
        $r->cancelled_at = Carbon::now();
        if($r->update()){
            return 'Request has been cancelled successfully.';
        }
        abort(503,'Service request not found.');
    }

    public function printRequestForm($slug){
        $r = $this->findBySlug($slug);
        return view('printables.mis_requests.print')->with([
            'r' => $r,
        ]);
    }

    public function index(){
        if(\request()->ajax() && \request()->has('draw')){
            $mis_requests = MisRequests::query();

            $table = DB::select('SELECT * FROM (
                        SELECT x.lastname, x.firstname, x.employee_no, users.user_id FROM (
                            SELECT hr_employees.lastname, hr_employees.firstname, hr_employees.employee_no FROM hr_employees WHERE hr_employees.employee_no != \'\'
                            UNION
                            SELECT hr_jo_employees.lastname, hr_jo_employees.firstname, hr_jo_employees.employee_no FROM hr_jo_employees
                        ) as x
                        LEFT JOIN users ON users.employee_no = x.employee_no
                        WHERE user_id != ""
                    ) as y
                    RIGHT JOIN mis_requests ON mis_requests.user_created = y.user_id;');

            return DataTables::of($table)
                ->addColumn('action',function ($data){

                    return '<div class="btn-group">
                            <button class="btn btn-default btn-sm print_request_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>"><i class="fa fa-print"></i></button>
                            <button class="btn btn-default btn-sm status_btn" data="'.$data->slug.'" text="Request no: <b>'.$data->request_no.'</b>" data-target="#status_modal" data-toggle="modal" title="Status" data-placement="top" ><i class="fa fa-refresh"></i></button>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                  <li><a href="#" class="recommendation_btn" data="'.$data->slug.'">Recommendation</a></li>
                                  <li><a href="#" data-toggle="modal" data-target="#trainings_modal" class="trainings_btn" data="'.$data->slug.'">Summary of Diagnosis</a></li>
                                </ul>
                            </div>
                        </div>';
                })
                ->addColumn('status', function ($data){
                    return 1;
                })
                ->editColumn('created_at',function ($data){
                    return Carbon::parse($data->created_at)->format('M. d, Y | h:i A');
                })
                ->editColumn('fullname',function ($data){
                    return $data->lastname.', '.$data->firstname;
                })
                ->editColumn('nature_of_request',function ($data){
                    if($data->request_details != ''){
                        return '<div>'.$data->nature_of_request.'
                                <div class="table-subdetail">
                                    '.$data->request_details.'
                                </div>
                            </div>';
                    }
                    return $data->nature_of_request;
                })

                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('dashboard.mis_requests.index');
    }

    public function update(Request $request,$request_slug){
        if($request->recommend == true){
            if($request_slug == ''){
                abort(503,'Missing parameters');
            }
            if($request->recommendation == ''){
                abort(503,'This field is required');
            }
            $r = $this->findBySlug($request_slug);
            $r->recommendations = $request->recommendation;
            if($r->update()){
                return $r->only('slug');
            }
            abort(503,'Error updating recommendation');
        }


    }

}