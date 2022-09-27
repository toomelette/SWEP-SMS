@php
    $withdrawals = [];
    $ws = \App\Models\SMS\Form5\Deliveries::query()
        ->selectRaw('sugar_class, sum(qty) as sum, sum(qty_prev) as sum_prev')
       // ->whereNull('refining')
        ->where('weekly_report_slug','=',$wr->slug)
        ->groupBy('sugar_class')
        ->get();

    if(!empty($ws)){
        foreach ( $ws as $w){
            $withdrawals[$w->sugar_class]['qty'] = $w->sum;
            $withdrawals[$w->sugar_class]['qty_prev'] = $w->sum_prev;
        }
    }

    $for_refining = \App\Models\SMS\Form5\Deliveries::query()
        ->selectRaw('sugar_class, sum(qty) as sum, sum(qty_prev) as sum_prev')
       // ->where('refining' ,'=',1)
        ->where('weekly_report_slug','=',$wr->slug)
        ->groupBy('sugar_class')
        ->get();
    if(!empty($ws)){
        foreach ( $ws as $w){
            $withdrawals[$w->sugar_class]['qty'] = $w->sum;
            $withdrawals[$w->sugar_class]['qty_prev'] = $w->sum_prev;
        }
    }
@endphp
{{print_r($withdrawals)}}
<table class="table table-bordered table-condensed">
    <thead>
        <tr>
            <th></th>
            <th colspan="3">CURRENT CROP</th>
            <th colspan="3">PREVIOUS CROP</th>
        </tr>
        <tr class="text-center">
            <th></th>
            <th>This Week</th>
            <th>Previous</th>
            <th>To Date</th>
            <th>This Week</th>
            <th>Previous</th>
            <th>To Date</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1. MANUFACTURED</td>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>2. ISSUANCES/CARRY-OVER</td>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @php
            $raw_sugar_issuances = \App\Models\SMS\InputFields::getFields('raw_sugar_issuances');
        @endphp
        @foreach($raw_sugar_issuances as $raw_sugar_issuance)
            <tr>
                <td>{{$raw_sugar_issuance->display_name}}</td>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        @endforeach

        <tr>
            <td>3. WITHDRAWALS</td>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        @php
            $raw_sugar_withdrawals = \App\Models\SMS\InputFields::getFields('raw_sugar_withdrawals');
        @endphp
        @foreach($raw_sugar_withdrawals as $raw_sugar_withdrawal)

            @if(isset($withdrawals[$raw_sugar_withdrawal->field]))
                <tr>
                    <td>{{$raw_sugar_withdrawal->display_name}}</td>
                    <td class="text-right">{{number_format($withdrawals[$raw_sugar_withdrawal->field]['qty'],3)}}</td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right">{{number_format($withdrawals[$raw_sugar_withdrawal->field]['qty_prev'],3)}}</td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td class="text-right">TOTAL</td>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>

        <tr>
            <td>4. BALANCE</td>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tbody>
</table>