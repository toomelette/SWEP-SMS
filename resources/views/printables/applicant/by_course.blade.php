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

  </style>

</head>


<body onload="window.print();" onafterprint="window.close()">

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


        {{-- <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">
          <span style="font-weight: bold;">EMPLOYEE ALPHALIST</span><br>
          <span>As of {{ Carbon::now()->format('F Y') }}</span><br>
        </div> --}}


      </div>

    <br>



    {{-- TABLE HEADER --}}

    <div class="row" style="margin:0px;">

      <div class="col-sm-12" style="border:solid 1px; -webkit-print-color-adjust: exact; background-color: #65D165 !important;">


        {{-- 1st div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-1 no-padding" style="text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">No.</span>
          </div>

          <div class="col-sm-5 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Name</span>
          </div>

          <div class="col-sm-6 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Address</span>
          </div>
          
        </div>

        {{-- 2nd div --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">

          <div class="col-sm-2 no-padding" style="text-align: center;">
            <span style="font-size:12px; font-weight:bold;">Civil Status</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Gender</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Age</span>
          </div>

          <div class="col-sm-6 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Birthdate</span>
          </div>
          
        </div>

        {{-- 3rd div --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">

          <div class="col-sm-3 no-padding" style="text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Contact No.</span>
          </div>

          <div class="col-sm-3 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Eligibility</span>
          </div>

          <div class="col-sm-6 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Educational Qualifications</span>
          </div>
          
        </div>

        {{-- 4th div --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">

          <div class="col-sm-3 no-padding" style="text-align:center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">School</span>
          </div>

          <div class="col-sm-5 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Work Experience</span>
          </div>

          <div class="col-sm-4 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:12px; font-weight:bold;">Remarks</span>
          </div>
          
        </div>


      </div>

    </div>


    {{-- TABLE BODY --}}

    @foreach ($applicants as $key => $data)

      <div class="col-sm-12" style="border:solid 1px;">

        {{-- 1st div --}}
        <div class="col-sm-3 no-padding">

          <div class="col-sm-1 no-padding" style="text-align: center; line-height: 40px;">
            <span style="font-size:11px; ">{{ $key + 1 }}</span>
          </div>

          <div class="col-sm-5 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ $data->lastname }}</span>
          </div>

          <div class="col-sm-6 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ $data->address }}</span>
          </div>
          
        </div>

        {{-- 2nd div --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">

          <div class="col-sm-2 no-padding" style="text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ $data->civil_status }}</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ $data->gender }}</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ Carbon::parse($data->date_of_birth)->age }}</span>
          </div>

          <div class="col-sm-6 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ Carbon::parse($data->date_of_birth)->format("F d,y") }}</span>
          </div>
          
        </div>

        {{-- 3rd div --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">

          <div class="col-sm-3 no-padding" style="text-align: center; line-height: 40px;">
            <span style="font-size:11px;">{{ $data->contact_no }}</span>
          </div>

          <div class="col-sm-3 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">Eligibility</span>
          </div>

          <div class="col-sm-6 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">Educational Qualifications</span>
          </div>
          
        </div>

        {{-- 4th div --}}
        <div class="col-sm-3 no-padding" style="border-left:solid 1px;">

          <div class="col-sm-3 no-padding" style="text-align:center; line-height: 40px;">
            <span style="font-size:11px;">School</span>
          </div>

          <div class="col-sm-5 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">Work Experience</span>
          </div>

          <div class="col-sm-4 no-padding" style="border-left:solid 1px; text-align: center; line-height: 40px;">
            <span style="font-size:11px;">Remarks</span>
          </div>
          
        </div>

      </div>

    @endforeach

  </div>



</body>
</html>

