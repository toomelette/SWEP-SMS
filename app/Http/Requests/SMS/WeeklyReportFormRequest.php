<?php


namespace App\Http\Requests\SMS;


use App\Models\SMS\WeeklyReports;
use App\Rules\MustBeSunday;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class WeeklyReportFormRequest extends FormRequest
{
    public function rules(){
        $week_ending = $this->week_ending;
        $crop_year = $this->crop_year;
        return [
          'crop_year' => 'required|string',
          'week_ending' => [
              'required',
              'date_format:Y-m-d',
              Rule::unique('weekly_reports')->where(function ($query) use ($week_ending,$crop_year){
                  return $query->where('week_ending' ,'=',$week_ending)
                      ->where('user_created' ,'=',Auth::user()->user_id)
                      ->where('crop_year','=',$crop_year);
              }),
              new MustBeSunday(),
          ],
          'report_no' => 'required|string',
          'dist_no' => 'required|string',
        ];
    }
    public function messages()
    {

        $href = '';
        $report = WeeklyReports::query()->where('week_ending','=',$this->week_ending)->first();
        if(!empty($report)){
            $href = route('dashboard.weekly_report.edit',$report->slug);
        }

        return [
            'week_ending.unique' => 'You have already made a report for this week ending. <a href="'.$href.'" target="">Click here to edit</a>.',
        ];
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}