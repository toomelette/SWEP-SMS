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
                <div style="min-height: 26em; max-height: 26em">
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


</body>
</html>

