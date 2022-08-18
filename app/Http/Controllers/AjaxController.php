<?php


namespace App\Http\Controllers;


use App\Models\Document;
use App\Models\SSL;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function get($for){

        if($for == 'compute_monthly_salary'){
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

        if($for == 'document_person_to'){
            $arr['results'] = [];
            $docs = Document::query()->select('person_to')->where('person_to','like','%'.Request::get("q").'%')->groupBy('person_to')->limit(30)->get();
            array_push($arr['results'],['id'=>'','text' => "Don't Filter"]);
            if(!empty($docs)){

                foreach ($docs as $doc){
                    array_push($arr['results'],['id'=>$doc->person_to,'text' => $doc->person_to]);
                }
            }
            return $arr;
        }
        if($for == 'document_person_from'){
            $arr['results'] = [];
            $docs = Document::query()->select('person_from')->where('person_from','like','%'.Request::get("q").'%')->groupBy('person_from')->limit(30)->get();
            array_push($arr['results'],['id'=>'','text' => "Don't Filter"]);
            if(!empty($docs)){
                foreach ($docs as $doc){
                    array_push($arr['results'],['id'=>$doc->person_from,'text' => $doc->person_from]);
                }
            }
            return $arr;
        }
        if($for == 'dv_add_item'){
            $rcs = \App\Models\RC::query()->get();
            $rand = \Illuminate\Support\Str::random(5);
            return [
                'view' => view('ajax.disbursement_voucher.add_item')->with([
                            'rcs'=>$rcs,
                            'rand' => $rand,
                        ])->render(),
                'rand' => $rand,
            ];
        }

    }
}