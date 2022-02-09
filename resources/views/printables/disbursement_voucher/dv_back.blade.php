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
    
    .arrow {
      position: absolute;
      overflow: hidden;
      display: inline-block;
      font-size: 3px;
      width: 3em;
      height: 3em;
      border-top: 2px solid black;
      border-right: 2px solid black ;
      transform: rotate(54deg) skew(20deg);
    }

  </style>

</head>

{{--<body onload="window.print();" onafterprint="window.close()">--}}
<body>
  <div class="wrapper">

    {{-- HEADER --}}
    <div class="col-sm-12" style="margin-top:40px;">
      <center>
        <h5>DISBURSEMENT VOUCHER (DV)</h5>
        <span style="font-style:italic; font-size: 10px;">INSTRUCTIONS</span> 
      </center>
    </div>
    <div class="col-sm-12" style="margin-top:10px;"></div>


    {{-- LEFT CONTENT --}}
    <div class="col-sm-6">
      <div class="row">

        <div class="col-sm-2">
          <span style="float:right; font-size:10px">A.</span>
        </div>
        <div class="col-sm-10" style="line-height:1.2;">
          <p style="font-size:10px;"> The DV shall be printed in one whole sheet of <br>
          8 1/2 x 11 size bond paper. This shall be prepared <br>
            in three copies to be distributed as follows:</p>
          <span style="font-size:10px;"><span style="font-style: italic;">Original</span> - Accounting Unit</span><br>
          <span style="font-size:10px;"><span style="font-style: italic;">Duplicate</span> - Cash Unit</span><br>
          <span style="font-size:10px;"><span style="font-style: italic;">Triplicate</span> - Payee</span>
        </div>
        <div class="col-sm-12" style="margin-top:10px;"></div>


        <div class="col-sm-2">
          <span style="float:right; font-size:10px">B.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"> The Accounting Unit shall stamp the date of<br>
          receipt on the face of this form.</p>
        </div>
        <div class="col-sm-12" style="margin-top:10px;"></div>


         <div class="col-sm-2">
          <span style="float:right;">c.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"> This form shall be accomplished in the following<br>
          manner:</p>
          <div class="row">

            <div class="col-sm-2">
              <span style="float:right; font-size:10px; ">1.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>DV No./Date</strong> - number assigned to the DV <br>
              by the Accounting Unit and the date of DV <br>
              preparation. It shall be numbered as follows:</p>
              <u style="font-size:10px;">0000</u> &nbsp;&nbsp;&nbsp; <u style="font-size:10px;">00</u> &nbsp;&nbsp;&nbsp; <u style="font-size:10px;">0000</u>
              <div class="row">
                <div style="border-left: 2px solid; width: 95px; border-bottom: 2px solid; height: 60px; margin-left:26px;">
                  <div class="arrow" style="margin-top: 55px; margin-left: 85px;"></div>
                </div>
                <div style="border-left: 2px solid; width: 60px; border-bottom: 2px solid; height: 47px; margin-left:61px; margin-top:-60px;">
                  <div class="arrow" style="margin-top: 41px; margin-left: 50px;"></div>
                </div>
                <div style="border-left: 2px solid; width: 22px; border-bottom: 2px solid; height: 25px; margin-left:98px; margin-top:-47px;">
                  <div class="arrow" style="margin-top: 20px; margin-left: 12px;"></div>
                </div>
                <div class="row"> 
                  <p style="margin-left:145px; margin-top:-11px; font-size:10px;">
                    Serial number<br>
                    (one series each year)<br>
                    <span>Month</span><br>
                    <span>Year</span>
                  </p><br>
                </div>
              </div>
            </div>

            <div class="col-sm-2">
              <span style="float:right; font-size:10px;">2.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>Mode of Payment</strong> - put a check " . " mark in <br>
              the appropriate box opposite the mode of <br>
              payment.</p>
            </div>
            <div class="col-sm-2">
              <span style="float:right; font-size:10px;">3.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>Payee</strong> - name of the payee/creditor<br></p>
            </div>
            <div class="col-sm-2">
              <span style="float:right; font-size:10px;">4.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>TIN/Employee No.</strong> - Tax Identification<br>
              Number (TIN) of the claimant/Identification<br>
              Number assigned by the agency to the officer/<br>
              employee.
              </p>
            </div>
            <div class="col-sm-2">
              <span style="float:right; font-size:10px;">5.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>BUR No.</strong> - Number of the Budget Utilization<br>
              Request supporting the DV.
              </p>
            </div>
            <div class="col-sm-2">
              <span style="float:right; font-size:10px;">6.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>Address</strong> - address of the claimant</p>
            </div>
            <div class="col-sm-2">
              <span style="float:right; font-size:10px;">7.</span>
            </div>
            <div class="col-sm-10">
              <p style="font-size:10px;"><strong>Responsibility Center (Office/Unit/Project and <br> 
              Code)</strong> - the office/unit/project and code assigned<br>
              to the cost center where the disbursement shall<br>
              be charged.</p>
            </div>

          </div>
        </div>

      </div>
    </div>


    {{-- RIGHT CONTENT --}}
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-2">
          <span style="float:right; font-size:10px;">8.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"><strong>Explanation</strong> - brief description of the disbursement</p>
        </div>
        <div class="col-sm-2">
          <span style="float:right; font-size:10px;">9.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"><strong>Amount</strong> - amount of claim</p>
        </div>
        <div class="col-sm-2">
          <span style="float:right; font-size:10px;">10.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"><strong>Certified (Box A)</strong> - certification by the Head of<br>
          Accounting Unit or his authorized representative<br>
          as to completeness of supporting documents.<br>
          The certifying officer shall affix his signature, print<br>
          his name, indicate his position, and the date of his<br>
          signing on the spaces provided. </p>
        </div>
        <div class="col-sm-2">
          <span style="float:right; font-size:10px;">11.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"><strong>Approved for Payment (Box B)</strong> - approval by the<br>
          Head of the Agency or his Authorized Representative<br>
          on the payment covered by the DV.<br>
          The approving officer shall affix his signature, print<br>
          his name, indicate his position, and the date of his<br>
          signing on the spaces provided.</p>
        </div>
        <div class="col-sm-2">
          <span style="float:right; font-size:10px;">12.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px;"><strong>Received Payment (Box C)</strong> - acknowledgement by the<br>
          claimant or his duly authorized representative for<br>
          the receipt of the check/cash and the date of receipt.<br>
          The claimant/payee shall affix his signature on the<br>
          space provided and shall indicate the number and<br>
          date of the check, bank name and number and<br>
          date of OR/other relevant documents issued to<br>
          acknowledge the receipt of payment.</p>
        </div>
        <div class="col-sm-2">
          <span style="float:right; font-size:10px;">13.</span>
        </div>
        <div class="col-sm-10">
          <p style="font-size:10px; font-size:10px;"><strong>JEV No. and Date</strong> - number and date of the Journal<br>
          Entry Voucher<br></p>
        </div>
      </div>
    </div>

  </div>
  
</body>

</html>
