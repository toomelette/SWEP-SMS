<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Disbursement Voucher</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('template/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

{{--    <link rel="stylesheet" href="{{ asset('template/bower_components/font-awesome/css/font-awesome.min.css') }}">--}}

{{--    <link rel="stylesheet" href="{{ asset('template/dist/css/AdminLTE.min.css') }}">--}}

    <link rel="stylesheet" href="{{ asset('css/print.css') }}?s={{\Illuminate\Support\Str::random()}}">


    <style type="text/css">

        .div-height{

            margin-bottom: -50px;
            padding-bottom: 50px;
            overflow: hidden;

        }

        td{
            border: 1px solid black;
            padding-left: 2px;
        }

        .top-left{
            float: left;
        }
        .no-margin{
            margin: 0 0 0 0;
        }
        .text-center{
            text-align: center;
        }
        .text-strong{
            font-weight: bold;
        }
        .f-12{
            font-size: 12px;
        }
        .f-9{
            font-size: 9px;
        }
        .no-border-top{
            border-top: 0px
        }
        .no-border-bottom{
            border-bottom: 0px
        }
        .no-border-left{
            border-left: 0px
        }
        .no-border-right{
            border-right: 0px
        }
        #dv_table{
            border-right: 2px solid black;
            border-left: 2px solid black;
            border-bottom: 2px solid black;
        }
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

<div class="printable">


    <table id="dv_table" style="width: 100%">
        <tr>
            <td style="width: 15px;"></td>
            <td style="width: 65px"></td>
            <td></td>
            <td style="width: 5em"></td>
            <td style="width: 5em"></td>
            <td style="width: 15px"></td>
            <td style="width: 65px"></td>
            <td></td>
            <td style="width: 10em"></td>

        </tr>
        <tr style="height: 100px">
            <td colspan="9">
                <div style=" width: 100%">
                    <div style="width: 25%; float: left">
                        <center>
                            <img src="{{ asset('images/sra.png') }}" style="width:100px; float: right">
                        </center>
                    </div>

                </div>
                <div class="col-sm-4">

                </div>
                <div class="col-sm-8" style="text-align: center; padding-right:125px;">
                    <span>Republic of the Philippines</span><br>
                    <span style="font-size:15px; font-weight:bold;">SUGAR REGULATORY ADMINISTRATION</span><br>
                    <span>North Avenue, Diliman, Quezon City</span>
                </div>
            </td>
        </tr>
        <tr>
            <td rowspan="2" colspan="8" style="padding-top: 9px; padding-bottom:9px; text-align: center; font-weight:bold; font-size:20px;">DISBURSEMENT VOUCHER</td>
            <td style="max-height: 10px" class="no-border-bottom">
                <p style="font-size:9px;" class="no-margin">No.</p>
            </td>
        </tr>
        <tr style="height: 30px">
            <td class="text-center text-strong no-border-top">{!! $disbursement_voucher->dv_no !!}</td>
        </tr>

        <tr>
            <td colspan="2" class="f-12 text-strong text-center">Mode of Payment:</td>
            <td colspan="7">
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
            </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="2" class="text-strong f-12">
                Payee:
            </td>
            <td colspan="3" rowspan="2" class="text-strong">
                {!! $disbursement_voucher->payee !!}
            </td>
            <td colspan="3" class="no-border-bottom">
                <p style="font-size:9px;" class="no-margin">TIN / Employee No.:</p>
            </td>
            <td class="no-border-bottom">
                <p style="font-size:9px;" class="no-margin">BUR No:</p>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="height: 30px;" class="text-strong f-12 text-center no-border-top">{!! $disbursement_voucher->tin !!}</td>
            <td class="no-border-top f-12 text-strong text-center">
                {!! $disbursement_voucher->bur_no !!}
            </td>
        </tr>

        <tr>
            <td colspan="2" rowspan="3" class="text-strong f-12">Address:</td>
            <td colspan="3" rowspan="3" class="text-strong">{!! $disbursement_voucher->address !!}</td>
            <td colspan="4">
                <p style="font-size:9px;" class="no-margin text-center text-strong">Responsibility Center</p>
            </td>
        </tr>
        <tr>
            <td style="font-size:9px;" colspan="3" class="no-margin no-border-bottom">Office/Unit/Project:</td>
            <td style="font-size:9px;" colspan="1" class="no-margin no-border-bottom">Code:</td>
        </tr>
        <tr>
            <td colspan="3" style="height: 20px" class="no-border-top f-12 text-strong">{!! optional($disbursement_voucher->departmentUnit)->description !!}</td>
            <td class="no-border-top f-12 text-strong">{!! $disbursement_voucher->project_code !!}</td>
        </tr>
        <tr>
            <td colspan="8" class="text-strong text-center">EXPLANATION</td>
            <td class="text-strong text-center">AMOUNT</td>
        </tr>
        <tr>
            <td colspan="8" style="padding-right: 5px">
                <div style="min-height: 24.9em; max-height: 25em">
                    {!! $disbursement_voucher->explanation !!}
                </div>
            </td>
            <td class="text-center text-strong" style="vertical-align: top; padding-top: 20px">
                {{ number_format($disbursement_voucher->amount, 2) }}
            </td>
        </tr>
        <tr>
            <td class="no-border-bottom">A</td>
            <td colspan="4" class="text-strong no-border-bottom">Certified</td>
            <td>B</td>
            <td colspan="3" class="text-strong no-border-bottom">Approved for Payment</td>
        </tr>
        <tr style="height: 2.5em">
            <td class="no-border-right"></td>
            <td colspan="4" class="text-center no-border-top no-border-left">&nbsp;Supporting documents complete</td>
            <td class="no-border-right"></td>
            <td colspan="3" class="text-center text-strong no-border-top no-border-left">
                @if(\Illuminate\Support\Facades\Auth::user()->username == 'salu9233' || \Illuminate\Support\Facades\Auth::user()->username == 'ppu.visayas')
                    <br>
                @else
                    {{ number_format($disbursement_voucher->amount, 2) }}
                @endif
            </td>
        </tr>
        <tr class="f-12" style="height: 30px">
            <td colspan="2">Signature:</td>
            <td colspan="3"></td>
            <td colspan="2">Signature:</td>
            <td colspan="2"></td>
        </tr>
        <tr class="f-12">
            <td colspan="2">Printed Name:</td>
            <td colspan="3" class="text-strong text-center">{{ $disbursement_voucher->certified_by }}</td>
            <td colspan="2">Printed Name:</td>
            <td colspan="2" class="text-strong text-center">{{ $disbursement_voucher->approved_by }}</td>
        </tr>
        <tr class="f-12">
            <td colspan="2" rowspan="2">Position:</td>
            <td colspan="3" class="text-strong text-center">{{ \Illuminate\Support\Str::limit($disbursement_voucher->certified_by_position,35,'') }}</td>
            <td colspan="2" rowspan="2">Position:</td>
            <td colspan="2" class="text-strong text-center">{{ \Illuminate\Support\Str::limit($disbursement_voucher->approved_by_position, 42,'') }}</td>
        </tr>
        <tr class="f-9 text-center">
            <td colspan="3">Head, Accounting Unit/Authorized Representative</td>
            <td colspan="2">Agency Head / Authorized Representative</td>
        </tr>
        <tr class="f-12" style="height: 30px">
            <td colspan="2">Date:</td>
            <td colspan="3"></td>
            <td colspan="2">Date:</td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td class="text-strong">C</td>
            <td colspan="6" class="text-strong">Received Payment:</td>
            <td colspan="2" row class="text-strong no-border-bottom">JEV No.</td>
        </tr>
        <tr class="f-9">
            <td colspan="2" rowspan="2" class="no-margin">Check/ADA No.:</td>
            <td rowspan="2"></td>
            <td class="no-margin no-border-bottom">Date:</td>
            <td colspan="3" class="no-margin no-border-bottom">Bank Name:</td>
            <td colspan="2" rowspan="2" class="no-border-top"></td>
        </tr>
        <tr class="f-9" style="height: 20px">
            <td class="no-margin no-border-top"></td>
            <td colspan="3" class="no-margin no-border-top"></td>
        </tr>
        <tr >
            <td colspan="2" rowspan="2" class="f-9">Signature:</td>
            <td rowspan="2"></td>
            <td class="no-border-bottom f-9">Date:</td>
            <td colspan="3" class="no-border-bottom f-9">Printed Name:</td>
            <td colspan="2" class="text-strong no-border-bottom"><p class="no-margin" style="font-size: 14px">Date:</p></td>
        </tr>
        <tr class="f-9">
            <td class="no-border-top"></td>
            <td colspan="3" class="no-border-top"><br></td>
            <td colspan="2" rowspan="3" class="f-12 text-strong no-border-top"></td>
        </tr>
        <tr class="f-9">
            <td colspan="7" class="no-border-bottom">Official Receipt (OR)/Other Documents:</td>
        </tr>
        <tr>
            <td colspan="7" class="no-border-top"><br></td>
        </tr>
    </table>


    {{-- SUFFIX --}}
    <div class="row" style="overflow: hidden;">

        <div class="col-sm-8 div-height">
            <p style="font-size:10px;">Username: {!! Auth::user()->username !!} | Doc No: {{ $disbursement_voucher->doc_no }}</p>
        </div>

        <div class="col-sm-4 div-height" style="border-right:solid; padding-left:0; line-height: 1.2;">
            <span style="font-size:11px;">FM-AFD-ACC-001, Rev. 00</span>
            <br><span style="font-size:11px;">Effective Date : March 12, 2015</span>
        </div>

    </div>
</div>

<hr class="no-print page-break">
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

