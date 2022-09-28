@php
    $sugarClasses = ['A','B','C','C1','D','DE','DR','DX'];
    $issuances = [];


    $wr = \App\Models\SMS\WeeklyReports::query()->where('slug','=',$weekly_report_slug)->first();
    $week_ending = $wr->week_ending;

    $so = \App\Models\SMS\SugarOrders::query()->where('effectivity','<=',$week_ending)->orderBy('effectivity','desc')->first();

    foreach ($sugarClasses as  $sugarClass){
        if($so->$sugarClass != 0){
            $issuances[$sugarClass]['current'] = Helper::sanitizeAutonum($manufactured_current) * ($so->$sugarClass/100);
            $issuances[$sugarClass]['prev'] = Helper::sanitizeAutonum($manufactured_prev) * ($so->$sugarClass/100);
        }
    }
@endphp
@if(count($issuances) > 0)
    @foreach($issuances as $key => $issuance)
        <tr>
            <td>{{$key}}</td>
            <td>
                <div class="data_form1_current_issuances col-md- data[form1][current][issuances]">
                    <input class="form-control autonumber_mt" readonly type="text" value="{{number_format($issuance['current'],3)}}" placeholder="" autocomplete="off">
                </div>
            </td>
            <td>
                <div class="data_form1_prev_issuances col-md- data[form1][prev][issuances]">
                    <input class="form-control autonumber_mt" readonly  type="text" value="{{($issuance['prev'] != 0) ? number_format($issuance['prev'],3) : ''}}" placeholder="" autocomplete="off">
                </div>
            </td>
            <td></td>
        </tr>
    @endforeach
@endif