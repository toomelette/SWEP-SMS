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
                @endphp
                @foreach($comparativeArray as $group => $mills)
                    @foreach($mills as $mill_code => $mill)
                        @php
                            $ct++;
                        @endphp
                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>
                            <td class="text-right">
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
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['manufactured']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['thisWeek']['manufactured']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['prevToDate']['manufactured']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['manufactured']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['withdrawalsTotal']['current'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['withdrawalsTotal']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['stockBalance']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['stockBalance']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['transfersToRefinery']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                @if(!empty($mill['form1']))
                                    {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['transfersToRefinery']['prev'],3,'-')}}
                                @endif
                            </td>
                            <td class="text-right">
                                {{\App\Swep\Helpers\Helper::toNumber(($prevManufactured - $prevWithdrawals - $prevTransfers) +
                                ($currentManufactured - $currentWithdrawals - $currentTransfers),3,'-')}}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            @endif
        </tbody>
    </table>
@endsection