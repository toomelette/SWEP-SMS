<?php


namespace App\SMS\Services;


use App\Models\SMS\Status;

class StatusService
{
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
          -1 => 'CANCELLED',
          1 => 'SUBMITTED',
        ];
    }
}