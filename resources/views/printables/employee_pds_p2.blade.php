<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee PDS</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">

  <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/print.css') }}">

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

    @media print{

    	.col-pds-1 {
        	width: 14.25%;
        	float: left;
   		}

    	.col-pds-2 {
        	width: 28.5%;
        	float: left;
   		}

   		.col-pds-8 {
        	width: 43%;
        	float: left;
   		}

   		.col-pds-10 {
        	width: 71.5%;
        	float: left;
   		}

    }

  </style>

</head>
<body onload="window.print();" onafterprint="window.close()">

<div style="border:solid;">
  <div class="wrapper" style="overflow:hidden !important;">

    {{-- ELIGIBILITY --}}
    <div class="row box-d-grey" style="border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">IV.  CIVIL SERVICE ELIGIBILITY</span>
      </div>
    </div>

    {{-- ELIGIBILITY Header --}}
    <div class="row" style="border-bottom:solid 1px;">

      <div class="col-sm-4 box-l-grey" style="border-right:solid 1px;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-2">
            <span style="font-size:8px;">27.</span>
          </div>
          <div class="col-sm-10" style="text-align: center;">
            <p style="font-size:8px; margin-top:7px;"> CAREER SERVICE/ RA 1080 (BOARD/ BAR) UNDER SPECIAL LAWS/ CES/ CSEE BARANGAY ELIGIBILITY / DRIVER'S LICENSE</p>
          </div>
        </div>
      </div>

      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:16px; padding-bottom:12px;">RATING<br>(If Applicable)</p>
      </div>

      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:12px; padding-bottom:5px;">DATE OF EXAMINATION / CONFERMENT</p>
      </div>

      <div class="col-sm-4 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:9px; text-align: center; padding-top:25px; padding-bottom:14px;">PLACE OF EXAMINATION / CONFERMENT</p>
      </div>

      <div class="col-sm-2 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:7px;">LICENSE (if applicable)</p>
        <div class="col-sm-12 no-padding" style="border-top: solid 1px; margin-bottom: -9px;">
          <div class="col-sm-6" style="border-right:solid 1px;">
            <p style="font-size:8px; text-align: center; padding-top:10px; padding-bottom: 9px;">NUMBER</p>
          </div>
          <div class="col-sm-6">
            <p style="font-size:8px; text-align: center; padding-top:2px; padding-right:7px;">Date of Validity</p>
          </div>
        </div>
      </div>

    </div>

    {{-- ELIGIBILITY Content --}}

    @foreach ($employee->employeeEligibility as $key => $data)
      @if($key <= 9)
        <div class="row" style="border-bottom:solid 1px;">

          <div class="col-sm-4" style="border-right:solid 1px;">
              <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ $data->eligibility }}</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ $data->rating != 0 ? $data->rating : '' }}</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ __dataType::date_parse($data->exam_date, 'm/d/Y') }}</span>
          </div>

          <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ $data->exam_place }}</span>
          </div>

          <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
            <div class="col-sm-12 no-padding" style="margin-bottom: -9px;">
              <div class="col-sm-6 no-padding" style="border-right:solid 1px;">
                <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ $data->license_no }}</span>
              </div>
              <div class="col-sm-6 no-padding">
                <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ __dataType::date_parse($data->license_validity, 'm/d/Y') }}</span>
              </div>
            </div>
          </div>

        </div>
      @endif
    @endforeach

    @if(count($employee->employeeEligibility) < 10)

      <?php 
        $diff = 10 - count($employee->employeeEligibility); 
      ?>

      @for ($i = 0; $i < $diff; $i++)

        <div class="row" style="border-bottom:solid 1px;">

          <div class="col-sm-4" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
          <div class="col-sm-12 no-padding" style="margin-bottom: -9px;">
            <div class="col-sm-6 no-padding" style="border-right:solid 1px;">
              &nbsp;
            </div>
            <div class="col-sm-6 no-padding">
              &nbsp;
            </div>
          </div>
          </div>

        </div>

      @endfor

    @endif

    <div class="row box-l-grey no-padding" style="border-bottom:solid 2px;">
      <div class="col-sm-12 no-padding">
        <p style="font-size: 7px; text-align: center; color:red !important; font-style: italic; -webkit-print-color-adjust: exact; margin-bottom: 1px">
        	(Continue on a seperate sheet if necessary)
    	</p>
      </div>
    </div>




    {{-- Work Experience --}}
    <div class="row box-d-grey" style="border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">V.  WORK EXPERIENCE </span>
      </div>
    </div>

    <div class="row box-d-grey" style="border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span style="-webkit-print-color-adjust: exact; color: #ffffff !important; font-style:italic;  font-size: 10px; font-weight: bold;">
          (Include private employment.  Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.
        </span>
      </div>
    </div>

    {{-- Work Experience Header --}}
    <div class="row" style="border-bottom:solid 1px;">

      <div class="col-sm-2 box-l-grey no-padding" style="border-right:solid 1px;">
        <div class="col-sm-12">
          <div class="col-sm-2 no-padding">
            <span style="font-size:7px; padding-left: 3px;">28.</span>
          </div>
          <div class="col-sm-10 no-padding" style="text-align: center;">
            <p style="font-size:7px; margin-top:7px;"> INCLUSIVE DATES (mm/dd/yyyy)</p>
          </div>
        </div>
        <div class="col-sm-12" style="border-top:solid 1px;">
          <div class="col-sm-6" style="border-right:solid 1px;  text-align: center; padding-bottom: 2px;">
            <span style="font-size:8px;">FROM</span>
          </div>
          <div class="col-sm-6" style="text-align: center;">
            <span style="font-size:8px;">TO</span>
          </div>
        </div>
      </div>

      <div class="col-sm-3 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:16px; padding-bottom:12px;">POSITION TITLE<br>(Write in full/Do not abbreviate)</p>
      </div>

      <div class="col-sm-3 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:16px; padding-bottom:12px;">DEPARTMENT / AGENCY / OFFICE / COMPANY<br>(Write in full/Do not abbreviate)</p>
      </div>

      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:17px; padding-bottom:11px;">MONTHLY SALARY</p>
      </div>

      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:6.5px; text-align: center; padding-top:2px; padding-bottom:3px;">SALARY/ JOB/ PAY GRADE (if applicable)& STEP  (Format "00-0")/ INCREMENT</p>
      </div>

      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:7px; text-align: center; padding-top:17px; padding-bottom:13px;">STATUS OF APPOINTMENT</p>
      </div>

      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:7px; text-align: center; padding-top:10px; padding-bottom:10px; padding-right:10px;">GOV'T <br>SERVICE<br>(Y/N)</p>
      </div>

    </div>

    {{-- Work Experience Content --}}

    @foreach ($employee->employeeExperience as $key => $data)
      @if($key <= 24)
        <div class="row" style="border-bottom:solid 1px;">

          <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
            <div class="col-sm-12">
              <div class="col-sm-6 no-padding" style="border-right:solid 1px; text-align: center;">
                <span style="font-size:8px; font-weight: bold;">{{ __dataType::date_parse($data->date_from, 'm/d/Y') }}</span>
              </div>
              <div class="col-sm-6 no-padding" style="text-align: center;">
                <span style="font-size:8px; font-weight: bold;">{{ __dataType::date_parse($data->date_to, 'm/d/Y') }}</span>
              </div>
            </div>
          </div>

          <div class="col-sm-3 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight: bold; padding-left: 3px;">{{ $data->position }}</span>
          </div>

          <div class="col-sm-3 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight: bold; padding-left: 3px;">{{ $data->company }}</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight: bold; padding-left: 3px;">{{ number_format($data->salary, 2) }}</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight: bold; padding-left: 3px;">{{ $data->salary_grade }}</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight: bold; padding-left: 3px;">{{ $data->appointment_status }}</span>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight: bold; padding-left: 3px;">{{ $data->is_gov_service == 1 ? 'Y' : 'N' }}</span>
          </div>

        </div>
      @endif
    @endforeach

    @if(count($employee->employeeExperience) < 25)

      <?php 
        $diff = 25 - count($employee->employeeExperience); 
      ?>

      @for ($i = 0; $i < $diff; $i++)

        <div class="row" style="border-bottom:solid 1px;">

          <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
            <div class="col-sm-12">
              <div class="col-sm-6" style="border-right:solid 1px;  text-align: center;">
                &nbsp;
              </div>
              <div class="col-sm-6" style="text-align: center;">
                &nbsp;
              </div>
            </div>
          </div>

          <div class="col-sm-3 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-3 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

        </div>

      @endfor

    @endif


    <div class="row box-l-grey no-padding" style="border-bottom:solid 2px;">
      <div class="col-sm-12 no-padding">
        <p style="font-size: 7px; text-align: center; color:red !important; font-style: italic; -webkit-print-color-adjust: exact; margin-bottom: 1px">
          (Continue on a seperate sheet if necessary)
      </p>
      </div>
    </div>


    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
      	<span style="font-size:11px; text-align: center; padding-left: 23px;">SIGNATURE</span>
      </div>
      <div class="col-sm-7" style="border-right:solid 1px;">
        &nbsp;
      </div>
      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <span style="font-size:11px; text-align: center; padding-left: 18px;">DATE</span>
      </div>
      <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
        &nbsp;
      </div>
    </div>

  </div>
</div>

<div class="row">
	<div class="col-sm-12 no-padding" style="border-right:solid 1px;">
		<p class="pull-right" style="font-size:8px; padding-right: 20px;">CS FORM 212 (Revised 2017), Page 2 of 4</p>
	</div>
</div>



</body>
</html>

