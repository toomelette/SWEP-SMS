<?php


namespace App\Http\Controllers;


use App\Models\UserData;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Arrays;
use App\Swep\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class AjaxPostController extends Controller
{
    public function post($for, WeeklyReportService $weeklyReportService){
        if($for == 'dtr_edit_intro'){
            $ud = new UserData;
            $ud->slug = Str::random();
            $ud->data = $for;
            $ud->user_id = Auth::user()->user_id;
            $ud->value = 1;
            $ud->save();
        }
        if($for == 'form1Preview'){
            $weekly_report_slug = Request::get('weekly_report');

            $form1Array = [];
            foreach (Arrays::sugarClasses() as $sugarClass){
                $structure[$sugarClass] = [
                    'current' => null,
                    'prev' => null,
                ];
            }
            $form1Array['issuances']['values'] = $structure;

            if(!empty(Request::get('data')['form1']['rawIssuances'])){
                foreach (Request::get('data')['form1']['rawIssuances']['options'] as $keySlug => $issuance){
                    $form1Array['issuances']['values'][$issuance] = [
                        'current' => !empty(Request::get('data')['form1']['rawIssuances']['current'][$keySlug]) ? Helper::sanitizeAutonum(Request::get('data')['form1']['rawIssuances']['current'][$keySlug]) : null,
                        'prev' => (!empty(Request::get('data')['form1']['rawIssuances']['prev'][$keySlug])) ? Helper::sanitizeAutonum(Request::get('data')['form1']['rawIssuances']['prev'][$keySlug]) : null,
                    ];
                }
            }
            $form1Array['manufactured']['current'] =  !empty(Request::get('data')['form1']['manufactured']['current']) ? Helper::sanitizeAutonum(Request::get('data')['form1']['manufactured']['current']) : null;
            $form1Array['manufactured']['prev'] =  !empty(Request::get('data')['form1']['manufactured']['prev']) ? Helper::sanitizeAutonum(Request::get('data')['form1']['manufactured']['prev']) : null;

            $computation = $weeklyReportService->computation($weekly_report_slug,$form1Array);
            return view('sms.weekly_report.previews.form1')->with([
                'formArray' => $computation,
            ]);
        }
    }
}