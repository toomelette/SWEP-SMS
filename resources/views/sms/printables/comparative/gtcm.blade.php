@extends('printables.print_layouts.print_layout_main')


@section('wrapper')
    <table class="" style="width: 100%;">
        <tr>
            <td style="width: 30%" class="text-top">
                <p class="no-margin text-strong">THE ADMINISTRATOR</p>
                <p class="no-margin">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="no-margin">SRA, DILIMAN, QUEZON CITY</p>
            </td>
            <td class="text-center" class="text-top">
                <p class="text-strong">SUGAR REGULATORY ADMINISTRATION</p>
                <p class="text-strong"> REGULATION DEPARTMENT</p>
            </td>
            <td style="width: 30%" class="text-top">
                <table class="tbl-condensed" style="width: 100%">
                    <tbody>
                    <tr>
                        <td style="width: 50%"></td>
                        <td>Crop year:</td>
                        <td class="text-strong">{{\Illuminate\Support\Facades\Request::get('crop_year')}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Report No:</td>
                        <td class="text-strong">{{\Illuminate\Support\Facades\Request::get('report_no')}}</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <p class="text-strong">GTCM, TSDC, LKG/TONNE CANE</p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">#</th>
            <th rowspan="2" class="text-center">MILLS</th>
            <th rowspan="2" class="text-center">Start of Milling</th>
            <th rowspan="2" class="text-center">Start of Milling</th>
            <th colspan="3" class="text-center">GROSS TONNES CANE MILLED</th>
            <th colspan="3" class="text-center">TONS SUGAR DUE CANE</th>
            <th colspan="2" class="text-center">LKG/TONNE CANE</th>
        </tr>
        <tr>
            <th class="text-center">THIS WEEK</th>
            <th class="text-center">PREVIOUS</th>
            <th class="text-center">TO DATE</th>
            <th class="text-center">THIS WEEK</th>
            <th class="text-center">PREVIOUS</th>
            <th class="text-center">TO DATE</th>
            <th class="text-center">TW</th>
            <th class="text-center">TD</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($millsArray))
            @php
                $ct = 0;
                $totals = [];
                $template = [];
                for ($x = 0;$x < 6; $x++){
                    $template[$x] = 0;
                }
            @endphp
            @foreach($millsArray as $group => $mills)
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
                        <td></td>
                        <td></td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                @php($totals[$group][0] += $mill['form1']['thisWeek']['gtcm']['current'])
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['thisWeek']['gtcm']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                @php($totals[$group][1] += $mill['form1']['prevToDate']['gtcm']['current'])
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['prevToDate']['gtcm']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                @php($totals[$group][2] += $mill['form1']['toDate']['gtcm']['current'])
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['gtcm']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                @php($totals[$group][3] += $mill['form1']['thisWeek']['tdc']['current'])
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['thisWeek']['tdc']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                @php($totals[$group][4] += $mill['form1']['prevToDate']['tdc']['current'])
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['prevToDate']['tdc']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                @php($totals[$group][5] += $mill['form1']['toDate']['tdc']['current'])
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['tdc']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['thisWeek']['lkgtc_gross']['current'],3,'-')}}
                            @endif
                        </td>
                        <td class="text-right">
                            @if(!empty($mill['form1']))
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form1']['toDate']['lkgtc_gross']['current'],3,'-')}}
                            @endif
                        </td>


                    </tr>
                @endforeach

                <tr class="text-strong" style="background-color: #f8ffeb">
                    <td colspan="2" class="text-right">
                        {{$group}} Subtotal
                    </td>
                    <td></td>
                    <td></td>
                    @if(!empty($totals[$group]))
                        @foreach($totals[$group] as $value)
                            <td class="text-right">{{number_format($value,3)}}</td>
                        @endforeach
                    @endif
                    @if($totals[$group][0] != 0)
                        <td class="text-right">
                            {{number_format($totals[$group][3] * 20 / $totals[$group][0],3)}}
                        </td>
                    @else
                        <td></td>
                    @endif
                    @if($totals[$group][2] != 0)
                        <td class="text-right">
                            {{number_format($totals[$group][5] * 20 / $totals[$group][2],3)}}
                        </td>
                    @else
                        <td></td>
                    @endif
                </tr>
            @endforeach
            <tr class="text-strong">
                <td colspan="2">TOTAL</td>
                <td></td>
                <td></td>
                @foreach($template as $key => $val)
                    <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
                @endforeach
                @if(array_sum(array_column($totals,0)) != 0)
                    <td class="text-right">{{number_format(array_sum(array_column($totals,3)) * 20 / array_sum(array_column($totals,0)),3)}}</td>
                @else
                    <td></td>
                @endif

                @if(array_sum(array_column($totals,2)) != 0)
                    <td class="text-right">{{number_format(array_sum(array_column($totals,5)) * 20 / array_sum(array_column($totals,2)),3)}}</td>
                @else
                    <td></td>
                @endif

            </tr>
        @endif
        </tbody>
    </table>
@endsection