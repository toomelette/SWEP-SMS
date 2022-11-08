<?php


namespace App\Http\Controllers;


use App\Models\SMS\WeeklyReports;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExampleController extends Controller
{
    public function index(Request $request){

        $weeklyReport = $this->findBySlug($request->slug);


        return $weeklyReport;
        return 1;




        $weeklyReports = new WeeklyReports;
        $weeklyReports->slug = Str::random();
        $weeklyReports->mill_code = '732aaaa';
        $weeklyReports->crop_year = '2024-2025';

        return 1;
        $weeklyReports = WeeklyReports::query()
            ->where('mill_code','=','51-SAGAY')
            ->get();

        return view('example.listing')->with([
            'weeklyReports' => $weeklyReports,
        ]);

    }

    private function findBySlug($slug){
        $weeklyReport = WeeklyReports::query()
            ->where('slug','=',$slug)
            ->first();

        return $weeklyReport;
    }
}