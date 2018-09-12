@php

  $df_header = Carbon::parse(Request::get('df'))->format('F d, Y');
  $dt_header = Carbon::parse(Request::get('dt'))->format('F d, Y');

  $df = Carbon::parse(Request::get('df'))->format('Y-m-d');
  $dt = Carbon::parse(Request::get('dt'))->format('Y-m-d');

@endphp

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

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    table, th, td {
      border: 1px solid black;
      padding:5px;
    }

    @media print {
        .footer {
          page-break-after: always;
        }
    }

  </style>

</head>
<body onload="//window.print();" onafterprint="window.close()">

  <div class="wrapper">

    <div class="row">
      <div class="col-sm-12">
        <p style="font-size: 17px;">SUGAR REGULATORY ADMINISTRATION</p>
      </div>
      <div class="col-sm-12">
        <p style="font-size: 15px; font-weight:bold;">SUMMARY OF PERMISSION SLIPS (WITH FILED PS)</p>
      </div>
      <div class="col-sm-12" style="margin-top: -5px;">
        <p style="font-size: 15px; font-weight:bold;">{{ $department->name }}</p>
      </div>
      <div class="col-sm-12" style="margin-top: -10px;">
        <p style="font-size: 12px;">Period Covered {{ $df_header . '  To  ' . $dt_header }}</p>
      </div>
    </div>





    <table style="border: 1px solid black;">
      


      <tr>
        <th>Employee Name</th>
        @foreach(StaticHelper::days() as $data)
          <th>{{ $data }}</th>
        @endforeach  
      </tr>



      @foreach($employees as $data_emp)

        <tr>

          <td>{{ $data_emp->fullname }}</td>

          @foreach(StaticHelper::days() as $data_days)
            
            <?php

              $date = '';
              $monthly_ps = $data_emp->permissionSlip()->monthlyPS($df,$dt);
            ?>

            @foreach( as $data_ps)

              <?php
                $date = DataTypeHelper::date_parse($data_ps->date, 'd');
                $from = Carbon::createFromFormat('H:i:s', $data_ps->time_out);
                $to = Carbon::createFromFormat('H:i:s', $data_ps->time_in);
                $hrs = $to->diffInHours($from);
                $mins = $to->copy()->subHours($hrs)->diffInMinutes($from);
              ?>

              @if($data_days == $date)

                <td>{{ $hrs .':'. $mins }}</td>

              @endif

            @endforeach

            <?php

              $date

            ?>

          @endforeach
        
        </tr>

      @endforeach



    </table>





  </div>

</body>
</html>

