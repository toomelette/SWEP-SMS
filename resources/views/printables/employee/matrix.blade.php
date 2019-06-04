<?php
  
  $total_score = optional($employee->employeeMatrix)->educ_bachelors_degree + 
                 optional($employee->employeeMatrix)->educ_undergrad_bachelor + 
                 optional($employee->employeeMatrix)->educ_masters_degree + 
                 optional($employee->employeeMatrix)->educ_doctoral_degree + 
                 optional($employee->employeeMatrix)->educ_undergrad_masteral + 
                 optional($employee->employeeMatrix)->educ_grad_certificate_course + 

                 optional($employee->employeeMatrix)->educ_distinctions_summa_cum_laude + 
                 optional($employee->employeeMatrix)->educ_distinctions_magna_cum_laude + 
                 optional($employee->employeeMatrix)->educ_distinctions_cum_laude + 
                 optional($employee->employeeMatrix)->educ_distinctions_pres_awardee + 
                 optional($employee->employeeMatrix)->educ_distinctions_csc_sra_da_awardee + 
                 optional($employee->employeeMatrix)->educ_distinctions_top_gov_exam + 

                 optional($employee->employeeMatrix)->experience + 
                 optional($employee->employeeMatrix)->training +
                 optional($employee->employeeMatrix)->eligibility + 
                 optional($employee->employeeMatrix)->performance + 
                 optional($employee->employeeMatrix)->behavior + 
                 optional($employee->employeeMatrix)->psycho_test;

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee Matrix</title>

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

    .particulars {
      padding:20px;
    }

    .bg-wm{
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      background-position: center;
      position:absolute;
      opacity:0.3;
      margin-top: 200px;
      padding:80px;
    }

    @media print {
        .footer {
          page-break-after: always;
        }
    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

  <img class="bg-wm" src="{{ asset('images/sra_wm.jpg') }}">

  {{-- Header --}}
  <div class="row">
    <div class="col-md-12">
      <div class="col-sm-3">
        <img src="{{ asset('images/sra.png') }}" style="width:110px;">
      </div>
      <div class="col-sm-8" style="padding-right:125px; font-family: tahoma; line-height:13px; margin-left:-40px;">
        <span style="font-size:12px;">Republic of the Philippines</span><br>
        <span style="font-size:12px;">Department of Agriculture</span><br>
        <span style="font-size:12px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
        <span style="font-size:12px;">North Avenue, Diliman, Quezon City</span><br>
        <span style="font-size:12px;">Philippines 6100</span><br>
        <span style="font-size:12px;">TIN 000-784-336</span>
      </div>
      <div class="col-sm-1"></div>
    </div>
    <div class="col-sm-12" style="padding-bottom:20px;"></div>
    <div class="col-sm-12" style="text-align: center; padding-bottom:10px;">   
      <span style="font-weight: bold;">Employee Matrix</span><br>
    </div>
  </div>


  {{-- Employee Information --}}
  <div class="row" style="font-size:11px; margin-bottom:10px;">
    <div class="col-sm-12" style="margin-bottom:10px;">
      <span> <b>EMPLOYEE INFORMATION</b> </span>
    </div>

    <div class="col-sm-3">
      <span><b>Fullname:</b></span>
    </div>
    <div class="col-sm-3">
      <span>{{ $employee->fullname }}</span>
    </div>

    <div class="col-sm-3">
      <span><b>Present Position:</b></span>
    </div>
    <div class="col-sm-3">
      <span>{{ $employee->position }}</span>
    </div>

    <div class="col-sm-3">
      <span><b>Employee No:</b></span>
    </div>
    <div class="col-sm-3">
      <span>{{ $employee->employee_no }}</span>
    </div>

    <div class="col-sm-3">
      <span><b>Vacant Position:</b></span>
    </div>
    <div class="col-sm-3">
      <span></span>
    </div>

  </div>


  {{-- Employee Matrix --}}
  <table style="border: 1px solid black; font-size: 11px;">
        
      <tr>
        <th style="text-align:center; width:120px;">Criteria</th>
        <th style="text-align:center; width:300px;">Particulars</th>
        <th style="text-align:center; width:250px;">Formula</th>
        <th style="text-align:center; width:50px;">Max Score</th>
        <th style="text-align:center; width:50px;">Score</th>
      </tr>


      {{-- Education --}}

      <tr>

        <td style="vertical-align: text-top;">
          Education - Relevant to the position
        </td>


        <td> 
          <ol style="margin-top:-8px;">
            <li class="particulars">Bachelor's Degree Graduate</li>
            <li class="particulars">College Undergraduate</li>
            <li class="particulars">Master's Degree Graduate</li>
            <li class="particulars">Doctoral Degree Graduate</li>
            <li class="particulars">Undergraduate Masteral/Doctoral</li>
            <li class="particulars">Graduate Certificate Course</li>
            <li style="padding-top: 20px; padding-left: 20px;">Honors / Awards Recieved / Distinctions:
              <ul>                    
                  <li style="padding:3px;">Summa Cum Laude</li>
                  <li style="padding:3px;">Magna Cum Laude</li>
                  <li style="padding:3px;">Cum Laude / With Honors</li>
                  <li style="padding:3px;">Presidential Awardee</li>
                  <li style="padding:3px;">CSC / SRA / DA Awardee</li>
                  <li>Top 10 on government licensure administered exams</li>
              </ul>
            </li>
          </ol>
        </td>


        <td style="vertical-align: text-top;">
          <p>160 Units<br>
             --------------- x &nbsp;&nbsp; 5.00<br>
             160 Units 
          </p>
          <p style="margin-top: 10px;">{{ number_format(optional($employee->employeeMatrix)->educ_undergrad_bachelor_units_earned) }} Units Earned<br>
             ----------------------- x &nbsp;&nbsp; 5.00<br>
             160 Units 
          </p>  
          <p style="margin-top: 115px;">{{ number_format(optional($employee->employeeMatrix)->educ_undergrad_masteral_units_earned) }} Units Earned<br>
             ----------------------- x &nbsp;&nbsp; 1.00<br>
             42 Units 
          </p>
          <br>   
          <p style="margin-top: 5px;">
            Certificate of Course Completion
          </p>
        </td>


        <td style="vertical-align: text-top;">
          <p>5.00</p>
          <p style="margin-top: 105px;">2.00</p>
          <p style="margin-top: 45px;">2.00</p>
          <p style="margin-top: 38px;">1.00</p>
          <p style="margin-top: 42px;">2.00</p>
          <p style="margin-top: 55px;">3.00</p>
          <p style="margin-top: -3px;">2.00</p>
          <p style="margin-top: -3px;">1.00</p>
          <p style="margin-top: -3px;">3.00</p>
          <p style="margin-top: -3px;">3.00</p>
          <p style="margin-top: -3px;">3.00</p>
        </td>


        <td style="vertical-align: text-top;">
          <p>
            @if (number_format(optional($employee->employeeMatrix)->educ_bachelors_degree) != 0)
              {{ number_format(optional($employee->employeeMatrix)->educ_bachelors_degree, 2) }}
             @else 
              {{ number_format(optional($employee->employeeMatrix)->educ_undergrad_bachelor, 2) }}
            @endif
          </p>
          <p style="margin-top: 105px;">{{ number_format(optional($employee->employeeMatrix)->educ_masters_degree, 2) }}</p>
          <p style="margin-top: 45px;">{{ number_format(optional($employee->employeeMatrix)->educ_doctoral_degree, 2) }}</p>
          <p style="margin-top: 38px;">{{ number_format(optional($employee->employeeMatrix)->educ_undergrad_masteral, 2) }}</p>
          <p style="margin-top: 42px;">{{ number_format(optional($employee->employeeMatrix)->educ_grad_certificate_course, 2) }}</p>
          <p style="margin-top: 55px;">{{ number_format(optional($employee->employeeMatrix)->educ_distinctions_summa_cum_laude, 2) }}</p>
          <p style="margin-top: -3px;">{{ number_format(optional($employee->employeeMatrix)->educ_distinctions_magna_cum_laude, 2) }}</p>
          <p style="margin-top: -3px;">{{ number_format(optional($employee->employeeMatrix)->educ_distinctions_cum_laude, 2) }}</p>
          <p style="margin-top: -3px;">{{ number_format(optional($employee->employeeMatrix)->educ_distinctions_pres_awardee, 2) }}</p>
          <p style="margin-top: -3px;">{{ number_format(optional($employee->employeeMatrix)->educ_distinctions_csc_sra_da_awardee, 2) }}</p>
          <p style="margin-top: -3px;">{{ number_format(optional($employee->employeeMatrix)->educ_distinctions_top_gov_exam, 2) }}</p>
        </td>

      </tr>



      {{-- Experience --}}

      <tr>

        <td style="vertical-align: text-top;">
          Experience
        </td>

        <td style="vertical-align: text-top;">
        </td>

        <td style="vertical-align: text-top;">
           
          <p>{{ number_format(optional($employee->employeeMatrix)->experience_years, 1) }} Years of Experience<br>
             ------------------------------ x &nbsp;&nbsp; 20.00<br>
             {{ number_format(optional($employee->employeeMatrix)->experience_req_years) }} Required number of Experience 
          </p>

        </td>

        <td style="vertical-align: text-top;">20.00</td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->experience, 2) }}</p>
        </td>

      </tr>



      {{-- Training --}}

      <tr>
            
        <td style="vertical-align: text-top;">
          Training
        </td>

        <td style="vertical-align: text-top;">
        </td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->training_no) }} Number of trainings<br>
             ------------------------------ x &nbsp;&nbsp; 10.00<br>
             {{ number_format(optional($employee->employeeMatrix)->training_req_no) }} Required number of trainings 
          </p>  
        </td> 

        <td style="vertical-align: text-top;">10.00</td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->training, 2) }}</p>
        </td>

      </tr>



      {{-- Eligibility --}}

      <tr>
            
        <td style="vertical-align: text-top;">
          Eligibility
        </td>

        <td style="vertical-align: text-top;">
        </td>

        <td style="vertical-align: text-top;"></td>

        <td style="vertical-align: text-top;">5.00</td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->eligibility, 2) }}</p>
        </td>

      </tr>



      {{-- Performance --}}

      <tr>
            
        <td style="vertical-align: text-top;">
          Performance
        </td>

        <td style="vertical-align: text-top;"></td>

        <td style="vertical-align: text-top;"></td>

        <td style="vertical-align: text-top;">20.00</td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->performance, 2) }}</p>
        </td>

      </tr>



      {{-- Behavioral Events --}}

      <tr>
            
        <td style="vertical-align: text-top;">
          Behavioral Events, Interview, Assesment (BEIA), Work Attitude
        </td>

        <td style="vertical-align: text-top;">
        </td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->behavior_point_score, 2) }} Point Score<br>
             --------------------- x &nbsp;&nbsp; 13.00<br>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5       
          </p>
        </td>

        <td style="vertical-align: text-top;">13.00</td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->behavior, 2) }}</p>
        </td>

      </tr>



      {{-- Psychological and Mental Aptitude Tests --}}

      <tr>
            
        <td style="vertical-align: text-top;">
          Psychological and Mental Aptitude Tests
        </td>

        <td style="vertical-align: text-top;">
        </td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->psycho_test_point_score, 2) }} Point Score<br>
             ---------------------- x &nbsp;&nbsp; 5.00<br>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;100       
          </p>
        </td>

        <td style="vertical-align: text-top;">5.00</td>

        <td style="vertical-align: text-top;">
          <p>{{ number_format(optional($employee->employeeMatrix)->psycho_test, 2) }}</p>
        </td>

      </tr>



      {{-- Total Score --}}

      <tr>
            
        <td>
          <span style="font-weight: bold;">TOTAL SCORE</span>
        </td>

        <td></td>

        <td></td>

        <td style="vertical-align: text-top;">100.00</td>

        <td>
          <span style="font-weight: bold;">{{ number_format($total_score, 2) }}</span>
        </td>

      </tr>


  </table>

    <div class="footer"></div>

</body>
</html>

