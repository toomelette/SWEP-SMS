<?php

  $leave_ot_balance = $employee->empBeginningCredits->bigbal_overtime;

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

  <link rel="stylesheet" href="{{ asset('css/print.css') }}?s={{\Illuminate\Support\Str::random()}}">

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
<body>

  <div class="wrapper" style="padding:50px;">

    {{-- HEADER --}}

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10" style="text-align: center;">
        <span style="font-size:15px;">SUGAR REGULATORY ADMINISTRATION</span><br>
        <span style="font-size:15px; margin-top: -10px;">Araneta St., Singcang, Bacolod City</span><br>
        <span style="font-weight:bold; font-size:17px; margin-top: -5px;">EMPLOYEE OVERTIME LEDGER</span>
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

        <div class="col-sm-2 no-padding" style="border-left:solid 1px; height: 4em; text-align: center;">
          <span style="font-size:11px; font-weight:bold;">PERIOD</span><br><br>
          <span style="font-size:14px; font-weight:bold;">August 2018</span>
        </div>


        {{-- Particulars --}}
        <div class="col-sm-6 no-padding" style="border-left:solid 1px; height: 4em;">
          <span style="font-size:11px; font-weight:bold; margin-left: 200px;"></span><br>
          <span style="font-size:11px; font-style:italic; margin-left: 200px; margin-top:-5px;"></span>
          <div class="col-sm-12 no-padding" style="border-top:solid 1px;">
            <div class="col-sm-4" style="border-right:solid 1px;">
              <span style="font-size:12px; margin-left:100px;">Overtime</span>
            </div>
            <div class="col-sm-4" style="border-right:solid 1px;">
              <span style="font-size:12px; margin-left:100px;">Monetary</span>
            </div>
            <div class="col-sm-4">
              <span style="font-size:12px; margin-left:100px;">Compensatory</span>
            </div>
          </div>
        </div>


        {{-- Balance --}}
        <div class="col-sm-4 no-padding" style="border-left:solid 1px; height: 4em;">
          <span style="font-size:11px; font-weight:bold; margin-left: 180px;"></span>
          <div class="col-sm-12 no-padding" style="border-top:solid 1px;">

            <div class="col-sm-6" style="border-right:solid 1px; height: 2.6em; text-align: center;">
              <span style="font-size:11px;">EARNED</span>
            </div>

            <div class="col-sm-6 no-padding" style="border-right:solid 1px; height: 2.6em; text-align: center">
              <span style="font-size:11px;">BALANCE</span>
              <div class="col-sm-12 no-padding" style="border-top:solid 1px; margin:0;">
                <span style="font-size:11px;">{{ number_format($leave_ot_balance, 3)  }}</span>
              </div>
            </div>

          </div>
        </div>



      </div>
    </div>





    {{-- TABLE BODY --}}
    @foreach ($list_of_months as $key => $data)

      <?php

        $month = substr($key, 0, 2);
        $year = substr($key, -4);


        // Queries
        $leave_ot_sum = $employee->leaveCard()->getOvertime($month, $year)->sum('credits');
        $leave_mon_sum = $employee->leaveCard()->getMonitize($month, $year, 'OT')->sum('credits');
        $leave_com_sum = $employee->leaveCard()->getCompensatory($month, $year)->sum('credits');

        // Logic
        $gained = $leave_ot_sum ;
        $loss = $leave_mon_sum + $leave_com_sum;

        $earned = $gained - $loss;

        $leave_ot_balance = $earned + $leave_ot_balance;

      ?>

      <div class="row" style="margin:0;">
        <div class="col-sm-12 no-padding" style="border:solid 1px;">


          <div class="col-sm-2 no-padding" style="border-left:solid 1px;">
            <span style="font-size:11px; font-weight:bold; margin-left: 20px;">{{ $data }}</span>
          </div>


          {{-- Particulars  --}}
          <div class="col-sm-6 no-padding" style="border-left:solid 1px;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                <span style="font-size:12px;">
                  &nbsp;
                  @foreach($employee->leaveCard()->getOvertime($month, $year) as $data_ot)
                    {{ __dataType::date_parse($data_ot->date, 'd') }}
                    ,
                  @endforeach
                </span>
              </div>
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                <span style="font-size:12px;">
                  &nbsp;
                  @foreach($employee->leaveCard()->getMonitize($month, $year, 'OT') as $data_mon)
                    {{ __dataType::date_parse($data_mon->date, 'd') }}
                    ,
                  @endforeach
                </span>
              </div>
              <div class="col-sm-4 no-padding">
                <span style="font-size:12px;">
                  &nbsp;
                  @foreach($employee->leaveCard()->getCompensatory($month, $year) as $data_com)
                    {{ __dataType::date_parse($data_com->date, 'd') }}
                    ,
                  @endforeach
                </span>
              </div>
            </div>
          </div>


          {{-- Balance --}}
          <div class="col-sm-4 no-padding" style="border-left:solid 1px;">
            <div class="col-sm-12 no-padding">

              <div class="col-sm-6" style="border-right:solid 1px; text-align: center;">
                <span style="font-size:11px;">{{ number_format($earned, 3) }}</span>
              </div>

              <div class="col-sm-6" style="border-right:solid 1px; text-align: center;">
                <span style="font-size:11px;">{{ number_format($leave_ot_balance, 3) }}</span>
              </div>

            </div>
          </div>


        </div>
      </div>
      
    @endforeach


  </div>


</body>
</html>

