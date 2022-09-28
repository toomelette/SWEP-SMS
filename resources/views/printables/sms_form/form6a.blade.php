<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form 6A - Print</title>

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

        .bordered td{
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

        .details_table tr td:first-child{
            width: 25%;
        }
        /*.details_table  td{*/
        /*    line-height: 40px;*/
        /*}*/
    </style>

</head>

{{--<body onload="window.print();" onafterprint="window.close()">--}}
<body>

<div class="printable">

    <div style=" width: 100%; margin-bottom: 10px; overflow: auto">
        <div style="width: 65%; float: left">
            <h5>SMS Form No. 6A</h5>
            <h6>August 2008</h6>
        </div>
        <div style="width: 35%; float: right">
            <table>
                <tr>
                    <td>Crop Year: </td>
                    <td class="text-right">{{$cy->name}}</td>
                </tr>
                <tr>
                    <td>Refinery Code/Short Name: </td>
                    <td class="text-right">{{$r->mill_code}}</td>
                </tr>
                <tr>
                    <td>Week Ending: </td>
                    <td class="text-right">{{\Carbon\Carbon::parse($r->week_ending)->format('M d, Y')}}</td>
                </tr>
                <tr>
                    <td>Report No: </td>
                    <td class="text-right">{{$r->report_no}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div style="width: 100%; overflow: auto">
        <div class="text-center">
            <p class="no-margin" style="font-weight: bold; font-size: 18px; padding-top: 8px">(QUEDAN REGISTRY)</p>
            <p class="no-margin" style="font-weight: bold; font-size: 12px; padding-top: 8px">Report on RAW Sugar Receipts, Refined Sugar Due and Refined Sugar Quedan Issuances</p>
        </div>
    </div>
    <div style="width: 100%; overflow: auto">
        <div class="">
            <p class="no-margin" style="font-weight: bold; font-size: 14px; padding-top: 8px">A. Raw Sugar Receipts</p>
            <table style="width: 100%;" class="table table-bordered text-center" >
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">Delivery No.</th>
                        <th rowspan="2" style="vertical-align: middle;">Trader/Tollee</th>
                        <th colspan="4">Raw Sugar Receipts</th>
                        <th rowspan="2" style="vertical-align: middle;">Refined Sugar Equivalent (Lkg)</th>
                    </tr>
                    <tr>
                        <th>Mill Source</th>
                        <th>Raw SRO S.N.</th>
                        <th>SRA Liens O.R. #</th>
                        <th>Qty. (Lkg)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($receiptsList as $receipts)
                    <tr>
                        <td>{{$receipts->delivery_no}}</td>
                        <td>{{$receipts->trader}}</td>
                        <td>{{$receipts->mill_source}}</td>
                        <td>{{$receipts->raw_sro_sn}}</td>
                        <td>{{$receipts->liens_or}}</td>
                        <td>{{$receipts->qty}}</td>
                        <td>{{$receipts->refined_sugar_equivalent}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5" style="width: 100%; overflow: auto">
        <div class="">
            <p class="no-margin" style="font-weight: bold; font-size: 14px; padding-top: 8px">B. Quedan Registry</p>
            <table style="width: 100%;" class="table table-bordered" >
                <thead class="text-center">
                <tr>
                    <th>Delivery No.</th>
                    <th>Trader/Tollee</th>
                    <th>Refined Quedan S.N.</th>
                    <th>Refined Sugar (LKg)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($registryList as $registry)
                    <tr class="text-center">
                        <td>{{$registry->delivery_no}}</td>
                        <td>{{$registry->trader}}</td>
                        <td>{{$registry->refined_quedan_sn}}</td>
                        <td>{{$registry->refined_sugar}}</td>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right">TOTAL</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5" style="width: 100%; overflow: auto">
        <div style="width: 100%;">
            <table width="100%">
                <tr>
                    <th width="50%">Certified: (Refinery Representative)</th>
                    <th width="50%">Verified: (SRA Representative)</th>
                </tr>
                <tr height="100px" >
                    <td width="50%">__________________</td>
                    <td width="50%">__________________</td>
                </tr>
            </table>
        </div>
    </div>

</div>
</body>
</html>