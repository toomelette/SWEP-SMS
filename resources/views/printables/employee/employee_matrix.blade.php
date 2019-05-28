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

    @media print {

        .footer {
          page-break-after: always;
        }

    }

  </style>

</head>

<body onload="window.print();" onafterprint="window.close()">

    <div class="wrapper">


      {{-- Header --}}
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
          <span>Test T. Test</span>
        </div>

        <div class="col-sm-3">
          <span><b>Present Position:</b></span>
        </div>
        <div class="col-sm-3">
          <span>Administrator</span>
        </div>

        <div class="col-sm-3">
          <span><b>Employee No:</b></span>
        </div>
        <div class="col-sm-3">
          <span>2019-001</span>
        </div>

        <div class="col-sm-3">
          <span><b>Vacant Position:</b></span>
        </div>
        <div class="col-sm-3">
          <span>Administrator</span>
        </div>

      </div>


      {{-- Employee Matrix --}}
      <table style="border: 1px solid black; font-size: 11px;">
        

        <thead>
            
          <tr>
            <th style="text-align:center; width:120px;">Criteria</th>
            <th style="text-align:center; width:250px;">Particulars</th>
            <th style="text-align:center; width:150px;">Formula</th>
            <th style="text-align:center; width:50px;">Score</th>
          </tr>

        </thead>


        <tbody>


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
              <p style="margin-top: 10px;">Units Earned<br>
                 ------------------- x &nbsp;&nbsp; 5.00<br>
                 160 Units 
              </p>  
              <p style="margin-top: 115px;">Units Earned<br>
                 ------------------- x &nbsp;&nbsp; 1.00<br>
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

          </tr>



          {{-- Experience --}}

          <tr>
    
            <td style="vertical-align: text-top;">
              Experience
            </td>

            <td style="vertical-align: text-top;">
              CSC QS Manual and CSC MC No. 5 s. 2016, re: Revised Qualification Standards and Requirements for Division Chiefs, Departments Managers and/or Executive Managerial Positions, and SRA Job Description Competency - based QS.
            </td>

            <td style="vertical-align: text-top;">
              Full Compliance of the CSC QS Manual, or CSC MC No. 5, s. 2016 and/or SRA Job Description Competency-based QS.
            </td>

            <td style="vertical-align: text-top;">
              <p>20.00</p>
            </td>

          </tr>



          {{-- Training --}}

          <tr>
                
            <td style="vertical-align: text-top;">
              Training
            </td>

            <td style="vertical-align: text-top;">
              CSC QS Manual and CSC MC No. 5 s. 2016, re: Revised Qualification Standards and Requirements for Division Chiefs, Departments Managers and/or Executive Managerial Positions, and SRA Job Description Competency - based QS. 
            </td>

            <td style="vertical-align: text-top;">
              Full Compliance of the CSC QS Manual, or CSC MC No. 5, s. 2016 and/or SRA Job Description Competency-based QS.
            </td>

            <td style="vertical-align: text-top;">
              <p>10.00</p>
            </td>

          </tr>



          {{-- Eligibility --}}

          <tr>
                
            <td style="vertical-align: text-top;">
              Eligibility
            </td>

            <td style="vertical-align: text-top;">
              <ol style="margin-top:-8px;">
                <li>
                  First Level (Sub-Professional) or its equivalent RA 1080 eligibility
                </li>
                <li>
                  Second Level (Professional) or its equivalent RA 1080 eligibility
                </li>
                <li>
                  Second Level / Executive Managerial Positions: Division Chiefs, Department Managers and / or Executive Managerial Positions: CSC MC No. 5, s. 2016, re: Revised Qualification Standards and Requirements for Division Chiefs, Department Managers and/or Executive Managerial Positions, and SRA Job Description Competency-based QS.
                </li>
              </ol> 
            </td>

            <td style="vertical-align: text-top;"></td>

            <td style="vertical-align: text-top;">
              <p>5.00</p>
            </td>

          </tr>



          {{-- Performance --}}

          <tr>
                
            <td style="vertical-align: text-top;">
              Performance
            </td>

            <td style="vertical-align: text-top;"></td>

            <td style="vertical-align: text-top;"></td>

            <td style="vertical-align: text-top;">
              <p>20.00</p>
            </td>

          </tr>



          {{-- Behavioral Events --}}

          <tr>
                
            <td style="vertical-align: text-top;">
              Behavioral Events, Interview, Assesment (BEIA), Work Attitude
            </td>

            <td style="vertical-align: text-top;">
              HRMPSBs Panel Interview
            </td>

            <td style="vertical-align: text-top;">
              <p>Point Score<br>
                 ----------------- x &nbsp;&nbsp; 13.00<br>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5       
              </p>
            </td>

            <td style="vertical-align: text-top;">
              <p>13.00</p>
            </td>

          </tr>



          {{-- Psychological and Mental Aptitude Tests --}}

          <tr>
                
            <td style="vertical-align: text-top;">
              Psychological and Mental Aptitude Tests
            </td>

            <td style="vertical-align: text-top;">
              HRMO - Psychometrician examination
            </td>

            <td style="vertical-align: text-top;">
              <p>Point Score<br>
                 ----------------- x &nbsp;&nbsp; 5.00<br>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;100       
              </p>
            </td>

            <td style="vertical-align: text-top;">
              <p>5.00</p>
            </td>

          </tr>



          {{-- Total Score --}}

          <tr>
                
            <td>
              <span style="font-weight: bold;">TOTAL SCORE</span>
            </td>

            <td></td>

            <td></td>

            <td>
              <span style="font-weight: bold;">100.00</span>
            </td>

          </tr>


          
        </tbody>


      </table>


    </div>


</body>
</html>

