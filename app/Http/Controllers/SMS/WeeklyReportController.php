<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Http\Controllers\SMS\WeeklyReport\RawSugarController;
use App\Http\Requests\SMS\WeeklyReportFormRequest;
use App\Models\SMS\InputFields;
use App\Models\SMS\ReportTypes;
use App\Models\SMS\WeeklyReports;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class WeeklyReportController extends Controller
{
    public function index(){
        if(\request()->ajax()){
            $reports = WeeklyReports::query()
                ->with('cropYear')
                ->where('mill_code','=',Auth::user()->mill_code);
            return \DataTables::of($reports)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.weekly_report.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm view_employee_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_employee_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                   
                                    <a  href="'. route('dashboard.weekly_report.edit', $data->slug).'" for="linkToEdit" type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_jo_employee_btn"  title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                  
                                </div>';
                    return $button;
                })
                ->addColumn('status',function($data){
                    return 'Draft';
                })
                ->editColumn('week_ending',function($data){
                    return Carbon::parse($data->week_ending)->format('F d, Y');
                })
                ->editColumn('crop_year',function($data){
                    return $data->cropYear->name;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->toJson();
        }
        return view('sms.weekly_report.index');
    }

    public function create(Request $request, RawSugarController $rawSugarController){

        return view('sms.weekly_report.create');
    }



    public function store(WeeklyReportFormRequest $request){
        $weekly_report = new WeeklyReports;
        $weekly_report->slug = Str::random();
        $weekly_report->mill_code = Auth::user()->mill_code;
        $weekly_report->crop_year = $request->crop_year;
        $weekly_report->dist_no = $request->dist_no;
        $weekly_report->week_ending = $request->week_ending;
        $weekly_report->report_no = $request->report_no;
        if($weekly_report->save()){
            return $weekly_report->only('slug');
        }
        abort(503,'Error creating week.');
    }

    public function edit($slug){
        $weekly_report = $this->findBySlug($slug);
        $details_arr = [];
        if(!empty($weekly_report->details)){
            foreach ($weekly_report->details as $detail){
                if($detail->grouping == null){
                    $details_arr[$detail->form_type][$detail->input_field] = $detail;
                }else{
                    $details_arr[$detail->form_type][$detail->grouping][$detail->input_field] = $detail;
                }
            }
        }

        if(!empty($weekly_report->seriesNos)){
            foreach ($weekly_report->seriesNos as $seriesNo){
                $details_arr[$seriesNo->form_type]['seriesNos'][$seriesNo->input_field] = $seriesNo;
            }
        }

//        return $details_arr;
        return view('sms.weekly_report.edit')->with([
            'wr' => $weekly_report,
            'details_arr' => $details_arr,
        ]);
    }

    public function findBySlug($slug){
        $wr = WeeklyReports::query()->with(['details','seriesNos'])->where('slug','=',$slug)->first();
        if(!empty($wr)){
            return $wr;
        }
        abort(510,'Weekly Report not found.');
    }

    public function print($slug){
        $weekly_report = $this->findBySlug($slug);
        $details_arr = [];
        $input_fields_arr = [];

        $ifs = InputFields::query()->get();
        if(!empty($ifs)){
            foreach ($ifs as $if){
                $input_fields_arr[$if->field] = [
                    'display_name' => $if->display_name,
                    'prefix' => $if->prefix,
                ];
            }
        }

        if(!empty($weekly_report->details)){
            foreach ($weekly_report->details as $detail){
                if($detail->grouping == null){
                    $details_arr[$detail->form_type][$detail->input_field] = $detail;
                }else{
                    $details_arr[$detail->form_type][$detail->grouping][$detail->input_field] = $detail;
                }
            }
        }

        if(!empty($weekly_report->seriesNos)){
            foreach ($weekly_report->seriesNos as $seriesNo){
                $details_arr[$seriesNo->form_type]['seriesNos'][$seriesNo->input_field] = $seriesNo;
            }
        }
        return view('sms.printables.formAll')->with([
            'wr' => $weekly_report,
            'details_arr' => $details_arr,
            'input_fields_arr' => $input_fields_arr,
        ]);
    }
}