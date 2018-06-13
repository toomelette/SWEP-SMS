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

</head>
<body onload="window.print();" onafterprint="window.close()">

<div style="border:solid;">

  <div class="wrapper">


    {{-- HEADER --}}
    <div class="row">
      <div class="col-md-12">
        <span style="font-style: italic; font-size: 12px; font-weight: bold;">CS Form No. 212</span><br>
        <p style="font-style: italic; font-size: 10px;">Revised 2017</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10" style="text-align: center;">
        <span style="font-weight:bold; font-size:35px;">PERSONAL DATA SHEET</span>
      </div>
      <div class="col-md-1"></div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <p style="font-style: italic; font-weight:bold; font-size:9px;">WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the 
          <br>person concerned.
          <br>READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.
        </p>
      </div>
    </div>

    <div class="row" style=" ">
      <div class="col-sm-8">
        <p style="font-size:7px;">Print legibly. Tick appropriate boxes (     ) and use separate sheet if necessary. Indicate N/A if not applicable.  <b>DO NOT ABBREVIATE.</b></p>
      </div>
      <div class="col-sm-1" style="border:solid 1px; padding:0;">
        <p style="font-size:7px;">1. CS ID No.</p>
      </div>
      <div class="col-sm-3" style="border:solid 1px; padding:0;">
        <p style="font-size:7px;" class="pull-right">(Do not fill up. For CSC use only)</p>
      </div>
    </div>


  </div>

</div>


{{-- SUFFIX --}}
<div class="row">
  
  <div class="col-sm-8 div-height">
    <p style="font-size:10px;">Username: {!! Auth::user()->username !!}</p>
  </div>

</div>


</body>
</html>

