<?php

  $level = ['ELEMENTARY', 'SECONDARY', 'VOCATIONAL/TRADE COURSE', 'COLLEGE', 'GRADUATE STUDIES']; 

?>


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


    {{-- HEADER --}}
    <div class="row">
      <div class="col-md-12" style="margin-bottom: -20px;">
        <span style="font-style: italic; font-size: 11px; font-weight: bold;">CS Form No. 212</span><br>
        <p style="font-style: italic; font-size: 9px; font-weight: bold;">Revised 2017</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10" style="text-align: center;">
        <span style="font-weight:bold; font-size:28px;">PERSONAL DATA SHEET</span>
      </div>
      <div class="col-md-1"></div>
    </div>

    <div class="row">
      <div class="col-md-12" style="margin-bottom: -9px;">
        <p style="font-style: italic; font-weight:bold; font-size:8px;">WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.<br>
          <br>READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-8" style="margin-bottom: -9px;">
        <p style="font-size:8px;">Print legibly. Tick appropriate boxes (&#x25FB;) and use separate sheet if necessary. Indicate N/A if not applicable.  <b>DO NOT ABBREVIATE.</b></p>
      </div>
      <div class="col-sm-1 no-padding" style="padding:0; margin-bottom:-9px;">
        <p style="font-size:7px; border:solid 1px;" class="box-d-grey">1. CS ID No.</p>
      </div>
      <div class="col-sm-3 no-padding" style="margin-bottom: -9px;">
        <p style="font-size:7px; border:solid 1px; padding-left:75px;">(Do not fill up. For CSC use only)</p>
      </div>
    </div>

    {{-- PERSONAL INFO --}}
    <div class="row box-d-grey" style="border-top:solid 2px; border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">I. PERSONAL INFORMATION</span>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px; border-bottom-color: #e8e8e8;">
        <span style="font-size:8px;">&nbsp;&nbsp;2. &nbsp;SURNAME</span>
      </div>
      <div class="col-sm-10" style="border-bottom:solid 1px;">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->lastname) }}</span>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px; border-bottom-color: #e8e8e8;">
        <span style="font-size:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FIRSTNAME</span>
      </div>
      <div class="col-sm-7" style="border-bottom:solid 1px;">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->firstname) }}</span>
      </div>
      <div class="col-sm-3 box-l-grey no-padding" style="border-bottom:solid 1px; border-left:solid 1px;">
        <div class="col-sm-12 no-padding">
          <div class="col-sm-8 no-padding">
            <p style="font-size:7px;">NAME EXTENSION (JR., SR) </p>
          </div>
          <div class="col-sm-4 no-padding">
            <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->name_ext) }}</span>
          </div>
        </div>  
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MIDDLENAME</span>
      </div>
      <div class="col-sm-10" style="border-right:solid 1px;">
         <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->middlename) }}</span>
      </div>
    </div>


    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px; padding-bottom: 10px;">
        <p style="font-size:8px;">&nbsp;&nbsp;3. DATE OF BIRTH<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(mm/dd/yyyy)</p>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px; padding-bottom: 22px;">
       <span style="font-size:10px; font-weight:bold;">{{ __dataType::date_parse($employee->date_of_birth, 'm/d/Y') }}</span>
      </div>
      <div class="col-sm-3 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-bottom:solid 1px; border-bottom-color: #e8e8e8; padding-bottom: 2px;">
        <span style="font-size:8px;">16. CITIZENSHIP</span>
        <br>&nbsp;
      </div>
      <div class="col-sm-4">
        <span style="font-size:9px;">
          {!! $employee->citizenship == 'Filipino' ? '&#9745;' : '&#9723;' !!} Filipino
        </span> &nbsp;&nbsp;
        <span style="font-size:9px;">
          {!! $employee->citizenship == 'Dual Citizenship' ? '&#9745;' : '&#9723;' !!} Filipino Dual Citizenship
        </span> <br>
        <span style="font-size:9px; margin-left:55px;">
          {!! $employee->citizenship_type == 'BB' ? '&#9745;' : '&#9723;' !!} by birth
        </span> &nbsp;&nbsp;
        <span style="font-size:9px;">
          {!! $employee->citizenship_type == 'BN' ? '&#9745;' : '&#9723;' !!} by naturalization
        </span>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;4. PLACE OF BIRTH</span>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px;">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->place_of_birth) }}</span>
      </div>
      <div class="col-sm-3 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-bottom:solid 1px; border-bottom-color: #e8e8e8;">
        <span style="font-size:8px;">If holder of dual citizenship, </span>
      </div>
      <div class="col-sm-4" style="border-bottom:solid 1px;">
        <span style="font-size:8px;">Pls. indicate country:</span>
      </div>
    </div>

     <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;5. SEX</span>
      </div>
      <div class="col-sm-3">
        <span style="font-size:9px;">
          {!! $employee->sex == 'M' || $employee->sex == 'MALE'? '&#9745;' : '&#9723;' !!} Male</span> &nbsp;&nbsp;&nbsp;
        <span style="font-size:9px;">
          {!! $employee->sex == 'F' || $employee->sex == 'FEMALE'? '&#9745;' : '&#9723;' !!} Female
        </span>
      </div>
      <div class="col-sm-3 box-l-grey" style="border-left:solid 1px; border-right:solid 1px;">
        <span style="font-size:8px;">please indicate the details.</span>
      </div>
      <div class="col-sm-4">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->dual_citizenship_country)}}</span>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px; padding-bottom:49px;">
        <span style="font-size:8px;">&nbsp;&nbsp;6. CIVIL STATUS</span>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px; padding-bottom:9px;">
        <span style="font-size:9px;">
          {!! $employee->civil_status == 'SINGLE' ? '&#9745;' : '&#9723;' !!} SINGLE
        </span> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="font-size:9px;">
          {!! $employee->civil_status == 'MARRIED' ? '&#9745;' : '&#9723;' !!} MARRIED
        </span><br>
        <span style="font-size:9px;">
          {!! $employee->civil_status == 'WIDOWED' ? '&#9745;' : '&#9723;' !!} WIDOWED
        </span> 
        &nbsp;&nbsp;&nbsp;&nbsp;
        <span style="font-size:9px;">
          {!! $employee->civil_status == 'SEPERATED' ? '&#9745;' : '&#9723;' !!} SEPERATED
        </span><br>
        <span style="font-size:9px;">
          {!! $employee->civil_status == 'OTHERS' ? '&#9745;' : '&#9723;' !!} OTHER/S
        </span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-bottom:solid 1px; border-bottom-color: #e8e8e8; padding-bottom:39px;">
        <p style="font-size:8px;">17. RESIDENTIAL ADDRESS</p>
      </div>
      <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-right:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
          <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_block) }}</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_street) }}</span>
        </div>
        <div class="col-sm-12" style="border-bottom:solid 1px; margin-top:-7px;"> 
            <span style="font-size:8px; font-style:italic; margin-left: 25px;">House/Block/Lot No.</span>
            <span style="font-size:8px; font-style:italic; margin-left: 110px;">Street</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-right:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_village) }}</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_barangay) }}</span>
        </div>
        <div class="col-sm-12" style="margin-top:-7px;"> 
            <span style="font-size:8px; font-style:italic; margin-left: 25px;">Subdivision/Village</span>
            <span style="font-size:8px; font-style:italic; margin-left: 110px;">Barangay</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; padding-bottom:13px; border-bottom:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;7. HEIGHT (m)</span>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px; height:2.4em; padding-bottom:13px;">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->height) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-right:solid 1px;  border-bottom-color:#a7aaab; padding-bottom:15px;">
        &nbsp;
      </div>
      <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-right:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_city) }}</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_province) }}</span>
        </div>
        <div class="col-sm-12" style="margin-top:-7px;"> 
            <span style="font-size:8px; font-style:italic; margin-left: 30px;">City/Municipality</span>
            <span style="font-size:8px; font-style:italic; margin-left: 110px;">Province</span>
        </div>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;8. WEIGHT (kg)</span>
      </div>
      <div class="col-sm-3">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->weight) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ZIP CODE</span>
      </div>
      <div class="col-sm-5">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->res_address_zipcode) }}</span>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; padding-bottom:17px; border-bottom:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;9. BLOOD TYPE</span>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px; height:2.7em; padding-bottom:17px;">
         <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->blood_type) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-right:solid 1px;  border-bottom-color:#a7aaab; padding-bottom:6px;">
        <p style="font-size:8px;">18. PERMANENT ADDRESS</p>
      </div>
      <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-right:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_block) }}</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_street) }}</span>
        </div>
        <div class="col-sm-12" style="margin-top:-7px; padding-bottom:3px;"> 
            <span style="font-size:8px; font-style:italic; margin-left: 25px;">House/Block/Lot No.</span>
            <span style="font-size:8px; font-style:italic; margin-left: 110px;">Street</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; padding-bottom:14px; border-bottom:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;10. GSIS ID NO.</span>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px; height:2.5em; padding-bottom:14px;">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->gsis) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-right:solid 1px;  border-bottom-color:#a7aaab; padding-bottom: 15px;">
        &nbsp;
      </div>
      <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-right:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_village) }}</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_barangay) }}</span>
        </div>
        <div class="col-sm-12" style="margin-top:-7px;"> 
            <span style="font-size:8px; font-style:italic; margin-left: 25px;">Subdivision/Village</span>
            <span style="font-size:8px; font-style:italic; margin-left: 110px;">Barangay</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; padding-bottom:14px; border-bottom:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;11. PAG-IBIG ID NO.</span>
      </div>
      <div class="col-sm-3" style="border-bottom:solid 1px; height:2.5em; padding-bottom:14px;">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->hdmf) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px; border-right:solid 1px;  border-bottom-color:#a7aaab; padding-bottom: 15px;">
        &nbsp;
      </div>
      <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-right:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_city) }}</span>
        </div>
        <div class="col-sm-6 no-padding" style="border-bottom:solid 1px; border-bottom-color:#a7aaab; text-align: center;"> 
            <span style="font-size:7px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_province) }}</span>
        </div>
        <div class="col-sm-12" style="margin-top:-7px;"> 
            <span style="font-size:8px; font-style:italic; margin-left: 20px;">City/Municipality</span>
            <span style="font-size:8px; font-style:italic; margin-left: 100px;">Province</span>
        </div>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;12. PHILHEALTH NO.</span>
      </div>
      <div class="col-sm-3">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->philhealth) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ZIP CODE</span>
      </div>
      <div class="col-sm-5">
       <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeAddress)->perm_address_zipcode) }}</span>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;13. SSS NO.</span>
      </div>
      <div class="col-sm-3">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->sss) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px;">
        <span style="font-size:8px;">19.  TELEPHONE NO.</span>
      </div>
      <div class="col-sm-5">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->tel_no) }}</span>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <span style="font-size:8px;">&nbsp;&nbsp;14. TIN NO.</span>
      </div>
      <div class="col-sm-3">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->tin) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px;">
        <span style="font-size:8px;">20. MOBILE NO.</span>
      </div>
      <div class="col-sm-5">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->cell_no) }}</span>
      </div>
    </div>

    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <p style="font-size:7px; margin-top: 5px; margin-left: 2px;">15. AGENCY EMPLOYEE NO.</p>
      </div>
      <div class="col-sm-3">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->agency_no) }}</span>
      </div>
      <div class="col-sm-2 box-l-grey" style="border-left:solid 1px; border-right:solid 1px;">
        <p style="font-size:7px; margin-top: 5px;">21. E-MAIL ADDRESS (if any)</p>
      </div>
      <div class="col-sm-5">
        <span style="font-size:10px; font-weight:bold;">{{ __print::string_trap($employee->email) }}</span>
      </div>
    </div>


    {{-- FAMILY BACKGROUND --}}
    <div class="row box-d-grey" style="border-top:solid 2px; border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">II. FAMILY BACKGROUND</span>
      </div>
    </div>

    <div class="row">

      <div class="col-sm-7 no-padding" style="border-right:solid 1px;">

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:8px; margin-left:13px;">&nbsp;&nbsp;22. SPOUSE'S SURNAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_lastname) }}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:8px; margin-left:17px;">&nbsp;&nbsp;FIRSTNAME</span>
      	</div>
      	<div class="col-pds-8" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_firstname) }}</span>
      	</div>
      	<div class="col-pds-2 box-l-grey no-padding" style="border-left:solid 1px; border-bottom:solid 1px;">
      		<div class="col-sm-12 no-padding">
            <div class="col-sm-10 no-padding">
              <p style="font-size:7px;">NAME EXTENSION (JR., SR) </p>
            </div>
            <div class="col-sm-2 no-padding">
              <span style="font-size:8px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_name_ext) }}</span>
            </div>
          </div>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px;">
      		<span style="font-size:8px; margin-left:15px;">&nbsp;&nbsp;MIDDLENAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_middlename)}}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px;">
      		<span style="font-size:8px; margin-left:15px;">&nbsp;&nbsp;OCCUPATION</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_ocupation)}}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px;">
      		<span style="font-size:7px; margin-left:15px;">&nbsp;&nbsp;EMPLOYER/BUSINESS NAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_employer)}}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px; ">
      		<span style="font-size:8px; margin-left:15px;">&nbsp;&nbsp;BUSINESS ADDRESS</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->spouse_business_address)}}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:8px; margin-left:13px;">&nbsp;&nbsp;24. FATHER'S SURNAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->father_lastname)}}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:8px; margin-left:17px;">&nbsp;&nbsp;FIRSTNAME</span>
      	</div>
      	<div class="col-pds-8" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->father_firstname)}}</span>
      	</div>
      	<div class="col-pds-2 box-l-grey no-padding" style="border-left:solid 1px; border-bottom:solid 1px;">
      		<div class="col-sm-12 no-padding">
            <div class="col-sm-10 no-padding">
              <p style="font-size:7px;">NAME EXTENSION (JR., SR) </p>
            </div>
            <div class="col-sm-2 no-padding">
              <span style="font-size:8px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->father_name_ext)}}</span>
            </div>
          </div>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; border-bottom:solid 1px;">
      		<span style="font-size:8px; margin-left:15px;">&nbsp;&nbsp;MIDDLENAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->father_middlename) }}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:7px; margin-left:13px;">&nbsp;&nbsp;25. MOTHER'S MAIDEN NAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px;">
      		<span style="font-size:8px;">&nbsp;&nbsp;</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:8px; margin-left:17px;">&nbsp;&nbsp;SURNAME</span>
      	</div>
      	<div class="col-pds-10" style="border-bottom:solid 1px; padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->mother_lastname) }}</span>
      	</div>

      	<div class="col-pds-2 box-l-grey" style="border-right:solid 1px; padding-bottom: 1px;">
      		<span style="font-size:8px; margin-left:17px;">&nbsp;&nbsp;FIRSTNAME</span>
      	</div>
      	<div class="col-pds-10" style="padding-left: 10px;">
      		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->mother_firstname) }}</span>
      	</div>

      </div>


      <div class="col-sm-5 no-padding">

        <div class="col-sm-7 box-l-grey no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
      		<span style="font-size:7px;">&nbsp;23. NAME of CHILDREN (Write full name and list all)</span>
      	</div>
      	<div class="col-sm-5 box-l-grey no-padding" style="border-bottom:solid 1px;">
      		<span style="font-size:7px;">&nbsp; DATE OF BIRTH (mm/dd/yyyy)</span>
      	</div>
        
        @foreach ($employee->employeeChildren as $key => $data)
          @if($key <= 10)
            <div class="col-sm-7 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 2px;">{{ $data->fullname }}</span>
            </div>
            <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 2px;">{{ __dataType::parse($data->date_of_birth) }}</span>
            </div>
          @endif
        @endforeach

        @if(count($employee->employeeChildren) < 11)
          <?php $diff = 11 - count($employee->employeeChildren); ?>
          @for ($i = 0; $i < $diff; $i++)
            <div class="col-sm-7 no-padding" style="border-right:solid 1px; border-bottom:solid 1px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 2px;">&nbsp;</span>
            </div>
            <div class="col-sm-5 no-padding" style="border-bottom:solid 1px;">
              <span style="font-size:8px; font-weight:bold; padding-left: 2px;">&nbsp;</span>
            </div>
          @endfor
        @endif

      </div>

    </div>


    <div class="row" style="border-bottom:solid 1px;">
      	<div class="col-sm-2 box-l-grey no-padding" style="border-right:solid 1px; margin-left: -1px;">
	  		<span style="font-size:8px; margin-left:17px;">&nbsp;&nbsp;&nbsp;MIDDLENAME</span>
	  	</div>
	  	<div class="col-sm-5" style="border-right:solid 1px; border-top:solid 1px; margin-left:1px; padding-left: 10px;">
	  		<span style="font-size:10px; font-weight:bold;">{{ __print::string_trap(optional($employee->employeeFamilyDetail)->mother_middlename) }}</span>
	  	</div>
	  	<div class="col-sm-5 box-l-grey" style="border-right:solid 1px; border-top:solid 1px; ">
	  		<p style="font-size: 7px; text-align: center; color:red !important; font-style: italic; -webkit-print-color-adjust: exact; margin-top: 5px; margin-bottom: 5px;">
	  			(Continue on a seperate sheet if necessary)
	  		</p>
	  	</div>
    </div>


    {{-- EDUCATIONAL BACKGROUND --}}
    <div class="row box-d-grey" style="border-bottom:solid 2px;">
      <div class="col-sm-12">
        <span class="title-l">III. EDUCATIONAL BACKGROUND</span>
      </div>
    </div>

    {{-- EB Header --}}
    <div class="row" style="border-bottom:solid 1px;">
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
      	<span style="font-size:8px;">26.</span>
      	<span style="font-size:8px; padding-left:27px;"> LEVEL</span>
      	<br>&nbsp;
      </div>
      <div class="col-sm-2 box-l-grey" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:7px;">NAME OF SCHOOL<br>(Write in full)</p>
      </div>
      <div class="col-sm-3 box-l-grey" style="border-right:solid 1px;">
        <p style="font-size:8px; text-align: center; padding-top:7px;">BASIC EDUCATION/DEGREE/COURSE<br>(Write in full)</p>
      </div>
      <div class="col-sm-2 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:7px; text-align: center; padding-top:7px;">PERIOD OF ATTENDANCE</p>
        <div class="col-sm-12 no-padding" style="border-top: solid 1px; margin-bottom: -9px;">
        	<div class="col-sm-6" style="border-right:solid 1px;">
        		<p style="font-size:7px; text-align: center;">From</p>
        	</div>
        	<div class="col-sm-6">
        		<p style="font-size:7px; text-align: center;">To</p>
        	</div>
        </div>
      </div>
      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:6px; text-align: center; padding-top: 5px;">HIGHEST LEVEL/<br>UNITS EARNED<br>(if not graduated)</p>
      </div>
      <div class="col-sm-1 box-l-grey no-padding" style="border-right:solid 1px;">
        <p style="font-size:7px; text-align: center; padding-top: 9px;">YEAR<br>GRADUATED</p>
      </div>
      <div class="col-sm-1 box-l-grey" style="border-right:solid 1px; padding:0;">
        <p style="font-size:6px; text-align: center; padding-right: 11px; margin-bottom:7px;">SCHOLARSHIP/<br>ACADEMIC<br>HONORS<br>RECEIVED</p>
      </div>
    </div>

    {{-- EB Content --}}

    @foreach ($employee->employeeEducationalBackground as $data)

      <div class="row" style="border-bottom:solid 1px;">
        <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; height: 1.9em; margin-bottom: -5px; padding-bottom: 5px; overflow: hidden;">
          <p style="{!! $data->level == 'VOCATIONAL/TRADE COURSE' || $data->level == 'GRADUATE STUDIES' ? 'font-size:7px;' : 'font-size:8px;' !!} padding-left:18px;">
            {{ $data->level }}
          </p>
        </div>
        <div class="col-sm-2 no-padding" style="border-right:solid 1px; height: 1.9em; margin-bottom: -5px; padding-bottom: 5px; overflow: hidden;">
          <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">{{ $data->school_name }}</p>
        </div>
        <div class="col-sm-3 no-padding" style="border-right:solid 1px; height: 1.9em; margin-bottom: -5px; padding-bottom: 5px; overflow: hidden;">
          <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">{{ $data->course }}</p>
        </div>
        <div class="col-sm-2 no-padding" style="border-right:solid 1px; height: 1.9em; margin-bottom: -5px; padding-bottom: 5px; overflow: hidden;">
          <div class="col-sm-12 no-padding">
            <div class="col-sm-6 no-padding" style="border-right:solid 1px; height: 1.9em; margin-bottom: -5px; padding-bottom: 5px; overflow: hidden; text-align: center;">
              <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">{{ $data->date_from }}</p>
            </div>
            <div class="col-sm-6" style="height: 1.9em; text-align: center;">
              <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">{{ $data->date_to }}</p>
            </div>
          </div>
        </div>
        <div class="col-sm-1 no-padding" style="border-right:solid 1px; height: 1.9em; text-align: center;">
          <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">{{ $data->units }}</p>
        </div>
        <div class="col-sm-1 no-padding" style="border-right:solid 1px; height: 1.9em; text-align: center;">
          <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">{{ $data->graduate_year }}</p>
        </div>
        <div class="col-sm-1 no-padding" style="border-right:solid 1px; height: 1.9em;">
          <p style="font-size:6px; font-weight:bold; padding-top: 4px; padding-left: 1px; padding-right: 5px;">{{ $data->scholarship }}</p>
        </div>
      </div>

    @endforeach

    
    @if(count($employee->employeeEducationalBackground) == 0)
      @foreach($level as $data)
      
        <div class="row" style="border-bottom:solid 1px;">
          <div class="col-sm-2 box-l-grey" style="border-right:solid 1px; padding:0; padding-bottom: 6px;">
            <span style="{!! $data == 'VOCATIONAL/TRADE COURSE' ? 'font-size:7px;' : 'font-size:8px;' !!}padding-left:18px;">
              {{ $data }}
            </span>
          </div>
          <div class="col-sm-2 no-padding" style="border-right:solid 1px; height: 1.9em;">
            <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">&nbsp;</p>
          </div>
          <div class="col-sm-3 no-padding" style="border-right:solid 1px; height: 1.9em;">
            <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">&nbsp;</p>
          </div>
          <div class="col-sm-2 no-padding" style="border-right:solid 1px; height: 1.9em;">
            <div class="col-sm-12 no-padding">
              <div class="col-sm-6 no-padding" style="border-right:solid 1px; height: 1.9em; text-align: center;">
                <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">&nbsp;</p>
              </div>
              <div class="col-sm-6" style="height: 1.9em; text-align: center;">
                <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">&nbsp;</p>
              </div>
            </div>
          </div>
          <div class="col-sm-1 no-padding" style="border-right:solid 1px; height: 1.9em; text-align: center;">
            <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">&nbsp;</p>
          </div>
          <div class="col-sm-1 no-padding" style="border-right:solid 1px; height: 1.9em; text-align: center;">
            <p style="font-size:7px; font-weight:bold; padding-left: 5px; padding-top: 4px;">&nbsp;</p>
          </div>
          <div class="col-sm-1 no-padding" style="border-right:solid 1px; height: 1.9em;">
            <p style="font-size:6px; font-weight:bold; padding-top: 4px; padding-left: 1px; padding-right: 5px;">&nbsp;</p>
          </div>
        </div>

      @endforeach
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
		<p class="pull-right" style="font-size:8px; padding-right: 20px;">CS FORM 212 (Revised 2017), Page 1 of 4</p>
	</div>
</div>



</body>
</html>

