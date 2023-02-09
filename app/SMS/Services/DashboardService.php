<?php


namespace App\SMS\Services;


use App\Swep\BaseClasses\BaseService;
use Illuminate\Support\Carbon;

class DashboardService extends BaseService
{
    public function getMillGatePrice($week_ending){
        $prevWeekEnding = Carbon::parse($week_ending)->subDays(7)->format('Y-m-d');
        $refined = \App\Models\SMS\Form1\Form1Details::query()
            ->selectRaw('week_ending, avg(wholesale_refined) as wholesale_refined')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form1_details.weekly_report_slug')
            ->where('status','=','1')
            ->where('wholesale_refined','>',1000)
            ->where('week_ending','=',$week_ending)
            ->groupBy('week_ending')
            ->first();

        return [
            'prices' => [
                'raw' => $this->queryMillGatePrice($week_ending,'wholesale_raw'),
                'refined' => $this->queryMillGatePrice($week_ending,'wholesale_refined'),
            ],
            'diff' =>[
                'raw' => $this->queryMillGatePrice($prevWeekEnding,'wholesale_raw') - $this->queryMillGatePrice($week_ending,'wholesale_raw'),
                'refined' => $this->queryMillGatePrice($prevWeekEnding,'wholesale_refined') - $this->queryMillGatePrice($week_ending,'wholesale_refined'),
            ]
        ];
    }

    private function queryMillGatePrice($week_ending,$field){
        $q = \App\Models\SMS\Form1\Form1Details::query()
            ->selectRaw('week_ending, avg('.$field.') as '.$field)
            ->leftJoin('weekly_reports','weekly_reports.slug','=','form1_details.weekly_report_slug')
            ->where('status','=','1')
            ->where($field,'>',1000)
            ->where('week_ending','=',$week_ending)
            ->groupBy('week_ending')
            ->first();
        return $q->$field ?? null;
    }
}