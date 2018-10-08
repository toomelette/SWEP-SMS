<?php
  
  $start_date = __dataType::date_parse('2017-9-01', 'm/d/y');
  $end_date = Carbon::now()->format('m/d/y');
  $balance_sick = $employee->empBeginningCredits->bigbal_sick_leave;
  $balance_vac = $employee->empBeginningCredits->bigbal_vacation_leave;

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Leave Card Ledger</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    .box-d-grey{
      -webkit-print-color-adjust: exact; 
      background-color: #a7aaab !important;
    }

    .box-l-grey{
      -webkit-print-color-adjust: exact; 
      background-color: #e8e8e8 !important;
    }

    .title-l{
      -webkit-print-color-adjust: exact; 
      color: #ffffff !important;
      font-style:italic; 
      font-size: 13px;
      font-weight: bold;
    }

    @media print {
        .footer {
          page-break-after: always;
        }
    }

  </style>

</head>
<body {{-- onload="window.print();" onafterprint="window.close()" --}}>

  <div class="wrapper" style="padding:50px;">

    {{-- HEADER --}}

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10" style="text-align: center;">
        <span style="font-size:15px;">SUGAR REGULATORY ADMINISTRATION</span><br>
        <span style="font-size:15px; margin-top: -10px;">Araneta St., Singcang, Bacolod City</span><br>
        <span style="font-weight:bold; font-size:17px; margin-top: -5px;">EMPLOYEE LEAVE CARD</span>
      </div>
      <div class="col-md-1"></div>
    </div>

    {{-- EMPLOYEE DETAILS --}}
    <div class="row" style="margin-top: 25px;">
      <div class="col-sm-2">
        <span style="font-size:13px;">NAME:</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 50px;">
        <span style="font-weight: bold; font-size:15px;">{{ $employee->fullname }}</span>
      </div>
      <div class="col-sm-1" style="margin-right: 50px;">
        <span style="font-size:13px;">DESIGNATION:</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px;">
        <span style="font-weight: bold; font-size:15px;">{{ $employee->position }}</span>
      </div>
    </div>


    <div class="row" style="margin-top: 25px;">
      <div class="col-sm-2">
        <span style="font-size:13px;">DATE JOINED:</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px; margin-right: 50px;">
        <span style="font-weight: bold; font-size:15px;">{{ __dataType::date_parse($employee->firstday_sra, 'F d,Y') }}</span>
      </div>
      <div class="col-sm-1" style="margin-right: 50px;">
        <span style="font-size:13px;">SALARY:</span>
      </div>
      <div class="col-sm-3 no-padding" style="border-bottom:solid 1px;">
        <span style="font-weight: bold; font-size:15px;">{{ number_format($employee->monthly_basic, 2) }}</span>
      </div>
    </div>

    <div style="margin-bottom: 40px;"></div>



    {{-- TABLE HEADER --}}
    <div class="row" style="margin:0;">
      <div class="col-sm-12 no-padding" style="border:solid 1px;">

        <div class="col-sm-1 no-padding" style="border-left:solid 1px; height: 4em; text-align: center;">
          <span style="font-size:11px; font-weight:bold;">PERIOD</span>
        </div>

        {{-- Particulars --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px; height: 4em;">
          <span style="font-size:11px; font-weight:bold; margin-left: 200px;">PARTICULARS</span><br>
          <span style="font-size:11px; font-style:italic; margin-left: 200px; margin-top:-5px;">(Dates of Leave)</span>
          <div class="col-sm-12 no-padding" style="border-top:solid 1px;">
            <div class="col-sm-4" style="border-right:solid 1px;">
              <span style="font-size:12px; margin-left:30px;">Vacation</span>
            </div>
            <div class="col-sm-4" style="border-right:solid 1px;">
              <span style="font-size:12px; margin-left:50px;">Sick</span>
            </div>
            <div class="col-sm-4">
              <span style="font-size:12px; margin-left:40px;">Forced</span>
            </div>
          </div>
        </div>

        {{-- Vacation --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px; height: 4em;">
          <span style="font-size:11px; font-weight:bold; margin-left: 180px;">VACATION LEAVE</span>
          <div class="col-sm-12 no-padding" style="border-top:solid 1px;">
            <div class="col-sm-2" style="border-right:solid 1px; height: 2.6em;">
              <span style="font-size:11px;">EARNED</span>
            </div>
            <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
              <span style="font-size:11px; margin-left:50px;">A/U w Pay</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <div class="col-sm-6" style="border-right:solid 1px;">
                  <span style="font-size:11px; margin-left:10px;">DAYS</span>
                </div>
                <div class="col-sm-6">
                  <span style="font-size:11px; margin-left:8px;">TARDY</span>
                </div>
              </div>
            </div>
            <div class="col-sm-2 no-padding" style="border-right:solid 1px; height: 2.6em;">
              <span style="font-size:11px; margin-left:12px;">BALANCE</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <span style="font-size:11px; margin-left:20px;">{{ number_format($balance_vac, 3)  }}</span>
              </div>
            </div>
            <div class="col-sm-4 no-padding">
              <span style="font-size:11px; margin-left:50px;">A/U wo Pay</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <div class="col-sm-6" style="border-right:solid 1px;">
                  <span style="font-size:11px; margin-left:10px;">DAYS</span>
                </div>
                <div class="col-sm-6">
                  <span style="font-size:11px; margin-left:8px;">TARDY</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Sick --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px; height: 4em;">
          <span style="font-size:11px; font-weight:bold; margin-left: 180px;">SICK LEAVE</span>
          <div class="col-sm-12 no-padding" style="border-top:solid 1px;">
            <div class="col-sm-2" style="border-right:solid 1px; height: 2.6em;">
              <span style="font-size:11px;">EARNED</span>
            </div>
            <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
              <span style="font-size:11px; margin-left:50px;">A/U w Pay</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <div class="col-sm-6" style="border-right:solid 1px;">
                  <span style="font-size:11px; margin-left:10px;">DAYS</span>
                </div>
                <div class="col-sm-6">
                  <span style="font-size:11px; margin-left:8px;">TARDY</span>
                </div>
              </div>
            </div>
            <div class="col-sm-2 no-padding" style="border-right:solid 1px; height: 2.6em;">
              <span style="font-size:11px; margin-left:12px;">BALANCE</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <span style="font-size:11px; margin-left:20px;">{{ number_format($balance_sick, 3) }}</span>
              </div>
            </div>
            <div class="col-sm-4 no-padding">
              <span style="font-size:11px; margin-left:50px;">A/U wo Pay</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <div class="col-sm-6" style="border-right:solid 1px;">
                  <span style="font-size:11px; margin-left:10px;">DAYS</span>
                </div>
                <div class="col-sm-6">
                  <span style="font-size:11px; margin-left:8px;">TARDY</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Remarks --}}
        <div class="col-sm-2 no-padding" style="border-left:solid 1px; height: 4em; text-align: center;">
          <span style="font-size:12px; font-weight:bold;">REMARKS</span><br>
          <span style="font-size:12px; font-weight:bold;">Adm. Order no.7</span>
        </div>

      </div>
    </div>





    {{-- TABLE BODY --}}
    @foreach (__dynamic::months_between_dates($start_date, $end_date) as $key => $data)

      <?php

        $month = substr($key, 0, 2);
        $year = substr($key, -4);
        $vac_leave_days = 0;
        $tardy = 0;
        $ut_sum = 0;
        $sick_leave_days = 0;
        $ps_hrs = 0;
        $ps_mins = 0;
        $ps_total_time = 0;
        $ps_credits = 0;

        foreach ($employee->permissionSlip()->monthlyPSM2($month, $year) as $data_ps) {
          
          $start = Carbon::createFromFormat('H:i:s', $data_ps->time_out);
          $end = Carbon::createFromFormat('H:i:s', $data_ps->time_in);
          $ps_hrs = $end->diffInHours($start);
          $ps_mins = $end->copy()->subHours($ps_hrs)->diffInMinutes($start) * .01;
          $ps_total_time = $ps_hrs + $ps_mins;

        }

        if($ps_total_time >= 4){

          $ps_diff_time = $ps_total_time - 4;
          $ps_total_hrs = floor($ps_diff_time);
          $ps_total_mins = ($ps_diff_time - $ps_total_hrs) * 100;
          $ps_credits_per_hr = number_format($ps_total_hrs * .125, 3);
          $ps_credits_per_min = number_format($ps_total_mins * .125/60, 3);

          $ps_credits = $ps_credits_per_hr + $ps_credits_per_min;

        }

      ?>

      <div class="row" style="margin:0;">
        <div class="col-sm-12 no-padding" style="border:solid 1px;">

          <div class="col-sm-1 no-padding" style="border-left:solid 1px;">
            <span style="font-size:11px; font-weight:bold;">{{ $data }}</span>
          </div>

          {{-- Particulars  --}}
          <div class="col-sm-3 no-padding" style="border-left:solid 1px;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                <span style="font-size:12px;">
                  &nbsp;
                  @foreach($employee->leaveCard()->getLeaveVacation($month, $year) as $data_vl)
                    {{ __dataType::date_parse($data_vl->date_from, 'd') .'-'. __dataType::date_parse($data_vl->date_to, 'd') }}
                    ,
                  @endforeach
                </span>
              </div>
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                <span style="font-size:12px;">
                  &nbsp;
                  @foreach($employee->leaveCard()->getLeaveSick($month, $year) as $data_sl)
                    {{ __dataType::date_parse($data_sl->date_from, 'd') .'-'. __dataType::date_parse($data_sl->date_to, 'd') }}
                    ,
                  @endforeach
                </span>
              </div>
              <div class="col-sm-4 no-padding">
                <span style="font-size:12px;">
                  &nbsp;
                  @foreach($employee->leaveCard()->getLeaveForced($month, $year) as $data_fl)
                    {{ __dataType::date_parse($data_fl->date_from, 'd') .'-'. __dataType::date_parse($data_fl->date_to, 'd') }}
                    ,
                  @endforeach
                </span>
              </div>
            </div>
          </div>


          {{-- Vacation --}}
          <div class="col-sm-3 no-padding" style="border-left:solid 1px;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-2" style="border-right:solid 1px;">
                <span style="font-size:11px; margin-left: 10px;">1.25</span>
              </div>
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                <div class="col-sm-12 no-padding" style="margin:0;">
                  <div class="col-sm-6" style="border-right:solid 1px;">
                    <span style="font-size:11px; margin-left:5px;">
                      <?php
                        $vac_sum = $employee->leaveCard()->getLeaveVacation($month, $year)->sum('credits');
                        $ut_sum = $employee->leaveCard()->getUndertime($month, $year)->sum('credits');
                        $vac_leave_days = $ut_sum + $vac_sum;
                      ?>
                      {{ $vac_leave_days == 0 ? '' : number_format($vac_leave_days, 3) }}
                    </span>
                  </div>
                  <div class="col-sm-6">
                    <span style="font-size:11px; margin-left:8px;">
                      <?php
                        $tardy = $employee->leaveCard()->getTardy($month, $year)->sum('credits');
                      ?>
                      {{ $tardy == 0 ? '' : number_format($tardy, 3) }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-sm-2" style="border-right:solid 1px;">
                <span style="font-size:11px; margin-left:8px;">
                  <?php
                    $deduct_vac = $tardy + $vac_leave_days + $ps_credits;
                    $balance_vac = $balance_vac + 1.25;
                    $balance_vac = $balance_vac - $deduct_vac;
                  ?>
                  {{ number_format($balance_vac, 3) }}
                </span>
              </div>
              <div class="col-sm-4 no-padding">
                <div class="col-sm-12 no-padding" style="margin:0;">
                  <div class="col-sm-6" style="border-right:solid 1px;">
                    <span style="font-size:11px;">
                      &nbsp;
                    </span>
                  </div>
                  <div class="col-sm-6">
                    <span style="font-size:11px;">
                      &nbsp;
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Sick  --}}
          <div class="col-sm-3 no-padding" style="border-left:solid 1px; border-right:solid 1px;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-2" style="border-right:solid 1px;">
                <span style="font-size:11px; margin-left: 10px;">1.25</span>
              </div>
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                <div class="col-sm-12 no-padding" style="margin:0;">
                  <div class="col-sm-6" style="border-right:solid 1px;">
                    <span style="font-size:11px; margin-left:8px;">
                      <?php
                        $sick_leave_days = $employee->leaveCard()->getLeaveSick($month, $year)->sum('credits');
                      ?>
                      {{ $sick_leave_days == 0 ? '' : number_format($sick_leave_days, 3) }}
                    </span>
                  </div>
                  <div class="col-sm-6">
                    <span style="font-size:11px; margin-left:8px;">
                      &nbsp;
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-sm-2" style="border-right:solid 1px;">
                <span style="font-size:11px; margin-left:7px;">
                  <?php
                    $balance_sick = $balance_sick + 1.25;
                    $balance_sick = $balance_sick - $sick_leave_days;
                  ?>
                  {{ number_format($balance_sick, 3) }}
                </span>
              </div>
              <div class="col-sm-4 no-padding">
                <div class="col-sm-12 no-padding" style="margin:0;">
                  <div class="col-sm-6" style="border-right:solid 1px;">
                    <span style="font-size:11px;">
                      &nbsp;
                    </span>
                  </div>
                  <div class="col-sm-6">
                    <span style="font-size:11px;">
                      &nbsp;
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Remarks --}}
          <div class="col-sm-2 no-padding" style="border-left:solid 1px;">

            @if($ps_credits > 0)
              <span style="font-size:11px;">Over PS - {{ $ps_credits }}, </span>
            @endif

            @if($ut_sum > 0)
              <span style="font-size:11px;">Undertime - {{ $ut_sum }}</span>
            @endif

          </div>

        </div>
      </div>
      
    @endforeach



  </div>


</body>
</html>

