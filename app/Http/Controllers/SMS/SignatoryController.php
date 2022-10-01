<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\SignatoryFormRequest;
use App\Models\SMS\Signatories;
use App\SMS\Services\SignatoryService;
use Illuminate\Http\Request;

class SignatoryController extends Controller
{
    public function index(SignatoryService $signatoryService){
        $signatoriesArr = $signatoryService->getSavedSignatoriesAsArray();
        return view('sms.signatory.index')->with([
            'signatories' => $signatoriesArr,
        ]);
    }

    public function store(SignatoryFormRequest $request){
        if(empty(\Auth::user()->sugarMill->signatories)){
            abort(503,'Sugar mill not found on the database.');
        }
        $signatoriesArr = [];
        if(!empty($request)){
            foreach ($request->signatories as $form => $types){
                foreach ($types as $type => $data){
                    array_push($signatoriesArr,[
                        'mill_code' => \Auth::user()->mill_code,
                        'form' => $form,
                        'for' => $type,
                        'name' => strtoupper($data['name']),
                        'position' => strtoupper($data['position']),
                        'user_created'=> \Auth::user()->user_id,
                        'created_at' => \Carbon::now(),
                        'ip_created' => \Illuminate\Support\Facades\Request::ip(),
                    ]);
                }
            }
        }
        \Auth::user()->sugarMill->signatories()->delete();
        if(Signatories::insert($signatoriesArr)){
            abort(200,'Success');
        }
        abort(503,'Error saving data.');
    }
}