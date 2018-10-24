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
      background-color: #7BB7DF !important;
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
            
        <span style="font-weight: bold;">Number of Personel Negros and Panay</span><br>
        <span>As of {{ Carbon::now()->format('F Y') }}</span><br>

      </div>

    </div>


    <table style="border: 1px solid black; font-size: 9px; margin-left:40px;">
        
      <?php

        $total_male = 0;
        $total_female = 0;

      ?>

      <tr>
        <th style="width:200px;">Unit</th>
        <th style="width:150px; text-align: center;">Male</th>
        <th style="width:150px; text-align: center;">Female</th>
        <th style="width:150px; text-align: center;">Total</th>
      </tr>

      @foreach ($dept_units as $data)
        <?php

          $count_male = $data->employee()->countBySexAndDeptUnit($data->department_unit_id, 'M');
          $count_female = $data->employee()->countBySexAndDeptUnit($data->department_unit_id, 'F');
          $count_every_unit = $data->employee()->countByDeptUnit($data->department_unit_id);

          $total_male += $count_male;
          $total_female += $count_female;

        ?>
        <tr> 
          <td>{{ $data->description }}</td>
          <td style="text-align: center;">{{ $count_male }}</td>
          <td style="text-align: center;">{{ $count_female }}</td>
          <td style="text-align: center;">{{ $data->employee()->countByDeptUnit($data->department_unit_id) }}</td>
        </tr>

      @endforeach

      <tr> 
        <td style="font-weight:bold;">TOTAL : </td>
        <td style="text-align: center; font-weight:bold;">{{ $total_male }}</td>
        <td style="text-align: center; font-weight:bold;">{{ $total_female }}</td>
        <td style="text-align: center; font-weight:bold;">{{ $total_male + $total_female }}</td>
      </tr>

    </table>

  </div>

</body>
</html>

