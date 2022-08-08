<?php


namespace App\Http\Controllers;


use App\Models\SSL;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function get($for){

        if($for = 'compute_monthly_salary'){
            $latest = SSL::query()->orderBy('date_implemented','desc')->first();
            $latest_date_implemented = $latest->date_implemented;
            $ssl = SSL::query()->where('salary_grade','=',Request::get('sg'))
                ->where('date_implemented','=',$latest_date_implemented)
                ->first();
            $si = 'step'.Request::get('si');

            if(!empty($ssl->$si)){
                return number_format($ssl->$si,2);
            }
            else{
                return 'N/A';
            }
        }
        if($for == 'educational_background'){
            return view('ajax.employee.add_school');
        }

        if($for == 'eligibility'){
            return view('ajax.employee.add_eligibility');
        }

        if($for == 'work_experience'){
            $rand = Str::random(16);
            return [
                'view' => view('ajax.employee.add_work_experience')->with([
                                'rand' => $rand,
                            ])->render(),
                'rand' => $rand,
            ];
        }

        if($for == 'close_bulletin'){
            $last_slug = request('last_slug');
            Session::put('last_slug',$last_slug);

            return Session::get('last_slug');
        }
    }
}