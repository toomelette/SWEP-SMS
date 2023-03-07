@extends('printables.print_layouts.print_layout_main')


@section('wrapper')
    <table class="" style="width: 100%;">
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

    <p class="text-strong">REFINED SUGAR PRODUCTION, WITHDRAWALS, and STOCK BALANCES ( In 50 KILO-BAG)</p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th rowspan="3" class="text-center">#</th>
            <th rowspan="3" class="text-center">REFINERIES</th>
            <th rowspan="3">Start of Refining</th>
            <th rowspan="3">End of Refining</th>
            <th rowspan="3" class="text-center">Previous Crop/s Carry-over</th>
            <th rowspan="2" colspan="3" class="text-center">CURRENT CROP PRODUCTION</th>
            <th colspan="4" class="text-center">WITHDRAWALS</th>
            <th colspan="3" class="text-center">STOCK BALANCES</th>
        </tr>
        <tr>
            <th colspan="2" class="text-center">Current Crop</th>
            <th colspan="2" class="text-center">Previous Crop</th>
            <th rowspan="2" class="text-center">CURRENT</th>
            <th rowspan="2" class="text-center">PREVIOUS</th>
            <th rowspan="2" class="text-center">TOTAL</th>
        </tr>
        <tr>
            <th class="text-center">This Week</th>
            <th class="text-center">Previous</th>
            <th class="text-center">To Date</th>
            <th class="text-center">This Week</th>
            <th class="text-center">To-Date</th>
            <th class="text-center">This Week</th>
            <th class="text-center">To-Date</th>

        </tr>
        </thead>
        <tbody>
            @if(!empty($millsArray))
                @php
                    $ct = 0;
                    $totals = [];
                    $template = [];
                    for ($x = 0;$x <= 10; $x++){
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


                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>
                            <td></td>
                            <td></td>
                            <td class="text-right">
                                @php
                                    $totals[$group][0] = $totals[$group][0] + ($mill['form2']['toDate']['refinedCarryOver']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['refinedCarryOver']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][1] = $totals[$group][1] + ($mill['form2']['thisWeek']['totalProduction']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['totalProduction']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][2] = $totals[$group][2] + ($mill['form2']['prevToDate']['totalProduction']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['prevToDate']['totalProduction']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][3] = $totals[$group][3] + ($mill['form2']['toDate']['totalProduction']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['totalProduction']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][4] = $totals[$group][4] + ($mill['form2']['thisWeek']['withdrawalTotal']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['withdrawalTotal']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][5] = $totals[$group][5] + ($mill['form2']['toDate']['withdrawalTotal']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['withdrawalTotal']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][6] = $totals[$group][6] + ($mill['form2']['thisWeek']['withdrawalTotal']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['withdrawalTotal']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][7] = $totals[$group][7] + ($mill['form2']['toDate']['withdrawalTotal']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['withdrawalTotal']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][8] = $totals[$group][8] + ($mill['form2']['toDate']['stockBalance']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['stockBalance']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][9] = $totals[$group][9] + ($mill['form2']['toDate']['stockBalance']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['stockBalance']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][10] = $totals[$group][10] + (($mill['form2']['toDate']['stockBalance']['current'] ?? null) + ($mill['form2']['toDate']['stockBalance']['prev'] ?? null));
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber(
                                    ($mill['form2']['toDate']['stockBalance']['current'] ?? null) + ($mill['form2']['toDate']['stockBalance']['prev'] ?? null) ,
                                    3,
                                    ''
                                )}}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-strong">
                        <td colspan="2" class="text-right">
                            {{$group}} Subtotal
                        </td>
                        <td></td>
                        <td></td>
                        @if(!empty($totals[$group]))
                            @foreach($totals[$group] as $value)
                                <td class="text-right text-strong">{{number_format($value,3)}}</td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tr class="text-strong">
                    <td colspan="2">TOTAL (LKG)</td>
                    <td></td>
                    <td></td>
                    @foreach($template as $key => $val)
                        <td class="text-right">{{number_format(array_sum(array_column($totals,$key)),3)}}</td>
                    @endforeach
                </tr>
            @endif
        </tbody>
    </table>



    <div style="break-before: page">
        <p class="text-strong">RAW SUGAR RECEIPTS, MELTED, and STOCK BALANCES (In Lkg.)</p>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th rowspan="3" class="text-center">#</th>
                <th rowspan="3" class="text-center">REFINERIES</th>
                <th rowspan="3" class="text-center">Previous Crop/s Carry-over</th>
                <th colspan="3" class="text-center">RAW SUGAR RECEIPTS</th>
                <th colspan="4" class="text-center">MELTED</th>
                <th colspan="4" class="text-center">WITHDRAWALS</th>
                <th colspan="3" class="text-center">STOCK BALANCES</th>
            </tr>
            <tr>
                <th rowspan="3" class="text-center">This Week</th>
                <th rowspan="3" class="text-center">Previous</th>
                <th rowspan="3" class="text-center">To Date</th>
                <th colspan="2" class="text-center">CURRENT CROP</th>
                <th colspan="2" class="text-center">PREVIOUS CROP</th>
                <th colspan="2" class="text-center">CURRENT CROP</th>
                <th colspan="2" class="text-center">PREVIOUS CROP</th>
                <th rowspan="2" class="text-center">CURRENT CROP</th>
                <th rowspan="2" class="text-center">PREVIOUS CROP</th>
                <th rowspan="2" class="text-center">TOTAL</th>
            </tr>
            <tr>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>
                <th class="text-center">This Week</th>
                <th class="text-center">To-Date</th>

            </tr>
            </thead>
            <tbody>
            @if(!empty($millsArray))
                @php
                    $ct = 0;
                    $totals = [];
                    $template = [];
                    for ($x = 0;$x <= 14; $x++){
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


                        <tr>
                            <td>{{$ct}}</td>
                            <td>{{$mill_code}}</td>

                            <td class="text-right">
                                @php
                                    $totals[$group][0] = $totals[$group][0] + ($mill['form2']['toDate']['carryOver']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['carryOver']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][1] = $totals[$group][1] + ($mill['form2']['thisWeek']['totalReceipts']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['totalReceipts']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][2] = $totals[$group][2] + ($mill['form2']['prevToDate']['totalReceipts']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['prevToDate']['totalReceipts']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][3] = $totals[$group][3] + ($mill['form2']['toDate']['totalReceipts']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['totalReceipts']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][4] = $totals[$group][4] + ($mill['form2']['thisWeek']['melted']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['melted']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][5] = $totals[$group][5] + ($mill['form2']['toDate']['melted']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['melted']['current'] ?? null,3,'-')}}
                            </td>

                            <td class="text-right">
                                @php
                                    $totals[$group][6] = $totals[$group][6] + ($mill['form2']['thisWeek']['melted']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['melted']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][7] = $totals[$group][7] + ($mill['form2']['toDate']['melted']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['melted']['prev'] ?? null,3,'-')}}
                            </td>


                            <td class="text-right">
                                @php
                                    $totals[$group][8] = $totals[$group][8] + ($mill['form2']['thisWeek']['rawWithdrawals']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['withdrawalTotal']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][9] = $totals[$group][9] + ($mill['form2']['toDate']['rawWithdrawals']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['withdrawalTotal']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][10] = $totals[$group][10] + ($mill['form2']['thisWeek']['rawWithdrawals']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['thisWeek']['withdrawalTotal']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][11] = $totals[$group][11] + ($mill['form2']['toDate']['rawWithdrawals']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['withdrawalTotal']['prev'] ?? null,3,'-')}}
                            </td>


                            <td class="text-right">
                                @php
                                    $totals[$group][12] = $totals[$group][12] + ($mill['form2']['toDate']['rawBalance']['current'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['rawBalance']['current'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][13] = $totals[$group][13] + ($mill['form2']['toDate']['rawBalance']['prev'] ?? null);
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber($mill['form2']['toDate']['rawBalance']['prev'] ?? null,3,'-')}}
                            </td>
                            <td class="text-right">
                                @php
                                    $totals[$group][14] = $totals[$group][14] + (($mill['form2']['toDate']['rawBalance']['current'] ?? null) + ($mill['form2']['toDate']['rawBalance']['prev'] ?? null));
                                @endphp
                                {{\App\Swep\Helpers\Helper::toNumber(
                                    ($mill['form2']['toDate']['rawBalance']['current'] ?? null) + ($mill['form2']['toDate']['rawBalance']['prev'] ?? null) ,
                                    3,
                                    ''
                                )}}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="text-strong">
                        <td colspan="2" class="text-right">
                            {{$group}} Subtotal
                        </td>
                        @if(!empty($totals[$group]))
                            @foreach($totals[$group] as $value)
                                <td class="text-right text-strong">{{number_format($value,3)}}</td>
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
            @endif
            </tbody>
        </table>
    </div>

@endsection