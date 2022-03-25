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

      <div class="row">

        <div class="col-sm-1"></div>

        <div class="col-sm-12">

            <div class="col-sm-2"></div>

            <div class="col-sm-1 no-padding">
              <img src="{{ asset('images/sra.png') }}" style="width:100%;">
            </div>

            <div class="col-sm-8" style="text-align: center; padding-right:125px;">
              <span>Republic of the Philippines</span><br>
              <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
              <span>North Avenue, Diliman, Quezon City</span>
            </div>

        </div>

        <div class="col-sm-1"></div>

        <div class="col-sm-12" style="padding-bottom:10px;"></div>

        <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">

          <span style="font-weight: bold;">EMPLOYEE ALPHALIST</span><br>
          <span>As of {{ Carbon::now()->format('F Y') }}</span><br>

        </div>

      </div>


      <table style="border: 1px solid black; font-size: 9px;">

        <tr>
          <th style="text-align:center;">Fullname</th>
          <th>Position</th>
          <th>Unit</th>
          <th>Salary</th>
          <th style="text-align:center; width:150px;"></th>
        </tr>

        @foreach ($employees as $key => $data)

          @if($key >= $start && $key <= $end)

            <?php

              $key = $key + 1;

            ?>

            <tr>
              <td>{!! $key .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $data->fullname !!}</td>
              <td>{{ $data->position }}</td>
              <td>{{ empty($data->departmentUnit) ? '' : $data->departmentUnit->description }}</td>
              <td style="text-align: right">
                @if(\App\Swep\Helpers\Helper::sqlServerIsOn() === true)
                  {{(!empty($data->empMaster)) ? number_format($data->empMaster->MonthlyBasic,2) : 'NO PAYROLL DATA'}}
                @else
                  {{$data->monthly_basic}}
                @endif
              </td>
              <td style="text-align:center;">
              </td>
            </tr>

          @endif

        @endforeach

      </table>

    </div>


  @endfor


</body>
</html>

