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
      
    .div-height{

      margin-bottom: -50px; 
      padding-bottom: 50px; 
      overflow: hidden;

    }

  </style>

</head>
<body onload="window.print();" onafterprint="window.close()">

<div style="border:solid;">

  <div class="wrapper">


      {{-- HEADER --}}
      <div class="row" style="padding:10px;">
        
        <div class="col-md-1"></div>

        <div class="col-md-12">

            <div class="col-sm-2"></div>

            <div class="col-sm-2">
              <img src="{{ asset('images/sra.png') }}" style="width:120px;">
            </div>

            <div class="col-sm-8" style="text-align: center; padding-right:125px;">
              <span>Republic of the Philippines</span><br>
              <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
              <span>North Avenue, Diliman, Quezon City</span>
            </div>

        </div>

        <div class="col-md-1"></div>

      </div>


      {{-- DOCUMENT NAME --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-9" style="border-right:solid 1.4px; text-align: center; padding-top:9px; padding-bottom:9px;"> 
          <span style="font-weight:bold; font-size:20px;">DISBURSEMENT VOUCHER</span>
        </div>

        <div class="col-sm-3" style="padding-left:0;">
          <p style="font-size:9px; padding-left:2px;">No.:</p>
          <span style="font-size:12px; font-weight:bold; padding-left:15px;">{!! $disbursement_voucher->dv_no !!}</span>
        </div>

      </div>


      {{-- MODE OF PAYMENT --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px; line-height: 1; text-align: center;"> 
          <span style="font-size:12px; font-weight:bold; white-space: nowrap;">Mode of</span>
          <br><span style="font-size:12px; font-weight:bold;">Payment</span>
        </div>

        <div class="col-sm-10" style="padding-top:5px;">
          @foreach(__static::dv_mode_of_payment() as $key => $data)
            <div class="col-sm-1" style="padding-left: 50px;">
              @if($key == $disbursement_voucher->mode_of_payment)
                <div style="width: 20px; height: 20px; border: 10px solid;"></div>
              @else
                <div style="width: 20px; height: 20px; border: 1.4px solid;"></div>
              @endif
            </div>
            <div class="col-sm-1" style="padding-left: 20px;">
              <span style="font-weight:bold;">{{ $data }}</span>
            </div>
          @endforeach
        </div>

      </div>


      {{-- PAYEE --}}
      <div class="row" style="border-top:solid 1.4px; overflow:hidden;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;"> 
          <p style="font-size:12px; padding-top:10px; padding-bottom:5px; padding-left: 3px; font-weight:bold;">Payee:</p>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px; padding-left: 0;">
          <span style="font-size:12px; font-weight:bold; word-wrap: break-word; margin-left: 2px;">{!! $disbursement_voucher->payee !!}</span>
        </div>

        <div class="col-sm-3 div-height" style="border-right:solid 1.4px; line-height: 1.3; padding-left:0;">
          <span style="font-size:9px; padding-left:2px;">TIN / Employee No.:</span>
          <br><span style="font-size:12px; font-weight:bold; padding-left:15px;">{!! $disbursement_voucher->tin !!}</span>
        </div>

        <div class="col-sm-3" style="line-height: 1.3; padding-left:0;">
          <span style="font-size:9px; padding-left:2px;"> BUR No.:</span>
          <br><span style="font-size:12px; font-weight:bold; padding-left:15px;">{!! $disbursement_voucher->bur_no !!}</span>
        </div>

      </div>


      {{-- ADDRESS --}}
      <div class="row" style="border-top:solid 1.4px; overflow:hidden;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;"> 
          <p style="font-size:12px; padding-top:10px; padding-bottom:5px; padding-left: 3px; font-weight:bold;">Address:</p>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px; padding-left: 0;">
          <span style="font-size:12px; font-weight:bold; word-wrap: break-word; margin-left: 2px;">{!! $disbursement_voucher->address !!}</span>
        </div>


        <div class="col-sm-6" style="padding:0%; margin-top:-6px; overflow:hidden;">
          
          <div class="col-sm-12" style="border-bottom:solid 1.4px; width: 100%; text-align: center;">
            <span style="font-size:10px; font-weight:bold;">Responsibility Center</span>
          </div>

          <div class="col-sm-6" style="border-right:solid 1.4px; padding-left:0; line-height:1.3;">
            <span style="font-size:9px; padding-left:2px;">Office/Unit/Project:</span>
            <br><span style="font-size:12px; font-weight:bold; padding-left:15px;">{!! optional($disbursement_voucher->departmentUnit)->description !!}</span>
          </div>

          <div class="col-sm-6" style="padding-left:0; line-height:1.3;">
            <span style="font-size:9px; padding-left:2px;">Code:</span>
            <br><span style="font-size:12px; font-weight:bold; padding-left:15px; padding-bottom:5px;">{!! $disbursement_voucher->project_code !!}</span>
          </div>

        </div>

      </div>


      {{-- EXPLANATION --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-9" style="border-right:solid 1.4px; text-align: center; padding-top:2px; padding-bottom:2px;"> 
          <span style="font-weight:bold; font-size:15px;">EXPLANATION</span>
        </div>

        <div class="col-sm-3" style="border-right:solid; text-align: center; padding-top:2px; padding-bottom:2px;"> 
          <span style="font-weight:bold; font-size:15px;">AMOUNT</span>
        </div>

      </div>


      {{-- EXPLANATION VALUE --}}
      <div class="row" style="border-top:solid 1.4px; height:26em; overflow: hidden;">
        
        <div class="col-sm-9" style="border-right:solid 1.4px; padding-left:20px; margin-bottom: -600px; padding-bottom: 600px;"> 
          <p style="font-family:Arial; font-size:16px; white-space: pre-wrap; white-space: -moz-pre-wrap;  white-space: -pre-wrap; white-space: -o-pre-wrap; word-wrap: break-word;">{!! $disbursement_voucher->explanation !!}</p>
        </div>

        <div class="col-sm-3" style="border-right:solid 1.4px; text-align: center; padding-top: 20px;"> 
          <span style="font-weight:bold; font-size:15px;">{{ number_format($disbursement_voucher->amount, 2) }}</span>
        </div>

      </div>


      {{-- CERT & APPR HEAD --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-6" style="border-right:solid 1.4px;"> 
          <span style="border-right: solid 1.4px; border-bottom: solid 1.4px; padding:4px; font-weight:bold;">A</span>
          <p style="margin-left:40px; margin-top:-10px; font-weight:bold;">Certified</p>
          <p style="margin-left:100px; margin-top:-7px;">Supporting documents complete</p>
        </div>

        <div class="col-sm-6 div-height" style="border-right:solid 1.4px; padding-left: 0;"> 
          <span style="border-right: solid 1.4px; border-bottom: solid 1.4px; padding:4px; font-weight:bold;">B</span>
          <p style="margin-left:40px; margin-top:-10px; font-weight:bold;">Approved for Payment</p>
          <p style="margin-left:200px; margin-top:-7px; font-weight:bold;">{{ number_format($disbursement_voucher->amount, 2) }}</p>
        </div>

      </div>


      {{-- SIGNATURES --}}
      <div class="row" style="border-top:solid 1.4px; margin-top: -2px; margin-bottom:5px;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;"> 
          <span style="font-size:12px;">&nbsp;Signature:</span>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px;">
          &nbsp;
        </div>

        <div class="col-sm-2 div-height" style="border-right:solid 1.4px; padding-left:0;"> 
          <span style="font-size:12px;">&nbsp;Signature:</span>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px;"> 
          &nbsp;
        </div>

      </div>


      {{-- NAMES --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;"> 
          <span style="font-size:12px;">&nbsp;Printed Name:</span>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px;">
          @foreach($global_signatories_all as $data)
            @if($data->type == 2)
              <span style="font-size:12px; font-weight:bold;">&nbsp;{{ $data->employee_name }}</span>
            @endif
          @endforeach
        </div>

        <div class="col-sm-2 div-height" style="border-right:solid 1.4px; padding-left:0;"> 
          <span style="font-size:12px;">&nbsp;Printed Name:</span>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px;"> 
          @foreach($global_signatories_all as $data)
            @if($data->type == 1)
              <span style="font-size:12px; font-weight:bold;">&nbsp;{{ $data->employee_name }}</span>
            @endif
          @endforeach
        </div>

      </div>


      {{-- POSITION --}}
      <div class="row" style="border-top:solid 1.4px; overflow: hidden;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;"> 
          <span style="font-size:12px;">&nbsp;Position:</span>
        </div>

        <div class="col-sm-4" style="border-right:solid 1.4px; padding:0%; margin-top:-6px; overflow:hidden;">

          <div class="col-sm-12" style="border-bottom:solid 1.4px; width: 100%; padding-top:5px; padding-bottom:5px;">
            @foreach($global_signatories_all as $data)
              @if($data->type == 2)
                <span style="font-size:12px; font-weight:bold;">&nbsp;{{ $data->employee_position }}</span>
              @endif
            @endforeach
          </div>

          <div class="col-sm-12" style="">
            <span style="font-size:9px;">Head, Accounting Unit/Authorized Representative</span>
          </div>

        </div>

        <div class="col-sm-2 div-height" style="border-right:solid 1.4px; padding-left:0;"> 
          <span style="font-size:12px;">&nbsp;Position:</span>
        </div>

        <div class="col-sm-4" style="border-right:solid 1.4px; padding:0%; margin-top:-6px; overflow:hidden;">

          <div class="col-sm-12" style="border-bottom:solid 1.4px; width: 100%; padding-top:5px; padding-bottom:5px;">
            @foreach($global_signatories_all as $data)
              @if($data->type == 1)
                <span style="font-size:12px; font-weight:bold;">&nbsp;{{ $data->employee_position }}</span>
              @endif
            @endforeach
          </div>

          <div class="col-sm-12">
            <span style="font-size:9px;">Agency Head / Authorized Representative</span>
          </div>

        </div>

      </div>


      {{-- DATE --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-2" style="border-right:solid 1.4px; overflow: hidden"> 
          <span style="font-size:12px;">&nbsp;Date:</span>
        </div>

        <div class="col-sm-4" style="border-right:solid 1.4px;">
          &nbsp;
        </div>

        <div class="col-sm-2" style="border-right:solid 1.4px; padding-left:0;"> 
          <span style="font-size:12px;">&nbsp;Date:</span>
        </div>

        <div class="col-sm-4" style="border-right:solid 1.4px;">
          &nbsp;
        </div>

      </div>


      {{-- RECIEVED PAYMENT --}}
      <div class="row" style="border-top:solid 1.4px;">
        
        <div class="col-sm-8" style="border-right:solid 1.4px;"> 
          <span style="border-right: solid 1.4px; padding-top:4px; padding-right:4px; padding-left:4px; padding-bottom:2px; font-weight:bold;">C</span>
          <span style="font-weight:bold; font-weight:bold; margin-left:10px;">Received Payment:</span>
        </div>

        <div class="col-sm-4" style="border-right:solid 1.4px; padding-left:0;"> 
          <span style="font-size:13px; font-weight:bold;">&nbsp;JEV No.</span>
        </div>

      </div>


      {{-- CHECK / ADA NO. --}}
      <div class="row" style="padding-bottom: 5px; overflow:hidden;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px; border-top: solid 1.4px;">
          <p style="font-size:10px;">&nbsp;Check/ADA No.:</p>
        </div>

        <div class="col-sm-2 div-height" style="border-right:solid 1.4px; border-top: solid 1.4px;"> 
          &nbsp;
        </div>

        <div class="col-sm-1 div-height" style="border-right:solid 1.4px; border-top: solid 1.4px; padding-left:0;"> 
         <p style="font-size:9px;">&nbsp;Date:</p>
        </div>

        <div class="col-sm-3 div-height" style="border-right:solid 1.4px; border-top: solid 1.4px; padding-left:0;"> 
          <p style="font-size:9px;">&nbsp;Bank Name:</p>
        </div>

      </div>


      {{-- SIGNATURE 2 --}}
      <div class="row" style="padding-bottom: 5px; border-top:solid 1.4px; overflow:hidden;">
        
        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;">
          <p style="font-size:11px;">&nbsp;Signature:</p>
        </div>

        <div class="col-sm-2 div-height" style="border-right:solid 1.4px;"> 
          &nbsp;
        </div>

        <div class="col-sm-1 div-height" style="border-right:solid 1.4px; padding-left:0;"> 
         <p style="font-size:9px;">&nbsp;Date:</p>
        </div>

        <div class="col-sm-3 div-height" style="border-right:solid 1.4px; padding-left:0;"> 
          <p style="font-size:9px;">&nbsp;Printed Name:</p>
        </div>

        <div class="col-sm-4" style="padding-left:0;"> 
          <span style="font-size:13px; font-weight:bold;">&nbsp;Date:</span>
        </div>

      </div>


      {{-- OR --}}
      <div class="row" style="padding-bottom: 5px;">
        
        <div class="col-sm-8 div-height" style="border-right:solid 1.4px; border-top:solid 1.4px;">
          <p style="font-size:10px;">&nbsp;Official Receipt (OR)/Other Documents:</p>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid 1.4px; padding-left:0;"> 
          <span style="font-size:9px;">&nbsp;</span>
        </div>

      </div>


  </div>

</div>


{{-- SUFFIX --}}
<div class="row">
  
  <div class="col-sm-8 div-height">
    <p style="font-size:10px;">Username: {!! Auth::user()->username !!} | Doc No: {{ $disbursement_voucher->doc_no }}</p>
  </div>

  <div class="col-sm-4 div-height" style="border-right:solid; padding-left:0; line-height: 1.2;"> 
    <span style="font-size:11px;">FM-AFD-ACC-001, Rev. 00</span>
    <br><span style="font-size:11px;">Effective Date : March 12, 2015</span>
  </div>

</div>


</body>
</html>

