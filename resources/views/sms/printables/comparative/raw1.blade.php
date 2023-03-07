@extends('printables.print_layouts.print_layout_main')


@section('wrapper')
    <table class="table" style="width: 100%;">
        <tr>
            <td style="width: 30%">
                <p class="no-margin text-strong">THE ADMINISTRATOR</p>
                <p class="no-margin">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="no-margin">SRA, DILIMAN, QUEZON CITY</p>
            </td>
            <td class="text-center">
                <p class="text-strong">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="text-strong"> REGULATION DEPARTMENT</p>
            </td>
            <td style="width: 30%">
                WEEK:
            </td>
        </tr>
    </table>

    <p class="text-strong">RAW SUGAR PRODUCTION, WITHDRAWALS & STOCK BALANCES IN (In LKG Bags)</p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">#</th>
            <th rowspan="2" class="text-center">MILLS</th>
            <th rowspan="2" class="text-center">Previous Crop/s Carry-over</th>
            <th colspan="3" class="text-center">PRODUCTION</th>
            <th colspan="2" class="text-center">TO DATE WITHDRAWALS</th>
            <th colspan="2" class="text-center">STOCK BALANCES</th>
            <th colspan="2" class="text-center">TRANSFERS TO REFINERY</th>
            <th rowspan="2" class="text-center">TOTAL STOCKS</th>
        </tr>
        <tr>
            <th class="text-center">This Week</th>
            <th class="text-center">Previous</th>
            <th class="text-center">To Date</th>
            <th class="text-center">Current Crop</th>
            <th class="text-center">Previous Crop</th>
            <th class="text-center">Current Crop</th>
            <th class="text-center">Previous Crop</th>
            <th class="text-center">Current Crop</th>
            <th class="text-center">Previous Crop</th>
        </tr>
        </thead>
        <tbody>
            @if(!empty($comparativeArray))
                @php
                    $ct = 0;
                    $totals = [];
                    $template = [];
                    for ($x = 0;$x < 11; $x++){
                        $template[$x] = 0;
                    }
                @endphp
                @foreach($comparativeArray as $group => $mills)
                    @php
                        $totals[$group] = $template;
                    @endphp
                    @foreach($mills as $mill_code => $mill)
                        @php
                            $ct++;
                        @endphp
                        @if(!empty($mill['form1']))
                            @php
                                $prevManufactured = $mill['form1']['toDate']['manufactured']['prev'] ?? 0;
                                $currentManufactured = $mill['form1']['toDate']['manufactured']['current'] ?? 0;
                                $currentWithdrawals = $mill['form1']['toDate']['withdrawalsTotal']['current'] ?? 0;
                                $prevWithdrawals = $mill['form1']['toDate']['withdrawalsTotal']['prev'] ?? 0;
                                $currentTransfers = $mill['form1']['toDate']['transfersToRefinery']['current'] ?? 0;
                                $prevTransfers = $mill['form1']['toDate']['transfersToRefinery']['prev'] ?? 0;
                            @endphp
                        @else
                            @php
                                $prevManufactured = 0;
                                $currentManufactured = 0;
                                $currentWithdrawals = 0;
                                $prevWithdrawals = 0;
                                $currentTransfers = 0;
                                $prevTransfers = 0;
                            @endphp
                        @endif

                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][0] += $mill['form1']['toDate']['manufactured']['prev'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['manufactured']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][1] += $mill['form1']['thisWeek']['manufactured']['current'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['thisWeek']['manufactured']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][2] += $mill['form1']['prevToDate']['manufactured']['current'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['prevToDate']['manufactured']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][3] += $mill['form1']['toDate']['manufactured']['current'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['manufactured']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][4] += $mill['form1']['toDate']['withdrawalsTotal']['current'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['withdrawalsTotal']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][5] += $mill['form1']['toDate']['withdrawalsTotal']['prev'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['withdrawalsTotal']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][6] += $mill['form1']['toDate']['stockBalance']['prev'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['stockBalance']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][7] += $mill['form1']['toDate']['stockBalance']['prev'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['stockBalance']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][8] += $mill['form1']['toDate']['transfersToRefinery']['prev'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['transfersToRefinery']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    @php($totals[$group][9] += $mill['form1']['toDate']['transfersToRefinery']['prev'])
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['transfersToRefinery']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @php($totalStocks = ($prevManufactured - $prevWithdrawals - $prevTransfers) +
                                                    ($currentManufactured - $currentWithdrawals - $currentTransfers))
                                @php($totals[$group][10] += $totalStocks)


                                {{\App\Swep\Helpers\Helper::toNumber($totalStocks,3,'-')}}
                            </td>
                        </tr>
                    @endforeach

                    <tr class="text-strong" style="background-color: #f8ffeb">
                        <td colspan="2" class="text-right">
                            {{$group}} Subtotal
                        </td>
                        @if(!empty($totals[$group]))
                            @foreach($totals[$group] as $value)
                                <td class="text-right">{{number_format($value,3)}}</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                    <tr class="text-strong">
                        <td colspan="2">TOTAL (LKG)</td>
                        @foreach($template as $key => $val)
                            <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
                        @endforeach
                    </tr>
                <tr class="text-strong">
                    <td colspan="2">TOTAL (MT)</td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{number_format(array_sum(array_column($totals,$key)) / 20,3)}}</td>
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>
@endsection