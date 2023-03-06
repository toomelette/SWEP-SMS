<?php


namespace App\Http\Controllers\SMS\Admin;


class ReportsController
{
    public function index(){
        return view('sms.admin.reports.index');
    }
}