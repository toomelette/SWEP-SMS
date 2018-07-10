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

    {{-- VOLUNTARY WORKS --}}
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

    @foreach ($employee->employeeVoluntaryWork as $data)

     <div class="row" style="border-bottom:solid 1px;">

      <div class="col-sm-5" style="border-right:solid 1px;">
        <span style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->name }}</span>
      </div>

      <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-6" style="border-right:solid 1px;">
            <span style="font-size:8px; font-weight:bold;">{{ $data->date_from != null ? Carbon::parse($data->date_from)->format('m/d/Y') : 'N/A' }}</span>
          </div>
          <div class="col-sm-6">
            <span style="font-size:8px; font-weight:bold;">{{ $data->date_to != null ? Carbon::parse($data->date_to)->format('m/d/Y') : 'N/A' }}</span>
          </div>
        </div>
      </div>

      <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
        <span style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->hours }}</span>
      </div>

      <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
        <span style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->position }}</span>
      </div>

    </div>

    @endforeach

    @if(count($employee->employeeVoluntaryWork) < 7)

      <?php 
        $diff = 7 - count($employee->employeeVoluntaryWork); 
      ?>

      @for ($i = 0; $i < $diff; $i++)

        <div class="row" style="border-bottom:solid 1px;">

          <div class="col-sm-5" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-6" style="border-right:solid 1px;">
                &nbsp;
              </div>
              <div class="col-sm-6">
                &nbsp;
              </div>
            </div>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
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




    {{-- TRAININGS --}}
    <div class="row box-d-grey" style="border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">VII.  LEARNING AND DEVELOPMENT (L&D) INTERVENTIONS/TRAINING PROGRAMS ATTENDED</span><br>
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
            <span style="font-size:8px;">30.</span>
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

    @foreach ($employee->employeeTraining as $data)

     <div class="row" style="border-bottom:solid 1px;">

      <div class="col-sm-5" style="border-right:solid 1px; margin-bottom: -100px; padding-bottom: 100px; overflow: hidden;">
        <p style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->title }}</p>
      </div>

      <div class="col-sm-2 no-padding">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-6" style="border-right:solid 1px; margin-bottom: -100px; padding-bottom: 100px; overflow: hidden;">
            <span style="font-size:8px; font-weight:bold;">{{ $data->date_from != null ? Carbon::parse($data->date_from)->format('m/d/Y') : 'N/A' }}</span>
          </div>
          <div class="col-sm-6" style="border-right:solid 1px; margin-bottom: -100px; padding-bottom: 100px; overflow: hidden;">
            <span style="font-size:8px; font-weight:bold;">{{ $data->date_to != null ? Carbon::parse($data->date_to)->format('m/d/Y') : 'N/A' }}</span>
          </div>
        </div>
      </div>

      <div class="col-sm-1" style="border-right:solid 1px; margin-bottom: -100px; padding-bottom: 100px; overflow: hidden;">
        <span style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->hours }}</span>
      </div>

      <div class="col-sm-1" style="border-right:solid 1px; margin-bottom: -100px; padding-bottom: 100px; overflow: hidden;">
        <span style="font-size:6px; font-weight:bold; padding-left: 3px;">{{ $data->type }}</span>
      </div>

      <div class="col-sm-3 no-padding" style="border-right:solid 1px;">
        <p style="font-size:8px; font-weight:bold; padding-left: 3px;">{{ $data->conducted_by }}</p>
      </div>

    </div>

    @endforeach

    @if(count($employee->employeeTraining) < 27)

      <?php 
        $diff = 27 - count($employee->employeeTraining); 
      ?>

      @for ($i = 0; $i < $diff; $i++)

        <div class="row" style="border-bottom:solid 1px;">

          <div class="col-sm-5" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-2 no-padding" style="border-right:solid 1px;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-6" style="border-right:solid 1px;">
                &nbsp;
              </div>
              <div class="col-sm-6">
                &nbsp;
              </div>
            </div>
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-1 no-padding" style="border-right:solid 1px;">
            &nbsp;
          </div>

          <div class="col-sm-3 no-padding" style="border-right:solid 1px;">
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



    {{-- OTHER INFO --}}
    <div class="row box-d-grey" style="border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">VIII.  OTHER INFORMATION</span>
      </div>
    </div>

    {{-- OTHER INFO Header --}}
    <div class="row" style="border-bottom:solid 1px;">


      <div class="col-sm-3 no-padding">

        {{-- SPECIAL SKILLS HEADER --}}
        <div class="col-sm-12 box-l-grey no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
          <div class="col-sm-2" style="padding-bottom: 21px;">
            <span style="font-size:8px;">31.</span>
          </div>
          <div class="col-sm-10 no-padding" style="text-align: center;">
            <p style="font-size:9px; margin-top:7px;">SPECIAL SKILLS and HOBBIES</p>
          </div>
        </div>

        {{-- SPECIAL SKILLS Content --}}
        @foreach ($employee->employeeSpecialSkill as $data)

         <div class="col-sm-12" style="border-right:solid 1px; border-bottom:solid 1px;">
          <span style="font-size:8px; font-weight:bold; padding-left:3px;">{{ $data->description }}</span>
        </div>

        @endforeach

        @if(count($employee->employeeSpecialSkill) < 7)

          <?php 
            $diff = 7 - count($employee->employeeSpecialSkill); 
          ?>

          @for ($i = 0; $i < $diff; $i++)

            <div class="col-sm-12 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
              &nbsp;
            </div>

          @endfor

        @endif

      </div>


      <div class="col-sm-6 no-padding">
        
        {{-- Recognitions HEADER --}}
        <div class="col-sm-12 box-l-grey no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
          <div class="col-sm-2">
            <span style="font-size:8px;">32.</span>
          </div>
          <div class="col-sm-10 no-padding" style="text-align: center;">
            <p style="font-size:9px; margin-top:7px;">NON-ACADEMIC DISTINCTIONS / RECOGNITION <br> (Write in full)</p>
          </div>
        </div>

        {{-- Recognitions Content --}}
        @foreach ($employee->employeeRecognition as $data)

         <div class="col-sm-12 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
          <span style="font-size:8px; font-weight:bold; padding-left:3px;">{{ $data->title }}</span>
        </div>

        @endforeach

        @if(count($employee->employeeRecognition) < 7)

          <?php 
            $diff = 7 - count($employee->employeeRecognition); 
          ?>

          @for ($i = 0; $i < $diff; $i++)

            <div class="col-sm-12 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
              &nbsp;
            </div>

          @endfor

        @endif

      </div>


      <div class="col-sm-3 no-padding">
        
        {{-- Recognitions HEADER --}}
        <div class="col-sm-12 box-l-grey no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
          <div class="col-sm-2">
            <span style="font-size:8px;">33.</span>
          </div>
          <div class="col-sm-10 no-padding" style="text-align: center;">
            <p style="font-size:7px; margin-top:1px; padding-right: 10px;">MEMBERSHIP IN ASSOCIATION/ORGANIZATION <br> (Write in full)</p>
          </div>
        </div>

        {{-- Recognitions Content --}}
        @foreach ($employee->employeeOrganization as $data)

         <div class="col-sm-12 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
          <span style="font-size:8px; font-weight:bold; padding-left:3px;">{{ $data->name }}</span>
        </div>

        @endforeach

        @if(count($employee->employeeOrganization) < 7)

          <?php 
            $diff = 7 - count($employee->employeeOrganization); 
          ?>

          @for ($i = 0; $i < $diff; $i++)

            <div class="col-sm-12 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
              &nbsp;
            </div>

          @endfor

        @endif

      </div>
    
    </div>

     

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
		<p class="pull-right" style="font-size:8px; padding-right: 20px;">CS FORM 212 (Revised 2017), Page 3 of 4</p>
	</div>
</div>



</body>
</html>

