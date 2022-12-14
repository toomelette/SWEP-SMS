<div style="width: 100%; overflow: auto" >
    <div style="width: 49%; float: left; overflow: auto">
        <div>
            <img src="{{asset('images/sra.png')}}" style="width: 50px; float: left; margin-right: 15px;">
        </div>
        <p class="no-margin text-left" style="font-size: 14px"> <b>SUGAR REGULATORY ADMINISTRATION</b></p>
        <p class="no-margin text-left" style="font-size: 12px; margin-bottom: 15px"> Sugar Monitoring System</p>

        <p class="no-margin text-left" style="font-size: 14px"> <b>{{(!empty($formName)) ? $formName : null}}</b></p>
        <p class="no-margin text-left" style="font-size: 12px"> August 2022</p>

    </div>
    <div style="width: 49%; float: right;">
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
    </div>

</div>