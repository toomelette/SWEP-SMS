<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Http\Controllers\Controller;
use App\SMS\Services\CancellationService;
use App\SMS\Services\StatusService;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class CancellationController extends Controller
{
    protected $cancellationService;
    protected $statusService;
    public function __construct(CancellationService $cancellationService, StatusService $statusService)
    {
        $this->cancellationService = $cancellationService;
        $this->statusService = $statusService;
    }

    public function preview($slug){
        $c =  $this->cancellationService->findBySlug($slug);
//        $path = $c->full_path;
//        return Storage::disk('sms_storage')->download($path);

        $path = Storage::disk('sms_storage')->path('/'.$c->full_path);


        if (!File::exists($path)) {
            abort(504,'File does not exist.');
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
//            $response->header("Content-Type", $type)
//                ->header('Content-disposition' => 'attachment; filename=' . $fileName,);
        $response->withHeaders([
            'Content-Type' => $type,
            'Content-disposition' => 'inline; filename='.$c->filename.'.pdf',
        ]);
        return $response;
    }

    public function action($slug, Request $request){
        $cancellation = $this->cancellationService->findBySlug($slug);
        if($request->action == 'APPROVED'){
            $cancellation->weeklyReport->status = null;
            $cancellation->weeklyReport->update();
            $this->statusService->updateStatus($cancellation->weekly_report_slug,1,'Cancellation request has been APPROVED.');


        }else{
            $this->statusService->updateStatus($cancellation->weekly_report_slug,-1,'Cancellation request has been DENIED.');
        }

        $cancellation->action = $request->action;
        $cancellation->action_by = \Auth::user()->user_id;
        $cancellation->action_at = Carbon::now();
        if($cancellation->save()){
            return $cancellation->only('slug');
        }
        abort(503,'Error performing action.');
    }
}