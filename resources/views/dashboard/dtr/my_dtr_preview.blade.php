@extends('layouts.modal-content')

@section('modal-header')
{{\Carbon\Carbon::parse($month)->format('F, Y')}}
@endsection

@section('modal-body')
    @php($days_in_this_month = \Carbon\Carbon::parse($month)->daysInMonth)
{{--    {{print_r($dtr_array)}}--}}
    <form method="POST" action="{{route('dashboard.dtr.download')}}">
        @csrf
        <input value="{{$month}}" name="month" hidden>
        <button type="submit" class="btn btn-primary pull-right download_btn" style="margin-bottom: 1rem"><i class="fa fa-download"></i> Download PDF </button>
    </form>

    <table class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>Date</th>
                <th>AM In</th>
                <th>AM Out</th>
                <th>PM In</th>
                <th>PM Out</th>
                <th>OT In</th>
                <th>OT Out</th>
                <th>Late</th>
                <th>Undertime</th>
                <th>Remarks</th>
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
                            <td colspan="9"><b>{{$holidays[$month.'-'.$date]['type']}} HOLIDAY</b> (<i>{{$holidays[$month.'-'.$date]['name']}}</i>)</td>
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

    <div class="row">
        <div class="col-md-6">
            <dl class="dl-horizontal">
                <dt>Total Late:</dt>
                <dd>{{number_format($late)}}</dd>
                <dt>Total Undertime:</dt>
                <dd>{{number_format($undertime)}}</dd>
            </dl>
        </div>
        <div class="col-md-6">
            <dl class="dl-horizontal">
                <dt>Total Saturdays:</dt>
                <dd>{{number_format($saturdays)}}</dd>
                <dt>Total Sundays:</dt>
                <dd>{{number_format($sundays)}}</dd>
            </dl>
        </div>
    </div>

@endsection

@section('modal-footer')
    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
@endsection

@section('scripts')
<script>
    {{--$(".download_btn").click(function () {--}}
    {{--    month = "{{$month}}";--}}
    {{--    alert(month);--}}
    {{--    $.ajax({--}}
    {{--        url : '{{route("dashboard.dtr.download")}}',--}}
    {{--        data : {month:month},--}}
    {{--        type: 'GET',--}}
    {{--        headers: {--}}
    {{--            {!! __html::token_header() !!}--}}
    {{--        },--}}
    {{--        success: function (res) {--}}
    {{--           console.log(res);--}}
    {{--        },--}}
    {{--        error: function (res) {--}}
    {{--            console.log(res);--}}
    {{--        }--}}
    {{--    })--}}
    {{--})--}}
</script>
@endsection

