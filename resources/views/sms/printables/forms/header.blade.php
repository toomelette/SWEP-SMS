<div style="width: 100%; overflow: auto" >

    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top">
                <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">
                <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>
                <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monitoring System</p>
                <p class="no-margin text-left" style="font-size: 14px"> <b>{{(!empty($formName)) ? $formName : null}}</b></p>
                <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>
            </td>
            <td style="text-align: right; vertical-align: top">
                @if($wr->status == 1)
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(65)->generate(route('dashboard.weekly_report.show',$wr->slug).'?src=SCANNER'); !!}
                @elseif($wr->status == -1)
                    <p class="text-danger text-strong" style="font-size: 18px">CANCELLED</p>
                @else
                    <p class="text-danger text-strong" style="font-size: 18px">DRAFT</p>
                @endif
            </td>
            <td style="width: 190px; vertical-align: top">
                <table style="float: right" class="details-top-right-table">
                    <tr>
                        <td>Crop Year:</td>
                        <td><b>{{$wr->crop_year}}</b></td>
                    </tr>
                    <tr>
                        <td>Mill Code:</td>
                        <td><b>{{$wr->mill_code}}</b></td>
                    </tr>
                    <tr>
                        <td>Week Ending:</td>
                        <td><b>{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</b></td>
                    </tr>
                    <tr>
                        <td>Report No.:</td>
                        <td><b>{{$wr->report_no}}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
{{--    <div style="width: 49%; float: left; overflow: auto">--}}
{{--        <div>--}}
{{--            <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">--}}
{{--        </div>--}}
{{--        <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>--}}
{{--        <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monitoring System</p>--}}

{{--        <p class="no-margin text-left" style="font-size: 14px"> <b>{{(!empty($formName)) ? $formName : null}}</b></p>--}}
{{--        <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>--}}

{{--    </div>--}}
{{--    <div style="width: 49%; float: right;">--}}
{{--        <table style="float: right" class="details-top-right-table">--}}
{{--            <tr>--}}
{{--                <td>Crop Year:</td>--}}
{{--                <td><b>{{$wr->crop_year}}</b></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Mill Code:</td>--}}
{{--                <td><b>{{$wr->mill_code}}</b></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Week Ending:</td>--}}
{{--                <td><b>{{\Illuminate\Support\Carbon::parse($wr->week_ending)->format('F d, Y')}}</b></td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Report No.:</td>--}}
{{--                <td><b>{{$wr->report_no}}</b></td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </div>--}}

</div>