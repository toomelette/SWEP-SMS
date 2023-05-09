<?php


namespace App\SMS\Services;


use App\Models\SMS\Status;

class StatusService
{
    protected $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function updateStatus($slug,$statusCode,$statusText = null,$statusDetails = null){
        $s = new Status;
        $s->weekly_report_slug = $slug;
        $s->status = $statusCode;
        $s->status_text = $statusText;
        $s->status_details = $statusDetails;
        $s->save();

    }

    public function statusCodes(){
        return [
            -2 => 'PENDING CANCELLATION',
            -1 => 'CANCELLED',
            1 => 'SUBMITTED',
        ];
    }
}