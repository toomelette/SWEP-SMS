@php($days_in_this_month = \Carbon\Carbon::parse($month)->daysInMonth)
<head>
    <style type="text/css">
        @font-face {
            font-family: 'HunDin';
            src: url({{ storage_path('fonts/HunDin.ttf') }}) format('truetype');
            font-weight: 400;
            font-style: normal;
        }


        @font-face {
            font-family: 'OS-Condenesed-Bold';
            src: url({{ storage_path('fonts/OpenSansCondensed-Bold.ttf') }}) format('truetype');
            font-weight: 400;
            font-style: normal;

        }

        @font-face {
            font-family: 'OS-Condenesed-Light';
            src: url({{ storage_path('fonts/OpenSansCondensed-Light.ttf') }}) format('truetype');
            font-style: normal;
        }

        .table-bordered,.table-bordered th,.table-bordered td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .text-center{
            text-align: center;
        }
        .text-right{
            text-align: right;
        }

        .text-left{
            text-align: left;
        }
        table td{
            font-family: "HunDin";
        }

        thead{
            font-family: "Helvetica";
        }
        p{
            font-size: 14px;
            font-family: "Helvetica";
        }
        .small-margin{
            margin: 5px 0;
        }
        .incomplete{
            color : #1e5ab3;
        }
    </style>
</head>
<div>
    <div style="width: 49%; float: left; border-right: 1px dashed black">
        <p class="text-left small-margin" style="margin-right: 10px; font-style: italic; font-size: 10px"><b>CSC Form 48</b></p>
        <p class="text-center" style="margin: 5px"><b>SUGAR REGULATORY ADMINISTRATION</b></p>
        <p class="text-center" style="margin: 5px"><b>DAILY TIME RECORD</b></p>

        <p class="small-margin" style="font-size: 16px"><b>{{strtoupper($employee->lastname)}}, {{strtoupper($employee->firstname)}}</b></p>
        <p class="small-margin">For the month of <b>{{\Carbon\Carbon::parse($month)->format('F Y')}}</b> </p>
        <table class="table table-bordered table-condensed" style="font-size: 11.5px">
            <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th colspan="2">Morning</th>
                <th colspan="2">Afternoon</th>
                <th colspan="2">Overtime</th>
                <th rowspan="2" style="min-width: 30px">Late</th>
                <th rowspan="2" style="min-width: 30px">U/T</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>

            </tr>
            </thead>
            <tbody>
            @php($late = 0)
            @php($undertime = 0)
            @php($saturdays= 0)
            @php($sundays = 0)
            @for($a = 1 ; $a <= $days_in_this_month; $a++)

                @php($date = sprintf('%02d', $a))
                @if(isset($dtr_array[$month.'-'.$date]))
                    @php($late = $late + $dtr_array[$month.'-'.$date]->late)
                    @php($undertime = $undertime + $dtr_array[$month.'-'.$date]->undertime)
                    @if($dtr_array[$month.'-'.$date]->calculated == -1)
                        @php($italic_op = '<i style="color:#d61900">')
                        @php($italic_cl = '</i>')
                    @else
                        @php($italic_op = '')
                        @php($italic_cl = '')
                    @endif
                    <tr class="text-center">
                        <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                            style="color: red"
                                @endif>
                            {{$date}}
                        </td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}</td>
                        <td>
                            {!! $italic_op !!}
                            {{$dtr_array[$month.'-'.$date]->late == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->late)}}
                            {!! $italic_cl !!}
                        </td>
                        <td>
                            {!! $italic_op !!}
                                {{$dtr_array[$month.'-'.$date]->undertime == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->undertime)}}
                            {!! $italic_cl !!}
                        </td>
                        <td class="text-left">
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                @php($saturdays++)
                                SAT
                            @endif
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                @php($sundays++)
                                SUN
                            @endif
                            @if(isset($holidays[$month.'-'.$date]))
                                <b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b>
                            @endif

                            @if($dtr_array[$month.'-'.$date]->calculated == -1)
                                <span class="incomplete">INC</span>
                            @endif
                        </td>
                    </tr>
                @else
                    @if(isset($holidays[$month.'-'.$date]))
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">HOL</td>
                            {{--                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b></td>--}}
                        </tr>
                    @else
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                    @php($saturdays++)
                                    SAT
                                @endif
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                    @php($sundays++)
                                    SUN
                                @endif


                            </td>
                        </tr>
                    @endif
                @endif
            @endfor
            </tbody>
        </table>
        <table style="font-family: 'Helvetica'; font-size: 14px; margin-top: 5px;margin-bottom: 0px;border: 0px; width: 100%">
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Late : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($late)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Saturday: <span style="font-family: 'HunDin'">{{number_format($saturdays)}}</span></td>
            </tr>
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Undertime : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($undertime)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Sunday: <span style="font-family: 'HunDin'">{{number_format($sundays)}}</span></td>
            </tr>
        </table>

        <div>
            <p style="font-size: 14px; font-family: 'OS-Condenesed-Bold'; margin-top: 0px">I hereby certify that the above records are true and correct</p>

            <div style="float: right; padding-right: 10px">
                ___________________________
                <p class="text-center" style="margin-top: 0">Signature of Employee</p>
            </div>
            <br><br><br>
            <div style="padding-right: 10px">
                ___________________________
                <p style="margin-top: 0; padding-left: 50px">Authorized Official</p>
            </div>

        </div>
        <div>
            <p style="font-size: 10px;float: left">2022/PPSPD/MIS | {{Auth::user()->username}} | {{request()->ip()}}</p>
        </div>
    </div>
    <div style="width: 46% ; float: right; margin-left: 20px">
        <p class="text-left small-margin" style="margin-right: 10px; font-style: italic; font-size: 10px"><b>CSC Form 48</b></p>
        <p class="text-center" style="margin: 5px"><b>SUGAR REGULATORY ADMINISTRATION</b></p>
        <p class="text-center" style="margin: 5px"><b>DAILY TIME RECORD</b></p>

        <p class="small-margin" style="font-size: 16px"><b>{{strtoupper($employee->lastname)}}, {{strtoupper($employee->firstname)}}</b></p>
        <p class="small-margin">For the month of <b>{{\Carbon\Carbon::parse($month)->format('F Y')}}</b> </p>
        <table class="table table-bordered table-condensed" style="font-size: 11.5px">
            <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th colspan="2">Morning</th>
                <th colspan="2">Afternoon</th>
                <th colspan="2">Overtime</th>
                <th rowspan="2" style="min-width: 30px">Late</th>
                <th rowspan="2" style="min-width: 30px">U/T</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>
                <th style="min-width: 30px">In</th>
                <th style="min-width: 30px">Out</th>

            </tr>
            </thead>
            <tbody>
            @php($late = 0)
            @php($undertime = 0)
            @php($saturdays= 0)
            @php($sundays = 0)
            @for($a = 1 ; $a <= $days_in_this_month; $a++)

                @php($date = sprintf('%02d', $a))
                @if(isset($dtr_array[$month.'-'.$date]))
                    @php($late = $late + $dtr_array[$month.'-'.$date]->late)
                    @php($undertime = $undertime + $dtr_array[$month.'-'.$date]->undertime)
                    @if($dtr_array[$month.'-'.$date]->calculated == -1)
                        @php($italic_op = '<i style="color:#d61900">')
                        @php($italic_cl = '</i>')
                    @else
                        @php($italic_op = '')
                        @php($italic_cl = '')
                    @endif
                    <tr class="text-center">
                        <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                            style="color: red"
                                @endif>
                            {{$date}}
                        </td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}</td>
                        <td>
                            {!! $italic_op !!}
                                {{$dtr_array[$month.'-'.$date]->late == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->late)}}
                            {!! $italic_cl !!}
                        </td>
                        <td>
                            {!! $italic_op !!}
                                {{$dtr_array[$month.'-'.$date]->undertime == 0 ? '' : \App\Swep\Helpers\Helper::convertToHoursMins($dtr_array[$month.'-'.$date]->undertime)}}
                            {!! $italic_cl !!}
                        </td>
                        <td class="text-left">
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                @php($saturdays++)
                                SAT
                            @endif
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                @php($sundays++)
                                SUN
                            @endif
                            @if(isset($holidays[$month.'-'.$date]))
                                <b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b>
                            @endif

                            @if($dtr_array[$month.'-'.$date]->calculated == -1)
                                <span class="incomplete">INC</span>
                            @endif
                        </td>
                    </tr>
                @else
                    @if(isset($holidays[$month.'-'.$date]))
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">HOL</td>
                            {{--                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b></td>--}}
                        </tr>
                    @else
                        <tr class="text-center">
                            <td @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6 || \Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                style="color: red"
                                    @endif>
                                {{$date}}
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-left">
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                    @php($saturdays++)
                                    SAT
                                @endif
                                @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                    @php($sundays++)
                                    SUN
                                @endif
                            </td>
                        </tr>
                    @endif
                @endif
            @endfor
            </tbody>
        </table>
        <table style="font-family: 'Helvetica'; font-size: 14px; margin-top: 5px;margin-bottom: 0px;border: 0px; width: 100%">
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Late : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($late)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Saturday: <span style="font-family: 'HunDin'">{{number_format($saturdays)}}</span></td>
            </tr>
            <tr>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Undertime : <span style="font-family: 'HunDin'">{{\App\Swep\Helpers\Helper::convertToHoursMins($undertime)}}</span></td>
                <td style="font-family: 'OS-Condenesed-Bold';">Total Sunday: <span style="font-family: 'HunDin'">{{number_format($sundays)}}</span></td>
            </tr>
        </table>

        <div>
            <p style="font-size: 14px; font-family: 'OS-Condenesed-Bold'; margin-top: 0px">I hereby certify that the above records are true and correct</p>

            <div style="float: right; padding-right: 10px">
                ___________________________
                <p class="text-center" style="margin-top: 0">Signature of Employee</p>
            </div>
            <br><br><br>
            <div style="padding-right: 10px">
                ___________________________
                <p style="margin-top: 0; padding-left: 50px">Authorized Official</p>
            </div>

        </div>
        <div>
            <p style="font-size: 10px;float: left">2022/PPSPD/MIS | {{Auth::user()->username}} | {{request()->ip()}}</p>
        </div>
    </div>
</div>
