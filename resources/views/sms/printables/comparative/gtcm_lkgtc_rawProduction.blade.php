<h4 class="text-strong">COMPARATIVE GTCM, LKG/TC, RAW SUGAR PRODUCTION</h4>


<table class="table-bordered details-top-right-table" style="width: 100%">
    <thead>
        <tr>
            <th>MILLS</th>
            <th>START OF MILLING</th>
            <th>END OF MILLING</th>
            <th>CY</th>
            <th>CY</th>
            <th>CY</th>
            <th>CY</th>
            <th>CY</th>
            <th>CY</th>
            <th>% Inc.</th>
            <th>Percentage Production</th>
        </tr>
    </thead>
    <tbody>

        @if(count($page1['mills'])> 0)
            @foreach($page1['mills'] as $grouping => $mills)
                @php
                    $totalGtcm = 0;
                    $totalRawProduction = 0;
                @endphp
                @if(!empty($mills))
                    @foreach($mills as $millCode => $mill)
                        @php
                            $totalGtcm = $totalGtcm + $mill['gtcm']['toDate'];
                            $totalRawProduction = $totalRawProduction + $mill['rawProduction']['toDate'];
                        @endphp
                        <tr class="tr">
                            <td>{{$millCode}}</td>
                            <td>{{$mill['startOfMilling']}}</td>
                            <td>{{$mill['endOfMilling']}}</td>
                            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($mill['gtcm']['toDate'],2)}}</td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{\App\Swep\Helpers\Helper::toNumber($mill['rawProduction']['toDate'],2)}}</td>
                            <td class="text-right"></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif
                <tr class="tr-strong">
                    <td class="text-right">{{$grouping}} TOTAL</td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{number_format($totalGtcm,2)}}</td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                    <td class="text-right">{{number_format($totalRawProduction,2)}}</td>
                    <td class="text-right"></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>