<?php

 $month_name = date("F", mktime(0, 0, 0, Request::get('m'), 10));
 $month = Request::get('m');
 $year = Request::get('y');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>List of Absences and Tardiness</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    th{
      -webkit-print-color-adjust: exact; 
      background-color: #65D165 !important;
    }

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

<body onload="window.print();" onafterprint="window.close()">

  <?php

    $total = ceil(count($employees) / 35);
    $start = 0;
    $end = 34;
    
  ?>

  @for ($i = 0; $i < $total; $i++)
  
    <?php

      if($i >= 1){

        $start = $start + 35;
        $end = $end + 35;

      }

    ?>

    <div class="wrapper" style="overflow:hidden !important;">

      <div class="row" style="text-align: center;">
        <div class="col-sm-12">
          <p style="font-size: 15px;">
            SUGAR REGULATORY ADMINISTRATION
            <br>LIST OF ABSENCES AND TARDINESS OF SRA VISAYAS EMPLOYEES
            <br>{{ $month_name .', '. $year }}
          </p>
        </div>
      </div>


      <table style="border: 1px solid black; font-size: 9px;">
        
        <tr>
          <th style="text-align:center;">Fullname</th>
          <th>Department</th>
          <th>Position</th>   
          <th style="text-align:center; width:200px;">ABSENT/ONLEAVE</th>
          <th style="text-align:center;">TARDY</th>
          <th style="text-align:center;">UNDERTIME</th>
        </tr>

        @foreach ($employees as $key => $data)

          @if($key >= $start && $key <= $end)

            <?php 

              $key = $key + 1; 
              $leave_list = $data->leaveCard()->getLeave($month, $year);

            ?>

            <tr> 
              <td>{!! $key .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $data->fullname !!}</td>
              <td>{{ empty($data->department) ? '' : $data->department->name }}</td>
              <td>{{ $data->position }}</td>
              <td style="text-align:center;">

                @if(count($leave_list) > 0)

                  @foreach ($leave_list as $data_leave)
                    
                    <?php
                      
                      $date_from_day = __dataType::date_parse($data_leave->date_from, 'd');
                      $date_to_day = __dataType::date_parse($data_leave->date_to, 'd');

                    ?>
                    
                    @if($data_leave->days > 1)

                      {{ $data_leave->leave_type .'('. $date_from_day .' - '. $date_to_day .')'}}

                    @elseif($data_leave->days == 1)

                      {{ $data_leave->leave_type .'('. $date_from_day .')'}}

                    @endif
                    ,
                  @endforeach

                @else
                  0
                @endif
              
              </td>
              <td style="text-align:center;">{{ $data->leaveCard()->getTardy($month, $year)->count() }}</td>
              <td style="text-align:center;">{{ $data->leaveCard()->getUndertime($month, $year)->count() }}</td>
            </tr>

          @endif

        @endforeach

      </table>

    </div>


  @endfor


</body>
</html>

