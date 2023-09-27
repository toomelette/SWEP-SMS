<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Http\Controllers\SMS\WeeklyReport\RawSugarController;
use App\Http\Requests\SMS\CancellationFormRequest;
use App\Http\Requests\SMS\WeeklyReportFormRequest;
use App\Models\SMS\Form1\Form1Details;
use App\Models\SMS\Form2\Form2Details;
use App\Models\SMS\Form3\Form3Details;
use App\Models\SMS\Form5\IssuancesOfSro;
use App\Models\SMS\InputFields;
use App\Models\SMS\CropYears;
use App\Models\SMS\Form6a\QuedanRegistry;
use App\Models\SMS\Form6a\RawSugarReceipts;
use App\Models\SMS\RequestsForCancellation;
use App\Models\SMS\WeeklyReports;
use App\SMS\Services\CalendarService;
use App\SMS\Services\SignatoryService;
use App\SMS\Services\StatusService;
use App\SMS\Services\WeeklyReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class WeeklyReportController extends Controller
{
    protected  $weeklyReportService;
    protected  $statusService;
    protected  $calendarService;
    public function __construct(WeeklyReportService $weeklyReportService, StatusService $statusService, CalendarService $calendarService)
    {
        $this->weeklyReportService = $weeklyReportService;
        $this->statusService = $statusService;
        $this->calendarService = $calendarService;
    }

    public function index(){
        if(\request()->ajax()){
            $reports = WeeklyReports::query()
                ->with(['cropYear','calendar'])
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
                    if($data->status == -2){
                        return '<span class="label label-warning"><i class="fa fa-times"></i> PENDING CANCELLATION REQUEST</span>';
                    }
                    return '<span class="label label-default"><i class="fa fa-pencil"></i> DRAFT</span>';
                })
                ->editColumn('week_ending',function($data){
                    return Carbon::parse($data->week_ending)->format('F d, Y');
                })
                ->editColumn('crop_year',function($data){
                    return $data->crop_year;
                })
                ->editColumn('report_no',function($data){
                    return $data->calendar->display_report_no;
                })
                ->addColumn('details',function($data){

                    return view('sms.weekly_report.action_buttons.weekly_report_index.details')->with([
                        'data' => $data,
                    ]);

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
        $calendar = $this->calendarService->findBySlug($request->calendar_slug);
        $weekly_report = new WeeklyReports;
        $weekly_report->slug = Str::random();
        $weekly_report->mill_code = Auth::user()->mill_code;
        $weekly_report->crop_year = $calendar->crop_year;
        $weekly_report->week_ending = $calendar->week_ending;
        $weekly_report->report_no = $calendar->report_no;
        $weekly_report->calendar_slug = $calendar->slug;
        $weekly_report->dist_no = $request->dist_no;
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
        if($weekly_report->mill_code != Auth::user()->mill_code){
            abort(510,'This report does not belong to your mill code.');
        }
        if($weekly_report->status == -1){
            abort(510,'This report has already been cancelled.');
        }

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
        $wr = WeeklyReports::query()->with(['sugarMill','form1','form2','form3','details'])->where('slug','=',$slug)->first();
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

    public function printSingle($slug, $formNo, SignatoryService $signatoryService){
        $weekly_report = $this->findBySlug($slug);
//        dd($formNo);

        if($weekly_report->mill_code != Auth::user()->mill_code){
            if(Auth::user()->access != 'ADMIN'){
                abort(404,'This report does not belong to your mill code.');
            }
        }
        $details_arr = [];
        $input_fields_arr = [];
        $this->weeklyReportService->updateSignatories($weekly_report->slug);
        $ifs = InputFields::query()->get();
        if(!empty($ifs)){
            foreach ($ifs as $if){
                $input_fields_arr[$if->field] = [
                    'display_name' => $if->display_name,
                    'prefix' => $if->prefix,
                ];
            }
        }



        if(!empty($weekly_report->seriesNos)){
            foreach ($weekly_report->seriesNos as $seriesNo){
                $details_arr[$seriesNo->type]['seriesNos'][$seriesNo->sugarClass][$seriesNo->slug] = $seriesNo;
            }
        }

        if($this->findPreviousReport($slug) == null){
            $prevForm1 = [];
        }else{
            $prevForm1 = $this->weeklyReportService->computation($this->findPreviousReport($slug)->slug,'toDate');
        }

        switch ($formNo)
        {
            case "1":
                return view("sms.printables.singleform.form1")->with([
                    'wr' => $weekly_report,
                    'details_arr' => $details_arr,
                    'input_fields_arr' => $input_fields_arr,
                    'signatories' => $this->weeklyReportService->getSignatories($slug),

                    'toDateForm1' => $this->weeklyReportService->computation($slug,'toDate',$weekly_report->report_no),
                    'form1' => $this->weeklyReportService->computation($slug),
                    'prevForm1' => $prevForm1,


                    'prevToDateForm1' => $this->weeklyReportService->computation($slug,'toDate', $weekly_report->report_no - 1),
                ]);
                break;

            case "2":
                return view("sms.printables.singleform.form1")->with([
                    'wr' => $weekly_report,
                    'details_arr' => $details_arr,
                    'input_fields_arr' => $input_fields_arr,
                    'signatories' => $this->weeklyReportService->getSignatories($slug),


                ]);
                break;

            case "3":
                return view("sms.printables.singleform.form1")->with([
                    'wr' => $weekly_report,
                    'details_arr' => $details_arr,
                    'input_fields_arr' => $input_fields_arr,
                    'signatories' => $this->weeklyReportService->getSignatories($slug),


                ]);
                break;
        }

        return view('sms.printables.formAll')->with([
            'wr' => $weekly_report,
            'details_arr' => $details_arr,
            'input_fields_arr' => $input_fields_arr,
            'signatories' => $this->weeklyReportService->getSignatories($slug),

            'toDateForm1' => $this->weeklyReportService->computation($slug,'toDate',$weekly_report->report_no),
            'form1' => $this->weeklyReportService->computation($slug),
            'prevForm1' => $prevForm1,


            'prevToDateForm1' => $this->weeklyReportService->computation($slug,'toDate', $weekly_report->report_no - 1),

            'form2' => $this->weeklyReportService->form2Computation($slug),
            'prevToDateForm2' => $this->weeklyReportService->form2Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm2' => $this->weeklyReportService->form2Computation($slug,'toDate',$weekly_report->report_no ),

            'form3' => $this->weeklyReportService->form3Computation($slug),
            'prevToDateForm3' => $this->weeklyReportService->form3Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm3' => $this->weeklyReportService->form3Computation($slug,'toDate',$weekly_report->report_no),

            'form3a' => $this->weeklyReportService->form3aComputation($slug),
            'prevToDateForm3a' => $this->weeklyReportService->form3aComputation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm3a' => $this->weeklyReportService->form3aComputation($slug,'toDate'),

            'form4' => $this->weeklyReportService->form4Computation($slug),
            'prevToDateForm4' => $this->weeklyReportService->form4Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm4' => $this->weeklyReportService->form4computation($slug,'toDate'),

            'form4a' => $this->weeklyReportService->form4aComputation($slug),
            'prevToDateForm4a' => $this->weeklyReportService->form4aComputation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm4a' => $this->weeklyReportService->form4acomputation($slug,'toDate'),
        ]);
    }

    public function print($slug, SignatoryService $signatoryService){
        $weekly_report = $this->findBySlug($slug);

        if($weekly_report->mill_code != Auth::user()->mill_code){
            if(Auth::user()->access != 'ADMIN'){
                abort(404,'This report does not belong to your mill code.');
            }
        }
        $details_arr = [];
        $input_fields_arr = [];
        $this->weeklyReportService->updateSignatories($weekly_report->slug);
        $ifs = InputFields::query()->get();
        if(!empty($ifs)){
            foreach ($ifs as $if){
                $input_fields_arr[$if->field] = [
                    'display_name' => $if->display_name,
                    'prefix' => $if->prefix,
                ];
            }
        }



        if(!empty($weekly_report->seriesNos)){
            foreach ($weekly_report->seriesNos as $seriesNo){
                $details_arr[$seriesNo->type]['seriesNos'][$seriesNo->sugarClass][$seriesNo->slug] = $seriesNo;
            }
        }

        if($this->findPreviousReport($slug) == null){
            $prevForm1 = [];
        }else{
            $prevForm1 = $this->weeklyReportService->computation($this->findPreviousReport($slug)->slug,'toDate');
        }

//        dd($this->weeklyReportService->form3Computation($slug,'toDate', $weekly_report->report_no - 1));

        return view('sms.printables.formAll')->with([
            'wr' => $weekly_report,
            'details_arr' => $details_arr,
            'input_fields_arr' => $input_fields_arr,
            'signatories' => $this->weeklyReportService->getSignatories($slug),

            'toDateForm1' => $this->weeklyReportService->computation($slug,'toDate',$weekly_report->report_no),
            'form1' => $this->weeklyReportService->computation($slug),
            'prevForm1' => $prevForm1,


            'prevToDateForm1' => $this->weeklyReportService->computation($slug,'toDate', $weekly_report->report_no - 1),

            'form2' => $this->weeklyReportService->form2Computation($slug),
            'prevToDateForm2' => $this->weeklyReportService->form2Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm2' => $this->weeklyReportService->form2Computation($slug,'toDate',$weekly_report->report_no ),

            'form3' => $this->weeklyReportService->form3Computation($slug),
            'prevToDateForm3' => $this->weeklyReportService->form3Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm3' => $this->weeklyReportService->form3Computation($slug,'toDate',$weekly_report->report_no),

            'form3a' => $this->weeklyReportService->form3aComputation($slug),
            'prevToDateForm3a' => $this->weeklyReportService->form3aComputation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm3a' => $this->weeklyReportService->form3aComputation($slug,'toDate'),

            'form4' => $this->weeklyReportService->form4Computation($slug),
            'prevToDateForm4' => $this->weeklyReportService->form4Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm4' => $this->weeklyReportService->form4computation($slug,'toDate'),

            'form4a' => $this->weeklyReportService->form4aComputation($slug),
            'prevToDateForm4a' => $this->weeklyReportService->form4aComputation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm4a' => $this->weeklyReportService->form4acomputation($slug,'toDate'),
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

    public function cancel($slug, Request $request){
        if(!$request->has('reason') || $request->reason == null | $request->reason == ''){
            abort(503,'Please indicate your reason for cancellation');
        }
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($slug);
        if($wr->requestsForCancellationNoAction()->count() > 0){
            abort(503,'This report has a pending request for cancellation.');
        }
        if($wr->status != 1){
            abort(503,'Non submitted reports cannot be cancelled');
        }


        $c = new RequestsForCancellation;
        $c->slug = Str::random();
        $c->weekly_report_slug = $slug;
        $c->reason = $request->reason;
        $c->cancelled_at = Carbon::now();
        $c->cancelled_by = Auth::user()->user_id;
        $cancel = $this->weeklyReportService->cancellationFilePath($wr);
        $c->filename = $cancel['filename'];
        $c->full_path = $cancel['full_path'];
        $this->pdf($wr->slug,$cancel['full_path']);
        if($c->save()){
            $this->statusService->updateStatus($slug,-2,'Cancellation is pending for approval of your designated Regulation Officer.');
        }
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

        $references = $this->references();

        foreach ($references as $tableName => $reference){
            $columns = \Schema::getColumnListing($tableName);
            if (($key = array_search('id', $columns)) !== false) {
                unset($columns[$key]);
            }
            if(!empty($wr->{$reference['objectRelation']})){
                $arr = [];
                foreach ($wr->{$reference['objectRelation']} as $data){
                    $toPush = [];
                    foreach ($columns as $col){
                        $toPush[$col] = $data->$col;
                        $toPush['slug'] = Str::random();
                        $toPush['weekly_report_slug'] = $wrNew->slug;
                    }
                    array_push($arr,$toPush);
                }
                $model  = $reference['model'];
                $model::insert($arr);
            }
        }


        if($wrNew->save()){
            return $wrNew->only('slug');
        }
    }

    private function references(){
        return [
            'form5_issuances_of_sro' => [
                'objectRelation' => 'form5IssuancesOfSro',
                'model' => 'App\Models\SMS\Form5\IssuancesOfSro',
            ],
            'form5_deliveries' => [
                'objectRelation' => 'form5Deliveries',
                'model' => 'App\Models\SMS\Form5\Deliveries',
            ],
            'form5_served_sros' => [
                'objectRelation' => 'form5ServedSros',
                'model' => 'App\Models\SMS\Form5\ServedSros',
            ],

            'form5a_issuances_of_sro' => [
                'objectRelation' => 'form5aIssuancesOfSro',
                'model' => 'App\Models\SMS\Form5a\IssuancesOfSro',
            ],
            'form5a_deliveries' => [
                'objectRelation' => 'form5aDeliveries',
                'model' => 'App\Models\SMS\Form5a\Deliveries',
            ],
            'form5a_served_sros' => [
                'objectRelation' => 'form5aServedSros',
                'model' => 'App\Models\SMS\Form5a\ServedSros',
            ],

            'form3b_issuances_of_sro' => [
                'objectRelation' => 'form3bIssuancesOfMro',
                'model' => 'App\Models\SMS\Form3b\IssuancesOfMro',
            ],
            'form3b_deliveries' => [
                'objectRelation' => 'form3bDeliveries',
                'model' => 'App\Models\SMS\Form3b\Deliveries',
            ],
            'form3b_served_sros' => [
                'objectRelation' => 'form3bServedMros',
                'model' => 'App\Models\SMS\Form3b\ServedSros',
            ],

        ];
    }

    public function submit($slug){
        $wr = $this->findBySlug($slug);
        $wr->status  = 1;
        $wr->submitted_at = Carbon::now();
        $wr->user_submitted = Auth::user()->user_id;
        $this->weeklyReportService->updateSignatories($slug);
        if($wr->save()){
            $this->statusService->updateStatus($slug,1,'Submitted at: '.Carbon::parse($wr->submitted_at)->format('M. d, Y | h:i A'));
            return $wr->only('slug');
        }
        abort(503, 'Error submitting weekly report.');
    }

    public function pdf($slug,$full_path){
        $weekly_report = $this->findBySlug($slug);

        if($weekly_report->mill_code != Auth::user()->mill_code){
            if(Auth::user()->access != 'ADMIN'){
                abort(404,'This report does not belong to your mill code.');
            }
        }
        $details_arr = [];
        $input_fields_arr = [];
        $this->weeklyReportService->updateSignatories($weekly_report->slug);
        $ifs = InputFields::query()->get();
        if(!empty($ifs)){
            foreach ($ifs as $if){
                $input_fields_arr[$if->field] = [
                    'display_name' => $if->display_name,
                    'prefix' => $if->prefix,
                ];
            }
        }



        if(!empty($weekly_report->seriesNos)){
            foreach ($weekly_report->seriesNos as $seriesNo){
                $details_arr[$seriesNo->type]['seriesNos'][$seriesNo->sugarClass][$seriesNo->slug] = $seriesNo;
            }
        }

        if($this->findPreviousReport($slug) == null){
            $prevForm1 = [];
        }else{
            $prevForm1 = $this->weeklyReportService->computation($this->findPreviousReport($slug)->slug,'toDate');
        }


        $data = [
            'wr' => $weekly_report,
            'details_arr' => $details_arr,
            'input_fields_arr' => $input_fields_arr,
            'signatories' => $this->weeklyReportService->getSignatories($slug),

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

            'form3a' => $this->weeklyReportService->form3aComputation($slug),
            'prevToDateForm3a' => $this->weeklyReportService->form3aComputation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm3a' => $this->weeklyReportService->form3aComputation($slug,'toDate'),

            'form4' => $this->weeklyReportService->form4Computation($slug),
            'prevToDateForm4' => $this->weeklyReportService->form4Computation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm4' => $this->weeklyReportService->form4computation($slug,'toDate'),

            'form4a' => $this->weeklyReportService->form4aComputation($slug),
            'prevToDateForm4a' => $this->weeklyReportService->form4aComputation($slug,'toDate', $weekly_report->report_no - 1),
            'toDateForm4a' => $this->weeklyReportService->form4acomputation($slug,'toDate'),
        ];

        $pdf = \PDF::loadView('sms.printables.pdf',$data);
        if(\Storage::disk('sms_storage')
            ->put($full_path,$pdf->output())){
            return 1;
        }
        abort(503, 'Error saving file.');
    }
}