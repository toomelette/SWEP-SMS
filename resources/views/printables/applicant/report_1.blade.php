<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Seminars and Trainings</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arial">

  <style type="text/css">

    @media print {
        .footer {
          page-break-after: always;
        }
    }

    table, td {

      border: 1px solid black;

    }

    thead{

      -webkit-print-color-adjust: exact; 
      background-color: #65D165 !important;

    }

    .data-row-head{

      text-align: center;
      padding:5px;
      font-size:11px;
      font-weight: bold;
      
    }

    .data-row-body{

      text-align: center;
      padding:5px;
      font-size:9px;
      
    }

  </style>

</head>


<body onload="window.print();" onafterprint="window.close()" style="padding-right: 100px;">

    {{-- HEADER --}}

    <div class="row">  

      <div class="col-sm-2"></div>


      <div class="col-sm-8">

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


      <div class="col-sm-2"></div>


      <div class="col-sm-12" style="padding-bottom:10px;"></div>



      @if(Request::get('r_type') == "ABC")

        <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">
          <span style="font-weight: bold;">
            @if (Request::get('lt') == "FL")
              FULL LIST OF
            @elseif(Request::get('lt') == "SL")
              SHORT LIST OF
            @else
              &nbsp;
            @endif
             {{ $course->name }} APPLICANTS
          </span><br>
          <span>As of {{ Carbon::now()->format("F d,Y") }}</span><br>
        </div>

      @elseif(Request::get('r_type') == "ABU")

        <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">
          <span style="font-weight: bold;">
            @if (Request::get('lt') == "FL")
              FULL LIST OF
            @elseif(Request::get('lt') == "SL")
              SHORT LIST OF
            @else
              &nbsp;
            @endif
             OF APPLICANTS FOR {{ $dept_unit->description }}
          </span><br>
          <span>As of {{ Carbon::now()->format("F d,Y") }}</span><br>
        </div>

      @else

        &nbsp;

      @endif

    </div>



    <br>

    <table style="border:solid 1px;">
        
      <thead>
          
        <td class="data-row-head">No.</td>
        <td class="data-row-head" style="width:150px;">Name</td>
        <td class="data-row-head" style="width:150px;">Address</td>
        <td class="data-row-head">Civil Status</td>
        <td class="data-row-head">Gender</td>
        <td class="data-row-head">Age</td>
        <td class="data-row-head">Birthdate</td>
        <td class="data-row-head" style="width:80px;">Contact No.</td>
        <td class="data-row-head" style="width:150px;">Eligibility</td>
        <td class="data-row-head" style="width:150px;">Course</td>
        <td class="data-row-head" style="width:150px;">School</td>
        <td class="data-row-head" style="width:150px;">Work Experience</td>
        <td class="data-row-head">Remarks</td>

      </thead>

      @foreach ($applicants as $key => $data)

        <tbody>
                
          <td class="data-row-body">{{ $key + 1 }}</td>
          <td class="data-row-body">{{ $data->fullname }}</td>
          <td class="data-row-body">{{ $data->address }}</td>
          <td class="data-row-body">{{ $data->civil_status }}</td>
          <td class="data-row-body">{{ $data->gender }}</td>
          <td class="data-row-body">{{ Carbon::parse($data->date_of_birth)->age }}</td>
          <td class="data-row-body">{{ Carbon::parse($data->date_of_birth)->format("F d,Y") }}</td>
          <td class="data-row-body" style="word-break: break-all;">{{ $data->contact_no }}</td>
          <td style="padding:5px; font-size:9px;">
            @foreach ($data->applicantEligibility as $data_elig)
              &#8226; <b>{{ $data_elig->eligibility }}</b> - {{ $data_elig->rating }} <br>
            @endforeach
          </td>
          <td class="data-row-body">{{ !empty($data->course) ? $data->course->name : 'N/A' }}</td>
          <td class="data-row-body">{{ $data->school }}</td>
          <td style="padding:5px; font-size:9px;">
            @foreach ($data->applicantExperience as $data_exp)
              &#8226; <b>{{ $data_exp->position }}</b> - {{ $data_exp->company }} <br>
            @endforeach
          </td>
          <td class="data-row-body">{{ $data->remarks }}</td>

        </tbody>

      @endforeach

    </table>



    <div class="row" style="margin-top: 50px;">
      <div class="col-sm-6">
        <span style="font-size:11px;">PREPARED BY:</span>
      </div>
      <div class="col-sm-6">
        <span style="font-size:11px;">NOTED BY:</span>
      </div>
    </div>



    <div class="row" style="margin-top: 30px;">
      <div class="col-sm-2">
        &nbsp;
      </div>
      <div class="col-sm-3" style="border-bottom:1px solid; text-align: center;">
        <span style="font-size:11px; font-weight: bold;">{{ Request::get('pn') }}</span>
      </div>
      <div class="col-sm-1">
        &nbsp;
      </div>
      <div class="col-sm-2" >
      </div>
      <div class="col-sm-3" style="border-bottom:1px solid; text-align: center;">
        <span style="font-size:11px; font-weight: bold;">{{ Request::get('nn') }}</span>
      </div>
      <div class="col-sm-1">
        &nbsp;
      </div>
    </div>



    <div class="row">
      <div class="col-sm-2">
        &nbsp;
      </div>
      <div class="col-sm-3" style="text-align: center;">
        <span style="font-size:10px;">{{ Request::get('pd') }}</span>
      </div>
      <div class="col-sm-1">
        &nbsp;
      </div>
      <div class="col-sm-2" >
      </div>
      <div class="col-sm-3" style="text-align: center;">
        <span style="font-size:10px;">{{ Request::get('nd') }}</span>
      </div>
      <div class="col-sm-1">
        &nbsp;
      </div>
    </div>
    

  </body>
</html>

