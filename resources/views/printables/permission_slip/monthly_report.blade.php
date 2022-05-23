<?php

  $df_header = __dataType::date_parse(Request::get('df'), 'F d, Y');
  $dt_header = __dataType::date_parse(Request::get('dt'), 'F d, Y');

  $df = __dataType::date_parse(Request::get('df'), 'Y-m-d');
  $dt = __dataType::date_parse(Request::get('dt'), 'Y-m-d');

  $df_YM = __dataType::date_parse(Request::get('df'), 'Y-m');

  $days = __dynamic::days_between_dates($df, $dt);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee Service Record</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}?s={{\Illuminate\Support\Str::random()}}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    /*table, th, td {*/
    /*  border: 1px solid black;*/
    /*  padding:5px;*/
    /*}*/

    @media print {
        .footer {
          page-break-after: always;
        }
    }



  </style>

</head>
{{--<body>--}}
<body onload="window.print();" onafterprint="window.close()">

  <div class="wrapper">
    <div style="width: 100%; overflow: auto">
      <div style="width: 50%; float: left">
        <p style="font-size: 17px;">SUGAR REGULATORY ADMINISTRATION</p>
      </div>
      <div style="width: 49%; float: right">
        <p style="font-size: 14px;" class="text-right">Page 1 of 1</p>
      </div>
    </div>
    <p style="font-size: 15px; font-weight:bold;">SUMMARY OF PERMISSION SLIPS (WITH FILED PS)</p>
    <p style="font-size: 15px; font-weight:bold;">{{ $department->name }}</p>
    <p style="font-size: 12px;">Period Covered {{ $df_header . '  To  ' . $dt_header }}</p>
{{--    <div class="row">--}}
{{--      <div class="col-sm-6">--}}
{{--        <p style="font-size: 17px;">SUGAR REGULATORY ADMINISTRATION</p>--}}
{{--      </div>--}}
{{--      <div class="col-sm-6">--}}
{{--        <span style="margin-left:450px;">Page 1 of 1</span>--}}
{{--      </div>--}}
{{--      <div class="col-sm-12">--}}
{{--        <p style="font-size: 15px; font-weight:bold;">SUMMARY OF PERMISSION SLIPS (WITH FILED PS)</p>--}}
{{--      </div>--}}
{{--      <div class="col-sm-12" style="margin-top: -5px;">--}}
{{--        <p style="font-size: 15px; font-weight:bold;">{{ $department->name }}</p>--}}
{{--      </div>--}}
{{--      <div class="col-sm-12" style="margin-top: -10px;">--}}
{{--        <p style="font-size: 12px;">Period Covered {{ $df_header . '  To  ' . $dt_header }}</p>--}}
{{--      </div>--}}
{{--    </div>--}}





    <table style="border: 1px solid black; font-size: 14px;" class="tbl-bordered tbl-padded">
      


      <tr>
        <th>Employee Name</th>
        @foreach($days as $data)
          <th>{{ $data }}</th>
        @endforeach  
        <th>Freq</th>
        <th>TOTAL</th>
      </tr>

      @foreach($employees as $data_emp)

        <?php

          $freq = 0;

        ?>

        <tr>

          <td style="width: 150px">{{ $data_emp->fullname }}</td>

          @foreach ($days as $data_days)

            <?php

              $table_data = '';
              $day_of_week = '';

              $total_hrs = 0;
              $total_mins = 0;

              $subtotal_hrs = 0;
              $subtotal_mins = 0;

              $monthly_ps = $data_emp->permissionSlip()->monthlyPS($df,$dt);
              $daily_ps = $data_emp->permissionSlip()->dailyPS($df_YM.'-'.$data_days);

            ?>

            <td>
              

              {{-- Daily PS --}}
              @foreach($daily_ps as $data_daily_ps)

                <?php

                  $start = Carbon::createFromFormat('H:i:s', $data_daily_ps->time_out);
                  $end = Carbon::createFromFormat('H:i:s', $data_daily_ps->time_in);

                  $start_H = __dataType::date_parse($start, 'H');
                  $end_H = __dataType::date_parse($end, 'H');

                  $daily_hrs = $end->diffInHours($start);
                  $daily_mins = $end->copy()->subHours($daily_hrs)->diffInMinutes($start);

                  $freq += 1;

                  if($start_H <= '12' && $end_H >= '13') {
                    
                    $daily_hrs = $daily_hrs - 1;

                  }

                  $subtotal_hrs += $daily_hrs;
                  $subtotal_mins += $daily_mins;

                  $table_data = __dataType::construct_time_HM($subtotal_hrs, $subtotal_mins); 



                ?>

                @if(count($daily_ps) >= 1)

                  @if($loop->last)
                    {{ $table_data }}
                    <?php unset($table_data) ?>
                    <?php unset($day_of_week) ?>
                  @endif

                @endif
                
              @endforeach




              {{-- Monthly PS --}}
              @foreach($monthly_ps as $data_monthly_ps)

                <?php

                  $date_YM = __dataType::date_parse($data_monthly_ps->date, 'Y-m');
                  $date_D = __dataType::date_parse($data_monthly_ps->date, 'd');
                  $date_YMD = Carbon::createFromFormat('Y-m-d', $date_YM .'-'. $data_days);

                  $start = Carbon::createFromFormat('H:i:s', $data_monthly_ps->time_out);
                  $end = Carbon::createFromFormat('H:i:s', $data_monthly_ps->time_in);

                  $start_H = __dataType::date_parse($start, 'H');
                  $end_H = __dataType::date_parse($end, 'H');

                  $monthly_hrs = $end->diffInHours($start);
                  $monthly_mins = $end->copy()->subHours($monthly_hrs)->diffInMinutes($start);

                  if($start_H <= '12' && $end_H >= '13') {
                    
                    $monthly_hrs = $monthly_hrs - 1;

                  }

                  $total_hrs += $monthly_hrs;
                  $total_mins += $monthly_mins;

                ?>

                @if($date_YMD->format( 'D' ) == 'Sun')
                  <?php $day_of_week = 'SUN'; ?>
                @elseif($date_YMD->format( 'D' ) == 'Sat')
                  <?php $day_of_week = 'SAT'; ?>
                @elseif(isset($table_data))
                  <?php $table_data = '00:00'; ?>
                @endif

              @endforeach


              {{-- Setting of Table Data --}}
              {{ isset($table_data) ? $table_data : '' }}
              {{ isset($day_of_week) ? $day_of_week : '' }}


            </td>

          @endforeach
          
          <td style="text-align:center;"><b>{{ $freq }}</b></td>
          <td><b>{{ __dataType::construct_time_HM($total_hrs, $total_mins) }}</b></td>

        </tr>

      @endforeach



    </table>


  </div>

</body>
</html>

