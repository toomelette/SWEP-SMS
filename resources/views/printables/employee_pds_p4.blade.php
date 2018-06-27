<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Disbursement Voucher</title>

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

  </style>

</head>
<body onload="window.print();" onafterprint="window.close()">

<div style="border:solid;">
  <div class="wrapper" style="overflow:hidden !important;">


    {{-- Question #34 --}}
    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 8.1em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">34.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">
              Are you related by consanguinity or affinity to the appointing or recommending authority, or to the <br>
              chief of bureau or office or to the person who has immediate supervision over you in the Office <br>
              Bureau or Department where you will be apppointed, <br> <br>
              a. within the third degree?<br>
              b. within the fourth degree (for Local Government Unit - Career Employees)?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5" style="padding-top:55px;">
        <p style="font-size:9px;">

          {!! $employee->employeeOtherQuestion->q_34_a == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_34_a == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          {!! $employee->employeeOtherQuestion->q_34_b == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_34_b == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_34_b_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_34_b_yes_details }}</small>
          @else
            _______________________
          @endif
          
        </p>
      </div>
    </div>



    {{-- Question #35 --}}
    <div class="row">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3.8em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">35.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">a. Have you ever been found guilty of any administrative offense?</p>
          </div>
        </div>
      </div>
      <div class="col-sm-5" style="border-bottom:solid 1px;">
        <p style="font-size:9px; margin-top:7px;">
          
          {!! $employee->employeeOtherQuestion->q_35_a == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_35_a == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_35_a_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_35_a_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 4.7em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            &nbsp;
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">b. Have you been criminally charged before any court?</p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px; margin-top:7px;">

          {!! $employee->employeeOtherQuestion->q_35_b == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_35_b == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>

          Date Filed:  
          @if($employee->employeeOtherQuestion->q_35_b_yes_details_1 != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_35_b_yes_details_1 }}</small>
          @else
            _______________________
          @endif 

          <br>

          Status of Case/s:
          @if($employee->employeeOtherQuestion->q_35_b_yes_details_2 != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_35_b_yes_details_2 }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>



    {{-- Question #36 --}}
    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3.8em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">36.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">Have you ever been convicted of any crime or violation of any law, decree, ordinance or regulation by any court or tribunal?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">

        <p style="font-size:9px; margin-top:7px;">

          {!! $employee->employeeOtherQuestion->q_36 == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_36 == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_36_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_36_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>



    {{-- Question #37 --}}
    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3.8em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">37.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">Have you ever been separated from the service in any of the following modes: resignation, retirement, dropped from the rolls, dismissal, termination, end of term, finished contract or phased out (abolition) in the public or private sector?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px; margin-top:7px;">

          {!! $employee->employeeOtherQuestion->q_37 == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_37 == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_37_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_37_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>



    {{-- Question #38 --}}
    <div class="row">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3.9em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">38.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">
              a. Have you ever been a candidate in a national or local election held within the last year (except Barangay election)?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px; margin-top:7px;">
          
          {!! $employee->employeeOtherQuestion->q_38_a == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_38_a == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_38_a_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_38_a_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 4em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            &nbsp;
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">
              b. Have you resigned from the government service during the three (3)-month period before the last election to promote/actively campaign for a national or local candidate?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px; margin-top:7px;">
          
          {!! $employee->employeeOtherQuestion->q_38_b == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_38_b == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_38_b_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_38_b_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>




    {{-- Question #39 --}}
    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3.8em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">39.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">Have you acquired the status of an immigrant or permanent resident of another country?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px; margin-top:7px;">
          
          {!! $employee->employeeOtherQuestion->q_39 == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_39 == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: <br>
          @if($employee->employeeOtherQuestion->q_39_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_39_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>



    {{-- Question #40 --}}
    <div class="row">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 4.6em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;">40.</span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">
              Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA 8972), please answer the following items: <br>
              a. Are you a member of any indigenous group?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5" style="padding-top:23px;">
        <p style="font-size:9px; margin-top:7px;">
          
          {!! $employee->employeeOtherQuestion->q_40_a == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_40_a == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: &nbsp;
          @if($employee->employeeOtherQuestion->q_40_a_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_40_a_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;"></span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px; margin-top:7px;">
              b. Are you a person with disability?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px; margin-top:7px;">
          
          {!! $employee->employeeOtherQuestion->q_40_b == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_40_b == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: &nbsp;
          @if($employee->employeeOtherQuestion->q_40_b_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_40_b_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>


    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-7 box-l-grey" style="border-right:solid 1px; height: 3em;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-1">
            <span style="font-size:8px;"></span>
          </div>
          <div class="col-sm-11 no-padding" style="">
            <p style="font-size:9px;">
              c. Are you a solo parent?
            </p>
          </div>
        </div>
      </div>
      <div class="col-sm-5">
        <p style="font-size:9px;">
          
          {!! $employee->employeeOtherQuestion->q_40_c == 1 ? '&#9745;' : '&#9723;' !!} YES 
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          {!! $employee->employeeOtherQuestion->q_40_c == 0 ? '&#9745;' : '&#9723;' !!} NO <br>

          If YES, give details: &nbsp;
          @if($employee->employeeOtherQuestion->q_40_c_yes_details != null)
            <small style="text-decoration: underline;">{{ $employee->employeeOtherQuestion->q_40_c_yes_details }}</small>
          @else
            _______________________
          @endif

        </p>
      </div>
    </div>



    {{-- Question #41 --}}
    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-8 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">

        <div class="col-sm-12 box-l-grey" style="border-bottom:solid 1px;">
          <div class="col-sm-1">
            <span style="font-size:8px;">41.</span>
          </div>
          <div class="col-sm-11 no-padding">
            <p style="font-size:9px; margin-top:7px;">
              REFERENCES 
                <small style="color:red !important; -webkit-print-color-adjust: exact;">
                  (Person not related by consanguinity or affinity to applicant /appointee)
                </small>
            </p>
          </div>
        </div>

        <div class="col-sm-12 no-padding box-l-grey" style="border-bottom:solid 1px;">
          <div class="col-sm-5" style="border-right:solid 1px;">
            <p style="font-size:9px; padding-top: 8px; text-align: center;">NAME</p>
          </div>
          <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
            <p style="font-size:9px; padding-top: 8px; text-align: center;">ADDRESS</p>
          </div>
          <div class="col-sm-3 no-padding">
            <p style="font-size:9px; padding-top: 8px; text-align: center;">TEL. NO.</p>
          </div>
        </div>


        @foreach ($employee->employeeReference as $data)
           <div class="col-sm-12 no-padding" style="border-bottom:solid 1px;">
            <div class="col-sm-5" style="border-right:solid 1px;">
              <p style="font-size:9px; padding-top: 2px; padding-left: 2px;">{{ $data->fullname }}</p>
            </div>
            <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
              <p style="font-size:9px; padding-top: 2px; padding-left: 2px;">{{ $data->address }}</p>
            </div>
            <div class="col-sm-3 no-padding">
              <p style="font-size:9px; padding-top: 2px; padding-left: 2px;">{{ $data->tel_no }}</p>
            </div>
          </div>
        @endforeach


        @if(count($employee->employeeReference) < 3)
          <?php 
            $diff = 3 - count($employee->employeeReference); 
          ?>
          @for ($i = 0; $i < $diff; $i++)
            <div class="col-sm-12 no-padding" style="border-bottom:solid 1px;">
              <div class="col-sm-5" style="border-right:solid 1px;">
                &nbsp;
              </div>
              <div class="col-sm-4 no-padding" style="border-right:solid 1px;">
                &nbsp;
              </div>
              <div class="col-sm-3 no-padding">
                &nbsp;
              </div>
            </div>
          @endfor
        @endif


        <div class="col-sm-12 box-l-grey" style="border-bottom:solid 1px;">
          <div class="col-sm-1">
            <span style="font-size:8px;">42.</span>
          </div>
          <div class="col-sm-11 no-padding">
            <p style="font-size:9px; margin-top:7px;">
              I declare under oath that I have personally accomplished this Personal Data Sheet which is a true, correct and complete statement pursuant to the provisions of pertinent laws, rules and regulations of the Republic of the Philippines. I authorize the agency head/authorized representative to verify/validate the contents stated herein.          I  agree that any misrepresentation made in this document and its attachments shall cause the filing of administrative/criminal case/s against me.
            </p>
          </div>
        </div>


        <div class="col-sm-12" style="border-bottom:solid 1px;">
          
          <div class="col-sm-6" style="padding:10px; border-right:solid 1px;">
            <div class="col-sm-12 no-padding" style="border:solid 1px;">

              <div class="col-sm-12 box-l-grey no-padding" style="border-bottom:solid 1px;">
                <p style="font-size:8px; padding-top:7px; padding-left:3px;">
                Government Issued ID (i.e.Passport, GSIS, SSS, PRC, Driver's License, etc.)                               
                PLEASE INDICATE ID Number and Date of Issuance</p>
              </div>

              <div class="col-sm-12 no-padding" style="border-bottom:solid 1px;">
                <div class="col-sm-6 no-padding">
                  <p style="font-size:8px; padding-top: 7px; padding-left:3px;">Government Issued ID:</p>
                </div>
                <div class="col-sm-6 no-padding" style="text-align: center;">
                  <p style="font-size:8px; padding-top: 7px;">
                    {!! $employee->gov_id != null ? $employee->gov_id : 'N/A' !!}
                  </p>
                </div>
              </div>

              <div class="col-sm-12 no-padding" style="border-bottom:solid 1px;">
                <div class="col-sm-6 no-padding">
                  <p style="font-size:8px; padding-top: 7px; padding-left:3px;">ID/License/Passport No.: </p>
                </div>
                <div class="col-sm-6 no-padding" style="text-align: center;">
                  <p style="font-size:8px; padding-top: 7px;">
                    {!! $employee->license_passport_no != null ? $employee->license_passport_no : 'N/A' !!}
                  </p>
                </div>
              </div>

              <div class="col-sm-12 no-padding">
                <div class="col-sm-6 no-padding">
                  <p style="font-size:8px; padding-top: 7px; padding-left:3px;">Date/Place of Issuance:</p>
                </div>
                <div class="col-sm-6 no-padding" style="text-align: center;">
                  <p style="font-size:8px; padding-top: 7px;">
                    {!! $employee->id_date_issue != null ? $employee->id_date_issue : 'N/A' !!}
                  </p>
                </div>
              </div>

            </div>
          </div>

          <div class="col-sm-6" style="padding:10px;">
            <div class="col-sm-12 no-padding" style="border:solid 1px;">
              <div class="col-sm-12" style="padding-bottom: 84.5px;">
                &nbsp;
              </div>
              <div class="col-sm-12 no-padding box-l-grey" style="border-bottom:solid 1px; border-top:solid 1px; padding-bottom: 80px; text-align: center;">
                <p style="font-size:7px; margin:0;">Signature (Sign inside the box)</p>
              </div>
              <div class="col-sm-12 no-padding" style="border-bottom:solid 1px; padding-bottom: 80px; text-align: center;">
                <p style="font-size:7px; margin:0;"><b>{{ Carbon::now()->format('M d, Y') }}</b></p>
              </div>
              <div class="col-sm-12 no-padding box-l-grey" style="padding-bottom: 80px; text-align: center;">
                <p style="font-size:7px; margin:0;">Date Accomplished</p>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-sm-4">

        <div class="col-sm-12" style="padding-top:20px; padding-left:50px; padding-right:50px;">
          <div class="col-sm-12" style="border:solid 1px;">
            <p style="font-size:8px; text-align: center; padding-top:12px; padding-bottom:6px;">
              ID picture taken within <br> 
              the last  6 months <br>
              3.5 cm. X 4.5 cm <br>
              (passport size) <br>

              With full and handwritten <br>
              name tag and signature over <br>
              printed name <br>

              Computer generated <br>
              or photocopied picture <br>
              is not acceptable <br>
            </p>
          </div>
        </div>

        <div class="col-sm-12" style="padding-bottom: 0;">
         <p style="font-size:8px; text-align: center; padding-top: 10px;">PHOTO</p>
        </div>

        <div class="col-sm-12" style="padding-top:0px; padding-left:30px; padding-right:30px; padding-bottom:0px;">
          <div class="col-sm-12 no-padding" style="border:solid 1px;">
            <div class="col-sm-12" style="padding-bottom: 150px; border-bottom:solid 1px;">
            </div>
            <div class="col-sm-12 no-padding box-l-grey" style="">
              <p style="font-size:8px; text-align: center; margin:0;">Right Thumbmark</p>
            </div>
          </div>
        </div>

      </div>

    </div>



    <div class="row" style="border-bottom:solid 1px; padding-bottom: 10px;">
      <div class="col-sm-12">
        <p style="font-size:9px; text-align: center; padding-top: 10px;"> 
        SUBSCRIBED AND SWORN to before me this, ______________________________ affiant exhibiting his/her validly issued government ID as indicated above.
        </p>
      </div>
      <div class="col-sm-12" style="padding-left:250px; padding-right:250px;">
        <div class="col-sm-12" style="border:solid 1px; padding-bottom: 80px;">
          &nbsp;
        </div>
        <div class="col-sm-12 box-l-grey" style="border:solid 1px;">
          <p style="font-size:9px; text-align: center; margin:2px;">Person Administering Oath</p>
        </div>
      </div>
    </div>



  </div>
</div>

<div class="row">
	<div class="col-sm-12 no-padding" style="border-right:solid 1px;">
		<p class="pull-right" style="font-size:8px; padding-right: 20px;">CS FORM 212 (Revised 2017), Page 4 of 4</p>
	</div>
</div>



</body>
</html>

