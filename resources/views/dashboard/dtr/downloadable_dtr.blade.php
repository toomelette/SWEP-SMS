@php($days_in_this_month = \Carbon\Carbon::parse($month)->daysInMonth)
<style>
    @font-face {
        font-family: 'Antonio';
        src: url('/fonts/Antonio-Regular.ttf') format('truetype');
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
    table{
        font-family: "Helvetica";
    }
    p{
        font-size: 14px;
        font-family: "Helvetica";
    }
    .small-margin{
        margin: 5px 0;
    }
</style>
<div>
    <div style="width: 49%; float: left; border-right: 1px dashed black">
        <p class="text-center"><b>SUGAR REGULATORY ADMINISTRATION</b></p>
        <p class="text-center"><b>DAILY TIME RECORD</b></p>
        <p class="text-right small-margin" style="margin-right: 10px; font-style: italic; font-size: 10px"><b>CSC Form 48</b></p>
        <p class="small-margin">{{$employee->lastname}}, {{$employee->firstname}}</p>
        <p class="small-margin">For the month of <b>{{\Carbon\Carbon::parse($month)->format('F Y')}}</b> </p>
        <table class="table table-bordered table-condensed" style="font-size: 11px">
            <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th colspan="2">AM</th>
                <th colspan="2">PM</th>
                <th colspan="2">OT</th>
                <th rowspan="2">Late</th>
                <th>Under-</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr>
                <th>In</th>
                <th>Out</th>
                <th>In</th>
                <th>Out</th>
                <th>In</th>
                <th>Out</th>
                <th>time</th>
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
                    <tr class="text-center">
                        <td>
                            {{$date}}
                        </td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}</td>
                        <td>{{$dtr_array[$month.'-'.$date]->late == 0 ? '' : $dtr_array[$month.'-'.$date]->late}}</td>
                        <td>{{$dtr_array[$month.'-'.$date]->late == 0 ? '' : $dtr_array[$month.'-'.$date]->undertime}}</td>
                        <td class="text-left">
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                @php($saturdays++)
                                SATURDAY
                            @endif
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                @php($sundays++)
                                SUNDAY
                            @endif
                            @if(isset($holidays[$month.'-'.$date]))
                                <b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b>
                            @endif
                        </td>
                    </tr>
                @else
                    @if(isset($holidays[$month.'-'.$date]))
                        <tr class="text-center">
                            <td>
                                {{$date}}
                            </td>
                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b></td>
                        </tr>
                    @else
                        <tr class="text-center">
                            <td>
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
        <table style="font-family: 'Helvetica'; font-size: 14px; margin-top: 20px;border: 0px; width: 100%">
            <tr>
                <td>Total Late : {{number_format($late)}} mins</td>
                <td>Total Saturday: {{number_format($saturdays)}}</td>
            </tr>
            <tr>
                <td>Total Undertime : {{number_format($undertime)}} mins</td>
                <td>Total Sunday: {{number_format($sundays)}}</td>
            </tr>
        </table>
        <br>
        <div>
            <p style="font-size: 12px">I hereby certify that the above records are true and correct</p>
            <br>
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
    </div>
    <div style="width: 46% ; float: right; margin-left: 20px">
        <p class="text-center"><b>DAILY TIME RECORD</b></p>
        <p class="small-margin">{{$employee->lastname}}, {{$employee->firstname}}</p>
        <p class="small-margin">For the month of <b>{{\Carbon\Carbon::parse($month)->format('F Y')}}</b> </p>
        <table class="table table-bordered table-condensed" style="font-size: 11px">
            <thead>
            <tr>
                <th rowspan="2">Date</th>
                <th colspan="2">AM</th>
                <th colspan="2">PM</th>
                <th colspan="2">OT</th>
                <th rowspan="2">Late</th>
                <th>Under-</th>
                <th rowspan="2">Remarks</th>
            </tr>
            <tr>
                <th>In</th>
                <th>Out</th>
                <th>In</th>
                <th>Out</th>
                <th>In</th>
                <th>Out</th>
                <th>time</th>
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
                    <tr class="text-center">
                        <td>
                            {{$date}}
                        </td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->am_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->pm_out) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_in) !!}</td>
                        <td>{!! __html::dtrTime($dtr_array[$month.'-'.$date]->ot_out) !!}</td>
                        <td>{{$dtr_array[$month.'-'.$date]->late == 0 ? '' : $dtr_array[$month.'-'.$date]->late}}</td>
                        <td>{{$dtr_array[$month.'-'.$date]->late == 0 ? '' : $dtr_array[$month.'-'.$date]->undertime}}</td>
                        <td class="text-left">
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 6)
                                @php($saturdays++)
                                SATURDAY
                            @endif
                            @if(\Carbon\Carbon::parse($month.'-'.$date)->format('w') == 0)
                                @php($sundays++)
                                SUNDAY
                            @endif
                            @if(isset($holidays[$month.'-'.$date]))
                                <b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b>
                            @endif
                        </td>
                    </tr>
                @else
                    @if(isset($holidays[$month.'-'.$date]))
                        <tr class="text-center">
                            <td>
                                {{$date}}
                            </td>
                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b></td>
                        </tr>
                    @else
                        <tr class="text-center">
                            <td>
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
        <table style="font-family: 'Helvetica'; font-size: 14px; margin-top: 20px;border: 0px; width: 100%">
            <tr>
                <td>Total Late : {{number_format($late)}} mins</td>
                <td>Total Saturday: {{number_format($saturdays)}}</td>
            </tr>
            <tr>
                <td>Total Undertime : {{number_format($undertime)}} mins</td>
                <td>Total Sunday: {{number_format($sundays)}}</td>
            </tr>
        </table>
        <br>
        <div>
            <p style="font-size: 12px">I hereby certify that the above records are true and correct</p>
            <br>
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
    </div>
</div>