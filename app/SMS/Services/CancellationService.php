<?php


namespace App\SMS\Services;




use App\Models\SMS\RequestsForCancellation;

class CancellationService
{
    public function findBySlug($slug){
        $s = RequestsForCancellation::query()->where('slug','=',$slug)->first();
        return $s ?? abort(503,'Cancellation not found');
    }

    public function getNumberOfActiveRequest($mill_code){
        $r = RequestsForCancellation::query()
            ->selectRaw('count(mill_code) as number_of_active_request, mill_code, action')
            ->leftJoin('weekly_reports','weekly_reports.slug','=','requests_for_cancellation.weekly_report_slug')
            ->where('action','=',null)
            ->where('mill_code','=',$mill_code)
            ->first();
        return $r->number_of_active_request ?? null;
    }
}