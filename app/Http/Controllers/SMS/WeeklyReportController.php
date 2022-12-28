<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Http\Controllers\SMS\WeeklyReport\RawSugarController;
use App\Http\Requests\SMS\WeeklyReportFormRequest;
use App\Models\SMS\Form1\Form1Details;
use App\Models\SMS\Form2\Form2Details;
use App\Models\SMS\Form3\Form3Details;
use App\Models\SMS\InputFields;
use App\Models\SMS\CropYears;
use App\Models\SMS\Form6a\QuedanRegistry;
use App\Models\SMS\Form6a\RawSugarReceipts;
use App\Models\SMS\WeeklyReports;
use App\SMS\Services\SignatoryService;
use App\SMS\Services\WeeklyReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class WeeklyReportController extends Controller
{
    protected  $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function index(){
        if(\request()->ajax()){
            $reports = WeeklyReports::query()
                ->with('cropYear')
                ->where('mill_code','=',Auth::user()->mill_code);
            return \DataTables::of($reports)
                ->addColumn('action',function($data){
                    $destroy_route = "'".route("dashboard.weekly_report.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $editHref = route('dashboard.weekly_report.edit', $data->slug);
                    return view('sms.weekly_report.action_buttons.weekly_report_index.action')->with([
                        'data' => $data,
                        'editHref' => $editHref,
                        'destroyRoute' => $destroy_route,
                    ]);
                })
                ->addColumn('status',function($data){
                    if($data->status == 1){
                        return '<span class="label label-success"><i class="fa fa-check"></i> SUBMITTED</span>';
                    }
                    if($data->status == -1){
                        return '<span class="label label-danger"><i class="fa fa-times"></i> CANCELED</span>';
                    }
                    return '<span class="label label-default"><i class="fa fa-pencil"></i> DRAFT</span>';
                })
                ->editColumn('week_ending',function($data){
                    return Carbon::parse($data->week_ending)->format('F d, Y');
                })
                ->editColumn('crop_year',function($data){
                    return $data->crop_year;
                })
                ->addColumn('details',function($data){
                    $return = '<small class="text-muted">';
                    if(!empty($data->submitted_at)){
                        $return .= '<span class="text-success">Submitted at: '.Carbon::parse($data->submitted_at)->format('m/d/Y h:i A'). '</span> <span class="indent"></span>';
                    }
                    if(!empty($data->canceled_at)){
                        $return .= '<span class="text-danger">Canceled at: '.Carbon::parse($data->canceled_at)->format('m/d/Y h:i A').'</span>';
                    }
                    return $return.'</small>';
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
            Form1Details::insert(['weekly_report_slug' => $weekly_report->slug]);
            Form2Details::insert(['weekly_report_slug' => $weekly_report->slug]);
            Form3Details::insert(['weekly_report_slug' => $weekly_report->slug]);
            return $weekly_report->only('slug');
        }
        abort(503,'Error creating week.');
    }

    public function edit($slug, WeeklyReportService $weeklyReportService){

        $weekly_report = $this->findBySlug($slug);

        return view('sms.weekly_report.edit')->with([
            'wr' => $weekly_report,
            'formArray' => $weeklyReportService->computation($slug),
            'form2Array' => $weeklyReportService->form2Computation($slug),
            'form3Array' => $weeklyReportService->form3Computation($slug),
            'subsidiaries' => $weeklyReportService->subsidiaries($slug),
            'seriesNos' => $weeklyReportService->seriesNos($slug),
        ]);
    }

    public function findBySlug($slug){
        $wr = WeeklyReports::query()->with(['form1','form2','form3','details'])->where('slug','=',$slug)->first();
        if(!empty($wr)){
            return $wr;
        }
        abort(510,'Weekly Report not found.');
    }

    public function show($slug){
        $wr = $this->findBySlug($slug);
        return view('sms.weekly_report.show')->with([
            'wr' => $wr,
        ]);
    }

    public function destroy($slug, WeeklyReportService $weeklyReportService){
        $weeklyReportService->isNotSubmitted($slug);
        $wr = $this->findBySlug($slug);
        if($wr->delete()){
            $wr->details()->delete();
            $wr->seriesNos()->delete();
            $wr->form5IssuancesOfSro()->delete();
            $wr->form5Deliveries()->delete();
            $wr->form5ServedSros()->delete();
            $wr->form5aIssuancesOfSro()->delete();
            $wr->form5aDeliveries()->delete();
            $wr->form5aServedSros()->delete();
            return 1;
        }
        abort(503,'Error deleting data.');
    }

    public function findPreviousReport($current_weekly_report_slug){
        $relations = ['form1','form2','details','seriesNos'];
        $wr = WeeklyReports::query()->with($relations)
            ->where('slug','=',$current_weekly_report_slug)
            ->first();
        if(!empty($wr)){
            $prev = WeeklyReports::query()->with($relations)
                ->where('mill_code','=',$wr->mill_code)
                ->where('crop_year','=', $wr->crop_year)
                ->where('report_no','=',$wr->report_no - 1)
                ->first();
            if(!empty($prev)){
                return $prev;
            }
            return null;
        }
        abort(510,'Weekly Report not found.');
    }

    public function print($slug, SignatoryService $signatoryService){

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

        if($this->findPreviousReport($slug) == null){
            $prevForm1 = [];
        }else{
            $prevForm1 = $this->weeklyReportService->computation($this->findPreviousReport($slug)->slug,'toDate');
        }

//        dd($this->weeklyReportService->form4aComputation($slug,'toDate',10));
        return view('sms.printables.formAll')->with([
            'wr' => $weekly_report,
            'details_arr' => $details_arr,
            'input_fields_arr' => $input_fields_arr,
            'signatories' => $signatoryService->getSavedSignatoriesAsArray(),

            'toDateForm1' => $this->weeklyReportService->computation($slug,'toDate'),
            'form1' => $this->weeklyReportService->computation($slug),
            'prevForm1' => $prevForm1,


            'prevToDateForm1' => $this->weeklyReportService->computation($slug,'toDate', $weekly_report->report_no - 1),

            'form2' => $this->weeklyReportService->form2Computation($slug),
            'prevToDateForm2' => $this->weeklyReportService->form2Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm2' => $this->weeklyReportService->form2Computation($slug,'toDate'),

            'form3' => $this->weeklyReportService->form3Computation($slug),
            'prevToDateForm3' => $this->weeklyReportService->form3Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm3' => $this->weeklyReportService->form3Computation($slug,'toDate'),

            'form4a' => $this->weeklyReportService->form4aComputation($slug),
        ]);
    }
    public function printForm6a($slug){
        $r = $this->findBySlug($slug);
        $cy = CropYears::query()->where('slug', $r->crop_year)->first();
        $receiptsList = RawSugarReceipts::query()->where('weekly_report_slug', $slug)->get();
        $registryList = QuedanRegistry::query()->where('weekly_report_slug', $slug)->get();
        return view('printables.sms_form.form6a')->with([
            'cy' => $cy,
            'r' => $r, 'receiptsList' => $receiptsList,
            'registryList' => $registryList,
        ]);
    }

    public function saveAsNew($slug){
        $wr = $this->findBySlug($slug);
        $wrNew = $wr->replicate(['status']);
        $wr->status = -1;
        $wr->canceled_at = Carbon::now();
        $wr->user_canceled = Auth::user()->user_id;
        $wrNew->slug = \Illuminate\Support\Str::random();

        $relations = ['form1','form2','form3'];
        foreach ($relations as $relation) {
            if(!empty($wr->{$relation})){
            $items = $wr->{$relation}->toArray();
            unset($items['id']);
            $wrNew->{$relation}()->create($items);
            }
        }
        $wr->save();
        if($wrNew->save()){
            return $wrNew->only('slug');
        }
    }

    public function submit($slug){
        $wr = $this->findBySlug($slug);
        $wr->status  = 1;
        $wr->submitted_at = Carbon::now();
        $wr->user_submitted = Auth::user()->user_id;
        if($wr->save()){
            return $wr->only('slug');
        }
        abort(503, 'Error submitting weekly report.');
    }
}