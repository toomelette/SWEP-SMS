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

    .data-row{

      border-left:solid 1px; 
      text-align: center; 
      margin-bottom: -200px; 
      padding-bottom: 200px;
      
    }

    .p-header{

      font-size:12px; 
      font-weight:bold;
      padding-top: 5px;
      
    }

    .p-body{

      font-size:10px;
      padding-top: 5px;
      
    }

  </style>

</head>


<body onload="window.print();" onafterprint="window.close()" style="padding-right:20px;">

  <div class="wrapper" style="overflow:hidden !important;">



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
              Full List of
            @elseif(Request::get('lt') == "SL")
              Short List of
            @else
              &nbsp;
            @endif
             {{ $course->name }} Applicants
          </span><br>
          <span>As of {{ Carbon::now()->format("F d,Y") }}</span><br>
        </div>

      @elseif(Request::get('r_type') == "ABU")

        <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">
          <span style="font-weight: bold;">
            @if (Request::get('lt') == "FL")
              Full List of
            @elseif(Request::get('lt') == "SL")
              Short List of
            @else
              &nbsp;
            @endif
             of Applicants for {{ $dept_unit->description }}
          </span><br>
          <span>As of {{ Carbon::now()->format("F d,Y") }}</span><br>
        </div>

      @else

        &nbsp;

      @endif

    </div>



    <br>



    {{-- TABLE HEADER --}}

    <div class="row" style="margin:0px;">

      <div class="col-sm-12" style="border:solid 1px; -webkit-print-color-adjust: exact; background-color: #65D165 !important; overflow: hidden;">


        {{-- 1st div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-1 no-padding" style="text-align: center;">
            <p class="p-header">No.</p>
          </div>

          <div class="col-sm-6 data-row">
            <p class="p-header">Name</p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-header">Address</p>
          </div>
          
        </div>

        {{-- 2nd div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-3 data-row">
            <p class="p-header">Civil Status</p>
          </div>

          <div class="col-sm-2 data-row">
            <p class="p-header" style="margin-left:-10px;">Gender</p>
          </div>

          <div class="col-sm-2 data-row">
            <p class="p-header">Age</p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-header">Birthdate</p>
          </div>
          
        </div>

        {{-- 3rd div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-3 data-row">
            <p class="p-header">Contact No.</p>
          </div>

          <div class="col-sm-4 data-row">
            <p class="p-header">Eligibility</p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-header">Course</p>
          </div>
          
        </div>

        {{-- 4th div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-3 data-row">
            <p class="p-header">School</p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-header">Work Experience</p>
          </div>

          <div class="col-sm-4 data-row">
            <p class="p-header">Remarks</p>
          </div>
          
        </div>


      </div>

    </div>




    {{-- TABLE BODY --}}

    @foreach ($applicants as $key => $data)

      <div class="col-sm-12" style="border:solid 1px; overflow: hidden;">

        {{-- 1st div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-1 no-padding" style="text-align: center;">
            <p class="p-body">{{ $key + 1 }}</p>
          </div>

          <div class="col-sm-6 data-row">
            <p class="p-body">{{ $data->fullname }}</p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-body">{{ $data->address }}</p>
          </div>
          
        </div>

        {{-- 2nd div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-3 data-row">
            <p class="p-body">{{ $data->civil_status }}</p>
          </div>

          <div class="col-sm-2 data-row">
            <p class="p-body">{{ $data->gender }}</p>
          </div>

          <div class="col-sm-2 data-row">
            <p class="p-body">{{ Carbon::parse($data->date_of_birth)->age }}</p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-body">{{ Carbon::parse($data->date_of_birth)->format("F d,Y") }}</p>
          </div>
          
        </div>

        {{-- 3rd div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-3 data-row">
            <p class="p-body" style="margin-left: -7px;">{{ $data->contact_no }}</p>
          </div>

          <div class="col-sm-4" style="border-left:solid 1px; margin-bottom: -200px; padding-bottom: 200px;">
            <p class="p-body" style="margin-left: -7px;">
              @foreach ($data->applicantEligibility as $data_elig)
                &#8226; <b>{{ $data_elig->eligibility }}</b> - {{ $data_elig->rating }} <br>
              @endforeach
            </p>
          </div>

          <div class="col-sm-5 data-row">
            <p class="p-body">{{ !empty($data->course) ? $data->course->name : 'N/A' }}</p>
          </div>
          
        </div>

        {{-- 4th div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-3 data-row">
            <p class="p-body">{{ $data->school }}</p>
          </div>

          <div class="col-sm-5" style="border-left:solid 1px; margin-bottom: -200px; padding-bottom: 200px;">
            <p class="p-body">
              @foreach ($data->applicantExperience as $data_exp)
                &#8226; <b>{{ $data_exp->position }}</b> - {{ $data_exp->company }} <br>
              @endforeach
            </p>
          </div>

          <div class="col-sm-4 data-row">
            <p class="p-body">{{ $data->remarks }}</p>
          </div>
          
        </div>

      </div>

    @endforeach

  </div>



</body>
</html>

