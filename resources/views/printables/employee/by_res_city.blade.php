<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>List of Employees by Residency</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    th{
      -webkit-print-color-adjust: exact; 
      background-color: #fbd473 !important;
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
          
      <span style="font-weight: bold;">EMPLOYEES BY RESIDENCY</span><br>
      <!-- <span>As of {{ Carbon::now()->format('F Y') }}</span><br> -->

    </div>

  </div>

  <?php
    $by_city = [];


  ?>

  @foreach($employees as $employee)

    <?php
      if(!isset($by_city[$employee->employeeAddress->res_address_city][$employee->employee_no])){
        $by_city[$employee->employeeAddress->res_address_city][$employee->employee_no] = $employee;
      }else{

    }

    ksort($by_city);
    ?>

  @endforeach

  <?php
  //print("<pre>".print_r($by_city, true)."</pre>");
  ?>
  
  @foreach($by_city as $key=>$employee)
    <div style="padding-bottom: 20px; ">

      <div class="col-sm-12" style="padding-bottom:7px;">
        <span style="font-weight: bold; font-size: 13px;">{{$key}}</span>
      </div>

      <table style="border: 1px solid black; font-size: 9px; width: 100%" >
        
        <tr>
          <th style="text-align:center; width:200px;">Name of Employee</th>
          <th style="text-align:center; width:200px;">Position</th>
          <th style="text-align:center; width:150px;">Complete Address</th>
        </tr>

        @foreach ($employee as $key => $data)

          @if ($data->is_active == 'ACTIVE')
            
            <tr>
              <td>{{ $data->fullname }}</td>
              <td>{{ $data->position }}</td>
              <td>
                @if($data->employeeAddress->res_address_block != NULL)
                  {{ $data->employeeAddress->res_address_block }},
                @endif
                
                @if($data->employeeAddress->res_address_street != NULL)
                  {{ $data->employeeAddress->res_address_street }},
                @endif

                @if($data->employeeAddress->res_address_village != NULL)
                  {{ $data->employeeAddress->res_address_village }},
                @endif

                @if($data->employeeAddress->res_address_barangay != NULL AND $data->employeeAddress->res_address_barangay != 'N/A')
                  {{ $data->employeeAddress->res_address_barangay }},
                @endif

                {{ $data->employeeAddress->res_address_city }}

              </td>
            </tr>

          @endif

        @endforeach


      </table>
    </div>
  @endforeach

  <div class="footer">
    
  </div>


</body>
</html>

