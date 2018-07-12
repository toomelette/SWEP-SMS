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



    {{-- CHILDREN --}}
    @if(count($employee->employeeChildren) > 11)

      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l">CHILDREN</span>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px;">
          <span style="font-size:7px;">&nbsp; NAME of CHILDREN (Write full name and list all)</span>
        </div>
        <div class="col-sm-5 box-l-grey" style="border-bottom:solid 1px;">
          <span style="font-size:7px;">&nbsp; DATE OF BIRTH (mm/dd/yyyy)</span>
        </div>
        @foreach ($employee->employeeChildren as $key => $data)
          @if($key > 10)
            <div class="col-sm-7" style="border-right:solid 1px; border-bottom:solid 1px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 2px;">{{ $data->fullname }}</span>
            </div>
            <div class="col-sm-5" style="border-bottom:solid 1px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 2px;">{{ DataTypeHelper::date_out($data->date_of_birth, 'm/d/Y') }}</span>
            </div>
          @endif
        @endforeach
      </div>

    @endif





    {{-- ELIGIBILITY --}}
    @if(count($employee->employeeEligibility) > 10)

      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l"> CIVIL SERVICE ELIGIBILITY</span>
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
        @if($key > 9)
          <div class="row" style="border-bottom:solid 1px;">

            <div class="col-sm-4" style="border-right:solid 1px;">
                <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ $data->eligibility }}</span>
            </div>

            <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
              <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ $data->rating }}</span>
            </div>

            <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
              <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ DataTypeHelper::date_out($data->exam_date, 'm/d/Y') }} </span>
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
                  <span style="font-size:8px; padding-left: 3px; font-weight: bold;"> {{ DataTypeHelper::date_out($data->license_validity, 'm/d/Y') }}</span>
                </div>
              </div>
            </div>

          </div>
        @endif
      @endforeach

    @endif





    {{-- Work Experience --}}
    @if(count($employee->employeeExperience) > 25)

      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l">WORK EXPERIENCE </span>
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
        @if($key > 24)
          <div class="row" style="border-bottom:solid 1px;">

            <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
              <div class="col-sm-12">
                <div class="col-sm-6 no-padding" style="border-right:solid 1px; text-align: center;">
                  <span style="font-size:8px; font-weight: bold;">{{ DataTypeHelper::date_out($data->date_from, 'm/d/Y') }}</span>
                </div>
                <div class="col-sm-6 no-padding" style="text-align: center;">
                  <span style="font-size:8px; font-weight: bold;">{{ DataTypeHelper::date_out($data->date_to, 'm/d/Y') }}</span>
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
    @endif




    {{-- VOLUNTARY WORKS --}}
    @if(count($employee->employeeVoluntaryWork) > 7)
      
      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l">VI. VOLUNTARY WORK OR INVOLVEMENT IN CIVIC / NON-GOVERNMENT / PEOPLE / VOLUNTARY ORGANIZATION/S</span>
        </div>
      </div>

      {{-- VOLUNTARY WORKS Header --}}
      <div class="row" style="border-bottom:solid 1px;">

        <div class="col-sm-5 box-l-grey" style="border-right:solid 1px;">
          <div class="col-sm-12 no-padding">
            <div class="col-sm-2">
              <span style="font-size:8px;">29.</span>
            </div>
            <div class="col-sm-10" style="text-align: center;">
              <p style="font-size:8px; margin-top:7px; padding-bottom: 9px;"> NAME & ADDRESS OF ORGANIZATION <BR>(Write in full)</p>
            </div>
          </div>
        </div>

        <div class="col-sm-2 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:8px; text-align: center; padding-top:3px;">INCLUSIVE DATES <br>(mm/dd/yyyy)</p>
          <div class="col-sm-12 no-padding" style="border-top: solid 1px; margin-bottom: -9px;">
            <div class="col-sm-6" style="border-right:solid 1px; height:0.9em;">
              <p style="font-size:8px; text-align: center;">From</p>
            </div>
            <div class="col-sm-6">
              <p style="font-size:8px; text-align: center;">To</p>
            </div>
          </div>
        </div>

        <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:8px; text-align: center; padding-top:12px; padding-bottom:4px;">NUMBER OF <br>HOURS</p>
        </div>

        <div class="col-sm-4 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:9px; text-align: center; padding-top:16px; padding-bottom:10px;">POSITION / NATURE OF WORK</p>
        </div>

      </div>

      {{-- VOLUNTARY WORKS Content --}}
      @foreach ($employee->employeeVoluntaryWork as $key => $data)
        @if($key > 6)
          <div class="row" style="border-bottom:solid 1px; overflow:hidden;">

            <div class="col-sm-5" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
              <p style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->name }}</p>
            </div>

            <div class="col-sm-2 no-padding">
              <div class="col-sm-12 no-padding">
                <div class="col-sm-6" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
                  <span style="font-size:8px; font-weight:bold;">{{ DataTypeHelper::date_out($data->date_from, 'm/d/Y') }}</span>
                </div>
                <div class="col-sm-6" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
                  <span style="font-size:8px; font-weight:bold;">{{ DataTypeHelper::date_out($data->date_to, 'm/d/Y') }}</span>
                </div>
              </div>
            </div>

            <div class="col-sm-1" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->hours }}</span>
            </div>

            <div class="col-sm-4" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
              <span style="font-size:8px; font-weight:bold; margin-left: -10px;">{{ $data->position }}</span>
            </div>

          </div>
        @endif
      @endforeach
    @endif





    {{-- TRAININGS --}}
    @if(count($employee->employeeTraining) > 20)
      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l"> LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED</span><br>
          <span style="-webkit-print-color-adjust: exact; color: #ffffff !important; font-style:italic; font-size: 8px; font-weight: bold;">
            (Start from the most recent L&D/training program and include only the relevant L&D/training taken for the last five (5) years for Division Chief/Executive/Managerial positions)
          </span>
        </div>
      </div>

      {{-- TRAININGS Header --}}
      <div class="row" style="border-bottom:solid 1px;">

        <div class="col-sm-5 box-l-grey" style="border-right:solid 1px;">
          <div class="col-sm-12 no-padding">
            <div class="col-sm-2">
              <span style="font-size:8px;"></span>
            </div>
            <div class="col-sm-10 no-padding" style="text-align: center;">
              <p style="font-size:8px; margin-top:7px; padding-bottom: 9px;"> TITLE OF LEARNING AND DEVELOPMENT INTERVENTIONS/TRAINING PROGRAMS <br>(Write in full)</p>
            </div>
          </div>
        </div>

        <div class="col-sm-2 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:8px; text-align: center; padding-top:3px;">INCLUSIVE DATES OF <br> ATTENDANCE<br>(mm/dd/yyyy)</p>
          <div class="col-sm-12 no-padding" style="border-top: solid 1px; margin-bottom: -9px;">
            <div class="col-sm-6" style="border-right:solid 1px; height:0.9em;">
              <p style="font-size:8px; text-align: center;">From</p>
            </div>
            <div class="col-sm-6">
              <p style="font-size:8px; text-align: center;">To</p>
            </div>
          </div>
        </div>

        <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:8px; text-align: center; padding-top:20px; padding-bottom:7px;">NUMBER OF <br>HOURS</p>
        </div>

        <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:7px; text-align: center; padding-top:9px;">Type of LD ( Managerial/ Supervisory/ Technical/ etc) </p>
        </div>

        <div class="col-sm-3 box-l-grey no-padding" style="border-right:solid 1px;">
          <p style="font-size:8px; text-align: center; padding-top:20px; padding-bottom:7px;">CONDUCTED/ SPONSORED BY <br> (Write in full)</p>
        </div>

      </div>

      {{-- TRAININGS Content --}}
      @foreach ($employee->employeeTraining()->populate() as $key => $data)
        @if($key > 19)
         <div class="row" style="border-bottom:solid 1px; overflow: hidden;">

            <div class="col-sm-5" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
              <p style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->title }}</p>
            </div>

            <div class="col-sm-2 no-padding">
              <div class="col-sm-12 no-padding">
                <div class="col-sm-6" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
                  <span style="font-size:8px; font-weight:bold;">{{ DataTypeHelper::date_out($data->date_from, 'm/d/Y') }}</span>
                </div>
                <div class="col-sm-6" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
                  <span style="font-size:8px; font-weight:bold;">{{ DataTypeHelper::date_out($data->date_to, 'm/d/Y') }}</span>
                </div>
              </div>
            </div>

            <div class="col-sm-1" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->hours }}</span>
            </div>

            <div class="col-sm-1" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px;">
              <span style="font-size:6px; font-weight:bold; padding-left: 3px;">{{ $data->type }}</span>
            </div>

            <div class="col-sm-3" style="border-right:solid 1px; margin-bottom: -50px; padding-bottom: 50px; padding-bottom: 0;">
              <p style="font-size:8px; font-weight:bold; margin-left: -10px;">{{ $data->conducted_by }}</p>
            </div>

          </div>
        @endif
      @endforeach
    @endif





    {{-- SPECIAL SKILLS --}}
    @if(count($employee->employeeSpecialSkill) > 7 )

      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l">Special Skills</span>
        </div>
      </div>

      <div class="row">

        {{-- SPECIAL SKILLS Content --}}
        @foreach ($employee->employeeSpecialSkill as $key => $data)
          @if($key > 6 )
           <div class="col-sm-12" style="border-right:solid 1px; border-bottom:solid 1px;">
            <p style="font-size:8px; font-weight:bold; padding-left:3px;">{{ $data->description }}</p>
           </div>
          @endif
        @endforeach

      </div>

    @endif
    




    {{-- Recognitions --}}
    @if(count($employee->employeeRecognition) > 7 )

      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l">NON-ACADEMIC DISTINCTIONS / RECOGNITION</span>
        </div>
      </div>

      <div class="row">

        {{-- Recognitions Content --}}
        @foreach ($employee->employeeRecognition as $key => $data)
          @if($key > 6 )
            <div class="col-sm-12" style="border-right:solid 1px; border-bottom:solid 1px;">
              <p style="font-size:8px; font-weight:bold; padding-left:3px;">{{ $data->title }}</p>
            </div>
          @endif
        @endforeach

      </div>

    @endif




    {{-- Organization --}}
    @if(count($employee->employeeOrganization) > 7 )

      <div class="row box-d-grey" style="border-bottom:solid 2px;">
        <div class="col-sm-12">
          <span class="title-l">MEMBERSHIP IN ASSOCIATION/ORGANIZATION</span>
        </div>
      </div>

      <div class="row">

        {{-- Organization Content --}}
        @foreach ($employee->employeeOrganization as $key => $data)
          @if($key > 6)
            <div class="col-sm-12 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
              <p style="font-size:8px; font-weight:bold; padding-left:3px;">{{ $data->name }}</p>
            </div>
          @endif
        @endforeach

      </div>

    @endif






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
		<p class="pull-right" style="font-size:8px; padding-right: 20px;">CS FORM 212 (Revised 2017), Extra Page</p>
	</div>
</div>



</body>
</html>

