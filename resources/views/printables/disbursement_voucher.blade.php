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

      margin-bottom: -1000px; 
      padding-bottom: 1000px; 
      overflow: hidden;

    }

  </style>

</head>
<body {{-- onload="window.print();" --}}>

<div style="border:solid;">

  <div class="wrapper">


      {{-- HEADER --}}
      <div class="row" style="padding:20px;">
        
        <div class="col-md-1"></div>

        <div class="col-md-10">

            <div class="col-sm-2"></div>

            <div class="col-sm-2">
              <img src="{{ asset('images/sra.png') }}" style="width:120px;">
            </div>

            <div class="col-sm-8" style="text-align: center; padding-right:150px;">
              <span>Republic of the Philippines</span><br>
              <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
              <span>North Avenue, Diliman, Quezon City</span>
            </div>

            <div class="col-sm-1"></div>

        </div>

      </div>


      {{-- DOCUMENT NAME --}}
      <div class="row" style="border-top:solid;">
        
        <div class="col-sm-9" style="border-right:solid; text-align: center; padding-top:10px; padding-bottom:10px;"> 
          <span style="font-weight:bold; font-size:20px;">DISBURSEMENT VOUCHER</span>
        </div>

        <div class="col-sm-3">
          <span style="font-size:9px;">No.:</span><br>
          <span style="font-size:12px; font-weight:bold; line-height: 1.2;">TEST</span>
        </div>

      </div>


      {{-- MODE OF PAYMENT --}}
      <div class="row" style="border-top:solid;">
        
        <div class="col-sm-1 div-height" style="border-right:solid; line-height: 1;"> 
          <span style="font-size:10px; font-weight:bold; white-space: nowrap;">Mode of</span>
          <br><span style="font-size:10px; font-weight:bold;">Payment</span>
        </div>

        <div class="col-sm-11 div-height">
          <p>Test</p>
        </div>

      </div>


      {{-- PAYEE --}}
      <div class="row" style="border-top:solid; overflow:hidden;">
        
        <div class="col-sm-1 div-height" style="border-right:solid; text-align: center;"> 
          <p style="font-size:11px; padding-top:12px; padding-bottom:5px; padding-left:3px;">Payee:</p>
        </div>

        <div class="col-sm-5 div-height" style="border-right:solid;">
          <span style="font-size:12px; word-wrap: break-word;">Test</span>
        </div>

        <div class="col-sm-3 div-height" style="border-right:solid; line-height: 1.3;">
          <span style="font-size:9px;">TIN / Employee No.:</span>
          <br><span style="font-size:12px; font-weight:bold;">TEST</span>
        </div>

        <div class="col-sm-3" style="line-height: 1.3;">
          <span style="font-size:9px;"> BUR No.:</span>
          <br><span style="font-size:12px; font-weight:bold;">TEST</span>
        </div>

      </div>


      {{-- ADDRESS --}}
      <div class="row" style="border-top:solid; overflow:hidden;">
        
        <div class="col-sm-1 div-height" style="border-right:solid; text-align: center;"> 
          <p style="font-size:11px; padding-top:20px; padding-bottom:5px;">Address:</p>
        </div>

        <div class="col-sm-5 div-height" style="border-right:solid;">
          <span style="font-size:12px; word-wrap: break-word;">Test</span>
        </div>


        <div class="col-sm-6" style="padding:0%; margin-top:-6px; overflow:hidden;">
          
          <div class="col-sm-12" style="border-bottom:solid; width: 100%; text-align: center;">
            <span style="font-size:9px;">Resposibility Center</span>
          </div>

          <div class="col-sm-6" style="border-right:solid;">
            <span style="font-size:9px;">Office/Unit/Project:</span>
            <br><span style="font-size:12px; font-weight:bold;">TEST</span>
          </div>

          <div class="col-sm-6">
            <span style="font-size:9px;">Code:</span>
            <br><span style="font-size:12px; font-weight:bold;">TEST</span>
          </div>

        </div>


      </div>



  </div>

</div>

</body>
</html>

@section('scripts')

  <script type="text/javascript">
    $('body').layout('fix')
  </script>

@endsection